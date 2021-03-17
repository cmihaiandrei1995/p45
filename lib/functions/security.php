<?
/**
 * General security functions
 */

function crlf_detect($input){
	
	$cr = '/\%0d/i';
	$lf = '/\%0a/i';
	
	 if (is_array($input)) {
        foreach($input as $var => $val) {
            crlf_detect($val);
        }
    } else {
    	$input = urlencode($input);
		
        $cr_check = preg_match($cr, $input);
		$lf_check = preg_match($lf, $input);
		
		if ($cr_check > 0 || $lf_check > 0){
		    echo 'CRLF detected';
			exit;
		}
    }
}
 
 
function cleanInput($input) {
 	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);
 
    $output = preg_replace($search, '', $input);
    return $output;
}

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    } else {
        $output  = cleanInput($input);
    }
    return $output;
}
//$_GET = sanitize($_GET);

function is_logged_in_cms(){
	global $_site_title;
	
	if($_SESSION[$_site_title]['cms']['id_admin_user'] > 0){
		return true;
	}else{
		return false;
	}
}