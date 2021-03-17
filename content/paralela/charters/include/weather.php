<?
if($_is_zone){
	$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
	$weather_title = $_title;
}elseif($_is_city){
	$weather = db_query('SELECT * FROM city_weather WHERE id_city = ? ORDER BY month ASC', $_item['id_city']);
	if(!$weather){
		$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
	}
	$weather_title = $_title;
}

if($weather){
?>
<div class="aside-filters__vremea hidden-xs">
	<p class="aside-filters__vremea__title"><strong>Vremea <?=$_is_tag ? "la" : "in"?></strong> <?=$weather_title?></p>
	<p class="text-center mb-20">
		<select id="weather-month">
			<? foreach($weather as $item){?>
				<option value="<?=$item['month']?>" <? if($item['month'] == date('n')){?>selected<? }?>><?=$_months[$item['month']]?></option>
			<? }?>
		</select>
	</p>
	<? foreach($weather as $item){?>
		<div id="weather<?=$item['month']?>" class="weather <? if($item['month'] != date('n')){?>hidden<? }?>">
			<p class="text-center icon-holder"><span class="<?=$item['icon']?>-weather"></span></p>
			<div class="clearfix">
				<p class="vremea-grade left"><span>max.<b><?=$item['max_temp']?>&deg;<span>C</span></b></span></p>
				<p class="vremea-grade right"><span>min.<b><?=$item['min_temp']?>&deg;<span>C</span></b></span></p>
			</div>
		</div>
	<? }?>
	<p class="text-center medium-temp">* temperatura medie a lunii</p>
</div>
<? }?>