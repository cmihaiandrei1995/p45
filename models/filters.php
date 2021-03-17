<?

$_offer_filter_links = array(
	'offer' => 'of',
	'cat' => 'c',
	'special' => 'sp',
	'special_tags' => 'st',
	'meals' => 'm',
	'facilities' => 'f',
	'stars' => 's',
	'price' => 'pr',
	'cities' => 'ct',
	'zones' => 'z',
	'query' => 'q',
	'sorter' => 'srt'
);

function get_offer_filter_link($_filters, $type, $value){
	global $_params, $_current_link_no_page;
	
	return $_current_link_no_page.'?'.get_offer_filters($_filters, $type, $value);
}

function remove_offer_filter_link($_filters, $type, $value){
	global $_params, $_current_link_no_page;
	
	return $_current_link_no_page.'?'.remove_offer_filters($_filters, $type, $value);
}

function get_offer_filters($_filters, $type = '', $value = ''){
	global $_params, $_offer_filter_links;
	
	$url = "";
	
	foreach($_offer_filter_links as $filter => $link){
		if($filter == $type){
			if(!in_array($value, $_filters[$type])){
				$_filters[$type][] = $value;
			}
		}
		if(count($_filters[$filter])){
			if($link != "pr"){
				if(($link == "of" && $type == "offer") || ($link == "st" && $type == "special_tags")){
					$url .= "&".$link."=".$value;
				}else{
					$url .= "&".$link."=".implode(',', $_filters[$filter]);
				}
			}
		}
		if($link == "q" || $link == "srt"){
			if($_GET[$link] != ""){
				$url .= "&".$link."=".$_GET[$link];
			}
		}
	}
	
	if($type == "price"){
		$url .= "&".$_offer_filter_links[$type]."=";
	}else{
		if($_filters['price']['min']){
			$url .= "&pr=".$_filters['price']['min'].'-'.$_filters['price']['max'];
		}
	}
	
	/*
	foreach($_offer_filter_links as $filter => $link){
		if($filter == $type){
			if(!in_array($value, $_filters[$type])){
				$_filters[$type][] = $value;
			}
		}
		if(count($_filters[$filter])){
			if($type == "price" && $link == "pr"){
				$url .= "&".$link."=";
			}else{
				if($link == "pr"){
					$url .= "&".$link."=".$_filters[$filter]['min'].'-'.$_filters[$filter]['max'];
				}elseif($link == "of" || $link == "st"){
					$url .= "&".$link."=".$value;
				}else{
					$url .= "&".$link."=".implode(',', $_filters[$filter]);
				}
			}
		}
		if($link == "q" || $link == "srt"){
			if($_GET[$link] != ""){
				$url .= "&".$link."=".$_GET[$link];
			}
		}
	}
	*/
	
	return $url;
}

function remove_offer_filters($_filters, $type = '', $value = ''){
	global $_params, $_offer_filter_links;
	
	$url = "";
	
	foreach($_offer_filter_links as $filter => $link){
		if($filter == $type){
			foreach($_filters[$type] as $k => $v){
				if($v == $value){
					unset($_filters[$type][$k]);
				}
			}
		}
		if(count($_filters[$filter])){
			if($link == "pr"){
				$url .= "&".$link."=".$_filters[$filter]['min'].'-'.$_filters[$filter]['max'];
			}else{
				$url .= "&".$link."=".implode(',', $_filters[$filter]);
			}
		}
		if(($link == "q" && $type != 'query') || ($link == "srt" && $type != 'sorter')){
			if($_GET[$link] != ""){
				$url .= "&".$link."=".$_GET[$link];
			}
		}
	}
	
	return $url;
}

function get_offer_sort_link($value){
	global $_current_link_no_page;
	
	if($_SERVER['QUERY_STRING'] != ""){
		$get_params = explode('&', $_SERVER['QUERY_STRING']);
		foreach($get_params as $item){
			if($item != ""){
				$tmp = explode('=', $item);
				if($tmp[1] != ""){
					$new_get_params[$tmp[0]] = $tmp[1];
				}
			}
		}
	}
	
	$new_get_params['srt'] = $value;
	foreach($new_get_params as $k => $v){
		$new_query .= "&".$k.'='.$v;
	}
	
	return $_current_link_no_page . ($new_query != '' ? '?' . $new_query : '');
}






