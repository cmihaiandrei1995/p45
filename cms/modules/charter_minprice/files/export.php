<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="export.csv";');

$fields = array(
    'id_hotel' => 'ID hotel',
	'code' => 'Cod hotel',
	'id_city_from' => 'Orase plecare',
	'date_from' => 'De la',
	'date_to' => 'Pana la',
);

if($_SESSION[$_site_title]['cms']['search']['charter_minprice']){
	foreach($_SESSION[$_site_title]['cms']['search']['charter_minprice'] as $field => $value){
		$where .= " AND ".$field." LIKE '%".$value."%'";
	}
}
if($_SESSION[$_site_title]['cms']['filter']['charter_minprice']){
	foreach($_SESSION[$_site_title]['cms']['filter']['charter_minprice'] as $field => $value){
		$where .= " AND ".$field." = '".$value."'";
	}
}

$bookings = db_query('SELECT * FROM charter_minprice WHERE 1 '.$where.' ORDER BY id_charter_minprice DESC');

foreach($fields as $key => $value){
	echo '"'.$value.'";';
}
echo "\n";

foreach($bookings as $booking){
	foreach($fields as $key => $value){
		echo '"'.$booking[$key].'";';
	}
	echo "\n";

}
