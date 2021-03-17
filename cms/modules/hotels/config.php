<?php
// Config for this section
$_section = array(
	'name'							=> "Hoteluri",

	'table' 						=> 'hotel',
	'id' 							=> 'id_hotel',

	'use_active' 					=> true,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
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

		'black_friday_tourism' => array(
			'id'					=> 'black_friday_tourism',
			'db_name'				=> 'black_friday_tourism',
			'db_type'				=> 'int',
			'name' 					=> 'Black friday Turism',
			'type' 					=> 'select',
			'values'				=> array(
										'0' => 'Nu',
										'1' => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Black friday Turism',
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
			'name' 					=> 'Cod Hotel',
			'type' 					=> 'text',

			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Cod Hotel',
			'placeholder'			=> 'ex: RO',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'tourop_code' => array(
			'id'					=> 'tourop_code',
			'db_name'				=> 'tourop_code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod Turoperator',
			'type' 					=> 'text',

			'required' 				=> true,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Cod Turoperator',
			'placeholder'			=> 'ex: P45',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'recommended' => array(
            'id'                    => 'recommended',
            'db_name'               => 'recommended',
            'db_type'               => 'int',
            'name'                  => 'Recomandat',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => true,
            'validation_rules'      => '',

            'tooltip'               => 'Recomandat',
            'placeholder'           => '',
            'icon'                  => 'star',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
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

		'id_city' => array(
			'id'					=> 'id_city',
			'db_name'				=> 'id_city',
			'db_type'				=> 'int',
			'name' 					=> 'Oras',
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

			'tooltip'				=> 'Orasul',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'description' => array(
            'id'                    => 'description',
            'db_name'               => 'description',
            'db_type'               => 'text',
            'name'                  => 'Descriere',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Descriere hotel',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'stars' => array(
			'id'					=> 'stars',
			'db_name'				=> 'stars',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nr stele',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr stele',
			'placeholder'			=> 'ex: 3',
			'icon'					=> 'star',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'senior' => array(
            'id'                    => 'senior',
            'db_name'               => 'senior',
            'db_type'               => 'int',
            'name'                  => 'Pentru seniori?',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => true,
            'validation_rules'      => '',

            'tooltip'               => 'Pentru seniori?',
            'placeholder'           => '',
            'icon'                  => 'info',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
         ),

		'senior_info' => array(
            'id'                    => 'senior_info',
            'db_name'               => 'senior_info',
            'db_type'               => 'text',
            'name'                  => 'Info Seniori Charter',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Info Seniori Charter',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'other_info' => array(
            'id'                    => 'other_info',
            'db_name'               => 'other_info',
            'db_type'               => 'text',
            'name'                  => 'Alte informatii',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Alte informatii',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'room_info' => array(
            'id'                    => 'room_info',
            'db_name'               => 'room_info',
            'db_type'               => 'text',
            'name'                  => 'Dotari camere',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Dotari camere',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'localization' => array(
            'id'                    => 'localization',
            'db_name'               => 'localization',
            'db_type'               => 'text',
            'name'                  => 'Localizare',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Localizare',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'kids_info' => array(
            'id'                    => 'kids_info',
            'db_name'               => 'kids_info',
            'db_type'               => 'text',
            'name'                  => 'Facilitati copii',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Facilitati copii',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'hotel_info' => array(
            'id'                    => 'hotel_info',
            'db_name'               => 'hotel_info',
            'db_type'               => 'text',
            'name'                  => 'Facilitati hotel',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Facilitati hotel',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'beach_info' => array(
            'id'                    => 'beach_info',
            'db_name'               => 'beach_info',
            'db_type'               => 'text',
            'name'                  => 'Info plaja',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Info plaja',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'meal_info' => array(
            'id'                    => 'meal_info',
            'db_name'               => 'meal_info',
            'db_type'               => 'text',
            'name'                  => 'Info masa',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Info masa',
            'icon'                  => 'info',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'address' => array(
            'id'                    => 'address',
            'db_name'               => 'address',
            'db_type'               => 'text',
            'name'                  => 'Adresa',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Adresa',
            'placeholder'           => 'Adresa',
            'icon'                  => 'globe',
            'size'                  => '50%',

            'lng'                   => array('ro'),
            'value'                 => ''
         ),

         'phone' => array(
            'id'                    => 'phone',
            'db_name'               => 'phone',
            'db_type'               => 'text',
            'name'                  => 'Telefon',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Telefon',
            'placeholder'           => 'Telefon',
            'icon'                  => 'phone',
            'size'                  => '50%',

            'lng'                   => array('ro'),
            'value'                 => ''
         ),

         'email' => array(
            'id'                    => 'email',
            'db_name'               => 'email',
            'db_type'               => 'text',
            'name'                  => 'E-mail',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'E-mail',
            'placeholder'           => 'E-mail',
            'icon'                  => 'envelope',
            'size'                  => '50%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'website' => array(
            'id'                    => 'website',
            'db_name'               => 'website',
            'db_type'               => 'text',
            'name'                  => 'Website',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Website',
            'placeholder'           => 'http://website.com',
            'icon'                  => 'globe',
            'size'                  => '50%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'latitude' => array(
            'id'                    => 'latitude',
            'db_name'               => 'latitude',
            'db_type'               => 'text',
            'name'                  => 'Latitudine',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Latitudine',
            'placeholder'           => 'Latitudine',
            'icon'                  => 'globe',
            'size'                  => '50%',

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'longitude' => array(
            'id'                    => 'longitude',
            'db_name'               => 'longitude',
            'db_type'               => 'text',
            'name'                  => 'Longitudine',
            'type'                  => 'text',

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Longitudine',
            'placeholder'           => 'Longitudine',
            'icon'                  => 'globe',
            'size'                  => '50%',

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

		'video_local' => array(
		   'id'                    => 'video_local',
		   'db_name'               => 'video_local',
		   'db_type'               => 'text',
		   'name'                  => 'Video Local',
		   'type'                  => 'text',

		   'required'              => false,
		   'validation_rules'      => '',

		   'tooltip'               => 'Video Local',
		   'placeholder'           => 'nume fisier.mp4',
		   'icon'                  => 'youtube-play',
		   'size'                  => '50%',

		   'lng'                   => array('ro'),
		   'value'                 => ''
		),

        'beach' => array(
            'id'                    => 'beach',
            'db_name'               => 'beach',
            'db_type'               => 'int',
            'name'                  => 'Hotel plaja',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Hotel plaja',
            'placeholder'           => '',
            'icon'                  => 'building',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
         ),

		'spa' => array(
            'id'                    => 'spa',
            'db_name'               => 'spa',
            'db_type'               => 'int',
            'name'                  => 'Spa',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Spa',
            'placeholder'           => '',
            'icon'                  => 'info',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		/*
        'pets' => array(
            'id'                    => 'pets',
            'db_name'               => 'pets',
            'db_type'               => 'int',
            'name'                  => 'Animale companie',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Animale companie',
            'placeholder'           => '',
            'icon'                  => 'paw',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),
		*/

        'aqua_park' => array(
            'id'                    => 'aqua_park',
            'db_name'               => 'aqua_park',
            'db_type'               => 'int',
            'name'                  => 'Aqua Park',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Aqua Park',
            'placeholder'           => '',
            'icon'                  => 'tint',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'parking' => array(
            'id'                    => 'parking',
            'db_name'               => 'parking',
            'db_type'               => 'int',
            'name'                  => 'Parcare',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Parcare',
            'placeholder'           => '',
            'icon'                  => 'car',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'wifi' => array(
            'id'                    => 'wifi',
            'db_name'               => 'wifi',
            'db_type'               => 'int',
            'name'                  => 'Wi-fi',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Wi-fi',
            'placeholder'           => '',
            'icon'                  => 'wifi',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'internet' => array(
            'id'                    => 'internet',
            'db_name'               => 'internet',
            'db_type'               => 'int',
            'name'                  => 'Internet',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Internet',
            'placeholder'           => '',
            'icon'                  => 'wifi',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'fitness' => array(
            'id'                    => 'fitness',
            'db_name'               => 'fitness',
            'db_type'               => 'int',
            'name'                  => 'Fitness',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Fitness',
            'placeholder'           => '',
            'icon'                  => 'bicycle',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'pool_indoor' => array(
            'id'                    => 'pool_indoor',
            'db_name'               => 'pool_indoor',
            'db_type'               => 'int',
            'name'                  => 'Piscina interioara',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Piscina interioara',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'pool_outside' => array(
            'id'                    => 'pool_outside',
            'db_name'               => 'pool_outside',
            'db_type'               => 'int',
            'name'                  => 'Piscina exterioara',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Piscina exterioara',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		/*
        'beach_sand' => array(
            'id'                    => 'beach_sand',
            'db_name'               => 'beach_sand',
            'db_type'               => 'int',
            'name'                  => 'Plaja cu nisip',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Plaja cu nisip',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),
		*/

        'air_conditioner' => array(
            'id'                    => 'air_conditioner',
            'db_name'               => 'air_conditioner',
            'db_type'               => 'int',
            'name'                  => 'Aer conditionat',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Aer conditionat',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'restaurant' => array(
            'id'                    => 'restaurant',
            'db_name'               => 'restaurant',
            'db_type'               => 'int',
            'name'                  => 'Restaurant',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Restaurant',
            'placeholder'           => '',
            'icon'                  => 'cutlery',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

        'restaurant_a_la_carte' => array(
            'id'                    => 'restaurant_a_la_carte',
            'db_name'               => 'restaurant_a_la_carte',
            'db_type'               => 'int',
            'name'                  => 'Restaurant a la carte',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Restaurant a la carte',
            'placeholder'           => '',
            'icon'                  => 'cutlery',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
		),

        'kids_hotel' => array(
            'id'                    => 'kids_hotel',
            'db_name'               => 'kids_hotel',
            'db_type'               => 'int',
            'name'                  => 'Facilitati copii',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Facilitati copii',
            'placeholder'           => '',
            'icon'                  => 'child',
            'use_ajax'              => false,

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
		'image', 'title', 'id_city', 'id_country', 'code', 'tourop_code'
	)

);
