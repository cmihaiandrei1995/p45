<?
/**
 * Gets the image sizes available for a section
 */
function get_images_sizes($table){
	global $_config;
	
	foreach($_config['cms'] as $key => $val){
		if($val['table'] == $table){
			$section = $key;
			break;
		}
	}
	
	if($_config['images'][$section]){
		return $_config['images'][$section];
	}
	
	return false;
}

/**
 * Fetches all the images
 */
function get_images($table, $id, $extra = array()){
	global $_base_uploads;
	
	if(isset($_GET['preview']) && is_logged_in_cms()){
		$active = "";
	}else{
		$active = "active = 1 AND";
	}
	
	$images = db_query('SELECT * FROM '.$table.'_img WHERE '.$active.' id_'.$table.' = ? ORDER BY `order` ASC', $id);
	
    if($images) {
        foreach($images as $i => $img) {
        	if(is_url($img['image'])){
        		// if the name of the image is a link return the link
            	$items[$i]['url'] = $img['image'];
			}else{
				// else return the image on the disk
				$items[$i]['url'] = $_base_uploads . 'images/' . $img['folder'] . $img['image'];
			}
			
            foreach(get_images_sizes($table) as $size) {
            	if(is_url($img['image'])){
            		$items[$i][$size] = $img['image'];
				}else{
                	$items[$i][$size] = $_base_uploads . 'images/' . $img['folder'] . $size . '-' . $img['image'];
				}
            }
			
			if($extra){
				foreach($extra as $k){
					$items[$i][$k] = $img[$k];
				}
			}
        }
    }
	return $items;
}

/**
 * Fetches first image
 */
function get_image($table, $id, $extra = array()){
	global $_base_uploads;
	
	$item = array();
	
	if(isset($_GET['preview']) && is_logged_in_cms()){
		$active = "";
	}else{
		$active = "active = 1 AND";
	}
	
	$image = db_row('SELECT * FROM '.$table.'_img WHERE '.$active.' id_'.$table.' = ? ORDER BY `order` ASC LIMIT 1', $id);
	
    if($image) {
    	if(is_url($image['image'])){
    		// if the name of the image is a link return the link
        	$item['url'] = $image['image'];
		}else{
			// else return the image on the disk
			$item['url'] = $_base_uploads . 'images/' . $image['folder'] . $image['image'];
		}
		
        foreach(get_images_sizes($table) as $size) {
            $item[$size] = $_base_uploads . 'images/' . $image['folder'] . $size . '-' . $image['image'];
        }
		
		if($extra){
			foreach($extra as $k){
				$items[$k] = $img[$k];
			}
		}
    }
	return $item;
}

/**
 * Fetches image from base table by cms field name
 */
function get_image_by_field($table, $field, $id){
	global $_base_uploads, $_config;
	
	$item = array();
	
	foreach($_config['cms'] as $key => $val){
		if($val['table'] == $table){
			$cms_section = $key;
			break;
		}
	}
	
	if($_config['cms'][$cms_section]['fields'][$field]){
		$image = db_row('SELECT * FROM '.$table.' WHERE id_'.$table.' = ?', $id);
		
	    if($image) {
	    	if(is_url($image[$field])){
	    		// if the name of the image is a link return the link
	        	$item['url'] = $image[$field];
			}else{
				// else return the image on the disk
				$item['url'] = $_base_uploads . 'images/' . date('Y', strtotime($image['created'])).'/'.date('n', strtotime($image['created'])).'/'.date('j', strtotime($image['created'])).'/' . $image[$field];
			}
			
	        foreach($_config['cms'][$cms_section]['fields'][$field]['sizes'] as $size => $val) {
	            $item[$size] = $_base_uploads . 'images/' . date('Y', strtotime($image['created'])).'/'.date('n', strtotime($image['created'])).'/'.date('j', strtotime($image['created'])).'/' . $size . '-' . $image[$field];
	        }
	    }
		return $item;
	}
}