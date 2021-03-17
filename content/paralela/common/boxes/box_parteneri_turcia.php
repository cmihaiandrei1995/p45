<?/*
<div class="container-fluid partners-turkey-wrapper ">
	<div class="row">
	      <div class="container">
	          <div class="row">

	          	<div class="col-xs-12 hr-title st-hr-title">
					<hr class="hr-title__hr">
					<h3 class="hr-title__text text-uppercase text--blue">Partenerii nostri din Turcia</h3>
				</div>

	          	<div class="col-md-12 text-center">
	          		<img src="<?= $_base ?>static/img/partners-turkey/gural.jpg" alt="Gural" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/rixos.jpg" alt="Rixos" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/shoerwood.jpg" alt="Shoerwood" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/calista.jpg" alt="Calista" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/sueno.jpg" alt="Sueno" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/cornelia.jpg" alt="Cornelia" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/1C-hotels.jpg" alt="1C-hotels" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/kaya.jpg" alt="Kaya" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/pine-beach.jpg" alt="Pine Beach" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/justiniano.jpg" alt="Justiniano" />
	          		<img src="<?= $_base ?>static/img/partners-turkey/vonresort.jpg" alt="Vonresort" />
	          	</div>

	          	<div class="col-xs-12 hr-title nd-hr-title">
					<hr class="hr-title__hr">
					<h3 class="hr-title__text text-uppercase text--blue"></h3>
				</div>
			 </div>
	      </div>
	</div>
</div>
*/ ?>

<?
list($_hotels_footer, $count_hotels_footer) = get_posts(array(
	'table' => 'hotel_footer',
	'images' => 1,
	'limit' => -1
));
foreach($_hotels_footer as $k => &$item){
	if($item['id_hotel']){
		$hotel = get_hotel_by_id($item['id_hotel']);
		$hotel['images'] = get_images('hotel', $item['id_hotel']);
		$hotel = hotel_prepare_info($hotel);
        $hotel = hotel_prepare_charter_basic_info($hotel, $hotel['zone'], $_bucuresti);

		if($hotel){
			$item['title'] = $hotel['title'];
			$item['images'] = $hotel['images'];
			$item['zone'] = $hotel['zone']['title'];
			$item['url'] = $hotel['url'];
			$item['show_icon'] = $hotel['video_id'] != "" ? true : false;
		}
	}

	if($item['title'] == ""){
		unset($_hotels_footer[$k]);
	}
	unset($item);
}
?>

<div class="onebluesection">
	<? if($_hotels_footer){?>
		<div class="container-fluid container__zebra hide-print">
			<div class="row">
				<div class="col-xs-12">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 hr-title">
								<h3 class="hr-title__text text--blue text-center">Hoteluri recomandate din Antalya</h3>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="swiper-nav-outsite swiper-noi-oferte swiper-oferte-recomandate swiper-hoteluri-recomandate-wrapper">
									<div class="swiper-container">
										<div class="swiper-wrapper">
											<? foreach($_hotels_footer as $item){?>
												<div class="swiper-slide position-relative">
													<a class="hoteluri-recomandate-item" href="<?=$item['url']?>">
														<? if($item['show_icon']){?>
															<span class="play"></span>
														<? }?>
														<img class="swiper-noi-oferte__img object-fit" src="<?=$item['images'][0]['small']?>" alt="<?=$item['title']?>">

														<div class="swiper-noi-oferte__title text-center">
															<h4>
																<strong><?=$item['title']?></strong><br>
																<span><?=$item['zone']?></span>
															</h4>
															<button class="btn btn--green items__item__btn">vezi oferta »</button>
														</div>
													</a>
												</div>
											<? }?>
										</div>
									</div>
									<?/*
									<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-green-white"></i></div>
									<div class="swiper-button-next"><i class="sprite sprite-swipe-right-green-white"></i></div>
									*/?>
									<div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
									<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<? }?>
</div>
