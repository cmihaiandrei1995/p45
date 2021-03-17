<?

$_ipp = $_config['paging']['ipp']['circuits'];

$_title = "Circuite";

if($_params['id']){

	$_search = db_row('SELECT * FROM circuit_search WHERE id_circuit_search = ?', $_params['id']);
	if(!$_search) go_away(route('circuits-home'));

	$id_search = $_search['id_circuit_search'];

	$results = cache_get('circuit_search_'.$id_search);
	if(!$results){
		go_away(route('circuits-loading', $id_search));
	}else{

		$search_items = array();
		if($results['Circuit'][0]){
			$search_items = $results['Circuit'];
		}else{
			$search_items[0] = $results['Circuit'];
		}

		foreach($search_items as $item){
			$code = $item['CircuitId']['value'];
			$circuit = get_circuit_by_eurosite_code($code);
			if($circuit){
				$_circuit_ids[] = $circuit['id_circuit'];
			}
		}
	}

	if($_circuit_ids){
		$_is_search = true;
	}

}

if($_params['country']){

	$_continent = get_continent_by_slug($_params['continent']);
	if(!$_continent) go_away(route('circuits-home'));

	$_country = get_country_by_slug($_params['country']);
	if(!$_country) go_away(route('circuits-home'));

	$country_sql = 'id_country = '.$_country['id_country'];
	$continent_sql = ' id_country IN (SELECT id_country FROM country WHERE id_continent = '.$_continent['id_continent'].')';

	$imgs = get_images('country', $_country['id_country']);
	if($imgs){
		$_header_img = $imgs[0]['big'];
	}else{
		$_header_img = $_base_static."img/header_circuite.jpg";
	}

	$_title .= " ".$_country['title'];

}elseif($_params['continent']){

	$_continent = get_continent_by_slug($_params['continent']);
	if(!$_continent) go_away(route('circuits-home'));

	$country_sql = ' id_country IN (SELECT id_country FROM country WHERE id_continent = '.$_continent['id_continent'].')';
	$continent_sql = ' id_country IN (SELECT id_country FROM country WHERE id_continent = '.$_continent['id_continent'].')';

	$_header_img = $_base_static."img/header_circuite.jpg";

	$_title .= " ".$_continent['title'];

}elseif($_params['cat']){

	$_category = get_circuit_category_by_slug($_params['cat']);
	if(!$_category) go_away(route('circuits-home'));

	$category_sql = 'id_circuit IN (SELECT id_circuit FROM circuit_to_label WHERE id_circuit_label = '.$_category['id_circuit_label'].')';

	$_header_img = $_base_static."img/header_circuite.jpg";

	$_title .= " ".$_category['title'];

}else{

	$_header_img = $_base_static."img/header_circuite.jpg";

}

$month_sql = '';
if(isset($_GET['m']) && isset($_GET['y'])){
	$month_sql = ' AND id_circuit IN (SELECT id_circuit FROM circuit_date_price WHERE DATE_FORMAT(dep_date, "%c-%Y") = "'.intval($_GET['m'])."-".intval($_GET['y']).'")';
}

$final_sql = $category_sql.$country_sql.$month_sql;
if($final_sql != ""){
	$final_sql = $final_sql.' AND '.db_is_active('', 'city');
}else{
	$final_sql = db_is_active('', 'city');
}

$_query = array(
	'table' => 'circuit',
    'extra_where' => 'AND id_circuit IN (SELECT id_circuit FROM circuit_to_city WHERE id_city IN (SELECT id_city FROM city WHERE '.$final_sql.'))',
	'limit' => -1,
	'images' => true
);

$_query_related = array(
	'table' => 'circuit',
    'extra_where' => 'AND id_circuit IN (SELECT id_circuit FROM circuit_to_city WHERE id_city IN (SELECT id_city FROM city WHERE '.$final_sql.'))',
	'limit' => 5,
	'order' => 'rand()',
	'images' => true
);

if($_params['type'] == "bus"){
	$_query['type'] = "bus";
	$_query_related['type'] = "bus";

	$_is_bus = true;
	$_title .= " cu autocarul";
}
if($_params['type'] == "plane"){
	$_query['type'] = "plane";
	$_query_related['type'] = "plane";

	$_is_plane = true;
	$_title .= " cu avionul";
}

if($_params['from'] != ""){
	$_city_from = get_city_by_slug($_params['from']);
	if($_city_from){
		$_query['extra_where'] .= ' AND id_circuit IN (SELECT id_circuit FROM circuit_city_from WHERE id_city = '.$_city_from['id_city'].' GROUP BY id_circuit)';
		$_query_related['extra_where'] .= ' AND id_circuit IN (SELECT id_circuit FROM circuit_city_from WHERE id_city = '.$_city_from['id_city'].' GROUP BY id_circuit)';

		$_title .= " din ".$_city_from['title'];
	}else{
		go_away(route('circuits-home'));
	}
}

if(isset($_GET['m']) && isset($_GET['y'])){
	$_title .= " - ".$_months[intval($_GET['m'])]." ".intval($_GET['y']);
}

if($_is_search){
	$_query['extra_where'] .= " AND id_circuit IN (".implode(",", $_circuit_ids).")";
}

// sidebar form values

$tranport_sql = "";
if($_is_plane){
	$tranport_sql = " AND type = 'plane'";
}elseif($_is_bus){
	$tranport_sql = " AND type = 'bus'";
}

$country_sql = "";
if($_country){
	$country_sql = ' AND id_country = '.$_country['id_country'];
}elseif(isset($_GET['continent'])){
	$country_sql = ' AND id_country IN (SELECT id_country FROM country WHERE id_continent = '.$_continent['id_continent'].')';
}

$from_sql = "";
if($_city_from){
	$from_sql = "AND id_circuit IN (SELECT id_circuit FROM circuit_city_from WHERE id_city = ".$_city_from['id_city'].")";
}

list($_circuit_countries_sidebar, $count) = get_posts(array(
	'table' => 'country',
	'limit' => -1,
	'order' => 'title ASC',
	'id_continent' => $_continent['id_continent'],
	'extra_where' => 'AND id_country IN (
						SELECT id_country FROM city WHERE id_city IN (
							SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
								SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
							) GROUP BY id_city
						) AND '.db_is_active('', 'city').'
					)'
));

$_circuit_dates_sidebar = db_query('
	SELECT DATE_FORMAT(dep_date, "%c") AS month, DATE_FORMAT(dep_date, "%Y") AS year FROM circuit_date_price
	WHERE id_circuit IN (
			SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (
				SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
					SELECT id_city FROM city WHERE '.db_is_active('', 'city').' '.$country_sql.'
				) AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
			)
		)
		'.$from_sql.'
		AND dep_date > NOW()
	GROUP BY DATE_FORMAT(dep_date, "%c-%Y")
	ORDER BY dep_date
');

$_cities_from_sidebar = db_query('
	SELECT * FROM city
	WHERE id_city IN (
		SELECT id_city FROM circuit_city_from WHERE id_circuit IN (
			SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (
				SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
					SELECT id_city FROM city WHERE '.db_is_active('', 'city').' '.$country_sql.'
				) AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
			)
		)
	)
');









// get items
list($_items, $_count_items) = get_posts($_query);


// get some related if needed
if($_count_items < 5){
	foreach($_items as $item){
		$_no_use_ids[] = $item['id_circuit'];
	}

	if(count($_no_use_ids)){
		$_query_related['extra_where'] .= " AND id_circuit NOT IN (".implode(",", $_no_use_ids).")";
	}

	list($_items_related, $_count_items_related) = get_posts($_query_related);

	foreach($_items_related as &$item){
		$item = circuit_prepare_info($item);
		unset($item);
	}

	if($_params['country']){
		$_title_related = "Alte circuite din ".$_country['title'];
	}else{
		$_title_related = "Alte circuite din ".$_continent['title'];
	}
}





// filters

$_filters['price']['min'] = 99999;
$_filters['price']['max'] = 0;

// browse items
foreach($_items as &$item){
	if($_is_search){
		$item = circuit_prepare_info_from_search($item, $_search, $search_items);
	}else{
		$item = circuit_prepare_info($item);
	}

	unset($item);
}

foreach($_items as &$item){
	if(!$item['variants']){
		$_new_items[] = $item;
	}else{
		$item_url = $item['url'];
		foreach($item['variants'] as $date => $variant){
			$item['date'] = $date;
			//$item['price_old'] = "";
			$item['price'] = $variant; // Problema acelasi circuit cu mai multe date, dar cu preturi diferite, suprascriem pretul pe varianta asta

			$item['url'] = $item_url."?d=".$date."&s=".$id_search;

			$_new_items[] = $item;
		}
	}
}
$_items = $_new_items;


// remove the ones without the price
foreach($_items as $k => $item){
	if(!($item['price'] > 0)){
		unset($_items[$k]);
	}
}

foreach($_items as &$item){
	if($item['price'] > $_filters['price']['max']) $_filters['price']['max'] = $item['price'];
	if($item['price'] < $_filters['price']['min']) $_filters['price']['min'] = $item['price'];

	foreach($item['categories'] as $cat){
		//$_filters['category'][$cat['id_circuit_label']] = $cat;
		$_filters['category'][$cat['id_circuit_label']]['id_circuit_label'] = $cat['id_circuit_label'];
		$_filters['category'][$cat['id_circuit_label']]['title'] = $cat['title'];
		$_filters['category'][$cat['id_circuit_label']]['count']++;
	}

	foreach($item['special'] as $cat){
		//$_filters['special'][$cat['id_circuit_label']] = $cat;
		$_filters['special'][$cat['id_circuit_label']]['id_circuit_label'] = $cat['id_circuit_label'];
		$_filters['special'][$cat['id_circuit_label']]['title'] = $cat['title'];
		$_filters['special'][$cat['id_circuit_label']]['count']++;
	}

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

	unset($item);
}





// check active filters
if(isset($_GET['pr'])){
	$tmp_price = explode('-', $_GET['pr']);

	$_active_filters['price']['min'] = $tmp_price[0];
	$_active_filters['price']['max'] = $tmp_price[1];
}

if(isset($_GET['c'])){
	$tmp_cat = explode(',', $_GET['c']);
	foreach($tmp_cat as $cat){
		if(in_array($cat, array_keys($_filters['category']))){
			$_active_filters['cat'][] = $cat;
		}
	}
}

if(isset($_GET['sp'])){
	$tmp_cat = explode(',', $_GET['sp']);
	foreach($tmp_cat as $cat){
		if(in_array($cat, array_keys($_filters['special']))){
			$_active_filters['special'][] = $cat;
		}
	}
}

if(isset($_GET['of'])){
	$tmp_of = explode(',', $_GET['of']);
	foreach($tmp_of as $of){
		if(in_array($of, array(1, 2, 3))){
			$_active_filters['offer'][] = $of;
		}
	}
}

// final count
$_count_items = count($_items);

// price filter links
$_price_filter_link = get_offer_filter_link($_active_filters, 'price', '');

// cat link
foreach($_filters['category'] as &$item){
	$item['add-url'] = get_offer_filter_link($_active_filters, 'cat', $item['id_circuit_label']);
	$item['remove-url'] = remove_offer_filter_link($_active_filters, 'cat', $item['id_circuit_label']);
	unset($item);
}

// special link
foreach($_filters['special'] as &$item){
	$item['add-url'] = get_offer_filter_link($_active_filters, 'special', $item['id_circuit_label']);
	$item['remove-url'] = remove_offer_filter_link($_active_filters, 'special', $item['id_circuit_label']);
	unset($item);
}

// special offers link
$_filters['special_offer']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 1);
$_filters['special_offer']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 1);

$_filters['last_minute']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 2);
$_filters['last_minute']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 2);

$_filters['early_booking']['add-url'] = get_offer_filter_link($_active_filters, 'offer', 3);
$_filters['early_booking']['remove-url'] = remove_offer_filter_link($_active_filters, 'offer', 3);


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

	// categories
	if($_active_filters['cat']){
		if($item['categories']){
			$cats = array();
			foreach($item['categories'] as $cat){
				$cats[] = $cat['id_circuit_label'];
			}

			$found = false;
			foreach($_active_filters['cat'] as $filter_cat){
				if(in_array($filter_cat, $cats)){
					$found = true;
					break;
				}
			}

			if(!$found){
				unset($_items[$k]);
			}
		}else{
			unset($_items[$k]);
		}
	}

	// special categories
	if($_active_filters['special']){
		if($item['special']){
			$cats = array();
			foreach($item['special'] as $cat){
				$cats[] = $cat['id_circuit_label'];
			}

			$found = false;
			foreach($_active_filters['special'] as $filter_cat){
				if(in_array($filter_cat, $cats)){
					$found = true;
					break;
				}
			}

			if(!$found){
				unset($_items[$k]);
			}
		}else{
			unset($_items[$k]);
		}
	}

}

$_new_count_items = count($_items);



// sort items
switch($_GET['srt']){
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
	case 'na':{
		usort($_items, function($a, $b){
			if($a['days'] == $b['days']){
		        return 0;
		    }
		    return ($a['days'] < $b['days']) ? -1 : 1;
		});
	}break;
	case 'nd':{
		usort($_items, function($a, $b){
			if($a['days'] == $b['days']){
		        return 0;
		    }
		    return ($a['days'] > $b['days']) ? -1 : 1;
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
			global $_is_search;
			if($a['price'] == $b['price']){
				if($_is_search){
					return (strtotime($a['date']) < strtotime($b['date'])) ? -1 : 1;
				}else{
					return 0;
				}
		    }
		    return ($a['price'] < $b['price']) ? -1 : 1;
		});
	}break;
}


// cut and show by pagination
$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
$_count_items_filters = count($_items);
$_nr_pages = ceil(count($_items)/$_ipp);
$_items = array_slice($_items, $offset, $_ipp);



$_section = "circuits";
$_active_tab = "circuits";

// seo
$_meta_title = $_title;
$_meta_description = "";
$_meta_keywords = "";
$_no_index = false;
