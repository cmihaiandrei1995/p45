<?php
// Page name
$_subtitle = _lng('bulk_edit_records');

// Validation rules
$_rules = array();
$_form = array();
$_multiple_lang = false;

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

// Loading field plugins
foreach($_section['fields'] as $key => $field){
	// check for multiple languages
	if(count($field['lng']) > 1){
		$_multiple_lang = true;
	}
	
	// Setting globals and variables (dumping the whole field config array)
	$config = array(
		'globals' => array(
			'_rules', '_form', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field_id' => $key, 'field' => $field, '_section' => $_section, '_action' => $_action)
	);
	
	// Constructing the plugin
	$plugin = new Plugin($field['type'], $config);
	if(!empty($plugin)) $_fields[$key] = $plugin;
	
	// call the data generation widget
	if($plugin->hasWidget('data')){
		$plugin->widget('data', 'backend');
	}
	
	// call the add backend widget
	$field_settings = $plugin->getViewSettings();
	$is_bulk_editable = $field_settings['is_bulk_editable'];
	
	if($plugin->hasWidget('edit') && $is_bulk_editable){
		$plugin->widget('edit', 'backend');
	}
}

// Call hooks pre action
add_hooks($_module, 'bulk_edit', 'pre');

// Begin testing data fror submit
if(isset($_POST['submit'])){
	
	$_valid = true;
	
	// validator for each plugin
	foreach($_fields as $plugin) {
		if($plugin->hasWidget('validate')){
			$plugin->widget('validate', 'backend');
		}
	}
	
	// constructing the validator
	$_form = new Validate($_rules, 'post');
	
	// running the validator
	$_valid = $_form->check();
	
	// all ok - insert in the db
	if($_valid){
		// updating the main post row
		$_update = 'UPDATE `'.$_section['table'].'` SET `updated` = NOW() WHERE '.$_section['id'].' = ? ';
		db_query($_update, $_id);
		
		// all plugins
		foreach($_fields as $plugin) {
			$field_settings = $plugin->getViewSettings();
			$is_bulk_editable = $field_settings['is_bulk_editable'];
		
			if($plugin->hasWidget('edit') && $is_bulk_editable){
				$plugin->setVar('_id', $_id);
				$plugin->setVar('_form', $_form);
				$plugin->setVar('_valid', $_valid);
				$plugin->widget('edit', 'backend');
			}
		}
		
		// Call hooks post action
		add_hooks($_module, 'bulk_edit', 'post');
		
		// redirect after success
		switch($_POST['after']){
			case 'list': $after = 'added=1'; break;
			case 'edit': $after = 'action=edit&id='.$_id.'&added=1'; break;
			case 'add':  $after = 'action=add&added=1'; break;
		}
		go_away($_base_cms . '?module=' . $_module . '&' . $_add_link);
	}else{
		$_messages[] = array(
			'message' => _lng('err_all_required'),
			'type' => 'error'
		);
	}
	
}
