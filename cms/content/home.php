<?
/**
 * CMS index page
 *
 */
?>

<section class="body">

	<? include $_base_path_cms . 'content/section/header.php';?>

	<div class="inner-wrapper">

		<? include $_base_path_cms . 'content/section/left.php';?>

		<section role="main" class="content-body">
			<header class="page-header">
				<h2><?=_lng('dashboard')?></h2>
			</header>

			<!-- start: page -->
			<div class="masonry-grid">
				<?
				foreach($_widgets as $k => $widget){
					if(is_dir($_base_cms_path.'widgets/'.$widget.'/') && file_exists($_base_cms_path.'widgets/'.$widget.'/content.php')){
						include $_base_cms_path.'widgets/'.$widget.'/content.php';
					}
				}
				?>
				<div class="grid-sizer col-xs-3"></div>
			</div>

			<div class="clear"></div>

			<? if(!$_hide_footer_copy){?>
				<p class="text-left text-muted mt-md mb-md">&copy; <a href="<?=$_cms_link?>" target="_blank">Prologue CMS v<?=$_version?></a>. <?=_lng('copyright')?>.</p>
			<? }?>

			<? if(debug_mode()){?>
				<? if(!$_disable_updates){?>
					<? if($show_update_notification){?>
						<script>
							$(document).ready(function(){
								new PNotify({
									title: 'Update CMS',
									text: 'O noua versiune <?=$new_version?> este disponibila. Va rugam faceti update folosind <a href="<?=$_base_cms?>update.php" target="_blank" style="color:#fff; text-decoration:underline;"">acest link</a>',
									addclass: 'notification-primary icon-nb',
									icon: 'fa fa-info',
									shadow: true,
									hide: false,
									buttons: {
										closer: true,
										sticker: false
									}
								});
							});
						</script>
					<? }?>
				<? }?>
			<? }?>

			<!-- end: page -->
		</section>
	</div>
</section>
