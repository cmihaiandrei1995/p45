<?php

/**
 * Checks if the user's ip address in $_SERVER['REMOTE_ADDR'] is considered a safe one for debugging
 * 
 * @return boolean		If the user's ip is safe or not
 */
function safe_ip(){
	global $_config;
	if(count($_config['site']['debug_ips'])){
		return in_array($_SERVER['REMOTE_ADDR'], $_config['site']['debug_ips']);
	}else{
		return true;
	}
}

/**
 * Checks if debug mode is active
 * If the user is in the safe ip list, it will active debug mode anyway
 * 
 * @return boolean
 */
function debug_mode(){
	global $_config;
	return $_config['site']['debug'] || safe_ip();
}

/**
 * Throw error
 */
function err($var, $safe = true){
    $bt = debug_backtrace();
    $output = "";
    foreach($bt as $caller){
        $output .= $caller['file'].': '.$caller['line']."<br>";
    }

    if(!$safe || ($safe && debug_mode())) {
        echo '<div style="font: 10px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">'.$output.'</div>';
        echo '<pre style="font: 11px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">';
        echo $var;
        echo '</pre>';
    }
}

/**
 * Function for printing on screen debug data
 */
function ld($var, $safe = true){
    $bt = debug_backtrace();
    $caller = array_shift($bt);

    if(!$safe || ($safe && debug_mode())) {
        echo '<span style="font: 10px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">'.$caller['file'].': '.$caller['line'].'</span>';
        echo '<pre style="font: 11px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">';
        var_dump($var);
        echo '</pre>';
    }
}

/**
 * Function for printing on screen debug data
 */
function ld_db($err, $query, $safe = true){
	$bt = debug_backtrace();
	$output = "";
	foreach($bt as $caller){
		$output .= $caller['file'].': '.$caller['line']."<br>";
	}
	
	if(!$safe || ($safe && debug_mode())) {
	    echo '<div style="font: 10px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">'.$output.'</div>';
		echo '<pre style="font: 11px/12px monospace; color: red; background: #ffffff; padding: 5px; margin: 0;">';
		echo $err;
		echo '</pre>';
		echo '<pre style="font: 11px/12px monospace; background: #ffffff; padding: 5px; margin: 0;">';
		echo $query;
		echo '</pre>';
	}
}
