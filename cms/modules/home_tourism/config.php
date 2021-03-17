<?php
// Config for this section
$_section = array(
	'name'							=> "Turism individual",

	'table' 						=> 'home_tourism',
	'id' 							=> 'id_home_tourism',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> true,
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

		'id_zone' => array(
			'id'					=> 'id_zone',
			'db_name'				=> 'id_zone',
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

		'discount' => array(
			'id'					=> 'discount',
			'db_name'				=> 'discount',
			'db_type'				=> 'varchar',
			'name' 					=> 'Valoare reducere',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Valoare reducere',
			'placeholder'			=> 'ex: -20%',
			'icon'					=> 'money',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'discount_text' => array(
			'id'					=> 'discount_text',
			'db_name'				=> 'discount_text',
			'db_type'				=> 'varchar',
			'name' 					=> 'Text reducere',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Text reducere',
			'placeholder'			=> 'ex: De la / Pana la',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'offer_text' => array(
			'id'					=> 'offer_text',
			'db_name'				=> 'offer_text',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip oferta <br> (Maxim 2 cuvinte)',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip oferta',
			'placeholder'			=> 'ex: Last minute',
			'icon'					=> 'info',
			'size'					=> '25%',

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
											'width' => 550,
											'height' => 350
										),

									),

			'tooltip'				=> 'Upload magine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),
	),

	'view' => array(
		'image', 'title', 'id_country', 'id_zone'
	)

);
