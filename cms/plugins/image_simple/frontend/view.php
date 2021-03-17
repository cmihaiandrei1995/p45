<?
if(count($field['lng']) > 1){
	$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$_lang_cms_rec.'" AND `'.$_section['id'].'` = '.$record[$_section['id']]);
	$record = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$record[$_section['id']]);
}else{
	$record = $_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$record[$_section['id']]);
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

?>
<td valign="middle" width="50">
	<? if($_fld_rec[$field['db_name']]) {?>
		<?
		if(is_url($_fld_rec[$field['db_name']])){ ?>
			<div class="post-image">
				<div class="img-thumbnail">
					<a href="<?=$_fld_rec[$field['db_name']]?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="<?=$_fld_rec[$field['db_name']]?>" style="width:50px"></a>
				</div>
			</div>
		<? }else{
			
			if($field['folder'] != ""){
				if($field['use_ymd_folder']){
					$extra_path = $_fld_rec[$field['db_name'].'_path'];
				}else{
					$extra_path = '';
				}
				
				$small_img = str_replace($_base_path, $_base, $field['folder'].$extra_path.$size_small.'-'.$_fld_rec[$field['db_name']]);
				$big_img = str_replace($_base_path, $_base, $field['folder'].$extra_path.$size_big.'-'.$_fld_rec[$field['db_name']]);
				$original_img = str_replace($_base_path, $_base, $field['folder'].$extra_path.$_fld_rec[$field['db_name']]);
				$path_img = $field['folder'].$extra_path.$_fld_rec[$field['db_name']];
				
				if(!file_exists($field['folder'].$extra_path.$size_small.'-'.$_fld_rec[$field['db_name']])){
					$small_img = str_replace($_base_path, $_base, $field['folder'].$extra_path.$_fld_rec[$field['db_name']]);
				}
				if(!file_exists($field['folder'].$extra_path.$size_big.'-'.$_fld_rec[$field['db_name']])){
					$big_img = str_replace($_base_path, $_base, $field['folder'].$extra_path.$_fld_rec[$field['db_name']]);
				}
			}else{
				$folder = date('Y', strtotime($record['created'])).'/'.date('n', strtotime($record['created'])).'/'.date('j', strtotime($record['created'])).'/';
				
				$small_img = $_base_uploads.'images/'.$folder.$size_small.'-'.$_fld_rec[$field['db_name']];
				$big_img = $_base_uploads.'images/'.$folder.$size_big.'-'.$_fld_rec[$field['db_name']];
				$original_img = $_base_uploads.'images/'.$folder.$_fld_rec[$field['db_name']];
				$path_img = $_base_uploads_path.'images/'.$folder.$_fld_rec[$field['db_name']];
				
				if(!file_exists($_base_uploads_path.'images/'.$folder.$size_small.'-'.$_fld_rec[$field['db_name']])){
					$small_img = $_base_uploads.'images/'.$folder.$_fld_rec['image'];
				}
				if(!file_exists($_base_uploads_path.'images/'.$folder.$size_big.'-'.$_fld_rec[$field['db_name']])){
					$big_img = $_base_uploads.'images/'.$folder.$_fld_rec['image'];
				}
			}
			
			if(file_exists($path_img) && $_fld_rec[$field['db_name']] != ""){ ?>
				<div class="post-image <?=($im > 0 ? 'hidden' : '')?>">
					<div class="img-thumbnail">
						<a href="<?=$big_img?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="<?=$small_img?>" style="width:50px"></a>
					</div>
				</div>
			<? }else{ ?>
				<div class="post-image <?=($im > 0 ? 'hidden' : '')?>">
					<div class="img-thumbnail">
						<a href="https://placehold.it/400x200&text=<?=_lng('err_img')?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="https://placehold.it/50x50&text=X" style="width:50px;height:35px;"></a>
					</div>
				</div>
			<? }
		}
		?>
	<? }else{ ?>
		<div class="post-image">
			<div class="img-thumbnail">
				<a href="https://placehold.it/400x200&text=<?=_lng('no_img')?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="https://placehold.it/50x50&text=X" style="width:50px;height:35px;"></a>		
			</div>
		</div>
	<? }?>
</td>