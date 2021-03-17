<?
list($_new_offers, $count_new_offers) = get_posts(array(
	'table' => 'newest_offer',
	'images' => 1,
	'limit' => -1
));
foreach($_new_offers as &$item){
	$cities = db_query('SELECT * FROM newest_offer_city_from WHERE id_newest_offer = ?', $item['id_newest_offer']);

	foreach($cities as $city){
		$item['cities'][] = get_city_by_id($city['id_city']);
	}

	if($item['logo'] != ""){
		$item['airline'] = $_base_uploads."images/".$item['logo_path']."small-".$item['logo'];
	}

	unset($item);
}
?>

<? if($_new_offers){?>
	<div class="container-fluid <? if($_with_bg){?>container__zebra<? }?> hide-print <? if(!$_box_mobile[8] && $_page == "home"){?>hidden-xs<? }?>">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 hr-title">
						<h3 class="hr-title__text text-uppercase text--blue">Cele mai noi oferte</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="swiper-nav-outsite swiper-noi-oferte">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<? foreach($_new_offers as $item){?>
										<div class="swiper-slide position-relative">
											<a class="hover-opacity" href="<?=$item['url']?>">
												<img class="swiper-noi-oferte__img object-fit" src="<?=$item['images'][0]['small']?>" alt="<?=$item['title']?>">
												<? if($item['cities']){?>
												<div class="swiper-noi-oferte__detalii swiper-noi-oferte__detalii--bg text--white">
												<? }else{?>
												<div class="swiper-noi-oferte__detalii">
												<? }?>
													<? if($item['cities']){?>
														<p class="swiper-noi-oferte__detalii__title">Plecari din:</p>
														<ul class="swiper-noi-oferte__detalii__list list-unstyled">
															<? foreach($item['cities'] as $city){?>
																<li class="swiper-noi-oferte__detalii__list__item">› <?=$city['title']?></li>
															<? }?>
														</ul>
													<? }?>
													<? if($item['airline'] != ""){?>
														<div class="swiper-noi-oferte__airline">
															<img class="position-center swiper-noi-oferte__airline__img" src="<?=$item['airline']?>" alt="...">
														</div>
													<? }?>
												</div>
												<? if($item['discount'] != "" && $item['discount_text'] != ""){?>
													<div class="swiper-noi-oferte__discount text-right text--orange">
														<span class="swiper-noi-oferte__discount__number"><strong><?=$item['discount']?></strong></span>
														<span class="swiper-noi-oferte__discount__text text-uppercase text-left"><?=$item['discount_text']?></span>
													</div>
												<? }?>
												<div class="swiper-noi-oferte__title swiper-noi-oferte__title--blue text-uppercase text--white text-center">
													<h4 class="swiper-noi-oferte__title__text"><?=$item['title']?></h4>
												</div>
											</a>
										</div>
									<? }?>
								</div>
							</div>
							<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-green-white"></i></div>
							<div class="swiper-button-next"><i class="sprite sprite-swipe-right-green-white"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<? }?>
