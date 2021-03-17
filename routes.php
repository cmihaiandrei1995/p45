<?
// All routes / links rules
$_config['routes'] = array(
    'home'                  		=> array('GET|POST', '/', 'home/home.php'),

	// 'bf'							=> array('GET', '/black-friday/', 'home/bf.php'),
    // 'happy'							=> array('GET', '/happy-days/', 'home/happy.php'),
    'bf2019'						=> array('GET|POST', '/black-friday/', 'home/bf2019.php'),

    // 'autostrazi'					=> array('GET', '/romania-vrea-autostrazi/', 'home/autostrazi.php'),

	// some redirects
	'redirect-home'					=> array('GET', '/index.php', 'redirect.php', array('to' => 'home')),
	'redirect-home2'				=> array('GET', '/index.html', 'redirect.php', array('to' => 'home')),
	'redirect-cruises'				=> array('GET', '/croaziera/[*:slug]', 'redirect.php', array('to' => 'cruise')),

    // redirects charters
    'redirect-charters-home'        => array('GET|POST', '/chartere/', 'redirect.php', array('to' => 'charters-home')),
    'redirect-charters-loading'     => array('GET|POST', '/chartere/cautare/[i:id]/', 'redirect.php', array('to' => 'charters-loading')),
    'redirect-charters-search'      => array('GET|POST', '/chartere/[*:city_to]/din-[*:city_from]/[i:id]/[p:page]/?', 'redirect.php', array('to' => 'charters-search')),
    'redirect-charters'             => array('GET', '/chartere/charter-[*:city_to]-plecare-din-[*:city_from]/[p:page]/?', 'redirect.php', array('to' => 'charters')),
    'redirect-charters2'            => array('GET', '/chartere/sejur-[*:city_to]-plecare-din-[*:city_from]/[p:page]/?', 'redirect.php', array('to' => 'charters2')),
    'redirect-charters-item'        => array('GET', '/chartere/charter-[*:city_to]-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item')),
    'redirect-charters-item2'       => array('GET', '/chartere/sejur-[*:city_to]-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item2')),

    'redirect-dubai'                => array('GET', '/vacante/charter-dubai-plecare-din-[*:city_from]/', 'redirect.php', array('to' => 'charters', 'new' => 'emiratele-arabe-unite')),
    'redirect-dubai2'               => array('GET', '/vacante/sejur-dubai-plecare-din-[*:city_from]/', 'redirect.php', array('to' => 'charters2', 'new' => 'emiratele-arabe-unite')),
    'redirect-dubai-item'           => array('GET', '/vacante/charter-dubai-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item', 'new' => 'emiratele-arabe-unite')),
    'redirect-dubai-item2'          => array('GET', '/vacante/sejur-dubai-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item2', 'new' => 'emiratele-arabe-unite')),

    'redirect-split'                => array('GET', '/vacante/charter-litoral-croatia-plecare-din-[*:city_from]/', 'redirect.php', array('to' => 'charters', 'new' => 'split')),
    'redirect-split2'               => array('GET', '/vacante/sejur-litoral-croatia-plecare-din-[*:city_from]/', 'redirect.php', array('to' => 'charters2', 'new' => 'split')),
    'redirect-split-item'           => array('GET', '/vacante/charter-litoral-croatia-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item', 'new' => 'split')),
    'redirect-split-item2'          => array('GET', '/vacante/sejur-litoral-croatia-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'redirect.php', array('to' => 'charters-item2', 'new' => 'split')),

    'redirect-dubai-hotel'          => array('GET', '/sejururi/dubai/', 'redirect.php', array('to' => 'tourism', 'new' => 'emiratele-arabe-unite')),
    'redirect-split-hotel'          => array('GET', '/sejururi/litoral-croatia/', 'redirect.php', array('to' => 'tourism', 'new' => 'split')),

    'redirect-contest'              => array('GET|POST', '/regulament-grecia/', 'redirect.php', array('to' => 'rules-contest')),

    'redirect-error-search-charter' => array('GET|POST', '/vacante/charter--plecare-din-/', 'redirect.php', array('to' => 'charters-home')),

    'redirect-thank-you'            => array('GET|POST', '/rezervare/finalizare/[i:id_booking]/index.php', 'redirect.php', array('to' => 'thank-you')),



    // sitemap
    'sitemap'						=> array('GET', '/sitemap.xml', 'sitemap/general.php'),

    // feed export
    'export-circuit'				=> array('GET', '/feed/circuits.xml', 'feed/circuits.php'),
    'export-hotel'				    => array('GET', '/feed/hotels.xml', 'feed/hotels.php'),
    'export-charter'				=> array('GET', '/feed/charters.xml', 'feed/charters.php'),

    'google-circuit'				=> array('GET', '/feed/google/circuits.csv', 'feed/google/circuits.php'),
    'google-hotel'				    => array('GET', '/feed/google/hotels.csv', 'feed/google/hotels.php'),
    'google-charter'				=> array('GET', '/feed/google/charters.csv', 'feed/google/charters.php'),

    'fb-circuit'				    => array('GET', '/feed/fb/circuits.xml', 'feed/fb/circuits.php'),
    'fb-hotel'				        => array('GET', '/feed/fb/hotels.xml', 'feed/fb/hotels.php'),
    'fb-charter'				    => array('GET', '/feed/fb/charters.xml', 'feed/fb/charters.php'),


	// booking
	'booking-circuit'             	=> array('GET|POST', '/circuite/rezervare/', 'booking/booking.php', array('type' => 'circuit')),
	'booking-tourism'             	=> array('GET|POST', '/sejururi/rezervare/', 'booking/booking.php', array('type' => 'tourism')),
	'booking-charter'             	=> array('GET|POST', '/chartere/rezervare/', 'booking/booking.php', array('type' => 'charter')),
    'booking-insurance'             => array('GET|POST', '/asigurari-calatorie/rezervare/', 'booking/booking.php', array('type' => 'insurance')),

	'thank-you'             		=> array('GET|POST', '/rezervare/finalizare/[i:id_booking]/?', 'booking/thank_you.php'),


	// charters
	'charters-home'                 => array('GET|POST', '/vacante/', 'charters/home.php'),
	'charters-loading'              => array('GET|POST', '/vacante/cautare/[i:id]/', 'charters/loading.php'),
	'charters-search'               => array('GET|POST', '/vacante/[*:city_to]/din-[*:city_from]/[i:id]/[p:page]/?', 'charters/list.php'),

	'charters'                  	=> array('GET', '/vacante/charter-[*:city_to]-plecare-din-[*:city_from]/[p:page]/?', 'charters/list.php', array('type' => 'charter')),
	'charters2'                  	=> array('GET', '/vacante/sejur-[*:city_to]-plecare-din-[*:city_from]/[p:page]/?', 'charters/list.php', array('type' => 'sejur')),
	//'charters-nofrom'               => array('GET', '/vacante/charter-[*:city_to]/[p:page]/?', 'charters/list.php', array('type' => 'charter')),
	//'charters2-nofrom'              => array('GET', '/vacante/sejur-[*:city_to]/[p:page]/?', 'charters/list.php', array('type' => 'sejur')),

	'charters-item'                 => array('GET', '/vacante/charter-[*:city_to]-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'charters/item.php'),
	'charters-item2'                => array('GET', '/vacante/sejur-[*:city_to]-plecare-din-[*:city_from]/[*:slug]-[i:id]', 'charters/item.php'),



	// circuite
	'circuits-home'                 => array('GET|POST', '/circuite/', 'circuits/home.php'),
	'circuits-all'                 	=> array('GET', '/oferte-circuite/', 'circuits/list.php'),

	'circuits-loading'              => array('GET|POST', '/circuite/cautare/[i:id]/', 'circuits/loading.php'),

	'circuits-cont'                 => array('GET', '/circuite/[*:continent]/[p:page]/?', 'circuits/list.php'),

	'circuits-cont-from'            => array('GET', '/circuite/[*:continent]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php'),
	'circuits-from'                 => array('GET', '/circuite/[*:continent]/[*:country]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php'),

	'circuits-cont-bus'             => array('GET', '/circuite-cu-autocarul/[*:continent]/[p:page]/?', 'circuits/list.php', array('type' => 'bus')),
	'circuits-cont-bus-from'        => array('GET', '/circuite-cu-autocarul/[*:continent]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php', array('type' => 'bus')),

	'circuits-bus'                  => array('GET', '/circuite-cu-autocarul/[*:continent]/[*:country]/[p:page]/?', 'circuits/list.php', array('type' => 'bus')),
	'circuits-bus-from'             => array('GET', '/circuite-cu-autocarul/[*:continent]/[*:country]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php', array('type' => 'bus')),

	'circuits-cont-plane'           => array('GET', '/circuite-cu-avionul/[*:continent]/[p:page]/?', 'circuits/list.php', array('type' => 'plane')),
	'circuits-cont-plane-from'      => array('GET', '/circuite-cu-avionul/[*:continent]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php', array('type' => 'plane')),

	'circuits-plane'                => array('GET', '/circuite-cu-avionul/[*:continent]/[*:country]/[p:page]/?', 'circuits/list.php', array('type' => 'plane')),
	'circuits-plane-from'           => array('GET', '/circuite-cu-avionul/[*:continent]/[*:country]/plecare-din-[*:from]/[p:page]/?', 'circuits/list.php', array('type' => 'plane')),

	'circuits-search'               => array('GET|POST', '/circuite/[*:continent]/[*:country]/[i:id]/[p:page]/?', 'circuits/list.php'),

	'circuits'                  	=> array('GET', '/circuite/[*:continent]/[*:country]/[p:page]/?', 'circuits/list.php'),

	'circuits-cat'                  => array('GET', '/circuite-[*:cat]/[p:page]/?', 'circuits/list.php'),

	'circuit'                  		=> array('GET', '/circuit/[*:slug]/', 'circuits/item.php'),
	'circuit-map'                  	=> array('GET', '/circuit/harta/[*:id]/', 'circuits/map.php'),



	// turism individual
	'tourism-home'                 	=> array('GET|POST', '/sejururi/', 'tourism/home.php'),
	'tourism-map'                  	=> array('GET', '/sejururi/harta-hotel/[*:id]/', 'tourism/map.php'),
	'tourism-loading'               => array('GET|POST', '/sejururi/cautare/[i:id]/', 'tourism/loading.php'),
	'tourism-search'               	=> array('GET|POST', '/sejururi/[*:destination]/[i:id]/[p:page]/?', 'tourism/list.php', array('ro' => false)),
	'tourism-item'                  => array('GET', '/sejururi/[*:slug]-[i:id]', 'tourism/item.php', array('ro' => false)),
	'tourism'                  		=> array('GET', '/sejururi/[*:city]/[p:page]/?', 'tourism/list.php', array('ro' => false)),



	// turism intern
	'tourism-ro-home'              	=> array('GET|POST', '/turism-intern/', 'tourism/home-intern.php'),
	'tourism-ro-loading'            => array('GET|POST', '/turism-intern/cautare/[i:id]/', 'tourism/loading.php'),
	'tourism-ro-search'             => array('GET|POST', '/turism-intern/[*:destination]/[i:id]/[p:page]/?', 'tourism/list.php', array('ro' => true)),
	'tourism-ro-cat'                => array('GET', '/turism-intern/[*:tag]/[p:page]/?', 'tourism/list.php', array('ro' => true)),



	// cruises
	'cruises-home'                  => array('GET|POST', '/oferte-croaziere/', 'cruises/home.php'),
	'cruise'  						=> array('GET|POST', '/croaziere/[*:slug]-[i:id]', 'cruises/item.php'),
	'cruises'                 		=> array('GET|POST', '/croaziere/[p:page]/?', 'cruises/list.php'),
	'cruises-ship' 	         		=> array('GET', '/croaziere/vas-[*:ship]/[p:page]/?', 'cruises/list.php'),
	'cruises-dest' 	         		=> array('GET', '/croaziere/destinatie-[*:dest]/[p:page]/?', 'cruises/list.php'),
	'cruises-cat' 	        		=> array('GET', '/croaziere/[*:cat]/[p:page]/?', 'cruises/list.php'),



	// other pages
	// 'about' 	        			=> array('GET', '/despre-noi/', 'about/about.php'),
    'about' 	        			=> array('GET', '/despre-noi/', 'about/about-new.php', array('id' => 1)),

    'about-new1' 	        		=> array('GET', '/despre-noi/', 'about/about-new.php', array('id' => 1)),
    'about-new2' 	        		=> array('GET', '/despre-noi/premii/', 'about/about-new.php', array('id' => 2)),
    'about-new3' 	        		=> array('GET', '/despre-noi/alin-burcea/', 'about/about-new.php', array('id' => 3)),
    'about-new4' 	        		=> array('GET', '/despre-noi/cea-mai-buna-echipa/', 'about/about-new.php', array('id' => 4)),
    'about-new5' 	        		=> array('GET', '/despre-noi/galerie-foto/[p:page]/?', 'about/about-new.php', array('id' => 5)),
    'about-new6' 	        		=> array('GET', '/despre-noi/cifre/', 'about/about-new.php', array('id' => 6)),
    'about-new7' 	        		=> array('GET', '/despre-noi/branduri/', 'about/about-new.php', array('id' => 7)),
    'about-new11' 	        		=> array('GET', '/despre-noi/25-de-ani/', 'about/about-new.php', array('id' => 11)),
    'about-new10' 	        		=> array('GET', '/despre-noi/oameni-care-scriu-istoria/', 'about/about-new.php', array('id' => 10)),
    'about-new12' 	        		=> array('GET', '/despre-noi/agentii-partenere/', 'about/about-new.php', array('id' => 12)),

    'about-corona' 	        		=> array('GET', '/informari-paralela-45-coronavirus/', 'about/about-corona.php'),

	'about-media' 	        		=> array('GET', '/despre-noi-media/[p:page]/?', 'about/about-media.php'),
	'assist' 	        			=> array('GET', '/asistenta/', 'pages/assist.php'),
	'team' 	        				=> array('GET', '/echipa/', 'pages/team.php'),
	'team-cat' 	        			=> array('GET', '/echipa/[*:cat]/', 'pages/team.php'),
	'csr' 	        				=> array('GET', '/actiuni-csr/', 'about/csr.php'),
	'jobs' 	        				=> array('GET|POST', '/cariere/', 'about/jobs.php'),

    'revolut' 	        			=> array('GET|POST', '/revolut/', 'pages/revolut.php'),

	'agencies'                 		=> array('GET|POST', '/agentii/', 'agencies/list.php'),
	'agency-country' 	        	=> array('GET|POST', '/agentii/din-[*:country]/', 'agencies/list.php'),
	'agency-city' 	        		=> array('GET|POST', '/agentii/[*:city]/', 'agencies/list.php'),
    'agency'                     	=> array('GET|POST', '/agentie/[*:slug]/', 'agencies/item.php'),

	'agencies-partner'              => array('GET', '/agentii-partenere/[p:page]/?', 'agencies-part/list.php'),
    'agency-judet-partner' 	        => array('GET', '/agentii-partenere/[*:judet]/[p:page]/?', 'agencies-part/list.php'),
    'agency-city-partner' 	        => array('GET', '/agentii-partenere/[*:judet]/[*:city]/[p:page]/?', 'agencies-part/list.php'),

	'guides'              			=> array('GET', '/ghizi/[p:page]/?', 'guides/list.php'),
	'guide' 	        			=> array('GET', '/ghid/[*:slug]/', 'guides/item.php'),

	'support' 	        			=> array('GET', '/suport/', 'pages/support.php'),
	'vouchers'						=> array('GET', '/info/vouchere/', 'pages/vouchers.php'),
	'terms'							=> array('GET', '/info/termeni-si-conditii/', 'pages/terms.php'),
    'data-protection'				=> array('GET|POST', '/protectie-date/', 'pages/data_protection.php'),
    //'data-protection-item'			=> array('GET|POST', '/protectie-date/[*:slug]/', 'pages/data_protection_item.php'),
	'tourist-contract'				=> array('GET', '/info/contract-cu-turistul/', 'pages/tourist-contract.php'),
    'tourist-contract-pj'			=> array('GET', '/info/contract-cu-turistul-pj/', 'pages/tourist-contract-pj.php'),
	'fidelity-card'					=> array('GET', '/info/card-de-fidelitate/', 'pages/fidelity-card.php'),
	'franchise'						=> array('GET', '/info/franciza/', 'pages/franchise.php'),
    'cookies'						=> array('GET', '/info/politica-cookie/', 'pages/cookies.php'),
	'privacy'						=> array('GET', '/info/politica-de-confidentialitate/', 'pages/privacy.php'),
	'competitions'					=> array('GET', '/info/concursuri-si-regulamente/', 'pages/competitions.php'),
	'complaints'					=> array('GET|POST', '/reclamatii/', 'pages/complaints.php'),
	'testimonials' 	        		=> array('GET|POST', '/testimoniale/[p:page]/?', 'pages/testimonials.php'),
	'vacations-lease' 	        	=> array('GET', '/info/vacante-in-rate/', 'pages/vacations-lease.php'),

    'buy-voucher'                   => array('GET|POST', '/vouchere-cadou/', 'pages/buy-voucher.php'),
    'thank-you-voucher'             => array('GET|POST', '/vouchere-cadou/final/[i:id_order]', 'pages/buy-voucher.php'),

    'rules-cluj'					=> array('GET', '/regulament-cluj/', 'pages/text.php', array('id' => 267)),
    'rules-love-greece'             => array('GET|POST', '/regulament-iubeste-grecia/', 'pages/text.php', array('id' => 269)),
    'rules-win-vacation'            => array('GET|POST', '/regulament-castiga-ti-vacanta/', 'pages/text.php', array('id' => 270)),
    //'rules-win-vacation2'           => array('GET|POST', '/regulament-vacante-castigatoare/', 'pages/text.php', array('id' => 271)),
    'rules-win-vacation3'           => array('GET|POST', '/regulament-castiga-ti-vacanta-in-antalya/', 'pages/text.php', array('id' => 272)),
    'rules-contest'                 => array('GET', '/regulament-concurs/', 'pages/rules-contest.php'),
    'rules-nl'                      => array('GET', '/regulament-abonare/', 'pages/rules-nl.php'),
    'rules-vote'                    => array('GET', '/regulament-mergi-la-vot/', 'pages/text.php', array('id' => 273)),
    'rules-readers'                 => array('GET', '/regulament-cititori-calatori/', 'pages/text.php', array('id' => 274)),
    'rules-revolut'                 => array('GET', '/regulament-revolut/', 'pages/text.php', array('id' => 275)),



    'ordonanta'                     => array('GET', '/drepturi-ordonanta-guvernului-nr-2-din-2018/', 'pages/text.php', array('id' => 268)),

    'acr' 	        				=> array('GET', '/sfaturi-auto-acr/', 'pages/acr.php'),

    'confirm-subscribe'             => array('GET', '/confirmare-abonare/', 'pages/confirm.php'),

    'subscription'                  => array('GET|POST', '/abonare/', 'pages/subscription.php'),

    'votenow'                       => array('GET|POST', '/voteaza/', 'pages/votenow.php'),

	'custom-vacations' 	        	=> array('GET|POST', '/vacante-la-comanda/', 'pages/custom-vacations.php'),
    'custom-vacations-city-break' 	=> array('GET|POST', '/vacante-la-comanda/city-break/', 'pages/custom-vacations.php', array('id_vacation' => 1)),

	'webcam'						=> array('GET', '/webcam/[i:id]/?', 'tourism/webcam.php'),

	'forms'							=> array('GET|POST', '/form/[*:slug]/', 'pages/form_lead.php'),



	// bilete avion
	'tickets'						=> array('GET|POST', '/bilete-de-avion/[p:page]/?', 'tickets/list.php'),
	'ticket'						=> array('GET|POST', '/bilete-de-avion/[*:title]-[*:id_ticket]/', 'tickets/item.php'),
	'tickets2'						=> array('GET|POST', '/bilete-de-avion/[*:country_to]/[*:city_to]/din-[*:city_from]/', 'tickets/list.php'),



	// login, account
	'login'							=> array('GET|POST', '/login/', 'account/login.php'),
    'new-account'				    => array('GET|POST', '/new-account/', 'account/new-account.php'),
    'resend-link'					=> array('GET', '/login/[*:resend]/', 'account/login.php'),
	'logout'						=> array('GET', '/logout/', 'account/login.php', array('action' => 'logout')),
	'confirm-account'				=> array('GET', '/confirmare-cont/[*:confirm]', 'account/login.php'),

	'my-account'       				=> array('GET|POST', '/contul-meu/', 'account/account.php'),
	'my-account-bookings'       	=> array('GET', '/contul-meu/rezervari/', 'account/reservations.php'),
	'my-account-account'       		=> array('GET|POST', '/contul-meu/date-cont/', 'account/account.php'),
	'my-account-passengers'      	=> array('GET|POST', '/contul-meu/pasageri/', 'account/passengers.php'),
	'my-account-whishlist'      	=> array('GET|POST', '/contul-meu/whishlist/[p:page]/?', 'account/wishlist.php'),
	'my-account-loyalty'      		=> array('GET', '/contul-meu/fidelitate/', 'account/loyalty.php'),



	// cautare
	'search' 		         		=> array('GET', '/cautare/[p:page]/?', 'search/list.php'),
	'search-tab' 		         	=> array('GET', '/cautare/[*:slug]/[p:page]/?', 'search/list.php'),
	'search-tab-from' 		        => array('GET', '/cautare/[*:slug]/din-[*:city_from]/[p:page]/?', 'search/list.php'),

	'insurance'					    => array('GET|POST', '/asigurari-calatorie/', 'insurance/insurance.php'),


    // landing pages
    'lp'					        => array('GET|POST', '/[*:slug]/', 'lp/home.php'),



);
