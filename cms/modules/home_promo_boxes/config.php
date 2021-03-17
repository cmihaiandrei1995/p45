<?php
// Config for this section
$_section = array(
	'name'							=> "Boxuri promo",
	
	'table' 						=> 'home_promo_box',
	'id' 							=> 'id_home_promo_box',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> true,
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
		
		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> 'url',
			
			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'color' => array(
			'id'					=> 'color',
			'db_name'				=> 'color',
			'db_type'				=> 'varchar',
			'name' 					=> 'Culoare',
			'type' 					=> 'select',
			'values'				=> array(
										'blue' => 'Albastru',
										'orange' => 'Portocaliu', 
									),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Culoare',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'icon' => array(
			'id'					=> 'icon',
			'db_name'				=> 'icon',
			'db_type'				=> 'int',
			'name' 					=> 'Icon',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Ceas',
										'2' => 'Discount', 
										'3'	=> 'Ticket'
									),		
			
			'required' 				=> true,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Icon',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
	),
	
	'view' => array(
		'title'
	)

);