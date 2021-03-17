<?

if(isset($_POST['advanced'])){

	$_valid = true;

	// destination
	$_rules['t-individual-tara'] = 'trim|required|numeric';
	$_rules['t-individual-destinatia'] = 'trim|required';
	$_rules['t-individual-oras'] = 'trim|required|numeric';

	// date
	$_rules['t-individual-check-in'] = 'trim|required|date';
	$_rules['t-individual-check-out'] = 'trim|required|date';

	$_rules['t-individual-camere'] = 'trim|required|numeric|min-1|max-3';

	for($i=1; $i<=$_POST['t-individual-camere']; $i++){
		$_rules['t-individual-adulti'.$i] = 'trim|required|numeric|min-1|max-5';
		$_rules['t-individual-copii'.$i] = 'trim|required|numeric|min-0|max-3';
		if($_POST['t-individual-copii'.$i] > 0){
			for($j=1; $j<=$_POST['t-individual-copii'.$i]; $j++){
				$_rules['t-individual-copii-varste'.$i.'-'.$j] = 'trim|required|numeric|min-0|max-17';
			}
		}
	}

	$_custom_error_messages = array();
	for($i=1; $i<=$_POST['t-individual-camere']; $i++){
		if($_POST['t-individual-copii'.$i] > 0){
			for($j=1; $j<=$_POST['t-individual-copii'.$i]; $j++){
				$_custom_error_messages['t-individual-copii-varste'.$i.'-'.$j] = array(
					'required' => 'Alegeti varsta!'
				);
			}
		}
	}

	// validate
	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	if($_valid){

		$room_data = array();
		for($i=1; $i<=$_POST['t-individual-camere']; $i++){
			$room_data[$i-1] = array(
				'adult' => $_form['t-individual-adulti'.$i],
				'child' => $_form['t-individual-copii'.$i]
			);
			if($_form['t-individual-copii'.$i] > 0){
				for($j=1; $j<=$_form['t-individual-copii'.$i]; $j++){
					$room_data[$i-1]['child_age'][$j-1] = $_form['t-individual-copii-varste'.$i.'-'.$j];
				}
			}
		}

		$id_search = db_query('
			INSERT INTO hotel_search
			SET id_country = ?, destination = ?, id_city = ?, date_from = ?, date_to = ?, rooms = ?, room_data = ?, status = "init", is_ro = 0',
			$_form['t-individual-tara'],
			$_form['t-individual-destinatia'],
			$_form['t-individual-oras'],
			date('Y-m-d', strtotime($_form['t-individual-check-in'])),
			date('Y-m-d', strtotime($_form['t-individual-check-out'])),
			$_form['t-individual-camere'],
			json_encode($room_data)
		);

		go_away(route('tourism-loading', $id_search));

	}

	$country = get_country_by_id($_form['t-individual-tara']);

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
		$destination_sidebar[] = array(
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
		$destination_sidebar[] = array(
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
						   '.(count($_zones_used) > 1 ? 'AND id_zone NOT IN ('.implode(',', $_zones_used).')' : '').'
						   AND id_city IN (
								SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
							)
						 '
	));

	foreach($cities as $city){
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




	$_category = get_category_by_slug($_form['t-individual-destinatia']);
	if(!$_category){
		$_zone = get_zone_by_slug($_form['t-individual-destinatia']);
		if(!$_zone){
			$_city = get_city_by_slug($_form['t-individual-destinatia']);
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
		$_cities_sidebar[$k]['id'] = $item['id'];
		$_cities_sidebar[$k]['text'] = $item['title'];
	}


}










$_text = get_post(array(
	'table' => 'page',
	'id_page' => 3
));


$_countries = cache_get('tourism_individual__countries');
if(!$_countries){
	list($_countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'home_tourism' => 1,
		'extra_where' => ' AND (
								id_country IN (SELECT id_country FROM city WHERE id_city IN (SELECT id_city FROM category_to_city GROUP BY id_city) GROUP BY id_country)
								OR id_country IN (SELECT id_country FROM zone WHERE id_zone IN (SELECT id_zone FROM category_to_zone GROUP BY id_zone) GROUP BY id_country)
								OR id_country IN (SELECT id_country FROM city WHERE home_tourism = 1 AND '.db_is_active('', 'city').')
								OR id_country IN (SELECT id_country FROM zone WHERE home_tourism = 1 AND '.db_is_active('', 'zone').')
							)
							AND id_country IN (SELECT id_country FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_country)
						',
		//'order' => 'title ASC'
	));

	foreach($_countries as &$country){
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

		$country['url'] = route('tourism', $country['title']);

		$cities_used = array(0);

		$_cats_used = array(0);
		foreach($cats as &$cat){
			$cat['url'] = route('tourism', $cat['title']);
			$_cats_used[] = $cat['id_category'];

			list($cities_for_cat, $count) = get_posts(array(
				'table' => 'city',
				'limit' => -1,
				'home_tourism' => 1,
				'extra_where' => ' AND id_city IN (SELECT id_city FROM category_to_city WHERE id_category = '.$cat['id_category'].')
								   OR id_zone IN (
										SELECT id_zone FROM category_to_zone WHERE  id_category = '.$cat['id_category'].'
									)
								 '
			));
			foreach($cities_for_cat as $city_cat){
				$cities_used[] = $city_cat['id_city'];
			}

			$country['cities'][] = $cat;
			unset($cat);
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

		foreach($zones as &$zone){
			$zone['url'] = route('tourism', $zone['title']);
			$_zones_used[] = $zone['id_zone'];

			list($cities_for_zone, $count) = get_posts(array(
				'table' => 'city',
				'limit' => -1,
				'home_tourism' => 1,
				'id_zone' => $zone['id_zone'],
				'extra_where' => ' AND id_city IN (
										SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_city
									)
								 '
			));
			foreach($cities_for_zone as $city_zone){
				$cities_used[] = $city_zone['id_city'];
			}

			$country['cities'][] = $zone;
			unset($zone);
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

		foreach($cities as &$city){
			$city['url'] = route('tourism', $city['title']);

			$cities_used[] = $city['id_city'];
			$country['cities'][] = $city;
			unset($zone);
		}

		if($country['title'] != "Romania"){
			usort($country['cities'], function ($a, $b) {
				return strcmp($a["title"], $b["title"]);
			});
		}

		$count = db_row('
			SELECT COUNT(DISTINCT id_hotel) AS nr
			FROM hotel_minprice
			WHERE id_hotel IN (
				SELECT id_hotel FROM hotel
					WHERE id_city IN ('.implode(',', $cities_used).')
					'.(count($_zones_used) > 1 ? 'OR id_city IN (SELECT id_city FROM city WHERE id_zone IN ('.implode(',', $_zones_used).') AND id_country = '.$country['id_country'].' AND '.db_is_active('', 'city').')' : '').'
					AND '.db_is_active('', 'hotel').'
			)
		');
		$country['count'] = $count['nr'];

		unset($country);
	}

	foreach($_countries as $k => $country){
		if($country['count'] > 0){
			$country_tmp[] = $country;
		}
	}
	$_countries = $country_tmp;

	cache_set('tourism_individual__countries', $_countries, 60*60);
}

$_section = "tourism";
$_active_tab = "tourism";

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
