<div class="row">
	<?
	$search_options = 0;
	foreach($_section['fields'] as $key => $field){
		if($_fields[$key]->view_settings['is_searchable']) $search_options++;
	}

	if($search_options > 0){
	?>
		<div class="col-lg-6 col-md-12">
			<form action="<?=$_base_cms?>bounce.php?action=search<?=($_filter_action != "view" ? "_".$_filter_action : "")?>&module=<?=$_module?>&do=init&redirect_to_action=<?=$_action?>" method="post">
				<section class="panel panel-horizontal">
					<header class="panel-heading bg-primary pt-xs pb-xs pl-sm pr-sm min-width110">
						<?=_lng('search')?>
					</header>
					<div class="panel-body p-sm">
						<div class="widget-summary widget-summary-xs">
							<div class="widget-summary-col">
								<div class="col-md-5 wsc-form-group">
									<input name="search" type="search" class="form-control" placeholder="<?=_lng('search')?>...">
								</div>
								<div class="col-md-5 col-xl-5 wsc-form-group">
									<select class="form-control populate select2" name="field">
										<option value="<?=$_section['table'].'.'.$_section['id']?>"><?=_lng('in')?> ID</option>
										<? foreach ($_section['fields'] as $key => $field){ ?>
					                        <? if($_fields[$key]->view_settings['is_searchable'] && (!$field['hidden'] || $field['hidden_but_searchable'])){?>
					                        	<option value="<?=$_section['table'].(count($_section['fields'][$key]['lng']) > 1 ? '_lng' : '').'.'.$field['db_name']?>"><?=_lng('in')?> <?=$_section['fields'][$key]['name']?></option>
					                        <? }?>
					                    <? }?>
									</select>
								</div>
								<div class="col-md-2 col-xl-2 text-right wsc-form-group">
									<button name="find" type="submit" class="m-none btn btn-danger"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</section>
			</form>
		</div>
	<? }?>

	<?
	$filter_options = 0;
	if($_section['use_active']) $filter_options++;
	foreach ($_section['fields'] as $key => $field){
		if($_fields[$key]->view_settings['is_filtrable']) $filter_options++;
	}

	if($filter_options > 0){
	?>
		<div class="col-lg-6 col-md-12">
			<form action="<?=$_base_cms?>bounce.php?action=filter<?=($_filter_action != "view" ? "_".$_filter_action : "")?>&module=<?=$_module?>&do=init&redirect_to_action=<?=$_action?>" method="post">
				<section class="panel panel-horizontal">
					<header class="panel-heading bg-primary pt-xs pb-xs pl-sm pr-sm min-width110">
						<?=_lng('filter_now')?>
					</header>
					<div class="panel-body p-sm">
						<div class="widget-summary widget-summary-xs">
							<div class="widget-summary-col">
								<div class="col-md-5 col-xl-5 wsc-form-group">
									<select class="form-control populate select2" name="field" id="filter-select">
										<option value=""><?=_lng('filter_for')?>:</option>
					                	<? if($_section['use_active']){?>
					                		<option value="<?=$_section['table']?>.active"><?=_lng('public')?></option>
					                	<? }?>
					                	<? foreach ($_section['fields'] as $key => $field){ ?>
					                        <? if($_fields[$key]->view_settings['is_filtrable'] && (!$field['hidden'] || $field['hidden_but_searchable'])){?>
					                        <option value="<?=$_section['table'].(count($_section['fields'][$key]['lng']) > 1 ? '_lng' : '').'.'.$field['db_name']?>"><?=$_section['fields'][$key]['name']?></option>
					                        <? $_filters++;}?>
					                    <? }?>
									</select>
								</div>
								<div class="col-md-5 col-xl-5 wsc-form-group">
									<input type="hidden" name="value" id="filter-values">
								</div>
								<div class="col-md-2 col-xl-2 text-right wsc-form-group">
									<button type="submit" name="find" class="m-none btn btn-danger"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
				</section>
			</form>
		</div>
	<? }?>
</div>
