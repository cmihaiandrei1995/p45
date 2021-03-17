<?php 
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';


if($_GET['type'] == "city_to"){
	
	$country = get_country_by_id($_GET['country']);
	
	
	
	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => ' AND id_city IN (SELECT id_city_to FROM ticket WHERE id_country_to = '.$country['id_country'].' GROUP BY id_city_to)',
		'order' => 'title ASC'
	));
	
	foreach($_cities as $city){
		$cities[] = array(
			'id' => $city['id_city'],
			'title' => $city['title']
		);
	}
	
	foreach($cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}
}


if($_GET['type'] == "city_from"){
	
	$country = get_country_by_id($_GET['country']);
	
	
	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => ' AND id_city IN (SELECT id_city_from FROM ticket WHERE id_country_to = '.$country['id_country'].' GROUP BY id_city_from)',
		'order' => 'title ASC'
	));
	
	foreach($_cities as $city){
		$cities[] = array(
			'id' => $city['id_city'],
			'title' => $city['title']
		);
	}
	
	foreach($cities as $k => $item){
		$result[$k]['id'] = $item['id'];
		$result[$k]['text'] = $item['title'];
	}
}

if($_GET['type'] == "link"){
	
	if(isset($_GET['country']) && $_GET['country'] != ""){
		$country = get_country_by_id(intval($_GET['country']));
		$result['link'] = route('tickets2', $country['title']);
	}
	
	if(isset($_GET['city']) && $_GET['city'] != ""){
		//$country = get_country_by_id(intval($_GET['country']));
		$city = get_city_by_id(intval($_GET['city']));
		$result['link'] = route('tickets2', $country['title'], $city['title']);
	}
	
	if(isset($_GET['city_from']) && $_GET['city_from'] != ""){
			//$country = get_country_by_id(intval($_GET['country']));
			//$city = get_city_by_id(intval($_GET['city']));
			$city_from = get_city_by_id(intval($_GET['city_from']));
			$result['link'] = route('tickets2', $country['title'], $city['title'], $city_from['title']);
		}

		
	
	
	
	
}


echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();