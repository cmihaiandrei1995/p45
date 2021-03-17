<?

// Google APP
require_once $_base_path_cms.'widgets/analytics/Google/autoload.php';

$ga_client_id = '4731088278-lvccbjkp1epeceubeesi727u8v85jdlg.apps.googleusercontent.com';
$ga_client_secret = 'L8WA-Q-zQgesgHKW5Wsalx-y';
$ga_redirect_uri = 'urn:ietf:wg:oauth:2.0:oob';

$ga_client = new Google_Client();
$ga_client->setClientId($ga_client_id);
$ga_client->setClientSecret($ga_client_secret);
$ga_client->setRedirectUri($ga_redirect_uri);
$ga_client->addScope('https://www.googleapis.com/auth/analytics.readonly');
$ga_client->setAccessType('offline');
$ga_client->setApprovalPrompt('auto');
$ga_client->setApplicationName('Prologue CMS');

$ga_logged_in = false;

// go
$ga_analytics_token = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_token"');
$ga_analytics_auth_token = db_row('SELECT * FROM admin_config WHERE `key` = "ga_widget_auth_token"');

if($ga_analytics_token['value']){
	if(!$ga_analytics_auth_token['value']){
		$ga_client->authenticate($ga_analytics_token['value']);
		$ga_token = $ga_client->getAccessToken();
		db_query('UPDATE admin_config SET `value` = ? WHERE `key` = "ga_widget_auth_token"', serialize($ga_token));
	}else{
		$ga_token = unserialize($ga_analytics_auth_token['value']);
	}
	
	$ga_client->setAccessToken($ga_token);
	$ga_logged_in = true;
}else{
	$ga_authUrl = $ga_client->createAuthUrl();
}
