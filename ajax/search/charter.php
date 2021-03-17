<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';


if($_GET['type'] == "city_to"){

	$country = get_country_by_id($_GET['country']);

	list($_zones, $count) = get_posts(array(
		'table' => 'zone',
		'limit' => -1,
		'home_charter' => 1,
		'id_country' => $country['id_country'],
		'extra_where' => ' AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city) GROUP BY id_zone)',
		/*
		'extra_where' => '
			AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city) GROUP BY id_zone)
			AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM charter_minprice)))
		',
		 */
		'order' => 'title ASC'
	));

	$_zones_used = array(0);
	foreach($_zones as $zone){
		$count = db_row('
			SELECT COUNT(DISTINCT id_hotel) AS nr
			FROM charter_minprice
			WHERE
				date_from > "'.date('Y-m-d').'"
				AND id_hotel IN (
					SELECT id_hotel FROM hotel WHERE id_city IN ( SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].') AND '.db_is_active('', 'hotel').'
				)
		');

		if($count['nr'] > 0){
			$_zones_used[] = $zone['id_zone'];
			$cities[] = array(
				'id' => $zone['id_zone'],
				'type' => 'zone',
				'title' => $zone['title']
			);
		}
	}

	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'home_charter' => 1,
		'id_country' => $country['id_country'],
		'extra_where' => ' AND id_zone NOT IN ('.implode(',', $_zones_used).') AND id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city)',
		/*
		'extra_where' => '
			AND id_zone NOT IN ('.implode(',', $_zones_used).')
			AND id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city)
			AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM charter_minprice))
		',
		 */
		'order' => 'title ASC'
	));

	foreach($_cities as $city){
		$count = db_row('
			SELECT COUNT(DISTINCT id_hotel) AS nr
			FROM charter_minprice
			WHERE
				date_from > "'.date('Y-m-d').'"
				AND id_hotel IN (
					SELECT id_hotel FROM hotel WHERE id_city = '.$city['id_city'].' AND '.db_is_active('', 'hotel').'
				)
		');

		if($count['nr'] > 0){
			$cities[] = array(
				'id' => $city['id_city'],
				'type' => 'city',
				'title' => $city['title']
			);
		}
	}

	usort($cities, function ($a, $b) {
		return strcmp($a["title"], $b["title"]);
	});

	foreach($cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}
}


if($_GET['type'] == "city_from"){

	$country = get_country_by_id($_GET['country']);
	if($_GET['city_to'] < 100){
		$zone_to = get_zone_by_id($_GET['city_to']);
		$sql = ' id_city IN (SELECT id_city FROM city WHERE id_zone = '.$zone_to['id_zone'].') ';
		$item = $zone_to;
	}else{
		$city_to = get_city_by_id($_GET['city_to']);
		$sql = ' id_city = '.$city_to['id_city'].' ';
		$item = $city_to;
	}

	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => '
			AND id_city IN (SELECT id_city_from FROM charter_destination WHERE '.$sql.' GROUP BY id_city_from)
		',
		'order' => 'title ASC'
	));

	foreach($_cities as $city){
		$cities[] = array(
			'id' => $city['id_city'], //get_charter_link($item, $item['title'], $city['title']),
			'title' => $city['title']
		);
	}

	foreach($cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}

}

if($_GET['type'] == "link"){
	$country = get_country_by_id($_GET['country']);

	if($_GET['city_to'] < 100){
		$zone_to = get_zone_by_id($_GET['city_to']);
		$item = $zone_to;
	}else{
		$city_to = get_city_by_id($_GET['city_to']);
		$item = $city_to;
	}

	$city_from = get_city_by_id($_GET['city_from']);

	$result['link'] = get_charter_link($item, $item['title'], $city_from['title']);
}


if($_GET['type'] == "dates"){

	$country = get_country_by_id($_GET['country']);

	if($_GET['city_to'] < 100){
		$zone_to = get_zone_by_id($_GET['city_to']);
		$item = $zone_to;
		$type = "zone";
	}else{
		$city_to = get_city_by_id($_GET['city_to']);
		$item = $city_to;
		$type = "city";
	}

	$city_from = get_city_by_id($_GET['city_from']);

	$periods = charter_get_available_dates($item, $type, $city_from);

	foreach($periods as $period){
		$dates_from[] = $period['date_from'];
		$dates_to[$period['date_from']][] = $period['date_to'];
	}

	$result['dates_from'] = $dates_from;
	$result['dates_to'] = $dates_to;
}




echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
