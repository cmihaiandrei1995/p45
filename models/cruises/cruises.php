<?
function get_cruise_by_id($id){
	return db_row('
        SELECT *
        FROM cruise
        WHERE '.db_is_active('', 'cruise').'
        	AND id_cruise = ?
    ', $id);
}

function get_cruise_basic_info($item){
	global $_cruise_currency, $_months_small, $_base_uploads;

	$item['url'] = route('cruise', $item['title'], $item['id_cruise']);
	$item['short_desc'] = limit_text($item['description'], 300);

	$item['line'] = get_cruise_line_by_id($item['id_cruise_line']);

	$item['images'] = get_images('cruise_ship', $item['id_cruise_ship']);
	$item['image'] = count($item['images']) ? $item['images'][mt_rand(0, count($item['images'])-1)]['medium'] : "http://placehold.it/300x156?text=".__('Fara imagine');

	$item['logo'] = $_base_uploads . 'images/cruises/' . $item['line']['logo'];

	return $item;
}

function get_cruise_info($item){
	global $_cruise_currency, $_months_small, $_base_uploads;

	$item['url'] = route('cruise', $item['title'], $item['id_cruise']);
	$item['short_desc'] = limit_text($item['description'], 300);

	$item['destination'] = get_cruise_destination_by_id($item['id_cruise_destination']);
	$item['line'] = get_cruise_line_by_id($item['id_cruise_line']);
	$item['ship'] = get_cruise_ship_by_id($item['id_cruise_ship']);

	if($item['line']['trip'] != ""){
		$item['trip_conditions'] = $_base_uploads.'files/'.date('Y', strtotime($item['line']['created'])).'/'.date('n', strtotime($item['line']['created'])).'/'.date('j', strtotime($item['line']['created'])).'/'.$item['line']['trip'];
	}

	$item['currency'] = $_cruise_currency[$item['line']['currency']];
	if($item['price_promo'] && $item['promo']){
		$item['price_save'] = $item['price'] - $item['price_promo'];
		$item['discount'] = (1 - ($item['price_promo']/$item['price'])) * 100;
		if($item['date_offer_from'] !="" && $item['date_offer_to'] != ""){
			$time_left = strtotime($item['date_offer_to']) - time();
			if($time_left > 0){
				$item['bestdeal'] = true;

				$item['time']['days'] = floor($time_left / 86400);
				$item['time']['hours'] = floor(($time_left - $item['time']['days'] * 86400) / 3600);
				$item['time']['minutes'] = floor(($time_left - ($item['time']['days'] * 86400 + $item['time']['hours'] * 3600)) / 60);
			}
		}
	}

	$item['images'] = get_images('cruise_ship', $item['id_cruise_ship']);
	$item['image'] = count($item['images']) ? $item['images'][mt_rand(0, count($item['images'])-1)]['medium'] : "http://placehold.it/300x156?text=".__('Fara imagine');

	$item['logo'] = $_base_uploads . 'images/cruises/' . $item['line']['logo'];

	$dates = db_query('SELECT * FROM cruise_date WHERE id_cruise = ? AND `date` > ? ORDER BY `date` ASC', $item['id_cruise'], date('Y-m-d'));
	foreach($dates as $date){
		$item['dates'][date('Y', strtotime($date['date']))][] = date('d', strtotime($date['date']))." ".$_months_small[date('n', strtotime($date['date']))];
	}

	$dates_book = db_query('SELECT * FROM cruise_date WHERE id_cruise = ? AND `date` > ? ORDER BY `date` ASC', $item['id_cruise'], date('Y-m-d'));
	foreach($dates_book as $date){
		$item['dates_book'][$date['url']] = date('d', strtotime($date['date']))." ".$_months_small[date('n', strtotime($date['date']))]." ".date('Y', strtotime($date['date']));
		$item['book_link'][$date['url']] = $date['url'];
		$item['dates_book_raw'][] = date('d.m.Y', strtotime($date['date']));
		$item['dates_to_book_link'][date('d.m.Y', strtotime($date['date']))] = $date['url'];
	}

	$ports = db_query('SELECT * FROM cruise_itinerary WHERE id_cruise = ? GROUP BY id_cruise_port', $item['id_cruise']);
	if($ports){
		foreach($ports as $port){
			$p = db_row('SELECT * FROM cruise_port WHERE id_cruise_port = ?', $port['id_cruise_port']);
			$item['ports'][] = $p['title'];
		}
	}

	if($item['port_start'] == 0){
		$item['departure']['title'] = $item['ports'][0];
	}else{
		$item['departure'] = db_row('SELECT * FROM cruise_port WHERE id_cruise_port = ?', $item['port_start']);
	}

	return $item;
}

function get_cruise_category_by_id($id){
	return db_row('
        SELECT *
        FROM cruise_category
        WHERE '.db_is_active('', 'cruise_category').'
        	AND id_cruise_category = ?
    ', $id);
}

function get_cruise_categories_by_parent_id($id){
	return db_query('
        SELECT *
        FROM cruise_category
        WHERE '.db_is_active('', 'cruise_category').'
        	AND parent_id = ?
    ', $id);
}

function get_cruise_category_by_slug($slug){
	$items = db_query('
        SELECT *
        FROM cruise_category
        WHERE '.db_is_active('', 'cruise_category').'
    ');
    foreach($items as $item) {
        if(generate_name($item['title']) == $slug) {
            return $item;
        }
    }
}

function get_cruise_cat_info($item){
	$item['url'] = route('cruises-cat', $item['title']);
	$item['description'] = wrap_wysiwyg_text($item['description']);

	return $item;
}









function cruise_make_req($section, $params){
	global $_config;

	$url = $_config['croaziere']['link'].$section.$params;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($response, true);

	return $data['response'][$section];
}
