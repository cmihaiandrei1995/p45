<?php
// Config for this section
$_section = array(
	'name'							=> 'Config',

	'table' 						=> 'config',
	'id' 							=> 'id_config',

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

		'key' => array(
			'id'					=> 'key',
			'db_name'				=> 'key',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cheie',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',
			'do_not_edit'			=> true,

			'tooltip'				=> 'Cheie',
			'placeholder'			=> 'ex: loremipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'value' => array(
			'id'					=> 'value',
			'db_name'				=> 'value',
			'db_type'				=> 'varchar',
			'name' 					=> 'Valoare',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Valoare',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'key', 'value'
	)

);