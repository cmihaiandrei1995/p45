<?
$_use_routes = false;
$_is_ajax = false;
require_once dirname(__FILE__) . '/../../config.php';

require_once $_base_path.'models/euplatesc/euplatesc.php';

$zcrsp = array (
	'amount'     => addslashes(trim(@$_POST['amount'])),
	'curr'       => addslashes(trim(@$_POST['curr'])),
	'invoice_id' => addslashes(trim(@$_POST['invoice_id'])),
	'ep_id'      => addslashes(trim(@$_POST['ep_id'])),
	'merch_id'   => addslashes(trim(@$_POST['merch_id'])),
	'action'     => addslashes(trim(@$_POST['action'])),
	'message'    => addslashes(trim(@$_POST['message'])),
	'approval'   => addslashes(trim(@$_POST['approval'])),
	'timestamp'  => addslashes(trim(@$_POST['timestamp'])),
	'nonce'      => addslashes(trim(@$_POST['nonce'])),
	'sec_status' => addslashes(trim(@$_POST['sec_status']))
);

$zcrsp['fp_hash'] = strtoupper(euplatesc_mac($zcrsp, $_euplatesc_key));

$id_booking = $zcrsp['invoice_id'];
$tmp = explode("-", $id_booking);

// file_put_contents('log.log', "\n\n\n", FILE_APPEND);
// file_put_contents('log.log', json_encode($_POST)."\n", FILE_APPEND);
// file_put_contents('log.log', json_encode($tmp)."\n", FILE_APPEND);

if($tmp[0] == "VOUCHER"){

	$id_booking = $tmp[1];

	$_order = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', $id_booking);

	// file_put_contents('log.log', json_encode($_order)."\n", FILE_APPEND);

	db_query("UPDATE voucher_order SET payment_status = '".$zcrsp['sec_status']."', error_payment = '".$zcrsp['action']."', error_message = '".$zcrsp['message']."' WHERE id_voucher_order = ".$id_booking);

	$fp_hash = addslashes(trim(@$_POST['fp_hash']));

	if($zcrsp['fp_hash'] === $fp_hash)	{

		if($zcrsp['action'] == "0") {

			if($_order['code'] == ""){

				$voucher_code = strtoupper(generateCode(10));
				$id_voucher = db_query(
					'INSERT INTO voucher SET title = ?, code = ?, offer_type = ?, date_from = ?, date_to = ?, type = ?, value = ?, cart_min_price = ?, max_usage = ?, subtype = ?',
					'Voucher Cadou - #'.$id_booking,
					$voucher_code,
					'all',
					date('Y-m-d'),
					date('Y-m-d', strtotime('+1year +1day')),
					'fixed',
					$_order['value'],
					50,
					1,
					'booking'
				);

				db_query('UPDATE voucher_order SET code = ?, status = "success" WHERE id_voucher_order = ?', $voucher_code, $id_booking);

				$content['title'] = "Confirmare plata online voucher ".$id_booking;
				$content['content'] = "
				<p>
					Id comanda voucher: ".$id_booking."<br>
					Status plata online: Confirmata<br>
				</p>
				";

				send_mail($_config['contact']['confirmations_pay'], "Confirmare plata online - voucher", $content, 'default');
				send_mail($_config['contact']['reservations'], "Confirmare plata online - voucher", $content, 'default');
			}

		}else{

			db_query("UPDATE voucher_order SET status = 'error_payment' WHERE id_voucher_order = ".$id_booking);

			$content['title'] = "Eroare plata online";
			$content['content'] = "
			<p>
				Id comanda voucher: ".$id_booking."<br>
				Eroare plata online: ".$zcrsp['message']."<br>
			</p>
			";

			send_mail($_config['contact']['confirmations_pay'], "Eroare plata online", $content, 'default');
			send_mail($_config['contact']['reservations'], "Eroare plata online", $content, 'default');

		}

	}else{
		echo "Invalid signature";
	}

}else{

	$_booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $id_booking);

	db_query("UPDATE booking SET payment_status = '".$zcrsp['sec_status']."', error_payment = '".$zcrsp['action']."', error_message = '".$zcrsp['message']."' WHERE id_booking = ".$id_booking);

	$fp_hash = addslashes(trim(@$_POST['fp_hash']));

	if($zcrsp['fp_hash'] === $fp_hash)	{

		if($zcrsp['action'] == "0") {

			if($_booking['type'] == "insurance"){

				if($_booking['generali_booking_id'] == ""){

					db_query("UPDATE booking SET status = 'paid' WHERE id_booking = ".$id_booking);

					$_search_data = json_decode($_booking['search_data'], true);
					$_selected_data = json_decode($_booking['selected_data'], true);
					$_booking_passengers = db_query('SELECT * FROM booking_passenger WHERE id_booking = ?', $_booking['id_booking']);

					$_generali_client = new SoapClient($_config['generali']['link'], array(
						'trace' => true,
						'exceptions' => true,
					));
					$return = generali_place_order($_selected_data['id_generali_product'], $_search_data, $_booking);

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

				if($_booking['eurosite_booking_id'] == ""){

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

						case 'circuit': {
							$return = eurositeCircuitAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers);
						}break;

						case 'charter': {
							$return = eurositeCharterAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers);
						}break;

						case 'tourism': {
							$return = eurositeHotelAddBooking($_search_data, $_selected_data, $_booking, $_booking_passengers, $currency);
						}break;

					}

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

		}else{

			db_query("UPDATE booking SET status = 'error_payment' WHERE id_booking = ".$id_booking);

			$content['title'] = "Eroare plata online";
			$content['content'] = "
			<p>
				Id rezervare site: ".$id_booking."<br>
				Eroare plata online: ".$zcrsp['message']."<br>
			</p>
			";

			send_mail($_config['contact']['confirmations_pay'], "Eroare plata online", $content, 'default');
			send_mail($_config['contact']['reservations'], "Eroare plata online", $content, 'default');

		}

	}else{
		echo "Invalid signature";
	}

}
