<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => intval($_params['id'])
));
if(!$_text) go_away($_base);

$_section = '';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
