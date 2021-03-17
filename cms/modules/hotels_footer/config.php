<?php
// Config for this section
$_section = array(
	'name'							=> "Hoteluri footer",

	'table' 						=> 'hotel_footer',
	'id' 							=> 'id_hotel_footer',

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

        'id_hotel' => array(
			'id'					=> 'id_hotel',
			'db_name'				=> 'id_hotel',
			'db_type'				=> 'int',
			'name' 					=> 'Hotel',
			'type' 					=> 'select_db',

			'from_table'			=> 'hotel',
			'from_id'				=> 'id_hotel',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(
										array('id' => 'id_city', 'table' => 'city', 'field' => 'title', 'multilang' => false),
									),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Hotel',
			'placeholder'			=> 'Alege hotel',
			'icon'					=> 'hotel',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

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

        'zone' => array(
			'id'					=> 'zone',
			'db_name'				=> 'zone',
			'db_type'				=> 'varchar',
			'name' 					=> 'Zona',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Zona',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'url',

			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'show_icon' => array(
			'id'					=> 'show_icon',
			'db_name'				=> 'show_icon',
			'db_type'				=> 'int',
			'name' 					=> 'Icon play',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu',
									),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Icon play',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

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
			'resize'				=> false,
			'sizes'					=> array(
                                        'big' => array(
                                            'width' => 900,
                                            'height' => 500
                                        ),
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
		'image', 'id_hotel', 'title'
	)

);
