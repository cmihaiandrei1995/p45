<?php
// Config for this section
$_section = array(
	'name'							=> "Tari",

	'table' 						=> 'city_insurance_country',
	'id' 							=> 'id_city_insurance_country',

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
            'do_not_edit'           => true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Titlul inregistrarii',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'is_paralela' => array(
			'id'					=> 'is_paralela',
			'db_name'				=> 'is_paralela',
			'db_type'				=> 'int',
			'name' 					=> 'Tara Paralela45',
			'type' 					=> 'select',
			'values'				=> array(
										0 => 'Nu',
										1 => 'Da',
			),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tara Paralela45',
			'placeholder'			=> 'Alege',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),


	),

	'view' => array(
		'title', 'is_paralela'
	)

);
