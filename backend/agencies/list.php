<?

$options = array(
    'table' => 'agency',
	'limit' => -1,
	'images' => true,
);

$options_city = array(
	'table' => 'city',
	'limit' => -1,
	'order' => 'title ASC'
);

$options_maps = array(
    'table' => 'agency',
	'limit' => -1,
	//'order' => 'id_agency ASC',
	'images' => true,
);

if(isset($_params['city'])){
	$_city = get_city_by_slug($_params['city']);

	if(!$_city){
		go_away(route('agencies'));
	}

	$options['id_city'] = $_city['id_city'];
	list($_items, $_count) = get_posts($options);

	foreach($_items as &$item){
		$item['city'] = $_city['title'];
		unset($item);
	}


	$options_city['extra_where'] = '  AND id_city IN (SELECT id_city FROM agency WHERE id_city IN (SELECT id_city FROM city WHERE id_country = '.$_city['id_country'].') AND active = 1)';
	$options_maps['id_city'] = $_city['id_city'];



}elseif(isset($_params['country'])){

	$country = get_country_by_slug($_params['country']);

	if($country['id_country'] == 126){
		go_away(route('agencies'));

	}

	$options_maps['extra_where'] = ' AND id_city IN (SELECT id_city FROM agency WHERE id_city IN (SELECT id_city FROM city WHERE id_country = '.$country['id_country'].'))';

	//print_r($country);
	$options_city['extra_where'] = ' AND id_city IN (SELECT id_city FROM agency WHERE id_city IN (SELECT id_city FROM city WHERE id_country = '.$country['id_country'].'))';
	//$options_city['debug'] = true;

	list($_cities, $_count) = get_posts($options_city);
	//print_r($_cities[0]['id_city']);
	$options['id_city'] = $_cities[0]['id_city'];

	list($_items, $_count) = get_posts($options);

}else{
	$options_maps['extra_where'] = ' AND id_city IN (SELECT id_city FROM agency WHERE id_city IN (SELECT id_city FROM city WHERE id_country = 126))';
	$options['id_city'] = 14997;
	//$options['debug'] = true;

	list($_items, $_count) = get_posts($options);

	foreach($_items as &$item){
		$item['city'] = 'Bucuresti';
		unset($item);
	}

	$options_city['extra_where'] = ' AND id_city IN (SELECT id_city FROM agency WHERE id_city IN (SELECT id_city FROM city WHERE id_country = 126) AND active = 1)';
}

$options_city['extra_where'] .= " AND id_city <> 21749";

list($_cities, $_count) = get_posts($options_city);

$_online_city = get_post(array(
	'table' => 'city',
	'id_city' => 21749,
));
array_unshift($_cities, $_online_city);

/*
$_online_agency = get_post(array(
	'table' => 'agency',
	'id_agency' => 56,
	'images' => true
));
array_unshift($_items, $_online_agency);
*/

list($_countries, $_count) = get_posts(array(
	'table' => 'country',
	'limit' => -1,
	'extra_where' => ' AND id_country IN (SELECT id_country FROM city WHERE id_city in (SELECT id_city FROM agency WHERE active = 1))',
	'order' => 'title DESC'
));
//print_r($_countries);

$_autoritatea = get_post(array(
	'table' => 'page',
	'id_page' => 251
));


list($_items_map, $_count_map) = get_posts($options_maps);

$arr = array();
foreach ($_items_map as $key => $value) {
	if($value['map_x'] !== null && $value['map_y'] !== null){
		$arr[] = $value['map_x'] . $value['map_y'];
	}

}


include $_base_path.'backend/common/forms/contact-form-agencies.php';


$_section = "agencies";

// seo
$seo = get_seo('agentii');
$_meta_title = $seo['title'] ? $seo['title'] : 'Agentii Paralela 45'.( isset($_params['city']) ? " - ".$_city['title'] : "");
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
