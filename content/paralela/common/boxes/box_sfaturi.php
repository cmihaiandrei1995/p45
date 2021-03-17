<? if(count($_xml_news)) {?>
<div class="onesection sfaturi-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="row">
                     <!-- sfaturi__title__wrapper -->
                    <div class="col-xs-12 hr-title">
                        <h3 class="oferte__title text--blue hr-title__text"><?=$_text_sfaturi['section_title'];?></h3>

                        <div class="row">
                            <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                                <h4 class="hr-subtitle">
                                <?=$_text_sfaturi['description'];?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <? foreach($_xml_news['rss']['channel']['item'] as $item => $val) {?>
                    <div class="col-xs-12 col-md-6">
                        <div class="sfat-item">
                            <div class="row">
                                <div class="col-xs-12 col-ms-5 col-sm-4 col-md-5">
                                    <div style="height:110px; max-width:100%; background-size:cover;background-position:center center; background-repeat:no-repeat; background-image: url(<?=$val['media:content']['attr']['url'];?>);"></div>
                                </div>
                                <div class="col-xs-12 col-ms-7 col-sm-8 col-md-7">
                                    <div class="sfat-item__date"><?=date("d", strtotime($val['pubDate']['value']))?>-<?=date("M", strtotime($val['pubDate']['value']))?>-<?=date("Y", strtotime($val['pubDate']['value']))?></div>
                                    <div class="sfat-item__title"><?=$val['title']['value']?></div>
                                    <div class="sfat-item__details"><?=limit_text($val['description']['value'], 100)?></div>
        						    <a href="<?=$val['link']['value']?>?&utm_source=CMS&utm_medium=Click&utm_campaign=<?=urlencode($val['title']['value'])?>" class="read-more">citeste mai mult »</a>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <? }?>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <a href="" class="btn btn--green items__item__btn">citeste toate articolele »</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? }?>