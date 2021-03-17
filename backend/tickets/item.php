<?

$_item = get_post(array(
	'table' => 'ticket',
	'id_ticket' => $_params['id_ticket'],
	'images' => true
));

/*
list($_items, $_count) = get_posts(array(
	'table' => 'ticket',
	'limit' => -1,
	'images' => true
));
foreach($_items as $item){
	if(generate_name($item['id_ticket']) == $_params['id_ticket']){
		$_item = $item;
		break;
	}
}
*/

if(!$_item){
	go_away(route('tickets'));
}


$city_f = get_city_by_id($_item['id_city_from']);
$city_from = $city_f['title'];

$city_t =  get_city_by_id($_item['id_city_to']);
$city_to = $city_t['title'];

$country_f = get_country_by_id($_item['id_country_from']);
$country_from = $country_f['title'];

$country_t = get_country_by_id($_item['id_country_to']);
$country_to = $country_t['title'];

$company_i = get_company_image_by_id($_item['id_ticket_company']);
$company_image = $_base . 'uploads/images/' .$company_i['folder'] . $company_i['image'];

$company_t = get_company_by_id($_item['id_ticket_company']);
$company_title = $company_t['title'];
setlocale(LC_ALL, 'ro_RO');

$dates = db_query('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC', $_item['id_ticket']);
if($dates){
	$date_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC LIMIT 1', $_item['id_ticket']);
	$date_max = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_to DESC LIMIT 1', $_item['id_ticket']);

	$price_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY price ASC LIMIT 1', $_item['id_ticket']);
	$_item['price'] = $price_min['price'];

	$date_from = date('d.m', strtotime($date_min['date_from']));
	$date_from2 = date('d.m.Y', strtotime($date_min['date_from']));

	$date_to = $date_max['date_to'] != "" ? date('d.m.Y', strtotime($date_max['date_to'])) : "";
	if($date_to  == ""){
		$date_from = date('d.m.Y', strtotime($date_min['date_from']));
	}

	$_item['period'] = $date_from." - ".$date_to;

	foreach($dates as $date){
		if(!in_array(date('d.m', strtotime($date['date_from'])), $date_departures)){
			$date_departures[] = date('d.m', strtotime($date['date_from']));
		}
		if(!in_array(date('d.m', strtotime($date['date_to'])), $date_returns)){
			if($date['date_to'] != ""){
				$date_returns[] = date('d.m', strtotime($date['date_to']));
			}
		}
	}
	$date_departure = implode(", ", $date_departures);
	if($date_returns){
		$date_return = implode(", ", $date_returns);
	}

	$_item['time_departure_from'] = $date_min['time_departure_from'];
	$_item['time_departure_to'] = $date_min['time_departure_to'];
	$_item['time_return_from'] = $date_min['time_return_from'];
	$_item['time_return_to'] = $date_min['time_return_to'];

	$_item['periods'] = $dates;
}else{
	$date_from = date('d.m', strtotime($_item['date_from']));
	$date_from2 = date('d.m.Y', strtotime($_item['date_from']));
	$day_from = substr(strftime('%a', strtotime($_item['date_from'])), 0, 2);

	$date_departure = $date_from2.", ".$day_from;

	$date_to = $date_max['date_to'] != "" ? date('d.m.Y', strtotime($_item['date_to'])) : "";
	$day_to = substr(strftime('%a', strtotime($_item['date_from'])), 0, 2);

	$date_return = $date_to.", ".$day_to;

	$_item['period'] = $date_from." - ".$date_to;
}






if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

	$_rules['data_plecare'] = 'trim|required';
	$_rules['data_intoarcere'] = 'trim|required';
	$_rules['adulti'] = 'trim|required';
	$_rules['copii'] = 'trim';
	$_rules['infants'] = 'trim';
	$_rules['zboruri_directe'] = 'trim';
	$_rules['firstname'] = 'trim|required';
	$_rules['lastname'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required';
	$_rules['newsletter'] = 'trim';
	//$_rules['contract_turist'] = 'trim|required';
	$_rules['terms'] = 'trim|required';

	$_rules['g-recaptcha-response'] = 'trim|required';
	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];

	$_form = new Validate($_rules, 'post');
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

	if($_valid){

		$directe = $_form['zboruri_directe'] == 1 ? "da" : "nu";
		$newsletter = $_form['newsletter'] == 1 ? "da" : "nu";

		if($_form['newsletter']){
			nl_subscribe_user($_form['email'], $_form['lastname'], $_form['firstname'], 'Pagina bilete avion');
		}

		$full_msg_request = "
			Cerere bilet avion
			Nume: ".$_form['lastname']."
			Prenume: ".$_form['firstname']."
			Email: ".$_form['email']."
			Telefon: ".$_form['phone']."
			Oras plecare: ".$city_from."
			Oras destinatie: ".$city_to."
			Data plecare: ".$_form['data_plecare']."
			Data intoarcere: ".$_form['data_intoarcere']."
			Adulti: ".$_form['adulti']."
			Copii: ".$_form['copii']."
			Infants: ".$_form['infants']."
			Zboruri directe: ".$directe."
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
		    'request_fname' => $_form['firstname'],
		    'request_lname' => $_form['lastname'],
		    'have_request' => 'false',
		    'last_update' => date(DATE_W3C),
		    'request_products' => 3,
		    'request_dep_date' => ($_form['data_plecare'] != "" ? date("Y-m-d", strtotime($_form['data_plecare'])) : ""),
		    'request_ret_date' => ($_form['data_intoarcere'] != "" ? date("Y-m-d", strtotime($_form['data_intoarcere'])) : ""),
		    'request_nights' => intval(($_form['data_plecare'] != "" && $_form['data_intoarcere'] != "" ? days_between_dates(date("Y-m-d", strtotime($_form['data_plecare'])), date("Y-m-d", strtotime($_form['data_intoarcere']))) : "")),
		    'request_adults' => intval($_form['adulti']),
		    'request_children' => intval($_form['copii']),
		    'request_children_ages' => '',
		    'request_room_type' => -1,
		    'request_transport' => 'Flight',
		    'request_meal' => 'None',
		    'request_hotel_category' => 0,
		    'request_dest_country' => '',
		    'request_dep_city'	=> $city_from,
		    'request_dest_city' => $city_to,
		    'request_date_flex_days' => 0,
		    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
		    'request_hotel_info' => '',
		    'request_room_info' => '',
		    'request_question_answers' => null
		);

		$response = send_request_to_tm($req_tm);

		$content['title'] = "Rezervare bilet ".$city_from." - ".$city_to;
		$content['content'] = "
		<p>
			Nume: ".$_form['lastname']."<br>
			Prenume: ".$_form['firstname']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Oras plecare: ".$city_from."<br>
			Oras destinatie: ".$city_to."<br>
			Data plecare: ".$_form['data_plecare']."<br>
			Data intoarcere: ".$_form['data_intoarcere']."<br>
			Adulti: ".$_form['adulti']."<br>
			Copii: ".$_form['copii']."<br>
			Infants: ".$_form['infants']."<br>
			Zboruri directe: ".$directe."<br>¨
		</p>
		";

		send_mail($_config['contact']['ticket_reservation'], "Rezervare bilet ".$city_from." - ".$city_to, $content, 'default');

	}
}

$_section = "planes";
$_active_tab = "tickets";

// seo
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : 'Bilet de avion ' . $city_from . ' - ' . $city_to ;
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
