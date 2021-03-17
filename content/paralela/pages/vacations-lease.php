<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid margin--top-50 info-pages-content">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 p-util-wrapper">
						<div class="row">
							<div class="col-md-3">
								<div class="aside-filters-sidebar">
									<h3>Link-uri utile</h3>
									<? include $_theme_path.'common/sidebars/sidebar-info.php' ?>
								</div>
							</div>
							<div class="col-md-9 vacations-lease">
								<h2 class="logo-title logo-title--full">
									<span class="logo-title__text">Vacante in rate</span>
								</h2>
								<?  if($_texts){ $x = count($_texts); $i = 0; foreach($_texts as $k => $text){ $i++; ?>
									<div class="p-util-section">
										<h4><?= $text['title'] ?></h4>
										<?= $text['description'] ?>
									</div>
									<? if($i != $x){ ?>
									<hr class="delim" />
									<? } ?>
								<? } }  ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<? //include $_theme_path.'common/boxes/box_learn_more_about.php' ?>
	<? //include $_theme_path.'common/boxes/box_partners.php' ?>

</main>
