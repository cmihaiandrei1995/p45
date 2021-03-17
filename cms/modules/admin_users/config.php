<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('users'),
	
	'table' 						=> 'admin_user',
	'id' 							=> 'id_admin_user',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(),
	
	'fields' => array(
	
		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('name'),	
			'type' 					=> 'text',	
			
			'unique_in_db'			=> true,
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('name_of_user'),
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'username' => array(
			'id'					=> 'username',
			'db_name'				=> 'username',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('username'),	
			'type' 					=> 'text',	
			
			'unique_in_db'			=> true,
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('username'),
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'user',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'email' => array(
			'id'					=> 'email',
			'db_name'				=> 'email',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('email'),	
			'type' 					=> 'text',	
			
			'unique_in_db'			=> true,
			'required' 				=> true,
			'validation_rules' 		=> 'email',
			
			'tooltip'				=> _lng('email'),
			'placeholder'			=> 'ex: john.doe@domain.com',
			'icon'					=> 'mail',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'password' => array(
			'id'					=> 'password',
			'db_name'				=> 'password',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('pass'),	
			'type' 					=> 'password',	
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('pass'),
			'placeholder'			=> 'ex: 4cjr374ycn',
			'icon'					=> 'key',
			'size'					=> '50%',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'id_admin_group' => array(
			'id'					=> 'id_admin_group',
			'db_name'				=> 'id_admin_group',
			'db_type'				=> 'int',
			'name' 					=> _lng('group'),
			'type' 					=> 'select_db',
			
			'from_table'			=> 'admin_group',
			'from_id'				=> 'id_admin_group',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('group'),
			'placeholder'			=> _lng('choose').' '.strtolower(_lng('group')),
			'icon'					=> 'users',
			'use_ajax'				=> false,
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),

		'use_2fa' => array(
			'id'					=> 'use_2fa',
			'db_name'				=> 'use_2fa',
			'db_type'				=> 'int',
			'name' 					=> '2FA',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => _lng('no'),
										'1' => _lng('yes')									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Two Factor Authentication',
			'placeholder'			=> '',
			'icon'					=> 'locked2',
			'use_ajax'				=> false,

			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
	),
	
	'view' => array(
		'title', 'username', 'email', 'id_admin_group', 'use_2fa'
	)

);