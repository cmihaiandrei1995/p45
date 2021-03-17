<div class="container-fluid main-filters__bg <? if(!$_box_mobile[1]){?>hidden-xs<? }?>">
	<div class="row">
		<div class="col-xs-12" style="padding:0;">
			<div class="<? if(count($_slides) > 1){?>swiper-container<? }?> swiper-main">
				<div class="swiper-wrapper">
					<?php foreach($_slides as $ki => $slide){ ?>
						<div class="swiper-slide <? if(!$slide['show_mobile']){?>hidden-xs<? }?>">
							<a href="<?=$slide['url']?>" class="clk-<?=$slide['id_home_slider']?>">
								<img class="swiper-main__img object-fit" src="<?=$slide['images'][0]['big']?>" alt="<?=$slide['title']?>">
							</a>
							<? if($slide['banner_img'] != ""){?>
								<a class="swiper-main__extra" href="<?=$slide['url']?>"  class="clk-<?=$slide['id_home_slider']?>">
									<img src="<?=$slide['banner_img']?>" alt="<?=$slide['title']?>">
								</a>
							<? }?>
							<? if($slide['show_counter']){?>
								<div class="swiper-main__countdown clock_counter">
									<? /*
									<i class="sprite sprite-countdown-top">
										<span class="swiper-main__countdown__top__title text-center text-uppercase text--orange"><?=$slide['counter_title']?></span>
										<span class="swiper-main__countdown__top__sub text-center text--orange"><?=$slide['counter_subtitle']?></span>
									</i>
									*/ ?>
									<div class="swiper-main__countdown__cta text--orange">
										<div class="row">
											<div class="col-xs-6">
												<span class="swiper-main__countdown__cta__big text-uppercase"><?=$slide['counter_title_reduction']?></span>
											</div>
											<div class="col-xs-6">
												<div class="swiper-main-procent-wrapper">
													<span class="swiper-main__countdown__cta__small"><?=$slide['counter_subtitle_reduction']?></span>
													<span class="swiper-main__countdown__cta__procent"><?=$slide['counter_reduction_text']?></span>
													<span class="swiper-main__countdown__cta__small">reducere</span>
												</div>
											</div>
										</div>
									</div>
									<div class="swiper-main-countdown-wrapper">
										Au ramas:
										<ul class="swiper-main__countdown__list list-unstyled list-inline">
											<? if($slide['counter_days'] > 0){?>
												<li class="swiper-main__countdown__list__item">
													<span class="swiper-main__countdown__list__item__time"><span class="days"><?=str_pad($slide['counter_days'], 2, '0', STR_PAD_LEFT)?></span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
													<span class="swiper-main__countdown__list__item__text text-uppercase">Zile</span>
												</li>
											<? }else{ ?>
												<span class="days hidden">0</span>
											<? }?>
											<li class="swiper-main__countdown__list__item">
												<span class="swiper-main__countdown__list__item__time"><span class="hours"><?=str_pad($slide['counter_hours'], 2, '0', STR_PAD_LEFT)?></span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
												<span class="swiper-main__countdown__list__item__text text-uppercase">Ore</span>
											</li>
											<li class="swiper-main__countdown__list__item">
												<span class="swiper-main__countdown__list__item__time"><span class="minutes"><?=str_pad($slide['counter_minutes'], 2, '0', STR_PAD_LEFT)?></span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
												<span class="swiper-main__countdown__list__item__text text-uppercase">Minute</span>
											</li>
											<li class="swiper-main__countdown__list__item">
												<span class="swiper-main__countdown__list__item__time"><span class="seconds"><?=str_pad($slide['counter_seconds'], 2, '0', STR_PAD_LEFT)?></span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
												<span class="swiper-main__countdown__list__item__text text-uppercase">Secunde</span>
											</li>
											<? if($slide['counter_days'] == 0){?>
												<li class="swiper-main__countdown__list__item">
													<span class="swiper-main__countdown__list__item__time"><span class="seconds"><?=str_pad($slide['counter_seconds'], 2, '0', STR_PAD_LEFT)?></span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
													<span class="swiper-main__countdown__list__item__text text-uppercase">Secunde</span>
												</li>
											<? }else{ ?>
												<span class="seconds hidden">0</span>
											<? }?>
										</ul>
									</div>
									<button>Rezerva acum »</button>
									<? /*
									<div class="swiper-main__countdown__cta text--orange">
										<span class="swiper-main__countdown__cta__big text-uppercase"><?=$slide['counter_title_reduction']?></span>
										<span class="swiper-main__countdown__cta__small"><?=$slide['counter_subtitle_reduction']?></span>
										<i class="sprite sprite-countdown-separator"></i>
										<span class="swiper-main__countdown__cta__procent"><?=$slide['counter_reduction_text']?></span>
									</div>
									*/ ?>
									<div class="swiper-main__countdown__bottom text-uppercase"><p class="text-center"><strong><?=$slide['counter_incentive']?></strong></p></div>
								</div>
							<? }?>
						</div>
						<script>
							$(document).ready(function(){
								dataLayer.push({
								 	'ecommerce': {
								    	'promoView': {
								      		'promotions': [{
								         		'id': '<?=$slide['id_home_slider']?>',
								         		'name': '<?=$slide['title']?>',
								         		'position': '<?=$ki?>'
								       		}]
								    	}
								  	}
								});

								$('.clk-<?=$slide['id_home_slider']?>').click(function(e){
									e.preventDefault();

									dataLayer.push({
									 	"event": "promotionClick",
									  	"ecommerce": {
									    	"promoClick": {
									      		"promotions": [{
													'id': '<?=$slide['id_home_slider']?>',
									         		'name': '<?=$slide['title']?>',
									         		'position': '<?=$ki?>'
									      		}]
									    	}
									  	}
									});

									location.href = $(this).attr('href');
								});
							});
						</script>
					<?php } ?>
				</div>
				<? if(count($_slides) > 1){?>
					<div class="swiper-button-prev"><i class="swiper-bttn swiper-bttn-prev"></i></div>
					<div class="swiper-button-next"><i class="swiper-bttn swiper-bttn-next"></i></div>
				<? }?>
			</div>
			<?/*
			<div class="row">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/home_forms.php'; ?>
					</div>
				</div>
			</div>
			*/ ?>
		</div>
	</div>
</div>

<div class="home_forms-wrapper">
	<div class="container">
		<div class="row">
			<?php include $_theme_path.'common/forms/home_forms.php'; ?>
		</div>
	</div>
</div>
