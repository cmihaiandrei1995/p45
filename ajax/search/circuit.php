<?php
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

if($_GET['type'] == "continent"){

	$tranport_sql = "";
	if($_GET['transport'] == "plane"){
		$tranport_sql = " AND type = 'plane'";
	}elseif($_GET['transport'] == "bus"){
		$tranport_sql = " AND type = 'bus'";
	}

	list($continents, $count) = get_posts(array(
		'table' => 'continent',
		'limit' => -1,
		'extra_where' => 'AND id_continent IN (
							SELECT id_continent FROM country WHERE id_country IN (
								SELECT id_country FROM city WHERE id_city IN (
									SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
										SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
									) GROUP BY id_city
								) AND '.db_is_active('', 'city').'
							) AND '.db_is_active('', 'country').'
						)'
	));

	foreach($continents as $k => $item){
		$result[$k]['id'] = $item['id_continent'];
		$result[$k]['text'] = $item['title'];
	}

}


if($_GET['type'] == "country"){

	$tranport_sql = "";
	if($_GET['transport'] == "plane"){
		$tranport_sql = " AND type = 'plane'";
	}elseif($_GET['transport'] == "bus"){
		$tranport_sql = " AND type = 'bus'";
	}

	list($countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1,
		'order' => 'title ASC',
		'id_continent' => intval($_GET['continent']),
		'extra_where' => 'AND id_country IN (
							SELECT id_country FROM city WHERE id_city IN (
								SELECT id_city FROM circuit_to_city WHERE id_circuit IN (
									SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
								) GROUP BY id_city
							) AND '.db_is_active('', 'city').'
						)'
	));

	foreach($countries as $k => $item){
		$result[$k]['id'] = $item['id_country'];
		$result[$k]['text'] = $item['title'];
	}

}

if($_GET['type'] == "month"){

	$_sql_country = "";
	if(isset($_GET['country'])){
		$_sql_country = ' AND id_country = '.intval($_GET['country']);
	}elseif(isset($_GET['continent'])){
		$_sql_country = ' AND id_country IN (SELECT id_country FROM country WHERE id_continent = '.intval($_GET['continent']).')';
	}

	$tranport_sql = "";
	if($_GET['transport'] == "plane"){
		$tranport_sql = " AND type = 'plane'";
	}elseif($_GET['transport'] == "bus"){
		$tranport_sql = " AND type = 'bus'";
	}

	$from_sql = "";
	if(isset($_GET['from'])){
		$from_sql = "AND id_circuit IN (SELECT id_circuit FROM circuit_city_from WHERE id_city = ".intval($_GET['from']).")";
	}

	$dates = db_query('
		SELECT DATE_FORMAT(dep_date, "%c") AS month, DATE_FORMAT(dep_date, "%Y") AS year FROM circuit_date_price
		WHERE id_circuit IN (
				SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (
					SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
						SELECT id_city FROM city WHERE '.db_is_active('', 'city').' '.$_sql_country.'
					)
				) AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
			)
			'.$from_sql.'
			AND dep_date > NOW()
		GROUP BY DATE_FORMAT(dep_date, "%c-%Y")
		ORDER BY dep_date
	');

	foreach($dates as $k => $item){
		$result[$k]['id'] = $item['month']."-".$item['year'];
		$result[$k]['text'] = $_months[$item['month']]." ".$item['year'];
	}

}


if($_GET['type'] == "from"){

	$_sql_country = "";
	if(isset($_GET['country'])){
		$_sql_country = ' AND id_country = '.intval($_GET['country']);
	}elseif(isset($_GET['continent'])){
		$_sql_country = ' AND id_country IN (SELECT id_country FROM country WHERE id_continent = '.intval($_GET['continent']).')';
	}

	$tranport_sql = "";
	if($_GET['transport'] == "plane"){
		$tranport_sql = " AND type = 'plane'";
	}elseif($_GET['transport'] == "bus"){
		$tranport_sql = " AND type = 'bus'";
	}

	$cities = db_query('
		SELECT * FROM city
		WHERE id_city IN (
			SELECT id_city FROM circuit_city_from WHERE id_circuit IN (
				SELECT id_circuit FROM circuit WHERE '.db_is_active('', 'circuit').' '.$tranport_sql.' AND id_circuit IN (
					SELECT id_circuit FROM circuit_to_city WHERE id_city IN (
						SELECT id_city FROM city WHERE '.db_is_active('', 'city').' '.$_sql_country.'
					)
				) AND id_circuit IN (SELECT id_circuit FROM circuit_date_price)
			)
		)
	');

	foreach($cities as $k => $item){
		$result[$k]['id'] = $item['id_city'];
		$result[$k]['text'] = $item['title'];
	}

}

if($_GET['type'] == "link"){

	if(isset($_GET['month']) && $_GET['month'] != ""){
		$tmp = explode("-", $_GET['month']);
		$append = "?m=".intval($tmp[0])."&y=".intval($tmp[1]);
	}

	$from_link = "";
	if(isset($_GET['from']) && $_GET['from'] != ""){
		$city = get_city_by_id(intval($_GET['from']));
		if($city){
			$from_link = "-from";
			$from_title = $city['title'];
		}
	}

	$transport = "";
	if(isset($_GET['transport']) && $_GET['transport'] != ""){
		$transport = $_GET['transport'] == "bus" ? "-bus" : "-plane";
	}

	if(isset($_GET['country']) && $_GET['country'] != ""){
		$country = get_country_by_id(intval($_GET['country']));
		$continent = get_continent_by_id($country['id_continent']);

		if($from_link){
			$result['link'] = route('circuits'.$transport.$from_link, $continent['title'], $country['title'], $from_title).$append;
		}else{
			$result['link'] = route('circuits'.$transport, $continent['title'], $country['title']).$append;
		}
	}elseif($_GET['continent'] && $_GET['continent'] != ""){
		$continent = get_continent_by_id($_GET['continent']);

		if($from_link){
			$result['link'] = route('circuits-cont'.$transport.$from_link, $continent['title'], $from_title).$append;
		}else{
			$result['link'] = route('circuits-cont'.$transport, $continent['title']).$append;
		}
	}else{
		$result['link'] = route('circuits-home').$append;
	}

}


echo json_encode($result);


// Close the conn
$_db->close();
