<?php
// Config for this section
$_section = array(
	'name'							=> "LP Oferte circuite",

	'table' 						=> 'lp_offer_circuit',
	'id' 							=> 'id_lp_offer_circuit',

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
            'from_where'            => ' AND type = 3 ',

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

        'id_circuit' => array(
			'id'					=> 'id_circuit',
			'db_name'				=> 'id_circuit',
			'db_type'				=> 'int',
			'name' 					=> 'Circuit',
			'type' 					=> 'select_db',

			'from_table'			=> 'circuit',
			'from_id'				=> 'id_circuit',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Circuit',
			'placeholder'			=> 'Alege circuit',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'last_places' => array(
			'id'					=> 'last_places',
			'db_name'				=> 'last_places',
			'db_type'				=> 'int',
			'name' 					=> 'Ultimele locuri',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Ultimele locuri',
			'placeholder'			=> 'ex: 5',
			'icon'					=> 'user',
			'size'					=> '20%',

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

	),

	'view' => array(
		'title', 'id_lp', 'id_lp_offer_zone', 'id_circuit'
	)

);
