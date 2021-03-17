<?php
// Config for this section
$_section = array(
	'name'							=> "Boxuri avantaje",

	'table' 						=> 'box_avantaj',
	'id' 							=> 'id_box_avantaj',

	'use_active' 					=> true,
	'use_trash' 					=> true,
	'use_drafts'					=> false,
	'use_order' 					=> true,
	'use_seo'						=> false,
	'use_add'						=> false,
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

		'subtitle' => array(
			'id'					=> 'subtitle',
			'db_name'				=> 'subtitle',
			'db_type'				=> 'varchar',
			'name' 					=> 'Titlu mic',
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

		'description' => array(
            'id'                    => 'description',
            'db_name'               => 'description',
            'db_type'               => 'text',
            'name'                  => 'Descriere scurta',
            'type'                  => 'textarea',

            'required'              => false,
            'validation_rules'      => '',

            'use_wysiwyg'           => true,
            'tooltip'               => 'Descriere',
            'placeholder'           => 'ex: RO',
            'icon'                  => 'info',
            'size'                  => '',

            'lng'                   => array('ro'),
            'value'                 => ''
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
