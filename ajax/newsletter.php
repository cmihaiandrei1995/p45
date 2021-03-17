<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../config.php';

// form data
$_fields['email'] = $_REQUEST['email'];
$_fields['name'] = $_REQUEST['name'];
$_fields['surname'] = $_REQUEST['surname'];
$_fields['g-recaptcha-response'] = $_REQUEST['g-recaptcha-response'];

$_rules['email'] = 'trim|required|email';
$_rules['name'] = 'trim';
$_rules['surname'] = 'trim';
$_rules['g-recaptcha-response'] = 'trim';

// validate
$_form = new Validate($_rules, 'request');

$_valid = $_form->check();
if(!$_valid) {
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Va rugam introduceti o adresa de email valida!'
    ));
    exit;
}

if($_valid){
    $_captcha = google_recaptcha_check($_form['g-recaptcha-response']);
    if(!$_captcha){
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Captcha invalid!'
        ));
        exit;
    }
}

nl_subscribe_user($_fields['email'], $_fields['name'], $_fields['surname'], 'Formular general');

echo json_encode(array(
    'status' => 'success',
    'message' => '<b>Felicitari!</b> Te-ai abonat cu succes!'
));

// Close the conn
$_db->close();
