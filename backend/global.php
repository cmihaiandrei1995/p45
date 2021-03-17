<?
if($_SERVER['SCRIPT_URL'] == "/vacante/sejur-emiratele-arabe-unite-plecare-din-bucuresti/" || $_SERVER['SCRIPT_URL'] == "/vacante/sejur-emiratele-arabe-unite-plecare-din-cluj-napoca/" || $_SERVER['SCRIPT_URL'] == "/sejururi/emiratele-arabe-unite/"){
	$_show_logo_stay_sunny = true;
}



$_bucuresti = get_city_by_id(14997);

//@andrei: date meniu drop
$_menu_pachete_vacanta = cache_get('charters__destinations_from');

if(!$_SESSION[$_site_title]['visits_count']){
	$_SESSION[$_site_title]['visits_count'] = 1;
}else{
	$_SESSION[$_site_title]['visits_count']++;
}

if(is_logged_in()){
	$_loggedin_user = get_logged_in_user();
}else{
	if(isset($_COOKIE[generate_name($_site_title)]["client"]["username"]) && isset($_COOKIE[generate_name($_site_title)]["client"]["password"])) {
		$user = $_COOKIE[generate_name($_site_title)]["client"]["username"];
		$pass = $_COOKIE[generate_name($_site_title)]["client"]["password"];

		$check_user = db_row('SELECT * FROM user WHERE email = ? AND password = ?', $user, $pass);
		if($check_user){
			if($check_user['active'] == 1){
				login_user($check_user);
				$_loggedin_user = get_logged_in_user();
			}else{
				$err_login = 1;
			}
		}else{
			$err_login = 1;
		}

		if($err_login){
			$go_away = route('login');
			logout_user();
			go_away($go_away);
		}
	}
}

// current link
$_current_link = $_SERVER['SCRIPT_URI'] . ($_SERVER['QUERY_STRING'] != '' ? '?' . $_SERVER['QUERY_STRING'] : '');
//$_current_link_no_page = substr($_base, 0, -1).preg_replace('/pag-\d\//', '', explode("?", $_SERVER['SCRIPT_URI'])[0]);
$_current_link_no_page = preg_replace('/pag-\d\//', '', explode("?", $_current_link)[0]);


$_charter_countries = cache_get('mainvar__charter_countries');
if(!$_charter_countries){
	// charters countries for search
	list($_charter_countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'home_charter' => 1,
		'extra_where' => ' AND id_country IN (SELECT id_country FROM charter_destination GROUP BY id_country)',
		'order' => 'title ASC'
		/*
		'extra_where' => '
			AND id_country IN (SELECT id_country FROM charter_destination GROUP BY id_country)
			AND id_country IN (SELECT id_country FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM charter_minprice))
		',
		 */
	));

	cache_set('mainvar__charter_countries', $_charter_countries, 60*60);
}



$_circuit_continents = cache_get('mainvar__circuit_continents');
if(!$_circuit_continents){
	// circuits continents for search
	list($_circuit_continents, $count) = get_posts(array(
		'table' => 'continent',
		'limit' => -1,
		'images' => true,
		'extra_where' => 'AND id_continent IN (
							SELECT id_continent FROM country WHERE id_country IN (
								SELECT id_country FROM city WHERE id_city IN (
									SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
										SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').'
									) GROUP BY id_city
								) AND '.db_is_active('', 'city').'
							) AND '.db_is_active('', 'country').'
						)'
	));

	cache_set('mainvar__circuit_continents', $_circuit_continents, 60*60);
}

$_circuit_dates = cache_get('mainvar__circuit_dates');
if(!$_circuit_dates){
	// circuit dates for search
	$circuit_dates = db_query('
		SELECT DATE_FORMAT(dep_date, "%c") AS month, DATE_FORMAT(dep_date, "%Y") AS year FROM circuit_date_price
		WHERE id_circuit IN (
				SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' AND id_circuit IN (
					SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
						SELECT id_city FROM city WHERE '.db_is_active('', 'city').'
					)
				)
			)
			AND dep_date > NOW()
		GROUP BY DATE_FORMAT(dep_date, "%c-%Y")
		ORDER BY dep_date
	');
	foreach($circuit_dates as $k => $item){
		$_circuit_dates[$item['month']."-".$item['year']] = $_months[$item['month']]." ".$item['year'];
	}

	cache_set('mainvar__circuit_dates', $_circuit_dates, 60*60);
}


$_tourism_countries = cache_get('mainvar__tourism_countries');
if(!$_tourism_countries){
	// turism search countries
	list($_tourism_countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'home_tourism' => 1,
		'extra_where' => ' AND (
								id_country IN (SELECT id_country FROM city WHERE id_city IN (SELECT id_city FROM category_to_city GROUP BY id_city) GROUP BY id_country)
								OR id_country IN (SELECT id_country FROM zone WHERE id_zone IN (SELECT id_zone FROM category_to_zone GROUP BY id_zone) GROUP BY id_country)
								OR id_country IN (SELECT id_country FROM city WHERE home_tourism = 1 AND '.db_is_active('', 'city').')
								OR id_country IN (SELECT id_country FROM zone WHERE home_tourism = 1 AND '.db_is_active('', 'zone').')
							)
							AND id_country IN (SELECT id_country FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice WHERE date_from > NOW() ) GROUP BY id_country)
						',
		'order' => 'title ASC'
	));

	cache_set('mainvar__tourism_countries', $_tourism_countries, 60*60);
}


$_tourism_intern_options = cache_get('mainvar__tourism_intern_options');
if(!$_tourism_intern_options){
	// turism intern
	list($_tourism_intern_tags, $count) = get_posts(array(
		'table' => 'city_tag',
		'limit' => -1,
		'images' => true,
		'extra_where' => ' AND title IN ("'.implode('","', $_allowed_tags).'")'
	));
	foreach($_tourism_intern_tags as $k => &$tag){
		list($tag['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 1,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (SELECT id_city FROM hotel WHERE id_hotel IN (SELECT id_hotel FROM hotel_minprice))
				AND id_city IN (SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$tag['id_city_tag'].')
			',
		));

		if($tag['cities']){
			$_tourism_intern_options[] = array(
				'type' => 'city',
				'id' => $tag['id_city_tag'],
				'title' => $tag['title_front']
			);
		}

		unset($tag);
	}

	list($_tourism_intern_tags_special, $count) = get_posts(array(
		'table' => 'home_tourism_intern',
		'limit' => -1,
		'query' => array(
			'key' => 'id_hotel_tag',
			'compare' => '>',
			'value' => 0
		),
		'images' => true,
	));

	foreach($_tourism_intern_tags_special as $k => &$box){
		$tag = get_hotel_tag_by_id($box['id_hotel_tag']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 1,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT id_hotel FROM hotel_minprice
					)
				)
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT hotel_grila.id_hotel FROM hotel_grila
						JOIN hotel_minprice ON (hotel_grila.date_offer_from = hotel_minprice.date_from AND hotel_grila.date_offer_to = hotel_minprice.date_to)
						WHERE hotel_grila.id_hotel_tag = '.$box['id_hotel_tag'].' AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
					)
				)
			',
			'order' => 'title ASC',
		));

		if($box['cities']){
			$_tourism_intern_options[] = array(
				'type' => 'special',
				'id' => $box['id_hotel_tag'],
				'title' => $box['title']
			);
		}

		unset($box);
	}

	cache_set('mainvar__tourism_intern_options', $_tourism_intern_options, 60*60);
}


$_cruise_destinations_form = cache_get('mainvar__cruise_dest_form');
if(!$_cruise_destinations_form){
	// cruise destinations for search
	list($cruise_dest_form, $count) = get_posts(array(
	    'table' => 'cruise_destination',
		'limit' => -1,
		'parent_id' => 0,
		'join' => array('cruise', 'id_cruise_destination', true),
		'extra_where' => 'AND '.db_is_active('', 'cruise'),
		'order' => 'title ASC',
	));

	foreach($cruise_dest_form as &$item_dest){
		list($item_dest['sub'], $dest_sub_count) = get_posts(array(
		    'table' => 'cruise_destination',
			'limit' => -1,
			'parent_id' => $item_dest['id_cruise_destination'],
			'join' => array(
				array('cruise', 'id_cruise_destination', true),
			),
			'extra_where' => 'AND '.db_is_active('', 'cruise'),
			'order' => 'title ASC',
		));
		$_cruise_destinations_form[] = $item_dest;
		unset($item_dest);
	}

	cache_set('mainvar__cruise_dest_form', $_cruise_destinations_form, 60*60);
}


$_ticket_countries = cache_get('mainvar__tickets_form');
if(!$_ticket_countries){
	list($_ticket_countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'extra_where' => ' AND id_country IN (SELECT id_country_to FROM ticket WHERE '.db_is_active('', 'ticket').' GROUP BY id_country_to)',
		'order' => 'title ASC'
	));

	cache_set('mainvar__tickets_form', $_ticket_countries, 60*60);
}



// footer partners
list($_footer_partners, $_footer_partners_count) = get_posts(array(
    'table' => 'footer_partner',
	'limit' => -1,
));

//@andrei: ia din cache variabilele pentru meniuri
$_destinations_from = cache_get('charters__destinations_from');