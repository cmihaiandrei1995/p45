<?

if($_params['city_from']){
	$_city_from = get_city_by_slug($_params['city_from']);
	if(!$_city_from) go_away(route('charters-home'));
}

$_zone = get_zone_by_slug($_params['city_to']);
if(!$_zone){
	$_city = get_city_by_slug($_params['city_to']);
	if(!$_city) go_away(route('charters-home'));
	$_is_city = true;
}else{
	$_is_zone = true;
}

if($_is_zone){
	if($_page == "charters-item" && $_zone['charter_type'] == "sejur"){
		$redirect_to = str_replace('/charter-', '/sejur-', $_current_url);
		go_away($redirect_to, '301');
	}elseif($_page == "charters-item2" && $_zone['charter_type'] == "charter"){
		$redirect_to = str_replace('/sejur-', '/charter-', $_current_url);
		go_away($redirect_to, '301');
	}
}else{
	if($_page == "charters-item" && $_city['charter_type'] == "sejur"){
		$redirect_to = str_replace('/charter-', '/sejur-', $_current_url);
		go_away($redirect_to, '301');
	}elseif($_page == "charters-item2" && $_city['charter_type'] == "charter"){
		$redirect_to = str_replace('/sejur-', '/charter-', $_current_url);
		go_away($redirect_to, '301');
	}
}

if($_is_city){
	$_title = $_city['title'];
	$_title_destination = $_city['title'];

	$imgs = get_images('city', $_city['id_city']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_chartere.jpg";
	}
}

if($_is_zone){
	$_title = $_zone['title'];
	$_title_destination = $_zone['title'];

	$imgs = get_images('zone', $_zone['id_zone']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_chartere.jpg";
	}
}

$_item = get_hotel_by_id($_params['id']);
if(!$_item) go_away(route('charters-home'));

if($_is_zone){
	$_parent_url = get_charter_link($_zone, $_zone['title'], $_city_from['title']);
}else{
	$_parent_url = get_charter_link($_city, $_city['title'], $_city_from['title']);
}

$_item['images'] = get_images('hotel', $_item['id_hotel']);

if(isset($_GET['s']) && $_GET['s'] != ""){

	$_search = db_row('SELECT * FROM charter_search WHERE id_charter_search = ?', intval($_GET['s']));
	if($_search){
		$id_search = $_search['id_charter_search'];

		$results = cache_get('charter_search_'.$id_search);
		if(!$results){
			$_item = hotel_prepare_charter_info($_item, ($_is_zone ? $_zone : $_city), $_city_from);
		}else{
			$search_items = array();
			if($results['Hotel'][0]){
				$search_items = $results['Hotel'];
			}else{
				$search_items[0] = $results['Hotel'];
			}
		}

		$_item = hotel_prepare_charter_info_from_search($_item, ($_is_zone ? $_zone : $_city), $_city_from, $_search, $search_items);

		$_date_from = date('d.m.Y', strtotime($_search['date_from']));
		$_date_to = date('d.m.Y', strtotime($_search['date_to']));

		$_search['room_info'] = json_decode($_search['room_data'], true);
	}else{
		$_item = hotel_prepare_charter_info($_item, ($_is_zone ? $_zone : $_city), $_city_from);
	}

    if(!$_item['price']){
        go_away($_SERVER['SCRIPT_URI'], '301');
    }

}else{
	$_item = hotel_prepare_charter_info($_item, ($_is_zone ? $_zone : $_city), $_city_from);
}

if(isset($_GET['d']) && $_GET['d'] != "" && isset($_GET['t']) && $_GET['t'] != ""){
	$dates_from = $dates_to = array();
	foreach($_item['periods'] as $period){
		if(!in_array($period['date_from'], $dates_from)){
			$dates_from[] = $period['date_from'];
		}
		if(!in_array($period['date_to'], $dates_to[$period['date_from']])){
			$dates_to[$period['date_from']][] = $period['date_to'];
		}
	}
	if(in_array(date('Y-m-d', strtotime($_GET['d'])), $dates_from) && in_array(date('Y-m-d', strtotime($_GET['t'])), $dates_to[date('Y-m-d', strtotime($_GET['d']))])){
		$_item = charter_get_price($_item, ($_is_zone ? $_zone : $_city), $_city_from, date('Y-m-d', strtotime($_GET['d'])), date('Y-m-d', strtotime($_GET['t'])));
	}
	$_date_from = date('d.m.Y', strtotime($_GET['d']));
	$_date_to = date('d.m.Y', strtotime($_GET['t']));

	if($_is_zone){
		$category = get_post(array(
			'table' => 'charter_category',
			'id_city_from' => $_city_from['id_city'],
			'extra_where' => '
				AND id_charter_category IN (SELECT id_charter_category FROM charter_category_to_city WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].'))
				AND id_charter_category IN (SELECT id_charter_category FROM charter_category_date WHERE dates = "'.date('Y-m-d', strtotime($_GET['d'])).'")
			'
		));

		if($category){
			$_is_category = true;

			$dates = db_query('SELECT * FROM charter_category_date WHERE id_charter_category = ?', $category['id_charter_category']);

			if($dates){
				$charter_dates = array();
				foreach($dates as $date){
					$charter_dates[] = $date['dates'];
				}

				foreach($_item['periods'] as $kp => $period){
					if(!in_array($period['date_from'], $charter_dates)){
						unset($_item['periods'][$kp]);
					}
				}
				$_item['periods'] = array_values($_item['periods']);
			}
		}
	}
}


$_country = get_country_by_id($_item['id_country']);
$_city = get_city_by_id($_item['id_city']);

if($_city['id_zone'] > 0 && !$_zone){
	$_zone = get_zone_by_id($_city['id_zone']);
}

if($_zone){
	$_zone_text = db_row('SELECT * FROM zone_text WHERE id_zone = ? AND id_city_from = ? AND senior = ?', $_zone['id_zone'], $_city_from['id_city'], $_item['senior']);
}

list($categories, $cnt_cat) = get_posts(array(
	'table' => 'charter_category',
	'id_city_from' => $_city_from['id_city'],
	'extra_where' => ' AND id_charter_category IN (SELECT id_charter_category FROM charter_category_to_city WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].'))'
));

if(!$_is_category){
	$dates_excluded = array();
	if($categories){
		foreach($categories as $cat){
			$dates = db_query('SELECT * FROM charter_category_date WHERE id_charter_category = ?', $cat['id_charter_category']);
			foreach($dates as $date){
				if(!in_array($date['dates'], $dates_excluded)){
					$dates_excluded[] = $date['dates'];
				}
			}
		}
	}

	if($dates_excluded){
		foreach($_item['periods'] as $kp => $period){
			if(in_array($period['date_from'], $dates_excluded)){
				unset($_item['periods'][$kp]);
			}
		}
		$_item['periods'] = array_values($_item['periods']);
	}
}


if(!$_header_img){
	$imgs = get_images('country', $_country['id_country']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_chartere.jpg";
	}
}

if($_params['city_from']){
	$_city_from = get_city_by_slug($_params['city_from']);
	if(!$_city_from) go_away(route('charters-home'));

	$_city_from_sql = "WHERE id_city_from = ".$_city_from['id_city'];
}

if($_city_from){
	$from_id = $_city_from['id_city'];

	$flights_departure = db_query('
		SELECT *, DATE_FORMAT(departure_time, "%w") AS departure_day, MIN(departure_time) AS min_departure, MAX(departure_time) AS max_departure FROM (
		    SELECT * FROM charter_flights
			WHERE flight_type = 1 AND departure_time > NOW() AND id_city_from = '.$from_id.' AND id_city = '.$_city['id_city'].' '
			.($dates_excluded ? ' AND DATE_FORMAT(departure_time, "%Y-%m-%d") NOT IN ("'.implode('","', $dates_excluded).'")' : '').' '
			.($_is_category ? ' AND DATE_FORMAT(departure_time, "%Y-%m-%d") IN ("'.implode('","', $charter_dates).'")' : '').
			'ORDER BY departure_time ASC
		) AS tmp_table GROUP BY id_city_from, departure_airport_code, arrival_airport_code, DATE_FORMAT(departure_time, "%w"), DATE_FORMAT(arrival_time, "%w"), flight_company
		-- , DATE_FORMAT(other_flight_time, "%w")
		-- LIMIT 2
	');

	$flights_return = db_query('
		SELECT *, DATE_FORMAT(departure_time, "%w") AS departure_day, MIN(departure_time) AS min_departure, MAX(departure_time) AS max_departure FROM (
		    SELECT * FROM charter_flights
			WHERE flight_type = 3 AND departure_time > NOW() AND id_city_from = '.$from_id.' AND id_city = '.$_city['id_city'].' '
			.($dates_excluded ? ' AND DATE_FORMAT(other_flight_time, "%Y-%m-%d") NOT IN ("'.implode('","', $dates_excluded).'")' : '').' '
			.($_is_category ? ' AND DATE_FORMAT(other_flight_time, "%Y-%m-%d") IN ("'.implode('","', $charter_dates).'")' : '').
			'ORDER BY departure_time ASC
		) AS tmp_table GROUP BY id_city_from, departure_airport_code, arrival_airport_code, DATE_FORMAT(departure_time, "%w"), DATE_FORMAT(arrival_time, "%w"), flight_company
		-- , DATE_FORMAT(other_flight_time, "%w")
		-- LIMIT 2
	');

	foreach($flights_departure as $k => $item){
		//if(!$flights_return[$k]) unset($flights_departure[$k]);
		if(!$flights_return[$k]){
			$flights_return[$k] = $flights_return[$k-1];
		}
		$flights_departure[$k]['key'] = $k;
	}

	// sort by day
	usort($flights_departure, function($a, $b){
		return strtotime($a['min_departure']) >= strtotime($b['min_departure']) ? 1 : -1;
	});
	foreach($flights_departure as $k => $item){
		$flights_return_new[$k] = $flights_return[$item['key']];
	}
	$flights_return = $flights_return_new;

	/*
	usort($flights_return, function($a, $b){
		//return strtotime($a['min_departure']) >= strtotime($b['min_departure']) ? 1 : -1;
	});
	*/

	// small fix in case some info in the return flight are missing
	foreach($flights_return as $k => $item){
		if(!$flights_return[$k]['flight_company']){
			$flights_return[$k]['flight_company'] = $flights_departure[$k]['flight_company'];
		}
		if(!$flights_return[$k]['departure_city']){
			$flights_return[$k]['departure_city'] = $flights_departure[$k]['arrival_city'];
		}
	}

	//$flights_departure = array_slice($flights_departure, 0, 6);
	//$flights_return = array_slice($flights_return, 0, 6);
}

$_offer_type = ucfirst($_item['charter_type']);
if($_offer_type == ""){
	$_offer_type = "Charter";
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
		'extra_where' => 'AND id_hotel IN (SELECT id_hotel FROM charter_minprice)',
		'limit' => 2,
		'images' => true,
		'order' => 'rand()'
	));

	foreach($_related_hotels as &$item){
		$item = hotel_prepare_charter_info($item, ($_is_zone ? $_zone : $_city), $_city_from);
		unset($item);
	}
}


// calculate days of departure
foreach($_item['periods'] as $period){
	$dayofweek = date('N', strtotime($period['date_from']));
	if($period['nr_nights'] == 7 || $period['nr_nights'] == 9 || $period['nr_nights'] == 14){
		$_periods_found++;
		if(!in_array($dayofweek, $_days_found)){
			$_days_found[] = $dayofweek;
		}
	}
}
sort($_days_found);



$_show_storno_insurance = false;
// if($_country['id_country'] == 53 || $_country['id_country'] == 40 || $_country['id_country'] == 152 || $_country['id_country'] == 158 || $_country['id_country'] == 141 || $_country['id_country'] == 35){
// 	$_show_storno_insurance = true;
// }


$_section = "charters";
$_active_tab = "charters";


// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : trim($_item['title']).", ".$_city['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
