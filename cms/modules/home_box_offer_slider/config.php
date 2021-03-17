<?php
// Config for this section
$_section = array(
	'name'							=> "Oferte Box slider",
	
	'table' 						=> 'home_box_offer_slider',
	'id' 							=> 'id_home_box_offer_slider',
	
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
		
		'subtitle' => array(
			'id'					=> 'subtitle',
			'db_name'				=> 'subtitle',
			'db_type'				=> 'varchar',
			'name' 					=> 'Subtitlu',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: 8 zile / 7 nopti',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'box' => array(
			'id'					=> 'box',
			'db_name'				=> 'box',
			'db_type'				=> 'int',
			'name' 					=> 'Box',
			'type' 					=> 'select',
			'values'				=> array(
										5 => 'Box oferte 1',
										6 => 'Box oferte 2',
										7 => 'Box oferte 3',
										8 => 'Box oferte 4',
										9 => 'Box oferte 5',
			),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Box',
			'placeholder'			=> 'Alege box',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> 'url',
			
			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'info_departure' => array(
			'id'					=> 'info_departure',
			'db_name'				=> 'info_departure',
			'db_type'				=> 'varchar',
			'name' 					=> 'Info plecare',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Info plecare',
			'placeholder'			=> 'ex: Plecari din Bucuresti: 15.09.2017',
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
		
		'discount' => array(
			'id'					=> 'discount',
			'db_name'				=> 'discount',
			'db_type'				=> 'varchar',
			'name' 					=> 'Valoare reducere',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Valoare reducere',
			'placeholder'			=> 'ex: -20%',
			'icon'					=> 'money',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'discount_text' => array(
			'id'					=> 'discount_text',
			'db_name'				=> 'discount_text',
			'db_type'				=> 'varchar',
			'name' 					=> 'Text reducere',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Text reducere',
			'placeholder'			=> 'ex: De la / Pana la',
			'icon'					=> 'info',
			'size'					=> '25%',
			
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
											'width' => 1140,
											'height' => 485
										),
										'small' => array(
											'width' => 550,
											'height' => 350
										),
									),
			
			'tooltip'				=> 'Upload imagine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'image', 'title', 'box', 'description'
	)

);