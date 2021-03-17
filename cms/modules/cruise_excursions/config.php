<?php
// Config for this section
$_section = array(
	'name'							=> "Excursii",
	
	'table' 						=> 'cruise_excursion',
	'id' 							=> 'id_cruise_excursion',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'cruise_to_excursion' => 'id_cruise_excursion'
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
		
		'pdf' => array(
			'id'					=> 'pdf',
			'db_name'				=> 'pdf',
			'db_type'				=> 'varchar',
			'name' 					=> 'PDF',
			'type' 					=> 'file_simple',
			
			'required' 				=> false,
			'accepted_ext' 			=> array('doc', 'pdf'),
			'use_random'			=> false,
			'folder'				=> $_base_path.'uploads/files/cruises/',
			'use_ymd_folder'		=> false,
			
 			'tooltip'				=> 'Upload fisier',
			'icon'					=> 'file',
			
			'lng' 					=> array('ro')
		),
		
		'image' => array(							
			'id'					=> 'image',
			'db_name'				=> 'image',
			'db_type'				=> 'varchar',
			'name' 					=> 'Imagine',
			'type' 					=> 'image_simple',
			
			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_random'			=> false,
			'folder'				=> $_base_path.'uploads/images/cruises/',
			'use_ymd_folder'		=> false,
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 800,
											'height' => 'auto'
										),
										'thumb' => array(
											'width' => 300,
											'height' => 150
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
		'image', 'title', 'description'
	)

);