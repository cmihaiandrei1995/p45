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
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<!-- titlu pagina -->
						<h1 class="logo-title logo-title--full">
							<div class="ipi-icons">
								<i class="sprite ipi-car-icon"></i>
								<i class="sprite ipi-hotel-icon"></i>
							</div>
							<span class="logo-title__text"><?=$_text['title']?></span>
							<div class="inner-page-subtitle"><?= $_text['description']?></div>
						</h1>
						<!-- end titlu pagina -->
					</div>
				</div>
				<!-- listare noua -->
				<div class="puzzle-masonry-inner-oneplusfour oferte-tab-list">
					<?/*<? foreach($_countries as $c => $country){?>*/?>
						<div class="row">
							<div class="col-md-6 col-lg-3 verytall">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/249x445">
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 tall">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/424x250">
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 tall">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/332x250">
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 small">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/332x187">
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3 col-lg-5 small">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "three-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/424x187">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-ms-6 col-sm-6 col-lg-3 regular">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/248x215">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-ms-6 col-sm-6 col-lg-3 regular">
								<div class="oferte-tab-list__content-wrapper">
									<div class="oferte-tab-list__content">
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
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
										<div class="oferte-tab-list__title">
											<span class="text-uppercase"><?=$country['title']?></span>
											<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
										</div>

										<ul class="list-unstyled">
											<? foreach($country['cities'] as $city){?>
												<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
											<? }?>
										</ul>
									</div>
									<a href="" class="see-all">vezi toate ofertele »</a>
									<div class="blue-cover"></div>
									<img src="https://via.placeholder.com/248x215">
								</div>
							</div>
						</div>
					<?/*<? }?>*/?>
				</div>
				<!-- end listare noua -->

				<?/*
				<div class="row">
					<? foreach($_countries as $c => $country){?>
						<div class="col-ms-6 col-sm-4 <?=count($country['cities']) > 8 ? "mb30" : ""?>">
							<div class="oferte-tab-list__title">
								<a href="<?=$country['url']?>" title="<?=$country['title']?>" class="oferte-tab-list-title-link">
									<span class="text-uppercase"><?=$country['title']?></span>
									<span class="pull-right text--blue"><?=$country['count']?> oferte</span>
								</a>
							</div>
							<ul class="list-unstyled">
								<? foreach($country['cities'] as $city){?>
									<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
								<? }?>
							</ul>
						</div>
						<? if($c%3==2){?>
							<div class="clearfix hidden-sm"></div>
						<? }?>
					<? }?>
				</div>
				*/?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="definal">
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
