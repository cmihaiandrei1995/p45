<?php
// Config for this section
$_section = array(
	'name'							=> "Filtre mese charter",

	'table' 						=> 'charter_filters_meal_group',
	'id' 							=> 'id_charter_filters_meal_group',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
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

        'tags' => array(
			'id'					=> 'tags',
			'db_name'				=> 'tags',
			'db_type'				=> 'varchar',
			'name' 					=> 'Cuvinte cheie',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Cuvinte cheie',
			'placeholder'			=> 'ex: masa, dejun',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'title', 'tags'
	)

);
