<?php

$lng_keys = array_keys($_website_langs);

// Config for this section
$_section = array(
	'name'							=> _lng('media_files'),
	
	'table' 						=> 'media',
	'id' 							=> 'id_media',
	
	'use_active' 					=> false,
	'use_trash' 					=> true,
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
			'name' 					=> _lng('title'),
			'type' 					=> 'text',
			
			'required' 				=> true,
			'unique_in_db'			=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> _lng('record_title'),
			'placeholder'			=> 'ex: Lorem ipsum',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array($lng_keys[0]),
			'value' 				=> ''
		),
		
		'file' => array(
			'id'					=> 'file',
			'db_name'				=> 'file',
			'db_type'				=> 'varchar',
			'name' 					=> _lng('file'),
			'type' 					=> 'file_simple',
			
			'required' 				=> true,
			'accepted_ext' 			=> array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'png', 'gif'),
			'use_random'			=> true,
			'folder'				=> $_base_path.'uploads/media/',
			'use_ymd_folder'		=> true,
			
			'tooltip'				=> _lng('upload_file'),
			'icon'					=> 'file',
			
			'lng' 					=> array($lng_keys[0])
		),
		
	),
	
	'view' => array(
		'title', 'file'
	)

);