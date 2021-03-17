<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<? include $_theme_path.'common/boxes/box_contact_info.php' ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 oferte-tab-list agencies-tab-list">
						<div class="row">
							<div class="col-md-3">
								<div class="aside-filters-sidebar">
									<h3>Agentiile Paralela 45</h3>
									<? if($_countries){ ?>
									<ul class="nav nav-pills agencies" role="tablist">
										<? foreach($_countries as $item){ ?>
										<li role="presentation" class="<?= $_city_current['id_country'] ==  $item['id_country'] ? 'active' : '' ?> "><a href="<?= route('agency-country', $item['title']) ?>" ><span class="oferte-tab-list__text"><?= $item['title'] ?></span></a></li>
										<? } ?>
										<!-- <li role="presentation"><a href="#rep-moldova" aria-controls="rep-moldova" role="tab" data-toggle="tab"><span class="oferte-tab-list__text">REPUBLICA MOLDOVA</span></a></li> -->
									</ul>
									<? } ?>
									<div class="aside-filters__item">
										<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege oras<i class="sprite sprite-down-black"></i></p>
										<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
											<? if($_cities){ ?>
											<ul class="list-unstyled">
												<? foreach($_cities as $item){  ?>
													<li><a class="<?= $_item['id_city'] ==  $item['id_city'] ? 'active' : '' ?>" href="<?= route('agency-city', $item['title']) ?>"><?= $item['title'] ?>	›</a></li>
												<? } ?>
											</ul>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-9 one-agency">
								<!-- butoane gen about -->
								<ul class="about-menu list-unstyled">
									<li><a href="">[Despre noi]</a></li>
									<li><a href="">[Echipa Paralela 45]</a></li>
									<li><a href="">[Agentii partenere]</a></li>
								</ul>
								<!-- end butoane gen about -->
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="town_agencies">
											<div class="town_agencies_info">
												<?/*<span class="town"><?= $_city_current['title'] ?></span><br />*/?>
												<span class="agency"><?= $_item['title'] ?></span><br />
												<p class="headoffice">SEDIU CENTRAL</p>

												<?= $_item['address'] ?>
												<?= $_item['phone'] ?>
												<?= $_item['info_license'] ?>
											</div>
										</div>
									</div>
									<? if($_item['images']){ ?>
										<div class="col-md-6 col-sm-6">
											<div class="swiper-container swiper-item__main swiper-item__main--contact-agentie agencies-gallery">
												<div class="swiper-wrapper">
													<? foreach($_item['images'] as $img){ ?>
														<div class="swiper-slide"><img class="swiper-item__main__img object-fit" src="<?= $img['large'] ?>" alt="<?= $_item['title'] ?>"></div>
													<? } ?>
													<? if($_item['polita']){ ?>
														<div class="swiper-slide">
															<a class="fancybox" rel="group" href="<?=$_base ?>uploads/images/<?= $_item['polita_path'] ?><?= $_item['polita'] ?>">
																<img class="swiper-item__main__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['polita_path'] ?><?= $_item['polita'] ?>" alt="<?= $_item['title'] ?>">
															</a>
														</div>
													<? } ?>

													<? if($_item['brevet']){ ?>
														<div class="swiper-slide">
															<a class="fancybox" rel="group" href="<?=$_base ?>uploads/images/<?= $_item['brevet_path'] ?><?= $_item['brevet'] ?>">
																<img class="swiper-item__main__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['brevet_path'] ?><?= $_item['brevet'] ?>" alt="<?= $_item['title'] ?>">
															</a>
														</div>
													<? } ?>

													<? if($_item['licenta']){ ?>
														<div class="swiper-slide">
															<a class="fancybox" rel="group" href="<?=$_base ?>uploads/images/<?= $_item['licenta_path'] ?><?= $_item['licenta'] ?>">
																<img class="swiper-item__main__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['licenta_path'] ?><?= $_item['licenta'] ?>" alt="<?= $_item['title'] ?>">
															</a>
														</div>
													<? } ?>

													<? for($i=1; $i<=3; $i++){?>
														<? if($_item['document'.$i]){ ?>
															<div class="swiper-slide">
																<a class="fancybox" rel="group" href="<?=$_base ?>uploads/images/<?= $_item['document'.$i.'_path'] ?><?= $_item['document'.$i] ?>">
																	<img class="swiper-item__main__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['document'.$i.'_path'] ?><?= $_item['document'.$i] ?>" alt="<?= $_item['title'] ?>">
																</a>
															</div>
														<? } ?>
													<? } ?>
												</div>
												<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
												<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
											</div>
											<div class="swiper-item__thumbs swiper-item__thumbs--contact-agentie hidden-xs agencies-thumbs">
												<div class="swiper-container">
													<div class="swiper-wrapper">
														<? foreach($_item['images'] as $img){ ?>
															<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?= $img['small'] ?>" alt="<?= $_item['title'] ?>"></div>
														<? } ?>

														<? if($_item['polita']){ ?>
															<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['polita_path'] ?>small-<?= $_item['polita'] ?>" alt="<?= $_item['title'] ?>"></div>
														<? } ?>

														<? if($_item['brevet']){ ?>
															<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['brevet_path'] ?>small-<?= $_item['brevet'] ?>" alt="<?= $_item['title'] ?>"></div>
														<? } ?>

														<? if($_item['licenta']){ ?>
															<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?=$_base ?>uploads/images/<?= $_item['licenta_path'] ?>small-<?= $_item['licenta'] ?>" alt="<?= $_item['title'] ?>"></div>
														<? } ?>
													</div>
												</div>
											</div>
										</div>
									<? } ?>
								</div>
								<div class="row">
									<? if(!empty($_item['map_y'])){ ?>
										<div class="col-md-12">
											<div class="tab-pane active" >
												<div class="map-content">
													<div class="map-content" id="map_modal" style="height: 323px; width: 100%;"></div>
												</div>
											</div>
										</div>
									<? } ?>
								</div>

								<div class="clearfix"></div>
								<hr>
								<!-- echipa din -->
								<h3>[Echipa noastra din <span>agentia Dacia</span>]</h3>
								<!-- end echipa din -->
								<div class="row">
									<? if($_team){ ?>
										<ul class="team-list list-unstyled">
											<? foreach($_team as $t){  ?>
												<li class="col-md-3 col-xs-6">
													<? if($t['images']){ ?>
														<img src="<?= $t['images'][0]['thumb'] ?>" width="97" /><br />
													<? }else{ ?>
														<img src="<?= urle('img/agent_no_pic.jpg', 'static')  ?>" alt="<?= $item['title'] ?>" style="width:97px">
													<? } ?>
													<p class="name"><b><?= $t['title'] ?></b><br /></p>
													<b><?= $t['position'] ?></b><br />
													<a href="mailto:<?= $t['email'] ?>"><?= $t['email'] ?></a>
													<p class="position">PRODUCTIE</p>
												</li>
											<? } ?>
										</ul>
									<? } ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9 col-md-offset-3">
								<div class="contact-form-wrapper agencies-form-wrapper">
									<? include $_theme_path.'common/forms/contact-form-agencies.php' ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- un paragraf random -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="definal">
					[Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.]
				</div>
			</div>
		</div>
	</div>
	<!-- end un paragraf random -->

	<?/*<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>*/?>

</main>

<? if(!empty($_item['map_y'])){ ?>
<script>
	$(document).ready(function(){
		initMap(<?=(float)$_item['map_x']?>, <?=(float)$_item['map_y']?>, '<?= $_item['title'] ?>', '<?= route('agency', $_item['title'])?>', '<?= $_item['images'][0]['medium'] ?>');
	});
</script>
<? } ?>
