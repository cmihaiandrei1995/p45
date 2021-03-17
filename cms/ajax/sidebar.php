<?php
$_use_routes = false;
$_is_ajax = true;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/../settings.php';

if(isset($_COOKIE[generate_name($_site_title)]["cms"]["hide_sidebar"])){
	if($_COOKIE[generate_name($_site_title)]["cms"]["hide_sidebar"] == 1){
		setcookie(generate_name($_site_title)."[cms][hide_sidebar]", 0, time()+60*60*24*30, '/');
	}else{
		setcookie(generate_name($_site_title)."[cms][hide_sidebar]", 1, time()+60*60*24*30, '/');
	}
}else{
	setcookie(generate_name($_site_title)."[cms][hide_sidebar]", 1, time()+60*60*24*30, '/');
}

// Close the conn
$_db->close();
