<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/big/cruises.php'; ?>
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
							<div class="inner-page-subtitle"><?=$_text['description']?></div>
						</h1>
						<!-- end titlu pagina -->
					</div>
				</div>
				<?/*
				<div class="row block-list">
					<? foreach($_destinations as $item){?>
						<div class="col-sm-6 col-md-4">
							<div class="block blk-blk">
								<div class="block-details">
									<div class="block-destination"><p class="destination"><?=$item['title']?></p></div>
									<div class="destination-z">
										<!-- <a href="<?=$item['url']?>">Toate destinatiile din <?=$item['title']?> ›</a> -->
										<? foreach($item['destinations'] as $subitem){?>
											<a href="<?=$subitem['url']?>"><?=$subitem['title']?> ›</a>
										<? }?>
										<a href="<?=$item['url']?>" class="btn btn--green destination-z-btn"><span>vezi toate ofertele ›</span></a>
									</div>
								</div>
								<img src="<?=$item['images'][0]['thumb']?>" alt="<?=$item['title']?>" />
							</div>
						</div>
					<? }?>
				</div>
				*/?>

				<!-- listare noua -->
				<div class="puzzle-masonry-inner">
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/262x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="oferte-tab-list__content-wrapper">
								<div class="oferte-tab-list__content">
									<a class="oferte-tab-list__title oferte-tab-list__title--circuite" href="">
									  <span class="text-uppercase pull-left">[ALASKA]</span>
									  <span class="pull-right text--blue oferte-tab-list__contor">[340 oferte]</span>
									</a>
									<ul class="list-unstyled list2col">
										<li><a href="">[Alaska Nord si Sud ›]</a></li>
										<li><a href="">[Alaska Pasajul Interior ›]</a></li>
									</ul>
								</div>
								<a href="" class="see-all">[vezi toate ofertele »]</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/555x215">
							</div>
						</div>
					</div>
				</div>
				<!-- end listare noua -->

				<!-- un paragraf -->
				<div class="definal">
					[Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.]
				</div>
				<!-- end un paragraf -->
			</div>
		</div>
	</div>

	<?/* <? include $_theme_path.'common/boxes/box_new_offers.php' ?> */?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
