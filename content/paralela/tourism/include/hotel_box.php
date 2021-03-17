<!-- ultimele camere -->
<?/*
<div class="lastrooms-warning">
	<div class="row">
		<div class="col-xs-12">
			<i class="warning-icon"></i>Grabeste-te! ULTIMELE 2 CAMERE
		</div>
	</div>
</div>
*/?>
<!-- end ultimele camere -->

<div class="items__item">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="items__item__title">
				<a href="<?=$item['url']?>" class="clk-<?=$item['id_hotel']?>"><?=$item['title']?></a>
				<? if($item['stars'] > 0){?>
					<span>
						<? for($i=1; $i<=$item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
					</span>
				<? }?>
			</h3>
			<p class="items__item__sub">
				<span><?=$item['city']['title']?></span>
				<? if($item['latitude'] != "" && $item['latitude'] != "0"){?>
					<a class="items__item__harta fancybox fancybox.iframe" href="<?=$item['map_url']?>">
						<i class="sprite sprite-pin"></i> Arata pe harta
					</a>
				<? }?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-ms-4 col-sm-4">
			<div class="swiper-container swiper-items__item">
				<div class="swiper-wrapper">
					<? if($item['video']){?>
						<div class="swiper-slide">
							<a href="<?=$item['url']?>" class="video-icon clk-<?=$item['id_hotel']?>">
								<img class="swiper-items__item__img object-fit swiper-lazy" data-src="<?=$item['video_thumb']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
							</a>
							<div class="swiper-lazy-preloader"></div>
						</div>
					<? }?>
					<? foreach($item['images'] as $image){?>
						<div class="swiper-slide">
							<a href="<?=$item['url']?>" class="clk-<?=$item['id_hotel']?>">
								<img class="swiper-items__item__img object-fit swiper-lazy" data-src="<?=$image['thumb']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
							</a>
							<div class="swiper-lazy-preloader"></div>
						</div>
					<? }?>
				</div>
				<? if(count($item['images']) > 1){?>
					<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white"></i></div>
					<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white"></i></div>
				<? }?>
			</div>
		</div>
		<div class="col-ms-8 col-sm-8">
			<div class="row">
				<div class="col-ms-8 col-sm-8 items__item__wrapper">
					<ul class="items__item__list list-unstyled list-inline">
						<? if($item['parking']){?>
							<li data-toggle="tooltip" title="Parcare"><i class="sprite sprite-facility-parking"></i></li>
						<? }?>
						<? if($item['kids_hotel']){?>
							<li data-toggle="tooltip" title="Hotel pentru copii"><i class="sprite sprite-kids"></i></li>
						<? }?>
						<? if($item['spa']){?>
							<li data-toggle="tooltip" title="Spa"><i class="sprite sprite-facility-spa"></i></li>
						<? }?>
						<? if($item['fitness']){?>
							<li data-toggle="tooltip" title="Sala fitness"><i class="sprite sprite-facility-gym"></i></li>
						<? }?>
						<!--
						<? if($item['pets']){?>
							<li data-toggle="tooltip" title="Accepta animale"><i class="sprite sprite-facility-pets"></i></li>
						<? }?>
						-->
						<? if($item['wifi'] || $item['internet']){?>
							<li data-toggle="tooltip" title="Internet"><i class="sprite sprite-facility-wifi"></i></li>
						<? }?>
						<? if($item['air_conditioner']){?>
							<li data-toggle="tooltip" title="Aer conditionat"><i class="sprite sprite-facility-ac"></i></li>
						<? }?>
						<? if($item['beach']){?>
							<li data-toggle="tooltip" title="Plaja"><i class="sprite sprite-facility-plaja"></i></li>
						<? }?>
						<!--
						<? if($item['beach_sand']){?>
							<li data-toggle="tooltip" title="Plaja cu nisip"><i class="sprite sprite-facility-hotelbeach"></i></li>
						<? }?>
						-->
						<? if($item['pool_outside']){?>
							<li data-toggle="tooltip" title="Piscina exterioara"><i class="sprite sprite-facility-pool"></i></li>
						<? }?>
						<? if($item['pool_indoor']){?>
							<li data-toggle="tooltip" title="Piscina interioara"><i class="sprite sprite-facility-insidepool"></i></li>
						<? }?>
						<? if($item['aqua_park']){?>
							<li data-toggle="tooltip" title="Aqua Park"><i class="sprite sprite-facility-aquapark"></i></li>
						<? }?>
						<? if($item['restaurant']){?>
							<li data-toggle="tooltip" title="Restaurant"><i class="sprite sprite-facility-restaurant"></i></li>
						<? }?>
						<? if($item['restaurant_a_la_carte']){?>
							<li data-toggle="tooltip" title="Restaurant a la carte"><i class="sprite sprite-facility-alacarte"></i></li>
						<? }?>
					</ul>
					<p class="items__item__desc"><?=$item['short_desc']?></p>
					<!-- status oferta -->
					<div class="status">
						<strong>Status oferta:</strong><br>
						<span class="status-mode available">Disponibil</span>
					</div>
					<!-- end status oferta -->

					<?/*
					<? if($item['latitude'] != "" && $item['latitude'] != "0"){?>
						<a class="items__item__harta fancybox fancybox.iframe" href="<?=$item['map_url']?>" class="clk-<?=$item['id_hotel']?>">
							<i class="sprite sprite-pin"></i> Vezi pe harta
						</a>
					<? }?>
					*/?>
				</div>
				<div class="col-ms-4 col-sm-4 items__item__wrapper">
					<div class="abs-bottright-0">
						<!-- early booking -->
						<? if($item['early_booking']){?>
							<div class="sale-tag">EARLY BOOKING</div>
						<? }?>
						<!-- end early booking -->

						<div class="clearfix"></div>
						<p class="items__item__del"><? if(!$_is_search){?>de la<? }?> <? if($item['price_old'] > 0){?><del><?=$item['price_old']?> <?=$currency_symbol?></del><? }?></p>
						<p class="items__item__price"><?=$item['price']?> <?=$currency_symbol?></p>
						<? if($_is_search){?>
							<p class="items__item__pers">pret / pachet</p>
						<? }else{?>
							<p class="items__item__pers">/ persoana / noapte</p>
						<? }?>
						<?/* aici diverse specificatii in grafica veche
						<ul class="items__item__hotel list-unstyled list-inline">
							<? if($item['last_minute']){?>
								<li><i class="sprite sprite-hotel-last-minute"></i></li>
							<? }?>
							<? if($item['smart']){?>
								<li><i class="sprite sprite-hotel-smart"></i></li>
							<? }?>
							<? if($item['early_booking']){?>
								<li><i class="sprite sprite-hotel-early-booking"></i></li>
							<? }?>
							<? if($item['discount'] > 0){?>
								<li class="items__item__hotel__discount">
									<i class="sprite sprite-hotel-discount"></i>
									<? if($item['reduction_type'] == 1){?>
										<span>-<?=$item['discount']?>%</span>
									<? }elseif($item['reduction_type'] == 2){?>
										<span>-<?=$item['discount']?> <?=$currency_symbol?></span>
									<? }?>
								</li>
							<? }?>
						</ul>
						*/?>
						<a class="btn btn--green items__item__btn" href="<?=$item['url']?>" class="clk-<?=$item['id_hotel']?>">Rezerva</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	ecommTrackImp.push({
		"id": "<?=$item['id_hotel']?>",
		"name": "<?=$item['title']?>",
		"price": "<?=$item['price']?>",
		"brand": "<?=$item['zone']['title'] != "" ? $item['zone']['title'] : $item['city']['title']?>",
		"category": "<?=$_params['ro'] ? "Turism intern" : "Sejururi"?>",
		"position": <?=$ki + $offset?>,
		<? if($_is_search){?>
			"list": "Advanced search"
		<? }elseif($_section == "search"){?>
			"list": "Search"
		<? }else{ ?>
			"list": "Offer list"
		<? }?>
	});

	rmkFbTrackIds.push('SJ<?=$item['id_hotel']?>');
	rmkFbTrackPrice.push('<?=$item['price']?>');
	rmkEventType = 'searchresults';

	rmkGTrackItems.push({
		'destination': 'SJ<?=$item['id_hotel']?>',
		'google_business_vertical': 'hotel_rental'
	});

	$('.clk-<?=$item['id_hotel']?>').click(function(e){
		e.preventDefault();

		dataLayer.push({
		 	"event": "productClick",
		  	"ecommerce": {
		    	"click": {
		      		"actionField": {
						<? if($_is_search){?>
							"list": "Advanced search"
						<? }elseif($_section == "search"){?>
							"list": "Search"
						<? }else{ ?>
							"list": "Offer list"
						<? }?>
		      		},
		      		"products": [{
						"id": "<?=$item['id_hotel']?>",
			      		"name": "<?=$item['title']?>",
			      		"price": "<?=$item['price']?>",
			      		"brand": "<?=$item['zone']['title'] != "" ? $item['zone']['title'] : $item['city']['title']?>",
			      		"category": "<?=$_params['ro'] ? "Turism intern" : "Sejururi"?>",
			      		"position": <?=$ki + $offset?>
		      		}]
		    	}
		  	}
		});

		location.href = $(this).attr('href');
	});
});
</script>
