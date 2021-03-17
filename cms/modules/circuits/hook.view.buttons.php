<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base_cms?>bounce.php?action=filter&module=circuit_day_description&do=init&field=circuit_day_description.id_circuit&value=<?=$record[$_section['id']]?>&redirect_to_module=circuit_day_description"
	data-toggle="tooltip" data-placement="top" data-original-title="Descrierea pe zile">
		<i class="fa fa-list"></i>
</a>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[dates<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/circuits/files/dates.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=80%&height=80%"
	data-toggle="tooltip" data-placement="top" data-original-title="Date plecari">
		<i class="fa fa-calendar"></i>
</a>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[itinerary<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/circuits/files/itinerary.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=50%&height=75%"
	data-toggle="tooltip" data-placement="top" data-original-title="Itinerariu">
		<i class="fa fa-bus"></i>
</a>