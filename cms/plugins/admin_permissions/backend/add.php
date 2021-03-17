<?
if(isset($_POST['submit']) && $_valid){
	foreach($_sections as $_sect){
		foreach($_sect['modules'] as $key => $val){
			include $_base_path_cms.'modules/'.$key.'/config.php';
			if(file_exists($_base_path_cms . 'modules/' . $key . '/extra/config.php')) {
				include $_base_path_cms . 'modules/' . $key . '/extra/config.php';
			}
			
			$_section['actions'] = array('view');
			if($_section['use_add']) $_section['actions'][] = "add";
			if($_section['use_edit']) $_section['actions'][] = "edit";
			if($_section['use_delete']) $_section['actions'][] = "delete";
			if($_section['use_order']) $_section['actions'][] = "order";
			
			if($_section['custom_actions']){
				foreach($_section['custom_actions'] as $action){
					$_section['actions'][] = $action;
				}
			}
			
			foreach($_section['actions'] as $action){
				if(isset($_POST[$key.'_'.$action]) && $_POST[$key.'_'.$action] == 1){
					$actions[$key][] = $action;	
				}
			}
		}
	}
	
	$_update = 'UPDATE admin_group SET `permission` = ? WHERE `id_admin_group` = ?';
	db_query($_update, json_encode($actions), $_id);
}