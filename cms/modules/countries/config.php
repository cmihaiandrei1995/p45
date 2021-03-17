<?php
// Config for this section
$_section = array(
	'name'							=> "Tari",
	
	'table' 						=> 'country',
	'id' 							=> 'id_country',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> false,
	
	'dependencies'					=> array(
										'city' => 'id_country',
										'zone' => 'id_country',
										'hotel' => 'id_country',
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
		
		'id_continent' => array(						
			'id'					=> 'id_continent',
			'db_name'				=> 'id_continent',	
			'db_type'				=> 'int',		
			'name' 					=> 'Continent',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'continent',
			'from_id'				=> 'id_continent',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Continent',				
			'placeholder'			=> 'Alege continent',				
			'icon'					=> 'globe',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'id_eurosite' => array(
			'id'					=> 'id_eurosite',
			'db_name'				=> 'id_eurosite',
			'db_type'				=> 'int',
			'name' 					=> 'ID Eurosite',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'ID Eurosite',
			'placeholder'			=> 'ex: 234234',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
	  
		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod ISO',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Cod ISO',
			'placeholder'			=> 'ex: RO',
			'icon'					=> 'info',
			'size'					=> '25%',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'home_tourism' => array(
            'id'                    => 'home_tourism',
            'db_name'               => 'home_tourism',
            'db_type'               => 'int',
            'name'                  => 'Apare la turism',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu', 
                                        '1' => 'Da',
                                    ),      
            
            'required'              => false,
            'validation_rules'      => '',
            
            'tooltip'               => 'Apare la turism',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,
            
            'lng'                   => array('ro'),
            'value'                 => ''
        ),
        
		'home_charter' => array(
            'id'                    => 'home_charter',
            'db_name'               => 'home_charter',
            'db_type'               => 'int',
            'name'                  => 'Apare la chartere',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu', 
                                        '1' => 'Da',
                                    ),      
            
            'required'              => false,
            'validation_rules'      => '',
            
            'tooltip'               => 'Apare la chartere',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,
            
            'lng'                   => array('ro'),
            'value'                 => ''
        ),
        
		'image' => array(							
			'id'					=> 'image',			
			'name' 					=> 'Imagine header',			
			'type' 					=> 'image',				
			'nr'					=> 1,				
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,							
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),	
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 1920,
											'height' => 500
										),
										'small' => array(
											'width' => 200,
											'height' => 'auto'
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
		'title', 'id_eurosite', 'code', 'id_continent', 'home_tourism', 'home_charter'
	)

);