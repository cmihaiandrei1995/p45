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
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="romania">
								<div class="row">
									<div class="col-md-3">
										<div class="aside-filters-sidebar">
											<h3>Agentiile Paralela 45</h3>
											<? if($_countries){ ?>
												<ul class="nav nav-pills agencies" role="tablist">
													<? foreach($_countries as $item){ ?>
														<li role="presentation" class="<?= $country['id_country'] ==  $item['id_country'] ? 'active' : '' ?> <?= (!isset($_params['country']) && $item['title'] == 'Romania' ) ? 'active' : ''  ?>"><a href="<?= route('agency-country', $item['title']) ?>" ><span class="oferte-tab-list__text">[<?= $item['title'] ?>]</span></a></li>
													<? } ?>
												</ul>
											<? } ?>
											<div class="aside-filters__item">
												<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege oras<i class="sprite sprite-down-black"></i></p>
												<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
													<? if($_cities){ ?>
													<ul class="list-unstyled">
														<? foreach($_cities as $k => $item){  ?>
															<li><a class="<?= $_city['id_city'] ==  $item['id_city'] ? 'active' : '' ?> <?= (!isset($_params['city']) && $item['title'] == 'Bucuresti' ) ? 'active' : ''  ?> <?= (isset($_params['country']) && $k == 1) ? 'active' : '' ?>" href="<?= route('agency-city', $item['title']) ?>"><?= $item['title'] ?>	›</a></li>
														<? } ?>
													</ul>
													<? } ?>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-9">
										<!-- butoane gen about -->
										<ul class="about-menu list-unstyled">
											<li><a href="">[Despre noi]</a></li>
											<li><a href="">[Echipa Paralela 45]</a></li>
											<li><a href="">[Agentii partenere]</a></li>
										</ul>
										<!-- end butoane gen about -->

										<div class="tab-pane active <?php if(empty($arr)){echo 'hidden'; }?>" id="country_gmap">
											<div class="map-content">
												<div class="map-content" id="map"></div>
											</div>
										</div>
										<? if($_items){ ?>
											<!-- agentiile din -->
											<h3 class="agg-from">[Agentiile Paralela 45 din Bucuresti]</h3>
											<!-- end agentiile din -->
											<div class="row">
												<ul class="town_agencies list-unstyled">
													<? foreach($_items as $k => $item){   ?>
														<div class="col-md-4 col-sm-6 col-ms-6">
															<li>
																<? if($item['images']){ ?>
																	<a href=" <?= route('agency', $item['title']) ?>" class="img">
																		<img src="<?= $item['images'][0]['medium'] ?>" class="object-fit" alt="<?= $item['title'] ?>" />
																	</a>
																<? } ?>
																<div class="town_agencies_info">
																	<? if($item['city']){?>
																		<span class="town"><?= $item['city'] ?></span>
																	<? }?>
																	<a href=" <?= route('agency', $item['title']) ?>"><span class="agency"><?= $item['title'] ?></span></a><br />
																	<?= $item['address'] ?>
																	<?= $item['phone'] ?>
																	<?= $item['info_license'] ?>
																</div>
																<div class="row no-gutters">
																	<div class="col-xs-6">
																		<? if($item['map_x']){  ?>
																			<a href="#" data-url="<?= route('agency', $item['title']) ?>" data-img="<?= $item['images'][0]['medium'] ?>" data-title="<?=$item['title']?>" data-lat="<?=(float)$item['map_x']?>" data-long="<?=(float)$item['map_y']?>" class="btn-blue wico wpinico" ><i class="sprite sprite-pin-white"></i>vezi harta</a>
																		<? } ?>
																	</div>
																	<div class="col-xs-6">
																		<a href=" <?= route('agency', $item['title']) ?>" class="btn-blue wico"><i class="sprite sprite-team-white"></i>vezi echipa <i class="zmdi zmdi-chevron-right"></i></a>
																	</div>
																</div>
															</li>
														</div>
													<? } ?>
												</ul>
											</div>
										<? }else{ ?>
											<h4>Nu s-a gasit niciun rezultat</h4>
										<? } ?>

										<div class="contact-form-wrapper agencies-form-wrapper" data-location="<? ?>">
											<? include $_theme_path.'common/forms/contact-form-agencies.php' ?>
										</div>
									</div>
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

	<?/*	<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>	*/?>

</main>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-body">
	       		<div class="form-training">
   			 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          		<span aria-hidden="true">&times;</span>
		        	</button>
					<div class="row">
						<div class="col-sm-12">
							<div class="tab-pane active" >
								<div class="map-content">
									<div class="map-content" id="map_modal" style="height: 400px; width: 100%;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
	      	</div>
	    </div>
	</div>
</div>

<script>
	$(document).ready(function(){
		var items = [
			<? foreach($_items_map as $k => $item){ if(!$item['map_x']){ continue; }?>
				['<?=addslashes(trim($item['title']))?>', <?=(float)$item['map_x']?>, <?=(float)$item['map_y']?>, '', '', '<?= route('agency', $item['title'])?>', '<?=$item['images'][0]['medium']?>'],
			<? }?>
		];
		<?php if(!empty($arr)){?> initAgenciesMap('map', items); <?php }?>
	});
</script>
