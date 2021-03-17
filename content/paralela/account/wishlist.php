<main>
    <div class="my-account-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <h1 class="logo-title logo-title--full">
                                <span class="logo-title__text">Wishlist. Te mai intereseaza aceste destinatii?</span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <? include $_theme_path.'account/include/side.php' ?>
                        </div>
                        <div class="col-md-9">
                            <div class="my-content">
                            	<? if(!$_whishlist_items){?>
                            		<p>Nu ai salvat nimic in whishlist</p>
                            	<? }else{?>
        	                        <ul class="list-unstyled">
        	                        	<? foreach($_whishlist_items as $item){?>
        		                            <li class="wishli">
        		                                <div class="row">
        		                                    <div class="col-md-4">
        		                                        <div class="swiper-container swiper-items__item">
        		                                            <div class="swiper-wrapper">
        		                                                <div class="swiper-slide">
        		                                                    <a href="<?=$item['url']?>"><img class="swiper-items__item__img object-fit" src="<?=$item['image']?>" alt="<?=$item['title']?>"></a>
        		                                                </div>
        		                                            </div>
        		                                            <!--
        		                                            <div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white"></i></div>
        		                                            <div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white"></i></div>
        		                                            -->
        		                                        </div>
        		                                    </div>
        		                                    <div class="col-md-8">
        		                                        <div class="row">
        		                                            <div class="col-md-8">
        		                                                <h3 class="items__item__supratitle"><a href="<?=$item['url']?>"><?=$item['title']?></a></h3>
        		                                                <h4 class="items__item__title"><?=$item['subtitle']?></h4>
        		                                                <p class="items__item__sub">
        		                                                    <span><?=$item['city']?></span>
        		                                                    <? if($item['stars'] > 0){?>
        																<span>
        																	<? for($i=1; $i<=$item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
        																</span>
        															<? }?>
        		                                                </p>
        		                                                <ul class="items__item__list list-unstyled list-inline">
        		                                                    <? if($item['parking']){?>
        																<li data-toggle="tooltip" title="Parcare"><i class="sprite sprite-facility-parking"></i></li>
        															<? }?>
        															<? if($item['kids_hotel']){?>
        																<li data-toggle="tooltip" title="Hotel pentru copii"><i class="sprite sprite-kids"></i></li>
        															<? }?>
        															<? if($item['spa']){?>
        																<li data-toggle="tooltip" title="Spa"><i class="sprite sprite-facility-spa"></i></li>
        															<? }?>
        															<? if($item['fitness']){?>
        																<li data-toggle="tooltip" title="Sala fitness"><i class="sprite sprite-facility-gym"></i></li>
        															<? }?>
        															<? if($item['pets']){?>
        																<li data-toggle="tooltip" title="Accepta animale"><i class="sprite sprite-facility-pets"></i></li>
        															<? }?>
        															<? if($item['wifi'] || $item['internet']){?>
        																<li data-toggle="tooltip" title="Internet"><i class="sprite sprite-facility-wifi"></i></li>
        															<? }?>
        															<? if($item['air_conditioner']){?>
        																<li data-toggle="tooltip" title="Aer conditionat"><i class="sprite sprite-facility-ac"></i></li>
        															<? }?>
        															<? if($item['beach']){?>
        																<li data-toggle="tooltip" title="Plaja"><i class="sprite sprite-facility-plaja"></i></li>
        															<? }?>
        															<? if($item['beach_sand']){?>
        																<li data-toggle="tooltip" title="Plaja cu nisip"><i class="sprite sprite-facility-hotelbeach"></i></li>
        															<? }?>
        															<? if($item['pool_outside']){?>
        																<li data-toggle="tooltip" title="Piscina exterioara"><i class="sprite sprite-facility-pool"></i></li>
        															<? }?>
        															<? if($item['pool_indoor']){?>
        																<li data-toggle="tooltip" title="Piscina interioara"><i class="sprite sprite-facility-insidepool"></i></li>
        															<? }?>
        															<? if($item['aqua_park']){?>
        																<li data-toggle="tooltip" title="Aqua Park"><i class="sprite sprite-facility-aquapark"></i></li>
        															<? }?>
        															<? if($item['restaurant']){?>
        																<li data-toggle="tooltip" title="Restaurant"><i class="sprite sprite-facility-restaurant"></i></li>
        															<? }?>
        															<? if($item['restaurant_a_la_carte']){?>
        																<li data-toggle="tooltip" title="Restaurant a la carte"><i class="sprite sprite-facility-alacarte"></i></li>
        															<? }?>
        		                                                </ul>
        		                                                <p><?=$item['short_desc']?></p>
        		                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="#" class="delete-from-wishlist">[sterge din wishlist ›]</a>
                                                            </div>
        		                                        </div>
        		                                    </div>
        		                                </div>

                                                <div class="dwrow">
                                                    <div class="theprice">[430.00€ <img src="<?= $_base ?>static/img/theprice-up.png" />]</div>
                                                    <a class="btn btn--green items__item__btn" href="<?=$item['url']?>">REZERVA ACUM ›</a>
        		                                </div>
        		                            </li>
        	                            <? }?>
        	                        </ul>

        	                        <div class="row">
        								<div class="col-xs-12 text-center">
        									<?php print_pagination(array('items_count' => $_count, 'per_page' => $_ipp))?>
        								</div>
        							</div>
        	                	<? }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
