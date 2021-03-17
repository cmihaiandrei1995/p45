<?

function getHotelDetails($hotelCode, $touropCode, $field){
    $details = db_row('SELECT '.$field.' FROM hotel WHERE code = ? AND tourop_code = ?', $hotelCode, $touropCode);

    return $details[$field];
}

function get_hotel_details_by_eurosite_code($field, $code){
    return db_row('SELECT '.$field.' FROM hotel WHERE code = ?', $code);
}

// no longer used
function get_hotel_by_eurosite_code($code){
    $item = db_row('SELECT * FROM hotel WHERE code = ?', $code);
    if($item){
        $item['title'] = ucwords(strtolower($item['title']));
    }
    return $item;
}

function get_hotel_by_eurosite_code_and_tourop($code, $tourop){
    $item = db_row('SELECT * FROM hotel WHERE code = ? AND tourop_code = ?', $code, $tourop);
    if($item){
        $item['title'] = ucwords(strtolower($item['title']));
    }
    return $item;
}

function get_hotel_by_id($id){
    $item = db_row('SELECT * FROM hotel WHERE id_hotel = ? AND '.db_is_active('', 'hotel'), $id);
    if($item){
        $item['title'] = ucwords(strtolower($item['title']));
    }
	return $item;
}

function get_hotel_tag_by_slug($slug){
	list($tags, $count) = get_posts(array(
		'table' => 'hotel_tag',
		'limit' => -1
	));

	foreach($tags as $tag){
		if(generate_name($tag['title']) == $slug){
			return $tag;
		}
	}

	return null;
}

function get_hotel_tag_by_id($id){
	return db_row('SELECT * FROM hotel_tag WHERE id_hotel_tag = ?', $id);
}

function get_hotel_group_tag_by_slug($slug){
	list($tags, $count) = get_posts(array(
		'table' => 'hotel_group_tag',
		'limit' => -1
	));

	foreach($tags as $tag){
		if(generate_name($tag['title']) == $slug){
			return $tag;
		}
	}

	return null;
}

function get_hotel_group_tag_by_id($id){
	return db_row('SELECT * FROM hotel_group_tag WHERE id_hotel_group_tag = ?', $id);
}

function hotel_prepare_basic_info($item){
	$item['url'] = route('tourism-item', $item['title'], $item['id_hotel']);

	$item['title'] = ucwords(strtolower($item['title']));

	if(!$item['images']){
		$item['images'][0] = array(
			'thumb' => url('img/nohotel-small.jpg', 'static'),
			'small' => url('img/nohotel-small.jpg', 'static'),
			'big' => url('img/nohotel-big.jpg', 'static')
		);
	}

	$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['description'], 100));
	if($item['short_desc'] == ""){
		$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['localization'], 100));
		if($item['short_desc'] == ""){
			$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['hotel_info'], 100));
			if($item['short_desc'] == ""){
				$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['other_info'], 100));
			}
		}
	}

	return $item;
}


function hotel_prepare_info($item){
    global $_base, $is_ro, $_country, $_currency_symbol;

	$item['url'] = route('tourism-item', $item['title'], $item['id_hotel']);

	$item['title'] = ucwords(strtolower($item['title']));

	$item = hotel_get_price($item);

    $item['currency'] = $_currency_symbol['EUR'];
    if($is_ro || $_country['id_country'] == 126 || $item['id_country'] == 126){
        $item['currency'] = $_currency_symbol['RON'];
    }

	$item['map_url'] = route('tourism-map', $item['id_hotel']);

	$item['periods'] = db_query('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from > "'.date('Y-m-d').'" ORDER BY date_from ASC, date_to ASC', $item['id_hotel']);

	$meals = db_query('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from > ? GROUP BY meal', $item['id_hotel'], date('Y-m-d'));
	if($meals){
		foreach($meals as $meal){
			//$item['meals'][] = $meal['meal'] != "" ? $meal['meal'] : "Fara masa";
			if($meal['meal'] != ""){
				$item['meals'][] = $meal['meal'];
			}
		}
	}

	if(!$item['images']){
		$item['images'][0] = array(
			'thumb' => url('img/nohotel-small.jpg', 'static'),
			'small' => url('img/nohotel-small.jpg', 'static'),
			'big' => url('img/nohotel-big.jpg', 'static')
		);
	}

    if($item['video_local']){
        $item['video'] = true;
        $item['video_thumb'] = $item['images'][0]['thumb'];
		$item['video_big'] = $item['images'][0]['big'];
        $item['video_file'] = $_base."video/".$item['video_local'];
    }elseif($item['video']){
		$item['video_id'] = get_video_id($item['video']);
		$item['video_thumb'] = get_video_thumb($item['video']);
		$item['video_big'] = get_video_thumb($item['video']);
		$item['video_code'] = get_video_code($item['video'], 848, 480);
	}

	$item['city'] = get_city_by_id($item['id_city']);
    if($item['city']['id_zone'] > 0){
        $item['zone'] = get_zone_by_id($item['city']['id_zone']);
    }

	$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['description'], 100));
	if($item['short_desc'] == ""){
		$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['localization'], 100));
		if($item['short_desc'] == ""){
			$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['hotel_info'], 100));
			if($item['short_desc'] == ""){
				$item['short_desc'] = str_replace(array('<br />', '<br/>', '<br>', "&lt;br&gt;"), '', limit_text($item['other_info'], 100));
			}
		}
	}

	return $item;
}


function hotel_get_price($item, $date_from = "", $date_to = ""){

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	if($date_from != "" && $date_to != ""){
		$price = db_row('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from LIKE "'.date('Y-m-d', strtotime($date_from)).'%" AND date_to LIKE "'.date('Y-m-d', strtotime($date_to)).'%" ORDER BY price ASC LIMIT 1', $item['id_hotel']);
	}else{
		$price = db_row('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from > NOW() ORDER BY price ASC LIMIT 1', $item['id_hotel']);
	}

	if(round($price['priceNoRedd']) > 0 && round($price['priceNoRedd']) > round($price['price'])){
		$item['price_old'] = round($price['priceNoRedd']);
		$item['price'] = round($price['price']);

		if(!$price['reduction_type']) $price['reduction_type'] = 1;
		if($price['reduction_type'] == 1){
			$item['discount'] = 100 - round(($item['price']/$item['price_old']) * 100);
		}elseif($price['reduction_type'] == 2){
			$item['discount'] = $item['price_old'] - $item['price'];
		}
		$item['reduction_type'] = $price['reduction_type'];

		$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

		if(str_like('%EB%', $price['description'])){
			$item['early_booking'] = true;
		}elseif(str_like('%last minute%', $price['description'])){
			$item['last_minute'] = true;
		}elseif($item['discount'] > 0 || str_like('%oferta speciala%', $price['description'])){
			$item['special_offer'] = true;
		}
	}else{
		$item['price'] = round($price['price']);
	}

	$item['nights'] = $price['nr_nights'];

	return $item;
}


function hotel_prepare_info_special_tag($item, $id_hotel_tag){

	$item = hotel_prepare_info($item);

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	$special_tag = db_row('SELECT * FROM hotel_grila WHERE id_hotel = ? AND id_hotel_tag = ?', $item['id_hotel'], $id_hotel_tag);

	if($special_tag){
		$price = db_row('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from = ? AND date_to = ? ORDER BY price ASC LIMIT 1', $item['id_hotel'], $special_tag['date_offer_from'], $special_tag['date_offer_to']);
		if(round($price['priceNoRedd']) > 0 && round($price['priceNoRedd']) > round($price['price'])){
			$item['price_old'] = round($price['priceNoRedd']);
			$item['price'] = round($price['price']);

			if(!$price['reduction_type']) $price['reduction_type'] = 1;
			if($price['reduction_type'] == 1){
				$item['discount'] = 100 - round(($item['price']/$item['price_old']) * 100);
			}elseif($price['reduction_type'] == 2){
				$item['discount'] = $item['price_old'] - $item['price'];
			}
			$item['reduction_type'] = $price['reduction_type'];

			$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

			if(str_like('%EB%', $price['description'])){
				$item['early_booking'] = true;
			}elseif(str_like('%last minute%', $price['description'])){
				$item['last_minute'] = true;
			}elseif($item['discount'] > 0 || str_like('%oferta speciala%', $price['description'])){
				$item['special_offer'] = true;
			}
		}else{
			$item['price'] = round($price['price']);
		}
	}

	return $item;
}

function hotel_prepare_info_from_search($item, $search, $results){

	$item = hotel_prepare_info($item);

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	foreach($results as $s_item){
		$code = $s_item['Product']['ProductCode']['value'];
		if($code == $item['code']){
			$search_info = $s_item;
			break;
		}
	}

	if($search_info){

		$offers = array();
        if($search_info['Offers']['Offer']['OfferType']['value']){
        	$offers[] = $search_info['Offers']['Offer'];
        }else{
            $offers = $search_info['Offers']['Offer'];
        }

		foreach($offers as $offer){
			if($offer['Availability']['attr']['Code'] != "ST"){
				$hotel_offer = $offer;
				break;
			}
		}

		if($hotel_offer){
			$meal = $hotel_offer['Meals']['Meal']['value'];
        	$price = $hotel_offer['Gross']['value'];
            $price_no_redd = $hotel_offer['PriceNoRedd']['value'];
            $offer_desc = $hotel_offer['OfferDescription']['value'];

			if($price_no_redd > 0 && $price_no_redd > $price){
				$item['price_old'] = round($price_no_redd);
				$item['price'] = round($price);

				$item['discount'] = 100 - round(($item['price']/$item['price_old']) * 100);
				$item['reduction_type'] = 1;

				$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

				if(str_like('%EB%', $offer_desc)){
					$item['early_booking'] = true;
				}elseif(str_like('%last minute%', $offer_desc)){
					$item['last_minute'] = true;
				}elseif($item['discount'] > 0 || str_like('%oferta speciala%', $offer_desc)){
					$item['special_offer'] = true;
				}
			}else{
				$item['price'] = round($price);
			}

			$item['url'] .= "?s=".$search['id_hotel_search'];
		}

	}

	return $item;
}


function update_eurosite_hotel_info($hotel){
	global $_eurosite_facility_to_code;

	$item = get_hotel_by_eurosite_code_and_tourop($hotel['Product']['ProductCode']['value'], $hotel['Product']['TourOpCode']['value']);

	$country = get_country_by_iso_code($hotel['Product']['CountryCode']['value']);
	$city = get_city_by_eurosite_code($hotel['Product']['CityCode']['value']);
    if(!$country) $country = get_country_by_id($city['id_country']);

	if($item){
		$id_hotel = $item['id_hotel'];

		if($item['allow_update']){
			db_query('UPDATE hotel SET title = ?, code = ?, tourop_code = ?, id_country = ?, id_city = ?, stars = ? WHERE id_hotel = ?', $hotel['Product']['ProductName']['value'], $hotel['Product']['ProductCode']['value'], $hotel['Product']['TourOpCode']['value'], $country['id_country'], $city['id_city'], $hotel['Product']['ProductCategory']['value'], $id_hotel);
		}
	}else{
		if($hotel['Product']['ProductCode']['value'] != "" && $hotel['Product']['ProductName']['value'] != "" && $hotel['Product']['TourOpCode']['value'] != ""){
			$id_hotel = db_query('INSERT INTO hotel SET title = ?, code = ?, tourop_code = ?, id_country = ?, id_city = ?, stars = ?, allow_update = 1, active = 0', $hotel['Product']['ProductName']['value'], $hotel['Product']['ProductCode']['value'], $hotel['Product']['TourOpCode']['value'], $country['id_country'], $city['id_city'], $hotel['Product']['ProductCategory']['value']);
			$item['allow_update'] = true;
		}
	}

	if($id_hotel){

		if($hotel['Product']['Latitude']['value'] != "" && $hotel['Product']['Longitude']['value'] != ""){
			db_query('UPDATE hotel SET latitude = ?, longitude = ? WHERE id_hotel = ?', $hotel['Product']['Latitude']['value'], $hotel['Product']['Longitude']['value'], $id_hotel);
		}

		$address = $hotel['Product']['Adress']['value'];
		if($address != ""){
			db_query('UPDATE hotel SET address = ? WHERE id_hotel = ?', $address, $id_hotel);
		}

		$descriptions = array();
		if($hotel['Product']['SpecialDescriptions']['SpecialDescription']['value']){
        	$descriptions[] = $hotel['Product']['SpecialDescriptions']['SpecialDescription'];
        }else{
            $descriptions = $hotel['Product']['SpecialDescriptions']['SpecialDescription'];
        }

        if($hotel['Product']['TourOpCode']['value'] != "P45"){
            if($hotel['Product']['DescriptionDet']['value'] != ""){
                db_query('UPDATE hotel SET description = ? WHERE id_hotel = ?', $hotel['Product']['DescriptionDet']['value'], $id_hotel);
            }else{
                db_query('UPDATE hotel SET description = ? WHERE id_hotel = ?', $hotel['Product']['Description']['value'], $id_hotel);
            }
        }

		if($descriptions){

            // empty all details first
            db_query('UPDATE hotel SET description = NULL, other_info = NULL, room_info = NULL, localization = NULL, kids_info = NULL, hotel_info = NULL, beach_info = NULL, website = NULL, meal_info = NULL WHERE id_hotel = ?', $id_hotel);

			foreach($descriptions as $desc){
				//$text = iconv(mb_detect_encoding($desc['value'], mb_detect_order(), true), "UTF-8", $desc['value']);
				$text = $desc['value'];

				switch($desc['attr']['Name']){
					case 'Descriere': {
						db_query('UPDATE hotel SET description = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Alte informatii': {
						db_query('UPDATE hotel SET other_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Dotari camere': {
						db_query('UPDATE hotel SET room_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
                    case 'Localizare': {
						db_query('UPDATE hotel SET localization = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Facilitati copii': {
						db_query('UPDATE hotel SET kids_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Facilitati hotel': {
						db_query('UPDATE hotel SET hotel_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Plaja': {
						db_query('UPDATE hotel SET beach_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Pagina web': {
						db_query('UPDATE hotel SET website = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
					case 'Tip masa': {
						db_query('UPDATE hotel SET meal_info = ? WHERE id_hotel = ?', $text, $id_hotel);
					}break;
				}
			}
		}

		$facilities = array();
		if($hotel['Product']['Facilities']['Facility']['value']){
        	$facilities[] = $hotel['Product']['Facilities']['Facility'];
        }else{
            $facilities = $hotel['Product']['Facilities']['Facility'];
        }

        db_query('UPDATE hotel SET beach = 0, spa = 0, pets = 0, parking = 0, aqua_park = 0, wifi = 0, kids_hotel = 0, restaurant_a_la_carte = 0, restaurant = 0, internet = 0, fitness = 0, pool_indoor = 0, pool_outside = 0, beach_sand = 0, air_conditioner = 0 WHERE id_hotel = ?', $id_hotel);

		if($facilities){
			foreach($facilities as $facility){
				if($_eurosite_facility_to_code[$facility['value']] != ""){
					db_query('UPDATE hotel SET '.$_eurosite_facility_to_code[$facility['value']].' = 1 WHERE id_hotel = ?', $id_hotel);
				}
			}
		}

		$pictures = array();
		if($hotel['Product']['Pictures']['Picture']['value']){
        	$pictures[] = $hotel['Product']['Pictures']['Picture'];
        }else{
            $pictures = $hotel['Product']['Pictures']['Picture'];
        }

        if($item['allow_update']){
    		if($pictures){
    			db_query('DELETE FROM hotel_img WHERE id_hotel = ?', $id_hotel);

    			foreach($pictures as $kj => $picture){
    				if($picture['value'] != ""){
    					db_query('INSERT INTO hotel_img SET id_hotel = ?, image = ?, active = 1, `order` = ?', $id_hotel, $picture['value'], ($kj+1));
    				}
    			}
    		}else{
    			if($hotel['Product']['FirstImage']['value'] != ""){
    				db_query('DELETE FROM hotel_img WHERE id_hotel = ?', $id_hotel);

    				db_query('INSERT INTO hotel_img SET id_hotel = ?, image = ?, active = 1, `order` = ?', $id_hotel, $hotel['Product']['FirstImage']['value'], 1);
    			}
    		}
        }

        if($item['allow_update']){
            $hotel_item = db_row('SELECT * FROM hotel WHERE id_hotel = ?', $id_hotel);

            if(!$hotel_item['stars']){
                // db_query('UPDATE hotel SET active = 0 WHERE id_hotel = ?', $id_hotel);
            }

            if(!$hotel_item['title']){
                db_query('UPDATE hotel SET active = 0 WHERE id_hotel = ?', $id_hotel);
            }

            $imgs = db_query('SELECT * FROM hotel_img WHERE id_hotel = ?', $id_hotel);
            if(!$imgs){
                // db_query('UPDATE hotel SET active = 0 WHERE id_hotel = ?', $id_hotel);
            }

            // if($hotel_item['stars'] && $hotel_item['title'] && $imgs && !$hotel_item['active']){
            if($hotel_item['title'] && !$hotel_item['active']){
                db_query('UPDATE hotel SET active = 1 WHERE id_hotel = ?', $id_hotel);
            }
        }

	}

}


function hotel_queue_for_update($code, $tourop, $country, $city){
    if($tourop != 'P45'){
        // $exists = db_query('SELECT * FROM hotel_queue_update WHERE code = ? AND tourop_code = ? AND executed = 0', $code, $tourop);
        $exists = db_query('SELECT * FROM hotel_queue_update WHERE code = ? AND tourop_code = ?', $code, $tourop);
        if(!$exists){
            db_query('INSERT INTO hotel_queue_update SET code = ?, tourop_code = ?, country_code = ?, city_code = ?, executed = 0', $code, $tourop, $country, $city);
        }
    }
}
