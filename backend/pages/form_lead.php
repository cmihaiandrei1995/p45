<?

list($_forms, $count) = get_posts(array(
	'table' => 'form',
	'limit' => -1
)); 

foreach($_forms as $form){
	if(generate_name($form['title']) == $_params['slug']){
		$_text = $form;
		break;
	}
}


$_section = 'forms';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = true;