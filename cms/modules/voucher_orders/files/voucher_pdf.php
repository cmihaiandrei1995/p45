<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$order = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', intval($_GET['id']));
if(!$order){
    echo "Order does not exist";
    exit;
}


generate_voucher($order['id_voucher_order']);
