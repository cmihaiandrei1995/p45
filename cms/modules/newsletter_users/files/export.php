<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="abonati.csv";');

$fields = array(
	'id_newsletter_user' => 'ID User',
	'active' => 'Activ',
	'ip' => 'IP User',
	'created' => 'Data abonarii',
	'name' => 'Nume',
	'surname' => 'Prenume',
	'email' => 'Email',
	'location' => 'Locatie abonare',
);

if($_SESSION[$_site_title]['cms']['search']['newsletter_users']){
	foreach($_SESSION[$_site_title]['cms']['search']['newsletter_users'] as $field => $value){
		$where .= " AND ".$field." LIKE '%".$value."%'";
	}
}
if($_SESSION[$_site_title]['cms']['filter']['newsletter_users']){
	foreach($_SESSION[$_site_title]['cms']['filter']['newsletter_users'] as $field => $value){
		$where .= " AND ".$field." = '".$value."'";
	}
}

$users = db_query('SELECT * FROM newsletter_user WHERE 1 '.$where.' ORDER BY id_newsletter_user DESC');

foreach($fields as $key => $value){
	echo '"'.$value.'";';
}
echo "\n";

foreach($users as $user){
	foreach($fields as $key => $value){
		echo '"'.$user[$key].'";';
	}
	echo "\n";
}
