<?

$_item = get_circuit_by_slug($_params['slug']);
if(!$_item) go_away(route('circuits-home'));

if(isset($_GET['s']) && $_GET['s'] != "" && isset($_GET['d']) && $_GET['d'] != ""){

	$_search = db_row('SELECT * FROM circuit_search WHERE id_circuit_search = ?', intval($_GET['s']));
	if($_search){
		$id_search = $_search['id_circuit_search'];

		$results = cache_get('circuit_search_'.$id_search);
		if(!$results){
			$_item = circuit_prepare_info($_item);
		}else{
			$search_items = array();
			if($results['Circuit'][0]){
				$search_items = $results['Circuit'];
			}else{
				$search_items[0] = $results['Circuit'];
			}
		}

		$_item = circuit_prepare_info_from_search($_item, $_search, $search_items);

		$_search['room_info'] = json_decode($_search['room_data'], true);
	}else{
		$_item = circuit_prepare_info($_item);
	}

	if($_item['variants']){
		foreach($_item['variants'] as $date => $variant){
			if($date == $_GET['d']){
				$_item['date'] = $date;
				$_item['price_old'] = "";
				$_item['price'] = $variant;
				break;
			}
		}
	}

	if(!$_item['price']){
        go_away($_SERVER['SCRIPT_URI'], '301');
    }

}else{
	$_item = circuit_prepare_info($_item);
}

if(isset($_GET['d']) && $_GET['d'] != "" && !isset($_GET['s'])){
	if(in_array(date('d.m.Y', strtotime($_GET['d'])), $_item['dates'])){
		$_item = circuit_get_price($_item, $_GET['d']);
	}
}

$_item['images'] = get_images('circuit', $_item['id_circuit']);

$countries = db_query('
	SELECT * FROM country
	WHERE id_country IN (
		SELECT id_country FROM city
		WHERE id_city IN (
			SELECT id_city FROM circuit_to_city WHERE id_circuit = ?
		) AND '.db_is_active('', 'city').'
	)
	AND '.db_is_active('', 'country').'
', $_item['id_circuit']);

$_country = $countries[mt_rand(0, count($countries)-1)];
$imgs = get_images('country', $_country['id_country']);
if($imgs){
	$_header_img = $imgs[0]['big'];
}else{
	$_header_img = $_base_static."img/header_circuite.jpg";
}

$_item['days_desc'] = db_query('SELECT * FROM circuit_day_description WHERE id_circuit = ? AND '.db_is_active('', 'circuit_day_description').' ORDER BY day ASC', $_item['id_circuit']);

$cities_from = db_query('SELECT * FROM circuit_city_from WHERE id_circuit = ?', $_item['id_circuit']);
if($cities_from){
	foreach($cities_from as $city){
		$city = get_city_by_id($city['id_city']);
		$_item['city_from'][] = $city['title'];
	}
}

$_item['departures'] = db_query('SELECT * FROM circuit_date_price WHERE id_circuit = ? ORDER BY dep_date ASC', $_item['id_circuit']);

if($_search){
	foreach($_item['departures'] as $departure){
		if(date("d.m.Y", strtotime($departure['dep_date'])) == $_item['date']){
			$_selected_departure = $departure['id_circuit_date_price'];
			break;
		}
	}
}

$_section = "circuits";
$_active_tab = "circuits";


// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
