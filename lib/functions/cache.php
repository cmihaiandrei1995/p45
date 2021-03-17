<?php

/**
 * Sets a variable in memcache / file cache
 *
 * @param  string		$var_name 	Name of the variable in the cache
 * @param  string/array	$content 	Content of the variable
 * @param  int			$life 		Life in seconds
 * @return boolean        			Result of the inseration
 */
function cache_set($var_name, $content, $life, $type = "memcache"){
	global $_config, $_is_cron, $_is_cms, $_base_path;

	if($_is_cron) return false;
	if(file_exists($_base_path.".maintenance") && !$_is_cms) return false;

	if($_config['server']['memcache'] && $type == "memcache"){
		global $_memcache;
		return $_memcache->set($_config['server']['memcache_prefix'].'_'.$var_name, $content, MEMCACHE_COMPRESSED, $life);
	}elseif($_config['server']['file_cache'] || ($type == "file" && $_config['server']['file_cache'])){
		global $_file_cache;
		return $_file_cache->store($var_name, $content, $life);
	}

	return false;
}

/**
 * Retrieves a variable from memcache / file cache
 *
 * @param  string		$var_name 	Name of the variable in the cache
 * @return string/array	   			Returns the variable
 */
function cache_get($var_name, $type = "memcache"){
	global $_config, $_is_cron, $_is_cms, $_base_path;

	if(file_exists($_base_path.".maintenance") && !$_is_cms) return false;
	if(isset($_GET['cc'])) return false;

	if($_config['server']['memcache'] && $type == "memcache"){
		global $_memcache;
		return $_memcache->get($_config['server']['memcache_prefix'].'_'.$var_name);
	}elseif($_config['server']['file_cache'] || ($type == "file" && $_config['server']['file_cache'])){
		global $_file_cache;
		return $_file_cache->fetch($var_name);
	}

	return false;
}

/**
 * Delete a variable from memcache / file cache
 *
 * @param  string		$var_name 	Name of the variable in the cache
 * @return string/array	   			Returns the variable
 */
function cache_unset($var_name, $type = "memcache"){
	global $_config;

	if($_config['server']['memcache'] && $type == "memcache"){
		global $_memcache;
		return $_memcache->delete($_config['server']['memcache_prefix'].'_'.$var_name);
	}elseif($_config['server']['file_cache'] || ($type == "file" && $_config['server']['file_cache'])){
		global $_file_cache;
		return $_file_cache->store($var_name, NULL, 1);
	}

	return false;
}


function get_memcached_keys(){
	global $_config;

    $mem = @fsockopen($_config['server']['memcache_host'], $_config['server']['memcache_port']);
    if ($mem === FALSE) return -1;

    // retrieve distinct slab
    $r = @fwrite($mem, 'stats items' . chr(10));
    if ($r === FALSE) return -2;

    $slab = array();
    while (($l = @fgets($mem, 1024)) !== FALSE) {
        // sortie ?
        $l = trim($l);
        if ($l == 'END') break;

        $m = array();
        // <STAT items:22:evicted_nonzero 0>
        $r = preg_match('/^STAT\sitems\:(\d+)\:/', $l, $m);
        if ($r != 1) return -3;
        $a_slab = $m[1];

        if (!array_key_exists($a_slab, $slab)) $slab[$a_slab] = array();
    }

    // recuperer les items
    reset($slab);
    foreach ($slab AS $a_slab_key => &$a_slab) {
        $r = @fwrite($mem, 'stats cachedump ' . $a_slab_key . ' 100' . chr(10));
        if ($r === FALSE) return -4;

        while (($l = @fgets($mem, 1024)) !== FALSE) {
            // sortie ?
            $l = trim($l);
            if ($l == 'END') break;

            $m = array();
            // ITEM 42 [118 b; 1354717302 s]
            $r = preg_match('/^ITEM\s([^\s]+)\s/', $l, $m);
            if ($r != 1) return -5;
            $a_key = $m[1];

            $a_slab[] = $a_key;
        }
    }

    // close
    @fclose($mem);
    unset($mem);

    // transform it;
    $keys = array();
    reset($slab);
    foreach ($slab AS &$a_slab) {
        reset($a_slab);
        foreach ($a_slab AS &$a_key) $keys[] = $a_key;
    }
    unset($slab);

    return $keys;
}
