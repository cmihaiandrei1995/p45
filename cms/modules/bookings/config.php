<?php
// Config for this section
$_section = array(
	'name'							=> "Rezervari",

	'table' 						=> 'booking',
	'id' 							=> 'id_booking',

	'use_active' 					=> false,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> false,
	'use_delete'					=> true,

	'dependencies'					=> array(),

	'fields' => array(

		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nume complet',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Numele complet',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'email' => array(
			'id'					=> 'email',
			'db_name'				=> 'email',
			'db_type'				=> 'varchar',
			'name' 					=> 'Email',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'email',

			'tooltip'				=> 'Email user',
			'placeholder'			=> 'ex: nume.prenume@domeniu.ro',
			'icon'					=> 'mail',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'phone' => array(
			'id'					=> 'phone',
			'db_name'				=> 'phone',
			'db_type'				=> 'varchar',
			'name' 					=> 'Telefon',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Telefonul userului',
			'placeholder'			=> 'ex: (039)711 9480',
			'icon'					=> 'phone',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'id_user' => array(
			'id'					=> 'id_user',
			'db_name'				=> 'id_user',
			'db_type'				=> 'int',
			'name' 					=> 'Utilizator',
			'type' 					=> 'select_db',

			'from_table'			=> 'user',
			'from_id'				=> 'id_user',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Utilizator',
			'placeholder'			=> 'Alege utilizator',
			'icon'					=> 'users',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'total' => array(
			'id'					=> 'total',
			'db_name'				=> 'total',
			'db_type'				=> 'varchar',
			'name' 					=> 'Total (&euro;)',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Suma totala platita',
			'placeholder'			=> 'ex: 299',
			'icon'					=> 'money',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip rezervare',
			'type' 					=> 'select',
			'values'				=> array(
									'insurance' => 'Asigurare',
									'charter' => 'Charter',
									'circuit' => 'Circuit',
									'tourism' => 'Sejur'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip rezervare',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'status' => array(
			'id'					=> 'status',
			'db_name'				=> 'status',
			'db_type'				=> 'varchar',
			'name' 					=> 'Status',
			'type' 					=> 'select',
			'values'				=> $_booking_statuses,

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Status comanda',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'created' => array(
			'id'					=> 'created',
			'db_name'				=> 'created',
			'db_type'				=> 'varchar',
			'name' 					=> 'Data',
			'type' 					=> 'date',

			'js_format'				=> 'dd.mm.yy H:i:s',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Data comenzii',
			'placeholder'			=> '',
			'icon'					=> 'dayCalendar',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
	),

	'view' => array(
		'created', 'title', 'email', 'phone', 'type', 'total', 'status'
	)

);
