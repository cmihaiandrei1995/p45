<?
//@andrei: text promo boxes section

$_text_promo_boxes = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 13
));

// promo boxes
$_promo_boxes = cache_get('homepage__promo_boxes');
if(!$_promo_boxes){
	list($promo_boxes, $count) = get_posts(array(
		'table' => 'home_promo_box',
		'limit' => -1,
	));
	foreach($promo_boxes as $box){
		$k_box = $box['id_home_promo_box']+3;

		list($offers, $count) = get_posts(array(
			'table' => 'home_promo_box_item',
			'limit' => -1,
			'id_home_promo_box' => $box['id_home_promo_box'],
			//'extra_where' => 'AND date_offer_from <= NOW() AND date_offer_to >= NOW()', @andrei: reenable this
			'order' => 'RAND()'
		));

		foreach($offers as $k => &$offer){

			switch($offer['type']){

				case 'charter': {
					$zone = get_zone_by_id($offer['charter_id_zone']);
					$city_from = get_city_by_id($offer['charter_id_city_from']);
					$item = get_hotel_by_id($offer['charter_id_hotel']);

					if($item){
						$item = hotel_prepare_charter_info($item, $zone, $city_from);

						$dates_from = $dates_to = array();
						foreach($item['periods'] as $period){
							$dates_from[] = $period['date_from'];
							$dates_to[$period['date_from']][] = $period['date_to'];
						}

						$offer['url'] = $item['url'];

						if(in_array($offer['charter_offer_from'], $dates_from) && in_array($offer['charter_offer_to'], $dates_to[$offer['charter_offer_from']])){
							$item = charter_get_price($item, $zone, $city_from, $offer['charter_offer_from'], $offer['charter_offer_to']);
							$offer['price_old'] = $item['price_old'];
							$offer['price'] = $item['price'];
						}else{
							$offer['charter_offer_from'] = $item['price_date_from'];
							$offer['charter_offer_to'] = $item['price_date_to'];
							$offer['price_old'] = $item['price_old'];
							$offer['price'] = $item['price'];
						}
						$offer['url'] .= "?d=".date('d.m.Y', strtotime($offer['charter_offer_from']))."&t=".date('d.m.Y', strtotime($offer['charter_offer_to']));

						$offer['text1'] = date('d.m.Y', strtotime($offer['charter_offer_from']))." - ".date('d.m.Y', strtotime($offer['charter_offer_to']));
						//$offer['text2'] = ($item['nr_nights']+1)." zile / ".$item['nr_nights']." nopti";
						$offer['text2'] = "Plecare din ".$city_from['title'];

						$offer['type'] = "charter";
						$offer['tracking'] = array(
							'id' => $item['id_hotel'],
							'brand' => $item['zone']['title'] != "" ? $item['zone']['title'] : $item['city']['title'],
							'name' => $item['title'],
							'price' => $offer['price'],
							'category' => "Chartere".($city_from ? " din ".$city_from['title'] : ""),
							'prefix' => "CH"
						);
					}else{
						unset($offers[$k]);
					}

				}break;

				case 'circuit': {
					$item = get_circuit_by_id($offer['circuit_id_circuit']);
					if($item){
						$item = circuit_prepare_info($item);

						$offer['url'] = $item['url'];

						if(in_array(date('d.m.Y', strtotime($offer['circuit_offer_from'])), $item['dates'])){
							$item = circuit_get_price($item, $offer['circuit_offer_from']);
							$offer['price_old'] = $item['price_old'];
							$offer['price'] = $item['price'];
						}else{
							$offer['circuit_offer_from'] = $item['price_date'];
							$offer['price_old'] = $item['price_old'];
							$offer['price'] = $item['price'];
						}
						$offer['url'] .= "?d=".date('d.m.Y', strtotime($offer['circuit_offer_from']));

						$offer['text1'] = "Plecare ".date('d.m.Y', strtotime($offer['circuit_offer_from']));
						$offer['text2'] = $item['days']." zile / ".$item['nights']." nopti";

						$offer['type'] = "circuit";
						$offer['tracking'] = array(
							'id' => $item['id_circuit'],
							'brand' => implode(", ", $item['countries_txt']),
							'name' => $item['title'],
							'price' => $offer['price'],
							'category' => "Circuite",
							'prefix' => "CI"
						);
					}else{
						unset($offers[$k]);
					}
				}break;

				case 'ticket': {
					$item = get_post(array(
						'table' => 'ticket',
						'id_ticket' => $offer['ticket_id_ticket'],
					));

					if($item){
						$company = get_company_by_id($item['id_ticket_company']);

						$dates = db_query('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC', $item['id_ticket']);
						if($dates){
							$date_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC LIMIT 1', $item['id_ticket']);
							$date_max = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_to DESC LIMIT 1', $item['id_ticket']);

							$price_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY price ASC LIMIT 1', $item['id_ticket']);
							$item['price'] = $price_min['price'];

							$date_from = date('d.m', strtotime($date_min['date_from']));
							$date_to = date('d.m.Y', strtotime($date_max['date_to']));

							$item['period'] = $date_from." - ".$date_to;
						}else{
							$date_from = date('d.m', strtotime($item['date_from']));
							$date_to = date('d.m.Y', strtotime($item['date_to']));

							$item['period'] = $date_from." - ".$date_to;
						}

						$offer['price'] = $item['price'];
						$offer['url'] = route('ticket', $item['title'], $item['id_ticket']);
						$offer['text1'] = $date_from." - ".$date_to;
						$offer['text2'] = $company['title'];

						$offer['type'] = "ticket";
					}else{
						unset($offers[$k]);
					}

				}break;

				case 'hotel': {
					$city = get_zone_by_id($offer['hotel_id_city']);
					$item = get_hotel_by_id($offer['hotel_id_hotel']);

					if($item){
						$item = hotel_prepare_info($item);

						$dates_from = $dates_to = array();
						foreach($item['periods'] as $period){
							$dates_from[] = $period['date_from'];
							$dates_to[$period['date_from']][] = $period['date_to'];
						}

						$offer['url'] = $item['url'];

						if(in_array($offer['hotel_offer_from'], $dates_from) && in_array($offer['hotel_offer_to'], $dates_to[$offer['hotel_offer_from']])){
							$item = hotel_get_price($item, $offer['hotel_offer_from'], $offer['hotel_offer_to']);
							$offer['price_old'] = $item['price_old']*$item['nights'];
							$offer['price'] = $item['price']*$item['nights'];
						}else{
							$offer['hotel_offer_from'] = $item['hotel_date_from'];
							$offer['hotel_offer_to'] = $item['hotel_date_to'];
							$offer['price_old'] = $item['price_old']*$item['nights'];
							$offer['price'] = $item['price']*$item['nights'];
						}
						$offer['url'] .= "?d=".date('d.m.Y', strtotime($offer['hotel_offer_from']))."&t=".date('d.m.Y', strtotime($offer['hotel_offer_to']));

						$offer['text1'] = date('d.m.Y', strtotime($offer['hotel_offer_from']))." - ".date('d.m.Y', strtotime($offer['hotel_offer_to']));
						$offer['text2'] = ($item['nights']+1)." zile / ".$item['nights']." nopti";
						//$offer['text2'] = $city['title'];

						$offer['type'] = "hotel";
						$offer['tracking'] = array(
							'id' => $item['id_hotel'],
							'brand' => $item['zone']['title'] != "" ? $item['zone']['title'] : $item['city']['title'],
							'name' => $item['title'],
							'price' => $offer['price'],
							'category' => $city['id_country'] == 126 ? "Turism intern" : "Sejururi",
							'prefix' => "SJ"
						);
					}else{
						unset($offers[$k]);
					}

				}break;

			}

			unset($offer);
		}

		$box['offers'] = $offers;

		$_promo_boxes[$k_box] = $box;
	}

	cache_set('homepage__promo_boxes', $_promo_boxes, 60*60);
}
