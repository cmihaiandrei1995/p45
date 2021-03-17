<?
/**
 * Miscellaneous Functions
 *
 */


/**
 * Returns a formatted system message
 *
 * @param $message The message
 * @param $type Type of message - info / error / warning / succes
 * @param $closable If user can dismiss the message or not - true / false
 *
 * @return The HTML with the message.
 *
 */
function sys_message($message, $type = "info", $closable = true) {
	if(!in_array($type, array("info", "error", "warning", "success"))) {
		$type = "info";
	}

	$relation = array(
		"info" => "info",
		"error" => "danger",
		"success" => "success",
		"warning" => "warning",
	);

	$icons = array(
		"info" => "info",
		"error" => "warning",
		"success" => "check",
		"warning" => "warning",
	);

	return '
	<div class="alert alert-'.$relation[$type].'">
		'.($closable ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' : '').'
		<i class="fa fa-'.$icons[$type].'"></i>&nbsp;&nbsp;&nbsp;
		'.$message.'
	</div>';
}

function add_sys_message($message, $type = "info"){
	global $_site_title, $_config;
	$_SESSION[$_site_title]['cms']['alerts'][] = array(
		'message' => $message,
		'type' => $type
	);
}

function clear_sys_messages(){
	global $_site_title, $_config;
	unset($_SESSION[$_site_title]['cms']['alerts']);
}

function page_navigator(){
	global $nr_pages, $_site_title, $_base_cms;

	if($_GET['pg']) {
		$page = intval($_GET['pg']);
	} else {
		$page = 1;
	}

	$current_page = str_replace("&pg=".$page, "", $_SESSION[$_site_title]['cms']['current_page']);
	?>
	<div class="paging_bs_normal">
		<ul class="pagination">
			<? if($page > 1){?>
				<li class="prev"><a href="<?=$current_page?>" title="<?=_lng('first_page')?>"><span class="fa fa-angle-double-left"></span></a></li>
				<li class="prev"><a href="<?=$current_page?><? if($page > 2) {?>&pg=<?=($page-1)?><? }?>" title="<?=_lng('prev_page')?>"><span class="fa fa-angle-left"></span></a></li>
			<? }?>
			<li class="text">
				<div><?=_lng('page')?></div>
				<input id="pagination" type="text" value="<?=($page > 0 ? $page : 1)?>" data-max="<?=$nr_pages?>" data-currentpage="<?=$current_page?>" class="form-control input-sm" autocomplete="off" />
				<div><?=_lng('of')?> <?=$nr_pages?></div>
			</li>
			<? if($page < $nr_pages){?>
				<li class="next"><a href="<?=$current_page?>&pg=<?=($page+1)?>" title="<?=_lng('next_page')?>"><span class="fa fa-angle-right"></span></a></li>
				<li class="next"><a href="<?=$current_page?>&pg=<?=$nr_pages?>" title="<?=_lng('last_page')?>"><span class="fa fa-angle-double-right"></span></a></li>
			<? }?>
		</ul>
	</div>
	<?
}

function convert_old_icon($icon){
	global $_form_icons_to_fa;

	return $_form_icons_to_fa[$icon];
}

function convert_time2date($time){
	return date('d.m.Y H:i:s', $time);
}

$_enqueued_scripts = $_enqueued_scripts_order = array();

function enqueue_script($name, $url, $page = '', $order = 0) {
	global $_page, $_enqueued_scripts, $_enqueued_scripts_order;
	if(!$_enqueued_scripts[$name] && ($_page == $page || $page == '') ) {
		$_enqueued_scripts[$name] = $url;
		$_enqueued_scripts_order[$name] = $order;
	}
}

function print_enqueued_scripts() {
	global $_page, $_enqueued_scripts, $_enqueued_scripts_order;
	asort($_enqueued_scripts_order);
	foreach($_enqueued_scripts_order as $name => $order) {
?>
		<script type="text/javascript" src="<?php echo $_enqueued_scripts[$name] ?>"></script>
<?php
	}
}