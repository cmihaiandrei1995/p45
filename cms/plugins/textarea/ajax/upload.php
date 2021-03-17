<?php
$_use_routes = false;
$_is_ajax = true;
$_do_not_use_restrict = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

create_folders('media');
$dirname = $_base_uploads_path.'media/'.date('Y').'/'.date('n').'/'.date('j').'/';

$image_field_name = $_POST['field'];

if($_FILES[$image_field_name]["size"] != 0) {
	$ext_break = explode(".", $_FILES[$image_field_name]["name"]);
	$ext = $ext_break[count($ext_break)-1];
	$tmp_file = time().".".$ext;
	
	$code = activation_code(4);
	$filename = strtolower(generate_name(substr($_FILES[$image_field_name]["name"], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
	$title = strtolower(generate_name(substr($_FILES[$image_field_name]["name"], 0, (-1)*strlen($ext)-1)));
	
	@move_uploaded_file($_FILES[$image_field_name]["tmp_name"], $dirname.$filename);
	
	db_query('INSERT INTO media SET created = NOW(), title = ?, file = ?, file_path = ?', $title, $filename, date('Y').'/'.date('n').'/'.date('j').'/');
	
	$response['link'] = $_base_uploads.'media/'.date('Y').'/'.date('n').'/'.date('j').'/'.$filename;

	echo json_encode($response);
}
	