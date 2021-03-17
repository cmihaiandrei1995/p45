<main class="home-for-padding">

	<? include $_theme_path.'home/include/home_slider.php';?>

	<?/*<? include $_theme_path.'home/include/circuits_count.php';?>*/?>

	<?/*<? include $_theme_path.'home/include/rate.php';?>*/?>

	<!--
	<? if(date('n') == 2 && date('Y') == 2018){?>
		<? if(date('j') == 22 || date('j') == 23 || date('j') == 24 || date('j') == 25){?>
			<? if(date('G') >= 10){?>
				<? if((date('j') == 25 && date('G') <= 16) || (date('j') != 25 && date('G') <= 18)){?>
					<div class="row">
						<div class="container">
							<a href="http://streaming.mobotixtools.com/live/58a317c32f8bb" target="_blank"><img src="https://www.paralela45.ro/uploads/media/2018/2/21/banner-web-expo-3rip.jpg"></a>
							<br><br><br><br>
						</div>
					</div>
				<? }?>
			<? }?>
		<? }?>
	<? }?>
	-->
	<!-- Se sterg doar ofertele -->
	<? include $_theme_path.'home/include/beneficii.php';?>

	<!-- Banner Asigurari -->
	<div class="containter-fluid hide-print">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 mb30">
						<a href="https://www.magroup-online.com/WL/CLF/RO/ro?agency=7692933" target="_blank">
							<img src="<?=$_base_static?>img/banner-asigurari.jpg" class="img-responsive">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<? //include $_theme_path.'home/include/pachete_vacanta.php';?>

	<?/*
	<?
	$_with_bg = true;
	include $_theme_path.'common/boxes/box_new_offers.php';
	?>
	*/?>

	<?
	foreach($_box_settings as $id => $box){
		if($box['active']){
			switch($id){
				case 1 : 
					include $_theme_path.'home/include/rate.php';
					include $_theme_path.'home/include/experiente.php';
					include $_theme_path.'home/include/chartere_new.php';
					include $_theme_path.'home/include/vacante_iarna.php';
				break;
				case 2 : include $_theme_path.'home/include/circuite.php'; break;
				case 3 : include $_theme_path.'home/include/turism_individual.php'; break;
				case 4 : include $_theme_path.'home/include/turism_intern.php'; break;
				case 5 : include $_theme_path.'home/include/box_offers_croaziere.php'; break;
				case 6 : include $_theme_path.'home/include/box_offers.php'; break;
				case 7 : include $_theme_path.'home/include/box_offers.php'; break;
				case 8 : include $_theme_path.'home/include/box_offers.php'; break;
				case 9 : include $_theme_path.'home/include/box_offers.php'; break;
				case 10: include $_theme_path.'home/include/promo_boxes.php'; break;
				case 11: include $_theme_path.'home/include/turism_seniori.php'; break;
			}
		}
	}
	?>

	<? include $_theme_path.'home/include/box_nl.php';?>

	<? include $_theme_path.'common/boxes/box_avantaje.php';?>

	<? include $_theme_path.'common/boxes/box_sfaturi.php';?>

	<?/*
	<? include $_theme_path.'common/boxes/box_consultanti.php';?>
	*/?>

</main>