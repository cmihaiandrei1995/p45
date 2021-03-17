<main>
	<?/* <div class="container-fluid inner-banner">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<? if($_header_img != ""){?>
						<img class="img-banner__img object-fit" src="<?=$_header_img?>" alt="<?=$_title?>">
					<? }?>
				</div>
				<div class="row">
					<div class="container">
						<div class="row">
							<?php //include $_theme_path.'common/forms/home_forms.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> */?>
	<div class="container-fluid">
		<div class="row">
			<div class="container mt-25">

				<?/*
				<?
				$_step = 2;
				$_step_type = "Circuit";
				include $_theme_path.'common/steps.php';
				?>
				*/?>

				<div class="row">
					<div class="col-xs-12 text-right">
						<a class="item__back" href="javascript:history.go(-1);">&lt; Inapoi la cautare</a>
					</div>
				</div>

				<div class="row item__info__wrapper">
					<div class="col-md-9">
						<div class="row item--flex2">
							<div class="col-xs-12">
								<h1 class="item__title">
									<?=$_item['title']?>
								</h1>
								<p class="item__sub">
									<span>
										<i class="sprite sprite-plane-light-blue"></i> <strong>Plecari: </strong>
										<?=implode(', ', $_item['dates'])?>
									</span>
									<span>
										<i class="sprite sprite-duration-light-blue"></i> <strong>Durata: </strong>
										<? if($_item['categories_txt']){?>
											<?=implode(", ", $_item['categories_txt'])?>
										<? }?>
										<?=$_item['days']?> zile / <?=$_item['nights']?> nopti
									</span>
									<!-- harta locatie -->
									<? if($_item['map_image']){?>
										<a href="<?=$_item['map_big']?>?&iframe=true&width=830&height=540" class="fancybox fancybox.iframe">
											<i class="sprite sprite-map-light-blue"></i> Vezi harta itinerariu
										</a>
									<? }?>
									<!-- end harta locatie -->
								</p>
								<?/*
								<p class="hidden-md hidden-lg">
									<? if($_item['type'] == "plane"){?>
										<i class="sprite sprite-calendar-avion-blue"></i>
									<? }?>
									<? if($_item['type'] == "bus"){?>
										<i class="sprite sprite-calendar-bus-blue"></i>
									<? }?>
								</p>
								*/?>
							</div>
						</div>
						<div class="swiper-container swiper-item__main <? if($_item['video']){?>with-video<? }?>">
							<!-- discount mutat -->
							<? if($_item['discount'] > 0){?>
								<div class="item__info__hotel__discount">
									pana la<br>
									<? if($_item['reduction_type'] == 1){?>
										<span>-<?=$_item['discount']?>%</span>
									<? }elseif($_item['reduction_type'] == 2){?>
										<span>-<?=$_item['discount']?>&euro;</span>
									<? }?>
								</div>
							<? }?>
							<!-- end discount mutat -->
							<div class="swiper-wrapper">
								<? if($_item['video']){?>
									<div class="swiper-slide"><?=$_item['video_code']?></div>
								<? }?>
								<? foreach($_item['images'] as $image){?>
									<div class="swiper-slide"><img class="swiper-item__main__img object-fit" src="<?=$image['big']?>" alt="<?=$_item['title']?>"></div>
								<? }?>
							</div>
							<!--
							<p class="swiper-item__main__badge"><i class="sprite sprite-circuit-cultural"></i></p>
							-->
							<div class="swiper-button-next hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
							<div class="swiper-button-prev hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
						</div>
						<div class="swiper-item__thumbs hidden-xs">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<? if($_item['video']){?>
										<div class="swiper-slide video-icon"><img class="swiper-item__thumbs__img object-fit" src="<?=$_item['video_thumb']?>" alt="<?=$_item['title']?>"></div>
									<? }?>
									<? foreach($_item['images'] as $image){?>
										<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?=$image['small']?>" alt="<?=$_item['title']?>"></div>
									<? }?>
								</div>
							</div>
							<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
							<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
						</div>
					</div>
					<div class="col-md-3 item__info print-table">
						<!-- early booking -->
						<? if($item['early_booking']){?>
							<div class="sale-tag">EARLY BOOKING</div>
						<? }?>
						<!-- end early booking -->
						<div class="row">
							<div class="col-ms-6 col-sm-5 col-md-12 item__info--align print-table-cell-50pro">
								<p class="items__item__del"><? if(!$_search){?>de la<? }?> <? if($_item['price_old'] > 0){?><del><?=$_item['price_old']?> &euro;</del><? }?></p>
								<p class="items__item__price"><?=$_item['price']?> &euro;</p>
								<? if($_search){?>
									<p class="item__info__pers">pret / pachet</p>
								<? }else{?>
									<p class="item__info__pers">/ persoana / pachet</p>
								<? }?>
								<?/*aici diverse specificatii in grafica veche
								<ul class="item__info__hotel list-unstyled list-inline">
									<? if($_item['last_minute']){?>
										<li><i class="sprite sprite-hotel-last-minute-l"></i></li>
									<? }?>
									<? if($_item['smart']){?>
										<li><i class="sprite sprite-hotel-smart-l"></i></li>
									<? }?>
									<? if($_item['early_booking']){?>
										<li><i class="sprite sprite-hotel-early-booking-l"></i></li>
									<? }?>
									<? if($_item['discount'] > 0){?>
										<li class="item__info__hotel__discount">
											<i class="sprite sprite-hotel-discount-l"></i>
											<? if($_item['reduction_type'] == 1){?>
												<span>-<?=$_item['discount']?>%</span>
											<? }elseif($_item['reduction_type'] == 2){?>
												<span>-<?=$_item['discount']?>&euro;</span>
											<? }?>
										</li>
									<? }?>
								</ul>
								*/?>
								<a id="item__480__btn" class="btn btn-block btn--green item__info__btn book_now" href="#">Rezerva</a>
							</div>
							<div id="item__480__block" class="col-ms-6 col-sm-5 col-sm-offset-2 col-md-12 col-md-offset-0 item__info--space print-table-cell-50pro">
								<p class="item__info__reper__title pchicl"><strong>Reperele circuitului</strong></p>
								<ul class="item__info__reper list-unstyled">
									<? if($_item['type'] == "plane" && $_item['airline']){?>
										<li><i class="sprite sprite-reper-avion"></i><strong>Companie aeriana</strong>: <?=$_item['airline']?></li>
									<? }?>
									<? if($_item['city_from']){?>
										<li><i class="sprite sprite-reper-pin"></i><strong>Plecari din</strong>: <?=implode(', ', $_item['city_from'])?></li>
									<? }?>
									<? if($_item['dates']){?>
										<li><i class="sprite sprite-reper-hike"></i><strong>Plecari</strong>: <?=implode(', ', $_item['dates'])?></li>
									<? }?>
									<? if($_item['min_person']){?>
										<li><i class="sprite sprite-reper-grup"></i><strong>Grup</strong>: minim <?=$_item['min_person']?> persoane</li>
									<? }?>
									<? if($_item['effort']){?>
										<li><i class="sprite sprite-reper-efort"></i><strong>Grad de efort</strong>: <?=$_item['effort']?></li>
									<? }?>
									<? if($_item['guides']){?>
										<li><i class="sprite sprite-reper-insotitor"></i>Insotitor de grup si ghizi locali</li>
									<? }?>
								</ul>
							</div>
							<div class="col-xs-12 hidden-xs hidden-sm">
								<hr class="item__info__hr">
							</div>
						</div>
						<div class="clearfix social-links">
							<div class="addthis_inline_share_toolbox text-center"></div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?
								if(is_logged_in()){
									$whish_exist = check_if_offer_is_in_whishlist($_loggedin_user['id_user'], $_item['id_circuit'], 'circuit', 0);
								}
								?>
								<button class="btn btn-block item__info__whishlist <?=$whish_exist ? "saved" : ""?>" id="whishlist" onclick="<? if(is_logged_in()){?>saveToWishlist('circuit', <?=$_item['id_circuit']?>, 0);<? }else{?>location.href='<?=route('login')?>?whish';<? }?>">
									<i class="zmdi zmdi-favorite-outline"></i>
									<p class="ptwsh">
										Salv<?=$whish_exist ? "at" : "eaza"?> in whishlist
									</p>
								</button>
								<!-- butoane -->
								<button class="btn btn-block item__info__print hidden-xxs">
									[<i class="sprite sprite-print-small"></i>
									<p>Printeaza oferta</p>]
								</button>
								<button class="btn btn-block item__info__print">
									[<i class="sprite sprite-mail-small"></i>
									<p>Trimite hotelul pe email</p>]
								</button>
								<button class="btn btn-block item__info__print">
									[<i class="sprite sprite-fb-small"></i>
									<p>Distribuie pe facebook</p>]
								</button>
								<!-- end butoane -->
							</div>
						</div>
					</div>
				</div>

				<?/*
				<? if($_item['itinerary_items']){?>
					<div class="row">
						<div class="col-xs-12">
							<ul class="list-unstyled list-inline item-itinerariu__list hidden-xs">
								<? foreach($_item['itinerary_items'] as $k => $item){?>
									<li><i class="sprite sprite-pin-<? if($k == 0) echo "green"; elseif($k == count($_item['itinerary_items'])-1) echo "red"; else echo "grey"?>"></i> <span><?=$item['title']?></span></li>
								<? }?>
							</ul>
						</div>
					</div>
				<? }?>
				*/?>

				<div class="row item-tabs">
					<div class="col-xs-12">
						<div class="row no-pad">
							<div class="col-xs-12 col-md-3">
								<ul id="nav-tabs" class="nav nav-tabs hidden-xs hidden-sm">
									<li class="active"><a href="#itinerariu" data-toggle="tab">ITINERARIU</a></li>
									<li><a href="#rezervare" data-toggle="tab">REZERVARE</a></li>
									<? if($_item['included'] || $_item['not_included']){?>
										<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
									<? }?>
									<? if($_item['financial_conditions']){?>
										<li><a href="#financiar" data-toggle="tab">Conditii financiare</a></li>
									<? }?>
									<? if($_item['flight_info']){?>
										<li><a href="#orar" data-toggle="tab">Orar de zbor</a></li>
									<? }?>
									<? if($_item['optional_excursions']){?>
										<li><a href="#excursii" data-toggle="tab">Excursii optionale</a></li>
									<? }?>
									<? if($_item['transfers']){?>
										<li><a href="#transferuri" data-toggle="tab">Transferuri</a></li>
									<? }?>
									<? if($_item['important_info']){?>
										<li><a href="#informatii" data-toggle="tab">Informatii importante</a></li>
									<? }?>
								</ul>

								<div class="dropdown hidden-md hidden-lg">
									<button class="btn btn-block item-tabs__btn clearfix" type="button" id="item-tabs__btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="item-tabs__btn__text">ITINERARIU</span>
										<span class="item-tabs__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="item-tabs__btn">
										<li class="active"><a href="#itinerariu" data-toggle="tab">ITINERARIU</a></li>
										<li><a href="#rezervare" data-toggle="tab">REZERVARE</a></li>
										<? if($_item['included'] || $_item['not_included']){?>
											<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
										<? }?>
										<? if($_item['financial_conditions']){?>
											<li><a href="#financiar" data-toggle="tab">Conditii financiare</a></li>
										<? }?>
										<? if($_item['flight_info']){?>
											<li><a href="#orar" data-toggle="tab">Orar de zbor</a></li>
										<? }?>
										<? if($_item['optional_excursions']){?>
											<li><a href="#excursii" data-toggle="tab">Excursii optionale</a></li>
										<? }?>
										<? if($_item['transfers']){?>
											<li><a href="#transferuri" data-toggle="tab">Transferuri</a></li>
										<? }?>
										<? if($_item['important_info']){?>
											<li><a href="#informatii"  data-toggle="tab">Informatii importante</a></li>
										<? }?>
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-md-9">
								<? if($_item['departures']){?>
									<div class="item-filters-wrapper">
										<div class="row item-filters" id="book_form">
											<div class="col-xs-12">
												<p><strong>Calculeaza tarif exact (numar adulti si copii)</strong></p>
												<form>
													<div class="row">
														<div class="col-xs-12 col-ms-4 col-sm-4 col-md-3">
															<label class="item-filters__label" for="item-circuite-data-plecare">
																<span class="item-filters__label__text">Data plecare</span>
																<select id="item-circuite-data-plecare" class="form-control item-filters__select" style="width: 100%;">
																	<option value=""></option>
																	<? foreach($_item['departures'] as $date){?>
																		<option value="<?=$date['id_circuit_date_price']?>" <? if($_selected_departure == $date['id_circuit_date_price']){?>selected<? }?>><?=date('d.m.Y', strtotime($date['dep_date']))?></option>
																	<? }?>
																</select>
																<span class="error"></span>
															</label>
														</div>
														<div class="col-xs-12 col-ms-4 col-sm-4 col-md-2">
															<label class="item-filters__label" for="item-circuite-camere">
																<span class="item-filters__label__text">Nr. camere</span>
																<select id="item-circuite-camere" class="form-control item-filters__select select__s2" style="width: 100%;">
																	<option value="1" <? if($_search['rooms'] == 1){?>selected<? }?>>1</option>
																	<option value="2" <? if($_search['rooms'] == 2){?>selected<? }?>>2</option>
																	<option value="3" <? if($_search['rooms'] == 3){?>selected<? }?>>3</option>
																</select>
															</label>
														</div>

														<? for($i=1; $i<=3; $i++){?>
															<div class="col-xs-12 col-md-7 <? if($i > 1){?>col-md-offset-5<? }?> item-filters__cam<?=$i?>" <? if($_search['rooms'] >= $i){?>style="display:block"<? }?>>
																<div class="row">
																	<div class="col-xs-12 col-ms-4 col-sm-4 col-md-6">
																		<div class="row">
																			<div class="col-md-4">
																				<label class="item-filters__label adult_nr" for="item-circuite-adulti<?=$i?>">
																					<span class="item-filters__label__text">Adulti</span>
																					<select id="item-circuite-adulti<?=$i?>" class="form-control item-filters__select select__s2" style="width: 100%;">
																						<option value="">-</option>
																						<?php for($j=1;$j<=3;$j++) { ?>
																							<option value="<?php echo $j; ?>" <? if($_search['room_info'][$i-1]['adult'] == $j){?>selected<? }elseif(!$_search && $j==2){?>selected<? }?>><?php echo $j; ?></option>
																						<?php } ?>
																					</select>
																					<span class="error"></span>
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label class="item-filters__label child_nr" for="item-circuite-copii<?=$i?>">
																					<span class="item-filters__label__text">Copii</span>
																					<select id="item-circuite-copii<?=$i?>" class="form-control item-filters__select select__s2" style="width: 100%;">
																						<option value="">-</option>
																						<option value="1" <? if($_search && $_search['room_info'][$i-1]['child'] == 1){?>selected<? }?>>1</option>
																					</select>
																				</label>
																			</div>
																			<div class="col-md-4">
																				<label class="item-filters__label child_age" for="item-circuite-copii-varste<?=$i?>" style="display:<? if($_search['room_info'][$i-1]['child'] == 1){?>block<? }else{ ?>none<? }?>;">
																					<span class="item-filters__label__text" style="white-space: nowrap;">Varsta copil</span>
																					<select id="item-circuite-copii-varste<?=$i?>" class="form-control item-filters__select item-circuite-varste-copii select__s2" style="width: 100%;">
																						<option value="">-</option>
																						<?php for($j=0;$j<14;$j++) { ?>
																							<option value="<?php echo $j; ?>" <? if($_search && $_search['room_info'][$i-1]['child_age'] == $j){?>selected<? }?>><?php echo $j; ?></option>
																						<?php } ?>
																					</select>
																					<span class="error"></span>
																				</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-xs-12 col-ms-4 col-sm-4 col-md-6">
																		<div class="row">
																			<div class="col-md-6">
																				<label class="item-filters__label room_type" for="item-room-type<?=$i?>">
																					<span class="item-filters__label__text">Tip camera</span>
																					<select id="item-room-type<?=$i?>" class="form-control item-filters__select select__s2" style="width: 100%;" data-placeholder="- Tip camera -">
																						<option value=""></option>
																						<? foreach($_circuit_room_types as $key => $room){?>
																							<option value="<?=$key?>" <? if($_search['room_info'][$i-1]['type'] == $key){?>selected<? }elseif(!$_search && $key==1){?>selected<? }?>><?=$room['title']?></option>
																						<? }?>
																					</select>
																					<span class="error"></span>
																				</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<? }?>
													</div>
													<div class="row margin--top-10">
														<div class="col-md-8">
															<p class="item-filters__disclaimer item-filters__disclaimer--bg">* Daca la plecarea selectata de dvs. exista camere disponibile, rezervarea se poate efectua online, prin plata cu cardul, iar confirmarea o veti primi prin email impreuna cu documentele de calatorie aferente. Daca tipul de camera figureaza “la cerere”, veti fi contactat de un operator care va verifica disponibilitatea acesteia cu partenerul extern si va realiza rezervarea.</p>
														</div>
														<div class="col-md-4">
															<button class="btn btn-block btn--light-blue item-filters__btn" id="calculate">
																<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
																<span>Calculeaza</span>
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>

										<div class="row rez-calc" id="results"></div>
									</div>
								<? }?>

								<div class="tab-content">
									<div class="tab-pane active print-visible" id="itinerariu">
										<div class="row">
										    <div class="col-md-12 print-visible"><p class="tab-title">Itinerariu</p></div>

											<div class="col-md-12 item-itinerariu__main">
												<ul class="list-unstyled item-itinerariu__main__list">
													<?php foreach($_item['days_desc'] as $day) { ?>
														<li><a href="#">
															<p class="item-itinerariu__main__list__title">
																[<strong>ZIUA <?=$day['day']?></strong>
																<? if(trim($day['title']) != ""){?>
																	&nbsp;•&nbsp;&nbsp;&nbsp;<?=$day['title']?>]
																<? }?>
																<!-- arrow -->
																<i class="item-itinerariu__main__list__arrow"></i>
																<!-- end arrow -->
															</p></a>
															<div class="item-itinerariu__main__list__text">
																<?=$day['description']?>
															</div>
															<? if(trim($day['hotel']) != "" || trim($day['meal']) != ""){?>
																<div class="item-itinerariu__main__list__detalii clearfix">
																	<i class="sprite sprite-itinerariu pull-left"></i>
																	<ul class="list-unstyled item-itinerariu__main__list__detalii__list">
																		<? if(trim($day['hotel']) != ""){?>
																			<li><strong>Cazare</strong>: <?=$day['hotel']?></li>
																		<? }?>
																		<? if(trim($day['meal']) != ""){?>
																			<li><strong>Mese</strong>: <?=$day['meal']?></li>
																		<? }?>
																	</ul>
																</div>
															<? }?>
															<hr>
														</li>
													<?php } ?>
												</ul>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 item-itinerariu__aside">
												<hr class="hr--blue">
												<div class="row">
													<div class="col-md-7">
														<? if($_item['attractions']){?>

															<p><strong>Atractiile circuitului:</strong></p>
															<?=$_item['attractions']?>
														<? }?>
													</div>
													<div class="col-md-5">
														<? if($_item['map_image']){?>
															<hr class="hr--blue">
															<a class="fancybox fancybox.iframe" href="<?=$_item['map_big']?>?&iframe=true&width=830&height=540" title="<?=$_item['title']?> - Harta Traseu">
																<img class="item-itinerariu__aside__img object-fit" src="<?=$_item['map_image']?>" alt="<?=$_item['title']?>">
															</a>
														<? }elseif($_item['itinerary']){?>
															<a rel="fancybox" href="<?=$_item['itinerary_big']?>">
																<img class="item-itinerariu__aside__img object-fit" src="<?=$_item['itinerary']?>" alt="<?=$_item['title']?>">
															</a>
														<? }?>
													</div>
												</div>

												<? if($_item['papers_needed'] || $_item['currency'] || $_item['language'] || $_item['climate']){?>
													<hr class="hr--blue">
													<p><strong>Informatii utile:</strong></p>
													<ul class="list-unstyled item-itinerariu__aside__list-utile">
														<? if($_item['papers_needed']){?>
															<li class="clearfix"><i class="sprite sprite-util-acte pull-left"></i><span><strong>Acte necesare</strong>: <?=$_item['papers_needed']?></span></li>
														<? }?>
														<? if($_item['currency']){?>
															<li class="clearfix"><i class="sprite sprite-util-moneda"></i><span><strong>Moneda</strong>: <?=$_item['currency']?></span></li>
														<? }?>
														<? if($_item['language']){?>
															<li class="clearfix"><i class="sprite sprite-util-limba"></i><span><strong>Limba</strong>: <?=$_item['language']?></span></li>
														<? }?>
														<? if($_item['climate']){?>
															<li class="clearfix"><i class="sprite sprite-util-clima"></i><span><strong>Clima</strong>: <?=$_item['climate']?></span></li>
														<? }?>
													</ul>
												<? }?>
											</div>
										</div>
									</div>

									<div class="tab-pane" id="rezervare"></div>

									<? if($_item['included'] || $_item['not_included']){?>
										<div class="tab-pane print-visible" id="servicii">
											<div class="print-visible"><p class="tab-title">Servicii</p></div>
											<? if($_item['included']){?>
												<p class="text-uppercase"><strong>SERVICII INCLUSE:</strong></p>
												<?=$_item['included']?>
												<br>
											<? }?>
											<? if($_item['not_included']){?>
												<p class="text-uppercase"><strong>NU SUNT INCLUSE:</strong></p>
												<?=$_item['not_included']?>
											<? }?>
										</div>
									<? }?>

									<? if($_item['financial_conditions']){?>
										<div class="tab-pane print-visible" id="financiar">
											<div class="print-visible"><p class="tab-title">Conditii financiare</p></div>
											<?=$_item['financial_conditions']?>
										</div>
									<? }?>

									<? if($_item['flight_info']){?>
										<div class="tab-pane print-visible" id="orar">
											<div class="print-visible"><p class="tab-title">Orar de zbor</p></div>
											<?=$_item['flight_info']?>
										</div>
									<? }?>

									<? if($_item['optional_excursions']){?>
										<div class="tab-pane print-visible" id="excursii">
											<div class="print-visible"><p class="tab-title">Excursii optionale</p></div>
											<?=$_item['optional_excursions']?>
										</div>
									<? }?>

									<? if($_item['transfers']){?>
										<div class="tab-pane print-visible" id="transferuri">
											<div class="print-visible"><p class="tab-title">Transferuri</p></div>
											<?=$_item['transfers']?>
										</div>
									<? }?>

									<? if($_item['important_info']){?>
										<div class="tab-pane print-visible" id="informatii">
											<div class="print-visible"><p class="tab-title">Informatii importante</p></div>
											<?=$_item['important_info']?>
										</div>
									<? }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<a href="#" class="go-ontop">Inapoi sus <span><i class="zmdi zmdi-chevron-up"></i></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_testimonials.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>

<script>
$(document).ready(function(){
	dataLayer.push({
		"ecommerce": {
			"currencyCode": "EUR",
			'detail': {
		    	'actionField': {'list': 'Offer page'},
		      	'products': [{
		        	'id': '<?=$_item['id_circuit']?>',
					'name': '<?=$_item['title']?>',
		        	'price': '<?=$_item['price']?>',
		        	'category': 'Circuite',
		    	}]
		    }
	  	}
	});

	gtag('event', 'page_view', {
		'send_to': 'AW-1009319514',
	   	'dynx_itemid': 'CI<?=$_item['id_circuit']?>',
	   	'dynx_itemid2': '<?=$_item['title']?>',
	   	'dynx_pagetype': 'offerdetail',
		'dynx_totalvalue': '<?=$_item['price']?>'
  	});

	gtag('event', 'view_item', {
		'send_to': 'AW-1009319514',
  		'items': [{
  			'destination': 'CI<?=$_item['id_circuit']?>',
  			'google_business_vertical': 'travel'
    	}]
	});

	fbq('track', 'ViewContent', {
	    value: <?=$_item['price']?>,
	    currency: 'EUR',
	    content_ids: 'CI<?=$_item['id_circuit']?>',
	    content_type: 'product',
		content_name: '<?=$_item['title']?>',
		content_category: 'Circuite'
  	});

});
</script>

<script type="text/javascript">$(function() { swiper_item(7); });</script>

<script>
$(document).ready(function(){

	$('body').on('click', '.rez_btn_circ', function(e){
		e.preventDefault();

		dataLayer.push({
			'event': 'addToCart',
			"ecommerce": {
				"currencyCode": "EUR",
				'add': {
			      	'products': [{
			        	'id': '<?=$_item['id_circuit']?>',
						'name': '<?=$_item['title']?>',
			        	'price': '<?=$_item['price']?>',
			        	'category': 'Circuite',
						'quantity': 1
			    	}]
			    }
		  	}
		});

		gtag('event', 'add_to_cart', {
			'send_to': 'AW-1009319514',
			'items': [{
  				'destination': 'CI<?=$_item['id_circuit']?>',
	  			'google_business_vertical': 'travel'
	    	}]
		});

		fbq('track', 'AddToCart', {
		    value: <?=$_item['price']?>,
		    currency: 'EUR',
		    content_ids: 'CI<?=$_item['id_circuit']?>',
		    content_type: 'product',
			content_name: '<?=$_item['title']?>',
	  	});

		$(this).parent().submit();
	});

	$('#calculate').click(function(e){
		e.preventDefault();

		$('#results').html('');

		$('label[for=item-circuite-data-plecare] span.error').html('');
		for(i=1; i<=3; i++){
			$('label[for=item-room-type'+i+'] span.error').html('');
			$('label[for=item-circuite-adulti'+i+'] span.error').html('');
			$('label[for=item-circuite-copii-varste'+i+'] span.error').html('');
		}

		$date = $('#item-circuite-data-plecare').val();
		if($date == ''){
	    	$('label[for=item-circuite-data-plecare] span.error').html('Alegeti o data de plecare');
	    	return false;
	    }

	    $nr_rooms = $('#item-circuite-camere').val();
	    $rooms_info = [];
	    for(i=1; i<=$nr_rooms; i++){
	    	$room_tmp = {};

	    	$room_type = $('#item-room-type'+i).val();

		    $room_tmp.type = $room_type;
		    $room_tmp.adult = $('#item-circuite-adulti'+i).val();
		    $room_tmp.child = $('#item-circuite-copii'+i).val();
		    $room_tmp.child_age = $('#item-circuite-copii-varste'+i).val();

		    if($room_tmp.adult == ''){
		    	$('label[for=item-circuite-adulti'+i+'] span.error').html('Alegeti nr de adulti');
		    	return false;
		    }

			if($room_tmp.child > 0){
				if($room_tmp.child_age == ""){
					$('label[for=item-circuite-copii-varste'+i+'] span.error').html('Alegeti varsta');
			    	return false;
				}
			}

	    	if($room_type == ''){
		    	$('label[for=item-room-type'+i+'] span.error').html('Alegeti tipul de camera');
		    	return false;
		    }

		    $rooms_info.push($room_tmp);

		    /*
		    $nr_child = $('#item-circuite-copii'+i+':selected').val();
		    if($nr_child > 0){

		    }
		    */
	    }

	    var $this = $(this);
	    $this.find('span').addClass('hidden');
	    $this.find('i').removeClass('hidden');

		$.ajax({
			url: $_base + 'ajax/item/circuit.php',
			method: 'post',
			data: {
				date: $date,
				rooms: $nr_rooms,
				rooms_info: JSON.stringify($rooms_info)
			},
			success: function(data) {
				$('#results').html(data);
				$this.find('i').addClass('hidden');
				$this.find('span').removeClass('hidden');
				$this.find('span').text('Recalculeaza');
			}
		});
	});

	<? if($_search){?>
		$('#calculate').trigger('click');
	<? }?>

	/*
	$('body').on('click', '.remove_room', function(e){
		e.preventDefault();

		$(this).parent().parent().parent().parent().next().remove();
		$(this).parent().parent().parent().parent().remove();
	});
	*/

});


</script>
