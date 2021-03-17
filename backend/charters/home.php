<?

if(isset($_POST['advanced'])){

	$_valid = true;

	// destination
	$_rules['chartere-tara'] = 'trim|required|numeric';
	$_rules['chartere-destinatia'] = 'trim|required|numeric';
	$_rules['chartere-oras-plecare'] = 'trim|required|numeric';

	// date
	$_rules['chartere-check-in'] = 'trim|required|date';
	$_rules['chartere-check-out'] = 'trim|required|date';

	$_rules['chartere-camere'] = 'trim|required|numeric|min-1|max-3';

	for($i=1; $i<=$_POST['chartere-camere']; $i++){
		$_rules['chartere-adulti'.$i] = 'trim|required|numeric|min-1|max-5';
		$_rules['chartere-copii'.$i] = 'trim|required|numeric|min-0|max-3';
		if($_POST['chartere-copii'.$i] > 0){
			for($j=1; $j<=$_POST['chartere-copii'.$i]; $j++){
				$_rules['chartere-copii-varste'.$i.'-'.$j] = 'trim|required|numeric|min-0|max-17';
			}
		}
	}

	$_custom_error_messages = array();
	for($i=1; $i<=$_POST['chartere-camere']; $i++){
		if($_POST['chartere-copii'.$i] > 0){
			for($j=1; $j<=$_POST['chartere-copii'.$i]; $j++){
				$_custom_error_messages['chartere-copii-varste'.$i.'-'.$j] = array(
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
		for($i=1; $i<=$_POST['chartere-camere']; $i++){
			$room_data[$i-1] = array(
				'adult' => $_form['chartere-adulti'.$i],
				'child' => $_form['chartere-copii'.$i]
			);
			if($_form['chartere-copii'.$i] > 0){
				for($j=1; $j<=$_form['chartere-copii'.$i]; $j++){
					$room_data[$i-1]['child_age'][$j-1] = $_form['chartere-copii-varste'.$i.'-'.$j];
				}
			}
		}

		$id_search = db_query('
			INSERT INTO charter_search
			SET id_country = ?, id_zone = ?, id_city_from = ?, date_from = ?, date_to = ?, rooms = ?, room_data = ?, status = "init"',
			$_form['chartere-tara'],
			$_form['chartere-destinatia'],
			$_form['chartere-oras-plecare'],
			date('Y-m-d', strtotime($_form['chartere-check-in'])),
			date('Y-m-d', strtotime($_form['chartere-check-out'])),
			$_form['chartere-camere'],
			json_encode($room_data)
		);

		go_away(route('charters-loading', $id_search));

	}

	$country = get_country_by_id($_form['chartere-tara']);

	// get cities for sidebar search
	list($_zones_check_sidebar, $count) = get_posts(array(
		'table' => 'zone',
		'limit' => -1,
		'id_country' => $country['id_country'],
		'extra_where' => '
			AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city) GROUP BY id_zone)
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
		'id_country' => $country['id_country'],
		'extra_where' => '
			AND id_zone NOT IN ('.implode(',', $_zones_used).')
			AND id_city IN (SELECT id_city FROM charter_destination WHERE id_country = '.$country['id_country'].' GROUP BY id_city)
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

	if($_form['chartere-destinatia'] < 55){
		$type = "zone";
		$zone = get_zone_by_id($_form['chartere-destinatia']);
	}else{
		$type = "city";
		$city = get_city_by_id($_form['chartere-destinatia']);
	}

	if($type == "zone"){
		$sql_city = ' id_city IN (SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].') ';
	}elseif($type == "city"){
		$sql_city = ' id_city = '.$city['id_city'].' ';
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
}











$_text = get_post(array(
	'table' => 'page',
	'id_page' => 2
));




$_destinations_from = cache_get('charters__destinations_from');

if(!$_destinations_from){
	list($_destinations_from, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'images' => true,
        'id_country' => 126,
		'extra_where' => ' AND id_city IN (SELECT id_city_from FROM charter_destination GROUP BY id_city_from)',
		//'order' => 'title ASC'
	));

	foreach($_destinations_from as &$dest_from){

		list($_countries, $count) = get_posts(array(
			'table' => 'country',
			'limit' => -1,
			'home_charter' => 1,
			'extra_where' => ' AND id_country IN (SELECT id_country FROM charter_destination WHERE id_city_from = '.$dest_from['id_city'].' GROUP BY id_country)',
			//'order' => 'title ASC'
		));

		$_zones_used = array(0);

		foreach($_countries as &$country){
			list($_zones, $count) = get_posts(array(
				'table' => 'zone',
				'limit' => -1,
				'home_charter' => 1,
				'extra_where' => ' AND id_zone IN (SELECT id_zone FROM city WHERE id_city IN (SELECT id_city FROM charter_destination WHERE id_city_from = '.$dest_from['id_city'].' AND id_country = '.$country['id_country'].' GROUP BY id_city) GROUP BY id_zone)',
				'order' => 'title ASC'
			));

			foreach($_zones as &$zone){
				$count = db_row('
					SELECT COUNT(DISTINCT id_hotel) AS nr
					FROM charter_minprice
					WHERE
						date_from > "'.date('Y-m-d').'"
						AND id_city_from = '.$dest_from['id_city'].'
						AND (
							id_hotel IN (
								SELECT id_hotel FROM hotel WHERE id_city IN ( SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].') AND '.db_is_active('', 'hotel').'
							)
							-- OR
							-- id_city IN ( SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].')
						)
				');

				if($count['nr'] > 0){
                    $_zones_used[] = $zone['id_zone'];

					list($_categories, $count_cats) = get_posts(array(
						'table' => 'charter_category',
						'id_zone' => $zone['id_zone'],
						'id_city_from' => $dest_from['id_city']
					));

                    $charter_dates_zone[$zone['id_zone']] = array();

					foreach($_categories as $category){
						$dates = db_query('SELECT * FROM charter_category_date WHERE id_charter_category = ?', $category['id_charter_category']);
						if($dates){
							$charter_dates = array();
							foreach($dates as $date){
								$charter_dates[] = $date['dates'];
                                $charter_dates_zone[$zone['id_zone']][] = $date['dates'];
							}

							$count_cat = db_row('
								SELECT COUNT(DISTINCT id_hotel) AS nr
								FROM charter_minprice
								WHERE
									date_from > "'.date('Y-m-d').'"
									AND date_from IN ("'.implode('","', $charter_dates).'")
									AND id_city_from = '.$dest_from['id_city'].'
									AND id_hotel IN (
										SELECT id_hotel FROM hotel WHERE id_city IN ( SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].') AND '.db_is_active('', 'hotel').'
									)
							');

							if($count_cat['nr'] > 0){
								$category['url'] = get_charter_link($category, $category['title'], $dest_from['title']);
								$category['count'] = $count_cat['nr'];
								$country['cities'][] = $category;
							}
						}
					}

                    if($_categories && $charter_dates_zone[$zone['id_zone']]){
                        $count = db_row('
                            SELECT COUNT(DISTINCT id_hotel) AS nr
                            FROM charter_minprice
                            WHERE
                                date_from > "'.date('Y-m-d').'"
                                AND date_from NOT IN ("'.implode('","', $charter_dates_zone[$zone['id_zone']]).'")
                                AND id_city_from = '.$dest_from['id_city'].'
                                AND id_hotel IN (
                                    SELECT id_hotel FROM hotel WHERE id_city IN ( SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].') AND '.db_is_active('', 'hotel').'
                                )
                        ');
                    }

                    if($count['nr'] > 0){
    					$zone['url'] = get_charter_link($zone, $zone['title'], $dest_from['title']);
    					$zone['count'] = $count['nr'];
    					$country['cities'][] = $zone;
                    }
				}

				unset($zone);
			}

			unset($country);
		}

		foreach($_countries as $k => &$country){
			list($_cities, $count) = get_posts(array(
				'table' => 'city',
				'limit' => -1,
				'home_charter' => 1,
				'extra_where' => ' AND id_zone NOT IN ('.implode(',', $_zones_used).') AND id_city IN (SELECT id_city FROM charter_destination WHERE id_city_from = '.$dest_from['id_city'].' AND id_country = '.$country['id_country'].' GROUP BY id_city)',
				'order' => 'title ASC'
			));

			foreach($_cities as &$city){
				$count = db_row('
					SELECT COUNT(DISTINCT id_hotel) AS nr
					FROM charter_minprice
					WHERE
						date_from > "'.date('Y-m-d').'"
						AND id_city_from = '.$dest_from['id_city'].'
						AND id_hotel IN (
							SELECT id_hotel FROM hotel WHERE id_city = '.$city['id_city'].' AND '.db_is_active('', 'hotel').'
						)
				');

				if($count['nr'] > 0){
					$city['url'] = get_charter_link($city, $city['title'], $dest_from['title']);
					$city['count'] = $count['nr'];
					$country['cities'][] = $city;
				}

				unset($city);
			}

			usort($country['cities'], function ($a, $b) {
				return strcmp($a["title"], $b["title"]);
			});

			$count = db_row('
				SELECT COUNT(DISTINCT id_hotel) AS nr
				FROM charter_minprice
				WHERE
					date_from > "'.date('Y-m-d').'"
					AND id_city_from = '.$dest_from['id_city'].'
					AND id_hotel IN (
						SELECT id_hotel FROM hotel WHERE id_country = '.$country['id_country'].' AND '.db_is_active('', 'hotel').'
					)
			');

			if($count['nr'] == 0){
				unset($_countries[$k]);
			}else{
				$country['count'] = $count['nr'];
			}

			usort($country['cities'], function($a, $b){
				return strcasecmp($a['title_homepage'] != "" ? $a['title_homepage'] : $a['title'], $b['title_homepage'] != "" ? $b['title_homepage'] : $b['title']);
			});

			unset($country);
		}

		$dest_from['countries'] = $_countries;

		unset($dest_from);
	}

	cache_set('charters__destinations_from', $_destinations_from, 60*60);
}

foreach($_destinations_from as &$item){
	$item['countries'] = array_values($item['countries']);
	unset($item);
}

$_section = "charters";
$_active_tab = "charters";

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
