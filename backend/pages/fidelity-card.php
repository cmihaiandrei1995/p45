<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 9
	
));

$_section = 'fidelity-card';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;