<?

define('ADMIN_USERNAME','paralela');
define('ADMIN_PASSWORD','prlg1234');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
$_SERVER['PHP_AUTH_USER'] != ADMIN_USERNAME ||$_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
Header("WWW-Authenticate: Basic realm=\"Memcache Login\"");
Header("HTTP/1.0 401 Unauthorized");

echo <<<EOB
	<html><body>
	<h1>Rejected!</h1>
	<big>Wrong Username or Password!</big>
	</body></html>
EOB;
exit;
}

// Site general data
$_config['site']['name']                = 'Paralela 45';
$_config['site']['domain']              = 'dev.paralela45.ro';
$_config['site']['use_https']           = false;
$_config['site']['redirect_nonwww']     = false;
$_config['site']['path']                = 'http://dev.paralela45.ro/';
$_config['site']['cms_path']			= 'http://dev.paralela45.ro/cms/';
$_config['site']['static_path']         = 'http://dev.paralela45.ro/static/';
$_config['site']['uploads_path']        = 'http://dev.paralela45.ro/uploads/';
$_config['site']['theme']               = 'paralela';
$_config['site']['less']                = true; //TODO: switch back to false when done 
$_config['site']['debug']               = true;
$_config['site']['debug_ips']           = array('84.232.132.184', '86.122.102.17', '5.2.135.32', '5.2.135.73', '109.97.198.142', '185.189.199.200', '109.97.199.12', '5.12.49.211', '109.97.199.12');

// Is shop ?
$_config['site']['is_shop']				= false;

// Server data
$_config['server']['path']              = '/home/devparalela/public_html/';
$_config['server']['cms_path']			= '/home/devparalela/public_html/cms/';
$_config['server']['static_path']       = '/home/devparalela/public_html/static/';
$_config['server']['uploads_path']      = '/home/devparalela/public_html/uploads/';

// Ftp data
$_config['ftp']['hostname']             = '185.92.193.56';
$_config['ftp']['username']             = 'paralela';
$_config['ftp']['password']             = '4rPaUTBQNXcw';
$_config['ftp']['port']              	= '21';
$_config['ftp']['passive_mode']         = true;
$_config['ftp']['main_dir']             = '/public_html/';

// Memcache
$_config['server']['memcache']          = true;
$_config['server']['memcache_host']     = 'localhost';
$_config['server']['memcache_port']     = 11211;
$_config['server']['memcache_prefix']   = 'paralela45_dev';
$_config['server']['memcache_time']		= 24*60*60; // 1 day

// File cache
$_config['server']['file_cache']        = false;

// DB data
$_config['db']['hostname']              = 'localhost';
$_config['db']['database']              = 'paralela_site';
$_config['db']['username']              = 'paralela_site';
$_config['db']['password']              = 'f8QDfTDdgthl';
$_config['db']['encoding']              = 'utf8';
$_config['db']['collation']             = 'utf8_general_ci';

$_config['blog-link']					= 'https://www.paralela45.ro/blog/';

// Email smtp settings
$_config['email']['smtp']               = true;
$_config['email']['use_pear']           = false;
$_config['email']['name_from']          = 'Paralela45';
$_config['email']['email_from']         = 'notificari@paralela45.ro';
$_config['email']['port']               = 587;
$_config['email']['hostname']           = 'smtp.office365.com';
$_config['email']['email_auth']         = 'notificari@paralela45.ro';
$_config['email']['password']           = 'Wowa6024';
$_config['email']['tls']				= true;

//$_config['email']['mandrill']           = false;
//$_config['email']['mandrill_host']      = "smtp.mandrillapp.com";
//$_config['email']['mandrill_port']      = 587;
//$_config['email']['mandrill_username']  = "Paralela 45";
//$_config['email']['mandrill_api_key']   = "K_XQHSGWtGLICrYAjhKrkQ";

// sunt folosite totusi pentru client - send_paralela_mail
$_config['email']['mailgun']            = false;
$_config['email']['mailgun_domain']     = 'mg.paralela45.ro';
$_config['email']['mailgun_apikey']     = 'key-9f417d6eeffe6f19ed1a3ec122fba4be';

$_config['eurosite']['user']           	= "XML_NEW_SITE";
$_config['eurosite']['pass']      		= "f344t43gg4556h56";
$_config['eurosite']['link']      		= "https://rezervari.paralela45.ro/server_xml/server.php";

$_config['croaziere']['api_key']      	= "38376d0acc746e2cc927ef18ce1529cf";
$_config['croaziere']['link']      		= "https://www.croaziere.net/api/v1.1/?api_key=".$_config['croaziere']['api_key']."&output=json&section=";

$_config['generali']['user']           	= "ApiParalela";
$_config['generali']['pass']      		= "ApiParalela45";
$_config['generali']['link']      		= "https://partners-test.generali.ro/soap/arms-rai.wsdl";
//$_config['generali']['user']           	= "paralela45_api";
//$_config['generali']['pass']      		= "123123";
//$_config['generali']['link']  			= "https://partners.generali.ro/soap/arms-rai.wsdl";

$_config['city_insurance']['user']      = "test123";
$_config['city_insurance']['pass']      = "test123";
$_config['city_insurance']['link']  	= "http://online.cityinsurance.ro/ws_medicale2.php?wsdl";

$_config['contact']						= array(
	'complaints' 			=> 'marketing@paralela45.ro',
	'register' 				=> 'marketing@paralela45.ro',
	'testimonial'			=> 'marketing@paralela45.ro',
	'agency_form'			=> 'marketing@paralela45.ro;vanzari.online@paralela45.ro',
	'jobs' 					=> 'hr@paralela45.ro',
	'gdpr'					=> 'marketing@paralela45.ro;it@paralela45.ro',

	'cruise_reservation' 	=> 'rezervari@paralela45.ro',
	'vacation_form'			=> 'rezervari@paralela45.ro',
	'ticket_reservation'	=> 'rezervari@paralela45.ro',
	'reservations'			=> 'rezervari@paralela45.ro',
	'confirmations_pay'		=> 'vanzari.online@paralela45.ro',

	'circuit_cron'			=> 'marketing@paralela45.ro',
	'grile_cron'			=> 'marketing@paralela45.ro',
);

$_config['paging']['page_link']			= 'pag-';
$_config['paging']['ipp']				= array(
	'cruises'			=> 10,
	'circuits'			=> 10,
	'tourism'			=> 10,
	'charter'			=> 10,

	'about-media'		=> 10,
	'agencies-partner'	=> 12,
	'testimonial'		=> 9,
	'tickets'			=> 12,
);

// Available models
$_config['models']                      = array(
	'eurosite/general',
	'eurosite/hotels',
	'eurosite/charter',
	'eurosite/transport',
	'eurosite/circuits',

	'city_insurance/functions',

	'tm',

	'destinations',
	'charter',
	'circuit',
	'hotel',
	'filters',

	'booking',

	'cruises/cruises',
	'cruises/lines',
	'cruises/ships',
	'cruises/destinations',
	'cruises/filters',

	'users',
	'general',
	'vouchers',
	'others'
);

$_config['google']['api_key']		= 'AIzaSyAeOGCL17xe-w7hE76iBE6LD7eGYHd6hc4';

$_config['typeform']['token']		= '5KXjxkbTaw1PMDGbHVUW8BctgokcZZFK684Y5ev3icGK';

$_config['captcha']['site_key']		= '6Ld5RjUUAAAAAHLuMl_SuOJ45a3R_gB5IjfWKKmS';
$_config['captcha']['secret_key']	= '6Ld5RjUUAAAAAFqbCp1s2UQp_uYmBdwsWorULLPM';

//$_config['captcha-invisible']['site_key']		= '6LeI51oUAAAAAH5c3x9yKcyJdCtEfcNfmO7SRbNM';
//$_config['captcha-invisible']['secret_key']		= '6LeI51oUAAAAANSuadGGBnh5gNcDfnTrEXkuvsk5';


// Language settings
$_website_langs                         = array('ro' => 'Romana');
$_cms_langs                             = array('ro' => 'Romana');

// Start
require_once $_config['server']['path'] . 'settings.php';
