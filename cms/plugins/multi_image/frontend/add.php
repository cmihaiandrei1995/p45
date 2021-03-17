<? $i=1; foreach($field['lng'] as $lng){?>
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

	if(isset($_POST[$field['id'].'_'.$lng.'_id'])) {
		$image_id = $_POST[$field['id'].'_'.$lng.'_id'];
	} else {
		$image_id = mt_rand(100, 999).'0'.$i.'0'.mt_rand(100, 999);
	}

	if(isset($_POST['submit'])){
		$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);
		$_record[$lng][$field['use_other_table']] = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE '.$_section['id'].' = '.$image_id.' ORDER BY `order` ASC');

		foreach($_record[$lng][$field['use_other_table']] as $val){
			$images[$lng][$val['order']]['folder'] = $val['folder'];
			$images[$lng][$val['order']]['image'] = $val['image'];
			$images[$lng][$val['order']]['id'] = $val['id_image'];
		}
	}
	include($_base_cms_path.'plugins/multi_image/popup/delete.php');
	?>
	<div id="<?=$field['id'].'_'.$lng?>_wrapper" class="
		form-group
		<? if(isset($_POST['submit'])){?>
			<? if($_form->error($field['id'].'_'.$lng.'_order') != ""){?>
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

		<div class="col-md-6 col-lg-10">
			<div class="gallery single clearfix sortable" id="gal-<?=$field['id'].'_'.$lng?>">
				<ul>
					<? for($j=1; $j<=count($images[$lng]); $j++){?>
						<?
						$small_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$size_small.'-'.$images[$lng][$j]['image'];
						$big_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$size_big.'-'.$images[$lng][$j]['image'];
						$original_img = $_base_uploads.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];
						$path_img = $_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];

						if(file_exists($path_img) && $images[$lng][$j]['image'] != ""){
							list($width, $height, $type, $attr) = getimagesize($path_img);
							$filesize = human_filesize($path_img);
						}
						?>
						<li data-id="<?=$images[$lng][$j]['id']?>">
							<a href="<?=$big_img?>" rel="prettyPhoto[1]">
								<img src="<?=$small_img?>" style="max-width:190px; max-height:190px;">
							</a>
							<div class="actions">
								<a href="<?=$big_img?>" class="mb-xs mt-xs mr-xs btn btn-default" rel="prettyPhoto[2]" data-toggle="tooltip" data-placement="top" data-original-title="Zoom"><i class="fa fa-search"></i></a><!--
								--><a href="<?=$original_img?>" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a><!--
								--><a href="#delete-image" class="mb-xs mt-xs mr-xs btn btn-default delete-image" data-id="<?=$images[$lng][$j]['id']?>" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field_id?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-trash-o"></i></a>
								<div class="info">
									<?=_lng('resolution')?>: <?=$width?>x<?=$height?><br />
									<?=_lng('size')?>: <?=$filesize?>
								</div>
							</div>
						</li>
					<? }?>
				</ul>
			</div>
			<div class="clear"></div>

			<input
				type="hidden"
				id="<?=$field['id'].'_'.$lng?>_order"
	    		name="<?=$field['id'].'_'.$lng?>_order"
	    		value="<?=$_POST[$field['id'].'_'.$lng.'_order']?>"
			/>
			<input
				type="hidden"
				id="<?=$field['id'].'_'.$lng?>_id"
	    		name="<?=$field['id'].'_'.$lng?>_id"
	    		value="<?=$image_id?>"
			/>
			<input
				type="file"
				id="<?=$field['id'].'_'.$lng?>"
	    		name="<?=$field['id'].'_'.$lng?>[]"
	    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
	    		multiple = "true"
	    		class="file-loading"
	    		style="position: absolute; left: 0px;"
	    		accept="image/*"
			/>

			<script type="text/javascript">
				$(document).ready(function(){
					$("#<?=$field['id'].'_'.$lng?>").fileinput({
						//showUpload: false,
						//showPreview: false,
						showRemove: false,
						showCancel: false,
						maxFileCount: <?=$field['nr']?>,
						allowedFileExtensions: ["<?=implode('","', $field['accepted_ext'])?>"],
						allowedFileTypes: ["image"],
						layoutTemplates: {
					        main1: "{preview}\n" +
					        "<div class=\'kv-upload-progress hide\'></div>\n" +
					        "<div class=\'input-group {class}\'>\n" +
					        "   <div class=\'input-group-btn\'>\n" +
					        "       {browse}\n" +
					        "       {upload}\n" +
					        "       {remove}\n" +
					        "   </div>\n" +
					        "   {caption}\n" +
					        "</div>",
					   },
					   browseLabel: "<?=_lng('choose_images')?>",
					   uploadLabel: "",

					   uploadAsync: true,
					   uploadUrl: "<?=$_base_cms?>plugins/multi_image/ajax/upload.php",
					   uploadExtraData: {
					        'id' : '<?=$image_id?>',
				        	'module' : '<?=$_module?>',
				        	'field' : '<?=$field['id']?>',
				        	'lng' : '<?=$lng?>'
					   }
					});

					var counter = 0;
					var selected_files = 0;
					var files_to_upload = 0;
					var uploaded_files = 0;

					// for each finished upload show the image
					$('#<?=$field['id'].'_'.$lng?>').on('fileuploaded', function(event, data, previewId, index) {

						$('#<?=$field['id'].'_'.$lng?>').fileinput('disable');

						uploaded_files++;

						response = data.response;

						// finished one upload
						$('#gal-<?=$field['id'].'_'.$lng?> ul').sortable({
			        		placeholder: "ui-state-highlight",
			        		stop: function() {
						        reorder_images();
						    }
			        	}).disableSelection();

			        	$('#gal-<?=$field['id'].'_'.$lng?>').removeClass('hide');
			        	$('#gal-<?=$field['id'].'_'.$lng?> ul').append(
			        		'<li data-id="' + response.id_img + '">' +
								'<a href="' + response.big_img + '" rel="prettyPhoto[1]">' +
									'<img src="' + response.small_img + '" style="max-width:190px; max-height:190px;">' +
								'</a>' +
								'<div class="actions">' +
									'<a href="' + response.big_img + '" class="mb-xs mt-xs mr-xs btn btn-default" rel="prettyPhoto[2]" data-toggle="tooltip" data-placement="top" data-original-title="Zoom"><i class="fa fa-search"></i></a>' +
									'<a href="' + response.original_img + '" class="mb-xs mt-xs mr-xs btn btn-default" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Download"><i class="fa fa-download"></i></a>' +
									'<a href="#delete-image-<?=$field['id'].'-'.$lng?>" class="mb-xs mt-xs mr-xs btn btn-default delete-image-<?=$field['id'].'-'.$lng?>" data-id="' + response.id_img + '" data-table="<?=$_section['table']?>" data-section="<?=$_module?>" data-field="<?=$field['id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-trash-o"></i></a>' +
									'<div class="info">' +
										'<?=_lng('resolution')?>: ' + response.width_img + 'x' + response.height_img + '<br />' +
										'<?=_lng('size')?>: ' + response.filesize_img +
									'</div>' +
								'</div>' +
							'</li>'
			        	);
			        	reorder_images();

						// finished all uploads
						if(uploaded_files == files_to_upload){
							$('#<?=$field['id'].'_'.$lng?>').fileinput('clear');
							$('#<?=$field['id'].'_'.$lng?>').fileinput('enable');
						}
					});

					// after all files are loaded into the preview (which is hidden) disable the choose file button and start upload
					$('#<?=$field['id'].'_'.$lng?>').on('fileloaded', function(event, file, previewId, index, reader) {
						counter++;

						if(counter == selected_files){
							$('#<?=$field['id'].'_'.$lng?>').fileinput('upload');
							$('#<?=$field['id'].'_'.$lng?>').fileinput('disable');

							files_to_upload = counter;
							counter = selected_files = 0;
						}
					});

					// diable choose file button until upload is finished
					$('#<?=$field['id'].'_'.$lng?>').on('filebatchuploadcomplete', function(event, files, extra) {
						if(uploaded_files != files_to_upload){
							$('#<?=$field['id'].'_'.$lng?>').fileinput('disable');
						}else{
							uploaded_files = 0;
						}
					});

					// get the total number of files to be uploaded
					$('#<?=$field['id'].'_'.$lng?>').on('filebatchselected', function(event, files) {
						selected_files = files.length;
					});

				});

				function reorder_images(){
					$ids = new Array();
					$('#<?=$field['id'].'_'.$lng?>_order').val('');
					$('#gal-<?=$field['id'].'_'.$lng?> ul li').each(function(){
						$ids.push($(this).data('id'));
					});
					$('#<?=$field['id'].'_'.$lng?>_order').val($ids.join(','));

					$("a[rel^='prettyPhoto']").prettyPhoto({
						social_tools: '',
						show_title: false,
						allow_resize: true
					});
				}
			</script>

			<span class="help-block">
				<?=_lng('accepted_ext')?>: <?=implode(", ", $field['accepted_ext'])?>
				<? if($field['resize']){?>
					<br/>
					<?=_lng('rec_size')?>:
					<? if($max_width > 0){?>
						<?=$max_width?>px <?=_lng('width')?>
					<? }?>
					<? if($max_width > 0 && $max_height > 0){?> * <? }?>
					<? if($max_height > 0){?>
						<?=$max_height?>px <?=_lng('height')?>
					<? }?>
				<? }?>
			</span>

			<? if(isset($_POST['submit'])){?>
		    	<? if($_form->error($field['id'].'_'.$lng.'_order') != ""){?>
		    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng.'_order')?></span>
		    	<? }?>
		    <? }?>
		</div>
	</div>

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
<? $i++; }?>
