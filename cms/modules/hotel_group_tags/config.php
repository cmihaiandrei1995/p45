<?php
// Config for this section
$_section = array(
	'name'							=> "Grupe tag-uri",

	'table' 						=> 'hotel_group_tag',
	'id' 							=> 'id_hotel_group_tag',

	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> true,
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

		'id_hotel_tag' => array(
			'id'					=> 'id_hotel_tag',
			'db_name'				=> 'id_hotel_tag',
			'db_type'				=> 'int',
			'name' 					=> 'Tag hotel',
			'type' 					=> 'select_db_multiple',
			'use_other_table'		=> '#table#_to_hotel_tag',

			'from_table'			=> 'hotel_tag',
			'from_id'				=> 'id_hotel_tag',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Tag hotel',
			'placeholder'			=> 'Alege tag hotel',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

	),

	'view' => array(
		'title',
	)

);
