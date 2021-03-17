<?php
// Config for this section
$_section = array(
	'name'							=> "Slider",
	
	'table' 						=> 'home_slider',
	'id' 							=> 'id_home_slider',
	
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
		
		'url' => array(
			'id'					=> 'url',
			'db_name'				=> 'url',
			'db_type'				=> 'varchar',
			'name' 					=> 'Link',
			'type' 					=> 'text',
			
			'required' 				=> true,
			'validation_rules' 		=> 'url',
			
			'tooltip'				=> 'Link-ul ofertei',
			'placeholder'			=> 'ex: '.$_base,
			'icon'					=> 'link',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'show_mobile' => array(
			'id'					=> 'show_mobile',
			'db_name'				=> 'show_mobile',
			'db_type'				=> 'int',
			'name' 					=> 'Apare pe mobil?',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Da',
										'0' => 'Nu', 
									),		
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Apare pe mobil?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'banner' => array(
			'id'					=> 'banner',
			'db_name'				=> 'banner',
			'db_type'				=> 'varchar',
			'name' 					=> 'Banner promo',
			'type' 					=> 'image_simple',
			
			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'small' => array(
											'width' => 430,
											'height' => 300
										),
									),
			
			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
		'counter_expire' => array(								
			'id'					=> 'counter_expire',
			'db_name'				=> 'counter_expire',
			'db_type'				=> 'datetime',
			'name' 					=> 'Counter - Expirare',
			'type' 					=> 'datetime',
			
			'js_format'				=> 'dd.mm.yy ',
			'js_time_format'		=> 'HH:mm:ss',
			'db_format'				=> 'Y-m-d H:i:s',
			
			'changeMonth'			=> 'false',
			'changeYear'			=> 'false',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Data - Format: zz.ll.aaaa',
			'placeholder'			=> 'ex: 19.10.2012',
			'icon'					=> 'dayCalendar',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_title' => array(
			'id'					=> 'counter_title',
			'db_name'				=> 'counter_title',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Titlu',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlu',
			'placeholder'			=> 'ex: Promo',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_subtitle' => array(
			'id'					=> 'counter_subtitle',
			'db_name'				=> 'counter_subtitle',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Subtitlu',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Subtitlu',
			'placeholder'			=> 'ex: Primavara reducerilor',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_title_reduction' => array(
			'id'					=> 'counter_title_reduction',
			'db_name'				=> 'counter_title_reduction',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Titlu reducere',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Titlu reducere',
			'placeholder'			=> 'ex: Reduceri',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_subtitle_reduction' => array(
			'id'					=> 'counter_subtitle_reduction',
			'db_name'				=> 'counter_subtitle_reduction',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Subtitlu reducere',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Subtitlu reducere',
			'placeholder'			=> 'ex: de pana la',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_reduction_text' => array(
			'id'					=> 'counter_reduction_text',
			'db_name'				=> 'counter_reduction_text',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Valoare reducere',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Valoare reducere',
			'placeholder'			=> 'ex: -30%',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'counter_incentive' => array(
			'id'					=> 'counter_incentive',
			'db_name'				=> 'counter_incentive',
			'db_type'				=> 'varchar',
			'name' 					=> 'Counter - Incentive',
			'type' 					=> 'text',
			
			'required' 				=> false,
			'validation_rules' 		=> '',
			
			'tooltip'				=> 'Incentive',
			'placeholder'			=> 'ex: Grabeste-te, locuri limitate!',
			'icon'					=> 'pencil',
			'size'					=> '',
			
			'lng' 					=> array('ro'),
			'value' 				=> ''
		),
		
		'image' => array(						
			'id'					=> 'image',				
			'name' 					=> 'Imagine',			
			'type' 					=> 'image',			
			'nr'					=> 1,	
			'use_other_table'		=> '#table#_img',
			
			'required' 				=> 0,			
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'resize'				=> true,
			'sizes'					=> array(	
										'big' => array(
											'width' => 1920,
											'height' => 600
										),
										'small' => array(
											'width' => 360,
											'height' => 144
										),
										
									),
			
			'tooltip'				=> 'Upload magine',		
			'icon'					=> 'image2',
			
			'lng' 					=> array('ro')
		),
		
	),
	
	'view' => array(
		'image', 'title'
	)

);