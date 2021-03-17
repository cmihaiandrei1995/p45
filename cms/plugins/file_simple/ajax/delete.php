<?php
$_use_routes = false;
$_is_ajax = true;
$_do_not_use_restrict = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_GET['id']) && isset($_GET['table']) && isset($_GET['section'])){
	$conf_file = $_base_path_cms.'modules/'.$_GET['section'].'/config.php';
	if(file_exists($conf_file)){
		include $conf_file;
		if(file_exists($_base_path_cms . 'modules/' . $_GET['section'] . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $_GET['section'] . '/extra/config.php';
		}
	}else{
		exit;
	}
	
	$_record = db_row('SELECT * FROM '.$_section['table'].' WHERE '.$_section['id'].' = ?', $_GET['id']);
	
	$field = $_section['fields'][$_GET['field']];
	
	if($_record[$field['db_name']] != ""){
		if($field['folder'] != ""){
			if($field['use_ymd_folder']){
				if(count($field['lng']) > 1){
					$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = '.$_GET['id']);
				}else{
					$_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$_GET['id']);
				}
				$extra_path = $_fld_rec[$field['db_name'].'_path'];
			}else{
				$extra_path = '';
			}

			$file_path = $field['folder'].$extra_path.$_record[$field['db_name']];
		}else{
			$folder = date('Y', strtotime($_record['created'])).'/'.date('n', strtotime($_record['created'])).'/'.date('j', strtotime($_record['created'])).'/';
			$file_path = $_base_uploads_path.'files/'.$folder.$_record[$field['db_name']];
		}
		
		if(file_exists($file_path)) {
			unlink($file_path);
		}
		db_query('UPDATE '.$_section['table'].' SET '.$field['db_name'].' = "", '.$field['db_name'].'_path WHERE '.$_section['id'].' = ?', $_GET['id']);
	}
}

// Close the conn
$_db->close();