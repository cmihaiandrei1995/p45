<?

list($_texts) = get_posts(array(
	'table' => 'vacation_rate',
	'limit' => -1,
));

$_section = 'vacation_rate';

// seo
$seo = get_seo('vacation_rate');
$_meta_title = $seo['title'] ? $seo['title'] : 'Vacante in rate';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;