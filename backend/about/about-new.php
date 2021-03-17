<?

$_ipp = 40;

$_text = get_post(array(
	'table' => 'about_new',
	'id_about_new' => $_params['id'],
    // 'images' => true
));

$_text['images'] = get_images('about_new', $_params['id'], array('title'));

// if(debug_mode()){
// 	print_r($_text);
// 	exit;
// }

list($_despre_pages, $count) = get_posts(array(
	'table' => 'about_new',
	'limit' => -1
));

if($_params['id'] == 5){
	$_count = count($_text['images']);
	$offset = $_params['page'] ? $_ipp * ($_params['page']-1) : 0;
	$_nr_pages = ceil(count($_text['images'])/$_ipp);
	$_text['images'] = array_slice($_text['images'], $offset, $_ipp);
}



$_section = 'about';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
