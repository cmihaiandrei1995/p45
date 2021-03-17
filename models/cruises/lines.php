<?
function get_cruise_line_by_slug($slug){
	$items = db_query('
        SELECT *
        FROM cruise_line
        WHERE '.db_is_active('', 'cruise_line').'
    ');
    foreach($items as $item) {
        if(generate_name($item['title']) == $slug) {
            return $item;
        }
    }
}

function get_cruise_line_by_id($id){
	return db_row('
        SELECT *
        FROM cruise_line
        WHERE '.db_is_active('', 'cruise_line').' 
        	AND id_cruise_line = ?
    ', $id);
}

function get_cruise_line_info($item){
	$item['description'] = wrap_wysiwyg_text(str_replace('&quot;', '', stripslashes($item['description'])));
	$item['short_desc'] = limit_text($item['description'], 300);
	
	$item['images'] = get_images('cruise_line', $item['id_cruise_line']);
	$item['image'] = count($item['images']) ? $item['images'][0]['small'] : "http://placehold.it/105x105?text=".__('Fara imagine');
	$item['medium'] = count($item['images']) ? $item['images'][0]['medium'] : "";
	$item['wide'] = count($item['images']) ? $item['images'][0]['small'] : "";
	$item['big'] = count($item['images']) ? $item['images'][0]['url'] : "";
	
	$item['file'] = get_cruise_line_file($item);
	
	$item['cruises_url'] = route('cruises-line', $item['title']);
	$item['ext_url'] = $item['url'];
	$item['url'] = route('line', $item['title'], $item['id_cruise_line']);
	
	return $item;
}

function get_cruise_line_file($item){
	global $_base;
	
	$file = db_row("SELECT * FROM cruise_line_file WHERE id_cruise_line = ? ORDER BY `order` ASC, id_file DESC LIMIT 1", $item['id_cruise_line']);
	if($file){
		return $_base."uploads/files/".$file['folder'].$file['file'];
	}
	return false;
}