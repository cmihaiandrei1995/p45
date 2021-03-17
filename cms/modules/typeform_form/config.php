<?php
// Config for this section
$_section = array(
	'name'							=> "Setari Typeform",

	'table' 						=> 'typeform_form',
	'id' 							=> 'id_typeform_form',

	'use_active' 					=> true,
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

			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'typeform_id' => array(
			'id'					=> 'typeform_id',
			'db_name'				=> 'typeform_id',
			'db_type'				=> 'varchar',
			'name' 					=> 'Id Typeform',
			'type' 					=> 'text',

			'required' 				=> false,
			'do_not_edit'			=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Id Typeform',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'title', 'typeform_id'
	)

);
