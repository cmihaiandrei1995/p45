<?

if(!is_logged_in()){
	go_away(route('login'));
}

$_user = get_logged_in_user();

//$_user['id_user'] = 1005; // 1746, 1005, 240, 2013, 591, 235, 1904

list($_bookings, $count) = get_posts(array(
	'table' => 'booking',
	'id_user' => $_user['id_user']
));

foreach($_bookings as &$item){

	$item['passengers'] = db_query('SELECT * FROM booking_passenger WHERE id_booking = ?', $item['id_booking']);
	$item['search_data'] = json_decode($item['search_data'], true);
	$item['selected_data'] = json_decode($item['selected_data'], true);

	$item['info']['check_in_day'] = date("d.m", strtotime($item['selected_data']['check_in']));
	$item['info']['check_in_year'] = date("Y", strtotime($item['selected_data']['check_in']));
	$item['info']['check_in_weekday'] = $_week_days[date("N", strtotime($item['selected_data']['check_in']))];

	$item['info']['check_out_day'] = date("d.m", strtotime($item['selected_data']['check_out']));
	$item['info']['check_out_year'] = date("Y", strtotime($item['selected_data']['check_out']));
	$item['info']['check_out_weekday'] = $_week_days[date("N", strtotime($item['selected_data']['check_out']))];

	$item['info']['nights'] = days_between_dates($item['selected_data']['check_in'], $item['selected_data']['check_out']);
	$item['info']['days'] = $item['info']['nights']+1;

	foreach($item['passengers'] as $passenger){
		$item['info'][$passenger['type']]++;
	}

	$item['info']['meal_info'] = $item['selected_data']['meal_info'];
	$item['info']['room_info'] = $item['selected_data']['room_info'];
	$item['info']['rooms'] = $item['search_data']['rooms'];

	if(strtotime($item['selected_data']['check_out']) < time()){
		$item['is_old'] = true;
	}

	switch($item['type']){

		case 'circuit':{

			$circuit = get_circuit_by_id($item['selected_data']['circuit_id']);
			$circuit['images'] = get_images('circuit', $circuit['id_circuit']);

			$item['info']['title'] = $circuit['title'];
			$item['info']['image'] = $circuit['images'][0]['small'];

		}break;

		case 'charter':
		case 'tourism':{

			$city = db_row('SELECT * FROM city WHERE code = ?', $item['search_data']['city']);
			$country = db_row('SELECT * FROM country WHERE id_country = ?', $city['id_country']);

			$hotel = get_hotel_by_id($item['selected_data']['id_hotel']);

			if($item['type'] == "charter"){
				if($city['id_zone']){
					$zone = get_zone_by_id($city['id_zone']);
					$item['info']['title'] = "Charter ".$zone['title'];
				}else{
					$item['info']['title'] = "Charter ".$city['title'];
				}

				$city_from = db_row('SELECT * FROM city WHERE code = ?', $item['search_data']['from_city']);
				$item['info']['city_from'] = $city_from['title'];
			}else{
				$item['info']['title'] = $city['title'];
			}


			$item['info']['hotel_title'] = $hotel['title'];
			$item['info']['hotel_stars'] = $hotel['stars'];
			$item['info']['city'] = $city['title'];

			$hotel['images'] = get_images('hotel', $hotel['id_hotel']);
			$item['info']['image'] = $hotel['images'][0]['small'];

		}break;

	}

	unset($item);
}


$_section = "reservations";

// seo
$_meta_title = "Rezervari";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;
