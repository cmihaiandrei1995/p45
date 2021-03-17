<?
function get_cruise_ship_by_id($id){
	return db_row('
        SELECT *
        FROM cruise_ship
        WHERE '.db_is_active('', 'cruise_ship').' 
        	AND id_cruise_ship = ?
    ', $id);
}

function get_cruise_ship_by_slug($slug){
	$items = db_query('
        SELECT *
        FROM cruise_ship
        WHERE '.db_is_active('', 'cruise_ship').'
    ');
    foreach($items as $item) {
        if(generate_name($item['title']) == $slug) {
            return $item;
        }
    }
}

function get_cruise_ship_info($item){
	$item['url'] = route('ship', $item['title'], $item['id_cruise_ship']);
	$item['description'] = wrap_wysiwyg_text($item['description']);
	$item['short_desc'] = limit_text($item['description'], 300);
	
	//$item['images'] = get_images('cruise_ship', $item['id_cruise_ship']);
	$item['image'] = count($item['images']) ? $item['images'][0]['medium'] : "http://placehold.it/300x156?text=".__('Fara imagine');
	
	return $item;
}

function get_cruise_ship_file($item){
	global $_base;
	
	$file = db_row("SELECT * FROM cruise_ship_file WHERE id_cruise_ship = ? ORDER BY `order` ASC, id_file DESC LIMIT 1", $item['id_cruise_ship']);
	if($file){
		return $_base."uploads/files/".$file['folder'].$file['file'];
	}
	return false;
}

function get_cruise_deck_by_ship_id($item){
	list($_items, $_count) = get_posts(array(
	    'table' => 'cruise_deck',
		'limit' => -1,
		'id_cruise_ship' => $item['id_cruise_ship'],
		'order' => '`order` ASC, id_cruise_deck DESC',
		'images' => true
	));
	
	foreach($_items as &$it){
		$it = get_cruise_deck_info($it, $item);
		unset($it);
	}
	return $_items;
}

function get_cruise_deck_info($it, $item){
	$it['url'] = route('ship-deck', $item['title'], $item['id_cruise_ship'], $it['title'], $it['id_cruise_deck']);
	$it['description'] = wrap_wysiwyg_text($it['description']);
	$it['short_desc'] = limit_text($it['description'], 300);
	$it['image'] = count($it['images']) ? $it['images'][0]['medium'] : "";
	$it['big'] = count($it['images']) ? $it['images'][0]['url'] : "";
	
	return $it;
}

function get_cruise_cabins_by_deck_id($id){
	list($_items, $_count) = get_posts(array(
	    'table' => 'cruise_cabin',
		'limit' => -1,
		'id_cruise_deck' => $id,
		'order' => '`order` ASC, id_cruise_cabin DESC',
		'images' => true
	));
	
	foreach($_items as &$it){
		$it = get_cruise_cabin_info($it);
		unset($it);
	}
	return $_items;
}

function get_cruise_cabin_info($it){
	$it['description'] = wrap_wysiwyg_text($it['description']);
	$it['short_desc'] = limit_text($it['description'], 300);
	$it['image'] = count($it['images']) ? $it['images'][0]['medium'] : "";
	$it['big'] = count($it['images']) ? $it['images'][0]['big'] : "";
	
	return $it;
}
