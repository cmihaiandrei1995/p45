<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('login_history'),
	
	'table' 						=> 'admin_user_login',
	'id' 							=> 'id_admin_user_login',
	
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
		
		'ip' => array(
			'id'					=> 'ip',
			'db_name'				=> 'ip',
			'db_type'				=> 'varchar',
			'name' 					=> 'IP',	
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'IP',
			'placeholder'			=> 'ex: 123.123.123.123',
			'icon'					=> 'info',
			'size'					=> '50%',
			
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
		
		'timestamp' => array(
			'id'					=> 'timestamp',
			'db_name'				=> 'timestamp',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('date_hour'),	
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Data, ora',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> '',
			
			'view_callback'			=> 'convert_time2date'
		),
		
	),
	
	'view' => array(
		'id_admin_user', 'ip', 'timestamp'
	)

);