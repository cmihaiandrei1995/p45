<?php
// Config for this section
$_section = array(
	'name'							=> "Vouchere",

	'table' 						=> 'voucher',
	'id' 							=> 'id_voucher',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
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

		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod voucher',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Codul voucher-ului',
			'placeholder'			=> 'ex: UYAD5435FR3',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'offer_type' => array(
			'id'					=> 'offer_type',
			'db_name'				=> 'offer_type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip oferta',
			'type' 					=> 'select',
			'values'				=> array(
										'all' => 'Toate',
										'charter' => 'Charter',
										'circuit' => 'Circuit',
                                        'tourism' => 'Hotel',
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip reducere',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'countries' => array(
			'id'					=> 'countries',
			'db_name'				=> 'id_country',
			'db_type'				=> 'int',
			'name' 					=> 'Tari',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_country',

			'from_table'			=> 'country',
			'from_id'				=> 'id_country',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tari',
			'placeholder'			=> 'Alege tari',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

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
			'value' 				=> '',

            'show_if'				=> array(
										'id' => 'offer_type',
										'cmp' => 'NOT IN',
										'value' => array('circuit'),
									),
		),

		'id_cities_from' => array(
			'id'					=> 'id_cities_from',
			'db_name'				=> 'id_cities_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'Orase de plecare',
			'type' 					=> 'select_multiple',

  			'values'				=> $_cities_from_circuits,

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orase de plecare',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'offer_type',
										'cmp' => '==',
										'value' => 'charter',
									),
		),

        'hotels' => array(
			'id'					=> 'hotels',
			'db_name'				=> 'id_hotel',
			'db_type'				=> 'int',
			'name' 					=> 'Hoteluri',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_hotel',

			'from_table'			=> 'hotel',
			'from_id'				=> 'id_hotel',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Hoteluri',
			'placeholder'			=> 'Alege hoteluri',
			'icon'					=> 'hotel',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> '',

            'show_if'				=> array(
										'id' => 'offer_type',
										'cmp' => 'NOT IN',
										'value' => array('circuit'),
									),
		),

        'circuits' => array(
			'id'					=> 'circuits',
			'db_name'				=> 'id_circuit',
			'db_type'				=> 'int',
			'name' 					=> 'Circuite',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_circuit',

			'from_table'			=> 'circuit',
			'from_id'				=> 'id_circuit',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Circuite',
			'placeholder'			=> 'Alege circuite',
			'icon'					=> 'info',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> '',

            'show_if'				=> array(
										'id' => 'offer_type',
										'cmp' => '==',
										'value' => 'circuit',
									),
		),

		'date_from' => array(
			'id'					=> 'date_from',
			'db_name'				=> 'date_from',
			'db_type'				=> 'datetime',
			'name' 					=> 'Data start',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy ',
			'js_time_format'		=> 'HH:mm:ss',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data de inceput - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'date_to' => array(
			'id'					=> 'date_to',
			'db_name'				=> 'date_to',
			'db_type'				=> 'datetime',
			'name' 					=> 'Data sfarsit',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy ',
			'js_time_format'		=> 'HH:mm:ss',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data de sfarsit - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'date_from_trip' => array(
			'id'					=> 'date_from_trip',
			'db_name'				=> 'date_from_trip',
			'db_type'				=> 'datetime',
			'name' 					=> 'Data start calatorie',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy ',
			'js_time_format'		=> 'HH:mm:ss',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data de inceput - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'date_to_trip' => array(
			'id'					=> 'date_to_trip',
			'db_name'				=> 'date_to_trip',
			'db_type'				=> 'datetime',
			'name' 					=> 'Data sfarsit calatorie',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy ',
			'js_time_format'		=> 'HH:mm:ss',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data de sfarsit - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip reducere',
			'type' 					=> 'select',
			'values'				=> array(
										'percent' => 'Procentuala',
										'fixed' => 'Valorica (Fixa)',
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip reducere',
			'placeholder'			=> '',
			'icon'					=> 'percent',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'subtype' => array(
			'id'					=> 'subtype',
			'db_name'				=> 'subtype',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip aplicare',
			'type' 					=> 'select',
			'values'				=> array(
										'person' => 'De persoana',
										'booking' => 'Per rezervare'
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip aplicare',
			'placeholder'			=> '',
			'icon'					=> 'percent',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										'id' => 'type',
										'cmp' => '==',
										'value' => 'fixed',
									),
		),

		'apply_to_child' => array(
			'id'					=> 'apply_to_child',
			'db_name'				=> 'apply_to_child',
			'db_type'				=> 'varchar',
			'name' 					=> 'Se aplica si copiilor?',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu'
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Se aplica si copiilor?',
			'placeholder'			=> '',
			'icon'					=> 'percent',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> '',

			'show_if'				=> array(
										array(
											array(
												'id' => 'type',
												'cmp' => '==',
												'value' => 'fixed',
											),
											array(
												'id' => 'subtype',
												'cmp' => '==',
												'value' => 'person',
											),
										),
									),
		),

		'value' => array(
			'id'					=> 'value',
			'db_name'				=> 'value',
			'db_type'				=> 'double',
			'name' 					=> 'Valoare reducere',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'float',

			'tooltip'				=> 'Valoare reducere',
			'placeholder'			=> 'ex: 10',
			'icon'					=> 'money',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

		'max_usage' => array(
			'id'					=> 'max_usage',
			'db_name'				=> 'max_usage',
			'db_type'				=> 'int',
			'name' 					=> 'Nr maxim de folosire',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'int',

			'tooltip'				=> 'Nr maxim de folosire',
			'placeholder'			=> 'ex: 1',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

		'max_amount_per_person' => array(
			'id'					=> 'max_amount_per_person',
			'db_name'				=> 'max_amount_per_person',
			'db_type'				=> 'double',
			'name' 					=> 'Discount maxim de persoana',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'float',

			'tooltip'				=> 'Discount maxim de persoana',
			'placeholder'			=> 'ex: 99',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

		'cart_min_price' => array(
			'id'					=> 'cart_min_price',
			'db_name'				=> 'cart_min_price',
			'db_type'				=> 'double',
			'name' 					=> 'Pret minim rezervare',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'float',

			'tooltip'				=> 'Pret minim pentru aplicare',
			'placeholder'			=> 'ex: 0',
			'icon'					=> 'chevron-right',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

		'cart_max_price' => array(
			'id'					=> 'cart_max_price',
			'db_name'				=> 'cart_max_price',
			'db_type'				=> 'double',
			'name' 					=> 'Pret maxim rezervare',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'float',

			'tooltip'				=> 'Pret maxim pentru aplicare',
			'placeholder'			=> 'ex: 99',
			'icon'					=> 'chevron-left',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

        /*
		'allow_other_voucher' => array(
			'id'					=> 'allow_other_voucher',
			'db_name'				=> 'allow_other_voucher',
			'db_type'				=> 'int',
			'name' 					=> 'Folosire impreuna cu alte cupoane',
			'type' 					=> 'select',
			'values'				=> array(
										0 => _lng('no'),
										1 => _lng('yes'),
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Folosire impreuna cu alte cupoane',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/

		/*
		'apply_to_promo' => array(
			'id'					=> 'apply_to_promo',
			'db_name'				=> 'apply_to_promo',
			'db_type'				=> 'int',
			'name' 					=> 'Se aplica produselor promo?',
			'type' 					=> 'select',
			'values'				=> array(
										0 => _lng('no'),
										1 => _lng('yes'),
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Se aplica produselor promo?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/

		'used' => array(
			'id'					=> 'used',
			'db_name'				=> 'used',
			'db_type'				=> 'int',
			'name' 					=> 'Nr folosiri',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'int',

			'hidden'				=> true,
			'hidden_but_searchable' => true,

			'tooltip'				=> 'Nr folosiri',
			'placeholder'			=> 'ex: 1',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> '0',
		),

	),

	'view' => array(
		'title', 'date_from', 'date_to', 'type', 'value', 'used'
	)

);
