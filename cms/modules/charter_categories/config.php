<?php
// Config for this section
$_section = array(
	'name'							=> "Categorii",

	'table' 						=> 'charter_category',
	'id' 							=> 'id_charter_category',

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

		'id_zone' => array(
			'id'					=> 'id_zone',
			'db_name'				=> 'id_zone',
			'db_type'				=> 'int',
			'name' 					=> 'Zone',
			'type' 					=> 'select_db',

			'from_table'			=> 'zone',
			'from_id'				=> 'id_zone',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'add_info'				=> array(),

			'required' 				=> true,
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
			'name' 					=> 'Plecare din',
			'type' 					=> 'select_db',

			'from_table'			=> 'city',
			'from_id'				=> 'id_city',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			'from_where'			=> 'AND id_country = 126',

			'add_info'				=> array(),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Oras',
			'placeholder'			=> 'Alege oras',
			'icon'					=> 'globe',
			'use_ajax'				=> false,

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

            'add_info'				=> array(
										array('id' => 'id_zone', 'table' => 'zone', 'field' => 'title', 'multilang' => false),
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Orase',
			'placeholder'			=> 'Alege orase',
			'icon'					=> 'globe',
			'use_ajax'				=> true,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'dates' => array(
			'id'					=> 'dates',
			'db_name'				=> 'dates',
			'db_type'				=> 'date',
			'name' 					=> 'Data',
			'type' 					=> 'date_multiple',
			'use_other_table'		=> '#table#_date',

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
			'value' 				=> ''
		),

	),

	'view' => array(
		'title', 'description', 'id_zone', 'id_city_from'
	)

);
