<main>
    <div class="my-account-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <h1 class="logo-title logo-title--full">
                                <span class="logo-title__text">Rezervari</span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <? include $_theme_path.'account/include/side.php' ?>
                        </div>
                        <div class="col-md-9">
                            <div class="my-content">
                                <? if($_bookings){?>

                                    <ul class="list-unstyled">

                                        <? foreach($_bookings as $item){?>

                                            <li class="<? if($item['is_old']){?>old<? }?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img class="swiper-items__item__img object-fit" src="<?=$item['info']['image']?>" alt="<?=$item['info']['title']?>">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <h3 class="items__item__supratitle"><a href="#"><?=$item['info']['title']?></a></h3>
                                                                <? if($item['info']['hotel_title']){?>
                                                                    <h4 class="items__item__title">
                                                                        <?=$item['info']['hotel_title']?><br>
                                                                        <? if($item['info']['hotel_stars']){?>
                                                                            <span>
                                                                                <? for($i=1; $i<=$item['info']['hotel_stars']; $i++){?>
                                                                                    <i class="sprite sprite-star"></i>
                                                                                <? }?>
                                                                            </span>
                                                                        <? }?>
                                                                    </h4>
                                                                <? }?>
                                                                <br>
                                                                <b>Cazare:</b> <?=$item['info']['days']?> zile / <?=$item['info']['nights']?> nopti<br />
                                                                <? if($item['info']['room_info']){?>
                                                                    <b>Tip camera:</b> <?=$item['info']['room_info']?>
                                                                <? }?>
                                                                <? if($item['info']['meal_info']){?>
                                                                    <b>Masa:</b> <?=$item['info']['meal_info']?><br />
                                                                <? }?>
                                                                <b>Turisti:</b> <?=$item['info']['adult']?> <?=$item['info']['adult'] > 1 ? "adulti" : "adult"?><? if($item['info']['child']){?>, <?=$item['info']['child']?> <?=$item['info']['child'] > 1 ? "copii" : "copil"?><? }?><br />
                                                                <? if($item['info']['city_from']){?>
                                                                    <b>Plecare din:</b> <?=$item['info']['city_from']?>
                                                                <? }?>
                                                            </div>
                                                            <div class="col-md-5 check-boxes">
                                                                <div class="check">
                                                                    Check-in<br />
                                                                    <span class="day"><?=$item['info']['check_in_day']?></span><br />
                                                                    <span class="year"><?=$item['info']['check_in_year']?></span><br />
                                                                    <span class="day-name"><?=$item['info']['check_in_weekday']?></span>
                                                                </div>
                                                                <div class="check">
                                                                    Check-out<br />
                                                                    <span class="day"><?=$item['info']['check_out_day']?></span><br />
                                                                    <span class="year"><?=$item['info']['check_out_year']?></span><br />
                                                                    <span class="day-name"><?=$item['info']['check_out_weekday']?></span>
                                                                </div>
                                                                <p class="total">
                                                                    TOTAL:
                                                                    <? if($item['old_total']){?>
                                                                        <span><del><?=$item['old_total']?>&euro;</del></span>
                                                                    <? }?>
                                                                    <span><?=$item['total']?>&euro;</span>
                                                                </p>
                                                            </div>
                                                            <? if(!$item['is_old']){?>
                                                                <!--
                                                                    <div class="col-md-7">
                                                                        <button class="btn btn-block btn--light-blue"><i class="down"></i><b>DESCARCA</b><br />DOCUMENTELE DE CALATORIE</button>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <button class="btn btn-block btn--green" href="#">vezi rezervarea ›</button>
                                                                    </div>
                                                                -->
                                                            <? }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        <? }?>

                                    </ul>

                                <? }else{?>

                                    <b>Nu ai nici o rezervare.</b>

                                <? }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
