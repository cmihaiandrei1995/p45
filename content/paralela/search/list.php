<main>

  <div class="container cautari-wrapper page-inner">
      <div class="row">
         <div class="col-md-12 oferte-tab-list ">

         	 <h2 class="h2-search">Rezultatele cautarii tale: <span>"<?= ucfirst($_search) ?>"</span></h2>

         	 <ul class="nav nav-pills" role="tablist">
         	 	 <? if($_hotel_charter){ ?>
				  	<li class="<?= !isset($_params['slug']) || (isset($_params['slug']) && $_params['slug'] == 'chartere') ? 'active' : '' ?>"><a href="<?= route('search-tab', 'chartere') ?>?q=<?= $_search ?>"><span class="oferte-tab-list__text" >Pachete de vacanta</span></a></li>
				 <? } ?>
				 <? if($_hotel){ ?>
				  	<li class="<?= isset($_params['slug']) && $_params['slug'] == 'hotel' ? 'active' : '' ?>"><a href="<?= route('search-tab', 'hotel') ?>?q=<?= $_search ?>"><span class="oferte-tab-list__text" >Hoteluri</span></a></li>
				 <? } ?>
				 <? if($_circuits){ ?>
				  	<li class="<?= isset($_params['slug']) && $_params['slug'] == 'circuite' ? 'active' : '' ?>"><a href="<?= route('search-tab', 'circuite') ?>?q=<?= $_search ?>"><span class="oferte-tab-list__text" >Circuite</span></a></li>
				 <? } ?>
				 <? if($_tickets){ ?>
				  	<li class="<?= isset($_params['slug']) && $_params['slug'] == 'bilete-avion' ? 'active' : '' ?>"><a href="<?= route('search-tab', 'bilete-avion') ?>?q=<?= $_search ?>"><span class="oferte-tab-list__text" >Bilete de avion</span></a></li>
				 <? } ?>
             	 <? if($_cruises){ ?>
				  	<li class="<?= isset($_params['slug']) && $_params['slug'] == 'croaziere' ? 'active' : '' ?>"><a href="<?= route('search-tab', 'croaziere') ?>?q=<?= $_search ?>"><span class="oferte-tab-list__text" >Croaziere</span></a></li>
				 <? }  ?>
			 </ul>
			 <br>

             <div class="tab-content">
             	<div id="cruise" class=" tab-pane fade in  <?= isset($_params['slug']) && $_params['slug'] == 'croaziere' ? 'active' : '' ?> ">
             		<? if($_cruises && isset($_params['slug']) && $_params['slug'] == 'croaziere'){?>
                		<? foreach($_cruises as $item) {  ?>
	               	 		<div class="items__item">
								<div class="row">
									<div class="col-ms-4 col-sm-4">
										<div class="swiper-container swiper-items__item">
											<div class="swiper-wrapper">
												<? foreach($item['images'] as $img){?>
													<div class="swiper-slide">
														<a href="<?=$item['url']?>"><img class="swiper-items__item__img object-fit" src="<?=$img['medium']?>" alt="<?=$item['title']?>"></a>
													</div>
												<? }?>
											</div>

											<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white"></i></div>
											<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white"></i></div>
										</div>
										<img class="items__item__croaziere__company__img" src="<?= $item['logo'] ?>" alt="...">
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
												<h3 class="items__item__title"><a href="<?=$item['url']?>" title="<?=$item['title']?>">Croaziera <?= $year ?> - <?=$item['departure']['title']?> - <?= $item['destination']['title'] ?></a></h3>
												<p class="items__item__sub"><?=$item['line']['title']?> <span class="text--blue">•</span> <?=$item['ship']['title']?> <span class="text--blue">•</span> <?=$item['nights']?> nopti</p>
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
						<? }?>

		                <div class="row">
		                  <div class="col-xs-12 text-center">
		                    <?php print_pagination(array('items_count' => $count_cruises, 'per_page' => $_ipp))?>
		                  </div>
		                </div>

                    <? } ?>
               </div>

               <!-- circuite -->
                <div id="circuit" class=" tab-pane fade in <?= isset($_params['slug']) && $_params['slug'] == 'circuite' ? 'active' : '' ?> ">
                	<? if($_circuits && isset($_params['slug']) && $_params['slug'] == 'circuite'){?>
                		<? foreach($_circuits as $ki => $item){ ?>
                			<? include $_theme_path."circuits/include/circuit_box.php";?>
	                	<?php } ?>

		                 <div class="row">
		                    <div class="col-xs-12 text-center">
		                        <?php print_pagination(array('items_count' => $_new_count_items, 'per_page' => $_ipp))?>
		                    </div>
		                </div>
	                <? } ?>
               </div>

               <!-- bilete de avion -->
               <div id="ticket" class=" tab-pane fade in <?= isset($_params['slug']) && $_params['slug'] == 'bilete-avion' ? 'active' : '' ?> ">
               		<div class="row chartere">
						<?php foreach($_tickets as $item) { ?>
							<div class="col-xs-12 col-ms-6 col-sm-4 col-md-3 chartere__item">
								<a class="chartere__item__link hover-opacity" href="<?= route('ticket', $item['title'], $item['id_ticket']) ?>">
									<img class="chartere__item__img object-fit" src="<?= $item['images'][0]['small'] ?>" alt="...">
									<div class="chartere__item__number__wrapper">
										<span class="chartere__item__number__text">de la</span>
										<span class="chartere__item__number chartere__item__number--v2"><strong><?= $item['price'] ?><span class="chartere__item__number__currency">€</span></strong></span>
									</div>
									<div class="chartere__item__airline"><img class="position-center chartere__item__airline__img" src="<?= $item['company_image'] ?>" alt="<?= $item['company_title'] ?>"></div>
									<div class="chartere__item__title">
										<div class="media">
											<div class="media-left">
												<i class="sprite sprite-arrow-blue-left-l"></i>
												<i class="sprite sprite-arrow-blue-right-l"></i>
											</div>
											<div class="media-body">
												<h4 class="media-heading chartere__item__title__text chartere__item__title__text--v2"><?= $item['title'] ?></h4>
												<p>Perioada calatorie: <?= $date_from ?> - <?= $date_to ?></p>
											</div>
										</div>
									</div>
								</a>
							</div>
						<?php } ?>
					</div>
                </div>

                <div id="charter" class=" tab-pane fade in <?= !isset($_params['slug']) || (isset($_params['slug']) && $_params['slug'] == 'chartere') ? 'active' : '' ?>">
	                <? if($_hotel_charter && (!isset($_params['slug']) || isset($_params['slug']) && $_params['slug'] == 'chartere')){?>
                        <div class="row">
                            <div class="col-xs-12">
        						<div class="page-inner-ordering">
        							<div class="row">
        								<div class="col-sm-6">
        									<!-- numar oferte -->
        									<p>[Am gasit <strong>300 oferte</strong>]</p>
        									<!-- end numar oferte -->
        								</div>
        								<div class="col-sm-6 text-sm-right">
        									<label>Ordonare:</label>
        									<div class="items__select__wrapper dropwdown-sortare">
        										<div class="dropdown">
        											<button class="btn btn-primary dropdown-toggle sortare" type="button" data-toggle="dropdown"> Implicit
        										  	<span class="caret"></span></button>
        										  	<ul class="dropdown-menu">
        										  		<li <? if($_GET['srt'] == "rc" || !isset($_GET['srt'])){?> class="active" <? }?>><a href="<?= get_offer_sort_link('rc') ?>">Recomandate</a></li>
        											  	<li <? if($_GET['srt'] == "pra"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('pra') ?>">Pret crescator</a></li>
        											    <li <? if($_GET['srt'] == "prd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('prd') ?>">Pret descrescator</a></li>
        											    <li <? if($_GET['srt'] == "dsc"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('dsc') ?>">Discount</a></li>
        											</ul>
        										</div>
        									</div>
        								</div>
        							</div>
        						</div>
        					</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 aside-filters">
        	                	<div class="oferte-tab-list">
                                    <div class="oferte-tab-list-title"><i class="sprite sprite-pills-avion"></i>[Orase de plecare:]</div>
        							<ul class="nav nav-pills">
        								<? foreach($_other_cities_from as $city){?>
        									<li <? if($city['id_city'] == $_city_from['id_city']){?>class="active"<? }?>>
        										<a href="<?=$city['url']?>">
        											[<span class="oferte-tab-list__text"><?=$city['title']?></span>]
        										</a>
        									</li>
        								<? }?>
        							</ul>
        							<br>
        						</div>
                            </div>
                            <div class="col-md-9">
                        		<? foreach($_hotel_charter as $ki => $item){  ?>
        	                		<?php include $_theme_path."charters/include/charter_box.php";?>
        	                	<?php } ?>

        		                <div class="row">
        		                  	<div class="col-xs-12 text-center">
        		                    	<?php print_pagination(array('items_count' => $new_count_hotel_charter, 'per_page' => $_ipp))?>
        		                  	</div>
        		                </div>
                            </div>
                        </div>

		                <? if($new_count_hotel_charter == 0){ ?>
		                	<div class="row">
		                  		<div class="col-xs-12">
		                  			<h3>Ne pare rau dar nu am gasit rezultate pentru cautarea ta.</h3>
		                  		</div>
		                	</div>
		                <? } ?>
	                <? } ?>
                </div>

                <!-- hotel -->
                <div id="hotel" class=" tab-pane fade in <?= isset($_params['slug']) && $_params['slug'] == 'hotel' ? 'active' : '' ?> ">
                	<? if($_hotel && isset($_params['slug']) && $_params['slug'] == 'hotel'){?>
                		<? foreach($_hotel as $ki => $item){  ?>
	                		<?php include $_theme_path."tourism/include/hotel_box.php";?>
	                	<?php } ?>

		                <div class="row">
		                  	<div class="col-xs-12 text-center">
		                    	<?php print_pagination(array('items_count' => $new_count_hotel, 'per_page' => $_ipp))?>
		                  	</div>
		                </div>
	                <? } ?>

	                <? if($new_count_hotel == 0){ ?>
	                	<div class="row">
	                  		<div class="col-xs-12">
	                  			<h3>Ne pare rau dar nu am gasit rezultate pentru cautarea ta.</h3>
	                  		</div>
	                	</div>
	                <? } ?>
               </div>
            </div>

         </div>
      </div>
    </div>

    <? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
