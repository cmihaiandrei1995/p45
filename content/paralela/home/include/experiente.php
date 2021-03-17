<div class="onebluesection circuits-onesection">
	<? if($_box_circuits || $_slider_circuits){?>
	<div class="container-fluid container__zebra  <? if(!$_box_mobile[10] && !$_box_mobile[11]){?>hidden-xs<? }?>">
		<div class="row">
			<div class="col-xs-12">
				<div class="container">
					<div class="row oferte__title__wrapper">
						<div class="col-xs-12 hr-title">
							<h3 class="oferte__title text--blue hr-title__text"><?= $_text_experiente['title']; ?></h3>

							<div class="row">
								<div class="col-xs-12 col-md-8 col-md-offset-2">
									<h4 class="hr-subtitle">
										<?= $_text_experiente['description'] ?>
									</h4>
								</div>
							</div>
						</div>
					</div>

					<? if($_slider_circuits){?>
					<div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
						<div class="col-xs-12">
							<div class="swiper-circuit-wrapper swiper-container-experiences-wrapper">
								<div class="swiper-container swiper-circuit swiper-container-experiences">
									<div class="swiper-wrapper">
										<?php foreach ($_slider_circuits as $k => $item) { ?>
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
														<span class="swiper-circuit__pret__text">persoana/pachet</span>
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
				</div>
			</div>
		</div>
	</div>
	<? }?>
</div>