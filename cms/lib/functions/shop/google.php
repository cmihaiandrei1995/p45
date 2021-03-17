<?

// Parse and get as array all Google categories from a file
function shop_get_google_categories($file){
	$data = file($file);
	foreach($data as $item){
		$tmp = explode("-", $item);
		if(is_numeric(trim($tmp[0]))){
			$categories[trim($tmp[0])] = trim($tmp[1]);
		}
	}
	
	return $categories;
}
