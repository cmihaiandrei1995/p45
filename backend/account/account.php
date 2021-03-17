<?

if(!is_logged_in()){
	go_away(route('login'));
}

$_user = get_logged_in_user();

$_form['invoice_type'] = $_user['invoice'];
if($_user['invoice'] == ""){
	$_form['invoice_type'] = "pf";
}
	
if($_form['invoice_type'] == "pf"){
	$_form['invoice_cnp'] = $_user['cnp'];
}
if($_form['invoice_type'] == "pj"){
	$_form['invoice_company'] = $_user['company'];
	$_form['invoice_cui'] = $_user['cui'];
	$_form['invoice_nr_reg'] = $_user['nr_reg'];
}

$_form['invoice_name'] = $_user['name'];
$_form['invoice_surname'] = $_user['surname'];
	
$_form['invoice_address'] = $_user['address'];
$_form['invoice_city'] = $_user['city'];
$_form['invoice_country'] = $_user['country'];
$_form['invoice_county'] = $_user['county'];

$_form['email'] = $_user['email'];
$_form['phone'] = $_user['phone'];




if(isset($_POST['account'])){
	
	$_valid = true;
	
	// invoice
	$_rules['invoice_type'] = 'trim|required';
	
	if($_POST['invoice_type'] == "pf"){
		$_rules['invoice_cnp'] = 'trim|required|cnp';
	}
	if($_POST['invoice_type'] == "pj"){
		$_rules['invoice_company'] = 'trim|required';
		$_rules['invoice_cui'] = 'trim|uppercase|required';
		$_rules['invoice_nr_reg'] = 'trim|uppercase|required';
	}
	
	$_rules['invoice_name'] = 'trim|required';
	$_rules['invoice_surname'] = 'trim|required';
		
	$_rules['invoice_address'] = 'trim|required';
	$_rules['invoice_city'] = 'trim|required';
	$_rules['invoice_country'] = 'trim|required';
	$_rules['invoice_county'] = 'trim|required';
	
	// other data
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-13';
	
	// custom messages
	$_custom_error_messages = array(
		'invoice_cnp' => array(
			'cnp' => "CNP invalid!"
		)
	);
	
	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}
	
	// check email
	if($_valid){
		$user_exists = db_row('SELECT * FROM user WHERE email = ? AND id_user <> ?', $_form['email'], $_user['id_user']);
		if($user_exists){
			$_valid = false;
			$_errors['email'] = "Adresa de email exista deja in baza de date";
		}
	}
	
	// all set, go!
	if($_valid){
		
		update_user_by_id($_form, $_user['id_user']);
		
	}
	
}


if(isset($_POST['pass'])){
	
	$_valid = true;
	
	$_rules['password'] = 'trim|required';
	$_rules['repassword'] = 'trim|required';
	
	// validate
	$_form_pass = new Validate($_rules, 'post');
	$_valid = $_form_pass->check();
	
	foreach($_rules as $key => $val){
		if($_form_pass->error($key) != ""){
			$_errors[$key] = $_form_pass->error($key);
		}
	}
	
	if($_form_pass['password'] != $_form_pass['repassword']){
		$_valid = false;
		$_errors['repassword'] = "Parolele nu corespund";
	}
	
	// all set, go!
	if($_valid){
		db_query('UPDATE user SET password = ? WHERE id_user = ?', md5($_form_pass['password']), $_user['id_user']);
	}
	
}



$_section = "account";

// seo
$_meta_title = "Date cont";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;