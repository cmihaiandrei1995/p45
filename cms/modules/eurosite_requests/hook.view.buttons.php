<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	rel="prettyPhoto[request<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/eurosite_requests/files/request.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=75%&height=75%"
	data-toggle="tooltip" data-placement="top" data-original-title="Request">
		<i class="fa fa-sign-in"></i>
</a>

<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	target="_blank"
	href="<?=$_base_cms?>modules/eurosite_requests/files/response.php?id=<?=$record[$_section['id']]?>"
	data-toggle="tooltip" data-placement="top" data-original-title="Response">
		<i class="fa fa-sign-out"></i>
</a>
