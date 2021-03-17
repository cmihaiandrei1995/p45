<?
if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

    $_rules['sub_email'] = 'trim|required|email';
    $_rules['sub_name'] = 'trim|required';
    $_rules['sub_surname'] = 'trim|required';

	$_rules['terms'] = 'trim|required';

	$_rules['g-recaptcha-response'] = 'trim|required';
	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];

	// custom messages
	$_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
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

	// if form ok send notification email
	if($_valid){

		nl_subscribe_user($_form['sub_email'], $_form['sub_name'], $_form['sub_surname'], 'Pagina abonare');

	}
}


$_section = "abonare";

// seo
$_meta_title = "Abonare newsletter";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = false;
