<?php
// Config for this section
$_section = array(
	'name'							=> "Useri",
	
	'table' 						=> 'user',
	'id' 							=> 'id_user',
	
	'use_active' 					=> true,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
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
		
		'password' => array(
			'id'					=> 'password',
			'db_name'				=> 'password',
			'db_type'				=> 'varchar',
			'name' 					=> 'Parola',	
			'type' 					=> 'password',	
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Parola utilizatorului',
			'placeholder'			=> 'ex: 4cjr374ycn',
			'icon'					=> 'key',
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
		
		/*
		'address' => array(								
			'id'					=> 'address',		
			'db_name'				=> 'address',		
			'db_type'				=> 'varchar',		
			'name' 					=> 'Adresa',				
			'type' 					=> 'text',					
			
			'required' 				=> false,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Adresa userului',		
			'placeholder'			=> 'ex: Strada Lorem ipsum nr 15',	
			'icon'					=> 'gmaps',			
			'size'					=> '50%',			
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
		),
		
		'city' => array(								
			'id'					=> 'city',		
			'db_name'				=> 'city',		
			'db_type'				=> 'varchar',		
			'name' 					=> 'Oras',				
			'type' 					=> 'text',					
			
			'required' 				=> false,		
			'validation_rules' 		=> '',					
			
			'tooltip'				=> 'Orasul userului',		
			'placeholder'			=> 'ex: Bucuresti',	
			'icon'					=> 'globe',			
			'size'					=> '50%',			
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''				
		),
		
		'county' => array(
			'id'					=> 'county',
			'db_name'				=> 'county',
			'db_type'				=> 'varchar',
			'name' 					=> 'Judet',
			'type' 					=> 'select',
			'values'				=> array_combine($_judete, $_judete),		
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Judetul userului',
			'placeholder'			=> '',
			'icon'					=> 'globe',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		*/
		
		
		
		
		
		
	),
	
	'view' => array(
		'title', 'email', 'phone'
	)

);