<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 1
));

list($_destinations, $dest_count) = get_posts(array(
    'table' => 'cruise_destination',
	'limit' => -1,
	'join' => array('cruise', 'id_cruise_destination', true),
	'extra_where' => 'AND '.db_is_active('', 'cruise'),
	'order' => 'cruise_destination.title ASC',
	'query' => array(
		array(
			'key' => 'parent_id',
			'compare' => '=',
			'value'  => 0
		)
	)
));

foreach($_destinations as &$item){
	$item['images'] = get_images('cruise_destination', $item['id_cruise_destination']);
	$item['url'] = route('cruises-dest', $item['title']);
	
	list($_subdestinations, $dest_count) = get_posts(array(
	    'table' => 'cruise_destination',
		'limit' => -1,
		'join' => array('cruise', 'id_cruise_destination', true),
		'extra_where' => 'AND '.db_is_active('', 'cruise'),
		'order' => 'cruise_destination.title ASC',
		'parent_id' => $item['id_cruise_destination']
	));
	foreach($_subdestinations as &$subitem){
		$subitem['images'] = get_images('cruise_destination', $subitem['id_cruise_destination']);
		$subitem['url'] = route('cruises-dest', $subitem['title']);
		unset($subitem);
	}

	$item['destinations'] = $_subdestinations;
	unset($item);
}


$_section = "cruises";
$_active_tab = "cruises";

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;