<? $i=1; foreach($field['lng'] as $lng){?>
	<?
	$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);
	foreach($_record[$lng][$field['use_other_table']] as $val){
		$images[$lng][$val['order']]['folder'] = $val['folder'];
		$images[$lng][$val['order']]['image'] = $val['image'];
		$images[$lng][$val['order']]['id'] = $val['id_image'];
	}
	?>
	<? for($j=1; $j<=$field['nr']; $j++){?>
		<div id="<?=$field['id'].'_'.$j.'_'.$lng?>_wrapper" class="
			form-group
			<? if(isset($_POST['submit'])){?>
				<? if($_form->error($field['id'].'_'.$j.'_'.$lng) != ""){?>
					has-error
				<? }?>
			<? }?>
			<? if(count($field['lng']) > 1) {?>lng_<?=$lng?><? }?>"
			<? if($i>1 || $field['hidden']){?> style="display:none;"<? }?>>

			<label class="col-md-4 col-lg-2 control-label" for="<?=$field['id'].'_'.$j.'_'.$lng?>">
				<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "image")?>"></i>
				<?=$field['name']?>
				<? if($field['nr'] > 1) echo $j;?>
				<? if($field['required']){?>
		    		<span class="required">*</span>
		    	<? }?>
			</label>

			<div class="col-md-6 col-lg-5">

				<?
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

				if(is_url($images[$lng][$j]['image'])){

					$img = $images[$lng][$j]['image'];
					?>
						<div class="gallery clearfix single">
							<ul>
								<li data-id="<?=$images[$lng][$j]['id']?>">
									<input type="hidden" name="<?=$field['id'].'_'.$j.'_'.$lng?>_id" value="<?=$images[$lng][$j]['id']?>">
									<a href="<?=$img?>" rel="prettyPhoto[1]">
										<img src="<?=$img?>" style="max-width:190px; max-height:190px;">
									</a>
									<div class="actions">
										<a href="<?=$img?>" class="mb-xs mt-xs mr-xs btn btn-default" rel="prettyPhoto[2]" data-toggle="tooltip" data-placement="top" data-original-title="Zoom"><i class="fa fa-search"></i></a><!--
										--><a href="<?=$img?>" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a><!--
										--><a href="#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>" class="mb-xs mt-xs mr-xs btn btn-default delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>" data-id="<?=$images[$lng][$j]['id']?>" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field_id?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delte')?>"><i class="fa fa-trash-o"></i></a>
										<div class="info">
											<?=_lng('resolution')?>: <?=$width?>x<?=$height?><br />
											<?=_lng('size')?>: <?=$filesize?>
										</div>
									</div>
								</li>
							</ul>
						</div>
					<?

				}else{

					$small_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$size_small.'-'.$images[$lng][$j]['image'];
					$big_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$size_big.'-'.$images[$lng][$j]['image'];
					$original_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];
					$path_img = $_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];

					if(!file_exists($_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$size_small.'-'.$images[$lng][$j]['image'])){
						$small_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];
					}
					if(!file_exists($_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$size_big.'-'.$images[$lng][$j]['image'])){
						$big_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];
					}

					if(file_exists($path_img) && $images[$lng][$j]['image'] != ""){
						list($width, $height, $type, $attr) = getimagesize($path_img);
						$filesize = human_filesize($path_img);
						?>
						<div class="gallery clearfix single">
							<ul>
								<li data-id="<?=$images[$lng][$j]['id']?>">
									<input type="hidden" name="<?=$field['id'].'_'.$j.'_'.$lng?>_id" value="<?=$images[$lng][$j]['id']?>">
									<a href="<?=$big_img?>" rel="prettyPhoto[1]">
										<img src="<?=$small_img?>" style="max-width:190px; max-height:190px;">
									</a>
									<div class="actions">
										<a href="<?=$big_img?>" class="mb-xs mt-xs mr-xs btn btn-default" rel="prettyPhoto[2]" data-toggle="tooltip" data-placement="top" data-original-title="Zoom"><i class="fa fa-search"></i></a><!--
										--><a href="<?=$original_img?>" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a><!--
										--><a href="#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>" class="mb-xs mt-xs mr-xs btn btn-default delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>" data-id="<?=$images[$lng][$j]['id']?>" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field_id?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-trash-o"></i></a>
										<div class="info">
											<?=_lng('resolution')?>: <?=$width?>x<?=$height?><br />
											<?=_lng('size')?>: <?=$filesize?>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<?
					}

				}
				?>

				<? if(!$field['do_not_edit']){?>
					<div class="clear">
						<input
							type="file"
							id="<?=$field['id'].'_'.$j.'_'.$lng?>"
				    		name="<?=$field['id'].'_'.$j.'_'.$lng?>"
				    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
				    		style="position: absolute; left: 0px;"
				    		accept="image/*"
						/>

						<script type="text/javascript">
							$(document).ready(function(){
								$("#<?=$field['id'].'_'.$j.'_'.$lng?>").fileinput({
									showUpload: false,
									showPreview: false,
									maxFileCount: 1,
									allowedFileExtensions: ["<?=implode('","', $field['accepted_ext'])?>"],
									allowedFileTypes: ["image"],
									layoutTemplates: {
								        main1: "{preview}\n" +
								        "<div class=\'input-group {class}\'>\n" +
								        "   <div class=\'input-group-btn\'>\n" +
								        "       {browse}\n" +
								        "       {remove}\n" +
								        "   </div>\n" +
								        "   {caption}\n" +
								        "</div>",
								   },
								   removeLabel: "",
								   browseLabel: "<?=_lng('choose_image')?>",
								});
							});
						</script>

						<span class="help-block">
							<?=_lng('accepted_ext')?>: <?=implode(", ", $field['accepted_ext'])?>
							<? if($field['resize']){?>
								<br/>
								<?=_lng('rec_size')?>:
								<?
								$max_width = $max_height = 0;
								foreach($field['sizes'] as $size){
									if($size['width'] > $max_width && $size['width'] != 'auto') {
										$max_width = $size['width'];
										if($size['height'] > $max_height && $size['height'] != 'auto') {
											$max_height = $size['height'];
										}
									}
								}
								?>
								<? if($max_width > 0){?>
									<?=$max_width?>px <?=_lng('width')?>
								<? }?>
								<? if($max_width > 0 && $max_height > 0){?> * <? }?>
								<? if($max_height > 0){?>
									<?=$max_height?>px <?=_lng('height')?>
								<? }?>
							<? }?>
						</span>
					</div>

					<? if(isset($_POST['submit'])){?>
				    	<? if($_form->error($field['id'].'_'.$j.'_'.$lng) != ""){?>
				    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$j.'_'.$lng)?></span>
				    	<? }?>
				    <? }?>
				<? }?>
			</div>
		</div>

		<? include($_base_cms_path.'plugins/image/popup/delete.php')?>

		<?php
			if(!empty($field['show_if'])) {
				$si_rules = $field['show_if'];
				if(!empty($si_rules['id']) && !empty($si_rules)) {
				    $si_rules = array( $si_rules );
				}
				foreach($si_rules as $i => $rule){
					if(!empty($rule['id']) && !empty($rule)) {
					    $si_rules[$i] = array( $rule );
					}
				}
			?>
			<script type="text/javascript">
				jQuery(function($){
					var $field = $('#field_<?=$field_id.'_'.$lng?>_wrapper'),
						lng = '<?=$lng?>',
						rules = <?=json_encode($si_rules)?>,
						comparisons = {
						    '<': function(a, b) { return a < b; },
						    '<=': function(a, b) { return a <= b; },
						    '>': function(a, b) { return a > b; },
						    '>=': function(a, b) { return a >= b; },
						    '===': function(a, b) { return a === b; },
						    '!==': function(a, b) { return a !== b; },
						    '==': function(a, b) { return a == b; },
						    '!=': function(a, b) { return a != b; }
						};

					function updateVisibility() {
						var show = false;
						$.each(rules, function(i, item){
							var subshow = true;
							$.each(item, function(i, subitem){
								switch(subitem.cmp) {
								    case 'IN':
								    case 'NOT IN':
								    case 'NOTIN':
								        if(subitem.value.indexOf($('#'+subitem.id+'_'+lng).val()) === -1) {
								            subshow = false;
								        }
								        if(subitem.cmp.toLowerCase().indexOf('not') !== -1) {
								        	subshow = !subshow;
								        }
								        break;
								    default:
								        if(!comparisons[subitem.cmp]($('#'+subitem.id+'_'+lng).val(), subitem.value)) {
								            subshow = false;
								        }
								        break;
								}
							});
							show = show || subshow;
						});
						if(show) {
						    $field.show();
						} else {
						    $field.hide();
						}
					}

					<?php foreach($si_rules as $item) { ?>
						<?php foreach($item as $subitem) { ?>
							$('#<?=$subitem['id'].'_'.$lng?>').on('change', updateVisibility).change();
						<?php } ?>
					<?php } ?>
				});
			</script>
			<?php } ?>
	<? }?>
<? $i++; }?>
