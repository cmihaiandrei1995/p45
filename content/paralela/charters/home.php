<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/big/charters.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<!-- titlu pagina -->
						<h1 class="logo-title logo-title--full margin--bottom-40">
							<div class="ipi-icons">
								<i class="sprite ipi-plane-icon"></i>
								<i class="sprite ipi-hotel-icon"></i>
							</div>
							<span class="logo-title__text"><?=$_text['title']?></span>
							<div class="inner-page-subtitle"><?= $_text['description']?></div>
						</h1>
						<!-- end titlu pagina -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 oferte-tab-list oferte-tab-list-charter">
						<ul class="nav nav-pills" role="tablist">
							<? foreach($_destinations_from as $k => $dest){?>
								<li role="presentation" <? if($k==0){?>class="active"<? }?>>
									<a href="#<?=generate_name($dest['title'])?>" aria-controls="<?=generate_name($dest['title'])?>" role="tab" data-toggle="tab"><?=$dest['title']?></a>
								</li>
							<? }?>
						</ul>
						<div class="tab-content">
							<?/*
							<? foreach($_destinations_from as $k => $dest){?>
								<div role="tabpanel" class="tab-pane <? if($k==0){?>active<? }?>" id="<?=generate_name($dest['title'])?>">
									<div class="row">
										<? foreach($dest['countries'] as $c => $country){?>
											<div class="col-ms-6 col-sm-4 <?=count($country['cities']) > 8 ? "mb30" : ""?>">
												<div class="oferte-tab-list__title"><i class="flags <?=strtolower($country['code'])?>"></i><span class="text-uppercase"><?=$country['title']?></span> <span class="pull-right text--blue"><?=$country['count']?> ofert<?=$country['count'] > 1 ? "e" : "a"?></span></div>
												<ul class="list-unstyled">
													<? foreach($country['cities'] as $city){?>
														<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a></li>
													<? }?>
												</ul>
											</div>
											<? if($c%3==2){?>
												<div class="clearfix hidden-sm"></div>
											<? }?>
										<? }?>
									</div>
								</div>
							<? }?>
							*/?>

							<!-- listare noua -->
							<div class="puzzle-masonry-inner-oneplusfour">
								<? foreach($dest['countries'] as $c => $country){?>
									<!-- plecare din -->
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">BUCURESTI</span>]</h2>
										</div>
									</div>
									<!-- end plecare din -->
									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 verytall">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
																<ul class="list-unstyled">
																	<li><a href="">[Alanya ›]</a></li>
																	<li><a href="">[Antalya ›]</a></li>
																	<li><a href="">[Belek ›]</a></li>
																	<li><a href="">[Kemere ›]</a></li>
																	<li><a href="">[Lara Kundu ›]</a></li>
																	<li><a href="">[Side ›]</a></li>
																</ul>
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/249x445">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 tall first-item">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor">[<strong><?=$country['count']?></strong>ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/424x250">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 tall">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/332x250">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 small">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/332x187">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 small">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/424x187">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">vezi toate ofertele »</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">vezi toate ofertele »</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">vezi toate ofertele »</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">vezi toate ofertele »</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
									</div>
								<? }?>
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
								<? foreach($dest['countries'] as $c => $country){?>
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Cluj</span>]</h2>
										</div>
									</div>
									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 verytall">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/249x445">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 tall first-item">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/424x250">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 tall">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/332x250">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 small">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/332x187">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 small">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/424x187">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-md-3 small">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/424x187">
											</div>
										</div>
									</div>
								<? }?>
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
								<? foreach($dest['countries'] as $c => $country){?>
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Iasi</span>]</h2>
										</div>
									</div>

									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
									</div>
								<? }?>
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
								<? foreach($dest['countries'] as $c => $country){?>
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Timisoara</span>]</h2>
										</div>
									</div>

									<div class="row">
										<div class="col-ms-6 col-sm-6 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong>[<?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?>]</span></div>
													<ul class="list-unstyled">
														<? foreach($country['cities'] as $city){?>
															<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
																[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
															</li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
									</div>
								<? }?>
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
								<? foreach($dest['countries'] as $c => $country){?>
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">TARGU MURES</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span></div>
															<ul class="list-unstyled">
																<? foreach($country['cities'] as $city){?>
																	<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																		[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
																	</li>
																<? }?>
															</ul>
														</div>
														<a href="" class="see-all">[vezi toate ofertele »]</a>
														<div class="blue-cover"></div>
														<img src="https://via.placeholder.com/248x215">
													</div>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Oradea</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<div class="oferte-tab-list__title"><span class="text-uppercase">[<?=$country['title']?>]</span> <span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span></div>
															<ul class="list-unstyled">
																<? foreach($country['cities'] as $city){?>
																	<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>">
																		[<a href="<?=$city['url']?>"><?=$city['title_homepage'] != "" ? $city['title_homepage'] : $city['title']?> ›</a>]
																	</li>
																<? }?>
															</ul>
														</div>
														<a href="" class="see-all">[vezi toate ofertele »]</a>
														<div class="blue-cover"></div>
														<img src="https://via.placeholder.com/248x215">
													</div>
												</div>
											</div>
										</div>
									</div>
								<? }?>
							</div>
							<!-- end listare noua -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="definal">
					[Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.]
				</div>
			</div>
		</div>
	</div>

	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>

<script>
$(document).ready(function() {

    if(location.hash !== '') {
        $('a[href="' + location.hash + '"]').trigger('click');
        setTimeout(function() {
            $(window).scrollTop(250);
        }, 5);
    }

	// return $('a[data-toggle="tab"]').on('shown', function(e) {
    //   	return location.hash = $(e.target).attr('href').substr(1);
    // });
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
       if(history.pushState) {
            history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
       } else {
            location.hash = '#'+$(e.target).attr('href').substr(1);
       }
    });
});
</script>
