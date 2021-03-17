<?
$_use_routes = false;
$_is_ajax = false;
require_once dirname(__FILE__) . '/config.php';

$verified = false;
if(isset($_POST['key']) && $_POST['key'] != "" && isset($_POST['params']) && $_POST['params'] != ""){
	if($_POST['key'] == hash_hmac('sha256', $_POST['params'], $_config['api']['password'])){
		$verified = true;
	}
}

if($verified){

	// extract data
	$data = json_decode($_POST['params'], true);
	if($data['table'] != ""){
		// do the query
		list($_items, $_items_count) = get_posts($data);

		// output return
		echo json_encode(array(
			'count' => $_items_count,
			'items' => $_items
		));
	}
}

// Close the conn
$_db->close();
