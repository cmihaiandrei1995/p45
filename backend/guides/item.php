<?

list($_items, $_count) = get_posts(array(
	'table' => 'guide',
	'limit' => -1,
	'images' => true
));

foreach($_items as $item){
	if(generate_name($item['title']) == $_params['slug']){
		$_item = $item;
		break;
	}
}
if(!$_item){
	go_away(route('guides'));
}

list($_testimonials, $_count_test) = get_posts( array(
	'table' => 'testimonial',
	'limit' => -1,
	'images' => true,
	'extra_where' => ' AND id_testimonial IN (SELECT id_testimonial FROM testimonial_to_guide WHERE id_guide = '.$_item['id_guide'].')',
));



// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;