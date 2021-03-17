<div class="map-content" id="map_modal" style="height: 550px; width: 800px;"></div>

<script>
	$(document).ready(function(){
		initMap(<?=(float)$_item['latitude']?>, <?=(float)$_item['longitude']?>, '<?=$_item['title'] ?>', '<?=$_item['url']?>', '<?=$_item['images'][0]['medium']?>');
	});
</script>