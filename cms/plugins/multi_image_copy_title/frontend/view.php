<?
$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);

if(count($field['lng']) > 1){
	$_fld_rec = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE `lng` = "'.$_lang_cms_rec.'" AND `'.$_section['id'].'` = '.$record[$_section['id']].' ORDER BY `order` ASC');
}else{
	$_fld_rec = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE `'.$_section['id'].'` = '.$record[$_section['id']].' ORDER BY `order` ASC');
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
	<? if($_fld_rec) {?>
		<? foreach($_fld_rec as $im => $image){?>
			<?
			if(is_url($image['image'])){ ?>
				<div class="post-image <?=($im > 0 ? 'hidden' : '')?>">
					<div class="img-thumbnail">
						<a href="<?=$image['image']?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="<?=$image['image']?>" style="width:50px"></a>
					</div>
				</div>
			<? }else{
				$small_img = $_base_uploads.'images/'.$image['folder'].$size_small.'-'.$image['image'];
				$big_img = $_base_uploads.'images/'.$image['folder'].$size_big.'-'.$image['image'];
				$path_img = $_base_uploads_path.'images/'.$image['folder'].$image['image'];
				if(!file_exists($_base_uploads_path.'images/'.$image['folder'].$size_small.'-'.$image['image'])){
					$small_img = $_base_uploads.'images/'.$image['folder'].$image['image'];
				}
				
				if(file_exists($path_img) && $image['image'] != ""){ ?>
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
		<? }?>
	<? }else{ ?>
		<div class="post-image">
			<div class="img-thumbnail">
				<a href="https://placehold.it/400x200&text=<?=_lng('no_img')?>" rel="prettyPhoto[<?=$field['id']?>_<?=$record[$_section['id']]?>]"><img src="https://placehold.it/50x50&text=X" style="width:50px;height:35px;"></a>		
			</div>
		</div>
	<? }?>
</td>