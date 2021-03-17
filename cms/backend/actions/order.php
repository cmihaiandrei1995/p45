<?php

$_subtitle = _lng('order_records');

// variables
$_multiple_lang = false;
$_sql_fields = array();

// Loading field plugins
foreach($_section['fields'] as $key => $field){
	// Setting globals and variables (dumping the whole field config array)
	$config = array(
		'globals' => array(
			'_rules', '_form', '_multiple_lang', '_website_langs',
		),
		'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action)
	);

	// Constructing the plugin
	$plugin = new Plugin($_section['fields'][$key]['type'], $config);
	if(!empty($plugin)) $_fields[$key] = $plugin;

	if($_fields[$key]->hasWidget('data')){
		$_fields[$key]->widget('data', 'backend');
	}

	$field_settings = $_fields[$key]->getViewSettings();
	if($field_settings['is_filtrable']){
		foreach($_fields[$key]->values as $value){
			$_section['fields'][$key]['values'][$value[$field['from_id']]] = $value[$field['from_field']];
		}
	}

	// check for multiple languages
	if(count($_section['fields'][$key]['lng']) > 1){
		$_multiple_lang = true;
	}
}

// reset other language for records in case this section has no multiple languages
if(!$_multiple_lang){
	$lng_keys = array_keys($_website_langs);
	$_SESSION[$_site_title]['cms']['lang_rec'] = $lng_keys[0];
	$_lang_cms_rec = $_SESSION[$_site_title]['cms']['lang_rec'];
}

// start preparing fields
$_sql_fields[] = $_section['table'].'.'.$_section['id'];

if($_section['use_active']){
	$_sql_fields[] = $_section['table'].'.active';
}
if($_section['use_order']){
	$_sql_fields[] = $_section['table'].'.order';
}

// check for the first field in view array that has text
if($_section['order']){
	foreach ($_section['order'] as $k => $field){
		if($_section['fields'][$field]['db_name'] != "" && ($_section['fields'][$field]['type'] == "text" || $_section['fields'][$field]['type'] == "select_db")){
			$_order_fields[] = $_section['fields'][$field]['db_name'];
		}
	}
}else{
	foreach ($_section['view'] as $k => $field){
		if($_section['fields'][$field]['db_name'] != "" && $_section['fields'][$field]['type'] == "text"){
			$_order_field = $_section['fields'][$field]['db_name'];
			break;
		}
	}
}

// take out the name of the fields and table joins
foreach ($_section['view'] as $k => $field){
	if($_section['fields'][$field]['from_table'] != ""){

		$table_to_join = $_section['fields'][$field]['from_table'].($_section['fields'][$field]['from_multilang'] ? '_lng' : '');

		// field for view
		$_sql_fields[] = $table_to_join.$k.'.'.$_section['fields'][$field]['from_field'].' AS `'.$field.'`';

		// original value
		$_sql_fields[] = $_section['table'].'.'.$_section['fields'][$field]['db_name'].' AS `record_'.$field.'`';

		$id_to_join = $_section['fields'][$field]['from_id'];

		$query_join .= ' LEFT JOIN '.$table_to_join.' AS '.$table_to_join.$k.' ON '.$_section['table'].'.'.$_section['fields'][$field]['db_name'].' = '.$table_to_join.$k.'.'.$id_to_join.' ';

		if($_section['fields'][$field]['from_multilang']){
			$where_join .= ' AND '.$table_to_join.$k.'.lng = "'.$_lang_cms_rec.'"';
		}

	}else{

		if($_section['fields'][$field]['db_name'] != ""){
			$_sql_fields[] = $_section['table'].(count($_section['fields'][$field]['lng']) > 1 ? '_lng' : '').'.'.$_section['fields'][$field]['db_name'];
		}

	}
}

// sorting
$query_order = 'ORDER BY '.$_section['table'].'.order ASC, '.$_section['table'].'.'.$_section['id'].' DESC ';

// searching
$query_search = ' ';
if(count($_SESSION[$_site_title]['cms']['search_order'][$_module])) {
	foreach($_SESSION[$_site_title]['cms']['search_order'][$_module] as $field => $search){
		if(is_numeric($search)){
			$query_search .= ' AND '.$field.' = "'.$search.'" ';
		}else{
			$query_search .= ' AND '.$field.' LIKE "%'.$search.'%" ';
		}
		$tmp = explode('.', $field);
		$fld = $tmp[count($tmp)-1];
		if(!in_array($field, $_sql_fields) && !in_array($fld, $_sql_fields) && !in_array($fld, $_section['view']) && !in_array($field, $_section['view'])){
			$_section['view'][] = $fld;
			$_sql_fields[] = $field;
		}
	}
}

// filtering
$query_filter = ' ';
if(count($_SESSION[$_site_title]['cms']['filter_order'][$_module])) {
	foreach($_SESSION[$_site_title]['cms']['filter_order'][$_module] as $field => $filter){
		$query_filter .= ' AND '.$field.' = "'.$filter.'" ';

		$tmp = explode('.', $field);
		$fld = $tmp[count($tmp)-1];
		if(!in_array($field, $_sql_fields) && !in_array($fld, $_sql_fields) && !in_array($fld, $_section['view']) && !in_array($field, $_section['view'])){
			$_section['view'][] = $fld;
			$_sql_fields[] = $field;
		}
	}
}

// look for extra where
if($_section['extra_where'] != ""){
	$extra_where = " ".$_section['extra_where']." ";
}

// format record with parents if needed
if($_section['use_parent_for_view'] && !$_SESSION[$_site_title]['cms']['filter_order'][$_module][$_section['table'].".".$_section['use_parent_for_view_field']]){
	$extra_where .= " AND ".$_section['table'].".".$_section['use_parent_for_view_field']." = 0";
}

// get the records
$records = db_query('
	SELECT '.implode(', ', $_sql_fields).'
	FROM '.$_section['table'].' '.
		($_multiple_lang ? ' JOIN '.$_section['table'].'_lng USING ('.$_section['id'].')' : '').' '.
		$query_join.' '.
	'WHERE 1 '.
		$query_search.
		$query_filter.
		$where_join.
		$extra_where.
		($_multiple_lang ? ' AND '.$_section['table'].'_lng.lng = "'.$_lang_cms_rec.'"' : '').' '.
		($_section['use_drafts'] ? ' AND '.$_section['table'].'.draft = 0 ' : '').
		($_section['use_trash'] ? ' AND '.$_section['table'].'.trash = 0 ' : '').
	$query_order
);

if(isset($_POST['submit'])){

	$box2values = explode(',', $_POST['box2ViewValues']);
	foreach($box2values as $k => $val){
		if($val!=""){
			$ord = $k + 1;
			db_query('UPDATE '.$_section['table'].' SET `order` = "'.$ord.'" WHERE '.$_section['id'].' = '.$val);
		}
	}

	$box1values = explode(',', $_POST['box1ViewValues']);
	foreach($box1values as $k => $val){
		if($val!=""){
			$ord = count($box2values) + $k + 1;
			db_query('UPDATE '.$_section['table'].' SET `order` = "'.$ord.'" WHERE '.$_section['id'].' = '.$val);
		}
	}

	// log action
	admin_log_action($_module, 'order');

	// redirect after success
	go_away($_base_cms . '?module=' . $_module . '&action=order&ordered=1');

}
