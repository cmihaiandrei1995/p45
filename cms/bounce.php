<?php
$_use_routes = false;
$_is_cms = true;
$_do_not_use_restrict = true;
require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/settings.php';

crlf_detect($_REQUEST);

// current link hash - page, trash, draft, etc...
$_add_link = "";
if(isset($_REQUEST['pg'])){
	$_add_link .= "&pg=".intval($_REQUEST['pg']);
}
if(isset($_REQUEST['drafts'])){
	$_add_link .= "&drafts=1";
}
if(isset($_REQUEST['trash'])){
	$_add_link .= "&trash=1";
}
if(isset($_REQUEST['redirect_to_action']) && $_REQUEST['redirect_to_action'] != "view"){
	$_add_link .= "&action=".$_REQUEST['redirect_to_action'];
}

$_action = $_REQUEST['action'];

if(isset($_REQUEST['module'])){
	$redirect_to = $_base_cms."?module=".$_REQUEST['module'].$_add_link;
}else{
	$redirect_to = $_SESSION[$_site_title]['cms']['current_page'].$_add_link;
}

$tmp = explode("?", $redirect_to);
$params = explode("&", $tmp[1]);
foreach($params as $param){
	$values = explode("=", $param);
	if($_REQUEST['redirect_to_module'] != "" && $values[0] == "module"){
		$values[1] = $_REQUEST['redirect_to_module'];
	}
	$param = implode("=", $values);
	$new_params[] = $param;
}
$tmp[1] = implode("&", $new_params);
$redirect_to = implode("?", $tmp);

switch($_action){
	// Change cms lang
	case 'lng': {
		if(array_key_exists($_REQUEST['val'], $_cms_langs)){
			$_SESSION[$_site_title]['cms']['lang'] = $_REQUEST['val'];
		}
		go_away($redirect_to);
	}break;

	// Change records lang
	case 'lng_rec': {
		if(array_key_exists($_REQUEST['val'], $_website_langs)){
			$_SESSION[$_site_title]['cms']['lang_rec'] = $_REQUEST['val'];
		}
		go_away($redirect_to.(isset($_REQUEST['where']) ? "&action=".$_REQUEST['where'] : ""));
	}break;

	// Change view fields
	case 'view_fields': {
		$_SESSION[$_site_title]['cms']['view_fields'][$_module] = array();
		foreach($_POST as $key => $val){
			$_SESSION[$_site_title]['cms']['view_fields'][$_module][] = $key;
		}
		go_away($redirect_to);
	}break;

	// Change ipp
	case 'ipp': {
		if(intval($_REQUEST['val']) > 0){
			$_SESSION[$_site_title]['cms']['ipp'] = intval($_REQUEST['val']);
		}
		go_away($redirect_to);
	}break;

	// Init/Delete sort
	case 'sort': {
		switch($_REQUEST['do']){
			case 'init': {
				$_SESSION[$_site_title]['cms']['sort'][$_module][$_REQUEST['sort']] = $_REQUEST['how'];
				go_away($redirect_to);
			}break;
			case 'delete': {
				unset($_SESSION[$_site_title]['cms']['sort'][$_module][$_REQUEST['sort']]);
				go_away($redirect_to);
			}break;
		}
	}break;

	case 'search': {
		switch($_REQUEST['do']){
			case 'init': {
				if(is_array($_REQUEST['search']) && is_array($_REQUEST['field'])){
					foreach($_REQUEST['field'] as $key => $field){
						$_SESSION[$_site_title]['cms']['search'][$_module][$field] = $_REQUEST['search'][$key];
					}
				}else{
					if(trim($_REQUEST['search']) != ""){
						$_SESSION[$_site_title]['cms']['search'][$_module][$_REQUEST['field']] = $_REQUEST['search'];
					}
				}
				go_away($redirect_to);
			}break;
			case 'delete': {
				unset($_SESSION[$_site_title]['cms']['search'][$_module][$_REQUEST['field']]);
				go_away($redirect_to);
			}break;
		}
	}break;

	case 'search_order': {
		$_add_link .= '&action=order';
		switch($_REQUEST['do']){
			case 'init': {
				if(is_array($_REQUEST['search']) && is_array($_REQUEST['field'])){
					foreach($_REQUEST['field'] as $key => $field){
						$_SESSION[$_site_title]['cms']['search_order'][$_module][$field] = $_REQUEST['search'][$key];
					}
				}else{
					if(trim($_REQUEST['search']) != ""){
						$_SESSION[$_site_title]['cms']['search_order'][$_module][$_REQUEST['field']] = $_REQUEST['search'];
					}
				}
				go_away($redirect_to);
			}break;
			case 'delete': {
				unset($_SESSION[$_site_title]['cms']['search_order'][$_module][$_REQUEST['field']]);
				go_away($redirect_to);
			}break;
		}
	}break;

	case 'filter': {
		switch($_REQUEST['do']){
			case 'init': {
				if(is_array($_REQUEST['search']) && is_array($_REQUEST['field'])){
					foreach($_REQUEST['field'] as $key => $field){
						$_SESSION[$_site_title]['cms']['filter'][$_module][$field] = $_REQUEST['value'][$key];
					}
				}else{
					if(trim($_REQUEST['value']) != ""){
						$_SESSION[$_site_title]['cms']['filter'][$_module][$_REQUEST['field']] = $_REQUEST['value'];
					}
				}
				go_away($redirect_to);
			}break;
			case 'delete': {
				unset($_SESSION[$_site_title]['cms']['filter'][$_module][$_REQUEST['field']]);
				go_away($redirect_to);
			}break;
		}
	}break;

	case 'filter_order': {
		$_add_link .= '&action=order';
		switch($_REQUEST['do']){
			case 'init': {
				if(is_array($_REQUEST['search']) && is_array($_REQUEST['field'])){
					foreach($_REQUEST['field'] as $key => $field){
						$_SESSION[$_site_title]['cms']['filter_order'][$_module][$field] = $_REQUEST['value'][$key];
					}
				}else{
					if(trim($_REQUEST['value']) != ""){
						$_SESSION[$_site_title]['cms']['filter_order'][$_module][$_REQUEST['field']] = $_REQUEST['value'];
					}
				}
				go_away($redirect_to);
			}break;
			case 'delete': {
				unset($_SESSION[$_site_title]['cms']['filter_order'][$_module][$_REQUEST['field']]);
				go_away($redirect_to);
			}break;
		}
	}break;

}

// Close the conn
$_db->close();
