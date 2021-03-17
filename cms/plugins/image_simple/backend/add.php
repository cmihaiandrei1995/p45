<?php

if($field['folder'] != ""){
	$dirname = $field['folder'];
	if($field['use_ymd_folder']){
		create_folders($field['folder']);
		$dirname .= date('Y').'/'.date('n').'/'.date('j').'/';
	}
}else{
	create_folders('images');
	$dirname = $_base_uploads_path.'images/'.date('Y').'/'.date('n').'/'.date('j').'/';
}

if(isset($_POST['submit']) && $_valid){
	foreach($field['lng'] as $lng){
		$image_field_name = $field['id'].'_'.$lng;
		
		if($_FILES[$image_field_name]["size"] != 0) {
			$ext_break = explode(".", $_FILES[$image_field_name]["name"]);
			$ext = $ext_break[count($ext_break)-1];
			$tmp_file = time().".".$ext;
			@move_uploaded_file($_FILES[$image_field_name]["tmp_name"], $dirname.$tmp_file);
			list($width, $height, $type, $attr) = getimagesize($dirname.$tmp_file);
						
			$code = activation_code(4);
			$filename = strtolower(generate_name(substr($_FILES[$image_field_name]["name"], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
			$filename_new = strtolower(generate_name(substr($_FILES[$image_field_name]["name"], 0, (-1)*strlen($ext)-1))."-".$code);
			
			@copy($dirname.$tmp_file, $dirname.$filename);
			
			if(count($field['sizes'])){
				foreach($field['sizes'] as $key => $field_val) {
					if($width < $field_val['width']) {
						@copy($dirname.$tmp_file, $dirname.$key.'-'.$filename);
					}else{
						$rand = mt_rand(0,100);
						@copy($dirname.$tmp_file, $dirname.$rand.$filename);
						$resized = new upload($dirname.$rand.$filename);
						if ($resized->uploaded) {
							$resized->file_new_name_body = $key.'-'.$filename_new;
							$resized->file_name_body_lowercase = true;
							$resized->jpeg_quality = 60;
							
							if(count($field['watermark'])){
								$resized->image_watermark = $field['watermark']['image'];
								$resized->image_watermark_x = $field['watermark']['poz_x'];
								$resized->image_watermark_y = $field['watermark']['poz_y'];
							}else{
								$resized->image_watermark = '';
							}
							
							$resized->file_safe_name = false;
							$resized->image_resize = true;
							
							if($field_val['height'] == "auto") {
								$resized->image_x = $field_val['width'];
								$resized->image_ratio_y = true;
								$resized->image_ratio_crop = false;
							}elseif($field_val['width'] == "auto")  {
								$resized->image_y = $field_val['height'];
								$resized->image_ratio_x = true;
								$resized->image_ratio_crop = false;
							}else {
								$resized->image_x = $field_val['width'];
								$resized->image_y = $field_val['height'];
								$resized->image_ratio_crop = true;
							}
							
							$resized->process($dirname);
							
							if ($resized->processed) {
								$resized->clean();
							}
						}	
						if(file_exists($dirname.$rand.$filename)){
							@unlink($dirname.$rand.$filename);
						}
					}
				}
			}

			if(file_exists($dirname.$tmp_file)){
				@unlink($dirname.$tmp_file);
			}
							
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
