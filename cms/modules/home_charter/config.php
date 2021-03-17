<?php
// Config for this section
$_section = array(
	'name'							=> "Chartere",

	'table' 						=> 'home_charter',
	'id' 							=> 'id_home_charter',

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

		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'url',

			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',

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

		'from_cazare' => array(
			'id'					=> 'from_cazare',
			'db_name'				=> 'from_cazare',
			'db_type'				=> 'int',
			'name' 					=> 'Din cazare',
			'type' 					=> 'select',
			'values'				=> array(
										0 => 'Nu',
										1 => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Din cazare',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

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

		'new' => array(
			'id'					=> 'new',
			'db_name'				=> 'new',
			'db_type'				=> 'int',
			'name' 					=> 'Nou?',
			'type' 					=> 'select',
			'values'				=> array(
										0 => 'Nu',
										1 => 'Da'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nou?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'special_text' => array(
			'id'					=> 'special_text',
			'db_name'				=> 'special_text',
			'db_type'				=> 'varchar',
			'name' 					=> 'Text special',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Text special',
			'placeholder'			=> 'ex: Unic in Romania',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'cities_from' => array(
			'id'					=> 'cities_from',
			'db_name'				=> 'id_city',
			'db_type'				=> 'int',
			'name' 					=> 'Plecari din <br> (Maxim 4 orase)',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_city_from',

			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			'from_where'			=> 'AND id_country = 126',

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

		'logo' => array(
			'id'					=> 'logo',
			'db_name'				=> 'logo',
			'db_type'				=> 'varchar',
			'name' 					=> 'Logo companie',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'small' => array(
											'width' => 88,
											'height' => 30
										),
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
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
		'image', 'title'
	)

);
