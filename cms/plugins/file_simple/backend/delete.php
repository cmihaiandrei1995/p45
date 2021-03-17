<?php

if(isset($_id) && $_id > 0){
	
	// TODO: make multiple languages
	$lng = $field['lng'][0];
	
	if($_record[$lng][$field['db_name']]!="") {
		if($field['folder'] != ""){
			if($field['use_ymd_folder']){
				if(count($field['lng']) > 1){
					$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = '.$_id);
				}else{
					$_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$_id);
				}
				$extra_path = $_fld_rec[$field['db_name'].'_path'];
			}else{
				$extra_path = '';
			}
			$file_path = $field['folder'].$extra_path.$_record[$lng][$field['db_name']];
		}else{
			$folder = date('Y', strtotime($_record[$lng]['row']['created'])).'/'.date('n', strtotime($_record[$lng]['row']['created'])).'/'.date('j', strtotime($_record[$lng]['row']['created'])).'/';
			$file_path = $_base_uploads_path.'files/'.$folder.$_record[$lng][$field['db_name']];
		}
		
		if(file_exists($file_path)) {
			unlink($file_path);
		}
		db_query('UPDATE '.$_section['table'].' SET '.$field['db_name'].' = "", '.$field['db_name'].'_path WHERE '.$_section['id'].' = ?', $_id);
	}
}