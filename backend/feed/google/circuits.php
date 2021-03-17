<?

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
echo "Destination ID,Origin ID,Title,Final URL,Image URL,Destination name,Origin name,Price,Sale price,Formatted price,Formatted sale price,Category,Contextual keywords,Destination address,Tracking template,Custom parameter,Final mobile URL,Similar Destination IDs";
echo "\n";

foreach($items as $item){

    if($item['price'] > 0){

        echo '"CI'.$item['id_circuit'].'",';                                        // Destination ID
        echo '"",';                                                                 // Origin ID
        echo '"'.$item['title'].'",';                                               // Title
        echo '"'.$item['url'].'",';                                                 // Final URL
        echo '"'.$item['images'][0]['url'].'",';                                    // Image URL
        echo '"",';                                                                 // Destination name
        echo '"",';                                                                 // Origin name
        if($item['price_old'] != ""){
            echo '"'.$item['price_old'].' EUR",';                                   // Price
            echo '"'.$item['price'].' EUR",';                                       // Sale Price
        }else{
            echo '"'.$item['price'].' EUR",';                                       // Price
            echo '"",';                                                             // Sale Price
        }
        echo '"",';                                                                 // Formatted price
        echo '"",';                                                                 // Formatted sale price
        echo '"Circuite",';                                                         // Category
        echo '"",';                                                                 // Contextual keywords
        echo '"",';                                                                 // Destination address
        echo '"",';                                                                 // Tracking template
        echo '"",';                                                                 // Custom parameter
        echo '"",';                                                                 // Final mobile URL
        echo '"",';                                                                 // Similar Destination IDs
        echo "\n";


        /*
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

        echo "<days>".$item['days']."</days>".PHP_EOL;
        echo "<nights>".$item['nights']."</nights>".PHP_EOL;
        echo "<transport>".$item['type']."</transport>".PHP_EOL;
        */

    }

}


exit;
