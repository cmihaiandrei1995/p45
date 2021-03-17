<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../config.php';

$_search = generate_name(sanitize($_GET['term']));
$_search = str_replace(array("quot-","amp-","ndash-", "-quot","-amp","-ndash", "-quot-","-amp-","-ndash-"), "-", $_search);
$_search = str_replace("-", " ", $_search);
$_search = trim($_search);

$response = array();
$response['results'] = array();

if(isset($_GET['term']) && $_GET['term'] != ''){

	$tmp_search = explode(" ", $_search);
	if(count($tmp_search) > 1){
		$extra_where = "";
		foreach($tmp_search as $tmp){
			if(strlen($tmp) > 2){
				$extra_where .= " OR title LIKE '%".$tmp."%'";
			}
		}
	}






	// cruises
	$options_cruises = array(
		'table' => 'cruise',
		'groupby' => 'cruise.id_cruise',
		'order' =>  'price ASC',
		'limit' => 4,
		'extra_where' => ' AND (0 OR title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.')',
	);
	list($_cruises, $count_cruises) = get_posts($options_cruises);

	foreach($_cruises as &$item){
		$item = get_cruise_basic_info($item);
		unset($item);
	}

	foreach($_cruises as $item){

		$response['results'][] = array(
			'type' => 'cruise',
	        'label' => $item['title'],
	        'value' => $item['title'],
	        'url' => $item['url'],
	        'img' => $item['images'][0]['medium']
	    );

	}

	$response['results'][] = array(
		'type' => 'link',
		'for' => 'cruise',
		'link' => route('search-tab', 'croaziere').'?q='.$_search,
	);





	// zones, cities circuits
	$options_country = array(
		'table' => 'country',
		'limit' => -1,
		'extra_where' => ' AND title LIKE "%'.$_search.'%" '.$extra_where,
		'order' => 'title ASC'
	);
	list($_countries, $count_zone) = get_posts($options_country);

	$_countries_used = array();
	foreach($_countries as $item){
		$_countries_used[] = $item['id_country'];
	}

	$options_city = array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => '
			AND (
				'.($_countries_used ? 'id_country IN ('.implode(',', $_countries_used).') OR' : '').'
				0 OR (title LIKE "%'.$_search.'%" '.$extra_where.')
			) ',
		'order' => 'title ASC',
	);
	list($_city, $count_city) = get_posts($options_city);

	$_cities_used = array(0);
	foreach($_city as $item){
		$_cities_used[] = $item['id_city'];
	}

	if($_cities_used || $_countries_used){

		// circuits
		$options_circuits = array(
			'table' => 'circuit',
			'limit' => 4,
			'groupby' => 'circuit.id_circuit',
			'extra_where' => '
				AND (
					id_circuit IN (SELECT id_circuit FROM circuit_to_city WHERE id_city IN ('.implode(",", $_cities_used).') )
						OR
					(title LIKE "%'.$_search.'%" '.$extra_where.' )
				)',
		);
		list($_circuits, $count_circuits) = get_posts($options_circuits);

		$_new_count_items = count($_circuits);

		foreach($_circuits as &$item){
			$item['images'] = get_images('circuit', $item['id_circuit']);
			$item = circuit_prepare_info($item);

			unset($item);
		}

		foreach($_circuits as $k => $item){
			if(!($item['price'] > 0)){
				unset($_circuits[$k]);
			}
		}

		usort($_circuits, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});

		foreach($_circuits as $item){
			if($k < 4){
				$response['results'][] = array(
					'type' => 'circuit',
			        'label' => $item['title'],
			        'value' => $item['title'],
			        'url' => $item['url'],
			        'img' => $item['images'][0]['thumb']
			    );
			}
		}

		$response['results'][] = array(
			'type' => 'link',
			'for' => 'circuit',
			'link' => route('search-tab', 'circuite').'?q='.$_search,
		);
	}








	//chartere

	// zones, cities
	$options_country = array(
		'table' => 'country',
		'limit' => -1,
		'extra_where' => ' AND title LIKE "%'.$_search.'%" '.$extra_where.' AND home_charter = 1',
		'order' => 'title ASC'
	);
	list($_countries, $count_zone) = get_posts($options_country);

	$_countries_used = array();
	foreach($_countries as $item){
		$_countries_used[] = $item['id_country'];
	}

	$options_zone = array(
		'table' => 'zone',
		'limit' => -1,
		'extra_where' => '
			'.($_countries_used ? 'AND id_country IN ('.implode(',', $_countries_used).')' : '').'
			AND title LIKE "%'.$_search.'%" '.$extra_where.' AND home_charter = 1
		',
		'order' => 'title ASC'
	);
	list($_zone, $count_zone) = get_posts($options_zone);

	$_zones_used = array();
	foreach($_zone as $item){
		$_zones_used[] = $item['id_zone'];
	}

	$options_city = array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => '
			AND (
				'.($_zones_used ? 'id_zone IN ('.implode(',', $_zones_used).') OR ' : '').'
				'.($_countries_used ? 'id_country IN ('.implode(',', $_countries_used).') OR' : '').'
				0 OR (title LIKE "%'.$_search.'%" '.$extra_where.')
			)
			AND home_charter = 1',
		'order' => 'title ASC',
	);
	list($_city, $count_city) = get_posts($options_city);

	$_cities_used = array(0);
	foreach($_city as $item){
		$_cities_used[] = $item['id_city'];
	}

	if($_cities_used || $_zones_used || $_countries_used){

		$options_hotel_charter = array(
			'table' => 'hotel',
			'limit' => -1,
			'images' => true,
			'extra_where' => '
				AND price_charter_from > 0
				AND (
					id_city IN (SELECT id_city FROM city WHERE id_city IN ('.implode(",", $_cities_used).') )
						OR
					-- (title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.' )
					(title LIKE "%'.$_search.'%" '.$extra_where.' )
				)',
			'order' => 'title ASC',
		);
		list($_hotel_charter, $count_hotel_charter) = get_posts($options_hotel_charter);

		$_city_from = get_city_by_id(14997);

		foreach($_hotel_charter as &$item){
			$_city = get_city_by_id($item['id_city']);
			if($_city['id_zone']){
				$_zone = get_zone_by_id($_city['id_zone']);
			}else{
				$_zone = array();
			}

			$item = hotel_prepare_charter_basic_info($item, ($_zone ? $_zone : $_city), $_city_from);
			unset($item);
		}

	}

	/*
	foreach($_hotel_charter as $k => $item){
		if(!($item['price'] > 0)){
			unset($_hotel_charter[$k]);
		}
	}
	usort($_hotel_charter, function($a, $b){
		if($a['price'] == $b['price']){
	        return 0;
	    }
	    return ($a['price'] < $b['price']) ? -1 : 1;
	});
	*/

	foreach($_hotel_charter as $k => $item){
		if($k < 4){
			$response['results'][] = array(
				'type' => 'charter',
		        'label' => $item['title'],
		        'value' => $item['title'],
		        'url' => $item['url'],
		        'img' => $item['images'][0]['thumb']
		    );
		}
	}

	$response['results'][] = array(
		'type' => 'link',
		'for' => 'charter',
		'link' => route('search-tab', 'chartere').'?q='.$_search,
	);








	// hoteluri

	// zones, cities
	$options_country = array(
		'table' => 'country',
		'limit' => -1,
		'extra_where' => ' AND title LIKE "%'.$_search.'%" '.$extra_where.' AND home_tourism = 1',
		'order' => 'title ASC'
	);
	list($_countries, $count_zone) = get_posts($options_country);

	$_countries_used = array();
	foreach($_countries as $item){
		$_countries_used[] = $item['id_country'];
	}

	$options_zone = array(
		'table' => 'zone',
		'limit' => -1,
		'extra_where' => '
			'.($_countries_used ? 'AND id_country IN ('.implode(',', $_countries_used).')' : '').'
			AND title LIKE "%'.$_search.'%" '.$extra_where.' AND home_tourism = 1
		',
		'order' => 'title ASC'
	);
	list($_zone, $count_zone) = get_posts($options_zone);

	$_zones_used = array();
	foreach($_zone as $item){
		$_zones_used[] = $item['id_zone'];
	}

	$options_city = array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => '
			AND (
				'.($_zones_used ? 'id_zone IN ('.implode(',', $_zones_used).') OR ' : '').'
				'.($_countries_used ? 'id_country IN ('.implode(',', $_countries_used).') OR' : '').'
				0 OR (title LIKE "%'.$_search.'%" '.$extra_where.')
			)
			AND home_tourism = 1',
		'order' => 'title ASC',
	);
	list($_city, $count_city) = get_posts($options_city);

	$_cities_used = array(0);
	foreach($_city as $item){
		$_cities_used[] = $item['id_city'];
	}

	if($_cities_used || $_zones_used || $_countries_used){

		// hotels
		$options_hotel = array(
			'table' => 'hotel',
			'limit' => -1,
			'images' => true,
			'extra_where' => '
				AND price_hotel_from > 0
				AND (
					id_city IN (SELECT id_city FROM city WHERE id_city IN ('.implode(",", $_cities_used).') )
						OR
					-- (title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.' )
					(title LIKE "%'.$_search.'%" '.$extra_where.' )
				)',
			'order' => 'title ASC',
		);
		list($_hotel, $count_hotel) = get_posts($options_hotel);

		foreach($_hotel as &$item){
			$item = hotel_prepare_basic_info($item);
			unset($item);
		}

	}

	/*
	foreach($_hotel as $k => $item){
		if(!($item['price'] > 0)){
			unset($_hotel[$k]);
		}
	}
	usort($_hotel, function($a, $b){
		if($a['price'] == $b['price']){
	        return 0;
	    }
	    return ($a['price'] < $b['price']) ? -1 : 1;
	});
	*/

	foreach($_hotel as $k => $item){
		if($k < 4){
			$response['results'][] = array(
		        'type' => 'hotel',
		        'label' => $item['title'],
		        'value' => $item['title'],
		        'url' => $item['url'],
		        'img' => $item['images'][0]['thumb']
		    );
		}
	}

	$response['results'][] = array(
		'type' => 'link',
		'for' => 'hotel',
		'link' => route('search-tab', 'hotel').'?q='.$_search,
	);






	echo json_encode($response);

}
