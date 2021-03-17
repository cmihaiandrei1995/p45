<?
/**
 * Sends email using template
 *
 * @return The result of the sending process.
 *
 */
function send_mail($to, $subject, $content, $template = '', $from = '', $from_name = '', $debug = false, $attachments = array()) {
    global $_config, $_base, $_base_path;

    if(empty($from_name)) {
        $from_name = ($_config['email']['name_from'] != "" ? $_config['email']['name_from'] : $_config['site']['name']);
    }
    if(empty($from)) {
        $from = ($_config['email']['email_from'] != "" ? $_config['email']['email_from'] : "office@".str_replace("www.", "", $_config['site']['domain']));
    }

    // check for , and ; in to email
    $to = str_replace(";", ",", $to);

    $tmp_to = explode(',', $to);
    foreach($tmp_to as $val){
        $emails_to[] = trim($val);
    }

    if($template) {
        ob_start();
        include $_base_path.'content/mail_tpl/'.$template.'.php';
        $content = ob_get_clean();
    }

    if($_config['email']['smtp']){

        if($_config['email']['use_pear']){

            require_once('Mail.php');
            require_once('Mail/mime.php');

            $smtpinfo['host'] = $_config['email']['hostname'];
            $smtpinfo['port'] = $_config['email']['port'];
            if($_config['email']['password'] != ""){
                $smtpinfo['auth'] = true;
                $smtpinfo['username'] = $_config['email']['email_auth'];
                $smtpinfo['password'] = $_config['email']['password'];
            }else{
                $smtpinfo['auth'] = false;
            }

            if($debug){
                $smtpinfo['debug'] = true;
            }

            $mail = Mail::factory('smtp', $smtpinfo);
            $mime = new Mail_mime();

            foreach($emails_to as $to){
                $headers = array(
                    'From' => $from_name." <".$from.">",
                    'To' => $to,
                    'Subject' => $subject
                );
                $mime->setHtmlBody($content);
                $mime->setTxtBody(mail_prepare_plain_text($content));
                $body = $mime->get();
                $headers = $mime->headers($headers);

                $return[] = $mail->send($to, $headers, $body);
            }

            return $return;

        }else{

            $mail = new PHPMailer();
            $mail->IsSMTP();

            $mail->From     = $from;
            $mail->FromName = $from_name;

            $mail->Host     = $_config['email']['hostname'];
            $mail->Sender   = $_config['email']['email_auth'];

            if($_config['email']['password'] != ""){
                $mail->Username = $_config['email']['email_auth'];
                $mail->Password = $_config['email']['password'];
                $mail->SMTPAuth = true;
                $mail->SMTPAutoTLS = $_config['email']['tls'] ? true : false;
            }

            if($debug){
                $mail->SMTPDebug = true;
            }

            $mail->ContentType = "text/html";
            $mail->Port     = $_config['email']['port'];
            $mail->Mailer   = "smtp";
            $mail->CharSet  = "utf-8";
            $mail->Subject  = $subject;
            $mail->Body     = $content;
            $mail->AltBody  = mail_prepare_plain_text($content);
            $mail->AddCustomHeader("Organization: ".$_config['site']['name']);

			if($attachments){
				foreach($attachments as $file){
					$mail->addAttachment($file);
				}
			}

            foreach($emails_to as $to){
                $mail->AddAddress($to);
            }
            $mail->AddReplyTo($from, $from_name);

            return $mail->Send();

        }

	}elseif($_config['email']['sendgrid']){

		require_once($_base_path.'lib/classes/mail/sendgrid/SendGrid.php');
		require_once($_base_path.'lib/classes/mail/sendgrid/Mail.php');

		//$sendgrid = new SendGrid($_config['email']['sendgrid_api_key']);
		//$email = new SendGrid\Email();

		$url = 'https://api.sendgrid.com/';
		$pass = $_config['email']['sendgrid_api_key'];

        foreach($emails_to as $to){
    		$params = array(
    		    'to'        => $to,
    		    //'toname'    => "Example User",
    		    'from'      => $from,
    		    'fromname'  => $from_name,
    		    'subject'   => $subject,
    		    'text'      => mail_prepare_plain_text($content),
    		    'html'      => $content,
    		);

    		$request = $url.'api/mail.send.json';

    		// Generate curl request
    		$session = curl_init($request);
    		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    		curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_config['email']['sendgrid_api_key']));
    		curl_setopt($session, CURLOPT_POST, true);
    		curl_setopt($session, CURLOPT_POSTFIELDS, $params);
    		curl_setopt($session, CURLOPT_HEADER, false);
    		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    		// obtain response
    		$response = curl_exec($session);
    		curl_close($session);

    		$return[] = $response;
        }

        return $return;

    }elseif($_config['email']['mandrill']){

        require_once($_base_path.'lib/classes/mail/swiftmailer/swift_required.php');

        foreach($emails_to as $to){
            $transport = Swift_SmtpTransport::newInstance($_config['email']['mandrill_host'], $_config['email']['mandrill_port']);
            $transport->setUsername($_config['email']['mandrill_username']);
            $transport->setPassword($_config['email']['mandrill_api_key']);
            $swift = Swift_Mailer::newInstance($transport);

            $message = new Swift_Message($subject);
            $message->setFrom(array($from => $from_name));
            $message->setBody($content, 'text/html');
            $message->setTo($to);
            $message->addPart(mail_prepare_plain_text($content), 'text/plain');

            $return[] = $swift->send($message, $failures);
        }

        return $return;

    }elseif($_config['email']['mailgun']){

        foreach($emails_to as $to){
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
                'text' => $plain
            ));

            $j = json_decode(curl_exec($ch));

            curl_close($ch);

            $return[] = $j;
        }

        return $return;

    }else{

        $headers .= "From: ".$from_name." < ".$from." > \r\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=utf-8\n";

        foreach($emails_to as $to){
            $return[] = @mail($to, '=?utf-8?B?'.base64_encode($subject).'?=', $content, $headers);
        }

        return $return;

    }
}

function mail_prepare_plain_text($content){
     $content = strip_html_tags($content);
     $content = str_replace("&nbsp;", "", $content);
     $content = str_replace("\t", "", $content);
     $content = preg_replace("/\n{3,}/", "\n\n", $content);

     return $content;
}




function mail_login($host, $port, $user, $pass, $folder = "INBOX", $ssl = false){
    $ssl = ($ssl == false) ? "/novalidate-cert":"";
    return imap_open("{"."$host:$port/pop3$ssl"."}$folder", $user, $pass);
}

function mail_stat($connection){
    $check = imap_mailboxmsginfo($connection);
    return (array)$check;
}

function mail_list($connection, $message = ""){
    if ($message){
        $range = $message;
    } else {
        $MC = imap_check($connection);
        $range = "1:".$MC->Nmsgs;
    }
    $response = imap_fetch_overview($connection, $range);
    foreach ($response as $msg) {
        $result[$msg->msgno] = (array)$msg;
    }
    return $result;
}

function mail_retr_headers($connection, $message){
    return imap_fetchheader($connection, $message, FT_PREFETCHTEXT);
}

function mail_delete($connection, $message){
    return imap_delete($connection, $message);
}

function mail_expunge($connection){
    return imap_expunge($connection);
}

function mail_parse_headers($headers){
    $headers = preg_replace('/\r\n\s+/m', '', $headers);
    preg_match_all('/([^: ]+): (.+?(?:\r\n\s(?:.+?))*)?\r\n/m', $headers, $matches);
    foreach ($matches[1] as $key =>$value) {
        $result[$value] = $matches[2][$key];
    }
    return $result;
}

function mail_body($connection, $message){
    return imap_body($connection, $message);
}

function mail_close($connection){
    return imap_close($connection);
}







//manage attachments

function mail_mime_to_array($imap, $mid, $parse_headers = false){
    $mail = imap_fetchstructure($imap, $mid);
    $mail = mail_get_parts($imap, $mid, $mail, 0);
    if ($parse_headers){
        $mail[0]["parsed"] = mail_parse_headers($mail[0]["data"]);
    }
    return $mail;
}

function mail_get_parts($imap, $mid, $part, $prefix){
    $attachments = array();
    $attachments[$prefix] = mail_decode_part($imap, $mid, $part, $prefix);
    if (isset($part->parts)){
        $prefix = ($prefix == "0")?"":"$prefix.";
        foreach ($part->parts as $number=>$subpart){
            $attachments = array_merge($attachments, mail_get_parts($imap, $mid, $subpart, $prefix.($number+1)));
        }
    }
    return $attachments;
}

function mail_decode_part($connection,$message_number,$part,$prefix){
    $attachment = array();

    if($part->ifdparameters) {
        foreach($part->dparameters as $object) {
            $attachment[strtolower($object->attribute)]=$object->value;
            if(strtolower($object->attribute) == 'filename') {
                $attachment['is_attachment'] = true;
                $attachment['filename'] = $object->value;
            }
        }
    }

    if($part->ifparameters) {
        foreach($part->parameters as $object) {
            $attachment[strtolower($object->attribute)]=$object->value;
            if(strtolower($object->attribute) == 'name') {
                $attachment['is_attachment'] = true;
                $attachment['name'] = $object->value;
            }
        }
    }

    $attachment['data'] = imap_fetchbody($connection, $message_number, $prefix);
    if($part->encoding == 3) { // 3 = BASE64
        $attachment['data'] = base64_decode($attachment['data']);
    }
    elseif($part->encoding == 4) { // 4 = QUOTED-PRINTABLE
        $attachment['data'] = quoted_printable_decode($attachment['data']);
    }
    return($attachment);
}
