<? if($group['offers']){?>
    <div class="row osc">
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
            <div class="col-xs-12 col-ms-6 col-sm-6 col-md-4 chartere__item chartere__itemon3">
                <a class="chartere__item__link hover-opacity clearfix" href="<?=$item['url']?>">
                    <img class="chartere__item__img object-fit lazy" data-original="<?=$item['images'][0]['thumb']?>">
                    <? if($item['last_places']){?>
                        <div class="chartere__item__corner">
                            <span><strong>ULTIMELE<br /><?=$item['last_places']?> LOCURI</strong></span>
                        </div>
                    <? }?>
                    <div class="chartere__item__title"><h4 class="chartere__item__title__text"><strong><?=$item['title']?></strong></h4></div>
                    <div class="chartere__item__details">
                        <div class="vertline"></div>
                        <div class="row">
                            <div class="col-ms-6 col-sm-6">
                                <i class="sprite sprite-lp-calendar"></i>
                                <span class="while"><?=$item['text2']?></span>
                                <? if($item['type'] == "plane"){?>
                                    <i class="sprite sprite-avion-blue"></i>
                                <? }else{?>
                                    <i class="sprite sprite-bus-blue-lp"></i>
                                <? }?>
                                <span class="where"><strong><?=$item['text1']?></strong></span>
                            </div>
                            <div class="col-ms-6 col-sm-6">
                                <p class="items__item__lastprice">de la <? if($item['price_old']){?><span><?=$item['price_old']?>&euro;<span><? }?></p>
                                <p class="items__item__price"><?=$item['price']?>&euro;</p>
                                <p class="items__item__pers">/ persoana</p>
                                <? if($item['type'] == "plane"){?>
                                    <p class="items__item__info">* taxele de aeroport incluse</p>
                                <? }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center"><button class="btn btn--green items__item__btn" href="<?=$item['url']?>">Rezerva</button></div>
                        </div>
                    </div>
                </a>
            </div>
        <? }?>
    </div>
<? }?>
