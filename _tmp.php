<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/config.php';


cache_set('test_var_memcache', 'test text', 60*15);

$test = cache_get('test_var_memcache');


var_dump($test);


$test = cache_get('black_friday_offers');

var_dump($test);


exit;



//$test = send_paralela_mail('alex@prologue.ro', 'Abonare cu succes', array(), 'subscribe');
//var_dump($test);


exit;

$hotel_info = eurositeGetProductInfoRequest('ES0196', 'P45', 'ES', 'ES0053');
update_eurosite_hotel_info($hotel_info);
print_r($hotel_info);

exit;



$countries = eurositeGetCountries();
print_r($countries);


/*
exit;
$tags = db_query('SELECT * FROM hotel_tag');
foreach($tags as $tag){
	db_query('UPDATE hotel_grila SET id_hotel_tag = ? WHERE title = ?', $tag['id_hotel_tag'], $tag['title']);
}
*/



/*
$hotel_info = eurositeGetProductInfoRequest('AE0163', '', 'AE', 'AE0001');
print_r($hotel_info);

exit;




$results = eurositeGetCharterDeparturesRequest();
print_r($results);


exit;
*/


$data = array(
	'city' => 'FILV1',
    'country' => 'FL',
    'date_from' => '2017-12-18',
    'date_to' => '2017-12-22',
    'from_city' => 'ROBCH1',
);


$results = eurositeGetPackageNVPriceRequest($data);

print_r($results);

/*
$data = array(
	'city' => 'FILV1',
    'country' => 'FL',
    'date_from' => '2017-12-18',
    'date_to' => '2017-12-22',
    'rooms' => 1,
    'rooms_info' => array(0 => array('adult' => 2))
);


$results = eurositeGetHotelPriceRequestForPricing($data);

print_r($results);
*/
