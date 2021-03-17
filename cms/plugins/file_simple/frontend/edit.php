<? $i=1; foreach($field['lng'] as $lng){?>
	<div id="<?=$field['id'].'_'.$lng?>_wrapper" class="
		form-group
		<? if(isset($_POST['submit'])){?>
			<? if($_form->error($field['id'].'_'.$lng) != ""){?>
				has-error
			<? }?>
		<? }?>
		<? if(count($field['lng']) > 1) {?>lng_<?=$lng?><? }?>"
		<? if($i>1 || $field['hidden']){?> style="display:none;"<? }?>>

		<label class="col-md-4 col-lg-2 control-label" for="<?=$field['id'].'_'.$lng?>">
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "image")?>"></i>
			<?=$field['name']?>
			<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-6 col-lg-5">

			<?
			if(is_url($_record[$lng][$field['db_name']])){

				$file = $_record[$lng][$field['db_name']];
				?>
					<div class="gallery clearfix single">
						<ul>
							<li data-id="<?=$_record['row'][$_section['id']]?>">
								<img src="<?=$file?>" style="max-width:190px; max-height:190px;">
								<div class="actions">
									<a href="<?=$file?>" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a><!--
									--><a href="#delete-file-<?=$field['id'].'-'.$lng?>" class="mb-xs mt-xs mr-xs btn btn-default delete-file-<?=$field['id'].'-'.$lng?>" data-id="<?=$_record['row'][$_section['id']]?>" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field_id?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-trash-o"></i></a>
									<div class="info">
										<?=_lng('size')?>: <?=$filesize?>
									</div>
								</div>
							</li>
						</ul>
					</div>
				<?

			}else{

				if($field['folder'] != ""){
					if($field['use_ymd_folder']){
						if(count($field['lng']) > 1){
							$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = '.$_id);
						}else{
							$_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$_id);
						}
						$extra_path = $_fld_rec[$field['db_name'].'_path'];
					}else{
						$extra_path = '';
					}

					$path_file = $field['folder'].$extra_path.$_record[$lng][$field['db_name']];
					$file = str_replace($_base_path, $_base, $path_file);
				}else{
					if($field['use_ymd_folder']){
						if(count($field['lng']) > 1){
							$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = '.$_id);
						}else{
							$_fld_rec = db_row('SELECT * FROM '.$_section['table'].' WHERE `'.$_section['id'].'` = '.$_id);
						}
						$folder = $_fld_rec[$field['db_name'].'_path'];
					}else{
						$folder = date('Y', strtotime($_record['row']['created'])).'/'.date('n', strtotime($_record['row']['created'])).'/'.date('j', strtotime($_record['row']['created'])).'/';
					}

					$path_file = $_base_uploads_path.'files/'.$folder.$_record[$lng][$field['db_name']];
					$file = $_base_uploads.'files/'.$folder.$_record[$lng][$field['db_name']];
				}

				if(file_exists($path_file) && $_record[$lng][$field['db_name']] != ""){
					$filesize = human_filesize($path_file);
					?>
					<div class="gallery clearfix single">
						<ul>
							<li data-id="<?=$_record['row'][$_section['id']]?>">
								<a href="<?=$file?>" target="_blank">
									<span class="fa fa-file-o"></span>
								</a>
								<div class="actions">
									<a href="<?=$file?>" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a><!--
									--><a href="#delete-file-<?=$field['id'].'-'.$lng?>" class="mb-xs mt-xs mr-xs btn btn-default delete-file-<?=$field['id'].'-'.$lng?>" data-id="<?=$_record['row'][$_section['id']]?>" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field_id?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-trash-o"></i></a>
									<div class="info">
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
						id="<?=$field['id'].'_'.$lng?>"
			    		name="<?=$field['id'].'_'.$lng?>"
			    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
			    		style="position: absolute; left: 0px;"
			    		accept=".<?=implode(', .', $field['accepted_ext'])?>"
					/>

					<script type="text/javascript">
						$(document).ready(function(){
							$("#<?=$field['id'].'_'.$lng?>").fileinput({
								showUpload: false,
								showPreview: false,
								maxFileCount: 1,
								allowedFileExtensions: ["<?=implode('","', $field['accepted_ext'])?>"],
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
							   browseLabel: "<?=_lng('choose_file')?>",
							});
						});
					</script>

					<span class="help-block">
						<?=_lng('accepted_ext')?>: <?=implode(", ", $field['accepted_ext'])?>
					</span>
				</div>

				<? if(isset($_POST['submit'])){?>
			    	<? if($_form->error($field['id'].'_'.$lng) != ""){?>
			    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng)?></span>
			    	<? }?>
			    <? }?>
		    <? }?>
		</div>
	</div>

	<? include($_base_cms_path.'plugins/file_simple/popup/delete.php')?>

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
			var $field = $('#<?=$field['id'].'_'.$lng?>_wrapper'),
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
<? $i++; }?>
