<?php
// Config for this section
$_section = array(
	'name'							=> "Linii de croaziera",
	
	'table' 						=> 'cruise_line',
	'id' 							=> 'id_cruise_line',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'cruise_ship' => 'id_cruise_line',
										'cruise' => 'id_cruise_line',
									),
	
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
		
		'description' => array(
			'id'					=> 'description',
			'db_name'				=> 'description',
			'db_type'				=> 'text',
			'name' 					=> 'Descriere',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'included' => array(
			'id'					=> 'included',
			'db_name'				=> 'included',
			'db_type'				=> 'text',
			'name' 					=> 'Servicii incluse',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'not_included' => array(
			'id'					=> 'not_included',
			'db_name'				=> 'not_included',
			'db_type'				=> 'text',
			'name' 					=> 'Servicii neincluse',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		/*
		'cancelation' => array(
			'id'					=> 'cancelation',
			'db_name'				=> 'cancelation',
			'db_type'				=> 'text',
			'name' 					=> 'Conditii anulare',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'trip_info' => array(
			'id'					=> 'trip_info',
			'db_name'				=> 'trip_info',
			'db_type'				=> 'text',
			'name' 					=> 'Conditii calatorie',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'trip' => array(
			'id'					=> 'trip',
			'db_name'				=> 'trip',
			'db_type'				=> 'varchar',
			'name' 					=> 'Conditii calatorie',
			'type' 					=> 'file_simple',
			
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'),
			'use_random'			=> false,

			'required' 				=> 0,
			'tooltip'				=> 'Upload fisiere',
			'icon'					=> 'file',

			'lng' 					=> array('ro')
		),
		*/
		
		'currency' => array(
			'id'					=> 'currency',
			'db_name'				=> 'currency',
			'db_type'				=> 'varchar',
			'name' 					=> 'Moneda',
			'type' 					=> 'select',
			'values'				=> $_cruise_currency,		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Moneda',
			'placeholder'			=> '',
			'icon'					=> 'money',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'logo' => array(							
			'id'					=> 'logo',
			'db_name'				=> 'logo',
			'db_type'				=> 'varchar',
			'name' 					=> 'Logo',
			'type' 					=> 'image_simple',
			
			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_random'			=> false,
			'folder'				=> $_base_path.'uploads/images/cruises/',
			'use_ymd_folder'		=> false,
			'resize'				=> true,
			'sizes'					=> array(
										'medium' => array(
											'width' => 220,
											'height' => 'auto'
										),
										'small' => array(
											'width' => 100,
											'height' => 'auto'
										)
									),
			
			'tooltip'				=> 'Upload imagine',			
			'icon'					=> 'image2',					
			
			'lng' 					=> array('ro')				
		),
		
		'allow_update' => array(
			'id'					=> 'allow_update',
			'db_name'				=> 'allow_update',
			'db_type'				=> 'int',
			'name' 					=> 'Permite update?',
			'type' 					=> 'select',
			'values'				=> array(
										1 => 'Da',
										0 => 'Nu'
			),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Permite update?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
	),
	
	'view' => array(
		'title', 'currency', 'description'
	)

);