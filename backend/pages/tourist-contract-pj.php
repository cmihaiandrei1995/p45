<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 266

));

$_section = 'tourist-contract-pj';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
