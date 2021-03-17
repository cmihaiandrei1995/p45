<main>

	<div class="container-fluid">
		<div class="row">
			<div class="container mt-25">
				<?/*
				<?
				$_step = 2;
				$_step_type = "Hotel";
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
						<div class="row">
							<div class="col-xs-12">
								<h1 class="item__title">
									<?=$_item['title']?>
									<? if($_item['stars'] > 0){?>
										<span>
											<? for($i=1; $i<=$_item['stars']; $i++){?><i class="sprite sprite-star-l"></i><? }?>
										</span>
									<? }?>
								</h1>
								<p class="item__sub">
									<span><?=$_city['title']?></span>
									<!-- arata pe harta -->
									<a class="items__item__harta fancybox fancybox.iframe" href="<?=$item['map_url']?>">
										[<i class="sprite sprite-pin"></i> Arata pe harta]
									</a>
									<!-- end arata pe harta -->
								</p>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<ul class="item__list list-unstyled list-inline">
									<? if($_item['parking']){?>
										<li data-toggle="tooltip" title="Parcare"><i class="sprite sprite-facility-parking-l"></i></li>
									<? }?>
									<? if($_item['kids_hotel']){?>
										<li data-toggle="tooltip" title="Hotel pentru copii"><i class="sprite sprite-kids-l"></i></li>
									<? }?>
									<? if($_item['spa']){?>
										<li data-toggle="tooltip" title="Spa"><i class="sprite sprite-facility-spa-l"></i></li>
									<? }?>
									<? if($_item['fitness']){?>
										<li data-toggle="tooltip" title="Sala fitness"><i class="sprite sprite-facility-gym-l"></i></li>
									<? }?>
									<!--
									<? if($_item['pets']){?>
										<li data-toggle="tooltip" title="Accepta animale"><i class="sprite sprite-facility-pets-l"></i></li>
									<? }?>
									-->
									<? if($_item['wifi'] || $_item['internet']){?>
										<li data-toggle="tooltip" title="Internet"><i class="sprite sprite-facility-wifi-l"></i></li>
									<? }?>
									<? if($_item['air_conditioner']){?>
										<li data-toggle="tooltip" title="Aer conditionat"><i class="sprite sprite-facility-ac-l"></i></li>
									<? }?>
									<? if($_item['beach']){?>
										<li data-toggle="tooltip" title="Plaja"><i class="sprite sprite-facility-plaja-l"></i></li>
									<? }?>
									<!--
									<? if($_item['beach_sand']){?>
										<li data-toggle="tooltip" title="Plaja cu nisip"><i class="sprite sprite-facility-hotelbeach-l"></i></li>
									<? }?>
									-->
									<? if($_item['pool_outside']){?>
										<li data-toggle="tooltip" title="Piscina exterioara"><i class="sprite sprite-facility-pool-l"></i></li>
									<? }?>
									<? if($_item['pool_indoor']){?>
										<li data-toggle="tooltip" title="Piscina interioara"><i class="sprite sprite-facility-insidepool-l"></i></li>
									<? }?>
									<? if($_item['aqua_park']){?>
										<li data-toggle="tooltip" title="Aqua Park"><i class="sprite sprite-facility-aquapark-l"></i></li>
									<? }?>
									<? if($_item['restaurant']){?>
										<li data-toggle="tooltip" title="Restaurant"><i class="sprite sprite-facility-restaurant-l"></i></li>
									<? }?>
									<? if($_item['restaurant_a_la_carte']){?>
										<li data-toggle="tooltip" title="Restaurant a la carte"><i class="sprite sprite-facility-alacarte-l"></i></li>
									<? }?>
								</ul>
							</div>
						</div>

						<? if($_item['images']){?>
							<div class="<? if(count($_item['images']) > 1){?>swiper-container <? }?> swiper-item__main <? if($_item['video']){?>with-video<? }?>">

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
											<? if($_item['reduction_type'] == 1){?>
												<span>-<?=$_item['discount']?>%</span>
											<? }elseif($_item['reduction_type'] == 2){?>
												<span>-<?=$_item['discount']?>&euro;</span>
											<? }?>
										</li>
									<? }?>
								</ul>
								*/?>
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
										<div class="swiper-slide">
											<? if($_item['video_file']){?>
												<script type="text/javascript" src='https://cdn.jwplayer.com/libraries/lYrci1Cv.js'></script>
												<div id="my-video"></div>
												<script>
												$(document).ready(function(){
													jwplayer("my-video").setup({
													    "file": "<?=$_item['video_file']?>",
													    "image": "<?=$_item['video_big']?>",
													    "height": "100%",
													    "width": "100%",
													});
												});
												</script>
												<? /*
												<video id='my-video' class='video-responsive' controls preload='auto' poster='<?=$_item['video_big']?>'>
												    <source src='<?=$_item['video_file']?>' type='video/mp4'>
												</video>
												*/ ?>
											<? }else{?>
												<?=$_item['video_code']?>
											<? }?>
										</div>
									<? }?>
									<? foreach($_item['images'] as $image){?>
										<div class="swiper-slide"><img class="swiper-item__main__img object-fit" src="<?=$image['big']?>" alt="<?=$_item['title']?>"></div>
									<? }?>
								</div>
								<? if(count($_item['images']) > 1){?>
									<div class="swiper-button-next hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
									<div class="swiper-button-prev hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
								<? }?>
							</div>
							<? if(count($_item['images']) > 1){?>
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
							<? }?>
						<? }?>
					</div>

					<div class="col-md-3 item__info">
						<!-- early booking -->
						<? if($item['early_booking']){?>
							<div class="sale-tag">[EARLY BOOKING]</div>
						<? }?>
						<!-- end early booking -->
						<? if($_item['price'] > 0){?>
							<div class="row">
								<div class="col-ms-6 col-sm-5 col-md-12 item__info--align">
									<p class="items__item__del"><? if(!$_search){?>de la<? }?> <? if($_item['price_old'] > 0){?><del><?=$_item['price_old']?> &euro;</del><? }?></p>
									<p class="items__item__price"><?=$_item['price']?> &euro;</p>

									<? if($_search){?>
										<p class="item__info__pers">pret / pachet <?=$_item['nr_nights']?> nopti</p>
									<? }else{?>
										<p class="item__info__pers">/ persoana / pachet <?=$_item['nr_nights']?> nopti</p>
									<? }?>

									<a id="item__480__btn" class="btn btn-block btn--green item__info__btn book_now" href="#">Rezerva</a>
								</div>
								<div class="col-xs-12 hidden-xs hidden-sm">
									<hr class="item__info__hr">
								</div>
								<div id="item__480__block" class="col-ms-6 col-sm-5 col-sm-offset-2 col-md-12 col-md-offset-0 item__info--space">
									<p class="margin--bottom-0 pchicl"><strong>Pachetul include</strong></p>
									<ul class="item__info__pachet list-unstyled">
										<li><i class="sprite sprite-pachet-nopti"></i><?=$_item['nr_nights']?> nopti cazare</li>
					                    <li><i class="sprite sprite-pachet-masa"></i>Masa *</li>
					                    <li><i class="sprite sprite-pachet-avion"></i>Bilete avion dus/intors</li>
					                    <li><i class="sprite sprite-pachet-taxe"></i>Taxe aeroport</li>
					                    <li><i class="sprite sprite-pachet-transfer"></i>Transfer aeroport - hotel - aeroport</li>
										<? if(!$_zone['hide_assistance']){?>
						                    <li><i class="sprite sprite-pachet-asistenta"></i>Asistenta turistica</li>
										<? }?>
										<li>* conform ofertei alese</li>
									</ul>
									<p class="margin--bottom-0 pchicl"><strong>Pachetul nu include</strong></p>
									<p class="item__info__nu-include">Asigurarea de calatorie, Asigurarea storno, Excursiile optionale, Alte servicii neincluse in pachet</p>
								</div>
								<div class="col-xs-12 hidden-xs hidden-sm">
									<hr class="item__info__hr">
								</div>
							</div>
							<div class="clearfix">
								<div class="addthis_inline_share_toolbox text-center"></div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<button class="btn btn-block item__info__whishlist <?=$whish_exist ? "saved" : ""?>" id="whishlist" onclick="<? if(is_logged_in()){?>saveToWishlist('charter', <?=$_item['id_hotel']?>, <?=$_city_from['id_city']?>);<? }else{?>location.href='<?=route('login')?>?whish';<? }?>">
										<i class="zmdi zmdi-favorite-outline"></i>
										<p>
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
								<?
								if(is_logged_in()){
									$whish_exist = check_if_offer_is_in_whishlist($_loggedin_user['id_user'], $_item['id_hotel'], 'charter', $_city_from['id_city']);
								}
								?>
							</div>
						<? }else{?>
							<div class="row">
								<div id="item__480__block" class="col-ms-6 col-sm-5 col-md-12 item__info--space item_indisponibil">
									<p class="margin--bottom-0 pchicl">Indisponibil</p>
									<hr>
									<p class="item__info__nu-include"><a href="<?=$_parent_url?>">Vezi alte hoteluri din <?=$_title?></a></p>
									<?php if($_related_hotels){ ?>
										<div class="similar-hotels-list">
											<? foreach($_related_hotels as $hotel){?>
												<div class="similar-hotel">
													<h2 class="item__title"><a href="<?=$hotel['url']?>"><?=$hotel['title']?></a></h1>
													<p class="item__sub">
														<span><?=$_city['title']?></span>
														<? if($hotel['stars'] > 0){?>
															<span>
																<? for($i=1; $i<=$_item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
															</span>
														<? }?>
													</p>
													<a href="<?=$hotel['url']?>"><img src="<?=$hotel['images'][0]['thumb']?>"></a>
												</div>
											<? }?>
										</div>
									<?php } ?>
								</div>
							</div>
						<? }?>
					</div>
				</div>

                <? if($_days_found && $_periods_found > 5 && $_item['price'] > 0) { ?>
	                <div class="row">
	                    <div class="col-xs-12">
	                        <div id="price-swiper">
	                            <div class="row">
	                                <div class="col-xs-12 col-md-3">
	                                    <form class="item-filters price-chart-left">
	                                        <label class="item-filters__label" for="item-t-start-day">
	                                            <span class="item-filters__label__text">Plecare:</span>
	                                            <select id="item-price-chart-start-day" class="form-control item-filters__select select__s2" style="width:171px;"
													data-offer="charter" data-city-from="<?=$_city_from['id_city']?>" data-id-hotel="<?=$_item['id_hotel']?>" data-type="<?=$_is_zone ? "zone" : "city"?>"
													data-location-id=<?=$_is_zone ? $_zone['id_zone'] : $_city['id_city']?>>
													<? foreach($_days_found as $day){?>
		                                                <option value="<?=$day?>"><?=$_week_days[$day]?></option>
													<? }?>
	                                            </select>
	                                        </label>
	                                        <label class="item-filters__label item-price-chart-vacation-duration" for="item-v-duration">
	                                            <span class="item-filters__label__text">Durata vacanta:</span>
	                                            <select id="item-price-chart-vacation-duration" class="form-control item-filters__select select__s2" style="width: 134px;">
	                                                <option value="">Alege ziua de plecare</option>
	                                            </select>
	                                        </label>
	                                        <div class="offer">
												*Tarifele afisate sunt valabile astazi si nu reprezinta evolutia lor in timp.<br>
												*Oferta este valabila in limita disponibilitatilor.
											</div>
	                                    </form>
	                                </div>
	                                <div class="col-xs-12 col-md-9">
	                                    <div id="sw-price-wrapper">
	                                        <!-- <i class="zmdi zmdi-spinner zmdi-hc-spin price-loader"></i> -->
	                                        <div class="sw-price-inner">
	                                            <div class="swiper-container swiper-price-chart">
	                                                <div class="swiper-wrapper"></div>
	                                            </div>
	                                            <div class="sw-price-prev"></div>
	                                            <div class="sw-price-next"></div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
                <? } ?>

				<div class="row item-tabs">
					<div class="col-xs-12">
						<div class="row no-pad">
							<div class="col-xs-12 col-md-3">
								<ul id="nav-tabs" class="nav nav-tabs hidden-xs hidden-sm">
									<? if($_item['price'] > 0){?>
										<li class="active"><a href="#rezervare" data-toggle="tab">REZERVARE</a></li>
									<? }?>
									<? if($_item['description'] != "" || $_item['localization'] != "" || $_item['room_info'] != "" || $_item['hotel_info'] != "" || $_item['kids_info'] != "" || $_item['beach_info'] != "" || $_item['meal_info'] != "" || $_item['other_info'] != "" || ($_item['latitude'] != "" && $_item['latitude'] != "0")){?>
										<li <? if(!$_item['price'] > 0){?>class="active"<? }?>><a href="#descriere" data-toggle="tab" class="desc_hotel">Descriere hotel<? if($_item['latitude'] != "" && $_item['latitude'] != "0"){?>/harta<? }?></a></li>
									<? }?>
									<? if($_zone['description'] != ""){?>
										<li><a href="#destinatie" data-toggle="tab">Descriere destinatie</a></li>
									<? }?>
									<? if($_zone_text['included_services'] != ""){?>
										<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
									<? }?>
									<? if($_zone['excursion'] != "" && $_item['senior'] != 1){?>
										<li><a href="#excursion" data-toggle="tab">Excursii optionale</a></li>
									<? }?>
									<? if($_zone_text['financial_terms'] != ""){?>
										<li><a href="#financiar" data-toggle="tab">Conditii financiare</a></li>
									<? }?>
									<? if($_item['senior_info'] != ""){?>
		                  				<li><a href="#senior" data-toggle="tab">Turism social/seniori</a></li>
		                  			<? }?>
									<? if($_zone_text['info_usefull'] != ""){?>
		                  				<li><a href="#info" data-toggle="tab">Informatii utile</a></li>
		                  			<? }?>
									<? if($_zone_text['transfers'] != ""){?>
		                  				<li><a href="#transferuri" data-toggle="tab">Transferuri</a></li>
		                  			<? }?>
								</ul>
								<div class="dropdown hidden-md hidden-lg">
									<button class="btn btn-block item-tabs__btn clearfix" type="button" id="item-tabs__btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="item-tabs__btn__text">REZERVARE</span>
										<span class="item-tabs__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="item-tabs__btn">
										<? if($_item['price'] > 0){?>
											<li class="active"><a href="#rezervare" data-toggle="tab">REZERVARE</a></li>
										<? }?>
										<? if(trim($_item['description']) != "" || trim($_item['localization']) != "" || trim($_item['room_info']) != "" || trim($_item['hotel_info']) != "" || trim($_item['kids_info']) != "" || trim($_item['beach_info']) != "" || trim($_item['meal_info']) != "" || trim($_item['other_info']) != "" || ($_item['latitude'] != "" && $_item['latitude'] != "0")){?>
											<li <? if(!$_item['price'] > 0){?>class="active"<? }?>><a href="#descriere" data-toggle="tab" class="desc_hotel">Descriere hotel<? if($_item['latitude'] != "" && $_item['latitude'] != "0"){?>/harta<? }?></a></li>
										<? }?>
										<? if($_zone['description'] != ""){?>
											<li><a href="#destinatie" data-toggle="tab">Descriere destinatie</a></li>
										<? }?>
										<? if($_zone['excursion'] != "" && $_item['senior'] != 1){?>
											<li><a href="#excursion" data-toggle="tab">Excursii optionale</a></li>
										<? }?>
										<? if($_zone_text['included_services'] != ""){?>
											<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
										<? }?>
										<? if($_zone_text['financial_terms'] != ""){?>
											<li><a href="#financiar" data-toggle="tab">Conditii financiare</a></li>
										<? }?>
										<? if($_item['senior_info'] != ""){?>
			                  				<li><a href="#senior" data-toggle="tab">Turism social/seniori</a></li>
			                  			<? }?>
										<? if($_zone_text['info_usefull'] != ""){?>
			                  				<li><a href="#info" data-toggle="tab">Informatii utile</a></li>
			                  			<? }?>
										<? if($_zone_text['transfers'] != ""){?>
			                  				<li><a href="#transferuri" data-toggle="tab">Transferuri</a></li>
			                  			<? }?>
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-md-9">
								<? if($_item['price'] > 0){?>
									<div class="item-filters-wrapper">
										<div class="item-filters" id="book_form">
												<p><strong>Calculeaza tarif exact (numar adulti si copii)</strong></p>
												<form>
													<div class="row">
														<div class="col-xs-12 col-ms-4 col-sm-4 col-md-3">
															<span class="item-filters__label__text">Check in <i class="sprite sprite-calendar-grey"></i></span>
															<input type="text" class="form-control" id="item-t-individual-check-in-restrict" placeholder="- Alege data -" autocomplete="off" value="<?=$_date_from?>">
															<span class="error"></span>
														</div>
														<div class="col-xs-12 col-ms-4 col-sm-4 col-md-3">
															<span class="item-filters__label__text">Check out <i class="sprite sprite-calendar-grey"></i></span>
															<input type="text" class="form-control" id="item-t-individual-check-out-restrict" placeholder="- Alege data -" autocomplete="off" value="<?=$_date_to?>">
															<span class="error"></span>
														</div>
														<div class="col-xs-12 col-ms-4 col-sm-4 col-md-2">
															<label class="item-filters__label" for="item-t-individual-camere">
																<span class="item-filters__label__text">Nr. camere</span>
																<select id="item-t-individual-camere" class="form-control item-filters__select select__s2" style="width: 100%;">
																	<option value="1" <? if($_search['rooms'] == 1){?>selected<? }?>>1</option>
																	<option value="2" <? if($_search['rooms'] == 2){?>selected<? }?>>2</option>
																	<option value="3" <? if($_search['rooms'] == 3){?>selected<? }?>>3</option>
																</select>
															</label>
														</div>
														<? for($k=1; $k<=3; $k++){?>
															<div class="col-xs-12 col-md-4 <? if($k>1){?> col-md-offset-8 <? }?> item-filters__cam<?=$k?>" <? if($_search['rooms'] >= $k){?>style="display:block"<? }?>>
																<label class="item-filters__label item-filters__label--small" for="item-t-individual-adulti<?=$k?>">
																	<span class="item-filters__label__text">Adulti</span>
																	<select id="item-t-individual-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
																		<?php for($j=1;$j<=5;$j++) { ?>
																			<option value="<?php echo $j; ?>" <? if($_search['room_info'][$k-1]['adult'] == $j){?>selected<? }elseif(!$_search && $j==2){?>selected<? }?>><?php echo $j; ?></option>
																		<?php } ?>
																	</select>
																</label>
																<label class="item-filters__label item-filters__label--small" for="item-t-individual-copii<?=$k?>">
																	<span class="item-filters__label__text">Copii</span>
																	<select id="item-t-individual-copii<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
																		<option value="">-</option>
																		<?php for($j=1;$j<4;$j++) { ?>
																			<option value="<?php echo $j; ?>" <? if($_search && $_search['room_info'][$k-1]['child'] == $j){?>selected<? }?>><?php echo $j; ?></option>
																		<?php } ?>
																	</select>
																</label>
																<? for($i=1; $i<=3; $i++){?>
																	<label class="item-filters__label item-filters__label--small" for="item-t-individual-copii-varste<?=$k?>-<?=$i?>" <? if($_search['room_info'][$k-1]['child'] >= $i){?>style="display:inline-block"<? }?>>
																		<span class="item-filters__label__text" style="white-space: nowrap;"><? if($i==1){?>Varste copii<? }?>&nbsp;</span>
																		<select class="form-control item-filters__select item-t-individual-varste-copii select__s2" id="item-t-individual-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
																			<option value="">-</option>
																			<?php for($j=0;$j<14;$j++) { ?>
																				<option value="<?php echo $j; ?>" <? if($_search && $_search['room_info'][$k-1]['child_age'][$i-1] == $j){?>selected<? }?>><?php echo $j; ?></option>
																			<?php } ?>
																		</select>
																		<span class="error"></span>
																	</label>
																<? }?>
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
																<span>Recalculeaza</span>
															</button>
														</div>
													</div>
												</form>
										</div>

										<div class="row rez-calc" id="results"></div>
									</div>
								<? }?>

								<div class="tab-content">
									<? if($_item['price'] > 0){?>
										<div class="tab-pane active" id="rezervare"></div>
									<? }?>

									<? if(trim($_item['description']) != "" || trim($_item['localization']) != "" || trim($_item['room_info']) != "" || trim($_item['hotel_info']) != "" || trim($_item['kids_info']) != "" || trim($_item['beach_info']) != "" || trim($_item['meal_info']) != "" || trim($_item['other_info']) != "" || ($_item['latitude'] != "" && $_item['latitude'] != "0")){?>
										<div class="tab-pane print-visible <? if(!$_item['price'] > 0){?>active<? }?>" id="descriere">
										    <div class="col-md-12 print-visible"><p class="tab-title">» Descriere</p></div>
											<ul class="list-unstyled item-tabs__list--space">
												<? if(trim($_item['description']) != ""){?>
													<li>
														<p><strong class="print-hidden">Descriere</strong></p>
														<?=$_item['description']?>
													</li>
												<? }?>
												<? if(trim($_item['localization']) != ""){?>
													<li>
														<p><strong>Localizare</strong></p>
														<?=$_item['localization']?>
													</li>
												<? }?>
												<? if(trim($_item['hotel_info']) != ""){?>
													<li>
														<p><strong>Facilitati hotel</strong></p>
														<?=$_item['hotel_info']?>
													</li>
												<? }?>
												<? if(trim($_item['room_info']) != ""){?>
													<li>
														<p><strong>Dotari camere</strong></p>
														<?=$_item['room_info']?>
													</li>
												<? }?>
												<? if(trim($_item['kids_info']) != ""){?>
													<li>
														<p><strong>Facilitati copii</strong></p>
														<?=$_item['kids_info']?>
													</li>
												<? }?>
												<? if(trim($_item['beach_info']) != ""){?>
													<li>
														<p><strong>Plaja</strong></p>
														<?=$_item['beach_info']?>
													</li>
												<? }?>
												<? if(trim($_item['meal_info']) != ""){?>
													<li>
														<p><strong>Tip masa</strong></p>
														<?=$_item['meal_info']?>
													</li>
												<? }?>
												<? if(trim($_item['other_info']) != ""){?>
													<li>
														<p><strong>Alte informatii</strong></p>
														<?=$_item['other_info']?>
													</li>
												<? }?>
												<? if(trim($_item['website']) != ""){?>
													<li>
														<p><strong>Website</strong></p>
														<a href="<?=addhttp($_item['website'])?>" target="_blank"><?=$_item['website']?></a>
													</li>
												<? }?>
											</ul>
											<? if($_item['latitude'] != "" && $_item['latitude'] != "0"){?>
												<hr class="hr--blue print-hidden">
												<p class="print-hidden"><strong>Localizare hotel</strong></p>
												<div class="map-responsive">
													<div class="map-content" id="map_modal" style="height: 250px; width: 100%;"></div>
													<script>
														$(document).ready(function(){
															$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
															  	var target = $(e.target).attr("href");
																if(target == "#descriere"){
																	initMap(<?=(float)$_item['latitude']?>, <?=(float)$_item['longitude']?>, '<?=$_item['title'] ?>', '<?=$_item['url']?>', '<?=$_item['images'][0]['medium'] ?>');
																}
															});
														});
													</script>
												</div>
											<? }?>

										</div>
									<? }?>

									<? if($_zone['description'] != ""){?>
										<div class="tab-pane print-visible" id="destinatie">
		                                    <div class="col-md-12 print-visible"><p class="tab-title">Destinatie</p></div>
											<?=$_zone['description']?>

										</div>
									<? }?>

									<? if($_zone['excursion'] != ""){?>
										<div class="tab-pane print-visible" id="excursion">
		                                    <div class="col-md-12 print-visible"><p class="tab-title">Excursii optionale</p></div>
											<?=$_zone['excursion']?>

										</div>
									<? }?>

									<? if($_zone_text['included_services'] != ""){?>
										<div class="tab-pane print-visible" id="servicii">
										    <div class="col-md-12 print-visible"><p class="tab-title">Servicii incluse/neincluse</p></div>
										    <?=$_zone_text['included_services']?>

										</div>
									<? }?>

									<? if($_zone_text['financial_terms'] != ""){?>
										<div class="tab-pane print-visible" id="financiar">
										    <div class="col-md-12 print-visible"><p class="tab-title">Conditii financiare</p></div>
						                    <?=$_zone_text['financial_terms']?>

						                </div>
					                <? }?>

					                <? if($_item['senior_info'] != ""){?>
										<div class="tab-pane print-visible" id="senior">
										    <div class="col-md-12 print-visible"><p class="tab-title">Turism social/seniori</p></div>
						                    <?=$_item['senior_info']?>

						                </div>
					                <? }?>

					                <? if($_zone_text['info_usefull'] != ""){?>
										<div class="tab-pane print-visible" id="info">
										    <div class="col-md-12 print-visible"><p class="tab-title">Informatii utile</p></div>
						                    <?=$_zone_text['info_usefull']?>

						                </div>
					                <? }?>

					                <? if($_zone_text['transfers'] != ""){?>
						                <div class="tab-pane print-visible" id="transferuri">
						                	<div class="col-md-12 print-visible"><p class="tab-title">Transferuri</p></div>
						                    <?=$_zone_text['transfers']?>

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

	<? if($flights_departure && $flights_return){?>
		<!-- <div class="container-fluid inner-banner charter"> -->
		<div class="container-fluid inner-banner inner-banner__charter back-image-form inner-page-info">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="container">
							<? if($flights_departure && $flights_return){?>
								<div class="col-xs-12 main-filters main-filters__charter">
									<div class="row">
										<div class="col-md-6">
											<p class="main-filters__charter__title">
												<i class="sprite sprite-world-plane-white"></i>
												<strong><?=$_offer_type." ".$_title?></strong><br>
												<span class="text-uppercase">ORAR INFORMATIV DE ZBOR</span>
												<span>(ore locale)</span>
											</p>
										</div>
									</div>
									<div class="row main-filters__charter--bg">
										<? if(count($flights_departure) > 2){ ?>
											<div class="swiper-container swiper-chartere-head">
												<div class="swiper-wrapper">
										<? } ?>
										<?  for($i=0; $i<count($flights_departure); $i++){ ?>

											<div class="col-ms-10 col-ms-offset-1 col-md-<?=max(6, 1/count($flights_departure)*12)?> col-md-offset-0 <?= count($flights_departure) > 2 ? 'swiper-slide': '' ?>">
												<p class="main-filters__charter__sub">
													Plecari <span class="text-uppercase"><?=$_week_days_mysql[$flights_departure[$i]['departure_day']]?></span>
													<? if($flights_departure[$i]['min_departure'] != $flights_departure[$i]['max_departure']){?>
														in perioada: <?=date("d.m.Y", strtotime($flights_departure[$i]['min_departure']))?> - <?=date("d.m.Y", strtotime($flights_departure[$i]['max_departure']))?>
													<? }else{ ?>
														<?=date("d.m.Y", strtotime($flights_departure[$i]['min_departure']))?>
													<? }?>
													<!--
													<img class="main-filters__charter__airline__img" src="http://placehold.it/70x25/000000/ffffff" alt="...">
													-->
												</p>
												<ul class="list-unstyled">
													<li class="main-filters__charter__item">
														<ul class="list-unstyled list-inline">
															<li><i class="sprite sprite-arrow-blue-right"></i></li>
															<li><?=$_city_from['title']//$flights_departure[$i]['departure_city']?></li>
															<li><?=date("H:i", strtotime($flights_departure[$i]['departure_time'])) != "00:00" ? date("H:i", strtotime($flights_departure[$i]['departure_time'])) : "00:00"?> – <?=$flights_departure[$i]['arrival_city']//$_title_destination?></li>
															<li><?=date("H:i", strtotime($flights_departure[$i]['arrival_time'])) != "00:00" ? date("H:i", strtotime($flights_departure[$i]['arrival_time'])) : "00:00"?></li>
															<li>| <?=$flights_departure[$i]['flight_company']?> <?=trim($flights_departure[$i]['flight_number']) != "" ? " - ".$flights_departure[$i]['flight_number'] : ""?></li>
														</ul>
													</li>
													<li class="main-filters__charter__item">
														<ul class="list-unstyled list-inline">
															<li><i class="sprite sprite-arrow-blue-left"></i></li>
															<li><?=$flights_return[$i]['departure_city']//$_title_destination?></li>
															<li><?=date("H:i", strtotime($flights_return[$i]['departure_time'])) != "00:00" ? date("H:i", strtotime($flights_return[$i]['departure_time'])) : "00:00"?> – <?=$_city_from['title']//$flights_return[$i]['arrival_city']?></li>
															<li><?=date("H:i", strtotime($flights_return[$i]['arrival_time'])) != "00:00" ? date("H:i", strtotime($flights_return[$i]['arrival_time'])) : "00:00"?></li>
															<li>| <?=$flights_return[$i]['flight_company']?> <?=trim($flights_return[$i]['flight_number']) != "" ? " - ".$flights_return[$i]['flight_number'] : ""?></li>
														</ul>
													</li>
												</ul>
											</div>
										<? }?>

										<? if(count($flights_departure) > 2){ ?>
												</div>
												<!-- Add Pagination -->
										        <div class="swiper-pagination hidden-lg  swiper-pagination-bullets"></div>
										        <!-- Add Arrows -->
												<div class="swiper-button-prev hidden-sm hidden-xs"><i class="sprite sprite-swipe-left-blue-white"></i></div>
												<div class="swiper-button-next hidden-sm hidden-xs"><i class="sprite sprite-swipe-right-blue-white"></i></div>
											</div>
										<? } ?>

									</div>
								</div>
							<? }else{ ?>
								<div class="row">
									<?php //include $_theme_path.'common/forms/home_forms.php'; ?>
								</div>
							<? }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<? }?>

	<?/*
		<? include $_theme_path.'common/boxes/box_testimonials.php' ?>
		<? include $_theme_path.'common/boxes/box_new_offers.php' ?>
	*/?>
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
		        	'id': '<?=$_item['id_hotel']?>',
					'name': '<?=$_item['title']?>',
		        	'price': '<?=$_item['price']?>',
					"brand": "<?=$_item['city']['title']?>",
		        	'category': 'Chartere<?=$_city_from ? " din ".$_city_from['title'] : ""?>',
		    	}]
		    }
	  	}
	});

	gtag('event', 'page_view', {
		'send_to': 'AW-1009319514',
	   	'dynx_itemid': 'CH<?=$_item['id_hotel']?>',
	   	'dynx_itemid2': '<?=$_item['title']?>',
	   	'dynx_pagetype': 'offerdetail',
		'dynx_totalvalue': '<?=$_item['price']?>'
  	});

	gtag('event', 'view_item', {
		'send_to': 'AW-1009319514',
		'items': [{
			'destination': 'CH<?=$_item['id_hotel']?>',
			'origin': '<?=$_city_from ? $_city_from['id_city'] : "14997"?>',
			'google_business_vertical': 'travel'
		}]
	});

	fbq('track', 'ViewContent', {
	    value: <?=$_item['price']?>,
	    currency: 'EUR',
	    content_ids: 'CH<?=$_item['id_hotel']?>-<?=$_city_from ? $_city_from['id_city'] : "14997"?>',
	    content_type: 'product',
		content_name: '<?=$_item['title']?>',
		content_category: 'Chartere<?=$_city_from ? " din ".$_city_from['title'] : ""?>'
  	});

});
</script>

<script type="text/javascript">$(function() { swiper_item(7); });</script>

<script>
$(document).ready(function(){

	var $dates_from = [];
	var $dates_to = [];
	var selectedChekinDate = '';

	<? $dates_from = array();?>
	<? foreach($_item['periods'] as $date){?>
		<? if(!in_array($date['date_from'], $dates_from)){?>
			$dates_from.push('<?=$date['date_from']?>');
			$dates_to['<?=$date['date_from']?>'] = [];
		<? $dates_from[] = $date['date_from']; }?>
		$dates_to['<?=$date['date_from']?>'].push('<?=$date['date_to']?>');
	<? }?>

	$('body').on('click', '.rez-calc__item__btn', function(e){
		e.preventDefault();

		dataLayer.push({
			'event': 'addToCart',
			"ecommerce": {
				"currencyCode": "EUR",
				'add': {
			      	'products': [{
			        	'id': '<?=$_item['id_hotel']?>',
						'name': '<?=$_item['title']?>',
			        	'price': '<?=$_item['price']?>',
						"brand": "<?=$_item['city']['title']?>",
			        	'category': 'Chartere<?=$_city_from ? " din ".$_city_from['title'] : ""?>',
						'quantity': 1
			    	}]
			    }
		  	}
		});

		gtag('event', 'add_to_cart', {
			'send_to': 'AW-1009319514',
			'items': [{
				'origin': '<?=$_city_from ? $_city_from['id_city'] : "14997"?>',
				'destination': 'CH<?=$_item['id_hotel']?>',
	  			'google_business_vertical': 'travel'
	    	}]
		});

		fbq('track', 'AddToCart', {
		    value: <?=$_item['price']?>,
		    currency: 'EUR',
		    content_ids: 'CH<?=$_item['id_hotel']?>-<?=$_city_from ? $_city_from['id_city'] : "14997"?>',
		    content_type: 'product',
			content_name: '<?=$_item['title']?>',
	  	});

		$(this).parent().submit();
	});

	$datePicker_from = $("#item-t-individual-check-in-restrict").datepicker({
        minDate: "+1d",
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
    	beforeShowDay: availableDays,
    	minDate: '<?=date("d.m.Y", strtotime($_item['periods'][0]['date_from']))?>',
        onSelect: trigerNextCalendarMinDateRestricted
    });

    $("#item-t-individual-check-out-restrict").datepicker({
        changeMonth: true,
        dateFormat: 'dd.mm.yy',
        <? if(!$_date_to){?>
        disabled: true,
        <? }?>
        firstDay: 1,
        numberOfMonths: 1
    });

	$('#calculate').click(function(e){
		e.preventDefault();

		$('#results').html('');

		$('#item-t-individual-check-in-restrict').parent().find('span.error').html('');
		$('#item-t-individual-check-out-restrict').parent().find('span.error').html('');

		for(i=1; i<=3; i++){
			for(j=1; j<=3; j++){
				$('label[for=item-t-individual-copii-varste'+i+'-'+j+'] span.error').html('');
			}
		}

		$check_in = $('#item-t-individual-check-in-restrict').val();
		if($check_in == ''){
	    	$('#item-t-individual-check-in-restrict').parent().find('span.error').html('Alegeti o data de check in');
	    	return false;
	    }

	    $check_out = $('#item-t-individual-check-out-restrict').val();
		if($check_out == ''){
	    	$('#item-t-individual-check-out-restrict').parent().find('span.error').html('Alegeti o data de check out');
	    	return false;
	    }

	    $nr_rooms = $('#item-t-individual-camere').val();
	    $rooms_info = [];
	    for(i=1; i<=$nr_rooms; i++){
	    	$room_tmp = {};

		    $room_tmp.adult = $('#item-t-individual-adulti'+i).val();
		    $room_tmp.child = $('#item-t-individual-copii'+i).val();

			if($room_tmp.child > 0){
				for(j=1; j<=$room_tmp.child; j++){
					if($('#item-t-individual-copii-varste'+i+'-'+j).val() == ""){
						$('label[for=item-t-individual-copii-varste'+i+'-'+j+'] span.error').html('Alegeti varsta');
				    	return false;
					}
				}
			}

		    $room_tmp.child_age = [];
		    for(j=1; j<=3; j++){
		    	$room_tmp.child_age.push($('#item-t-individual-copii-varste'+i+'-'+j).val());
		    }

		    $rooms_info.push($room_tmp);
	    }

	    var $this = $(this);
	    $this.find('span').addClass('hidden');
	    $this.find('i').removeClass('hidden');

		$.ajax({
			url: $_base + 'ajax/item/charter.php',
			method: 'post',
			data: {
				id_hotel: <?=$_item['id_hotel']?>,
				id_city_from: <?=$_city_from['id_city']?>,
				check_in: $check_in,
				check_out: $check_out,
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

		return false;
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

	function availableDays(date) {
		dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

		//console.log(dmy+' : '+($.inArray(dmy, $dates_from)));
		if ($.inArray(dmy, $dates_from) != -1) {
	    	return [true, "","Available"];
	  	} else {
	    	return [false,"","unAvailable"];
	  	}
	}

	function availableDaysReturn(date) {
		dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

		tmp = selectedChekinDate.split('.');
		new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

		//console.log(dmy+' : '+($.inArray(dmy, $dates_to[new_dmy])));
		if ($.inArray(dmy, $dates_to[new_dmy]) != -1) {
	    	return [true, "","Available"];
	  	} else {
	    	return [false,"","unAvailable"];
	  	}
	}

	function trigerNextCalendarMinDateRestricted(selectedDate){
		$("#item-t-individual-check-out-restrict").datepicker("option", "disabled", false);
		$('#item-t-individual-check-out-restrict').val('');

    	selectedChekinDate = selectedDate;

    	tmp = selectedChekinDate.split('.');
		new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

		selectedChekoutDate = $dates_to[new_dmy];

		tmp = selectedChekoutDate[0].split('-');
		new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

    	$('#item-t-individual-check-out-restrict').datepicker("option", "minDate", new_date);
    	$('#item-t-individual-check-out-restrict').datepicker("option", "beforeShowDay", availableDaysReturn);
    }
});
</script>
