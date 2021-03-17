<?php
// Config for this section
$_section = array(
	'name'							=> "Vase de croaziera",
	
	'table' 						=> 'cruise_ship',
	'id' 							=> 'id_cruise_ship',
	
	'use_active' 					=> true,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> true,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'cruise_deck' => 'id_cruise_ship',
										'cruise' => 'id_cruise_ship',
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
			'use_ajax'				=> true,
			
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
		
		'weight' => array(
			'id'					=> 'weight',
			'db_name'				=> 'weight',
			'db_type'				=> 'varchar',
			'name' 					=> 'Greutate',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Greutate',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'capacity' => array(
			'id'					=> 'capacity',
			'db_name'				=> 'capacity',
			'db_type'				=> 'varchar',
			'name' 					=> 'Capacitate',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Capacitate',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'length' => array(
			'id'					=> 'length',
			'db_name'				=> 'length',
			'db_type'				=> 'varchar',
			'name' 					=> 'Lungime',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Lungime',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'width' => array(
			'id'					=> 'width',
			'db_name'				=> 'width',
			'db_type'				=> 'varchar',
			'name' 					=> 'Latime',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Latime',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'crew' => array(
			'id'					=> 'crew',
			'db_name'				=> 'crew',
			'db_type'				=> 'varchar',
			'name' 					=> 'Echipaj',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Echipaj',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'year' => array(
			'id'					=> 'year',
			'db_name'				=> 'year',
			'db_type'				=> 'varchar',
			'name' 					=> 'An constructie',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'An constructie',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'constructor' => array(
			'id'					=> 'constructor',
			'db_name'				=> 'constructor',
			'db_type'				=> 'varchar',
			'name' 					=> 'Constructor',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Constructor',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'speed' => array(
			'id'					=> 'speed',
			'db_name'				=> 'speed',
			'db_type'				=> 'varchar',
			'name' 					=> 'Viteza',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Viteza',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'stars' => array(
			'id'					=> 'stars',
			'db_name'				=> 'stars',
			'db_type'				=> 'varchar',
			'name' 					=> 'Stele',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Stele',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'construction_cost' => array(
			'id'					=> 'construction_cost',
			'db_name'				=> 'construction_cost',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cost constructie',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Cost constructie',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'registered' => array(
			'id'					=> 'registered',
			'db_name'				=> 'registered',
			'db_type'				=> 'varchar',
			'name' 					=> 'Inregistrat in',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Inregistrat in',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'pescaj' => array(
			'id'					=> 'pescaj',
			'db_name'				=> 'pescaj',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pescaj',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Pescaj',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'nr_cabins' => array(
			'id'					=> 'nr_cabins',
			'db_name'				=> 'nr_cabins',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr cabine',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Nr cabine',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'supr_cabins' => array(
			'id'					=> 'supr_cabins',
			'db_name'				=> 'supr_cabins',
			'db_type'				=> 'varchar',
			'name' 					=> 'Supr. cabine',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Supr. cabine',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'volts' => array(
			'id'					=> 'volts',
			'db_name'				=> 'volts',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tensiunea in cabina',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Tensiunea in cabina',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'decks_access' => array(
			'id'					=> 'decks_access',
			'db_name'				=> 'decks_access',
			'db_type'				=> 'varchar',
			'name' 					=> 'Punti accesibile',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Punti accesibile',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'nr_pools' => array(
			'id'					=> 'nr_pools',
			'db_name'				=> 'nr_pools',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr piscine',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Nr piscine',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'nr_jacuzzi' => array(
			'id'					=> 'nr_jacuzzi',
			'db_name'				=> 'nr_jacuzzi',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr jacuzzi',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Nr piscine',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		'nr_elevators' => array(
			'id'					=> 'nr_elevators',
			'db_name'				=> 'nr_elevators',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr lifturi',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Nr lifturi',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		
		/*
		'currency_used' => array(
			'id'					=> 'currency_used',
			'db_name'				=> 'currency_used',
			'db_type'				=> 'varchar',
			'name' 					=> 'Moneda folosita',
			'type' 					=> 'text',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Moneda folosita',
			'placeholder'			=> '',
			'icon'					=> 'info',	
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),	
			'value' 				=> ''		
		),
		*/
		
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
			'name' 					=> 'Imagini',			
			'type' 					=> 'multi_image',				
			'nr'					=> 100,				
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,							
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),	
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 800,
											'height' => 'auto'
										),
										'large' => array(
											'width' => 848,
											'height' => 480
										),
										'medium' => array(
											'width' => 524,
											'height' => 330
										),
										'thumb' => array(
											'width' => 110,
											'height' => 60
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
		'image', 'title', 'id_cruise_line', 'description'
	)

);