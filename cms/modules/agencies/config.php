<?php
// Config for this section
$_section = array(
	'name'							=> "Agentii",

	'table' 						=> 'agency',
	'id' 							=> 'id_agency',

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
			'from_where'			=> 'AND (id_country = 126 OR id_country = 94 OR id_country = 53)',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Oras',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'use_booking' => array(
            'id'                    => 'use_booking',
            'db_name'               => 'use_booking',
            'db_type'               => 'int',
            'name'                  => 'Apare la rezervare',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => true,
            'validation_rules'      => '',

            'tooltip'               => 'Apare la rezervare',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'address' => array(
			'id'					=> 'address',
			'db_name'				=> 'address',
			'db_type'				=> 'text',
			'name' 					=> 'Adresa',
			'type' 					=> 'textarea',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'phone' => array(
			'id'					=> 'phone',
			'db_name'				=> 'phone',
			'db_type'				=> 'text',
			'name' 					=> 'Contact',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'info_license' => array(
			'id'					=> 'info_license',
			'db_name'				=> 'info_license',
			'db_type'				=> 'text',
			'name' 					=> 'Info licente',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'map_x' => array(
			'id'					=> 'map_x',
			'db_name'				=> 'map_x',
			'db_type'				=> 'float',
			'name' 					=> 'Coordonata X',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Coordonata X',
			'placeholder'			=> 'ex: 45.13453',
			'icon'					=> 'info',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'map_y' => array(
			'id'					=> 'map_y',
			'db_name'				=> 'map_y',
			'db_type'				=> 'float',
			'name' 					=> 'Coordonata Y',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Coordonata Y',
			'placeholder'			=> 'ex: 24.43453',
			'icon'					=> 'info',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'team' => array(
			'id'					=> 'team',
			'db_name'				=> 'id_team',
			'db_type'				=> 'int',
			'name' 					=> 'Echipa',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_team',

			'from_table'			=> 'team',
			'from_id'				=> 'id_team',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Echipa',
			'placeholder'			=> 'Alege echipa',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'polita' => array(
			'id'					=> 'polita',
			'db_name'				=> 'polita',
			'db_type'				=> 'varchar',
			'name' 					=> 'Polita insolvabilitate',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'brevet' => array(
			'id'					=> 'brevet',
			'db_name'				=> 'brevet',
			'db_type'				=> 'varchar',
			'name' 					=> 'Brevet turism',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'licenta' => array(
			'id'					=> 'licenta',
			'db_name'				=> 'licenta',
			'db_type'				=> 'varchar',
			'name' 					=> 'Licenta turism',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'document1' => array(
			'id'					=> 'document1',
			'db_name'				=> 'document1',
			'db_type'				=> 'varchar',
			'name' 					=> 'Alte documente 1',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'document2' => array(
			'id'					=> 'document2',
			'db_name'				=> 'document2',
			'db_type'				=> 'varchar',
			'name' 					=> 'Alte documente 2',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

		'document3' => array(
			'id'					=> 'document3',
			'db_name'				=> 'document3',
			'db_type'				=> 'varchar',
			'name' 					=> 'Alte documente 3',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

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
										'large' => array(
											'width' => 490,
											'height' => auto
										),
										'medium' => array(
											'width' => 262,
											'height' => auto
										),
										'small' => array(
											'width' => 50,
											'height' => 40
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),


	),

	'view' => array(
		'image', 'title', 'id_city', 'description'
	)

);
