<?

header('Content-type: application/xml; charset="UTF-8"', true);
header('Pragma: no-cache');

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
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".PHP_EOL;
echo "<destinations>".PHP_EOL;

foreach($_destinations_to as $item){

    foreach($item['cities'] as $subtiem){

        echo "<destination>".PHP_EOL;

            $continent = get_continent_by_id($item['id_continent']);
            echo "<country_id>".$item['id_country']."</country_id>".PHP_EOL;
            echo "<country>".$item['title']."</country>".PHP_EOL;

            if($subtiem['id_city']){
                $type = 'city';
            }else{
                $type = 'zone';
            }

            echo "<destination_type>".$type."</destination_type>".PHP_EOL;

            if($type == "city"){
                $city = get_city_by_id($subtiem['id_city']);
                echo "<city_id>".$city['id_city']."</city_id>".PHP_EOL;
                echo "<city>".$city['title']."</city>".PHP_EOL;
            }

            $zone = get_zone_by_id($subtiem['id_zone']);
            echo "<zone_id>".$zone['id_zone']."</zone_id>".PHP_EOL;
            echo "<zone>".$zone['title']."</zone>".PHP_EOL;

            echo "<offers>".PHP_EOL;

                foreach($subtiem['from'] as $from){
                    echo "<offer>".PHP_EOL;

                        echo "<from>".PHP_EOL;
                            $city_from = get_city_by_id($from['id_city']);
                            echo "<city_id>".$city_from['id_city']."</city_id>".PHP_EOL;
                            echo "<city>".$city_from['title']."</city>".PHP_EOL;
                        echo "</from>".PHP_EOL;

                        echo "<hotels>".PHP_EOL;

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
                                    echo "<hotel>".PHP_EOL;

                                        echo "<id>".$hotel['id_hotel']."</id>".PHP_EOL;
                                        echo "<title><![CDATA[".$hotel['title']."]]></title>".PHP_EOL;

                                        $city = get_city_by_id($hotel['id_city']);
                                        $country = get_country_by_id($city['id_country']);
                                        $continent = get_continent_by_id($country['id_continent']);

                                        echo "<city_id>".$city['id_city']."</city_id>".PHP_EOL;
                                        echo "<city>".$city['title']."</city>".PHP_EOL;
                                        echo "<country_id>".$country['id_country']."</country_id>".PHP_EOL;
                                        echo "<country>".$country['title']."</country>".PHP_EOL;
                                        echo "<continent>".$continent['title']."</continent>".PHP_EOL;
                                        echo "<address>".$hotel['address']."</address>".PHP_EOL;
                                        echo "<latitude>".$hotel['latitude']."</latitude>".PHP_EOL;
                                        echo "<longitude>".$hotel['longitude']."</longitude>".PHP_EOL;

                                        echo "<stars>".$hotel['stars']."</stars>".PHP_EOL;
                                        if($hotel['price_old'] != ""){
                                            echo "<price_old>".$hotel['price_old']."</price_old>".PHP_EOL;
                                        }
                                        echo "<price_from>".$hotel['price']."</price_from>".PHP_EOL;
                                        echo "<currency>EUR</currency>".PHP_EOL;

                                        echo "<periods>".PHP_EOL;
                                            foreach($hotel['periods'] as $period){
                                                echo "<period>".PHP_EOL;
                                                    echo "<date_from>".$period['date_from']."</date_from>".PHP_EOL;
                                                    echo "<date_to>".$period['date_to']."</date_to>".PHP_EOL;
                                                    echo "<nr_nights>".$period['nr_nights']."</nr_nights>".PHP_EOL;
                                                    echo "<price>".$period['price']."</price>".PHP_EOL;
                                                    if($period['priceNoRedd'] != ""){
                                                        echo "<price_old>".$period['priceNoRedd']."</price_old>".PHP_EOL;
                                                    }
                                                    echo "<currency>EUR</currency>".PHP_EOL;
                                                echo "</period>".PHP_EOL;
                                            }
                                        echo "</periods>".PHP_EOL;

                                        echo "<description><![CDATA[".$hotel['description']."]]></description>".PHP_EOL;
                                        echo "<localization><![CDATA[".$hotel['localization']."]]></localization>".PHP_EOL;
                                        echo "<room_info><![CDATA[".$hotel['room_info']."]]></room_info>".PHP_EOL;
                                        echo "<hotel_info><![CDATA[".$hotel['hotel_info']."]]></hotel_info>".PHP_EOL;
                                        echo "<kids_info><![CDATA[".$hotel['kids_info']."]]></kids_info>".PHP_EOL;
                                        echo "<beach_info><![CDATA[".$hotel['beach_info']."]]></beach_info>".PHP_EOL;
                                        echo "<meal_info><![CDATA[".$hotel['meal_info']."]]></meal_info>".PHP_EOL;
                                        echo "<other_info><![CDATA[".$hotel['other_info']."]]></other_info>".PHP_EOL;

                                        echo "<images>".PHP_EOL;
                                        foreach($hotel['images'] as $image){
                                            echo "<image>".$image['url']."</image>".PHP_EOL;
                                        }
                                        echo "</images>".PHP_EOL;

                                    echo "</hotel>".PHP_EOL;
                                }

                                unset($hotel);
                            }

                        echo "</hotels>".PHP_EOL;

                    echo "</offer>".PHP_EOL;
                }

            echo "</offers>".PHP_EOL;

        echo "</destination>".PHP_EOL;

    }

}
echo "</destinations>".PHP_EOL;


exit;
