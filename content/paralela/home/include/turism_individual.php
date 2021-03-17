<div class="onesection">
	<? if($_box_tourism_individual || $_slider_tourism_individual){?>
	<div class="container-fluid <? if(!$_box_mobile[12] && !$_box_mobile[22]){?>hidden-xs<? }?>">
		<div class="row">
			<div class="container">
				<div class="row oferte__title__wrapper">
					<div class="col-xs-12 hr-title">
						<h3 class="oferte__title text--blue hr-title__text"><?= $_text_turism_individual['section_title'] ?>
							<!-- <i class="sprite sprite-oferte-car"></i> -->
						</h3>

						<div class="row">
							<div class="col-xs-12 col-lg-8 col-lg-offset-2">
								<h4 class="hr-subtitle">
									<?= $_text_turism_individual['description'] ?>
								</h4>
							</div>
						</div>
					</div>
				</div>

				<? if($_slider_tourism_individual){?>
				<div class="row <? if(!$_box_mobile[22]){?>hidden-xs<? }?>">
					<div class="col-xs-12">
						<div class="swiper-container swiper-circuit">
							<div class="swiper-wrapper">
								<?php foreach ($_slider_tourism_individual as $item) { ?>
									<div class="swiper-slide">
										<a href="<?= $item['url'] ?>">
											<img class="swiper-circuit__img img-responsive swiper-lazy" data-src="<?= $item['images'][0]['big'] ?>" alt="<?= $item['title'] ?>" src="<?= urle('img/blank.gif', 'static') ?>">
										</a>
										<? if($item['discount'] != ""){?>
										<div class="swiper-circuit__pret__wrapper">
											<span class="swiper-circuit__pret__text text--orange" style="<?= $item['discount_text'] == '' ? 'height:13px; display:block;' : '' ?>"><?= $item['discount_text'] ?></span>
											<p class="swiper-circuit__pret">
												<span class="swiper-circuit__pret__number text--orange"><?= $item['discount'] ?></span>
												<!--
															<span class="swiper-circuit__pret__number__sub">/ persoana</span>
															-->
											</p>
										</div>
										<? }?>
										<div class="swiper-circuit__detalii text--white">
											<h4 class="swiper-circuit__detalii__title">
												<a class="text--white hover-opacity" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
												<? if($item['subtitle'] != ""){?>
												<small><?= $item['subtitle'] ?></small>
												<? }?>
											</h4>
											<? if($item['info_departure'] != ""){?>
											<i class="sprite sprite-detalii-avion pull-left"></i>
											<p class="swiper-circuit__detalii__plecare">
												<span class="text-uppercase"><?= $item['info_departure'] ?></span>
											</p>
											<? }?>
											<div class="swiper-circuit__detalii__wrapper">
												<?= $item['description'] ?>
											</div>
											<p class="text-right"><a href="<?= $item['url'] ?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">vezi mai mult</a></p>
										</div>
										<div class="swiper-lazy-preloader"></div>
									</div>
								<?php } ?>
							</div>
							<? if(count($_slider_tourism_individual) > 1){?>
							<div class="swiper-pagination"></div>
							<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue"></i> <i class="sprite sprite-swipe-left-white-l hidden-xs"></i></div>
							<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue"></i> <i class="sprite sprite-swipe-right-white-l hidden-xs"></i></div>
							<? }?>
						</div>
					</div>
				</div>
				<? }?>

				<div class="newhome-turism-individual-section">
					<? if($_box_tourism_individual){?>
					<div class="row chartere <? if(!$_box_mobile[12]){?>hidden-xs<? }?>">
						<? foreach($_box_tourism_individual as $item){?>
						<? if($_box_settings[3]['nr_items'] == 3){?>
						<div class="col-xs-12 col-ms-6 col-sm-4 chartere__item chartere__item--large">
							<? }elseif($_box_settings[3]['nr_items'] == 4){?>
							<div class="col-ms-6 col-sm-6 col-md-3 chartere__item">
								<? }?>
								<a class="chartere__item__link" href="<?= $item['url'] ?>">
									<img class="chartere__item__img lazy" data-original="" alt="<?= $item['title'] ?>" src="<?= $item['images'][0]['small']; ?>">
									<?/*<img class="chartere__item__img lazy" data-original="<?= $item['images'][0]['small'] ?>" alt="<?= $item['title'] ?>">*/?>

									<?/*
											<? if($item['discount_text'] != ""){?>
									<div class="chartere__item__procent__wrapper">
										<span class="chartere__item__procent__text"><?= $item['discount_text'] ?></span>
										<span class="chartere__item__procent"><strong><?= $item['discount'] ?></strong></span>
									</div>
									<? }?>
									*/ ?>
									<div class="chartere__item__content">
										<? if(!empty($item['offer_text'])) {?>
										<div class="chartere__item__top">
											<?= str_replace(" ", " ", trim($item['offer_text'])) ?>
										</div>
										<? }?>
										<div class="chartere__item__title">
											<div class="row">
												<div class="col-xs-6">
													<h4 class="chartere__item__title__text"><strong><?= $item['title'] ?></strong></h4>
												</div>
												<div class="col-xs-6 text-right">
													<? if(!empty($item['discount_text'])) {?>
													<div class="chartere__item__discount_text">
														<!-- aici discount -->
														<?= $item['discount_text'] ?> <span class="chartere__item__title__list__item__number text--orange"><?= $item['discount'] ?></span>
														<!-- end aici discount -->
													</div>
													<? }?>
												</div>
											</div>
										</div>
										<ul class="chartere__item__title__list list-unstyled">
											<? foreach($item['cities'] as  $k_city => $city){ if($k_city == 5) break; ?>
											<li class="chartere__item__title__list__item"><i class="chartere-list-item-arrow"></i><?= $city['title'] ?></li>
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
										<div class="text-center">
											<button class="btn btn--green items__item__btn">vezi toate ofertele »</button>
										</div>
									</div>
								</a>
							</div>
							<? }?>
						</div>
						<? }?>
					</div>
				</div>
			</div>
		</div>
		<? }?>
	</div>