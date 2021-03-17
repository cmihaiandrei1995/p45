<?php
$_use_routes = false;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['action']) && $_POST['action'] == "save_token"){
	db_query('UPDATE admin_config SET `value` = ? WHERE `key` = "ga_widget_token"', $_POST['token']);
}

if(isset($_POST['action']) && $_POST['action'] == "reset_account"){
	db_query('UPDATE admin_config SET `value` = "" WHERE `key` IN ("ga_widget_token", "ga_widget_auth_token", "ga_widget_profile")');
}

if(isset($_POST['action']) && $_POST['action'] == "save_profile"){
	db_query('UPDATE admin_config SET `value` = ? WHERE `key` = "ga_widget_profile"', $_POST['view']);
}


if(isset($_POST['action']) && $_POST['action'] == "get_profiles"){
	
	require_once $_base_path_cms.'widgets/analytics/ga_login.php';
	
	$ga_analytics = new Google_Service_Analytics($ga_client);
	$ga_properties = $ga_analytics->management_webproperties->listManagementWebproperties($_POST['account']);
	
	if(count($ga_properties->getItems()) > 0){
		foreach($ga_properties->getItems() as $property){
			$profiles[] = array(
				'id' => $property->getId(),
				'text' => $property->getName()
			);
		}
	}else{
		$profiles = array(
			0 => array(
				'id' => "",
				'text' => _lng('no_ga_profiles')
			),
		);
	}
	
	header('Content-type: application/json');
	echo json_encode($profiles);
}

if(isset($_POST['action']) && $_POST['action'] == "get_views"){
	
	require_once $_base_path_cms.'widgets/analytics/ga_login.php';
	
	$ga_analytics = new Google_Service_Analytics($ga_client);
	$ga_views = $ga_analytics->management_profiles->listManagementProfiles($_POST['account'], $_POST['profile']);
	
	if(count($ga_views->getItems()) > 0){
		foreach($ga_views->getItems() as $view){
			$views[] = array(
				'id' => $view->getId(),
				'text' => $view->getName()
			);
		}
	}else{
		$views = array(
			0 => array(
				'id' => "",
				'text' => _lng('no_ga_data')
			),
		);
	}
	
	header('Content-type: application/json');
	echo json_encode($views);
}