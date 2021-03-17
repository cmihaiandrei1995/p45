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
echo "<listings>".PHP_EOL;

echo "<title>Circuite</title>".PHP_EOL;
echo "<link rel='self' href='".$_base."'/>".PHP_EOL;

foreach($items as $item){

    if($item['price'] > 0){
        echo "<listing>".PHP_EOL;

            echo "<destination_id>CI".$item['id_circuit']."</destination_id>".PHP_EOL;
            echo "<name><![CDATA[".$item['title']."]]></name>".PHP_EOL;
            echo "<description><![CDATA[Circuite - ".$item['title']."]]></description>".PHP_EOL;

            foreach($item['cities'] as $city){
                $city = get_city_by_id($city);
                $country = get_country_by_id($city['id_country']);

                echo "<address format='simple'>".PHP_EOL;
                    echo "<component name='city'>".$city['title']."</component>".PHP_EOL;
                    echo "<component name='region'>".$city['title']."</component>".PHP_EOL;
                    echo "<component name='country'>".$country['title']."</component>".PHP_EOL;
                echo "</address>".PHP_EOL;

                break;
            }

            if($item['price_old'] != ""){
                echo "<price>".$item['price_old']." EUR</price>".PHP_EOL;
                echo "<sale_price>".$item['price']." EUR</sale_price>".PHP_EOL;
            }else{
                echo "<price>".$item['price']." EUR</price>".PHP_EOL;
            }
            echo "<type>city</type>".PHP_EOL;

            foreach($item['images'] as $k => $image){
                if($k<20){
                    echo "<image>".PHP_EOL;
                        echo "<url>".$image['url']."</url>".PHP_EOL;
                    echo "</image>".PHP_EOL;
                }
            }

            echo "<url>".$item['url']."</url>".PHP_EOL;

        echo "</listing>".PHP_EOL;
    }

}
echo "</listings>".PHP_EOL;


exit;
