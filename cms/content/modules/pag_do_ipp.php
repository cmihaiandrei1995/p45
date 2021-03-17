<div class="panel-footer clearfix">
	<? if(check_admin_perm($_module, 'edit') || check_admin_perm($_module, 'delete')){?>
		<div class="col-md-3 p-none">
			<select class="select2 form-control" name="do_with" id="do_with">
		        <option value=""><?=_lng('with_selected')?></option>
		        <? if($_trash && $_section['use_delete'] && check_admin_perm($_module, 'delete')){?>
		        	<option value="undo_trash"><?=_lng('move_back')?></option>
		        	<option value="delete"><?=_lng('delete_forever')?></option>
		        <? }else{ ?>
			        <? if($_section['use_delete'] && check_admin_perm($_module, 'delete')){?>
			        	<? if($_section['use_trash'] && !$_trash){?>
			        		<option value="trash"><?=_lng('move_to_trash')?></option>
			        	<? }?>
			        	<option value="delete"><?=_lng('delete_forever')?></option>
			        <? }?>
		        <? }?>
		        <? if($_section['use_edit'] && check_admin_perm($_module, 'edit')){?>
		        	<? if(!$_trash && !$_drafts){?>
			        	<? if($_section['use_drafts']){?>
				    		<option value="draft"><?=_lng('set_as_draft')?></option>
				    	<? }?>
				    	<? if($_section['use_active']){?>
				        	<option value="active"><?=_lng('set_as_public')?></option>
				        	<option value="inactive"><?=_lng('set_as_hidden')?></option>
			        	<? }?>
		        	<? }?>
		        	<? if($_drafts && check_admin_perm($_module, 'edit')){ ?>
			    		<option value="undo_draft"><?=_lng('move_back')?></option>
			    	<? }?>
			    	<!--
		        	<? if(!$_trash && check_admin_perm($_module, 'edit')){?>
		        		<option value="edit"><?=_lng('edit_bulk')?></option>
		        	<? }?>
		        	-->
		        <? }?>
		    </select>
		</div>
		<script>
			$(document).ready(function(){
				if($('#do_with option').length == 1){
					$('#do_with').hide();
				}
			});
		</script>
	<? }else{ ?>
		<div class="col-md-6 p-none">&nbsp;</div>
	<? }?>

	<div class="col-md-6">
		<? if(!$_section['do_not_use_pagination']){?>
			<? if($nr_pages > 1){?>
				<? page_navigator()?>
			<? }?>
		<? }?>
	</div>

	<div class="col-md-3 p-none">
		<? if(!$_section['do_not_use_pagination']){?>
			<select name="ippSelector" class="form-control select2" id="ippSelector">
				<? foreach($_ipp_values as $ipp){?>
					<option value="<?=$ipp?>" <?=($_ipp == $ipp ? 'selected' : '')?>><?=$ipp?> <?=_lng('rec_per_page')?></option>
				<? }?>
			</select>
		<? }?>
	</div>
</div>
