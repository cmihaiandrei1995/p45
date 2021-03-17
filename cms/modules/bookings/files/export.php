<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="rezervari.csv";');

$fields = array(
	'id_booking' => 'ID Rezervare site',
	'eurosite_booking_id' => 'ID Eurosite',
	'id_user' => 'ID User site',
	'ip' => 'IP User',
	'created' => 'Data rezervare',

	'name' => 'Nume',
	'surname' => 'Prenume',
	'email' => 'Email',
	'phone' => 'Telefon',

	'country' => 'Tara',
	'county' => 'Judet',
	'city' => 'Oras',
	'address' => 'Adresa',

	'invoice' => 'Tip facturare',
	//'cnp' => 'CNP',
	'cui' => 'CUI',
	'nr_reg' => 'Nr reg com',

	'type' => 'Tip rezervare',

	'booking_info_country' => 'Tara rezervare',
	'booking_info_city' => 'Oras rezervare',
	'booking_info_check_in' => 'Data start',
	'booking_info_check_out' => 'Data end',
	'booking_info_rooms' => 'Nr camere',
	'booking_info_circuit_id' => 'Cod circuit',
	'booking_info_id_circuit' => 'Nume circuit',
	'booking_info_id_city_from' => 'Oras plecare',
	'booking_info_hotel_code' => 'Cod hotel',
	'booking_info_id_hotel' => 'Nume hotel',
	'booking_info_room_info' => 'Solutie camere',
	'booking_info_meal_info' => 'Info mese',

	'total' => 'Suma totala (Eur)',
	'total_ron' => 'Suma totala (Ron)',
	'old_total' => 'Pret vechi (Eur)',
	'old_total_ron' => 'Pret vechi (Ron)',
	'advance_total' => 'Avans (Eur)',
	'advance_total_ron' => 'Avans (Ron)',
	'pay_amount' => 'Alegere plata',
	'currency_to_ron' => 'Curs EUR/RON',
	'pay_currency' => 'Moneda plata',

	'payment' => 'Tip plata',
	'payment_bank' => 'Sistem rate',
	'installments' => 'Nr rate',
	'id_agency' => 'Agentie',

	'status' => 'Status rezervare',
	'payment_status' => 'Status plata',
	'error_message' => 'Mesaj plata procesator',

	'obs' => 'Observatii rezervare'
);

if($_SESSION[$_site_title]['cms']['search']['bookings']){
	foreach($_SESSION[$_site_title]['cms']['search']['bookings'] as $field => $value){
		$where .= " AND ".$field." LIKE '%".$value."%'";
	}
}
if($_SESSION[$_site_title]['cms']['filter']['bookings']){
	foreach($_SESSION[$_site_title]['cms']['filter']['bookings'] as $field => $value){
		$where .= " AND ".$field." = '".$value."'";
	}
}

$bookings = db_query('SELECT * FROM booking WHERE trash = 0 '.$where.' ORDER BY id_booking DESC');

foreach($fields as $key => $value){
	echo '"'.$value.'";';
}
echo "\n";

foreach($bookings as $booking){
	$search_data = json_decode($booking['search_data'], true);
	$selected_data = json_decode($booking['selected_data'], true);

	foreach($fields as $key => $value){
		if($key == "id_agency"){
			if($booking[$key] > 0){
				$agency = db_row('SELECT * FROM agency WHERE id_agency = ?', $booking[$key]);
				echo '"'.$agency['title'].'";';
			}else{
				echo '"";';
			}
		}elseif(str_like('booking_info%', $key)){
			switch($key){
				case 'booking_info_country': {
					$country = db_row('SELECT * FROM country WHERE code = ?', $search_data['country']);
					echo '"'.$country['title'].'";';
				}break;
				case 'booking_info_city': {
					$city = db_row('SELECT * FROM city WHERE code = ?', $search_data['city']);
					echo '"'.$city['title'].'";';
				}break;
				case 'booking_info_check_in': {
					echo '"'.$selected_data['check_in'].'";';
				}break;
				case 'booking_info_check_out': {
					echo '"'.$selected_data['check_out'].'";';
				}break;
				case 'booking_info_rooms': {
					echo '"'.$search_data['rooms'].'";';
				}break;
				case 'booking_info_circuit_id': {
					echo '"'.$selected_data['circuit_id'].'";';
				}break;
				case 'booking_info_id_circuit': {
					$circuit = db_row('SELECT * FROM circuit WHERE id_circuit = ?', $selected_data['id_circuit']);
					echo '"'.$circuit['title'].'";';
				}break;
				case 'booking_info_id_city_from': {
					$city = db_row('SELECT * FROM city WHERE id_city = ?', $selected_data['id_city_from']);
					echo '"'.$city['title'].'";';
				}break;
				case 'booking_info_hotel_code': {
					echo '"'.$selected_data['hotel_code'].'";';
				}break;
				case 'booking_info_id_hotel': {
					$hotel = db_row('SELECT * FROM hotel WHERE id_hotel = ?', $selected_data['id_hotel']);
					echo '"'.$hotel['title'].'";';
				}break;
				case 'booking_info_room_info': {
					echo '"'.strip_tags($selected_data['room_info']).'";';
				}break;
				case 'booking_info_meal_info': {
					echo '"'.strip_tags($selected_data['meal_info']).'";';
				}break;
			}

		}else{
			echo '"'.$booking[$key].'";';
		}
	}
	echo "\n";

}
