<?

$_ipp = $_config['paging']['ipp']['charter'];

if($_params['city_from']){
	$_city_from = get_city_by_slug($_params['city_from']);
	if(!$_city_from) go_away(route('charters-home'));

	$_city_from_sql = "WHERE id_city_from = ".$_city_from['id_city'];
}

if(!$_params['id']){
	$_zone = get_zone_by_slug($_params['city_to']);
	if(!$_zone){
		$_city = get_city_by_slug($_params['city_to']);
		if(!$_city) {
			$_category = get_charter_category_by_slug_and_city_from($_params['city_to'], $_city_from['id_city']);
			if(!$_category) go_away(route('charters-home'));
			$_is_category = true;

			$_zone = get_zone_by_id($_category['id_zone']);
			$_is_zone = true;
		}else{
			$_is_city = true;
		}
	}else{
		$_is_zone = true;
	}
}


if($_params['id']){

	$_search = db_row('SELECT * FROM charter_search WHERE id_charter_search = ?', $_params['id']);
	if(!$_search) go_away(route('charters-home'));

	$id_search = $_search['id_charter_search'];

	$results = cache_get('charter_search_'.$id_search);
	if(!$results){
		go_away(route('charters-loading', $id_search));
	}else{

		$search_items = array();
		if($results['Hotel'][0]){
			$search_items = $results['Hotel'];
		}else{
			$search_items[0] = $results['Hotel'];
		}

		foreach($search_items as $item){
			$code = $item['Product']['ProductCode']['value'];
			$tourop = $item['Product']['TourOpCode']['value'];
			$hotel = get_hotel_by_eurosite_code_and_tourop($code, $tourop);
			if($hotel){
				$_hotels_ids[] = $hotel['id_hotel'];
			}
		}

	}

	if($_hotels_ids){
		$_is_search = true;
	}

}

if($_is_search){
	$_city_from = get_city_by_id($_search['id_city_from']);
	if(!$_city_from) go_away(route('charters-home'));

	$_city_from_sql = "WHERE id_city_from = ".$_city_from['id_city'];
}


$_query = array(
	'table' => 'hotel',
	'limit' => -1,
	'images' => true,
	'extra_where' => ' AND id_hotel IN (SELECT id_hotel FROM charter_minprice '.$_city_from_sql.')'
);


if($_is_search){

	$_country = get_country_by_id($_search['id_country']);
	$_zone = get_zone_by_id($_search['id_zone']);
	if(!$_zone){
		$_city = get_city_by_id($_search['id_zone']);
		$_zone = get_zone_by_id($city['id_zone']);
		$_is_city = true;
	}else{
		$_is_zone = true;
	}

	$_query['extra_where'] .= ' AND id_hotel IN ('.implode(",", $_hotels_ids).')';

}

if($_is_city){
	$_title = $_city['title'];
	$_title_destination = $_city['title'];
	$_item = $_city;

	$_query['id_city'] = $_city['id_city'];

	$imgs = get_images('city', $_city['id_city']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_chartere.jpg";
	}

	$_country = get_country_by_id($_city['id_country']);
}

if($_is_zone){
	$_title = $_zone['title_homepage'] != "" && !$_is_search ? $_zone['title_homepage'] : $_zone['title'];
	$_title_destination = $_zone['title'];
	$_item = $_zone;

	$imgs = get_images('zone', $_zone['id_zone']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_chartere.jpg";
	}

	$_country = get_country_by_id($_zone['id_country']);

	if($_is_category){

		$_title = $_category['title'];
		$_title_destination = $_category['title'];

		$dates = db_query('SELECT * FROM charter_category_date WHERE id_charter_category = ?', $_category['id_charter_category']);
		$cities_category = db_query('SELECT * FROM charter_category_to_city WHERE id_charter_category = ?', $_category['id_charter_category']);

		if($dates && $cities_category){
			$charter_dates = array();
			foreach($dates as $date){
				$charter_dates[] = $date['dates'];
			}

			$charter_cities = array();
			foreach($cities_category as $cities_cat){
				$charter_cities[] = $cities_cat['id_city'];
			}

			$_query['extra_where'] .= ' AND id_city IN ('.implode(',', $charter_cities).') AND id_hotel IN (SELECT id_hotel FROM charter_minprice WHERE date_from > "'.date('Y-m-d').'" AND date_from IN ("'.implode('","', $charter_dates).'"))';
			// $_extra_cities_from = ' AND id_city IN (SELECT id_city_from FROM charter_category WHERE title = "'.$_category['title'].'") AND id_city IN (SELECT id_city_from FROM charter_minprice WHERE date_from > "'.date('Y-m-d').'" AND date_from IN ("'.implode('","', $charter_dates).'") AND id_city IN ('.implode(',', $charter_cities).')  )';
			$_extra_cities_from = ' AND id_city IN (SELECT id_city_from FROM charter_category WHERE title = "'.$_category['title'].'") AND id_city IN (SELECT id_city_from FROM charter_minprice WHERE date_from > "'.date('Y-m-d').'" AND id_city IN ('.implode(',', $charter_cities).')  )';
		}else{
			$_query['extra_where'] .= ' AND id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].')';
		}

	}else{

		list($categories, $cnt_cat) = get_posts(array(
			'table' => 'charter_category',
			'id_city_from' => $_city_from['id_city'],
			'extra_where' => ' AND id_charter_category IN (SELECT id_charter_category FROM charter_category_to_city WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].'))'
		));

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

		$_query['extra_where'] .= ' AND id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].')';

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

if( !$_is_search && (($_params['type'] != $_item['charter_type'] && $_item['charter_type'] != "") || ($_item['charter_type'] == "" && $_params['type'] == "sejur")) ){
	go_away(get_charter_link($_item, $_title, $_city_from['title']), '301');
}

// facilities
$_facilities_hotels = array_keys($_hotel_facilities_options);
$_facilities_hotels_flipped = array_flip($_facilities_hotels);

// meal special filters
list($_meal_filters_tags, $count_meal) = get_posts(array(
	'table' => 'charter_filters_meal_group'
));

// get items and filters from cache
if(!$_is_search && !isset($_GET['d']) && !isset($_GET['t'])){
	$hash_for_cache = md5(json_encode($_query)."-".json_encode($dates_excluded));

	$_items = cache_get('charters-list-items-'.$hash_for_cache); // TODO : takes 1 second at least...
	$_filters = cache_get('charters-list-filters-'.$hash_for_cache);
	$_cities_hotels = cache_get('charters-list-cities-hotels-'.$hash_for_cache);
	$_filters_meals = cache_get('charters-list-filter-meals-'.$hash_for_cache);
}

if(!$_items || !$_filters){

	// get items
	list($_items, $_count_items) = get_posts($_query);

	// filters
	$_filters['price']['min'] = 99999;
	$_filters['price']['max'] = 0;
	$_filters_meals = array();

	// browse items
	$mi = 1;
	foreach($_items as &$item){
		if($_is_search){
			$item = hotel_prepare_charter_info_from_search($item, ($_is_zone ? $_zone : $_city), $_city_from, $_search, $search_items);
		}else{
			$item = hotel_prepare_charter_info($item, ($_is_zone ? $_zone : $_city), $_city_from, $dates_excluded);
		}

		if(isset($_GET['d']) && $_GET['d'] != "" && isset($_GET['t']) && $_GET['t'] != ""){
			$dates_from = $dates_to = array();
			foreach($item['periods'] as $period){
				if(!in_array($period['date_from'], $dates_from)){
					$dates_from[] = $period['date_from'];
				}
				if(!in_array($period['date_to'], $dates_to[$period['date_from']])){
					$dates_to[$period['date_from']][] = $period['date_to'];
				}
			}
			if(in_array(date('Y-m-d', strtotime($_GET['d'])), $dates_from) && in_array(date('Y-m-d', strtotime($_GET['t'])), $dates_to[date('Y-m-d', strtotime($_GET['d']))])){
				$item = charter_get_price($item, ($_is_zone ? $_zone : $_city), $_city_from, date('Y-m-d', strtotime($_GET['d'])), date('Y-m-d', strtotime($_GET['t'])));
				$item['url'] .= "?d=".date('d.m.Y', strtotime($_GET['d']))."&t=".date('d.m.Y', strtotime($_GET['t']));
			}else{
				$item['price'] = "";
			}
		}

		if($_is_category){
			$dates_from = array();
			foreach($item['periods'] as $kp => $period){
				if(!in_array($period['date_from'], $charter_dates)){
					unset($item['periods'][$kp]);
				}
			}
			$item['periods'] = array_values($item['periods']);

			usort($item['periods'], function($a, $b){
				if($a['price'] == $b['price']) return 0;
				else return $a['price'] < $b['price'] ? -1 : 1;
			});

			if($item['periods']){
				$item = charter_get_price($item, ($_is_zone ? $_zone : $_city), $_city_from, $item['periods'][0]['date_from'], $item['periods'][0]['date_to']);
				$item['url'] .= "?d=".date('d.m.Y', strtotime($item['periods'][0]['date_from']))."&t=".date('d.m.Y', strtotime($item['periods'][0]['date_to']));
			}else{
				$item['price'] = "";
			}
			/*
			if(in_array(date('Y-m-d', strtotime($_GET['d'])), $dates_from) && in_array(date('Y-m-d', strtotime($_GET['t'])), $dates_to[date('Y-m-d', strtotime($_GET['d']))])){
				$item = charter_get_price($item, ($_is_zone ? $_zone : $_city), $_city_from, date('Y-m-d', strtotime($_GET['d'])), date('Y-m-d', strtotime($_GET['t'])));
				$item['url'] .= "?d=".date('d.m.Y', strtotime($_GET['d']))."&t=".date('d.m.Y', strtotime($_GET['t']));
			}else{
				$item['price'] = "";
			}
			*/
		}

		if($item['price'] > 0){
			if($item['price'] > $_filters['price']['max']) $_filters['price']['max'] = $item['price'];
			if($item['price'] < $_filters['price']['min']) $_filters['price']['min'] = $item['price'];

			if($item['special_offer']){
				$_filters['special_offer']['show'] = true;
				$_filters['special_offer']['count']++;
			}
			if($item['last_minute']){
				$_filters['last_minute']['show'] = true;
				$_filters['last_minute']['count']++;
			}
			if($item['early_booking']){
				$_filters['early_booking']['show'] = true;
				$_filters['early_booking']['count']++;
			}

			if($item['stars'] > 0){
				$_filters['stars'][$item['stars']]['count']++;
			}

			if($item['meals']){
				foreach($item['meals'] as $meal){
					if(!in_array($meal, $_filters_meals)){
						$key = $mi++;
						$_filters['meals'][] = array(
							'name' => $meal,
							'key' => $key,
							'count' => 1
						);
						$_filters_meals[$key] = $meal;
					}else{
						foreach($_filters['meals'] as $k => $v){
							if($v['name'] == $meal){
								$_filters['meals'][$k]['count']++;
								break;
							}
						}
					}
				}
			}

			foreach($_hotel_facilities_options as $key_filt => $filt){
				if($item[$key_filt]){
					$_filters['facilities'][$_facilities_hotels_flipped[$key_filt]]['count']++;
				}
			}

			$_filters['cities'][$item['id_city']]['count']++;
			if(!in_array($item['id_city'], $_cities_hotels)){
				$_cities_hotels[] = $item['id_city'];

				$city_info = get_city_by_id($item['id_city']);
				$_filters['cities'][$item['id_city']]['name'] = $city_info['title'];
			}
		}

		unset($item);
	}

	cache_set('charters-list-items-'.$hash_for_cache, $_items, 60*60);
	cache_set('charters-list-filters-'.$hash_for_cache, $_filters, 60*60);
	cache_set('charters-list-cities-hotels-'.$hash_for_cache, $_cities_hotels, 60*60);
	cache_set('charters-list-filter-meals-'.$hash_for_cache, $_filters_meals, 60*60);

}


// check active filters
if(isset($_GET['pr'])){
	$tmp_price = explode('-', $_GET['pr']);

	$_active_filters['price']['min'] = $tmp_price[0];
	$_active_filters['price']['max'] = $tmp_price[1];
}

if(isset($_GET['of'])){
	$tmp_of = explode(',', $_GET['of']);
	foreach($tmp_of as $of){
		if(in_array($of, array(1, 2, 3))){
			$_active_filters['offer'][] = $of;
		}
	}
}

if(isset($_GET['s'])){
	$tmp_s = explode(',', $_GET['s']);
	foreach($tmp_s as $s){
		$_active_filters['stars'][] = $s;
	}
}

if(isset($_GET['m'])){
	$tmp_m = explode(',', $_GET['m']);
	foreach($tmp_m as $m){
		$_active_filters['meals'][] = $m;
	}
}

if(isset($_GET['f'])){
	$tmp_f = explode(',', $_GET['f']);
	foreach($tmp_f as $f){
		$_active_filters['facilities'][] = $f;
	}
}

if(isset($_GET['ct'])){
	$tmp_ct = explode(',', $_GET['ct']);
	foreach($tmp_ct as $ct){
		$_active_filters['cities'][] = $ct;
	}
}

if(isset($_GET['q'])){
	$q = generate_name($_GET['q']);
	$_search_query = str_replace('-', ' ', $q);
}


// remove the ones without the price
foreach($_items as $k => $item){
	if(!($item['price'] > 0)){
		unset($_items[$k]);
	}
}
$_count_items = count($_items);

// price filter links
$_price_filter_link = get_offer_filter_link($_active_filters, 'price', '');

// special offers link
$_filters['special_offer']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 1);
$_filters['special_offer']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 1);

$_filters['last_minute']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 2);
$_filters['last_minute']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 2);

$_filters['early_booking']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 3);
$_filters['early_booking']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 3);

// stars filter links
foreach($_filters['stars'] as $k => &$v){
	$v['add-url'] = get_offer_filter_link($_active_filters, 'stars', $k);
	$v['remove-url'] = remove_offer_filter_link($_active_filters, 'stars', $k);
	unset($v);
}
ksort($_filters['stars']);

// meals filter links
$_max_meal_filter_key = count($_filters['meals']);
foreach($_meal_filters_tags as $meal_filter){
	$tags = explode(",", $meal_filter['tags']);
	foreach($_filters['meals'] as $k => $v){
		if($_filters['meals'][$k]){
			foreach($tags as $tag){
				if(stripos($_filters['meals'][$k]['name'], trim($tag)) !== false){
					if($_special_meal_filters[$meal_filter['title']]){
						$_special_meal_filters[$meal_filter['title']]['count'] += $_filters['meals'][$k]['count'];
					}else{
						$_special_meal_filters[$meal_filter['title']] = array(
							'name' => $meal_filter['title'],
							'key' => $_max_meal_filter_key + count($_special_meal_filters) + 1,
							'count' => $_filters['meals'][$k]['count'],
							'id' => $meal_filter['id_charter_filters_meal_group']
						);
					}
					$_special_meal_filters_grouped[$meal_filter['id_charter_filters_meal_group']][] = $_filters['meals'][$k];
					unset($_filters['meals'][$k]);
				}
			}
		}
	}
}

if($_special_meal_filters){
	foreach($_special_meal_filters as $meal_filter){
		$_filters['meals'][] = $meal_filter;
	}
}

foreach($_filters['meals'] as $k => &$v){
	$v['add-url'] = get_offer_filter_link($_active_filters, 'meals', $v['key']);
	$v['remove-url'] = remove_offer_filter_link($_active_filters, 'meals', $v['key']);
	unset($v);
}
foreach($_filters['meals'] as &$meal){
	$meal['name'] = ucwords(strtolower($meal['name']));
	unset($meal);
}
usort($_filters['meals'], function($a, $b){
	if($a['count'] == $b['count']) return 0;
	else return $a['count'] > $b['count'] ? -1 : 1;
	//if($a['name'] == "Fara masa") return -10;
	//else return strcasecmp($a['name'], $b['name']);
});

// facilities filter links
foreach($_filters['facilities'] as $k => &$v){
	$v['add-url'] = get_offer_filter_link($_active_filters, 'facilities', $k);
	$v['remove-url'] = remove_offer_filter_link($_active_filters, 'facilities', $k);
	unset($v);
}
ksort($_filters['facilities']);

// cities filter links
if($_is_zone && $_cities_hotels){
	foreach($_filters['cities'] as $k => &$v){
		$v['add-url'] = get_offer_filter_link($_active_filters, 'cities', $k);
		$v['remove-url'] = remove_offer_filter_link($_active_filters, 'cities', $k);
		unset($v);
	}
	uasort($_filters['cities'], function($a, $b){
		return strcasecmp($a['name'], $b['name']);
	});
}

// apply filters
foreach($_items as $k => $item){

	// price
	if($_active_filters['price']){
		if($_active_filters['price']['min'] > $item['price'] || $_active_filters['price']['max'] < $item['price']){
			unset($_items[$k]);
		}
	}

	// special offers
	if($_active_filters['offer']){
		foreach($_active_filters['offer'] as $of){
			if($of == 1 && $item['special_offer'] != 1) unset($_items[$k]);
			if($of == 2 && $item['last_minute'] != 1) unset($_items[$k]);
			if($of == 3 && $item['early_booking'] != 1) unset($_items[$k]);
		}
	}

	// stars
	if($_active_filters['stars']){
		$found = false;
		foreach($_active_filters['stars'] as $st){
			if($st == $item['stars']) $found = true;
		}
		if(!$found) unset($_items[$k]);
	}

	// meals
	if($_active_filters['meals']){
		$found = false;
		foreach($_active_filters['meals'] as $ml){
			if($ml <= $_max_meal_filter_key){
				if(in_array($_filters_meals[$ml], $item['meals'])) $found = true;
			}else{
				foreach($_special_meal_filters as $meal_filter){
					if($meal_filter['key'] == $ml){
						foreach($_special_meal_filters_grouped[$meal_filter['id']] as $ml_filter){
							if(in_array($_filters_meals[$ml_filter['key']], $item['meals'])) $found = true;
						}
						break;
					}
				}
			}
		}
		if(!$found) unset($_items[$k]);
	}

	// facilities
	if($_active_filters['facilities']){
		$found = true;
		foreach($_active_filters['facilities'] as $fl){
			if(!$item[$_facilities_hotels[$fl]]) $found = false;
		}
		if(!$found) unset($_items[$k]);
	}

	// cities
	if($_active_filters['cities']){
		$found = false;
		foreach($_active_filters['cities'] as $fl){
			if($item['id_city'] == $fl) $found = true;
		}
		if(!$found) unset($_items[$k]);
	}

	// query
	if($_search_query != ""){
		if(!str_like("%".$_search_query."%", $item['title'])){
			unset($_items[$k]);
		}
	}
}

$_new_count_items = $_count_items_filters = count($_items);


// sort items
switch($_GET['srt']){
	case 'rc':{
		usort($_items, function($a, $b){
			if($a['recommended'] == $b['recommended']){
				if($a['price'] == $b['price']){
			        return 0;
			    }
			    return ($a['price'] < $b['price']) ? -1 : 1;
			}
			return ($a['recommended'] > $b['recommended']) ? -1 : 1;
		});
	}break;
	case 'pra':{
		usort($_items, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});
	}break;
	case 'prd':{
		usort($_items, function($a, $b){
			if($a['price'] == $b['price']){
		        return 0;
		    }
		    return ($a['price'] > $b['price']) ? -1 : 1;
		});
	}break;
	case 'ta':{
		usort($_items, function($a, $b){
			return strcasecmp($a['title'], $b['title']);
		});
	}break;
	case 'td':{
		usort($_items, function($a, $b){
			return strcasecmp($b['title'], $a['title']);
		});
	}break;
	case 'sa':{
		usort($_items, function($a, $b){
			if($a['stars'] == $b['stars']){
		        return 0;
		    }
		    return ($a['stars'] < $b['stars']) ? -1 : 1;
		});
	}break;
	case 'sd':{
		usort($_items, function($a, $b){
			if($a['stars'] == $b['stars']){
		        return 0;
		    }
		    return ($a['stars'] > $b['stars']) ? -1 : 1;
		});
	}break;
	case 'dsc':{
		usort($_items, function($a, $b){
			if($a['discount_sort'] == $b['discount_sort']){
		        return 0;
		    }
		    return (intval($a['discount_sort']) > intval($b['discount_sort'])) ? -1 : 1;
		});
	}break;
	default:{
		usort($_items, function($a, $b){
			if($a['recommended'] == $b['recommended']){
				if($a['price'] == $b['price']){
			        return 0;
			    }
			    return ($a['price'] < $b['price']) ? -1 : 1;
			}
			return ($a['recommended'] > $b['recommended']) ? -1 : 1;
			/*
			if($a['black_friday'] == $b['black_friday']){
				if($a['price'] == $b['price']){
			        return 0;
			    }
			    return ($a['price'] < $b['price']) ? -1 : 1;
			}
			return ($a['black_friday'] > $b['black_friday']) ? -1 : 1;
			*/
		});
	}break;
}


// cut and show by pagination
$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
$_nr_pages = ceil(count($_items)/$_ipp);
$_items = array_slice($_items, $offset, $_ipp);






// get cities for sidebar search
list($_zones_check_sidebar, $count) = get_posts(array(
	'table' => 'zone',
	'limit' => -1,
	'id_country' => $_country['id_country'],
	'extra_where' => '
		AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$_country['id_country'].' GROUP BY id_city) GROUP BY id_zone)
		AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM charter_minprice)))
	',
	'order' => 'title ASC'
));

$_zones_used = array(0);
foreach($_zones_check_sidebar as $zone){
	$_zones_used[] = $zone['id_zone'];
	$cities_to_side[] = array(
		'id' => $zone['id_zone'],
		'type' => 'zone',
		'title' => $zone['title']
	);
}

list($_cities_check_sidebar, $count) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
	'id_country' => $_country['id_country'],
	'extra_where' => '
		AND id_zone NOT IN ('.implode(',', $_zones_used).')
		AND id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$_country['id_country'].' GROUP BY id_city)
		AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM charter_minprice))
	',
	'order' => 'title ASC'
));

foreach($_cities_check_sidebar as $city){
	$cities_to_side[] = array(
		'id' => $city['id_city'],
		'type' => 'city',
		'title' => $city['title']
	);
}

foreach($cities_to_side as $k => $item){
	$_cities_sidebar[$k]['id'] = $item['id'];
	$_cities_sidebar[$k]['text'] = $item['title'];
}



// get cities from for sidebar search
if($_is_zone){
	$sql_city = ' id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_item['id_zone'].') ';
}elseif($_is_city){
	$sql_city = ' id_city = '.$_item['id_city'].' ';
}

list($cities_to_side, $count) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
	'extra_where' => '
		AND id_city IN (SELECT id_city_from FROM charter_destination WHERE '.$sql_city.' GROUP BY id_city_from)
	',
	'order' => 'title ASC'
));

foreach($cities_to_side as $city){
	$_cities_from_sidebar[] = array(
		'id_city' => $city['id_city'],
		'title' => $city['title']
	);
}




// get all cities from for this destination
list($_other_cities_from, $count_other) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
	'id_country' => 126,
	'extra_where' => ' AND id_city IN (SELECT id_city_from FROM charter_destination WHERE '.$sql_city.')'.$_extra_cities_from,
	//'order' => 'title ASC'
));
foreach($_other_cities_from as $k => &$city){

	$city['url'] = get_charter_link($_item, ($_is_category ? $_category['title'] : $_item['title']), $city['title']);

	if($_is_zone && !$_is_category){
		list($categories, $cnt_cat) = get_posts(array(
			'table' => 'charter_category',
			'id_city_from' => $city['id_city'],
			'extra_where' => ' AND id_charter_category IN (SELECT id_charter_category FROM charter_category_to_city WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].'))'
		));

		$dates_excluded_tmp = array();
		if($categories){
			foreach($categories as $cat){
				$dates = db_query('SELECT * FROM charter_category_date WHERE id_charter_category = ?', $cat['id_charter_category']);
				foreach($dates as $date){
					if(!in_array($date['dates'], $dates_excluded_tmp)){
						$dates_excluded_tmp[] = $date['dates'];
					}
				}
			}
		}

		if($dates_excluded_tmp){
			$query_for_cities = $_query;
			$city_from_sql = "WHERE id_city_from = ".$city['id_city'].' AND date_from NOT IN ("'.implode('","', $dates_excluded_tmp).'")';
			$query_for_cities['extra_where'] = str_replace($_city_from_sql, $city_from_sql, $query_for_cities['extra_where']);

			list($itms, $count) = get_posts($query_for_cities);

			if(!$count){
				unset($_other_cities_from[$k]);
			}
		}
	}

	unset($city);
}



// get charter flight info
if($_cities_hotels){
	$from_id = $_city_from['id_city'];

	// if(debug_mode()){
	// 	echo '
	// 		SELECT *, DATE_FORMAT(departure_time, "%w") AS departure_day, MIN(departure_time) AS min_departure, MAX(departure_time) AS max_departure FROM (
	// 			SELECT * FROM charter_flights
	// 			WHERE flight_type = 3 AND DATE_FORMAT(departure_time, "%Y-%m-%d") > NOW() AND id_city_from = '.$from_id.' AND id_city IN ('.implode(",", $_cities_hotels).')'
	// 			.($dates_excluded ? ' AND DATE_FORMAT(other_flight_time, "%Y-%m-%d") NOT IN ("'.implode('","', $dates_excluded).'")' : '').' '
	// 			.($_is_category ? ' AND DATE_FORMAT(other_flight_time, "%Y-%m-%d") IN ("'.implode('","', $charter_dates).'")' : '').
	// 			'ORDER BY departure_time ASC
	// 		) AS tmp_table GROUP BY id_city_from, departure_airport_code, arrival_airport_code, DATE_FORMAT(departure_time, "%w"), DATE_FORMAT(arrival_time, "%w"), flight_company
	// 		-- , DATE_FORMAT(other_flight_time, "%w")
	// 		-- LIMIT 2
	// 	';
	// 	exit;
	// }

	$flights_departure = db_query('
		SELECT *, DATE_FORMAT(departure_time, "%w") AS departure_day, MIN(departure_time) AS min_departure, MAX(departure_time) AS max_departure FROM (
		    SELECT * FROM charter_flights
			WHERE flight_type = 1 AND DATE_FORMAT(departure_time, "%Y-%m-%d") > NOW() AND id_city_from = '.$from_id.' AND id_city IN ('.implode(",", $_cities_hotels).')'
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
			WHERE flight_type = 3 AND DATE_FORMAT(departure_time, "%Y-%m-%d") > NOW() AND id_city_from = '.$from_id.' AND id_city IN ('.implode(",", $_cities_hotels).')'
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






$_section = "charters";
$_active_tab = "charters";

// seo
$_meta_title = $_offer_type." ".$_title." cu plecare din ".$_city_from['title'];
$_meta_description = "";
$_meta_keywords = "";
$_no_index = false;
