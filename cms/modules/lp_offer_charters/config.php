<?php
// Config for this section
$_section = array(
	'name'							=> "Oferte chartere hotel",

	'table' 						=> 'lp_offer_charter',
	'id' 							=> 'id_lp_offer_charter',

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
            'from_where'            => ' AND type = 2 ',

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

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Zona',
			'placeholder'			=> 'Alege zona',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

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

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Hotel',
			'placeholder'			=> 'Alege hotel',
			'icon'					=> 'hotel',
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

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Oras plecare',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'meal' => array(
			'id'					=> 'meal',
			'db_name'				=> 'meal',
			'db_type'				=> 'varchar',
			'name' 					=> 'Masa',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Masa info',
			'placeholder'			=> 'ex: all inclusive',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'offer_from' => array(
			'id'					=> 'offer_from',
			'db_name'				=> 'offer_from',
			'db_type'				=> 'date',
			'name' 					=> 'Data plecare',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'offer_to' => array(
			'id'					=> 'offer_to',
			'db_name'				=> 'offer_to',
			'db_type'				=> 'date',
			'name' 					=> 'Data retur',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

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

		'depart_from' => array(
			'id'					=> 'depart_from',
			'db_name'				=> 'depart_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Plecare din',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Plecare din',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'globe',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'price' => array(
			'id'					=> 'price',
			'db_name'				=> 'price',
			'db_type'				=> 'int',
			'name' 					=> 'Pret de la',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'int',

			'tooltip'				=> 'Pret de la',
			'placeholder'			=> 'ex: 199',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'price_old' => array(
			'id'					=> 'price_old',
			'db_name'				=> 'price_old',
			'db_type'				=> 'int',
			'name' 					=> 'Pret vechi',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'int',

			'tooltip'				=> 'Pret vechi',
			'placeholder'			=> 'ex: 299',
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

	),

	'view' => array(
		'title', 'id_lp', 'id_lp_offer_zone', 'id_zone', 'id_hotel'
	),

	'order' => array(
		'title', 'id_hotel'
	)

);
