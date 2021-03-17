<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 263

));

list($_items, $nr) = get_posts(array(
	'table' => 'data_protection',
	'limit' => -1,
	'images' => true
));


if(isset($_POST['submit'])){

	// form validation
	$_valid = true;

	$_rules['name'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric';

	//$_rules['newsletter'] = 'trim';
	$_rules['terms'] = 'trim|required';
	if($_POST['item'] == 1){
		$_rules['gdpr'] = 'trim|required';
	}else{
		$_rules['gdpr'] = 'trim';
	}

	$_rules['item'] = 'trim|required|numeric';

	$_rules['g-recaptcha-response'] = 'trim|required';
	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];

	// custom messages
	$_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
		'gdpr' => array(
			'required' => "Trebuie sa fii de acord cu aceasta clauza!"
		)
	);

	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	if($_valid){
		$_captcha = google_recaptcha_check($_form['g-recaptcha-response']);
		if(!$_captcha){
			$_valid = false;
			$_errors['g-recaptcha-response'] = "Captcha invalid";
		}
	}

	if($_valid){

		if($_form['gdpr']){
			nl_subscribe_user_to_db_only($_form['email'], $_form['name'], '', 'Panou gdpr');
		}

		$_item = get_post(array(
			'table' => 'data_protection',
			'id_data_protection' => $_form['item']
		));

		$content['title'] = "Formular protectie date pentru ".$_item['title'];
		$content['content'] = "
		<p>
			Nume: ".$_form['name']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Motiv: ".$_item['title']."<br>
		</p>
		";

		send_mail($_config['contact']['gdpr'], "Formular protectie date pentru ".$_item['title'], $content, 'default');

	}
}



$_section = 'data_protection';

// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
