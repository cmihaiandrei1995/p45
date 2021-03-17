<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../config.php';

if(!is_logged_in()){
	exit;
}else{
	$_user = get_logged_in_user();
}

if(isset($_GET['id']) && isset($_GET['type'])){
	
	$exist = check_if_offer_is_in_whishlist($_user['id_user'], intval($_GET['id']), $_GET['type'], intval($_GET['city_from']));
	if(!$exist){
		db_query('INSERT INTO user_whishlist SET id_user = ?, id_offer = ?, type = ?, id_city_from = ?, created = NOW()', $_user['id_user'], intval($_GET['id']), $_GET['type'], intval($_GET['city_from']));
	}
	
}

// Close the conn
$_db->close();