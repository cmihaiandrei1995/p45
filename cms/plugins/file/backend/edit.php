<?php

create_folders('files');
$dirname = $_base_uploads_path.'files/'.date('Y').'/'.date('n').'/'.date('j').'/';

$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);

if(!$field['do_not_edit']){
	if(isset($_POST['submit']) && $_valid){
		foreach($field['lng'] as $lng){
			foreach($_record[$lng][$field['use_other_table']] as $val){
				$files[$lng][$val['order']]['folder'] = $val['folder'];
				$files[$lng][$val['order']]['file'] = $val['file'];
				$files[$lng][$val['order']]['id'] = $val['id_file'];
			}
			
			for($j=1; $j<=$field['nr']; $j++){
				
				$file_field_name = $field['id'].'_'.$j.'_'.$lng;
				
				if($_FILES[$file_field_name]["size"] != 0) {
					if($files[$lng][$j]['file']!="") {
						db_query('DELETE FROM '.$_section['table'].'_file WHERE id_file = ?', $files[$lng][$j]['id']);
					    
						$file_path = $_base_uploads_path.'files/'.$files[$lng][$j]['folder'].$files[$lng][$j]['file'];
						if(file_exists($file_path)) {
							unlink($file_path);
						}
					}
					
					$ext_break = explode(".", $_FILES[$file_field_name]["name"]);
					$ext = $ext_break[count($ext_break)-1];
								
					$code = activation_code(4);
					$filename = strtolower(generate_name(substr($_FILES[$file_field_name]["name"], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
					
					@move_uploaded_file($_FILES[$file_field_name]["tmp_name"], $dirname.$filename);
					
					if(count($field['lng']) > 1){
						$_insert = 'INSERT INTO '.$_section['table'].'_file SET
							`'.$_section['id'].'` = ?,
							`lng` = "'.$lng.'",
							`order` = ?,
							`folder` = ?,
							`file` = ?';
					}else{
						$_insert = 'INSERT INTO '.$_section['table'].'_file SET
							`'.$_section['id'].'` = ?,
							`order` = ?,
							`folder` = ?,
							`file` = ?';
					}
					db_query($_insert, $_id, $j, date('Y').'/'.date('n').'/'.date('j').'/', $filename);
				}
			}
		}
	}
}