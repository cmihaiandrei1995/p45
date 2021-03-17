<?php
// Config for this section
$_section = array(
	'name'							=> "Despre - Media",
	
	'table' 						=> 'about_media',
	'id' 							=> 'id_about_media',
	
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
		
		'date' => array(								
			'id'					=> 'date',
			'db_name'				=> 'date',
			'db_type'				=> 'date',
			'name' 					=> 'Data',
			'type' 					=> 'date',
			
			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',
			
			'lng' 					=> array('ro'),
			'value' 				=> date('d.m.Y')
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
		
		// 'image' => array(						
			// 'id'					=> 'image',				
			// 'name' 					=> 'Imagini',			
			// 'type' 					=> 'multi_image',			
			// 'nr'					=> 100,	
			// 'use_other_table'		=> '#table#_img',
// 			
			// 'required' 				=> 0,			
			// 'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			// 'resize'				=> true,
			// 'sizes'					=> array(	
										// 'big' => array(
											// 'width' => 800,
											// 'height' => 'auto'
										// ),
										// 'large' => array(
											// 'width' => 660,
											// 'height' => 290
										// ),
										// 'medium' => array(
											// 'width' => 480,
											// 'height' => 90
										// ),
										// 'small' => array(
											// 'width' => 230,
											// 'height' => 90
										// ),
									// ),
// 			
			// 'tooltip'				=> 'Upload magine',		
			// 'icon'					=> 'image2',
// 			
			// 'lng' 					=> array('ro')
		// ),
		
	),
	
	'view' => array(
		'title', 'description'
	)

);