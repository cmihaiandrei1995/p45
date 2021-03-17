<?

if(!is_logged_in()){
	go_away(route('login'));
}

$_user = get_logged_in_user();

$_ipp = 10;

$_whishlist_items = db_query('SELECT * FROM user_whishlist WHERE id_user = ? ORDER BY created DESC', $_user['id_user']);
if($_whishlist_items){

	foreach($_whishlist_items as $k => &$item){

		switch($item['type']){

			case 'circuit':{

				$item = get_circuit_by_id($item['id_offer']);
				if($item){
					$item = circuit_prepare_info($item);

					$item['images'] = get_images('circuit', $item['id_circuit']);
					$item['image'] = $item['images'][0]['thumb'];

					if($item['categories_txt']){
						$item['subtitle'] .= implode(", ", $item['categories_txt'])." • ";
					}
					$item['subtitle'] .= $item['days']." zile / ".$item['nights']." nopti";

					$item['short_desc'] .= "<br><br> <b>Plecar".(count($item['dates']) > 1 ? "i" : "e").": ".implode(", ", $item['dates'])."</b>";
				}else{
					unset($_whishlist_items[$k]);
				}
			}break;

			case 'charter':{

				$city_from = get_city_by_id($item['id_city_from']);
				if($city_from){
					$item = get_hotel_by_id($item['id_offer']);
					if($item) {
						$city = get_city_by_id($item['id_city']);
						if($city) {
							$to = $city;
							if($city['id_zone'] > 0){
								$zone = get_zone_by_id($city['id_zone']);
								$to = $zone;
							}

							$item = hotel_prepare_charter_info($item, $to, $city_from);

							$item['images'] = get_images('hotel', $item['id_hotel']);
							$item['image'] = $item['images'][0]['thumb'];

							$item['subtitle'] = $item['title'];
							if($to['charter_type'] == "sejur"){
								$item['title'] = "Sejur ".$to['title'];
							}else{
								$item['title'] = "Charter ".$to['title'];
							}
							$item['city'] = $city['title'];
						}else{
							unset($_whishlist_items[$k]);
						}
					}else{
						unset($_whishlist_items[$k]);
					}
				}else{
					unset($_whishlist_items[$k]);
				}

			}break;

			case 'cruise':{

				$item = get_cruise_by_id($item['id_offer']);
				if($item){
					$item = get_cruise_info($item);

					$item['image'] = $item['images'][0]['medium'];

					$item['short_desc'] .= "<br><br> <b>Plecare din:</b> ".$item['departure']['title'];
					$item['short_desc'] .= "<br> <b>Vas:</b> ".$item['ship']['title'];
					$item['short_desc'] .= "<br> <b>Porturi:</b> ".implode(' - ', $item['ports']);
					if($item['dates']){
						foreach($item['dates'] as $year => $dates){
							$item['short_desc'] .= "<br> <b>Plecari ".$year.":</b> ".implode(', ', $dates);
						}
					}
					if($item['plane_included'] == 1){
						$item['short_desc'] .= "<br> <b>Zbor inclus</b>";
					}
				}else{
					unset($_whishlist_items[$k]);
				}

			}break;

			case 'hotel':{

				$item = get_hotel_by_id($item['id_offer']);
				if($item){
					$item = hotel_prepare_info($item);

					$item['images'] = get_images('hotel', $item['id_hotel']);
					$item['image'] = $item['images'][0]['thumb'];

					$city = get_city_by_id($item['id_city']);
					$item['city'] = $city['title'];
				}else{
					unset($_whishlist_items[$k]);
				}

			}break;

		}

		unset($item);
	}

}

$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
$_count = count($_whishlist_items);
$_whishlist_items = array_slice($_whishlist_items, $offset, $_ipp);


$_section = "whishlist";

// seo
$_meta_title = "Whishlist";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;
