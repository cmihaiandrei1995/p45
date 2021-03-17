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
						<h1 class="logo-title logo-title--full margin--bottom-40">
							<div class="ipi-icons">
								<i class="sprite ipi-car-icon"></i>
								<i class="sprite ipi-hotel-icon"></i>
							</div>
							<span class="logo-title__text"><?=$_text['title']?></span>
                            <div class="inner-page-subtitle"><?=$_text['description']?></div>
						</h1>
						<!-- end titlu pagina -->
					</div>
                </div>

                <!-- listare noua -->
                <? if($_tags){?>
				<div class="puzzle-masonry-inner-oneplusfour oferte-tab-list">
                    <? foreach($_tags as $tag){?>
					<div class="row">
						<div class="col-ms-6 col-sm-6 col-lg-3 verytall">
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
                        <div class="col-ms-6 col-sm-6 col-lg-3 verytall">
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
                        <div class="col-ms-6 col-sm-6 col-lg-3 verytall">
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
                                    <?/*
									<div class="oferte-tab-list__title">
										<span class="text-uppercase"><?=$country['title']?></span>
										<span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
									</div>

									<ul class="list-unstyled">
										<? foreach($country['cities'] as $city){?>
											<li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>"><a href="<?=$city['url']?>"><?=$city['title']?> ›</a></li>
										<? }?>
									</ul>
                                    */?>

                                    <div class="block-destination">
                                        <p class="destination"><?=$tag['title']?></p>
                                        <span class="pull-right text--blue oferte-tab-list__contor"><strong><?=$country['count']?></strong> ofert<?=$country['count'] > 1 ? "e" : "a"?></span>
                                    </div>
                                    <div class="destination-z">
                                        <ul class="list-unstyled">
                                            <? foreach($tag['cities'] as $kc => $city){?>
                                                <li class="oferte-tab-list__item <?=count($country['cities']) > 8 ? "two-per-row" : ""?>">
                                                <a href="<?=$city['url']?>"><?=$city['title']?> ›</a>
                                            </li>
                                            <? }?>
                                        </ul>
                                    </div>
								</div>
								<a href="" class="see-all">vezi toate ofertele »</a>
								<div class="blue-cover"></div>
								<img src="https://via.placeholder.com/248x215">
							</div>
						</div>
					</div>
                    <? }?>
				</div>
                <? }?>
				<!-- end listare noua -->

                <?/*
                <? if($_tags){?>
	                <div class="row block-list lp-block-list">
	                    <? foreach($_tags as $tag){?>
	                        <div class="col-sm-<?=count($_tags) == 4 ? 6 : 12?> col-md-<?=count($_tags) == 4 ? 6 : 4?> text-center">
	                            <div class="block blk-blk">
	                                <div class="block-details">
	                                    <div class="block-destination"><p class="destination"><?=$tag['title_front']?></p></div>
	                                    <div class="destination-z">
	                                    	<div class="row">
	                                    		<div class="col-xs-<?=count($tag['cities']) > 6 ? 6 : 12?>">
			                                    	<? foreach($tag['cities'] as $kc => $city){?>
			                                        	<a href="<?=$city['url']?>"><?=$city['title']?> ›</a>
			                                        	<? if($kc == intval(count($tag['cities']) / 2)-1 && count($tag['cities']) > 6){?>
			                                        	</div>
			                                        	<div class="col-xs-6">
			                                        	<? }?>
			                                        <? }?>
		                                        </div>
	                                        </div>
	                                        <a href="<?=$tag['url']?>" class="btn btn--green destination-z-btn"><span>vezi toate ofertele ›</span></a>
	                                    </div>
	                                </div>
	                                <? if(count($_tags) == 4){?>
	                                	<img src="<?=$tag['images'][0]['big']?>" alt="<?=$tag['title_front']?>" class="hidden-xs hidden-sm hidden-md">
	                                	<img src="<?=$tag['images'][0]['small']?>" alt="<?=$tag['title_front']?>" class="hidden-lg">
	                                <? }?>
	                                <? if(count($_tags) < 4){?>
	                                	<img src="<?=$tag['images'][0]['small']?>" alt="<?=$tag['title_front']?>" class="hidden-sm">
	                                	<img src="<?=$tag['images'][0]['big']?>" alt="<?=$tag['title_front']?>" class="visible-sm">
	                                <? }?>
	                            </div>
	                        </div>
	                    <? }?>
	                </div>
	        	<? }?>
                */?>
            </div>
        </div>
    </div>

    <?/*
    <? if($_tags_special){?>
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 hr-title">
                            <hr class="hr-title__hr">
                            <h3 class="hr-title__text text-uppercase text--blue text-center">OFERTE SPECIALE<br />VACANTE IN ROMANIA</h3>
                        </div>
                    </div>

	                <div class="row block-list lp-block-list">
	                    <? foreach($_tags_special as $tag){?>
	                        <div class="col-sm-<?=count($_tags_special) == 4 ? 6 : 12?> col-md-<?=count($_tags_special) == 4 ? 6 : 4?> text-center">
	                            <div class="block blk-blk">
	                                <div class="block-details">
	                                    <div class="block-destination"><p class="destination"><?=$tag['title']?></p></div>
	                                    <div class="destination-z">
	                                    	<div class="row">
	                                    		<div class="col-xs-<?=count($tag['cities']) > 6 ? 6 : 12?>">
			                                    	<? foreach($tag['cities'] as $kc => $city){?>
			                                        	<a href="<?=$city['url']?>"><?=$city['title']?> ›</a>
			                                        	<? if($kc == intval(count($tag['cities']) / 2)-1 && count($tag['cities']) > 6){?>
			                                        	</div>
			                                        	<div class="col-xs-6">
			                                        	<? }?>
			                                        <? }?>
		                                        </div>
	                                        </div>
	                                        <a href="<?=$tag['url']?>" class="btn btn--green destination-z-btn"><span>vezi toate ofertele ›</span></a>
	                                    </div>
	                                </div>
	                                <? if(count($_tags_special) == 4){?>
	                                	<img src="<?=$tag['images'][0]['big']?>" alt="<?=$tag['title']?>" class="hidden-xs hidden-sm hidden-md">
	                                	<img src="<?=$tag['images'][0]['small']?>" alt="<?=$tag['title']?>" class="hidden-lg">
	                                <? }?>
	                                <? if(count($_tags_special) < 4){?>
	                                	<img src="<?=$tag['images'][0]['small']?>" alt="<?=$tag['title']?>" class="hidden-sm">
	                                	<img src="<?=$tag['images'][0]['big']?>" alt="<?=$tag['title']?>" class="visible-sm">
	                                <? }?>
	                            </div>
	                        </div>
	                    <? }?>
	                </div>

                    <?/*comentariu mai vechi
                    <div class="row block-list">
                        <div class="col-md-12">
                            <div class="block block-full">
                                <div class="row">
                                    <div class="col-md-8 block-full-img">
                                        <img src="<?=$_base?>static/img/vd-all.jpg" alt="">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="block-details">
                                            <div class="block-destination"><p class="destination">LITORAL ROMANIA</p></div>
                                            <div class="destination-z">
                                                <a href="#">Eforie Nord  ›</a>
                                                <a href="#">Jupiter ›</a>
                                                <a href="#">Mamaia  ›</a>
                                                <a href="#">Neptun ›</a>
                                                <a href="#">Saturn ›</a>
                                                <a href="#">Venus ›</a>
                                                <button class="btn btn--green"><span>vezi toate ofertele  ›</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    */?>
                    <?/*
                </div>
            </div>
        </div>
    <? }?>
    */?>

    <?/*<? include $_theme_path.'common/boxes/box_testimonials.php' ?>*/?>
    <?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
    <? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
