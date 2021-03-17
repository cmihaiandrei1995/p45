<main>
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

	<div class="container-fluid page-inner">
		<div class="row">
			<div class="container">

				<? /*
				$_step = 1;
				$_step_type = "Circuit";
				include $_theme_path.'common/steps.php'; */
				?>

				<div class="row big-category">
					<div class="col-xs-12">
						<h1 class="page-inner-title">
							<?=$_title?>
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
											  	<li <? if($_GET['srt'] == "pra" || !isset($_GET['srt'])){?> class="active" <? }?>><a href="<?= get_offer_sort_link('pra') ?>">Pret crescator</a></li>
											    <li <? if($_GET['srt'] == "prd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('prd') ?>">Pret descrescator</a></li>
											    <li <? if($_GET['srt'] == "dsc"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('dsc') ?>">Discount</a></li>
											    <!--
											    <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
											    <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
											    <li <? if($_GET['srt'] == "na"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('na') ?>">Nr zile crescator</a></li>
										    	<li <? if($_GET['srt'] == "nd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('nd') ?>">Nr zile descrescator</a></li>
										    	-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-3 aside-filters">
						<!-- orase de plecare -->
						<div class="oferte-tab-list">
							<div class="oferte-tab-list-title">[<i class="sprite sprite-pills-avion"></i> Orase de plecare:]</div>
							<ul class="nav nav-pills">
								<? foreach($_other_cities_from as $city){?>
									<li <? if($city['id_city'] == $_city_from['id_city']){?>class="active"<? }?>><a href="<?=$city['url']?>">	<span class="oferte-tab-list__text">[<?=$city['title']?>]</span></a></li>
								<? }?>
							</ul>
						</div>
						<!-- end orase de plecare -->

						<?/*
						<div class="aside-filters--bg">
							<div class="row">
								<?php include $_theme_path.'common/forms/sidebar/circuits.php'; ?>
							</div>
						</div>
						<p class="aside-filters__title"><strong><?=$_count_items_filters?></strong> <span>oferte</span><br>Filtreaza rezultatele</p>
						*/?>

						<?php include $_theme_path."circuits/include/filters.php";?>

						<!--
						<div class="aside-filters__ghizi hidden-xs">
							<p class="aside-filters__ghizi__title"><strong>Ghizi cu experienta pentru vacantele tale</strong></p>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><i class="sprite sprite-flag"></i> Ilona Chirila</h4>
									<p><a href="#">Detalii ...</a></p>
								</div>
							</div>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><i class="sprite sprite-flag"></i> Ilona Chirila</h4>
									<p><a href="#">Detalii ...</a></p>
								</div>
							</div>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><i class="sprite sprite-flag"></i> Ilona Chirila</h4>
									<p><a href="#">Detalii ...</a></p>
								</div>
							</div>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><i class="sprite sprite-flag"></i> Ilona Chirila</h4>
									<p><a href="#">Detalii ...</a></p>
								</div>
							</div>
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="http://placehold.it/65x65" alt="...">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading"><i class="sprite sprite-flag"></i> Ilona Chirila</h4>
									<p><a href="#">Detalii ...</a></p>
								</div>
							</div>
						</div>
						-->
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
							<a class="btn btn--green items__item__btn" href="">Rezerva acum</a>
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
						<?/* <div class="items__title--bg">
							<div class="row">
								<div class="col-ms-7 col-sm-7 col-md-8">
									<h2 class="items__title">
										<? if($_params['type']){?>
											<i class="sprite sprite-<?=$_params['type'] == "plane" ? "avion" : "bus"?>-blue"></i>
										<? }?>
										<?=$_title?>
									</h2>
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
											    <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
											    <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
											    <li <? if($_GET['srt'] == "na"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('na') ?>">Nr zile crescator</a></li>
										    	<li <? if($_GET['srt'] == "nd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('nd') ?>">Nr zile descrescator</a></li>

											</ul>
										</div>
									</div>
								</div>
							</div>
						</div> */?>

						<?php foreach($_items as $ki => $item) { ?>

							<? include $_theme_path."circuits/include/circuit_box.php";?>

						<?php } ?>

						<div class="row">
							<div class="col-xs-12 text-center">
								<?php print_pagination(array('items_count' => $_new_count_items, 'per_page' => $_ipp))?>
							</div>
						</div>

						<? if($_items_related){?>

							<? $_is_search = false?>
							<br><br><br>
							<div class="items__title--bg">
								<div class="row">
									<div class="col-ms-7 col-sm-7 col-md-8">
										<h2 class="items__title">
											<?=$_title_related?>
										</h2>
									</div>
								</div>
							</div>

							<?php foreach($_items_related as $item) { ?>

								<? include $_theme_path."circuits/include/circuit_box.php";?>

							<?php } ?>

						<? }?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
