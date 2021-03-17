<?php

create_folders('files');
$dirname = $_base_uploads_path.'files/'.date('Y').'/'.date('n').'/'.date('j').'/';

if(isset($_POST['submit']) && $_valid){
	foreach($field['lng'] as $lng){
		for($j=1; $j<=$field['nr']; $j++){
			
			$file_field_name = $field['id'].'_'.$j.'_'.$lng;
			
			if($_FILES[$file_field_name]["size"] != 0) {
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