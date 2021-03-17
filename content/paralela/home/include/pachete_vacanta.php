
<div class="onesection">pachete vacanta
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                     <!-- oferte__title__wrapper -->
                    <div class="col-xs-12 hr-title">
                        <h3 class="oferte__title text--blue hr-title__text">[Pachete de vacanta]</h3>

                        <div class="row">
                            <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                                <h4 class="hr-subtitle">
                                    [Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum]
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="puzzle-masonry-col6">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <? if($_slider_circuits){?>
        						<div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
        							<div class="col-xs-12">
        								<div class="swiper-circuit-wrapper">
        									<div class="swiper-container swiper-circuit">
        										<div class="swiper-wrapper">
        											<?php foreach($_slider_circuits as $item) { ?>
        												<div class="swiper-slide">
        													<a href="<?=$item['url']?>">
        														<img class="swiper-circuit__img img-responsive swiper-lazy" data-src="<?=$item['images'][0]['big']?>" alt="<?=$item['title']?>" src="<?=urle('img/blank.gif', 'static')?>">
        													</a>

        													<div class="swiper-circuit__detalii text--white">
        														<? if($item['discount'] != ""){?>
        															<div class="swiper-circuit__pret__wrapper">
        																<span class="swiper-circuit__pret__text" style="<?= $item['discount_text'] == '' ? 'height:13px; display:block;' : '' ?>"><?=$item['discount_text']?></span>
        																<p class="swiper-circuit__pret">
        																	<span class="swiper-circuit__pret__number"><?=$item['discount']?></span><br>
        																</p>
        																<!-- per persoana bulina -->
        																<span class="swiper-circuit__pret__text">/ persoana</span>
        																<!-- end per persoana bulina -->
        															</div>
        														<? }?>
        														<h4 class="swiper-circuit__detalii__title">
        															<a class="text--white" href="<?=$item['url']?>"><?=$item['title']?></a>
                                                                    <?/*
                                                                    <? if($item['subtitle'] != ""){?>
        																<small><?=$item['subtitle']?></small>
        															<? }?>
                                                                    */?>
        														</h4>
                                                                <div class="more-listing__special">[OFERTA SPECIALA]</div>
        														<div class="swiper-circuit-detalii-plecare-wrapper">
        															<? if($item['info_departure'] != ""){?>
        																<p class="swiper-circuit__detalii__plecare">
        																	[<span class="text-uppercase"><i class="swiper-sprite-detalii-avion"></i> <?=$item['info_departure']?></span>]
        																</p>
        															<? }?>
        														</div>
                                                                <div class="swiper-circuit__detalii__wrapper">
        															[<?=$item['description']?>]
        														</div>
        														<p class="text-center"><a href="<?=$item['url']?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">Rezerva</a></p>
        													</div>
        													<div class="swiper-lazy-preloader"></div>
        												</div>
        											<?php } ?>
        										</div>
        										<? if(count($_slider_circuits) > 1){?>
        											<div class="swiper-pagination"></div>
                                                    <div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
            										<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
        										<? }?>
        									</div>
        								</div>
        							</div>
        						</div>
        					<? }?>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
                                <div class="new-label"><span>nou!<span></div>
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
            							<span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="#">
        						<div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
            						<div class="chartere__item__procent__wrapper">
                                        <span class="chartere__item__procent__text">[pana la]</span>
            							<span class="chartere__item__procent"><strong>[1085€]</strong></span>
                                        <span class="chartere__item__procent__text">[REDUCERE]</span>
            						</div>
            						<div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong>[Circuite in AFRICA]</strong></h4></div>
                                    <div class="chartere__item__locations">[Anglia • Austria • Belgia • Cehia • Cipru • Danemarca]</div>
                                    <hr class="chartere__item__hr">
                                    <div class="more-listing__special">[EARLY BOOKING]</div>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <img src="https://via.placeholder.com/248x249">
        					</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
