<? if($_box_charters || $_slider_charters){?>
<div class="onesection">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <!-- oferte__title__wrapper -->
                    <div class="col-xs-12 hr-title">
                        <h3 class="oferte__title text--blue hr-title__text"><?= $_text_chartere['section_title'] ?></h3>

                        <div class="row">
                            <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                                <h4 class="hr-subtitle">
                                    <?= $_text_chartere['description'] ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="puzzle-masonry-col6">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <? if($_slider_charters){?>
                            <div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
                                <div class="col-xs-12">
                                    <div class="swiper-circuit-wrapper">
                                        <div class="swiper-container swiper-circuit">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($_slider_charters as $item) { ?>
                                                    <div class="swiper-slide">
                                                        <a href="<?= $item['url'] ?>">
                                                            <img class="swiper-circuit__img img-responsive swiper-lazy" data-src="<?= $item['images'][0]['big'] ?>" alt="<?= $item['title'] ?>" src="<?= urle('img/blank.gif', 'static') ?>">
                                                        </a>

                                                        <div class="swiper-circuit__detalii text--white">
                                                            <? if($item['discount'] != ""){?>
                                                            <div class="swiper-circuit__pret__wrapper">
                                                                <span class="swiper-circuit__pret__text" style="<?= $item['discount_text'] == '' ? 'height:13px; display:block;' : '' ?>"><?= $item['discount_text'] ?></span>
                                                                <p class="swiper-circuit__pret">
                                                                    <span class="swiper-circuit__pret__number"><?= $item['discount'] ?></span><br>
                                                                </p>
                                                                <!-- per persoana bulina -->
                                                                <span class="swiper-circuit__pret__text">/ persoana</span>
                                                                <!-- end per persoana bulina -->
                                                            </div>
                                                            <? }?>
                                                            <h4 class="swiper-circuit__detalii__title">
                                                                <a class="text--white" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                                                                <?/*
                                                                    <? if($item['subtitle'] != ""){?>
                                                                <small><?= $item['subtitle'] ?></small>
                                                                <? }?>
                                                                */?>
                                                            </h4>
                                                            <div class="more-listing__special"><?=$item['subtitle'];?></div>
                                                            <div class="swiper-circuit-detalii-plecare-wrapper">
                                                                <? if($item['info_departure'] != ""){?>
                                                                <p class="swiper-circuit__detalii__plecare">
                                                                    <span class="text-uppercase"><i class="swiper-sprite-detalii-avion"></i> <?= $item['info_departure'] ?></span>
                                                                </p>
                                                                <? }?>
                                                            </div>
                                                            <div class="swiper-circuit__detalii__wrapper">
                                                                <?= $item['description'] ?>
                                                            </div>
                                                            <p class="text-center"><a href="<?= $item['url'] ?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">Rezerva</a></p>
                                                        </div>
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <? if(count($_slider_charters) > 1){?>
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

                        <? if($_box_charters) { ?>
                        <? foreach($_box_charters as $item) {?>
                        <div class="col-xs-12 col-ms-6 col-sm-6 col-lg-3 regular">
                            <a class="chartere__item__link oneitemlink" href="<?=$item['url'];?>">
                                <? if($item['new']) {?>
                                <div class="new-label"><span>nou!<span></div>
                                <? } ?>
                                <div class="blue-cover"></div>
                                <div class="chartere__item__link__content">
                                    <div class="chartere__item__procent__wrapper">
                                        <? if($item['discount_text']) {?>
                                        <span class="chartere__item__procent__text"><?= $item['discount_text']; ?></span>
                                        <? } ?>
                                        <? if($item['discount']) {?> 
                                        <span class="chartere__item__procent"><strong><?=$item['discount'];?></strong></span>
                                        <span class="chartere__item__procent__text">REDUCERE</span>
                                        <? } ?>
                                    </div>
                                    <div class="chartere__item__title chartere__item__title_fix">
                                        <h4 class="chartere__item__title__text"><strong><?= $item['title']; ?></strong></h4>
                                    </div>
                                    <div class="chartere__item__locations">
                                        <?php if ($item['cities'] !== NULL) { ?>
                                            <?= implode('&nbsp;•&nbsp;', $item['cities']); ?>
                                        <?php } ?>
                                    </div>
                                    <hr class="chartere__item__hr">
                                    <? if($item['offer_text']) {?>
                                    <div class="more-listing__special"><?= $item['offer_text']; ?></div>
                                    <? } ?>
                                </div>
                                <button class="btn btn--green items__item__btn">Rezerva</button>
                                <? if(count($item['images']) > 0) {?>
                                    <img src="<?=$item['images'][0]['small'];?>">
                                <? } ?>
                            </a>
                        </div>
                        <? } ?>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? } ?>