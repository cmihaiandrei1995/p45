<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';


$date = db_row('SELECT * FROM circuit_date_price WHERE id_circuit_date_price = ?', intval($_POST['date']));
if($date){
	$circuit = get_circuit_by_id($date['id_circuit']);
	if($circuit){

		$circuit = circuit_prepare_info($circuit);

		$destination = db_row('SELECT * FROM circuit_to_city WHERE id_circuit = ? LIMIT 1', $circuit['id_circuit']);

		$city = get_city_by_id($destination['id_city']);
		$country = get_country_by_id($city['id_country']);

		$month = date('n', strtotime($date['dep_date']));
		$year = date('Y', strtotime($date['dep_date']));

		$rooms = intval($_POST['rooms']);
		$room_info = json_decode($_POST['rooms_info'], true);

		for($i=0; $i<$rooms; $i++){
			$adults_all += $room_info[$i]['adult'];
			$children_all += $room_info[$i]['child'];
		}

		for($i=0; $i<$rooms; $i++){

			$data = array(
				'city' => $city['code'],
			    'country' => $country['code'],
			    'year' => $year,
			    'month' => $month,
			    'title' => $circuit['title_original'],
			    'rooms' => 1,
			    'rooms_info' => array(0 => $room_info[$i])
			);

			$results = eurositeCircuitSearchRequestForPricing($data);

			if(debug_mode()){
				// echo "<pre>";
				// print_r($results);
				// echo "</pre>";
			}

			$variants = array();
			if($results['Circuit']['Variants']['Variant']){
				$circuit_eurosite = $results['Circuit']['Variants']['Variant'];
				$search_id = $results['Circuit']['SearchId']['value'];
			}else{
				foreach($results['Circuit'] as $api_circuit){
					if($api_circuit['CircuitId']['value'] == $circuit['code']){
						$circuit_eurosite = $api_circuit['Variants']['Variant'];
						$search_id = $api_circuit['SearchId']['value'];
						break;
					}
				}
			}

			if(debug_mode()){
				// echo "<pre>";
				// print_r($circuit_eurosite);
				// echo "</pre>";
			}

			if($circuit_eurosite['UniqueId']['value']){
				$variants[] = $circuit_eurosite;
			}else{
				$variants = $circuit_eurosite;
			}

			if(debug_mode()){
				//echo "<pre>";
				//print_r($variants);
				//echo "</pre>";
			}

			if($variants){
				$solutions[] = array(
					'solutions' => $variants,
					'search_id' => $search_id
				);
			}else{
				$solutions[] = false;
			}

			$found = false;
			if($variants){
				foreach($variants as $variant){
					$variant_id = str_replace($search_id."_", "", $variant['UniqueId']['value']);

					if($date['code'] == $variant_id){
						$found = true;
					}
				}
			}

			if($found){
				$new_room_info[] = $room_info[$i];
			}

			if(debug_mode()){
				// echo "<pre>";
				// print_r($variants);
				// echo "</pre>";
			}
		}

		/*
		$room_info = $new_room_info;
		$rooms = count($room_info);

		$adults_all = $children_all = 0;
		for($i=0; $i<$rooms; $i++){
			$adults_all += $room_info[$i]['adult'];
			$children_all += $room_info[$i]['child'];
		}
		*/

		// general request with all rooms
		$data = array(
			'city' => $city['code'],
		    'country' => $country['code'],
		    'year' => $year,
		    'month' => $month,
		    'title' => $circuit['title_original'],
		    'rooms' => count($new_room_info),
		    'rooms_info' => $new_room_info
		);

		$results_all_rooms = eurositeCircuitSearchRequestForPricing($data);

		// if(debug_mode()){
		// 	echo "<pre>";
		// 	print_r($circuit);
		// 	print_r($results_all_rooms);
		// 	echo "</pre>";
		// }

		$variants_all_rooms = array();
		if($results_all_rooms['Circuit']['Variants']['Variant']){
			$circuit_eurosite_all_rooms = $results_all_rooms['Circuit']['Variants']['Variant'];
			$_tour_op = $results_all_rooms['Circuit']['TourOpCode']['value'];
			$_circuit_id = $results_all_rooms['Circuit']['CircuitId']['value'];
			$_search_id = $results_all_rooms['Circuit']['SearchId']['value'];
		}else{
			foreach($results_all_rooms['Circuit'] as $circuit_eurosite){
				if($circuit_eurosite['CircuitId']['value'] == $circuit['code']){
					$circuit_eurosite_all_rooms = $circuit_eurosite['Variants']['Variant'];
					$_tour_op = $circuit_eurosite['TourOpCode']['value'];
					$_circuit_id = $circuit_eurosite['CircuitId']['value'];
					$_search_id = $circuit_eurosite['SearchId']['value'];
				}
			}
		}

		if($circuit_eurosite_all_rooms['UniqueId']['value']){
			$variants_all_rooms[] = $circuit_eurosite_all_rooms;
		}else{
			$variants_all_rooms = $circuit_eurosite_all_rooms;
		}

		foreach($variants_all_rooms as $k => $variant){
			$variant_id = str_replace($_search_id."_", "", $variant['UniqueId']['value']);

			if($date['code'] == $variant_id){
				$_unique_id = $variant['UniqueId']['value'];
				$_departure_charter = $variant['DepartureCharter']['value'];
				$_final_price = $variant['Gross']['value'];

				$rooms_solution = $rooms_available = array();
				$rooms_eurosite = $variant['Rooms']['Room'];
				if($rooms_eurosite['value']){
					$rooms_solution[] = $rooms_eurosite;
				}else{
					$rooms_solution = $rooms_eurosite;
				}

				foreach($rooms_solution as $room){
					$_rooms_solution[] = $room['attr']['Code'];
					$rooms_available[trim($room['value'])] += 1;//$room['attr']['Quantity'];
				}

				$room_txt = "";
				foreach($rooms_available as $room => $quant){
					$room_txt .= $quant." X ".$room."<br>";
				}
			}
		}

		if($solutions){

			?>

			<div class="col-xs-12">

				<?
				$found = false;
				foreach($solutions as $k => $variants){
					if(is_array($variants)){
						foreach($variants['solutions'] as $variant){
							$variant_id = str_replace($variants['search_id']."_", "", $variant['UniqueId']['value']);

							if($date['code'] == $variant_id){
								$found = true;
							}
						}
					}
				}

				if($found){

					foreach($solutions as $k => $variants){

						$adults = $room_info[$k]['adult'];
						$children = $room_info[$k]['child'];

						if(is_array($variants)){

							?>

							<? if($k == 0){ ?>

								<p class="rez-calc__title">
									<strong>Rezultate calcul tarif:</strong>
									<?=$adults_all?> adulti<?=$children_all > 0 ? ", ".$children_all."copii" : ""?>,
									plecare in <?=date('d.m.Y', strtotime($date['dep_date']))?>,
									<?=$circuit['nights']?> nopti
								</p>
								<hr class="hr--blue hidden-xs hidden-sm">
								<div class="rez-calc__desktop">
									<div class="row rez-calc__sub hidden-xs">
										<div class="col-sm-6">
											<div class="row">
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
											<div class="row">
												<div class="col-sm-4">
													<strong>Tip masa</strong>
												</div>
												<div class="col-sm-4">
													<strong>Pret</strong>
												</div>
												<div class="col-sm-4">
													<strong>Status</strong>
												</div>
												<!--
												<div class="col-sm-1 hide-print"></div>
												-->
											</div>
										</div>
									</div>
									<hr class="hr--blue">

							<? } ?>

							<?
							foreach($variants['solutions'] as $variant){
								$variant_id = str_replace($variants['search_id']."_", "", $variant['UniqueId']['value']);

								if($date['code'] == $variant_id){

									$services = $variant['Services']['Service'];

									$services_text = array();
									foreach($services as $service){
										$services_text[] = $service['Name']['value'];
									}
									?>
									<div class="row rez-calc__item rez-calc__item_mobile">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3 tl">
													<!--
													<?=date('d.m.Y', strtotime($date['dep_date']))?> - <?=date('d.m.Y', strtotime($date['ret_date_arr']))?>
													-->
													<strong class="hidden-lg hidden-md hidden-sm">Camera:</strong>
													<?=$variant['Rooms']['Room']['value']?>
													<?//=$_circuit_room_types[$room_info[$k]['type']]['title']?>
												</div>
												<div class="col-sm-3 tl">
												    <strong class="hidden-lg hidden-md hidden-sm">Adulti:</strong>
													<?=$adults?>
												</div>
												<div class="col-sm-3 tl">
												    <strong class="hidden-lg hidden-md hidden-sm">Copii:</strong>
													<?=$children?>
												</div>
												<div class="col-sm-3 tl">
												    <strong class="hidden-lg hidden-md hidden-sm">Durata:</strong>
													<?=$circuit['nights']?> nopti
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4 tl">
													Conform programului
												</div>
												<div class="col-sm-4 rez-calc__item__price tl">
													<span><?=$variant['Gross']['value']?> &euro;</span>
													<!--
													<del>589 €</del> <span>450 €</span> <small>Reducere EB 40% pana la 30.09.206 din cazare</small>
													-->
												</div>
												<div class="col-sm-4 rez-calc__item__status tl">
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
												<!--
												<div class="col-sm-1 hide-print">
													<a class="hidden-xs remove_room" href="#"><i class="zmdi zmdi-delete error"></i></a>
													<a class="hidden-lg hidden-md hidden-sm error remove_room" href="#">Sterge</a>
												</div>
												-->
												<!--
												<div class="col-sm-3">
													<a class="btn btn-block btn--green rez-calc__item__btn" href="http://demo.prologue.ro/p45/chartere-hotel-rezervare.php">Rezerva</a>
												</div>
												-->
											</div>
										</div>
										<? if($services_text){?>
											<div class="clearfix"></div>
											<div class="col-md-6 col-sm-12 text-left" style="font-size:12px; line-height: 14px; margin-top: 15px;">
												<p><b>Pretul include:</b> <br> <?=implode(', ', $services_text)?></p>
											</div>
										<? }?>
									</div>
									<hr class="hr--blue">

									<?
								}
							}
							?>

							<? if($k == 0){ ?>
							</div>
							<? }?>

						<? }else{ ?>

							<? if($k == 0){ ?>

								<p class="rez-calc__title">
									<strong>Rezultate calcul tarif:</strong>
									<?=$adults_all?> adulti<?=$children_all > 0 ? ", ".$children."copii" : ""?>,
									plecare in <?=date('d.m.Y', strtotime($date['dep_date']))?>,
									<?=$circuit['nights']?> nopti
								</p>
								<hr class="hr--blue hidden-xs hidden-sm">
								<div class="rez-calc__desktop">
									<div class="row rez-calc__sub hidden-xs">
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-3 tl">
													<strong>Camera</strong>
												</div>
												<div class="col-sm-3">
													<strong>Nr. adulti</strong>
												</div>
												<div class="col-sm-3">
													<strong>Nr. copii</strong>
												</div>
												<div class="col-sm-3">
													<strong>Durata</strong>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-4">
													<strong>Tip masa</strong>
												</div>
												<div class="col-sm-4">
													<strong>Pret</strong>
												</div>
												<div class="col-sm-4">
													<strong>Status</strong>
												</div>
												<!--
												<div class="col-sm-1 hide-print"></div>
												-->
											</div>
										</div>
									</div>
									<hr class="hr--blue">

							<? } ?>

							<div class="row rez-calc__item">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-sm-3">
											<del><?=$_circuit_room_types[$room_info[$k]['type']]['title']?></del>
										</div>
										<div class="col-sm-3">
											<del><?=$adults?></del>
										</div>
										<div class="col-sm-3">
											<del><?=$children?></del>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="alert alert-danger" style="margin:0px;padding:5px;">
										Ne pare rau, dar camera selectata de tine nu mai este disponibila.
									</div>
								</div>
							</div>
							<hr class="hr--blue">

							<? if($k == 0){ ?>
							</div>
							<? }?>

						<?

						}

					}

				}else{

					?>
						<div class="alert alert-danger">
							<? if($rooms > 1){?>
								Ne pare rau, dar camerele selectate de tine nu mai sunt disponibile.
							<? }else{ ?>
								Ne pare rau, dar camera selectata de tine nu mai este disponibila.
							<? }?>
						</div>
					<?

				}
				?>

				<? if($found){?>
					<div class="row">

						<div class="col-sm-9">
							<div class="rez-calc__extra">
								<p>* Pretul camerei single contine supliment camera single.</p>
								<p>* A treia persoana in camera dubla beneficiaza de reducere</p>
							</div>
						</div>
						<div class="col-sm-3">
							<?
							$tmp_hash =
								$_search_id.'-'.
								$_tour_op.'-'.
								$_circuit_id.'-'.
								$_unique_id.'-'.
								$_final_price;
							$hash = md5($tmp_hash);
							?>

							<form action="<?=route('booking-circuit')?>" method="post">
								<input type="hidden" name="id_circuit" value="<?=$date['id_circuit']?>">
								<input type="hidden" name="id_circuit_date_price" value="<?=$date['id_circuit_date_price']?>">
								<input type="hidden" name="search_data" value="<?=htmlentities(json_encode($data))?>">

								<input type="hidden" name="search_id" value="<?=$_search_id?>">
								<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
								<input type="hidden" name="circuit_id" value="<?=$_circuit_id?>">
								<input type="hidden" name="unique_id" value="<?=$_unique_id?>">
								<input type="hidden" name="rooms_solution" value="<?=htmlentities(json_encode($_rooms_solution))?>">
								<input type="hidden" name="room_info" value="<?=$room_txt?>">
								<input type="hidden" name="departure_charter" value="<?=$_departure_charter?>">
								<input type="hidden" name="final_price" value="<?=$_final_price?>">
								<input type="hidden" name="availability" value="<?=$variant['Availability']['attr']['Code']?>">

								<input type="hidden" name="hash" value="<?=$hash?>">

								<button id="item__480__btn" class="btn btn-block btn--green item__info__btn rez_btn_circ">Rezerva</button>
							</form>
						</div>
					</div>
				<? }?>

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
}

// Close the conn
$_db->close();
