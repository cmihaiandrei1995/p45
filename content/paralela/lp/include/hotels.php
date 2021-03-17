<? if($group['offers']){?>
    <div class="row">
        <div class="col-xs-12">
            <div class="section-title">
                <div class="title"><?=$group['title']?></div>
                <div class="loc">
                    <? if($group['icon_bus']){?>
                        <i class="sprite sprite-bus-blue-bb"></i>
                    <? }?>
                    <? if($group['icon_plane']){?>
                        <i class="sprite sprite-avion-blue-bb"></i>
                    <? }?>
                    <?=$group['subtitle']?>
                </div>
            </div>
        </div>

        <? foreach($group['offers'] as $item){?>
            <div class="col-xs-12 col-ms-6 col-sm-6 col-md-4 col-lg-3 chartere__item">
                <a class="chartere__item__link hover-opacity clearfix" href="<?=$item['url']?>">
                    <img class="chartere__item__img object-fit lazy" data-original="<?=$item['images'][0]['small']?>">
                    <? if($item['offer_text'] != ""){?>
                        <div class="chartere__item__procent__wrapper">
                            <span class="chartere__item__procent notif" style="line-height:15px !important;font-size:14px;"><strong><?=strtoupper(str_replace(" ", "<br>", trim($item['offer_text'])))?></strong></span>
                        </div>
                        <!--
                        <div class="chartere__item__top">
                            <span class="chartere__item__top__text__early <? if(!$item['new'] && $item['discount_text'] == "" && $item['special_text'] == ""){?>full-width<? }?>"><?=str_replace(" ", "<br>", trim($item['offer_text']))?></span>
                        </div>
                        -->
                    <? }?>
                    <!--
                    <? if($item['discount_text'] != ""){?>
                        <div class="chartere__item__procent__wrapper">
                            <span class="chartere__item__procent__text"><?=$item['discount_text']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span class="chartere__item__procent" style="line-height:9px;"><strong><?=$item['discount']?></strong></span>
                            <span class="chartere__item__procent__text">din cazare</span>
                        </div>
                    <? }?>
                    <? if($item['new']){?>
                        <div class="chartere__item__extra chartere__item__extra--green">
                            <span class="chartere__item__extra__nou text-uppercase text--white block text-center"><strong>Nou!</strong></span>
                        </div>
                    <? }?>
                    <? if($item['special_text'] != ""){?>
                        <div class="chartere__item__extra chartere__item__extra--yellow">
                            <span class="chartere__item__extra__unic text-uppercase text--blue block text-center"><?=$item['special_text']?></span>
                        </div>
                    <? }?>
                    -->
                    <div class="chartere__item__title">
                        <h4 class="chartere__item__title__text">
                            <strong><?=$item['title']?></strong>
                        </h4>
                    </div>
                    <div class="chartere__item__details">
                        <i class="sprite sprite-lp-hotel"></i>
                        <span class="where hhotel first">
                            <b>
                                <?=$item['hotel']?>
                                <? if($item['stars'] > 0){?>
        							<span>
        								<? for($i=1; $i<=$item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
        							</span>
        						<? }?>
                            </b>
                            <?=$item['city']?> <? if($item['meal'] != ""){?> | <i><?=$item['meal']?></i><? }?>
                        </span>
                        <i class="sprite sprite-lp-calendar"></i>
                        <span class="where">
                            <? if($item['depart_from'] != ""){?><b>Plecare din <?=$item['depart_from']?></b><br> <? }?>
                            <b>Perioada:</b> <?=date('d.m.Y', strtotime($item['offer_from']))?> - <?=date('d.m.Y', strtotime($item['offer_to']))?>
                        </span>
                        <div class="row">
                            <div class="col-ms-6 col-sm-6">
                                <p class="items__item__lastprice">de la <? if($item['price_old']){?><span><?=$item['price_old']?>&euro;<span><? }?></p>
                                <p class="items__item__price"><?=$item['price']?>&euro;</p>
                            </div>
                            <div class="col-ms-6 col-sm-6">
                                <button class="btn btn--green items__item__btn" href="<?=$item['url']?>">Rezerva</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="items__item__pers">/ persoana / <?=$item['nights'] > 0 ? $item['nights']." nopti" : "perioada"?></p>
                                <p class="items__item__info">* taxele de aeroport incluse</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <? }?>

        <? if($group['button_title'] != "" && $group['button_url'] != ""){?>
            <div class="text-center" style="clear:both">
                <a href="<?=$group['button_url']?>" class="lp-cta-button"><?=$group['button_title']?></a>
                <br><br>
            </div>
        <? }?>
    </div>
<? }?>
