<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/hotel/hotels.php?id_country=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare hoteluri">
		<i class="fa fa-building"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/hotel/grile.php?id_country=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare grile">
		<i class="fa fa-calendar"></i>
</a>
<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base?>cron/eurosite/circuit/circuits.php?country=<?=$record[$_section['id']]?>" target="_blank"
	data-toggle="tooltip" data-placement="top" data-original-title="Sincronizare circuite">
		<i class="fa fa-exchange"></i>
</a>
