<?php 
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';


if($_GET['type'] == "city"){
	
	if($_GET['tag'] == "city"){
		
		$tag = get_post(array(
			'table' => 'city_tag',
			'id_city_tag' => $_GET['program']
		));
		
		list($_cities, $count) = get_posts(array(
			'table' => 'city',
			'limit' => -1,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				AND id_city IN (SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$tag['id_city_tag'].')
			',
			'order' => 'title ASC'
		));
		
	}elseif($_GET['tag'] == "special"){
		
		$tag = get_hotel_tag_by_id($_GET['program']);
		
		list($_cities, $count) = get_posts(array(
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
		
	}
	
	foreach($_cities as $k => $item){
		$result[$k]['id'] = $item['id_city'];
		$result[$k]['text'] = $item['title'];
	}
}



if($_GET['type'] == "link"){
	
	if($_GET['tag'] == "city"){
		$tag = get_post(array(
			'table' => 'city_tag',
			'id_city_tag' => $_GET['program']
		));
		$result['link'] = route('tourism-ro-cat', $tag['title_front']);
	}elseif($_GET['tag'] == "special"){
		$tag = get_hotel_tag_by_id($_GET['program']);
		$result['link'] = route('tourism-ro-cat', $tag['title']);
	}
	
	if($_GET['city'] != "" && is_numeric($_GET['city'])){
		$result['link'] .= "?ct=".intval($_GET['city']);
	}
	
}


echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();