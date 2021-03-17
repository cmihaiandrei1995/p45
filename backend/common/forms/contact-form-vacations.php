<?
if(isset($_POST['submit'])){

	// form validation
	$_valid = true;

	$_rules['firstname'] = 'trim';
	$_rules['lastname'] = 'trim';
	$_rules['phone'] = 'trim|numeric';
	if($_POST['phone'] != ''){
		$_rules['email'] = 'trim|email';
	}else{
		$_rules['email'] = 'trim|required|email';
	}
	$_rules['plecare'] = 'trim';
	$_rules['destinatie-tara'] = 'trim|required';
	$_rules['destinatie-oras'] = 'trim';
	$_rules['adulti'] = 'trim';
	$_rules['copii'] = 'trim';
	$_rules['varsta'] = 'trim';
	$_rules['buget'] = 'trim';
	$_rules['data-plecare'] = 'trim|required|date';
	$_rules['data-intoarcere'] = 'trim|date';
	$_rules['transport'] = 'trim';
	$_rules['masa'] = 'trim';
	$_rules['hotel'] = 'trim';
	$_rules['camera'] = 'trim';
	$_rules['newsletter'] = 'trim';
	$_rules['terms'] = 'trim|required';
	$_rules['gdpr'] = 'trim|required';
	$_rules['observations'] = 'trim';
	$_rules['page-location'] = 'trim';

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

	if($_valid){

		if($_form['newsletter']){
			nl_subscribe_user($_form['email'], $_form['lastname'], $_form['firstname'], 'Pagina vacante la comanda');
		}

		if($_form['data-intoarcere'] == ""){
			$_form['data-intoarcere'] = date('Y-m-d', strtotime($_form['data-plecare']." +7days"));
		}

		$full_msg_request = "
			Vacanta la comanda: ".$_form['page-location']."
			Nume: ".$_form['lastname']."
			Prenume: ".$_form['firstname']."
			Email: ".$_form['email']."
			Telefon: ".$_form['phone']."
			Plecare: ".$_form['plecare']."
			Tara destinatie: ".$_form['destinatie-tara']."
			Oras destinatie: ".$_form['destinatie-oras']."
			Adulti: ".$_form['adulti']."
			Copii: ".$_form['copii']."
			Varsta copii: ".$_form['varsta']."
			Buget de persoana: ".$_form['buget']."
			Data plecare: ".$_form['data-plecare']."
			Data intoarcere: ".$_form['data-intoarcere']."
			Transport: ".$_tm_transport[$_form['transport']]."
			Masa: ".$_tm_masa[$_form['masa']]."
			Hotel: ".($_form['hotel'] > 0 ? $_form['hotel']." ".($_form['hotel'] == 1 ? "stea" : "stele") : "")."
			Camera: ".$_tm_camere[$_form['camera']]."
			Observatii client: ".$_form['observations']."
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
		    'request_products' => 1,
		    'request_dep_date' => ($_form['data-plecare'] != "" ? date("Y-m-d", strtotime($_form['data-plecare'])) : ""),
		    'request_ret_date' => ($_form['data-intoarcere'] != "" ? date("Y-m-d", strtotime($_form['data-intoarcere'])) : ""),
		    'request_nights' => intval(($_form['data-plecare'] != "" && $_form['data-intoarcere'] != "" ? days_between_dates(date("Y-m-d", strtotime($_form['data-plecare'])), date("Y-m-d", strtotime($_form['data-intoarcere']))) : "")),
		    'request_adults' => intval($_form['adulti']),
		    'request_children' => intval($_form['copii']),
		    'request_children_ages' => $_form['varsta'],
		    'request_room_type' => -1,
		    'request_transport' => ($_form['transport'] != "" ? $_form['transport'] : "None"),
		    'request_meal' => ($_form['masa'] != "" ? $_form['masa'] : "None"),
		    'request_hotel_category' => intval($_form['hotel']),
		    'request_dest_country' => $_form['destinatie-tara'],
		    'request_dep_city'	=> $_form['plecare'],
		    'request_dest_city' => $_form['destinatie-oras'],
		    'request_date_flex_days' => 0,
		    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
		    'request_hotel_info' => '',
		    'request_room_info' => '',
		    'request_question_answers' => null
		);

		$response = send_request_to_tm($req_tm);

		$content['title'] = "Formular vacante la comanda - ".$_form['page-location'];
		$content['content'] = "
		<p>
			Vacanta: ".$_form['page-location']."<br>
			Nume: ".$_form['lastname']."<br>
			Prenume: ".$_form['firstname']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Plecare: ".$_form['plecare']."<br>
			Tara destinatie: ".$_form['destinatie-tara']."<br>
			Oras destinatie: ".$_form['destinatie-oras']."<br>
			Adulti: ".$_form['adulti']."<br>
			Copii: ".$_form['copii']."<br>
			Varsta copii: ".$_form['varsta']."<br>
			Buget de persoana: ".$_form['buget']."<br>
			Data plecare: ".$_form['data-plecare']."<br>
			Data intoarcere: ".$_form['data-intoarcere']."<br>
			Transport: ".$_tm_transport[$_form['transport']]."<br>
			Masa: ".$_tm_masa[$_form['masa']]."<br>
			Hotel: ".($_form['hotel'] > 0 ? $_form['hotel']." ".($_form['hotel'] == 1 ? "stea" : "stele") : "")."<br>
			Camera: ".$_tm_camere[$_form['camera']]."<br>
			Observatii client: ".$_form['observations']."<br>
		</p>
		";

		send_mail($_config['contact']['vacation_form'], "Formular vacante la comanda - ".$_form['page-location'], $content, 'default');

	}
}
