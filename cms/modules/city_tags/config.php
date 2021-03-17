<?php
// Config for this section
$_section = array(
	'name'							=> "Tag-uri",
	
	'table' 						=> 'city_tag',
	'id' 							=> 'id_city_tag',
	
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
			'validation_rules' 		=> '',
			'do_not_edit'			=> true,
			
			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'title_front' => array(
			'id'					=> 'title_front',
			'db_name'				=> 'title_front',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu in site',
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
											'width' => 550,
											'height' => 270
										),
										'small' => array(
											'width' => 360,
											'height' => 270
										)
									),
			
			'tooltip'				=> 'Upload imagine',			
			'icon'					=> 'image2',					
			
			'lng' 					=> array('ro')				
		),
		
	),
	
	'view' => array(
		'image', 'title'
	)

);