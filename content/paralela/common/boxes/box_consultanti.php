<?
list($_text_items, $count_items) = get_posts(array(
	'table' => 'home_testimonial',
	'limit' => -1
));
?>
<div class="container-fluid hide-print <? if(!$_box_mobile[15] && $_page == "home"){?>hidden-xs<? }?>">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 hr-title">
					<hr class="hr-title__hr">
					<h3 class="hr-title__text text-uppercase text--blue">Ce spun consultantii nostri</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="swiper-container swiper-consultanti text--blue">
						<div class="swiper-wrapper">
							<?php foreach($_text_items as $item) { ?>
								<div class="swiper-slide">
									<i class="sprite sprite-blockquote pull-left"></i>
									<div class="swiper-consultanti__wrapper">
										<p class="swiper-consultanti__author"><strong><?=$item['name']?></strong>, <?=$item['function']?></p>
										<p class="swiper-consultanti__title"><?=$item['hotel']?></p>
										<div class="swiper-consultanti__text">
											<?=$item['description']?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>