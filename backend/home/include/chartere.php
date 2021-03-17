<?
// text chartere
$_text_chartere = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 2,
));

// itemi chartere
list($_box_charters, $charter_count) = get_posts(array(
	'table' => 'home_charter',
	'limit' => -1,
	'images' => true
));
foreach($_box_charters as &$item){
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

// slider chartere
list($_slider_charters, $charter_count) = get_posts(array(
	'table' => 'home_charter_slider',
	'limit' => -1,
	'images' => true
));