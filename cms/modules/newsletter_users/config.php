<?php
// Config for this section
$_section = array(
	'name'							=> "Abonati newsletter",

	'table' 						=> 'newsletter_user',
	'id' 							=> 'id_newsletter_user',

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

		'name' => array(
			'id'					=> 'name',
			'db_name'				=> 'name',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nume',
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

		'surname' => array(
			'id'					=> 'surname',
			'db_name'				=> 'surname',
			'db_type'				=> 'varchar',
			'name' 					=> 'Prenume',
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

		'email' => array(
			'id'					=> 'email',
			'db_name'				=> 'email',
			'db_type'				=> 'varchar',
			'name' 					=> 'Email',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'email',

			'tooltip'				=> 'Emailul persoanei',
			'placeholder'			=> 'ex: ceva@ceva.ro',
			'icon'					=> 'email',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'location' => array(
			'id'					=> 'location',
			'db_name'				=> 'location',
			'db_type'				=> 'varchar',
			'name' 					=> 'Locatie abonare',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Locatie abonare',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'name', 'surname', 'email', 'location'
	)

);
