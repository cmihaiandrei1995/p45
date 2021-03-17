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
			<input
				type="file"
				id="<?=$field['id'].'_'.$lng?>"
	    		name="<?=$field['id'].'_'.$lng?>"
	    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
	    		style="position: absolute; left: 0px;"
	    		accept="image/*"
			/>

			<script type="text/javascript">
				$(document).ready(function(){
					$("#<?=$field['id'].'_'.$lng?>").fileinput({
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

			<? if(isset($_POST['submit'])){?>
		    	<? if($_form->error($field['id'].'_'.$lng) != ""){?>
		    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng)?></span>
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
