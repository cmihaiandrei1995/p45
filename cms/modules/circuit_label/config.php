<?php
// Config for this section
$_section = array(
	'name'							=> "Tag-uri",
	
	'table' 						=> 'circuit_label',
	'id' 							=> 'id_circuit_label',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> true,
	
	'dependencies'					=> array(
										'circuit_to_label' => 'id_circuit_label',
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
		
		'is_category' => array(
            'id'                    => 'is_category',
            'db_name'               => 'is_category',
            'db_type'               => 'int',
            'name'                  => 'E categorie?',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu', 
                                        '1' => 'Da',
                                    ),      
            
            'required'              => false,
            'validation_rules'      => '',
            
            'tooltip'               => 'E categorie?',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,
            
            'lng'                   => array('ro'),
            'value'                 => ''
        ),
        
		'is_special' => array(
            'id'                    => 'is_special',
            'db_name'               => 'is_special',
            'db_type'               => 'int',
            'name'                  => 'E tip sarbatoare?',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu', 
                                        '1' => 'Da',
                                    ),      
            
            'required'              => false,
            'validation_rules'      => '',
            
            'tooltip'               => 'E tip sarbatoare?',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,
            
            'lng'                   => array('ro'),
            'value'                 => ''
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
		'title', 'is_category', 'is_special'
	)

);