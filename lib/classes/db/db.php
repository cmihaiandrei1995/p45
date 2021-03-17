<?
/**
 * Database connection class
 *
 */


class DB {
    //the actual connection
    public $conn;

    //remeber the last id
    private $last_id = false;

    /**
     * Class constructor. Establishes the connections and selects the Database.
     *
     * @param $dbhost MySQL server
     * @param $dbuser MySQL username
     * @param $dbpassword MySQL password
     * @param $dbname MySQL database name
     * @param $dbencoding MySQL encoding for tables
     * @param $dbcollation MySQL collations for tables
     *
     * @throws Exception on connection errors.
     */
    function __construct($dbhost, $dbuser, $dbpassword, $dbname, $dbencoding = "utf8", $dbcollation = "utf8_general_ci") {

        global $config;

        // Connect to an ODBC database using driver invocation
        $dsn = 'mysql:dbname='.$dbname.';host='.$dbhost;

        try {
            $this->conn = new PDO($dsn, $dbuser, $dbpassword, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
            $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
        } catch (PDOException $e) {
            if(debug_mode()){
                die('Connection error: ' . $e->getMessage());
            }else{
                exit;
            }
        }

        if($dbencoding!=""){
            $this->conn->query("SET NAMES ".$dbencoding);
            $this->conn->query("SET CHARACTER SET ".$dbencoding);
        }
        if($dbcollation!=""){
            $this->conn->query("SET COLLATION_CONNECTION='".$dbcollation."'");
        }
    }

    /**
     * Returns an array with the query results.
     * The array follows this pattern: array(0 => <row>, 1=> <row>, etc.)
     *
     * @param $query The query
     * @param $debug If set to true, the function prints out the query, for debugging purposes. Default is false.
     *
     * @return The results array.
     *
     * @throws Exception on MySQL error.
     */
    function array_results($query, $args = array(), $debug = false) {
        try {
            $processed_query = $this->process($query, $args);
            if($processed_query) {
                $query = $processed_query;
            }

            $rows = $this->conn->prepare($query);
            $rows->execute($args);

            $results = array();
            while ($row = $rows->fetch(PDO::FETCH_ASSOC)){
                $results[] = $row;
            }

            $rows->closeCursor();
            $rows = null;

            return $results;
        } catch (PDOException $e) {
            $err = $e->getMessage();

            if(!empty($err)){
                if($debug) {
                    ld_db($err, $query."\nArgs: ".implode(" | ", $args));
                    exit;
                }else{
                    //die('SQL error: '.$err);
                    exit;
                }
            }
        }
    }

    /**
     * Returns an array with the query results.
     * The array follows this pattern: array(0 => <row>, 1=> <row>, etc.)
     *
     * @param $query The query
     * @param $debug If set to true, the function prints out the query, for debugging purposes. Default is false.
     *
     * @return The results array.
     *
     * @throws Exception on MySQL error.
     */
    function indexed_results($query, $args = array(), $debug = false) {
        try {
            $processed_query = $this->process($query, $args);
            if($processed_query) {
                $query = $processed_query;
            }

            $rows = $this->conn->prepare($query);
            $rows->execute($args);

            $results = array();
            while ($row = $rows->fetch(PDO::FETCH_NUM)){
                $results[] = $row;
            }

            $rows->closeCursor();
            $rows = null;

            return $results;
        } catch (PDOException $e) {
            $err = $e->getMessage();

            if(!empty($err)){
                if($debug) {
                    ld_db($err, $query."\nArgs: ".implode(" | ", $args));
                    exit;
                }else{
                    //die('SQL error: '.$err);
                    exit;
                }
            }
        }
    }

    /**
     * Returns an associative array with the first row in the query results.
     *
     * @param $query The query
     * @param $debug If set to true, the function prints out the query, for debugging purposes. Default is false.
     *
     * @return The first row in the results.
     *
     * @throws Exception on MySQL error.
     */
    function single_row($query, $args = array(), $debug = false) {
        try {
            $processed_query = $this->process($query, $args);
            if($processed_query) {
                $query = $processed_query;
            }

            $rows = $this->conn->prepare($query);
            $rows->execute($args);
            $row = $rows->fetch(PDO::FETCH_ASSOC);

            $rows->closeCursor();
            $rows = null;

            return $row;
        } catch (PDOException $e) {
            $err = $e->getMessage();

            if(!empty($err)){
                if($debug) {
                    ld_db($err, $query."\nArgs: ".implode(" | ", $args));
                    exit;
                }else{
                    //die('SQL error: '.$err);
                    exit;
                }
            }
        }
    }

    /**
     * Returns an associative array with the first row in the query results.
     *
     * @param $query The query
     * @param $debug If set to true, the function prints out the query, for debugging purposes. Default is false.
     *
     * @return The first row in the results.
     *
     * @throws Exception on MySQL error.
     */
    function field($query, $args = array(), $debug = false) {
        try {
            $processed_query = $this->process($query, $args);
            if($processed_query) {
                $query = $processed_query;
            }

            $rows = $this->conn->prepare($query);
            $rows->execute($args);
            $row = $rows->fetchColumn();

            $rows->closeCursor();
            $rows = null;

            return $row;
        } catch (PDOException $e) {
            $err = $e->getMessage();

            if(!empty($err)){
                if($debug) {
                    ld_db($err, $query."\nArgs: ".implode(" | ", $args));
                    exit;
                }else{
                    //die('SQL error: '.$err);
                    exit;
                }
            }
        }
    }

    /**
     * Executes a pseudo-query (INSERT / UPDATE / DELETE / etc).
     *
     * @param $query The query
     * @param $debug If set to true, the function prints out the query, for debugging purposes. Default is false.
     *
     * @return The number of affected rows, if applicable.
     *
     * @throws Exception on MySQL error.
     */
    function execute($query, $args = array(), $debug = false) {
        try {
            $processed_query = $this->process($query, $args);
            if($processed_query) {
                $affected_rows = $this->conn->exec($processed_query);
            } else {
                $result = $this->conn->prepare($query);
                $result->execute($args);
                $affected_rows = $result->rowCount();

                $result->closeCursor();
                $result = null;
            }

            return $affected_rows;
        } catch (PDOException $e) {
            $err = $e->getMessage();

            if(!empty($err)){
                if($debug) {
                    ld_db($err, $query."\nArgs: ".implode(" | ", $args));
                    exit;
                }else{
                    //die('SQL error: '.$err);
                    exit;
                }
            }
        }
    }

    /**
     * Parse query and replace placeholders with data
     *
     * @param  string $query unparsed query
     * @param  array  $data  data for placeholders
     * @return string parsed query
     */
    function process($pattern, $data = array(), $replace = true) {

        if (!empty($data) && preg_match_all("/\?(i|s|l|d|a|n|u|e|m|p|w|f)+/", $pattern, $m)) {
            $offset = 0;
            foreach ($m[0] as $k => $ph) {
                if ($ph == '?u' || $ph == '?e') {

                    $table_pattern = '\?\:';
                    if (preg_match("/^(UPDATE|INSERT INTO|REPLACE INTO|DELETE FROM) " . $table_pattern . "(\w+) /", $pattern, $m)) {
                        $data[$k] = $this->checkTableFields($data[$k], $m[2]);

                        if (empty($data[$k])) {
                            return false;
                        }
                    }
                }

                if ($ph == '?i') { // integer
                
                    $pattern = $this->_strReplace($ph, $this->_intVal($data[$k]), $pattern, $offset); // Trick to convert int's and longint's

                } elseif ($ph == '?s') { // string

                    $pattern = $this->_strReplace($ph, $this->conn->quote($data[$k]), $pattern, $offset);

                } elseif ($ph == '?l') { // string for LIKE operator
                
                    $pattern = $this->_strReplace($ph, $this->conn->quote(str_replace("\\", "\\\\", $data[$k])), $pattern, $offset);

                } elseif ($ph == '?d') { // float
                
                    $pattern = $this->_strReplace($ph, sprintf('%01.2f', $data[$k]), $pattern, $offset);

                } elseif ($ph == '?a') { // array FIXME: add trim
                
                    $data[$k] = !is_array($data[$k]) ? array($data[$k]) : $data[$k];
                    if (!empty($data[$k])) {
                        $pattern = $this->_strReplace($ph, implode(', ', $this->_filterData($data[$k], true)), $pattern, $offset);
                    } else {
                        $pattern = $this->_strReplace($ph, 'NULL', $pattern, $offset);
                    }

                } elseif ($ph == '?n') { // array of integer FIXME: add trim
                
                    $data[$k] = !is_array($data[$k]) ? array($data[$k]) : $data[$k];
                    $pattern = $this->_strReplace($ph, !empty($data[$k]) ? implode(', ', array_map(array('self', '_intVal'), $data[$k])) : "''", $pattern, $offset);

                } elseif ($ph == '?u' || $ph == '?w') { // update/condition with and
                
                    $clue = ($ph == '?u') ? ', ' : ' AND ';
                    $q = implode($clue, $this->_filterData($data[$k], false));
                    $pattern = $this->_strReplace($ph, $q, $pattern, $offset);

                } elseif ($ph == '?e') { // insert
                
                    $filtered = $this->_filterData($data[$k], true);
                    $pattern = $this->_strReplace($ph, "(" . implode(', ', array_keys($filtered)) . ") VALUES (" . implode(', ', array_values($filtered)) . ")", $pattern, $offset);

                } elseif ($ph == '?m') { // insert multi
                
                    $values = array();
                    foreach ($data[$k] as $value) {
                        $filtered = $this->_filterData($value, true);
                        $values[] = "(" . implode(', ', array_values($filtered)) . ")";
                    }
                    $pattern = $this->_strReplace($ph, "(" . implode(', ', array_keys($filtered)) . ") VALUES " . implode(', ', $values), $pattern, $offset);

                } elseif ($ph == '?f') { // field/table/database name
                
                    $pattern = $this->_strReplace($ph, $this->_field($data[$k]), $pattern, $offset);

                }
            }

            return $pattern;
        }
    }

    /**
     * Get column names from table
     *
     * @param  string $table_name table name
     * @param  array  $exclude    optional array with fields to exclude from result
     * @param  bool   $wrap_quote optional parameter, if true, the fields will be enclosed in quotation marks
     * @return array  columns array
     */
    public function getTableFields($table_name, $exclude = array(), $wrap = false) {

        $fields = $this->getColumn("SHOW COLUMNS FROM ?:$table_name");
        if (!$fields) {
            return false;
        }

        if ($exclude) {
            $fields = array_diff($fields, $exclude);
        }

        if ($wrap) {
            foreach ($fields as &$v) {
                $v = "`$v`";
            }
        }

        return $fields;
    }

    /**
     * Check if passed data corresponds columns in table and remove unnecessary data
     *
     * @param  array $data       data for compare
     * @param  array $table_name table name
     * @return mixed array with filtered data or false if fails
     */
    public function checkTableFields($data, $table_name) {
        $_fields = $this->getTableFields($table_name);
        if (is_array($_fields)) {
            foreach ($data as $k => $v) {
                if (!in_array($k, $_fields)) {
                    unset($data[$k]);
                }
            }
            if (func_num_args() > 3) {
                for ($i = 3; $i < func_num_args(); $i++) {
                    unset($data[func_get_arg($i)]);
                }
            }

            return $data;
        }

        return false;
    }

    /**
     * Placeholder replace helper
     *
     * @param  string $needle      string to replace
     * @param  string $replacement replacement
     * @param  string $subject     string to search for replace
     * @param  int    $offset      offset to search from
     * @return string with replaced fragment
     */
    private function _strReplace($needle, $replacement, $subject, &$offset) {
        $pos = strpos($subject, $needle, $offset);
        $offset = $pos + strlen($replacement);

        // substr_replace does not work properly with mb_* and UTF8 encoded strings.
        //$return = substr_replace($subject, $replacement, $pos, 2);
        $return = substr($subject, 0, $pos) . $replacement . substr($subject, $pos + 2);

        return $return;
    }

    /**
     * Convert variable to int/longint type
     *
     * @param  mixed $int variable to convert
     * @return mixed int/intval variable
     */
    private function _intVal($int) {
        return $int + 0;
    }

    /**
     * Check if variable is valid database table name, table field or database name
     *
     * @param  string $field field to check
     * @return mixed  passed variable if valid, empty string otherwise
     */
    private function _field($field) {
        if (preg_match("/([\w]+)/", $field, $m) && $m[0] == $field) {
            return $field;
        }

        return '';
    }

    /**
     * Filters data to form correct SQL string
     * @param  array $data      key-value array of fields and values to filter
     * @param  bool  $key_value return result as key-value array if set true or as array of field-value pairs if set to false
     * @return array filtered data
     */
    private function _filterData($data, $key_value) {
        $filtered = array();
        foreach ($data as $field => $value) {
            if (is_int($value) || is_float($value)) {
                //ok
            } elseif (is_numeric($value) && $value === strval($value + 0)) {
                $value += 0;
            } elseif (is_null($value)) {
                $value = 'NULL';
            } else {
                $value = $this->conn->quote($value);
            }

            if ($key_value == true) {
                $filtered['`' . $this->_field($field) . '`'] = $value;
            } else {
                $filtered[] = '`' . $this->_field($field) . '` = ' . $value;
            }

        }

        return $filtered;
    }

    /**
     * Returns the last inserted id
     *
     * @return Returns the last inserted id
     */
    function last_id() {
        return $this->conn->lastInsertId();
    }

    /**
     * Closes the connection
     */
    function close() {
        $this->conn = null;
    }

}

/**
 * Some db function to return sql types for fields - used in the cms
 */
function db_type($type){
    switch($type){
        case 'varchar':{
            return "varchar(255) ";
        }break;
        case 'text':{
            return "text ";
        }break;
        case 'int':{
            return "int(11) ";
        }break;
        case 'double':{
            return "double ";
        }break;
        case 'float':{
            return "float ";
        }break;
        case 'date':{
            return 'date';
        }break;
        case 'datetime':{
            return 'datetime';
        }break;
    }
}

/**
 * Wrapper function for array_results() and execute()
 */
function db_query(){
    global $_db, $_config;

    if (func_num_args() < 1){
        return false;
    }else{
        $query = func_get_arg(0);
        $args = array_slice(func_get_args(), 1);

        if(debug_mode()) $debug = true;

        if(preg_match("/^\\s*(delete|update|replace|create|alter) /i", $query)) {
            return $_db->execute($query, $args, $debug);
        }elseif(preg_match("/^\\s*(insert) /i", $query)) {
            $_db->execute($query, $args, $debug);
            return $_db->last_id();
        }elseif(preg_match("/^\\s*(drop|truncate) /i", $query)) {
            $_db->execute($query, $args, $debug);
            return true;
        }else{
            $_rows = $_db->array_results($query, $args, $debug);
            return $_rows;
        }
    }
}

/**
 * Wrapper function for single_row()
 */
function db_row(){
    global $_db, $_config;

    if (func_num_args() < 1){
        return false;
    }else{
        $query = func_get_arg(0);
        $args = array_slice(func_get_args(), 1);

        if(debug_mode()) $debug = true;

        $_row = $_db->single_row($query, $args, $debug);
        return $_row;
    }
}

/**
 * Return first field of results
 */
function db_field(){
    global $_db, $_config;

    if (func_num_args() < 1){
        return false;
    }else{
        $query = func_get_arg(0);
        $args = array_slice(func_get_args(), 1);

        if(debug_mode()) $debug = true;

        $_row = $_db->field($query, $args, $debug);
        return $_row;
    }
}

/**
 * Return first column of results
 */
function db_col(){
    global $_db, $_config;

    if (func_num_args() < 1){
        return false;
    }else{
        $query = func_get_arg(0);
        $args = array_slice(func_get_args(), 1);

        if(debug_mode()) $debug = true;

        $_rows = $_db->indexed_results($query, $args, $debug);
        if($_rows) foreach($_rows as $key => $value) {
            $_results[$key] = $value[0];
        }
        return $_results;
    }
}

function db_config($key, $table = 'meta'){
    return db_field("SELECT {$table}_value FROM `{$table}` WHERE `{$table}_key` = ?", $key);
}

function db_is_active($concat = '', $table = '', $cms_section = '') {
    global $_is_cms, $_section, $_base_path_cms, $_config;

    if($cms_section == ""){
        foreach($_config['cms'] as $key => $val){
            if($val['table'] == $table){
                $cms_section = $key;
                break;
            }
        }
    }

    $_section = $_config['cms'][$cms_section];

    $return = ' ';
    if($_section){
        if($_section['use_active']){
            $sections[] = ($table ? $table.'.' : '').'active = 1 ';
        }
        if($_section['use_trash']){
            $sections[] = ($table ? $table.'.' : '').'trash = 0 ';
        }
        if($_section['use_drafts']){
            $sections[] = ($table ? $table.'.' : '').'draft = 0 ';
        }
        $return = implode(' AND ', $sections);
    }else{
        //$return .= ($table ? $table.'.' : '').'active = 1 AND '.($table ? $table.'.' : '').'trash = 0 AND '.($table ? $table.'.' : '').'draft = 0 ';
        if(in_array('active', $_config['db_tables'][$table])){
            $return .= ($table ? $table.'.' : '').'active = 1 ';
        }else{
            $return .= " 1 ";
        }
    }
	
	if(isset($_GET['preview']) && is_logged_in_cms()){
		if(trim($concat) != ""){
			$return = " ".$concat." ";
		}else{
			$return = " 1 ";
		}
	}else{
		$return .= $concat;
	}

    return $return;
}

function db_is_trash($concat = '', $table = '') {
    return ' '.($table ? $table.'.' : '').'trash = 1 ' . $concat;
}

function db_is_draft($concat = '', $table = '') {
    return ' '.($table ? $table.'.' : '').'draft = 1 ' . $concat;
}

function db_table_exists($table_name){
    $tables = db_query('SHOW TABLES LIKE "'.$table_name.'"');
    if(count($tables) == 1) {
        return true;
    }
    return false;
}

function backup_db() {
	global $_config;
	
	// get all of the tables
	$tables = array();
	$tbls = db_query('SHOW TABLES');
	foreach($tbls as $table){
		$tables[] = $table['Tables_in_'.$_config['db']['database']];
	}

    $return = '';
	
	// cycle through
	foreach($tables as $table) {
		$result = db_query('SELECT * FROM '.$table);
		
		$return .= "DROP TABLE IF EXISTS ".$table.";";
		$create_table = db_row('SHOW CREATE TABLE '.$table);
		$return.= "\n\n".$create_table['Create Table'].";\n\n";
		
		foreach($result as $row){
			$return.= 'INSERT INTO '.$table.' VALUES (';
			$k = 0;
			foreach($row as $key => $val){
				$val = addslashes($val);
				$val = str_replace("\n","\\n", $val);
				if (isset($val)) { $return.= '"'.$val.'"' ; } else { $return.= '""'; }
				if ($k < (count($row)-1)) { $return.= ','; }
				$k++;
			}
			$return .= ");\n";
		}
		
		$return .= "\n\n\n";
	}
	
	// save file
	
	$dirname = $_config['server']['uploads_path']."backups/";
	if(!is_dir($dirname)){
		mkdir($dirname, 0755, true);
	}
	
	$handle = fopen($dirname.'db-backup-'.date('d.m.Y-H.i.s').'.sql', 'w+');
	fwrite($handle, $return);
	fclose($handle);
}