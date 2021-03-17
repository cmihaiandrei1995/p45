<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="export.csv";');

$fields = array(
	'name' => 'Nume',
	'surname' => 'Prenume',
	'email' => 'Email',
	'phone' => 'Telefon',
    'newsletter' => 'Newsletter'
);

if($_SESSION[$_site_title]['cms']['search']['user_contest_vote']){
	foreach($_SESSION[$_site_title]['cms']['search']['user_contest_vote'] as $field => $value){
		$where .= " AND ".$field." LIKE '%".$value."%'";
	}
}
if($_SESSION[$_site_title]['cms']['filter']['user_contest_vote']){
	foreach($_SESSION[$_site_title]['cms']['filter']['user_contest_vote'] as $field => $value){
		$where .= " AND ".$field." = '".$value."'";
	}
}

$bookings = db_query('SELECT * FROM user_contest_vote WHERE 1 '.$where.' ORDER BY id_user_contest_vote DESC');

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
