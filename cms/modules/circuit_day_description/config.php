<?php
// Config for this section
$_section = array(
	'name'							=> "Descrieri zile",
	
	'table' 						=> 'circuit_day_description',
	'id' 							=> 'id_circuit_day_description',
	
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
			'name' 					=> 'Titlu',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'id_circuit' => array(						
			'id'					=> 'id_circuit',
			'db_name'				=> 'id_circuit',	
			'db_type'				=> 'int',		
			'name' 					=> 'Circuit',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'circuit',
			'from_id'				=> 'id_circuit',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Circuit',				
			'placeholder'			=> 'Alege circuit',				
			'icon'					=> 'info',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'day' => array(
			'id'					=> 'day',
			'db_name'				=> 'day',
			'db_type'				=> 'int',
			'name' 					=> 'Ziua',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ziua din circuit',
			'placeholder'			=> 'ex: 5',
			'icon'					=> 'pencil',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'hotel' => array(
			'id'					=> 'hotel',
			'db_name'				=> 'hotel',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cazare',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Info cazare',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'meal' => array(
			'id'					=> 'meal',
			'db_name'				=> 'meal',
			'db_type'				=> 'varchar',
			'name' 					=> 'Masa',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Info masa',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'description' => array(
			'id'					=> 'description',
			'db_name'				=> 'description',
			'db_type'				=> 'text',
			'name' 					=> 'Descriere',
			'type' 					=> 'textarea',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		
	),
	
	'view' => array(
		'id_circuit', 'title', 'day', 'description'
	)

);