<div class="my-acc-menu">
    <ul class="list-unstyled">
        <li>
            <div class="my-acc-pict">
                <img src="<?= $_base ?>static/img/my-acc-placeholder.png" />
            </div>
            <div class="my-acc-name">
                <?=$_user['title']?>
            </div>
            <hr>
        </li>
        <li <? if($_section == "reservations"){?>class="active"<? }?>><a href="<?=route('my-account-bookings')?>"><i class="my-acc-sprite my-acc-01"></i>Rezervarile mele</a></li>
        <li <? if($_section == "account"){?>class="active"<? }?>><a href="<?=route('my-account-account')?>"><i class="my-acc-sprite my-acc-02"></i>Date cont</a></li>
        <!--<li <? if($_section == "passengers"){?>class="active"<? }?>><a href="<?=route('my-account-passengers')?>"><i class="my-acc-sprite my-acc-02"></i>Date pasageri</a></li>-->
        <!--<li><a href="#"><i class="my-acc-sprite my-acc-03"></i>Documente de calatorie</a></li>-->
        <li <? if($_section == "loyalty"){?>class="active"<? }?>><a href="<?=route('my-account-loyalty')?>"><i class="my-acc-sprite my-acc-04"></i>Puncte de fidelitate</a></li>
        <li <? if($_section == "whishlist"){?>class="active"<? }?>><a href="<?=route('my-account-whishlist')?>"><i class="my-acc-sprite my-acc-05"></i>Wishlist</a></li>
        <li><a href="<?=route('logout')?>"><i class="my-acc-sprite my-acc-06"></i>LOGOUT</a></li>
    </ul>
</div>
