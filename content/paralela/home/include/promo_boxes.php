<div class="promo_boxes-wrapper onebluesection">
	<div class="container-fluid">
		<div class="container__zebra">
			<div class="row">
				<div class="container">
					<!-- titlu + subtitlu sectiune -->
					<div class="row">
						<div class="col-xs-12 hr-title">
							<h3 class="hr-title__text wisubtit text-uppercase text--blue"><?=$_text_promo_boxes['section_title'];?></h3>

							<div class="row">
								<div class="col-xs-12 col-lg-8 col-lg-offset-2">
									<h2 class="hr-subtitle">
										<?=$_text_promo_boxes['description'];?>
									</h2>
								</div>
							</div>
						</div>
					</div>
					<!-- end titlu + subtitlu sectiune -->
					<div class="row">
						<? foreach($_promo_boxes as $k_box => $box){?>
						<div class="col-sm-4 <? if(!$_box_mobile[$k_box]){?>hidden-xs<? }?>">
							<div class="last-minute">
								<h3 class="last-minute__title  text-center text--white position-relative clearfix">
									<? if($box['icon'] == 1){?>
									<i class="sprite sprite-oferte-last-minute"></i>
									<? }elseif($box['icon'] == 2){?>
									<i class="sprite sprite-oferte-speciale"></i>
									<? }elseif($box['icon'] == 3){?>
									<i class="sprite sprite-oferte-booking"></i>
									<? }?><br>
									<?= $box['title'] ?>
								</h3>
								<ul class="last-minute__list list-unstyled">
									<? $k_item = 0; shuffle($box['offers'])?>
									<? foreach($box['offers'] as $item){?>
									<li class="last-minute__list__item">
										<img src="<?= $_base ?>static/img/sprite-oferte-dus-intors.png" class="sprite-oferte-dus-intors">
										<a class="last-minute__list__item__link clkpb-<?= $item['tracking']['id'] ?>" href="<?= $item['url'] ?>">
											<div class="row no-gutters">
												<div class="col-ms-7 col-md-7">
													<p class="last-minute__list__item__title">

														<strong><?= $item['title'] ?></strong>
													</p>
													<? if($item['subtitle'] != ""){?>
													<span class="last-minute__list__item__details imp-details text--grey"><?= $item['subtitle'] ?></span>
													<? }?>
													<? if($item['text1'] != ""){?>
													<span class="last-minute__list__item__details text--grey"><?= $item['text1'] ?></span>
													<? }?>
													<? if($item['text2'] != ""){?>
													<span class="last-minute__list__item__details text--grey"><?= $item['text2'] ?></span>
													<? }?>
												</div>
												<div class="col-ms-5 col-md-5 last-minute__list__item__second-block">
													<p class="last-minute__list__item__pret">
														de la
														<? if($item['price_old']){?>
														<del class="last-minute__list__item__pret__old"><?= $item['price_old'] ?>&euro;</del>
														<? }?>
														<span class="last-minute__list__item__pret__actual"><?= $item['price'] ?>&euro;</span>
													</p>
													<span class="last-minute__list__item__details per_pers text--grey">/ persoana</span>
													<? if($item['last_places']){?>
													<span class="last-minute__list__item__details thelast text-uppercase text--orange"><strong>Ultimele <?= $item['last_places'] ?> locuri</strong></span>
													<? }?>
												</div>
											</div>
										</a>
									</li>

									<? $k_item++; ?>
									<? if($k_item > 2) break;?>

									<? if($item['tracking']){?>
									<script>
										$(document).ready(function() {
											ecommTrackImp.push({
												"id": "<?= $item['tracking']['id'] ?>",
												"name": "<?= $item['tracking']['name'] ?>",
												"price": "<?= $item['tracking']['price'] ?>",
												"brand": "<?= $item['tracking']['brand'] ?>",
												"category": "<?= $item['tracking']['category'] ?>",
												"position": <?= $k_item + $k_box * 3 ?>,
												"list": "Homepage: <?= $box['title'] ?>"
											});

											rmkFbTrackIds.push('<?= $item['tracking']['prefix'] ?><?= $item['tracking']['id'] ?>');
											rmkFbTrackPrice.push('<?= $item['tracking']['price'] ?>');
											rmkEventType = 'home';

											$('.clkpb-<?= $item['tracking']['id'] ?>').click(function(e) {
												e.preventDefault();

												dataLayer.push({
													"event": "productClick",
													"ecommerce": {
														"click": {
															"actionField": {
																"list": "Homepage: <?= $box['title'] ?>"
															},
															"products": [{
																"id": "<?= $item['tracking']['id'] ?>",
																"name": "<?= $item['tracking']['name'] ?>",
																"price": "<?= $item['tracking']['price'] ?>",
																"brand": "<?= $item['tracking']['brand'] ?>",
																"category": "<?= $item['tracking']['category'] ?>",
																"position": <?= $k_item + $k_box * 3 ?>,
															}]
														}
													}
												});

												location.href = $(this).attr('href');
											});
										});
									</script>

									<? }?>

									<? }?>
								</ul>
								<a href="<?=$box['url'];?>" class="view-all">
									Vezi toate ofertele<br>
									<img src="<?= $_base ?>static/img/view-all.png">
								</a>
								<?/*
										<? if($box['url'] != ""){?>
								<a class="btn btn-block last-minute__btn last-minute__btn--<?= $box['color'] ?> position-relative" href="<?= $box['url'] ?>"><strong class="position-center text--<?= $box['color'] ?>">Vezi toate ofertele ›</strong></a>
								<? }?>
								*/?>
							</div>
						</div>
						<? }?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>