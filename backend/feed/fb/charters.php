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
echo "<listings>".PHP_EOL;

echo "<title>Chartere</title>".PHP_EOL;
echo "<link rel='self' href='".$_base."'/>".PHP_EOL;

foreach($_destinations_to as $item){

    foreach($item['cities'] as $subtiem){

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

                if($hotel['price'] > 0 && $hotel['title'] != "" && count($hotel['images']) > 0 && $hotel['images'][0]['url'] != ""){
                    echo "<listing>".PHP_EOL;

                        $city = get_city_by_id($hotel['id_city']);
                        $country = get_country_by_id($city['id_country']);

                        echo "<destination_id>CH".$hotel['id_hotel']."-".$city_from['id_city']."</destination_id>".PHP_EOL;
                        echo "<name><![CDATA[".$hotel['title']."]]></name>".PHP_EOL;
                        echo "<description><![CDATA[Charter ".($type == "city" ? $city['title'] : $zone['title'])."]]></description>".PHP_EOL;

                        echo "<address format='simple'>".PHP_EOL;
                            echo "<component name='city'>".$city['title']."</component>".PHP_EOL;
                            echo "<component name='region'>".($type == "city" ? $city['title'] : $zone['title'])."</component>".PHP_EOL;
                            echo "<component name='country'>".$country['title']."</component>".PHP_EOL;
                        echo "</address>".PHP_EOL;

                        echo "<type>city</type>".PHP_EOL;

                        if($hotel['price_old'] != ""){
                            echo "<price>".$hotel['price_old']." EUR</price>".PHP_EOL;
                            echo "<sale_price>".$hotel['price']." EUR</sale_price>".PHP_EOL;
                        }else{
                            echo "<price>".$hotel['price']." EUR</price>".PHP_EOL;
                        }
                        echo "<star_rating>".$hotel['stars']."</star_rating>".PHP_EOL;

                        foreach($hotel['images'] as $k => $image){
                            if($k<20){
                                echo "<image>".PHP_EOL;
                                    echo "<url>".$image['url']."</url>".PHP_EOL;
                                echo "</image>".PHP_EOL;
                            }
                        }

                        echo "<url>".$hotel['url']."</url>".PHP_EOL;

                    echo "</listing>".PHP_EOL;
                }

                unset($hotel);
            }

        }

    }

}
echo "</listings>".PHP_EOL;


exit;
