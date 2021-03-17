<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('groups'),
	
	'table' 						=> 'admin_group',
	'id' 							=> 'id_admin_group',
	
	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'admin_user' => 'id_admin_group'
	),
	
	'fields' => array(
	
		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('title'),	
			'type' 					=> 'text',	
			
			'unique_in_db'			=> true,
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('group_title'),
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'admin_permission' => array(						
			'id'					=> 'permission',
			'db_name'				=> 'permission',
			'db_type'				=> 'text',
			'name' 					=> _lng('permissions'),		
			'type' 					=> 'admin_permissions',	
		),
	),
	
	'view' => array(
		'title'
	)

);