<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('actions_log'),
	
	'table' 						=> 'admin_action',
	'id' 							=> 'id_admin_action',
	
	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> false,
	'use_delete'					=> false,
	
	'dependencies'					=> array(),
	
	'fields' => array(
	
		'id_admin_user' => array(
			'id'					=> 'id_admin_user',
			'db_name'				=> 'id_admin_user',
			'db_type'				=> 'int',
			'name' 					=> _lng('user'),
			'type' 					=> 'select_db',
			
			'from_table'			=> 'admin_user',
			'from_id'				=> 'id_admin_user',
			'from_multilang'		=> false,
			'from_field'			=> 'username',
			'from_order_by'			=> 'username',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('user'),
			'placeholder'			=> _lng('choose').' '.strtolower(_lng('user')),
			'icon'					=> 'user',
			'use_ajax'				=> false,
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'session_id' => array(
			'id'					=> 'session_id',
			'db_name'				=> 'session_id',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('session_id'),	
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('session_id'),
			'placeholder'			=> '',
			'icon'					=> 'info',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'section' => array(
			'id'					=> 'section',
			'db_name'				=> 'section',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('section'),	
			'type' 					=> 'select',
			'values'				=> $_sections_txt,		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('section'),
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'action' => array(
			'id'					=> 'action',
			'db_name'				=> 'action',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('action'),	
			'type' 					=> 'select',
			'values'				=> $_actions_txt,		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('action'),
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'id_what' => array(
			'id'					=> 'id_what',
			'db_name'				=> 'id_what',
			'db_type'				=> 'int',
			'name' 					=> _lng('record_id'),	
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('record_id'),
			'placeholder'			=> 'ex: 23423',
			'icon'					=> 'info',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
	),
	
	'view' => array(
		'id_admin_user', 'section', 'action', 'id_what'
	)

);