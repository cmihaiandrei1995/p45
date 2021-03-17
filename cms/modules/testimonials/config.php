<?php
// Config for this section
$_section = array(
	'name'							=> "Testimoniale",

	'table' 						=> 'testimonial',
	'id' 							=> 'id_testimonial',

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

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

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

		'rating' => array(
            'id'                    => 'rating',
            'db_name'               => 'rating',
            'db_type'               => 'int',
            'name'                  => 'Rating',
            'type'                  => 'select',
            'values'                => array(
                                        '1' => '1',
                                        '2' => '2',
										'3' => '3',
										'4' => '4',
										'5' => '5',
                                    ),

            'required'              => false,
            'validation_rules'      => '',

            'tooltip'               => 'Rating',
            'placeholder'           => '',
            'icon'                  => 'info',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
         ),

		'reply' => array(
			'id'					=> 'reply',
			'db_name'				=> 'reply',
			'db_type'				=> 'text',
			'name' 					=> 'Raspuns paralela',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'name' => array(
			'id'					=> 'name',
			'db_name'				=> 'name',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nume',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Numele clientului',
			'placeholder'			=> 'ex: Popescu Ion',
			'icon'					=> 'user',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'email' => array(
			'id'					=> 'email',
			'db_name'				=> 'email',
			'db_type'				=> 'varchar',
			'name' 					=> 'Email',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'email',

			'tooltip'				=> 'Emailul clientului',
			'placeholder'			=> 'ex: ceva@ceva.ro',
			'icon'					=> 'mail',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'date' => array(
			'id'					=> 'date',
			'db_name'				=> 'date',
			'db_type'				=> 'date',
			'name' 					=> 'Data',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> date('d.m.Y')
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

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orasul',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'guides' => array(
			'id'					=> 'guides',
			'db_name'				=> 'id_guide',
			'db_type'				=> 'int',
			'name' 					=> 'Ghizi',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_guide',

			'from_table'			=> 'guide',
			'from_id'				=> 'id_guide',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Ghizi',
			'placeholder'			=> 'Alege ghizi',
			'icon'					=> 'users',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
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

										'small' => array(
											'width' => 44,
											'height' => 30
										),
									),

			'tooltip'				=> 'Upload magine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

	),

	'view' => array(
		'title', 'description'
	)

);
