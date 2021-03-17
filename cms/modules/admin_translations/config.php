<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('translations'),
	
	'table' 						=> 'admin_translation',
	'id' 							=> 'id_admin_translation',
	
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
			'name' 					=> _lng('key'),
			'type' 					=> 'text',
			'do_not_edit'			=> true,
			'hidden'				=> true,
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> '',
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
	),
	
	'view' => array_keys($_website_langs)

);

foreach(array_keys($_website_langs) as $lng){
	$_section['fields'][$lng] = array(
		'id'					=> $lng,
		'db_name'				=> $lng,
		'db_type'				=> 'text',
		'name' 					=> $_website_langs[$lng],
		'type' 					=> 'textarea',

		'required' 				=> true,
		'validation_rules' 		=> '',

		'use_wysiwyg'			=> false,
		'tooltip'				=> _lng('translation'),
		'icon'					=> 'pencil',

		'lng' 					=> array($lng_keys[0]),
		'value' 				=> ''
	);
}
