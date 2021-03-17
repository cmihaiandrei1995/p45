<?php
$_use_routes = false;
$_is_ajax = true;
$_do_not_use_restrict = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_GET['id']) && isset($_GET['table']) && isset($_GET['section'])){
	$_record = db_row('SELECT * FROM '.$_GET['table'].'_file WHERE id_file = ?', $_GET['id']);
	
	$conf_file = $_base_path_cms.'modules/'.$_GET['section'].'/config.php';
	if(file_exists($conf_file)){
		include $conf_file;
		if(file_exists($_base_path_cms . 'modules/' . $_GET['section'] . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $_GET['section'] . '/extra/config.php';
		}
	}else{
		exit;
	}
	
	$field = $_section['fields'][$_GET['field']];
	
	if($_record['file'] != ""){
		db_query('DELETE FROM '.$_GET['table'].'_file WHERE id_file = ?', $_GET['id']);
			    
		$file_path = $_base_uploads_path.'files/'.$_record['folder'].$_record['file'];
		if(file_exists($file_path)) {
			unlink($file_path);
		}
	}
}

// Close the conn
$_db->close();