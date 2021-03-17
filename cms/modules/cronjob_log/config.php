<?php
// Config for this section
$_section = array(
	'name'							=> "Log cronjob-uri",

	'table' 						=> 'cronjob_log',
	'id' 							=> 'id_cronjob_log',

	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> false,
	'use_delete'					=> false,

	'dependencies'					=> array(),

	'fields' => array(

		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip request',
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

        'executed_by' => array(
			'id'					=> 'executed_by',
			'db_name'				=> 'executed_by',
			'db_type'				=> 'int',
			'name' 					=> 'Executat de',
			'type' 					=> 'select',
			'values'				=> array(
										'cronjob' => 'Cronjob',
										'user' => 'User'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Executat de',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'id_admin_user' => array(
			'id'					=> 'id_admin_user',
			'db_name'				=> 'id_admin_user',
			'db_type'				=> 'int',
			'name' 					=> 'User',
			'type' 					=> 'select_db',

			'from_table'			=> 'admin_user',
			'from_id'				=> 'id_admin_user',
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

		'started_at' => array(
			'id'					=> 'started_at',
			'db_name'				=> 'started_at',
			'db_type'				=> 'varchar',
			'name' 					=> 'Inceput la',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy H:i:s',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data, ora',
			'placeholder'			=> '',
			'icon'					=> 'dayCalendar',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'finished_at' => array(
			'id'					=> 'finished_at',
			'db_name'				=> 'finished_at',
			'db_type'				=> 'varchar',
			'name' 					=> 'Terminat la',
			'type' 					=> 'datetime',

			'js_format'				=> 'dd.mm.yy H:i:s',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data, ora',
			'placeholder'			=> '',
			'icon'					=> 'dayCalendar',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'time_spent' => array(
			'id'					=> 'time_spent',
			'db_name'				=> 'time_spent',
			'db_type'				=> 'varchar',
			'name' 					=> 'Durata executie',
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

	),

	'view' => array(
		'title', 'executed_by', 'id_admin_user', 'started_at', 'finished_at', 'time_spent'
	)

);
