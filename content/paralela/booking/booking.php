<main>
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-10 col-lg-offset-1 inline-nav inline-nav--margin">
						<?
						include $_theme_path.'common/steps.php';
						?>
					</div>
				</div>
				<div class="row item--flex2">
					<div class="col-ms-4 col-sm-3 col-ms-push-8 col-sm-push-9 text-right">
						<a class="item__back" href="javascript:history.go(-1);">&lt; Inapoi la cautare</a>
					</div>
					<div class="col-ms-8 col-sm-9 col-ms-pull-4 col-sm-pull-3">
						<h1 class="item__title item__title--rezervare inline-block"><?=$_offer_title?></h1>
						<? if($_params['type'] == "insurance"){?>
							<img src="<?= $_base ?>static/img/city-insurance.jpg">
						<? }?>
					</div>
				</div>
				<div class="row item--flex1 mb-70" >
					<div class="col-md-8 item-rezervare__info">

						<? if($_params['type'] != "insurance"){?>
							<div class="row item--flex2">
								<div class="col-xs-12">
									<div class="item-rezervare__info__border">
										<div class="row">
											<div class="col-ms-5 col-sm-5">
												<img class="img-responsive" src="<?=$_item['images'][0]['thumb']?>" alt="<?=$_item['title']?>">
											</div>
											<div class="col-ms-7 col-sm-7">
												<h2 class="item__title mr-top10"><?=$_item['title']?></h2>
												<? if($_params['type'] == "charter" || $_params['type'] == "tourism"){?>
													<p class="item__sub">
														<?=$_city['title']?>
														<? if($_item['stars'] > 0){?>
															<span>
																<? for($i=1; $i<=$_item['stars']; $i++){?><i class="sprite sprite-star-l"></i><? }?>
															</span>
														<? }?>
													</p>
												<? }?>
												<p class="item__desc"><?=$_item['short_desc']?></p>
												<? if($_params['type'] != "insurance"){?>
													<p class="rez-calc__item__status">
														<strong>Disponibilitate:</strong>
														<? if($_availability == "IM"){?>
															<span class="disponibil">
																Disponibil
																<i class="zmdi zmdi-info" data-toggle="tooltip" data-placement="top" title="Pachetul ales este disponibil si poate fi rezervat imediat"></i>
															</span>
														<? }elseif($_availability == "ST"){?>
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
													</p>
												<? }?>
											</div>
										</div>
									</div>
								</div>
							</div>
						<? }?>

						<div class="item-rezervare__info__detalii item-rezervare__info__border" <? if($_params['type'] == "insurance"){?>style="margin-top:0px" <? }?>>
							<ul class="list-unstyled">
								<? if($_params['type'] != "insurance"){?>
									<li><strong>Cazare:</strong> <?=$_nr_days?> zile / <?=$_nr_nights?> nopti</li>
								<? }?>
								<li><strong>Perioada:</strong> <?=date('d.m.Y', strtotime($_check_in))?> - <?=date('d.m.Y', strtotime($_check_out))?></li>
								<? if($_params['type'] != "insurance"){?>
									<li><strong>Tip camera:</strong> <?=$_room_info?></li>
									<? if($_meal_info != ""){?>
										<li><strong>Masa:</strong> <?=$_meal_info?></li>
									<? }else{ ?>
										<li><strong>Masa:</strong> Conform program</li>
									<? }?>
								<? }?>
								<? if($_params['type'] == "insurance"){?>
									<li><strong>Destinatia:</strong> <?=$_insurance_country['title']?></li>
								<? }?>
								<li><strong>Turisti:</strong> <?=$adults_all?> adulti <?=$children_all > 0 ? " si ".$children_all." ".($children_all > 1 ? "copii" : "copil")." ".$childrens_ages_txt." ani" : ""?></li>
							</ul>

							<? if($_params['type'] == "insurance"){?>

								<ul class="list-unstyled">
									<? foreach($_search_data['insurants'] as $i => $insurant){?>
										<? $_item = $_insurance_offers[$i][$_insurance_selected_items[$i]];?>
										<li><b><?=$insurant['firstname']?> <?=$insurant['lastname']?></b>: <?=$_item['product']['title']?> - <a href="#" class="show-popup-insurance" data-id="<?=$i?>">Vezi detalii »</a></li>
									<? }?>
								</ul>

							<? }?>

							<? if($_params['type'] == "charter"){?>
								<hr>
								<? if($_flight_info){?>
									<ul class="list-unstyled item-rezervare__info__detalii__list item-rezervare__info__detalii__list--sprite">
										<li>
											<strong>Transport:</strong>
										</li>
										<? foreach($_flight_info as $kf => $flight){?>
											<li>
												<? if($kf == 0){?>
													<i class="sprite sprite-arrow-blue-right-l"></i>
													<strong>Dus</strong>
												<? }else{?>
													<i class="sprite sprite-arrow-blue-left-l"></i>
													<strong>Intors</strong>
												<? }?>
												<?=date("d.m.Y", strtotime($flight['from_date']))?> - <?=ucwords(strtolower($flight['company']))?><br>
												<?=date("H:i", strtotime($flight['from_date']))?> <?=$flight['from']?> -
												<?=date("H:i", strtotime($flight['to_date']))?> <?=$flight['to']?>
											</li>
										<? }?>
									</ul>
								<? }elseif($_flight_info_departure && $_flight_info_return){?>
									<ul class="list-unstyled item-rezervare__info__detalii__list item-rezervare__info__detalii__list--sprite">
										<li>
											<strong>Transport:</strong>
											<?=ucwords(strtolower($_flight_info_departure['flight_company']))?>
											<!--<img class="item-rezervare__info__detalii__airline__img" src="http://placehold.it/80x30" alt="...">-->
										</li>
										<li>
											<i class="sprite sprite-arrow-blue-right-l"></i>
											<strong>Dus</strong>
											<?=date("d.m.Y", strtotime($_flight_info_departure['departure_time']))?><br>
											<?=date("H:i", strtotime($_flight_info_departure['departure_time']))?> <?=$_flight_info_departure['departure_city']?> -
											<?=date("H:i", strtotime($_flight_info_departure['arrival_time']))?> <?=$_flight_info_departure['arrival_city']?>
										</li>
										<li>
											<i class="sprite sprite-arrow-blue-left-l"></i>
											<strong>Intors</strong>
											<?=date("d.m.Y", strtotime($_flight_info_return['departure_time']))?><br>
											<?=date("H:i", strtotime($_flight_info_return['departure_time']))?> <?=$_flight_info_return['departure_city']?> -
											<?=date("H:i", strtotime($_flight_info_return['arrival_time']))?> <?=$_flight_info_return['arrival_city']?>
										</li>
									</ul>
								<? }?>
							<? }?>
							<!--
							<? if($_params['type'] == "charter" || ($_params['type'] == "circuit" && $_item['type'] == "plane")){?>
								<hr>
								<p><strong>Transfer aeroport - hotel - aeroport:</strong> inclus</p>
							<? }?>
							-->
							<? if($_params['type'] == "charter" && $_zone['included_services'] != ""){?>
								<hr>
								<p class="text-uppercase"><strong>SERVICII INCLUSE:</strong></p>
								<?=$_zone['included_services']?>
							<? }?>
							<? if($_params['type'] == "circuit" && $_item['included']){?>
								<hr>
								<p class="text-uppercase"><strong>SERVICII INCLUSE:</strong></p>
								<?=$_item['included']?>
							<? }?>
							<!--
							<ul class="list-unstyled item-rezervare__info__detalii__list--sprite">
								<li>Alte servicii incluse:</li>
								<? if($_params['type'] == "charter" || ($_params['type'] == "circuit" && $_item['type'] == "plane")){?>
								<li><i class="sprite sprite-tick"></i> taxe de aeroport</li>
								<? }?>
								<li><i class="sprite sprite-tick"></i> [bagaj de mana]</li>
								<li><i class="sprite sprite-tick"></i> [bagaj de cala] </li>
							</ul>
							-->
						</div>

						<form action="#form" method="post" id="form">
							<? for($i=0; $i<$_search_data['rooms']; $i++){ ?>

								<h4 class="item-rezervare__info__detalii__title">Detalii turisti <?=$_search_data['rooms'] > 1 ? " - Camera ".$_search_data['rooms'] : ""?></h4>

								<? foreach(array('adult', 'child') as $type){?>
									<? if($_search_data['rooms_info'][$i][$type] > 0) {?>
										<? for($j=0; $j<$_search_data['rooms_info'][$i][$type]; $j++){ ?>
											<p class="item-rezervare__info__detalii__sub"><?=$type == "adult" ? "Adult" : "Copil"?> <?=($j+1)?></p>
											<div class="row item-rezervare__info__detalii__item">
												<div class="col-sm-2">
													<div class="form-group"> <!-- has-error -->
														<label class="control-label item-rezervare__info__detalii__label__text" for="<?=$type?>_gender_<?=$i?>_<?=$j?>">Apelativ</label>
														<select class="form-control" id="<?=$type?>_gender_<?=$i?>_<?=$j?>" name="<?=$type?>_gender_<?=$i?>_<?=$j?>">
														  	<option value="">Alege</option>
															<option value="B" <? if($_form[$type.'_gender_'.$i.'_'.$j] == "B"){ echo "selected"; }?>>Dl.</option>
															<option value="F" <? if($_form[$type.'_gender_'.$i.'_'.$j] == "F"){ echo "selected"; }?>>Dna.</option>
														</select>
														<? if($_errors[$type.'_gender_'.$i.'_'.$j] != ""){?>
															<span class="error"><?=$_errors[$type.'_gender_'.$i.'_'.$j]?></span>
														<? }?>
													</div>
												</div>
												<div class="col-ms-6 col-sm-3">
													<div class="form-group"> <!-- has-error -->
														<label class="control-label item-rezervare__info__detalii__label__text" for="<?=$type?>_name_<?=$i?>_<?=$j?>">Nume</label>
														<input type="text" class="form-control" id="<?=$type?>_name_<?=$i?>_<?=$j?>" name="<?=$type?>_name_<?=$i?>_<?=$j?>" aria-describedby="<?=$type?>_name_<?=$i?>_<?=$j?>-help" value="<?=$_form[$type.'_name_'.$i.'_'.$j]?>">
														<span id="<?=$type?>_name_<?=$i?>_<?=$j?>-help" class="help-block hidden">Necesar</span>
														<? if($_errors[$type.'_name_'.$i.'_'.$j] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_name_'.$i.'_'.$j]?></span>
											        	<? }?>
													</div>
												</div>
												<div class="col-ms-6 col-sm-3">
													<div class="form-group"> <!-- has-error -->
														<label class="control-label item-rezervare__info__detalii__label__text" for="<?=$type?>_surname_<?=$i?>_<?=$j?>">Prenume</label>
														<input type="text" class="form-control" id="<?=$type?>_surname_<?=$i?>_<?=$j?>" name="<?=$type?>_surname_<?=$i?>_<?=$j?>" aria-describedby="<?=$type?>_surname_<?=$i?>_<?=$j?>-help" value="<?=$_form[$type.'_surname_'.$i.'_'.$j]?>">
														<span id="<?=$type?>_surname_<?=$i?>_<?=$j?>-help" class="help-block hidden">Necesar</span>
														<? if($_errors[$type.'_surname_'.$i.'_'.$j] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_surname_'.$i.'_'.$j]?></span>
											        	<? }?>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group"> <!-- has-error -->
														<label class="control-label item-rezervare__info__detalii__label__text" for="<?=$type?>_dob_<?=$i?>_<?=$j?>">Data nasterii</label>
														<div class="row">
															<div class="col-md-3 col-sm-4 col-xs-3 db-padd">
																<div class="form-group">
																	  <select class="form-control" id="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_day" name="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_day">
																		  <option value="">Zi</option>
																		  <? for($jk = 1; $jk <= 31; $jk++){?>
																		 	<option value="<?=str_pad($jk, 2, '0', STR_PAD_LEFT)?>" <? if($_form[$type.'_dob_'.$i.'_'.$j.'_dob_day'] == str_pad($jk, 2, '0', STR_PAD_LEFT)){ echo "selected"; }?>><?=$jk?></option>
																		  <? }?>
																	</select>
																</div>
															</div>
															<div class="col-md-5 col-sm-4 col-xs-5 db-padd">
																<div class="form-group">
																	<select class="form-control" id="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_month" name="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_month">
																		<option value="">Luna</option>
																		<? foreach($_months as $month_key => $month_val){?>
																			<option value="<?=str_pad($month_key, 2, '0', STR_PAD_LEFT)?>" <? if($_form[$type.'_dob_'.$i.'_'.$j.'_dob_month'] == str_pad($month_key, 2, '0', STR_PAD_LEFT)){ echo "selected"; }?>><?=$month_val?></option>
																		<? }?>
																	</select>
																</div>
															</div>
															<div class="col-md-4 col-sm-4 col-xs-4 db-padd-right">
																<div class="form-group">
																	<select class="form-control" id="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_year" name="<?=$type?>_dob_<?=$i?>_<?=$j?>_dob_year">
																		<option value="">An</option>
																		<?
																		$year_from = ($type == "child" ? date('Y') : date('Y')-13);
																		$year_to = ($type == "child" ? date('Y')-14 : date('Y')-110);
																		for($jk = $year_from; $jk >= $year_to; $jk--){?>
																			<option value="<?=$jk?>" <? if($_form[$type.'_dob_'.$i.'_'.$j.'_dob_year'] == $jk){ echo "selected"; }?>><?=$jk?></option>
																		<? }?>
																	</select>
																</div>
															</div>
														</div>
											        	<? if($_errors[$type.'_dob_'.$i.'_'.$j.'_dob_day'] != ""){?>
										        			<span class="error"><?=$_errors[$type.'_dob_'.$i.'_'.$j.'_dob_day']?></span>
														<? }elseif($_errors[$type.'_dob_'.$i.'_'.$j.'_dob_month'] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_dob_'.$i.'_'.$j.'_dob_month']?></span>
														<? }elseif($_errors[$type.'_dob_'.$i.'_'.$j.'_dob_year'] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_dob_'.$i.'_'.$j.'_dob_year']?></span>
														<? }elseif($_errors[$type.'_dob_'.$i.'_'.$j] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_dob_'.$i.'_'.$j]?></span>
											        	<? }?>
													</div>
													<? /*
													<div class="form-group">
														<label class="control-label item-rezervare__info__detalii__label__text" for="<?=$type?>_dob_<?=$i?>_<?=$j?>">Data nasterii</label>
														<input type="text" class="form-control dob <?=$type?>" id="<?=$type?>_dob_<?=$i?>_<?=$j?>" name="<?=$type?>_dob_<?=$i?>_<?=$j?>" placeholder="- Alege data -" aria-describedby="<?=$type?>_dob_<?=$i?>_<?=$j?>-help" value="<?=$_form[$type.'_dob_'.$i.'_'.$j]?>">
														<span id="<?=$type?>_dob_<?=$i?>_<?=$j?>-help" class="help-block hidden">Necesar</span>
														<? if($_errors[$type.'_dob_'.$i.'_'.$j] != ""){?>
											        		<span class="error"><?=$_errors[$type.'_dob_'.$i.'_'.$j]?></span>
											        	<? }?>
													</div>
													*/ ?>
												</div>
												<div class="col-xs-12">
													<hr>
												</div>
											</div>
										<? }?>
									<? }?>
								<? }?>

							<? }?>

							<h4 class="item-rezervare__info__detalii__title">Date contact</h4>
							<div class="row">
								<? if($error_insurance_message != ""){?>
									<div class="col-sm-12">
										<span class="error"><?=$error_insurance_message?></span><br><br>
									</div>
								<? }?>

								<div class="col-ms-6 col-sm-5">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="email">Email</label>
										<input type="email" class="form-control" id="email" name="email" value="<?=$_form['email']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['email'] != ""){?>
							        		<span class="error"><?=$_errors['email']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 col-sm-offset-1">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="phone">Telefon</label>
										<input type="number" class="form-control" id="phone" name="phone" value="<?=$_form['phone']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['phone'] != ""){?>
							        		<span class="error"><?=$_errors['phone']?></span>
							        	<? }?>
									</div>
								</div>
								<? if(!is_logged_in()){?>
									<div class="col-xs-12">
										<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color">
											<input id="account" name="account" value="1" type="checkbox" <? if($_form['account'] == "1") echo "checked"?>>
											<label for="account">Da, vreau cont pe site</label>
										</div>
									</div>
								<? }?>
							</div>

							<? if($_params['type'] == "insurance"){?>
								<input id="pay_amount_full" name="pay_amount" value="full" type="hidden">
								<input id="pay_currency_ron" name="pay_currency" value="ron" type="hidden">
							<? }else{ ?>
								<h4 class="item-rezervare__info__detalii__title">Variante de plata</h4>
								<div class="row">
									<div class="col-ms-6 col-sm-4">
										<div class="checkbox item-rezervare__info__detalii__checkbox">
											<input id="pay_amount_full" name="pay_amount" value="full" type="radio" <? if($_form['pay_amount'] == "full" || !isset($_POST['book_now'])) echo "checked"?>>
											<label for="pay_amount_full">
												Plata integrala<br> <span class="total_eur"><?=$_final_price?></span><?=$_final_currency_symbol?>
												<? if($_country_code != "RO"){?>
													(<span class="total_ron"><?=$_final_price_ron?></span> Lei)
												<? }?>
											</label>
										</div>
										<? if($_errors['pay_amount'] != ""){?>
							        		<span class="error"><?=$_errors['pay_amount']?></span>
							        	<? }?>
									</div>
									<? if($_advance_price > 0 && $_advance_price < $_final_price){?>
										<div class="col-ms-6 col-sm-4">
											<div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="pay_amount_advance" name="pay_amount" value="advance" type="radio" <? if($_form['pay_amount'] == "advance") echo "checked"?>>
												<label for="pay_amount_advance">
													Plata avans (<span id="advance_percent"><?=$_advance_percent?></span>%)<br>
													<span class="advance_eur"><?=$_advance_price?></span><?=$_final_currency_symbol?>
													<? if($_country_code != "RO"){?>
														(<span class="advance_ron"><?=$_advance_price_ron?></span> Lei)
													<? }?>
												</label>
											</div>
										</div>
									<? }?>
									<? /*
									<div class="col-sm-4">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Foloseste un voucher">
											<span class="help-block hidden">Gresit</span>
										</div>
									</div>
									*/ ?>
								</div>
								<? if($_country_code == "RO"){?>
									<div class="hidden">
										<input id="pay_currency_ron" name="pay_currency" value="ron" type="radio" checked>
										<input id="pay_currency_eur" name="pay_currency" value="eur" type="radio">
									</div>
								<? }else{?>
									<div class="row">
										<div class="col-ms-4 col-sm-3">
											Moneda tranzactionarii
										</div>
										<div class="col-ms-2 col-sm-1">
											<div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="pay_currency_ron" name="pay_currency" value="ron" type="radio" <? if($_form['pay_currency'] == "ron" || !isset($_POST['book_now'])) echo "checked"?>>
												<label for="pay_currency_ron">LEI</label>
												<? if($_errors['pay_currency'] != ""){?>
									        		<span class="error"><?=$_errors['pay_currency']?></span>
									        	<? }?>
											</div>
										</div>
										<div class="col-ms-2 col-sm-1">
											<div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="pay_currency_eur" name="pay_currency" value="eur" type="radio" <? if($_form['pay_currency'] == "eur") echo "checked"?>>
												<label for="pay_currency_eur">EUR</label>
											</div>
										</div>
									</div>
								<? }?>
							<? }?>

							<? if($_installments){?>
								<div id="scadente" class="<? if($_form['pay_amount'] == "full" || !isset($_POST['book_now'])) echo "hidden"?>">
									<h4 class="item-rezervare__info__detalii__title">Scadente</h4>
									<ul class="list-unstyled">
										<? $k = 1; foreach($_installments as $date => $percent){?>
											<li>
												• <?=$percent?>%
												<? if($k == 1){?>
													avans
												<? }else{ ?>
													pana la <?=date('d.m.Y', strtotime($date))?>
												<? }?>
											</li>
										<? $k++;}?>
									</ul>
								</div>
							<? }?>

							<? if($_params['type'] != "insurance"){?>
								<h4 class="item-rezervare__info__detalii__title">Cod promo</h4>
								<div class="row">
									<div class="col-xs-12">
										<div class="checkbox item-rezervare__info__detalii__checkbox">
											<input id="have_voucher" name="have_voucher" value="1" type="checkbox" <? if($_form['have_voucher'] == 1) echo "checked"?>>
											<label for="have_voucher" class="text-uppercase">Am un cod promo</label>
										</div>
									</div>
								</div>

								<div class="row voucher-booking <? if($_form['have_voucher'] != 1) echo "hidden"?>">
									<div class="col-ms-6 col-sm-5 margin--bottom-25">
										<div class="form-group"> <!-- has-error -->
											<input type="text" class="form-control" id="voucher" name="voucher" value="<?=$_form['voucher']?>">
							        		<span class="error"><?=$_errors['voucher']?></span>
										</div>
									</div>
									<div class="col-ms-6 col-sm-5">
										<button class="btn btn--green" style="color:#fff;" id="apply_voucher" name="apply_voucher" type="button">
											<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
											<span>Aplica</span>
										</button>
									</div>
								</div>
							<? }?>

							<h4 class="item-rezervare__info__detalii__title">Date facturare</h4>
							<div class="row">
								<div class="col-ms-6 col-sm-5">
									<div class="checkbox item-rezervare__info__detalii__checkbox">
										<input id="invoice_type_pf" name="invoice_type" value="pf" type="radio" <? if($_form['invoice_type'] == "pf" || !isset($_POST['book_now'])) echo "checked"?>>
										<label for="invoice_type_pf">FACTURA PERSOANA FIZICA</label>
									</div>
									<? if($_errors['invoice_type'] != ""){?>
						        		<span class="error"><?=$_errors['invoice_type']?></span>
						        	<? }?>
								</div>
								<div class="clearfix"></div>
								<div class="col-ms-6 col-sm-5">
									<div class="checkbox item-rezervare__info__detalii__checkbox">
										<input id="invoice_type_pj" name="invoice_type" value="pj" type="radio" <? if($_form['invoice_type'] == "pj") echo "checked"?>>
										<label for="invoice_type_pj">FACTURA PERSOANA JURIDICA</label>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-ms-6 col-sm-5">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_name">Nume</label>
										<input type="text" class="form-control" id="invoice_name" name="invoice_name" value="<?=$_form['invoice_name']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_name'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_name']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 col-sm-offset-1">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_surname">Prenume</label>
										<input type="text" class="form-control" id="invoice_surname" name="invoice_surname" value="<?=$_form['invoice_surname']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_surname'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_surname']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_address">Adresa facturare</label>
										<input type="text" class="form-control" id="invoice_address" name="invoice_address" value="<?=$_form['invoice_address']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_address'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_address']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 col-sm-offset-1">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_country">Tara</label>
										<input type="text" class="form-control" id="invoice_country" name="invoice_country" value="<?=$_form['invoice_country']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_country'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_country']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_city">Oras</label>
										<input type="text" class="form-control" id="invoice_city" name="invoice_city" value="<?=$_form['invoice_city']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_city'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_city']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 col-sm-offset-1">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_county">Judet/Sector</label>
										<input type="text" class="form-control" id="invoice_county" name="invoice_county" value="<?=$_form['invoice_county']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_county'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_county']?></span>
							        	<? }?>
									</div>
								</div>
								<? /*
								<div class="col-ms-6 col-sm-5 f-persoana <? if($_form['invoice_type'] == "pj") echo "hidden"?>">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_cnp">CNP</label>
										<input type="number" class="form-control" id="invoice_cnp" name="invoice_cnp" value="<?=$_form['invoice_cnp']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_cnp'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_cnp']?></span>
							        	<? }?>
									</div>
								</div>
								*/ ?>
								<div class="col-ms-6 col-sm-5 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_POST['book_now'])) echo "hidden"?>">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_company">Companie</label>
										<input type="text" class="form-control" id="invoice_company" name="invoice_company" value="<?=$_form['invoice_company']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_company'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_company']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 col-sm-offset-1 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_POST['book_now'])) echo "hidden"?>">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_cui">CUI</label>
										<input type="text" class="form-control" id="invoice_cui" name="invoice_cui" value="<?=$_form['invoice_cui']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_cui'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_cui']?></span>
							        	<? }?>
									</div>
								</div>
								<div class="col-ms-6 col-sm-5 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_POST['book_now'])) echo "hidden"?>">
									<div class="form-group"> <!-- has-error -->
										<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_nr_reg">Numar Registrul Comertului</label>
										<input type="text" class="form-control" id="invoice_nr_reg" name="invoice_nr_reg" value="<?=$_form['invoice_nr_reg']?>">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['invoice_nr_reg'] != ""){?>
							        		<span class="error"><?=$_errors['invoice_nr_reg']?></span>
							        	<? }?>
									</div>
								</div>
								<? if(is_logged_in()){?>
									<div class="col-xs-12">
										<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color">
											<input id="save_to_account" name="save_to_account" value="1" type="checkbox" <? if($_form['save_to_account'] == "1") echo "checked"?>>
											<label for="save_to_account">Salveaza datele in contul meu</label>
										</div>
									</div>
								<? }?>
							</div>

							<h4 class="item-rezervare__info__detalii__title">Metode de plata</h4>
							<ul class="list-unstyled">
								<li>
									<div class="row">
										<div class="col-ms-6 col-sm-6">
											<div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="payment_euplatesc" name="payment" value="euplatesc" type="radio" <? if($_form['payment'] == "euplatesc" || !isset($_POST['book_now'])) echo "checked"?>>
												<label for="payment_euplatesc" class="text-uppercase">Card bancar online</label>
											</div>
										</div>
										<div class="col-ms-6 col-sm-6">
											<img class="img-responsive" src="<?=$_base?>static/img/payment.png" alt="...">
										</div>
									</div>
									<hr>
								</li>

								<? if($_params['type'] != "insurance"){?>
									<li class="payment-rate <? if($_form['pay_currency'] == "eur") echo "hidden"?>">
										<div class="row">

											<div class="col-sm-4 ">
												<div class="checkbox item-rezervare__info__detalii__checkbox">
													<input id="payment_in_rate" name="payment" value="rate" type="radio" <? if($_form['payment'] == "rate") echo "checked"?>>
													<label for="payment_in_rate" class="text-uppercase">CARD BANCAR - IN RATE</label>
												</div>
											</div>

											<div class="col-sm-6 payment_in_rate_banci">
												<select id="payment_in_rate_banci" name="payment_bank">
													<option value="">Alege card</option>
													<? foreach($_payment_methods as $method){?>
														<?
														$installments = explode(',', $method['installments']);
														rsort($installments);
														?>
														<option value="<?=$method['key']?>" <? if($_form['payment_bank'] == $method['key']) echo "selected"?>><?=$method['title'] . " (" . $method['installments'] .  " rate)" ?></option>
													<? }?>
												</select>
												<? if($_errors['payment_bank'] != ""){?>
									        		<span class="error"><?=$_errors['payment_bank']?></span>
									        	<? }?>
											</div>
											<!--
											<div class="col-ms-4 col-sm-4">
												<div class="checkbox item-rezervare__info__detalii__checkbox">
													<input id="payment_<?=$method['key']?>" name="payment" value="<?=$method['key']?>" type="radio" <? if($_form['payment'] == $method['key']) echo "checked"?>>
													<label for="payment_<?=$method['key']?>" class="text-uppercase"><?=$method['title']?></label>
												</div>
											</div>
											<div class="col-ms-2 col-sm-2">
												<label class="item-rezervare__info__detalii__label">
													<span class="item-rezervare__info__detalii__label__text">Numar rate</span>
													<select class="select__s2" id="installments_<?=$method['key']?>" name="installments_<?=$method['key']?>" style="width: 100%;">
														<? foreach($installments as $val){?>
															<option value="<?=$val?>" <? if($_form['installments_'.$method['key']] == $val) echo "selected"?>><?=$val?></option>
														<? }?>
													</select>
												</label>
											</div>
											<? if($method['logo'] != ""){?>
												<div class="col-ms-6 col-sm-6">
													<img class="img-responsive" src="<?=$_base_uploads?>images/<?=$method['logo_path'].'small-'.$method['logo']?>" alt="<?=$method['title']?>">
												</div>
											<? }?>
											-->
										</div>
										<hr>
									</li>
								<? }?>

								<li>
									<div class="checkbox item-rezervare__info__detalii__checkbox">
										<input id="payment_op" name="payment" value="op" type="radio" <? if($_form['payment'] == "op") echo "checked"?>>
										<label for="payment_op" class="text-uppercase">Transfer bancar</label>
									</div>
									<!--
									<p class="item-rezervare__info__detalii__transfer__text">Detalii pentru efectuarea platii:</p>
									<p class="item-rezervare__info__detalii__transfer__text">S.C.<br>
										Adresa:<br>
									</p>
									-->
									<hr>
								</li>

								<? if($_show_payment_voucher){?>
									<li>
										<div class="checkbox item-rezervare__info__detalii__checkbox">
											<input id="payment_voucher" name="payment" value="voucher" type="radio" <? if($_form['payment'] == "voucher") echo "checked"?>>
											<label for="payment_voucher" class="text-uppercase">Vouchere de vacanta</label>
										</div>
										<hr>
									</li>
								<? }?>

								<li>
									<div class="checkbox item-rezervare__info__detalii__checkbox">
										<input id="payment_cash" name="payment" value="cash" type="radio" <? if($_form['payment'] == "cash") echo "checked"?>>
										<label for="payment_cash" class="text-uppercase">Cash in agentiile Paralela 45</label>
									</div>
								</li>
							</ul>

							<h4 class="item-rezervare__info__detalii__title">Ai o agentie preferata?</h4>
							<div class="row">
								<div class="col-ms-6 col-sm-3">
									<label class="item-rezervare__info__detalii__label">
										<span class="item-rezervare__info__detalii__label__text">Oras</span>
										<select id="select_agencies" name="agency_city" data-placeholder="Alege orasul" style="width: 100%;">
											<option value=""></option>
											<? foreach($_agencies_city as $city){?>
												<option value="<?=$city['id_city']?>" <? if($_form['agency_city'] == $city['id_city'] || (!isset($_form) && $city['id_city'] == 21749)) echo "selected"?>><?=$city['title']?></option>
											<? }?>
										</select>
										<? if($_errors['agency_city'] != ""){?>
											<span class="error"><?=$_errors['agency_city']?></span>
										<? }?>
									</label>
								</div>
								<div class="col-ms-6 col-sm-3">
									<label class="item-rezervare__info__detalii__label">
										<span class="item-rezervare__info__detalii__label__text">Agentia</span>
										<select id="id_agency" name="id_agency" class="select__s2" data-placeholder="Alege agentia" style="width: 100%;">
											<option value=""></option>
											<? foreach($_agencies as $agency){?>
												<option value="<?=$agency['id_agency']?>" <? if($_form['id_agency'] == $agency['id_agency']  || (!isset($_form) && $agency['id_agency'] == 56)) echo "selected"?>><?=$agency['title']?></option>
											<? }?>
										</select>
										<? if($_errors['id_agency'] != ""){?>
											<span class="error"><?=$_errors['id_agency']?></span>
										<? }?>
									</label>
								</div>
								<div class="col-ms-6 col-sm-3">
									<label class="item-rezervare__info__detalii__label">
										<span class="item-rezervare__info__detalii__label__text">Agent</span>
										<input type="text" class="form-control" id="agent" name="agent" value="<?=$_form['agent']?>" style="margin-top: 4px;">
									</label>
								</div>
							</div>
							<br>

							<? if(debug_mode()){ ?>
							<? if($_params['type'] != "insurance"){?>
								<h4 class="item-rezervare__info__detalii__title">Asigurare de calatorie</h4>
								<div class="row">
									<div class="col-xs-12">
										<div class="checkbox item-rezervare__info__detalii__checkbox">
											<input id="want_insurance" name="" value="" type="checkbox">
											<label for="want_insurance" class="text-uppercase">Vreau asigurare de calatorie</label>
										</div>
									</div>
								</div>

								<div class="row insurance-booking hidden">
									<div class="col-xs-12 margin--bottom-25">
										<div class="checkbox bilete-rezervare__checkbox">
											<input id="checbox1" type="checkbox" value="1" name="">
											<label for="checbox1">
												Turist(medicala) <span class="text--blue pull-right"><b>80</b> Lei</span>
											</label>
							            </div>
							            <div class="description">
							            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis luctus enim non tempor bibendum. Morbi vestibulum pretium sollicitudin. </p>
							            	<a href="#">Vezi detalii »</a><br/>
							            	<a href="#">Vezi termeni si conditii »</a>
							            </div>
									</div>

									<div class="col-xs-12 margin--bottom-25">
										<div class="checkbox bilete-rezervare__checkbox">
											<input id="checbox2" type="checkbox" value="1" name="">
											<label for="checbox2">
												Turist plus premium(medicala si storno) <span class="text--blue pull-right"><b>120</b> Lei</span>
											</label>
							            </div>
							            <div class="description">
							            	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis luctus enim non tempor bibendum. Morbi vestibulum pretium sollicitudin. </p>
							            	<a href="#">Vezi detalii »</a><br/>
							            	<a href="#">Vezi termeni si conditii »</a>
							            </div>
									</div>
								</div>
							<? } ?>
							<? } ?>

							<h4 class="item-rezervare__info__detalii__title">Observatii</h4>
							<textarea class="form-control" name="obs" rows="5" placeholder="Alte detalii"><?=$_form['obs']?></textarea>

							<p><em>* Datele tale sunt sigure si criptate. S.C. PARALELA 45 TURISM SRL este inregistrata ca operator de	date cu caracter personal nr. 8176 si cu nr. 7718</em></p>
							<div class="row">
								<div class="col-ms-6 col-md-7">
									<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color item-rezervare__info__detalii__checkbox--size">
										<input id="terms" name="terms" value="1" type="checkbox" <? if($_form['terms'] == "1") echo "checked"?>>
										<label for="terms">
											Am citit si sunt de acord cu <a href="<?=route('terms')?>" target="_blank"><u>termenii si conditiile</u></a>,
											<a href="<?=route('tourist-contract')?>" id="contract-pf-link" style="display:<?=$_form['invoice_type'] == 'pf' || $_form['invoice_type'] == '' ? '' : 'none'?>" target="_blank"><u>contractul de servicii de calatorie</u></a>
											<a href="<?=route('tourist-contract-pj')?>" id="contract-pj-link" style="display:<?=$_form['invoice_type'] == 'pj' ? '' : 'none'?>" target="_blank"><u>contractul de servicii de calatorie</u></a>
											si <a href="<?=route('privacy')?>" target="_blank"><u>politica de confidentialitate</u></a> a operatorului.
										</label>
										<? if($_errors['terms'] != ""){?>
							        		<span class="error clearfix"><?=$_errors['terms']?><br></span>
							        	<? }?>
									</div>
									<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color item-rezervare__info__detalii__checkbox--size">
										<input id="newsletter" name="newsletter" value="1" type="checkbox" <? if($_form['newsletter'] == "1") echo "checked"?>>
										<label for="newsletter">Vreau sa aflu primul cele mai noi oferte din newsletterul Paralela 45.</label>
										<? if($_errors['newsletter'] != ""){?>
							        		<span class="error clearfix"><?=$_errors['newsletter']?><br></span>
							        	<? }?>
									</div>
									<? /*
									<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color item-rezervare__info__detalii__checkbox--size">
										<input id="terms" name="terms" value="1" type="checkbox" <? if($_form['terms'] == "1") echo "checked"?>>
										<label for="terms">Am citit si sunt de acord cu <a href="<?=route('terms')?>" target="_blank">Termeni si Conditii</a></label>
										<? if($_errors['terms'] != ""){?>
							        		<span class="error clearfix"><?=$_errors['terms']?><br></span>
							        	<? }?>
									</div>
									<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color item-rezervare__info__detalii__checkbox--size">
										<input id="contract" name="contract" value="1" type="checkbox" <? if($_form['contract'] == "1") echo "checked"?>>
										<label for="contract">
											Am citit si sunt de acord cu
											<a href="<?=route('tourist-contract')?>" id="contract-pf-link" style="display:<?=$_form['invoice_type'] == 'pf' || $_form['invoice_type'] == '' ? '' : 'none'?>" target="_blank">Contractul cu turistul</a>
											<a href="<?=route('tourist-contract-pj')?>" id="contract-pj-link" style="display:<?=$_form['invoice_type'] == 'pj' ? '' : 'none'?>" target="_blank">Contractul cu turistul PJ</a>
										</label>
										<? if($_errors['contract'] != ""){?>
							        		<span class="error clearfix"><?=$_errors['contract']?><br></span>
							        	<? }?>
									</div>
									<div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color item-rezervare__info__detalii__checkbox--size">
										<input id="gdpr" name="gdpr" value="1" type="checkbox" <? if($_form['gdpr'] == "1") echo "checked"?>>
										<label for="gdpr">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
										<? if($_errors['gdpr'] != ""){?>
							        		<span class="error clearfix"><?=$_errors['gdpr']?><br></span>
							        	<? }?>
									</div>
									*/ ?>
								</div>
								<div class="col-ms-6 col-md-5">
									<button class="btn btn--green item-rezervare__info__detalii__btn" id="book" name="book" type="submit">
										<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
										<span>Rezerva</span>
									</button>
									<input type="hidden" name="book_now" value="1">
								</div>
							</div>

							<input type="hidden" name="search_data" value="<?=htmlentities(json_encode($_search_data))?>">

							<? if($_params['type'] == "circuit"){?>

								<input type="hidden" name="id_circuit" value="<?=$_id_circuit?>">
								<input type="hidden" name="id_circuit_date_price" value="<?=$_id_circuit_date_price?>">

								<input type="hidden" name="search_id" value="<?=$_search_id?>">
								<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
								<input type="hidden" name="circuit_id" value="<?=$_circuit_id?>">
								<input type="hidden" name="unique_id" value="<?=$_unique_id?>">
								<input type="hidden" name="departure_charter" value="<?=$_departure_charter?>">

							<? }?>

							<? if($_params['type'] == "charter"){?>

								<input type="hidden" name="id_hotel" value="<?=$_id_hotel?>">
								<input type="hidden" name="id_city_from" value="<?=$_id_city_from?>">

								<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
								<input type="hidden" name="country_code" value="<?=$_country_code?>">
								<input type="hidden" name="city_code" value="<?=$_city_code?>">
								<input type="hidden" name="hotel_code" value="<?=$_hotel_code?>">

								<input type="hidden" name="variant_id" value="<?=$_variant_id?>">
								<input type="hidden" name="package_id" value="<?=$_package_id?>">

								<input type="hidden" name="services_info" value="<?=htmlentities(json_encode($_services_info))?>">
								<input type="hidden" name="flight_info" value="<?=htmlentities(json_encode($_flight_info))?>">

							<? }?>

							<? if($_params['type'] == "tourism"){?>

								<input type="hidden" name="id_hotel" value="<?=$_id_hotel?>">

								<input type="hidden" name="tour_op" value="<?=$_tour_op?>">
								<input type="hidden" name="country_code" value="<?=$_country_code?>">
								<input type="hidden" name="city_code" value="<?=$_city_code?>">
								<input type="hidden" name="hotel_code" value="<?=$_hotel_code?>">

								<input type="hidden" name="variant_id" value="<?=$_variant_id?>">

							<? }?>

							<input type="hidden" name="check_in" value="<?=$_check_in?>">
							<input type="hidden" name="check_out" value="<?=$_check_out?>">
							<input type="hidden" name="rooms_solution" value="<?=htmlentities(json_encode($_rooms_solution))?>">
							<input type="hidden" name="room_info" value="<?=$_room_info?>">
							<input type="hidden" name="meal_info" value="<?=$_meal_info?>">

							<input type="hidden" name="final_price" value="<?=$_final_price?>">
							<input type="hidden" name="advance_price" value="<?=$_advance_price?>">
							<input type="hidden" name="old_price" value="<?=$_old_price?>">

							<input type="hidden" name="final_price_ron" value="<?=$_final_price_ron?>">
							<input type="hidden" name="advance_price_ron" value="<?=$_advance_price_ron?>">
							<input type="hidden" name="old_price_ron" value="<?=$_old_price_ron?>">

							<input type="hidden" name="final_price_original" value="<?=$_final_price?>">
							<input type="hidden" name="advance_price_original" value="<?=$_advance_price?>">

							<input type="hidden" name="final_price_ron_original" value="<?=$_final_price_ron?>">
							<input type="hidden" name="advance_price_ron_original" value="<?=$_advance_price_ron?>">

							<input type="hidden" name="availability" value="<?=$_availability?>">

							<input type="hidden" name="currency" value="<?=$_currency?>">

							<input type="hidden" name="hash" value="<?=$_POST['hash']?>">
						</form>
					</div>
					<div class="col-md-4">
						<div id="sticky_item">
							<div class="item-rezervare">
								<h3 class="item-rezervare__title">Rezervarea ta</h3>
								<ul class="list-unstyled item-rezervare__list">
									<li><strong><?=$_side_title?></strong> <strong class="pull-right"><?=$_old_price > 0 ? $_old_price : $_final_price?><?=$_final_currency_symbol?></strong></li>
									<? if($_params['type'] == "charter" || ($_params['type'] == "circuit" && $_item['type'] == "plane")){?>
										<li><?=($adults_all+$children_all)?> Bilete de avion dus/intors</li>
									<? }?>
									<? if($_params['type'] == "circuit" && $_item['type'] == "plane"){?>
										<li>Transport autocar</li>
									<? }?>
									<li><?=$_room_info?></li>
									<? if($_params['type'] != "insurance"){?>
										<? if($_meal_info != ""){?>
											<li><?=$_meal_info?></li>
										<? }else{ ?>
											<li>Mese: Conform program</li>
										<? }?>
									<? }?>
									<li>
										<?=($adults_all+$children_all)?> turisti
										(<?=$adults_all?> adulti
										<?=$children_all > 0 ? " si ".$children_all." ".($children_all > 1 ? "copii" : "copil")." ".$childrens_ages_txt." ani" : ""?>)
									</li>
									<? if($_params['type'] == "charter" || ($_params['type'] == "circuit" && $_item['type'] == "plane")){?>
										<li>Taxe de aeroport</li>
									<? }?>
									<? if($_params['type'] != "insurance"){?>
										<li class="rez-calc__item__status">
											<strong>Disponibilitate:</strong>
											<? if($_availability == "IM"){?>
												<span class="disponibil">
													Disponibil
													<i class="zmdi zmdi-info" data-toggle="tooltip" data-placement="top" title="Pachetul ales este disponibil si poate fi rezervat imediat"></i>
												</span>
											<? }elseif($_availability == "ST"){?>
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
										</li>
									<? }?>
								</ul>
								<hr>
								<ul class="list-unstyled item-rezervare__list">
									<? if($_old_price > 0){?>
										<li>Reducere <span class="pull-right">- <?=($_old_price - $_final_price)?><?=$_final_currency_symbol?></span></li>
									<? }?>
									<li id="discount_voucher" class="hidden">Discount cod promo <span class="pull-right">- <span class="discount"></span><?=$_final_currency_symbol?></span></li>
									<li class="total">Total <span class="pull-right"><span class="total_eur"><?=$_final_price?></span><?=$_final_currency_symbol?></span></li>
								</ul>
							</div>
							<? if($_final_currency == "EUR"){?>
								<div class="item-rezervare item-rezervare__cursv">
									<ul class="list-unstyled item-rezervare__list">
										<li>CURS VALUTAR UNICREDIT BANK</li>
										<li><?=date('d.m.Y')?></li>
										<li>1 EUR = <span id="currency"><?=$_currency?></span> Lei </li>
										<li><span class="total_eur"><?=$_final_price?></span> EUR = <span class="total_ron"><?=$_final_price_ron?></span> Lei</li>
									</ul>
								</div>
							<? }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<? if($_params['type'] == "insurance"){?>
	<? foreach($_search_data['insurants'] as $i => $insurant){?>
		<? $_item = $_insurance_offers[$i][$_insurance_selected_items[$i]];?>
		<div class="black-cover hidden" id="popup-info-insurance<?=$i?>">
			<div class="popup-white">
				<a href="#" class="close-popup"><i class="zmdi zmdi-close"></i></a>
				<h4><?=$_item['product']['title']?></h4>
				<div class="table-wrapper">
					<?=$_item['product']['description']?>
				</div>
			</div>
		</div>
	<? }?>
<? }?>

<script>
$(document).ready(function(){
	$('#form').submit(function() {
		var $this = $('#book');
	    $this.find('span').addClass('hidden');
	    $this.find('i').removeClass('hidden');
	    $this.prop('disabled', true);
	});

	$('.show-popup-insurance').click(function(e){
		e.preventDefault();
		id = $(this).attr('data-id');
		$('#popup-info-insurance'+id).removeClass('hidden');
		$('#popup-info-insurance'+id).find('.close-popup').click(function(ev){
			ev.preventDefault();
			$('#popup-info-insurance'+id).addClass('hidden');
		});
	});

	$('#apply_voucher').click(function(){
		$this = $(this);
		$voucher = $('#voucher').val();
		$error_field = $this.parent().parent().find('span.error');
		$('#discount_voucher').addClass('hidden');

		$error_field.html('');
		$this.find('.zmdi-spinner').removeClass('hidden');

		$.ajax({
			url: $_base + 'ajax/cart/voucher.php',
			data: {voucher: $voucher},
			dataType: 'json',
			success: function(data) {
				$this.find('.zmdi-spinner').addClass('hidden');

				$total_eur = parseFloat($('input[name="final_price_original"]').val());
				$total_ron = parseFloat($('input[name="final_price_ron_original"]').val());
				$advance_percent = parseFloat($('#advance_percent').html());
				$currency = parseFloat($('#currency').html());

				if(data.status == 'error') {
					$error_field.html(data.message);

					$final_eur = $total_eur;
					$final_ron = $final_eur*$currency;

					$advance_eur = $final_eur*$advance_percent/100;
					$advance_ron = $advance_eur*$currency;
				}else if(data.status == 'success') {
					$('#discount_voucher').find('span.discount').html(data.discount);
					$('#discount_voucher').removeClass('hidden');

					$final_eur = $total_eur-data.discount;
					$final_ron = $final_eur*$currency;

					$advance_eur = $final_eur*$advance_percent/100;
					$advance_ron = $advance_eur*$currency;
				}

				$('.total_eur').html($final_eur.toFixed(2));
				$('.total_ron').html($final_ron.toFixed(2));

				$('.advance_eur').html($advance_eur.toFixed(2));
				$('.advance_ron').html($advance_ron.toFixed(2));
			}
		});
	});

	if($('#apply_voucher').length){
		if($('#voucher').val() != ""){
			$('#apply_voucher').trigger('click');
		}
	}

	dataLayer.push({
		'event': 'checkout',
	    'ecommerce': {
			"currencyCode": "<?=$_final_currency?>",
	      	'checkout': {
	        	'actionField': {'step': 1},
	        	'products': [{
					<? if($_params['type'] == "circuit"){?>
		          		'id': '<?=$_id_circuit?>',
						'category': 'Circuite',
						'brand': '<?=implode(", ", $_item['countries_txt'])?>',
					<? }?>
					<? if($_params['type'] == "charter"){?>
						'id': '<?=$_id_hotel?>',
						'brand': '<?=$_city['title']?>',
						'category': 'Chartere',
					<? }?>
					<? if($_params['type'] == "tourism"){?>
						'id': '<?=$_id_hotel?>',
						'brand': '<?=$_city['title']?>',
		          		'category': '<?=$_city['id_country'] == 126 ? "Turism intern" : "Sejururi"?>',
					<? }?>
					<? if($_params['type'] == "insurance"){?>
						'id': 'insurance',
						'brand': 'Asigurari',
		          		'category': 'Asigurari',
					<? }?>
	          		'name': '<?=$_item['title']?>',
	          		'price': '<?=$_final_price?>',
	          		'quantity': 1
	       		}]
	    	}
		}
	});

	gtag('event', 'page_view', {
		'send_to': 'AW-1009319514',
		<? if($_params['type'] == "circuit"){?>
			'dynx_itemid': 'CI<?=$_id_circuit?>',
		<? }?>
		<? if($_params['type'] == "charter"){?>
			'dynx_itemid': 'CH<?=$_id_hotel?>',
		<? }?>
		<? if($_params['type'] == "tourism"){?>
			'dynx_itemid': 'SJ<?=$_id_hotel?>',
		<? }?>
		<? if($_params['type'] == "insurance"){?>
			'dynx_itemid': 'insurance',
		<? }?>
		'dynx_itemid2': '',
		'dynx_pagetype': 'conversionintent',
		'dynx_totalvalue': '<?=$_final_price?>'
	});

	<? if($_params['type'] != "insurance"){?>
		gtag('event', 'add_to_cart', {
			'send_to': 'AW-1009319514',
			'items': [{
				<? if($_params['type'] == "circuit"){?>
	  				'destination': 'CI<?=$_id_circuit?>',
				<? }?>
				<? if($_params['type'] == "charter"){?>
					'origin': '<?=$_id_city_from?>',
					'destination': 'CH<?=$_id_hotel?>',
				<? }?>
				<? if($_params['type'] == "tourism"){?>
					'destination': 'SJ<?=$_id_hotel?>',
				<? }?>
	  			'google_business_vertical': '<?=$_params['type'] == "tourism" ? "hotel_rental" : "travel"?>'
	    	}]
		});
	<? }?>

	fbq('track', 'InitiateCheckout', {
		value: <?=$_final_price?>,
		currency: '<?=$_final_currency?>',
		content_type: 'product',
		<? if($_params['type'] == "circuit"){?>
			content_ids: 'CI<?=$_id_circuit?>',
		<? }?>
		<? if($_params['type'] == "charter"){?>
			content_ids: 'CH<?=$_id_hotel?>-<?=$_id_city_from?>',
		<? }?>
		<? if($_params['type'] == "tourism"){?>
			content_ids: 'SJ<?=$_id_hotel?>',
		<? }?>
		<? if($_params['type'] == "insurance"){?>
			content_ids: 'insurance',
		<? }?>
	});

});
</script>
