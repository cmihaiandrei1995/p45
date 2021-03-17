<?

$_item = get_hotel_by_id($_params['id']);
if(!$_item) go_away(route('tourism-home'));

$_item = hotel_prepare_info($_item);

$_item['images'] = get_images('hotel', $_item['id_hotel']);

$_do_not_include_header = true;
$_do_not_include_footer = true;

// seo
$_meta_title = $_item['title'];
$_no_index = true;