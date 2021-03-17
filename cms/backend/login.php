<?php
/**
 * CMS login page
 *
 */

//current page
$log_tries = 3;

if(isset($_GET['action']) && $_GET['action'] == "reset-pass"){

	//reset pass form
	$doReset = 0;
	if(isset($_POST['submit']) && $_POST['action'] == "resetpass"){
		if(isset($_POST['username']) && $_POST['username'] != "") {
			$user = $_POST['username'];
			$doReset = 1;
		}else{
			if($_POST['username'] == ""){
				$err_user = 1;
			}
		}

		//count login tries
		if($_SESSION[$_site_title]['cms']['log_tries'] == "") {
			$_SESSION[$_site_title]['cms']['log_tries'] = 1;
		}else{
			$_SESSION[$_site_title]['cms']['log_tries']++;
		}
	}

	//security captcha validation
	if($_SESSION[$_site_title]['cms']['log_tries'] > $log_tries) {
		if(isset($_POST['captcha']) && $_POST['captcha'] != ""){
			if(strtolower($_POST['captcha']) != strtolower($_SESSION[$_site_title]['CAPTCHAString']['cms_login'])){
				$doReset = 0;
				$err_captcha = 1;
			}
		}else{
			if(isset($_POST['submit'])){
				$doReset = 0;
				$err_captcha = 1;
			}else{
				$doReset = 0;
				$err_captcha = 0;
			}
		}
	}

	if($doReset==1){
		$reset_usr = db_row("SELECT * FROM admin_user WHERE (username = ? OR email = ?) AND active = 1", $user, $user);

		if($reset_usr['id_admin_user'] != "") {

			$newpass = generateCode(mt_rand(6,10));

			//update users table with the new password
			$result = db_query("UPDATE admin_user SET password = ? WHERE id_admin_user = ?", md5($newpass), $reset_usr['id_admin_user']);

			$to = $reset_usr['email'];
			$subject = _lng('reset_pass');
			$content = "Parola noua este: ".$newpass;
			send_mail($to, $subject, $content);

			$succes_reset = 1;

			//reset login tries
			$_SESSION[$_site_title]['cms']['log_tries'] = 0;

			//reset $_POST
			unset($_POST);

		}else{
			$err_reset = 1;
		}
	}

	if($succes_reset){
		$error_msg = _lng('success_reset_user');
		$err_type = "success";
	}elseif($err_reset == 1){
		$error_msg = _lng('err_reset_user');
		$err_type = "error";
	}elseif($err_user == 1){
		$error_msg = _lng('err_user');
		$err_type = "warning";
	}elseif($err_captcha == 1){
		if($_POST['captcha']!=""){
			$error_msg = _lng('err_captcha_wrong');
			$err_type = "error";
		}else{
			$error_msg = _lng('err_captcha_empty');
			$err_type = "warning";
		}
	}else{
		$error_msg = _lng('err_reset_pass_info');
		$err_type = "info";
	}

}else{

	//begin login post processing
	$doLogin = 0;
	if(isset($_POST['submit']) && $_POST['action'] == "login"){
		if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {
			$user = $_POST['username'];
			$pass = md5($_POST['password']);
			$doLogin = 1;
		}else{
			if($_POST['password'] == ""){
				$err_pass = 1;
			}
			if($_POST['username'] == ""){
				$err_user = 1;
			}
		}

		//count login tries
		if(!isset($_POST['2fa_code'])){
			if($_SESSION[$_site_title]['cms']['log_tries'] == "") {
				$_SESSION[$_site_title]['cms']['log_tries'] = 1;
			}else{
				$_SESSION[$_site_title]['cms']['log_tries']++;
			}
		}
	}

	if(isset($_COOKIE[generate_name($_site_title)]["cms"]["username"]) && isset($_COOKIE[generate_name($_site_title)]["cms"]["password"]) && $_GET['action'] != "logout") {
		$user = $_COOKIE[generate_name($_site_title)]["cms"]["username"];
		$pass = $_COOKIE[generate_name($_site_title)]["cms"]["password"];
		$doLogin = 1;
	}

	//security captcha validation
	if($_SESSION[$_site_title]['cms']['log_tries'] > $log_tries) {
		if(isset($_POST['captcha']) && $_POST['captcha'] != ""){
			if(strtolower($_POST['captcha']) != strtolower($_SESSION[$_site_title]['CAPTCHAString']['cms_login'])){
				$doLogin = 0;
				$err_captcha = 1;
			}
		}else{
			if(isset($_POST['submit'])){
				$doLogin = 0;
				$err_captcha = 1;
			}else{
				$doLogin = 0;
				$err_captcha = 0;
			}
		}
	}

	//check in db
	if($doLogin == 1) {

		$login_usr = db_row("SELECT * FROM admin_user WHERE (username = ? OR email = ?) AND password = ? AND active = 1", $user, $user, $pass);

		if($login_usr['id_admin_user'] != "") {

			if($login_usr['use_2fa'] == 1 && $login_usr['2fa_secret'] == ""){

				// set up 2FA
				$ga_2fa = new GoogleAuthenticator();
				$tfa_secret = $ga_2fa->createSecret();

				db_query("UPDATE admin_user SET 2fa_secret = ? WHERE id_admin_user = ?", $tfa_secret, $login_usr['id_admin_user']);

				$qr_account = str_replace(" ", "-", $_site_title)."-CMS";
				$qrCodeUrl = $ga_2fa->getQRCodeGoogleUrl($qr_account, $tfa_secret);

				$check_for_2fa = true;
				$is_2fa_first_time = true;
				$doLogin = false;

			}elseif($login_usr['use_2fa'] == 1 && $login_usr['2fa_secret'] != ""){

				// check 2FA
				$check_for_2fa = true;

				if($_POST['2fa_code'] != ""){
					$ga_2fa = new GoogleAuthenticator();
					$check_2fa = $ga_2fa->verifyCode($login_usr['2fa_secret'], $_POST['2fa_code'], 10);

					if(!$check_2fa) {
						$doLogin = false;
						$err_2fa = true;
					}
				}else{
					$doLogin = false;
					$err_2fa = true;
				}

			}

			if($doLogin){

				//get group permissions
				$perms = db_row('SELECT * FROM admin_group WHERE id_admin_group = ?', $login_usr['id_admin_group']);

				//start the session
				$_SESSION[$_site_title]['cms']['username'] = $login_usr['username'];
				$_SESSION[$_site_title]['cms']['title'] = $login_usr['title'];
				$_SESSION[$_site_title]['cms']['id_admin_user'] = $login_usr['id_admin_user'];
				$_SESSION[$_site_title]['cms']['id_admin_group'] = $login_usr['id_admin_group'];
				$_SESSION[$_site_title]['cms']['user_group'] = $perms['title'];
				$_SESSION[$_site_title]['cms']['permissions'] = json_decode($perms['permission'], true);
				$_SESSION[$_site_title]['cms']['last_visit'] = $login_usr['last_visit'];
				$_SESSION[$_site_title]['cms']['last_ip'] = $login_usr['last_ip'];

				//reset login tries
				$_SESSION[$_site_title]['cms']['log_tries'] = 0;

				//update users table with last ip and last visit
				$result = db_query("UPDATE admin_user SET last_ip = ?, last_visit = '".date('Y-m-d')."' WHERE id_admin_user = ?", $_SERVER['REMOTE_ADDR'], $login_usr['id_admin_user']);

				//insert the log record
				$result = db_query("INSERT INTO admin_user_login SET `ip` = ?, `session_id` = ?, `timestamp` = ?, `id_admin_user` = ?", $_SERVER['REMOTE_ADDR'], session_id(), time(), $login_usr['id_admin_user']);

				//if remember me is checked
				if(isset($_POST['remember']) && $_POST['remember'] == 1 && $login_usr['use_2fa'] != 1) {
					setcookie(generate_name($_site_title)."[cms][username]", $login_usr['username'], time()+60*60*24*30, '/');
					setcookie(generate_name($_site_title)."[cms][password]", $login_usr['password'], time()+60*60*24*30, '/');
				}

				//ok, go to index
				if(isset($_SESSION[$_site_title]['cms']['redirect_login'])){
					$redirect_to = $_SESSION[$_site_title]['cms']['redirect_login'];
					unset($_SESSION[$_site_title]['cms']['redirect_login']);

					go_away($redirect_to);
				}else{
					go_away($_base_cms);
				}

			}

		}else{
			$err_login = 1;
		}

	}

	if($err_login == 1){
		$error_msg = _lng('err_user_pass');
		$err_type = "error";
	}elseif($err_user == 1){
		$error_msg = _lng('err_user');
		$err_type = "warning";
	}elseif($err_pass == 1){
		$error_msg = _lng('err_pass');
		$err_type = "warning";
	}elseif($err_captcha == 1){
		if($_POST['captcha'] != ""){
			$error_msg = _lng('err_captcha_wrong');
			$err_type = "warning";
		}else{
			$error_msg = _lng('err_captcha_empty');
			$err_type = "warning";
		}
	}elseif($check_for_2fa && $err_2fa && isset($_POST['2fa_code'])){
		$error_msg = "Codul de securitate este gresit";
		$err_type = "error";
	}elseif($check_for_2fa){
		$error_msg = "Intoduceti codul de securitate";
		$err_type = "info";
	}else{
		$error_msg = _lng('err_need_login');
		$err_type = "info";
	}

}

//to fully log out a visitor we need to clear the session varialbles
if(isset($_GET['action']) && $_GET['action'] == "logout"){
	unset($_SESSION[$_site_title]['cms']);

	if(isset($_COOKIE[generate_name($_site_title)]["cms"]["username"]) && isset($_COOKIE[generate_name($_site_title)]["cms"]["password"])) {
		setcookie(generate_name($_site_title)."[cms][username]", "", time()-60*60*24*30, '/');
		setcookie(generate_name($_site_title)."[cms][password]", "", time()-60*60*24*30, '/');
	}

	go_away($_base_cms."?login");
}else{
	if(isset($_SESSION[$_site_title]['cms']['username'])){
		go_away($_base_cms);
	}
}
