<?

if(isset($_POST['contact-submit'])){

	// form validation
	$_valid = true;

	$_rules['firstname'] = 'trim';
	$_rules['lastname'] = 'trim';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|numeric';

	$_rules['newsletter'] = 'trim';
	$_rules['terms'] = 'trim|required';
	$_rules['gdpr'] = 'trim|required';
	$_rules['observations'] = 'trim';

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
			nl_subscribe_user($_form['email'], $_form['lastname'], $_form['firstname'], 'Pagina contact');
		}

		$req_tm = array(
		    'request_id' => 0,
		    'request_date' => date('Y-m-d'),
		    'request_client' => -1,
		    'request_expense_dep' => null,
		    'request_web_login' => null,
		    'request_user' => 1,
		    'request_owner' => 1,
		    'request_location' => 1,
		    'request_text' =>
				"Nume: ".$_form['lastname']." ".$_form['firstname']."\n".
				"Telefon: ".$_form['phone']."\n".
				"Email: ".$_form['email']."\n".
				"Tip formular: ".$_form['page-location']."\n".
				"Agentie: ".($_item['title'] != "" ? $_item['title'] : "Neselectat")."\n".
				"Detalii:\n".$_form['observations'],
		    'request_final_booking' => 0,
		    'request_notes' => null,
		    //'request_source' => 'OMV',
			'request_source' => array(
				'source_id' => 10,
				'source_name' => 'Lead',
				'source_active' => 'true'
			),
		    'request_source_phone' => $_form['phone'],
		    'request_source_email' => $_form['email'],
		    'request_closed' => false,
		    'request_closed_reason' => null,
		    'request_status' => 'NewWithoutReponse',
		    'request_fname' => $_form['lastname']." ".$_form['firstname'],
		    'request_lname' => '',
		    'have_request' => 'false',
		    'last_update' => date(DATE_W3C),
		    'request_products' => 1,
		    'request_dep_date' => date('Y-m-d'),
		    'request_ret_date' => date('Y-m-d'),
		    'request_nights' => '',
		    'request_adults' => 0,
		    'request_children' => 0,
		    'request_children_ages' => '',
		    'request_room_type' => -1,
		    'request_transport' => 'None',
		    'request_meal' => 'None',
		    'request_hotel_category' => 0,
		    'request_dest_country' => '',
		    'request_dep_city'	=> '',
		    'request_dest_city' => '',
		    'request_date_flex_days' => 0,
		    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
		    'request_hotel_info' => '',
		    'request_room_info' => '',
		    'request_question_answers' => null
		);

		$response_tm = send_request_to_tm($req_tm);

		$content['title'] = "Formular de contact pentru ".$_form['page-location'];
		$content['content'] = "
		<p>
			Agentia: ".($_item['title'] != "" ? $_item['title'] : "Neselectat")."<br>
			Nume: ".$_form['lastname']."<br>
			Prenume: ".$_form['firstname']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Observatii: ".$_form['observations']."<br>
		</p>
		";

		send_mail($_config['contact']['agency_form'], "Formular de contact pentru ".$_form['page-location'], $content, 'default');

	}
}
