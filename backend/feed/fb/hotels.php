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
echo "<listings>".PHP_EOL;

echo "<title>Hoteluri</title>".PHP_EOL;
echo "<link rel='self' href='".$_base."'/>".PHP_EOL;

foreach($items as $item){

    if($item['price'] > 0 && $item['title'] != "" && count($item['images']) > 0 && $item['images'][0]['url'] != ""){
        echo "<listing>".PHP_EOL;

            $city = get_city_by_id($item['id_city']);
            $country = get_country_by_id($city['id_country']);

            echo "<destination_id>SJ".$item['id_hotel']."</destination_id>".PHP_EOL;
            echo "<name><![CDATA[".$item['title']."]]></name>".PHP_EOL;
            echo "<description><![CDATA[Sejur ".$item['title']."]]></description>".PHP_EOL;

            echo "<address format='simple'>".PHP_EOL;
                echo "<component name='city'>".$city['title']."</component>".PHP_EOL;
                echo "<component name='region'>".$city['title']."</component>".PHP_EOL;
                echo "<component name='country'>".$country['title']."</component>".PHP_EOL;
            echo "</address>".PHP_EOL;

            echo "<type>city</type>".PHP_EOL;

            if($item['price_old'] != ""){
                echo "<price>".$item['price_old']." EUR</price>".PHP_EOL;
                echo "<sale_price>".$item['price']." EUR</sale_price>".PHP_EOL;
            }else{
                echo "<price>".$item['price']." EUR</price>".PHP_EOL;
            }
            echo "<star_rating>".$item['stars']."</star_rating>".PHP_EOL;

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
