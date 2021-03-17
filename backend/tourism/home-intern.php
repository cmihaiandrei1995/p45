<?

if(isset($_POST['advanced'])){

	$_valid = true;

	// destination
	$_rules['t-intern-programul'] = 'trim|required';
	$_rules['location_type'] = 'trim|required';
	$_rules['t-intern-statiunea'] = 'trim|required|numeric';

	// date
	$_rules['t-intern-check-in'] = 'trim|required|date';
	$_rules['t-intern-check-out'] = 'trim|required|date';

	$_rules['t-intern-camere'] = 'trim|required|numeric|min-1|max-3';

	for($i=1; $i<=$_POST['t-intern-camere']; $i++){
		$_rules['t-intern-adulti'.$i] = 'trim|required|numeric|min-1|max-5';
		$_rules['t-intern-copii'.$i] = 'trim|required|numeric|min-0|max-3';
		if($_POST['t-intern-copii'.$i] > 0){
			for($j=1; $j<=$_POST['t-intern-copii'.$i]; $j++){
				$_rules['t-intern-copii-varste'.$i.'-'.$j] = 'trim|required|numeric|min-0|max-17';
			}
		}
	}

	$_custom_error_messages = array();
	for($i=1; $i<=$_POST['t-intern-camere']; $i++){
		if($_POST['t-intern-copii'.$i] > 0){
			for($j=1; $j<=$_POST['t-intern-copii'.$i]; $j++){
				$_custom_error_messages['t-intern-copii-varste'.$i.'-'.$j] = array(
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

	$country = get_country_by_id(126);

	// sidebar values
	if($_form['location_type'] == "city"){

		$tag = get_post(array(
			'table' => 'city_tag',
			'id_city_tag' => $_form['t-intern-programul']
		));

		list($cities_ro, $count) = get_posts(array(
			'table' => 'city',
			'limit' => -1,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				AND id_city IN (SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$tag['id_city_tag'].')
			',
			'order' => 'title ASC'
		));

		$destination = $tag['title_front'];

	}elseif($_form['location_type'] == "special"){

		$tag = get_hotel_tag_by_id($_form['t-intern-programul']);

		list($cities_ro, $count) = get_posts(array(
			'table' => 'city',
			'limit' => -1,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT id_hotel FROM hotel_minprice
					)
				)
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT hotel_grila.id_hotel FROM hotel_grila
						JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
						WHERE hotel_grila.id_hotel_tag = '.$tag['id_hotel_tag'].' AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
					)
				)
			',
			'order' => 'title ASC',
		));

		$destination = $tag['title'];
	}

	foreach($cities_ro as $k => $item){
		$_cities_sidebar[$k]['id'] = $item['id_city'];
		$_cities_sidebar[$k]['text'] = $item['title'];
	}

	if($_valid){

		$_form['t-intern-tara'] = 126;

		$room_data = array();
		for($i=1; $i<=$_POST['t-intern-camere']; $i++){
			$room_data[$i-1] = array(
				'adult' => $_form['t-intern-adulti'.$i],
				'child' => $_form['t-intern-copii'.$i]
			);
			if($_form['t-intern-copii'.$i] > 0){
				for($j=1; $j<=$_form['t-intern-copii'.$i]; $j++){
					$room_data[$i-1]['child_age'][$j-1] = $_form['t-intern-copii-varste'.$i.'-'.$j];
				}
			}
		}

		$id_search = db_query('
			INSERT INTO hotel_search
			SET id_country = ?, destination = ?, id_city = ?, date_from = ?, date_to = ?, rooms = ?, room_data = ?, status = "init", is_ro = 1',
			$_form['t-intern-tara'],
			generate_name($destination),
			$_form['t-intern-statiunea'],
			date('Y-m-d', strtotime($_form['t-intern-check-in'])),
			date('Y-m-d', strtotime($_form['t-intern-check-out'])),
			$_form['t-intern-camere'],
			json_encode($room_data)
		);

		go_away(route('tourism-ro-loading', $id_search));

	}

}








$_text = get_post(array(
	'table' => 'page',
	'id_page' => 4
));


$_tags = cache_get('tourism_intern__tags');
if(!$_tags){
	list($_tags, $count) = get_posts(array(
		'table' => 'city_tag',
		'limit' => -1,
		'images' => true,
		'extra_where' => ' AND title IN ("'.implode('","', $_allowed_tags).'")'
	));
	foreach($_tags as $k => &$tag){
		list($tag['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 12,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				AND id_city IN (SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$tag['id_city_tag'].')
			',
		));

		if(!$tag['cities']){
			unset($_tags[$k]);
		}else{
			foreach($tag['cities'] as &$city){
				$city['url'] = route('tourism-ro-cat', $tag['title_front'])."?&ct=".$city['id_city'];
				unset($city);
			}
		}

		$tag['url'] = route('tourism-ro-cat', $tag['title_front']);

		unset($tag);
	}

	cache_set('tourism_intern__tags', $_tags, 60*60);
}


$_tags_special = cache_get('tourism_intern__tags_special');
if(!$_tags_special){
	list($_tags_special, $count) = get_posts(array(
		'table' => 'home_tourism_intern',
		'limit' => -1,
		'query' => array(
			'key' => 'id_hotel_tag',
			'compare' => '>',
			'value' => 0
		),
		'images' => true,
	));

	foreach($_tags_special as $k => &$box){
		$tag = get_hotel_tag_by_id($box['id_hotel_tag']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 6,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT id_hotel FROM hotel_minprice
					)
				)
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT hotel_grila.id_hotel FROM hotel_grila
						JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
						WHERE hotel_grila.id_hotel_tag = '.$box['id_hotel_tag'].' AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
					)
				)
			',
			'order' => 'title ASC',
		));

		if(!$box['cities']){
			unset($_tags_special[$k]);
		}else{
			foreach($box['cities'] as &$city){
				$city['url'] = route('tourism-ro-cat', $tag['title'])."?&ct=".$city['id_city'];
				unset($city);
			}
		}

		$box['url'] = route('tourism-ro-cat', $tag['title']);

		unset($box);
	}

	cache_set('tourism_intern__tags_special', $_tags_special, 60*60);
}

$_section = "tourism-ro";
$_active_tab = "tourism-ro";

$_country = get_country_by_id(126);

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
