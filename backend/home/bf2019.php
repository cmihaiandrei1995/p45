<?php
if(isset($_POST['bf_nl'])){

    $_rules['email'] = 'trim|required|email';
    $_rules['name'] = 'trim|required';
    // $_rules['surname'] = 'trim|required';
    // $_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-10';
    $_rules['newsletter'] = 'trim';
    // $_rules['g-recaptcha-response'] = 'trim';

    // custom messages
	$_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
	);

    // validate
	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

    foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

    if($_valid){
		$email_exists = db_row('SELECT * FROM user_black_friday WHERE email = ?', $_form['email']);
		if($email_exists){
			$_valid = false;
			$_errors['email'] = "Acest email a mai fost deja inscris";
		}
	}

    if($_valid){
        // $_captcha = google_recaptcha_check($_form['g-recaptcha-response']);
        // if(!$_captcha){
        // }

        // db_query('INSERT INTO user_black_friday SET email = ?, name = ?, surname = ?, title = ?, phone = ?, newsletter = ?', $_form['email'], $_form['name'], $_form['surname'], $_form['name']." ".$_form['surname'], $_form['phone'], $_form['newsletter']);
        db_query('INSERT INTO user_black_friday SET email = ?, title = ?, newsletter = ?', $_form['email'], $_form['name'], $_form['newsletter']);

        send_paralela_mail($_form['email'], "Abonare Black Friday", $content, 'bf2019');
    }

}


$_do_not_include_header = true;
$_do_not_include_footer = true;

$_section = "home";

// seo
$_meta_title = 'Black Friday';
$_meta_description = '';
$_meta_keywords = '';
$_no_index = false;
