<?php
// Config for this section
$_section = array(
	'name'							=> "Agentii",

	'table' 						=> 'agency_partner',
	'id' 							=> 'id_agency_partner',

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
			'from_where'			=> 'AND id_country = 126',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Oras',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'judet' => array(
            'id'                    => 'judet',
            'db_name'               => 'judet',
            'db_type'               => 'int',
            'name'                  => 'Judet',
            'type'                  => 'select',
            'values'                => array_combine($_judete, $_judete),

            'required'              => true,
            'validation_rules'      => '',

            'tooltip'               => 'Judet',
            'placeholder'           => '',
            'icon'                  => 'pencil',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'adress' => array(
			'id'					=> 'adress',
			'db_name'				=> 'adress',
			'db_type'				=> 'varchar',
			'name' 					=> 'Adresa',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Adresa agentiei',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'info',
			'size'					=> '50%',

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
			'validation_rules' 		=> '',

			'tooltip'				=> 'email',
			'placeholder'			=> 'ex: ceva@ceva.ro',
			'icon'					=> 'email',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'phone' => array(
			'id'					=> 'phone',
			'db_name'				=> 'phone',
			'db_type'				=> 'varchar',
			'name' 					=> 'Telefon',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Telefon',
			'placeholder'			=> 'ex: 021.123.45.67',
			'icon'					=> 'info',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Web',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'url',

			'tooltip'				=> 'Link website',
			'placeholder'			=> 'ex: http://www.ceva.ro',
			'icon'					=> 'info',
			'size'					=> '50%',

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
											'width' => 103,
											'height' => 39
										),

									),

			'tooltip'				=> 'Upload magine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

	),

	'view' => array(
		'image', 'title', 'id_city'
	)

);
