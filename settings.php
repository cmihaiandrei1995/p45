<?php
// CMS version
$_version = '2.93';

// Php error & debug settings
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
if(in_array($_SERVER['REMOTE_ADDR'], $_config['site']['debug_ips'])){
	$_config['site']['debug'] = true;
}

if($_config['site']['debug']){
	ini_set("display_errors", 1);
}else{
	ini_set("display_errors", 0);
}

// session init
if(!session_id()) session_start();
if(!isset($_SESSION)) $_SESSION = array();

// url base, you can also use $_config['site']['path']
$_base = $_config['site']['path'];
$_base_static = $_config['site']['static_path'];
$_base_uploads = $_config['site']['uploads_path'];

// current url with https or http
$_current_url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// Server root base, you can also use $_config['server']['path']
$_base_path = $_config['server']['path'];
$_base_static_path = $_config['server']['static_path'];
$_base_uploads_path = $_config['server']['uploads_path'];

// Config theme
$_theme = $_config['site']['theme'];
$_theme_path = $_base_path . 'content/' . $_theme . '/';
$_backend_path = $_base_path . 'backend/';

// Use global link and add 'cms'
$_base_cms = $_config['site']['cms_path'];
$_base_path_cms = $_config['server']['cms_path'];

// Other variables
$_site_title = $_config['site']['name'];

// Php overwrite default setings
ini_set("allow_url_fopen", 1);
ini_set('auto_detect_line_endings', true);
ini_set('gd.jpeg_ignore_warning', 1);
ini_set('mysql.connect_timeout', "600");

ini_set("memory_limit", "1024M");
ini_set("post_max_size", "50M");
ini_set("upload_max_filesize", "50M");
set_time_limit(3600);
ini_set("max_execution_time", "3600");
ini_set("max_input_time", "3600");

header("Cache-Control: no-cache");
if(!$_config['site']['allow_iframes']){
	header("X-Frame-Options: SAMEORIGIN");
	header("Content-Security-Policy: frame-ancestors 'self'");
}

// Connect to memcache if available
if($_config['server']['memcache']) {
	$_memcache = new Memcache();
	$_memcache->connect($_config['server']['memcache_host'], $_config['server']['memcache_port']) or die("Could not connect to Memcache server.");
}

// Load routes
require_once $_base_path . 'routes.php';

// Load functions
require_once $_base_path . 'lib/functions.php';

// Load classes
require_once $_base_path . 'lib/classes.php';

// perform redirects : https, non www
if($_use_routes || ($_is_cms && !$_is_ajax && !$_is_cron && !$_use_routes)){
	if($_config['site']['use_https']){
		if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
		    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		    go_away($redirect, '301');
		}
	}

	// redirect non www links to www links
	if($_config['site']['redirect_nonwww']){
		if(substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.') {
		    $redirect = 'http' . ($_config['site']['use_https'] ? "s://" : "://") . 'www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		    go_away($redirect, '301');
		}
	}

	// redirect in case link contains uppercase characters
	if(strtolower($_SERVER['SCRIPT_URI']) != $_SERVER['SCRIPT_URI']){
		$redirect = strtolower($_SERVER['SCRIPT_URI']).($_SERVER['QUERY_STRING'] != "" ? "?".$_SERVER['QUERY_STRING'] : "");
		go_away($redirect, '301');
	}
}

// Connect to the db
$_db = new DB($_config['db']['hostname'], $_config['db']['username'], $_config['db']['password'], $_config['db']['database'], $_config['db']['encoding'], $_config['db']['collation']);

// Load shop classes & functions
if($_config['site']['is_shop']){
	require_once $_base_path . 'lib/shop/general.php';
}

// Load models
foreach($_config['models'] as $model) {
	if(is_file($_base_path . 'models/' . $model . '.php')){
		require_once $_base_path . 'models/' . $model . '.php';
	}
}

// Load global variables
if(is_file($_base_path . 'variables.php')){
	require_once $_base_path . 'variables.php';
}

// load all config data from cms into one variable
if($_config['server']['memcache'] || $_config['server']['file_cache']) {
	$_config['cms'] = cache_get('cms_conf');
	$_config['images'] = cache_get('cms_images');
}
if(!$_config['cms'] && !$_config['images']){

	// Include general cms config
	require_once $_base_path_cms . 'config.php';

	foreach($_sections as $section){
		foreach($section['modules'] as $key => $module){
			$_section = array();

			if(file_exists($_base_path_cms . 'modules/' . $key . '/config.php')) {
				include $_base_path_cms . 'modules/' . $key . '/config.php';

				if(file_exists($_base_path_cms . 'modules/' . $key . '/extra/config.php')) {
					include $_base_path_cms . 'modules/' . $key . '/extra/config.php';
				}

				$_config['cms'][$key] = $_section;

				// get image sizes
				foreach($_section['fields'] as $k => $v){
					if($k == "image"){
						foreach($v['sizes'] as $s => $size){
							$_config['images'][$key][] = $s;
						}
					}
				}
			}
		}
	}

	// Load shop init scripts
	if($_config['site']['is_shop']){
		require_once $_base_path . 'lib/shop/init.php';
	}

	if($_config['server']['memcache'] || $_config['server']['file_cache']) {
		cache_set('cms_conf', $_config['cms'], $_config['server']['memcache_time']);
		cache_set('cms_images', $_config['images'], $_config['server']['memcache_time']);
	}
}

// get a list of all current tables with all fields and put it in config
if($_config['server']['memcache'] || $_config['server']['file_cache']) {
	$_config['db_tables'] = cache_get('db_tables');
}
if(!$_config['db_tables']){
	$_tables = array();
	$tables = db_query('SHOW TABLES');
	foreach($tables as $table){
		$_tables[] = $table['Tables_in_'.$_config['db']['database']];
	}

	foreach($_tables as $tbl){
		$columns = db_query('DESCRIBE '.$tbl);
		$all_columns = array();
		foreach($columns as $column){
			$all_columns[] = $column['Field'];
		}

		$_config['db_tables'][$tbl] = $all_columns;
	}

	if($_config['server']['memcache'] || $_config['server']['file_cache']) {
		cache_set('db_tables', $_config['db_tables'], $_config['server']['memcache_time']);
	}
}

// detect if lang parameter is in url and set Lang for frontend
$tmp = explode("/", str_replace($_base, '', $_current_url));
$lng_keys = array_keys($_website_langs);
if(in_array($tmp[0], $lng_keys)){
	// redirect if in the link is the main/first language
	if($tmp[0] == $lng_keys[0]){
		$_SESSION[$_site_title]['lang'] = $lng_keys[0];

		$redirect = preg_replace('/\/'.$lng_keys[0].'\//', '/', $_current_url, 1);
		go_away($redirect, '301');
	}else{
		$_SESSION[$_site_title]['lang'] = $tmp[0];
		$_lang = $tmp[0];
	}
}else{
	// set default language
	if(isset($_SESSION[$_site_title]['lang'])){
		$_lang = $_SESSION[$_site_title]['lang'];
	}else{
		$_SESSION[$_site_title]['lang'] = $lng_keys[0];
		$_lang = $lng_keys[0];
	}
}

// check if GET['lang'] is set and change the language
if(isset($_GET['lang']) && $_GET['lang'] != "" && !$_is_cms){
	if(in_array($_GET['lang'], array_keys($_website_langs))){
		$_prev_lang = $_lang;
		$_redirect_lng = true;

		$_SESSION[$_site_title]['lang'] = $_GET['lang'];
		$_lang = $_GET['lang'];
	}
}

// Set up Routes
$_router = new router();
$_router->setBasePath(str_replace(($_config['site']['use_https'] ? "https://" : "http://").$_config['site']['domain']."/", "", $_config['site']['path']));

foreach($_config['routes'] as $route_key => $route){
	$_router->map($route[0], $route[1], $route[2], $route[3], $route_key);
}

if($_use_routes){

	// Match the current request
	$match = $_router->match();
	if($match) {
		$_page = $match['name'];
		$_page_file = $match['target'];
		$_params = $match['params'];

		if(isset($_GET['lang']) && in_array($_GET['lang'], array_keys($_website_langs)) && count($_params) == 0){
			if(substr($_page, -3, 1) == "-" && substr($_page, -2, 2) != $_lang){
				$newpage = substr($_page, 0, -2).$_lang;
				$redirect_to_other_link = route($newpage);
				go_away($redirect_to_other_link);
			}
		}elseif($_redirect_lng){
			$new_route = substr($_page, 0, -2).$_lang; //str_replace("-".$_prev_lang, "-".$_lang, $_page);
			if($_config['routes'][$new_route]){
				foreach($_params as $k => $param){
					if(in_array($k, array_keys($_config['routes'][$new_route][3]))){
						unset($_params[$k]);
					}
				}
				$redirect_to = route($new_route, $_params);
				go_away($redirect_to);
			}else{
				go_away($_base);
			}
		}
	} else {
		// else load the 404 template
		$_is_404 = true;
	}
}

// Load shop global
if($_config['site']['is_shop']){
	if(is_file($_base_path . 'lib/shop/global.php')){
		require_once $_base_path . 'lib/shop/global.php';
	}
}

// Load global backend
if(is_file($_base_path . 'backend/global.php')){
	require_once $_base_path . 'backend/global.php';
}

// forms error messages
$_error_messages = array(
	'default' => e('Completeaza corect campul!'),
	'required' => e('Campul nu poate fi gol!'),
	'numeric' => e('Valoarea trebuie sa fie numerica!'),
	'alphanumeric' => e('Valoarea trebuie sa fie alfanumerica!'),
	'letters' => e('Valoarea trebuie sa contina numai litere!'),
	'min' => e('Valoarea trebuie sa fie mai mare decat %value%!'),
	'max' => e('Valoarea trebuie sa fie mai mica decat %value%!'),
	'in' => e('Valoarea trebuie sa fie una dintre urmatoarele: %value%!'),
	'not' => e('Valoarea nu poate fi "%value%"!'),
	'match' => e('Valoarea trebuie sa fie aceeasi ca cea a campului: %value%!'),
	'minlength' => e('Valoarea nu poate avea mai putin de %value% caractere!'),
	'maxlength' => e('Valoarea nu poate avea mai mult de %value% caractere!'),
	'email' => e('Valoarea trebuie sa fie o adresa e-mail valida!'),
	'url' => e('Valoarea trebuie sa fie un url valid!'),
	'date' => e('Data este invalida!'),
	'category' => e('Alege o categorie!'),
	'requiredfile' => e('Nu ati incarcat fisier!'),
	'file' => e('Tipul de fisier nu este permis!'),
	'uniquedb' => e('Valoarea exista deja in baza de date'),
	'uniquedbbyfield' => e('Valoarea exista deja in baza de date'),
);

// SEO - noindex default false
$_no_index = false;

// check maintenance mode
if(file_exists($_base_path.".maintenance") && !$_is_cms){
	header('HTTP/1.1 503 Service Temporarily Unavailable');
	header('Content-Type: text/html; charset=utf-8');
	header('Retry-After: 300');

	if(is_file($_theme_path . 'maintenance.php')) {
		include $_theme_path . 'maintenance.php';
	}else{
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<title><?=e('Mentenanta')." - ".$_site_title?></title>
		</head>
		<body>
			<h1><?=e('Mentenanta')?></h1>
			<p><?=e('Ne cerem scuze, efectuam niste lucrari de mentenanta.')?></p>
		</body>
		</html>
		<?
	}
	exit;
}

// load 404 if needed
if($_is_404){
	header('HTTP/1.0 404 Not Found');
	if(is_file($_theme_path . '404.php')) {
		include $_theme_path . '404.php';
	}
	exit;
}
