<?php
// Config for this section
$_section = array(
	'name'							=> "LP Oferte bilete",

	'table' 						=> 'lp_offer_plane',
	'id' 							=> 'id_lp_offer_plane',

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

        'id_lp' => array(
			'id'					=> 'id_lp',
			'db_name'				=> 'id_lp',
			'db_type'				=> 'int',
			'name' 					=> 'Landing page',
			'type' 					=> 'select_db',

			'from_table'			=> 'lp',
			'from_id'				=> 'id_lp',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Landing page',
			'placeholder'			=> 'Alege landing page',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'id_lp_offer_zone' => array(
			'id'					=> 'id_lp_offer_zone',
			'db_name'				=> 'id_lp_offer_zone',
			'db_type'				=> 'int',
			'name' 					=> 'Zona oferte',
			'type' 					=> 'select_db',

			'from_table'			=> 'lp_offer_zone',
			'from_id'				=> 'id_lp_offer_zone',
			'from_multilang'		=> false,
			'from_field'			=> 'title',
			'from_order_by'			=> 'title',
			'from_order_how'		=> 'asc',
			'from_where'            => ' AND type = 4 ',

			'required' 				=> true,
			'validation_rules' 		=> '',

            'add_info'				=> array(
                                        array('id' => 'id_lp', 'table' => 'lp', 'field' => 'title', 'multilang' => false),
                                    ),

			'tooltip'				=> 'Zona oferte',
			'placeholder'			=> 'Alege zona',
			'icon'					=> 'info',
			'use_ajax'				=> false,

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

        'discount' => array(
            'id'					=> 'discount',
            'db_name'				=> 'discount',
            'db_type'				=> 'varchar',
            'name' 					=> 'Valoare reducere',
            'type' 					=> 'text',

            'required' 				=> false,
            'validation_rules' 		=> '',

            'tooltip'				=> 'Valoare reducere',
            'placeholder'			=> 'ex: -20%',
            'icon'					=> 'money',
            'size'					=> '25%',

            'lng' 					=> array('ro'),
            'value' 				=> ''
        ),

        'discount_text' => array(
            'id'					=> 'discount_text',
            'db_name'				=> 'discount_text',
            'db_type'				=> 'varchar',
            'name' 					=> 'Text reducere',
            'type' 					=> 'text',

            'required' 				=> false,
            'validation_rules' 		=> '',

            'tooltip'				=> 'Text reducere',
            'placeholder'			=> 'ex: De la / Pana la',
            'icon'					=> 'info',
            'size'					=> '25%',

            'lng' 					=> array('ro'),
            'value' 				=> ''
        ),

        'offer_text' => array(
            'id'					=> 'offer_text',
            'db_name'				=> 'offer_text',
            'db_type'				=> 'varchar',
            'name' 					=> 'Tip oferta <br> (Maxim 2 cuvinte)',
            'type' 					=> 'text',

            'required' 				=> false,
            'validation_rules' 		=> '',

            'tooltip'				=> 'Tip oferta',
            'placeholder'			=> 'ex: Last minute',
            'icon'					=> 'info',
            'size'					=> '25%',

            'lng' 					=> array('ro'),
            'value' 				=> ''
        ),

        'new' => array(
            'id'					=> 'new',
            'db_name'				=> 'new',
            'db_type'				=> 'int',
            'name' 					=> 'Nou?',
            'type' 					=> 'select',
            'values'				=> array(
                                        0 => 'Nu',
                                        1 => 'Da'
            ),

            'required' 				=> true,
            'validation_rules' 		=> '',

            'tooltip'				=> 'Nou?',
            'placeholder'			=> '',
            'icon'					=> 'info',
            'use_ajax'				=> false,

            'lng' 					=> array('ro'),
            'value' 				=> ''
        ),

        'special_text' => array(
            'id'					=> 'special_text',
            'db_name'				=> 'special_text',
            'db_type'				=> 'varchar',
            'name' 					=> 'Text special',
            'type' 					=> 'text',

            'required' 				=> false,
            'validation_rules' 		=> '',

            'tooltip'				=> 'Text special',
            'placeholder'			=> 'ex: Unic in Romania',
            'icon'					=> 'info',
            'size'					=> '25%',

            'lng' 					=> array('ro'),
            'value' 				=> ''
        ),

        'leaving_txt' => array(
			'id'					=> 'leaving_txt',
			'db_name'				=> 'leaving_txt',
			'db_type'				=> 'varchar',
			'name' 					=> 'Plecari din',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Plecari din',
			'placeholder'			=> 'ex: Bucuresti, Cluj',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'leaving_dates' => array(
			'id'					=> 'leaving_dates',
			'db_name'				=> 'leaving_dates',
			'db_type'				=> 'varchar',
			'name' 					=> 'Date plecare',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Date plecare',
			'placeholder'			=> 'ex: 16.06 - 19.07',
			'icon'					=> 'pencil',
			'size'					=> '',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'icon_plane' => array(
			'id'					=> 'icon_plane',
			'db_name'				=> 'icon_plane',
			'db_type'				=> 'int',
			'name' 					=> 'Icon Avion',
			'type' 					=> 'select',
			'values'				=> array(
										'1' => 'Dus',
                                        '2' => 'Intors',
										'3' => 'Dus-intors',
									),

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Icon Avion?',
			'placeholder'			=> '',
			'icon'					=> 'info',
			'use_ajax'				=> false,

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'price' => array(
			'id'					=> 'price',
			'db_name'				=> 'price',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pret de la',
			'type' 					=> 'text',

			'required' 				=> true,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Pret de la',
			'placeholder'			=> 'ex: 199',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'price_old' => array(
			'id'					=> 'price_old',
			'db_name'				=> 'price_old',
			'db_type'				=> 'varchar',
			'name' 					=> 'Pret vechi',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Pret vechi',
			'placeholder'			=> 'ex: 299',
			'icon'					=> 'info',
			'size'					=> '25%',

			'lng' 					=> array('ro'),
			'value' 				=> ''
		),

        'nights' => array(
			'id'					=> 'nights',
			'db_name'				=> 'nights',
			'db_type'				=> 'int',
			'name' 					=> 'Nr nopti',
			'type' 					=> 'text',

			'required' 				=> false,
			'validation_rules' 		=> '',

			'tooltip'				=> 'Nr nopti',
			'placeholder'			=> 'ex: 5',
			'icon'					=> 'info',
			'size'					=> '25%',

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
                                        'medium' => array(
                                            'width' => 550,
                                            'height' => 350
                                        ),
										'small' => array(
											'width' => 260,
											'height' => 210
										),

									),

			'tooltip'				=> 'Upload magine',
			'icon'					=> 'image2',

			'lng' 					=> array('ro')
		),

	),

	'view' => array(
		'image', 'title', 'id_lp', 'id_lp_offer_zone'
	)

);
