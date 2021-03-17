<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

$hotel = get_hotel_by_id(intval($_POST['id_hotel']));
if($hotel){

	$city = get_city_by_id($hotel['id_city']);
	$country = get_country_by_id($city['id_country']);

	$rooms = intval($_POST['rooms']);
	$room_info = json_decode($_POST['rooms_info'], true);

	for($i=0; $i<$rooms; $i++){
		$adults_all += $room_info[$i]['adult'];
		$children_all += $room_info[$i]['child'];
	}

	$data = array(
		'city' => $city['code'],
	    'country' => $country['code'],
	    'date_from' => date('Y-m-d', strtotime($_POST['check_in'])),
	    'date_to' => date('Y-m-d', strtotime($_POST['check_out'])),
	    'title' => $hotel['title_original'] != "" ? $hotel['title_original'] : $hotel['title'],
		'code' => $hotel['code'],
		'tourop_code' => $hotel['tourop_code'],
	    'rooms' => $rooms,
	    'rooms_info' => $room_info
	);
	$nr_nights = days_between_dates($_POST['check_in'], $_POST['check_out']);

	$currency = "EUR";
	if($country['id_country'] == 126){
		$currency = "RON";
	}
	$results = eurositeGetHotelPriceRequestForPricing($data, $currency);

	if(debug_mode()){
		//echo "<pre>";
		//print_r($results);
		//echo "</pre>";
	}

	$solutions = array();
	if($results['Hotel'][0]){
		$solutions_hotels = $results['Hotel'];
	}else{
		$solutions_hotels[] = $results['Hotel'];
	}

	foreach($solutions_hotels as $key => $hotel_eurosite){
		if($hotel_eurosite['Product']['ProductCode']['value'] != $hotel['code']){
			unset($solutions_hotels[$key]);
		}
	}
	$solutions_hotels = array_values($solutions_hotels);

	$hotel_eurosite = $solutions_hotels[0]['Offers']['Offer'];
	if($hotel_eurosite['OfferType']['value']){
		$solutions[] = $hotel_eurosite;
	}else{
		$solutions = $hotel_eurosite;
	}

	if($solutions){

		$_tour_op = $solutions_hotels[0]['Product']['TourOpCode']['value'];
		$_country_code = $solutions_hotels[0]['Product']['CountryCode']['value'];
		$_city_code = $solutions_hotels[0]['Product']['CityCode']['value'];
		$_hotel_code = $solutions_hotels[0]['Product']['ProductCode']['value'];

		usort($solutions, function($a, $b){
			if($a['Availability']['attr']['Code'] == $b['Availability']['attr']['Code']){
				//return 0;
				if($a['PriceNoRedd']['value'] > 0 && $b['PriceNoRedd']['value'] > 0){
					if($a['PriceNoRedd']['value'] == $b['PriceNoRedd']['value']) return 0;
					else return $a['PriceNoRedd']['value'] > $b['PriceNoRedd']['value'] ? 1 : -1;
				}elseif($a['PriceNoRedd']['value'] > 0){
					if($a['PriceNoRedd']['value'] == $b['Gross']['value']) return 0;
					else return $a['PriceNoRedd']['value'] > $b['Gross']['value'] ? 1 : -1;
				}elseif($b['PriceNoRedd']['value'] > 0){
					if($a['Gross']['value'] == $b['PriceNoRedd']['value']) return 0;
					else return $a['Gross']['value'] > $b['PriceNoRedd']['value'] ? 1 : -1;
				}else{
					if($a['Gross']['value'] == $b['Gross']['value']) return 0;
					else return $a['Gross']['value'] > $b['Gross']['value'] ? 1 : -1;
				}
			}else{
				if($a['Availability']['attr']['Code'] == "ST" && $b['Availability']['attr']['Code'] == "IM"){
					return 1;
				}
				if($a['Availability']['attr']['Code'] == "ST" && $b['Availability']['attr']['Code'] == "OR"){
					return 1;
				}
				if($a['Availability']['attr']['Code'] == "IM" && $b['Availability']['attr']['Code'] == "ST"){
					return -1;
				}
				if($a['Availability']['attr']['Code'] == "OR" && $b['Availability']['attr']['Code'] == "ST"){
					return -1;
				}
			}
		});

		?>

		<div class="col-xs-12">

			<?
			usort($solutions, function($a, $b){
				if(strtotime($a['PeriodOfStay']['CheckIn']['value']) == strtotime($b['PeriodOfStay']['CheckIn']['value'])) return 0;
				return strtotime($a['PeriodOfStay']['CheckIn']['value']) < strtotime($b['PeriodOfStay']['CheckIn']['value']) ? -1 : 1;
			});

			foreach($solutions as $k => $variant){

				if($variant['Meals']['Meal'][0]['value'] != ""){
					$meal_desc_all = array();
					foreach($variant['Meals']['Meal'] as $meal){
						$meal_desc_all[] = $meal['value'];
					}
					$meal_desc = implode(", ", $meal_desc_all);
				}else{
					$meal_desc = $variant['Meals']['Meal']['value'];
				}
				?>

				<? if($k == 0){ ?>

					<?
					if($variant['Availability']['attr']['Code'] != "ST" && $children_all < 1){

						$pret_hotel = $variant['Gross']['value']/$nr_nights/$adults_all;
		                $pret_nored = $variant['PriceNoRedd']['value']/$nr_nights/$adults_all;

						$date_from = date("Y-m-d", strtotime($variant['PeriodOfStay']['CheckIn']['value']));
						$date_to = date("Y-m-d", strtotime($variant['PeriodOfStay']['CheckOut']['value']));

						$desc = $variant['OfferDescription']['value'];
						$hotelCode = $hotel['code'];
						$id_hotel = $hotel['id_hotel'];
						$tourOpCode = $hotel['tourop_code'];

						if($pret_hotel > 0){
			                // Check if it exists
			                $exists = db_row('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from = ? AND date_to = ? AND meal = ?', $id_hotel, $date_from, $date_to, $meal_desc);

			                if($exists){
			                    //daca pretul nou venit din request este mai mic ca cel prezent in baza de date il updatam
								//if($exists['price'] > $pret_hotel && $pret_hotel > 0){
								if($pret_hotel > 0){
			                        if($pret_hotel != $pret_nored){
			                           db_query('UPDATE hotel_minprice SET tourop_code = ?, price = ?, priceNoRedd = ?, meal = ?, description = ?, requested_from = "search" WHERE id_hotel = ?', $tourOpCode, $pret_hotel, $pret_nored, $meal_desc, $offer_desc, $id_hotel);
		                            } else {
			                           db_query('UPDATE hotel_minprice SET tourop_code = ?, price = ?, priceNoRedd = NULL, meal = ?, description = NULL, requested_from = "search" WHERE id_hotel = ?', $tourOpCode, $pret_hotel, $meal_desc, $id_hotel);
		                            }
			                    }
			                } else {
			                    if($pret_hotel != $pret_nored){
			                       db_query('INSERT INTO hotel_minprice SET id_hotel = ?, code = ?, tourop_code = ?, date_from = ?, date_to = ?, nr_nights = ?, price = ?, priceNoRedd = ?, meal = ?, description = ?, requested_from = "search"', $id_hotel, $hotelCode, $tourOpCode, $date_from, $date_to, $nr_nights, $pret_hotel, $pret_nored, $meal_desc, $offer_desc);
		                        } else {
			                       db_query('INSERT INTO hotel_minprice SET id_hotel = ?, code = ?, tourop_code = ?, date_from = ?, date_to = ?, nr_nights = ?, price = ?, priceNoRedd = NULL, meal = ?, description = NULL, requested_from = "search"', $id_hotel, $hotelCode, $tourOpCode, $date_from, $date_to, $nr_nights, $pret_hotel, $meal_desc);
		                        }
			                }
		               	}
					}
					?>

					<p class="rez-calc__title">
						<strong>Rezultate calcul tarif:</strong>
						<?=$adults_all?> adulti<?=$children_all > 0 ? ", ".$children_all."copii" : ""?>,
						plecare in <?=date('d.m.Y', strtotime($_POST['check_in']))?>,
						<?=$nr_nights?> nopti cazare
					</p>
					<hr class="hr--blue hidden-xs hidden-sm">
					<div class="rez-calc__desktop">
						<div class="row rez-calc__sub hidden-xs half-gutters">
							<div class="col-sm-7">
								<div class="row half-gutters">
									<div class="col-sm-3 tl">
										<strong>Camera</strong>
									</div>
									<div class="col-sm-1">
										<strong>Adulti</strong>
									</div>
									<div class="col-sm-1">
										<strong>Copii</strong>
									</div>
									<div class="col-sm-2">
										<strong>Durata</strong>
									</div>
									<div class="col-sm-5">
										<strong>Perioada</strong>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="row half-gutters">
									<div class="col-sm-3">
										<strong>Tip masa</strong>
									</div>
									<div class="col-sm-3">
										<strong>Pret</strong>
									</div>
									<div class="col-sm-3">
										<strong>Status</strong>
									</div>
									<div class="col-sm-3 hide-print"></div>
								</div>
							</div>
						</div>
						<hr class="hr--blue">

				<? } ?>

				<?
				$services_xml = $variant['PriceDetails']['Services']['Service'];

				$services = array();
				if($services_xml['Name']['value']){
					$services[] = $services_xml;
				}else{
					$services = $services_xml;
				}

				$services_text = array();
				foreach($services as $service){
					if(!str_like('%package%', $service['Name']['value']) && !str_like('%commission%', $service['Name']['value']) && !str_like('%rounding%', $service['Name']['value']) && !str_like('%comision%', $service['Name']['value']) && !str_like('%rotunjire%', $service['Name']['value']) && !str_like('%reducere%', $service['Name']['value'])){
						$services_text[] = ucfirst($service['Name']['value']);
					}
				}

				$rooms_solution = array();
				$rooms_eurosite = $variant['BookingRoomTypes']['Room'];
				if($rooms_eurosite['value']){
					$rooms_solution[] = $rooms_eurosite;
				}else{
					$rooms_solution = $rooms_eurosite;
				}

				/*
				foreach($rooms_solution as &$room){
					if($children_all > 0){
						if($room['attr']['ExtraBed'] == "true"){
							$room['value'] .= " (cu pat suplimentar)";
						}else{
							$room['value'] .= " (fara pat suplimentar)";
						}
					}
					unset($room);
				}
				*/

				$rooms_available = array();
				foreach($rooms_solution as $room){
					$rooms_available[trim($room['value'])] += $room['attr']['Quantity'];
				}

				$room_txt = "";
				foreach($rooms_available as $room => $quant){
					$room_txt .= $quant." X ".$room."<br>";
				}

				$_variant_id = $variant['PackageVariantId']['value'];

				$_check_in = $variant['PeriodOfStay']['CheckIn']['value'];
				$_check_out = $variant['PeriodOfStay']['CheckOut']['value'];

				$rooms_solution = $_rooms_solution = array();
				$rooms_eurosite = $variant['BookingRoomTypes']['Room'];
				if($rooms_eurosite['value']){
					$rooms_solution[] = $rooms_eurosite;
				}else{
					$rooms_solution = $rooms_eurosite;
				}

				foreach($rooms_solution as $room){
					$_rooms_solution[] = $room['attr']['Code'];
				}
				?>
				<div class="row rez-calc__item rez-calc__item_mobile half-gutters">
					<div class="col-sm-6">
						<div class="row half-gutters">
							<div class="col-sm-3 tl">
								<!--
								<?=date('d.m.Y', strtotime($date['dep_date']))?> - <?=date('d.m.Y', strtotime($date['ret_date_arr']))?>
								-->
								<strong class="hidden-lg hidden-md hidden-sm">Camera:</strong>
								<?=$room_txt?>
							</div>
							<div class="col-sm-1 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Adulti:</strong>
								<?=$adults_all?>
							</div>
							<div class="col-sm-1 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Copii:</strong>
								<?=($children_all > 0 ? $children_all : "-")?>
							</div>
							<div class="col-sm-2 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Durata:</strong>
								<?=days_between_dates(date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckIn']['value'])), date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckOut']['value'])))?> nopti
							</div>
							<div class="col-sm-5 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Perioada:</strong>
							    <? if(date('d.m.Y', strtotime($_POST['check_in'])) != date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckIn']['value']))){?><b><? }?>
									<?=date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckIn']['value']))?> -
									<?=date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckOut']['value']))?>
								<? if(date('d.m.Y', strtotime($_POST['check_in'])) != date("d.m.Y", strtotime($variant['PeriodOfStay']['CheckIn']['value']))){?></b><? }?>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row half-gutters">
							<div class="col-sm-3 tl">
								<?=$meal_desc?>
							</div>
							<div class="col-sm-3 rez-calc__item__price tl">
								<? if($variant['PriceNoRedd']['value'] > 0 && $variant['PriceNoRedd']['value'] > $variant['Gross']['value']){?>
									<?
									$_final_price = $variant['Gross']['value'];
									$_old_price = $variant['PriceNoRedd']['value'];
									?>
									<del><?=$variant['PriceNoRedd']['value']?> <?=$_currency_symbol[$currency]?></del> <span><?=$variant['Gross']['value']?> <?=$_currency_symbol[$currency]?></span> <small><?=$variant['OfferDescription']['value']?></small>
								<? }else{ ?>
									<?
									$_final_price = $variant['Gross']['value'];
									$_old_price = "";
									?>
									<span><?=$variant['Gross']['value']?> <?=$_currency_symbol[$currency]?></span>
								<? }?>
							</div>
							<div class="col-sm-3 rez-calc__item__status tl">
								<? if($variant['Availability']['attr']['Code'] == "IM"){?>
									<span class="disponibil">
										Disponibil
										<i class="zmdi zmdi-info" data-toggle="tooltip" data-placement="top" title="Pachetul ales este disponibil si poate fi rezervat imediat"></i>
									</span>
								<? }elseif($variant['Availability']['attr']['Code'] == "ST"){?>
									<span class="red">
										Indisponibil
										<i class="zmdi zmdi-info" data-toggle="tooltip" data-placement="top" title="Pachetul este indisponibil"></i>
									</span>
								<? }else{?>
									<span class="ultimele">
										La cerere
										<i class="zmdi zmdi-info" data-toggle="tooltip" data-placement="top" title="Pachetul ales necesita confirmare din partea partenerilor nostri."></i>
									</span>
								<? }?>
							</div>
							<div class="col-sm-3 hide-print">
								<? if($variant['Availability']['attr']['Code'] != "ST"){?>
									<?
									$tmp_hash =
										$_country_code.'-'.
										$_city_code.'-'.
										$_hotel_code.'-'.
										$_package_id.'-'.
										$_variant_id.'-'.
										$_check_in.'-'.
										$_check_out.'-'.
										$_final_price.'-'.
										$_old_price;
									$hash = md5($tmp_hash);
									?>
									<form action="<?=route('booking-tourism')?>" method="post">
										<input type="hidden" name="id_hotel" value="<?=$hotel['id_hotel']?>">
										<input type="hidden" name="search_data" value="<?=htmlentities(json_encode($data))?>">

										<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
										<input type="hidden" name="country_code" value="<?=$_country_code?>">
										<input type="hidden" name="city_code" value="<?=$_city_code?>">
										<input type="hidden" name="hotel_code" value="<?=$_hotel_code?>">

										<input type="hidden" name="variant_id" value="<?=$_variant_id?>">
										<input type="hidden" name="check_in" value="<?=$_check_in?>">
										<input type="hidden" name="check_out" value="<?=$_check_out?>">
										<input type="hidden" name="rooms_solution" value="<?=htmlentities(json_encode($_rooms_solution))?>">
										<input type="hidden" name="room_info" value="<?=$room_txt?>">
										<input type="hidden" name="meal_info" value="<?=$meal_desc?>">
										<input type="hidden" name="final_price" value="<?=$_final_price?>">
										<input type="hidden" name="old_price" value="<?=$_old_price?>">
										<input type="hidden" name="availability" value="<?=$variant['Availability']['attr']['Code']?>">

										<input type="hidden" name="hash" value="<?=$hash?>">

										<button class="btn btn-block btn--green rez-calc__item__btn">Rezerva</button>
									</form>
								<? }?>
							</div>
						</div>
					</div>
					<? if($services_text){?>
						<div class="clearfix"></div>
						<div class="col-md-6 col-sm-12 text-left" style="font-size:12px; line-height: 14px;">
							<p><b>Pretul include:</b> <br> <?=implode(', ', $services_text)?></p>
						</div>
					<? }?>
				</div>
				<hr class="hr--blue">

				<? if($k == 0){ ?>
				</div>
				<? }?>

			<? }?>

			<div class="row">
				<div class="col-sm-12">
					<div class="rez-calc__extra">
						<p>Reducerile Early Booking sunt valabile cu conditia achitarii pachetelor rezervate conform termenelor de plata.</p>
						<!-- <p>Tarifele din tabelul de mai sus sunt cu titlu informativ pentru a va arata in ce perioada tarifele sunt mai mici. Pentru a afla tariful exact va rugam sa faceti o calculatie in motorul “Calculeaza tarif exact”.</p> -->
						<p>Reducerile se aplica la tarifele de cazare si sunt calculate din oferta standard.</p>
					</div>
				</div>
			</div>

		</div>

		<?

	}else{

		?>

		<div class="col-xs-12">
			<div class="alert alert-danger">
				<? if($rooms > 1){?>
					Ne pare rau, dar camerele selectate de tine nu mai sunt disponibile.
				<? }else{ ?>
					Ne pare rau, dar camera selectata de tine nu mai este disponibila.
				<? }?>
			</div>
		</div>

		<?

	}

}


// Close the conn
$_db->close();
