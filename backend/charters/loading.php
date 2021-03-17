<?

$_search = db_row('SELECT * FROM charter_search WHERE id_charter_search = ?', $_params['id']);
if(!$_search) go_away(route('charters-home'));

$id_search = $_search['id_charter_search'];

$_country = get_country_by_id($_search['id_country']);

$imgs = get_images('country', $_country['id_country']);
if($imgs){
	$_header_img = $imgs[0]['big'];
}else{
	$_header_img = $_base_static."img/header_chartere.jpg";
}

$_section = "charters";
$_active_tab = "charters";


// seo
$_meta_title = "Cautare pachete de vacanta";
$_meta_description = '';
$_meta_keywords = '';
$_no_index = true;
