<?

list($_texts) = get_posts(array(
	'table' => 'about',
	'limit' => -1,
));

$_section = 'about';

// seo
$seo = get_seo('despre_noi');
$_meta_title = $seo['title'] ? $seo['title'] : 'Despre Paralela 45';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;