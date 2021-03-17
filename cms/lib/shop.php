<?
$_shop_sections['shop_products'] = array(
	'name' => 'Produse',
	'menu_class' => 'list-ul',

	'modules' => array(
		'shop_products' => array(
			'name' => 'Produse'
		),
		'shop_categories' => array(
			'name' => 'Categorii'
		),
	)
);
if(shop_get_config_key('use_brands')){
	$_shop_sections['shop_products']['modules']['shop_brands'] = array(
		'name' => 'Brand-uri'
	);
}

$_shop_sections['shop_orders'] = array(
	'name' => 'Comenzi',
	'menu_class' => 'money',

	'modules' => array(
		'shop_orders' => array(
			'name' => 'Comenzi'
		),
		'shop_reports' => array(
			'name' => 'Rapoarte'
		),
	)
);
if(shop_get_config_key('use_invoices')){
	$_shop_sections['shop_orders']['modules']['shop_invoices'] = array(
		'name' => 'Facturi'
	);
}

$_shop_sections['shop_discounts'] = array(
	'name' => 'Marketing',
	'menu_class' => 'percent',

	'modules' => array(
		'shop_home_blocks' => array(
			'name' => 'Produse homepage'
		),
		'shop_discount_rules' => array(
			'name' => 'Reguli discount-uri'
		),
		'shop_cart_discounts' => array(
			'name' => 'Promotii cos'
		),
	)
);
if(shop_get_config_key('use_vouchers')){
	$_shop_sections['shop_discounts']['modules']['shop_vouchers'] = array(
		'name' => 'Vouchere'
	);
}

$_shop_sections['shop_users'] = array(
	'name' => 'Clienti',
	'menu_class' => 'users',

	'modules' => array(
		'shop_users' => array(
			'name' => 'Clienti'
		),
	)
);

$_shop_sections['shop_config'] = array(
	'name' => 'Setari shop',
	'menu_class' => 'cog',

	'modules' => array(
		'shop_product_attributes' => array(
			'name' => 'Atribute / Filtre'
		),
		'shop_config' => array(
			'name' => 'Setari shop'
		),
		'shop_cart_alerts' => array(
			'name' => 'Mesaje cos'
		),
		'shop_delivery_times' => array(
			'name' => 'Timpi livrare'
		),
	)
);

// Put shop related items at the start
$_sections = array_merge($_shop_sections, $_sections);
