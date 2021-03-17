<script>
$(document).ready(function(){
    if(ecommTrackImp.length){
        dataLayer.push({
    		"ecommerce": {
    	    	"currencyCode": "EUR",
    	    	"impressions": ecommTrackImp
    	  	}
    	});
    }

    if(rmkGTrackItems.length){
        gtag('event', 'view_item_list', {
            'send_to': 'AW-1009319514',
      		'items': rmkGTrackItems
    	});
    }

    if(rmkFbTrackPrice.length && rmkFbTrackIds.length){
        gtag('event', 'page_view', {
            'send_to': 'AW-1009319514',
            'dynx_itemid': rmkFbTrackIds,
            'dynx_itemid2': '',
            'dynx_pagetype': rmkEventType,
            'dynx_totalvalue': rmkFbTrackPrice
        });

        fbq('track', 'ViewContent', {
            //value: rmkFbTrackPrice,
            //currency: 'EUR',
            content_ids: rmkFbTrackIds,
            content_type: 'product',
        });
    }
});
</script>

<script type="text/javascript" src="<?php urle('js/plugins.js', 'static') ?>?v=<?=date('Ymd')?>"></script>

<? /*
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/ro.js"></script>
*/ ?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/masonry/3.1.5/masonry.pkgd.min.js"></script>

<!-- IE hack for object-fit css property -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.1.3/ofi.min.js"></script>
<script src="https://cdn.rawgit.com/leafo/sticky-kit/v1.1.2/jquery.sticky-kit.min.js"></script>
<script src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.20/src/jquery.ez-plus.js"></script>

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&key=<?=$_config['google']['api_key']?>"></script>

<script type="text/javascript" src="<?php urle('js/main.js', 'static') ?>?v=<?=date('Ymd')?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery_lazyload/1.9.7/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?= $_base ?>static/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>

<? if($_page != 'circuit-map'){?>
    <!-- Hotjar Tracking Code for https://www.paralela45.ro/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:681485,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
<? }?>

<? if($_page != 'bf' && $_page != 'happy'){?>
    <script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/b7b8273b287e9134de3cb363593903cb_1.js" async></script>
<? }?>

<? /* OLD
    <script type="text/javascript">
    var lz_data = { language:'ro'};
    </script>
    <script type="text/javascript" id="24c02fa0f04065b2cf7217087b389f29" src="https://www.paralela45.ro/chat/script.php?id=24c02fa0f04065b2cf7217087b389f29"></script>
*/ ?>

<? /*
<script type="text/javascript">
var lz_data = { language:'ro'};
</script>
<script type="text/javascript" id="lzdefsc" src="//www.paralela45.ro/chat/script.php?id=lzdefsc" defer></script>
*/ ?>


<? if(date("H") >= 9 && date("H") < 17 && date('N') < 6){?>
    <div class="fb-customerchat" attribution=setup_tool page_id="89625862971" theme_color="#2e8ae5" logged_in_greeting="Cum va putem ajuta?" logged_out_greeting="Cum va putem ajuta?"></div>
<? }?>


<? if(!isset($_SESSION['accept_cookies'])){?>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
	window.cookieconsent.initialise({
	  "palette": {
	    "popup": {
	      "background": "#fff",
	      "text": "#585858"
	    },
	    "button": {
	      "background": "#72b94e",
	      "text": "#ffffff"
	    }
	  },
	  "theme": "edgeless",
	  "content": {
	    "message": "Acest site foloseste cookies. <span class='hidden-xxs'>Continuarea navigarii in site inseamna ca esti de acord cu </span>",
	    "dismiss": "<i class='zmdi zmdi-close'></i> INCHIDE",
	    "link": "Politica de cookies a site-ului",
	    "href": "/info/politica-de-confidentialitate/"
	  }
	});
});
</script>
<? $_SESSION['accept_cookies'] = true;}?>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-598b851f008c84aa"></script>
