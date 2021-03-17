<?php
// Config for this section
$_section = array(
	'name'							=> "Setari SEO",
	
	'table' 						=> 'seo',
	'id' 							=> 'id_seo',
	
	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> false,
	
	'dependencies'					=> array(),
	
	'fields' => array(
	
		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu',
			'type' 					=> 'text',
			'do_not_edit'			=> true,
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'value' => array(
			'id'					=> 'value',
			'db_name'				=> 'value',
			'db_type'				=> 'varchar',
			'name' 					=> 'Valoare',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Valoare',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'info',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
	),
	
	'view' => array(
		'title', 'value'
	)

);