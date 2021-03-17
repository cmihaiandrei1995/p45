<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

list($_agencies, $_count) = get_posts(array(
    'table' => 'agency',
	'limit' => -1,
	'order' => '`title` ASC',
	'use_booking' => $_GET['city'] == "21749" ? 0 : 1,
	'id_city' => intval($_GET['city'])
));

foreach($_agencies as $k => $agency){
	$result[$k]['id'] = $agency['id_agency'];
	$result[$k]['text'] = $agency['title'];
}



echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
