<? 
$_filter_action = "view"; 
include $_base_path_cms . 'content/modules/filters.php';
?>

<section class="panel panel-featured panel-featured-primary">
						
	<header class="panel-heading ph-wiel">
		<div class="panel-actions">
			<p class="pull-left"><b><?=$records_count['nr_recs']?></b> <?=_lng('records')?></p>
			
			<form action="<?=$_base_cms?>bounce.php?&module=<?=$_module?>&action=view_fields" class="pull-right mr-left-10" method="post">
				<div class="btn-group pull-right">
					<button type="button" class="multiselect m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><span><?=_lng('fields')?></span> <span class="caret"></span></button>
					<ul class="multiselect-container fields-select dropdown-menu classic no-bg" role="menu">
						<? foreach ($_section['view'] as $key => $field){ ?>
							<? if($_section['fields'][$field]){?>
								<?
								$field_settings = $_fields[$field]->getViewSettings();
								if($field_settings['is_viewable']){
								?>
									<li class="<? if($lng == $_SESSION[$_site_title]['cms']['lang_rec']){?>active<? }?>">
										<a href="javascript:;">
											<label class="checkbox"><input type="checkbox" name="<?=$field?>" value="1" checked> <?=$_section['fields'][$field]['name']?></label>
										</a>
									</li>
								<? }?>
							<? }?>
						<? }?>
						<? foreach ($_section['fields'] as $key => $field){ ?>
							<? if($_section['fields'][$key]){?>
								<?
								if(!in_array($key, $_section['view'])){
									$field_settings = $_fields[$key]->getViewSettings();
									if($field_settings['is_viewable']){
									?>
										<li class="<? if($lng == $_SESSION[$_site_title]['cms']['lang_rec']){?>active<? }?>">
											<a href="javascript:;">
												<label class="checkbox"><input type="checkbox" name="<?=$key?>" value="1"> <?=$_section['fields'][$key]['name']?></label>
											</a>
										</li>
									<? }?>
								<? }?>
							<? }?>
						<? }?>
						<li>
							<button type="submit" class="mb-xs mt-xs mr-xs btn btn-sm btn-primary mr-left-20"><?=_lng('show')?></button>
						</li>
					</ul>
				</div>
			</form>
			
			<? if($_multiple_lang){?>
				<? $lng_keys = array_keys($_website_langs);?>
				
				<div class="btn-group pull-right">
					<button type="button" class="m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><span><?=$_website_langs[$_SESSION[$_site_title]['cms']['lang_rec']]?></span> <span class="caret"></span></button>
					<ul class="dropdown-menu langtabs classic" role="menu">
						<? foreach($_website_langs as $lng => $lng_name){?>
							<li class="<? if($lng == $_SESSION[$_site_title]['cms']['lang_rec']){?>active<? }?>">
								<a href="<?=$_base_cms?>bounce.php?action=lng_rec&val=<?=$lng?><?=$_add_link?>"><?=$lng_name?></a>
							</li>
						<? }?>
					</ul>
				</div>
			<? }?>
		</div>

		<h2 class="panel-title"><?=$_subtitle?></h2>
	</header>
	
	<div class="panel-body">
		
		<? 
		$_filter_action = "view"; 
		include $_base_path_cms . 'content/modules/filters_set.php';
		?>
			
		<? if(count($records)){?>
			<div class="table-responsive">
				<table class="table mb-none table-hover table-striped" id="checkAll">
					<thead>
						<tr>
							<? if(admin_show_actions($_module)){?>
								<th width="25">
									<div class="checkbox-custom checkbox-default">
										<input type="checkbox" name="titleCheck" id="titleCheck">
										<label for="titleCheck"></label>
									</div>
								</th>
							<? }?>
							
							<th width="45" class="sorting <?=(isset($_SESSION[$_site_title]['cms']['sort'][$_module][$_section['table'].".".$_section['id']]) ? ($_SESSION[$_site_title]['cms']['sort'][$_module][$_section['table'].".".$_section['id']] == "asc" ? '_asc' : '_desc') : '')?>">
								<a href="<?=$_base_cms?>bounce.php?action=sort&module=<?=$_module?>&do=init&sort=<?=$_section['table'].".".$_section['id']?>&how=<? if(!isset($_SESSION[$_site_title]['cms']['sort'][$_module][$_section['table'].".".$_section['id']])) echo "asc"; elseif($_SESSION[$_site_title]['cms']['sort'][$_module][$_section['table'].".".$_section['id']] == "asc") echo "desc"; else echo "asc"?>">ID</a>
							</th>
							
							<? foreach ($_section['view'] as $key => $field){ ?>
								<? if($_section['fields'][$field]){?>
				                	<? 
				                	$field_settings = $_fields[$field]->getViewSettings();
				                	$is_sortable = $field_settings['is_sortable'];
									$sort_field = $_section['table'].(count($_section['fields'][$field]['lng']) > 1 ? '_lng' : '').'.'.$_section['fields'][$field]['db_name'];
				                	?>
					                <? if($field_settings['is_viewable']){?>
										<th style="min-width:100px" class="<?=($is_sortable ? "sorting" : "") . (isset($_SESSION[$_site_title]['cms']['sort'][$_module][$sort_field]) ? ($_SESSION[$_site_title]['cms']['sort'][$_module][$sort_field] == "asc" ? '_asc' : '_desc') : '')?>">
											<? if($is_sortable){?>
											<a href="<?=$_base_cms?>bounce.php?action=sort&module=<?=$_module?>&do=init&sort=<?=$sort_field?>&how=<? if(!isset($_SESSION[$_site_title]['cms']['sort'][$_module][$sort_field])) echo "asc"; elseif($_SESSION[$_site_title]['cms']['sort'][$_module][$sort_field] == "asc") echo "desc"; else echo "asc"?>">
											<? }?>
												<?=$_section['fields'][$field]['name']?>
											<? if($is_sortable){?>
											</a>
											<? }?>
										</th>
									<? }?>
								<? }?>
			                <? }?>
							
							<? if($_section['use_active']){?>
			                	<? if(!$_trash && !$_drafts){?>
			                		<th class="text-center" width="50"><?=_lng('public')?></th>
			                	<? }?>
			                <? }?>
			                
							<? if(admin_show_actions($_module) || has_hooks($_module, 'view', 'buttons')){?>
			                	<th class="text-right" class="view-actions"><?=_lng('actions')?> &nbsp;</th>
			                <? }?>
						</tr>
					</thead>
			        
			        <tbody>
			        	<? foreach ($records as $k => $record) {?>
			        		<tr <? if($k%2 == 0){?>class="odd"<? }?>>
			        			
			        			<? 
			        			if($_section['use_delete'] && check_admin_perm($_module, 'delete')){
			                    	// check for dependencies
			                    	$allow_delete = 1;
			                    	if(count($_section['dependencies'])){
			                    		foreach($_section['dependencies'] as $dep_table => $dep_id){
											if(is_array($dep_id)){
												foreach($dep_id as $this_tbl => $that_tbl){
													$dep_rows = db_row('SELECT COUNT(1) AS nr_recs FROM '.$dep_table.' WHERE '.$this_tbl.' = '.$record[$that_tbl]);
													if($dep_rows['nr_recs'] > 0){
														$allow_delete = 0;
													}
												}
											}else{
												$dep_rows = db_row('SELECT COUNT(1) AS nr_recs FROM '.$dep_table.' WHERE '.$dep_id.' = '.$record[$dep_id]);
												if($dep_rows['nr_recs'] > 0){
													$allow_delete = 0;
												}
											}
			                    		}
			                    	}
			                    }
								?>
			        			
			        			<? if(admin_show_actions($_module)){?>
				            		<td>
				            			<div class="checkbox-custom checkbox-default">
											<input type="checkbox" value="<?=$record[$_section['id']]?>" name="checkRow" id="titleCheck<?=$k?>" <? if(!$allow_delete){?>disabled<? }?>>
											<label for="titleCheck<?=$k?>"></label>
										</div>
				            		</td>
				            	<? }?>
				            	
				            	<td><?=$record[$_section['id']]?></td>
				            	
				            	<? foreach ($_section['view'] as $key => $field){ ?>
				            		<? if($_section['fields'][$field]){?>
					            		<?
					            		if($_fields[$field]->hasWidget('view')){
					            			if($field_settings['is_viewable']){
												$_fields[$field]->widget('view', 'frontend');
											}
										}else{
											$field_settings = $_fields[$field]->getViewSettings();
						                	if($field_settings['is_viewable']){?>
							                	<td>
							                		<?
													if($_section['use_parent_for_view'] && $record['level'] && $field == "title"){
														?>
														<i class="fa fa-angle-right" style="margin-left:<?=$record['level']*20?>px"></i>
														<?
													}
													?>
													
							                		<?
							                		if(count($_section['fields'][$field]['values'])){
							                			$key = $record[$_section['fields'][$field]['db_name']];
													}
													
													if($_section['fields'][$field]['values'][$key] != ""){
														$value = $_section['fields'][$field]['values'][$key];
							                		}else{
							                			$value = limit_text(strip_tags($record[$_section['fields'][$field]['db_name']]), 100);
							                		}
													
													if($field_settings['view_callback']){
														echo call_user_func_array($field_settings['view_callback'], array($value));
													}elseif($_section['fields'][$field]['view_callback']){
														echo call_user_func_array($_section['fields'][$field]['view_callback'], array($value));
													}else{
														echo $value;
													}
							                		?>
							                	</td>
						                	<? }?>
						                <? }?>
					                <? }?>
				                <? }?>
				                
				                <? if($_section['use_active']){?>
				                	<? if(!$_trash && !$_drafts){?>
					                	<td class="text-center">
					                		<?=($record['active'] ? _lng('yes') : _lng('no'))?>
					                	</td>
				                	<? }?>
				                <? }?>
				            	
				            	<? if(admin_show_actions($_module) || has_hooks($_module, 'view', 'buttons')){?>
					                <td align="right">
					                	<?
					                	// Call hooks pre action
										add_hooks($_module, 'view', 'buttons');
					                	?>
					                	
					                	<? if(!(($_module == "admin_users" || $_module == "admin_groups") && $record[$_section['id']] == 1)){?>
					                		<? if(check_admin_perm($_module, 'edit')){?>
							                	<? if($_section['use_edit']){?>
						                    		<a class="mb-xs mt-xs mr-xs btn btn-info" href="<?=$_base_cms?>?module=<?=$_module?>&action=edit&id=<?=$record[$_section['id']]?><?=$_add_link?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('do_edit')?>"><i class="fa fa-pencil"></i></a>
							                    	<? if($_section['preview']){?>
							                    		<?
							                    		$preview_params = array(
															$_section['preview']['route']
														);
														
														foreach($_section['preview']['params'] as $prm){
															$preview_params[] = $record[$prm];
														}
														
														$preview_link = call_user_func_array('route', $preview_params);
														
														if(isset($_config['site']['preview'])){
															if(is_array($_config['site']['preview']) && count($_website_langs) > 1){
																$lng_prev = $_SESSION[$_site_title]['cms']['lang_rec'];
																$preview_link = str_replace($_base, $_config['site']['preview'][$lng_prev], $preview_link);
															}else{
																$preview_link = str_replace($_base, $_config['site']['preview'], $preview_link);
															}
														}
														
														if($preview_link != ""){?>
							                    			<a class="mb-xs mt-xs mr-xs btn btn-default" href="<?=$preview_link?>?preview" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('Preview')?>"><i class="fa fa-eye"></i></a>
							                    		<? }?>
							                    	<? }?>
							                    <? }?>
							                    <? if(!$_trash && !$_drafts){?>
							                    	<? if(check_admin_perm($_module, 'add') && in_array('add', $_section['actions']) && $_section['use_add']){?>
								                    	<a class="mb-xs mt-xs mr-xs btn btn-default btn-success" href="<?=$_base_cms?>?module=<?=$_module?>&action=edit&id=<?=$record[$_section['id']]?>&duplicate=true<?=$_add_link?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('do_duplicate')?>"><i class="fa fa-plus"></i></a>
							                    	<? }?>
								                    <? if($_section['use_edit'] && $_section['use_active']){?>
								                    	<a class="mb-xs mt-xs mr-xs btn btn-warning" href="<?=$_base_cms?>?module=<?=$_module?>&action=switch&id=<?=$record[$_section['id']]?>&field=active&value=<?=($record['active'] == 1 ? 0 : 1)?><?=$_add_link?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=($record['active'] == 1 ? _lng('deactivate') : _lng('activate'))?>"><i class="fa fa-<?=($record['active'] == 1 ? 'key' : 'lock')?>"></i></a>
								                    <? }?>
							                    <? }?>
							                    <? if($_drafts && $_section['use_drafts']){?>
							                    	<a class="mb-xs mt-xs mr-xs btn btn-warning" href="<?=$_base_cms?>?module=<?=$_module?>&action=undo_draft&id=<?=$record[$_section['id']]?><?=$_add_link?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('do_undo_draft')?>"><i class="fa fa-undo"></i></a>
							                    <? }?>
							               <? }?>
							               <? if(check_admin_perm($_module, 'delete')){?>
							                    <? if($_trash){?>
							                    	<a class="mb-xs mt-xs mr-xs btn btn-success" href="<?=$_base_cms?>?module=<?=$_module?>&action=undo_trash&id=<?=$record[$_section['id']]?><?=$_add_link?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('undo')?>"><i class="fa fa-undo"></i></a>
							                    <? }?>
						                    <? }?>
						                    <? if($_section['use_delete'] && check_admin_perm($_module, 'delete')){?>
						                    	<? if(!$_trash && $_section['use_trash']){?>
						                    		<a class="mb-xs mt-xs mr-xs btn btn-danger <?=($allow_delete ? 'trash-record' : 'delete-restricted inactive')?>" href="#<?=($allow_delete ? "trash-record" : "delete-restricted")?>" data-id="<?=$record[$_section['id']]?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-close"></i></a>
						                    	<? }else{?>
						                    		<a class="mb-xs mt-xs mr-xs btn btn-danger <?=($allow_delete ? 'delete-record' : 'delete-restricted inactive')?>" href="#<?=($allow_delete ? "delete-record" : "delete-restricted")?>" data-id="<?=$record[$_section['id']]?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('delete')?>"><i class="fa fa-close"></i></a>
					                    		<? }?>
						                	<? }?>
					                	<? }?>
					                </td>
				                <? }?>
							</tr>
						<? }?>
					</tbody>
				</table>
			</div>
			
		<? }else{ ?>
			
			<br>
			<p><?=_lng('no_recs_found')?></p>
	    	
		<? }?>
		
	</div>
	
	<? if(count($records)){?>
		<? include $_base_path_cms . 'content/modules/pag_do_ipp.php';?>
	<? }?>
	
</section>

<? include $_base_path_cms . 'content/modules/dialogs.php';?>
