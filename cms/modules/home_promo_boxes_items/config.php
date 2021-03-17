<?php
// Config for this section
$_section = array(
	'name'							=> "Itemi boxuri promo",
	
	'table' 						=> 'home_promo_box_item',
	'id' 							=> 'id_home_promo_box_item',
	
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
			
			'tooltip'				=> 'Subtitlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'id_home_promo_box' => array(						
			'id'					=> 'id_home_promo_box',
			'db_name'				=> 'id_home_promo_box',	
			'db_type'				=> 'int',		
			'name' 					=> 'Box promo',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'home_promo_box',
			'from_id'				=> 'id_home_promo_box',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Box promo',				
			'placeholder'			=> 'Alege box',				
			'icon'					=> 'info',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip oferta',
			'type' 					=> 'select',
			'values'				=> array(
										'charter' => 'Charter',
										'circuit' => 'Circuit',
										'ticket' => 'Bilet avion',
										'hotel' => 'Hotel'
			),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Tip oferta',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'last_places' => array(
			'id'					=> 'last_places',
			'db_name'				=> 'last_places',
			'db_type'				=> 'int',
			'name' 					=> 'Ultimele locuri',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Ultimele locuri',
			'placeholder'			=> 'ex: 5',
			'icon'					=> 'user',
			'size'					=> '20%',
			
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
			
			'required' 				=> true,		
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
			
			'required' 				=> true,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',	
			'placeholder'			=> 'ex: 19.10.2012',		
			'icon'					=> 'dayCalendar',		
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
		),
		
		'separator1' => array(
			'id'					=> 'separator1',
			'name' 					=> 'Info charter',
			'type' 					=> 'separator',
			'do_not_edit'			=> true,
		),
		
		'charter_id_zone' => array(						
			'id'					=> 'charter_id_zone',
			'db_name'				=> 'charter_id_zone',	
			'db_type'				=> 'int',		
			'name' 					=> 'Zona',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'zone',
			'from_id'				=> 'id_zone',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(
										array('id' => 'id_country', 'table' => 'country', 'field' => 'title', 'multilang' => false),
									),
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Zona',				
			'placeholder'			=> 'Alege zona',				
			'icon'					=> 'globe',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'charter_id_hotel' => array(						
			'id'					=> 'charter_id_hotel',
			'db_name'				=> 'charter_id_hotel',	
			'db_type'				=> 'int',		
			'name' 					=> 'Hotel',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'hotel',
			'from_id'				=> 'id_hotel',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(
										array('id' => 'id_city', 'table' => 'city', 'field' => 'title', 'multilang' => false),
									),
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Hotel',				
			'placeholder'			=> 'Alege hotel',				
			'icon'					=> 'hotel',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'charter_id_city_from' => array(
			'id'					=> 'charter_id_city_from',
			'db_name'				=> 'charter_id_city_from',
			'db_type'				=> 'int',
			'name' 					=> 'Oras plecare',
			'type' 					=> 'select',
			'values'				=> $_cities_from_circuits,		
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Oras plecare',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		
		'charter_offer_from' => array(								
			'id'					=> 'charter_offer_from',			
			'db_name'				=> 'charter_offer_from',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data plecare',
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
		
		'charter_offer_to' => array(								
			'id'					=> 'charter_offer_to',			
			'db_name'				=> 'charter_offer_to',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data retur',
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
		
		'separator2' => array(
			'id'					=> 'separator2',
			'name' 					=> 'Info circuit',
			'type' 					=> 'separator',
			'do_not_edit'			=> true,
		),
		
		'circuit_id_circuit' => array(						
			'id'					=> 'circuit_id_circuit',
			'db_name'				=> 'circuit_id_circuit',	
			'db_type'				=> 'int',		
			'name' 					=> 'Circuit',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'circuit',
			'from_id'				=> 'id_circuit',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(),
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Circuit',				
			'placeholder'			=> 'Alege circuit',				
			'icon'					=> 'info',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'circuit_offer_from' => array(								
			'id'					=> 'circuit_offer_from',			
			'db_name'				=> 'circuit_offer_from',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data plecare',
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
		
		'separator3' => array(
			'id'					=> 'separator3',
			'name' 					=> 'Bilet avion',
			'type' 					=> 'separator',
			'do_not_edit'			=> true,
		),
		
		'ticket_id_ticket' => array(						
			'id'					=> 'ticket_id_ticket',
			'db_name'				=> 'ticket_id_ticket',	
			'db_type'				=> 'int',		
			'name' 					=> 'Bilet avion',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'ticket',
			'from_id'				=> 'id_ticket',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(),
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Bilet avion',				
			'placeholder'			=> 'Alege bilet',				
			'icon'					=> 'info',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'separator4' => array(
			'id'					=> 'separator4',
			'name' 					=> 'Hotel',
			'type' 					=> 'separator',
			'do_not_edit'			=> true,
		),
		
		'hotel_id_city' => array(						
			'id'					=> 'hotel_id_city',
			'db_name'				=> 'hotel_id_city',	
			'db_type'				=> 'int',		
			'name' 					=> 'Oras / Statiune',			
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
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Oras',				
			'placeholder'			=> 'Alege oras',				
			'icon'					=> 'globe',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'hotel_id_hotel' => array(						
			'id'					=> 'hotel_id_hotel',
			'db_name'				=> 'hotel_id_hotel',	
			'db_type'				=> 'int',		
			'name' 					=> 'Hotel',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'hotel',
			'from_id'				=> 'id_hotel',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'add_info'				=> array(
										array('id' => 'id_city', 'table' => 'city', 'field' => 'title', 'multilang' => false),
									),
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Hotel',				
			'placeholder'			=> 'Alege hotel',				
			'icon'					=> 'hotel',				
			'use_ajax'				=> true,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'hotel_offer_from' => array(								
			'id'					=> 'hotel_offer_from',			
			'db_name'				=> 'hotel_offer_from',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data plecare',
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
		
		'hotel_offer_to' => array(								
			'id'					=> 'hotel_offer_to',			
			'db_name'				=> 'hotel_offer_to',			
			'db_type'				=> 'date',		
			'name' 					=> 'Data retur',
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
		
	),
	
	'view' => array(
		'title', 'id_home_promo_box', 'type'
	)

);