<?
// text box offer
$_text_box_offer = get_post(array(
	'table' => 'home_text',
	'id_home_text' => ($id+1),
));

//@andrei: box offers extra texte
$_extra_text[$id] = array(get_post(array(
	'table' => 'home_text',
	'id_home_text' => 11
)));

// itemi box offer
list($_box_offer[$id], $offer_count) = get_posts(array(
	'table' => 'home_box_offer',
	'limit' => -1,
	'box' => $id,
	'images' => true
));
foreach($_box_offer[$id] as &$item){
	if($item['logo'] != ""){
		$item['logo_img'] = $_base_uploads.'images/'.$item['logo_path'].'small-'.$item['logo'];
	}

	$cities = db_query('SELECT * FROM home_charter_city_from WHERE id_home_charter = ?', $item['id_home_charter']);
	if($cities){
		foreach($cities as $city){
			$city = get_city_by_id($city['id_city']);
			$item['cities'][] = $city['title'];
		}
	}
	
	unset($item);
}

// slider circuite
list($_slider_box_offer[$id], $offer_count) = get_posts(array(
	'table' => 'home_box_offer_slider',
	'limit' => -1,
	'box' => $id,
	'images' => true
));