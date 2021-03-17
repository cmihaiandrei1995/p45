<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

$code_service = $_POST['scope'];

$service = db_row('SELECT * FROM generali_service WHERE code = ?', $code_service);
if($service){
    $zones = db_query('SELECT * FROM generali_zone WHERE active = 1 AND id_generali_product IN (SELECT id_generali_product FROM generali_product WHERE active = 1 AND id_generali_product IN (SELECT id_generali_product FROM generali_product_to_service WHERE id_generali_service = ?)) GROUP BY code ORDER BY title DESC', $service['id_generali_service']);
    foreach($zones as $zone){
        $return[] = array(
            'id' => $zone['code'],
            'text' => $zone['title']
        );
    }
}
echo json_encode($return);

// Close the conn
$_db->close();
