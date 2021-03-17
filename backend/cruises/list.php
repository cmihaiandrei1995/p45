<?

$_ipp = $_config['paging']['ipp']['cruises'];

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 1
));


// general options
$options = array(
    'table' => 'cruise',
    'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
	//'order' => '`order` ASC, id_cruise DESC'
	'order' => 'price ASC'
);

//sort
if(isset($_GET['srt']) && $_GET['srt'] == "pra"){
	$options['order'] = 'price ASC';
}

if(isset($_GET['srt']) && $_GET['srt'] == "prd"){
	$options['order'] = 'price DESC';
}

if(isset($_GET['srt']) && $_GET['srt'] == "ta"){
	$options['order'] = 'title ASC';
}

if(isset($_GET['srt']) && $_GET['srt'] == "td"){
	$options['order'] = 'title DESC';
}

if(isset($_GET['srt']) && $_GET['srt'] == "na"){
	$options['order'] = 'nights ASC';
}

if(isset($_GET['srt']) && $_GET['srt'] == "nd"){
	$options['order'] = 'nights DESC';
}

// if promo page
if($_params['promo']){
	$options['promo'] = 1;
	$query_promo = array(
        'key' => 'cruise.promo',
        'compare' => '=',
        'value' => 1,
    );

	$options['query'][] = array(
        'key' => 'cruise.price_promo',
        'compare' => '>',
        'value' => 0,
    );
	$query_promo2 = array(
        'key' => 'cruise.price_promo',
        'compare' => '>',
        'value' => 0,
    );

	$options['query'][] = array(
        'key' => 'cruise.date_offer_to',
        'compare' => 'IS NULL',
    );
	$query_promo_date = array(
        'key' => 'cruise.date_offer_to',
        'compare' => 'IS NULL',
    );
}

// if bestdeals page
if($_params['bestdeal']){
	$options['promo'] = 1;
	$query_promo = array(
        'key' => 'cruise.promo',
        'compare' => '=',
        'value' => 1,
    );

	$options['query'][] = array(
        'key' => 'cruise.date_offer_to',
        'compare' => '>=',
        'value' => date('Y-m-d'),
    );
	$query_promo_date = array(
        'key' => 'cruise.date_offer_to',
        'compare' => '>=',
        'value' => date('Y-m-d'),
    );

	$options['order'] = 'CAST(`price_promo` AS signed) ASC';
}



######################## Check for existing filters

// destination
if(isset($_params['dest'])){
	$tmp = get_cruise_destination_by_slug($_params['dest']);
	$_filters['dest'][] = $tmp['id_cruise_destination'];
	$_meta_extra_title = " - ".$tmp['title'];
}
if(isset($_GET['d']) && $_GET['d'] != ""){
	$tmp = explode(',', $_GET['d']);
	foreach($tmp as $t){
		$_filters['dest'][] = $t;
	}
}
if(count($_filters['dest'])){
	$all_dest = $_filters['dest'];

	foreach($_filters['dest'] as $dest){
		$children = get_cruise_destinations_by_parent_id($dest);
		if($children){
			foreach($children as $child){
				$_filters['extra_dest'][] = $child['id_cruise_destination'];
			}
		}
	}

	foreach($_filters['extra_dest'] as $val){
		$all_dest[] = $val;
	}
	array_unique($all_dest);

	$query_dest = array(
        'key' => 'id_cruise_destination',
        'compare' => 'IN',
        'value' => $all_dest,
    );
	$options['query'][] = $query_dest;
}

// cruise line
if(isset($_params['line'])){
	$tmp = get_cruise_line_by_slug($_params['line']);
	$_filters['line'][] = $tmp['id_cruise_line'];
	$_meta_extra_title = " - ".$tmp['title'];
}
if(isset($_GET['l']) && $_GET['l'] != ""){
	$tmp = explode(',', $_GET['l']);
	foreach($tmp as $t){
		$_filters['line'][] = $t;
	}
}
if(count($_filters['line'])){
	$query_line = array(
        'key' => 'cruise.id_cruise_line',
        'compare' => 'IN',
        'value' => $_filters['line'],
    );
    $options['query'][] = $query_line;
}

// ships
if(isset($_params['ship'])){
	$tmp = get_cruise_ship_by_slug($_params['ship']);
	$_filters['ship'][] = $tmp['id_cruise_ship'];
	$_meta_extra_title = " - ".$tmp['title'];
}
if(isset($_GET['s']) && $_GET['s'] != ""){
	$tmp = explode(',', $_GET['s']);
	foreach($tmp as $t){
		$_filters['ship'][] = $t;
	}
}
if(count($_filters['ship'])){
	$query_ship = array(
        'key' => 'cruise.id_cruise_ship',
        'compare' => 'IN',
        'value' => $_filters['ship'],
    );
	$options['query'][] = $query_ship;
}

// cruise category
if(isset($_params['cat'])){
	$tmp = get_cruise_category_by_slug($_params['cat']);
	$_filters['cat'][] = $tmp['id_cruise_category'];
	$_meta_extra_title = " - ".$tmp['title'];
}
if(isset($_GET['c']) && $_GET['c'] != ""){
	$tmp = explode(',', $_GET['c']);
	foreach($tmp as $t){
		$_filters['cat'][] = $t;
	}
}
if(count($_filters['cat'])){
	$options['join'][] = array('cruise_to_category', 'id_cruise', true);
	$options['query'][] = array(
        'key' => 'cruise_to_category.id_cruise_category',
        'compare' => 'IN',
        'value' => $_filters['cat'],
    );
	$query_cat = array(
        'key' => 'cruise.id_cruise',
        'compare' => 'IN',
        'value' => '( SELECT id_cruise FROM cruise_to_category WHERE id_cruise_category IN ('.implode(",", $_filters['cat']).') )',
    );
}

// starting point
if(isset($_GET['p']) && $_GET['p'] != ""){
	$tmp = explode(',', $_GET['p']);
	foreach($tmp as $t){
		$_filters['port'][] = $t;
	}

	$query_port = array(
        'key' => 'cruise.port_start',
        'compare' => 'IN',
        'value' => $_filters['port'],
    );
	$options['query'][] = $query_port;
}

// date
if(isset($_GET['t']) && $_GET['t'] != ""){
	$tmp = explode(',', $_GET['t']);
	foreach($tmp as $t){
		$_filters['date'][] = $t;
	}

	$query_date = array(
        'key' => 'DATE_FORMAT(`date`, "%c-%Y")',
        'compare' => 'IN',
        'value' => $_filters['date'],
    );
	$options['query'][] = $query_date;

	$join_date = array('cruise_date', 'id_cruise', false);
	$options['join'][] = $join_date;
}

// nights
if(isset($_GET['n']) && $_GET['n'] != ""){
	$tmp = explode(',', $_GET['n']);
	foreach($tmp as $t){
		$_filters['nights'][] = $t;
	}

	$query_nights = array(
		'relation' => 'OR'
	);

	foreach($_filters['nights'] as $val){
		switch($val){
			case 1: {
				$query_nights[] = array(
			        'key' => 'nights',
			        'compare' => '<=',
			        'value' => 4,
			    );
			}break;
			case 2: {
				$query_nights[] = array(
			        'key' => 'nights',
			        'compare' => 'BETWEEN',
			        'value' => array(5, 8),
			    );
			}break;
			case 3: {
				$query_nights[] = array(
			        'key' => 'nights',
			        'compare' => 'BETWEEN',
			        'value' => array(9, 14),
			    );
			}break;
			case 4: {
				$query_nights[] = array(
			        'key' => 'nights',
			        'compare' => 'BETWEEN',
			        'value' => array(15, 20),
			    );
			}break;
			case 5: {
				$query_nights[] = array(
			        'key' => 'nights',
			        'compare' => '>',
			        'value' => 20,
			    );
			}break;
		}
	}

	$options['query'][] = $query_nights;
}

// price
if(isset($_GET['pr']) && $_GET['pr'] != ""){
	$_GET['pr'] = str_replace(",", "-", $_GET['pr']);
	$tmp = explode('-', $_GET['pr']);
	$_filters['price']['min'] = $tmp[0];
	$_filters['price']['max'] = $tmp[1];

	$query_price = array(
		'relation' => 'OR'
	);
	$query_price[] = array(
        'key' => 'price',
        'compare' => 'BETWEEN',
        'value' => array($_filters['price']['min'], $_filters['price']['max']),
    );
	$query_price[] = array(
        'key' => 'price_promo',
        'compare' => 'BETWEEN',
        'value' => array($_filters['price']['min'], $_filters['price']['max']),
    );
	$options['query'][] = $query_price;
}


######################## Get cruises
$options['groupby'] = 'cruise.id_cruise';
list($_items, $_count) = get_posts($options);
$_nr_pages = ceil($_count/$_ipp);

foreach($_items as &$item){
	$item = get_cruise_info($item);
	unset($item);
}

if($_count == 0){
	unset($query_dest);
	unset($query_line);
	unset($query_ship);
	unset($query_port);
	unset($query_date);
	unset($query_nights);
	unset($query_price);
}


######################## Filters

// destinations
list($dest, $dest_count) = get_posts(array(
    'table' => 'cruise_destination',
	'limit' => -1,
	'parent_id' => 0,
	'join' => array('cruise', 'id_cruise_destination', true),
	'extra_where' => 'AND '.db_is_active('', 'cruise'),
	'order' => 'price ASC',
));
foreach($dest as $item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'dest', $item['id_cruise_destination']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'dest', $item['id_cruise_destination']);

	list($item['sub'], $dest_sub_count) = get_posts(array(
	    'table' => 'cruise_destination',
		'limit' => -1,
		'parent_id' => $item['id_cruise_destination'],
		'join' => array(
			array('cruise', 'id_cruise_destination', true),
			$join_date,
		),
		'extra_where' => 'AND '.db_is_active('', 'cruise'),
		'query' => array(
			$query_promo,
			$query_promo2,
			$query_promo_date,
			$query_line,
			$query_ship,
			$query_port,
			$query_cat,
			$query_date,
			$query_nights,
			$query_price
		),
		'order' => 'title ASC',
	));
	foreach($item['sub'] as &$sub){
		$sub['add-url'] = get_cruise_filter_link($_filters, 'dest', $sub['id_cruise_destination']);
		$sub['remove-url'] = remove_cruise_filter_link($_filters, 'dest', $sub['id_cruise_destination']);
		unset($sub);
	}

	$_destinations[] = $item;
}

// cruise lines
list($_lines, $_lines_count) = get_posts(array(
    'table' => 'cruise_line',
	'limit' => -1,
	'join' => array(
		array('cruise', 'id_cruise_line', true),
		$join_date,
	),
	'extra_where' => 'AND '.db_is_active('', 'cruise'),
	'query' => array(
		$query_promo,
		$query_promo2,
		$query_promo_date,
		$query_dest,
		$query_ship,
		$query_port,
		$query_cat,
		$query_date,
		$query_nights,
		$query_price
	),
	'order' => 'title ASC',
));
foreach($_lines as &$item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'line', $item['id_cruise_line']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'line', $item['id_cruise_line']);
	unset($item);
}

// ships
list($_ships, $_ships_count) = get_posts(array(
    'table' => 'cruise_ship',
	'limit' => -1,
	'join' => array(
		array('cruise', 'id_cruise_ship', true),
		$join_date,
	),
	'extra_where' => 'AND '.db_is_active('', 'cruise'),
	'query' => array(
		$query_promo,
		$query_promo2,
		$query_promo_date,
		$query_dest,
		$query_line,
		$query_port,
		$query_cat,
		$query_date,
		$query_nights,
		$query_price
	),
	'order' => 'title ASC',
));
foreach($_ships as &$item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'ship', $item['id_cruise_ship']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'ship', $item['id_cruise_ship']);
	unset($item);
}

// starting points
list($_ports, $_ports_count) = get_posts(array(
    'table' => 'cruise_port',
	'limit' => -1,
	'join' => array(
		array('cruise', 'id_cruise_port=port_start', true),
		$join_date,
	),
	'extra_where' => 'AND id_cruise_port IN ( SELECT port_start FROM cruise WHERE '.db_is_active('', 'cruise').' AND port_start > 0 GROUP BY port_start ) AND '.db_is_active('', 'cruise'),
	'query' => array(
		$query_promo,
		$query_promo2,
		$query_promo_date,
		$query_dest,
		$query_line,
		$query_ship,
		$query_cat,
		$query_date,
		$query_nights,
		$query_price
	),
	'order' => '`title` ASC',
));
foreach($_ports as &$item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'port', $item['id_cruise_port']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'port', $item['id_cruise_port']);
	unset($item);
}

// cruise category
list($cat, $cat_count) = get_posts(array(
    'table' => 'cruise_category',
	'limit' => -1,
	//'parent_id' => 0,
	'join' => array(
		array('cruise_to_category', 'id_cruise_category', true),
		array('cruise', 'id_cruise', false),
		$join_date,
	),
	'extra_where' => 'AND '.db_is_active('', 'cruise'),
	'query' => array(
		$query_promo,
		$query_promo2,
		$query_promo_date,
		$query_dest,
		$query_line,
		$query_ship,
		$query_port,
		$query_date,
		$query_nights,
		$query_price
	),
	'order' => '`order` ASC',
));
foreach($cat as $item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'cat', $item['id_cruise_category']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'cat', $item['id_cruise_category']);

	$_categories[] = $item;
}

// dates
list($_dates, $_dates_count) = get_posts(array(
    'table' => 'cruise_date',
    'select' => array(
    	'DATE_FORMAT(`date`, "%M %Y")' => 'date_solution',
    	'DATE_FORMAT(`date`, "%c")' => 'month',
    	'DATE_FORMAT(`date`, "%Y")' => 'year'
	),
	'limit' => -1,
	'join' => array(
		array('cruise', 'id_cruise', false),
	),
	'query' => array(
		/*
		array(
	        'key' => 'cruise_date.book_id',
	        'compare' => '>',
	        'value' => 0,
	    ),
		*/
	    array(
	        'key' => 'cruise_date.date',
	        'compare' => '>',
	        'value' => date('Y-m-d'),
	    ),
	    $query_promo,
		$query_promo2,
		$query_promo_date,
		$query_dest,
		$query_line,
		$query_ship,
		$query_port,
		$query_cat,
		$query_nights,
		$query_price
	),
	'extra_where' => ' AND id_cruise IN ( SELECT id_cruise FROM cruise WHERE '.db_is_active('', 'cruise').' )',
	'status' => '',
	'groupby' => 'date_solution',
	'order' => '`date` ASC',
));
foreach($_dates as &$item){
	$item['add-url'] = get_cruise_filter_link($_filters, 'date', $item['month'].'-'.$item['year']);
	$item['remove-url'] = remove_cruise_filter_link($_filters, 'date', $item['month'].'-'.$item['year']);
	unset($item);
}

// nights
foreach($_cruise_nights_filter as $key => $val){
	$_nights_links[$key]['add-url'] = get_cruise_filter_link($_filters, 'nights', $key);
	$_nights_links[$key]['remove-url'] = remove_cruise_filter_link($_filters, 'nights', $key);
}

// price
if(isset($_GET['pr'])){
	array_pop($options['query']);
}

$options['order'] = 'price ASC';
$options['limit'] = 1;
$_price_min = get_post($options);

$options['order'] = 'price_promo ASC';
$_price_promo_min = get_post($options);

$options['order'] = 'price DESC';
$_price_max = get_post($options);

$options['order'] = 'price_promo DESC';
$_price_promo_max = get_post($options);

$_price['min'] = max(0, min($_price_min['price'], $_price_promo_min['price_promo']));
$_price['max'] = max($_price_max['price'], $_price_promo_max['price_promo']);

$_price_filter_link = get_cruise_filter_link($_filters, 'price', '');






$_section = "cruises";
$_active_tab = "cruises";





// seo
if($_params['saved']){
	$_breadcrumbs = array(
	    __('Croazierele mele') => '',
	);

	$_meta_title = __('Croazierele mele');

	$_section = "cruises";
}elseif($_params['promo']){
	$_breadcrumbs = array(
	    __('Promotii croaziere') => '',
	);

	$seo = get_seo('promotii');
	$_meta_title = $seo['title'] ? $seo['title'] : __('Promotii croaziere');

	$_section = "cruises";
}else{
	$_breadcrumbs = array(
	    __('Croaziere') => '',
	);
	$seo = get_seo('croaziere');
	$_meta_title = $seo['title'] ? $seo['title'] : __('Croaziere');
	$_meta_title .= $_meta_extra_title;

	$_section = "cruises";
}

if($_params['page'] > 1){
	$_meta_title .= " - ".__('Pagina')." ".$_params['page'];
}
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
if(isset($_GET['d']) || isset($_GET['l']) || isset($_GET['s']) || isset($_GET['p']) || isset($_GET['c']) || isset($_GET['t']) || isset($_GET['n']) || isset($_GET['pr']) || isset($_GET['srt'])){
	$_no_index = true;
}else{
	$_no_index = false;
}
