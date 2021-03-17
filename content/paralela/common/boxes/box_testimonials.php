<?
if($_country){
	list($_text_items, $count_items) = get_posts(array(
		'table' => 'testimonial',
		'id_country' => $_country['id_country'],
		'limit' => 5,
		'order' => 'rand()',
		'extra_where' => ' AND (reply IS NULL OR reply = "")'
	));
}

if(!$_country){
	list($_text_items, $count_items) = get_posts(array(
		'table' => 'testimonial',
		'limit' => 5,
		'order' => 'rand()',
		'extra_where' => ' AND (reply IS NULL OR reply = "")'
	));
}

if($_text_items){
?>
<div class="container-fluid hide-print">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 hr-title">
					<hr class="hr-title__hr">
					<h3 class="hr-title__text text-uppercase text--blue">Ce spun clientii nostri</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="swiper-container swiper-consultanti text--blue">
						<div class="swiper-wrapper">
							<?php foreach($_text_items as $item) { ?>
								<?
								$country = get_country_by_id($item['id_country']);
								if($item['id_city'] > 0){
									$city = get_city_by_id($item['id_city']);
								}
								?>
								<div class="swiper-slide">
									<i class="sprite sprite-blockquote pull-left"></i>
									<div class="swiper-consultanti__wrapper">
										<p class="swiper-consultanti__author">
											<strong><?=$item['name']?></strong> a fost in
											<strong><?=$country['title']?><?=($item['id_city'] > 0 && $city['title'] != $country['title'] ? ", ".$city['title'] : "")?></strong>
										</p>
										<div class="swiper-consultanti__sub">
											<? if($item['title'] != ""){?>
												<strong><?=$item['title']?></strong><br>
											<? }?>
											<?=$item['description']?><a href="#" class="readmore">Vezi mai mult</a> <a href="#" class="less">Vezi mai putin</a>
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
<? }?>
