<?
// text turism intern
$_text_turism_intern = get_post(array(
	'table' => 'home_text',
	'id_home_text' => 5,
));

$_extra_text[$id] = array(
	get_post(array(
		'table' => 'home_text',
		'id_home_text' => 16
	))
);

$_box_tourism_intern_city_tag = cache_get('homepage__box_turism_intern');
if(!$_box_tourism_intern_city_tag){
	list($_box_tourism_intern_city_tag, $count) = get_posts(array(
		'table' => 'home_tourism_intern',
		'limit' => -1,
		'query' => array(
			'key' => 'id_city_tag',
			'compare' => '>',
			'value' => 0
		),
		'images' => true,
	));
	foreach($_box_tourism_intern_city_tag as $k => &$box){
		$tag = get_city_tag_by_id($box['id_city_tag']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 6,
			'id_country' => 126,
			'extra_where' => '
				AND id_city IN (
					SELECT id_city FROM hotel WHERE id_hotel IN (
						SELECT id_hotel FROM hotel_minprice
					)
				)
				AND id_city IN (
					SELECT id_city FROM city_to_tag WHERE id_city_tag = '.$box['id_city_tag'].'
				)
			',
		));

		if(!$box['cities']){
			unset($_box_tourism_intern_hotel_tag[$k]);
		}else{
			foreach($box['cities'] as &$city){
				$city['url'] = route('tourism-ro-cat', $tag['title_front'])."?&ct=".$city['id_city'];
				unset($city);
			}
		}

		$box['url'] = route('tourism-ro-cat', $tag['title_front']);

		unset($box);
	}

	cache_set('homepage__box_turism_intern', $_box_tourism_intern_city_tag, 60*60);
}


$_box_tourism_intern_hotel_tag = cache_get('homepage__box_turism_intern_2');
if(!$_box_tourism_intern_hotel_tag){
	list($_box_tourism_intern_hotel_tag, $count) = get_posts(array(
		'table' => 'home_tourism_intern',
		'limit' => -1,
		'query' => array(
			'key' => 'id_hotel_tag',
			'compare' => '>',
			'value' => 0
		),
		'images' => true,
	));

	foreach($_box_tourism_intern_hotel_tag as $k => &$box){
		$tag = get_hotel_tag_by_id($box['id_hotel_tag']);
		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 6,
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

		if(!$box['cities']){
			unset($_box_tourism_intern_hotel_tag[$k]);
		}else{
			foreach($box['cities'] as &$city){
				$city['url'] = route('tourism-ro-cat', $tag['title'])."?&ct=".$city['id_city'];
				unset($city);
			}
		}

		$box['url'] = route('tourism-ro-cat', $tag['title']);

		unset($box);
	}

	cache_set('homepage__box_turism_intern_2', $_box_tourism_intern_hotel_tag, 60*60);
}

$_box_tourism_intern_hotel_group_tag = cache_get('homepage__box_turism_intern_3');
if(!$_box_tourism_intern_hotel_group_tag){
	list($_box_tourism_intern_hotel_group_tag, $count) = get_posts(array(
		'table' => 'home_tourism_intern',
		'limit' => -1,
		'query' => array(
			'key' => 'id_hotel_group_tag',
			'compare' => '>',
			'value' => 0
		),
		'images' => true,
	));


	foreach($_box_tourism_intern_hotel_group_tag as $k => &$box){
		$group_tag = get_hotel_group_tag_by_id($box['id_hotel_group_tag']);
		$all_tags = db_query('SELECT * FROM hotel_group_tag_to_hotel_tag WHERE id_hotel_group_tag = ?', $box['id_hotel_group_tag']);

		$hotel_tags = array(0);
		foreach($all_tags as $tg){
			$hotel_tags[] = $tg['id_hotel_tag'];
		}

		list($box['cities'], $count) = get_posts(array(
			'table' => 'city',
			'limit' => 6,
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
						WHERE hotel_grila.id_hotel_tag IN ('.implode(',', $hotel_tags).') AND hotel_grila.description != "" AND hotel_grila.description IS NOT NULL AND hotel_grila.date_tab_from <= NOW() AND hotel_grila.date_tab_to >= NOW()
					)
				)
			',
			'order' => 'title ASC',
		));

		if(!$box['cities']){
			unset($_box_tourism_intern_hotel_group_tag[$k]);
		}else{
			foreach($box['cities'] as &$city){
				$city['url'] = route('tourism-ro-cat', $group_tag['title'])."?&ct=".$city['id_city'];
				unset($city);
			}
		}

		$box['url'] = route('tourism-ro-cat', $group_tag['title']);

		unset($box);
	}

	cache_set('homepage__box_turism_intern_3', $_box_tourism_intern_hotel_group_tag, 60*60);
}

// slider turism
list($_slider_tourism_intern, $tourism_intern_count) = get_posts(array(
	'table' => 'home_tourism_intern_slider',
	'limit' => -1,
	'images' => true
));

// slider video
list($_slider_video_tourism_intern, $tourism_intern_count) = get_posts(array(
	'table' => 'home_tourism_intern_video',
	'images' => 1,
	'limit' => -1
));
foreach($_slider_video_tourism_intern as $k => &$item){
	if($item['id_hotel']){
		$hotel = get_hotel_by_id($item['id_hotel']);
		$hotel['images'] = get_images('hotel', $item['id_hotel']);
		$hotel = hotel_prepare_info($hotel);

		if($hotel){
			$item['title'] = $hotel['title'];
			$item['images'] = $hotel['images'];
			$item['zone'] = $hotel['zone']['title'];
			$item['url'] = $hotel['url'];
			$item['show_icon'] = $hotel['video_id'] != "" ? true : false;
		}
	}

	if($item['title'] == ""){
		unset($_slider_video_tourism_intern[$k]);
	}
	unset($item);
}
