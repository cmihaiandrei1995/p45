<?php

/**
 * Language functions for frontend
 *
 */

function __($text, $replace = array(), $lng = '') {
	global $_website_langs, $_lang, $_config;
	
	if($_config['server']['memcache'] || $_config['server']['file_cache']){
		$string = cache_get('lng_var_'.($lng != '' ? $lng : $_lang).'_'.md5($text));
	}else{
		$string = '';
	}
	
	if(!$string){
		$lng_keys = array_keys($_website_langs);
		if($lng != '' && !in_array($lng, $lng_keys)){
			$string = $text;
		}else{
			if(db_table_exists('admin_translation')){
				$translate = db_row('SELECT * FROM admin_translation WHERE title = ? OR title = ? LIMIT 1', generate_name($text), md5($text));
		
				if(!$translate){
					$id_translate = db_query("INSERT INTO admin_translation (`title`, `created`) VALUES (?, NOW())", md5($text));
					foreach($lng_keys as $key){
						db_query("UPDATE admin_translation SET `".$key."` = ? WHERE id_admin_translation = ?", $text, $id_translate);
					}
					$string = $text;
				}else{
					if($lng != '' && $translate[$lng] != ''){
						$string = $translate[$lng];
					}elseif($translate[$_lang] != ''){
						$string = $translate[$_lang];
					}else{
						$string = $text;
					}
				}
			}else{
				$string = $text;
			}
		}
	}
	
	if($_config['server']['memcache'] || $_config['server']['file_cache']){
		cache_set('lng_var_'.($lng != '' ? $lng : $_lang).'_'.md5($text), $string, $_config['server']['memcache_time']);
	}
	
	foreach($replace as $k => $v) {
		$string = str_replace('['.$k.']', $v, $string);
	}

	return $string;
}

function _e($text, $replace = array(), $lng = '') {
	echo __($text, $replace, $lng);
}

function e($text, $lng = ''){
	return __($text, array(), $lng);
}

function switch_lang_link($lng) {
	global $_config, $_prev_lang, $_lang;

	$cur_link = str_replace(array("&lang=".$_prev_lang, "lang=".$_prev_lang, "&lang=".$_lang, "lang=".$_lang), "", ($_config['site']['use_https'] ? "https://" : "http://").$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	if($lng != ""){
		$cur_link = str_replace(array("&lang=".$lng, "lang=".$lng), "", $cur_link);
	}

	if(stripos($cur_link, '?') !== false){
		$cur_link .= "&lang=".$lng;
	}else{
		$cur_link .= "?lang=".$lng;
	}

	return $cur_link;
}






/**
 * Language functions for CMS
 *
 */

function lng($text, $lng = '') {
	global $_base_path_cms, $_lang_cms, $_lang_array;

	if(empty($lng)) {
		if($_lang_cms == "") $_lang_cms = "ro";
		$return = lng($text, $_lang_cms);

		if(!empty($return)) {
			return $_lang_array[$return];
		}

		return $text;
	} else {
		/*
		include $_base_path_cms.'lang/'.$lng.'.php';
		if(is_file($_base_path_cms . 'lang/extra/'.$lng.'.php')){
			include $_base_path_cms . 'lang/extra/'.$lng.'.php';
		}
		*/
		if(isset($_lang_array[$text])) return $text;

		$key = array_search($text, $_lang_array);
		if(!empty($key)) return $key;
	}
}

function _lng($text, $lng = '') {
	return lng($text, $lng);
}