<?php
// Page name
if($_GET['duplicate']){
	$_subtitle = _lng('duplicate_records');
}else{
	$_subtitle = _lng('edit_records');
}

// Validation rules
$_rules = array();
$_form = array();
$_multiple_lang = false;
$_sql_fields = array();

// current link hash - page, trash, draft, etc...
$_add_link = "";
if(isset($_GET['pg'])){
	$_add_link .= "&pg=".intval($_GET['pg']);
}

// check for drafts
$_drafts = 0;
if(isset($_GET['drafts'])){
	$_drafts = 1;
	$_add_link .= "&drafts=1";
}

//check for trash
$_trash = 0;
if(isset($_GET['trash'])){
	$_trash = 1;
	$_add_link .= "&trash=1";
}

// Get the record
$_id = intval($_GET['id']);
$_record['row'] = db_row('SELECT * FROM '.$_section['table'].' WHERE '.$_section['id'].' = ?', $_id);
if(empty($_record['row'][$_section['id']])){
	go_away($_base_cms.'?module='.$_module);
}

// check for multiple languages
foreach($_section['fields'] as $key => $field){
	if(count($field['lng']) > 1){
		$_multiple_lang = true;
	}
}

// get all the db name for each field
foreach($_section['fields'] as $key => $field){
	if(count($field['db_fields']) && $field['use_other_table'] == ""){
		foreach($field['db_fields'] as $db_fields){
			if($db_fields != ""){
				$_sql_fields[] = $_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'.'.$db_fields;
			}
		}
	}elseif($field['db_name'] != "" && $field['use_other_table'] == ""){
		$_sql_fields[] = $_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'.'.$field['db_name'];
	}
}

// seo fields
if($_section['use_seo']){
	$_sql_fields[] = $_section['table'].($_multiple_lang ? '_lng' : '').'.seo_title';
	$_sql_fields[] = $_section['table'].($_multiple_lang ? '_lng' : '').'.seo_keywords';
	$_sql_fields[] = $_section['table'].($_multiple_lang ? '_lng' : '').'.seo_description';
}

//get general fields
foreach($_website_langs as $lng => $lang_name){
	$_record[$lng] = db_row('SELECT '.$_section['table'].'.*, '.implode(', ', $_sql_fields).'
		FROM '.$_section['table'].' '.
			($_multiple_lang ? ' JOIN '.$_section['table'].'_lng USING ('.$_section['id'].')' : '').' '.
		'WHERE '.$_section['id'].' = '.$_id.' '.
			($_multiple_lang ? ' AND '.$_section['table'].'_lng.lng = "'.$lng.'"' : '')
		);
}

// get fields from other tables
foreach($_section['fields'] as $key => $field){
	if($field['use_other_table'] != ""){
		$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);
		if(count($field['lng']) > 1){
			foreach($field['lng'] as $lng){
				$_record[$lng][$field['use_other_table']] = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE `lng` = "'.$lng.'" AND '.$_section['id'].' = '.$_id);
			}
		}else{
			$_record[$field['lng'][0]][$field['use_other_table']] = db_query('SELECT * FROM '.$field['use_other_table'].' WHERE '.$_section['id'].' = '.$_id);
		}
	}
}

// apply htmlentities
array_walk_recursive($_record, 'htmlentities');

// Loading field plugins
foreach($_section['fields'] as $key => $field){
	// Fix for wrong language in the field "lng"
	$lng_keys = array_keys($_website_langs);
	if(count($field['lng']) == 1 && $field['lng'][0] != $lng_keys[0]){
		$field['lng'][0] = $lng_keys[0];
	}
	
	// Setting globals and variables (dumping the whole field config array)
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field_id' => $key, 'field' => $field, '_section' => $_section, '_action' => $_action, '_record' => $_record, '_id' => $_id)
	);
	
	// Constructing the plugin
	$plugin = new Plugin($field['type'], $config);
	if(!empty($plugin)) $_fields[$key] = $plugin;
	
	// call the data generation widget
	if($plugin->hasWidget('data')){
		$plugin->widget('data', 'backend');
	}
	
	// call the edit backend widget
	if($plugin->hasWidget('edit')){
		$plugin->widget('edit', 'backend');
	}
}

// Seo plugin
if($_section['use_seo']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action, '_record' => $_record)
	);
	$seo_plugin = new Plugin('seo', $config);
}

// Active plugin
if($_section['use_active']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action, '_record' => $_record)
	);
	$active_plugin = new Plugin('active', $config);
}

// Order plugin
if($_section['use_order']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action, '_record' => $_record)
	);
	$order_plugin = new Plugin('order', $config);
}

// Call hooks pre action
add_hooks($_module, 'add', 'pre');

// Begin testing data fror submit
if(isset($_POST['submit'])){
	
	$_valid = true;
	
	// validator for each plugin
	foreach($_fields as $plugin) {
		if($plugin->hasWidget('validate')){
			$plugin->widget('validate', 'backend');
		}
	}
	
	// validate active plugin
	if($_section['use_active']){
    	$active_plugin->widget('validate', 'backend');
    }
	
	// validate order plugin
    if($_section['use_order']){
    	$order_plugin->widget('validate', 'backend');
    }
	
	// validate seo plugin
    if($_section['use_seo']){
    	$seo_plugin->widget('validate', 'backend');
    }
	
	// constructing the validator
	$_form = new Validate($_rules, 'post');
	
	// running the validator
	$_valid = $_form->check();
	
	// all ok - insert in the db
	if($_valid){
		if($_GET['duplicate']){
			// Call hooks pre action
			add_hooks($_module, 'add', 'pre');
			
			// inserting the main post row
			$_insert = 'INSERT INTO `'.$_section['table'].'` ( `created` ) VALUES ( NOW() )';
			
			// execute the query and acquire the inserted id
			$_id = db_query($_insert);
		}else{
			// Call hooks pre action
			add_hooks($_module, 'edit', 'pre');
		
			// updating the main post row
			$_update = 'UPDATE `'.$_section['table'].'` SET `updated` = NOW() WHERE '.$_section['id'].' = ? ';
			db_query($_update, $_id);
		}
		
		// all plugins
		foreach($_fields as $plugin) {
			if($plugin->hasWidget('edit')){
				$plugin->setVar('_id', $_id);
				$plugin->setVar('_form', $_form);
				$plugin->setVar('_valid', $_valid);
				$plugin->widget('edit', 'backend');
			}
		}
		
		// active plugin
		if($_section['use_active']){
			$active_plugin->setVar('_id', $_id);
			$active_plugin->setVar('_form', $_form);
			$active_plugin->setVar('_valid', $_valid);
	    	$active_plugin->widget('edit', 'backend');
	    }
		
		// order plugin
	    if($_section['use_order']){
	    	$order_plugin->setVar('_id', $_id);
			$order_plugin->setVar('_form', $_form);
			$order_plugin->setVar('_valid', $_valid);
	    	$order_plugin->widget('edit', 'backend');
	    }
		
		// seo plugin
	    if($_section['use_seo']){
	    	$seo_plugin->setVar('_id', $_id);
			$seo_plugin->setVar('_form', $_form);
			$seo_plugin->setVar('_valid', $_valid);
	    	$seo_plugin->widget('edit', 'backend');
	    }
		
		if($_GET['duplicate']){
			// Call hooks post action
			add_hooks($_module, 'add', 'post');
			
			// log action
			admin_log_action($_module, 'add', $_id, $_form);
		}else{
			// Call hooks post action
			add_hooks($_module, 'edit', 'post');

			// fix for 2fa
			if($_module == "admin_users" && $_form['use_2fa_ro'] == 0){
				db_query("UPDATE admin_user SET 2fa_secret = NULL WHERE id_admin_user = ?", $_id);
			}
			
			// log action
			admin_log_action($_module, 'edit', $_id, $_form);
		}
		
		// redirect after success
		if($_GET['duplicate']){
			switch($_POST['after']){
				case 'list': $after = 'added=1'; break;
				case 'edit': $after = 'action=edit&id='.$_id.'&added=1'; break;
				case 'add':  $after = 'action=add&added=1'; break;
			}
		}else{
			switch($_POST['after']){
				case 'list': $after = 'edited=1'; break;
				case 'edit': $after = 'action=edit&id='.$_id.'&edited=1'; break;
				case 'add':  $after = 'action=add&edited=1'; break;
			}
		}
		go_away($_base_cms . '?module=' . $_module . '&' . $after . $_add_link);
	}else{
		$_messages[] = array(
			'message' => _lng('err_all_required'),
			'type' => 'error'
		);
	}
}
