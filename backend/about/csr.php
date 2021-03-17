<?

list($_texts) = get_posts(array(
	'table' => 'csr',
	'limit' => -1,
));

list($_despre_pages, $count) = get_posts(array(
	'table' => 'about_new',
	'limit' => -1
));

$_section = 'csr';

// seo
$seo = get_seo('actiuni_csr');
$_meta_title = $seo['title'] ? $seo['title'] : 'Actiuni CSR';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
