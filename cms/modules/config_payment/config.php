<?php
// Config for this section
$_section = array(
	'name'							=> 'Setari plata in rate',

	'table' 						=> 'config_payment',
	'id' 							=> 'id_config_payment',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> false,

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

			'tooltip'				=> 'Titlu',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'key' => array(
			'id'					=> 'key',
			'db_name'				=> 'key',
			'db_type'				=> 'varchar',
			'name' 					=> 'Identificator',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'generate_name',
			'do_not_edit'			=> true,

			'tooltip'				=> 'Identificator',
			'placeholder'			=> 'ex: lorem-ipsum',
			'icon'					=> 'pencil',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'installments' => array(
			'id'					=> 'installments',
			'db_name'				=> 'installments',
			'db_type'				=> 'varchar',
			'name' 					=> 'Optiuni rate',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Optiuni rate',
			'placeholder'			=> 'ex: 2,3,6,12',
			'icon'					=> 'pencil',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'type' => array(
            'id'                    => 'type',
            'db_name'               => 'type',
            'db_type'               => 'varchar',
            'name'                  => 'Procesator',
            'type'                  => 'select',
            'values'                => array(
                                        'euplatesc' => 'Euplatesc', 
                                        'mobilpay' => 'Mobilpay',
                                    ),      
            
            'required'              => true,
            'validation_rules'      => '',
            
            'tooltip'               => 'Procesator',
            'placeholder'           => '',
            'icon'                  => 'info',
            'use_ajax'              => false,
            
            'lng'                   => array('ro'),
            'value'                 => ''
        ),
        
		'logo' => array(							
			'id'					=> 'logo',
			'db_name'				=> 'logo',
			'db_type'				=> 'varchar',
			'name' 					=> 'Logo mic',
			'type' 					=> 'image_simple',
			
			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 110,
											'height' => 35
										),
										'small' => array(
											'width' => 'auto',
											'height' => 35
										)
									),
			
			'tooltip'				=> 'Upload imagine',			
			'icon'					=> 'image2',					
			
			'lng' 					=> array('ro')				
		),
		
	),

	'view' => array(
		'title', 'type', 'installments'
	)

);