<?
$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);

if(count($field['lng']) > 1){
	$_fld_rec = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE `lng` = "'.$_lang_cms_rec.'" AND `'.$_section['id'].'` = '.$record[$_section['id']].' ORDER BY `order` ASC');
}else{
	$_fld_rec = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE `'.$_section['id'].'` = '.$record[$_section['id']].' ORDER BY `order` ASC');
}

?>
<td valign="middle" width="100">
	<? if($_fld_rec) {?>
		<? foreach($_fld_rec as $fl => $file){?>
			<?
			if(is_url($file['file'])){ ?>
				<a class="mb-xs mt-xs mr-xs btn btn-default"
					href="<?=$file['file']?>" target="_blank"
					data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('file')?>">
						<i class="fa fa-file-pdf-o"></i>
				</a>
			<? }else{
				$path_file = $_base_uploads_path.'files/'.$file['folder'].$file['file'];
				
				if(file_exists($path_file) && $file['file'] != ""){ ?>
					<a class="mb-xs mt-xs mr-xs btn btn-default"
						href="<?=$_base_uploads.'files/'.$file['folder'].$file['file']?>" target="_blank"
						data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('file')?> - <?=$file['file']?>">
							<i class="fa fa-file-pdf-o"></i>
					</a>
				<? }
			}
			?>
		<? }?>
	<? }else{ ?>
		0 fisiere
	<? }?>
</td>