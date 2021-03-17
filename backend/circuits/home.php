<?

if(isset($_POST['advanced'])){

	$_valid = true;

	// destination
	$_rules['circuite-continent'] = 'trim|required|numeric';
	$_rules['circuite-tara'] = 'trim|required|numeric';
	$_rules['circuite-luna-plecare'] = 'trim|required';

	$_rules['circuite-bus'] = 'trim';
	$_rules['circuite-airplane'] = 'trim';

	$_rules['circuite-camere'] = 'trim|required|numeric|min-1|max-3';

	for($i=1; $i<=$_POST['circuite-camere']; $i++){
		$_rules['circuite-adulti'.$i] = 'trim|required|numeric|min-1|max-3';
		$_rules['circuite-copii'.$i] = 'trim|required|numeric|min-0|max-1';
		$_rules['circuite-room-type'.$i] = 'trim|required';
		if($_POST['circuite-copii'.$i] > 0){
			$_rules['circuite-copii-varste'.$i] = 'trim|required|numeric|min-0|max-17';
		}
	}

	$_custom_error_messages = array();
	for($i=1; $i<=$_POST['circuite-camere']; $i++){
		if($_POST['circuite-copii'.$i] > 0){
			$_custom_error_messages['circuite-copii-varste'.$i] = array(
				'required' => 'Alegeti varsta!'
			);
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
		for($i=1; $i<=$_POST['circuite-camere']; $i++){
			$room_data[$i-1] = array(
				'adult' => $_form['circuite-adulti'.$i],
				'child' => $_form['circuite-copii'.$i],
				'child_age' => $_form['circuite-copii-varste'.$i],
				'type' => $_form['circuite-room-type'.$i]
			);
		}

		$tmp = explode("-", $_form['circuite-luna-plecare']);

		$id_search = db_query('
			INSERT INTO circuit_search
			SET id_country = ?, id_continent = ?, bus = ?, plane = ?, month = ?, year = ?, rooms = ?, room_data = ?, status = "init"',
			$_form['circuite-tara'],
			$_form['circuite-continent'],
			$_form['circuite-bus'],
			$_form['circuite-airplane'],
			$tmp[0],
			$tmp[1],
			$_form['circuite-camere'],
			json_encode($room_data)
		);

		go_away(route('circuits-loading', $id_search));

	}



	$_continent = get_continent_by_id($_form['circuite-continent']);

	$tranport_sql = "";
	if($_form['circuite-airplane'] && !$_form['circuite-bus']){
		$tranport_sql = " AND type = 'plane'";
	}elseif(!$_form['circuite-airplane'] && $_form['circuite-bus']){
		$tranport_sql = " AND type = 'bus'";
	}

	list($_circuit_countries_header, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'order' => 'title ASC',
		'id_continent' => $_continent['id_continent'],
		'extra_where' => 'AND id_country IN (
							SELECT id_country FROM city WHERE id_city IN (
								SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
									SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.'
								) GROUP BY id_city
							) AND '.db_is_active('', 'city').'
						)'
	));
}



$_text = get_post(array(
	'table' => 'page',
	'id_page' => 5
));

$_text_2 = get_post(array(
	'table' => 'page',
	'id_page' => 6
));

$_cities = cache_get('circuit__cities');
$_cities_count = cache_get('circuit__cities_count');
if(!$_cities && !$_cities_count){
	foreach(array(1, 2) as $city_type){
		foreach(array('plane', 'bus') as $type){
			list($_cities[$city_type][$type], $count) = get_posts(array(
				'table' => 'city',
				'limit' => -1,
				//'order' => 'title ASC',
				'extra_where' => 'AND id_city '.($city_type == 1 ? "IN" : "NOT IN").' ('.implode(',', array_keys($_cities_from_circuits)).') AND id_city IN (SELECT id_city FROM circuit_city_from GROUP BY id_city)'
			));

			foreach($_cities[$city_type][$type] as &$city){

				list($continents, $count) = get_posts(array(
					'table' => 'continent',
					'limit' => -1,
					'extra_where' => 'AND id_continent IN (
										SELECT id_continent FROM country WHERE id_country IN (
											SELECT id_country FROM city WHERE id_city IN (
												SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
													SELECT id_circuit FROM circuit WHERE id_circuit IN (
														SELECT id_circuit FROM circuit_city_from WHERE id_city = '.$city['id_city'].' GROUP BY id_circuit
													) AND '.db_is_active('', 'circuit').' AND type = "'.$type.'"
												) GROUP BY id_city
											) AND '.db_is_active('', 'city').'
										) AND '.db_is_active('', 'country').'
									)'
				));

				foreach($continents as &$continent){

					list($countries, $count) = get_posts(array(
						'table' => 'country',
						'limit' => -1,
						'order' => 'title ASC',
						'id_continent' => $continent['id_continent'],
						'extra_where' => 'AND id_country IN (
											SELECT id_country FROM city WHERE id_city IN (
												SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
													SELECT id_circuit FROM circuit WHERE id_circuit IN (
														SELECT id_circuit FROM circuit_city_from WHERE id_city = '.$city['id_city'].' GROUP BY id_circuit
													) AND '.db_is_active('', 'circuit').' AND type = "'.$type.'"
												) GROUP BY id_city
											) AND '.db_is_active('', 'city').'
										)'
					));

					foreach($countries as &$country){
						$country['url'] = route('circuits-'.$type.'-from', $continent['title'], $country['title'], $city['title']);

						$count = db_row('
							SELECT COUNT(*) AS nr
							FROM circuit
							WHERE id_circuit IN (
									SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
										SELECT id_city FROM city WHERE id_country = '.$country['id_country'].' AND '.db_is_active('', 'city').'
									)
								)
								AND id_circuit IN (
									SELECT id_circuit FROM circuit_city_from WHERE id_city = '.$city['id_city'].' GROUP BY id_circuit
								)
								AND '.db_is_active('', 'circuit').' AND type = "'.$type.'"
						');
						$continent['count'] += $count['nr'];

						unset($country);
					}

					$continent['url'] = route('circuits-cont', $continent['title']);
					$continent['url-plane'] = route('circuits-cont-plane', $continent['title']);
					$continent['url-bus'] = route('circuits-cont-bus', $continent['title']);

					$continent['countries'] = $countries;
					unset($continent);
				}

				$city['continents'] = $continents;
				$_cities_count[$city_type][$type] += count($continents);

				unset($city);
			}
		}
	}

	cache_set('circuit__cities', $_cities, 60*60);
	cache_set('circuit__cities_count', $_cities_count, 60*60);
}


$_months_circuits = cache_get('circuit__month_circuits');
if(!$_months_circuits){
	list($_months_circuits, $_months_count) = get_posts(array(
	    'table' => 'circuit_date_price',
	    'select' => array(
	    	'DATE_FORMAT(`dep_date`, "%M %Y")' => 'date_solution',
	    	'DATE_FORMAT(`dep_date`, "%c")' => 'month',
	    	'DATE_FORMAT(`dep_date`, "%Y")' => 'year'
		),
		'limit' => -1,
		'join' => array(
			array('circuit', 'id_circuit', false),
		),
		'query' => array(
		    array(
		        'key' => 'circuit_date_price.dep_date',
		        'compare' => '>=',
		        'value' => date('Y-m-d'),
		    ),
		),
		'extra_where' => ' AND '.db_is_active('', 'circuit'),
		'status' => '',
		'groupby' => 'date_solution',
		'order' => '`dep_date` ASC',
	));

	foreach($_months_circuits as &$month){
		$_items = db_query('
			SELECT circuit.*, circuit_date_price.expired, circuit_date_price.last_chance,
				DATE_FORMAT(circuit_date_price.dep_date, "%d") AS day, DATE_FORMAT(circuit_date_price.dep_date, "%c") AS month, DATE_FORMAT(circuit_date_price.dep_date, "%Y") AS year
	        FROM circuit_date_price
	       		JOIN circuit USING (id_circuit)
	        WHERE 1 AND DATE_FORMAT(circuit_date_price.dep_date, "%c-%Y") = "'.$month['month'].'-'.$month['year'].'" AND '.db_is_active('', 'circuit').'
	        GROUP BY circuit_date_price.dep_date, circuit_date_price.id_circuit
	        ORDER BY circuit_date_price.dep_date ASC
		');

		foreach($_items as &$item){
			$item['images'] = get_images('circuit', $item['id_circuit']);
			$item = circuit_prepare_info($item);
			unset($item);
		}

		$month['offers'] = $_items;

		unset($month);
	}

	cache_set('circuit__month_circuits', $_months_circuits, 60*60);
}




$_section = "circuits";
$_active_tab = "circuits";

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : "Circuite";
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
