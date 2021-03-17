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

	<div class="container-fluid page-inner">
		<div class="row">
			<div class="container">

				<?
				/*
				$_step = 1;
				$_step_type = "Hotel";
				include $_theme_path.'common/steps.php';
				*/
				?>

				<div class="row big-category">
					<div class="col-xs-12">
						<h1 class="page-inner-title">
							<?=$_offer_type." ".$_title." cu plecare din ".$_city_from['title']?>
						</h1>
					</div>

					<div class="col-xs-12">
						<div class="page-inner-ordering">
							<div class="row">
								<div class="col-sm-9">
									<!-- numar oferte -->
									<p>[Am gasit <strong>300 oferte</strong>]</p>
									<!-- end numar oferte -->
								</div>
								<div class="col-sm-3 text-sm-right">
									<label>Ordonare:</label>
									<div class="items__select__wrapper dropwdown-sortare">
										<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle sortare" type="button" data-toggle="dropdown"> Sortare
										  	<span class="caret"></span></button>
										  	<ul class="dropdown-menu">
										  		<li <? if($_GET['srt'] == "rc" || !isset($_GET['srt'])){?> class="active" <? }?>><a href="<?= get_offer_sort_link('rc') ?>">Recomandate</a></li>
											  	<li <? if($_GET['srt'] == "pra"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('pra') ?>">Pret crescator</a></li>
											    <li <? if($_GET['srt'] == "prd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('prd') ?>">Pret descrescator</a></li>
											    <li <? if($_GET['srt'] == "dsc"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('dsc') ?>">Discount</a></li>
											    <!--
											    <li <? if($_GET['srt'] == "sa"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sa') ?>">Nr stele crescator</a></li>
											    <li <? if($_GET['srt'] == "sd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sd') ?>">Nr stele descrescator</a></li>
											    <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
											    <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
											    -->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<? if($_show_logo_stay_sunny){ ?>
						<!--
							<div class="col-xs-12 col-sm-3 sunny-logo">
								<a href="#"><img class="pull-right" src="<?= $_base ?>static/img/sunny.jpg" /></a>
							</div>
						-->
					<? } ?>

					<?/*
					<div class="col-xs-12 oferte-tab-list">
						<ul class="nav nav-pills">
							<? foreach($_other_cities_from as $city){?>
								<li <? if($city['id_city'] == $_city_from['id_city']){?>class="active"<? }?>><a href="<?=$city['url']?>"><i class="sprite sprite-pills-avion"></i><span class="oferte-tab-list__text">Plecare din <?=$city['title']?></span></a></li>
							<? }?>
						</ul>
					</div>
					*/?>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-3 aside-filters">
						<div class="oferte-tab-list">
							<div class="oferte-tab-list-title">[<i class="sprite sprite-pills-avion"></i> Orase de plecare:]</div>
							<ul class="nav nav-pills">
								<? foreach($_other_cities_from as $city){?>
									<li <? if($city['id_city'] == $_city_from['id_city']){?>class="active"<? }?>><a href="<?=$city['url']?>">	<span class="oferte-tab-list__text">[<?=$city['title']?></span>]</a></li>
								<? }?>
							</ul>
						</div>

						<div class="aside-filters__map">
							<p class="aside-filters__sub" role="button" data-toggle="" data-target="" aria-expanded="true" aria-controls="">Lorem ipsum</p>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5697.283825176272!2d26.08942772218858!3d44.44050709643669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcbeb2be389029af8!2sParalela+45+Turism!5e0!3m2!1sro!2sro!4v1560255678232!5m2!1sro!2sro" width="237" height="140" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>

						<?/*
						<div class="aside-filters--bg">
							<div class="row">
								<?php include $_theme_path.'common/forms/sidebar/charters.php'; ?>
							</div>

						</div>

						<p class="aside-filters__title"><strong><?=$_count_items_filters?></strong> <span>oferte</span><br>Filtreaza rezultatele</p>
						*/?>

						<?php include $_theme_path."tourism/include/filters.php";?>

						<? if(!$_is_category){?>
							<?php include $_theme_path."tourism/include/weather.php";?>
						<? }?>

						<? /*
						<div class="aside-filters__asistenta hidden-xs">
							<p class="aside-filters__asistenta__title"><strong>Asistenta locala permanenta</strong></p>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Rodos</h4>
									<p><i class="sprite sprite-asistenta-person"></i> Ilona Chirila</p>
									<p><i class="sprite sprite-asistenta-phone"></i> <a href="tel:00306943470065">0030-694.347.0065</a></p>
								</div>
							</div>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading">Rodos</h4>
									<p><i class="sprite sprite-asistenta-person"></i> Ilona Chirila</p>
									<p><i class="sprite sprite-asistenta-phone"></i> <a href="tel:00306943470065">0030-694.347.0065</a></p>
								</div>
							</div>
						</div>
						*/ ?>

						<!-- zona bannere -->
						<div class="banner" style="background-image: url(<?= $_base?>static/img/banner.jpg);">
							<div class="swiper-circuit__pret__wrapper">
								<span class="swiper-circuit__pret__text" style="">de la</span>
								<p class="swiper-circuit__pret">
									<span class="swiper-circuit__pret__number">[165€]</span><br>
								</p>
							</div>
							<p class="last">[Last Minute]</p>
							<p class="where">[ANTALYA]</p>
							[Plecare 30.06.2019]
							<a class="btn btn--green items__item__btn" href="">[Rezerva acum]</a>
						</div>

						<div class="banner ondrkbg" style="background-image: url(<?= $_base?>static/img/altbanner.jpg);">
							<div class="swiper-circuit__pret__wrapper">
								<span class="swiper-circuit__pret__text" style="">de la</span>
								<p class="swiper-circuit__pret">
									<span class="swiper-circuit__pret__number">[165€]</span><br>
								</p>
							</div>
							<p class="last">[Last Minute]</p>
							<p class="where">[ANTALYA]</p>
							[Plecare 30.06.2019]
							<a class="btn btn--green items__item__btn" href="">Rezerva acum</a>
						</div>
						<!-- end zona bannere -->
						<div class="clearfix"></div>
					</div>

					<div class="col-md-9 items">
						<? /*
                        <div class="items__title--bg">
							 <div class="row">
								<div class="col-ms-7 col-sm-7 col-md-8">
									<h2 class="items__title"><i class="sprite sprite-sun"></i> <?=$_offer_type." ".$_title." cu plecare din ".$_city_from['title']?></h2>
								</div>
								<div class="col-ms-5 col-sm-5 col-md-4">
									<div class="items__select__wrapper dropwdown-sortare">
										<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle sortare" type="button" data-toggle="dropdown"> Sortare
										  	<span class="caret"></span></button>
										  	<ul class="dropdown-menu">
											  	<li <? if($_GET['srt'] == "pra" || !isset($_GET['srt'])){?> class="active" <? }?>><a href="<?= get_offer_sort_link('pra') ?>">Pret crescator</a></li>
											    <li <? if($_GET['srt'] == "prd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('prd') ?>">Pret descrescator</a></li>
											    <li <? if($_GET['srt'] == "dsc"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('dsc') ?>">Discount</a></li>
											    <!--
											    <li <? if($_GET['srt'] == "sa"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sa') ?>">Nr stele crescator</a></li>
											    <li <? if($_GET['srt'] == "sd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sd') ?>">Nr stele descrescator</a></li>
											    <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
											    <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
                                                -->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
                        */ ?>

						<? if(isset($_GET['error'])){?>
							<div class="alert alert-danger">
								Nu am gasit nimic disponibil pentru perioada cautata. Descopera toate hotelurile noastre din <?=$_title?>
							</div>
						<? }?>

						<?php foreach($_items as $ki => $item) { ?>

							<?php include $_theme_path."charters/include/charter_box.php";?>

						<?php } ?>

						<div class="row">
							<div class="col-xs-12 text-center">
								<?php print_pagination(array('items_count' => $_new_count_items, 'per_page' => $_ipp))?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid inner-banner inner-banner__charter back-image-form inner-page-info">
		<div class="row">
			<div class="col-xs-12">
				<div class="container">
					<div class="row">
						<? if($flights_departure && $flights_return){?>
							<div class="col-xs-12 main-filters main-filters__charter">
								<div class="row">
									<div class="col-md-6">
										<p class="main-filters__charter__title">
											<i class="sprite sprite-world-plane-white"></i>
											<strong><?=$_offer_type." ".$_title?></strong><br>
											<span class="text-uppercase">ORAR INFORMATIV DE ZBOR</span>
											<span>(ore locale)</span>
										</p>
									</div>
								</div>
								<div class="row main-filters__charter--bg">
									<? if(count($flights_departure) > 2){ ?>
										<div class="swiper-container swiper-chartere-head">
											<div class="swiper-wrapper">
									<? } ?>
									<?  for($i=0; $i<count($flights_departure); $i++){ ?>

										<div class="col-ms-10 col-ms-offset-1 col-md-<?=max(6, 1/count($flights_departure)*12)?> col-md-offset-0 <?= count($flights_departure) > 2 ? 'swiper-slide': '' ?>">
											<p class="main-filters__charter__sub">
												Plecari <span class="text-uppercase"><?=$_week_days_mysql[$flights_departure[$i]['departure_day']]?></span>
												<? if($flights_departure[$i]['min_departure'] != $flights_departure[$i]['max_departure']){?>
													in perioada: <?=date("d.m.Y", strtotime($flights_departure[$i]['min_departure']))?> - <?=date("d.m.Y", strtotime($flights_departure[$i]['max_departure']))?>
												<? }else{ ?>
													<?=date("d.m.Y", strtotime($flights_departure[$i]['min_departure']))?>
												<? }?>
												<!--
												<img class="main-filters__charter__airline__img" src="http://placehold.it/70x25/000000/ffffff" alt="...">
												-->
											</p>
											<ul class="list-unstyled">
												<li class="main-filters__charter__item">
													<ul class="list-unstyled list-inline">
														<li><i class="sprite sprite-arrow-blue-right"></i></li>
														<li><?=$_city_from['title']//$flights_departure[$i]['departure_city']?></li>
														<li><?=date("H:i", strtotime($flights_departure[$i]['departure_time'])) != "00:00" ? date("H:i", strtotime($flights_departure[$i]['departure_time'])) : "00:00"?> – <?=$flights_departure[$i]['arrival_city']//$_title_destination?></li>
														<li><?=date("H:i", strtotime($flights_departure[$i]['arrival_time'])) != "00:00" ? date("H:i", strtotime($flights_departure[$i]['arrival_time'])) : "00:00"?></li>
														<li>| <?=$flights_departure[$i]['flight_company']?> <?=trim($flights_departure[$i]['flight_number']) != "" ? " - ".$flights_departure[$i]['flight_number'] : ""?></li>
													</ul>
												</li>
												<li class="main-filters__charter__item">
													<ul class="list-unstyled list-inline">
														<li><i class="sprite sprite-arrow-blue-left"></i></li>
														<li><?=$flights_return[$i]['departure_city']//$_title_destination?></li>
														<li><?=date("H:i", strtotime($flights_return[$i]['departure_time'])) != "00:00" ? date("H:i", strtotime($flights_return[$i]['departure_time'])) : "00:00"?> – <?=$_city_from['title']//$flights_return[$i]['arrival_city']?></li>
														<li><?=date("H:i", strtotime($flights_return[$i]['arrival_time'])) != "00:00" ? date("H:i", strtotime($flights_return[$i]['arrival_time'])) : "00:00"?></li>
														<li>| <?=$flights_return[$i]['flight_company']?> <?=trim($flights_return[$i]['flight_number']) != "" ? " - ".$flights_return[$i]['flight_number'] : ""?></li>
													</ul>
												</li>
											</ul>
										</div>
									<? }?>

									<? if(count($flights_departure) > 2){ ?>
											</div>
											<!-- Add Pagination -->
									        <div class="swiper-pagination hidden-lg  swiper-pagination-bullets"></div>
									        <!-- Add Arrows -->
											<div class="swiper-button-prev hidden-sm hidden-xs"><i class="sprite sprite-swipe-left-blue-white"></i></div>
											<div class="swiper-button-next hidden-sm hidden-xs"><i class="sprite sprite-swipe-right-blue-white"></i></div>
										</div>
									<? } ?>

								</div>
							</div>
						<? }else{ ?>
							<div class="row">
								<?php include $_theme_path.'common/forms/home_forms.php'; ?>
							</div>
						<? }?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_testimonials.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
