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
					<div class="col-md-3">
						<div class="aside-filters-sidebar">
							<h3>Agentiile partenere</h2>
							<div class="aside-filters__item">
								<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege judet<i class="sprite sprite-down-black"></i></p>
								<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
									<? if($_judete_list){ ?>
										<ul class="list-unstyled">
											<? foreach($_judete_list as $item){  ?>
												<li>
													<a class="<?= $_judet == $item['judet'] || !isset($_params['judet']) && $item['judet'] == 'Bucuresti' ? 'active' : '' ?>" href="<?= route('agency-judet-partner', $item['judet']) ?>#list"><?= $item['judet'] ?>	›</a>
												</li>
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
							<li><a href="">Echipa Paralela 45</a></li>
							<li><a href="">Agentiile Paralela 45</a></li>
							<li><a href="">Despre noi</a></li>
						</ul>
						<!-- end butoane gen about -->

						<div class="hr-title">
							<h3 class="agg-from">Agentii partenere in <span class="text-uppercase "><?= $_item_title ?></span></h3>
						</div>

						<p class="hr-subtitle">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>

						<?/*
						<div class="partner-agencies">
							<div class="aside-filters__item">
								<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege oras<i class="sprite sprite-down-black"></i></p>
								<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
									<div class="row">
										<div class="col-xs-12">
											<? if($_cities){ ?>
												<ul class="list-unstyled">
													<? foreach($_cities as $item){  ?>
														<li class="col-md-3 col-sm-12 col-xs-12">
															<a class="<?= $_city['id_city'] ==  $item['id_city'] ? 'active' : '' ?>" href="<?= route('agency-city-partner', $_judet, $item['title']) ?>#list"><?= $item['title'] ?>	›</a>
														</li>
													<? } ?>
												</ul>
											<? } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						*/?>

						<div class="partner-agencies-list" id="list">
							<div class="row">

							</div>
							<? if($_judet && count($_cities) > 1){?>
								<div class="row">

								</div>
								<div class="row">
								</div>
							<? }?>
							<? if($_items){ ?>
								<div class="row">
									<? foreach($_items as $item){ ?>
										<div class="col-lg-3 col-md-4 col-sm-6">
											<div class="partner-agency">
												<span class="point"><?= $item['city'] ?></span><br />
												<span class="partner"><?= $item['title'] ?></span>
												<? if($item['images']){ ?>
													<a href="#" class="img"><img src="<?= $item['images'][0]['url']  ?>" alt="<?= $item['title'] ?>"></a>
												<? } else{ ?>
													<a href="#" class="img img-ag-default"><img src="<?= urle('img/partener_P452.jpg', 'static')  ?>" alt="<?= $item['title'] ?>"></a>
												<? }?>
												<?= $item['adress'] ?><br />
												<a href="tel:<?= $item['phone'] ?>"><?= $item['phone'] ?></a><br />
												<a href="mailto:<?= $item['email'] ?>"><?= $item['email'] ?></a>
											</div>
										</div>
									<? } ?>

								</div>
								<div class="row">
									<div class="col-xs-12 text-center">
										<?php print_pagination(array('items_count' => $_count_agencies, 'per_page' => $_ipp))?>
									</div>
								</div>
							<? }else{ ?>
								<h4>Nu s-a gasit niciun rezultat.</h4>
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

	<?/* <? include $_theme_path.'common/boxes/box_learn_more_about.php' ?> */?>

	<? /*
	<div class="container-fluid anpc-wrapper">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<b><?= $_autoritatea['title'] ?></b>
						<p><span class="pull-right copyright-span">Copyright &copy; <?=date('Y')?> Paralela 45</span><br><br>
						<?= $_autoritatea['description'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	*/ ?>

</main>
