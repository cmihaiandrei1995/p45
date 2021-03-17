<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/hotel/hotels.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare hoteluri">
		<i class="fa fa-building"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/hotel/grile.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare grile">
		<i class="fa fa-calendar"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/hotel/minprice.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare preturi hoteluri">
		<i class="fa fa-hotel"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-danger"
	href="<?=$_base?>cron/eurosite/hotel/clear_price.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Golire preturi hoteluri">
		<i class="fa fa-hotel"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/charter/minprice.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare preturi charter">
		<i class="fa fa-plane"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-danger"
	href="<?=$_base?>cron/eurosite/charter/clear_price.php?id_city=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Golire preturi charter">
		<i class="fa fa-plane"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[weather<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/cities/files/weather.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=70%&height=90%"
	data-toggle="tooltip" data-placement="top" data-original-title="Vremea">
		<i class="fa fa-sun-o"></i>
</a>
