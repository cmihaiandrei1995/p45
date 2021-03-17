<?

$_ipp = $_config['paging']['ipp']['agencies-partner'];

$options = array(
    'table' => 'agency_partner',
	'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
	//'order' => 'id_agency_partner ASC',
	'images' => true
);

$_judete[] = "Chisinau"; // hack since Chisinau is not a $judet

if(isset($_params['city'])){

    foreach($_judete as $judet){
        if($_params['judet'] == generate_name($judet)){
            $_judet = $judet;
            break;
        }
    }

    if(!$_judet){
		go_away(route('agencies-partner'));
	}

	$_city = get_city_by_slug($_params['city']);

	if(!$_city && !$_judet){
		go_away(route('agencies-partner'));
	}

	$options['id_city'] = $_city['id_city'];
    $_item_title = $_city['title'];

}elseif(isset($_params['judet'])){

    foreach($_judete as $judet){
        if($_params['judet'] == generate_name($judet)){
            $_judet = $judet;
            break;
        }
    }

    if(!$_judet){
		go_away(route('agencies-partner'));
	}

    $options['judet'] = $_judet;
    $_item_title = $_judet;

}else{

	$_city['title'] = $_judet = "Bucuresti";
	$options['id_city'] = 14997;
	$item['city'] = "Bucuresti";
    $_item_title = $_city['title'];

}

list($_items, $_count_agencies) = get_posts($options);
$_nr_pages = intval($_count_agencies/$_ipp);

foreach($_items as &$item){
    $city = get_city_by_id($item['id_city']);
	$item['city'] = $city['title'];
	unset($item);
}

list($_judete_list, $_count) = get_posts(array(
	'table' => 'agency_partner',
	'limit' => -1,
	'order' => 'judet ASC',
    'groupby' => 'judet'
));

if($_judet){
    list($_cities, $_count) = get_posts(array(
    	'table' => 'city',
    	'limit' => -1,
    	'extra_where' => ' AND id_city IN (SELECT id_city FROM agency_partner WHERE judet = "'.$_judet.'")',
    	'order' => 'title ASC'
    ));
}

//print_r($_cities);

$_autoritatea = get_post(array(
	'table' => 'page',
	'id_page' => 251
));


// seo
$seo = get_seo('agentii-partenere');
$_meta_title = $seo['title'] ? $seo['title'] : 'Agentii Partenere'.( isset($_params['city']) ? " - ".$_city['title'] : "");
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = true;
