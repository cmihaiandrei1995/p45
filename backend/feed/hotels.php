<?

header('Content-type: application/xml; charset="UTF-8"', true);
header('Pragma: no-cache');

// get items
list($items, $count) = get_posts(array(
    'table' => 'hotel',
	'limit' => -1,
	'images' => true
));

// prepare info
foreach($items as &$item){
    $item = hotel_prepare_info($item);
    unset($item);
}

// echo items
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".PHP_EOL;
echo "<hotels>".PHP_EOL;

foreach($items as $item){

    if($item['price'] > 0){
        echo "<hotel>".PHP_EOL;

            echo "<id>".$item['id_hotel']."</id>".PHP_EOL;
            echo "<title><![CDATA[".$item['title']."]]></title>".PHP_EOL;

            $city = get_city_by_id($item['id_city']);
            $country = get_country_by_id($city['id_country']);
            $continent = get_continent_by_id($country['id_continent']);

            echo "<city_id>".$city['id_city']."</city_id>".PHP_EOL;
            echo "<city>".$city['title']."</city>".PHP_EOL;
            echo "<country_id>".$country['id_country']."</country_id>".PHP_EOL;
            echo "<country>".$country['title']."</country>".PHP_EOL;
            echo "<continent>".$continent['title']."</continent>".PHP_EOL;
            echo "<address>".$item['address']."</address>".PHP_EOL;
            echo "<latitude>".$item['latitude']."</latitude>".PHP_EOL;
            echo "<longitude>".$item['longitude']."</longitude>".PHP_EOL;

            echo "<stars>".$item['stars']."</stars>".PHP_EOL;
            if($item['price_old'] != ""){
                echo "<price_old>".$item['price_old']."</price_old>".PHP_EOL;
            }
            echo "<price_from>".$item['price']."</price_from>".PHP_EOL;
            echo "<currency>EUR</currency>".PHP_EOL;

            echo "<description><![CDATA[".$item['description']."]]></description>".PHP_EOL;
            echo "<localization><![CDATA[".$item['localization']."]]></localization>".PHP_EOL;
            echo "<room_info><![CDATA[".$item['room_info']."]]></room_info>".PHP_EOL;
            echo "<hotel_info><![CDATA[".$item['hotel_info']."]]></hotel_info>".PHP_EOL;
            echo "<kids_info><![CDATA[".$item['kids_info']."]]></kids_info>".PHP_EOL;
            echo "<beach_info><![CDATA[".$item['beach_info']."]]></beach_info>".PHP_EOL;
            echo "<meal_info><![CDATA[".$item['meal_info']."]]></meal_info>".PHP_EOL;
            echo "<other_info><![CDATA[".$item['other_info']."]]></other_info>".PHP_EOL;

            echo "<images>".PHP_EOL;
            foreach($item['images'] as $image){
                echo "<image>".$image['url']."</image>".PHP_EOL;
            }
            echo "</images>".PHP_EOL;

        echo "</hotel>".PHP_EOL;
    }

}
echo "</hotels>".PHP_EOL;


exit;
