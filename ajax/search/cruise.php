<?php 
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

if($_GET['type'] == "port"){
	
	$extra_dest[] = $_GET['destination'];
	$children = get_cruise_destinations_by_parent_id($_GET['destination']);
	if($children){
		foreach($children as $child){
			$extra_dest[] = $child['id_cruise_destination'];
		}
	}

	array_unique($extra_dest);
	
	list($_ports, $_ports_count) = get_posts(array(
	    'table' => 'cruise_port',
		'limit' => -1,
		'join' => array(
			array('cruise', 'id_cruise_port=port_start', true),
		),
		'extra_where' => 'AND id_cruise_port IN ( SELECT port_start FROM cruise WHERE '.db_is_active('', 'cruise').' AND port_start > 0 GROUP BY port_start ) AND '.db_is_active('', 'cruise'),
		'query' => array(
	        'key' => 'cruise.id_cruise_destination',
	        'compare' => 'IN',
	        'value' => $extra_dest,
		),
		'order' => '`title` ASC',
	));
	
	foreach($_ports as $k => $port){
		$result[$k]['id'] = $port['id_cruise_port'];
		$result[$k]['text'] = $port['title'];
	}
}

if($_GET['type'] == "month"){
	list($_dates, $_dates_count) = get_posts(array(
	    'table' => 'cruise_date',
	    'select' => array(
	    	'DATE_FORMAT(`date`, "%M %Y")' => 'date_solution',
	    	'DATE_FORMAT(`date`, "%c")' => 'month',
	    	'DATE_FORMAT(`date`, "%Y")' => 'year'
		),
		'limit' => -1,
		'join' => array(
			array('cruise', 'id_cruise', false),
		),
		'query' => array(
		    array(
		        'key' => 'cruise_date.date',
		        'compare' => '>',
		        'value' => date('Y-m-d'),
		    ),
			array(
		        'key' => 'id_cruise_destination',
		        'compare' => '=',
		        'value' => $_GET['destination'],
			),
			array(
		        'key' => 'cruise.port_start',
		        'compare' => '=',
		        'value' => $_GET['port'],
		    ),
		),
		'extra_where' => ' AND id_cruise IN ( SELECT id_cruise FROM cruise WHERE '.db_is_active('', 'cruise').' )',
		'status' => '',
		'groupby' => 'date_solution',
		'order' => '`date` ASC',
	));
	
	foreach($_dates as $k => $date){
		$result[$k]['id'] = $date['month'].'-'.$date['year'];
		$result[$k]['text'] = $_months[$date['month']].' '.$date['year'];
	}
}

echo json_encode($result);
//print_r($result);
// Close the conn
$_db->close();