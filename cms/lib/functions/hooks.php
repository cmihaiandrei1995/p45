<?
function add_hooks($module, $action, $where){
	global $_db, $_base, $_base_path, $_base_cms, $_base_path_cms, $_base_uploads, $_base_uploads_path, $_lang_cms, $_lang_cms_rec;
	global $_module, $_section, $_form, $_valid, $_id, $_messages, $record;

	if(file_exists($_base_path_cms . 'modules/' . $module . '/hook.' . $action . '.' . $where . '.php')) {
		include $_base_path_cms . 'modules/' . $module . '/hook.' . $action . '.' . $where . '.php';
	}
	if($action != "view"){
		if(file_exists($_base_path_cms . 'modules/' . $module . '/hook.all.' . $where . '.php')) {
			include $_base_path_cms . 'modules/' . $module . '/hook.all.' . $where . '.php';
		}
	}

	if(file_exists($_base_path_cms . 'modules/' . $module . '/extra/hook.' . $action . '.' . $where . '.php')) {
		include $_base_path_cms . 'modules/' . $module . '/extra/hook.' . $action . '.' . $where . '.php';
	}
	if($action != "view"){
		if(file_exists($_base_path_cms . 'modules/' . $module . '/extra/hook.all.' . $where . '.php')) {
			include $_base_path_cms . 'modules/' . $module . '/extra/hook.all.' . $where . '.php';
		}
	}
}

function has_hooks($module, $action, $where){
	global $_base_path_cms;

	if(file_exists($_base_path_cms . 'modules/' . $module . '/hook.' . $action . '.' . $where . '.php') || file_exists($_base_path_cms . 'modules/' . $module . '/extra/hook.' . $action . '.' . $where . '.php')) {
		return true;
	}
	if($action != "view"){
		if(file_exists($_base_path_cms . 'modules/' . $module . '/hook.all.' . $where . '.php') || file_exists($_base_path_cms . 'modules/' . $module . '/extra/hook.all.' . $where . '.php')) {
			return true;
		}
	}

	return false;
}
