<?
$dates = db_row("SELECT COUNT(*) AS nr FROM cruise_date WHERE id_cruise = ?", $record[$_section['id']]);
?>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[dates<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/cruises/files/dates.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=50%&height=75%"
	data-toggle="tooltip" data-placement="top" data-original-title="<?=$dates['nr']?> plecari">
		<?//=$dates['nr']?> <i class="fa fa-calendar"></i>
</a>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[itinerary<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/cruises/files/itinerary.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=75%&height=75%"
	data-toggle="tooltip" data-placement="top" data-original-title="Itinerariu">
		<i class="fa fa-anchor"></i>
</a>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[rooms<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/cruises/files/rooms.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=75%&height=75%"
	data-toggle="tooltip" data-placement="top" data-original-title="Cabine">
		<i class="fa fa-bed"></i>
</a>
