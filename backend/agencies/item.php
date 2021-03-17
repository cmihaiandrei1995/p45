<?


list($_items, $_count) = get_posts(array(
	'table' => 'agency',
	'limit' => -1,
	'images' => true
));

foreach($_items as $item){
	if(generate_name($item['title']) == $_params['slug']){
		$_item = $item;
		break;
	}
}
if(!$_item){
	go_away(route('agencies'));
}

if($_item['id_city'] > 0){
	$_city_current = get_city_by_id($_item['id_city']);

	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => ' AND id_city IN (SELECT id_city FROM agency where active = 1 ) AND id_country= '.$_city_current['id_country'].' AND id_city <> 21749',
		'order' => 'title ASC'
	));
}else{
	list($_cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => ' AND id_city IN (SELECT id_city FROM agency where active = 1 ) AND id_city <> 21749',
		'order' => 'title ASC'
	));
}

$_online_city = get_post(array(
	'table' => 'city',
	'id_city' => 21749,
));
array_unshift($_cities, $_online_city);

list($_team, $count) = get_posts(array(
	'table' => 'team',
	'limit' => -1,
	'extra_where' => 'AND id_team IN (SELECT id_team FROM agency_to_team WHERE id_agency IN (SELECT id_agency FROM agency WHERE id_agency= '.$_item['id_agency'].' AND '.db_is_active('', 'agency').'))',
	'images' => true
));

list($_countries, $_count) = get_posts(array(
	'table' => 'country',
	'limit' => -1,
	'extra_where' => ' AND id_country IN (SELECT id_country FROM city WHERE id_city in (SELECT id_city FROM agency))',
	'order' => 'title DESC'
));

$_section = "agencies";

include $_base_path.'backend/common/forms/contact-form-agencies.php';

// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
