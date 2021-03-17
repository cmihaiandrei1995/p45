<?php
// Config for this section
$_section = array(
	'name'							=> "Companii",
	
	'table' 						=> 'ticket_company',
	'id' 							=> 'id_ticket_company',
	
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
										'small' => array(
											'width' => 90,
											'height' => 40
										),
										
									),
			
			'tooltip'				=> 'Upload magine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'image', 'title'
	)

);