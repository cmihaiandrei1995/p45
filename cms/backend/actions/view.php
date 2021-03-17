<?php

if($_GET['trash'] == 1 && $_section['use_trash']){
	$_subtitle = _lng('view_trash');
	$icon = "trash";
}elseif($_GET['drafts'] == 1 && $_section['use_drafts']){
	$_subtitle = _lng('view_drafts');
	$icon = "pencil";
}else{
	$_subtitle = _lng('view_records');
	$icon = "list";
}

// variables
$_multiple_lang = false;
$_sql_fields = array();

// current link hash - page, trash, draft, etc...
$_add_link = "";
if(isset($_GET['pg'])){
	$_add_link .= "&pg=".intval($_GET['pg']);
}

// Loading field plugins
foreach($_section['fields'] as $key => $field){
	// Setting globals and variables (dumping the whole field config array)
	$config = array(
		'globals' => array(
			'_rules', '_form', '_multiple_lang', '_website_langs', 'record'
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
if($_section['use_trash']){
	$_sql_fields[] = $_section['table'].'.trash';
}
if($_section['use_drafts']){
	$_sql_fields[] = $_section['table'].'.draft';
}
if($_section['use_order']){
	$_sql_fields[] = $_section['table'].'.order';
}

// check for drafts
$_drafts = 0;
if(isset($_GET['drafts'])){
	$_drafts = 1;
	$_add_link .= "&drafts=1";
}

//check for trash
$_trash = 0;
if(isset($_GET['trash'])){
	$_trash = 1;
	$_add_link .= "&trash=1";
}

// override view fields if any of them are set in the session
if(count($_SESSION[$_site_title]['cms']['view_fields'][$_module])){
	$_section['view'] = $_SESSION[$_site_title]['cms']['view_fields'][$_module];
}

// sorting
$query_order = 'ORDER BY ';
if(count($_SESSION[$_site_title]['cms']['sort'][$_module])) {
	foreach($_SESSION[$_site_title]['cms']['sort'][$_module] as $sort => $how){
		$tmp_sort = explode('.', $sort);
		if(in_array($sort[1], $_section['view'])){
			$query_order .= $_section['table'].'.'.$sort[1].' '.$how.',';
		}else{
			$query_order .= $sort.' '.$how.',';
		}
	}
	$query_order = substr($query_order, 0, -1).' ';
}else{
	if($_section['use_order']){
		$query_order .= '`order` ASC, '.$_section['table'].'.'.$_section['id'].' DESC ';
	}else{
		$query_order .= $_section['table'].'.'.$_section['id'].' DESC ';
	}
}

// searching
$query_search = ' ';
if(count($_SESSION[$_site_title]['cms']['search'][$_module])) {
	foreach($_SESSION[$_site_title]['cms']['search'][$_module] as $field => $search){
		if(is_numeric($search)){
			$query_search .= ' AND '.$field.' = "'.$search.'" ';
		}else{
			$query_search .= ' AND ( '.$field.' LIKE "%'.$search.'%" ';
			
			if(count($_SESSION[$_site_title]['cms']['sort'][$_module]) == 0) {
				$query_order = 'ORDER BY (CASE WHEN '.$field.' = "'.$search.'" THEN 0
					               WHEN '.$field.' like "'.$search.'%" THEN 1
					               WHEN '.$field.' like "% %'.$search.'% %" THEN 2
					               WHEN '.$field.' like "%'.$search.'" THEN 3
					               ELSE 4
					          	END) ';
			}
			
			$tmp = explode(' ', $search);
			if(count($tmp) > 1){
				foreach($tmp as $t){
					$query_search .= ' OR '.$field.' LIKE "%'.$t.'%" ';
					
					if(count($_SESSION[$_site_title]['cms']['sort'][$_module]) == 0) {
						$query_order .= ', (CASE WHEN '.$field.' = "'.$t.'" THEN 0
							               WHEN '.$field.' like "'.$t.'%" THEN 1
							               WHEN '.$field.' like "% %'.$t.'% %" THEN 2
							               WHEN '.$field.' like "%'.$t.'" THEN 3
							               ELSE 4
							          	END) ';
					}
				}
			}
			$query_search .= ' ) ';
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
if(count($_SESSION[$_site_title]['cms']['filter'][$_module])) {
	foreach($_SESSION[$_site_title]['cms']['filter'][$_module] as $field => $filter){
		$query_filter .= ' AND '.$field.' = "'.$filter.'" ';
		
		$tmp = explode('.', $field);
		$fld = $tmp[count($tmp)-1];
		if(!in_array($field, $_sql_fields) && !in_array($fld, $_sql_fields) && !in_array($fld, $_section['view']) && !in_array($field, $_section['view'])){
			$_section['view'][] = $fld;
			$_sql_fields[] = $field;
		}
	}
}

$query_fields = array();

// take out the name of the fields and table joins
foreach($_section['view'] as $k => $field){
	$query_fields[] = $field;
}

// add preview needed fields
if($_section['preview']){
	foreach($_section['preview']['params'] as $param){
		if(!in_array($param, $_section['view'])){
			$query_fields[] = $param;
		}
	}
}

// add to queries
foreach($query_fields as $k => $field){
	if($_section['fields'][$field]['from_table'] != ""){
		
		$table_to_join = $_section['fields'][$field]['from_table'].($_section['fields'][$field]['from_multilang'] ? '_lng' : '');
		
		// field for view
		$_sql_fields[] = $table_to_join.$k.'.'.$_section['fields'][$field]['from_field'].' AS `'.$field.'`';
		
		// original value 
		$_sql_fields[] = $_section['table'].'.'.$_section['fields'][$field]['db_name'].' AS `record_'.$field.'`';
		
		$id_to_join = $_section['fields'][$field]['from_id'];
		
		$query_join .= ' LEFT JOIN '.$table_to_join.' AS '.$table_to_join.$k.' ON '.$_section['table'].'.'.$_section['fields'][$field]['db_name'].' = '.$table_to_join.$k.'.'.$id_to_join.' ';
		
		if($_section['fields'][$field]['from_multilang']){
			$where_join .= ' AND ('.$table_to_join.$k.'.lng = "'.$_lang_cms_rec.'" OR '.$table_to_join.$k.'.lng IS NULL)';
		}
		
	}else{
		
		if($_section['fields'][$field]['db_name'] != ""){
			$_sql_fields[] = $_section['table'].(count($_section['fields'][$field]['lng']) > 1 ? '_lng' : '').'.'.$_section['fields'][$field]['db_name'];
		}
		
	}
}

// look for extra where
if($_section['extra_where'] != ""){
	$extra_where = " ".$_section['extra_where']." ";
}

// get the total numer of records
$records_count = db_row('
	SELECT COUNT(1) AS nr_recs 
	FROM '.$_section['table'].' '.
		($_multiple_lang ? ' JOIN '.$_section['table'].'_lng USING ('.$_section['id'].')' : '').' '.
		$query_join.' '.
	'WHERE 1 '.
		$query_search.
		$query_filter.
		$where_join.
		$extra_where.
		($_multiple_lang ? ' AND '.$_section['table'].'_lng.lng = "'.$_lang_cms_rec.'"' : '').' '.
		($_section['use_drafts'] ? ' AND '.$_section['table'].'.draft = '.$_drafts.' ' : '').
		($_section['use_trash'] ? ' AND '.$_section['table'].'.trash = '.$_trash : '').' '
);
$nr_pages = ceil($records_count['nr_recs']/$_ipp);

// correct pagination if needed
if(intval($_GET['pg']) > $nr_pages){
	go_away(str_replace("&pg=".$_GET['pg'], "", $_SESSION[$_site_title]['cms']['current_page']) . '&pg='.$nr_pages);
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
		($_section['use_drafts'] ? ' AND '.$_section['table'].'.draft = '.$_drafts.' ' : '').
		($_section['use_trash'] ? ' AND '.$_section['table'].'.trash = '.$_trash.' ' : '').
	$query_order.
	($_section['do_not_use_pagination'] ? "" : 'LIMIT '.$_start.', '.$_ipp)
);

// format record with parents if needed
if($_section['use_parent_for_view']){
	$new_records = format_records_for_view_with_parents($records, 0);
	$records = $new_records;
}
