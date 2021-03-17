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

	<div class="container-fluid agencies-tab-list">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12"> <!--oferte-tab-list-->
						<div class="tab-content">
							<div>
								<div class="row">
									<div class="col-md-3">
										<div class="aside-filters-sidebar">
											<h3>Echipa Paralela 45</h2>
											<div class="aside-filters__item">
												<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege departament<i class="sprite sprite-down-black"></i></p>
												<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
													<? if($_categories){ ?>
														<ul class="list-unstyled">
															<? foreach($_categories as $item){ ?>
																<li><a class="<?= $_cat['id_team_category'] ==  $item['id_team_category'] ? 'active' : '' ?>" href="<?= route('team-cat', $item['title']) ?>"><?= $item['title'] ?>	›</a></li>
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
											<li><a href="">Agentiile Paralela 45</a></li>
											<li><a href="">Despre noi</a></li>
											<li><a href="">Agentii partenere</a></li>
										</ul>
										<!-- end butoane gen about -->
										<h3 class="agg-from"><?= $_cat['title'] ?></h3>
										<p class="hr-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>

										<div class="row">
											<? if($_items){ ?>
												<ul class="team-list list-unstyled">
													<? foreach($_items as $item){ ?>
														<li class="col-md-3 col-sm-4 col-ms-6">
															<? if($item['images'][0]['thumb']){?>
																<img src="<?= $item['images'][0]['thumb'] ?>" alt="<?= $item['title'] ?>" /><br />
															<? }else{ ?>
																<img src="<?= urle('img/agent_no_pic.jpg', 'static')  ?>" alt="<?= $item['title'] ?>" style="width:97px">
															<? }?>
															<p><b><?= $item['title'] ?></b><br /></p>
															<b><?= $item['position'] ?></b><br />
															<a href="mailto:<?= $item['email'] ?>"><?= $item['email'] ?></a>
														</li>
													<? } ?>
												</ul>
											<? }else{ ?>
												<div class="col-md-12">
													<h4>Nu a fost gasit niciun rezultat</h4>
												</div>
											<? } ?>
										</div>

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
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.
				</div>
			</div>
		</div>
	</div>
	<!-- end un paragraf random -->

	<?/*	<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?> */?>
</main>
