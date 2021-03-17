<?

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
echo "Property ID,Property name,Final URL,Image URL,Destination name,Description,Price,Sale price,Formatted price,Formatted sale price,Star rating,Category,Contextual keywords,Address,Tracking template,Custom parameter,Final mobile URL,Similar Property IDs";
echo "\n";

foreach($items as $item){

    if($item['price'] > 0 && $item['title'] != ""){

        $city = get_city_by_id($item['id_city']);
        $country = get_country_by_id($city['id_country']);
        $continent = get_continent_by_id($country['id_continent']);

        echo '"SJ'.$item['id_hotel'].'",';                                          // Property ID
        echo '"'.$item['title'].'",';                                               // Property name
        echo '"'.$item['url'].'",';                                                 // Final URL
        echo '"'.$item['images'][0]['url'].'",';                                    // Image URL
        echo '"'.$city['title'].'",';                                               // Destination name
        echo '"",';                                                                 // Description
        if($item['price_old'] != ""){
            echo '"'.$item['price_old'].' EUR",';                                   // Price
            echo '"'.$item['price'].' EUR",';                                       // Sale Price
        }else{
            echo '"'.$item['price'].' EUR",';                                       // Price
            echo '"",';                                                             // Sale Price
        }
        echo '"",';                                                                 // Formatted price
        echo '"",';                                                                 // Formatted sale price
        echo '"'.$item['stars'].'",';                                               // Star rating
        echo '"Sejururi",';                                                         // Category
        echo '"",';                                                                 // Contextual keywords
        echo '"",';                                                                 // Destination address
        echo '"",';                                                                 // Tracking template
        echo '"",';                                                                 // Custom parameter
        echo '"",';                                                                 // Final mobile URL
        echo '"",';                                                                 // Similar Destination IDs
        echo "\n";

    }

}


exit;
