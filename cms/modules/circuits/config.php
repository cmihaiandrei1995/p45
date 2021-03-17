<?php
// Config for this section
$_section = array(
	'name'							=> "Circuite",

	'table' 						=> 'circuit',
	'id' 							=> 'id_circuit',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> true,
	'use_add'						=> false,
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

		'black_friday' => array(
			'id'					=> 'black_friday',
			'db_name'				=> 'black_friday',
			'db_type'				=> 'int',
			'name' 					=> 'Black friday',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu',
										'1' => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Black friday',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod Circuit',
			'type' 					=> 'text',

			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Cod Circuit',
			'placeholder'			=> 'ex: RO',
			'icon'					=> 'info',
			'size'					=> '25%',

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

		'cities' => array(
			'id'					=> 'cities',
			'db_name'				=> 'id_city',
			'db_type'				=> 'int',
			'name' 					=> 'Orase',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_city',

			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(
										//array('id' => 'id_country', 'table' => 'country', 'field' => 'title', 'multilang' => false),
									),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orase',
			'placeholder'			=> 'Alege orase',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'description' => array(
            'id'                    => 'description',
            'db_name'               => 'description',
            'db_type'               => 'text',
            'name'                  => 'Descriere scurta',
            'type'                  => 'textarea',

            'required'              => false,
            'do_not_edit'           => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Descriere hotel',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'labels' => array(
			'id'					=> 'labels',
			'db_name'				=> 'id_circuit_label',
			'db_type'				=> 'int',
			'name' 					=> 'Tag-uri',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_label',

			'from_table'			=> 'circuit_label',
			'from_id'				=> 'id_circuit_label',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tag-uri',
			'placeholder'			=> 'Alege tag',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'cities_from' => array(
			'id'					=> 'cities_from',
			'db_name'				=> 'id_city',
			'db_type'				=> 'int',
			'name' 					=> 'Plecari din',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_city_from',

			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			'from_where'			=> 'AND (id_country = 126 OR id_country = 62)',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orase',
			'placeholder'			=> 'Alege orase',
			'icon'					=> 'globe',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip circuit',
			'type' 					=> 'select',
			'values'				=> array(
										'plane' => 'Cu avionul',
										'bus' => 'Cu autocarul'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip circuit',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'airline' => array(
			'id'					=> 'airline',
			'db_name'				=> 'airline',
			'db_type'				=> 'varchar',
			'name' 					=> 'Companie zbor',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Companie zbor',
			'placeholder'			=> 'ex: Tarom',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		/*
		'expired' => array(
			'id'					=> 'expired',
			'db_name'				=> 'expired',
			'db_type'				=> 'int',
			'name' 					=> 'Locuri epuizate',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu',
										'1' => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Locuri epuizate',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/

		'min_person' => array(
			'id'					=> 'min_person',
			'db_name'				=> 'min_person',
			'db_type'				=> 'int',
			'name' 					=> 'Nr minim persoane',
			'type' 					=> 'text',

			'required' 				=> false,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr minim persoane',
			'placeholder'			=> 'ex: 30',
			'icon'					=> 'info',
			'size'					=> '15%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'days' => array(
			'id'					=> 'days',
			'db_name'				=> 'days',
			'db_type'				=> 'int',
			'name' 					=> 'Nr zile',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr zile',
			'placeholder'			=> 'ex: 30',
			'icon'					=> 'info',
			'size'					=> '15%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'nights' => array(
			'id'					=> 'nights',
			'db_name'				=> 'nights',
			'db_type'				=> 'int',
			'name' 					=> 'Nr nopti',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr nopti',
			'placeholder'			=> 'ex: 30',
			'icon'					=> 'info',
			'size'					=> '15%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		/*
		'last_chance' => array(
			'id'					=> 'last_chance',
			'db_name'				=> 'last_chance',
			'db_type'				=> 'int',
			'name' 					=> 'Ultimele locuri',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Ultimele X locuri',
			'placeholder'			=> 'ex: 3',
			'icon'					=> 'info',
			'size'					=> '15%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/

		'guides' => array(
			'id'					=> 'guides',
			'db_name'				=> 'guides',
			'db_type'				=> 'int',
			'name' 					=> 'Insotitori',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Insotitori',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'smart' => array(
			'id'					=> 'smart',
			'db_name'				=> 'smart',
			'db_type'				=> 'int',
			'name' 					=> 'Smart45',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu',
										'1' => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Smart45',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'effort' => array(
			'id'					=> 'effort',
			'db_name'				=> 'effort',
			'db_type'				=> 'varchar',
			'name' 					=> 'Grad efort',
			'type' 					=> 'select',
			'values'				=> array(
										'scazut' => 'Scazut',
										'mediu' => 'Mediu',
										'ridicat' => 'Ridicat'
			),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Grad efort',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'attractions' => array(
            'id'                    => 'attractions',
            'db_name'               => 'attractions',
            'db_type'               => 'text',
            'name'                  => 'Atractiile circuitului',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Atractiile circuitului',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'currency' => array(
			'id'					=> 'currency',
			'db_name'				=> 'currency',
			'db_type'				=> 'varchar',
			'name' 					=> 'Moneda',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Info moneda',
			'placeholder'			=> 'ex: EUR',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'papers_needed' => array(
			'id'					=> 'papers_needed',
			'db_name'				=> 'papers_needed',
			'db_type'				=> 'varchar',
			'name' 					=> 'Acte necesare',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Info acte',
			'placeholder'			=> 'ex: pasaport sau buletin',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'language' => array(
			'id'					=> 'language',
			'db_name'				=> 'language',
			'db_type'				=> 'varchar',
			'name' 					=> 'Limba',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Info limba',
			'placeholder'			=> 'ex: italiana',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'climate' => array(
			'id'					=> 'climate',
			'db_name'				=> 'climate',
			'db_type'				=> 'varchar',
			'name' 					=> 'Clima',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Info clima',
			'placeholder'			=> 'ex: continentala',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'itinerary_img' => array(
			'id'					=> 'itinerary_img',
			'db_name'				=> 'itinerary_img',
			'db_type'				=> 'varchar',
			'name' 					=> 'Imagine itinerariu',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'small' => array(
											'width' => 270,
											'height' => 270
										),

									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'included' => array(
            'id'                    => 'included',
            'db_name'               => 'included',
            'db_type'               => 'text',
            'name'                  => 'Inclus',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Inclus',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'not_included' => array(
            'id'                    => 'not_included',
            'db_name'               => 'not_included',
            'db_type'               => 'text',
            'name'                  => 'Neinclus',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Neinclus',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'financial_conditions' => array(
            'id'                    => 'financial_conditions',
            'db_name'               => 'financial_conditions',
            'db_type'               => 'text',
            'name'                  => 'Conditii financiare',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Conditii financiare',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'flight_info' => array(
            'id'                    => 'flight_info',
            'db_name'               => 'flight_info',
            'db_type'               => 'text',
            'name'                  => 'Orar de zbor',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Orar de zbor',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'optional_excursions' => array(
            'id'                    => 'optional_excursions',
            'db_name'               => 'optional_excursions',
            'db_type'               => 'text',
            'name'                  => 'Excursii optionale',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Excursii optionale',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'transfers' => array(
            'id'                    => 'transfers',
            'db_name'               => 'transfers',
            'db_type'               => 'text',
            'name'                  => 'Transferuri',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Transferuri',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'important_info' => array(
            'id'                    => 'important_info',
            'db_name'               => 'important_info',
            'db_type'               => 'text',
            'name'                  => 'Info importante',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Info importante',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '25%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'video' => array(
		   'id'                    => 'video',
		   'db_name'               => 'video',
		   'db_type'               => 'text',
		   'name'                  => 'Video Youtube',
		   'type'                  => 'text',

		   'required'              => false,
		   'validation_rules'      => '',

		   'tooltip'               => 'Video Youtube',
		   'placeholder'           => 'https://www.youtube.com/watch?v=kpkXIiwPMlg',
		   'icon'                  => 'youtube-play',
		   'size'                  => '50%',

		   'lng'                   => array('ro'),
		   'value'                 => ''
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
											'width' => 992,
											'height' => 480
										),
										'thumb' => array(
											'width' => 260,
											'height' => 165
										),
										'small' => array(
											'width' => 110,
											'height' => 60
										)
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

	),

	'view' => array(
		'image', 'title', 'code', 'type', 'id_country'//, 'id_city'
	)

);
