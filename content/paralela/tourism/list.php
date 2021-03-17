<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/big/tourism.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="container page-inner">

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
							<?=$_title?>
						</h1>
					</div>

					<div class="col-xs-12">
						<div class="page-inner-ordering">
							<div class="row">
								<div class="col-sm-6">
									<!-- numar oferte -->
									<p>Am gasit <strong>300 oferte</strong></p>
									<!-- end numar oferte -->
								</div>
								<div class="col-sm-6 text-sm-right">
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
											    <? /*
											    <li <? if($_GET['srt'] == "sa"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sa') ?>">Nr stele crescator</a></li>
											    <li <? if($_GET['srt'] == "sd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('sd') ?>">Nr stele descrescator</a></li>
											    <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
											    <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
											    */ ?>
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
						<div class="aside-filters__map">
							<p class="aside-filters__sub" role="button" data-toggle="" data-target="" aria-expanded="true" aria-controls="">Lorem ipsum</p>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5697.283825176272!2d26.08942772218858!3d44.44050709643669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcbeb2be389029af8!2sParalela+45+Turism!5e0!3m2!1sro!2sro!4v1560255678232!5m2!1sro!2sro" width="237" height="140" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
						<?/*
						<div class="aside-filters--bg">
							<div class="row">
								<?
								if($_params['ro']){
									include $_theme_path.'common/forms/sidebar/tourism-ro.php';
								}else{
									include $_theme_path.'common/forms/sidebar/tourism.php';
								}
								?>
							</div>
						</div>

						<p class="aside-filters__title"><strong><?=$_count_items_filters?></strong> <span>oferte</span><br>Filtreaza rezultatele</p>
						*/?>

						<?php include $_theme_path."tourism/include/filters.php";?>

						<?php include $_theme_path."tourism/include/webcam.php"; ?>

						<?php include $_theme_path."tourism/include/weather.php";?>

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
					</div>
					<div class="col-md-9 items">
						<? /*
						<div class="items__title--bg">
							<div class="row">
								<div class="col-ms-7 col-sm-7 col-md-8">
									<h2 class="items__title">
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

							<?php include $_theme_path."tourism/include/hotel_box.php";?>

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

	<?/*<? include $_theme_path.'common/boxes/box_testimonials.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
