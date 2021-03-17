<?

header('Content-type: application/xml; charset="UTF-8"', true);
header('Pragma: no-cache');

// get items
list($items, $count) = get_posts(array(
    'table' => 'circuit',
	'limit' => -1,
	'images' => true
));

// prepare info
foreach($items as &$item){
    $item = circuit_prepare_info($item);
    unset($item);
}

// echo items
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".PHP_EOL;
echo "<circuits>".PHP_EOL;

foreach($items as $item){

    if($item['price'] > 0){
        echo "<circuit>".PHP_EOL;

            echo "<id>".$item['id_circuit']."</id>".PHP_EOL;
            echo "<title><![CDATA[".$item['title']."]]></title>".PHP_EOL;

            echo "<destinations>".PHP_EOL;
            foreach($item['cities'] as $city){
                $city = get_city_by_id($city);
                $country = get_country_by_id($city['id_country']);
                $continent = get_continent_by_id($country['id_continent']);

                echo "<destination>".PHP_EOL;
                    echo "<city_id>".$city['id_city']."</city_id>".PHP_EOL;
                    echo "<city>".$city['title']."</city>".PHP_EOL;
                    echo "<country_id>".$country['id_country']."</country_id>".PHP_EOL;
                    echo "<country>".$country['title']."</country>".PHP_EOL;
                    echo "<continent>".$continent['title']."</continent>".PHP_EOL;
                echo "</destination>".PHP_EOL;
            }
            echo "</destinations>".PHP_EOL;

            echo "<dates>".PHP_EOL;
            foreach($item['dates'] as $date){
                echo "<date>".$date."</date>".PHP_EOL;
            }
            echo "</dates>".PHP_EOL;

            echo "<days>".$item['days']."</days>".PHP_EOL;
            echo "<nights>".$item['nights']."</nights>".PHP_EOL;
            echo "<transport>".$item['type']."</transport>".PHP_EOL;

            if($item['price_old'] != ""){
                echo "<price_old>".$item['price_old']."</price_old>".PHP_EOL;
            }
            echo "<price_from>".$item['price']."</price_from>".PHP_EOL;
            echo "<currency>EUR</currency>".PHP_EOL;

            echo "<description><![CDATA[".$item['included']."]]></description>".PHP_EOL;
            echo "<included><![CDATA[".$item['included']."]]></included>".PHP_EOL;
            echo "<not_included><![CDATA[".$item['included']."]]></not_included>".PHP_EOL;
            echo "<financial_conditions><![CDATA[".$item['included']."]]></financial_conditions>".PHP_EOL;
            echo "<flight_info><![CDATA[".$item['included']."]]></flight_info>".PHP_EOL;
            echo "<optional_excursions><![CDATA[".$item['included']."]]></optional_excursions>".PHP_EOL;
            echo "<transfers><![CDATA[".$item['included']."]]></transfers>".PHP_EOL;
            echo "<important_info><![CDATA[".$item['included']."]]></important_info>".PHP_EOL;

            echo "<images>".PHP_EOL;
            foreach($item['images'] as $image){
                echo "<image>".$image['url']."</image>".PHP_EOL;
            }
            echo "</images>".PHP_EOL;

        echo "</circuit>".PHP_EOL;
    }

}
echo "</circuits>".PHP_EOL;


exit;
