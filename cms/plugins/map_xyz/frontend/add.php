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

		<label class="col-md-2 control-label" for="<?=$field['id'].'_x_'.$lng?>">
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "pencil")?>"></i>
			<?=$field['name']?>
			<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-10">

			<div class="row">

				<div class="col-sm-2">
					<input
			    		type="text"
			    		id="<?=$field['id'].'_x_'.$lng?>"
			    		name="<?=$field['id'].'_x_'.$lng?>"
			    		value="<?=(isset($_POST[$field['id'].'_x_'.$lng]) ? $_POST[$field['id'].'_x_'.$lng] : '')?>"
			    		class="form-control"
			    		placeholder="ex: 41.32342342"
			    		data-toggle="tooltip" data-placement="left" data-original-title="Coordonata X"
			    	/>
			    	<? if(isset($_POST[$field['id'].'_x_'.$lng])){?>
				    	<? if($_form->error($field['id'].'_x_'.$lng) != ""){?>
				    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_x_'.$lng)?></span>
				    	<? }?>
				    <? }?>
				</div>
				<div class="visible-xs mb-md"></div>

				<div class="col-sm-2">
					<input
			    		type="text"
			    		id="<?=$field['id'].'_y_'.$lng?>"
			    		name="<?=$field['id'].'_y_'.$lng?>"
			    		value="<?=(isset($_POST[$field['id'].'_y_'.$lng]) ? $_POST[$field['id'].'_y_'.$lng] : '')?>"
			    		class="form-control"
			    		placeholder="ex: 22.23425435"
			    		data-toggle="tooltip" data-placement="left" data-original-title="Coordonata Y"
			    	/>
			    	<? if(isset($_POST[$field['id'].'_y_'.$lng])){?>
				    	<? if($_form->error($field['id'].'_y_'.$lng) != ""){?>
				    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_y_'.$lng)?></span>
				    	<? }?>
				    <? }?>
				</div>
				<div class="visible-xs mb-md"></div>

				<div class="col-sm-2">
					<input
			    		type="text"
			    		id="<?=$field['id'].'_z_'.$lng?>"
			    		name="<?=$field['id'].'_z_'.$lng?>"
			    		value="<?=(isset($_POST[$field['id'].'_z_'.$lng]) ? $_POST[$field['id'].'_z_'.$lng] : '')?>"
			    		class="form-control"
			    		placeholder="ex: 12"
			    		data-toggle="tooltip" data-placement="left" data-original-title="Nivelul de zoom (1 - 16)"
			    	/>
			    	<? if(isset($_POST[$field['id'].'_z_'.$lng])){?>
				    	<? if($_form->error($field['id'].'_z_'.$lng) != ""){?>
				    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_z_'.$lng)?></span>
				    	<? }?>
				    <? }?>
				</div>

			</div>

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
