<?

function google_recaptcha_check($value){
	global $_config;
	
	$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$_config['captcha']['secret_key'].'&response='.$value);
	$responseData = json_decode($verifyResponse);
    return $responseData->success;
	
	return true;
}


function wrap_wysiwyg_text($text){
	if($text == strip_tags($text)){
		return "<p>".nl2br(stripslashes($text))."</p>";
	}else{
		return stripslashes($text);
	}
}


function grab_image($url, $saveto){
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw = curl_exec($ch);
	
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	if($httpCode == 200) {
	    curl_close ($ch);
	    if(file_exists($saveto)){
	        unlink($saveto);
	    }
	    $fp = fopen($saveto, 'x');
	    fwrite($fp, $raw);
	    fclose($fp);
		return 1;
	}else{
		return 0;
	}
}