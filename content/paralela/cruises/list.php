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

				<div class="row big-category">
					<div class="col-xs-12">
						<h1 class="page-inner-title">
							<?/* <?=$_text['title']?> */?>
							[Croaziere ASIA/AFRICA SI ORIENTUL MIJLOCIU • China]
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
										  	<li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'pra') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('pra') ?>">Pret crescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'prd') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('prd') ?>">Pret descrescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'ta') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('ta') ?>">Titlu A-Z</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'td') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('td') ?>">Titlu Z-A</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'na') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('na') ?>">Nopti crescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'nd') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('nd') ?>">Nopti descrescator</a></li>
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
					<div class="col-md-3 aside-filters aside-filters__croaziere">
						<?/*<p class="aside-filters__title"><strong><?= $_count ?></strong> <span>oferte</span><br>Filtreaza rezultatele</p>*/?>
						<div class="aside-filters__item">
							<p class="aside-filters__sub">Pret</p>
							<div id="aside-filters__price" class="aside-filters__price">
								<div id="slider-range-filter"><div class="color-region"></div></div>
								<div id="slider-data-filter" data-min="<?=$_price['min']?>" data-max="<?=$_price['max']?>"
									data-min-set="<?=($_filters['price']['min'] > 0 ? $_filters['price']['min'] : $_price['min'])?>"
                                    data-max-set="<?=($_filters['price']['max'] > 0 ? $_filters['price']['max'] : $_price['max'])?>"></div>
								<span id="min2"></span>
								<span id="max2"></span>
								<input id="hidden-range-amount" type="hidden" name="range" value="">
								<script>
				                	var $_price_filter_link = '<?=$_price_filter_link?>';
				                </script>
							</div>
						</div>
						<div class="aside-filters__item book-form">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__destinatie" aria-expanded="true" aria-controls="aside-filters__destinatie"><i class="sprite sprite-croaziere-pin"></i> Destinatie <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__destinatie" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-destinatie">
									<select id="aside-croaziere-destinatie" multiple="multiple" name="destination[]"  class="form-control main-filters__select change-select " style="width: 100%;" data-placeholder="<? _e('- Alege destinatii -')?>">
										<option></option>
										<? foreach($_destinations as $item){?>
				                            <optgroup label="<?=$item['title']?>">
				                                <option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['id_cruise_destination'], $_filters['dest'])) echo "selected"?>><? _e('Toate destinatiile din')?> <?=$item['title']?></option>
				                                <? foreach($item['sub'] as $subitem){?>
				                                    <option value="<?=$subitem['add-url']?>" data-remove="<?=$subitem['remove-url']?>" <? if(in_array($subitem['id_cruise_destination'], $_filters['dest'])) echo "selected"?>><?=$subitem['title']?></option>
				                                <? }?>
				                            </optgroup>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__linia" aria-expanded="true" aria-controls="aside-filters__linia"><i class="sprite sprite-croaziere-flag"></i> Linia de croaziera <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__linia" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-linia">
									<select id="aside-croaziere-linia" multiple="multiple" class="form-control main-filters__select change-select" style="width: 100%;"  data-placeholder="<? _e('- Alege linia de croaziera -')?>" name="line[]">
										<option></option>
										 <? foreach($_lines as $item){?>
				                        	<option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['id_cruise_line'], $_filters['line'])) echo "selected"?>><?=$item['title']?></option>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__vasul" aria-expanded="true" aria-controls="aside-filters__vasul"><i class="sprite sprite-croaziere-boat"></i> Vasul de croaziera <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__vasul" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-vasul">
									<select id="aside-croaziere-vasul" multiple="multiple" class="form-control main-filters__select change-select" style="width: 100%;" name="ship[]" data-placeholder="<? _e('- Alege vasul de croaziera -')?>">
										<option></option>
										<? foreach($_ships as $item){?>
				                        	<option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['id_cruise_ship'], $_filters['ship'])) echo "selected"?>><?=$item['title']?></option>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__portul" aria-expanded="true" aria-controls="aside-filters__portul"><i class="sprite sprite-croaziere-port"></i> Portul de imbarcare <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__portul" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-portul">
									<select id="aside-croaziere-portul" multiple="multiple" class="form-control main-filters__select change-select" style="width: 100%;" name="port[]" data-placeholder="<? _e('- Alege port de imbarcare -')?>">
										<option></option>
										<? foreach($_ports as $item){?>
				                        	<option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['id_cruise_port'], $_filters['port'])) echo "selected"?>><?=$item['title']?></option>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__categorie" aria-expanded="true" aria-controls="aside-filters__categorie"><i class="sprite sprite-croaziere-star"></i> Categorie <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__categorie" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-categorie">
									<select id="aside-croaziere-categorie" multiple="multiple" class="form-control main-filters__select change-select" style="width: 100%;" name="category[]" data-placeholder="<? _e('- Alege categorii -')?>">
										<option></option>
										<? foreach($_categories as $item){?>
				                        	<? if(count($item['sub'])){?>
				                                <optgroup label="<?=$item['title']?>">
				                                    <? foreach($item['sub'] as $subitem){?>
				                                        <option value="<?=$subitem['add-url']?>" data-remove="<?=$subitem['remove-url']?>" <? if(in_array($subitem['id_cruise_category'], $_filters['cat'])) echo "selected"?>><?=$subitem['title']?></option>
				                                    <? }?>
				                                </optgroup>
				                            <? }else{?>
				                            	<option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['id_cruise_category'], $_filters['cat'])) echo "selected"?>><?=$item['title']?></option>
				                            <? }?>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__luna" aria-expanded="true" aria-controls="aside-filters__luna"><i class="sprite sprite-croaziere-calendar"></i> Alege luna plecarii <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__luna" class="collapse in">
								<label class="aside-filters__label" for="aside-croaziere-luna">
									<select id="aside-croaziere-luna" multiple="multiple" class="form-control main-filters__select change-select" style="width: 100%;" name="date[]" data-placeholder="<? _e('- Alege luna plecare -')?>">
										<option></option>
										<? foreach($_dates as $item){?>
				                        	<option value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>" <? if(in_array($item['month'].'-'.$item['year'], $_filters['date'])) echo "selected"?>><?=$_months[$item['month']]." ".$item['year']?></option>
				                        <? }?>
									</select>
								</label>
							</div>
						</div>
						<div class="aside-filters__item">
							<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__nopti" aria-expanded="true" aria-controls="aside-filters__nopti"><i class="sprite sprite-croaziere-clepsidra"></i> Numar nopti <i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__nopti" class="collapse in">
								<div class="row">
									<? foreach($_cruise_nights_filter as $key => $val){?>
				                    	<div class="col-sm-6">
				                    		<a href="<?=$_nights_links[$key][(in_array($key, $_filters['nights']) ? 'remove-url' : 'add-url')]?>" class="checkbox aside-filters__checkbox <? if(in_array($key, $_filters['nights'])) echo "active"?>">
					                    		<input type="checkbox" value="" <? if(in_array($key, $_filters['nights'])) echo "checked"?>>
					                    		<label><?=$val?></label>
					                    	</a>
				                    	</div>
				                    <? }?>
								</div>
							</div>
						</div>
						<!-- zona bannere -->
						<div class="banner" style="background-image: url(<?= $_base?>static/img/banner.jpg);">
							<div class="swiper-circuit__pret__wrapper">
								<span class="swiper-circuit__pret__text" style="">de la</span>
								<p class="swiper-circuit__pret">
									<span class="swiper-circuit__pret__number">[300€]</span><br>
								</p>
							</div>
							<p class="last">[OFERTA SPECIALA]</p>
							<p class="where">[MSC CRUISE]</p>
							[Plecari: mai, iunie, iulie 2019]
							<a class="btn btn--green items__item__btn" href="">Rezerva acum</a>
						</div>
						<!-- zona bannere -->
					</div>
					<div class="col-md-9 items">
						<!--<div class="items__title--bg">
							<div class="row">
								<div class="col-ms-7 col-sm-7 col-md-8">
									<h2 class="items__title"><i class="sprite sprite-boat"></i> Croaziere</h2>
								</div>

								<div class="col-ms-5 col-sm-5 col-md-4">
									<div class="items__select__wrapper dropwdown-sortare">
										<div class="dropdown">
										   <button class="btn btn-primary dropdown-toggle sortare" type="button" data-toggle="dropdown"> Sortare
										  <span class="caret"></span></button>
										  <ul class="dropdown-menu">
										  	<li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'pra') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('pra') ?>">Pret crescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'prd') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('prd') ?>">Pret descrescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'ta') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('ta') ?>">Titlu A-Z</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'td') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('td') ?>">Titlu Z-A</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'na') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('na') ?>">Nopti crescator</a></li>
										    <li class="<?= (isset($_GET['srt']) && $_GET['srt'] == 'nd') ? 'active' : '' ?>"><a href="<?= get_cruise_sort_link('nd') ?>">Nopti descrescator</a></li>
										  </ul>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<?php foreach($_items as $item){ ?>
							<div class="items__item">
								<div class="row">
									<div class="col-ms-8 col-sm-8">
										<h3 class="items__item__title"><a href="<?=$item['url']?>" title="<?=$item['title']?>">Croaziera <?= $year ?> - <?=$item['departure']['title']?> - <?= $item['destination']['title'] ?></a></h3>
										<p class="items__item__sub"><i class="sprite items__item__cruisesicon"></i><?=$item['line']['title']?> <span class="text--blue">•</span> <?=$item['ship']['title']?> <span class="text--blue">•</span> <?=$item['nights']?> nopti</p>
									</div>
									<div class="col-ms-4 col-sm-4 text-right">
										<img class="items__item__croaziere__company__img" src="<?= $item['logo'] ?>" alt="<?=$item['line']['title']?>">
									</div>
								</div>
								<div class="row">
									<div class="col-ms-4 col-sm-4">
										<div class="swiper-container swiper-items__item">
											<div class="swiper-wrapper">
												<? foreach($item['images'] as $img){?>
													<div class="swiper-slide">
														<a href="<?=$item['url']?>">
															<img class="swiper-items__item__img object-fit swiper-lazy" data-src="<?=$img['medium']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
														</a>
														<div class="swiper-lazy-preloader"></div>
													</div>
												<? }?>
											</div>
											<!-- <p class="items__item__epuizat">LOCURI EPUIZATE</p> -->
											<? if(count($item['images']) > 1){?>
												<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white"></i></div>
												<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white"></i></div>
											<? }?>
										</div>
									</div>
									<div class="col-ms-8 col-sm-8">
										<div class="row">
											<?
											foreach($item['dates'] as $x => $date){
												$year = $x;
												break;
											}
											?>
											<div class="col-ms-6 col-sm-6 col-md-9 items__item__wrapper items__item__circuite">


												<ul class="list-unstyled items__item__croaziere__list">
													<li><i class="sprite sprite-croaziere-pin-s"></i> <span>Plecare din:</span> <?=$item['departure']['title']?></li>
													<li><i class="sprite sprite-croaziere-boat-s"></i> <span>Vas:</span> <?=$item['ship']['title']?></li>
													<li>
														<div class="media">
															<div class="media-left">
																<i class="sprite sprite-croaziere-port-s"></i>
															</div>
															<div class="media-body">
																<span>Porturi:</span> <?=implode(' - ', $item['ports'])?>
															</div>
														</div>
													</li>
													<? if($item['dates']){?>
                                						<? foreach($item['dates'] as $year => $dates){?>
															<li><i class="sprite sprite-croaziere-calendar-s"></i> <span>Plecari <?=$year?>:</span> </span> <?=implode(', ', $dates)?></li>
														<?php } ?>
													<?php } ?>

													<?php if($item['plane_included'] == 1){ ?>
														<li><i class="sprite sprite-croaziere-plane-s"></i> <span>Zbor inclus </li>
													<?php } ?>
												</ul>
											</div>
											<div class="col-ms-6 col-sm-6 col-md-3 items__item__wrapper">
												<div class="abs-bottright-0">
						                    		<? if($item['promo'] && $item['price_promo']){?>
														<p class="items__item__del">de la <del><?=$item['price']?> <?=$item['currency']?></del></p>
														<p class="items__item__price"><?=$item['price_promo']?> <?=$item['currency']?></p>
													 <? }else{ ?>
													 	<p class="items__item__del">de la</p>
													 	<p class="items__item__price"><?=$item['price']?> <?=$item['currency']?></p>
												 	<? }?>
													<p class="items__item__pers">/ persoana</p>
													<ul class="items__item__hotel list-unstyled list-inline">
														<!--
														<li><i class="sprite sprite-hotel-last-minute"></i></li>
														<li><i class="sprite sprite-hotel-smart"></i></li>
														<li><i class="sprite sprite-hotel-early-booking"></i></li>
														-->
														<? if($item['discount']) { ?>
															<li class="items__item__hotel__discount"><i class="sprite sprite-hotel-discount"></i> <span>-<?= round($item['discount']) ?>%</span></li>
														<?php } ?>
													</ul>
													<a class="btn btn--green items__item__btn" href="<?=$item['url']?>">Rezerva</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="row">
							<div class="col-xs-12 text-center">
								<?php print_pagination(array('items_count' => $_count, 'per_page' => $_ipp))?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
