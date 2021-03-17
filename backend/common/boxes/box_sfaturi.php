<?php
//@andrei:
$_text_sfaturi = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 14
));

$_xml_news = cache_get('p45_blog');
if(!$_xml_news){
	$soap_do = curl_init('https://www.paralela45.ro/blog/feed/');
	curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($soap_do, CURLOPT_TIMEOUT, 5);
	curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
	$return = curl_exec($soap_do);
		
	if($return != ""){
		$_xml_news = xml2array($return);
		cache_set('p45_blog', $_xml_news, 60*60);
	}
}