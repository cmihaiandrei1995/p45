<?php 
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

if($_GET['type'] == "city"){
	list($_cities, $_cities_count) = get_posts(array(
	    'table' => 'city',
		'limit' => -1,
		'order' => '`title` ASC',
		'extra_where' => 'AND id_country = '. $_GET['country'] .''
	));
	
	foreach($_cities as $k => $city){
		$result[$k]['id'] = $city['id_city'];
		$result[$k]['text'] = $city['title'];
	}
}



echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();