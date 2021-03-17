<?
$_ipp = $_config['paging']['ipp']['about-media'];

list($_texts, $_count) = get_posts(array(
	'table' => 'about_corona',
	'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
));

list($_despre_pages, $count) = get_posts(array(
	'table' => 'about_new',
	'limit' => -1
));

$_section = 'about-corona';

// seo
$seo = get_seo('informari_coronavirus');
$_meta_title = $seo['title'] ? $seo['title'] : 'Informari Paralela 45 -  Coronavirus';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
