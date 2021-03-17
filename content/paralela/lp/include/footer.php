<? if($_footer){?>
    <div class="row oof">
        <div class="col-xs-12">
            <div class="intro">
                <h3 class="title">
                    <?=$_item['title_footer']?>
                    <? if($_item['id_lp'] == 32){?>
                        <br>
                        <a href="https://www.paralela45.ro/uploads/asigurari.pdf" target="_blank">Vezi regulamentul campaniei &raquo;</a>
                    <? }?>
                </h3><br />
            </div>
        </div>
        <div class="col-xs-12">
            <? foreach($_footer as $k => $footer){?>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <? if($footer['url'] != ""){?>
                            <a href="<?=$footer['url']?>">
                        <? }?>
                            <img src="<?=$footer['images'][0]['small']?>" />
                        <? if($footer['url'] != ""){?>
                            </a>
                        <? }?>
                    </div>
                    <div class="col-xs-12 col-md-8">
                        <h3>
                            <? if($footer['url'] != ""){?>
                                <a href="<?=$footer['url']?>">
                            <? }?>
                                <?=$footer['title']?>
                            <? if($footer['url'] != ""){?>
                                </a>
                            <? }?>
                        </h3>
                        <?=$footer['description']?>
                        <br />
                        <div class="row">
                            <div class="col-md-8">
                                <? if($footer['price'] != ""){?>
                                    <p class="items__item__price"><span>de la</span> <?=$footer['price']?></p>
                                    <? if($footer['nights'] != ""){?>
                                        <p class="items__item__pers">/ persoana / <?=$footer['nights']?> nopti</p>
                                    <? }?>
                                <? }?>
                            </div>
                            <? if($footer['url'] != ""){?>
                                <div class="col-md-4">
                                    <a class="btn btn--green items__item__btn" href="<?=$footer['url']?>">vezi oferta &raquo;</a>
                                </div>
                            <? }?>
                        </div>
                    </div>
                </div>
                <? if($k < count($_footer) - 1){?>
                    <hr />
                <? }?>
            <? }?>
        </div>
    </div>
<? }?>
