<?

list($_jobs) = get_posts(array(
	'table' => 'jobs',
	'limit' => -1,
));

list($_despre_pages, $count) = get_posts(array(
	'table' => 'about_new',
	'limit' => -1
));

$_text = get_post(array(
	'table' => 'page',
	'id_page' => 252,
));
foreach($_jobs as $job){

	if(isset($_POST['submit-'.$job['id_jobs']])){

		// form validation
		$_valid = true;

		$_rules['name'] = 'required';
		$_rules['email'] = 'trim|required|email';
		$_rules['phone'] = 'trim|required';
		$_rules['letter'] = 'trim|required';
		$_rules['file'] = 'trim|requiredfile|file-doc,docx,pdf,png,jpg,jpeg';

		//$_rules['g-recaptcha-response'] = 'trim|required';
		//$_rules['captcha'] = 'trim|required|lowercase|equal-'.$_SESSION[$_site_title]['CAPTCHAString']['reservation'];

		$_form = new Validate($_rules, 'post');
		$_valid = $_form->check();

		foreach($_rules as $key => $val){
			if($_form->error($key) != ""){
				$_errors[$key] = $_form->error($key);
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

			$dirname = $_base_path.'uploads/files/cv/';

			if($_FILES['file']["size"] != 0) {

				$ext_break = explode(".", $_FILES['file']["name"]);
				$ext = $ext_break[count($ext_break)-1];

				$code = activation_code(4);
				$filename = strtolower(generate_name(substr($_FILES['file']["name"], 0, (-1)*strlen($ext)-1))."-".$code.".".$ext);

				@move_uploaded_file($_FILES['file']["tmp_name"], $dirname.$filename);

			}

			db_query('INSERT INTO jobs_applicants SET name = ?, email = ?, phone = ?, letter = ?, file = ?, job_title = ? ',
				$_form['name'],
				$_form['email'],
				$_form['phone'],
				$_form['letter'],
				$filename,
				$_form['title_job']
			);

			$content['title'] = "Aplicatie job ".$_form['title_job'];
			$content['content'] = "
			<p>
				Job: ".$_form['title_job']."<br>
				Nume: ".$_form['name']."<br>
				Email: ".$_form['email']."<br>
				Telefon: ".$_form['phone']."<br>
				Scrisoare de intentie: ".$_form['letter']."<br>
				CV: <a href='".$_base.'uploads/files/cv/'.$filename."'> ".$_base.'uploads/files/cv/'.$filename."</a><br>
			</p>
			";

			send_mail($_config['contact']['jobs'], "Aplicatie job ".$_form['title_job'], $content, 'default');

		}
	}

}

$_section = 'jobs';



//seo
$_meta_title = $_text['seo_title'] ? $_text['seo_title'] : $_text['title'];
$_meta_description = $_text['seo_description'];
$_meta_keywords = $_text['seo_keywords'];
$_no_index = false;
