<?

function validate_voucher($code, $booking_info){
    $voucher_found = get_post(array(
        'table' => 'voucher',
        'code' => $code,
    ));

    if(!$voucher_found){
        return array(
            'error' => true,
            'message' => 'Codul promo este invalid'
        );
    }else{

        $search_data = json_decode($booking_info['search_data'], true);

        $voucher_to_country = db_query('SELECT * FROM voucher_to_country WHERE id_voucher = ?', $voucher_found['id_voucher']);
        $voucher_to_circuit = db_query('SELECT * FROM voucher_to_circuit WHERE id_voucher = ?', $voucher_found['id_voucher']);
        $voucher_to_hotel = db_query('SELECT * FROM voucher_to_hotel WHERE id_voucher = ?', $voucher_found['id_voucher']);
        $voucher_to_zone = db_query('SELECT * FROM voucher_to_zone WHERE id_voucher = ?', $voucher_found['id_voucher']);

        if($voucher_found['offer_type'] != $booking_info['booking_type'] && $voucher_found['offer_type'] != "all"){
            return array(
                'error' => true,
                'message' => 'Codul promo este invalid'
            );
        }

        if($voucher_found['max_usage'] != ""){
            if($voucher_found['max_usage'] <= $voucher_found['used']){
                return array(
                    'error' => true,
                    'message' => 'Codul promo a fost deja folosit'
                );
            }
        }

        if($voucher_found['date_from'] != ""){
            if(strtotime($voucher_found['date_from']) >= time()){
                return array(
                    'error' => true,
                    'message' => 'Codul promo este expirat'
                );
            }
        }

        if($voucher_found['date_to'] != ""){
            if(strtotime($voucher_found['date_to']) < time()){
                return array(
                    'error' => true,
                    'message' => 'Codul promo este expirat'
                );
            }
        }

        if($voucher_found['cart_min_price'] != ""){
            if($voucher_found['cart_min_price'] > $booking_info['final_price']){
                return array(
                    'error' => true,
                    'message' => 'Codul promo se aplica la rezervari mai mari de '.$voucher_found['cart_min_price'].'&euro;'
                );
            }
        }

        if($voucher_found['cart_max_price'] != ""){
            if($voucher_found['cart_max_price'] <= $booking_info['final_price']){
                return array(
                    'error' => true,
                    'message' => 'Codul promo se aplica la rezervari mai mici de '.$voucher_found['cart_max_price'].'&euro;'
                );
            }
        }

        if($voucher_found['apply_to_promo'] == 1){
            if($booking_info['old_price'] > 0){
                return array(
                    'error' => true,
                    'message' => 'Codul promo nu se aplica la oferte la promotie'
                );
            }
        }

        if($booking_info['booking_type'] == "circuit" || $voucher_found['offer_type'] == "all"){

            if($voucher_to_circuit){
                $found = false;
                foreach($voucher_to_circuit as $item){
                    if($item['id_circuit'] == $booking_info['id_circuit']){
                        $found = true;
                    }
                }
                if(!$found){
                    return array(
                        'error' => true,
                        'message' => 'Codul promo nu se aplica la aceasta oferta'
                    );
                }
            }

            if($voucher_to_country){
                $circuit_to_city = db_query('SELECT * FROM circuit_to_city WHERE id_circuit = ?', $booking_info['id_circuit']);
                if($circuit_to_city){
                    foreach($circuit_to_city as $city){
                        $city = get_city_by_id($city['id_city']);
                        $country = get_country_by_id($city['id_country']);

                        if($city && $country){
                            $found = false;
                            foreach($voucher_to_country as $item){
                                if($item['id_country'] == $country['id_country']){
                                    $found = true;
                                }
                            }
                            if(!$found){
                                return array(
                                    'error' => true,
                                    'message' => 'Codul promo nu se aplica pentru '.$country['title']
                                );
                            }
                        }
                    }
                }
            }

        }

        if($booking_info['booking_type'] == "tourism" || $booking_info['booking_type'] == "charter" || $voucher_found['offer_type'] == "all"){

            if($voucher_to_hotel){
                $found = false;
                foreach($voucher_to_hotel as $item){
                    if($item['id_hotel'] == $booking_info['id_hotel']){
                        $found = true;
                    }
                }
                if(!$found){
                    return array(
                        'error' => true,
                        'message' => 'Codul promo nu se aplica la aceasta oferta'
                    );
                }
            }

            if($voucher_to_zone){
                $hotel = get_hotel_by_id($booking_info['id_hotel']);
                $zone = db_row('SELECT * FROM zone WHERE id_zone IN (SELECT id_zone FROM city WHERE id_city = ?)', $hotel['id_city']);

                if($zone){
                    $found = false;
                    foreach($voucher_to_zone as $item){
                        if($item['id_zone'] == $zone['id_zone']){
                            $found = true;
                        }
                    }
                    if(!$found){
                        return array(
                            'error' => true,
                            'message' => 'Codul promo nu se aplica pentru '.$zone['title']
                        );
                    }
                }
            }

            if($voucher_to_country){
                $hotel = get_hotel_by_id($booking_info['id_hotel']);
                $city = get_city_by_id($hotel['id_city']);
                $country = get_country_by_id($city['id_country']);

                if($city && $country){
                    $found = false;
                    foreach($voucher_to_country as $item){
                        if($item['id_country'] == $country['id_country']){
                            $found = true;
                        }
                    }
                    if(!$found){
                        return array(
                            'error' => true,
                            'message' => 'Codul promo nu se aplica pentru '.$country['title']
                        );
                    }
                }
            }

        }

        if($booking_info['booking_type'] == "charter" || $voucher_found['offer_type'] == "all"){

            if($voucher_found['id_cities_from'] != ""){
                $cities_from = explode(",", $voucher_found['id_cities_from']);
                $cities_from_voucher = array();
                foreach($cities_from as $city){
                    $city = get_city_by_id($city);
                    $cities_from_voucher[] = $city['title'];
                }
                if(!in_array($booking_info['id_city_from'], $cities_from)){
                    return array(
                        'error' => true,
                        'message' => 'Codul promo nu se aplica decat pentru plecari din '.implode(', ', $cities_from_voucher)
                    );
                }
            }

            if($voucher_found['date_from_trip'] != ""){
                if(strtotime($booking_info['check_in']) < strtotime($voucher_found['date_from_trip'])){
                    return array(
                        'error' => true,
                        'message' => 'Codul promo nu se aplica pentru plecari inainte de '.date('d.m.Y', strtotime($voucher_found['date_from_trip']))
                    );
                }
            }

            if($voucher_found['date_to_trip'] != ""){
                if(strtotime($booking_info['check_out']) > strtotime($voucher_found['date_to_trip'])){
                    return array(
                        'error' => true,
                        'message' => 'Codul promo nu se aplica pentru intoarceri dupa data de '.date('d.m.Y', strtotime($voucher_found['date_to_trip']))
                    );
                }
            }
        }

        // calcul reducere
        $final_price = $booking_info['final_price'];
        if($voucher_found['type'] == "percent"){
            $discount = number_format($voucher_found['value']*$final_price/100, 2, ".", "");
        }elseif($voucher_found['type'] == "fixed"){
            if($voucher_found['subtype'] == "booking"){
                $discount = $voucher_found['value'];
            }elseif($voucher_found['subtype'] == "person"){
                foreach($search_data['rooms_info'] as $room){
                    $discount += $voucher_found['value'] * $room['adult'];
                    if($voucher_found['apply_to_child']){
                        $discount += $voucher_found['value'] * $room['child'];
                    }
                }
            }
        }

        if($voucher_found['max_amount_per_person'] > 0){
            $discount_max = 0;
            foreach($search_data['rooms_info'] as $room){
                $discount_max += $voucher_found['max_amount_per_person'] * $room['adult'];
                if($voucher_found['apply_to_child']){
                    $discount += $voucher_found['max_amount_per_person'] * $room['child'];
                }
            }

            if($discount > $discount_max){
                $discount = $discount_max;
            }
        }

    }

    return array(
        'value' => $discount
    );
}
