<?php
/**
 * Used for url redirection, with headers if needed
 */
function go_away($url = '', $headers = '') {
	if(empty($url)) {
		global $_base;
		$url = $_base;
	}

	if(!headers_sent()) {
		if($headers){
			switch($headers){
				case '301':
					header('HTTP/1.1 301 Moved Permanently');
				break;
				case '404':
					header('HTTP/1.0 404 Not Found');
				break;
			}
		}
		header('Location: '.$url);
		exit;
	}
}

/**
 * Redirects to 404 custom page if any and sets the header
 */
function error_404(){
	global $_theme_path, $_base;

	header('HTTP/1.0 404 Not Found');
	if(is_file($_theme_path . '404.php')) {
        include $_theme_path . '404.php';
    }
	exit;
}

/**
 * Generates a link based on the route settings
 *
 * First element is the route
 * The rest are variables to be set in the link
 */
function route() {
    global $_router, $_config, $_lang, $_website_langs;

    $args = func_get_args();
    $route = $args[0];
    $params = array();
    unset($args[0]);

	if(count($_website_langs) > 1){
		if(!in_array($route, array_keys($_config['routes']))){
			$route .= '-'.$_lang;
		}
	}

	if(is_array($args[1])){
		$args = $args[1];
	}else{
		$args = array_values($args);
	}

    foreach($args as $key => $arg) {
		if(stripos($_config['routes'][$route][1], "[#:".$key."]") !== false){
			$params[$key] = generate_name($arg, array('+', '/'));
		}else{
			$params[$key] = generate_name($arg);
		}
    }

    try {
        return route_generate($route, $params);
    } catch (Exception $e) {
        print $e->getMessage();
    }
}

/**
 * Generates the route
 */
function route_generate($route, $params) {
    global $_router, $_config;

    if(!is_array($params)) {
        $params = array();
    }

    try {
        $path = $_router->generate($route, $params);
    } catch(Exception $e) {
        $path = '';
    }

	return ($_config['site']['use_https'] ? "https://" : "http://").$_config['site']['domain']. "/" . $path;
}

/**
 * Creates and returns an url for static/uploads folders
 */
function url($path = '', $type = '') {
    global $_base, $_base_static, $_base_uploads;

	if($type == 'static'){
   		return $_base_static . $path;
	}elseif($type == 'uploads'){
		return $_base_uploads . $path;
	}else{
		return $_base . $path;
	}
}

/**
 * Creates and prints an url for static/uploads folders
 */
function urle($path = '', $type = '') {
    global $_base, $_base_static, $_base_uploads;

    if($type == 'static'){
   		echo $_base_static . $path;
	}elseif($type == 'uploads'){
		echo $_base_uploads . $path;
	}else{
		echo $_base . $path;
	}
}

function url_static($path = '') {
    global $_base_static;
   	return $_base_static . $path;
}

function url_uploads($path = '') {
    global $_base_uploads;
   	return $_base_uploads . $path;
}

function path($path = '') {
    global $_base_path;
    return $_base_path . $path;
}

function pathe($path = '') {
    global $_base_path;
    echo $_base_path . $path;
}

function is_url($link){
	if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $link) == 0) {
		return false;
	}
	return true;
}

function addhttp($url) {
    if (!preg_match("@^https?://@i", $url) && !preg_match("@^ftps?://@i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}
