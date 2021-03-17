<?php
$_use_routes = false;
$_is_ajax = true;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/../settings.php';

// create maintenance file
$fh = fopen($_base_path.".maintenance", 'w') or die("Can't create file");

// clear memcache
if($_config['server']['memcache']){

	cache_unset('cms_conf');
	cache_unset('cms_images');

	$lng_vars = db_query('SELECT * FROM admin_translation');
	foreach($lng_vars as $var){
		foreach($_website_langs as $key => $lang){
			cache_unset('lng_var_'.$key.'_'.$var['title']);
		}
	}

	if($_GET['action'] == "all"){
		$keys = get_memcached_keys();
		foreach($keys as $key){
			if(str_like($_config['server']['memcache_prefix'].'_%', $key)){
				cache_unset(str_replace($_config['server']['memcache_prefix']."_", "", $key));
			}
		}
		$_memcache->flush();
	}

}

// clear file cache
if($_config['server']['file_cache']){

	cache_unset('cms_conf');
	cache_unset('cms_images');

	$lng_vars = db_query('SELECT * FROM admin_translation');
	foreach($lng_vars as $var){
		foreach($_website_langs as $key => $lang){
			cache_unset('lng_var_'.$key.'_'.$var['title']);
		}
	}

	if($_GET['action'] == "all"){
		rmdir_recursive($_base_path.'cache/');
	}

}

// remove maintenance file
if(file_exists($_base_path.".maintenance")){
	unlink($_base_path.".maintenance");
}

// Close the conn
$_db->close();
