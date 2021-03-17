<?php
// Config for this section
$_section = array(
	'name'							=> "Concurs voteaza",

	'table' 						=> 'user_contest_vote',
	'id' 							=> 'id_user_contest_vote',

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

		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nume complet',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Numele utilizatorului',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'name' => array(
			'id'					=> 'name',
			'db_name'				=> 'name',
			'db_type'				=> 'varchar',
			'name' 					=> 'Nume',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nume',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'surname' => array(
			'id'					=> 'surname',
			'db_name'				=> 'surname',
			'db_type'				=> 'varchar',
			'name' 					=> 'Prenume',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Prenume',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '50%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'email' => array(
			'id'					=> 'email',
			'db_name'				=> 'email',
			'db_type'				=> 'varchar',
			'name' 					=> 'Email',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'email',

			'tooltip'				=> 'Emailul utilizatorului',
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

        'newsletter' => array(
			'id'					=> 'newsletter',
			'db_name'				=> 'newsletter',
			'db_type'				=> 'varchar',
			'name' 					=> 'Newsletter',
			'type' 					=> 'select',
			'values'				=> array(
										1 => 'Da',
										0 => 'Nu'
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Abonat newsletter',
			'placeholder'			=> 'Alege newsletter',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
	),

	'view' => array(
		'title', 'email', 'phone', 'newsletter'
	)

);
