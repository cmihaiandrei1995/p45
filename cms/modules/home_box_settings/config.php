<?php
// Config for this section
$_section = array(
	'name'							=> "Setari boxuri",
	
	'table' 						=> 'home_box_setting',
	'id' 							=> 'id_home_box_setting',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
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
			
			'required' 				=> true,
			'do_not_edit' 			=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'nr_items' => array(
			'id'					=> 'nr_items',
			'db_name'				=> 'nr_items',
			'db_type'				=> 'int',
			'name' 					=> 'Nr boxuri pe rand',
			'type' 					=> 'select',
			'values'				=> array(
										3 => 3,
										4 => 4
			),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Nr boxuri pe rand',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
	),
	
	'view' => array(
		'title', 'nr_items'
	)

);