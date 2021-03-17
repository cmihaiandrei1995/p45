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
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "pencil")?>"></i>
			<?=$field['name']?>
			<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-6 col-lg-5">
			<input
	    		type="text"
	    		id="<?=$field['id'].'_'.$lng?>"
	    		name="<?=$field['id'].'_'.$lng?>"
	    		value="<?=(isset($_POST[$field['id'].'_'.$lng]) ? $_POST[$field['id'].'_'.$lng] : htmlentities($_record[$lng][$field['db_name']]))?>"
	    		class="form-control"
	    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
	    		placeholder="<?=($field['placeholder']!="" ? $field['placeholder'] : "ex: Lorem ipsum")?>"
	    		<? if($field['size'] != ""){?>
	    			style="width:<?=$field['size']?>"
	    		<? }?>
	    		<? if($field['do_not_edit']){?>disabled<? }?>
	    	/>

	    	<? if(isset($_POST[$field['id'].'_'.$lng])){?>
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

			console.log($field);
			console.log(rules);

			function updateVisibility() {
				var show = false;
				$.each(rules, function(i, item){
					var subshow = true;
					$.each(item, function(i, subitem){
						console.log('subitem:', subitem);
						console.log('val:', $('#'+subitem.id+'_'+lng).val());
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
						console.log('subshow:', subshow);
					});
					show = show || subshow;
				});
				console.log('show', show);
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
