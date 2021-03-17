<?php
// Config for this section
$_section = array(
	'name'							=> 'Setari scadente',

	'table' 						=> 'config_installment',
	'id' 							=> 'id_config_installment',

	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> true,
	'use_delete'					=> false,

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
			'do_not_edit'			=> true,

			'tooltip'				=> 'Titlu',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'percent' => array(
			'id'					=> 'percent',
			'db_name'				=> 'percent',
			'db_type'				=> 'varchar',
			'name' 					=> 'Procent',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'int',

			'tooltip'				=> 'Valoare',
			'placeholder'			=> 'ex: 25',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'days_before' => array(
			'id'					=> 'days_before',
			'db_name'				=> 'days_before',
			'db_type'				=> 'varchar',
			'name' 					=> 'Zile inainte de sejur',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> 'int',

			'tooltip'				=> 'Zile inainte de sejur',
			'placeholder'			=> 'ex: 60',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'title', 'percent', 'days_before'
	)

);