<div class="onesection">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                    <!-- oferte__title__wrapper -->
                    <div class="col-xs-12 hr-title">
                        <h3 class="oferte__title text--blue hr-title__text"><?= $_text_circuite['title']; ?></h3>

                        <div class="row">
                            <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                                <h4 class="hr-subtitle">
                                    <?= $_text_circuite['description']; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="puzzle-masonry-col4">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-4 verytall">
                            <? if($_slider_circuits){?>
                            <div class="row <? if(!$_box_mobile[11]){?>hidden-xs<? }?>">
                                <div class="col-xs-12">
                                    <div class="swiper-circuit-wrapper">
                                        <div class="swiper-container swiper-circuit">
                                            <div class="swiper-wrapper">
                                                <?php foreach ($_slider_circuits as $item) { ?>
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
                                                                <span class="swiper-circuit__pret__text">pachet/persoana</span>
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
                                                            <div class="more-listing__special">OFERTA SPECIALA</div>
                                                            <div class="swiper-circuit-detalii-plecare-wrapper">
                                                                <? if($item['info_departure'] != ""){?>
                                                                <p class="swiper-circuit__detalii__plecare">
                                                                    <span class="text-uppercase"><i class="swiper-sprite-detalii-avion"></i> <?= $item['info_departure'] ?></span>
                                                                </p>
                                                                <? }?>
                                                            </div>
                                                            <p class="text-center"><a href="<?= $item['url'] ?>" class="swiper-circuit__detalii__link btn btn--green items__item__btn">Rezerva acum »</a></p>
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
                        <!-- Check if any box circuits -->
                        <?php if ($_box_circuits) { ?>
                            <!-- Loop through and count iterations -->
                            <?php $i = 0;
                            foreach ($_box_circuits as $k_box => $item) { ?>
                                <!-- Tall one -->
                                <?php if ($i == 0) { ?>
                                    <div class="col-xs-12 col-md-6 col-lg-8 tall" style="background-image:url(<?=$item['images'][0]['url'];?>);">
                                        <div class="chartere__item__link-wrapper">
                                            <a class="chartere__item__link oneitemlink" href="<?=$item['url'];?>">
                                                <div class="blue-cover"></div>
                                                <div class="oneitemlink-content">
                                                    <div class="chartere__item__procent__wrapper">
                                                        <span class="chartere__item__procent__text"><?= $item['discount_text']; ?></span>
                                                        <span class="chartere__item__procent"><strong><?= $item['discount']; ?></strong></span>
                                                        <span class="chartere__item__procent__text">persoana/pachet</span>
                                                    </div>
                                                    <div class="chartere__item__title">
                                                        <h4 class="chartere__item__title__text"><strong><?= $item['title']; ?></strong></h4>
                                                    </div>
                                                    <div class="chartere__item__locations">
                                                    <?php if ($item['cities'] !== NULL) { ?>
                                                        <?=implode('&nbsp;•&nbsp;', $item['cities']);?>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                                <button class="btn btn--green items__item__btn">Rezerva acum »</button>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- 2 regular -->
                                <?php } elseif ($i == 1 || $i == 2) { ?>
                                    <div class="col-ms-6 col-sm-6 col-md-3 col-lg-4 regular">
                                        <a class="chartere__item__link oneitemlink" href="<?=$item['url'];?>">
                                            <div class="blue-cover"></div>
                                            <div class="oneitemlink-content">
                                                <div class="chartere__item__procent__wrapper">
                                                    <span class="chartere__item__procent__text"><?=$item['discount_text'];?></span>
                                                    <span class="chartere__item__procent"><strong><?=$item['discount'];?></strong></span>
                                                    <span class="chartere__item__procent__text">persoana/pachet</span>
                                                </div>
                                                <div class="chartere__item__title">
                                                    <h4 class="chartere__item__title__text"><strong><?=$item['title'];?></strong></h4>
                                                </div>
                                                <div class="chartere__item__locations">
                                                <?php if ($item['cities'] !== NULL) { ?>
                                                    <?=implode('&nbsp;•&nbsp;', $item['cities']);?>
                                                <?php } ?>
                                                </div>
                                            </div>
                                            <img src="<?=$item['images'][0]['small'];?>">
                                            <button class="btn btn--green items__item__btn">Rezerva acum »</button>
                                        </a>
                                    </div>
                                    <?php if($i == 2) { ?>
                                    </div>
                                    <?php } ?>
                                    <!-- Small -->
                                <?php } else { ?>
                                    <?php if($i == 3) { ?>
                                        <div class="row">
                                    <?php } ?>
                                    <div class="col-ms-6 col-sm-6 col-lg-3 small">
                                        <a class="chartere__item__link oneitemlink" href="<?=$item['url'];?>">
                                            <div class="blue-cover"></div>
                                            <div class="oneitemlink-content">
                                                <div class="chartere__item__procent__wrapper">
                                                    <span class="chartere__item__procent__text"><?=$item['discount_text'];?></span>
                                                    <span class="chartere__item__procent"><strong><?=$item['discount'];?></strong></span>
                                                    <span class="chartere__item__procent__text">persoana/pachet</span>
                                                </div>
                                                <div class="chartere__item__title">
                                                    <h4 class="chartere__item__title__text"><strong><?=$item['title'];?></strong></h4>
                                                </div>
                                            </div>
                                            <button class="btn btn--green items__item__btn">Rezerva acum »</button>
                                            <img src="<?=$item['images'][0]['small'];?>">
                                        </a>
                                    </div>
                                    <?php if($i == count($_box_circuits)-1) { ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>

                            <?php $i++;
                            } ?>
                            <!-- END foreach loop -->
                        <?php } ?>
                        <!-- END IF -->
                </div>
            </div>
        </div>
    </div>
</div>