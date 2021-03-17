<?php
/**
 * CMS page
 * Main destination for CMS pages.
 *
 */
?>

<section class="body">

	<? include $_base_path_cms . 'content/section/header.php';?>

	<div class="inner-wrapper">

		<? include $_base_path_cms . 'content/section/left.php';?>

		<section role="main" class="content-body media-gallery">
			<header class="page-header">
				<h2><?=$_title?></h2>

				<div class="right-wrapper pull-right">
					<?
                	// Call hooks pre action
					add_hooks($_module, 'view', 'actions');
                	?>
                	
					<? if(!isset($_GET['popup']) && !$_is_dashboard){ ?>
	            		<? if($_section['use_add'] && check_admin_perm($_module, 'add')){?>
	                		<a href="<?=$_base_cms?>?module=<?=$_module?>&action=add<?=$_extra_add_link?>" title="<?=_lng('do_add')?>" class="mb-xs mt-xs mr-xs btn btn-success"><i class="fa fa-plus"></i> <?=_lng('do_add')?></a>
	                	<? }?>
	                	<? if($_section){?>
	                		<a href="<?=$_base_cms?>?module=<?=$_module?><?=$_extra_view_link?>" title="<?=_lng('view')?>" class="mb-xs mt-xs mr-xs btn btn-info"><i class="fa fa-list-ul"></i> <?=_lng('view')?> <? if($view_count['nr_recs'] != "") {?> (<?=$view_count['nr_recs']?>) <? }?></a>
	                		<? if($_section['preview_list']){?>
		                		<?
								$preview_link = route($_section['preview_list']['route']);
								if(isset($_config['site']['preview'])){
									if(is_array($_config['site']['preview']) && count($_website_langs) > 1){
										$lng_prev = $_SESSION[$_site_title]['cms']['lang_rec'];
										$preview_link = str_replace($_base, $_config['site']['preview'][$lng_prev], $preview_link);
									}else{
										$preview_link = str_replace($_base, $_config['site']['preview'], $preview_link);
									}
								}
								
								if($preview_link != ""){?>
		                			<a href="<?=$preview_link?>?preview" title="<?=_lng('preview')?>" target="_blank" class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-eye"></i> <?=_lng('preview')?></a>
		                		<? }?>
		                	<? }?>
	                	<? }?>
	                	<? if($_section['use_drafts'] && check_admin_perm($_module, 'edit')){?>
	                		<a href="<?=$_base_cms?>?module=<?=$_module?>&drafts=1<?=$_extra_draft_link?>" title="<?=_lng('drafts')?>" class="mb-xs mt-xs mr-xs btn btn-warning"><i class="fa fa-pencil"></i> <?=_lng('drafts')?> <? if($drafts_count['nr_recs'] != "") {?> (<?=$drafts_count['nr_recs']?>) <? }?></a>
	                	<? }?>
	                	<? if($_section['use_trash'] && check_admin_perm($_module, 'delete')){?>
	                		<a href="<?=$_base_cms?>?module=<?=$_module?>&trash=1<?=$_extra_trash_link?>" title="<?=_lng('trash')?>" class="mb-xs mt-xs mr-xs btn btn-danger"><i class="fa fa-trash-o"></i> <?=_lng('trash')?> <? if($trash_count['nr_recs'] != "") {?> (<?=$trash_count['nr_recs']?>) <? }?></a>
	                	<? }?>
	                	<? if($_section['use_order'] && check_admin_perm($_module, 'order')){?>
	                		<a href="<?=$_base_cms?>?module=<?=$_module?>&action=order<?=$_extra_order_link?>" title="<?=_lng('do_order')?>" class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-reorder"></i> <?=_lng('do_order')?></a>
	                	<? }?>
		            <? }?>
				</div>
			</header>

			<!-- start: page -->
			<div class="row">

				<div class="col-md-12 col-lg-12 col-xl-12">
					<? include $_base_path_cms . 'content/modules/alerts.php'?>

				    <?
				    if(file_exists($_base_path_cms . 'modules/' . $_GET['module'] . '/content/' . $_action . '.php')) {
						include $_base_path_cms . 'modules/' . $_GET['module'] . '/content/' . $_action . '.php';
					}else{
						include $_base_path_cms . 'content/actions/' . $_action . '.php';
					}
				    ?>
				</div>
			</div>

			<? if(!isset($_GET['popup'])){ ?>
				<? if(!$_hide_footer_copy){?>
					<p class="text-left text-muted mt-md mb-md">&copy; <a href="<?=$_cms_link?>" target="_blank">Prologue CMS v<?=$_version?></a>. <?=_lng('copyright')?>.</p>
				<? }?>
			<? }?>

			<!-- end: page -->
		</section>

	</div>

</section>
