<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

$code_service = $_POST['scope'];
$code_zone = $_POST['zone'];

$service = db_row('SELECT * FROM generali_service WHERE code = ?', $code_service);
if($service){
    $destinations = db_query('SELECT * FROM generali_country WHERE active = 1 AND id_generali_country IN (SELECT id_generali_country FROM generali_product_to_country WHERE id_generali_product IN (SELECT id_generali_product FROM generali_product_to_service WHERE id_generali_service = ?)) ORDER BY title ASC', $service['id_generali_service']);
    foreach($destinations as $destination){
        $tmp = explode(',', $destination['area']);
        if(in_array($code_zone, $tmp)){
            if($destination['is_paralela'] == 1){
                $return_paralela[] = array(
                    'id' => $destination['code'],
                    'text' => $destination['title']
                );
            }else{
                $return_simple[] = array(
                    'id' => $destination['code'],
                    'text' => $destination['title']
                );
            }
        }
    }
}

$return = array(
    array(
        'text' => 'Destinatii Paralela 45',
        'children' => $return_paralela
    ),
    array(
        'text' => 'Alte destinatii',
        'children' => $return_simple
    )
);


echo json_encode($return);

// Close the conn
$_db->close();
