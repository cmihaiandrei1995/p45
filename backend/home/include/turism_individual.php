<?
// text turism individual
$_text_turism_individual = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 4,
));

list($_box_tourism_individual, $count) = get_posts(array(
	'table' => 'home_tourism',
	'limit' => -1,
	'images' => true,
));
foreach($_box_tourism_individual as &$box){
	if($box['id_zone'] > 0){
		$zone = get_zone_by_id($box['id_zone']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 6,
			'id_zone' => $box['id_zone'],
			'extra_where' => '
				AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
			',
			'order' => 'title ASC'
		));
		foreach($box['cities'] as &$city){
			$city['url'] = route('tourism', $country['title'])."?&ct=".$city['id_city'];
			unset($city);
		}

		$box['url'] = route('tourism', $zone['title']);
	}else{
		$country = get_country_by_id($box['id_country']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'zone',
			'limit' => 6,
			'id_country' => $country['id_country'],
			'extra_where' => '
				AND id_zone IN (
					SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				)
			',
			'order' => 'title ASC'
		));
		if($box['cities']){
			foreach($box['cities'] as &$city){
				$city['url'] = route('tourism', $city['title']);
				unset($city);
			}
		// }else{
		// 	list($box['cities'], $count) = get_posts(array(
		// 		'table' => 'city',
		// 		'limit' => 6,
		// 		'id_country' => $country['id_country'],
		// 		'extra_where' => '
		// 			AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
		// 		',
		// 		'order' => 'title ASC'
		// 	));
		// 	foreach($box['cities'] as &$city){
		// 		$city['url'] = route('tourism', $country['title'])."?&ct=".$city['id_city'];
		// 		unset($city);
		// 	}
		}

		if(count($box['cities']) < 6){
			list($items_cities, $count) = get_posts(array(
				'table' => 'city',
				'limit' => 6-count($box['cities']),
				'id_country' => $country['id_country'],
				'home_tourism' => 1,
				'extra_where' => '
					AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				',
				'order' => 'rand()'
			));
			foreach($items_cities as &$city){
				$city['url'] = route('tourism', $country['title'])."?&ct=".$city['id_city'];
				unset($city);
			}
			$box['cities'] = array_merge($box['cities'], $items_cities);
		}

		$box['url'] = route('tourism', $country['title']);
	}


	unset($box);
}

// slider turism
list($_slider_tourism_individual, $tourism_individual_count) = get_posts(array(
	'table' => 'home_tourism_slider',
	'limit' => -1,
	'images' => true
));
