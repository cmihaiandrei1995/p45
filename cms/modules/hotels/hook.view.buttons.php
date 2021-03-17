<?
$grile = db_row("SELECT COUNT(*) AS nr FROM hotel_grila WHERE id_hotel = ?", $record[$_section['id']]);
$charter = db_row("SELECT COUNT(*) AS nr FROM charter_minprice WHERE id_hotel = ?", $record[$_section['id']]);
?>

<? if($grile['nr'] > 0){?>
	<a
		class="mb-xs mt-xs mr-xs btn btn-default"
		rel="prettyPhoto[grile<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/hotels/files/grile.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=90%&height=90%"
		data-toggle="tooltip" data-placement="top" data-original-title="<?=$grile['nr']?> grile">
			<i class="fa fa-calendar"></i>
	</a>
<? }?>
<? if($charter['nr'] > 0){?>
	<a
	    class="mb-xs mt-xs mr-xs btn btn-default"
	    href="<?=$_base_cms?>bounce.php?action=filter&module=charter_minprice&do=init&field=charter_minprice.id_hotel&value=<?=$record[$_section['id']]?>&redirect_to_module=charter_minprice"
	    data-toggle="tooltip" data-placement="top" data-original-title="<?=$charter['nr']?> preturi charter">
	        <?=$charter['nr']?> <i class="fa fa-plane"></i>
	</a>
<? }?>
