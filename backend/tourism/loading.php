<?

$_search = db_row('SELECT * FROM hotel_search WHERE id_hotel_search = ?', $_params['id']);
if(!$_search) go_away(route('tourism-home'));

$id_search = $_search['id_hotel_search'];

$_country = get_country_by_id($_search['id_country']);

$imgs = get_images('country', $_country['id_country']);
if($imgs){
	$_header_img = $imgs[0]['big'];
}else{
	if($_search['is_ro']){
		$_header_img = $_base_static."img/banner-ti-lp.jpg";
	}else{
		$_header_img = $_base_static."img/header_turism-individual.jpg";
	}
}

if($_search['is_ro']){
	$_section = "tourism-ro";
	$_active_tab = "tourism-ro";
}else{
	$_section = "tourism";
	$_active_tab = "tourism";
}


// seo
$_meta_title = "Cautare sejururi";
$_meta_description = '';
$_meta_keywords = '';
$_no_index = true;