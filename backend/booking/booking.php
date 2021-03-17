<?
if(isset($_POST['search_data']) || isset($_POST['book_now'])){
	$_POST['booking_type'] = $_params['type'];
	$_SESSION['booking'] = $_POST;
}

if($_params['type'] == "insurance"){
	$_session_booking['search_data'] = $_SESSION['insurance_booking'];
}else{
	$_session_booking = $_SESSION['booking'];
}

if($_params['type'] == "insurance"){
	$_insurance_offers = $_SESSION['insurance_offers'];
	if(!$_insurance_offers) go_away($_base);

	$_insurance_selected_items = $_SESSION['insurance_selected_items'];
	if(!$_insurance_selected_items) go_away($_base);

	$_insurance_offers = json_decode($_insurance_offers, true);
}

if(!$_params['type'] || !isset($_session_booking['search_data'])){
	go_away($_base);
}

$_search_data = json_decode($_session_booking['search_data'], true);

if($_params['type'] == "insurance"){
	// look for childern
	foreach($_search_data['insurants'] as $item){
		if(date('Y') - $item['dob_year'] < 18){
			$_has_child = true;
			$children_all++;
		}else{
			$adults_all++;
		}
	}
}else{
	// look for childern
	for($i=0; $i<$_search_data['rooms']; $i++){
		if($_search_data['rooms_info'][$i]['child'] > 0){
			$_has_child = true;
		}

		$adults_all += $_search_data['rooms_info'][$i]['adult'];
		$children_all += $_search_data['rooms_info'][$i]['child'];

		for($ch=0; $ch<$_search_data['rooms_info'][$i]['child']; $ch++){
			$childrens_ages[] = $_search_data['rooms_info'][$i]['child_age'][$ch];
		}
	}
	$childrens_ages_txt = implode(", ", $childrens_ages);
}

list($_payment_methods, $count) = get_posts(array(
	'table' => 'config_payment',
	'limit' => -1,
));
foreach($_payment_methods as $item){
	$_installments_to_procesator[$item['key']] = $item['type'];
}




switch($_params['type']){

	case 'insurance':{
		foreach($_search_data['insurants'] as $i => $insurant){
			$_item = $_insurance_offers[$i][$_insurance_selected_items[$i]];
			$_items_insurance[] = $_item;
			$_final_price += $_item['quote']['prima'];
		}

		//print_R($_search_data);
		//print_R($_items_insurance);
		//exit;

		$_final_currency = "RON";
		$_final_currency_symbol = "Lei";

		$_insurance_country = city_insurance_get_country_by_id($_search_data['destination']);

		$_check_in = $_search_data['start_date'];
		$_check_out = $_search_data['end_date'];

		$date1 = new DateTime($_search_data['start_date']);
		$date2 = new DateTime($_search_data['end_date']);
		$_nr_nights = $date2->diff($date1)->format("%a") + 1;
		$_nr_days = $_nr_nights + 1;

		// general things
		$_step = 3;
		$_step_type = "Asigurare";

		$_offer_title = "Asigurare medicala de calatorie";

		$_side_title = "Asigurare de calatorie";
		$_mail_title = "Asigurare de calatorie";

		$full_msg_request[] = "Rezervare asigurare de calatorie";
		$full_msg_request[] = "";
		$full_msg_request[] = "Check in: ".$_check_in;
		$full_msg_request[] = "Check out: ".$_check_out;
		$full_msg_request[] = "Tara: ".$_insurance_country['title'];

		$_show_storno_insurance = false;

	}break;

	case 'circuit':{

		$_id_circuit = $_session_booking['id_circuit'];
		$_id_circuit_date_price = $_session_booking['id_circuit_date_price'];

		$_search_id = $_session_booking['search_id'];
		$_circuit_id = $_session_booking['circuit_id'];
		$_unique_id = $_session_booking['unique_id'];
		$_tour_op = $_session_booking['tour_op'];

		$_rooms_solution = json_decode($_session_booking['rooms_solution'], true);
		$_room_info = $_session_booking['room_info'];
		$_departure_charter = $_session_booking['departure_charter'];
		$_final_price = $_session_booking['final_price'];
		$_old_price = $_session_booking['old_price'];
		$_availability = $_session_booking['availability'];
		$_final_currency = "EUR";
		$_final_currency_symbol = "&euro;";

		$date = db_row('SELECT * FROM circuit_date_price WHERE id_circuit_date_price = ?', intval($_session_booking['id_circuit_date_price']));
		$_check_in = $date['dep_date'];
		$_check_out = $date['ret_date_arr'];

		$date1 = new DateTime($date['dep_date']);
		$date2 = new DateTime($date['ret_date_arr']);
		$_nr_days = $date2->diff($date1)->format("%a") + 1;

		$date1 = new DateTime($date['dep_date_arr']);
		$date2 = new DateTime($date['ret_date']);
		$_nr_nights = $date2->diff($date1)->format("%a");

		$tmp_hash =
			$_search_id.'-'.
			$_tour_op.'-'.
			$_circuit_id.'-'.
			$_unique_id.'-'.
			$_final_price;
		$hash = md5($tmp_hash);

		if($hash != $_session_booking['hash']){
			go_away(route('home'));
		}

		// get installments
		$fees = eurositeCircuitPaymentInstallments($_id_circuit, $_unique_id, $_departure_charter, $_tour_op, $_search_data, $_rooms_solution);

		$installments = array();
		if($fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee']['attr']['Type']){
			$installments[] = $fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee'];
		}else{
			$installments = $fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee'];
		}

		foreach($installments as $item){
			if($item['attr']['Type'] == "cancellation" && $item['ToDate']['value'] != ""){
				$_installments[] = array(
					'percent' => $item['Value']['value'],
					'max_date' => $item['ToDate']['value'],
				);
			}
		}

		/*
		// get extra services
		$services = eurositeCircuitSearchServiceRequest($_id_circuit, $_departure_charter);

		$extras = array();
		if($services['Services']['Service']['Type']['value']){
			$extras[] = $services['Services']['Service'];
		}else{
			$extras = $services['Services']['Service'];
		}

		foreach($extras as $extra){
			if($extra['HasPrice']['value'] == "true"){
				$price_info = eurositeCircuitSearchServicePriceRequest($_id_circuit, $_departure_charter, $extra['Type']['value'], $extra['Code']['value'], 'adult');

				if($price_info['Services']['Service']['Gross']['value'] > 0){
					$_extra_services[] = array(
						'title' => $extra['Name']['value'],
						'code' => $price_info['Services']['Service']['Code']['value'],
						'price' => $price_info['Services']['Service']['Gross']['value'],
						'type' => 'adult'
					);

					if($_has_child){
						$price_info = eurositeCircuitSearchServicePriceRequest($_id_circuit, $_departure_charter, $extra['Type']['value'], $extra['Code']['value'], 'child');

						$_extra_services[] = array(
							'title' => $extra['Name']['value'],
							'code' => $price_info['Services']['Service']['Code']['value'],
							'price' => $price_info['Services']['Service']['Gross']['value'],
							'type' => 'child'
						);
					}
				}
			}
		}
		*/

		// general things
		$_step = 3;
		$_step_type = "Circuit";

		$_item = get_circuit_by_id($_id_circuit);
		$_item = circuit_prepare_info($_item);

		$_offer_title = $_item['title'];

		$_side_title = "Pachet circuit";
		$_mail_title = "Circuit";

		$full_msg_request[] = "Rezervare circuit - ".$_item['title'];
		$full_msg_request[] = "";
		$full_msg_request[] = "Id circuit: ".$_id_circuit;
		$full_msg_request[] = "Check in: ".$_check_in;
		$full_msg_request[] = "Check out: ".$_check_out;
		$full_msg_request[] = "Camere: ".$_room_info;
		$full_msg_request[] = "Disponibilitate Eurosite: ".$_session_booking['availability'];

		$_show_storno_insurance = false;
		// if(days_between_dates(date("Y-m-d", strtotime($_check_in)), date("Y-m-d")) > 30){
		// 	$_show_storno_insurance = true;
		// }

	}break;

	case 'charter':
	case 'tourism':{

		$_id_hotel = $_session_booking['id_hotel'];
		$_id_city_from = $_session_booking['id_city_from'];

		$_package_id = $_session_booking['package_id'];
		$_variant_id = $_session_booking['variant_id'];
		$_tour_op = $_session_booking['tour_op'];
		$_country_code = $_session_booking['country_code'];
		$_city_code = $_session_booking['city_code'];
		$_hotel_code = $_session_booking['hotel_code'];

		$_rooms_solution = json_decode($_session_booking['rooms_solution'], true);
		$_room_info = $_session_booking['room_info'];
		$_meal_info = $_session_booking['meal_info'];

		if($_params['type'] == "charter"){
			$_services_info = json_decode($_session_booking['services_info'], true);
			$_flight_info = json_decode($_session_booking['flight_info'], true);
		}

		$_check_in = $_session_booking['check_in'];
		$_check_out = $_session_booking['check_out'];
		$_final_price = $_session_booking['final_price'];
		$_old_price = $_session_booking['old_price'];
		$_availability = $_session_booking['availability'];
		$_final_currency = "EUR";
		$_final_currency_symbol = $_currency_symbol[$_final_currency];

		$date1 = new DateTime($_check_in);
		$date2 = new DateTime($_check_out);
		$_nr_nights = $date2->diff($date1)->format("%a");
		$_nr_days = $_nr_nights + 1;

		if($_country_code == "RO"){
			$_show_payment_voucher = true;
			$_final_currency = "RON";
			$_final_currency_symbol = " ".$_currency_symbol[$_final_currency];
		}

		$tmp_hash =
			$_country_code.'-'.
			$_city_code.'-'.
			$_hotel_code.'-'.
			$_package_id.'-'.
			$_variant_id.'-'.
			$_check_in.'-'.
			$_check_out.'-'.
			$_final_price.'-'.
			$_old_price;
		$hash = md5($tmp_hash);

		if($hash != $_session_booking['hash']){
			go_away(route('home'));
		}

		// get installments
		$fees = eurositeHotelPaymentInstallments($_hotel_code, $_check_in, $_check_out, $_country_code, $_city_code, $_tour_op, $_variant_id, $_search_data, $_rooms_solution, $_final_currency);

		$installments = array();
		if($fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee']['attr']['Type']){
			$installments[] = $fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee'];
		}else{
			$installments = $fees['ItemPaymentDLS']['ItemPaymentDL']['Fees']['Fee'];
		}

		foreach($installments as $item){
			//if($item['attr']['Type'] == "cancellation" && $item['ToDate']['value'] != ""){
			if($item['ToDate']['value'] != ""){
				$_installments[] = array(
					'percent' => $item['Value']['value'],
					'max_date' => $item['ToDate']['value'],
				);
			}
		}

		// get cancelation fees
		$cancelation_fees = eurositeGetHotelCancelationFeesRequest($_hotel_code, $_check_in, $_check_out, $_country_code, $_city_code, $_tour_op, $_variant_id, $_search_data, $_rooms_solution, $_final_currency);

		$cancelations = array();
		if($cancelation_fees['ItemFees']['ItemFee']['Fees']['Fee']['attr']['Type']){
			$cancelations[] = $cancelation_fees['ItemFees']['ItemFee']['Fees']['Fee'];
		}else{
			$cancelations = $cancelation_fees['ItemFees']['ItemFee']['Fees']['Fee'];
		}

		foreach($cancelations as $item){
			if($item['attr']['Type'] == "cancellation" && $item['ToDate']['value'] != ""){
				if(strtotime(date('Y-m-d')) > strtotime($item['FromDate']['value'])) $item['FromDate']['value'] = date('Y-m-d');
				if(!$item['Gross']['value']){
					if($item['Value']['attr']['Procent'] == "true"){
						$item['Gross']['value'] = round($_final_price * $item['Value']['value'] / 100);
					}else{
						$item['Gross']['value'] = $item['Value']['value'];
					}
				}
				$_cancelations[] = array(
					'percent' => $item['Value']['value'],
					'gross' => $item['Gross']['value'],
					'from_date' => $item['FromDate']['value'],
					'to_date' => $item['ToDate']['value'],
				);
			}
		}

		/*
		// get extra services
		$services = eurositeHotelSearchServiceRequest($_hotel_code, $_check_in, $_check_out, $_country_code, $_city_code, $_tour_op, $_variant_id);

		$extras = array();
		if($services['Services']['Service']['Type']['value']){
			$extras[] = $services['Services']['Service'];
		}else{
			$extras = $services['Services']['Service'];
		}

		foreach($extras as $extra){
			if($extra['HasPrice']['value'] == "true"){
				$price_info = eurositeHotelSearchServicePriceRequest($_hotel_code, $_check_in, $_check_out, $_country_code, $_city_code, $_tour_op, $_variant_id, $extra['Type']['value'], $extra['Code']['value'], 'adult', $_final_currency);

				if($price_info['Services']['Service']['Gross']['value'] > 0){
					$_extra_services[] = array(
						'title' => $extra['Name']['value'],
						'code' => $price_info['Services']['Service']['Code']['value'],
						'price' => $price_info['Services']['Service']['Gross']['value'],
						'type' => 'adult'
					);

					if($_has_child){
						$price_info = eurositeHotelSearchServicePriceRequest($_hotel_code, $_check_in, $_check_out, $_country_code, $_city_code, $_tour_op, $_variant_id, $extra['Type']['value'], $extra['Code']['value'], 'child', $_final_currency);

						$_extra_services[] = array(
							'title' => $extra['Name']['value'],
							'code' => $price_info['Services']['Service']['Code']['value'],
							'price' => $price_info['Services']['Service']['Gross']['value'],
							'type' => 'child'
						);
					}
				}
			}
		}
		*/

		// general things
		$_step = 3;
		$_step_type = "Hotel";

		$_item = get_hotel_by_id($_id_hotel);
		$_item['images'] = get_images('hotel', $_item['id_hotel']);

		$_country = get_country_by_id($_item['id_country']);
		$_city = get_city_by_id($_item['id_city']);

		if($_params['type'] == "charter"){

			if($_city['id_zone'] > 0 && !$_zone){
				$_is_zone = true;

				$_zone = get_zone_by_id($_city['id_zone']);
				$_offer_type = ucfirst($_zone['charter_type']);
				if($_offer_type == ""){
					$_offer_type = "Charter";
				}
				$_offer_title = $_offer_type." ".$_zone['title'];
			}else{
				$_is_city = true;

				$_offer_type = ucfirst($_city['charter_type']);
				if($_offer_type == ""){
					$_offer_type = "Charter";
				}
				$_offer_title = $_offer_type." ".$_city['title'];
			}

			$_city_from = get_city_by_id($_id_city_from);

			$_item = hotel_prepare_charter_info($_item, ($_is_zone ? $_zone : $_city), $_city_from);

			$full_msg_request[] = "Rezervare charter ".$_city_from['title']." - ".$_city['title']." (".$_zone['title'].") - ".$_item['title'];

			$_flight_info_departure = db_row('SELECT * FROM charter_flights WHERE id_city = '.$_item['id_city'].' AND id_city_from = '.$_city_from['id_city'].' AND departure_time LIKE "'.$_check_in.'%"');
			$_flight_info_return = db_row('SELECT * FROM charter_flights WHERE id_city = '.$_item['id_city'].' AND id_city_from = '.$_city_from['id_city'].' AND departure_time LIKE "'.$_check_out.'%"');

			$_side_title = "Pachet charter";
			$_mail_title = "Charter";

		}elseif($_params['type'] == "tourism"){

			$_item = hotel_prepare_info($_item);

			if($_city['id_zone'] > 0 && !$_zone){
				$_is_zone = true;

				$_zone = get_zone_by_id($_city['id_zone']);
				$_offer_title = "Sejur ".$_zone['title'];

				$full_msg_request[] = "Zona: ".$_zone['title'];
				$full_msg_request[] = "Oras: ".$_city['title'];
				$full_msg_request[] = "Hotel: ".$_item['title'];
			}else{
				$_is_city = true;

				$_offer_type = ucfirst($_city['charter_type']);
				if($_offer_type == ""){
					$_offer_type = "Charter";
				}
				$_offer_title = "Sejur ".$_city['title'];

				$full_msg_request[] = "Oras: ".$_city['title'];
				$full_msg_request[] = "Hotel: ".$_item['title'];
			}

			$_side_title = "Pachet sejur";
			$_mail_title = "Hotel - Turism individual";

		}

		$full_msg_request[] = "";
		$full_msg_request[] = "Id hotel: ".$_item['id_hotel'];
		$full_msg_request[] = "Cod hotel: ".$_item['code'];
		$full_msg_request[] = "Cod touroperator: ".$_item['tourop_code'];
		$full_msg_request[] = "Check in: ".$_check_in;
		$full_msg_request[] = "Check out: ".$_check_out;
		$full_msg_request[] = "Camere: ".$_room_info;
		$full_msg_request[] = "Masa: ".$_meal_info;
		$full_msg_request[] = "Disponibilitate Eurosite: ".$_session_booking['availability'];

		$_show_storno_insurance = false;
		// if($_params['type'] == "charter" && days_between_dates(date("Y-m-d", strtotime($_check_in)), date("Y-m-d")) > 30){
		// 	$_show_storno_insurance = true;
		// }
		// if($_params['type'] == "charter" && ($_country['id_country'] == 53 || $_country['id_country'] == 40) && days_between_dates(date("Y-m-d", strtotime($_check_in)), date("Y-m-d")) > 30){
		// 	$_show_storno_insurance = true;
		// }

	}break;

}


// Commented out
// $_show_storno_insurance = false;

$full_msg_request[] = "Turisti: ".$adults_all." adulti".($children_all > 0 ? " si ".$children_all." ".($children_all > 1 ? "copii" : "copil")." ".$childrens_ages_txt." ani" : "");

//print_r($_extra_services);
//exit;


foreach($_installments as $item){
	$sum_installments += $item['percent'];
}

if(!$_installments || $sum_installments != 100){
	$_installments = array();

	$installments_db = db_query('SELECT * FROM config_installment ORDER BY id_config_installment ASC');
	foreach($installments_db as $item){

		$time = strtotime($_check_in." -".$item['days_before']." days");
		if($time < time()){
			$date = date('Y-m-d');
		}else{
			$date = date('Y-m-d', $time);
		}

		$_installments[] = array(
			'percent' => $item['percent'],
			'max_date' => $date,
		);
	}
}

foreach($_installments as $item){
	$new_installments[$item['max_date']] += $item['percent'];
}
$_installments = $new_installments;

$currency = db_row('SELECT * FROM currency ORDER BY `date` DESC LIMIT 1');
$_currency = $currency['value'];

$_advance_percent = $_installments[array_keys($_installments)[0]];
$_advance_price = ceil($_final_price * $_advance_percent / 100);
$_advance_price_ron = number_format($_advance_price * $_currency, 2, '.', '');

if($_country_code == "RO"){
	$_final_price_ron = $_final_price;
	$_old_price_ron = $_old_price;
	$_advance_price_ron = $_advance_price;
}else{
	$_old_price_ron = number_format($_old_price * $_currency, 2, '.', '');
	$_final_price_ron = number_format($_final_price * $_currency, 2, '.', '');
}



//echo "<pre>";
//print_r($_extra_services);
//echo "</pre>";

if(is_logged_in() && !isset($_POST['book_now'])){

	$_form['email'] = $_loggedin_user['email'];
	$_form['phone'] = $_loggedin_user['phone'];
	$_form['invoice_type'] = $_loggedin_user['invoice'];
	/*
	if($_loggedin_user['invoice'] == "pf"){
		$_form['invoice_cnp'] = $_loggedin_user['cnp'];
	}
	*/
	if($_loggedin_user['invoice'] == "pj"){
		$_form['invoice_company'] = $_loggedin_user['company'];
		$_form['invoice_cui'] = $_loggedin_user['cui'];
		$_form['invoice_nr_reg'] = $_loggedin_user['nr_reg'];
	}
	$_form['invoice_name'] = $_loggedin_user['name'];
	$_form['invoice_surname'] = $_loggedin_user['surname'];
	$_form['invoice_address'] = $_loggedin_user['address'];
	$_form['invoice_city'] = $_loggedin_user['city'];
	$_form['invoice_country'] = $_loggedin_user['country'];
	$_form['invoice_county'] = $_loggedin_user['county'];

}


if(isset($_POST['book_now'])){


	// if(debug_mode()){
	// 	print_r($_POST);
	// 	exit;
	// }

	$_valid = true;

	if($_params['type'] != "insurance"){
		// passengers
		for($i=0; $i<$_search_data['rooms']; $i++){
			foreach(array('adult', 'child') as $type){
				if($_search_data['rooms_info'][$i][$type] > 0) {
					for($j=0; $j<$_search_data['rooms_info'][$i][$type]; $j++){

						$_rules[$type.'_name_'.$i.'_'.$j] = 'trim|required|letters';
						$_rules[$type.'_surname_'.$i.'_'.$j] = 'trim|required|letters';
						$_rules[$type.'_gender_'.$i.'_'.$j] = 'trim|required|letters';
						//$_rules[$type.'_dob_'.$i.'_'.$j] = 'trim|required|date';

						$_rules[$type.'_dob_'.$i.'_'.$j.'_dob_day'] = 'trim|required';
						$_rules[$type.'_dob_'.$i.'_'.$j.'_dob_month'] = 'trim|required';
						$_rules[$type.'_dob_'.$i.'_'.$j.'_dob_year'] = 'trim|required';

						if($_POST[$type.'_dob_'.$i.'_'.$j.'_dob_day'] != "" && $_POST[$type.'_dob_'.$i.'_'.$j.'_dob_month'] != "" && $_POST[$type.'_dob_'.$i.'_'.$j.'_dob_year'] !=""){
							$_POST[$type.'_dob_'.$i.'_'.$j] = $_POST[$type.'_dob_'.$i.'_'.$j.'_dob_year'].'-'.$_POST[$type.'_dob_'.$i.'_'.$j.'_dob_month'].'-'.$_POST[$type.'_dob_'.$i.'_'.$j.'_dob_day'];
							$_rules[$type.'_dob_'.$i.'_'.$j] = 'trim|required|date';
						}

					}
				}
			}
		}
	}

	// payment
	$_rules['pay_amount'] = 'trim|required';
	$_rules['payment'] = 'trim|required';
	$_rules['pay_currency'] = 'trim|required';

	// invoice
	$_rules['invoice_type'] = 'trim|required';

	/*
	if($_POST['invoice_type'] == "pf"){
		$_rules['invoice_cnp'] = 'trim|required|cnp';
	}
	*/
	if($_POST['invoice_type'] == "pj"){
		$_rules['invoice_company'] = 'trim|required';
		$_rules['invoice_cui'] = 'trim|uppercase|required';
		$_rules['invoice_nr_reg'] = 'trim|uppercase|required';
	}

	$_rules['invoice_name'] = 'trim|required';
	$_rules['invoice_surname'] = 'trim|required';

	$_rules['invoice_address'] = 'trim|required';
	$_rules['invoice_city'] = 'trim|required';
	$_rules['invoice_country'] = 'trim|required';
	$_rules['invoice_county'] = 'trim|required';

	// voucher
	$_rules['have_voucher'] = 'trim';
	$_rules['voucher'] = 'trim';

	// other data
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-13';

	$_rules['obs'] = 'trim';

	$_rules['account'] = 'trim';
	$_rules['save_to_account'] = 'trim';

	if($_show_storno_insurance){
		$_rules['storno_insurance'] = 'trim';
	}

	$_rules['terms'] = 'trim|required';
	//$_rules['contract'] = 'trim|required';
	//$_rules['gdpr'] = 'trim|required';

	$_rules['newsletter'] = 'trim';

	/*
	if($_POST['payment'] == "cash"){
		$_rules['agency_city'] = 'trim|required';
		$_rules['id_agency'] = 'trim|required';
		$_rules['agent'] = 'trim';
	}
	if($_POST['payment'] == "voucher"){
		$_rules['agency_city'] = 'trim|required';
		$_rules['id_agency'] = 'trim|required';
		$_rules['agent'] = 'trim';
	}
	*/

	$_rules['agency_city'] = 'trim|required';
	$_rules['id_agency'] = 'trim|required';
	$_rules['agent'] = 'trim';

	if($_POST['payment'] == "rate"){
		$_rules['payment_bank'] = 'trim|required';
	}

	// custom messages
	$_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
		/*
		'contract' => array(
			'required' => "Trebuie sa fii de acord cu contractul!"
		),
		'gdpr' => array(
			'required' => "Trebuie sa fii de acord cu aceasta clauza!"
		),
		'invoice_cnp' => array(
			'cnp' => "CNP invalid!"
		)
		*/
	);

	// validate
	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	//print_r($_form);

	// if(debug_mode()){
	// 	print_r($_errors);
	// 	print_r($_form);
	// 	print_r($_POST);
	// 	exit;
	// }

	// all set, go!
	if($_valid){

		if($_form['newsletter']){
			nl_subscribe_user($_form['email'], $_form['invoice_name'], $_form['invoice_surname'], 'Rezervare');
		}

		if(is_logged_in()){
			$_user_id = get_logged_in_user()['id_user'];
			$_user = get_user_by_id($_user_id);
		}else{
			$_user = get_user_by_email($_form['email']);
			$_user_id = $_user['id_user'];
		}

		if(!$_user){
			$_user_id = insert_user($_form);
			$_user = get_user_by_id($_user_id);

			if($_form['account']){
				$_send_welcome = true;
			}
		}else{
			if(is_logged_in()){
				if($_form['save_to_account']){
					update_user_by_id($_form, $_user_id);
				}
			}else{
				update_user_by_id($_form, $_user_id);
				if($_form['account']){
					$_send_welcome = true;
				}
			}
		}

		if($_send_welcome){
			login_user($_user);

			if(!$_user['active']){
				$rand_pass = activation_code(8);
				db_query('UPDATE user SET password = ? WHERE id_user = ?', md5($rand_pass), $_user_id);

				$link = route('confirm-account', md5($_user_id));
				$content['title'] = "Iti multumim pentru inregistrarea pe site-ul Paralela45";
				$content['content'] = "
					<p>
						Pentru a putea sa te loghezi te rugam sa iti confimi adresa de email facand click pe link-ul de mai jos.<br><br>
						Parola contului tau este: <b>".$rand_pass."</b> - O vei putea schimba dupa ce iti confirmi contul.<br><br>
						<a href='".$link."' style='color:#2f4ea1; text-decoration:none; font-weight:bold;'>".$link."</a>
					</p>
				";
				send_paralela_mail($_form['email'], "Confirmare inregistrare cont - Paralela45", $content, 'default');
			}
		}

		$_card_currency = $_form['pay_currency'];

		if($_params['type'] == "insurance"){
			$_final_price_ron = $_final_price;
			$_advance_price_ron = $_final_price;
			$_final_price = number_format($_final_price / $_currency, 2, '.', '');
			$_advance_price = $_final_price;
		}

		if($_form['pay_amount'] == "full"){
			if($_card_currency == "eur"){
				$_card_price = $_final_price;
			}else{
				$_card_price = $_final_price_ron;
			}
		}else{
			if($_card_currency == "eur"){
				$_card_price = $_advance_price;
			}else{
				$_card_price = $_advance_price_ron;
			}
		}

		if($_params['type'] == "insurance"){
			$_selected_data['country'] = $_insurance_country['title'];
			$_selected_data['insurance_items'] = $_items_insurance;
		}

		if($_params['type'] == "circuit"){
			$_selected_data['id_circuit'] = $_id_circuit;
			$_selected_data['id_circuit_date_price'] = $_id_circuit_date_price;
			$_selected_data['search_id'] = $_search_id;
			$_selected_data['tour_op'] = $_tour_op;
			$_selected_data['circuit_id'] = $_circuit_id;
			$_selected_data['unique_id'] = $_unique_id;
			$_selected_data['departure_charter'] = $_departure_charter;
		}

		if($_params['type'] == "charter"){
			$_selected_data['id_hotel'] = $_id_hotel;
			$_selected_data['id_city_from'] = $_id_city_from;
			$_selected_data['tour_op'] = $_tour_op;
			$_selected_data['country_code'] = $_country_code;
			$_selected_data['city_code'] = $_city_code;
			$_selected_data['hotel_code'] = $_hotel_code;
			$_selected_data['variant_id'] = $_variant_id;
			$_selected_data['package_id'] = $_package_id;
			$_selected_data['services_info'] = htmlentities(json_encode($_services_info));
			$_selected_data['flight_info'] = htmlentities(json_encode($_flight_info));
		}

		if($_params['type'] == "tourism"){
			$_selected_data['id_hotel'] = $_id_hotel;
			$_selected_data['tour_op'] = $_tour_op;
			$_selected_data['country_code'] = $_country_code;
			$_selected_data['city_code'] = $_city_code;
			$_selected_data['hotel_code'] = $_hotel_code;
			$_selected_data['variant_id'] = $_variant_id;
		}

		if($_params['type'] != "insurance"){
			$_selected_data['rooms_solution'] = htmlentities(json_encode($_rooms_solution));
			$_selected_data['room_info'] = $_room_info;
			$_selected_data['meal_info'] = $_meal_info;
		}

		$_selected_data['check_in'] = $_check_in;
		$_selected_data['check_out'] = $_check_out;

		$_discount_price = 0;
		if($_form['have_voucher'] == 1 && $_form['voucher'] != ""){
			$_discount_price_item = validate_voucher($_form['voucher'], $_session_booking);
			$_discount_price = $_discount_price_item['value'];
			if($_discount_price){
				$_discount_price_ron = number_format($_discount_price * $_currency, 2, '.', '');
				if($_form['pay_amount'] != "full"){
					$_discount_advance_price = ceil($_discount_price * $_advance_percent / 100);
					$_discount_advance_price_ron = number_format($_discount_advance_price * $_currency, 2, '.', '');
				}else{
					$_discount_advance_price = $_discount_price;
					$_discount_advance_price_ron = $_discount_price_ron;
				}
			}else{
				$_form['voucher'] = "";
			}
		}

		// insert booking
		$_id_booking = db_query('INSERT INTO booking SET
			created = NOW(),
			id_user = ?,
			session_id = ?,
			ip = ?,
			title = ?,
			phone = ?,
			email = ?,
			invoice = ?,
			name = ?,
			surname = ?,
			company = ?,
			cui = ?,
			nr_reg = ?,
			address = ?,
			city = ?,
			country = ?,
			county = ?,
			type = ?,
			storno_insurance = ?,
			total = ?,
			total_ron = ?,
			discount = ?,
			discount_ron = ?,
			voucher = ?,
			advance_total = ?,
			advance_total_ron = ?,
			discount_advance = ?,
			discount_advance_ron = ?,
			old_total = ?,
			old_total_ron = ?,
			currency = "EUR",
			currency_to_ron = ?,
			payment = ?,
			payment_bank = ?,
			pay_amount = ?,
			installments = ?,
			pay_currency = ?,
			id_agency = ?,
			agent = ?,
			status = ?,
			obs = ?,
			search_data = ?,
			selected_data = ?
		',
			$_user_id,
			session_id(),
			$_SERVER['REMOTE_ADDR'],
			($_form['invoice_type'] ? $_form['invoice_name']." ".$_form['invoice_surname'] : $_form['invoice_company']),
			$_form['phone'],
			$_form['email'],
			$_form['invoice_type'],
			$_form['invoice_name'],
			$_form['invoice_surname'],
			$_form['invoice_company'],
			$_form['invoice_cui'],
			$_form['invoice_nr_reg'],
			$_form['invoice_address'],
			$_form['invoice_city'],
			$_form['invoice_country'],
			$_form['invoice_county'],
			$_params['type'],
			$_show_storno_insurance ? 1 : 0,
			$_final_price,
			$_final_price_ron,
			$_discount_price,
			$_discount_price_ron,
			$_form['voucher'],
			$_advance_price,
			$_advance_price_ron,
			$_discount_advance_price,
			$_discount_advance_price_ron,
			$_old_price,
			$_old_price_ron,
			$_currency,
			$_form['payment'],
			$_form['payment_bank'],
			$_form['pay_amount'],
			1,//$_POST['installments_'.$_form['payment']],
			$_form['pay_currency'],
			$_form['id_agency'],
			$_form['agent'],
			'new',
			$_form['obs'],
			json_encode($_search_data),
			json_encode($_selected_data)
		);

		// check for voucher
		if($_form['voucher'] && $_discount_price > 0){
			$voucher_from_db = get_post(array(
		        'table' => 'voucher',
		        'code' => $_form['voucher'],
		    ));

			if($voucher_from_db){
				db_query('UPDATE voucher SET max_usage = max_usage - 1, used = used + 1 WHERE id_voucher = ?', $voucher_from_db['id_voucher']);
				if($voucher_from_db['max_usage'] < 2){
					db_query('UPDATE voucher SET active = 0 WHERE id_voucher = ?', $voucher_from_db['id_voucher']);
				}
			}
		}

		$full_msg_request[] = "";
		$full_msg_request[] = "ID booking site: ".$_id_booking;
		$full_msg_request[] = "Nume complet: ".($_form['invoice_type'] ? $_form['invoice_name']." ".$_form['invoice_surname'] : $_form['invoice_company']);
		$full_msg_request[] = "Telefon: ".$_form['phone'];
		$full_msg_request[] = "Email: ".$_form['email'];
		$full_msg_request[] = "Factura: ".$_form['invoice_type'];
		$full_msg_request[] = "Nume: ".$_form['invoice_name'];
		$full_msg_request[] = "Prenume: ".$_form['invoice_surname'];
		if($_form['invoice_type'] == "pj"){
			$full_msg_request[] = "Companie: ".$_form['invoice_company'];
			$full_msg_request[] = "CUI: ".$_form['invoice_cui'];
			$full_msg_request[] = "Nr reg com: ".$_form['invoice_nr_reg'];
		}else{
			//$full_msg_request[] = "CNP: ".$_form['invoice_cnp'];
		}
		$full_msg_request[] = "Adresa: ".$_form['invoice_address'];
		$full_msg_request[] = "Oras: ".$_form['invoice_city'];
		$full_msg_request[] = "Judet: ".$_form['invoice_county'];
		$full_msg_request[] = "Tara: ".$_form['invoice_country'];

		$full_msg_request[] = "";

		if($_show_storno_insurance){
			$full_msg_request[] = "Asigurare STORNO GRATUIT";
			$full_msg_request[] = "";
		}

		if($_old_price > 0){
			if($_country['id_country'] != 126){
				$full_msg_request[] = "Pret vechi Eur: ".$_old_price;
			}
			$full_msg_request[] = "Pret vechi Ron: ".$_old_price_ron;
		}
		if($_country['id_country'] != 126){
			$full_msg_request[] = "Pret final Eur: ".$_final_price;
		}
		$full_msg_request[] = "Pret final Ron: ".$_final_price_ron;

		if($_form['voucher'] != "" && $_discount_price > 0){
			$full_msg_request[] = "";
			$full_msg_request[] = "Discount Eur: -".$_discount_price;
			$full_msg_request[] = "Discount Ron: -".$_discount_price_ron;
			$full_msg_request[] = "Cod voucher: ".$_form['voucher'];
			$full_msg_request[] = "";
			if($_country['id_country'] != 126){
				$full_msg_request[] = "Pret cu discount Eur: ".($_final_price-$_discount_price);
			}
			$full_msg_request[] = "Pret cu discount Ron: ".($_final_price_ron-$_discount_price_ron);
		}

		$full_msg_request[] = "Metoda de plata: ".$_form['payment'];
		$full_msg_request[] = "Forma de plata: ".$_form['pay_amount'];
		if($_form['pay_amount'] != "full"){
			if($_country['id_country'] != 126){
				$full_msg_request[] = "Avans Eur: ".$_advance_price;
			}
			$full_msg_request[] = "Avans Ron: ".$_advance_price_ron;
			if($_form['voucher'] != "" && $_discount_price > 0){
				if($_country['id_country'] != 126){
					$full_msg_request[] = "Discount Avans Eur: -".$_discount_advance_price;
				}
				$full_msg_request[] = "Discount Avans Ron: -".$_discount_advance_price_ron;
				$full_msg_request[] = "";
				if($_country['id_country'] != 126){
					$full_msg_request[] = "Avans cu discount Eur: ".($_advance_price-$_discount_advance_price);
				}
				$full_msg_request[] = "Avans cu discount Ron: ".($_advance_price_ron-$_discount_advance_price_ron);
			}
		}

		if($_form['payment'] == "euplatesc"){
			$full_msg_request[] = "Moneda tranzactionare: ".$_form['pay_currency'];
		}
		if($_form['payment'] == "rate"){
			$full_msg_request[] = "Card rate: ".$_form['payment_bank'];
		}
		if($_form['payment'] == "op"){
			$full_msg_request[] = "Moneda tranzactionare: ".$_form['pay_currency'];
		}
		if($_form['payment'] == "cash"){
			$full_msg_request[] = "Moneda tranzactionare: ".$_form['pay_currency'];
		}
		if($_form['payment'] == "voucher"){
			$full_msg_request[] = "Moneda tranzactionare: ".$_form['pay_currency'];
		}

		$agency = get_post(array(
			'table' => 'agency',
			'id_agency' => $_form['id_agency']
		));
		$full_msg_request[] = "Agentie: ".$agency['title'];
		$full_msg_request[] = "Agent: ".$_form['agent'];

		$full_msg_request[] = "";
		$full_msg_request[] = "Observatii client: ".$_form['obs'];

		if($_params['type'] == "insurance"){

			$error_insurance = false;

			foreach($_search_data['insurants'] as $i => $insurant){

				$type = (date('Y') - $item['dob_year'] < 18 ? "child" : "adult");
				$dob = $insurant['dob_year']."-".$insurant['dob_month']."-".$insurant['dob_day'];

				$full_msg_request[] = "";
				$full_msg_request[] = "Turist ".($i+1).": ";

				$exists = db_row('
					SELECT * FROM user_passenger
					WHERE name = ? AND surname = ? AND type = ? AND dob = ? AND id_user = ?',
					$insurant['firstname'], $insurant['lastname'], $type, $dob, $_user_id
				);
				if(!$exists){
					db_query('INSERT INTO user_passenger SET
						name = ?,
						surname = ?,
						type = ?,
						dob = ?,
						gender = ?,
	                    ci = ?,
						cnp = ?,
	                    county = ?,
	                    city = ?,
	                    address = ?,
						id_user = ?
					',
						$insurant['firstname'],
						$insurant['lastname'],
						$type,
						$dob,
						$insurant['gender'],
						$insurant['ci'],
						$insurant['cnp'],
						$insurant['county'],
						$insurant['city'],
						$insurant['address'],
						$_user_id
					);
				}

				$id_insurant = db_query('INSERT INTO booking_passenger SET
					id_booking = ?,
					title = ?,
					name = ?,
					surname = ?,
					type = ?,
					room = ?,
					nr = ?,
					dob = ?,
					gender = ?,
					ci = ?,
					cnp = ?,
					county = ?,
					city = ?,
					address = ?
				',
					$_id_booking,
					$insurant['firstname']." ".$insurant['lastname'],
					$insurant['firstname'],
					$insurant['lastname'],
					$type,
					1,
					($i+1),
					$dob,
					$insurant['gender'],
					$insurant['ci'],
					$insurant['cnp'],
					$insurant['county'],
					$insurant['city'],
					$insurant['address']
				);

				$full_msg_request[] = ($type == "child" ? "Copil" : "Adult")." ".($j+1).": ".$insurant['firstname']." ".$insurant['lastname'].", ".$type.", ".$dob.", ".$insurant['gender'].", ".$insurant['ci'].", ".$insurant['county'].", ".$insurant['city'].", ".$insurant['address'];
				if($insurant['is_extreme']){
					$full_msg_request[] = "Optiuni extrem: ".($insurant['zapada'] ? "Zapada, ": "").($insurant['aero'] ? "Aero, ": "").($insurant['nautic'] ? "Nautic, ": "").($insurant['terestru'] ? "Terestru, ": "").($insurant['roti'] ? "Cu Motor, ": "").($insurant['triatlon'] ? "Triatlon, ": "");
				}
				$full_msg_request[] = $_items_insurance[$i]['product']['title']." - ".$_items_insurance[$i]['quote']['prima']." Ron";

				$offer = city_insurance_create_offer($_search_data, $insurant, $_items_insurance[$i]['product']['code'], $_form['payment'], $_id_booking, false);

				if($offer['error']){
					$error_insurance = true;
					$error_insurance_message = $offer['message'];
				}
				db_query('UPDATE booking_passenger SET city_insurance_offer_id = ? WHERE id_booking_passenger = ?', json_encode($offer), $id_insurant);

			}

			if($error_insurance){
				db_query('UPDATE booking SET trash = 1 WHERE id_booking = ?', $_id_booking);
			}

		}else{

			for($i=0; $i<$_search_data['rooms']; $i++){

				$full_msg_request[] = "";
				$full_msg_request[] = "Camera ".($i+1).": ";

				foreach(array('adult', 'child') as $type){
					if($_search_data['rooms_info'][$i][$type] > 0) {
						for($j=0; $j<$_search_data['rooms_info'][$i][$type]; $j++){

							$exists = db_row('
								SELECT * FROM user_passenger
								WHERE name = ? AND surname = ? AND type = ? AND dob = ? AND id_user = ?',
								$_form[$type.'_name_'.$i.'_'.$j], $_form[$type.'_surname_'.$i.'_'.$j], $type, date("Y-m-d", strtotime($_form[$type.'_dob_'.$i.'_'.$j])), $_user_id
							);
							if(!$exists){
								db_query('INSERT INTO user_passenger SET
									name = ?,
									surname = ?,
									type = ?,
									gender = ?,
									dob = ?,
									id_user = ?
								',
									$_form[$type.'_name_'.$i.'_'.$j],
									$_form[$type.'_surname_'.$i.'_'.$j],
									$type,
									$_form[$type.'_gender_'.$i.'_'.$j],
									date("Y-m-d", strtotime($_form[$type.'_dob_'.$i.'_'.$j])),
									$_user_id
								);
							}

							db_query('INSERT INTO booking_passenger SET
								id_booking = ?,
								title = ?,
								name = ?,
								surname = ?,
								type = ?,
								gender = ?,
								room = ?,
								nr = ?,
								dob = ?
							',
								$_id_booking,
								$_form[$type.'_name_'.$i.'_'.$j]." ".$_form[$type.'_surname_'.$i.'_'.$j],
								$_form[$type.'_name_'.$i.'_'.$j],
								$_form[$type.'_surname_'.$i.'_'.$j],
								$type,
								$_form[$type.'_gender_'.$i.'_'.$j],
								($i+1),
								($j+1),
								date("Y-m-d", strtotime($_form[$type.'_dob_'.$i.'_'.$j]))
							);

							$full_msg_request[] = ($type == "child" ? "Copil" : "Adult")." ".($j+1).": ".$_form[$type.'_name_'.$i.'_'.$j]." ".$_form[$type.'_surname_'.$i.'_'.$j].", ".$type.", ".$_form[$type.'_dob_'.$i.'_'.$j];

						}
					}
				}
			}

		}

		// if(debug_mode()){
		// 	var_dump($error_insurance);
		// 	// print_r($_search_data);
		// 	// print_r($_selected_data);
		// 	// print_r($_items_insurance);
		// 	// print_r($full_msg_request);
		// 	exit;
		// }

		if(($_params['type'] == "insurance" && !$error_insurance) || $_params['type'] != "insurance"){

			$req_tm = array(
			    'request_id' => 0,
			    'request_date' => date('Y-m-d'),
			    'request_client' => -1,
			    'request_expense_dep' => null,
			    'request_web_login' => null,
			    'request_user' => 1,
			    'request_owner' => 1,
			    'request_location' => 1,
			    'request_text' => implode("\n", $full_msg_request),
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
			    'request_fname' => $_form['invoice_surname'],
			    'request_lname' => $_form['invoice_name'],
			    'have_request' => 'false',
			    'last_update' => date(DATE_W3C),
			    'request_products' => 1,
			    'request_dep_date' => ($_check_in != "" ? date("Y-m-d", strtotime($_check_in)) : ""),
			    'request_ret_date' => ($_check_out != "" ? date("Y-m-d", strtotime($_check_out)) : ""),
			    'request_nights' => intval(($_check_in != "" && $_check_out != "" ? days_between_dates(date("Y-m-d", strtotime($_check_in)), date("Y-m-d", strtotime($_check_out))) : "")),
			    'request_adults' => intval($adults_all),
			    'request_children' => intval($children_all),
			    'request_children_ages' => '',
			    'request_room_type' => -1,
			    'request_transport' => 'None',
			    'request_meal' => 'None',
			    'request_hotel_category' => 0,
			    'request_dest_country' => '',
			    'request_dep_city'	=> $_city_from['title'],
			    'request_dest_city' => $_zone['title'],
			    'request_date_flex_days' => 0,
			    'request_client_feedback' => '1900-01-01T00:00:00+03:00',
			    'request_hotel_info' => '',
			    'request_room_info' => '',
			    'request_question_answers' => null
			);

			$response = send_request_to_tm($req_tm);

			$content['title'] = "Rezervare ".$_mail_title;
			$content['content'] = "<p>".implode("<br>", $full_msg_request)."</p>";

			send_mail($_config['contact']['reservations'], "Rezervare ".$_mail_title, $content, 'default');

			if($_params['type'] == "charter" || $_params['type'] == "tourism"){

				$user_content['country'] = $_country['title'];
				$user_content['zone'] = $_zone['title'] != "" ? $_zone['title'] : $_city['title'];
				$user_content['city'] = $_city['title'];

				$user_content['form_data'] = $_form;
				$user_content['search_data'] = $_search_data;

				$user_content['nr_nights'] = $_nr_nights;
				$user_content['nr_days'] = $_nr_days;
				$user_content['check_in'] = $_check_in;
				$user_content['check_out'] = $_check_out;

				$user_content['room_info'] = $_room_info;
				$user_content['meal_info'] = $_meal_info;

				if($_params['type'] == "charter"){
					$user_content['flight_info'] = $_flight_info;
				}

				$user_content['adults_all'] = $adults_all;
				$user_content['children_all'] = $children_all;

				$user_content['item'] = $_item;

				if($_country['id_country'] != 126){
					$user_content['final_price'] = $_final_price;
				}
				$user_content['final_price_ron'] = $_final_price_ron;

				$user_content['old_price'] = $_old_price;
				$user_content['old_price_ron'] = $_old_price_ron;

				if($_form['voucher'] != "" && $_discount_price > 0){
					$user_content['discount_price'] = $_discount_price;
					$user_content['discount_price_ron'] = $_discount_price_ron;
					$user_content['discount_advance_price'] = $_discount_advance_price;
					$user_content['discount_advance_price_ron'] = $_discount_advance_price_ron;
					$user_content['voucher'] = $_form['voucher'];
				}

				$user_content['availability'] = $_availability;

				if($_form['pay_amount'] != "full"){
					$user_content['advance_price'] = $_advance_price;
					$user_content['advance_price_ron'] = $_advance_price_ron;
				}

				/*
				if($_form['payment'] == "cash"){
					$user_content['agency'] = $agency;
				}

				if($_form['payment'] == "voucher"){
					$user_content['agency'] = $agency;
				}
				*/

				$user_content['agency'] = $agency;

				if($_show_storno_insurance){
					$user_content['show_storno_insurance'] = true;
				}

				send_paralela_mail($_form['email'], "Rezervare ".$_side_title." #".$_id_booking, $user_content, 'booking-'.$_params['type']);
				//send_paralela_mail("alex@prologue.ro", "Rezervare ".$_side_title." #".$_id_booking, $user_content, 'booking-'.$_params['type']);

			}elseif($_params['type'] == "insurance"){

				// if(debug_mode()){
				// 	print_r($_search_data);
				// 	print_r($_selected_data);
				// 	print_r($_items_insurance);
				// 	print_r($full_msg_request);
				// 	exit;
				// }

				$user_content['country'] = ucwords(strtolower($_search_data['country']));

				$user_content['form_data'] = $_form;
				$user_content['search_data'] = $_search_data;
				$user_content['insurance_data'] = $_items_insurance;

				$user_content['nr_nights'] = $_nr_nights;
				$user_content['nr_days'] = $_nr_days;
				$user_content['check_in'] = $_check_in;
				$user_content['check_out'] = $_check_out;

				$user_content['adults_all'] = $adults_all;
				$user_content['children_all'] = $children_all;

				$user_content['item'] = $_item;

				$user_content['final_price'] = $_final_price;
				$user_content['final_price_ron'] = $_final_price_ron;

				$user_content['availability'] = $_availability;

				/*
				if($_form['payment'] == "cash"){
					$user_content['agency'] = $agency;
				}
				*/

				$user_content['agency'] = $agency;

				send_paralela_mail($_form['email'], $_side_title." #".$_id_booking, $user_content, 'booking-'.$_params['type']);
				//send_paralela_mail("alex@prologue.ro", "Rezervare ".$_side_title." #".$_id_booking, $user_content, 'booking-'.$_params['type']);

			}

			unset($_SESSION['insurance_booking']);
			unset($_SESSION['insurance_offers']);


			if($_form['payment'] == "rate"){
				//if(in_array($_form['payment'], array_keys($_installments_to_procesator))){
				$_gateway = $_installments_to_procesator[$_form['payment_bank']];
			}else{
				$_gateway = $_form['payment'];
			}

			switch($_gateway){

				case 'mobilpay': {

					require_once $_base_path.'models/mobilpay/Payment/Request/Abstract.php';
					require_once $_base_path.'models/mobilpay/Payment/Request/Card.php';
					require_once $_base_path.'models/mobilpay/Payment/Invoice.php';
					require_once $_base_path.'models/mobilpay/Payment/Address.php';

					//for testing purposes, all payment requests will be sent to the sandbox server. Once your account will be active you must switch back to the live server https://secure.mobilpay.ro
					if(debug_mode()){
						$paymentUrl = 'http://sandboxsecure.mobilpay.ro';
					}else{
						$paymentUrl = 'https://secure.mobilpay.ro';
					}

					// this is the path on your server to the public certificate. You may download this from Admin -> Conturi de comerciant -> Detalii -> Setari securitate
					if(debug_mode()){
						$x509FilePath = $_base_path.'models/mobilpay/test.public.cer';
					}else{
						$x509FilePath = $_base_path.'models/mobilpay/live.public.cer';
					}

					try{
						srand((double) microtime() * 1000000);
						$objPmReqCard 						= new Mobilpay_Payment_Request_Card();

						#semnatura contului de comerciant - mergi pe www.mobilpay.ro Admin -> Conturi de comerciant -> Detalii -> Setari securitate
						$objPmReqCard->signature 			= 'N8H3-HVBN-S6EQ-UQQS-ADLD';

						#order_id should be unique for a merchant account
						$objPmReqCard->orderId 				= $_id_booking;

						#if you don't want to supply a different return/confirm URL, just let it null
						$objPmReqCard->confirmUrl 			= $_base.'models/mobilpay/ipn.php';
						$objPmReqCard->returnUrl 			= route('thank-you');

						#detalii cu privire la plata: moneda, suma, descrierea
						$objPmReqCard->invoice = new Mobilpay_Payment_Invoice();
						$objPmReqCard->invoice->currency	= strtoupper($_card_currency);
						$objPmReqCard->invoice->amount		= $_card_price;
						$objPmReqCard->invoice->installments= "";//1;//$_POST['installments_'.$_form['payment']];
						$objPmReqCard->invoice->details		= 'Rezervare #'.$_id_booking;

						#detalii cu privire la adresa posesorului cardului
						$billingAddress 				= new Mobilpay_Payment_Address();
						$billingAddress->type			= "person";
						$billingAddress->firstName		= $_form['invoice_name'];
						$billingAddress->lastName		= $_form['invoice_surname'];
						$billingAddress->fiscalNumber	= "";
						$billingAddress->identityNumber	= "";
						$billingAddress->country		= $_form['invoice_country'];
						$billingAddress->city			= $_form['invoice_city'];
						$billingAddress->email			= $_form['email'];
						$billingAddress->mobilePhone	= $_form['phone'];
						$billingAddress->address		= $_form['invoice_address'];
						$objPmReqCard->invoice->setBillingAddress($billingAddress);

						$objPmReqCard->encrypt($x509FilePath);

					}
					catch(Exception $e){
						//do something
					}

					if(!($e instanceof Exception)){?>
						<html>
						<head>
							<title>Mobilpay</title>
							<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
							<? include $_theme_path."section/tracking.php"; ?>
						</head>
						<body>
							<?
							$_booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $_id_booking);

							$_search_data = json_decode($_booking['search_data'], true);
							$_selected_data = json_decode($_booking['selected_data'], true);

							if($_selected_data['id_hotel']){
								$_item = get_hotel_by_id($_selected_data['id_hotel']);
								$_city = get_city_by_id($_item['id_city']);
							}

							if($_selected_data['id_circuit']){
								$_item = get_circuit_by_id($_selected_data['id_circuit']);
							}

							include $_theme_path."booking/include/tracking.php";
							?>
							<div align="center">
								<form name="frmPaymentRedirect" method="post" action="<?=$paymentUrl;?>">
									<input type="hidden" name="env_key" value="<?=$objPmReqCard->getEnvKey();?>"/>
									<input type="hidden" name="data" value="<?=$objPmReqCard->getEncData();?>"/>
									<p>Pentru a finaliza plata veti fi redirectat catre pagina securizata a MobilPay</p>
								</form>
							</div>
							<script type="text/javascript" language="javascript">
								window.setTimeout(document.frmPaymentRedirect.submit(), 1000);
							</script>
						</body>
						</html>
						<? exit;?>
					<? }else{?>
						<p><strong><?=$e->getMessage();?></strong></p>
						<? exit;?>
					<? }

				}break;

				case 'euplatesc':{

					require_once $_base_path.'models/euplatesc/euplatesc.php';

					$dataAll = array(
						'amount'      => $_card_price,
						'curr'        => strtoupper($_card_currency),
						'invoice_id'  => $_id_booking,
						'order_desc'  => 'Rezervare #'.$_id_booking,
						'merch_id'    => $_euplatesc_mid,
						'timestamp'   => gmdate("YmdHis"),
			 			'nonce'       => md5(microtime() . mt_rand()),
					);

					$dataAll['fp_hash'] = strtoupper(euplatesc_mac($dataAll, $_euplatesc_key));

					$dataBill = array(
						'fname'	   => $_form['invoice_name'],
						'lname'	   => $_form['invoice_surname'],
						'country'  => $_form['invoice_country'],
						'company'  => '',
						'city'	   => $_form['invoice_city'],
						'add'	   => $_form['invoice_address'],
						'email'	   => $_form['email'],
						'phone'	   => $_form['phone'],
						'fax'	   => '',
					);
					?>
						<html>
							<head>
								<title>Euplatesc</title>
								<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
								<? include $_theme_path."section/tracking.php"; ?>
							</head>
							<body>
								<?
								$_booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $_id_booking);

								$_search_data = json_decode($_booking['search_data'], true);
								$_selected_data = json_decode($_booking['selected_data'], true);

								if($_selected_data['id_hotel']){
									$_item = get_hotel_by_id($_selected_data['id_hotel']);
									$_city = get_city_by_id($_item['id_city']);
								}

								if($_selected_data['id_circuit']){
									$_item = get_circuit_by_id($_selected_data['id_circuit']);
								}

								include $_theme_path."booking/include/tracking.php";
								?>
								<div align="center">
									<form action="https://secure.euplatesc.ro/tdsprocess/tranzactd.php" method="post" name="gateway" target="_self">
										<p class="tx_red_mic">Pentru a finaliza plata veti fi redirectat catre pagina securizata a EuPlatesc</p>
										<!--
										<p><img src="https://www.euplatesc.ro/plati-online/tdsprocess/images/progress.gif" alt="" title="" onload="javascript:document.gateway.submit()"></p>
										-->

									    <input name="fname" type="hidden" value="<?=$dataBill['fname'];?>" />
									    <input name="lname" type="hidden" value="<?=$dataBill['lname'];?>" />
									    <input name="country" type="hidden" value="<?=$dataBill['country'];?>" />
									    <input name="company" type="hidden" value="<?=$dataBill['company'];?>" />
									    <input name="city" type="hidden" value="<?=$dataBill['city'];?>" />
									    <input name="add" type="hidden" value="<?=$dataBill['add'];?>" />
									    <input name="email" type="hidden" value="<?=$dataBill['email'];?>" />
									    <input name="phone" type="hidden" value="<?=$dataBill['phone'];?>" />
									    <input name="fax" type="hidden" value="<?=$dataBill['fax'];?>" />

										<input type="hidden" name="amount" value="<?=$dataAll['amount'] ?>" />
										<input type="hidden" name="curr" value="<?=$dataAll['curr'] ?>" />
										<input type="hidden" name="invoice_id" value="<?=$dataAll['invoice_id'] ?>" />
										<input type="hidden" name="order_desc" value="<?=$dataAll['order_desc'] ?>" />
										<input type="hidden" name="merch_id" value="<?=$dataAll['merch_id'] ?>" />
										<input type="hidden" name="timestamp" value="<?=$dataAll['timestamp'] ?>" />
										<input type="hidden" name="nonce" value="<?=$dataAll['nonce'] ?>" />
										<input type="hidden" name="fp_hash" value="<?=$dataAll['fp_hash'] ?>" />

										<input type="hidden" name="returnurl" value="<?=route('thank-you', $_id_booking) ?>" />

										<p><a href="javascript:gateway.submit();" class="txtCheckout">Continua</a></p>
									</form>

									<script type="text/javascript" language="javascript">
										window.setTimeout(document.gateway.submit(), 1000);
									</script>
								</div>
							</body>
						</html>

					<?
					exit;

				}break;

				case 'cash':
				case 'voucher':
				case 'op':{

					go_away(route('thank-you', $_id_booking));

				}break;

			}

		}

	}

}



list($_agencies_city, $count) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
	'order' => 'title ASC',
	'id_country' => 126,
	'extra_where' =>  ' AND id_city IN (SELECT id_city FROM agency WHERE use_booking = 1 AND '.db_is_active('', 'agency').') OR id_city = 21749'
));

if(isset($_POST['agency_city'])){
	list($_agencies, $count) = get_posts(array(
		'table' => 'agency',
		'limit' => -1,
		'use_booking' => 1,
		'order' => 'title ASC',
		'id_city' => intval($_POST['agency_city'])
	));
}else{
	list($_agencies, $count) = get_posts(array(
		'table' => 'agency',
		'limit' => -1,
		'order' => 'title ASC',
		'id_city' => 21749
	));
}


$_payment_methods_titles = array();
foreach($_payment_methods as $method){
	$_payment_methods_titles[] = $method['key'];
}


$_section = 'booking';



//seo
$_meta_title = "Rezervare";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;
