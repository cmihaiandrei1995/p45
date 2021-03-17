<?php
// Config for this section
$_section = array(
	'name'							=> "Bilete avion",
	
	'table' 						=> 'ticket',
	'id' 							=> 'id_ticket',
	
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
			'name' 					=> 'Titlu (informativ)',
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
		
		'id_country_from' => array(
			'id'					=> 'id_country_from',
			'db_name'				=> 'id_country_from',
			'db_type'				=> 'int',
			'name' 					=> 'Tara plecare',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'do_not_edit'			=> true,
			'hidden'				=> true,
			'validation_rules' 		=> 'int',
			
			'tooltip'				=> 'Tara plecare',
			'placeholder'			=> 'ex: 126',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> '126'
		),
		
		'id_city_from' => array(						
			'id'					=> 'id_city_from',
			'db_name'				=> 'id_city_from',	
			'db_type'				=> 'int',		
			'name' 					=> 'Oras plecare',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			'from_where'			=> 'AND id_country = 126',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Oras',				
			'placeholder'			=> 'Alege oras',				
			'icon'					=> 'globe',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'airport_from' => array(
			'id'					=> 'airport_from',
			'db_name'				=> 'airport_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Aeroport plecare',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Aeroport plecare',
			'placeholder'			=> 'ex: Otopeni',
			'icon'					=> 'info',
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'iata_from' => array(
			'id'					=> 'iata_from',
			'db_name'				=> 'iata_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod IATA plecare',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Cod IATA plecare',
			'placeholder'			=> 'ex: OTP',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'id_country_to' => array(						
			'id'					=> 'id_country_to',
			'db_name'				=> 'id_country_to',	
			'db_type'				=> 'int',		
			'name' 					=> 'Tara destinatie',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'country',
			'from_id'				=> 'id_country',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Tara',				
			'placeholder'			=> 'Alege tara',				
			'icon'					=> 'globe',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'id_city_to' => array(						
			'id'					=> 'id_city_to',
			'db_name'				=> 'id_city_to',	
			'db_type'				=> 'int',		
			'name' 					=> 'Oras destinatie',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(
										array('id' => 'id_country', 'table' => 'country', 'field' => 'title', 'multilang' => false),
									),
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Oras',				
			'placeholder'			=> 'Alege oras',				
			'icon'					=> 'globe',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'airport_to' => array(
			'id'					=> 'airport_to',
			'db_name'				=> 'airport_to',
			'db_type'				=> 'varchar',
			'name' 					=> 'Aeroport destinatie',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Aeroport destinatie',
			'placeholder'			=> 'ex: Dubai Airport',
			'icon'					=> 'info',
			'size'					=> '50%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'iata_to' => array(
			'id'					=> 'iata_to',
			'db_name'				=> 'iata_to',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod IATA destinatie',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Cod IATA destinatie',
			'placeholder'			=> 'ex: DXB',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		/*
		'date_from' => array(								
			'id'					=> 'date_from',
			'db_name'				=> 'date_from',
			'db_type'				=> 'date',
			'name' 					=> 'Data zbor dus',
			'type' 					=> 'date',
			
			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',
			
			'lng' 					=> array('ro'),
			'value' 				=> date('d.m.Y')
		),
		
		'time_departure_from' => array(
			'id'					=> 'time_departure_from',
			'db_name'				=> 'time_departure_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Ora plecare dus',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ora plecare dus',
			'placeholder'			=> 'ex: 10:45',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'time_departure_to' => array(
			'id'					=> 'time_departure_to',
			'db_name'				=> 'time_departure_to',
			'db_type'				=> 'varchar',
			'name' 					=> 'Ora sosire dus',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ora sosire dus',
			'placeholder'			=> 'ex: 10:45',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'date_to' => array(								
			'id'					=> 'date_to',
			'db_name'				=> 'date_to',
			'db_type'				=> 'date',
			'name' 					=> 'Data intoarcere',
			'type' 					=> 'date',
			
			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',	
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',
			
			'lng' 					=> array('ro'),
			'value' 				=> date('d.m.Y')
		),
		
		'time_return_from' => array(
			'id'					=> 'time_return_from',
			'db_name'				=> 'time_return_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Ora plecare intors',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ora plecare intors',
			'placeholder'			=> 'ex: 10:45',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'time_return_to' => array(
			'id'					=> 'time_return_to',
			'db_name'				=> 'time_return_to',
			'db_type'				=> 'varchar',
			'name' 					=> 'Ora sosire intors',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ora sosire intors',
			'placeholder'			=> 'ex: 10:45',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/
		'id_ticket_company' => array(						
			'id'					=> 'id_ticket_company',
			'db_name'				=> 'id_ticket_company',	
			'db_type'				=> 'int',		
			'name' 					=> 'Companie',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'ticket_company',
			'from_id'				=> 'id_ticket_company',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> true,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Companie',				
			'placeholder'			=> 'Alege companie',				
			'icon'					=> 'plane',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'info_stop' => array(
			'id'					=> 'info_stop',
			'db_name'				=> 'info_stop',
			'db_type'				=> 'varchar',
			'name' 					=> 'Info escala',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Info escala',
			'placeholder'			=> 'ex: Zbor direct',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'time_stop' => array(
			'id'					=> 'time_stop',
			'db_name'				=> 'time_stop',
			'db_type'				=> 'varchar',
			'name' 					=> 'Durata zbor/escala',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Durata zbor/escala',
			'placeholder'			=> 'ex: 3 ore',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		/*
		'price' => array(
			'id'					=> 'price',
			'db_name'				=> 'price',
			'db_type'				=> 'int',
			'name' 					=> 'Pret de la',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> 'int',
			
			'tooltip'				=> 'Pret de la',
			'placeholder'			=> 'ex: 199',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/
		
		'observation' => array(
			'id'					=> 'observation',
			'db_name'				=> 'observation',
			'db_type'				=> 'text',
			'name' 					=> 'Observatii',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'financial' => array(
			'id'					=> 'financial',
			'db_name'				=> 'financial',
			'db_type'				=> 'text',
			'name' 					=> 'Conditii financiare',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
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
										'small' => array(
											'width' => 260,
											'height' => 210
										),
										
									),
			
			'tooltip'				=> 'Upload magine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'image', 'title', 'id_city_from', 'id_city_to', 'id_ticket_company'//, 'date_to', 'date_from', 'price'
	)

);