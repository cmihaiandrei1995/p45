<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

// form data
$voucher_code = $_REQUEST['voucher'];
$booking_info = $_SESSION['booking'];

$_rules['voucher'] = 'trim|required';

// validate
$_form = new Validate($_rules, 'request');

$_valid = $_form->check();
if(!$_valid) {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Va rugam scrieti codul voucherului'
    ));
    exit;
}

$voucher = validate_voucher($voucher_code, $booking_info);
if($voucher['error']){
    echo json_encode(array(
        'status' => 'error',
        'message' => $voucher['message']
    ));
}else{
    echo json_encode(array(
        'status' => 'success',
        'discount' => $voucher['value']
    ));
}

// Close the conn
$_db->close();
