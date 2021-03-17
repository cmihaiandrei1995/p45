<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$id_booking = $_REQUEST['booking'];
$id_passenger = $_REQUEST['insurant'];

$booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $id_booking);
$passengers = db_query('SELECT * FROM booking_passenger WHERE id_booking = ?', $id_booking);
$search_data = json_decode($booking['search_data'], true);
$selected_data = json_decode($booking['selected_data'], true);

foreach($passengers as $i => $p) {
    if($p['id_booking_passenger'] == $id_passenger){
        $insurant = $selected_data['insurance_items'][$i];
        $info = $search_data['insurants'][$i];
        $offer = json_decode($p['city_insurance_offer_id'], true);
        $pdf = $p['remote_pdf_offer'];
    }
}

if($booking && $insurant){

    if($offer && !$pdf){
        $pdf_issue = city_insurance_print_offer($offer['serie'], $offer['numar']);
        if($pdf_issue && !$pdf_issue['error']){
            db_query('UPDATE booking_passenger SET remote_pdf_offer = ? WHERE id_booking_passenger = ?', $pdf_issue['pdf'], $id_passenger);
        }
    }

}

go_away($_SERVER['HTTP_REFERER']);
