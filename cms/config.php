<?php
// Available actions
$_actions = array('view', 'add', 'edit', 'order', 'delete');


// Widgets for dashboard
$_widgets = array(
	'general_stats',
	'analytics',
	'prlg',
);

// Define main sections of the CMS with its subsections
$_sections = array(

	'countries' => array(
		'name' => 'Destinatii / Programe',
		'menu_class' => 'globe',

		'modules' => array(
			'continents' => array(
				'name' => 'Continente'
			),
			'countries' => array(
				'name' => 'Tari'
			),
			'zones' => array(
				'name' => 'Zone'
			),
			'cities' => array(
				'name' => 'Orase'
			),
			'city_tags' => array(
				'name' => 'Tag-uri destinatii'
			),
			'categories' => array(
				'name' => 'Categorii / Programe'
			),
			'charter_categories' => array(
				'name' => 'Categorii Chartere'
			),
		)
	),

	'hotels' => array(
		'name' => 'Hoteluri',
		'menu_class' => 'hotel',

		'modules' => array(
			'hotels' => array(
				'name' => 'Hoteluri'
			),
			'hotel_tags' => array(
				'name' => 'Tab-uri hoteluri'
			),
			'hotel_group_tags' => array(
				'name' => 'Grupe tag-uri'
			),
			'charter_minprice' => array(
				'do_not_show' => true,
				'name' => 'Preturi chartere'
			),
		)
	),

	'circuits' => array(
		'name' => 'Circuite',
		'menu_class' => 'exchange',

		'modules' => array(
			'circuits' => array(
				'name' => 'Circuite'
			),
			'circuit_label' => array(
				'name' => 'Tag-uri',
			),
			'circuit_day_description' => array(
				'name' => 'Descrieri pe zile',
				'do_not_show' => true
			),
		)
	),

	'tickets' => array(
		'name' => 'Bilete avion',
		'menu_class' => 'plane',

		'modules' => array(
			'tickets' => array(
				'name' => 'Bilete avion'
			),
			'ticket_companies' => array(
				'name' => 'Companii'
			),
		)
	),

	'cruises' => array(
		'name' => 'Croaziere',
		'menu_class' => 'ship',

		'modules' => array(
			'cruise_categories' => array(
				'name' => 'Categorii'
			),
			'cruises' => array(
				'name' => 'Croaziere'
			),
			'cruise_lines' => array(
				'name' => 'Linii de croaziera'
			),
			'cruise_ships' => array(
				'name' => 'Vase de croaziera'
			),
			'cruise_decks' => array(
				'name' => 'Punti'
			),
			'cruise_cabins' => array(
				'name' => 'Cabine'
			),
			'cruise_destinations' => array(
				'name' => 'Destinatii'
			),
			'cruise_ports' => array(
				'name' => 'Porturi'
			),
			'cruise_excursions' => array(
				'name' => 'Excursii optionale'
			),
		)
	),

	/*
	'generali_products' => array(
		'name' => 'Asigurari',
		'menu_class' => 'heartbeat',

		'modules' => array(
			'generali_products' => array(
				'name' => 'Asigurari'
			),
			'generali_countries' => array(
				'name' => 'Tari'
			),
		)
	),
	*/

	'city_insurance_products' => array(
		'name' => 'Asigurari',
		'menu_class' => 'heartbeat',

		'modules' => array(
			'city_insurance_products' => array(
				'name' => 'Asigurari'
			),
			'city_insurance_countries' => array(
				'name' => 'Tari'
			),
		)
	),

	'bookings' => array(
		'name' => 'Rezervari',
		'menu_class' => 'money',

		'modules' => array(
			'bookings' => array(
				'name' => 'Rezervari'
			),
			'vouchers' => array(
				'name' => 'Vouchere'
			),
			'voucher_orders' => array(
				'name' => 'Comenzi vouchere'
			),
		)
	),

	'users' => array(
		'name' => 'Useri',
		'menu_class' => 'users',

		'modules' => array(
			'users' => array(
				'name' => 'Useri'
			),
			'newsletter_users' => array(
				'name' => 'Abonati newsletter'
			),
			'users_contest_vote' => array(
				'name' => 'Concurs voteaza'
			),
			'users_contest_revolut' => array(
				'name' => 'Concurs Revolut'
			),
			'users_black_friday' => array(
				'name' => 'Abonati BF 2019'
			),
		)
	),

	'about' => array(
		'name' => 'Alte sectiuni',
		'menu_class' => 'info',

		'modules' => array(
			'forms' => array(
				'name' => 'Formulare lead-uri'
			),
			// 'about_new' => array(
			// 	'name' => 'Despre NOU'
			// ),
			'about_new' => array(
				'name' => 'Despre'
			),
			'about_gallery' => array(
				'name' => 'Despre - Galerie'
			),
			'about_corona' => array(
				'name' => 'Despre - Corona'
			),
			'about_media' => array(
				'name' => 'Despre - Media'
			),
			'csr' => array(
				'name' => 'Actiuni CSR'
			),
			'jobs' => array(
				'name' => 'Cariere'
			),
			'competitions' => array(
				'name' => 'Concursuri'
			),
			'agencies' => array(
				'name' => 'Agentii'
			),
			'agencies_partners' => array(
				'name' => 'Agentii partenere'
			),
			'testimonials' => array(
				'name' => 'Testimoniale'
			),
			'team' => array(
				'name' => 'Echipa'
			),
			'team_category' => array(
				'name' => 'Categorii echipa'
			),
			'guides' => array(
				'name' => 'Ghizi'
			),
			'faq' => array(
				'name' => 'Suport clienti'
			),
			'vacations' => array(
				'name' => 'Vacante la comanda'
			),
			'vacations_rate' => array(
				'name' => 'Vacante in rate'
			),
			'data_protection' => array(
				'name' => 'Protectia datelor'
			),
			'pages' => array(
				'name' => 'Pagini text'
			),
			'pages_old' => array(
				'name' => 'Pagini vechi'
			),
		)
	),

	'home_slider' => array(
		'name' => 'Setari homepage',
		'menu_class' => 'home',

		'modules' => array(
			'home_slider' => array(
				'name' => 'Slider'
			),
			'home_text' => array(
				'name' => 'Texte homepage'
			),
			'home_box_settings' => array(
				'name' => 'Setari boxuri'
			),
			'home_box_mobile' => array(
				'name' => 'Setari mobile'
			),
			'home_promo_boxes' => array(
				'name' => 'Boxuri promo'
			),
			'home_promo_boxes_items' => array(
				'name' => 'Itemi boxuri promo'
			),
			'home_box_offer' => array(
				'name' => 'Oferte Box'
			),
			'home_box_offer_slider' => array(
				'name' => 'Oferte Box slider'
			),
			'home_charter' => array(
				'name' => 'Chartere'
			),
			'home_charter_slider' => array(
				'name' => 'Chartere slider'
			),
			'home_circuit' => array(
				'name' => 'Circuite'
			),
			'home_circuit_slider' => array(
				'name' => 'Circuite slider'
			),
			'home_tourism' => array(
				'name' => 'Turism individual'
			),
			'home_tourism_slider' => array(
				'name' => 'Turism individual slider'
			),
			'home_tourism_intern' => array(
				'name' => 'Turism intern'
			),
			'home_tourism_intern_slider' => array(
				'name' => 'Turism intern slider'
			),
			'home_tourism_intern_video' => array(
				'name' => 'Turism intern video'
			),
			'home_testimonial' => array(
				'name' => 'Testimoniale'
			),
		)
	),

	'lp' => array(
		'name' => 'Landing pages',
		'menu_class' => 'hashtag',

		'modules' => array(
			'lp' => array(
				'name' => 'Landing page'
			),
			'lp_slider' => array(
				'name' => 'Slidere'
			),
			'lp_banner' => array(
				'name' => 'Bannere'
			),
			'lp_offer_zones' => array(
				'name' => 'Zone oferte'
			),
			'lp_offer_destinations' => array(
				'name' => 'Oferte destinatii'
			),
			'lp_offer_charters' => array(
				'name' => 'Oferte chartere hotel'
			),
			'lp_offer_circuits' => array(
				'name' => 'Oferte circuite'
			),
			'lp_offer_planes' => array(
				'name' => 'Oferte bilete'
			),
			'lp_footer' => array(
				'name' => 'Oferte footer'
			),
		)
	),

	'config' => array(
		'name' => 'Setari',
		'menu_class' => 'settings',

		'modules' => array(
			'config' => array(
				'name' => 'Setari Generale'
			),
			'config_installments' => array(
				'name' => 'Setari Scadente'
			),
			'config_payment' => array(
				'name' => 'Setari plati rate'
			),
			'typeform_form' => array(
				'name' => 'Setari Typeform'
			),
			'hotel_filters_meal_group' => array(
				'name' => 'Filtre mese hoteluri'
			),
			'charter_filters_meal_group' => array(
				'name' => 'Filtre mese charter'
			),
			'seo' => array(
				'name' => 'Setari SEO'
			),
			'newest_offers' => array(
				'name' => 'Cele mai noi oferte'
			),
			'box_avantaj' => array(
				'name' => 'Boxuri avantaje'
			),
			'box_recommend' => array(
				'name' => 'Boxuri recomandari'
			),
			'box_vacations' => array(
				'name' => 'Recomandari vacante'
			),
			'footer_partners' => array(
				'name' => 'Parteneri footer'
			),
			'hotels_footer' => array(
				'name' => 'Hoteluri footer'
			),
			'eurosite_requests' => array(
				'name' => 'Log request-uri Eurosite'
			),
			'cronjob_log' => array(
				'name' => 'Log cronjob-uri'
			),
		)
	),

);
