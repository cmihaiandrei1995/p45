<?
// detect landing page
list($items, $count) = get_posts(array(
    'table' => 'lp'
));
foreach($items as $item){
    if(generate_name($item['title']) == $_params['slug'] || $item['slug'] == $_params['slug']){
        $_item = $item;
        break;
    }
}
if(!$_item) error_404();


// main slider
list($_slides, $slides_count) = get_posts(array(
	'table' => 'lp_slider',
	'limit' => -1,
    'id_lp' => $_item['id_lp'],
	'images' => true
));
foreach($_slides as &$slide){
	if($slide['banner'] != ""){
		$slide['banner_img'] = $_base_uploads.'images/'.$slide['banner_path'].$slide['banner'];
	}

	if($slide['counter_expire'] != ""){
		$time_left = strtotime($slide['counter_expire']) - time();
		if($time_left > 0){
			$slide['show_counter'] = true;
			$slide['counter_days'] = floor($time_left / 86400);
			$slide['counter_hours'] = floor(($time_left - $slide['counter_days'] * 86400) / 3600);
			$slide['counter_minutes'] = floor(($time_left - ($slide['counter_days'] * 86400 + $slide['counter_hours'] * 3600)) / 60);
			$slide['counter_seconds'] = floor(($time_left - ($slide['counter_days'] * 86400 + $slide['counter_hours'] * 3600 + $slide['counter_minutes'])) / 60);
		}
	}

	unset($slide);
}


// banners
list($_banners, $banners_count) = get_posts(array(
	'table' => 'lp_banner',
	'limit' => -1,
    'id_lp' => $_item['id_lp'],
	'images' => true
));

// text rate
$_text_rate = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 1,
));


// boxes settings
list($home_box_settings, $boxes_count) = get_posts(array(
	'table' => 'home_box_setting',
	'limit' => -1,
));
foreach($home_box_settings as $item){
	$_box_settings[$item['id_home_box_setting']] = $item;
}


// zone offers
list($_offer_zones, $offer_zones_count) = get_posts(array(
	'table' => 'lp_offer_zone',
	'limit' => -1,
    'id_lp' => $_item['id_lp'],
));
foreach($_offer_zones as &$zone){

    switch($zone['type']){

        case '1':{ // Charter + sejur
            list($offers, $offers_count) = get_posts(array(
            	'table' => 'lp_offer_destination',
            	'limit' => -1,
                'id_lp' => $_item['id_lp'],
                'id_lp_offer_zone' => $zone['id_lp_offer_zone'],
                'images' => true
            ));
            foreach($offers as $k => &$offer){
                $zone_db = get_zone_by_id($offer['id_zone']);

                if($offer['type'] == "charter"){
                    $price = db_row('SELECT * FROM charter_minprice WHERE date_from = ? '.($offer['id_city_from'] != "" ? ' AND id_city_from = "'.$offer['id_city_from'].'"' : '' ).' AND id_city IN (SELECT id_city FROM city WHERE id_zone = ?) ORDER BY price ASC LIMIT 1', $offer['date'], $zone_db['id_zone']);
                    $city_from = get_city_by_id($price['id_city_from']);
                    $offer['city_from'] = $city_from['title'];
                    $offer['nights'] = $price['nr_nights'];
                }elseif($offer['type'] == "hotel"){
                    $price = db_row('SELECT * FROM hotel_minprice WHERE id_hotel IN ( SELECT id_hotel FROM hotel WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = ?)) ORDER BY price ASC LIMIT 1', $zone_db['id_zone']);
                }

                if(!$price){
                    unset($offers[$k]);
                }else{
                    $offer['price'] = floor($price['price']);
                    $offer['price_old'] = floor($price['priceNoRedd']);
                }

                unset($offer);
            }
            $zone['offers'] = $offers;
        }break;

        case '2':{ // Of speciale hotel chartere
            list($offers, $offers_count) = get_posts(array(
            	'table' => 'lp_offer_charter',
            	'limit' => -1,
                'id_lp' => $_item['id_lp'],
                'id_lp_offer_zone' => $zone['id_lp_offer_zone'],
            ));
            foreach($offers as $k => &$offer){
                $zone_db = get_zone_by_id($offer['id_zone']);
                $hotel_db = get_hotel_by_id($offer['id_hotel']);
                $city_db = get_city_by_id($hotel_db['id_city']);
                $city_from = get_city_by_id($offer['id_city_from']);

                //$hotel_db = hotel_prepare_info($hotel_db);
                $hotel_db = hotel_prepare_charter_info($hotel_db, $zone_db, $city_from);

                $offer['images'] = get_images('hotel', $offer['id_hotel']);

                $hotel_db = charter_get_price($hotel_db, $zone_db, $city_from, $offer['offer_from'], $offer['offer_to']);
                if($hotel_db['price']){
                    $offer['price_old'] = $hotel_db['price_old'];
                    $offer['price'] = $hotel_db['price'];
                }else{
                    // ramane cel pus manual din cms, daca e pus
                }

                if(!$offer['price']){
                    unset($offers[$k]);
                }else{
                    $offer['hotel'] = $hotel_db['title'];
                    $offer['stars'] = $hotel_db['stars'];
                    $offer['city'] = $city_db['title'];
                    $offer['url'] = $hotel_db['url']."?d=".$offer['offer_from']."&t=".$offer['offer_to'];
                }

                unset($offer);
            }
            $zone['offers'] = $offers;
        }break;

        case '3':{ // Circuite
            list($offers, $offers_count) = get_posts(array(
            	'table' => 'lp_offer_circuit',
            	'limit' => -1,
                'id_lp' => $_item['id_lp'],
                'id_lp_offer_zone' => $zone['id_lp_offer_zone'],
            ));
            foreach($offers as $k => &$offer){
                $item = get_circuit_by_id($offer['id_circuit']);
                if($item){
                    $item = circuit_prepare_info($item);

                    $title = $offer['title'];
                    $last_places = $offer['last_places'];
                    $depart_from = $offer['depart_from'];
                    $date_from = $offer['offer_from'];

                    $offer = $item;

                    $offer['title'] = $title;
                    $offer['last_places'] = $last_places;
                    $offer['depart_from'] = $depart_from;

                    $offer['url'] = $item['url'];
                    if(in_array(date('d.m.Y', strtotime($date_from)), $item['dates'])){
                        $item = circuit_get_price($item, $date_from);
                        $offer['offer_from'] = $item['price_date'];
                        $offer['price_old'] = $item['price_old'];
                        $offer['price'] = $item['price'];
                    }else{
                        $offer['offer_from'] = $item['price_date'];
                        $offer['price_old'] = $item['price_old'];
                        $offer['price'] = $item['price'];
                    }

                    if(!$offer['price']){
                        unset($offers[$k]);
                    }else{
                        $offer['url'] .= "?d=".date('d.m.Y', strtotime($offer['offer_from']));

                        $offer['type'] = $item['type'];

                        $offer['text1'] = "Plecare".($offer['depart_from'] != "" ? " din ".$offer['depart_from'] : "").": ".date('d.m.Y', strtotime($offer['offer_from']));
                        $offer['text2'] = $item['days']." zile / ".$item['nights']." nopti";
                    }
                }
                unset($offer);
            }
            $zone['offers'] = $offers;
        }break;

        case '4':{ // Bilete avion
            list($offers, $offers_count) = get_posts(array(
            	'table' => 'lp_offer_plane',
            	'limit' => -1,
                'id_lp' => $_item['id_lp'],
                'id_lp_offer_zone' => $zone['id_lp_offer_zone'],
                'images' => true
            ));
            $zone['offers'] = $offers;
        }break;

        case '5':{ // Zona text

        }break;

        case '6':{ // Zona video

        }break;

    }

    unset($zone);
}








// footer offers
list($_footer, $footer_count) = get_posts(array(
	'table' => 'lp_footer',
	'limit' => -1,
    'id_lp' => $_item['id_lp'],
	'images' => true
));



$_section = "lp";

// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
