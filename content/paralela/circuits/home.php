<main>
	<?/*
	<div class="container-fluid inner-banner back-image-form">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<img class="img-banner__img object-fit" src="<?=$_base?>static/img/header_croaziere.jpg" alt="<?=$_text['title']?>">
				</div>
				<div class="row">
					<div class="container">
						<div class="row">
							<?php include $_theme_path.'common/forms/home_forms.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	*/?>

	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/big/circuits.php'; ?>
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
								<i class="sprite ipi-world-icon"></i>
							</div>
							<span class="logo-title__text"><?=$_text['title']?></span>
							<div class="inner-page-subtitle"><?= $_text['description']?></div>
						</h1>
						<!-- end titlu pagina -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 oferte-tab-list">
						<ul class="nav nav-pills" role="tablist">
							<? $jk = 0; foreach($_cities[1]['plane'] as $k => $city){?>
								<? if($city['continents']){?>
									<li role="presentation" class="<?=($jk==0 ? "active" : "")?>">
										<a href="#<?=generate_name($city['title'])?>" aria-controls="<?=generate_name($city['title'])?>" role="tab" data-toggle="tab"><?=$city['title']?></a>
									</li>
								<? $jk++; }?>
							<? }?>
							<? if($_cities_count[2]['plane']){?>
								<li class="dropdown">
							    	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="sprite sprite-pills-avion"></i> <span class="oferte-tab-list__text">Plecari din alte orase</span> <span class="caret"></span></a>
							    	<ul class="dropdown-menu">
							    		<? foreach($_cities[2]['plane'] as $k => $city){?>
							    			<? if($city['continents']){?>
								        		<li><a href="#<?=generate_name($city['title'])?>" aria-controls="<?=generate_name($city['title'])?>" role="tab" data-toggle="tab">Plecare din <?=$city['title']?></a></li>
							        		<? }?>
							        	<? }?>
							      	</ul>
							    </li>
						    <? }?>
						</ul>
						<div class="tab-content">
							<?/*
							<? foreach(array(1, 2) as $city_from){?>
								<? $jk = 0; foreach($_cities[$city_from]['plane'] as $k => $city){?>
									<? if($city['continents']){?>
										<div role="tabpanel" class="tab-pane <?=($jk==0 && $city_from==1 ? "active" : "")?>" id="<?=generate_name($city['title'])?>">
											<div class="row">
												<? foreach($city['continents'] as $c => $continent){?>
													<div class="col-ms-6 col-sm-6 col-md-4 <?=count($continent['countries']) > 10 ? "mb30" : ""?>">
														<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
															<i class="sprite sprite-circuit-<?=$_continent_id_to_css[$continent['id_continent']]?>-s"></i>
															<span class="text-uppercase pull-left"><?=$continent['title']?></span>
															<span class="pull-right text--blue"><?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?></span>
														</a>
														<ul class="list-unstyled">
															<? foreach($continent['countries'] as $country){?>
																<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>"><?=$country['title']?></a></li>
															<? }?>
														</ul>
													</div>
													<? if($c%3==2){?>
														<div class="clearfix"></div>
													<? }?>
												<? }?>
											</div>
										</div>
									<? $jk++;}?>
								<? }?>
							<? }?>
							*/?>

							<!-- listare noua -->
							<div class="puzzle-masonry-inner-oneplusfour">
								<div class="row">
									<div class="col-xs-12">
										<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Bucuresti</span>]</h2>
									</div>
								</div>
								<div class="row">
									<div class="col-ms-6 col-sm-6 col-lg-3 verytall">
										<div class="oferte-tab-list__content-wrapper">
											<div class="oferte-tab-list__content">
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
													<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
													<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
													<? foreach($continent['countries'] as $country){?>
														<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
													<? }?>
												</ul>
											</div>
											<a href="" class="see-all">[vezi toate ofertele »]</a>
											<div class="blue-cover"></div>
											<img src="https://via.placeholder.com/249x445">
										</div>
									</div>
									<!-- pe 3 coloane -->
									<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 tall first-item">
										<div class="oferte-tab-list__content-wrapper">
											<div class="oferte-tab-list__content">
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
												  <span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
												  <span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
												  <? foreach($continent['countries'] as $country){?>
												    <li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "three-per-row" : ""?>"><a href="<?=$country['url']?>"><?=$country['title']?></a></li>
												  <? }?>
												</ul>
											</div>
											<a href="" class="see-all">[vezi toate ofertele »]</a>
											<div class="blue-cover"></div>
											<img src="https://via.placeholder.com/424x250">
										</div>
									</div>
									<!-- end pe 3 coloane -->
									<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 tall">
										<div class="oferte-tab-list__content-wrapper">
											<div class="oferte-tab-list__content">
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
												  <span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
												  <span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
												  <? foreach($continent['countries'] as $country){?>
												    <li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
												  <span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
												  <span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
												  <? foreach($continent['countries'] as $country){?>
												    <li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
												  <span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
												  <span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
												  <? foreach($continent['countries'] as $country){?>
												    <li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?></a>]</li>
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
												<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
												  <span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
												  <span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
												</a>
												<ul class="list-unstyled">
												  <? foreach($continent['countries'] as $country){?>
												    <li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
												  <? }?>
												</ul>
											</div>
											<a href="" class="see-all">[vezi toate ofertele »]</a>
											<div class="blue-cover"></div>
											<img src="https://via.placeholder.com/424x187">
										</div>
									</div>
								</div>
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">CLUJ NAPOCA</span>]</h2>
										</div>
									</div>

									<div class="row">
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left"><?=$continent['title']?></span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Iasi</span>]</h2>
										</div>
									</div>

									<div class="row">
										<!-- pe 3 coloane -->
										<div class="col-ms-6 col-sm-6 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "three-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<!-- end pe 3 coloane -->
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12">
											<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Timisoara</span>]</h2>
										</div>
									</div>

									<div class="row">
										<!-- pe 3 coloane -->
										<div class="col-ms-6 col-sm-6 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "three-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
														<? }?>
													</ul>
												</div>
												<a href="" class="see-all">[vezi toate ofertele »]</a>
												<div class="blue-cover"></div>
												<img src="https://via.placeholder.com/248x215">
											</div>
										</div>
										<!-- end pe 3 coloane -->
										<div class="col-ms-6 col-sm-6 col-lg-3 regular">
											<div class="oferte-tab-list__content-wrapper">
												<div class="oferte-tab-list__content">
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
														<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
														<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
													</a>
													<ul class="list-unstyled">
														<? foreach($continent['countries'] as $country){?>
															<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Arad</span>]</h2>
												</div>
											</div>

											<div class="row">
												<!-- pe 3 coloane -->
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "three-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
																<? }?>
															</ul>
														</div>
														<a href="" class="see-all">[vezi toate ofertele »]</a>
														<div class="blue-cover"></div>
														<img src="https://via.placeholder.com/248x215">
													</div>
												</div>
												<!-- end pe 3 coloane -->
											</div>
										</div>
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Sibiu</span>]</h2>
												</div>
											</div>

											<div class="row">
												<!-- pe 3 coloane -->
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "three-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
																<? }?>
															</ul>
														</div>
														<a href="" class="see-all">[vezi toate ofertele »]</a>
														<div class="blue-cover"></div>
														<img src="https://via.placeholder.com/248x215">
													</div>
												</div>
												<!-- end pe 3 coloane -->
											</div>
										</div>
									</div>
							</div>
							<!-- end listare noua -->
						</div>
					</div>
				</div>
				<div class="row margin--top-10">
					<div class="col-xs-12">
						<!-- titlu pagina -->
						<h1 class="logo-title logo-title--full margin--bottom-40">
							<div class="ipi-icons">
								<i class="sprite ipi-bus-icon"></i>
								<i class="sprite ipi-flag-icon"></i>
							</div>
							<span class="logo-title__text"><?=$_text_2['title']?></span>
							<p class="inner-page-subtitle"><?=$_text_2['description']?></p>
						</h1>
						<!-- end titlu pagina -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 oferte-tab-list">
						<ul class="nav nav-pills" role="tablist">
							<? $jk = 0; foreach($_cities[1]['bus'] as $k => $city){?>
								<? if($city['continents']){?>
									<li role="presentation" class="<?=($jk==0 ? "active" : "")?>"><a href="#<?=generate_name($city['title'])?>-bus" aria-controls="<?=generate_name($city['title'])?>-bus" role="tab" data-toggle="tab"><?=$city['title']?></a></li>
								<? $jk++; }?>
							<? }?>
							<? if($_cities_count[2]['bus']){?>
								<li class="dropdown">
							    	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="busss-onblue"></i> <span class="oferte-tab-list__text">Plecari din alte orase</span> <span class="caret"></span></a>
							    	<ul class="dropdown-menu">
							    		<? foreach($_cities[2]['bus'] as $k => $city){?>
							    			<? if($city['continents']){?>
								        		<li><a href="#<?=generate_name($city['title'])?>-bus" aria-controls="<?=generate_name($city['title'])?>-bus" role="tab" data-toggle="tab">Plecare din <?=$city['title']?></a></li>
							        		<? }?>
							        	<? }?>
							      	</ul>
							    </li>
						    <? }?>
						</ul>
						<div class="tab-content">
							<?/*
							<? foreach(array(1, 2) as $city_from){?>
								<? $jk = 0; foreach($_cities[$city_from]['bus'] as $k => $city){?>
									<? if(count($city['continents']) > 1){?>
										<div role="tabpanel" class="tab-pane <?=($jk==0 && $city_from==1 ? "active" : "")?>" id="<?=generate_name($city['title'])?>-bus">
											<div class="row">
												<? foreach($city['continents'] as $c => $continent){?>
													<div class="col-ms-6 col-sm-6 col-md-4 <?=count($continent['countries']) > 10 ? "mb30" : ""?>">
														<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-bus']?>">
															<i class="sprite sprite-circuit-<?=$_continent_id_to_css[$continent['id_continent']]?>-s"></i>
															<span class="text-uppercase pull-left"><?=$continent['title']?></span>
															<span class="pull-right text--blue"><?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?></span>
														</a>
														<ul class="list-unstyled">
															<? foreach($continent['countries'] as $country){?>
																<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>"><?=$country['title']?></a></li>
															<? }?>
														</ul>
													</div>
													<? if($c%3==2){?>
														<div class="clearfix"></div>
													<? }?>
												<? }?>
											</div>
										</div>
									<?
									$jk++;
									}elseif(count($city['continents']) == 1){
									?>
										<div role="tabpanel" class="tab-pane <?=($jk==0 && $city_from==1 ? "active" : "")?>" id="<?=generate_name($city['title'])?>-bus">
											<div class="row">
												<? foreach($city['continents'] as $continent){?>
													<div class="col-xs-12">
														<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-bus']?>">
															<i class="sprite sprite-circuit-<?=$_continent_id_to_css[$continent['id_continent']]?>-s"></i>
															<span class="text-uppercase pull-left"><?=$continent['title']?></span>
															<span class="pull-right text--blue"><?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?></span>
														</a>
														<div class="row">
															<div class="col-ms-6 col-sm-4">
																<ul class="list-unstyled">
																	<? foreach($continent['countries'] as $c => $country){?>
																		<li class="oferte-tab-list__item"><a href="<?=$country['url']?>"><?=$country['title']?></a></li>
																		<? if($c == intval(count($continent['countries'])/3) || $c == intval(2*count($continent['countries'])/3)){?>
																</ul>
															</div>
															<div class="col-ms-6 col-sm-4">
																<ul class="list-unstyled">
																		<? }?>
																	<? }?>
																</ul>
															</div>
														</div>
													</div>
												<? }?>
											</div>
										</div>
									<? $jk++; }?>
								<? }?>
							<? }?>
							*/?>

							<!-- listare noua -->
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Bucuresti</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Timisoara</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
							</div>
							<div class="puzzle-masonry-inner-oneplusfour">
									<div class="row">
										<div class="col-xs-12 col-md-6">
											<div class="row">
												<div class="col-xs-12">
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Budapesta</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
													<h2 class="oferte-tab-list__puzzle-title">[<i class="sprite gofrom-plane-icon"></i>Pachete de vacanta din <span class="upper">Sibiu</span>]</h2>
												</div>
											</div>

											<div class="row">
												<div class="col-xs-12 regular">
													<div class="oferte-tab-list__content-wrapper">
														<div class="oferte-tab-list__content">
															<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="<?=$continent['url-plane']?>">
																<span class="text-uppercase pull-left">[<?=$continent['title']?>]</span>
																<span class="pull-right text--blue oferte-tab-list__contor">[<?=$continent['count']?> ofert<?=$continent['count'] > 1 ? "e" : "a"?>]</span>
															</a>
															<ul class="list-unstyled">
																<? foreach($continent['countries'] as $country){?>
																	<li class="oferte-tab-list__item <?=count($continent['countries']) > 10 ? "two-per-row" : ""?>"><a href="<?=$country['url']?>">[<?=$country['title']?>]</a></li>
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
							</div>
							<!-- end listare noua -->
						</div>
					</div>
				</div>
				<div class="row margin--top-10" id="calendar">
					<div class="col-xs-12">
						<!-- titlu pagina -->
						<h2 class="logo-title logo-title--full margin--bottom-40">
							<div class="ipi-icons">
								<i class="sprite ipi-plane-icon"></i>
								<i class="sprite ipi-bus-icon"></i>
							</div>
							<span class="logo-title__text">Calendar circuite</span>
						</h2>
						<!-- end titlu pagina -->
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="calendar-nav month-slider">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<div class="row">
										<div class="swiper-container ">
		        							<div class="swiper-wrapper">
		        								<? foreach($_months_circuits as $k => $month){?>
		        									<div class="col-md-4 swiper-slide" data-month="<?=$month['month']."-".$month['year']?>">
														<p class="text-center">
															<a class="hover-opacity" href="#">
																<?=$_months[$month['month']]?>
															</a>
														</p>
													</div>
		        								<? }?>
											</div>
											 <!-- Add Arrows -->
									        <div class="swiper-button-next"></div>
									        <div class="swiper-button-prev"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<? foreach($_months_circuits as $k => $month){?>
						<div data-month="<?=$month['month']."-".$month['year']?>" class="tab-month <? if($k > 0){?> hidden <? }?>">
							<? foreach($month['offers'] as $item){?>
								<div class="col-ms-6 col-sm-4 col-md-3 calendar-item">
									<a class="calendar-item__link" href="<?=$item['url']?>">
										<div class="calendar-item__date">
											<i class="sprite sprite-calendar-<? if($item['type'] == "plane"){?>avion<? }else{?>bus<? }?>"></i>
											<i class="sprite sprite-calendar-sep"></i>
											<div class="calendar-item__date__wrapper">
												<span class="calendar-item__date__day"><?=$item['day']?></span>
												<span class="calendar-item__date__month"><?=$_months_small[$item['month']]?></span>
											</div>
										</div>
										<div class="calendar-item__text">
											<p class="calendar-item__text__title"><?=$item['title']?></p>
											<hr>
											<p class="calendar-item__text__sub">
												<!-- plecare din -->
												• Plecare din Bucuresti<br>
												<!-- end plecare din -->
												• <?=$item['days']?> zile / <?=$item['nights']?> nopti
											</p>
										</div>
										<? if($item['expired']){?>
											<p class="items__item__epuizat"><i class="sprite sprite-awareness"></i>LOCURI EPUIZATE</p>
										<? }else{ ?>
											<? if($item['last_chance']){?>
												<p class="items__item__epuizat__last">
													<i class="warning-small-icon"></i>
													<? if($item['last_chance'] == 1){?>
														ULTIMUL LOC
													<? }else{?>
														ULTIMELE <?=$item['last_chance']?> LOCURI
													<? }?>
												</p>
											<? }?>
										<? }?>
										<i class="calendar-item-arrow"></i>
									</a>
								</div>
							<? } ?>
							<!-- mai multe -->
							<div class="col-ms-6 col-sm-4 col-md-3 calendar-item">
								<a class="calendar-item__link more" href="#">
									[vezi circuitele lunii
									<span>OCTOMBRIE</span> <i class="calendar-item-more"></i>]
								</a>
							</div>
							<!-- end mai multe -->
						</div>
					<? }?>
				</div>

				<?/*
				<div class="row">
					<div class="col-xs-12">
						<div class="calendar-nav month-slider" id="month-slider-second">
							<div class="row">
								<div class="col-md-8 col-md-offset-2">
									<div class="row">
										<div class="swiper-container ">
		        							<div class="swiper-wrapper">
		        								<? foreach($_months_circuits as $k => $month){?>
		        									<div class="col-md-4 swiper-slide" data-month="<?=$month['month']."-".$month['year']?>">
														<p class="text-center">
															<a class="hover-opacity" href="#">
																<span><?=$_months[$month['month']]." ".$month['year']?></span>
															</a>
														</p>
													</div>
		        								<? }?>
											</div>
											 <!-- Add Arrows -->
									        <div class="swiper-button-next sprite sprite-swipe-right-white"></div>
									        <div class="swiper-button-prev sprite sprite-swipe-left-white"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				*/?>

				<!-- un paragraf -->
				<div class="definal">
					[Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.]
				</div>
				<!-- end un paragraf -->

				<?/*
				<div class="row">
					<div class="col-xs-12 text-center">
						<br><br>
						<a href="<?=route('guides')?>"><img src="<?=$_base?>static/img/banner-guides.jpg"></a>
						<br><br><br><br>
					</div>
				</div>
				*/?>

			</div>
		</div>
	</div>

	<? if(isset($_GET['m']) && isset($_GET['y'])){?>
		<?
		$initial_slide = 0;
		foreach($_months_circuits as $k => $month){
			if($month['month']."-".$month['year'] == $_GET['m']."-".$_GET['y']){
				$initial_slide = $k;
			}
		}
		?>
		<script>
			$(document).ready(function(){
				$('html,body').animate({
		       		scrollTop: $('#calendar').offset().top
		        }, 500);

		        var swiperCalendar = new Swiper('.month-slider .swiper-container', {
			        pagination: '.month-slider .swiper-pagination',
			        slidesPerView: 3,
			        paginationClickable: true,
			        spaceBetween: 0,
			        nextButton: '.month-slider .swiper-button-next',
			        prevButton: '.month-slider .swiper-button-prev',
			        centeredSlides: true,
			        initialSlide: <?=$initial_slide?>,
			        slideToClickedSlide: true,
			        loop: false,
			        onSlideChangeStart : function() {
			        	$('.month-slider .swiper-slide-active span').append('<i class="sprite sprite-calendar"></i>');
			        	$current_month = $('.month-slider .swiper-slide-active').data('month');
			        	$('.tab-month').addClass('hidden');
			        	$('.tab-month[data-month="'+$current_month+'"]').removeClass('hidden');
			        },
			        onInit : function() {
			        	$('.month-slider .swiper-slide-active span').append('<i class="sprite sprite-calendar"></i>');
			        }
			    });

			    $('#month-slider-second .swiper-button-next').click(function(){
			    	$('html,body').animate({
			       		scrollTop: $('#calendar').offset().top - 200
			        }, 500);
			    });

			     $('#month-slider-second .swiper-button-prev').click(function(){
			    	$('html,body').animate({
			       		scrollTop: $('#calendar').offset().top - 200
			        }, 500);
			    });

			});
		</script>
	<? }else{ ?>
		<script>
			$(document).ready(function(){
				if(location.hash !== '') {
			        $('a[href="' + location.hash + '"]').trigger('click');
			        setTimeout(function() {
			            $(window).scrollTop(250);
			        }, 5);
			    }

				$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			       if(history.pushState) {
			            history.pushState(null, null, '#'+$(e.target).attr('href').substr(1));
			       } else {
			            location.hash = '#'+$(e.target).attr('href').substr(1);
			       }
			    });

		        var swiperCalendar = new Swiper('.month-slider .swiper-container', {
			        pagination: '.month-slider .swiper-pagination',
			        slidesPerView: 3,
			        paginationClickable: true,
			        spaceBetween: 0,
			        nextButton: '.month-slider .swiper-button-next',
			        prevButton: '.month-slider .swiper-button-prev',
			        centeredSlides: true,
			        //initialSlide: 1,
			        slideToClickedSlide: true,
			        loop: false,
			        onSlideChangeStart : function() {
			        	$('.month-slider .swiper-slide-active span').append('<i class="sprite sprite-calendar"></i>');
			        	$current_month = $('.month-slider .swiper-slide-active').data('month');
			        	$('.tab-month').addClass('hidden');
			        	$('.tab-month[data-month="'+$current_month+'"]').removeClass('hidden');
			        },
			        onInit : function() {
			        	$('.month-slider .swiper-slide-active span').append('<i class="sprite sprite-calendar"></i>');
			        }
			    });

			    $('#month-slider-second .swiper-button-next').click(function(){
			    	$('html,body').animate({
			       		scrollTop: $('#calendar').offset().top - 200
			        }, 500);
			    });

			     $('#month-slider-second .swiper-button-prev').click(function(){
			    	$('html,body').animate({
			       		scrollTop: $('#calendar').offset().top - 200
			        }, 500);
			    });

			});
		</script>
    <!-- }); -->
	<? }?>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
