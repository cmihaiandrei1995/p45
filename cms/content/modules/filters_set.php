<?
$search_session = "search";
$filter_session = "filter";
$sort_session = "sort";

if($_filter_action != "view"){
	$search_session .= "_".$_filter_action;
	$filter_session .= "_".$_filter_action;
	$sort_session .= "_".$_filter_action;
}
?>

<div class="row">
			
	<? if(count($_SESSION[$_site_title]['cms'][$search_session][$_module])){ ?>
		<div class="col-lg-6 col-md-12">
			<section class="panel panel-horizontal">
				<header class="panel-heading bg-info pt-xs pb-xs pl-sm pr-sm min-width110">
					<?=_lng('active_search')?>
				</header>
				<div class="panel-body p-sm">
					<div class="widget-summary widget-summary-xs">
						<div class="widget-summary-col">
							<? $i=1; foreach($_SESSION[$_site_title]['cms'][$search_session][$_module] as $filter_field => $search){ ?>
								<? 
								$tmp = explode('.', $filter_field);
								$fld = $tmp[count($tmp)-1];
								?>
								<b><?=($filter_field == $_section['table'].'.'.$_section['id'] ? "ID" : $_section['fields'][$fld]['name'])?></b>: <?=$search?>
								<a href="<?=$_base_cms?>bounce.php?action=<?=$search_session?>&module=<?=$_module?>&do=delete&field=<?=$filter_field?>&redirect_to_action=<?=$_action?>" title="<?=_lng('delete_search')?>">
									<i class="fa fa-close"></i>
								</a>
								<? if($i < count($_SESSION[$_site_title]['cms'][$search_session][$_module])){?>
									<div class="separator"></div>
								<? }?>
							<? $i++;}?>
						</div>
					</div>
				</div>
			</section>
		</div>
	<? }?>
	
	<? if(count($_SESSION[$_site_title]['cms'][$filter_session][$_module])){ ?>
		<div class="col-lg-6 col-md-12">
			<section class="panel panel-horizontal">
				<header class="panel-heading bg-info pt-xs pb-xs pl-sm pr-sm min-width110">
					<?=_lng('active_filter')?>
				</header>
				<div class="panel-body p-sm">
					<div class="widget-summary widget-summary-xs">
						<div class="widget-summary-col">
							<? $i=1; foreach($_SESSION[$_site_title]['cms'][$filter_session][$_module] as $filter_field => $filter){ ?>
								<? 
								$tmp = explode('.', $filter_field);
								$fld = $tmp[count($tmp)-1];
								
								if($_section['use_active'] && $fld == "active"){
									$_section['fields'][$fld]['name'] = "Activ";
									$_section['fields'][$fld]['values'] = array('1' => _lng('yes'), '0' => _lng('no'));
								}
								
								if($_section['fields'][$fld]['use_ajax']){
									$_ajax_action = 'initSelection';
									$_ajax_id = $filter;
									$_ajax_module = $_module;
									$_ajax_field = $fld;
									
									include $_base_cms_path.'ajax/records.php';
									$filter_value = $return_data['text'];
								}else{
									$filter_value = $_section['fields'][$fld]['values'][$filter];
								}
								?>
								<b><?=$_section['fields'][$fld]['name']?></b>: <?=$filter_value?>
								<a href="<?=$_base_cms?>bounce.php?action=<?=$filter_session?>&module=<?=$_module?>&do=delete&field=<?=$filter_field?>&redirect_to_action=<?=$_action?>" title="<?=_lng('delete_filter')?>">
									<i class="fa fa-close"></i>
								</a>
								<? if($i < count($_SESSION[$_site_title]['cms'][$filter_session][$_module])){?>
									<div class="separator"></div>
								<? }?>
							<? $i++;}?>
						</div>
					</div>
				</div>
			</section>
		</div>
	<? }?>
	
</div>

<? if(count($_SESSION[$_site_title]['cms'][$sort_session][$_module])){ ?>
	<div class="row">
		<div class="col-lg-6 col-md-12">
			<section class="panel panel-horizontal">
				<header class="panel-heading bg-info pt-xs pb-xs pl-sm pr-sm min-width110">
					Sortare activa
				</header>
				<div class="panel-body p-sm">
					<div class="widget-summary widget-summary-xs">
						<div class="widget-summary-col">
							<? $i=1; foreach($_SESSION[$_site_title]['cms'][$sort_session][$_module] as $sort => $how){ ?>
								<? $tmp = explode(".", $sort);?>
								<? if($tmp[1] == $_section['id']){?>
									<b>ID</b>: <?=_lng($how)?>
								<? }else{ ?>
									<b><?=$_section['fields'][$tmp[1]]['name']?></b>: <?=_lng($how)?>
								<? }?>
								<a href="<?=$_base_cms?>bounce.php?action=<?=$sort_session?>&module=<?=$_module?>&do=delete&sort=<?=$sort?>&redirect_to_action=<?=$_action?>" title="Sterge sortarea">
									<i class="fa fa-close"></i>
								</a>
								<? if($i < count($_SESSION[$_site_title]['cms'][$sort_session][$_module])){?>
									<div class="separator"></div>
								<? }?>
							<? $i++;}?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<? }?>