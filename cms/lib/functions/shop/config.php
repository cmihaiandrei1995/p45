<?

// Register config key
function shop_register_config_key($key, $value = ""){
	if(db_table_exists('shop_config')){
		$check = db_row('SELECT * FROM shop_config WHERE `key` = ?', $key);
		if(!$check){
			db_query('INSERT INTO shop_config SET `key` = ?, `value` = ?', $key, $value);
		}
	}
}

// Update a config key 
function shop_update_config_key($key, $value = ""){
	if(db_table_exists('shop_config')){
		db_query('UPDATE shop_config SET `value` = ? WHERE `key` = ?', $value, $key);
	}
}

// Get config key
function shop_get_config_key($key){
	if(db_table_exists('shop_config')){
		$check = db_row('SELECT * FROM shop_config WHERE `key` = ?', $key);
		if($check){
			return $check['value'];
		}
		return false;
	}
}