<!-- @andrei: dropdown menu Pachete de vacanta -->
<ul class="dropdown-menu p45-dd-menu">
    <div class="nav-tabs-content">
        <ul class="nav nav-tabs side-nav">
            <? foreach($_destinations_from as $k=>$dest) {?>
            <li class="<? if($k==0) {?>active<? }?> p45-dd-menu-item"><a data-toggle="tab" href="#<?=generate_name($dest['title']);?>">Plecari din <?= $dest['title']; ?></a></li>
            <? }?>
        </ul>
    </div>

    <div class="tab-content">
        <? foreach($_destinations_from as $k=>$dest) {?>
        <div id="<?=generate_name($dest['title']);?>" class="tab-pane fade in<? if($k==0){?> active<?}?> clearfix">

            <ul class="nav nav-tabs full-nav">
                <? if($dest['countries']) {?>
                <? foreach($dest['countries'] as $k_country => $country) {?>
                <li>
                    <ul class="nav nav-tabs">
                        <li><strong><?= $country['title']; ?></strong></li>
                        <? if($country['cities']) {?>
                        <? foreach($country['cities'] as $k_city => $city) {?>
                        <li><a href="<?= $city['url']; ?>"><?= $city['title']; ?></a></li>
                        <? if($k_city == 2){ break; } }?>
                        <? }?>
                    </ul>
                </li>
                <? if($k_country == 5){ break; } }?>
                <? }?>
            </ul>

            <div class="dropdown-menu-pict" style="background:url(<?=$dest['images'][0]['small'];?>);">
                <a href="<?=route('custom-vacations');?>"><button class="btn btn--green items__item__btn">Rezerva acum</button></a>
            </div>
        </div>
        <? }?>
    </div>
</ul>