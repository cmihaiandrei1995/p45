<?

$options_country = array(
	'table' => 'testimonial',
	'limit' => -1,
	'groupby' => 'id_country'
);

$options_city = array(
	'table' => 'testimonial',
	'limit' => -1,
	'groupby' => 'id_city'
);



if(isset($_GET['v']) && $_GET['v'] != ""){
	$_ipp = $_GET['v'];
}else{
	$_ipp = $_config['paging']['ipp']['testimonial'];
}


$options = array(
	'table' => 'testimonial',
	'offset' => $_params['page'] ? $_ipp * ($_params['page']-1) : 0,
	'limit' => $_ipp,
	'images' => true
);

if(isset($_GET['c']) && $_GET['c'] != ""){
	$options['id_country'] = $_GET['c'];
	$options_city['id_country'] = $_GET['c'];
}

if(isset($_GET['d']) && $_GET['d'] != ""){
	$options['id_city'] = $_GET['d'];
}


list($_testimonials, $_count) = get_posts($options);
list($_country, $_count_country) = get_posts($options_country);
list($_city, $_count_city) = get_posts($options_city);

$_nr_pages = intval($_count/$_ipp);

foreach($_testimonials as &$item){
	$country = get_country_by_id($item['id_country']);
	$city = get_city_by_id($item['id_city']);
	$item['country'] = $country['title'];
	$item['city'] = $city['title'];

	if($item['images']){
		foreach($item['images'] as &$image){
			if(!file_exists(str_replace($_base, $_base_path, $image['small']))){
				$image['small'] = $image['url'];
				$image['big'] = $image['url'];
			}
			unset($image);
		}
	}
	unset($item);
}


foreach($_country as &$item){
	list($tests,$count_test) = get_posts(array(
		'table' => 'testimonial',
		'id_country' => $item['id_country'],
		'limit'	=> -1

	));
	$country = get_country_by_id($item['id_country']);
	$item['country'] = $country['title']. " (" . count($tests) . ")";
	unset($item);
}



function cmp($a, $b){
    //var_dump($a);
    if ($a['country']['country'] == $b['country']['country']) {
        return 0;
    }else{
     return ($a['country']['country'] > $b['country']['country']) ? 1 : -1;
    }
}
usort($_country,'cmp');

foreach($_city as &$item){

	list($tests_city,$count_test_city) = get_posts(array(
		'table' => 'testimonial',
		'id_city' => $item['id_city'],
		'limit'	=> -1

	));

	$city = get_city_by_id($item['id_city']);
	$item['city'] = $city['title']. " (" . count($tests_city) . ")";
	unset($item);
}


function cmps($a, $b){
    //var_dump($a);
    if ($a['city']['city'] == $b['city']['city']) {
        return 0;
    }else{
     return ($a['city']['city'] > $b['city']['city']) ? 1 : -1;
    }
}
usort($_city,'cmps');

//form

list($_countries_form, $_count_countries_form) = get_posts(array(
	'table' => 'country',
	'limit' => -1,
	'extra_where' => 'AND title IS NOT NULL',
	'order' => 'title ASC'
));


list($_cities_form, $_count_cities_form) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
));


if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

	$_rules['title'] = 'trim|required';
	$_rules['name'] = 'trim|required';
	$_rules['email'] = 'trim|email';
	$_rules['country'] = 'trim|required';
	$_rules['city'] = 'trim|required';
	$_rules['description'] = 'trim|required';
	$_rules['rating'] = 'trim|required';
	$_rules['images'] = 'trim|file-png,jpeg,jpg';

	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['contact'];

	$_form = new Validate($_rules, 'post');
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}


	if($_valid){

		create_folders('images');
		$dirname = $_base_uploads_path.'images/'.date('Y').'/'.date('n').'/'.date('j').'/';

		$testimonial = db_query('INSERT INTO testimonial SET title = ?, name = ?, email = ?, id_country = ?, id_city = ?, description = ?, active = ?, date = ?, rating = ? ',
			$_form['title'],
			$_form['name'],
			$_form['email'],
			$_form['country'],
			$_form['city'],
			$_form['description'],
			0,
			date('Y-m-d'),
			$_form['rating']
		);

		$nr_img = count($_FILES['images']['name']);
		$k = 0;

		for($j=1; $j<=$nr_img; $j++){
			if($_FILES['images']['size'][$j-1] != 0) {

				$ext_break = explode(".", $_FILES['images']['name'][$j-1]);
				$ext = strtolower($ext_break[count($ext_break)-1]);

				if($ext == "jpg" || $ext == "jpeg"){
					$k++;

					$code = activation_code(4);
					$filename = strtolower(generate_name(substr($_FILES['images']['name'][$j-1], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);
					$filename_new = strtolower(generate_name(substr($_FILES['images']['name'][$j-1], 0, (-1)*strlen($ext)-1))."-".$code);

					@move_uploaded_file($_FILES['images']["tmp_name"][$j-1], $dirname.$filename);

					list($width, $height, $type, $attr) = getimagesize($dirname.$filename);

					foreach($_config['cms']['testimonials']['fields']['image']['sizes'] as $key => $field_val) {
						if($width < $field_val['width']) {
							@copy($dirname.$filename, $dirname.$key.'-'.$filename);
						}else{
							$rand = mt_rand(0,100);
							@copy($dirname.$filename, $dirname.$rand.$filename);
							$resized = new upload($dirname.$rand.$filename);
							if ($resized->uploaded) {
								$resized->file_new_name_body = $key.'-'.$filename_new;
								$resized->file_name_body_lowercase = true;
								$resized->jpeg_quality = 60;
								$resized->image_watermark = '';
								$resized->file_safe_name = false;
								$resized->image_resize = true;
								if($field_val['height'] == "auto") {
									$resized->image_x = $field_val['width'];
									$resized->image_ratio_y = true;
									$resized->image_ratio_crop = false;
								}elseif($field_val['width'] == "auto")  {
									$resized->image_y = $field_val['height'];
									$resized->image_ratio_x = true;
									$resized->image_ratio_crop = false;
								}else {
									$resized->image_x = $field_val['width'];
									$resized->image_y = $field_val['height'];
									$resized->image_ratio_crop = true;
								}
								$resized->process($dirname);
								if ($resized->processed) {
									$resized->clean();
								}
							}

							if(file_exists($dirname.$rand.$filename)){
								@unlink($dirname.$rand.$filename);
							}
						}
					}

					@rename($dirname.$filename, $dirname.$filename_new.".jpg");

					$_insert = 'INSERT INTO testimonial_img SET
						`id_testimonial` = ?,
						`order` = ?,
						`folder` = ?,
						`image` = ?';

					db_query($_insert, $testimonial, $k, date('Y').'/'.date('n').'/'.date('j').'/', $filename_new.".jpg");
				}
			}
		}


		$content['title'] = "Un nou testimonial a fost adaugat";
		$content['content'] = "
		<p>
			Un nou testimonial a fost adaugat
		</p>
		";

		send_mail($_config['contact']['testimonial'], "Un nou testimonial a fost adaugat ".$_form['title_job'], $content, 'default');

	}
}





$_section = 'testimonial';



// seo
$seo = get_seo('testimoniale');
$_meta_title = $seo['title'] ? $seo['title'] : 'Testimoniale - Paralela 45';
$_meta_description = $seo['description'];
$_meta_keywords = $seo['keywords'];
$_no_index = false;
