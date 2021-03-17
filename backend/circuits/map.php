<?

$_item = get_circuit_by_id($_params['id']);
if(!$_item) go_away(route('circuits-home'));

$_item['itinerary_items'] = db_query('SELECT * FROM circuit_itinerary WHERE id_circuit = ? ORDER BY `order` ASC', $_item['id_circuit']);

foreach($_item['itinerary_items'] as $item){
	if($item['map_x'] != 0 && $item['map_y'] != 0 && $item['map_x'] != "" && $item['map_y'] != ""){
		$coordinates['x'][] = $item['map_x'];
		$coordinates['y'][] = $item['map_y'];
	}
}

if($coordinates['x'] && $coordinates['y']){
	
	// calculate center
	$map_width = abs(min($coordinates['x']) - max($coordinates['x']));
	$map_height = abs(min($coordinates['y']) - max($coordinates['y']));
	$center_x = min($coordinates['x']) + $map_width/2;
	$center_y = min($coordinates['y']) + $map_height/2;
	
	$mapCenter = $center_x.','.$center_y;
	
	// add hotels
	foreach($_item['itinerary_items'] as $item){
		if($item['map_x'] != 0 && $item['map_y'] != 0 && $item['map_x'] != "" && $item['map_y'] != ""){
			
			/*
			$description =
				'<div style=\"padding-top:5px;width:380px; overflow:hidden;\">'.
				    '<div style=\"font-size: 22px;display: inline-block;\">'.$item['title'].'</div>'.
					(empty($item['description']) ? '' : '<div style=\"font-size:13px;margin-top: 5px;\">'.$item['description'].'</div>').
			    '</div>';
			*/
				
			//$cities_for_js .= '["'.$item['title'].'",'.$item['map_x'].','.$item['map_y'].',"'.$description.'"],';
			$cities_for_js .= '["'.$item['title'].'",'.$item['map_x'].','.$item['map_y'].'],';
			
			$line_points .= 'new google.maps.LatLng('.$item['map_x'].','.$item['map_y'].'),';
		}
	}
	
	// calculate zoom
	$dist = (6371 *
		acos(
			sin(min($coordinates['x']) / 57.2958) *
			sin(max($coordinates['x']) / 57.2958) + (
				cos(min($coordinates['x']) / 57.2958) *
				cos(max($coordinates['x']) / 57.2958) *
				cos(max($coordinates['y']) / 57.2958 - min($coordinates['y']) / 57.2958)
			)
		)
	);
	
	if($dist < 24576) $zoomLvl = 1;
	if($dist < 12288) $zoomLvl = 2;
	if($dist < 6144) $zoomLvl = 3;
	if($dist < 3072) $zoomLvl = 4;
	if($dist < 1536) $zoomLvl = 5;
	if($dist < 768) $zoomLvl = 6;
	if($dist < 384) $zoomLvl = 7;
	if($dist < 192) $zoomLvl = 8;
	if($dist < 96) $zoomLvl = 9;
	if($dist < 48) $zoomLvl = 10;
	if($dist < 24) $zoomLvl = 11;
	if($dist < 11) $zoomLvl = 12;
	if($dist < 4.8) $zoomLvl = 13;
	if($dist < 3.2) $zoomLvl = 14;
	if($dist < 1.6) $zoomLvl = 15;
	if($dist < 0.8) $zoomLvl = 16;
	if($dist < 0.3) $zoomLvl = 17;
	if($dist == 0) $zoomLvl = 10;
	
	$zoomLvl = $zoomLvl + 1;
	
}


$_do_not_include_header = true;
$_do_not_include_footer = true;

// seo
$_meta_title = $_item['title'];
$_no_index = true;