<?
$_ipp = $_config['paging']['ipp']['about-media'];

list($_texts, $_count) = get_posts(array(
	'table' => 'about_media',
	'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
));

list($_despre_pages, $count) = get_posts(array(
	'table' => 'about_new',
	'limit' => -1
));

$_section = 'about-media';

// seo
$seo = get_seo('despre_noi_media');
$_meta_title = $seo['title'] ? $seo['title'] : 'Paralela 45 in media';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
