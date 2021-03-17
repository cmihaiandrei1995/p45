<?php
// Config for this section
$_section = array(
	'name'							=> "Echipa",
	
	'table' 						=> 'team',
	'id' 							=> 'id_team',
	
	'use_active' 					=> true,
	'use_trash' 					=> true,
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
		
		'position' => array(
			'id'					=> 'position',
			'db_name'				=> 'position',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pozitie',
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
		
		'id_team_category' => array(						
			'id'					=> 'id_team_category',
			'db_name'				=> 'id_team_category',	
			'db_type'				=> 'int',		
			'name' 					=> 'Categorie',			
			'type' 					=> 'select_db',	
			
			'from_table'			=> 'team_category',
			'from_id'				=> 'id_team_category',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			
			'required' 				=> false,				
			'validation_rules' 		=> '',						
			
			'tooltip'				=> 'Categorie',				
			'placeholder'			=> 'Alege categorie',				
			'icon'					=> 'info',				
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),			
			'value' 				=> ''			
		),
		
		'image' => array(						
			'id'					=> 'image',				
			'name' 					=> 'Imagini',			
			'type' 					=> 'image',			
			'nr'					=> 1,	
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,			
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'resize'				=> true,
			'sizes'					=> array(	
										
										'thumb' => array(
											'width' => 97,
											'height' => 97
										),
									),
			
			'tooltip'				=> 'Upload magine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'image', 'title', 'position', 'email', 'id_team_category'
	),
	
	'order' => array(
		'title', 'position', 'id_team_category'
	),

);