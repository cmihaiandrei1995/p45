<?php
// Config for this section
$_section = array(
	'name'							=> "LP Zone oferte",

	'table' 						=> 'lp_offer_zone',
	'id' 							=> 'id_lp_offer_zone',

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

        'id_lp' => array(
			'id'					=> 'id_lp',
			'db_name'				=> 'id_lp',
			'db_type'				=> 'int',
			'name' 					=> 'Landing page',
			'type' 					=> 'select_db',

			'from_table'			=> 'lp',
			'from_id'				=> 'id_lp',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Landing page',
			'placeholder'			=> 'Alege landing page',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'int',
			'name' 					=> 'Tip oferte',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Charter + sejur',
										'2' => 'Of speciale hotel chartere',
                                        '3' => 'Circuite',
                                        '4' => 'Bilete avion',
										'5' => 'Zona text',
										'6' => 'Zona video'
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip oferte',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'subtitle' => array(
			'id'					=> 'subtitle',
			'db_name'				=> 'subtitle',
			'db_type'				=> 'varchar',
			'name' 					=> 'Subtitlu',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Subtitlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('1', '2', '3', '4'),
									),
		),

        'icon_bus' => array(
			'id'					=> 'icon_bus',
			'db_name'				=> 'icon_bus',
			'db_type'				=> 'int',
			'name' 					=> 'Icon Bus?',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu',
									),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Icon Bus?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('1', '2', '3', '4'),
									),
		),

        'icon_plane' => array(
			'id'					=> 'icon_plane',
			'db_name'				=> 'icon_plane',
			'db_type'				=> 'int',
			'name' 					=> 'Icon Avion?',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu',
									),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Icon Avion?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('1', '2', '3', '4'),
									),
		),

		'button_title' => array(
			'id'					=> 'button_title',
			'db_name'				=> 'button_title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu buton',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Titlul butonului',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('1', '2', '3', '4'),
									),
		),

		'button_url' => array(
			'id'					=> 'button_url',
			'db_name'				=> 'button_url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link buton',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'url',

			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('1', '2', '3', '4'),
									),
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
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('5'),
									),
		),

		'url_video' => array(
			'id'					=> 'url_video',
			'db_name'				=> 'url_video',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link video',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'url',

			'tooltip'				=> 'Link-ul videoului',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('6'),
									),
		),

		'bg_video' => array(
			'id'					=> 'bg_video',
			'db_name'				=> 'bg_video',
			'db_type'				=> 'varchar',
			'name' 					=> 'Background video',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 1170,
											'height' => 600
										)
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro'),

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => 'IN',
										'value' => array('6'),
									),
		),

	),

	'view' => array(
		'title', 'type', 'id_lp'
	)

);
