<?php
// Config for this section
$_section = array(
	'name'							=> "Destinatii",
	
	'table' 						=> 'cruise_destination',
	'id' 							=> 'id_cruise_destination',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> true,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'cruise' => 'id_cruise_destination',
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
		
		'parent_id' => array(							
			'id'					=> 'parent_id',	
			'db_name'				=> 'parent_id',	
			'db_type'				=> 'int',			
			'name' 					=> 'Parinte',					
			'type' 					=> 'select_db',				
			
			'from_table'			=> 'cruise_destination',
			'from_id'				=> 'id_cruise_destination',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'use_parent'			=> true,
			
			'required' 				=> false,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Destinatie',					
			'placeholder'			=> 'Fara parinte',			
			'icon'					=> 'info',			
			'use_ajax'				=> false,
			
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
		
		'image' => array(							
			'id'					=> 'image',			
			'name' 					=> 'Imagine',			
			'type' 					=> 'image',				
			'nr'					=> 1,				
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,							
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),	
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 800,
											'height' => 'auto'
										),
										'thumb' => array(
											'width' => 360,
											'height' => 270
										),
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
		'image', 'title', 'parent_id', 'description'
	)

);