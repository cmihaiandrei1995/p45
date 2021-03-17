
<main class="margin--bottom-100">
	<div class="container-fluid inner-banner inner-banner-about">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper text-center">
						<div class="black-layer lighter-layer"></div>
					<img class="img-banner__img object-fit wwpropos" src="<?= $_base ?>static/img/banner-procente.jpg" alt="..." />
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid margin--top-50">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="logo-title logo-title--full"><span class="logo-title__text"><?= $_text['title'] ?></span> <span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span></h2>
					</div>
				</div>
				<div class="row p-util-wrapper">
					<div class="col-md-3">
						<? include $_theme_path.'common/sidebars/sidebar-info.php' ?>
					</div>
					<div class="col-md-9">
						<div class="p-util-section cr">
							<?= $_text['description'] ?>
						</div>

						<? foreach($_texts as $item){ ?>
							<hr class="delim" />
							<div class="p-util-section cr full-text-toggle">
								<h4><?= $item['title'] ?></h4>
								<p class="date"><?= $item['period'] ?></p>
								<img src="<?= $item['images'][0]['medium'] ?>" class="pr imgpr" />
								<p><?= $item['description'] ?></p>
								<a class="more-details show-full-text" id="show-full-text" href="#">Citeste mai mult</a>
							</div>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
