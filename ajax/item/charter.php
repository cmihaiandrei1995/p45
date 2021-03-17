<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

$hotel = get_hotel_by_id(intval($_POST['id_hotel']));
if($hotel){

	$city = get_city_by_id($hotel['id_city']);
	$country = get_country_by_id($city['id_country']);

	$city_from = get_city_by_id($_POST['id_city_from']);

	$rooms = intval($_POST['rooms']);
	$room_info = json_decode($_POST['rooms_info'], true);

	for($i=0; $i<$rooms; $i++){
		$adults_all += $room_info[$i]['adult'];
		$children_all += $room_info[$i]['child'];
	}

	if(in_array($hotel['id_country'], $_problematic_countries_with_1_day_flight)){
		$_POST['check_out'] = date('Y-m-d', strtotime($_POST['check_out']." -1day"));
	}

	$data = array(
		'city' => $city['code'],
	    'country' => $country['code'],
	    'from_city' => $city_from['code'],
	    'date_from' => date('Y-m-d', strtotime($_POST['check_in'])),
	    'date_to' => date('Y-m-d', strtotime($_POST['check_out'])),
	    'title' => $hotel['title_original'] != "" ? $hotel['title_original'] : $hotel['title'],
		'code' => $hotel['code'],
		'tourop_code' => $hotel['tourop_code'],
	    'rooms' => $rooms,
	    'rooms_info' => $room_info
	);
	$nr_nights = days_between_dates($_POST['check_in'], $_POST['check_out']);

	$results = eurositeGetPackageNVPriceRequestForPricing($data);

	if(debug_mode()){
		// echo "<pre>";
		// print_r($results);
		// echo "</pre>";
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

		foreach($solutions as &$sol){
			foreach($sol['PriceDetails']['Services']['Service'] as $serv){
				if($serv['Type']['value'] == "7"){
					if($serv['Availability']['attr']['Code'] != "IM" && $serv['Availability']['attr']['Code'] != $sol['Availability']['attr']['Code']){
						$sol['Availability']['attr']['Code'] = $serv['Availability']['attr']['Code'];
						break;
					}
				}
			}
			unset($sol);
		}

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

		if(debug_mode()){
			// echo "<pre>";
			// print_r($solutions);
			// echo "</pre>";
		}

		?>

		<div class="col-xs-12">

			<?
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

						$pret_hotel = $variant['Gross']['value']/$adults_all;
		                $pret_nored = $variant['PriceNoRedd']['value']/$adults_all;

						// data plecare poate fi diferita de data checkin - vezi maldive, plecare pe 26, checkin pe 27, checkout pe 04, retur zbor pe 05.
						// luam si salvam ca sa afisam data plecare + data checkout.
						$date_from = date('Y-m-d', strtotime($_POST['check_in'])); // este cea din calendar
						$date_to = date("Y-m-d", strtotime($variant['PeriodOfStay']['CheckOut']['value']));

						$desc = $variant['OfferDescription']['value'];
						$hotelCode = $hotel['code'];
						$id_hotel = $hotel['id_hotel'];

						$offer_id_city_from = $city_from['id_city'];
						$offer_id_city = $city['id_city'];

						if($pret_hotel > 0){
		                    // Check if it exists
		                    $exists = db_row('SELECT * FROM charter_minprice WHERE id_hotel = ? AND date_from = ? AND date_to = ? AND id_city_from = ? AND id_city = ?', $id_hotel, $date_from, $date_to, $offer_id_city_from, $offer_id_city);
		                    if($exists){
		                        //daca pretul nou venit din request este mai mic ca cel prezent in baza de date il updatam
		                        //if($exists['price'] > $pret_hotel){
		                            if($pret_hotel != $pret_nored){
		                                db_query('UPDATE charter_minprice SET price = ?, priceNoRedd = ?, description = ? WHERE id_charter_minprice = ?', $pret_hotel, $pret_nored, $offer_description, $exists['id_charter_minprice']);
		                            } else {
		                                db_query('UPDATE charter_minprice SET price = ?, priceNoRedd = NULL, description = NULL WHERE id_charter_minprice = ?', $pret_hotel, $exists['id_charter_minprice']);
		                            }
		                        //}
		                    } else {
		                        if($pret_hotel != $pret_nored){
		                            db_query('INSERT INTO charter_minprice SET id_hotel = ?, code = ?, date_from = ?, date_to = ?, nr_nights = ?, price = ?, priceNoRedd = ?, description = ?, id_city_from = ?, id_city = ?', $id_hotel, $hotelCode, $date_from, $date_to, $nr_nights, $pret_hotel, $pret_nored, $offer_description, $offer_id_city_from, $offer_id_city);
		                        } else {
		                            db_query('INSERT INTO charter_minprice SET id_hotel = ?, code = ?, date_from = ?, date_to = ?, nr_nights = ?, price = ?, id_city_from = ?, id_city = ?, priceNoRedd = NULL, description = NULL', $id_hotel, $hotelCode, $date_from, $date_to, $nr_nights, $pret_hotel, $offer_id_city_from, $offer_id_city);
		                        }
		                    }
	                    }else{
	                    	db_query('DELETE FROM charter_minprice WHERE id_hotel = ? AND date_from = ? AND date_to = ? AND id_city_from = ? AND id_city = ?', $id_hotel, $date_from, $date_to, $offer_id_city_from, $offer_id_city);
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
							<div class="col-sm-6">
								<div class="row half-gutters">
									<div class="col-sm-3 tl">
										<strong>Camera</strong>
									</div>
									<div class="col-sm-3">
										<strong>Adulti</strong>
									</div>
									<div class="col-sm-3">
										<strong>Copii</strong>
									</div>
									<div class="col-sm-3">
										<strong>Durata</strong>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
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
				$flight_info = array();
				foreach($services as $service){
					if(!str_like('%package%', $service['Name']['value']) && !str_like('%commission%', $service['Name']['value']) && !str_like('%rounding%', $service['Name']['value']) && !str_like('%comision%', $service['Name']['value']) && !str_like('%rotunjire%', $service['Name']['value']) && !str_like('%reducere%', $service['Name']['value'])){
						$services_text[] = ucfirst($service['Name']['value']);
					}
					if($service['Type']['value'] == "7" && $service['Transport']['value'] == "plane"){
						$flight_info[] = array(
							'from' => $service['Departure']['value'],
							'from_code' => $service['Departure']['attr']['Code'],
							'from_date' => $service['PeriodOfStay']['CheckIn']['value'],
							'to' => $service['Arrival']['value'],
							'to_code' => $service['Arrival']['attr']['Code'],
							'to_date' => $service['PeriodOfStay']['CheckOut']['value'],
							'company' => $service['Company']['value'],
							'flight_nr' => $service['FlightNumber']['value'],
						);
					}
				}

				$rooms_solution = array();
				$rooms_eurosite = $variant['BookingRoomTypes']['Room'];
				if($rooms_eurosite['value']){
					$rooms_solution[] = $rooms_eurosite;
				}else{
					$rooms_solution = $rooms_eurosite;
				}

				$rooms_available = array();
				foreach($rooms_solution as $room){
					$rooms_available[trim($room['value'])] += $room['attr']['Quantity'];
				}

				$room_txt = "";
				foreach($rooms_available as $room => $quant){
					$room_txt .= $quant." X ".$room."<br>";
				}

				$_package_id = $variant['PackageId']['value'];
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
							<div class="col-sm-3 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Adulti:</strong>
								<?=$adults_all?>
							</div>
							<div class="col-sm-3 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Copii:</strong>
								<?=($children_all > 0 ? $children_all : "-")?>
							</div>
							<div class="col-sm-3 tl">
							    <strong class="hidden-lg hidden-md hidden-sm">Durata:</strong>
								<?=$nr_nights?> nopti
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
									<del><?=$variant['PriceNoRedd']['value']?> &euro;</del> <span><?=$variant['Gross']['value']?> &euro;</span> <small><?=$variant['OfferDescription']['value']?></small>
								<? }else{ ?>
									<?
									$_final_price = $variant['Gross']['value'];
									$_old_price = "";
									?>
									<span><?=$variant['Gross']['value']?> &euro;</span>
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
									<form action="<?=route('booking-charter')?>" method="post">
										<input type="hidden" name="id_hotel" value="<?=$hotel['id_hotel']?>">
										<input type="hidden" name="id_city_from" value="<?=$city_from['id_city']?>">
										<input type="hidden" name="search_data" value="<?=htmlentities(json_encode($data))?>">

										<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
										<input type="hidden" name="country_code" value="<?=$_country_code?>">
										<input type="hidden" name="city_code" value="<?=$_city_code?>">
										<input type="hidden" name="hotel_code" value="<?=$_hotel_code?>">

										<input type="hidden" name="package_id" value="<?=$_package_id?>">
										<input type="hidden" name="variant_id" value="<?=$_variant_id?>">
										<input type="hidden" name="check_in" value="<?=$_check_in?>">
										<input type="hidden" name="check_out" value="<?=$_check_out?>">
										<input type="hidden" name="rooms_solution" value="<?=htmlentities(json_encode($_rooms_solution))?>">
										<input type="hidden" name="room_info" value="<?=$room_txt?>">
										<input type="hidden" name="services_info" value="<?=implode(', ', $services_text)?>">
										<input type="hidden" name="flight_info" value="<?=htmlentities(json_encode($flight_info))?>">
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
						<div class="col-md-6 col-sm-12 text-left" style="font-size:10px; line-height: 12px; margin-top:15px;">
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
