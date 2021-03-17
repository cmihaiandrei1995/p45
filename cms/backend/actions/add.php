<?php
// Page name
$_subtitle = _lng('add_records');

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
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
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
	if($plugin->hasWidget('add')){
		$plugin->widget('add', 'backend');
	}
}

// Seo plugin
if($_section['use_seo']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action)
	);
	$seo_plugin = new Plugin('seo', $config);
}

// Active plugin
if($_section['use_active']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module'
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action)
	);
	$active_plugin = new Plugin('active', $config);
}

// Order plugin
if($_section['use_order']){
	$config = array(
		'globals' => array(
			'_rules', '_form', '_valid', '_multiple_lang', '_website_langs', '_module',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action)
	);
	$order_plugin = new Plugin('order', $config);
}

// Call hooks pre action
add_hooks($_module, 'add', 'pre');

// Begin testing data fror submit
if(isset($_POST['submit'])){
	
	$_valid = true;
	
	// if a secondary language is present and no value has been inserted for a field, auto populate with the value form the default field
	foreach($_section['fields'] as $key => $field){
		// check for multiple languages
		if(count($field['lng']) > 1){
			foreach($field['lng'] as $k => $lng){
				if($k > 0){
					if(empty($_POST[$key.'_'.$lng])){
						$_POST[$key.'_'.$lng] = $_POST[$key.'_'.$field['lng'][0]];
					}
				}
			}
		}
	}
	
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
    	// if a secondary language is present and no value has been inserted for a field, auto populate with the value form the default field
		foreach($_section['fields'] as $key => $field){
			// check for multiple languages
			if(count($field['lng']) > 1){
				foreach($field['lng'] as $k => $lng){
					if($k > 0){
						if(empty($_POST['seo_title'.'_'.$lng])){
							$_POST['seo_title'.'_'.$lng] = $_POST['seo_title'.'_'.$field['lng'][0]];
						}
						if(empty($_POST['seo_keywords'.'_'.$lng])){
							$_POST['seo_keywords'.'_'.$lng] = $_POST['seo_keywords'.'_'.$field['lng'][0]];
						}
						if(empty($_POST['seo_description'.'_'.$lng])){
							$_POST['seo_description'.'_'.$lng] = $_POST['seo_description'.'_'.$field['lng'][0]];
						}
					}
				}
			}
		}
		
    	$seo_plugin->widget('validate', 'backend');
    }
	
	// constructing the validator
	$_form = new Validate($_rules, 'post');
	
	// running the validator
	$_valid = $_form->check();
	
	// all ok - insert in the db
	if($_valid){
		// inserting the main post row
		$_insert = 'INSERT INTO `'.$_section['table'].'` ( `created` ) VALUES ( NOW() )';
		
		// execute the query and acquire the inserted id
		$_id = db_query($_insert);
		
		// all plugins
		foreach($_fields as $plugin) {
			if($plugin->hasWidget('add')){
				$plugin->setVar('_id', $_id);
				$plugin->setVar('_form', $_form);
				$plugin->setVar('_valid', $_valid);
				$plugin->widget('add', 'backend');
			}
		}
		
		// active plugin
		if($_section['use_active']){
			$active_plugin->setVar('_id', $_id);
			$active_plugin->setVar('_form', $_form);
			$active_plugin->setVar('_valid', $_valid);
	    	$active_plugin->widget('add', 'backend');
	    }
		
		// order plugin
	    if($_section['use_order']){
	    	$order_plugin->setVar('_id', $_id);
			$order_plugin->setVar('_form', $_form);
			$order_plugin->setVar('_valid', $_valid);
	    	$order_plugin->widget('add', 'backend');
	    }
		
		// seo plugin
	    if($_section['use_seo']){
	    	$seo_plugin->setVar('_id', $_id);
			$seo_plugin->setVar('_form', $_form);
			$seo_plugin->setVar('_valid', $_valid);
	    	$seo_plugin->widget('add', 'backend');
	    }
		
		// Call hooks post action
		add_hooks($_module, 'add', 'post');
		
		// log action
		admin_log_action($_module, 'add', $_id, $_form);
		
		// redirect after success
		switch($_POST['after']){
			case 'list': $after = 'added=1'; break;
			case 'edit': $after = 'action=edit&id='.$_id.'&added=1'; break;
			case 'add':  $after = 'action=add&added=1'; break;
		}
		go_away($_base_cms . '?module=' . $_module . '&' . $after . $_add_link);
	}else{
		$_messages[] = array(
			'message' => _lng('err_all_required'),
			'type' => 'error'
		);
	}
	
}
