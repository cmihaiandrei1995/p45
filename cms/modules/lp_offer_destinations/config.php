<?php
// Config for this section
$_section = array(
	'name'							=> "Oferte destinatii",

	'table' 						=> 'lp_offer_destination',
	'id' 							=> 'id_lp_offer_destination',

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

        'id_lp_offer_zone' => array(
			'id'					=> 'id_lp_offer_zone',
			'db_name'				=> 'id_lp_offer_zone',
			'db_type'				=> 'int',
			'name' 					=> 'Zona oferte',
			'type' 					=> 'select_db',

			'from_table'			=> 'lp_offer_zone',
			'from_id'				=> 'id_lp_offer_zone',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
            'from_where'            => ' AND type = 1 ',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'add_info'				=> array(
                                        array('id' => 'id_lp', 'table' => 'lp', 'field' => 'title', 'multilang' => false),
                                    ),

			'tooltip'				=> 'Zona oferte',
			'placeholder'			=> 'Alege zona',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip',
			'type' 					=> 'select',
			'values'				=> array(
										'charter' => 'Charter',
										'hotel' => 'Hotel'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip',
			'placeholder'			=> '',
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

		'id_city_from' => array(
			'id'					=> 'id_city_from',
			'db_name'				=> 'id_city_from',
			'db_type'				=> 'int',
			'name' 					=> 'Oras plecare',
			'type' 					=> 'select',
			'values'				=> $_cities_from_circuits,

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Oras plecare',
			'placeholder'			=> 'Alege oras',
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

		'date' => array(
			'id'					=> 'date',
			'db_name'				=> 'date',
			'db_type'				=> 'date',
			'name' 					=> 'Plecare',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> date('d.m.Y')
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
		'image', 'title', 'id_lp', 'id_lp_offer_zone', 'type', 'id_zone'
	)

);
