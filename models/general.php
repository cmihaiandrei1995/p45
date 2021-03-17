<?

function get_currency(){
    $currency = db_row('SELECT * FROM currency ORDER BY `date` DESC LIMIT 1');
    return $currency['value'];
}

function send_paralela_mail($to, $subject, $content, $template = '') {
    global $_config, $_base, $_base_path;

    if($template) {
        ob_start();
        include $_base_path.'content/mail_tpl/'.$template.'.php';
        $content = ob_get_clean();
    }

    /*
	$client = new SoapClient("http://www.mailagent.ro/MailAgentService.wsdl", array("cache_wsdl" => 'WSDL_CACHE_NONE'));
	try{
		$response = $client->sendMessage("bce6e78ce44f438ee72274e031433c62", 455443, $to,
			array(
				"subject" => $subject,
				"body" => $content,
				"text_version" => mail_prepare_plain_text($content),
				"ignoreHB" => 1
			),
		1);
	} catch(SoapFault $e) {
		//die("Exception: ".$e->getMessage());
		return false;
	}

	if($response['op_message'] == "Ok") return true;
	return false;
    */

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$_config['email']['mailgun_apikey']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $plain = strip_tags($content);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$_config['email']['mailgun_domain'].'/messages');
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'from' => $_config['email']['name_from'].' <'.$_config['email']['email_from'].'>',
        'to' => $to,
        'subject' => $subject,
        'html' => $content,
        'text' => mail_prepare_plain_text($content)
    ));

    $j = json_decode(curl_exec($ch));

    curl_close($ch);

    return $j;
}



function get_team_by_slug($slug){
	$items = db_query('
        SELECT *
        FROM team_category
        WHERE '.db_is_active('', 'team_category').'
    ');
    foreach($items as $item) {
        if(generate_name($item['title']) == $slug) {
            return $item;
        }
    }
}

function get_company_image_by_id($id){
	return db_row('SELECT * FROM ticket_company_img where id_ticket_company in (Select id_ticket_company from ticket_company WHERE id_ticket_company = ?)', $id);
}

function get_company_by_id($id){
	return db_row('SELECT * FROM ticket_company WHERE id_ticket_company = ?', $id);
}


function extractDataFromDate($date){
	$date_time = strtotime($date);

	$day = date('d', $date_time);
	$month = date('m', $date_time);
	$year = date('Y', $date_time);

	$dob = $year.'-'.$month.'-'.$day;

	$datetime1 = new DateTime('now');
	$datetime2 = new DateTime($dob);
	$interval = $datetime1->diff($datetime2);
	$age = $interval->format('%Y');

	return array(
		'day' => $day,
		'month' => $month,
		'year' => $year,
		'dob' => $dob,
		'age' => $age,
	);
}
