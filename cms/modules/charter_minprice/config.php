<?php
// Config for this section
$_section = array(
	'name'							=> "Preturi chartere",

	'table' 						=> 'charter_minprice',
	'id' 							=> 'id_charter_minprice',

	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
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

			'required' 				=> true,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Hotel',
			'placeholder'			=> 'Alege hotel',
			'icon'					=> 'hotel',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod hotel',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Cod hotel',
			'placeholder'			=> 'ex: TR1234',
			'icon'					=> 'info',
			'size'					=> '25%',

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

            'do_not_edit'           => true,

			'tooltip'				=> 'Oras plecare',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'date_from' => array(
			'id'					=> 'date_from',
			'db_name'				=> 'date_from',
			'db_type'				=> 'date',
			'name' 					=> 'Data plecare',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'date_to' => array(
			'id'					=> 'date_to',
			'db_name'				=> 'date_to',
			'db_type'				=> 'date',
			'name' 					=> 'Data retur',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy',
			'db_format'				=> 'Y-m-d',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Data curenta - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',

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

		'price' => array(
			'id'					=> 'price',
			'db_name'				=> 'price',
			'db_type'				=> 'float',
			'name' 					=> 'Pret final',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Pret final',
			'placeholder'			=> 'ex: 123.33',
			'icon'					=> 'money',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'priceNoRedd' => array(
			'id'					=> 'priceNoRedd',
			'db_name'				=> 'priceNoRedd',
			'db_type'				=> 'float',
			'name' 					=> 'Pret vechi',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

            'do_not_edit'           => true,

			'tooltip'				=> 'Pret vechi',
			'placeholder'			=> 'ex: 123.33',
			'icon'					=> 'money',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'description' => array(
			'id'					=> 'description',
			'db_name'				=> 'description',
			'db_type'				=> 'varchar',
			'name' 					=> 'Text reducere',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Text reducere',
			'placeholder'			=> 'ex: Reducere EB pana la 30.08',
			'icon'					=> 'info',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),



	),

	'view' => array(
		'id_hotel', 'code', 'id_city_from', 'date_from', 'date_to', 'black_friday'
	)

);
