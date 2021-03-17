<?

list($_items, $nr) = get_posts(array(
	'table' => 'data_protection',
	'limit' => -1,
	'images' => true
));
foreach($_items as $item){
    if(generate_name($item['title']) == $_params['slug']){
        $_item = $item;
    }
}
if(!$_item){
    go_away(route('data-protection'));
}

if(isset($_POST['submit'])){

	// form validation
	$_valid = true;

	$_rules['name'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric';

	//$_rules['newsletter'] = 'trim';
	$_rules['terms'] = 'trim|required';
	//$_rules['gdpr'] = 'trim|required';

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

		if($_form['newsletter']){
			nl_subscribe_user($_form['email'], $_form['name'], '');
		}

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
$_meta_title = $_item['seo_title'] ? $_item['seo_title'] : $_item['title'];
$_meta_description = $_item['seo_description'];
$_meta_keywords = $_item['seo_keywords'];
$_no_index = false;
