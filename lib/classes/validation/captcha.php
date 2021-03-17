<?
/**
 * Captcha image generator class
 *
 * @usage
 * <img src="http://.../lib/classes/validation/captcha.php?id=login&rnd=<?=mt_rand(10,100)?>&width=100&height=37&characters=6&bg=f6f6f6&text=4a4a4a&noise=cccccc" />
 * security code avalable in - $_SESSION[$_site_title]['CAPTCHAString']['login']
 *
 */

// general website config
$_use_routes = false;
require_once dirname(__FILE__) . '/../../../config.php';

class CaptchaSecurityImages {

	var $font = 'font/monofont.ttf';

	function generateCode($characters) {
		// list all possible characters, similar looking characters and vowels have been removed
		$possible = '23456789bcdfghjkmnpqrstvwxyzABCEFGHKLMNPRQSTVWXYZ';
		$code = '';
		$i = 0;
		while ($i < $characters) {
        	$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
        	$i++;
		}
		return $code;
	}

	function hex2RGB($color){
	    $color = str_replace('#', '', $color);
	    if (strlen($color) != 6){ return array(0,0,0); }
	    $rgb = array();
	    for ($x=0;$x<3;$x++){
	        $rgb[$x] = hexdec(substr(strtoupper($color),(2*$x),2));
	    }
	    return $rgb;
	}

	function __construct($width='120', $height='40', $characters='6', $bg_color, $text_color, $noise_color, $cid) {
		global $_site_title;

		$code = $this->generateCode($characters);

		// font size will be 75% of the image height
		$font_size = $height * 0.6 * mt_rand(80, 100) / 100;
		$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');

		// set the colors
		$bg = $this->hex2RGB($bg_color, true);
		$txt = $this->hex2RGB($text_color);
		$noise = $this->hex2RGB($noise_color);

		$backgroundColor = imagecolorallocate($image, $bg[0], $bg[1], $bg[2]);
		$textColor = imagecolorallocate($image, $txt[0], $txt[1], $txt[2]);
		$noiseColor = imagecolorallocate($image, $noise[0], $noise[1], $noise[2]);

		// generate random dots in background
		for( $i=0; $i<($width*$height)/10; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noiseColor);
		}

		// generate random lines in background
		for( $i=0; $i<($width*$height)/500; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noiseColor);
		}

		// create textbox and add text
		$textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2 + mt_rand(-10,10);
		$y = ($height - $textbox[5])/2 + mt_rand(-5,5);
		$angle = mt_rand(-5,5);
		imagettftext($image, $font_size, $angle, $x, $y, $textColor, $this->font, $code) or die('Error in imagettftext function');

		$_SESSION[$_site_title]['CAPTCHAString'][$cid] = strtolower($code);

		// output captcha image to browser
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	}
}

$width = isset($_GET['width']) && $_GET['width'] < 600 ? $_GET['width'] : '95';
$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '30';
$characters = isset($_GET['characters']) && $_GET['characters'] > 2 ? $_GET['characters'] : '6';

$bg_color = isset($_GET['bg']) ? $_GET['bg'] : 'fff';
$text_color = isset($_GET['text']) ? $_GET['text'] : '000';
$noise_color = isset($_GET['noise']) ? $_GET['noise'] : 'aaa';

$cid = isset($_GET['id']) ? $_GET['id'] : '0';

$captcha = new CaptchaSecurityImages($width, $height, $characters, $bg_color, $text_color, $noise_color, $cid);
