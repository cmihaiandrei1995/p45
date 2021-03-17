<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../config.php';

if(isset($_REQUEST['id'])){
	$_search = db_row('SELECT * FROM hotel_search WHERE id_hotel_search = ?', $_REQUEST['id']);
	if(!$_search) $error = true;

	if(!$error){

		$id_search = $_search['id_hotel_search'];

		$results = cache_get('hotel_search_'.$id_search);

		$city = get_city_by_id($_search['id_city']);
		$country = get_country_by_id($_search['id_country']);

		if(!$results){
			$data = array(
				'city' => $city['code'],
			    'country' => $country['code'],
			    'date_from' => date('Y-m-d', strtotime($_search['date_from'])),
			    'date_to' => date('Y-m-d', strtotime($_search['date_to'])),
			    'rooms' => $_search['rooms'],
			    'rooms_info' => json_decode($_search['room_data'], true)
			);
			$nr_nights = days_between_dates($_search['date_from'], $_search['date_to']);

			$currency = "EUR";
			if($country['id_country'] == 126){
				$currency = "RON";
			}

			$results = eurositeGetHotelPriceRequestForPricing($data, $currency);

			if($results['Hotel']){
				$success = true;
				cache_set('hotel_search_'.$id_search, $results, 60*60);
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
	db_query('UPDATE hotel_search SET status = "error" WHERE id_hotel_search = ?', $id_search);

	if($_search['is_ro']){
		$result['url'] = route('tourism-ro-cat', $_search['destination']);
	}else{
		$result['url'] = route('tourism', $_search['destination']);
	}
	$result['url'] .= "?ct=".$city['id_city']."&error";
}elseif($success){
	$result['success'] = 1;
	db_query('UPDATE hotel_search SET status = "success" WHERE id_hotel_search = ?', $id_search);

	if($_search['is_ro']){
		$result['url'] = $result['url'] = route('tourism-ro-search', $_search['destination'], $id_search);
	}else{
		$result['url'] = $result['url'] = route('tourism-search', $_search['destination'], $id_search);
	}
}

echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
