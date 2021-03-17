<?php
// Config for this section
$_section = array(
	'name'							=> "Comenzi vouchere",

	'table' 						=> 'voucher_order',
	'id' 							=> 'id_voucher_order',

	'use_active' 					=> false,
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

        'address' => array(
			'id'					=> 'address',
			'db_name'				=> 'address',
			'db_type'				=> 'varchar',
			'name' 					=> 'Adresa',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Adresa',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'city' => array(
			'id'					=> 'city',
			'db_name'				=> 'city',
			'db_type'				=> 'varchar',
			'name' 					=> 'Localitate',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Localitate',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'name_from' => array(
			'id'					=> 'name_from',
			'db_name'				=> 'name_from',
			'db_type'				=> 'varchar',
			'name' 					=> 'De la',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'De la',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'name_for' => array(
			'id'					=> 'name_for',
			'db_name'				=> 'name_for',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pentru',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Pentru',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'message' => array(
			'id'					=> 'message',
			'db_name'				=> 'message',
			'db_type'				=> 'text',
			'name' 					=> 'Mesaj',
			'type' 					=> 'textarea',

  			'required' 				=> true,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> false,
			'tooltip'				=> 'Mesaj',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'type' => array(
			'id'					=> 'type',
			'db_name'				=> 'type',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip voucher',
			'type' 					=> 'select',
			'values'				=> array(
	                                    'general' => 'General',
										'aniversare' => 'Aniversare',
										'nunta' => 'Nunta',
										'sarbatori' => 'Sarbatori',
										'paste' => 'Paste',
										'valentines' => 'Valentines',
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip voucher',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'value' => array(
			'id'					=> 'value',
			'db_name'				=> 'value',
			'db_type'				=> 'varchar',
			'name' 					=> 'Valoare (&euro;)',
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

		'code' => array(
			'id'					=> 'code',
			'db_name'				=> 'code',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cod voucher',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Codul voucher-ului',
			'placeholder'			=> 'ex: UYAD5435FR3',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'payment' => array(
			'id'					=> 'payment',
			'db_name'				=> 'payment',
			'db_type'				=> 'varchar',
			'name' 					=> 'Plata',
			'type' 					=> 'select',
			'values'				=> array(
									'euplatesc' => 'Euplatesc',
									'rate' => 'In rate'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tip plata',
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

			'js_format'				=> 'd.m.yy H:i:s',
			'db_format'				=> 'Y-m-d H:i:s',

			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',

			'required' 				=> false,
            'hidden'                => true,
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
		'created', 'title', 'email', 'phone', 'type', 'value', 'payment', 'status'
	)

);
