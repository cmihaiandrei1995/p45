<?
list($_vacations, $_count) = get_posts(array(
	'table' => 'vacation',
	'limit' => -1,
	'images' => true
));

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 255
));

list($_rec_vacation, $_count_rec) = get_posts(array(
	'table' => 'box_vacation',
	'limit' => 3,
	'images' => true
));



$_section = 'vacation';

include $_base_path.'backend/common/forms/contact-form-vacations.php';

// seo
$seo = get_seo('vacations');
$_meta_title = $seo['title'] ? $seo['title'] : 'Vacante la comanda';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;