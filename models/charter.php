<?

function get_charter_link($item, $to, $from){
	if($item['charter_type'] == "sejur"){
		$link = route('charters2', $to, $from);
	}else{
		$link = route('charters', $to, $from);
	}

	return $link;
}


function get_eurositeCode_by_id($table, $field, $id){
    $row =  db_row('SELECT code FROM '.$table.' WHERE `'.$field.'` = ?', $id);
    return $row['code'];
}


function hotel_prepare_charter_basic_info($item, $_item = array(), $city_from = ""){
	if($_item){
		if($item['charter_type'] == "sejur"){
			$item['url'] = route('charters-item2', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
			$link = route('charters2', $from, $to);
		}else{
			$item['url'] = route('charters-item', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
			$link = route('charters', $from, $to);
		}
	}

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

function hotel_prepare_charter_info($item, $_item = array(), $city_from = "", $excluded_dates = array(), $date_from = '', $date_to = ''){
	global $_base;

	if($_item){
		if($_item['charter_type'] == "sejur"){
			$item['url'] = route('charters-item2', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
			$link = route('charters2', $from, $to);
		}else{
			$item['url'] = route('charters-item', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
			$link = route('charters', $from, $to);
		}
	}

	$item['title'] = ucwords(strtolower($item['title']));

	$city_from_sql = "";
	if($city_from){
		$city_from_sql = "AND id_city_from = ".$city_from['id_city'];
	}

	$item = charter_get_price($item, $_item, $city_from, $date_from, $date_to, $excluded_dates);

	if($date_from == '' && $date_to == ''){
		$item['periods'] = db_query('SELECT * FROM charter_minprice WHERE id_hotel = ? '.$city_from_sql.' AND date_from > "'.date('Y-m-d').'" ORDER BY date_from ASC, date_to ASC', $item['id_hotel']);
	}

	// check for black friday
	$item['black_friday_charter'] = 0;
	foreach($item['periods'] as $period){
		if($period['black_friday']){
			$item['black_friday_charter'] = 1;
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

	$item['map_url'] = route('tourism-map', $item['id_hotel']);

	$meals = db_query('SELECT * FROM hotel_minprice WHERE id_hotel = ? AND date_from > ? GROUP BY meal', $item['id_hotel'], date('Y-m-d'));
	if($meals){
		foreach($meals as $meal){
			//$item['meals'][] = $meal['meal'] != "" ? $meal['meal'] : "Fara masa";
			if($meal['meal'] != ""){
				$item['meals'][] = $meal['meal'];
			}
		}
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

function charter_get_cities_from($item){
	$cities = db_query('SELECT * FROM charter_minprice WHERE id_hotel = ? AND date_from > "'.date('Y-m-d').'" GROUP BY id_city_from', $item['id_hotel']);
	foreach($cities as $city){
		$result[] = $city['id_city_from'];
	}
	return $result;
}


function hotel_prepare_charter_info_from_search($item, $_item = array(), $city_from = "", $search, $results){

	$item = hotel_prepare_charter_info($item, $_item, $city_from);

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

			$item['url'] .= "?s=".$search['id_charter_search'];

			$item['nr_nights'] = days_between_dates($search['date_from'], $search['date_to']);
		}

	}

	return $item;

}

function charter_get_available_dates($item, $type, $city_from){

	$city_from_sql = "";
	if($city_from){
		$city_from_sql = "AND id_city_from = ".$city_from['id_city'];
	}

	if($type == "zone"){
		$city_sql = "SELECT id_city FROM city WHERE id_zone = ".$item['id_zone'];
	}else{
		$city_sql = $item['id_city'];
	}
	$periods = db_query('SELECT * FROM charter_minprice WHERE id_city IN ('.$city_sql.') '.$city_from_sql.' AND date_from > "'.date('Y-m-d').'" GROUP BY date_from, date_to ORDER BY date_from ASC, date_to ASC');

	return $periods;

}

function charter_get_price($item, $_item = array(), $city_from = "", $date_from = "", $date_to = "", $excluded_dates = array()){

	unset($item['price_old']);
	unset($item['price']);
	unset($item['discount']);
	unset($item['discount_sort']);
	unset($item['early_booking']);
	unset($item['last_minute']);
	unset($item['special_offer']);

	$city_from_sql = "";
	if($city_from){
		$city_from_sql = "AND id_city_from = ".$city_from['id_city'];
	}

	if($date_from != "" && $date_to != ""){
		$price = db_row('SELECT * FROM charter_minprice WHERE id_hotel = ? '.$city_from_sql.' AND date_from LIKE "'.date('Y-m-d', strtotime($date_from)).'%" AND date_to LIKE "'.date('Y-m-d', strtotime($date_to)).'%" ORDER BY price ASC LIMIT 1', $item['id_hotel']);
	}elseif($excluded_dates){
		$price = db_row('SELECT * FROM charter_minprice WHERE id_hotel = ? '.$city_from_sql.' AND nr_nights >= '.($_item['charter_min_nights'] > 0 ? $_item['charter_min_nights'] : 7).' AND date_from NOT IN ("'.implode('","', $excluded_dates).'") ORDER BY price ASC LIMIT 1', $item['id_hotel']);
	}else{
		$price = db_row('SELECT * FROM charter_minprice WHERE id_hotel = ? '.$city_from_sql.' AND nr_nights >= '.($_item['charter_min_nights'] > 0 ? $_item['charter_min_nights'] : 7).' AND date_from > "'.date('Y-m-d').'" ORDER BY price ASC LIMIT 1', $item['id_hotel']);
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

		if(str_like('%EB%', $price['description'])){
			$item['early_booking'] = true;
		}elseif(str_like('%last minute%', $price['description'])){
			$item['last_minute'] = true;
		}elseif($item['discount'] > 0 || str_like('%oferta speciala%', $price['description'])){
			$item['special_offer'] = true;
		}

		$item['discount_sort'] = 100 - round(($item['price']/$item['price_old']) * 100);

		if(!$city_from){
			$city_from = get_city_by_id($price['id_city_from']);

			if($item['charter_type'] == "sejur"){
				$item['url'] = route('charters-item2', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
				$link = route('charters2', $from, $to);
			}else{
				$item['url'] = route('charters-item', $_item['title'], $city_from['title'], $item['title'], $item['id_hotel']);
				$link = route('charters', $from, $to);
			}
		}
	}else{
		$item['price'] = round($price['price']);
	}

	$item['price_date_from'] = date('Y-m-d', strtotime($price['date_from']));
	$item['price_date_to'] = date('Y-m-d', strtotime($price['date_to']));

	$item['nr_nights'] = $price['nr_nights'];

	return $item;
}
