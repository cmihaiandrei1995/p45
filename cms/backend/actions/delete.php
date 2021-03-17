<?php

// current link hash - page, trash, draft, etc...
$_add_link = "";
if(isset($_GET['pg'])){
	$_add_link .= "&pg=".intval($_GET['pg']);
}
if(isset($_GET['drafts'])){
	$_add_link .= "&drafts=1";
}
if(isset($_GET['trash'])){
	$_add_link .= "&trash=1";
}

if($_REQUEST['id'] != ""){
	// Checking field plugins
	foreach($_section['fields'] as $key => $field){
		// check for multiple languages
		if(count($field['lng']) > 1){
			$_multiple_lang = true;
		}
	}
	
	$tmp_ids = explode(',', $_REQUEST['id']);
	
	foreach($tmp_ids as $_id){
		// Call hooks pre action
		add_hooks($_module, 'delete', 'pre');

		db_query('DELETE FROM '.$_section['table'].' WHERE '.$_section['id'].' = ? ', intval($_id));
		if($_multiple_lang){
			db_query('DELETE FROM '.$_section['table'].'_lng WHERE '.$_section['id'].' = ? ', intval($_id));
		}
		
		// Loading field plugins
		foreach($_section['fields'] as $key => $field){
			// Setting globals and variables (dumping the whole field config array)
			$config = array(
				'globals' => array(
					'_rules', '_form', '_multiple_lang', '_website_langs', '_module',
				),
				'vars' => array('field_id' => $key, 'field' => $field, '_section' => $_section, '_action' => $_action, '_id' => intval($_id))
			);
			
			// Constructing the plugin
			$plugin = new Plugin($field['type'], $config);
			if(!empty($plugin)) $_fields[$key] = $plugin;
			
			if($plugin->hasWidget('delete')){
				$plugin->widget('delete', 'backend');
			}
		}
		
		// Call hooks post action
		add_hooks($_module, 'delete', 'post');
		
		// log action
		admin_log_action($_module, 'delete', $_id);
	}
	
	if(count($tmp_ids) > 1){
		go_away($_base_cms.'?module='.$_module.'&deleted_all=1'.$_add_link);
	}else{
		go_away($_base_cms.'?module='.$_module.'&deleted=1'.$_add_link);
	}
}else{
	go_away($_base_cms.'?module='.$_module.$_add_link);
}