<?
$_ipp = $_config['paging']['ipp']['tickets'];

$options = array(
    'table' => 'ticket',
	'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
	//'order' => 'price ASC',
	'images' => true,
	//'debug' => true
);

$_tickets_title = "Oferte speciale";

if(isset($_params['country_to'])){
	$country = get_country_by_slug($_params['country_to']);
	if(!$country){
		go_away(route('tickets'));
	}

	$options['extra_where'] .= ' AND id_country_to = ' . $country['id_country'] . '';
}

if(isset($_params['city_to'])){
	$city = get_city_by_slug($_params['city_to']);
	if(!$city){
		go_away(route('tickets'));
	}
	$options['extra_where'] .= ' AND id_city_to = ' . $city['id_city'] . '';
}

if(isset($_params['city_from']) ){
	$city_from = get_city_by_slug($_params['city_from']);
	if(!$city_from){
		go_away(route('tickets'));
	}
	$options['extra_where'] .=  ' AND id_city_from = ' . $city_from['id_city'] . '';

	$_tickets_title = "Oferte ".$_params['city_from']." - ".$_params['city_to'];
}




list($_items, $_count) = get_posts($options);
$_nr_pages = ceil($_count/$_ipp);

foreach($_items as &$item){
	$city_from = get_city_by_id($item['id_city_from']);
	$city_to = get_city_by_id($item['id_city_to']);

	$company_image = get_company_image_by_id($item['id_ticket_company']);
	$company = get_company_by_id($item['id_ticket_company']);

	$dates = db_query('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC', $item['id_ticket']);
	if($dates){
		$date_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_from ASC LIMIT 1', $item['id_ticket']);
		$date_max = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY date_to DESC LIMIT 1', $item['id_ticket']);

		$price_min = db_row('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY price ASC LIMIT 1', $item['id_ticket']);
		$item['price'] = $price_min['price'];

		$date_from = date('d.m', strtotime($date_min['date_from']));
		$date_to = date('d.m.Y', strtotime($date_max['date_to']));

        if($date_max['date_to'] != ""){
            $item['period'] = $date_from." - ".$date_to;
        }else{
            $item['period'] = $date_from;
        }
	}else{
		$date_from = date('d.m', strtotime($item['date_from']));
		$date_to = date('d.m.Y', strtotime($item['date_to']));

        if($item['date_to'] != ""){
            $item['period'] = $date_from." - ".$date_to;
        }else{
            $item['period'] = $date_from;
        }
	}

	//$item['title'] = $city_from['title'] . ' - ' . $city_to['title'];
	$item['company_image'] = $_base . 'uploads/images/' .$company_image['folder'] . $company_image['image'];
	$item['company_title'] = $company['title'];

	unset($item);
}


if(isset($_POST['submit'])){
	$_valid = true;

	$_rules['oras_plecare'] = 'trim|required';
	$_rules['oras_intoarcere'] = 'trim|required';
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
			Oras plecare: ".$_form['oras_plecare']."
			Oras destinatie: ".$_form['oras_intoarcere']."
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
		    'request_dep_city'	=> $_form['oras_plecare'],
		    'request_dest_city' => $_form['oras_intoarcere'],
		    'request_date_flex_days' => 0,
		    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
		    'request_hotel_info' => '',
		    'request_room_info' => '',
		    'request_question_answers' => null
		);

		$response = send_request_to_tm($req_tm);

		$content['title'] = "Rezervare bilet ".$_form['oras_plecare']." - ".$_form['oras_intoarcere'];
		$content['content'] = "
		<p>
			Nume: ".$_form['lastname']."<br>
			Prenume: ".$_form['firstname']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Oras plecare: ".$_form['oras_plecare']."<br>
			Oras destinatie: ".$_form['oras_intoarcere']."<br>
			Data plecare: ".$_form['data_plecare']."<br>
			Data intoarcere: ".$_form['data_intoarcere']."<br>
			Adulti: ".$_form['adulti']."<br>
			Copii: ".$_form['copii']."<br>
			Infants: ".$_form['infants']."<br>
			Zboruri directe: ".$directe."<br>
		</p>
		";

		send_mail($_config['contact']['ticket_reservation'], "Rezervare bilet ".$_form['oras_plecare']." - ".$_form['oras_intoarcere'], $content, 'default');

	}
}


$_section = "planes";
$_active_tab = "tickets";

// seo
$seo = get_seo('bilete_avion');
$_meta_title = $seo['title'] ? $seo['title'] : 'Bilete de avion';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
