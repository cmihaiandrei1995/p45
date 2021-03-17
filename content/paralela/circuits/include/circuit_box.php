
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
			<h3 class="items__item__title"><a href="<?=$item['url']?>" class="clk-<?=$item['id_circuit']?>"><?=$item['title']?></a></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-ms-4 col-sm-4">
			<div class="swiper-container swiper-items__item">
				<div class="swiper-wrapper">
					<? if($item['video']){?>
						<div class="swiper-slide">
							<a href="<?=$item['url']?>" class="video-icon clk-<?=$item['id_circuit']?>">
								<img class="swiper-items__item__img object-fit swiper-lazy" data-src="<?=$item['video_thumb']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
							</a>
							<div class="swiper-lazy-preloader"></div>
						</div>
					<? }?>
					<? foreach($item['images'] as $image){?>
						<div class="swiper-slide">
							<a href="<?=$item['url']?>" class="clk-<?=$item['id_circuit']?>">
								<img class="swiper-items__item__img object-fit swiper-lazy" data-src="<?=$image['thumb']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
							</a>
							<div class="swiper-lazy-preloader"></div>
						</div>
					<? }?>
				</div>
				<?/*
					<? if($item['expired']){?>
						<p class="items__item__epuizat">LOCURI EPUIZATE</p>
					<? }?>
				*/?>
				<? if(count($item['images']) > 1){?>
					<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white"></i></div>
					<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white"></i></div>
				<? }?>
			</div>
		</div>
		<div class="col-ms-8 col-sm-8">
			<div class="row">
				<div class="col-ms-8 col-sm-8 items__item__wrapper items__item__circuite">
					<p class="items__item__plecare">
						<? if($item['type'] == "plane"){?>
							<i class="sprite sprite-avion-light-blue"></i>
						<? }else{?>
							<i class="busss"></i>
						<? }?>
						<? if($_is_search){?>
							<strong>Plecare:</strong> <?=$item['date']?>
						<? }else{ ?>
							<strong>Plecar<?=count($item['dates']) > 1 ? "i" : "e"?>:</strong> <?=implode(", ", $item['dates'])?>
						<? }?>
					</p>
					<p class="items__item__sub">
						<? if($item['categories_txt']){?>
							<?=implode(", ", $item['categories_txt'])?> •
						<? }?>
						<i class="sprite sprite-duration-light-blue small"></i>
						<strong>Durata:</strong> <?=$item['days']?> zile / <?=$item['nights']?> nopti
					</p>
					<!-- harta itinerariu -->
					<? if($item['map_image']){?>
						<a href="<?=$item['map_big']?>?&iframe=true&width=830&height=540" class="items__item__map fancybox fancybox.iframe">
							<i class="sprite sprite-map-light-blue small"></i>
							Vezi harta itinerariu
						</a>
					<? }?>
					<!-- end harta itinerariu -->



					<?/*<p class="items__item__desc"><?=$item['short_desc']?></p>*/?>
					<?/*
						<? if($item['last_chance']){?>
							<p class="items__item__ultimele">
								<? if($item['last_chance'] == 1){?>
									ULTIMUL LOC
								<? }else{?>
									ULTIMELE <?=$item['last_chance']?> LOCURI
								<? }?>
							</p>
						<? }?>
					*/?>

					<!-- status oferta -->
					<div class="status">
						<strong>[Status oferta:]</strong><br>
						<p><span class="status-date">[05.10.2018</span><span class="status-mode">9 LOCURI]</span></p>
						<p><span class="status-date">[10.03.2018</span><span class="status-mode cerere">La cerere]</span></p>
					</div>
					<!-- end status oferta -->
				</div>
				<div class="col-ms-4 col-sm-4 items__item__wrapper">
					<div class="abs-bottright-0">
						<!-- early booking -->
						<? if($item['early_booking']){?>
							<div class="sale-tag">[EARLY BOOKING]</div>
						<? }?>
						<!-- end early booking -->

						<div class="clearfix"></div>
						<p class="items__item__del"><? if(!$_is_search){?>de la<? }?> <? if($item['price_old'] > 0){?><del><?=$item['price_old']?> &euro;</del><? }?></p>
						<p class="items__item__price"><?=$item['price']?> &euro;</p>
						<? if($_is_search){?>
							<p class="items__item__pers">pret / pachet</p>
						<? }else{?>
							<p class="items__item__pers">/ persoana / pachet</p>
						<? }?>

						<?/*
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
										<span>-<?=$item['discount']?>&euro;</span>
									<? }?>
								</li>
							<? }?>
						</ul>
						*/?>

						<a class="btn btn--green items__item__btn" href="<?=$item['url']?>" class="clk-<?=$item['id_circuit']?>">Rezerva</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	ecommTrackImp.push({
		"id": "<?=$item['id_circuit']?>",
		"name": "<?=$item['title']?>",
		"price": "<?=$item['price']?>",
		"brand": "<?=implode(", ", $item['countries_txt'])?>",
		"category": "Circuite",
		"position": <?=$ki + $offset?>,
		<? if($_is_search){?>
			"list": "Advanced search"
		<? }elseif($_section == "search"){?>
			"list": "Search"
		<? }else{ ?>
			"list": "Offer list"
		<? }?>
	});

	rmkGTrackItems.push({
		'destination': 'CI<?=$item['id_circuit']?>',
		'google_business_vertical': 'travel'
	});

	rmkFbTrackIds.push('CI<?=$item['id_circuit']?>');
	rmkFbTrackPrice.push('<?=$item['price']?>');
	rmkEventType = 'searchresults';

	$('.clk-<?=$item['id_circuit']?>').click(function(e){
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
						"id": "<?=$item['id_circuit']?>",
			      		"name": "<?=$item['title']?>",
			      		"price": "<?=$item['price']?>",
			      		"category": "Circuite",
			      		"position": <?=$ki + $offset?>
		      		}]
		    	}
		  	}
		});

		location.href = $(this).attr('href');
	});
});
</script>
