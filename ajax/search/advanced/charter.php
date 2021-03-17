<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../config.php';

if(isset($_REQUEST['id'])){
	$_search = db_row('SELECT * FROM charter_search WHERE id_charter_search = ?', $_REQUEST['id']);
	if(!$_search) $error = true;

	if(!$error){

		$id_search = $_search['id_charter_search'];

		$results = cache_get('charter_search_'.$id_search);

		$zone = get_zone_by_id($_search['id_zone']);
		if(!$zone){
			$city = get_city_by_id($_search['id_zone']);
			$zone = get_zone_by_id($city['id_zone']);
		}else{
			$city = get_post(array(
				'table' => 'city',
				'id_zone' => $zone['id_zone'],
				'home_charter' => 1,
				'limit' => 1
			));
		}
		$country = get_country_by_id($_search['id_country']);
		$city_from = get_city_by_id($_search['id_city_from']);

		if(in_array($country['id_country'], $_problematic_countries_with_1_day_flight)){
			$_search['date_to'] = date('Y-m-d', strtotime($_search['date_to']." -1day"));
		}

		if(!$results){
			$data = array(
				'city' => $city['code'],
				'zone' => $zone['code'],
			    'country' => $country['code'],
			    'from_city' => $city_from['code'],
			    'date_from' => date('Y-m-d', strtotime($_search['date_from'])),
			    'date_to' => date('Y-m-d', strtotime($_search['date_to'])),
			    'rooms' => $_search['rooms'],
			    'rooms_info' => json_decode($_search['room_data'], true)
			);
			$nr_nights = days_between_dates($_search['date_from'], $_search['date_to']);

			$results = eurositeGetPackageNVPriceRequestForPricing($data);

			if($results['Hotel']){
				$success = true;
				cache_set('charter_search_'.$id_search, $results, 60*60);
			}else{
				$error = true;
			}
		}else{
			$success = true;
		}
	}
}


if($error){
	$result['error'] = 1;
	db_query('UPDATE charter_search SET status = "error" WHERE id_charter_search = ?', $id_search);

	$result['url'] = get_charter_link($zone, $zone['title'], $city_from['title']);
	$result['url'] .= "?ct=".$city['id_city']."&error";
}elseif($success){
	$result['success'] = 1;
	db_query('UPDATE charter_search SET status = "success" WHERE id_charter_search = ?', $id_search);

	$result['url'] = route('charters-search', $zone['title'], $city_from['title'], $id_search);
}

echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
