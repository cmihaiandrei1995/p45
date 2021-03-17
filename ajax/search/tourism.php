<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';


if($_GET['type'] == "destination"){

	$country = get_country_by_id($_GET['country']);

	list($cats, $count) = get_posts(array(
		'table' => 'category',
		'limit' => -1,
		'extra_where' => ' AND (
								id_category IN (
									SELECT id_category FROM category_to_city WHERE id_city IN (
											SELECT id_city FROM city WHERE home_tourism = 1 AND '.db_is_active('', 'city').' AND id_country = '.$country['id_country'].'
										)
										AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city)
										GROUP BY id_category
								)
								OR id_category IN (
									SELECT id_category FROM category_to_zone WHERE id_zone IN (
											SELECT id_zone FROM zone WHERE home_tourism = 1 AND '.db_is_active('', 'zone').' AND id_country = '.$country['id_country'].'
										)
										AND id_zone IN (
											SELECT id_zone FROM city WHERE id_city IN (
												SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
											)
										)
										GROUP BY id_category
								)
							)
						'
	));

	$_cats_used = array(0);
	foreach($cats as $cat){
		$_cities[] = array(
			'id' => generate_name($cat['title']),//route('tourism', $cat['title']),
			'title' => $cat['title']
		);

		$_cats_used[] = $cat['id_category'];
	}

	$_zones_used = array(0);
	list($zones, $count) = get_posts(array(
		'table' => 'zone',
		'limit' => -1,
		'home_tourism' => 1,
		'id_country' => $country['id_country'],
		'extra_where' => '
			'.(count($_cats_used) > 1 ? 'AND id_zone NOT IN (SELECT id_zone FROM category_to_zone WHERE id_category IN ('.implode(',', $_cats_used).') GROUP BY id_zone)' : '').'
			AND id_zone IN (
				SELECT id_zone FROM city WHERE id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
				)
			)
		'
	));

	foreach($zones as $zone){
		$_cities[] = array(
			'id' => generate_name($zone['title']),//route('tourism', $zone['title']),
			'title' => $zone['title']
		);

		$_zones_used[] = $zone['id_zone'];
	}

	list($cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'home_tourism' => 1,
		'id_country' => $country['id_country'],
		'extra_where' => ' '.(count($_cats_used) > 1 ? 'AND id_city NOT IN (SELECT id_city FROM category_to_city WHERE id_category IN ('.implode(',', $_cats_used).') GROUP BY id_city)' : '').'
						   '.(count($_zones_used) > 1 ? 'AND (id_zone NOT IN ('.implode(',', $_zones_used).') OR id_zone IS NULL)' : '').'
						   AND id_city IN (
								SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
							)
						 '
	));

	foreach($cities as $city){
		$_cities[] = array(
			'id' => generate_name($city['title']),//route('tourism', $city['title']),
			'title' => $city['title']
		);
	}

	usort($_cities, function ($a, $b) {
		return strcmp($a["title"], $b["title"]);
	});

	foreach($_cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}
}



if($_GET['type'] == "city"){

	$country = get_country_by_id($_GET['country']);

	$_category = get_category_by_slug($_GET['destination']);
	if(!$_category){
		$_zone = get_zone_by_slug($_GET['destination']);
		if(!$_zone){
			$_city = get_city_by_slug($_GET['destination']);
			if(!$_city) exit;
			$_is_city = true;
		}else{
			$_is_zone = true;
		}
	}else{
		$_is_category = true;
	}

	$_query = array(
		'table' => 'hotel',
		'limit' => -1,
	);

	if($_is_city){
		$_query['id_city'] = $_city['id_city'];
	}
	if($_is_zone){
		$_query['extra_where'] = 'AND id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].')';
	}
	if($_is_category){
		$_query['extra_where'] = 'AND (
										id_city IN (SELECT id_city FROM city WHERE '.db_is_active('', 'city').' AND id_city IN (SELECT id_city FROM category_to_city WHERE id_category = '.$_category['id_category'].'))
										OR
										id_city IN (SELECT id_city FROM city WHERE '.db_is_active('', 'city').' AND id_zone IN (SELECT id_zone FROM category_to_zone WHERE id_category = '.$_category['id_category'].'))
								)';
	}

	// get items
	list($_items, $_count_items) = get_posts($_query);

	foreach($_items as &$item){
		$item = hotel_prepare_info($item);
		if($item['price'] > 0){
			if(!in_array($item['id_city'], $_cities_hotels)){
				$_cities_hotels[] = $item['id_city'];
			}
		}
		unset($item);
	}


	foreach($_cities_hotels as $city){
		$city_info = get_city_by_id($city);
		$_cities[] = array(
			'id' => $city_info['id_city'],
			'title' => $city_info['title']
		);
	}

	usort($_cities, function ($a, $b) {
		return strcmp($a["title"], $b["title"]);
	});

	foreach($_cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}
}



if($_GET['type'] == "link"){

	$result['link'] = route('tourism', $_GET['destination']);

	if($_GET['city'] != "" && is_numeric($_GET['city'])){
		$result['link'] .= "?ct=".intval($_GET['city']);
	}

}


echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
