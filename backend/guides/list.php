<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 253,
));

list($_items, $_count) = get_posts(array(
	'table' => 'guide',
	'limit' => -1,
	'images' => true
));


$_section = 'guides';



//seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;