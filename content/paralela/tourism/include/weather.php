<?
if($is_ro){
	if($_is_tag){
		$weather = db_query('SELECT * FROM city_tag_weather WHERE id_city_tag = ? ORDER BY month ASC', $_tag['id_city_tag']);
		$weather_title = $_tag['title'];
	}else{
		if($_is_zone){
			$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
		}elseif($_is_city){
			$weather = db_query('SELECT * FROM city_weather WHERE id_city = ? ORDER BY month ASC', $_item['id_city']);
			if(!$weather){
				$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
			}
		}
		$weather_title = $_title;
	}
}elseif($_is_zone){
	$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
	$weather_title = $_title;
}elseif($_is_city){
	$weather = db_query('SELECT * FROM city_weather WHERE id_city = ? ORDER BY month ASC', $_item['id_city']);
	if(!$weather){
		$weather = db_query('SELECT * FROM zone_weather WHERE id_zone = ? ORDER BY month ASC', $_item['id_zone']);
	}
	$weather_title = $_title;
}elseif($_is_category){
	$weather = db_query('SELECT * FROM category_weather WHERE id_category = ? ORDER BY month ASC', $_item['id_category']);
	$weather_title = $_title;
}

if($weather){
?>
<div class="aside-filters__vremea hidden-xs">
	<p class="aside-filters__vremea__title"><strong>Vremea</strong> <?=$_is_category ? "" : ($_is_tag ? "la" : "in")?> <?=$weather_title?></p>
	<p class="text-center select-month">
		<select id="weather-month">
			<? foreach($weather as $item){?>
				<option value="<?=$item['month']?>" <? if($item['month'] == date('n')){?>selected<? }?>><?=$_months[$item['month']]?></option>
			<? }?>
		</select>
	</p>
	<? foreach($weather as $item){?>
		<div id="weather<?=$item['month']?>" class="weather <? if($item['month'] != date('n')){?>hidden<? }?> clearfix">
			<div class="temp">
				<p class="vremea-grade"><span>max.<b><?=$item['max_temp']?>&deg;<span>C</span></b></span></p>
				<div class="clearfix"></div><hr>
				<p class="vremea-grade"><span>min.<b><?=$item['min_temp']?>&deg;<span>C</span></b></span></p>
				<p class="text-center medium-temp">* temperatura medie a lunii</p>
			</div>
			<div class="temp-icon">
				<p class="text-center icon-holder"><span class="<?=$item['icon']?>-weather"></span></p>
			</div>
		</div>
	<? }?>
</div>
<? }?>
