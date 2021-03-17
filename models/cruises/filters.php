<?

$_cruise_filter_links = array(
	'dest' => 'd',
	'line' => 'l',
	'ship' => 's',
	'port' => 'p',
	'cat' => 'c',
	'date' => 't',
	'nights' => 'n',
	'price' => 'pr'
);


function get_cruise_filter_link($_filters, $type, $value, $route = 'cruises'){
	global $_params;
	
	// check if any filter is set
	if(isset($_GET['d']) || isset($_GET['l']) || isset($_GET['s']) || isset($_GET['p']) || isset($_GET['c']) || isset($_GET['t']) || isset($_GET['n']) || isset($_GET['pr'])){
		$is_filter = true;
	}
	if(isset($_params['dest']) || isset($_params['line']) || isset($_params['ship']) || isset($_params['cat'])){
		$is_filter = true;
	}
	
	switch($type){
		case 'dest': {
			if(!$is_filter && $route == 'cruises'){
				$item = get_cruise_destination_by_id($value);
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : ""))).'-dest', $item['title']);
				return $url;
			}else{
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'dest', $value);
				return $url;
			}
		}break;
		case 'line': {
			if(!$is_filter && $route == 'cruises'){
				$item = get_cruise_line_by_id($value);
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : ""))).'-line', $item['title']);
				return $url;
			}else{
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'line', $value);
				return $url;
			}
		}break;
		case 'ship': {
			if(!$is_filter && $route == 'cruises'){
				$item = get_cruise_ship_by_id($value);
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : ""))).'-ship', $item['title']);
				return $url;
			}else{
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'ship', $value);
				return $url;
			}
		}break;
		case 'cat': {
			if(!$is_filter && $route == 'cruises'){
				$item = get_cruise_category_by_id($value);
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : ""))).'-cat', $item['title']);
				return $url;
			}else{
				$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'cat', $value);
				return $url;
			}
		}break;
		case 'port': {
			$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'port', $value);
			return $url;
		}break;
		case 'date': {
			$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'date', $value);
			return $url;
		}break;
		case 'nights': {
			$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'nights', $value);
			return $url;
		}break;
		case 'price': {
			$url = route($route.($_params['promo'] ? "-promo" : ($_params['bestdeal'] ? "-best-deals" : ($_params['fluvial'] ? "-fluvial" : "")))).'?'.get_cruise_filters($_filters, 'price', $value);
			return $url;
		}break;
	}
}

function remove_cruise_filter_link($_filters, $type, $value, $route = 'cruises'){
	global $_params;
	
	return route($route).'?'.remove_cruise_filters($_filters, $type, $value);
}

function get_cruise_filters($_filters, $type = '', $value = ''){
	global $_params, $_cruise_filter_links;
	
	$url = "";
	
	foreach($_cruise_filter_links as $filter => $link){
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
				}else{
					$url .= "&".$link."=".implode(',', $_filters[$filter]);
				}
			}
		}
	}
	
	return $url;
}

function remove_cruise_filters($_filters, $type = '', $value = ''){
	global $_params, $_cruise_filter_links;
	
	$url = "";
	
	foreach($_cruise_filter_links as $filter => $link){
		if($filter == $type){
			foreach($_filters[$type] as $k => $v){
				if($v == $value){
					unset($_filters[$type][$k]);
				}
			}
		}
		if(count($_filters[$filter])){
			$url .= "&".$link."=".implode(',', $_filters[$filter]);
		}
	}
	
	return $url;
}

function get_cruise_sort_link($value){
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
	
	return $_SERVER['SCRIPT_URI'] . ($new_query != '' ? '?' . $new_query : '');
}






