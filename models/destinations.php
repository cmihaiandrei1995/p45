<?

function get_country_by_id($id){
	return db_row('SELECT * FROM country WHERE id_country = ?', $id);
}

function get_country_id_by_name($id){
    return db_row('SELECT id_country FROM country WHERE title = ?', $id);
}

function get_country_by_iso_code($code){
	return db_row('SELECT * FROM country WHERE code = ?', $code);
}

function get_country_by_slug($slug){
	list($countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1
	));

	foreach($countries as $country){
		if(generate_name($country['title']) == $slug){
			return $country;
		}
	}

	return null;
}

function get_country_by_title($slug){
	list($countries, $count) = get_posts(array(
		'table' => 'country',
		'limit' => -1
	));

	foreach($countries as $country){
		if(trim($country['title']) == trim($slug)){
			return $country;
		}
	}

	return null;
}

function get_continent_by_id($id){
	return db_row('SELECT * FROM continent WHERE id_continent = ?', $id);
}





function get_city_tag_by_slug($slug){
	list($tags, $count) = get_posts(array(
		'table' => 'city_tag',
		'limit' => -1
	));

	foreach($tags as $tag){
		if(generate_name($tag['title_front']) == $slug){
			return $tag;
		}
	}

	return null;
}

function get_city_tag_by_id($id){
	return db_row('SELECT * FROM city_tag WHERE id_city_tag = ?', $id);
}





function get_zone_by_eurosite_code($code){
	return db_row('SELECT * FROM zone WHERE code = ?', $code);
}

function get_zone_by_id($id){
	return db_row('SELECT * FROM zone WHERE id_zone = ?', $id);
}

function get_zone_by_slug($slug){
	list($zones, $count) = get_posts(array(
		'table' => 'zone',
		'limit' => -1
	));

	foreach($zones as $zone){
		if(generate_name($zone['title']) == $slug){
			return $zone;
		}
	}

	return null;
}






function get_city_by_eurosite_code($code){
	return db_row('SELECT * FROM city WHERE code = ?', $code);
}

function get_city_by_id($id){
	return db_row('SELECT * FROM city WHERE id_city = ?', $id);
}

function get_city_id_by_name($id){
    return db_row('SELECT id_city FROM city WHERE title = ?', $id);
}

function get_city_id_by_name_and_country($id, $id_country){
    return db_row('SELECT id_city FROM city WHERE title = ? AND id_country = ?', $id, $id_country);
}

function get_city_by_slug($slug){

	$tmp = explode("-", $slug);

	$where = ' AND (0 ';
	foreach($tmp as $t){
		$where .= ' OR title LIKE "%'.$t.'%"';
	}
	$where .= ')';

	list($cities, $count) = get_posts(array(
		'table' => 'city',
		'limit' => -1,
		'extra_where' => $where
	));

	foreach($cities as $city){
		if(generate_name($city['title']) == $slug){
			return $city;
		}
	}

	return null;
}

function get_city_by_title_and_id_country($slug, $id){
	list($cities, $count) = get_posts(array(
		'table' => 'city',
		'id_country' => $id,
		'limit' => -1
	));

	foreach($cities as $city){
		if(trim($city['title']) == trim($slug)){
			return $city;
		}
	}

	return null;
}




function get_continent_by_slug($slug){
	list($continents, $count) = get_posts(array(
		'table' => 'continent',
		'limit' => -1
	));

	foreach($continents as $continent){
		if(generate_name($continent['title']) == $slug){
			return $continent;
		}
	}

	return null;
}




function get_category_by_slug($slug){
	list($cats, $count) = get_posts(array(
		'table' => 'category',
		'limit' => -1
	));

	foreach($cats as $cat){
		if(generate_name($cat['title']) == $slug){
			return $cat;
		}
	}

	return null;
}


function get_charter_category_by_slug_and_city_from($slug, $id_city){
	list($cats, $count) = get_posts(array(
		'table' => 'charter_category',
		'id_city_from' => $id_city,
		'limit' => -1
	));

	foreach($cats as $cat){
		if(generate_name($cat['title']) == $slug){
			return $cat;
		}
	}

	return null;
}
