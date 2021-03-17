<?php
// Config for this section
$_section = array(
	'name'							=> "Landing pages",

	'table' 						=> 'lp',
	'id' 							=> 'id_lp',

	'use_active' 					=> true,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> false,
	'use_seo'						=> true,
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

        'slug' => array(
			'id'					=> 'slug',
			'db_name'				=> 'slug',
			'db_type'				=> 'varchar',
			'name' 					=> 'Slug link',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> 'generate_name',

			'tooltip'				=> 'Forma link-ului',
			'placeholder'			=> 'ex: lorem-ipsum-dolor',
			'icon'					=> 'link',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

		'bg_lp' => array(
			'id'					=> 'bg_lp',
			'db_name'				=> 'bg_lp',
			'db_type'				=> 'varchar',
			'name' 					=> 'Background LP',
			'type' 					=> 'image_simple',

			'required' 				=> 0,
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),
			'use_ymd_folder'		=> true,
			'resize'				=> true,
			'sizes'					=> array(
										'big' => array(
											'width' => 1920,
											'height' => ''
										)
									),

			'tooltip'				=> 'Upload imagine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro'),

		),

		'show_rate' => array(
            'id'                    => 'show_rate',
            'db_name'               => 'show_rate',
            'db_type'               => 'int',
            'name'                  => 'Afiseaza box rate',
            'type'                  => 'select',
            'values'                => array(
                                        '0' => 'Nu',
                                        '1' => 'Da',
                                    ),

            'required'              => true,
            'validation_rules'      => '',

            'tooltip'               => 'Box rate',
            'placeholder'           => '',
            'icon'                  => 'info',
            'use_ajax'              => false,

            'lng'                   => array('ro'),
            'value'                 => ''
        ),

		'title_footer' => array(
			'id'					=> 'title_footer',
			'db_name'				=> 'title_footer',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu footer',
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

		'disclaimer' => array(
			'id'					=> 'disclaimer',
			'db_name'				=> 'disclaimer',
			'db_type'				=> 'text',
			'name' 					=> 'Disclaimer footer',
			'type' 					=> 'textarea',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'use_wysiwyg'			=> true,
			'tooltip'				=> 'Continut articol',
			'icon'					=> 'imagesList',

			'lng' 					=> array('ro'),
			'value' 				=> '',
		),

	),

	'view' => array(
		'title'
	)

);
