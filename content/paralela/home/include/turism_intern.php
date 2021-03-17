<div class="onebluesection">
	<? if($_box_tourism_intern_city_tag || $_box_tourism_intern_hotel_tag || $_box_tourism_intern_hotel_group_tag || $_slider_tourism_intern){?>
	<div class="container-fluid container__zebra <? if(!$_box_mobile[13] && !$_box_mobile[23]){?>hidden-xs<? }?>">
		<div class="row">
			<div class="col-xs-12">
				<div class="container">
					<div class="row oferte__title__wrapper">
						<div class="col-xs-12 hr-title">
							<h3 class="oferte__title text--blue hr-title__text"><?= $_text_turism_intern['section_title'] ?>
								<!-- <i class="sprite sprite-oferte-car"></i> -->
							</h3>

							<div class="row">
								<div class="col-xs-12 col-lg-8 col-lg-offset-2">
									<h4 class="hr-subtitle">
										<?= $_text_circuite['description'] ?>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<!-- Slider Mare -->
					<div class="circuits-onesection">
						<? if($_slider_tourism_intern || $_slider_tourism_intern){?>
						<div class="container-fluid container__zebra  <? if(!$_box_mobile[10] && !$_box_mobile[11]){?>hidden-xs<? }?>">
							<div class="row">
								<div class="col-xs-12">
									<div class="container">
										<? if($_slider_tourism_intern){?>
										<div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
											<div class="col-xs-12">
												<div class="swiper-circuit-wrapper swiper-container-experiences-wrapper">
													<div class="swiper-container swiper-circuit swiper-container-experiences">
														<div class="swiper-wrapper">
															<?php foreach ($_slider_tourism_intern as $k => $item) { ?>
																<div class="swiper-slide">
																	<a href="<?= $item['url'] ?>">
																		<img class="swiper-circuit__img img-responsive swiper-lazy" data-src="<?= $item['images'][0]['big'] ?>" alt="<?= $item['title'] ?>" src="<?= urle('img/blank.gif', 'static') ?>">
																	</a>

																	<div class="swiper-circuit__detalii text--white">
																		<? if($item['discount'] != ""){?>
																		<div class="swiper-circuit__pret__wrapper">
																			<span class="swiper-circuit__pret__text" style="<?= $item['discount_text'] == '' ? 'height:13px; display:block;' : '' ?>"><?= $item['discount_text'] ?></span>
																			<p class="swiper-circuit__pret">
																				<span class="swiper-circuit__pret__number"><?= $item['discount'] ?></span><br>
																			</p>
																			<!-- per persoana bulina -->
																			<span class="swiper-circuit__pret__text">persoana</span>
																			<!-- end per persoana bulina -->
																		</div>
																		<? }?>
																		<h4 class="swiper-circuit__detalii__title">
																			<a class="text--white hover-opacity" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
																			<? if($item['subtitle'] != ""){?>
																			<small><?= $item['subtitle'] ?></small>
																			<? }?>
																		</h4>
																		<div class="swiper-circuit-detalii-plecare-wrapper">
																			<? if($item['info_departure'] != ""){?>
																			<p class="swiper-circuit__detalii__plecare">
																				<span class="text-uppercase"><i class="swiper-sprite-detalii-avion"></i> <?= $item['info_departure'] ?></span>
																			</p>
																			<? }?>
																		</div>
																		<div class="swiper-circuit__detalii__wrapper">
																			<?= $item['description'] ?>
																		</div>
																		<p><a href="<?= $item['url'] ?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">Vezi mai mult »</a></p>
																	</div>
																	<div class="swiper-lazy-preloader"></div>
																</div>
															<?php } ?>
														</div>
														<? if(count($_slider_tourism_intern) > 1){?>
														<div class="swiper-pagination"></div>
														<? }?>
													</div>
													<? if(count($_slider_tourism_intern) > 1){?>
													<div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
													<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
													<? }?>
												</div>
											</div>
										</div>
										<? }?>
									</div>
								</div>
							</div>
						</div>
						<? }?>
					</div>
											
					<!-- Content Turism Intern -->
					<div class="newhome-turism-intern-section">
						<? if($_box_tourism_intern_city_tag){?>
						<div class="row chartere <? if(!$_box_mobile[13]){?>hidden-xs<? }?>">
							<? foreach($_box_tourism_intern_city_tag as $item){?>
							<? if(count($_box_tourism_intern_city_tag) == 4){?>
							<div class="col-xs-12 col-sm-6 <? if($_box_settings[$id]['nr_items'] == 4) {?>col-md-3<? }else{?>col-md-4<? }?> chartere__item">
								<? }else{ ?>
								<div class="col-xs-12 col-sm-6 <? if($_box_settings[$id]['nr_items'] == 4) {?>col-md-3<? }else{?>col-md-4<? }?> chartere__item chartere__item--large">
									<? }?>
									<a class="chartere__item__link" href="<?= $item['url'] ?>">
										<div class="blue-cover"></div>
										<img class="chartere__item__img lazy" data-original="<?= $item['images'][0]['small'] ?>" alt="<?= $item['title'] ?>" src="https://via.placeholder.com/248x330">
										<div class="chartere__item__content">
											<? if($item['discount_text'] != ""){?>
											<div class="chartere__item__procent__wrapper zit">
												<span class="chartere__item__procent__text"><?= $item['discount_text'] ?></span>
												<span class="chartere__item__procent"><strong><?= $item['discount'] ?></strong></span>
												<span class="swiper-circuit__pret__text">persoana</span>
											</div>
											<? }?>
											<div class="chartere__item__title">
												<h4 class="chartere__item__title__text"><?= $item['title'] ?></h4>
											</div>
											<? if(!empty($item['offer_text'])) {?>
											<div class="chartere__item__top">
												<span class="chartere__item__top__text__early"><?= str_replace(" ", " ", trim($item['offer_text'])) ?></span>
											</div>
											<? }?>
											<div class="chartere__item__title__list__wrapper">
												<ul class="chartere__item__title__list list-unstyled">
													<? foreach($item['cities'] as $k_city => $city){ if($k_city == 5) break; ?>
													<li class="chartere__item__title__list__item text--blue"><i class="chartere-list-item-arrow"></i><?= $city['title'] ?></li>
													<? }?>
													<?/*
															<? if($item['discount_text'] != ""){?>
													<li class="chartere__item__title__list__item text--blue"><?= $item['discount_text'] ?> <span class="chartere__item__title__list__item__number text--orange"><?= $item['discount'] ?></span></li>
													<? }?>
													*/?>
													<!-- link de mai multe -->
													<li class="chartere__item__title__list__item"><i class="chartere-list-item-arrow"></i><span class="chartere__item__title__list__more">mai multe...</span></li>
													<!-- end link de mai multe -->
												</ul>
												<button class="btn btn--green items__item__btn">vezi toate ofertele »</button>
											</div>
										</div>
									</a>
								</div>
								<? }?>
							</div>
							<? }?>
						</div>

						<!-- swiper video -->
						<div class="newhome-turism-intern-swiper-section">
							<? if($_slider_video_tourism_intern){?>
							<div class="hide-print">
								<!-- subtitlu sectiune -->
								<div class="row">
									<div class="col-xs-12 hr-small-title">
										<h3 class="hr-title__text hr-title__more"><?= $_extra_text[$id][0]['section_title']; ?></h3>

										<div class="row">
											<div class="col-xs-12 col-lg-8 col-lg-offset-2">
												<h2 class="hr-subtitle">
													<?= $_extra_text[$id][0]['description']; ?>
												</h2>
											</div>
										</div>
									</div>
								</div>
								<!-- end subtitlu sectiune -->

								<div class="row">
									<div class="container">
										<div class="row">
											<div class="col-xs-12">
												<div class="swiper-oferte-recomandate-wrapper">
													<div class="swiper-nav-outsite swiper-noi-oferte swiper-oferte-recomandate">
														<div class="swiper-container">
															<div class="swiper-wrapper">
																<? foreach($_slider_video_tourism_intern as $item){?>
																<div class="swiper-slide position-relative">
																	<a class="" href="<?= $item['url'] ?>">
																		<? if($item['show_icon']){?>
																		<span class="play"></span>
																		<? }?>
																		<img class="swiper-noi-oferte__img object-fit" src="<?= $item['images'][0]['small'] ?>" alt="<?= $item['title'] ?>">
																		<div class="swiper-noi-oferte__title swiper-noi-oferte__title--blue">
																			<h4>
																				<strong><?= $item['title'] ?></strong><br>
																				<span class="swiper-noi-oferte__zone"><?= $item['zone'] ?> <i class="swiper-noi-oferte__car"></i></span>
																			</h4>
																			<!-- buton si pret pentru turism intern -->
																			<button class="btn btn--green items__item__btn">vezi oferta »</button>
																			<p class="last-minute__list__item__pret">
																				de la
																				<del class="last-minute__list__item__pret__old"><?= $item['price_old'] . $item['currency']; ?></del><br>
																				<span class="last-minute__list__item__pret__actual"><?= $item['price'] . $item['currency']; ?></span>
																			</p>
																			<!-- end buton si pret pentru turism intern -->
																		</div>
																		<?/*
																				<div class="swiper-noi-oferte__title swiper-noi-oferte__title--blue text-center">
																					<h4>
																						<strong><?= $item['title'] ?></strong><br>
																		<span><?= $item['zone'] ?></span>
																		</h4>
																</div>
																*/?>
																</a>
															</div>
															<? }?>
														</div>
													</div>

												</div>
												<div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
												<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<? }?>
					</div>
					<!-- end swiper video -->
				</div>
			</div>
		</div>
	</div>
	<? }?>
</div>