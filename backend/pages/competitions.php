<?

go_away($_base);

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 254

));

list($_texts) = get_posts(array(
	'table' => 'competitions',
	'limit' => -1,
	'images' => true
));


$_section='competitions';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
