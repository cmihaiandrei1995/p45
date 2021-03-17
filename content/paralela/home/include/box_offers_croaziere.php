<div class="onesection">
	<? if($_box_offer[$id] || $_slider_box_offer[$id]){?>
	<div class="container-fluid <? if(!$_box_mobile[$id+11]){?>hidden-xs<? }?>">
		<div class="row">
			<div class="container">
				<div class="row oferte__title__wrapper">
					<div class="col-xs-12 hr-title">
						<h3 class="oferte__title text--blue hr-title__text"><?= $_text_box_offer['section_title'] ?>
							<!--<i class="sprite sprite-oferte-chartere"></i>-->
						</h3>

						<div class="row">
							<div class="col-xs-12 col-md-8 col-md-offset-2">
								<h4 class="hr-subtitle">
									<?= $_text_circuite['description'] ?>
								</h4>
							</div>
						</div>
					</div>
					<? /*
						<div class="col-sm-6 col-md-6 col-md-offset-2">
							<div class="oferte__title__sub"><?= $_text_box_offer[$id]['description'] ?>
				</div>
			</div>
			*/ ?>
		</div>

		<? if($_slider_box_offer[$id]) {?>
		<!-- croaziere intro -->
		<div class="row">
			<div class="col-xs-12">
				<div class="croaziere-intro-wrapper">
					<div class="row">
						<div class="col-xs-12 col-lg-3">
							<h3><?=$_text_box_offer['section_title'];?></h3>
							<h4><?=$_text_box_offer['description'];?></h4>
							<a href="<?=route('cruises-home');?>" class="btn btn--green items__item__btn croaziere-intro-button">vezi toate croazierele »</a>
						</div>
						<div class="col-xs-12 col-lg-9">
							<div class="croaziere-intro-listare">
								<div class="row">
									<? foreach($_slider_box_offer[$id] as $item) {?>
									<div class="col-ms-6 col-sm-6 col-md-4">
										<a class="chartere__item__link oneitemlink" href="<?= $item['url']; ?>">
											<div class="blue-cover"></div>
											<img class="swiper-noi-oferte__img object-fit" src="<?= $item['images'][0]['small']; ?>" alt="">
											<div class="chartere__item__title">
												<h4 class="chartere__item__title__text"><?= $item['title']; ?></h4>
											</div>
											<div class="chartere__item__intro__text">
												<? if(!empty($item['info_departure'])) {?>
												<div class="chartere__item__locations">
													<?= $item['info_departure']; ?>
												</div>
												<? }?>
												<button class="btn btn--green items__item__btn">Rezerva acum »</button>
											</div>
										</a>
									</div>
									<? }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end croaziere intro -->
		<? }?>
		<!-- subtitlu sectiune -->
		<div class="row">
			<div class="col-xs-12 hr-small-title">
				<h3 class="hr-title__text hr-title__more"><?=$_extra_text[$id][0]['section_title'];?></h3>

				<div class="row">
					<div class="col-xs-12 col-lg-8 col-lg-offset-2">
						<h2 class="hr-subtitle">
							<?=$_extra_text[$id][0]['description'];?>
						</h2>
					</div>
				</div>
			</div>
		</div>
		<!-- end subtitlu sectiune -->
		<? if($_box_offer[$id]) {?> 
		<!-- mai multe croaziere -->
		<div class="croaziere-more-listing">
			<div class="row">
				<? foreach($_box_offer[$id] as $item) {?>
				<div class="col-ms-6 col-sm-6 col-md-6 col-lg-3">
					<a href="<?=$item['url'];?>" class="more-listing__item">
						<div class="more-listing__item__pict">
							<? if($item['special_text']) {?> 
								<div class="more-listing__special"><?=$item['special_text'];?><?=$item['special_text'];?></div>
							<? }?>
							<img class="" data-original="" alt="" src="<?=$item['images'][0]['small'];?>">
						</div>
						<div class="more-listing__content last-minute__list__item__link">
							<div class="row">
								<div class="col-xs-12">
									<? if($item['logo_path'] !== NULL && !empty($item['logo_path'])) {?>
										<div class="more-listing__logo"><img class="" data-original="" alt="" src="<?=$item['logo_path'];?>"></div>
									<? }?>
									<p class="last-minute__list__item__title">
										<strong><?=$item['title'];?></strong>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-7">
									<!-- <span class="last-minute__list__item__details text--grey">
										[<strong>Vas:</strong> Carnival Valor]<br>
										[<strong>Plecari din:</strong> Tampa]<br>
										[<strong>Imbarcari:</strong> 28.02, 03.12, 22.12]
									</span> -->
								</div>
								<div class="col-xs-5 last-minute__list__item__second-block">
									<p class="last-minute__list__item__pret text-right">
										<? if($item['discount']) {?>
											<?=$item['discount_text'];?>
										<!-- <del class="last-minute__list__item__pret__old">[650€]</del><br> -->
										<span class="last-minute__list__item__pret__actual"><?=$item['discount'];?></span>
										<? }?>
									</p>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 text-center">
									<button class="btn btn--green items__item__btn">Rezerva acum »</button>
								</div>
							</div>
						</div>
					</a>
				</div>
				<? }?>
			</div>
		</div>
		<!-- end mai multe croaziere -->
		<? }?>
	</div>
</div>
</div>
<? }?>
</div>