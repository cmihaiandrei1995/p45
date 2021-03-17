<?php
// Config for this section
$_section = array(
	'name'							=> "Zone",

	'table' 						=> 'zone',
	'id' 							=> 'id_zone',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> false,

	'dependencies'					=> array(
										'city' => 'id_zone',
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

		'title_homepage' => array(
			'id'					=> 'title_homepage',
			'db_name'				=> 'title_homepage',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu homepage',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'id_country' => array(
			'id'					=> 'id_country',
			'db_name'				=> 'id_country',
			'db_type'				=> 'int',
			'name' 					=> 'Tara',
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

		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod Zona',
			'type' 					=> 'text',

			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Cod Zona',
			'placeholder'			=> 'ex: RO',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'charter_type' => array(
			'id'					=> 'charter_type',
			'db_name'				=> 'charter_type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip link charter',
			'type' 					=> 'select',
			'values'				=> array(
										'charter' => 'Charter',
										'sejur' => 'Sejur'
			),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip link',
			'placeholder'			=> 'Alege tip link',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'charter_min_nights' => array(
			'id'					=> 'charter_min_nights',
			'db_name'				=> 'charter_min_nights',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr min nopti pret charter',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr min nopti pret charter',
			'placeholder'			=> 'ex: 7',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'hide_assistance' => array(
			'id'					=> 'hide_assistance',
			'db_name'				=> 'hide_assistance',
			'db_type'				=> 'varchar',
			'name' 					=> 'Ascunde asistenta',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu',
										'1' => 'Da'
			),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Ascunde asistenta',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

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

		'description' => array(
			'id'					=> 'description',
			'db_name'				=> 'description',
			'db_type'				=> 'text',
			'name' 					=> 'Descriere - Charter',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'excursion' => array(
			'id'					=> 'excursion',
			'db_name'				=> 'excursion',
			'db_type'				=> 'text',
			'name' 					=> 'Excursii optionale - Charter',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		/*
		'included_services' => array(
			'id'					=> 'included_services',
			'db_name'				=> 'included_services',
			'db_type'				=> 'text',
			'name' 					=> 'Servicii incluse (chartere)',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'transfers' => array(
			'id'					=> 'transfers',
			'db_name'				=> 'transfers',
			'db_type'				=> 'text',
			'name' 					=> 'Transferuri (chartere)',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'info_usefull' => array(
			'id'					=> 'info_usefull',
			'db_name'				=> 'info_usefull',
			'db_type'				=> 'text',
			'name' 					=> 'Informatii utile (chartere)',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'financial_terms' => array(
			'id'					=> 'financial_terms',
			'db_name'				=> 'financial_terms',
			'db_type'				=> 'text',
			'name' 					=> 'Conditii financiare (chartere)',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/

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
		'title', 'id_country', 'code', 'home_tourism', 'home_charter'
	)

);
