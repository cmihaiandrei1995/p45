<?
$_ipp = 12;

$_search = generate_name(sanitize($_GET['q']));
$_search = str_replace(array("quot-","amp-","ndash-", "-quot","-amp","-ndash", "-quot-","-amp-","-ndash-"), "-", $_search);
$_search = str_replace("-", " ", $_search);
$_search = trim($_search);

if(isset($_GET['q']) && $_GET['q'] != ''){


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
		'extra_where' => ' AND (0 OR title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.')',
	);
	list($_cruises, $count_cruises) = get_posts($options_cruises);







	// zones, cities
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
			'limit' => -1,
			'groupby' => 'circuit.id_circuit',
			'extra_where' => '
				AND (
					id_circuit IN (SELECT id_circuit FROM circuit_to_city WHERE id_city IN ('.implode(",", $_cities_used).') )
						OR
					(title LIKE "%'.$_search.'%" '.$extra_where.' )
				)',
		);
		list($_circuits, $count_circuits) = get_posts($options_circuits);

	}



	// tickets
	$options_tickets = array(
	    'table' => 'ticket',
	    'limit' => -1,
		'order' => 'price ASC',
		'images' => true,
		'extra_where' => ' AND id_city_to IN ( SELECT id_city from city WHERE title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.')'
	);
	list($_tickets, $count_tickets) = get_posts($options_tickets);




	// chartere zones, cities
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

		if($_params['city_from']){
			$_city_from = get_city_by_slug($_params['city_from']);
			if(!$_city_from) go_away(route('charters-home'));
		}

		$options_hotel_charter = array(
			'table' => 'hotel',
			'limit' => -1,
			'images' => true,
			'extra_where' => '
				AND (
					id_city IN (SELECT id_city FROM city WHERE id_city IN ('.implode(",", $_cities_used).') )
						OR
					-- (title LIKE "%'.$_search.'%" OR description LIKE "%'.$_search.'%" '.$extra_where.' )
					(title LIKE "%'.$_search.'%" '.$extra_where.' )
				)',
			'order' => 'title ASC',
		);
		list($_hotel_charter, $count_hotel_charter) = get_posts($options_hotel_charter);

		foreach($_hotel_charter as &$item){
			$_city = get_city_by_id($item['id_city']);
			if($_city['id_zone']){
				$_zone = get_zone_by_id($_city['id_zone']);
			}else{
				$_zone = array();
			}

			$item = hotel_prepare_charter_info($item, ($_zone ? $_zone : $_city), $_city_from);
			unset($item);
		}

		foreach($_hotel_charter as $k => $item){
			if(!($item['price'] > 0)){
				unset($_hotel_charter[$k]);
			}
		}

		foreach($_hotel_charter as $item){
			$cities = charter_get_cities_from($item);
			foreach($cities as $city){
				if(!in_array($city, $_cities_from_ids)){
					$_cities_from_ids[] = $city;
				}
			}
		}

		if($_cities_from_ids){
			foreach($_cities_from_ids as $city){
				$_other_cities_from[] = get_city_by_id($city);
			}
		}

		usort($_other_cities_from, function($a, $b){
			if($a['order'] == $b['order']) return 0;
		    return ($a['order'] < $b['order']) ? -1 : 1;
		});

		if(!$_city_from){
			$_city_from = $_other_cities_from[0];
		}
		foreach($_other_cities_from as &$city){
			$city['url'] = route('search-tab-from', 'chartere', $city['title']).'?q='.$_search;
			unset($city);
		}



	}





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
			$item = hotel_prepare_info($item);
			unset($item);
		}

		foreach($_hotel as $k => $item){
			if(!($item['price'] > 0)){
				unset($_hotel[$k]);
			}
		}

	}









	if(!isset($_params['slug']) || $_params['slug'] == 'chartere'){

		list($_hotel_charter, $count_hotel_charter) = get_posts($options_hotel_charter);

		foreach($_hotel_charter as &$item){
			$_city = get_city_by_id($item['id_city']);
			if($_city['id_zone']){
				$_zone = get_zone_by_id($_city['id_zone']);
			}else{
				$_zone = array();
			}

			$item = hotel_prepare_charter_info($item, ($_zone ? $_zone : $_city), $_city_from);
			unset($item);
		}

		foreach($_hotel_charter as $k => $item){
			if(!($item['price'] > 0)){
				unset($_hotel_charter[$k]);
			}
		}
		$new_count_hotel_charter = count($_hotel_charter);

		usort($_hotel_charter, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});

		$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
		$_nr_pages = intval(count($_hotel_charter)/$_ipp);
		$_hotel_charter = array_slice($_hotel_charter, $offset, $_ipp);

		if($new_count_hotel_charter == 0){
			go_away( route('search-tab', 'circuite') .'?q='.$_search );
		}



	}elseif(isset($_params['slug']) && $_params['slug'] == 'circuite'){

		list($_circuits, $count_circuits) = get_posts($options_circuits);

		$_new_count_items = count($_circuits);

		foreach($_circuits as &$item){
			$item['images'] = get_images('circuit', $item['id_circuit']);
			$item = circuit_prepare_info($item);

			unset($item);
		}

		usort($_circuits, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});

		foreach($_circuits as $k => $item){
			if(!($item['price'] > 0)){
				unset($_circuits[$k]);
			}
		}
		$_new_count_items = count($_circuits);

		$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
		$_nr_pages = intval(count($_circuits)/$_ipp);
		$_circuits = array_slice($_circuits, $offset, $_ipp);

		if($_new_count_items == 0){
			go_away( route('search-tab', 'bilete-avion') .'?q='.$_search );
		}

	}elseif(isset($_params['slug']) && $_params['slug'] == 'bilete-avion'){

		$options_tickets['offset'] = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
		$options_tickets['limit'] = $_ipp;

		list($_tickets, $count_tickets) = get_posts($options_tickets);

		foreach($_tickets as &$item){
			$city_from = get_city_by_id($item['id_city_from']);
			$city_to = get_city_by_id($item['id_city_to']);
			$company_image = get_company_image_by_id($item['id_ticket_company']);
			$company = get_company_by_id($item['id_ticket_company']);
			$dates = db_query('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC', $item['id_ticket']);
			if($dates){
				$date_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC LIMIT 1', $item['id_ticket']);
				$date_max = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_to DESC LIMIT 1', $item['id_ticket']);

				$price_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY price ASC LIMIT 1', $item['id_ticket']);
				$item['price'] = $price_min['price'];

				$date_from = date('d.m', strtotime($date_min['date_from']));
				$date_to = date('d.m.Y', strtotime($date_max['date_to']));

		        if($date_max['date_to'] != ""){
		            $item['period'] = $date_from." - ".$date_to;
		        }else{
		            $item['period'] = $date_from;
		        }
			}else{
				$date_from = date('d.m', strtotime($item['date_from']));
				$date_to = date('d.m.Y', strtotime($item['date_to']));

		        if($item['date_to'] != ""){
		            $item['period'] = $date_from." - ".$date_to;
		        }else{
		            $item['period'] = $date_from;
		        }
			}
			$item['title'] = $city_from['title'] . ' - ' . $city_to['title'];
			$item['company_image'] = $_base . 'uploads/images/' .$company_image['folder'] . $company_image['image'];
			$item['company_title'] = $company['title'];
			unset($item);
		}

		if($count_tickets == 0){
			go_away( route('search-tab', 'croaziere') .'?q='.$_search );
		}

	}elseif(isset($_params['slug']) && $_params['slug'] == 'croaziere'){

		$options_cruises['offset'] = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
		$options_cruises['limit'] = $_ipp;

		list($_cruises, $count_cruises) = get_posts($options_cruises);

		foreach($_cruises as &$item){
			$item = get_cruise_info($item);
			unset($item);
		}

		if($count_cruises == 0){
			go_away( route('search-tab', 'hotel') .'?q='.$_search );
		}

	}elseif(isset($_params['slug']) && $_params['slug'] == 'hotel'){

		list($_hotel, $count_hotel) = get_posts($options_hotel);

		foreach($_hotel as &$item){
			$item = hotel_prepare_info($item);
			unset($item);
		}

		foreach($_hotel as $k => $item){
			if(!($item['price'] > 0)){
				unset($_hotel[$k]);
			}
		}
		$new_count_hotel = count($_hotel);

		usort($_hotel, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});

		$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
		$_nr_pages = intval(count($_hotel)/$_ipp);
		$_hotel = array_slice($_hotel, $offset, $_ipp);

		// if($count_hotel == 0){
			// go_away( route('search') .'?q='.$_search );
		// }

	}




}



$_section = "search";

// seo
$_meta_title = __('Cautare');
$_no_index = true;
