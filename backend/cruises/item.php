<?php

$_item = get_cruise_by_id($_params['id']);
if(!$_item) go_away(route('cruises'), '301');

if($_params['slug'] != generate_name($_item['title'])){
	go_away(route('cruise', $_item['title'], $_item['id_cruise']), '301');
}

$_item = get_cruise_info($_item);

$_item['rooms'] = db_query('SELECT * FROM cruise_room WHERE id_cruise = ? ORDER BY price ASC', $_item['id_cruise']);

$_item['url-ports'] = route('cruise-ports', $_item['title'], $_item['id_cruise']);
$_item['url-ship'] = route('cruise-ship', $_item['title'], $_item['id_cruise']);
$_item['url-price'] = route('cruise-price', $_item['title'], $_item['id_cruise']);
$_item['url-opt'] = route('cruise-opt', $_item['title'], $_item['id_cruise']);
$_item['url-inc'] = route('cruise-inc', $_item['title'], $_item['id_cruise']);
$_item['url-canc'] = route('cruise-canc', $_item['title'], $_item['id_cruise']);

$_item['itinerary_list'] = db_query('SELECT * FROM cruise_itinerary WHERE id_cruise = ? ORDER BY `day` ASC, CHAR_LENGTH(from_hour) ASC, CHAR_LENGTH(till_hour) DESC, from_hour ASC, till_hour ASC', $_item['id_cruise']);
foreach($_item['itinerary_list'] as $it){
	if($it['id_cruise_port'] > 0){
		$_ports_opt[] = $it['id_cruise_port'];
	}
}




foreach($_item['itinerary_list'] as &$it){
if($it['id_cruise_port'] > 0){
	$port = get_cruise_port_by_id($it['id_cruise_port']);
	$it['title'] = $port['title'];
	$it['url'] = route('cruise-port', $_item['title'], $_item['id_cruise'], $it['title'], $it['id_cruise_port']);
}else{
	$it['title'] = __('Pe mare');
	}
	unset($it);
}
$_item['itinerary_img'] = $_base_uploads.'images/'.($_item['itinerary_path'] != "" ? $_item['itinerary_path'] : "itinerary/").$_item['itinerary'];

$_item['ship']['decks'] = get_cruise_deck_by_ship_id($_item['ship']);

foreach($_item['ship']['decks'] as &$dk){
	$dk['url'] = route('cruise-deck', $_item['title'], $_item['id_cruise'], $dk['title'], $dk['id_cruise_deck']);
	unset($dk);
}
$decks = $_item['ship']['decks'];

foreach($decks as &$deck){
	$deck['cabins'] = get_cruise_cabins_by_deck_id($deck['id_cruise_deck']);
	unset($deck);
}

$_item['ship']['video'] = get_video_embed($_item['ship']['embed'], 460, 320);




$disclaimer = get_post(array(
	'table' => 'page',
	'id_page' => 13
));


list($_item['optional'], $cnt) = get_posts(array(
	'table' => 'cruise_excursion',
	'limit' => -1,
	'extra_where' => 'AND id_cruise_excursion IN ( SELECT id_cruise_excursion FROM cruise_to_excursion WHERE id_cruise = '. $_item['id_cruise'] .' )',
	'order' => 'id_cruise_excursion DESC',
	//'debug' => true
));

if($_tab == 'inc'){
	if($_item['line']['included'] == strip_tags($_item['line']['included'], "<br><br/>")){
		$_item['line']['included'] = "<ul>".str_replace('** ', '<li>', str_replace('- ', '<li>', str_replace(array('<br>', '<br />', '<br/>'), '</li>', $_item['line']['included'])))."</ul>";
	}
	if($_item['line']['not_included'] == strip_tags($_item['line']['not_included'], "<br><br/>")){
		$_item['line']['not_included'] = "<ul>".str_replace('** ', '<li>', str_replace('- ', '<li>', str_replace(array('<br>', '<br />', '<br/>'), '</li>', $_item['line']['not_included'])))."</ul>";
	}
}

if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

	$_rules['name'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required';
	$_rules['message'] = 'trim|required';

	if($_item['dates']){
		$_rules['date'] = 'trim|required';
	}
	if($_item['rooms']){
		$_rules['room'] = 'trim|required';
	}
	$_rules['passengers'] = 'trim|required|numeric';
	$_rules['children'] = 'trim|numeric';

	$_rules['newsletter'] = 'trim';
	$_rules['terms'] = 'trim|required';
	$_rules['gdpr'] = 'trim|required';

	$_rules['g-recaptcha-response'] = 'trim|required';
	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];

	// custom messages
	$_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
		'gdpr' => array(
			'required' => "Trebuie sa fii de acord cu aceasta clauza!"
		)
	);

	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	if($_valid){
		$_captcha = google_recaptcha_check($_form['g-recaptcha-response']);
		if(!$_captcha){
			$_valid = false;
			$_errors['g-recaptcha-response'] = "Captcha invalid";
		}
	}

	// if form ok send notification email
	if($_valid){

		if($_form['newsletter']){
			nl_subscribe_user($_form['email'], $_form['name'], '', 'Pagina croaziera');
		}

		$full_msg_request = "
			Croaziera: ".$_item['title']."
			Link: ".$_item['url']."
			Nume: ".$_form['name']."
			Email: ".$_form['email']."
			Telefon: ".$_form['phone']."
			Adulti: ".$_form['passengers']."
			Copii: ".$_form['children']."
			Cabina: ".$_form['room']."
			Plecare: ".$_form['date']."
			Mesaj: ".nl2br($_form['message'])."
		";

		$req_tm = array(
		    'request_id' => 0,
		    'request_date' => date('Y-m-d'),
		    'request_client' => -1,
		    'request_expense_dep' => null,
		    'request_web_login' => null,
		    'request_user' => 1,
		    'request_owner' => 1,
		    'request_location' => 1,
		    'request_text' => $full_msg_request,
		    'request_final_booking' => 0,
		    'request_notes' => null,
		    //'request_source' => 'Web',
			'request_source' => array(
				'source_id' => 3,
				'source_name' => 'Website',
				'source_active' => 'true'
			),
		    'request_source_phone' => $_form['phone'],
		    'request_source_email' => $_form['email'],
		    'request_closed' => false,
		    'request_closed_reason' => null,
		    'request_status' => 'NewWithoutReponse',
		    'request_fname' => $_form['name'],
		    'request_lname' => '',
		    'have_request' => 'false',
		    'last_update' => date(DATE_W3C),
		    'request_products' => 1,
		    'request_dep_date' => date("Y-m-d", strtotime($_form['date'])),
		    'request_ret_date' => date("Y-m-d", strtotime($_form['date']." +".$_item['nights']."days")),
		    'request_nights' => intval($_item['nights']),
		    'request_adults' => intval($_form['passengers']),
		    'request_children' => intval($_form['children']),
		    'request_children_ages' => '',
		    'request_room_type' => -1,
		    'request_transport' => 'None',
		    'request_meal' => 'None',
		    'request_hotel_category' => 0,
		    'request_dest_country' => $_item['destination']['title'],
		    'request_dep_city'	=> 'Bucuresti',
		    'request_dest_city' => '',
		    'request_date_flex_days' => 0,
		    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
		    'request_hotel_info' => '',
		    'request_room_info' => '',
		    'request_question_answers' => null
		);

		$response = send_request_to_tm($req_tm);

		$content['title'] = "Rezervare croaziera";
		$content['content'] = "
		<p>
			Nume: ".$_form['name']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Adulti: ".$_form['passengers']."<br>
			Copii: ".$_form['children']."<br>
			Cabina: ".$_form['room']."<br>
			Plecare: ".$_form['date']."<br>
			Croaziera: ".$_item['title']."<br>
			Link: <a href='".$_item['url']."'>".$_item['url']."</a><br>
			Mesaj: ".nl2br($_form['message'])."<br><br>
		</p>
		";

		send_mail($_config['contact']['cruise_reservation'], "Rezervare croaziera", $content, 'default');

	}
}


$_breadcrumbs = array(
    __('Croaziere') => route('cruises'),
    $_item['title'] => ''
);

$_section = "cruises";
$_active_tab = "cruises";

// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
