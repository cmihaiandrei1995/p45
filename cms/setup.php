<?php
/**
 * Sets up the database, or checks and repairs tables
 */

$_use_routes = false;
$_is_cms = true;
$_do_not_use_restrict = true;
$_page = "setup";

require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/settings.php';

if(!$do_update){
	// Start output
	include $_base_path_cms . 'content/section/meta.php';
}

// get mysql version
$mysql_version_row = db_row("SELECT version()");
$tmp_version = explode(".", $mysql_version_row['version()']);
$mysql_version = $tmp_version[0].".".$tmp_version[1];

// send data info to prologue
$url_api = 'http://cms.prologue.ro/api/api.php';
$fields_api = array(
	'name' => urlencode($_config['site']['name']),
	'domain' => urlencode($_config['site']['domain']),
	'path' => urlencode($_config['site']['path']),
	'version' => urlencode($_version),
	'action' => 'setup'
);
foreach($fields_api as $key => $value) { $fields_api_string .= $key.'='.$value.'&'; }
rtrim($fields_api_string, '&');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url_api);
curl_setopt($ch, CURLOPT_POST, count($fields_api));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_api_string);
$result = curl_exec($ch);
curl_close($ch);

// get a list of all current tables
$_tables = array();
$tables = db_query('SHOW TABLES');
foreach($tables as $table){
	$_tables[] = $table['Tables_in_'.$_config['db']['database']];
}

show_table_log_header();

if(!isset($_SESSION[$_site_title]['cms']['id_admin_user']) && in_array('admin_user', $_tables)){
	show_table_log_row('error', 'You have no permission to access this file. You must be logged in the cms in order to use this script.');
	exit;
}

// create maintenance file
$fh = fopen($_base_path.".maintenance", 'w') or die("Can't create file");
show_table_log_row('info', "Enable maintenance mode");

// create a backup
if($_config['setup']['backup']){
	show_table_log_row('info', "Creating backup...");
	backup_db();
}

// browse all sections in the config.php
show_table_log_row('info', "Browsing modules...");

foreach($_sections as $section){
	foreach($section['modules'] as $key => $module){
		$_section = array();

		// check for config file
		$output = "<b>".$module['name']."</b>\n";
		$output .= " - checking for config file... ";
		if(file_exists($_base_path_cms . 'modules/' . $key . '/config.php')) {
			include $_base_path_cms . 'modules/' . $key . '/config.php';
			if(file_exists($_base_path_cms . 'modules/' . $key . '/extra/config.php')) {
				include $_base_path_cms . 'modules/' . $key . '/extra/config.php';
			}
			$output .= "Done\n";
		}else{
			$output .= "<span style='color:red'>Config file missing!</span>\n\n";
			continue;
		}

		if($_section['table']){

			// check for table
			$output .= " - checking for table... ";

			if(in_array($_section['table'], $_tables)){

				$output .= "Table found\n";

				// checking for multiple languages
				$_multiple_lang = false;
				foreach($_section['fields'] as $field){
					if(count($field['lng']) > 1){
						$_multiple_lang = true;
					}
				}

				// check for multiple languages tables to create
				$output .= " - checking for multiple lang... ";
				if($_multiple_lang){
					$output .= "Multiple languages detected\n";
					$_lng = "_lng";

					if(in_array($_section['table'].'_lng', $_tables)){
						$output .= " - table for multiple languages found\n";
					}else{
						$output .= " - creating table for languages... ";
						$sql = "CREATE TABLE IF NOT EXISTS `".$_section['table']."_lng` (
						  `".$_section['id']."_lng` int(11) NOT NULL AUTO_INCREMENT,
						  `lng` varchar(3) NOT NULL,
						  `".$_section['id']."` int(11) NOT NULL,
						  PRIMARY KEY (`".$_section['id']."_lng`),
						  KEY `".$_section['id']."` (`".$_section['id']."`)
						) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";

						db_query($sql);
						$output .= "Done\n";
					}
				}else{
					$output .= "No multiple languages detected\n";
					$_lng = "";
				}

				// check columns
				$output .= " - checking for new columns... ";
				$columns = db_query('DESCRIBE '.$_section['table']);

				$all_columns = array();
				foreach($columns as $column){
					$all_columns[] = $column['Field'];
				}

				if($_lng != ""){
					$columns = db_query('DESCRIBE '.$_section['table'].$_lng);

					foreach($columns as $column){
						$all_columns[] = $column['Field'];
					}
				}

				// check for general fields
				if($_section['use_active'] && !in_array('active', $all_columns)){
					$sql = "ALTER TABLE `".$_section['table']."` ADD `active` int(11) NOT NULL DEFAULT '1' AFTER `".$_section['id']."`";
					db_query($sql);
				}
				if($_section['use_order'] && !in_array('order', $all_columns)){
					$sql = "ALTER TABLE `".$_section['table']."` ADD `order` int(11) NOT NULL DEFAULT '0' AFTER `".$_section['id']."`";
					db_query($sql);
				}
				if($_section['use_drafts'] && !in_array('draft', $all_columns)){
					$sql = "ALTER TABLE `".$_section['table']."` ADD `draft` int(11) NOT NULL DEFAULT '0' AFTER `".$_section['id']."`";
					db_query($sql);
				}
				if($_section['use_trash'] && !in_array('trash', $all_columns)){
					$sql = "ALTER TABLE `".$_section['table']."` ADD `trash` int(11) NOT NULL DEFAULT '0' AFTER `".$_section['id']."`";
					db_query($sql);
				}

				// check for other fields
				foreach($_section['fields'] as $key => $field){

					if($field['db_name'] == "" && $field['use_other_table'] == "") continue;

					// Setting globals and variables (dumping the whole field config array)
					$config = array(
						'vars' => array('field' => $field, '_section' => $_section)
					);

					// Constructing the plugin
					$plugin = new Plugin($field['type'], $config);

					$sql_array = $plugin->getSql();

					if((!in_array($field['db_name'], $all_columns) && !$field['db_fields']) || ( count($field['db_fields']) > 0 && count(array_intersect($field['db_fields'], $all_columns)) != count($field['db_fields']) ) || $field['use_other_table'] != ""){
						if(count($sql_array)){
							foreach($sql_array as $sql){
								$sql = str_replace("#table#", $_section['table'].(count($field['lng']) > 1 ? $_lng : ''), $sql);
								$sql = str_replace("#field#", $field['db_name'], $sql);
								$sql = str_replace("#id#", $_section['id'], $sql);
								$sql = str_replace("#type#", db_type($field['db_type']), $sql);
								$sql = str_replace("#from_table#", $field['from_table'], $sql);
								$sql = str_replace("#from_id#", $field['from_id'], $sql);
								$sql = str_replace("#table#", $_section['table'], str_replace("#use_other_table#", $field['use_other_table'], $sql));

								if(count($field['lng']) > 1){
									$sql = str_replace("#lng#", '`lng` varchar(3) NOT NULL,', $sql);
								}else{
									$sql = str_replace("#lng#", '', $sql);
								}

								db_query($sql);
							}
						}else{
							$sql = "ALTER TABLE `".$_section['table'].(count($field['lng']) > 1 ? $_lng : '')."` ADD `".$field['db_name']."` ";
							$sql .= db_type($field['db_type']);
							$sql .= " NULL DEFAULT NULL";

							db_query($sql);
						}
					}

					// check for indexes on other tables and add them if needed
					if(strpos($sql_array[0], "#use_other_table#") !== false && strpos($sql_array[0], "#id#") !== false && strpos($sql_array[0], "#from_id#") !== false){
						$indexes = db_query('SHOW INDEX FROM '.str_replace("#table#", $_section['table'], $field['use_other_table']));
						if(count($indexes) == 1){
							db_query("ALTER TABLE `".str_replace("#table#", $_section['table'], $field['use_other_table'])."` ADD KEY `".$field['from_id']."` (`".$field['from_id']."`)");
							db_query("ALTER TABLE `".str_replace("#table#", $_section['table'], $field['use_other_table'])."` ADD KEY `".$_section['id']."_".$field['from_id']."` (`".$_section['id']."`, `".$field['from_id']."`)");
						}
					}

					// check for indexes on integer fields
					if($field['db_type'] == "int" && in_array($field['db_name'], $all_columns)){
						$indexes = db_query('SHOW INDEX FROM '.$_section['table']);

						$found_index = false;
						foreach($indexes as $index){
							if($index['Key_name'] == $field['db_name'] || $index['Column_name'] == $field['db_name']){
								$found_index = true;
							}
						}

						if(!$found_index){
							db_query("ALTER TABLE `".$_section['table']."` ADD KEY `".$field['db_name']."` (`".$field['db_name']."`)");
						}
					}

				}
				$output .= "Done\n";

				$output .= " - checking for seo... ";
				if($_section['use_seo'] && !in_array('seo_title', $all_columns) && !in_array('seo_keywords', $all_columns) && !in_array('seo_description', $all_columns)){
					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_title` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);

					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_keywords` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);

					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_description` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);

					$output .= "Seo fields already in place\n";
				}else{
					$output .= "Seo not needed\n";
				}

				// migrate content
				$columns = db_query('DESCRIBE '.$_section['table']);

				$all_columns = array();
				foreach($columns as $column){
					$all_columns[] = $column['Field'];
				}

				$all_columns_lng = array();
				if(in_array($_section['table'].'_lng', $_tables)){
					$columns_lng = db_query('DESCRIBE '.$_section['table'].'_lng');

					foreach($columns_lng as $column){
						$all_columns_lng[] = $column['Field'];
					}
				}

				$move_to_lng = $move_from_lng = array();
				foreach($_section['fields'] as $key => $field){
					if($field['db_name'] == "" && $field['use_other_table'] == "") continue;

					if(count($field['lng']) > 1){
						if(in_array($field['db_name'], $all_columns)){
							// to be moved then dropped
							$move_to_lng[$key] = $field['db_name'];
						}
					}else{
						if(in_array($field['db_name'], $all_columns_lng)){
							// to be moved then dropped
							$move_from_lng[$key] = $field['db_name'];
						}
					}
				}

				// execute move to lng
				if(count($move_to_lng)){
					if($_section['use_seo']){
						$move_to_lng[] = "seo_title";
						$move_to_lng[] = "seo_keywords";
						$move_to_lng[] = "seo_description";
					}

					$all_rows = db_query("SELECT * FROM `".$_section['table']."` ORDER BY `".$_section['id']."` ASC");

					// move rows
					foreach($all_rows as $row){
						foreach($move_to_lng as $key => $fld){
							foreach($_section['fields'][$key]['lng'] as $lng){
								$row_lng = db_row("SELECT * FROM `".$_section['table']."_lng` WHERE `lng` = ? AND `".$_section['id']."` = ?", $lng, $row[$_section['id']]);
								if(!$row_lng[$_section['id']."_lng"]){
									$sql = "INSERT INTO `".$_section['table']."_lng` (`lng`, `".$_section['id']."`) VALUES (?, ?)";
									db_query($sql, $lng, $row[$_section['id']]);
								}
								$sql = "UPDATE `".$_section['table']."_lng` SET `".$fld."` = ? WHERE `lng` = ? AND `".$_section['id']."` = ?";
								db_query($sql, $row[$fld], $lng, $row[$_section['id']]);
							}
						}
					}

					// drop the column from the original table
					foreach($move_to_lng as $fld){
						$sql = "ALTER TABLE `".$_section['table']."` DROP `".$fld."`";
						db_query($sql);
					}
				}

				// execute move from lng
				if(count($move_from_lng)){
					if($_section['use_seo'] && !$_multiple_lang){
						$move_from_lng[] = "seo_title";
						$move_from_lng[] = "seo_keywords";
						$move_from_lng[] = "seo_description";
					}

					$lng_default = array_keys($_website_langs);
					$all_rows = db_query("SELECT * FROM `".$_section['table']."_lng` WHERE `lng` = '".$lng_default[0]."' ORDER BY `".$_section['id']."` ASC");

					// move rows
					foreach($all_rows as $row){
						foreach($move_from_lng as $fld){
							$sql = "UPDATE `".$_section['table']."` SET `".$fld."` = ? WHERE `".$_section['id']."` = ?";
							db_query($sql, $row[$fld], $row[$_section['id']]);
						}
					}

					if(!$_multiple_lang){
						$sql = "DROP TABLE `".$_section['table']."_lng`";
						db_query($sql);
					}else{
						foreach($move_from_lng as $fld){
							$sql = "ALTER TABLE `".$_section['table']."_lng` DROP `".$fld."`";
							db_query($sql);
						}
					}
				}


			}else{

				$output .= "Not found\n";

				// creating table
				$output .= " - creating table... ";
				$sql = "CREATE TABLE IF NOT EXISTS `".$_section['table']."` (
					`".$_section['id']."` int(11) NOT NULL AUTO_INCREMENT,";

					if($_section['use_active']){
						$sql .= "`active` int(11) NOT NULL DEFAULT '1',";
					}
					if($_section['use_order']){
						$sql .= "`order` int(11) NOT NULL DEFAULT '0',";
					}
					if($_section['use_drafts']){
						$sql .= "`draft` int(11) NOT NULL DEFAULT '0',";
					}
					if($_section['use_trash']){
						$sql .= "`trash` int(11) NOT NULL DEFAULT '0',";
					}

				$sql .= "
					`created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
					`updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
					PRIMARY KEY (`".$_section['id']."`)
				) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";

				db_query($sql);
				$output .= "Done\n";

				// checking for multiple languages
				$_multiple_lang = false;
				foreach($_section['fields'] as $field){
					if(count($field['lng']) > 1){
						$_multiple_lang = true;
					}
				}

				// check for multiple languages tables to create
				$output .= " - checking for multiple lang... ";
				if($_multiple_lang){
					$output .= "Multiple languages detected\n";
					$_lng = "_lng";

					$output .= " - creating table for languages... ";
					$sql = "CREATE TABLE IF NOT EXISTS `".$_section['table']."_lng` (
					  `".$_section['id']."_lng` int(11) NOT NULL AUTO_INCREMENT,
					  `lng` varchar(3) NOT NULL,
					  `".$_section['id']."` int(11) NOT NULL,
					  PRIMARY KEY (`".$_section['id']."_lng`),
					  KEY `".$_section['id']."` (`".$_section['id']."`)
					) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";

					db_query($sql);
					$output .= "Done\n";
				}else{
					$output .= "No multiple languages detected\n";
					$_lng = "";
				}

				$output .= " - checking for other fields... ";
				foreach($_section['fields'] as $key => $field){

					if($field['db_name'] == "" && $field['use_other_table'] == "") continue;

					// Setting globals and variables (dumping the whole field config array)
					$config = array(
						'vars' => array('field' => $field, '_section' => $_section)
					);

					// Constructing the plugin
					$plugin = new Plugin($field['type'], $config);

					$sql_array = $plugin->getSql();

					if(count($sql_array)){
						foreach($sql_array as $sql){
							$sql = str_replace("#table#", $_section['table'].(count($field['lng']) > 1 ? $_lng : ''), $sql);
							$sql = str_replace("#field#", $field['db_name'], $sql);
							$sql = str_replace("#id#", $_section['id'], $sql);
							$sql = str_replace("#type#", db_type($field['db_type']), $sql);
							$sql = str_replace("#from_table#", $field['from_table'], $sql);
							$sql = str_replace("#from_id#", $field['from_id'], $sql);
							$sql = str_replace("#table#", $_section['table'], str_replace("#use_other_table#", $field['use_other_table'], $sql));

							if(count($field['lng']) > 1){
								$sql = str_replace("#lng#", '`lng` varchar(3) NOT NULL,', $sql);
							}else{
								$sql = str_replace("#lng#", '', $sql);
							}

							db_query($sql);
						}
					}else{
						$sql = "ALTER TABLE `".$_section['table'].(count($field['lng']) > 1 ? $_lng : '')."` ADD `".$field['db_name']."` ";
						$sql .= db_type($field['db_type']);
						$sql .= " NULL DEFAULT NULL";

						db_query($sql);
					}
				}
				$output .= "Done\n";

				$output .= " - checking for seo... ";
				if($_section['use_seo']){
					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_title` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);
					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_keywords` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);
					$sql = "ALTER TABLE `".$_section['table'].$_lng."` ADD `seo_description` VARCHAR(255) NULL DEFAULT NULL";
					db_query($sql);

					$output .= "Seo fields added\n";
				}else{
					$output .= "Seo not needed\n";
				}

				// get all final columns from the table
				$columns = db_query('DESCRIBE '.$_section['table']);

				$all_columns = array();
				foreach($columns as $column){
					$all_columns[] = $column['Field'];
				}

				foreach($_section['fields'] as $key => $field){
					if($field['db_name'] == "" && $field['use_other_table'] == "") continue;

					// check for indexes on integer fields
					if($field['db_type'] == "int" && in_array($field['db_name'], $all_columns)){
						$indexes = db_query('SHOW INDEX FROM '.$_section['table']);

						$found_index = false;
						foreach($indexes as $index){
							if($index['Key_name'] == $field['db_name'] || $index['Column_name'] == $field['db_name']){
								$found_index = true;
							}
						}

						if(!$found_index){
							db_query("ALTER TABLE `".$_section['table']."` ADD KEY `".$field['db_name']."` (`".$field['db_name']."`)");
						}
					}
				}

			}

			$output .= " - finished checking module\n";

		}

		show_table_log_row('debug', nl2br($output));
	}
}



// create extra shop tables
if($_config['site']['is_shop']){

	// create shop_category_filter table if not exists
	if(!db_table_exists('shop_category_filter')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_category_filter` (
		  `id_shop_category_filter` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_category` int(11) NOT NULL,
		  `id_shop_product_attribute` int(11) NOT NULL,
		  PRIMARY KEY (`id_shop_category_filter`),
		  KEY `id_shop_category` (`id_shop_category`),
		  KEY `id_shop_product_attribute` (`id_shop_product_attribute`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8  AUTO_INCREMENT = 1";
		db_query($sql);
	}

	// create shop_product_attribute_value table if not exists
	if(!db_table_exists('shop_product_attribute_value')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_product_attribute_value` (
		  `id_shop_product_attribute_value` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_product_attribute` int(11) NOT NULL,
		  `title` varchar(256) NOT NULL,
		  `color` varchar(256) NULL DEFAULT NULL,
		  `image` varchar(256) NULL DEFAULT NULL,
		  `image_path` varchar(256) NULL DEFAULT NULL,
		  `order` int(11) NULL,
		  PRIMARY KEY (`id_shop_product_attribute_value`),
		  KEY `id_shop_product_attribute` (`id_shop_product_attribute_value`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";
		db_query($sql);
	}

	// create shop_product_to_attribute table if not exists
	if(!db_table_exists('shop_product_to_attribute')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_product_to_attribute` (
		  `id_shop_product_to_attribute` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_product` int(11) NOT NULL,
		  `id_shop_product_attribute` int(11) NOT NULL,
		  `value` varchar(255) DEFAULT NULL,
		  `use_variation` int(11) NOT NULL,
		  PRIMARY KEY (`id_shop_product_to_attribute`),
		  KEY `id_shop_product` (`id_shop_product`),
		  KEY `id_shop_product_attribute` (`id_shop_product_attribute`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";
		db_query($sql);
	}

	// create shop_product_to_attribute table if not exists
	if(!db_table_exists('shop_product_to_attribute_value')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_product_to_attribute_value` (
		  `id_shop_product_to_attribute_value` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_product` int(11) NOT NULL,
		  `id_shop_product_attribute` int(11) NOT NULL,
		  `id_shop_product_attribute_value` int(11) NOT NULL,
		  PRIMARY KEY (`id_shop_product_to_attribute_value`),
		  KEY `id_shop_product` (`id_shop_product`),
		  KEY `id_shop_product_attribute` (`id_shop_product_attribute`),
		  KEY `id_shop_product_attribute_value` (`id_shop_product_attribute_value`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";
		db_query($sql);
	}

	// create shop_product_variation table if not exists
	if(!db_table_exists('shop_product_variation')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_product_variation` (
		  `id_shop_product_variation` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_product` int(11) NOT NULL,
		  `active` int(11) NOT NULL DEFAULT '1',
		  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		  `sku` varchar(255) DEFAULT NULL,
		  `price` double DEFAULT NULL,
		  `price_promo` double DEFAULT NULL,
		  `stock_type` int(11) DEFAULT NULL,
		  `stock_value` double DEFAULT NULL,
		  `stock_show` int(11) DEFAULT NULL,
		  PRIMARY KEY (`id_shop_product_variation`),
		  KEY `id_shop_product` (`id_shop_product`),
		  KEY `sku` (`sku`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";
		db_query($sql);
	}

	// create shop_product_variation table if not exists
	if(!db_table_exists('shop_product_variation_to_attribute')){
		$sql = "CREATE TABLE IF NOT EXISTS `shop_product_variation_to_attribute` (
		  `id_shop_product_variation_to_attribute` int(11) NOT NULL AUTO_INCREMENT,
		  `id_shop_product` int(11) NOT NULL,
		  `id_shop_product_variation` int(11) NOT NULL,
		  `id_shop_product_to_attribute` int(11) NOT NULL
		  PRIMARY KEY (`id_shop_product_variation_to_attribute`),
		  KEY `id_shop_product` (`id_shop_product`),
		  KEY `id_shop_product_variation` (`id_shop_product_variation`),
		  KEY `id_shop_product_to_attribute` (`id_shop_product_to_attribute`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1";
		db_query($sql);
	}

}



// create translations table
$sql = "
	CREATE TABLE IF NOT EXISTS `admin_translation` (
	  `id_admin_translation` INT(11) NOT NULL AUTO_INCREMENT,
	  `created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
	  `updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
	  `title` TEXT NULL DEFAULT NULL,
	  ";

foreach(array_keys($_website_langs) as $lng){
  	$sql .= "`".$lng."` TEXT NULL DEFAULT NULL,";
}

$sql .= "
	  PRIMARY KEY (`id_admin_translation`)
	) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1
";
db_query($sql);


// adding / removing language columns
show_table_log_row('info', "Adding/altering translations table...");
if(in_array('admin_translation', $_tables)){
	$fields = db_query("DESCRIBE admin_translation");
	$lang_fields = array();
	foreach($fields as $fld){
		if(strlen($fld['Field']) == 2){
			$lang_fields[] = $fld['Field'];
		}
	}

	// add fields
	foreach(array_keys($_website_langs) as $lng){
		if(!in_array($lng, $lang_fields)){
			db_query('ALTER TABLE `admin_translation` ADD `'.$lng.'` TEXT NULL DEFAULT NULL');
		}
	}

	//remove fields
	foreach($lang_fields as $lng){
		if(!in_array($lng, array_keys($_website_langs))){
			db_query('ALTER TABLE `admin_translation` DROP `'.$lng.'`');
		}
	}
}

// create admin table
show_table_log_row('info', "Adding/altering admin users table...");
if(!in_array('admin_user', $_tables)){
	$sql = "
		CREATE TABLE IF NOT EXISTS `admin_user` (
		  `id_admin_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
		  `title` varchar(255) NOT NULL,
		  `email` varchar(255) DEFAULT NULL,
		  `id_admin_group` int(11) NOT NULL DEFAULT '1',
		  `username` varchar(255) NOT NULL,
		  `password` varchar(255) NOT NULL,
		  `use_2fa` int(11) NULL DEFAULT NULL,
		  `2fa_secret` varchar(255) NULL DEFAULT NULL,
		  `active` int(11) NOT NULL DEFAULT '1',
		  `created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  `updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  `last_visit` date DEFAULT NULL,
		  `last_ip` varchar(64) DEFAULT NULL,
		  PRIMARY KEY (`id_admin_user`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 2
	";
	db_query($sql);

	// add a user
	$sql = "
		INSERT INTO `admin_user` (`id_admin_user`, `title`, `email`, `id_admin_group`, `username`, `password`, `active`, `created`, `updated`, `last_visit`, `last_ip`) VALUES
		(1, 'Prologue', 'office@prologue.ro', 1, 'prologue', 'e10adc3949ba59abbe56e057f20f883e', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '')
	";
	db_query($sql);

	show_table_log_row('info', "Adding user table...");
}else{
	// adding new fields - since 2.92
	$columns = db_query('DESCRIBE admin_user');

	$all_columns = array();
	foreach($columns as $column){
		$all_columns[] = $column['Field'];
	}

	if(!in_array('use_2fa', $all_columns)){
		db_query("ALTER TABLE `admin_user` ADD `use_2fa` INT(11) NULL DEFAULT NULL AFTER `password`");
	}
	if(!in_array('2fa_secret', $all_columns)){
		db_query("ALTER TABLE `admin_user` ADD `2fa_secret` VARCHAR(255) NULL DEFAULT NULL AFTER `use_2fa`");
	}
}

// create admin groups table
show_table_log_row('info', "Adding/altering admin groups table...");
if(!in_array('admin_group', $_tables)){
	$sql = "
		CREATE TABLE IF NOT EXISTS `admin_group` (
		  `id_admin_group` int(11) NOT NULL AUTO_INCREMENT,
		  `title` varchar(255) NOT NULL,
		  `permission` text,
		  `created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  `updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  PRIMARY KEY (`id_admin_group`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 2
	";
	db_query($sql);

	// add a user
	$sql = "
		INSERT INTO `admin_group` (`id_admin_group`, `title`, `permission`, `created`, `updated`) VALUES
		(1, 'Admin general', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00')
	";
	db_query($sql);

	show_table_log_row('info', "Adding user groups table...");
}

// create admin use login table
show_table_log_row('info', "Adding/altering admin users login table...");
if(!in_array('admin_user_login', $_tables)){
	$sql = "
		CREATE TABLE IF NOT EXISTS `admin_user_login` (
		  `id_admin_user_login` int(11) NOT NULL AUTO_INCREMENT,
		  `id_admin_user` int(11) NOT NULL,
		  `ip` varchar(64) NOT NULL,
		  `session_id` varchar(255) NOT NULL,
		  `timestamp` varchar(64) NOT NULL,
		  PRIMARY KEY (`id_admin_user_login`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8
	";
	db_query($sql);

	show_table_log_row('info', "Adding user login table...");
}else{
	// fix for old cms db, check for primary id on admin_user_login table
	$columns = db_query('DESCRIBE admin_user_login');
	$all_columns = array();
	foreach($columns as $column){
		$all_columns[] = $column['Field'];
	}

	if(!in_array('id_admin_user_login', $all_columns)){
		db_query('ALTER TABLE `admin_user_login` ADD `id_admin_user_login` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
	}
}

// check if admin_config table exists, if not create it.
show_table_log_row('info', "Adding/altering admin config table...");
if(!in_array('admin_config', $_tables)){
	$sql = "
		CREATE TABLE IF NOT EXISTS `admin_config` (
		  `id_admin_config` int(11) NOT NULL AUTO_INCREMENT,
		  `title` varchar(255) NULL DEFAULT NULL,
		  `key` varchar(255) NULL DEFAULT NULL,
		  `value` text NULL DEFAULT NULL,
		  `created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  `updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  PRIMARY KEY (`id_admin_config`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1
	";
	db_query($sql);

	show_table_log_row('info', "Adding config table...");
}


// check if admin_config table exists, if not create it.
show_table_log_row('info', "Adding/altering admin users action log table...");
if(!in_array('admin_action', $_tables)){
	$sql = "
		CREATE TABLE IF NOT EXISTS `admin_action` (
		  `id_admin_action` int(11) NOT NULL AUTO_INCREMENT,
		  `id_admin_user` int(11) NOT NULL,
		  `section` varchar(255) NULL DEFAULT NULL,
		  `action` varchar(255) NULL DEFAULT NULL,
		  `session_id` varchar(255) NULL DEFAULT NULL,
		  `id_what` int(11) NULL DEFAULT NULL,
		  `data` longblob NULL DEFAULT NULL,
		  `created` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  `updated` DATETIME ".($mysql_version >= 5.6 ? "NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP" : "NULL DEFAULT NULL").",
		  PRIMARY KEY (`id_admin_action`)
		) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1
	";
	db_query($sql);

	show_table_log_row('info', "Adding action log table...");
}

// remove maintenance file
if(file_exists($_base_path.".maintenance")){
	unlink($_base_path.".maintenance");
}
show_table_log_row('info', "Disable maintenance mode");

// end log
show_table_log_footer();

// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();
