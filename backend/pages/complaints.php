<?

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 7,
	'images' => true
));

if(isset($_POST['submit'])){

	$_valid = true;
	
	$_rules['name'] = 'required';
	$_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required';
	$_rules['observations'] = 'trim|required';
	
	$_rules['g-recaptcha-response'] = 'trim|required';
	//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];
		
	$_form = new Validate($_rules, 'post');
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
		
		$complaint = db_query('INSERT INTO complaints SET name = ?, email = ?, phone = ?, observations = ? ',
			$_form['name'],
			$_form['email'],
			$_form['phone'],
			$_form['observations']

		);
		
		$content['title'] = "Reclamatie";
		$content['content'] = "
		<p>
			Nume: ".$_form['name']."<br>
			Email: ".$_form['email']."<br>
			Telefon: ".$_form['phone']."<br>
			Observatii: ".$_form['observations']."<br>
		</p>
		";
		
		send_mail($_config['contact']['complaints'], "Reclamatie", $content, 'default');
		
	}
}


// seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;