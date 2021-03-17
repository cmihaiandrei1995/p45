<div id="map-canvas" style="width:800px; height:550px;"></div>

<script>
$(document).ready(function(){
	var infowindow = null;
	var myLatlng = new google.maps.LatLng(<?=$mapCenter?>);
	var cities = [<?=$cities_for_js?>];
	var map;
	
	function initialize() {
		var mapOptions = {
		    zoom: <?=$zoomLvl?>,
		    center: myLatlng,
		    mapTypeId: google.maps.MapTypeId.ROADMAP,
		    fullscreenControl: false,
		    streetViewControl: false,
		   	mapTypeControl: false,
		    styles: [{"featureType":"all","elementType":"all","stylers":[{"hue":"#008eff"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"0"},{"lightness":"0"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-60"},{"lightness":"-20"}]}]
		    //styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
		};
	  	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  
	 	var path = [];
	 	
	    for (var i = 0; i < cities.length; i++) {
		  	var city = cities[i];
		  	var myLatLng = new google.maps.LatLng(city[1], city[2]);
			var marker = new google.maps.Marker({
		        position: myLatLng,
		        map: map,
		        icon: {
		        	url: '<?=url('img/pin-map.png', 'static')?>',
		        	size: new google.maps.Size(11, 11),
				    anchor: new google.maps.Point(7, 5),
		        }
		    });
		    path.push(marker.getPosition());
	    }
	    
	    /*
	    var flightPlanCoordinates = [
	    	<?=$line_points?>
	    ];
	    var flightPath = new google.maps.Polyline({
		    path: flightPlanCoordinates,
		    strokeColor: '#2f62a2',
		    strokeOpacity: 0.7,
		    strokeWeight: 2
	    });
	
	    flightPath.setMap(map);
	    */
	   
		var lineSymbol = {
		    path: google.maps.SymbolPath.CIRCLE,
		    scale: 5,
		    strokeColor: '#2f62a2',
		    strokeWeight: 10
		};
		
	    var myLine = new google.maps.Polyline({
	    	map: map,
	    	path: path,
	    	strokeColor: "#2f62a2",
		    strokeOpacity: 0.7,
	    	strokeWeight: 2,
		    icons: [{
		    	icon: lineSymbol
		    }],
	    });
		
		animateCircle(myLine);

	}
	  
	google.maps.event.addDomListener(window, 'load', initialize);
	
	function animateCircle(line) {
	    var count = 0;
	    window.setInterval(function() {
	    	count = (count + 1) % 200;
	
	      	var icons = line.get('icons');
	      	icons[0].offset = (count / 2) + '%';
	      	line.set('icons', icons);
	  	}, 50);
	}
});
</script>