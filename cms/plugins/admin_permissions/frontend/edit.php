<? global $_sections, $_actions, $_actions_txt;?>
<? $permissions = json_decode($_record['row']['permission'], true); ?>

<?
$all_actions = $actions_section = array();

foreach($_actions as $action){
	$all_actions[$action] = false;
}

foreach($_sections as $_sect){
    foreach($_sect['modules'] as $key => $val){
    	include $_base_path_cms.'modules/'.$key.'/config.php';
		if(file_exists($_base_path_cms . 'modules/' . $key . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $key . '/extra/config.php';
		}
		
		$_section['actions'] = array('view');
		if($_section['use_add']) $_section['actions'][] = "add";
		if($_section['use_edit']) $_section['actions'][] = "edit";
		if($_section['use_delete']) $_section['actions'][] = "delete";
		if($_section['use_order']) $_section['actions'][] = "order";
		
		if($_section['custom_actions']){
			foreach($_section['custom_actions'] as $action){
				$_section['actions'][] = $action;
			}
		}
		
		$actions_section[$key] = $_section['actions'];
		
		foreach($_actions as $action){
			if(in_array($action, $_section['actions'])){
				$all_actions[$action] = true;
			}
		}
	}
}
?>
		
<div class="
	form-group
	<? if(isset($_POST[$field['id'].'_'.$lng])){?> 
		<? if($_form->error($field['id'].'_'.$lng) != ""){?>
			has-error
		<? }?>
	<? }?>">
	
	<label class="col-md-2 control-label" for="<?=$field['id'].'_'.$lng?>">
		<i class="fa fa-cogs"></i>
		<?=$field['name']?>
    	<span class="required">*</span>
	</label>
    	
    <div class="col-md-10">	
    	<table class="table mb-none table-hover table-striped">
    		<? foreach($_sections as $_sect){?>
    			<tr>
    				<td><b><?=$_sect['name']?></b></td>
    				<? foreach($all_actions as $action => $allowed){?>
	    				<? if($allowed){?>
	    					<td align="center"><?=$_actions_txt[$action] != "" ? $_actions_txt[$action] : ucfirst($action)?></td>
	    				<? }else{?>
							<td>&nbsp;</td>
						<? }?>
	    			<? }?>
    			</tr>
    			<? foreach($_sect['modules'] as $key => $val){?>
    				<tr id="<?=$key?>">
    					<td>&nbsp;&nbsp;&nbsp;<?=$val['name']?></td>
    					<? foreach($_actions as $action){?>
    						<? if(in_array($action, $actions_section[$key])){?>
    							<td class="text-center">
    								<div class="checkbox-custom checkbox-default" style="display: inline;">
										<input type="checkbox" value="1" class="<?=$action?>" id="<?=$key?>_<?=$action?>" name="<?=$key?>_<?=$action?>" <? if(isset($_POST[$key.'_'.$action]) && $_POST[$key.'_'.$action] == 1){?>checked<? }elseif(in_array($action, $permissions[$key])){?>checked<? }?>>
										<label for="<?=$key?>_<?=$action?>"></label>
									</div>
	    						</td>
    						<? }else{?>
    							<td>&nbsp;</td>
    						<? }?>
    					<? }?>
    					<script type="text/javascript">
				        $(document).ready(function(){
				        	$('#<?=$key?> .view').click(function(){
				        		if(!$(this).is(':checked')){
				        			$('#<?=$key?> input:checkbox').removeAttr('checked');
				        		}
				        	});
				        	$('#<?=$key?> input:checkbox:not(.view)').click(function(){
				        		if($(this).is(':checked')){
				        			$('#<?=$key?> .view').attr('checked', 'checked');
				        		}
				        	});
				        });
				        </script>
    				</tr>
    			<? }?>
    		<? }?>
    	</table>
    	
    	<? if(isset($_POST[$field['id']])){?>
	    	<? if($_form->error($field['id']) != ""){?>
	    		<span class="help-block text-danger"><?=$_form->error($field['id'])?></span>
	    	<? }?>
	    <? }?>
	</div>
</div>