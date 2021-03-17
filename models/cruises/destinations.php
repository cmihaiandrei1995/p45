<?
function get_cruise_destination_by_id($id){
	return db_row('
        SELECT *
        FROM cruise_destination
        WHERE '.db_is_active('', 'cruise_destination').' 
        	AND id_cruise_destination = ?
    ', $id);
}

function get_cruise_destination_by_slug($slug){
	$items = db_query('
        SELECT *
        FROM cruise_destination
        WHERE '.db_is_active('', 'cruise_destination').'
    ');
    foreach($items as $item) {
        if(generate_name($item['title']) == $slug) {
            return $item;
        }
    }
}

function get_cruise_port_by_id($id){
	return db_row('
        SELECT *
        FROM cruise_port
        WHERE '.db_is_active('', 'cruise_port').' 
        	AND id_cruise_port = ?
    ', $id);
}

function get_cruise_destinations_by_parent_id($id){
	return db_query('
        SELECT *
        FROM cruise_destination
        WHERE '.db_is_active('', 'cruise_destination').' 
        	AND parent_id = ?
    ', $id);
}