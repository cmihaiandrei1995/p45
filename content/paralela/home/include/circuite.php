<div class="onebluesection circuits-onesection">
	<? if($_box_circuits || $_slider_circuits){?>
	<div class="container-fluid container__zebra  <? if(!$_box_mobile[10] && !$_box_mobile[11]){?>hidden-xs<? }?>">
		<div class="row">
			<div class="col-xs-12">
				<div class="container">
					<div class="row oferte__title__wrapper">
						<div class="col-xs-12 hr-title">
							<h3 class="oferte__title text--blue hr-title__text"><?= $_text_circuite['section_title'] ?>
								<!-- <i class="sprite sprite-oferte-circuite"></i> -->
							</h3>

							<div class="row">
								<div class="col-xs-12 col-md-8 col-md-offset-2">
									<h4 class="hr-subtitle">
										<?= $_text_circuite['description'] ?>
									</h4>
								</div>
							</div>
						</div>
					</div>
					<?/*
						<? if($_slider_circuits){?>
					<div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
						<div class="col-xs-12">
							<div class="swiper-circuit-wrapper">
								<div class="swiper-container swiper-circuit">
									<div class="swiper-wrapper">
										<?php foreach ($_slider_circuits as $item) { ?>
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
														<span class="swiper-circuit__pret__text">/ persoana</span>
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
									<? if(count($_slider_circuits) > 1){?>
									<div class="swiper-pagination"></div>
									<? }?>
								</div>
								<? if(count($_slider_circuits) > 1){?>
								<div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
								<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
								<? }?>
							</div>
						</div>
					</div>
					<? }?>
					*/?>

					<!-- listare noua circuite -->
					<? if($_circuit_continents_homepage) {?>
					<div class="newhome-circuit-section">
						<div class="row">
							<div class="col-md-4 col-md-push-4 col-lg-6 col-lg-push-3">
								<div class="newhome-circuit-section-intro">
									<?=$_extra_text[$id][1]['description'];?>
								</div>
							</div>

							<? foreach($_circuit_continents_homepage as $k => $item) {?>
								
							<? if($k == 0) {?>
							<div class="col-sm-6 col-sm-6 col-md-4 col-md-pull-4 col-lg-3 col-lg-pull-6">
								<? }else{?>
								<div class="col-sm-6 col-sm-6 col-md-4 col-lg-3">
									<? }?>
									<a class="chartere__item__link oneitemlink" href="<?=$item['url'];?>">
										<div class="blue-cover"></div>
										<img class="chartere__item__img object-fit lazy" data-original="<?= $item['images'][0]['thumb']; ?>" alt="<?= $item['title'] ?>">
										<div class="chartere__item__title">
											<h4 class="chartere__item__title__text"><strong><?= $item['title']; ?></strong></h4>
										</div>
										<div class="chartere__item__count"><?=$item['count'];?> circuite</div>
										<button class="btn btn--green items__item__btn">vezi toate circuitele »</button>
									</a>
								</div>

								<? }?>
							</div>
						</div>
						<? }?>
						<!-- end listare noua circuite -->
						
						<!-- mai multe circuite -->
						<div class="more-listing">

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
							<? if($_box_circuits) {?>
							<div class="row">
								<? foreach($_box_circuits as $item) {?>
								<div class="col-ms-6 col-sm-6 col-lg-3">
									<a href="<?= $item['url']; ?>" class="more-listing__item">
										<div class="more-listing__item__pict">
											<? if($item['special_text']) {?>
											<div class="more-listing__special"><?= $item['special_text']; ?></div>
											<? }?>
											<img class="" data-original="" alt="" src="<?= $item['images'][0]['small']; ?>">
										</div>
										<div class="more-listing__content last-minute__list__item__link">
											<div class="row">
												<div class="col-xs-12">
													<p class="last-minute__list__item__title">
														<strong><?= $item['title']; ?></strong>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-7">
													<span class="last-minute__list__item__details text--grey">
														<?= $item['cities'] ? implode('&nbsp;•&nbsp;', $item['cities']) : ''; ?><br>
														<!-- [12.11, 30.11.2008]<br>
														[8 zile / 7 nopti] -->
														<? if(!empty($item['logo_img'])) {?><img src="<?=$item['logo_img'];?>" alt=""><? }?>
													</span>
												</div>
												<div class="col-xs-5 last-minute__list__item__second-block">
													<p class="last-minute__list__item__pret text-right">
														<?= $item['discount_text'] ?? ''; ?>
														<!-- <del class="last-minute__list__item__pret__old">[650&euro;]</del><br> -->
														<span class="last-minute__list__item__pret__actual"><?= str_replace(" ", "", $item['discount']) ?? ''; ?></span>
													</p>
												</div>
											</div>
											<div class="row">
												<div class="col-xs-12 text-center sink-btn">
													<button class="btn btn--green items__item__btn">Rezerva acum »</button>
												</div>
											</div>
										</div>
									</a>
								</div>
								<? }?>
							</div>
							<? }?>
						</div>
						<!-- end mai multe circuite -->

						<? /*
						<? if($_box_circuits){?>
						<div class="row chartere <? if(!$_box_mobile[10]){?>hidden-xs<? }?>">
							<?php foreach ($_box_circuits as $item) { ?>
								<? if($_box_settings[2]['nr_items'] == 3){?>
								<div class="col-xs-12 col-ms-6 col-sm-4 chartere__item chartere__item--large">
									<? }elseif($_box_settings[2]['nr_items'] == 4){?>
									<div class="col-xs-12 col-ms-6 col-sm-6 col-md-3 chartere__item">
										<? }?>
										<a class="chartere__item__link hover-opacity" href="<?= $item['url'] ?>">
											<img class="chartere__item__img object-fit lazy" data-original="<?= $item['images'][0]['small'] ?>" alt="<?= $item['title'] ?>">
											<? if($item['offer_text'] != ""){?>
											<div class="chartere__item__top">
												<span class="chartere__item__top__text__early <? if(!$item['new'] && $item['discount_text'] == "" && $item['special_text'] == ""){?>full-width<? }?>"><?= str_replace(" ", "<br>", trim($item['offer_text'])) ?></span>
											</div>
											<? }?>
											<? if($item['discount_text'] != ""){?>
											<div class="chartere__item__procent__wrapper">
												<span class="chartere__item__procent__text"><?= $item['discount_text'] ?></span>
												<span class="chartere__item__procent"><strong><?= $item['discount'] ?></strong></span>
											</div>
											<? }?>
											<? if($item['new']){?>
											<div class="chartere__item__extra chartere__item__extra--green">
												<span class="chartere__item__extra__nou text-uppercase text--white block text-center"><strong>Nou!</strong></span>
											</div>
											<? }?>
											<? if($item['special_text'] != ""){?>
											<div class="chartere__item__extra chartere__item__extra--yellow">
												<span class="chartere__item__extra__unic text-uppercase text--blue block text-center"><?= $item['special_text'] ?></span>
											</div>
											<? }?>
											<? if($item['cities']){?>
											<div class="chartere__item__list__wrapper chartere__item__list__wrapper--height text--white">
												<p class="chartere__item__list__title">Plecari din:</p>
												<ul class="chartere__item__list list-unstyled">
													<? foreach($item['cities'] as $city){?>
													<li class="chartere__item__list__item">› <?= $city ?></li>
													<? }?>
												</ul>
											</div>
											<? }?>
											<? if($item['logo_img'] != ""){?>
											<div class="chartere__item__airline"><img class="position-center chartere__item__airline__img lazy" data-original="<?= $item['logo_img'] ?>" alt="<?= $item['title'] ?>"></div>
											<? }?>
											<div class="chartere__item__title">
												<h4 class="chartere__item__title__text"><strong><?= $item['title'] ?></strong></h4>
											</div>
										</a>
									</div>
								<?php } ?>
								</div>
								<? }?>
						</div>
						*/ ?>
					</div>
				</div>
			</div>
		</div>
		<? }?>
	</div>