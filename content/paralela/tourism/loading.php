<main class="margin--bottom-100">
	<div class="container-fluid inner-banner">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
				    <div class="loading-txt">Cautam vacanta ta...</div>
					<? if($_header_img != ""){?>
					    <div class="black-layer"></div>
						<img class="img-banner__img object-fit" src="<?=$_header_img?>" alt="<?=$_title?>">
					<? }?>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid margin--top-50">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<div class="plata">
							<img src="<?=urle('img/spinner.gif', 'static')?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<script>
$(document).ready(function(){
	$.ajax({
		url: $_base + 'ajax/search/advanced/tourism.php',
		data: {id: '<?=$id_search?>'},
		dataType: 'json',
		success: function(data) {
			location.href = data.url;
		}
	});
});
</script>