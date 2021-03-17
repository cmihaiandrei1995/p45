<?

function nl_subscribe_user($email, $name, $surname, $location = ''){
	global $_config;

	$user = db_query('SELECT * FROM newsletter_user WHERE email = ?', $email);

	if(!$user){
		db_query('INSERT INTO newsletter_user SET name = ?, surname = ?, email = ?, ip = ?, location = ?, created = NOW()', $name, $surname, $email, $_SERVER['REMOTE_ADDR'], $location);
	}

	$client = new SoapClient("http://www.mailagent.ro/MailAgentService.wsdl", array("cache_wsdl" => 'WSDL_CACHE_NONE'));
	try{
		$response = $client->validateSubscriber("bce6e78ce44f438ee72274e031433b84", 28927, $email, array("prenume" => $surname, "nume" => $name), array());
	} catch (SoapFault $e) {
		die("Exception: ".$e->getMessage());
	}

	send_paralela_mail($email, "Abonare confirmata - Paralela45", $content, 'subscribe');

	//print_r($response);

	//echo "Exit projectcodee: " . $response['op_status'] . "\n";
	//echo "Response message: " . $response['op_message'] . "\n";
}

function nl_subscribe_user_to_db_only($email, $name, $surname, $location = ''){
	global $_config;

	$user = db_query('SELECT * FROM newsletter_user WHERE email = ?', $email);

	if(!$user){
		db_query('INSERT INTO newsletter_user SET name = ?, surname = ?, email = ?, ip = ?, location = ?, created = NOW()', $name, $surname, $email, $_SERVER['REMOTE_ADDR'], $location);
	}

	send_paralela_mail($email, "Abonare data protection - Paralela45", $content, 'subscribe');
}



function check_if_offer_is_in_whishlist($user_id, $id, $type, $city_from){
	$exists = db_row('SELECT * FROM user_whishlist WHERE id_user = ? AND id_offer = ? AND type = ? AND id_city_from = ?', $user_id, $id, $type, $city_from);
	if($exists) return true;
	return false;
}



function login_user($user){
	global $_site_title;

	$_SESSION[$_site_title]['logged_in'] = $user;
}

function is_logged_in(){
	global $_site_title;

	return (count($_SESSION[$_site_title]['logged_in']) ? true : false);
}

function get_logged_in_user(){
	global $_site_title;

	return $_SESSION[$_site_title]['logged_in'];
}

function logout_user(){
	global $_site_title;

	if(isset($_COOKIE[generate_name($_site_title)]["client"]["username"]) && isset($_COOKIE[generate_name($_site_title)]["client"]["password"])) {
		setcookie(generate_name($_site_title)."[client][username]", "", time()-60*60*24*30, '/');
		setcookie(generate_name($_site_title)."[client][password]", "", time()-60*60*24*30, '/');
	}

	unset($_SESSION[$_site_title]['logged_in']);
}



function get_user_by_email($email){
	$user = db_row('SELECT * FROM user WHERE email = ?', $email);
	return $user;
}

function get_user_by_id($id_user){
	$user = db_row('SELECT * FROM user WHERE id_user = ?', $id_user);
	return $user;
}

function insert_user($form){
	return db_query('INSERT INTO user SET
		title = ?,
		phone = ?,
		email = ?,
		invoice = ?,
		name = ?,
		surname = ?,
		cnp = ?,
		company = ?,
		cui = ?,
		nr_reg = ?,
		address = ?,
		county = ?,
		city = ?,
		country = ?,
		active = 0
	',
		($form['invoice_type'] ? $form['invoice_name']." ".$form['invoice_surname'] : $form['invoice_company']),
		$form['phone'],
		$form['email'],
		$form['invoice_type'],
		$form['invoice_name'],
		$form['invoice_surname'],
		$form['invoice_cnp'],
		$form['invoice_company'],
		$form['invoice_cui'],
		$form['invoice_nr_reg'],
		$form['invoice_address'],
		$form['invoice_county'],
		$form['invoice_city'],
		$form['invoice_country']
	);
}

function update_user_by_id($form, $id_user){
	db_query('UPDATE user SET
		title = ?,
		phone = ?,
		email = ?,
		invoice = ?,
		name = ?,
		surname = ?,
		cnp = ?,
		company = ?,
		cui = ?,
		nr_reg = ?,
		address = ?,
		county = ?,
		city = ?,
		country = ?
		WHERE id_user = ?
	',
		($form['invoice_type'] ? $form['invoice_name']." ".$form['invoice_surname'] : $form['invoice_company']),
		$form['phone'],
		$form['email'],
		$form['invoice_type'],
		$form['invoice_name'],
		$form['invoice_surname'],
		$form['invoice_cnp'],
		$form['invoice_company'],
		$form['invoice_cui'],
		$form['invoice_nr_reg'],
		$form['invoice_address'],
		$form['invoice_county'],
		$form['invoice_city'],
		$form['invoice_country'],
		$id_user
	);
}
