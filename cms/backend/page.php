<?php

// Base page action
if(isset($_GET['action'])) {
	$_action = $_GET['action'];
}else{
	$_action = "view";
}

// Including the config file
if(isset($_module) && $_module!="") {
	if(file_exists($_base_path_cms . 'modules/' . $_module . '/config.php')) {
		include $_base_path_cms . 'modules/' . $_module . '/config.php';
		if(file_exists($_base_path_cms . 'modules/' . $_module . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $_module . '/extra/config.php';
		}
	} else {
		go_away($_base_cms);
	}
} else {
	go_away($_base_cms);
}

// fix
$_section['actions'] = array('view');
if($_section['use_add']) $_section['actions'][] = "add";
if($_section['use_edit']) $_section['actions'][] = "edit";
if($_section['use_delete']) $_section['actions'][] = "delete";
if($_section['use_order']) $_section['actions'][] = "order";

// Restrict access to pages and actions
if(!check_admin_perm($_module, $_action)){
	go_away($_base_cms);
}

// Include base action from module if available
if(file_exists($_base_path_cms . 'modules/' . $_module . '/backend/' . $_action . '.php')) {

	include $_base_path_cms . 'modules/' . $_module . '/backend/' . $_action . '.php';

}else{

	// Include default action
	include $_base_path_cms . 'backend/actions/' . $_action . '.php';

	// Main section title
	$_title = $_section['name'];

	// Check preview options and set up new ones if possible
	if(!$_section['preview']){
		$route_to_check = $_section['table'];
		if(count($_website_langs) > 1){
			$lng_prev = $_SESSION[$_site_title]['cms']['lang_rec'];
			if(array_key_exists($_section['table']."-".$lng_prev, $_config['routes'])){
				$route_to_check = $_section['table']."-".$lng_prev;
			}
		}

		if($_config['routes'][$route_to_check]){
			preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|\/\?|)`', $_config['routes'][$route_to_check][1], $lnk_items, PREG_SET_ORDER);

			$params_preview = array();
			if(count($lnk_items) <= 2){
				foreach($lnk_items as $itm){
					if($itm[2] == "*" && $itm[3] == "slug"){
						$params_preview[] = "title";
					}
					if($itm[2] == "i" && $itm[3] == "id"){
						$params_preview[] = $_section['id'];
					}
				}

				if($params_preview){
					$_section['preview']['route'] = $route_to_check;
					$_section['preview']['params'] = $params_preview;
				}
			}
		}
	}
	if(!$_section['preview_list']){
		$route_to_check = $_section['table'].'s';
		if(count($_website_langs) > 1){
			$lng_prev = $_SESSION[$_site_title]['cms']['lang_rec'];
			if(array_key_exists($_section['table']."s-".$lng_prev, $_config['routes'])){
				$route_to_check = $_section['table']."s-".$lng_prev;
			}
		}

		if($_config['routes'][$route_to_check]){
			preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|\/\?|)`', $_config['routes'][$route_to_check][1], $lnk_items, PREG_SET_ORDER);

			if(!count($lnk_items) || (count($lnk_items) == 1 && $lnk_items[0][3] == "page")){
				$_section['preview_list']['route'] = $route_to_check;
			}
		}
	}

	// Get records count
	include $_base_path_cms . 'backend/actions/modules/count.php';

	// Error & success messages
	if($_GET['added'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_added'),
			'type' => 'success'
		);
	}

	if($_GET['edited'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_edited'),
			'type' => 'success'
		);
	}

	if($_GET['deleted'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_deleted'),
			'type' => 'success'
		);
	}


	if($_GET['trashed'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_trashed'),
			'type' => 'success'
		);
	}


	if($_GET['ordered'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_ordered'),
			'type' => 'success'
		);
	}

	if($_GET['drafted'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_drafted'),
			'type' => 'success'
		);
	}

	if($_GET['undo_trash'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_undo_trash'),
			'type' => 'success'
		);
	}

	if($_GET['undo_drafted'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_undo_drafted'),
			'type' => 'success'
		);
	}

	if($_GET['activated'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_activated'),
			'type' => 'success'
		);
	}

	if($_GET['inactivated'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_inactivated'),
			'type' => 'success'
		);
	}

	if($_GET['trashed_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_trashed_all'),
			'type' => 'success'
		);
	}

	if($_GET['undo_trash_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_undo_trash_all'),
			'type' => 'success'
		);
	}

	if($_GET['deleted_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_deleted_all'),
			'type' => 'success'
		);
	}

	if($_GET['drafted_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_drafted_all'),
			'type' => 'success'
		);
	}

	if($_GET['undo_drafted_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_undo_drafted_all'),
			'type' => 'success'
		);
	}

	if($_GET['activated_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_activated_all'),
			'type' => 'success'
		);
	}

	if($_GET['inactivated_all'] == 1){
		$_messages[] = array(
			'message' => _lng('succ_inactivated_all'),
			'type' => 'success'
		);
	}

	if(count($_SESSION[$_site_title]['cms']['alerts'])){
		foreach($_SESSION[$_site_title]['cms']['alerts'] as $alert){
			$_messages[] = $alert;
		}
		clear_sys_messages();
	}





}
