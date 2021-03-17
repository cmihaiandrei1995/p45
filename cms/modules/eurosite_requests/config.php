<?php
// Config for this section
$_section = array(
	'name'							=> "Log request-uri",
	
	'table' 						=> 'eurosite_request',
	'id' 							=> 'id_eurosite_request',
	
	'use_active' 					=> false,
	'use_trash' 					=> false,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> false,
	'use_add'						=> false,
	'use_edit'						=> false,
	'use_delete'					=> true,
	
	'dependencies'					=> array(),
	
	'fields' => array(
	
		'title' => array(
			'id'					=> 'title',
			'db_name'				=> 'title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Tip request',
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
		
		'created' => array(						
			'id'					=> 'created',
			'db_name'				=> 'created',		
			'db_type'				=> 'varchar',			
			'name' 					=> 'Data',			
			'type' 					=> 'date',	
			
			'js_format'				=> 'dd.mm.yy H:i:s',
			'db_format'				=> 'Y-m-d H:i:s',	
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',	
			
			'required' 				=> true,		
			'validation_rules' 		=> '',			
			
			'tooltip'				=> 'Data, ora',		
			'placeholder'			=> '',						
			'icon'					=> 'dayCalendar',			
			'use_ajax'				=> false,				
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''			
		),
		
		'request' => array(
			'id'					=> 'request',
			'db_name'				=> 'request',
			'db_type'				=> 'text',
			'name' 					=> 'Request',
			'type' 					=> 'textarea',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'use_wysiwyg'			=> false,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		/*		
		'status' => array(										
			'id'					=> 'status',				
			'db_name'				=> 'status',					
			'db_type'				=> 'varchar',			
			'name' 					=> 'Status',			
			'type' 					=> 'text',			
			
			'required' 				=> true,		
			'validation_rules' 		=> '',			
			
			'tooltip'				=> 'Status',		
			'placeholder'			=> 'ex: Lorem ipsum',	
			'icon'					=> 'pencil',		
			'size'					=> '',				
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''					
		),
		
		'error_message' => array(										
			'id'					=> 'error_message',				
			'db_name'				=> 'error_message',					
			'db_type'				=> 'varchar',			
			'name' 					=> 'Mesaj eroare',			
			'type' 					=> 'text',			
			
			'required' 				=> true,		
			'validation_rules' 		=> '',			
			
			'tooltip'				=> 'Mesaj eroare',		
			'placeholder'			=> 'ex: Lorem ipsum',	
			'icon'					=> 'pencil',		
			'size'					=> '',				
			
			'lng' 					=> array('ro'),		
			'value' 				=> ''					
		),
		*/
	),
	
	'view' => array(
		'title', 'created'
	)

);