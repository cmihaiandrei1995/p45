<a
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[booking<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/bookings/files/booking.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=85%&height=95%"
	data-toggle="tooltip" data-placement="top" data-original-title="Detalii comanda">
		<i class="fa fa-info"></i>
</a>

<!--
<div class="btn-group">
	<button type="button" class="m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <span class="caret"></span></button>
	<ul class="dropdown-menu dropdown-menu-right" role="menu">
		<li><a href="<?=$_base_cms?>modules/bookings/files/view_confirmation.php?id=<?=$record[$_section['id']]?>" target="_blank">Vezi email confirmare</a></li>

		<? if($record['status'] == "success" && $record['payment'] == "card"){?>
			<li><a href="<?=$_base_cms?>modules/bookings/files/view_vouchers.php?id=<?=$record[$_section['id']]?>" target="_blank">Vezi vouchere</a></li>
		<? }?>

		<li role="separator" class="divider"></li>

		<li><a href="<?=$_base_cms?>modules/bookings/files/resend_confirmation.php?id=<?=$record[$_section['id']]?>">Retrimite email confirmare</a></li>

		<? if($record['status'] == "success" && $record['payment'] == "card"){?>
			<li><a href="<?=$_base_cms?>modules/bookings/files/resend_vouchers.php?id=<?=$record[$_section['id']]?>">Retrimite vouchere</a></li>
		<? }?>
	</ul>
</div>

<script>
$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
</script>
-->
