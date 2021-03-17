<main class="lp">

    <? include $_theme_path."lp/include/slider.php"?>

    <? /*
    <div class="header-intro">
        <a href="http://newsletter-paralela45.ro/index.php?module=newsletterpreview&msgid=201802050833312da7b8c843073de4550a115b6887e366">
            <img class="swiper-main__img object-fit" src="../../static/img/lp-slider.png" alt="Promotie februarie" height="495" style="height:495px;">
        </a>
        <div class="swiper-main__countdown clock_counter">
            <i class="sprite sprite-countdown-top">
                <span class="swiper-main__countdown__top__title text-center text-uppercase text--orange">REDUCERI</span>
                <span class="swiper-main__countdown__top__sub text-center text--orange">SEDUCATOARE</span>
            </i>
            <ul class="swiper-main__countdown__list list-unstyled list-inline">
                <li class="swiper-main__countdown__list__item">
                    <span class="swiper-main__countdown__list__item__time"><span class="days">07</span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
                    <span class="swiper-main__countdown__list__item__text text-uppercase">Zile</span>
                </li>
                <li class="swiper-main__countdown__list__item">
                    <span class="swiper-main__countdown__list__item__time"><span class="hours">06</span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
                    <span class="swiper-main__countdown__list__item__text text-uppercase">Ore</span>
                </li>
                <li class="swiper-main__countdown__list__item">
                    <span class="swiper-main__countdown__list__item__time"><span class="minutes">30</span> <span class="swiper-main__countdown__list__item__time__sep">&nbsp;</span></span>
                    <span class="swiper-main__countdown__list__item__text text-uppercase">Minute</span>
                </li>
                <span class="seconds hidden">0</span>
            </ul>
            <div class="swiper-main__countdown__cta text--orange">
                <span class="swiper-main__countdown__cta__big text-uppercase">Reduceri</span>
                <span class="swiper-main__countdown__cta__small">de pana la</span>
                <i class="sprite sprite-countdown-separator"></i>
                <span class="swiper-main__countdown__cta__procent">-47%</span>
            </div>
            <div class="swiper-main__countdown__bottom text-uppercase"><p class="text-center"><strong>Rezerva o vacanta!</strong></p></div>
        </div>
    </div>
    */ ?>

    <? include $_theme_path."lp/include/banners.php"?>

    <div class="container-fluid">
        <div class="container">
            <? include $_theme_path.'lp/include/footer.php';?>
        </div>
    </div>

    <div class="container-fluid blue-bg" style="<? if($_item['bg_lp'] != ""){?>background:url('<?=$_base_uploads.'images/'.$_item['bg_lp_path'].$_item['bg_lp'];?>') no-repeat;<? }else{?>background:transparent!important;<? }?>">
        <div class="container">

            <? foreach($_offer_zones as $group){?>

                <?
                switch($group['type']){

                    case '1':{ // Charter + sejur

                        include $_theme_path."lp/include/charters.php";

                    }break;

                    case '2':{ // Of speciale hotel chartere

                        include $_theme_path."lp/include/hotels.php";

                    }break;

                    case '3':{ // Circuite

                        include $_theme_path."lp/include/circuits.php";

                    }break;

                    case '4':{ // Bilete avion

                        include $_theme_path."lp/include/planes.php";

                    }break;

                    case '5':{ // Zona text

                        include $_theme_path."lp/include/text.php";

                    }break;

                    case '6':{ // Zona video

                        include $_theme_path."lp/include/video.php";

                    }break;

                }
                ?>

            <? }?>

            <? if($_item['show_rate']){?>
                <!--plata-->
                <div class="row plata-rate-lp">
                    <div class="col-md-12">
                        <? include $_theme_path.'home/include/rate.php';?>
                    </div>
                </div>
            <? }?>

            <? if($_item['disclaimer'] != ""){?>
                <!--sectiune-->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="intro">
                            <br><br>
                            <?=$_item['disclaimer']?>
                        </div>
                    </div>
                </div>
            <? }?>

        </div>
    </div>
</main>
