<?

//if(!isset($_GET['home'])){
	//go_away(route('bf'));
//}







// main slider
list($_slides, $slides_count) = get_posts(array(
	'table' => 'home_slider',
	'limit' => -1,
	'images' => true
));
foreach($_slides as &$slide){
	if($slide['banner'] != ""){
		$slide['banner_img'] = $_base_uploads.'images/'.$slide['banner_path'].$slide['banner'];
	}

	if($slide['counter_expire'] != ""){
		$time_left = strtotime($slide['counter_expire']) - time();
		if($time_left > 0){
			$slide['show_counter'] = true;
			$slide['counter_days'] = floor($time_left / 86400);
			$slide['counter_hours'] = floor(($time_left - $slide['counter_days'] * 86400) / 3600);
			$slide['counter_minutes'] = floor(($time_left - ($slide['counter_days'] * 86400 + $slide['counter_hours'] * 3600)) / 60);
			$slide['counter_seconds'] = floor(($time_left - ($slide['counter_days'] * 86400 + $slide['counter_hours'] * 3600 + $slide['counter_minutes'])) / 60);
		}
	}

	unset($slide);
}

// circuits counter
$_circuit_continents_homepage = cache_get('homepage__circuit_continents');
if(!$_circuit_continents_homepage){
	foreach($_circuit_continents as &$continent){
		$count = db_row('SELECT COUNT(*) AS nr FROM circuit WHERE id_circuit IN (SELECT id_circuit FROM circuit_to_city WHERE id_city IN (SELECT id_city FROM city WHERE id_country IN (SELECT id_country FROM country WHERE id_continent = '.$continent['id_continent'].' AND '.db_is_active('', 'country').') AND '.db_is_active('', 'city').')) AND '.db_is_active('', 'circuit'));
		// id_circuit IN (SELECT id_circuit FROM circuit_date_price) AND

		$continent['count'] = $count['nr'];

		$continent['url'] = route('circuits-cont', $continent['title']);
		$_circuit_continents_homepage[] = $continent;

		unset($continent);
	}

	cache_set('homepage__circuit_continents', $_circuit_continents_homepage, 60*60);
}

// text rate
$_text_rate = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 1,
));

// boxes settings
list($home_box_settings, $boxes_count) = get_posts(array(
	'table' => 'home_box_setting',
	'limit' => -1,
));
foreach($home_box_settings as $item){
	$_box_settings[$item['id_home_box_setting']] = $item;
}


// mobile settings
list($home_box_mobile, $boxes_count) = get_posts(array(
	'table' => 'home_box_mobile',
	'limit' => -1,
));

foreach($home_box_mobile as $item){
	$_box_mobile[$item['id_home_box_mobile']] = $item['show_mobile'];
}



foreach($_box_settings as $id => $box){
	if($box['active']){
		switch($id){
			case 1 : {
				include $_base_path.'backend/home/include/chartere.php';
				include $_base_path.'backend/home/include/experiente.php';
			} break;
			case 2 : include $_base_path.'backend/home/include/circuite.php'; break;
			case 3 : include $_base_path.'backend/home/include/turism_individual.php'; break;
			case 4 : include $_base_path.'backend/home/include/turism_intern.php'; break;
			case 5 : include $_base_path.'backend/home/include/box_offers.php'; break;
			case 6 : include $_base_path.'backend/home/include/box_offers.php'; break;
			case 7 : include $_base_path.'backend/home/include/box_offers.php'; break;
			case 8 : include $_base_path.'backend/home/include/box_offers.php'; break;
			case 9 : include $_base_path.'backend/home/include/box_offers.php'; break;
			case 10: include $_base_path.'backend/home/include/promo_boxes.php'; break;
			case 11: include $_base_path.'backend/home/include/turism_seniori.php'; break;
		}
	}
}

//@andrei: feed blog
include $_base_path.'backend/common/boxes/box_sfaturi.php';















$_section = "home";

// seo
$seo = get_seo('homepage');
$_meta_title = $seo['title'] ? $seo['title'] : 'Paralela 45';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
