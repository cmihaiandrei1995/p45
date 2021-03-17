<?php
// Config for this section
$_section = array(
	'name'							=> "Croaziere",
	
	'table' 						=> 'cruise',
	'id' 							=> 'id_cruise',
	
	'preview'						=> array(
										//'route' => 'cruise',
										//'params' => array('title', 'id_cruise')
									),
	'preview_list'					=> array(
										//'route' => 'cruises',
									),
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> true,
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
		
		'id_cruise_destination' => array(
			'id'					=> 'id_cruise_destination',
			'db_name'				=> 'id_cruise_destination',
			'db_type'				=> 'int',		
			'name' 					=> 'Destinatie',
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'cruise_destination',
			'from_id'				=> 'id_cruise_destination',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'use_parent'			=> true,
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Destinatie',
			'placeholder'			=> 'Alege destinatie',
			'icon'					=> 'globe',
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
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'id_cruise_line' => array(						
			'id'					=> 'id_cruise_line',
			'db_name'				=> 'id_cruise_line',	
			'db_type'				=> 'int',		
			'name' 					=> 'Linie',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'cruise_line',
			'from_id'				=> 'id_cruise_line',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Linie',				
			'placeholder'			=> 'Alege linie',				
			'icon'					=> 'ship',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'id_cruise_ship' => array(						
			'id'					=> 'id_cruise_ship',
			'db_name'				=> 'id_cruise_ship',	
			'db_type'				=> 'int',		
			'name' 					=> 'Nava',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'cruise_ship',
			'from_id'				=> 'id_cruise_ship',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(
										array('id' => 'id_cruise_line', 'table' => 'cruise_line', 'field' => 'title', 'multilang' => false),
									),
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Nava',				
			'placeholder'			=> 'Alege nava',				
			'icon'					=> 'ship',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'port_start' => array(						
			'id'					=> 'port_start',
			'db_name'				=> 'port_start',	
			'db_type'				=> 'int',		
			'name' 					=> 'Port imbarcare',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'cruise_port',
			'from_id'				=> 'id_cruise_port',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Port imbarcare',				
			'placeholder'			=> 'Alege port',				
			'icon'					=> 'globe',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'excursions' => array(
			'id'					=> 'excursions',
			'db_name'				=> 'id_cruise_excursion',		
			'db_type'				=> 'int',	
			'name' 					=> 'Excursii',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_excursion',
			
			'from_table'			=> 'cruise_excursion',
			'from_id'				=> 'id_cruise_excursion',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(),
			
			'required' 				=> false,
			'validation_rules' 		=> '',	
			
			'tooltip'				=> 'Excursii',
			'placeholder'			=> 'Alege excursii',	
			'icon'					=> 'globe',	
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'nights' => array(								
			'id'					=> 'nights',			
			'db_name'				=> 'nights',			
			'db_type'				=> 'int',		
			'name' 					=> 'Nr nopti',					
			'type' 					=> 'text',					
			
			'required' 				=> true,		
			'validation_rules' 		=> 'int',					
			
			'tooltip'				=> 'Nr nopti',	
			'placeholder'			=> 'ex: 5',		
			'icon'					=> 'dayCalendar',		
			'size'					=> '25%',				
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
		),
		
		'plane_included' => array(
			'id'					=> 'plane_included',
			'db_name'				=> 'plane_included',
			'db_type'				=> 'int',
			'name' 					=> 'Avion inclus',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu', 
										'1' => 'Da',
									),		
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Avion inclus',
			'placeholder'			=> '',
			'icon'					=> 'plane',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'included' => array(
			'id'					=> 'included',
			'db_name'				=> 'included',
			'db_type'				=> 'text',
			'name' 					=> 'Include',
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
			'name' 					=> 'Nu include',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'cancelation' => array(
			'id'					=> 'cancelation',
			'db_name'				=> 'cancelation',
			'db_type'				=> 'text',
			'name' 					=> 'Anulare',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'cruise_categories' => array(
			'id'					=> 'cruise_categories',
			'db_name'				=> 'id_cruise_category',		
			'db_type'				=> 'int',	
			'name' 					=> 'Categorii',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_category',
			
			'from_table'			=> 'cruise_category',
			'from_id'				=> 'id_cruise_category',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'use_parent'			=> true,
			
			'add_info'				=> array(),
			
			'required' 				=> false,
			'validation_rules' 		=> '',	
			
			'tooltip'				=> 'Categorii',
			'placeholder'			=> 'Alege categorie',	
			'icon'					=> 'info',	
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'itinerary' => array(							
			'id'					=> 'itinerary',
			'db_name'				=> 'itinerary',
			'db_type'				=> 'varchar',
			'name' 					=> 'Imagine itinerariu',
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
											'width' => 240,
											'height' => 160
										)
									),
			
			'tooltip'				=> 'Upload imagine',			
			'icon'					=> 'image2',					
			
			'lng' 					=> array('ro')				
		),
		
		'price' => array(
			'id'					=> 'price',
			'db_name'				=> 'price',
			'db_type'				=> 'float',
			'name' 					=> 'Pret de la',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Pret',
			'placeholder'			=> 'ex: 399',
			'icon'					=> 'tag',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
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
		
		'promo' => array(
			'id'					=> 'promo',
			'db_name'				=> 'promo',
			'db_type'				=> 'varchar',
			'name' 					=> 'Promotie',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu', 
										'1' => 'Da',
									),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Promotie',
			'placeholder'			=> '',
			'icon'					=> 'star',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'price_promo' => array(
			'id'					=> 'price_promo',
			'db_name'				=> 'price_promo',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pret promo',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Pret promo',
			'placeholder'			=> 'ex: 399',
			'icon'					=> 'tag',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'date_offer_from' => array(								
			'id'					=> 'date_offer_from',			
			'db_name'				=> 'date_offer_from',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data oferta de la',
			'type' 					=> 'date',
			
			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',
			
			'required' 				=> false,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',	
			'placeholder'			=> 'ex: 19.10.2012',		
			'icon'					=> 'dayCalendar',		
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
		),
		
		'date_offer_to' => array(								
			'id'					=> 'date_offer_to',			
			'db_name'				=> 'date_offer_to',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data oferta pana la',
			'type' 					=> 'date',
			
			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',
			
			'required' 				=> false,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',	
			'placeholder'			=> 'ex: 19.10.2012',		
			'icon'					=> 'dayCalendar',		
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
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
		'title', 'price', 'description'
	)

);