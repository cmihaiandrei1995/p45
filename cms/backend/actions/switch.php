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

if($_REQUEST['id'] != "" && $_REQUEST['value'] != "" && $_REQUEST['field'] != ""){
	// Call hooks pre action
	add_hooks($_module, 'switch', 'pre');

	db_query('UPDATE '.$_section['table'].' SET `'.$_REQUEST['field'].'` = "'.$_REQUEST['value'].'" WHERE '.$_section['id'].' = ? ', intval($_REQUEST['id']));
	
	// Call hooks post action
	add_hooks($_module, 'switch', 'post');
	
	// log action
	if($_REQUEST['field'] == "active"){
		admin_log_action($_module, ($_REQUEST['value'] == 0 ? 'in' : '').'active', $_REQUEST['id']);
	}else{
		$_form = array(
			$_REQUEST['field'] => array(
				array_keys($_website_langs)[0] => $_REQUEST['value']
			)
		);
		admin_log_action($_module, 'edit', $_REQUEST['id'], $_form);
	}
	
	go_away($_base_cms.'?module='.$_module.'&edited=1'.$_add_link);
}else{
	go_away($_base_cms.'?module='.$_module.$_add_link);
}