<?

$_text = get_post(array(
    'table' => 'page',
    'id_page' => 276
));

if(isset($_POST['submit'])){
	// form validation
	$_valid = true;

	$_rules['name'] = 'trim|required';
	$_rules['surname'] = 'trim|required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-10';
    $_rules['newsletter'] = 'trim';



	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}


	if($_valid){
		$email_exists = db_row('SELECT * FROM user_contest_revolut WHERE email = ?', $_form['email']);
		if($email_exists){
			$_valid = false;
			$_errors['email'] = "Acest email a mai fost deja inscris";
		}
	}

	// if form ok send notification email
	if($_valid){
		db_query('INSERT INTO user_contest_revolut SET email = ?, name = ?, surname = ?, title = ?, phone = ?, newsletter = ?', $_form['email'], $_form['name'], $_form['surname'], $_form['name']." ".$_form['surname'], $_form['phone'], $_form['newsletter']);

		send_paralela_mail($_form['email'], "Paralela45 Revolut", '', 'revolut');

		$message = urlencode('Inregistreaza-te folosind acest link https://revolut.ngih.net/paralela45y si ia-ti GRATUIT cardul tau Revolut. Iti multumim! Echipa Paralela 45');
		$curl = curl_init();
		curl_setopt_array($curl, [
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://utilsapi.newsmanapp.com/smsparalela45/?key=656a565b9d9e9a77cb98e7f41068198f&message='.$message.'&to='.$_form['phone']
		]);
		$result = curl_exec($curl);

	}
}

// seo
$_meta_title                = $_text['seo_title'] != '' ? $_text['seo_title'] : $_text['title'];
$_meta_description          = $_text['seo_description'] != '' ? $_text['seo_description'] : '';
$_meta_keywords             = $_text['seo_keywords'] != '' ? $_text['seo_keywords'] : '' ;

//ogg
$_meta_ogg['type']          = 'website';
$_meta_ogg['title']         = $_text['seo_title'] != '' ? $_text['seo_title'] : $_text['title'];
$_meta_ogg['description']   = $_text['seo_description'] != '' ? $_text['seo_description'] : '';
$_meta_ogg['image']         = '';

$_no_index                  = false;
