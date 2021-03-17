<?
if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

    $_rules['email'] = 'trim|required|email';
    $_rules['name'] = 'trim|required';
    $_rules['surname'] = 'trim|required';
    $_rules['phone'] = 'trim|required|minlength-10|maxlength-10';
	$_rules['newsletter'] = 'trim';

	// $_rules['g-recaptcha-response'] = 'trim|required';

	// custom messages
	$_custom_error_messages = array(
		// 'terms' => array(
		// 	'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		// ),
	);

	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

    if($_valid){
		$email_exists = db_row('SELECT * FROM user_contest_vote WHERE email = ?', $_form['email']);
		if($email_exists){
			$_valid = false;
			$_errors['email'] = "Acest email a mai fost deja inscris";
		}
	}

    /*
	if($_valid){
		$_captcha = google_recaptcha_check($_form['g-recaptcha-response']);
		if(!$_captcha){
			$_valid = false;
			$_errors['g-recaptcha-response'] = "Captcha invalid";
		}
	}
    */

	// if form ok send notification email
	if($_valid){

		db_query('INSERT INTO user_contest_vote SET email = ?, name = ?, surname = ?, title = ?, phone = ?, newsletter = ?', $_form['email'], $_form['name'], $_form['surname'], $_form['name']." ".$_form['surname'], $_form['phone'], $_form['newsletter']);

		send_paralela_mail($_form['email'], 'Mergi la Vot, Mergi in Vacanta', '', 'votenow');

	}
}


$_section = "votenow";

// seo
$_meta_title = "Mergi la vot, Mergi in Vacanta";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = false;
