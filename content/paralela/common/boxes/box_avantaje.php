<?
list($_avantaje, $count_avantaje) = get_posts(array(
	'table' => 'box_avantaj',
	'images' => 1,
	'limit' => 3
));

if($_avantaje){
?>
<div class="avantaje-wrapper">
	<div class="container-fluid hide-print <? if(!$_box_mobile[14] && $_page == "home"){?>hidden-xs<? }?>">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 hr-title">
						<h3 class="hr-title__text text-uppercase text--blue">Avantaje Paralela 45</h3>
					</div>
				</div>
				<div class="row avantaje">
					<? foreach($_avantaje as $item){?>
						<div class="col-sm-6 col-lg-4 avantaje__item">
							<a class="avantaje__item__link" href="<?=$item['url']?>">
								<!-- continut avantaje -->
								<div class="avantaje__item__img" style="background-image:url(<?=$item['images'][0]['url']?>);"></div>
								<div class="avantaje__item__wrapper avantaje__item__wrapper text-center">
									<h4 class="avantaje__item__title text-uppercase"><?=$item['title']?></h4>
								</div>
								<div class="avantaje__item__prgf">
									<?=$item['description'];?>
								</div>
								<!-- end continut avantaje -->
							</a>
						</div>
					<? }?>
				</div>
			</div>
		</div>
	</div>
</div>
<? }?>
