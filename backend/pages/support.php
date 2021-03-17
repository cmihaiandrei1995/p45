<? 

list($_texts, $_count) = get_posts(array(
	'table' => 'faq',
	'limit' => -1
));





$_section = 'support';

// seo
$seo = get_seo('support');
$_meta_title = $seo['title'] ? $seo['title'] : 'Suport Clienti';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;