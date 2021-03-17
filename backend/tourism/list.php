<?

$_ipp = $_config['paging']['ipp']['tourism'];

if($_params['ro']){
	$is_ro = true;
}else{
	$_country = get_country_by_slug($_params['city']);
	if(!$_country){
		$_category = get_category_by_slug($_params['city']);
		if(!$_category){
			$_zone = get_zone_by_slug($_params['city']);
			if(!$_zone){
				$_city = get_city_by_slug($_params['city']);
				if(!$_city) go_away(route('tourism-home'));
				$_is_city = true;
			}else{
				$_is_zone = true;
			}
		}else{
			$_is_category = true;
		}
	}else{
		$_is_country = true;
	}
}

$_query = array(
	'table' => 'hotel',
	'limit' => -1,
	'images' => true
);

if($_params['id']){

	$_search = db_row('SELECT * FROM hotel_search WHERE id_hotel_search = ?', $_params['id']);
	if(!$_search) go_away(route('tourism-home'));

	$id_search = $_search['id_hotel_search'];

	$_country = get_country_by_id($_search['id_country']);
	$_city = get_city_by_id($_search['id_city']);

	$results = cache_get('hotel_search_'.$id_search);

	if(!$results){
		go_away(route('tourism-loading', $id_search));
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
				if($tourop != 'P45'){
				// if($tourop != 'P45' && !$item['images']){
					// $hotel_info = eurositeGetProductInfoRequest($code, $tourop, $_country['code'], $_city['code']);
					// update_eurosite_hotel_info($hotel_info);
					// $hotel = get_hotel_by_eurosite_code_and_tourop($code, $tourop);
					hotel_queue_for_update($code, $tourop, $_country['code'], $_city['code']);
				}
				if($hotel['title'] == ""){
					// $hotel_info = eurositeGetProductInfoRequest($code, $tourop, $_country['code'], $_city['code']);
					// update_eurosite_hotel_info($hotel_info);

					// if(debug_mode()){
					// 	print_r($hotel_info);
					// 	exit;
					// }
				}else{
					$_hotels_ids[] = $hotel['id_hotel'];
				}
			}
		}

	}

	if($_hotels_ids){
		$_is_search = true;
	}

}



if($is_ro){

	$_title = "Turism intern";

	$_query['id_country'] = 126;
	$_country = get_country_by_id(126);

	$_header_img = $_base_static."img/header_turism-intern.jpg";

	if(isset($_params['tag'])){
		$_tag = get_city_tag_by_slug($_params['tag']);
		if(!$_tag){
			$_hotel_tag = get_hotel_tag_by_slug($_params['tag']);
			if(!$_hotel_tag) {
				$_hotel_group_tag = get_hotel_group_tag_by_slug($_params['tag']);
				if(!$_hotel_group_tag) go_away(route('tourism-ro-home'));

				$_is_hotel_group_tag = true;
				$_is_hotel_group_tag_link = true;
			}else{
				$_is_hotel_tag = true;
				$_is_hotel_tag_link = true;
			}
		}else{
			$_is_tag = true;
		}
	}

	if(isset($_GET['st'])){
		$_hotel_tag = get_hotel_tag_by_id(intval($_GET['st']));
		if(!$_hotel_tag) go_away(route('tourism-ro-home'));

		$_is_hotel_tag = true;
	}

}



if($_is_search){

	$_country = get_country_by_id($_search['id_country']);
	$_city = get_city_by_id($_search['id_city']);

	$_is_city = true;

	$_query['extra_where'] = ' AND id_hotel IN ('.implode(",", $_hotels_ids).')';

}



if($_is_tag){

	$_title .= " - ".$_tag['title_front'];

	$_query['extra_where'] = 'AND id_city IN (SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$_tag['id_city_tag'].')';

}


if($_is_hotel_tag){

	$_title .= " - ".$_hotel_tag['title'];

	/*
	$_query['extra_where'] = '
		AND id_hotel IN (
			SELECT hotel_grila.id_hotel FROM hotel_grila
			JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
			WHERE hotel_grila.id_hotel_tag = '.$_hotel_tag['id_hotel_tag'].' AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
		)
	';
	*/

}


if($_is_hotel_group_tag){

	$_title .= " - ".$_hotel_group_tag['title'];

	$hotel_tags = array(0);
	$all_tags = db_query('SELECT * FROM hotel_group_tag_to_hotel_tag WHERE id_hotel_group_tag = ?', $_hotel_group_tag['id_hotel_group_tag']);
	foreach($all_tags as $tg){
		$hotel_tags[] = $tg['id_hotel_tag'];
	}

	$_query['extra_where'] = '
		AND id_hotel IN (
			SELECT hotel_grila.id_hotel FROM hotel_grila
			JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
			WHERE hotel_grila.id_hotel_tag IN ('.implode(',', $hotel_tags).') AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
		)
	';

}


if($_is_country){

	$_title = $_country['title'];
	$_item = $_country;

	$_query['id_country'] = $_country['id_country'];

	$imgs = get_images('country', $_country['id_country']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_turism-individual.jpg";
	}

}


if($_is_city){

	$_title = $_city['title'];
	$_item = $_city;

	$_query['id_city'] = $_city['id_city'];

	$imgs = get_images('city', $_city['id_city']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_turism-individual.jpg";
	}

	$_country = get_country_by_id($_city['id_country']);

}

if($_is_zone){

	$_title = $_zone['title'];
	$_item = $_zone;

	$_query['extra_where'] = 'AND id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].')';

	$imgs = get_images('zone', $_zone['id_zone']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_turism-individual.jpg";
	}

	$_country = get_country_by_id($_zone['id_country']);

}


if($_is_category){

	$_title = $_category['title'];
	$_item = $_category;

	$_query['extra_where'] = 'AND (
									id_city IN (SELECT id_city FROM city WHERE '.db_is_active('', 'city').' AND id_city IN (SELECT id_city FROM category_to_city WHERE id_category = '.$_category['id_category'].'))
									OR
									id_city IN (SELECT id_city FROM city WHERE '.db_is_active('', 'city').' AND id_zone IN (SELECT id_zone FROM category_to_zone WHERE id_category = '.$_category['id_category'].'))
							)';
	if($_category['id_hotel_group_tag'] > 0){
 		$hotel_tags = array(0);
		$all_tags = db_query('SELECT * FROM hotel_group_tag_to_hotel_tag WHERE id_hotel_group_tag = ?', $_category['id_hotel_group_tag']);
		foreach($all_tags as $tg){
			$hotel_tags[] = $tg['id_hotel_tag'];
		}

		$_query['extra_where'] .= '
			AND id_hotel IN (
				SELECT hotel_grila.id_hotel FROM hotel_grila
				JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
				WHERE hotel_grila.id_hotel_tag IN ('.implode(',', $hotel_tags).') AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
			)
		';
	}

	$imgs = get_images('category', $_category['id_category']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_turism-individual.jpg";
	}

}



// facilities
$_facilities_hotels = array_keys($_hotel_facilities_options);
$_facilities_hotels_flipped = array_flip($_facilities_hotels);

// meal special filters
list($_meal_filters_tags, $count_meal) = get_posts(array(
	'table' => 'hotel_filters_meal_group'
));


// get items and filters from cache
if(!$_is_search){
	$hash_for_cache = md5(json_encode($_query));

	$_items = cache_get('tourism-list-items-'.$hash_for_cache);
	$_filters = cache_get('tourism-list-filters-'.$hash_for_cache);
	$_cities_hotels = cache_get('tourism-list-cities-hotels-'.$hash_for_cache);
	$_filters_meals = cache_get('tourism-list-filter-meals-'.$hash_for_cache);
}

if(!$_items || !$_filters){

	// get items
	list($_items, $_count_items) = get_posts($_query);

	// filters
	$_filters['price']['min'] = 99999;
	$_filters['price']['max'] = 0;

	// browse items
	$mi = 1;
	$_hotels_ids_filters = array(0);

	foreach($_items as $xkl => $item){
		if($item['title'] == ""){
			unset($_items[$xkl]);
		}
	}

	foreach($_items as $xkl => &$item){
		if($_is_hotel_tag){
			$item = hotel_prepare_info_special_tag($item, $_hotel_tag['id_hotel_tag']);
		}elseif($_is_search){
			$item = hotel_prepare_info_from_search($item, $_search, $search_items);
		}else{
			$item = hotel_prepare_info($item);
		}

		if($item['price'] > 0){

			$_hotels_ids_filters[] = $item['id_hotel'];

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

			if($is_ro){
				list($special_tags, $count) = get_posts(array(
					'table' => 'hotel_tag',
					'limit' => -1,
					'extra_where' => '
						AND id_hotel_tag IN (
							SELECT hotel_grila.id_hotel_tag FROM hotel_grila
							JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
							WHERE hotel_grila.id_hotel = '.$item['id_hotel'].' AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
						)
					',
					'order' => 'title ASC',
				));

				foreach($special_tags as $tag){
					$item['hotel_tags'][] = $tag['id_hotel_tag'];

					if(!in_array($tag['id_hotel_tag'], $_filters_special_tags)){
						$_filters['special_tags'][] = array(
							'name' => $tag['title'],
							'key' => $tag['id_hotel_tag'],
							'count' => 1
						);
						$_filters_special_tags[] = $tag['id_hotel_tag'];
					}else{
						foreach($_filters['special_tags'] as $k => $v){
							if($v['key'] == $tag['id_hotel_tag']){
								$_filters['special_tags'][$k]['count']++;
								break;
							}
						}
					}
				}
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

				if($city_info['id_zone'] > 0 && $_is_country){
					if(!in_array($city_info['id_zone'], $_zones_hotels)){
						$zone_info = get_zone_by_id($city_info['id_zone']);
						$_zones_hotels[] = $zone_info['id_zone'];
						$_filters['zones'][$zone_info['id_zone']]['name'] = $zone_info['title'];
					}
					$_filters['zones'][$zone_info['id_zone']]['count']++;

					$item['id_zone'] = $zone_info['id_zone'];
				}
			}

		}

		unset($item);
	}

	/*
	if($is_ro && !$_is_hotel_tag_link && !$_is_hotel_group_tag_link){
		list($special_tags, $count) = get_posts(array(
			'table' => 'hotel_tag',
			'limit' => -1,
			'extra_where' => '
				AND id_hotel_tag IN (
					SELECT hotel_grila.id_hotel_tag FROM hotel_grila
					JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
					WHERE
						hotel_grila.id_hotel IN ('.implode(",", $_hotels_ids_filters).') AND
						-- hotel_grila.id_hotel IN (SELECT id_hotel FROM hotel_minprice GROUP BY id_hotel) AND
						hotel_grila.description != "" AND
						hotel_grila.description IS NOT NULL AND
						hotel_grila.date_tab_from <= NOW() AND
						hotel_grila.date_tab_to >= NOW()
				)
			',
			'order' => 'title ASC',
		));

		foreach($special_tags as $tag){
			if(!in_array($tag['id_hotel_tag'], $_filters_special_tags)){
				$_filters['special_tags'][] = array(
					'name' => $tag['title'],
					'key' => $tag['id_hotel_tag'],
					'count' => 1
				);
				$_filters_special_tags[] = $tag['id_hotel_tag'];
			}else{
				foreach($_filters['special_tags'] as $k => $v){
					if($v['key'] == $tag['id_hotel_tag']){
						$_filters['special_tags'][$k]['count']++;
						break;
					}
				}
			}
		}
	}
	*/

	cache_set('tourism-list-items-'.$hash_for_cache, $_items, 60*60);
	cache_set('tourism-list-filters-'.$hash_for_cache, $_filters, 60*60);
	cache_set('tourism-list-cities-hotels-'.$hash_for_cache, $_cities_hotels, 60*60);
	cache_set('tourism-list-filter-meals-'.$hash_for_cache, $_filters_meals, 60*60);
}

if($_is_category && !$_country){
	foreach($_items as $item){
		if($item['id_country']){
			$_country = get_country_by_id($item['id_country']);
			break;
		}
	}
}




$currency = "EUR";
if($is_ro || $_country['id_country'] == 126){
	$currency = "RON";
}
$currency_symbol = $_currency_symbol[$currency];


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

if(isset($_GET['st'])){
	$tmp_st = explode(',', $_GET['st']);
	foreach($tmp_st as $st){
		$_active_filters['special_tags'][] = $st;
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

if(isset($_GET['z'])){
	$tmp_z = explode(',', $_GET['z']);
	foreach($tmp_z as $z){
		$_active_filters['zones'][] = $z;
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
							'id' => $meal_filter['id_hotel_filters_meal_group']
						);
					}
					$_special_meal_filters_grouped[$meal_filter['id_hotel_filters_meal_group']][] = $_filters['meals'][$k];
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

// special tags filter links
// if($is_ro && !$_is_hotel_tag_link && !$_is_hotel_group_tag_link){
if($is_ro){
	foreach($_filters['special_tags'] as $k => &$v){
		$v['add-url'] = get_offer_filter_link($_active_filters, 'special_tags', $v['key']);
		$v['remove-url'] = remove_offer_filter_link($_active_filters, 'special_tags', $v['key']);
		unset($v);
	}
	uasort($_filters['special_tags'], function($a, $b){
		return strcasecmp($a['name'], $b['name']);
	});
}

// facilities filter links
foreach($_filters['facilities'] as $k => &$v){
	$v['add-url'] = get_offer_filter_link($_active_filters, 'facilities', $k);
	$v['remove-url'] = remove_offer_filter_link($_active_filters, 'facilities', $k);
	unset($v);
}
ksort($_filters['facilities']);

// cities filter links
if(!$_is_city && $_cities_hotels){
	foreach($_filters['cities'] as $k => &$v){
		$v['add-url'] = get_offer_filter_link($_active_filters, 'cities', $k);
		$v['remove-url'] = remove_offer_filter_link($_active_filters, 'cities', $k);
		unset($v);
	}
	uasort($_filters['cities'], function($a, $b){
		return strcasecmp($a['name'], $b['name']);
	});
}

// zones filter links
if($_is_country && $_zones_hotels){
	foreach($_filters['zones'] as $k => &$v){
		$v['add-url'] = get_offer_filter_link($_active_filters, 'zones', $k);
		$v['remove-url'] = remove_offer_filter_link($_active_filters, 'zones', $k);
		unset($v);
	}
	uasort($_filters['zones'], function($a, $b){
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

	// special tags
	if($_active_filters['special_tags']){
		$found = false;
		foreach($_active_filters['special_tags'] as $z){
			if(in_array($z, $item['hotel_tags'])) $found = true;
		}
		if(!$found) unset($_items[$k]);
	}

	// cities
	if($_active_filters['cities']){
		$found = false;
		foreach($_active_filters['cities'] as $ct){
			if($item['id_city'] == $ct) $found = true;
		}
		if(!$found) unset($_items[$k]);
	}

	// zones
	if($_active_filters['zones']){
		$found = false;
		foreach($_active_filters['zones'] as $z){
			if($item['id_zone'] == $z) $found = true;
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

$_new_count_items = count($_items);


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
		});
	}break;
}


// cut and show by pagination
$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
$_count_items_filters = count($_items);
$_nr_pages = ceil(count($_items)/$_ipp);
$_items = array_slice($_items, $offset, $_ipp);


if(!$is_ro){ // && !$_is_category
	// && !$_is_category - scos 2 mai 2018
	// && !$_is_category - pus inapoi pe 24 mai ca nu merge https://www.paralela45.ro/sejururi/rusalii-bulgaria/ - din cauza sidebar-ului
	// && !$_is_category - scos din nou pe 2 oct ca nu merge selectorul de destinatie pe categorii aici : https://www.paralela45.ro/sejururi/litoral-bulgaria/

	// sidebar values
	list($cats_sidebar, $count) = get_posts(array(
		'table' => 'category',
		'limit' => -1,
		'extra_where' => ' AND (
								id_category IN (
									SELECT id_category FROM category_to_city WHERE id_city IN (
											SELECT id_city FROM city WHERE home_tourism = 1 AND '.db_is_active('', 'city').' '.($_country['id_country'] != "" ? 'AND id_country = '.$_country['id_country'] : '').'
										)
										AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city)
										GROUP BY id_category
								)
								OR id_category IN (
									SELECT id_category FROM category_to_zone WHERE id_zone IN (
											SELECT id_zone FROM zone WHERE home_tourism = 1 AND '.db_is_active('', 'zone').' '.($_country['id_country'] != "" ? 'AND id_country = '.$_country['id_country'] : '').'
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

	$_cats_used_sidebar = array(0);
	foreach($cats_sidebar as $cat){
		$destination_sidebar[] = array(
			'id' => generate_name($cat['title']),//route('tourism', $cat['title']),
			'title' => $cat['title']
		);

		$_cats_used_sidebar[] = $cat['id_category'];
	}

	$_zones_used_sidebar = array(0);
	list($zones_sidebar, $count) = get_posts(array(
		'table' => 'zone',
		'limit' => -1,
		'home_tourism' => 1,
		'id_country' => $_country['id_country'],
		'extra_where' => '
			'.(count($_cats_used_sidebar) > 1 ? 'AND id_zone NOT IN (SELECT id_zone FROM category_to_zone WHERE id_category IN ('.implode(',', $_cats_used_sidebar).') GROUP BY id_zone)' : '').'
			AND id_zone IN (
				SELECT id_zone FROM city WHERE id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
				)
			)
		'
	));

	foreach($zones_sidebar as $zone){
		$destination_sidebar[] = array(
			'id' => generate_name($zone['title']),//route('tourism', $zone['title']),
			'title' => $zone['title']
		);

		$_zones_used_sidebar[] = $zone['id_zone'];
	}

	list($cities_sidebar, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'home_tourism' => 1,
		'id_country' => $_country['id_country'],
		'extra_where' => ' '.(count($_cats_used_sidebar) > 1 ? 'AND id_city NOT IN (SELECT id_city FROM category_to_city WHERE id_category IN ('.implode(',', $_cats_used_sidebar).') GROUP BY id_city)' : '').'
						   '.(count($_zones_used_sidebar) > 1 ? 'AND (id_zone NOT IN ('.implode(',', $_zones_used_sidebar).') OR id_zone IS NULL)' : '').'
						   AND id_city IN (
								SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
							)
						 '
	));

	foreach($cities_sidebar as $city){
		$destination_sidebar[] = array(
			'id' => generate_name($city['title']),//route('tourism', $city['title']),
			'title' => $city['title']
		);
	}

	usort($destination_sidebar, function ($a, $b) {
		return strcmp($a["title"], $b["title"]);
	});

	foreach($destination_sidebar as $k => $item){
		$_destinations_sidebar[$k]['id'] = $item['id'];
		$_destinations_sidebar[$k]['text'] = $item['title'];
	}

}


if($_cities_hotels){
	foreach($_cities_hotels as $city){
		$item = get_city_by_id($city);
		$_cities_sidebar[] = array(
			'id' => $item['id_city'],
			'text' => $item['title']
		);
	}

	usort($_cities_sidebar, function ($a, $b) {
		return strcmp($a["text"], $b["text"]);
	});
}


if($is_ro){
	$_section = "tourism-ro";
	$_active_tab = "tourism-ro";

	// seo
	$_meta_title = $_title;
	$_meta_description = "";
	$_meta_keywords = "";
	$_no_index = false;
}else{
	$_section = "tourism";
	$_active_tab = "tourism";

	// seo
	$_meta_title = $_title;
	$_meta_description = "";
	$_meta_keywords = "";
	$_no_index = false;
}
