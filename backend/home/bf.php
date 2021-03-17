<?

if(!isset($_GET['demo'])){
    go_away(route('home'));
	exit;
}



$_cities_from = array(
	'bucuresti' => 'Bucuresti',
	'cluj-napoca' => 'Cluj Napoca',
	'iasi' => 'Iasi',
	'arad' => 'Arad <b>NOU!</b>',
	'bacau' => 'Bacau <b>NOU!</b>',
	'baia-mare' => 'Baia Mare <b>NOU!</b>',
	'oradea' => 'Oradea <b>NOU!</b>',
	//'sibiu' => 'Sibiu <b>NOU!</b>',
	'targu-mures' => 'Targu Mures <b>NOU!</b>',
	'timisoara' => 'Timisoara'
);

$_cities_from_ids = array(
	'bucuresti' => 14997,
	'cluj napoca' => 15023,
	'iasi' => 15086,
	'arad' => 14944,
	'bacau' => 14951,
	'baia mare' => 14954,
	'oradea' => 15133,
	'sibiu' => 15199,
	'targu mures' => 15224,
	'timisoara' => 15234
);

$_offers_titles = array(
	'charter' => 'Pachete de vacanta',
	'tourism' => 'Turism individual',
	//'tourism_ro' => 'Turism intern',
	'circuit' => 'Circuite cu avionul'
);

$_offers_icons = array(
	'charter' => '01',
	'tourism' => '03',
	//'tourism_ro' => 'Turism intern',
	'circuit' => '01'
);


$_offers = cache_get('black_friday_offers');
$_sidebar = cache_get('black_friday_sidebar');

if(!$_offers || !$_sidebar){

	// chartere
	if (($handle = fopen($_base_path.'backend/home/bf/chartere_18.csv', "r")) !== FALSE) {
	    while (($tmp = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$hotel = get_hotel_by_eurosite_code_and_tourop(trim($tmp[0]), 'P45');
			if($hotel){
				$zone = db_row('SELECT * FROM zone WHERE title LIKE "%'.trim($tmp[3]).'%"');
				if($zone){

					$country = get_country_by_id($zone['id_country']);
					$city_from = db_row('SELECT * FROM city WHERE id_city = ?', $_cities_from_ids[strtolower(trim($tmp[1]))]);

					if($city_from){
						$dates = explode("-", $tmp[4]);
						$date_from = explode(".", trim($dates[0]));
						$date_to = explode(".", trim($dates[1]));

						if(!isset($date_from[2])){
							$from = $date_from[0] . '-' . $date_from[1] . '-' . $date_to[2];
						}else{
							$from = $date_from[0] . '-' . $date_from[1] . '-' . $date_from[2];
						}
						$to =  $date_to[0] . '-' . $date_to[1] . '-' . $date_to[2];

						$hotel['offer_type'] = "charter";

						$hotel = hotel_prepare_charter_info($hotel, $zone, $city_from, array(), $from, $to);
						$hotel['images'] = get_images('hotel', $hotel['id_hotel']);

						$hotel['url'] .= "?d=".date('d.m.Y', strtotime($from))."&t=".date('d.m.Y', strtotime($to));

						//$hotel['valabilitate'] = trim($tmp[5]);
						if(trim($tmp[6]) != ""){
							$hotel['discount_txt'] = "-".trim($tmp[6]);
						}
						if(trim($tmp[7]) != ""){
							$hotel['extra_txt'] = trim($tmp[7]);
						}

						if($hotel['images'][0]['small'] && $hotel['price'] > 0){
							$_offers[generate_name($city_from['title'])]['charter'][$country['title']][$zone['title']][] = $hotel;
							if(!in_array($zone['title'], $_sidebar[generate_name($city_from['title'])]['charter'][$country['title']])){
								$_sidebar[generate_name($city_from['title'])]['charter'][$country['title']][] = $zone['title'];
							}
						}
					}
				}
			}

			$i++;
		}
		fclose($handle);
	}



	// turism individual
	if (($handle = fopen($_base_path.'backend/home/bf/turism_individual_18.csv', "r")) !== FALSE) {
	    while (($tmp = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$hotel = get_hotel_by_eurosite_code(trim($tmp[0]));
			if($hotel){
				$zone = db_row('SELECT * FROM city WHERE title LIKE "'.trim($tmp[2]).'%"');
				if($zone){
					$country = get_country_by_id($zone['id_country']);

					$dates = explode("-", $tmp[3]);
					$date_from = explode(".", trim($dates[0]));
					$date_to = explode(".", trim($dates[1]));

					if(!isset($date_from[2])){
						$from = $date_from[0] . '-' . $date_from[1] . '-' . $date_to[2];
					}else{
						$from = $date_from[0] . '-' . $date_from[1] . '-' . $date_from[2];
					}
					$to =  $date_to[0] . '-' . $date_to[1] . '-' . $date_to[2];

					$hotel = hotel_prepare_info($hotel);
					//$hotel = hotel_get_price($hotel, $from, $to);

					$hotel['images'] = get_images('hotel', $hotel['id_hotel']);

					//$hotel['valabilitate'] = trim($tmp[4]);
					if($hotel['discount'] != ""){
						$hotel['discount_txt'] = "-".$hotel['discount']."%";
					}

					$hotel['offer_type'] = "hotel";

					$hotel['period_txt'] = trim($tmp[4]);

					$hotel['url'] .= "?d=".date('d.m.Y', strtotime($from))."&t=".date('d.m.Y', strtotime($to));

					if($hotel['images'][0]['small'] && $hotel['price'] > 0){
						foreach($_cities_from as $key => $city){
							$_offers[$key]['tourism'][$country['title']][$zone['title']][] = $hotel;
						}

						foreach($_cities_from as $key => $city){
							if(!in_array($zone['title'], $_sidebar[$key]['tourism'][$country['title']])){
								$_sidebar[$key]['tourism'][$country['title']][] = $zone['title'];
							}
						}
					}
				}
			}

			$i++;
		}
		fclose($handle);
	}

    /*
	// turism intern
	if (($handle = fopen($_base_path.'backend/home/bf/tourism_ro.csv', "r")) !== FALSE) {
	    while (($tmp = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$hotel = get_hotel_by_eurosite_code(trim($tmp[0]));
			if($hotel){
				$zone = db_row('SELECT * FROM city WHERE title LIKE "%'.trim($tmp[3]).'%"');
				if($zone){
					$hotel = hotel_prepare_info($hotel);
					$hotel['images'] = get_images('hotel', $hotel['id_hotel']);

					//$hotel['valabilitate'] = trim($tmp[4]);
					if($hotel['discount'] != ""){
						$hotel['discount_txt'] = "-".$hotel['discount']."%";
					}

					if($hotel['images'][0]['small'] && $hotel['price'] > 0){
						foreach($_cities_from as $key => $city){
							$_offers[$key]['tourism_ro'][$zone['title']][] = $hotel;
						}

						foreach($_cities_from as $key => $city){
							if(!in_array($zone['title'], $_sidebar[$key]['tourism_ro'])){
								$_sidebar[$key]['tourism_ro'][] = $zone['title'];
							}
						}
					}
				}
			}

			$i++;
		}
		fclose($handle);
	}
    */

	// circuite
	if (($handle = fopen($_base_path.'backend/home/bf/circuite_18.csv', "r")) !== FALSE) {
	    while (($tmp = fgetcsv($handle, 1000, ",")) !== FALSE) {

			$hotel = get_circuit_by_eurosite_code(trim($tmp[0]));
			if($hotel){
				$zone = get_country_by_id($hotel['id_country']);
				if($zone){
					$city_from = db_row('SELECT * FROM city WHERE id_city = ?', $_cities_from_ids[strtolower(trim($tmp[2]))]);

					if($city_from){
						$hotel = circuit_prepare_info($hotel);
						$hotel['images'] = get_images('circuit', $hotel['id_circuit']);

						$hotel['plecare'] = date("d.m.Y", strtotime(trim($tmp[1])));

						if(trim($tmp[3]) != ""){
							$hotel['discount_txt'] = "-".str_replace(array(" ", "euro"), array("", "&euro;"), trim($tmp[3]));
						}
						if(trim($tmp[4]) != ""){
							$hotel['extra_txt'] = trim($tmp[4]);
						}

						$hotel['offer_type'] = "circuit";

						if($hotel['images'][0]['small'] && $hotel['price'] > 0){
							$_offers[generate_name($city_from['title'])]['circuit'][$zone['title']][$zone['title']][] = $hotel;

							if(!in_array($zone['title'], $_sidebar[generate_name($city_from['title'])]['circuit'])){
								$_sidebar[generate_name($city_from['title'])]['circuit'][$zone['title']][] = $zone['title'];
							}
						}
					}
				}
			}

			$i++;
		}
		fclose($handle);
	}


	foreach($_offers as $city_from => $offers){
		foreach($offers as $offer => $countries){
			foreach($countries as $country => $zones){
				foreach($zones as $zone => $hotels){
					usort($_offers[$city_from][$offer][$country][$zone], function($a, $b){
						if($a['discount'] == $b['discount']){
					        return 0;
					    }
					    return ($a['discount'] > $b['discount']) ? -1 : 1;
					});
				}
			}
		}
	}

	cache_set('black_friday_offers', $_offers, 60*15);
	cache_set('black_friday_sidebar', $_sidebar, 60*15);
}

$_section = "home";

// seo
$_meta_title = 'Black Friday';
$_meta_description = '';
$_meta_keywords = '';
$_no_index = false;
