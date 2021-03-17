<?php
// prologue news

if(count($_SESSION[$_site_title]['prlg_news'])){
	$_xml_news = $_SESSION[$_site_title]['prlg_news'];
}else{
	$soap_do = curl_init('https://www.prologue.ro/feed/');
	curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($soap_do, CURLOPT_TIMEOUT, 5);
	curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
	$return = curl_exec($soap_do);
		
	if($return != ""){
		$_xml_news = xml2array($return);
		$_SESSION[$_site_title]['prlg_news'] = $_xml_news;
	}
}