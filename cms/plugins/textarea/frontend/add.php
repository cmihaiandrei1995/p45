<? $i=1; foreach($field['lng'] as $lng){?>
	<div id="field_<?=$field_id.'_'.$lng?>"
		class="form-group
		<? if(isset($_POST[$field['id'].'_'.$lng])){?>
			<? if($_form->error($field['id'].'_'.$lng) != ""){?>
				has-error
			<? }?>
		<? }?>
		<? if(count($field['lng']) > 1) {?>lng_<?=$lng?><? }?>"
		<? if($i>1 || $field['hidden']){?> style="display:none;"<? }?>>

		<label class="col-md-4 col-lg-2 control-label" for="<?=$field['id'].'_'.$lng?>">
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "list-ul")?>"></i>
			<?=$field['name']?>
			<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-8 col-lg-10">
			<textarea name="<?=$field['id'].'_'.$lng?>" cols="" rows="10" class="form-control" id="<?=$field['id'].'_'.$lng?>"><?=(isset($_POST[$field['id'].'_'.$lng]) ? $_POST[$field['id'].'_'.$lng] : $field['value'])?></textarea>

	    	<div style="display:none;">
		    	<input
					type="file"
					id="<?=$field['id'].'_'.$lng?>_file"
		    		name="<?=$field['id'].'_'.$lng?>_file"
		    		accept="image/*"
				/>
			</div>

	    	<? if(isset($_POST[$field['id'].'_'.$lng])){?>
		    	<? if($_form->error($field['id'].'_'.$lng) != ""){?>
		    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng)?></span>
		    	<? }?>
		    <? }?>
		</div>

	</div>

	<? if($field['use_wysiwyg']){?>
		<script type="text/javascript">
			$(document).ready(function(){
				tinymce.init({
					// General options
					mode : "exact",
					elements : "<?=$field['id'].'_'.$lng?>",
					theme : "modern",
					skin : "lightgray",
					plugins: [ "advlist autosave charmap code colorpicker contextmenu hr image link lists media paste preview table textcolor textpattern visualchars wordcount" ],

				    toolbar1: "styleselect | fontsizeselect | bold italic underline strikethrough | subscript superscript | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor",
			        toolbar2: "undo redo | cut copy paste pastetext removeformat | outdent indent | hr | table | link unlink image media charmap | code",

					// Options
					extended_valid_elements : "iframe[src|width|height|name|style|align|border|scrollbars],i[class]",
					convert_urls : false,
					image_advtab: true,
					resize: true,
				    menubar: false,
					height : 300,
					width: "99.5%",

                    image_class_list: [
                        {title: 'None', value: ' '},
                        {title: 'Align Left', value: 'img-align-left'},
                        {title: 'Align Right', value: 'img-align-right'},
                        {title: 'Align Center', value: 'img-align-center'},
                    ],

					textpattern_patterns: [
				         {start: '1. ', cmd: 'InsertOrderedList'},
				         {start: '* ', cmd: 'InsertUnorderedList'},
				         {start: '- ', cmd: 'InsertUnorderedList'}
				    ],

                    content_css: '<?=$_base_cms?>assets/stylesheets/editor-styles.css',

					file_browser_callback: function(field_name, url, type, win) {
			            if(type=='image') {
			            	$('#<?=$field['id'].'_'.$lng?>_file').click();
			            	$(window).on('mce_upload_start', function(e, data){
			            		$('#'+field_name).val('');
				            	$('#'+field_name).prop('disabled', true);
				            	$('#'+field_name.replace('inp', 'action')).find('i').removeClass('mce-ico mce-i-browse').addClass('fa fa-spinner fa-spin');
				            });
				            $(window).on('mce_upload_finished', function(e, data){
				            	$('#'+field_name).prop('disabled', false);
				            	$('#'+field_name.replace('inp', 'action')).find('i').removeClass('fa fa-spinner fa-spin').addClass('mce-ico mce-i-browse');
				            	$('#'+field_name).val(data.value);
				            });
			            }
			        },

					// Basic setup
					setup : function(editor) {
						// Make use of tab and shift+tab to indent paragraphs
						editor.on('keydown', function(e) {
							// Firefox uses the e.which event for keypress, while IE and others use e.keyCode, so we look for both
					        if (e.keyCode) code = e.keyCode;
					        else if (e.which) code = e.which;
					        if(code == 9 && !e.altKey && !e.ctrlKey) {
					            // toggle between Indent and Outdent command, depending on if SHIFT is pressed
					            if (e.shiftKey) editor.execCommand('Outdent');
					            else editor.execCommand('Indent');
					            // prevent tab key from leaving editor in some browsers
					            if(e.preventDefault) {
					                e.preventDefault();
					            }
					            return false;
					        }
				      	});
					}
				});

				$("#<?=$field['id'].'_'.$lng?>_file").fileinput({
					maxFileCount: 1,
					allowedFileExtensions: ["jpg", "png", "gif"],
					allowedFileTypes: ["image"],
				    uploadAsync: true,
				    uploadUrl: "<?=$_base_cms?>plugins/textarea/ajax/upload.php",
				    uploadExtraData: {
			        	'field' : '<?=$field['id'].'_'.$lng?>_file',
				    }
				});

				$("#<?=$field['id'].'_'.$lng?>_file").on('fileuploaded', function(event, data, previewId, index) {
					response = data.response;
					$("#<?=$field['id'].'_'.$lng?>_file").val('');
					$(window).trigger('mce_upload_finished', [{value: response.link}]);
				});

				$('#<?=$field['id'].'_'.$lng?>_file').on('change', function(){
					$('#<?=$field['id'].'_'.$lng?>_file').fileinput('upload');
					$(window).trigger('mce_upload_start');
				});
			});
		</script>
	<? }?>

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
			var $field = $('#field_<?=$field_id.'_'.$lng?>'),
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
