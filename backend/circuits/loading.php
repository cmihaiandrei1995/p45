<?

$_search = db_row('SELECT * FROM circuit_search WHERE id_circuit_search = ?', $_params['id']);
if(!$_search) go_away(route('circuits-home'));

$id_search = $_search['id_circuit_search'];

$_country = get_country_by_id($_search['id_country']);

$imgs = get_images('country', $_country['id_country']);
if($imgs){
	$_header_img = $imgs[0]['big'];
}else{
	$_header_img = $_base_static."img/header_circuite.jpg";
}

$_section = "circuits";
$_active_tab = "circuits";


// seo
$_meta_title = "Cautare circuite";
$_meta_description = '';
$_meta_keywords = '';
$_no_index = true;