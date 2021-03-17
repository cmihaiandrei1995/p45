<?php
// Config for this section
$_section = array(
	'name'							=> "Ghizi",
	
	'table' 						=> 'guide',
	'id' 							=> 'id_guide',
	
	'use_active' 					=> true,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> true,
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
		
		/*
		'phone' => array(
			'id'					=> 'phone',
			'db_name'				=> 'phone',
			'db_type'				=> 'text',
			'name' 					=> 'Telefon',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/
		
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
		
		'guide' => array(
			'id'					=> 'file',
			'db_name'				=> 'file',
			'db_type'				=> 'varchar',
			'name' 					=> 'Imagine ghid',
			'type' 					=> 'image_simple',
			
			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 190,
											'height' => 190
										),
										
										'small' => array(
											'width' => 97,
											'height' => 97
										),
										
									),
			
			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
		'image' => array(						
			'id'					=> 'image',				
			'name' 					=> 'Galerie',			
			'type' 					=> 'multi_image',			
			'nr'					=> 100,	
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,			
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'resize'				=> true,
			'sizes'					=> array(	
										'big' => array(
											'width' => 870,
											'height' => 480
										),
										
										'thumb' => array(
											'width' => 107,
											'height' => 60
										),
									),
			
			'tooltip'				=> 'Upload magine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'title', 'description'
	)

);