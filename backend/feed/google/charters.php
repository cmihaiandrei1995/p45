<?

// get items
$_destinations_from = cache_get('charters__destinations_from');

foreach($_destinations_from as $from){

    foreach($from['countries'] as $country){

        if(!in_array($country['id_country'], array_keys($_destinations_to))){
            $new_country = $country;
            unset($new_country['cities']);
            $_destinations_to[$country['id_country']] = $new_country;
        }

        foreach($country['cities'] as $city){

            $new_from = $from;
            unset($new_from['countries']);

            if($city['id_city']){
                $key = 'id_city';
            }else{
                $key = 'id_zone';
            }

            if(!in_array($city[$key], array_keys($_destinations_to[$country['id_country']]['cities']))){
                $_destinations_to[$country['id_country']]['cities'][$city[$key]] = $city;
            }

            $_destinations_to[$country['id_country']]['cities'][$city[$key]]['from'][] = $new_from;
        }

    }

}



// echo items
echo "Destination ID,Origin ID,Title,Final URL,Image URL,Destination name,Origin name,Price,Sale price,Formatted price,Formatted sale price,Category,Contextual keywords,Destination address,Tracking template,Custom parameter,Final mobile URL,Similar Destination IDs";
echo "\n";

foreach($_destinations_to as $item){

    foreach($item['cities'] as $subtiem){

        $continent = get_continent_by_id($item['id_continent']);

        if($subtiem['id_city']){
            $type = 'city';
        }else{
            $type = 'zone';
        }

        if($type == "city"){
            $city = get_city_by_id($subtiem['id_city']);
        }

        $zone = get_zone_by_id($subtiem['id_zone']);

        foreach($subtiem['from'] as $from){

            $city_from = get_city_by_id($from['id_city']);

            $_query = array(
                'table' => 'hotel',
                'limit' => -1,
                'images' => true,
                'extra_where' => ' AND id_hotel IN (SELECT id_hotel FROM charter_minprice WHERE id_city_from = '.$city_from['id_city'].')'
            );

            if($type == "city"){
                $_query['id_city'] = $city['id_city'];
            }else{
                $_query['extra_where'] .= ' AND id_city IN (SELECT id_city FROM city WHERE id_zone = '.$zone['id_zone'].')';
            }

            list($hotels, $_count_items) = get_posts($_query);

            foreach($hotels as &$hotel){
        		$hotel = hotel_prepare_charter_info($hotel, ($type == "zone" ? $zone : $city), $city_from);

                if($hotel['price'] > 0){

                    $city = get_city_by_id($hotel['id_city']);
                    $country = get_country_by_id($city['id_country']);
                    $continent = get_continent_by_id($country['id_continent']);

                    echo '"CH'.$hotel['id_hotel'].'",';                                         // Destination ID
                    echo '"'.$city_from['id_city'].'",';                                        // Origin ID
                    echo '"'.$hotel['title'].'",';                                              // Title
                    echo '"'.$hotel['url'].'",';                                                // Final URL
                    echo '"'.$hotel['images'][0]['url'].'",';                                   // Image URL
                    echo '"'.($type == "city" ? $city['title'] : $zone['title']).'",';          // Destination name
                    echo '"'.$city_from['title'].'",';                                          // Origin name
                    if($hotel['price_old'] != ""){
                        echo '"'.$hotel['price_old'].' EUR",';                                  // Price
                        echo '"'.$hotel['price'].' EUR",';                                      // Sale Price
                    }else{
                        echo '"'.$hotel['price'].' EUR",';                                      // Price
                        echo '"",';                                                             // Sale Price
                    }
                    echo '"",';                                                                 // Formatted price
                    echo '"",';                                                                 // Formatted sale price
                    echo '"Pachete de vacanta",';                                               // Category
                    echo '"",';                                                                 // Contextual keywords
                    echo '"'.$city['title'].'",';                                               // Destination address
                    echo '"",';                                                                 // Tracking template
                    echo '"",';                                                                 // Custom parameter
                    echo '"",';                                                                 // Final mobile URL
                    echo '"",';                                                                 // Similar Destination IDs
                    echo "\n";

                }

                unset($hotel);
            }

        }

    }

}


exit;
