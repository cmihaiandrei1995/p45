<?
// text circuite
$_text_circuite = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 3,
));

//@andrei: extra texte circuite
$_extra_text[$id] = array(get_post(array(
	'table' => 'home_text',
	'id_home_text' => 12
)),get_post(array(
	'table' => 'home_text',
	'id_home_text' => 15
)));

// itemi circuite
list($_box_circuits, $circuit_count) = get_posts(array(
	'table' => 'home_circuit',
	'limit' => -1,
	'images' => true
));
foreach($_box_circuits as &$item){
	if($item['logo'] != ""){
		$item['logo_img'] = $_base_uploads.'images/'.$item['logo_path'].'small-'.$item['logo'];
	}

	$cities = db_query('SELECT * FROM home_circuit_city_from WHERE id_home_circuit = ?', $item['id_home_circuit']);
	if($cities){
		foreach($cities as $city){
			$city = get_city_by_id($city['id_city']);
			$item['cities'][] = $city['title'];
		}
	}
	
	unset($item);
}

// slider circuite
list($_slider_circuits, $circuit_count) = get_posts(array(
	'table' => 'home_circuit_slider',
	'limit' => -1,
	'images' => true
));