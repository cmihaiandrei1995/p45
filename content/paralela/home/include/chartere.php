<? if($_box_charters || $_slider_charters){?>
	<div class="container-fluid container__zebra <? if(!$_box_mobile[9] && !$_box_mobile[21]){?>hidden-xs<? }?> chartere-home">
		<div class="row">
			<div class="container">
				<div class="row oferte__title__wrapper">
					<div class="col-xs-12 hr-title">
						<hr class="hr-title__hr">
						<h3 class="oferte__title text--blue hr-title__text"><?=$_text_chartere['section_title']?> <i class="sprite sprite-oferte-chartere"></i></h3>
					</div>
					<? /*
					<div class="col-sm-6 col-md-6 col-md-offset-2">
						<div class="oferte__title__sub"><?=$_text_chartere['description']?></div>
					</div>
					*/ ?>
				</div>

				<? if($_slider_charters){?>
					<div class="row <? if(!$_box_mobile[21]){?>hidden-xs<? }?>">
						<div class="col-xs-12">
							<div class="swiper-container swiper-circuit">
								<div class="swiper-wrapper">
									<?php foreach($_slider_charters as $item) { ?>
										<div class="swiper-slide">
											<a href="<?=$item['url']?>">
												<img class="swiper-circuit__img img-responsive swiper-lazy" data-src="<?=$item['images'][0]['big']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
											</a>
											<? if($item['discount'] != ""){?>
												<div class="swiper-circuit__pret__wrapper">
													<span class="swiper-circuit__pret__text text--orange" style="<?= $item['discount_text'] == '' ? 'height:13px; display:block;' : '' ?>"><?=$item['discount_text']?></span>
													<p class="swiper-circuit__pret">
														<span class="swiper-circuit__pret__number text--orange"><?=$item['discount']?></span>
														<? if($item['from_cazare']){?>
															<span class="swiper-circuit__pret__text text--orange">din cazare</span>
														<? }?>
													</p>
												</div>
											<? }?>
											<div class="swiper-circuit__detalii text--white">
												<h4 class="swiper-circuit__detalii__title">
													<a class="text--white hover-opacity" href="<?=$item['url']?>"><?=$item['title']?></a>
													<? if($item['subtitle'] != ""){?>
														<small><?=$item['subtitle']?></small>
													<? }?>
												</h4>
												<? if($item['info_departure'] != ""){?>
													<i class="sprite sprite-detalii-avion pull-left"></i>
													<p class="swiper-circuit__detalii__plecare">
														<span class="text-uppercase"><?=$item['info_departure']?></span>
													</p>
												<? }?>
												<div class="swiper-circuit__detalii__wrapper">
													<?=$item['description']?>
												</div>
												<p class="text-right"><a href="<?=$item['url']?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">vezi mai mult</a></p>
											</div>
											<div class="swiper-lazy-preloader"></div>
										</div>
									<?php } ?>
								</div>
								<? if(count($_slider_charters) > 1){?>
									<div class="swiper-pagination"></div>
									<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue"></i> <i class="sprite sprite-swipe-left-white-l hidden-xs"></i></div>
									<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue"></i> <i class="sprite sprite-swipe-right-white-l hidden-xs"></i></div>
								<? }?>
							</div>
						</div>
					</div>
				<? }?>

				<? if($_box_charters){?>
					<div class="row chartere <? if(!$_box_mobile[9]){?>hidden-xs<? }?>">
						<?php foreach($_box_charters as $item) { ?>
							<? if($_box_settings[1]['nr_items'] == 3){?>
								<div class="col-xs-12 col-ms-6 col-sm-4 chartere__item chartere__item--large">
							<? }elseif($_box_settings[1]['nr_items'] == 4){?>
								<div class="col-xs-12 col-ms-6 col-sm-4 col-md-3 chartere__item">
							<? }?>
								<a class="chartere__item__link hover-opacity" href="<?=$item['url']?>">
									<img class="chartere__item__img object-fit lazy" data-original="<?=$item['images'][0]['small']?>" alt="<?=$item['title']?>">
									<? if($item['offer_text'] != ""){?>
										<div class="chartere__item__top">
											<span class="chartere__item__top__text__early <? if(!$item['new'] && $item['discount_text'] == "" && $item['special_text'] == ""){?>full-width<? }?>"><?=str_replace(" ", "<br>", trim($item['offer_text']))?></span>
										</div>
									<? }?>
									<? if($item['discount_text'] != ""){?>
										<div class="chartere__item__procent__wrapper">
											<span class="chartere__item__procent__text"><?=$item['discount_text']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<span class="chartere__item__procent" style="line-height:9px;"><strong><?=$item['discount']?></strong></span>
											<? if($item['from_cazare']){?>
												<span class="chartere__item__procent__text">din cazare</span>
											<? }?>
										</div>
									<? }?>
									<? if($item['new']){?>
										<div class="chartere__item__extra chartere__item__extra--green">
											<span class="chartere__item__extra__nou text-uppercase text--white block text-center"><strong>Nou!</strong></span>
										</div>
									<? }?>
									<? if($item['special_text'] != ""){?>
										<div class="chartere__item__extra chartere__item__extra--yellow">
											<span class="chartere__item__extra__unic text-uppercase text--blue block text-center"><?=$item['special_text']?></span>
										</div>
									<? }?>
									<? if($item['cities']){?>
										<div class="chartere__item__list__wrapper chartere__item__list__wrapper--height text--white">
											<p class="chartere__item__list__title">Plecari din:</p>
											<ul class="chartere__item__list list-unstyled">
												<? foreach($item['cities'] as $city){?>
													<li class="chartere__item__list__item">› <?=$city?></li>
												<? }?>
											</ul>
										</div>
									<? }?>
									<? if($item['logo_img'] != ""){?>
										<div class="chartere__item__airline"><img class="position-center chartere__item__airline__img lazy" data-original="<?=$item['logo_img']?>" alt="<?=$item['title']?>"></div>
									<? }?>
									<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong><?=$item['title']?></strong></h4></div>
								</a>
							</div>
						<?php } ?>
					</div>
				<? }?>
			</div>
		</div>
	</div>
<? }?>
