<?


if($_params['action'] == "logout"){
	$go_away = route('login');
	logout_user();
	go_away($go_away);
}

if(is_logged_in()){
	go_away(route('my-account'));
}

if(isset($_params['confirm'])){
	db_query('UPDATE user SET active = 1 WHERE MD5(id_user) = ?', $_params['confirm']);
	$show_success_activation = true;
}

if(isset($_POST['action']) && $_POST['action'] == "forgot"){
	// form validation
	$_valid = true;

	$_rules['email'] = 'trim|required|email';

	$_form = new Validate($_rules, 'post');
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	if($_valid){
		$check_user = db_row('SELECT * FROM user WHERE email = ?', $_form['email']);
		if($check_user){
			$newpass = activation_code(6);
			db_query('UPDATE user SET password = ? WHERE id_user = ?', md5($newpass), $check_user['id_user']);

			$content['title'] = "Resetare parola";
			$content['content'] = "
				<p>
					Parola contului tau a fost resetata. Noua parola este: ".$newpass."<br><br>
				</p>
			";
			send_paralela_mail($_form['email'], "Resetare parola cont - Paralela45", $content, 'default');
		}else{
			$_valid = false;
			$_errors['email'] = "Adresa de email inexistenta.";
		}
	}
}

if(isset($_POST['action']) && $_POST['action'] == "login"){
	// form validation
	$_valid = true;

	$_rules['email'] = 'trim|required|email';
	$_rules['password'] = 'trim|required';

	$_form = new Validate($_rules, 'post');
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

	if($_valid){
		$check_user = db_row('SELECT * FROM user WHERE email = ? AND password = ?', $_form['email'], md5($_form['password']));
		if($check_user){
			if($check_user['active'] == 1){
				if(isset($_POST['remember']) && $_POST['remember']==1) {
					setcookie(generate_name($_site_title)."[client][username]", $check_user['email'], time()+60*60*24*30, '/');
					setcookie(generate_name($_site_title)."[client][password]", $check_user['password'], time()+60*60*24*30, '/');
				}
				login_user($check_user);
				go_away(route('my-account'));
			}else{
				$_valid = false;
				$_errors['email'] = "Contul nu a fost confirmat. <a href='".route('resend-link', md5($check_user['id_user']))."'>Retrimite linkul de confirmare.</a>";
			}
		}else{
			$_valid = false;
			$_errors['email'] = "Email inexistent in baza de date sau parola gresita.";
		}
	}
}

if(isset($_POST['action']) && $_POST['action'] == "register"){
	// form validation
	$_valid = true;

	$_rules['name'] = 'trim|required';
	$_rules['surname'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric';
	$_rules['password'] = 'trim|required';
	$_rules['repassword'] = 'trim|required';
	$_rules['terms'] = 'trim|required';
	$_rules['gdpr'] = 'trim|required';

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

	$check_email = db_row('SELECT * FROM user WHERE email = ?', $_form['email']);
	if($check_email){
		$_valid = false;
		$_errors['email'] = "Adresa de email este deja folosita";
	}

	if($_form['password'] != $_form['repassword']){
		$_valid = false;
		$_errors['repassword'] = "Parolele nu corespund";
	}

	if($_valid){
		$id_user = db_query('INSERT into user SET title = ?, name = ?, surname = ?, email = ?, password = ?, phone = ?, active = 0, created = NOW()',
			$_form['surname']." ".$_form['name'],
			$_form['name'],
			$_form['surname'],
			$_form['email'],
			md5($_form['password']),
			$_form['phone']
		);

		$content['link'] = route('confirm-account', md5($id_user));
		send_paralela_mail($_form['email'], "Confirmare inregistrare cont - Paralela45", $content, 'register');

		$content['title'] = "Inregistrare noua";
		$content['content'] = "
			<p>
				Nume: ".$_form['name']."<br>
				Prenume: ".$_form['surname']."<br>
				Email: ".$_form['email']."<br>
				Telefon: ".$_form['phone']."<br>
			</p>
		";

		foreach($_config['contact']['register'] as $k => $mail){
			send_mail($mail, "Inregistrare noua", $content, 'default');
		}
	}
}

if($_params['resend']){
	$check_user = db_row('SELECT * FROM user WHERE MD5(id_user) = ?', $_params['resend']);
	if($check_user){
		$content['link'] = route('confirm-account', md5($check_user['id_user']));
		send_paralela_mail($check_user['email'], "Confirmare inregistrare cont - Paralela45", $content, 'register');

		$_show_resend = true;
	}
}






$_do_not_include_header = true;
$_do_not_include_footer = true;

$_section = "login";

// seo
$_meta_title = 'Login clienti';
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;
