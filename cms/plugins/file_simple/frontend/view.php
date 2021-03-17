<?
if($field['folder'] != ""){
	if($field['use_ymd_folder']){
		if(count($field['lng']) > 1){
			$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$_lang_cms_rec.'" AND `'.$_section['id'].'` = '.$record[$_section['id']]);
		}else{
			$_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$record[$_section['id']]);
		}
		$extra_path = $_fld_rec[$field['db_name'].'_path'];
	}else{
		$extra_path = '';
	}
	
	$path_file = $field['folder'].$extra_path.$record[$field['db_name']];
	$file = str_replace($_base_path, $_base, $path_file);
}else{
	$folder = date('Y', strtotime($record['created'])).'/'.date('n', strtotime($record['created'])).'/'.date('j', strtotime($record['created'])).'/';
	$path_file = $_base_uploads_path.'files/'.$folder.$record[$field['db_name']];
	$file = $_base_uploads.'files/'.$folder.$record[$field['db_name']];
}
?>
<td>
	<a href="<?=$file?>" target="_blank"><?=$file?></a>
</td>