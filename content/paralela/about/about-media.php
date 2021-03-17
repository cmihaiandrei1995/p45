		<main>
			<div class="container-fluid inner-banner inner-banner-about">
				<div class="row">
					<div class="col-xs-12">
						<div class="row img-banner__img__wrapper">
								<div class="black-layer"></div>
							<img class="img-banner__img object-fit" src="<?= $_base ?>static/img/banner_despre.jpg" alt="...">
						</div>
						<div class="row">
								<div class="container">
										<div class="col-md-2"></div>
										<div class="col-xs-12 col-md-8">
												<p class="quote">“Oriunde ai vrea sa calatoresti, poti sa pleci linistit. Ai intotdeauna suportul nostru.”<br /><i>Alin Burcea</i></p>
										</div>
								</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid margin--top-50">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<h2 class="logo-title logo-title--full"><span class="logo-title__text">POVESTEA NOASTRA</span> <span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 about-wrapper about-media">
										<div class="row">
											<div class="col-md-3">
												<? include $_theme_path.'common/sidebars/sidebar-about-new.php' ?>
											</div>
											<div class="col-md-9">
												<? if($_texts){ $x = count($_texts); $i=0; foreach($_texts as $k => $text){ $i++; ?>
													<div class="about-section full-text-toggle">
																	<h4 class="media"><?= $text['title'] ?> </h4>
                                  									<p class="date"><?=date('d.m.Y', strtotime($text['created']))?></p>
																	<?= $text['description'] ?>
																	<a class="more-details show-full-text" id="show-full-text" href="#">Citeste mai mult</a>
														</div>
														<? if($i != $x){ ?>
														<hr class="delim" />
														<? } ?>
														
														<? } } ?>
														
											</div>
									</div>
									<div class="row">
										<div class="col-md-9 pull-right text-center">
											<?php print_pagination(array('items_count' => $_count, 'per_page' => $_ipp))?>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>
			<? //include $_theme_path.'common/boxes/box_partners.php' ?>
				
		</main>
