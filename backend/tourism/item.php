<?

$_item = get_hotel_by_id($_params['id']);
if(!$_item) go_away(route('tourism-home'));

$_item['images'] = get_images('hotel', $_item['id_hotel']);

if(isset($_GET['s']) && $_GET['s'] != ""){

	$_search = db_row('SELECT * FROM hotel_search WHERE id_hotel_search = ?', intval($_GET['s']));
	if($_search){
		$id_search = $_search['id_hotel_search'];

		$results = cache_get('hotel_search_'.$id_search);
		if(!$results){
			$_item = hotel_prepare_info($_item);
		}else{
			$search_items = array();
			if($results['Hotel'][0]){
				$search_items = $results['Hotel'];
			}else{
				$search_items[0] = $results['Hotel'];
			}
		}

		$_item = hotel_prepare_info_from_search($_item, $_search, $search_items);

		$_date_from = date('d.m.Y', strtotime($_search['date_from']));
		$_date_to = date('d.m.Y', strtotime($_search['date_to']));

		$_search['room_info'] = json_decode($_search['room_data'], true);
	}else{
		$_item = hotel_prepare_info($_item);
	}

    if(!$_item['price']){
        go_away($_SERVER['SCRIPT_URI'], '301');
    }

}else{
	$_item = hotel_prepare_info($_item);
}

$currency = "EUR";
if($_item['id_country'] == 126){
	$currency = "RON";
}
$currency_symbol = $_currency_symbol[$currency];

if(isset($_GET['d']) && $_GET['d'] != "" && isset($_GET['t']) && $_GET['t'] != ""){
	$dates_from = $dates_to = array();
	foreach($_item['periods'] as $period){
		$dates_from[] = $period['date_from'];
		$dates_to[$period['date_from']][] = $period['date_to'];
	}
	if(in_array(date('Y-m-d', strtotime($_GET['d'])), $dates_from) && in_array(date('Y-m-d', strtotime($_GET['t'])), $dates_to[date('Y-m-d', strtotime($_GET['d']))])){
		$_item = hotel_get_price($_item, $_GET['d'], $_GET['t']);
	}
	$_date_from = date('d.m.Y', strtotime($_GET['d']));
	$_date_to = date('d.m.Y', strtotime($_GET['t']));
}

$_country = get_country_by_id($_item['id_country']);
$_city = get_city_by_id($_item['id_city']);

$imgs = get_images('country', $_country['id_country']);
if($imgs){
	$_header_img = $imgs[0]['big'];
}else{
	$_header_img = $_base_static."img/header_turism-individual.jpg";
}

$_item['periods'] = db_query('SELECT * FROM hotel_serie WHERE id_hotel = ? ORDER BY date_from ASC', $_item['id_hotel']);

// $_item['available_periods'] = db_query('SELECT * FROM hotel_grila WHERE id_hotel = ? AND date_offer_from <= NOW() AND date_offer_to >= NOW() GROUP BY date_offer_from, date_offer_to ORDER BY date_offer_from ASC', $_item['id_hotel']);
$_item['available_periods'] = db_query('SELECT * FROM hotel_grila WHERE id_hotel = ? ORDER BY date_offer_from ASC', $_item['id_hotel']);

$_item['available_dates'] = db_query('SELECT * FROM hotel_minprice WHERE id_hotel = ? ORDER BY date_from ASC', $_item['id_hotel']);

$_item['special_cats'] = db_query('SELECT * FROM hotel_grila WHERE id_hotel = ? AND date_tab_from <= NOW() AND date_tab_to >= NOW() AND description != ""', $_item['id_hotel']);
foreach($_item['special_cats'] as &$item){
	if(strtotime($item['date_expire_eb']) >= time()){
		$item['description'] = $item['description_eb'].$item['description'];
		if($item['value_eb'] != ""){
			$item['title'] .= " -".$item['value_eb']."%";
		}
	}
	unset($item);
}

if(!$_item['price']){
	list($_related_hotels, $related_nr) = get_posts(array(
		'table' => 'hotel',
		'id_city' => $_city['id_city'],
		'query' => array(
			//'relation' => 'AND',
			//array(
				'key' => 'id_hotel',
				'compare' => '!=',
				'value' => $_item['id_hotel']
			//),
		),
		'extra_where' => 'AND id_hotel IN (SELECT id_hotel FROM hotel_minprice)',
		'limit' => 2,
		'images' => true,
		'order' => 'rand()'
	));

	foreach($_related_hotels as &$item){
		$item = hotel_prepare_info($item);
		unset($item);
	}
}


// calculate days of departure
foreach($_item['periods'] as $period){
	$dayofweek = date('N', strtotime($period['date_from']));
	if($period['nights'] == 5 || $period['nights'] == 7){
		if(!in_array($dayofweek, $_days_found)){
			$_days_found[] = $dayofweek;
		}
	}
}
sort($_days_found);


if($_country['id_country'] == 126){
	$_section = "tourism-ro";
	$_active_tab = "tourism-ro";
}else{
	$_section = "tourism";
	$_active_tab = "tourism";
}


// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : trim($_item['title']).", ".$_city['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
