<?php
// Config for this section
$_section = array(
	'name'							=> "Turism intern",

	'table' 						=> 'home_tourism_intern',
	'id' 							=> 'id_home_tourism_intern',

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

		'id_city_tag' => array(
			'id'					=> 'id_city_tag',
			'db_name'				=> 'id_city_tag',
			'db_type'				=> 'int',
			'name' 					=> 'Tag destinatie',
			'type' 					=> 'select_db',

			'from_table'			=> 'city_tag',
			'from_id'				=> 'id_city_tag',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tag destinatie',
			'placeholder'			=> 'Alege tag',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'id_hotel_tag' => array(
			'id'					=> 'id_hotel_tag',
			'db_name'				=> 'id_hotel_tag',
			'db_type'				=> 'int',
			'name' 					=> 'Tag hotel',
			'type' 					=> 'select_db',

			'from_table'			=> 'hotel_tag',
			'from_id'				=> 'id_hotel_tag',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tag hotel',
			'placeholder'			=> 'Alege tag hotel',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'id_hotel_group_tag' => array(
			'id'					=> 'id_hotel_group_tag',
			'db_name'				=> 'id_hotel_group_tag',
			'db_type'				=> 'int',
			'name' 					=> 'Grup tag-uri',
			'type' 					=> 'select_db',

			'from_table'			=> 'hotel_group_tag',
			'from_id'				=> 'id_hotel_group_tag',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Grup tag-uri',
			'placeholder'			=> 'Alege grup tag-uri',
			'icon'					=> 'info',
			'use_ajax'				=> false,

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
										'big' => array(
											'width' => 550,
											'height' => 270
										),
										'small' => array(
											'width' => 360,
											'height' => 270
										)

									),

			'tooltip'				=> 'Upload magine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),
	),

	'view' => array(
		'image', 'title', 'id_city_tag', 'id_hotel_tag', 'id_hotel_group_tag'
	)

);
