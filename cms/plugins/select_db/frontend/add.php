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
			<i class="fa fa-<?=($field['icon'] != "" ? (convert_old_icon($field['icon']) != "" ? convert_old_icon($field['icon']) : $field['icon']) : "tag")?>"></i>
			<?=$field['name']?>
	    	<? if($field['required']){?>
	    		<span class="required">*</span>
	    	<? }?>
		</label>

		<div class="col-md-6 col-lg-10">

		    <? if($field['use_ajax']){?>

	    		<input
	    			type="hidden"
	    			value="<? if(isset($_POST[$field['id'].'_'.$lng])){ echo $_POST[$field['id'].'_'.$lng]; }else{ echo $field['value'];}?>"
	    			name="<?=$field['id'].'_'.$lng?>"
	    			id="<?=$field['id'].'_'.$lng?>"
	    			data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>">

	    		<?
    			if(count($field['add_info'])){
    				$contraint_id = $contraint_field = array();
    				foreach($field['add_info'] as $parents){
    					if(count($_section['fields'][$parents['id']]) && !$parents['not_affected']){
    						$contraint_id[] = $parents['id'];
    						if(count($_section['fields'][$parents['id']]['lng']) == count($field['lng'])){
    							$contraint_field[] = $parents['id'].'_'.$lng;
    						}else{
    							$contraint_field[] = $parents['id'].'_'.$_section['fields'][$parents['id']]['lng'][0];
    						}
    					}
    				}
    			}
	    		?>

	    		<script type="text/javascript">
	    		$(document).ready(function(){
	    			ajax_url = $_base_cms + 'ajax/records.php';

	    			$('#<?=$field['id'].'_'.$lng?>').select2({
				        placeholder: "<?=($field['placeholder']!="" ? $field['placeholder'] : _lng('choose'))?>",
					    minimumInputLength: 3,
						containerCssClass: 'w25',
					    dropdownAutoWidth: true,
					    allowClear: true,
					    ajax: {
					        url: ajax_url,
					        dataType: 'json',
					        type: "GET",
					        data: function (term, page) {
					        	$fld = new Array();
					        	<? foreach($contraint_field as $fld){?>
					        		$fld.push( $('#<?=$fld?>').val() );
					        	<? }?>
					            return {
					            	q: term,
					            	action: 'search',
					            	module: $_module,
									field: '<?=$field['id']?>',
									<? if(count($contraint_field) && count($contraint_id)){?>
									where_field: '<?=json_encode($contraint_id)?>',
									where_value: JSON.stringify($fld),
									<? }?>
					            };
					        },
					        results: function (data) {
					            return {results: data};
					        }
					    },
					    initSelection: function(element, callback) {
					        var id = $(element).val();
					        if (id !== "") {
					            $.ajax(ajax_url, {
					            	dataType: "json",
					            	type: "GET",
					                data: {
					                    action: 'initSelection',
					                    id: id,
						            	module: $_module,
										field: '<?=$field['id']?>',
					                }
					            }).done(function(data) { if(!$.isEmptyObject(data)) callback(data); });
					        }
					    }
					});
	    		});
	    		</script>

	    	<? }else{ ?>

	    		<?
	        	$add_to_fields = array();
				if(count($field['add_info'])){
					foreach($field['add_info'] as $k => $info){
						$add_to_fields[] = 'field'.($k+1);
					}
				}
	        	?>
	        	<select
					name="<?=$field['id'].'_'.$lng?>"
					id="<?=$field['id'].'_'.$lng?>"
					class="form-control select2 w25"
					data-toggle="tooltip" data-placement="left" data-original-title="<?=$field['tooltip']?>">

					<option value="<?=$field['value']?>"><?=($field['placeholder']!="" ? $field['placeholder'] : _lng('choose'))?></option>
					<?
					foreach($this->values as $val){
						$option_disabled = false;
						if(isset($field['max_levels']) && is_numeric($field['max_levels']) && $field['max_levels']>0 && $val['level']>=$field['max_levels']) {
							$option_disabled = true;
						}
						if(isset($field['disable_parents']) && $field['disable_parents'] == true && $val['has_children']) {
							$option_disabled = true;
						}
						if(isset($val['items_count']) && is_numeric($val['items_count']) && $val['items_count']>0) {
							$option_disabled = true;
						}
					?>
			        	<option <?php if($option_disabled) echo 'disabled'; ?>
			        		value="<?=$val[$field['from_id']]?>" <? if(isset($_POST[$field['id'].'_'.$lng]) && $_POST[$field['id'].'_'.$lng] == $val[$field['from_id']]) echo "selected"?>>
			        		<?
			        		$add_to = '';
							if(count($add_to_fields)){
								foreach($add_to_fields as $flds){
									$add_to .= ', '.$val[$flds];
								}
							}
							?>
			        		<?=$val[$field['from_field']] . $add_to?>
			        		<? if($_section['use_trash'] && $val['trash']){?> (<?=_lng('trash')?>) <? }?>
			        		<? if($_section['use_drafts'] && $val['drafts']){?> (<?=_lng('draft')?>) <? }?>
			        	</option>
			        <? }?>
			    </select>

		    <? }?>

			<? if(isset($_POST[$field['id'].'_'.$lng])){?>
		    	<? if($_form->error($field['id'].'_'.$lng) != ""){?>
		    		<span class="help-block text-danger"><?=$_form->error($field['id'].'_'.$lng)?></span>
		    	<? }?>
		    <? }?>
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
	</div>
<? $i++; }?>
