<?php
// Config for this section
$_section = array(
	'name'							=> "Continent",
	
	'table' 						=> 'continent',
	'id' 							=> 'id_continent',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'country' => 'id_continent',
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
		//@andrei:
		'image' => array(
			'id'					=> 'image',
			'name' 					=> 'Imagini',
			'type' 					=> 'image',
			'nr'					=> 1,
			'use_other_table'		=> '#table#_img',

			'required' 				=> 1,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 990,
											'height' => "auto"
										),
										'thumb' => array(
											'width' => 290,
											'height' => 180
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