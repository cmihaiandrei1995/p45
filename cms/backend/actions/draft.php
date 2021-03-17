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
	$tmp_ids = explode(',', $_REQUEST['id']);
	
	foreach($tmp_ids as $_id){
		// Call hooks pre action
		add_hooks($_module, 'draft', 'pre');

		db_query('UPDATE '.$_section['table'].' SET draft = 1 WHERE '.$_section['id'].' = ? ', intval($_id));
		
		// Call hooks post action
		add_hooks($_module, 'draft', 'post');
		
		// log action
		admin_log_action($_module, 'draft', $_id);
	}
	
	if(count($tmp_ids) > 1){
		go_away($_base_cms.'?module='.$_module.'&drafted_all=1'.$_add_link);
	}else{
		go_away($_base_cms.'?module='.$_module.'&drafted=1'.$_add_link);
	}
}else{
	go_away($_base_cms.'?module='.$_module.$_add_link);
}