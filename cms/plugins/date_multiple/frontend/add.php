<? $i=1; foreach($field['lng'] as $lng){?>
	<?
    if(isset($_POST[$field['id'].'_'.$lng])){
		if($_POST[$field['id'].'_'.$lng] != ""){
			$tmp = explode(",", $_POST[$field['id'].'_'.$lng]);
			$rec_date = array();
			foreach($tmp as $val){
				$rec_date[] = trim($val);
			}
		}
	}else{
		$rec_date = array();
		if($field['value'] != ""){
			$tmp = explode(",", $field['value']);
			foreach($tmp as $val){
				$rec_date[] = trim($val);
			}
		}
	}
    ?>

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
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "calendar")?>"></i>
			<?=$field['name']?>
			<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-8 col-lg-10">
			<div class="input-group">
				<div id="<?=$field['id'].'_'.$lng?>_div" class="inline-datepicker-div"></div>
				<input
		    		type="text"
		    		id="<?=$field['id'].'_'.$lng?>"
		    		name="<?=$field['id'].'_'.$lng?>"
		    		value=""
		    		class="form-control"
		    		data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>"
		    		placeholder="<?=($field['placeholder']!="" ? $field['placeholder'] : "ex: ".date(($field['js_format'] != "" ? $field['js_format'] : 'd.m.Y')))?>"
		    		autocomplete="off"
		    	/>

				<!--
				<span class="input-group-addon">
					<span class="icon"><i class="calendar-trigger fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "calendar")?>"></i></span>
				</span>
				-->
			</div>

	    	<? if(isset($_POST[$field['id'].'_'.$lng])){?>
		    	<? if($_form->error($field['id'].'_'.$lng) != ""){?>
		    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng)?></span>
		    	<? }?>
		    <? }?>
		</div>

	    <script type="text/javascript">
		    $(document).ready(function(){
		    	$("#<?=$field['id'].'_'.$lng?>_div").multiDatesPicker({
		    		altField: '#<?=$field['id'].'_'.$lng?>',
		    		<? if(count($rec_date)){?>
					addDates: ['<?=implode("','", $rec_date)?>'],
					<? }?>
		    		firstDay: 1,
					autoSize: true,
					numberOfMonths: [1,3],
					dateFormat: '<?=($field['js_format'] != "" ? $field['js_format'] : 'dd.mm.yy')?>',
					changeMonth: <?=$field['changeMonth']?>,
			      	changeYear: <?=$field['changeYear']?>
				});
				$("#<?=$field['id'].'_'.$lng?>").parent().find('.inputImg').click(function(){
					$("#<?=$field['id'].'_'.$lng?>").trigger('focus');
				});
			});
	    </script>
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
