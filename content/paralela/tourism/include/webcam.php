<? if($_tag['id_city_tag'] == 2 || $_tag['id_city_tag'] == 5){?>
	<div class="aside-filters__vremea aside-filters__webcam hidden-xs">
		<p class="aside-filters__vremea__title"><strong>WEBCAM <?=$_tag['id_city_tag'] == 2 ? "Predeal" : "Navodari"?></strong></p>
		<!--
		<a href="<?=route('webcam', $_tag['id_city_tag'])?>" class="fancybox fancybox.iframe">
		-->
		<a href="<?=($_tag['id_city_tag'] == 2 ? "http://streaming.mobotixtools.com/live/5559aa70e3c1d" : "http://streaming.mobotixtools.com/live/5901e8f57d6ed")?>" target="_blank">
			<div class="img-big-webcam <?=$_tag['id_city_tag'] == 2 ? "munte" : "mare"?>"></div>
			<img src="<?= $_base ?>static/img/icon-webcam.jpg" class="img-small-webcam" />
		</a>
	</div>
<? }?>
