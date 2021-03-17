<?

function get_circuit_by_id($id){
	return get_post(array(
		'table' => 'circuit',
		'id_circuit' => $id,
		'images' => true
	));
}

function get_circuit_by_eurosite_code($code){
    return db_row('SELECT * FROM circuit WHERE code = ?', $code);
}

function circuit_prepare_basic_info($item){
	$item['url'] = route('circuit', $item['title']);

	$item['title'] = ucwords(strtolower($item['title']));

	if(!$item['images']){
		$item['images'][0] = array(
			'thumb' => url('img/nohotel-small.jpg', 'static'),
			'small' => url('img/nohotel-small.jpg', 'static'),
			'big' => url('img/nohotel-big.jpg', 'static')
		);
	}

	$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['description'], 100));

	return $item;
}


function circuit_prepare_info($item){
	global $_base, $_base_uploads;

	$item['url'] = route('circuit', $item['title']);

	$item['title'] = ucwords(strtolower($item['title']));

	$item = circuit_get_price($item);

	if(!$item['images']){
		$item['images'][0] = array(
			'thumb' => url('img/nohotel-small.jpg', 'static'),
			'small' => url('img/nohotel-small.jpg', 'static'),
			'big' => url('img/nohotel-big.jpg', 'static')
		);
	}

	if($item['video']){
		$item['video_id'] = get_video_id($item['video']);
		$item['video_thumb'] = get_video_thumb($item['video']);
		$item['video_code'] = get_video_code($item['video'], 848, 480);
	}

	list($tags_cat, $count) = get_posts(array(
		'table' => 'circuit_label',
		'limit' => -1,
		'is_category' => 1,
		'extra_where' => ' AND id_circuit_label IN (SELECT id_circuit_label FROM circuit_to_label WHERE id_circuit = '.$item['id_circuit'].')'
	));
	$item['categories'] = $tags_cat;
	foreach($item['categories'] as $cat){
		$item['categories_txt'][] = $cat['title'];
	}

	list($tags_special, $count) = get_posts(array(
		'table' => 'circuit_label',
		'limit' => -1,
		'is_special' => 1,
		'extra_where' => ' AND id_circuit_label IN (SELECT id_circuit_label FROM circuit_to_label WHERE id_circuit = '.$item['id_circuit'].')'
	));
	$item['special'] = $tags_special;
	foreach($item['special'] as $cat){
		$item['special_txt'][] = $cat['title'];
	}

	if($item['days'] == "" && $item['nights'] == ""){
		$date1 = new DateTime($price['dep_date']);
		$date2 = new DateTime($price['ret_date_arr']);
		$numberOfDays = $date2->diff($date1)->format("%a");
		$item['days'] = $numberOfDays+1;

		$date1 = new DateTime($price['dep_date_arr']);
		$date2 = new DateTime($price['ret_date']);
		$numberOfNights = $date2->diff($date1)->format("%a");
		$item['nights'] = $numberOfNights;
	}

	$cities = db_query('SELECT * FROM circuit_to_city WHERE id_circuit = ?', $item['id_circuit']);
	foreach($cities as $city){
		$city = get_city_by_id($city['id_city']);

		if(!in_array($city['id_city'], $item['cities'])){
			$item['cities'][] = $city['id_city'];
			$item['cities_txt'][] = $city['title'];
		}
		if(!in_array($city['id_country'], $item['countries'])){
			$country = get_country_by_id($city['id_country']);
			$item['countries'][] = $country['id_country'];
			$item['countries_txt'][] = $country['title'];
		}
	}

	$dates = db_query('SELECT * FROM circuit_date_price WHERE id_circuit = ? AND dep_date >= "'.date('Y-m-d').'" ORDER BY dep_date ASC', $item['id_circuit']);
	foreach($dates as $date){
		$item['dates'][] = date('d.m.Y', strtotime($date['dep_date']));
	}

	$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['description'], 100));

	if($item['itinerary_img']){
		$item['itinerary'] = $_base_uploads.'images/'.$item['itinerary_img_path'].'small-'.$item['itinerary_img'];
		$item['itinerary_big'] = $_base_uploads.'images/'.$item['itinerary_img_path'].$item['itinerary_img'];
	}

	$item['itinerary_items'] = db_query('SELECT * FROM circuit_itinerary WHERE id_circuit = ? ORDER BY `order` ASC', $item['id_circuit']);

	$item['map_image'] = circuit_generate_map_image($item['itinerary_items'], 300, 300);
	$item['map_big'] = route('circuit-map', $item['id_circuit']);

	return $item;
}


function circuit_prepare_info_from_search($item, $search, $results){

	$item = circuit_prepare_info($item);

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	foreach($results as $s_item){
		$code = $s_item['CircuitId']['value'];
		if($code == $item['code']){
			$search_info = $s_item;
			break;
		}
	}

	$variants = array();
	if($search_info['Variants']['Variant'][0]){
		$variants = $search_info['Variants']['Variant'];
	}else{
		$variants[0] = $search_info['Variants']['Variant'];
	}

	foreach($variants as $k => $variant){
		$varitant_id = str_replace($s_item['SearchId']['value']."_", "", $variant['UniqueId']['value']);
		$price_date = db_row('SELECT * FROM circuit_date_price WHERE code = ?', $varitant_id);

		$price = $variant['Gross']['value'];
		$date = date("d.m.Y", strtotime($price_date['dep_date']));

		$item['variants'][$date] = $price;

		//if($k == 0){
			if($variant['PriceNoRedd']['value'] > 0 && $variant['PriceNoRedd']['value'] > $variant['Gross']['value']){
				$item['price_old'] = $variant['PriceNoRedd']['value'];
				$item['price'] = $variant['Gross']['value'];

				if(!$price_date['offer_type']) $price_date['offer_type'] = 1;
				if($price_date['offer_type'] == 1){
					$item['special_offer'] = true;
				}elseif($price_date['offer_type'] == 2){
					$item['last_minute'] = true;
				}elseif($price_date['offer_type'] == 3){
					$item['early_booking'] = true;
				}

				$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

				if(!$price_date['reduction_type']) $price_date['reduction_type'] = 1;
				if($price_date['reduction_type'] == 1){
					$item['discount'] = 100 - round(($item['price']/$item['price_old']) * 100);
				}elseif($price_date['reduction_type'] == 2){
					$item['discount'] = $item['price_old'] - $item['price'];
				}
				$item['reduction_type'] = $price_date['reduction_type'];
			}else{
				$item['price'] = $variant['Gross']['value'];
			}
		//}
	}

	return $item;
}


function circuit_get_price($item, $date = ""){

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	if($date != ""){
		$price = db_row('SELECT * FROM circuit_date_price WHERE id_circuit = ? AND dep_date LIKE "'.date('Y-m-d', strtotime($date)).'%" ORDER BY price ASC LIMIT 1', $item['id_circuit']);
	}else{
		$price = db_row('SELECT * FROM circuit_date_price WHERE id_circuit = ? AND dep_date >= "'.date('Y-m-d').'" ORDER BY price ASC LIMIT 1', $item['id_circuit']);
	}

	if($price['priceNoRedd'] > 0 && $price['priceNoRedd'] > $price['price']){
		$item['price_old'] = round($price['priceNoRedd'] / 2);
		$item['price'] = round($price['price'] / 2);

		if(!$price['offer_type']) $price['offer_type'] = 1;
		if($price['offer_type'] == 1){
			$item['special_offer'] = true;
		}elseif($price['offer_type'] == 2){
			$item['last_minute'] = true;
		}elseif($price['offer_type'] == 3){
			$item['early_booking'] = true;
		}

		$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

		if(!$price['reduction_type']) $price['reduction_type'] = 1;
		if($price['reduction_type'] == 1){
			$item['discount'] = 100 - round(($item['price']/$item['price_old']) * 100);
		}elseif($price['reduction_type'] == 2){
			$item['discount'] = $item['price_old'] - $item['price'];
		}
		$item['reduction_type'] = $price['reduction_type'];
	}else{
		$item['price'] = round($price['price'] / 2);
	}

	$item['price_date'] = date('Y-m-d', strtotime($price['dep_date']));

	return $item;
}


function get_circuit_by_slug($slug){
	list($circuits, $count) = get_posts(array(
		'table' => 'circuit',
		'limit' => -1
	));

	foreach($circuits as $circuit){
		if(generate_name($circuit['title']) == $slug){
			return $circuit;
		}
	}

	return null;
}

function get_circuit_category_by_slug($slug){
	list($circuits, $count) = get_posts(array(
		'table' => 'circuit_label',
		'limit' => -1
	));

	foreach($circuits as $circuit){
		if(generate_name($circuit['title']) == $slug){
			return $circuit;
		}
	}

	return null;
}



function circuit_generate_map_image($items, $size_x, $size_y){
	global $_config;

	if($items){

		$_static_map_image = "https://maps.googleapis.com/maps/api/staticmap?";

		// add size
		$_static_map_image .= "&size=".$size_x."x".$size_y;

		// get hotels
		foreach($items as $item){
			if($item['map_x'] != 0 && $item['map_y'] != 0 && $item['map_x'] != "" && $item['map_y'] != ""){
				$coordinates['x'][] = $item['map_x'];
				$coordinates['y'][] = $item['map_y'];
			}
		}

		if($coordinates['x'] && $coordinates['y']){

			$line_points = '&path=color:0x002f62a2|weight:2';

			// calculate center
			$map_width = abs(min($coordinates['x']) - max($coordinates['x']));
			$map_height = abs(min($coordinates['y']) - max($coordinates['y']));
			$center_x = min($coordinates['x']) + $map_width/2;
			$center_y = min($coordinates['y']) + $map_height/2;

			// add center and zoom
			$_static_map_image .= "&center=".$center_x.",".$center_y;

			// add hotels
			foreach($items as $item){
				if($item['map_x'] != 0 && $item['map_y'] != 0 && $item['map_x'] != "" && $item['map_y'] != ""){
					$_static_map_image .= "&markers=size:tiny|".$item['map_x'].",".$item['map_y'];
					//$_static_map_image .= "&markers=icon:".url('img/pin-map.png', 'static')."|".$item['map_x'].",".$item['map_y'];
					$line_points .= '|'.$item['map_x'].','.$item['map_y'];
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

			$_static_map_image .= "&zoom=".$zoomLvl;

			// add style

			$_static_map_image .= "&style=feature:all|hue:0x008eff";
			$_static_map_image .= "&style=feature:poi|visibility:off";
			$_static_map_image .= "&style=feature:transit|visibility:off";
			$_static_map_image .= "&style=feature:road|element:all|saturation:0|lightness:0";
			$_static_map_image .= "&style=feature:road|element:labels.icon|visibility:off";
			$_static_map_image .= "&style=feature:water|element:all|visibility:simplified|lightness:-20|saturation:-60";

			/*
			$_static_map_image .= "&style=feature:poi|visibility:off";
			$_static_map_image .= "&style=feature:water|element:geometry|color:0xe9e9e9|lightness:17";
			$_static_map_image .= "&style=feature:landscape|element:geometry|color:0xf5f5f5|lightness:20";
			$_static_map_image .= "&style=feature:road|visibility:off";
			$_static_map_image .= "&style=feature:all|element:labels.text.stroke|visibility:on|color:0xffffff|lightness:16";
			$_static_map_image .= "&style=feature:all|element:labels.text.fill|color:0x333333|lightness:17";
			$_static_map_image .= "&style=feature:transit|element:geometry|color:0xf2f2f2|lightness:19";
			$_static_map_image .= "&style=feature:administrative|element:geometry.fill|color:0xfefefe|lightness:20";
			$_static_map_image .= "&style=feature:administrative|element:geometry.stroke|color:0xfefefe|lightness:17|weight:1.2";
			*/

			// add path
			$_static_map_image .= $line_points;

			// add key
			$_static_map_image .= "&key=".$_config['google']['api_key'];

			return $_static_map_image;

		}

	}

	return null;
}
