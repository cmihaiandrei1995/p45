<?php
// Config for this section
$_section = array(
	'name'							=> "Categorii",

	'table' 						=> 'category',
	'id' 							=> 'id_category',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> true,
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

		'description' => array(
			'id'					=> 'description',
			'db_name'				=> 'description',
			'db_type'				=> 'text',
			'name' 					=> 'Descriere',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

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

		'zones' => array(
			'id'					=> 'zones',
			'db_name'				=> 'id_zone',
			'db_type'				=> 'int',
			'name' 					=> 'Zone',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_zone',

			'from_table'			=> 'zone',
			'from_id'				=> 'id_zone',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Zone',
			'placeholder'			=> 'Alege zone',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'cities' => array(
			'id'					=> 'cities',
			'db_name'				=> 'id_city',
			'db_type'				=> 'int',
			'name' 					=> 'Orase / Statiuni',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_city',

			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orase',
			'placeholder'			=> 'Alege orase',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'image' => array(
			'id'					=> 'image',
			'name' 					=> 'Imagini',
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

	),

	'view' => array(
		'title', 'description'
	)

);
