<?php

function restrict_cms(){
	global $_site_title, $_page, $_base_cms, $_is_ajax, $_is_cron;
	
	if (!isset($_SESSION[$_site_title]['cms']['username'])) {
		unset($_SESSION[$_site_title]['cms']);
		
		if(isset($_COOKIE[generate_name($_site_title)]["cms"]["username"]) && isset($_COOKIE[generate_name($_site_title)]["cms"]["password"])) {
			$user = $_COOKIE[generate_name($_site_title)]["cms"]["username"];
			$pass = $_COOKIE[generate_name($_site_title)]["cms"]["password"];
		
			$login_usr = db_row("SELECT * FROM admin_user WHERE (username = ? OR email = ?) AND password = ? AND active = 1", $user, $user, $pass);
		
			if($login_usr['id_user']!="") {
				//get group mermissions
				$perms = db_row('SELECT * FROM admin_group WHERE id_admin_group = ?', $login_usr['id_admin_group']);
				
				//start the session
				$_SESSION[$_site_title]['cms']['username'] = $login_usr['username'];
				$_SESSION[$_site_title]['cms']['title'] = $login_usr['title'];
				$_SESSION[$_site_title]['cms']['id_admin_user'] = $login_usr['id_admin_user'];
				$_SESSION[$_site_title]['cms']['id_admin_group'] = $login_usr['id_admin_group'];
				$_SESSION[$_site_title]['cms']['user_group'] = $perms['title'];
				$_SESSION[$_site_title]['cms']['permissions'] = json_decode($perms['permission'], true);
				$_SESSION[$_site_title]['cms']['last_visit'] = $login_usr['last_visit'];
				$_SESSION[$_site_title]['cms']['last_ip'] = $login_usr['last_ip'];
				
				//update users table with last ip and last visit
				$result = db_query("UPDATE admin_user SET last_ip = ?, last_visit = ? WHERE id_admin_user = ?", $_SERVER['REMOTE_ADDR'], date('Y/m/d'), $login_usr['id_admin_user']);
		
				//insert the log record
				$result = db_query("INSERT INTO admin_user_login SET `ip` = ?, `session_id` = ?, `timestamp` = ?, `id_admin_user` = ?", $_SERVER['REMOTE_ADDR'], session_id(), time(), $login_usr['id_admin_user']);
			}else{
				$err_login = 1;
			}
		}else{
			$err_login = 1;
		}
		
		if($err_login){
			if(!$_is_ajax && !$_is_cron){
				$_SESSION[$_site_title]['cms']['redirect_login'] = $_SERVER['REQUEST_URI'];
			}else{
				$_SESSION[$_site_title]['cms']['redirect_login'] = "";
			}
			go_away($_base_cms."?login");
		}
	}
}

function check_admin_perm($section, $action){
	global $_site_title;

	// allow secondary actions to be checked as main actions
	if($action == "switch") $action = "edit";
	if($action == "active") $action = "edit";
	if($action == "inactive") $action = "edit";
	if($action == "draft") $action = "edit";
	if($action == "undo_draft") $action = "edit";
	if($action == "trash") $action = "delete";
	if($action == "undo_trash") $action = "delete";
	
	if($_SESSION[$_site_title]['cms']['id_admin_group'] == 1){
		return true;
	}elseif(in_array($action, $_SESSION[$_site_title]['cms']['permissions'][$section])){
		return true;
	}elseif($section == "admin_users" && $action == "edit" && $_GET['id'] == $_SESSION[$_site_title]['cms']['id_admin_user']){
		return true;
	}else{
		return false;
	}
}

function admin_show_actions($section){
	global $_site_title, $_config;

	if($_SESSION[$_site_title]['cms']['id_admin_group'] == 1){
		if($_config['cms'][$section]['use_active'] || $_config['cms'][$section]['use_trash'] || $_config['cms'][$section]['use_drafts'] || $_config['cms'][$section]['use_edit'] || $_config['cms'][$section]['use_delete']){
			return true;
		}
		return false;
	}elseif(in_array("edit", $_SESSION[$_site_title]['cms']['permissions'][$section]) || in_array("delete", $_SESSION[$_site_title]['cms']['permissions'][$section])){
		return true;
	}else{
		return false;
	}
}

function is_admin(){
	global $_site_title;
	
	if($_SESSION[$_site_title]['cms']['id_admin_group'] == 1){
		return true;
	}else{
		return false;
	}
}
