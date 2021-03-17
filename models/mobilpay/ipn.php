<?
$_use_routes = false;
$_is_ajax = false;
require_once dirname(__FILE__) . '/../../config.php';

if(isset($_POST['env_key']) && isset($_POST['data'])) {

	require_once $_base_path.'models/mobilpay/Payment/Request/Abstract.php';
	require_once $_base_path.'models/mobilpay/Payment/Request/Card.php';
	require_once $_base_path.'models/mobilpay/Payment/Request/Notify.php';
	require_once $_base_path.'models/mobilpay/Payment/Invoice.php';
	require_once $_base_path.'models/mobilpay/Payment/Address.php';

	$errorCode 		= 0;
	$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_NONE;
	$errorMessage	= '';

	#calea catre cheia privata
	#cheia privata este generata de mobilpay, accesibil in Admin -> Conturi de comerciant -> Detalii -> Setari securitate
	//$privateKeyFilePath = $_base_path.'models/mobilpay/test.private.key';
	$privateKeyFilePath = $_base_path.'models/mobilpay/live.private.key';

	try{
		$objPmReq = Mobilpay_Payment_Request_Abstract::factoryFromEncrypted($_POST['env_key'], $_POST['data'], $privateKeyFilePath);

    	switch($objPmReq->objPmNotify->action){
			#orice action este insotit de un cod de eroare si de un mesaj de eroare. Acestea pot fi citite folosind $cod_eroare = $objPmReq->objPmNotify->errorCode; respectiv $mesaj_eroare = $objPmReq->objPmNotify->errorMessage;
			#pentru a identifica ID-ul ordersi pentru care primim rezultatul platii folosim $id_comanda = $objPmReq->orderId;
	        case 'confirmed':
				#cand action este confirmed avem certitudinea ca banii au plecat din contul posesorului de card si facem update al starii ordersi si livrarea produsului
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
			case 'confirmed_pending':
				#cand action este confirmed_pending inseamna ca tranzactia este in curs de verificare antifrauda. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
			case 'paid_pending':
				#cand action este paid_pending inseamna ca tranzactia este in curs de verificare. Nu facem livrare/expediere. In urma trecerii de aceasta verificare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
			case 'paid':
				#cand action este paid inseamna ca tranzactia este in curs de procesare. Nu facem livrare/expediere. In urma trecerii de aceasta procesare se va primi o noua notificare pentru o actiune de confirmare sau anulare.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
			case 'canceled':
				#cand action este canceled inseamna ca tranzactia este anulata. Nu facem livrare/expediere.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
			case 'credit':
				#cand action este credit inseamna ca banii sunt returnati posesorului de card. Daca s-a facut deja livrare, aceasta trebuie oprita sau facut un reverse.
	        	$errorMessage = $objPmReq->objPmNotify->getCrc();
	            break;
	        default:
	        	$errorType		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_PERMANENT;
	            $errorCode 		= Mobilpay_Payment_Request_Abstract::ERROR_CONFIRM_INVALID_ACTION;
	            $errorMessage 	= 'mobilpay_refference_action paramaters is invalid';
	            break;
    	}

		$id_booking = $objPmReq->orderId;
		$_booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $id_booking);

		db_query("UPDATE booking SET payment_status = '".$objPmReq->objPmNotify->action."', error_payment = '".$objPmReq->objPmNotify->errorCode."', error_message = '".$objPmReq->objPmNotify->errorMessage."' WHERE id_booking = ".$id_booking);

		if(in_array($objPmReq->objPmNotify->action, array('confirmed')) && $objPmReq->objPmNotify->errorCode == 0) {

			if($_booking['eurosite_booking_id'] == "" || $_booking['generali_booking_id'] == ""){
				db_query("UPDATE booking SET status = 'paid' WHERE id_booking = ".$id_booking);

				$_search_data = json_decode($_booking['search_data'], true);
				$_selected_data = json_decode($_booking['selected_data'], true);
				$_booking_passengers = db_query('SELECT * FROM booking_passenger WHERE id_booking = ?', $_booking['id_booking']);

				if($_selected_data['id_hotel'] != ""){
					$hotel = get_hotel_by_id($_selected_data['id_hotel']);
				}

				$currency = "EUR";
				if($hotel['id_country'] == 126){
					$currency = "RON";
				}

				switch($_booking['type']){

					case 'insurance': {
						if($_booking['generali_booking_id'] == ""){
							$_generali_client = new SoapClient($_config['generali']['link'], array(
							    'trace' => true,
							    'exceptions' => true,
							));
							$return = generali_place_order($_selected_data['id_generali_product'], $_search_data, $_booking);
						}
					}break;

					case 'circuit': {
						if($_booking['eurosite_booking_id'] == ""){
							$return = eurositeCircuitAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers);
						}
					}break;

					case 'charter': {
						if($_booking['eurosite_booking_id'] == ""){
							$return = eurositeCharterAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers);
						}
					}break;

					case 'tourism': {
						if($_booking['eurosite_booking_id'] == ""){
							$return = eurositeHotelAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers, $currency);
						}
					}break;

				}

				if($_booking['type'] == "insurance"){

					if($_booking['generali_booking_id'] == ""){
						db_query('UPDATE booking SET generali_booking_id = ?, status = "success" WHERE id_booking = ?', $return, $_booking['id_booking']);

						$content['title'] = "Confirmare plata online rezervare ".$id_booking;
						$content['content'] = "
						<p>
							Id rezervare site: ".$id_booking."<br>
							Id rezervare generali: ".$return."<br>
							Status plata online: Confirmata<br>
						</p>
						";

						send_mail($_config['contact']['confirmations_pay'], "Confirmare plata online", $content, 'default');
						send_mail($_config['contact']['reservations'], "Confirmare plata online", $content, 'default');
					}

				}else{

					if($return['BookingReferences']['BookingReference'][0]['value'] != ""){

						db_query('UPDATE booking SET eurosite_booking_id = ?, status = "success" WHERE id_booking = ?', $return['BookingReferences']['BookingReference'][0]['value'], $id_booking);

						$content['title'] = "Confirmare plata online rezervare ".$return['BookingReferences']['BookingReference'][0]['value'];
						$content['content'] = "
						<p>
							Id rezervare site: ".$id_booking."<br>
							Id rezervare eurosite: ".$return['BookingReferences']['BookingReference'][0]['value']."<br>
							Status plata online: Confirmata<br>
						</p>
						";

						send_mail($_config['contact']['confirmations_pay'], "Confirmare plata online", $content, 'default');
						send_mail($_config['contact']['reservations'], "Confirmare plata online", $content, 'default');

					}elseif($return['BookingItems']['BookingItem']['Error']['ErrorText']['value'] != ""){

						db_query('UPDATE booking SET eurosite_error = ?, status = "error_eurosite" WHERE id_booking = ?', $return['BookingItems']['BookingItem']['Error']['ErrorText']['value'], $id_booking);

						$content['title'] = "Eroare rezervare in eurosite";
						$content['content'] = "
						<p>
							Id rezervare site: ".$id_booking."<br>
							Eroare rezervare: ".$return['BookingItems']['BookingItem']['Error']['ErrorText']['value']."<br>
							Status plata online: Confirmata<br>
						</p>
						";

						send_mail($_config['contact']['confirmations_pay'], "Eroare rezervare", $content, 'default');
						send_mail($_config['contact']['reservations'], "Eroare rezervare", $content, 'default');

					}

				}

			}

		}

		if($objPmReq->objPmNotify->errorCode > 0){

			db_query("UPDATE booking SET status = 'error_payment' WHERE id_booking = ".$id_booking);

			$content['title'] = "Eroare plata online";
			$content['content'] = "
			<p>
				Id rezervare site: ".$id_booking."<br>
				Eroare plata online: ".$objPmReq->objPmNotify->errorMessage."<br>
			</p>
			";

			send_mail($_config['contact']['confirmations_pay'], "Eroare plata online", $content, 'default');
			send_mail($_config['contact']['reservations'], "Eroare plata online", $content, 'default');

		}

	}catch(Exception $e){

		$errorType 		= Mobilpay_Payment_Request_Abstract::CONFIRM_ERROR_TYPE_TEMPORARY;
		$errorCode		= $e->getCode();
		$errorMessage 	= $e->getMessage();

		$content .= "Eroare:<br /><br />".$errorCode."<br /><br />".$errorMessage;

		$headers = "From: Paralela45 <contact@paralela45.ro> \r\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Return-Path: contact@paralela45.ro \r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\n";

		$subject = "Eroare plata de pe Paralela45";
		@mail("alex@prologue.ro", $subject, $content, $headers);

	}

	header('Content-type: application/xml');
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	if($errorCode == 0){
		echo "<crc>{$errorMessage}</crc>";
	}else{
		echo "<crc error_type=\"{$errorType}\" error_code=\"{$errorCode}\">{$errorMessage}</crc>";
	}
	exit;

}
