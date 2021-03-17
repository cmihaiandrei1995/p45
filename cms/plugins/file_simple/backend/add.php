<?php

if($field['folder'] != ""){
	$dirname = $field['folder'];
	if($field['use_ymd_folder']){
		create_folders($field['folder']);
		$dirname .= date('Y').'/'.date('n').'/'.date('j').'/';
	}
}else{
	create_folders('files');
	$dirname = $_base_uploads_path.'files/'.date('Y').'/'.date('n').'/'.date('j').'/';
}

if(isset($_POST['submit']) && $_valid){
	foreach($field['lng'] as $lng){
		$file_field_name = $field['id'].'_'.$lng;
		
		if($_FILES[$file_field_name]["size"] != 0) {
			$ext_break = explode(".", $_FILES[$file_field_name]["name"]);
			$ext = $ext_break[count($ext_break)-1];
			
			if($field['use_random']){
				$code = activation_code(4);
				$filename = strtolower(generate_name(substr($_FILES[$file_field_name]["name"], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
			}else{
				$filename = strtolower(generate_name(substr($_FILES[$file_field_name]["name"], 0, (-1)*strlen($ext)-1)).".".$ext);
			}
			
			@move_uploaded_file($_FILES[$file_field_name]["tmp_name"], $dirname.$filename);
			
			if(count($field['lng']) > 1){
				$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = '.$_id);
				
				if($_fld_rec[$_section['id'].'_lng'] != ""){
					$_update = 'UPDATE '.$_section['table'].'_lng SET 
						`'.$field['db_name'].'` = ? ';
						if($field['use_ymd_folder']){
							$_update .= ', `'.$field['db_name'].'_path` = ? ';
						}
					$_update .= 'WHERE `'.$_section['id'].'_lng` = '.$_fld_rec[$_section['id'].'_lng'].' AND `'.$_section['id'].'` = ?';
				}else{
					$_update = 'INSERT INTO '.$_section['table'].'_lng SET 
						`lng` = "'.$lng.'",
						`'.$field['db_name'].'` = ?, ';
						if($field['use_ymd_folder']){
							$_update .= '`'.$field['db_name'].'_path` = ?, ';
						}
						$_update .= '`'.$_section['id'].'` = ?';
				}
			}else{
				$_update = 'UPDATE '.$_section['table'].' SET 
					`'.$field['db_name'].'` = ? ';
						if($field['use_ymd_folder']){
							$_update .= ', `'.$field['db_name'].'_path` = ? ';
						}
					$_update .= 'WHERE `'.$_section['id'].'` = ?';
			}
			
			if($field['use_ymd_folder']){
				db_query($_update, $filename, date('Y').'/'.date('n').'/'.date('j').'/', $_id);
			}else{
				db_query($_update, $filename, $_id);
			}
		}
	}
}