<?php
$_use_routes = false;
$_is_ajax = true;
$_do_not_use_restrict = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

create_folders('images');
$dirname = $_base_uploads_path.'images/'.date('Y').'/'.date('n').'/'.date('j').'/';

// Including the config file
if(isset($_POST['module']) && $_POST['module']!="") {
	if(file_exists($_base_path_cms . 'modules/' . $_POST['module'] . '/config.php')) {
		include $_base_path_cms . 'modules/' . $_POST['module'] . '/config.php';
		if(file_exists($_base_path_cms . 'modules/' . $_POST['module'] . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $_POST['module'] . '/extra/config.php';
		}
	} else {
		exit;
	}
} else {
	exit;
}

$field = $_section['fields'][$_POST['field']];
$lng = $_POST['lng'];
$_id = $_POST['id'];

// get last item, if any
$order = db_row('SELECT * FROM '.$_section['table'].'_img WHERE '.$_section['id'].' = ? ORDER BY `order` DESC LIMIT 1', $_id);
if($order['order'] > 0){
	$j = $order['order'] + 1;
}else{
	$j = 1;
}

if(!empty($_FILES)) {
    $image_field_name = $field['id'].'_'.$lng;

	if($_FILES[$image_field_name]["size"][0] != 0) {
		$ext_break = explode(".", $_FILES[$image_field_name]["name"][0]);
		$ext = $ext_break[count($ext_break)-1];
		$tmp_file = time().".".$ext;
		@move_uploaded_file($_FILES[$image_field_name]["tmp_name"][0], $dirname.$tmp_file);
		list($width, $height, $type, $attr) = getimagesize($dirname.$tmp_file);

		$code = activation_code(4);
		$filename = strtolower(generate_name(substr($_FILES[$image_field_name]["name"][0], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
		$filename_new = strtolower(generate_name(substr($_FILES[$image_field_name]["name"][0], 0, (-1)*strlen($ext)-1))."-".$code);

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
			$_insert = 'INSERT INTO '.$_section['table'].'_img SET
				`'.$_section['id'].'` = ?,
				`lng` = "'.$lng.'",
				`order` = ?,
				`folder` = ?,
				`active` = 0,
				`image` = ?';
		}else{
			$_insert = 'INSERT INTO '.$_section['table'].'_img SET
				`'.$_section['id'].'` = ?,
				`order` = ?,
				`folder` = ?,
				`active` = 0,
				`image` = ?';
		}
		$id_img = db_query($_insert, $_id, $j, date('Y').'/'.date('n').'/'.date('j').'/', $filename);
	}

	$max_width = $max_height = 0;
	$min_width = 10000;
	foreach($field['sizes'] as $key => $size){
		if($size['width'] > $max_width && $size['width'] != 'auto') {
			$max_width = $size['width'];
			$size_big = $key;
			if($size['height'] > $max_height && $size['height'] != 'auto') {
				$max_height = $size['height'];
			}
		}
		if($size['width'] < $min_width) {
			$min_width = $size['width'];
			$size_small = $key;
		}
	}

	$small_img = $_base_uploads.'images/'.date('Y').'/'.date('n').'/'.date('j').'/'.$size_small.'-'.$filename;
	$big_img = $_base_uploads.'images/'.date('Y').'/'.date('n').'/'.date('j').'/'.$size_big.'-'.$filename;
	$original_img = $_base_uploads.'images/'.date('Y').'/'.date('n').'/'.date('j').'/'.$filename;
	$path_img = $dirname.$filename;

	if(file_exists($path_img) && $filename != ""){
		list($width, $height, $type, $attr) = getimagesize($path_img);
		$filesize = human_filesize($path_img);
	}

	$response['big_img'] = $big_img;
	$response['small_img'] = $small_img;
	$response['original_img'] = $original_img;
	$response['id_img'] = $id_img;
	$response['width_img'] = $width;
	$response['height_img'] = $height;
	$response['filesize_img'] = $filesize;

	echo json_encode($response);
}

// Close the conn
$_db->close();
