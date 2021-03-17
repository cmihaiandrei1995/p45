<?
/**
 * Form validation class.
 *
 */

class Validate extends ArrayObject {
	//The source for the values ($_GET or $_POST).
	private $src = array();

	//Values (after callback functions are applied).
	private $values = array();

	//Validation rule strings.
	private $rules = array();

	//Error message strings per field.
	private $errors = array();

	//Possible error messages for each rule. These come from the language file.
	private $error_messages = array();

	//Array of custom error messages for each combination of field + rule. These come as a parameter. Structure:
	// [
	// 	$field1 => [
	// 		$rule1 => $message,
	// 		...
	// 	],
	// 	...
	// ]
	private $custom_error_messages = array();

	//Field names.
	private $names = array();

	//Array containing true/false for each field.
	private $valid = array();

	//Whole form "validness".
	private $is_valid = null;

	//Temporary value. Will replace the %value% wildcard in error messages. It is rewritten after every use of check_value(), so make sure you use it.
	public static $error_value = '';

	//Temporary static value. It is used to see what rule has the field failed
	public static $error_rule = '';

	//Temporary static value. It is used by check_value to store the processed value.
	public static $value = '';

	//List of allowed rules. @todo explanations
	private static $allowed_rules = array(
		'required',
		'numeric',
		'alphanumeric',
		'letters',
		'int',
		'float',
		'date',
		'datemultiple',
		'min',
		'max',
		'in',
		'not',
		'match',
		'equal',
		'regex',
		'minlength',
		'maxlength',
		'email',
		'cnp',
		'url',
		'array',
		'mincount',
		'maxcount',
		'requiredfile',
		'file',
		'uniquedb',
		'uniquedbbyfield'
	);

	//List of allowed callback functions to transform the values.
	private static $allowed_callbacks = array(
		'trim',
		'escape',
		'md5',
		'uppercase',
		'lowercase',
		'titlecase',
		'round',
		'floor',
		'ceil',
		'nl2br',
		'generate_name'
	);

	/**
	 * Split function that checks for escaped tokens.
	 *
	 * @param $token The separator.
	 * @param $string The string.
	 *
	 * @return The array.
	 */
	static function explode($token, $string) {
		$parts = explode($token, $string);
		$return = array();

		foreach($parts as $i => $part) {
			if($part[strlen($part) - 1] == '\\') {
				$parts[$i] = substr($parts[$i], 0, -1).$token;
				$parts[$i] .= $parts[$i + 1];
				unset($parts[$i + 1]);
			}
		}

		foreach($parts as $part) $return[] = $part;

		return $return;
	}

	/**
	 * Class constructor.
	 *
	 * @param $rules Array of rules, per field.
	 * @param $src Either 'get' or 'post' or 'request'. Default is 'post'.
	 * @param $custom_error_messages Array of custom error messages, per rule + field combination. Optional.
	 */
	function __construct($rules, $src = 'post', $custom_error_messages = null) {
		global $_error_messages;

		if(is_array($src)) $this->src = $src;
		elseif($src == 'post') $this->src = $_POST;
		elseif($src == 'get') $this->src = $_GET;
		elseif($src == 'request') $this->src = $_REQUEST;

		if(!is_array($this->src)) {
			$this->src = array();
		}

		if(!count($this->src)) {
			foreach($rules as $field => $rule) {
				$this->valid[$field] = true;
				$this->names[$field] = $field;
			}
		}

		$this->rules = $rules;
		$this->error_messages = $_error_messages;
		$this->custom_error_messages = $custom_error_messages;

		//extract initial values
		foreach($this->src as $field => $value) {
			$this->values[$field] = $value;
			$this->valid[$field] = true;
			$this->names[$field] = $field;
		}

		//add callbacks to rules
		Validate::$allowed_rules = array_merge(Validate::$allowed_rules, Validate::$allowed_callbacks);
	}

	static function check_value($value, $rule_string, $field = '', $src = array()) {
		//if(!$this) {
			Validate::$allowed_rules = array_merge(Validate::$allowed_rules, Validate::$allowed_callbacks);
		//}

		if(empty($rule_string)) return true;
		foreach(Validate::explode('|', $rule_string) as $rule) {
			$params = Validate::explode('-', $rule);
			//if the first parameter is not a valid keyword
			if(!in_array($params[0], Validate::$allowed_rules)) {return false;}

			//value to be replaced in value-specific error messages
			Validate::$error_value = '';
			Validate::$value = $value;

			$keyword = $params[0];
			unset($params[0]);
			$condition = implode("-", $params);

			Validate::$error_rule = $keyword;
			switch($keyword) {
				// validation rules
				case 'required':
					if(is_array($value) && count($value) == 0){
						return false;
					}elseif(!is_array($value) && !is_numeric($value) && empty($value)){
						return false;
					}elseif(!is_array($value) && ($value == "" || strlen($value) == 0)){
						return false;
					}
				break;
				case 'numeric':
					if(!is_numeric($value) && $value !== '') {
						return false;
					}
				break;
				case 'alphanumeric':
					if(!ctype_alnum(trim(str_replace(' ', '', $value))) && $value !== '') {
						return false;
					}
				break;
				case 'letters':
					if(!ctype_alpha(trim(str_replace(' ', '', $value))) && $value !== '') {
						return false;
					}
				break;
				case 'date':
					if($value != ''){
						$test_date = date("m/d/Y", strtotime($value));
						$test_arr  = explode('/', $test_date);
						if(!checkdate($test_arr[0], $test_arr[1], $test_arr[2]) || $test_date == "01/01/1970") {
							return false;
						}
					}
				break;
				case 'datemultiple':
					if($value != ''){
						$vals = explode(",", $value);
						foreach($vals as $val){
							$test_date = date("m/d/Y", strtotime($val));
							$test_arr  = explode('/', $test_date);
							if(!checkdate($test_arr[0], $test_arr[1], $test_arr[2]) || $test_date == "01/01/1970") {
								return false;
							}
						}
					}
				break;
				case 'int':
					if(!preg_match('/^\d+$/', $value) && $value !== '') {
						return false;
					}
				break;
				case 'float':
					if(!preg_match('/^[0-9]*(\.[0-9]+)?$/', $value) && $value !== '') {
						return false;
					}
				break;
				case 'min':
					if($value < $condition && $value !== '') {
						Validate::$error_value = $condition;
						return false;
					}
				break;
				case 'max':
					if($value > $condition && $value !== '') {
						Validate::$error_value = $condition;
						return false;
					}
				break;
				case 'minlength':
					if(strlen($value) < $condition && $value !== '') {
						Validate::$error_value = $condition;
						return false;
					}
				break;
				case 'maxlength':
					if(strlen($value) > $condition && $value !== '') {
						Validate::$error_value = $condition;
						return false;
					}
				break;
				case 'email':
					//if(preg_match('/^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$/', $value) == 0 && $value !== '') {
					if(!filter_var($value, FILTER_VALIDATE_EMAIL) && $value !== '') {
						return false;
					}
				break;
				case 'cnp':
					if(!validCNP($value) && $value !== '') {
						return false;
					}
				break;
				case 'url':
					if(preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value) == 0 && $value !== '') {
						return false;
					}
				break;
				case 'in':
					foreach($params as $param) {
						if($value == $param) {
							return true;
						}
					}

					if ($value !== '') {
						//reaching this point implies an error.
						Validate::$error_value = implode(', ', $params);
						return false;
					}
				break;
				case 'not':
					foreach($params as $param) {
						if($value == $param) {
							Validate::$error_value = $param;
							return false;
							break;
						}
					}
				break;
				case 'match':
					if($value != $src[$condition]) {
						return false;
					}
				break;
				case 'equal':
					if($value != $params[1]) {
						return false;
					}
				break;
				case 'regex':
					if (preg_match($condition, $value) == 0 && $value !== '') {
						return false;
					}
				break;
				case 'array':
					if(!is_array($value) && $value !== '') {
						return false;
					}
				break;
				case 'mincount':
					if(count($value) < $condition) {
						return false;
					}
				break;
				case 'maxcount':
					if(count($value) > $condition) {
						return false;
					}
				break;
				case 'requiredfile':
					if($_FILES[$field]["size"] == 0) {
						return false;
					}
				break;
				case 'file':
					if($_FILES[$field]['error'] == 0 && $_FILES[$field]["size"] != 0){
						if($condition){
							$found = 0;
							$ext_break = explode(".", $_FILES[$field]["name"]);
							$ext = $ext_break[count($ext_break)-1];
							$allowed_ext = explode(",", $condition);
							foreach($allowed_ext as $cond) {
								if (strtolower($ext) == $cond) {
									$found = 1;
								}
							}
							if($found == 0) {
								return false;
							}
						}
					}
				break;
				case 'uniquedb':
					if($value != ""){
						if($params[4] != ""){
							$row = db_row('SELECT * FROM '.$params[1].' WHERE `'.$params[3].'` = ? AND `'.$params[2].'` != ?', $value, $params[4]);
						}else{
							$row = db_row('SELECT * FROM '.$params[1].' WHERE `'.$params[3].'` = ?', $value);
						}
						if($row[$params[2]] > 0){
							return false;
						}
					}
				break;
				case 'uniquedbbyfield':
					if($value != ""){
						if($params[5] != ""){
							if($params[6] != ""){
								$row = db_row('SELECT * FROM '.$params[1].' WHERE `'.$params[3].'` = ? AND `'.$params[4].'` = ? AND `'.$params[2].'` != ?', $value, $params[5], $params[6]);
							}else{
								$row = db_row('SELECT * FROM '.$params[1].' WHERE `'.$params[3].'` = ? AND `'.$params[4].'` = ?', $value, $params[5]);
							}
							if($row[$params[2]] > 0){
								return false;
							}
						}
					}
				break;


				//callback transformation
				case 'trim':
					if(is_array($value)){
						array_walk_recursive($value, 'trim');
					}else{
						$value = Validate::$value = trim($value);
					}
				break;

				case 'escape':
					if(is_array($value)){
						array_walk_recursive($value, 'addslashes');
					}else{
						$value = Validate::$value = addslashes($value);
					}
				break;

				case 'md5':
					if(is_array($value)){
						array_walk_recursive($value, 'md5');
					}else{
						if($value!=""){
							$value = Validate::$value = md5($value);
						}
					}
				break;

				case 'lowercase':
					if(is_array($value)){
						array_walk_recursive($value, 'strtolower');
					}else{
						$value = Validate::$value = strtolower($value);
					}
				break;

				case 'uppercase':
					if(is_array($value)){
						array_walk_recursive($value, 'strtoupper');
					}else{
						$value = Validate::$value = strtoupper($value);
					}
				break;

				case 'titlecase':
					if(is_array($value)){
						array_walk_recursive($value, 'ucwords');
					}else{
						$value = Validate::$value = ucwords($value);
					}
				break;

				case 'round':
					if(is_array($value)){
						array_walk_recursive($value, 'round');
					}else{
						$value = Validate::$value = round($value);
					}
				break;

				case 'floor':
					if(is_array($value)){
						array_walk_recursive($value, 'floor');
					}else{
						$value = Validate::$value = floor($value);
					}
				break;

				case 'ceil':
					if(is_array($value)){
						array_walk_recursive($value, 'ceil');
					}else{
						$value = Validate::$value = ceil($value);
					}
				break;

				case 'nl2br':
					if(is_array($value)){
						array_walk_recursive($value, 'nl2br');
					}else{
						$value = Validate::$value = nl2br($value);
					}
				break;

				case 'generate_name':
					if(is_array($value)){
						array_walk_recursive($value, 'generate_name');
					}else{
						$value = Validate::$value = generate_name($value);
					}
				break;

			}
		}

		if(Validate::$value == ""){
			Validate::$value = null;
		}

		return true;
	}

	function check() {
		$valid_form = true;
		foreach($this->rules as $field => $rule_string) {

			Validate::$value = false;
			$this->valid[$field] = $this->check_value($this->values[$field], $rule_string, $field, $this->src);
			$this->values[$field] = Validate::$value !== false ? Validate::$value : $this->values[$field];

			if(!$this->valid($field)) $valid_form = false;

			if(!$this->valid($field)) {
				$valid_form = false;

				if (!empty($this->custom_error_messages[$field][Validate::$error_rule])) {
					$this->errors[$field] = str_replace('%value%', Validate::$error_value, $this->custom_error_messages[$field][Validate::$error_rule]);
				} else {
					$this->errors[$field] = str_replace('%value%', Validate::$error_value, $this->error_messages[Validate::$error_rule]);
				}
			}
		}
		$this->is_valid = $valid_form;
		return $valid_form;
	}

	/**
	 * Get value
	 */
	function value($field) {
		return $this->values[$field];
	}

	/**
	 * Array style value retrieval
	 */
	function offsetGet($field) {
		return $this->value($field);
	}

	/**
	 * Sets a certain value to a field. Used to prepopulate forms.
	 */
	function set_value($field, $value, $valid = true) {
		$this->values[$field] = $value;

		if($valid) $this->valid[$field] = true;
	}

	/**
	 * Array style value set.
	 */
	function offsetSet($field, $value) {
		$this->set_value($field, $value);
	}

	function errors() {
		return $this->valid;
	}

	function valid($field = '') {
		if(empty($field)) return $this->is_valid;
		else return $this->valid[$field];
	}

	function name($field) {
		return $this->names[$field];
	}

	function error($field) {
		if(!$this->valid($field)) {
			if(empty($this->errors[$field])) {
				return $this->error_messages['default'];
			} else return $this->errors[$field];
		} else return '';

	}

	function fields() {
		return array_keys($this->rules);
	}

	function values() {
		return $this->values;
	}
}

/**
 * Validate CNP ( valid for 1800-2099 )
 *
 * @param string $p_cnp
 * @return boolean
 */
function validCNP($p_cnp) {

    // CNP must have 13 characters
    if(strlen($p_cnp) != 13) {
        return false;
    }
    $cnp = str_split($p_cnp);
    unset($p_cnp);

    $hashTable = array( 2 , 7 , 9 , 1 , 4 , 6 , 3 , 5 , 8 , 2 , 7 , 9 );
    $hashResult = 0;

    // All characters must be numeric
    for($i=0 ; $i<13 ; $i++) {
        if(!is_numeric($cnp[$i])) {
            return false;
        }
        $cnp[$i] = (int)$cnp[$i];
        if($i < 12) {
            $hashResult += (int)$cnp[$i] * (int)$hashTable[$i];
        }
    }
    unset($hashTable, $i);

    $hashResult = $hashResult % 11;
    if($hashResult == 10) {
        $hashResult = 1;
    }

    // Check Year
    $year = ($cnp[1] * 10) + $cnp[2];
    switch( $cnp[0] ) {
        case 1  : case 2 : { $year += 1900; } break; // cetateni romani nascuti intre 1 ian 1900 si 31 dec 1999
        case 3  : case 4 : { $year += 1800; } break; // cetateni romani nascuti intre 1 ian 1800 si 31 dec 1899
        case 5  : case 6 : { $year += 2000; } break; // cetateni romani nascuti intre 1 ian 2000 si 31 dec 2099
        case 7  : case 8 : case 9 : {                // rezidenti si Cetateni Straini
            $year += 2000;
            if($year > (int)date('Y')-14) {
                $year -= 100;
            }
        } break;
        default : {
            return false;
        } break;
    }

    return ($year > 1800 && $year < 2099 && $cnp[12] == $hashResult);
}

function extractDataFromCNP($p_cnp){
	if(!validCNP($p_cnp)) return false;

	$cnp = str_split($p_cnp);

	for($i=0 ; $i<13 ; $i++) {
        $cnp[$i] = (int)$cnp[$i];
    }

	$year = ($cnp[1] * 10) + $cnp[2];

	switch( $cnp[0] ) {
        case 1  : case 2 : { $year += 1900; } break; // cetateni romani nascuti intre 1 ian 1900 si 31 dec 1999
        case 3  : case 4 : { $year += 1800; } break; // cetateni romani nascuti intre 1 ian 1800 si 31 dec 1899
        case 5  : case 6 : { $year += 2000; } break; // cetateni romani nascuti intre 1 ian 2000 si 31 dec 2099
        case 7  : case 8 : case 9 : {                // rezidenti si Cetateni Straini
            $year += 2000;
            if($year > (int)date('Y')-14) {
                $year -= 100;
            }
        } break;
    }

	$day = $cnp[5].$cnp[6];
	$month = $cnp[3].$cnp[4];
	$county = $cnp[7].$cnp[8];

	$dob = $year.'-'.$month.'-'.$day;

	$datetime1 = new DateTime('now');
	$datetime2 = new DateTime($dob);
	$interval = $datetime1->diff($datetime2);
	$age = $interval->format('%Y');

	switch( $cnp[0] ) {
        case 1  : case 3 : case 5 : case 7 : case 9 : { $gender = 'm'; } break;
        case 2  : case 4 : case 6 : case 8 : { $gender = 'f'; } break;
    }

	return array(
		'gender' => $gender,
		'day' => $day,
		'month' => $month,
		'year' => $year,
		'dob' => $dob,
		'age' => $age,
		'county' => $county
	);
}
