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
			$img_path = $field['folder'].$extra_path.$_record[$field['db_name']];
			
			foreach($field['sizes'] as $key => $field_val) {
				$img_path_other = $field['folder'].$extra_path.$key.'-'.$_record[$field['db_name']];
				if(file_exists($img_path_other)) {
					unlink($img_path_other);
				}
			}
		}else{
			$folder = date('Y', strtotime($_record['created'])).'/'.date('n', strtotime($_record['created'])).'/'.date('j', strtotime($_record['created'])).'/';
			$img_path = $_base_uploads_path.'images/'.$folder.$_record[$field['db_name']];
			
			foreach($field['sizes'] as $key => $field_val) {
				$img_path_other = $_base_uploads_path.'images/'.$folder.$key.'-'.$_record[$field['db_name']];
				if(file_exists($img_path_other)) {
					unlink($img_path_other);
				}
			}
		}
		
		if(file_exists($img_path)) {
			unlink($img_path);
		}
		db_query('UPDATE '.$_section['table'].' SET '.$field['db_name'].' = "", '.$field['db_name'].'_path = "" WHERE '.$_section['id'].' = ?', $_GET['id']);
	}
}

// Close the conn
$_db->close();