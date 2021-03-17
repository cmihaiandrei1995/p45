<?

// check if required variables for this widget are set in the admin_config table, if not, insert them
$ga_analytics_token = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_token"');
if(!$ga_analytics_token){
	db_query('INSERT INTO admin_config SET `title` = "Cheie acces Google Analytics", `key` = "ga_widget_token"');
}

$ga_analytics_auth_token = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_auth_token"');
if(!$ga_analytics_auth_token){
	db_query('INSERT INTO admin_config SET `title` = "Token Google Analytics", `key` = "ga_widget_auth_token"');
}

$ga_analytics_profile = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_profile"');
if(!$ga_analytics_profile){
	db_query('INSERT INTO admin_config SET `title` = "Profil Analytics", `key` = "ga_widget_profile"');
}

// general Google settings
require_once $_base_path_cms.'widgets/analytics/ga_login.php';

if($ga_logged_in){
	$ga_analytics = new Google_Service_Analytics($ga_client);
		
	if(!$ga_analytics_profile['value']){
		$ga_accounts = $ga_analytics->management_accounts->listManagementAccounts();
		
		foreach($ga_accounts->getItems() as $account){
			$_ga_profiles[] = array(
				'id' => $account->getId(),
				'text' => $account->getName()
			);
		}
	}
}
