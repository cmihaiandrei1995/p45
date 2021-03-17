<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$user = db_row('SELECT * FROM user WHERE id_user = ?', intval($_GET['id']));
if($user){
    $content['link'] = route('confirm-account', md5($user['id_user']));
    send_paralela_mail($user['email'], "Confirmare inregistrare cont - Paralela45", $content, 'register');
}

$_SESSION[$_site_title]['cms']['alerts'][] = array(
	'message' => "Emailul de activare a fost retrimis cu succes",
	'type' => 'success'
);

go_away($_SERVER['HTTP_REFERER']);
