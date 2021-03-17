<?

go_away(route('home'));

$options = array(
    'table' => 'team',
	'limit' => -1,
	'order' => 'id_team ASC',
	'images' => true
);

if(isset($_params['cat'])){
	$_cat = get_team_by_slug($_params['cat']);

	if(!$_cat){
		go_away(route('team'));
	}

	$options['id_team_category'] = $_cat['id_team_category'];
}else{
	$_cat = get_post(array(
		'table' => 'team_category',
		'limit' => 1,
		'order' => 'order ASC'
	));
	$options['id_team_category'] = $_cat['id_team_category'];
}

list($_items, $_count) = get_posts($options);


list($_categories) = get_posts(array(
	'table' => 'team_category',
	'limit' => -1,
	'order' => 'order ASC',
));

$_autoritatea = get_post(array(
	'table' => 'page',
	'id_page' => 251
));


// seo
$seo = get_seo('echipa');
$_meta_title = $seo['title'] ? $seo['title'] : 'Echipa Paralela 45'.( isset($_params['cat']) ? " - ".$_cat['title'] : "");
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
