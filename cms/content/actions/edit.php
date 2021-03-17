<form action="" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

	<div class="row">

		<div class="col-md-12 col-lg-12 col-xl-9">

			<section class="panel panel-featured panel-featured-primary">

				<header class="panel-heading">
					<h2 class="panel-title pull-left"><?=_lng('edit')?></h2>
					<? if($_multiple_lang){?>
						<? $lng_keys = array_keys($_website_langs);?>

						<div class="btn-group pull-right">
							<button type="button" class="m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><span><?=$_website_langs[$lng_keys[0]]?></span> <span class="caret"></span></button>
							<ul class="dropdown-menu langtabs" role="menu">
								<? foreach($_website_langs as $lng => $lng_name){?>
									<li class="<? if($lng == $lng_keys[0]){?>active<? }?>"><a href="#" data-lang="<?=$lng?>"><?=$lng_name?></a></li>
								<? }?>
							</ul>
						</div>
					<? }?>
					<div class="clearfix"></div>
				</header>

				<div class="panel-body">

					<?
                    foreach($_fields as $plugin){
                    	if($plugin->hasWidget('edit')){
							$plugin->widget('edit', 'frontend');
						}
					}
					?>

				</div>

			</section>

			<?
		    if($_section['use_seo']){
		    	$seo_plugin->widget('edit', 'frontend');
		    }
		    ?>

		</div>

		<div class="col-md-12 col-lg-12 col-xl-3">
			<section class="panel panel-featured panel-featured-primary panel-fixed">

				<header class="panel-heading">
					<h2 class="panel-title"><?=_lng('publish')?></h2>
				</header>

				<div class="panel-body">

					<?
				    if($_section['use_active']){
				    	$active_plugin->widget('edit', 'frontend');
				    }
				    ?>

	                <?
				    if($_section['use_order']){
				    	$order_plugin->widget('edit', 'frontend');
				    }
				    ?>

					<div class="form-group">
						<label class="col-xs-12 col-md-4 col-lg-2 col-xl-4 control-label" for="inputSuccess"><?=_lng('after_edit')?></label>
						<div class="col-xs-7 col-md-5 col-xl-8">
							<select name="after" id="after" class="form-control select2">
					            <option value="list"><?=_lng('go_to_save')?></option>
				           		<option value="edit" <?=($_GET['edited'] == "1" || $_GET['added'] == "1" ? "selected" : "")?>><?=_lng('go_to_edit')?></option>
				        		<option value="add"><?=_lng('go_to_add')?></option>
					        </select>
						</div>
					</div>

				</div>

				<footer class="panel-footer">
					<div class="row">
						<div class="col-sm-12 text-right">
							<?
							if(check_admin_perm('admin_action', 'view')){
								$rows = db_row('SELECT COUNT(*) AS nr FROM admin_action WHERE id_what = ? AND section = ?', $_record['row'][$_section['id']], $_module);
								if($rows['nr']){?>
									<a class="btn btn-default" href="<?=$_base_cms?>bounce.php?action=search&module=admin_action&do=init&field[0]=admin_action.id_what&search[0]=<?=$_record['row'][$_section['id']]?>&field[1]=admin_action.section&search[1]=<?=$_module?>&redirect_to_module=admin_action" target="_blank">Vezi log</a>
								<? }?>
							<? }?>
							
							<? 
		        			if($_section['use_delete'] && check_admin_perm($_module, 'delete')){
								// check for dependencies
								$allow_delete = 1;
								if(count($_section['dependencies'])){
									foreach($_section['dependencies'] as $dep_table => $dep_id){
										if(is_array($dep_id)){
											foreach($dep_id as $this_tbl => $that_tbl){
												$dep_rows = db_row('SELECT COUNT(1) AS nr_recs FROM '.$dep_table.' WHERE '.$this_tbl.' = '.$_record['row'][$that_tbl]);
												if($dep_rows['nr_recs'] > 0){
													$allow_delete = 0;
												}
											}
										}else{
											$dep_rows = db_row('SELECT COUNT(1) AS nr_recs FROM '.$dep_table.' WHERE '.$dep_id.' = '.$_record['row'][$dep_id]);
											if($dep_rows['nr_recs'] > 0){
												$allow_delete = 0;
											}
										}
									}
								}
		                    }
							?>
							
							<? if($_section['use_delete'] && check_admin_perm($_module, 'delete')){?>
								<? if(!$_trash && $_section['use_trash']){?>
		                    		<a class="btn btn-default <?=($allow_delete ? 'trash-record' : 'delete-restricted inactive')?>" href="#<?=($allow_delete ? "trash-record" : "delete-restricted")?>" data-id="<?=$_record['row'][$_section['id']]?>"><?=_lng('delete')?></a>
		                    	<? }else{?>
		                    		<a class="btn btn-default <?=($allow_delete ? 'delete-record' : 'delete-restricted inactive')?>" href="#<?=($allow_delete ? "delete-record" : "delete-restricted")?>" data-id="<?=$_record['row'][$_section['id']]?>"><?=_lng('delete')?></a>
	                    		<? }?>
							<? }?>
							<button type="submit" name="submit" class="btn btn-primary"><?=_lng('save')?></button>
						</div>
					</div>
				</footer>

			</section>
		</div>
	</div>

</form>

<? include $_base_path_cms . 'content/modules/dialogs.php';?>
