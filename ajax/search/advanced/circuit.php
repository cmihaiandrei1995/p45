<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../config.php';

if(isset($_REQUEST['id'])){
	$_search = db_row('SELECT * FROM circuit_search WHERE id_circuit_search = ?', $_REQUEST['id']);
	if(!$_search) $error = true;

	if(!$error){

		$id_search = $_search['id_circuit_search'];

		$results = cache_get('circuit_search_'.$id_search);

		$continent = get_continent_by_id($_search['id_continent']);
		$country = get_country_by_id($_search['id_country']);

		if(!$results){
			$data = array(
			    'country' => $country['code'],
			    'year' => $_search['year'],
			    'month' => $_search['month'],
			    'rooms' => $_search['rooms'],
			    'rooms_info' => json_decode($_search['room_data'], true)
			);

			$results = eurositeCircuitSearchRequestForPricing($data);

			if($results['Circuit']){
				$success = true;
				cache_set('circuit_search_'.$id_search, $results, 60*60);
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
	db_query('UPDATE circuit_search SET status = "error" WHERE id_circuit_search = ?', $id_search);

	$result['url'] = route('circuits', $continent['title'], $country['title'])."?error";
}elseif($success){
	$result['success'] = 1;
	db_query('UPDATE circuit_search SET status = "success" WHERE id_circuit_search = ?', $id_search);

	$result['url'] = route('circuits-search', $continent['title'], $country['title'], $id_search);
}

echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();
