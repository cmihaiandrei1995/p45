<?php
if($_action == "edit" && $field['do_not_edit']){
	foreach($field['lng'] as $lng){
		$_rules[$field['id'].'_'.$lng] = 'trim';
	}
}else{
	foreach($field['lng'] as $lng){
		$_rules[$field['id'].'_'.$lng] = 'trim';

		if($field['required']){
			$_rules[$field['id'].'_'.$lng] .= '|required';
		}
		if($field['validation_rules']){
			$_rules[$field['id'].'_'.$lng] .= '|'.$field['validation_rules'];
		}
	}

	if($field['unique_in_db']){
		if($_action == "add"){
			foreach($field['lng'] as $lng){
				if($field['unique_by_field'] != ""){
					$_rules[$field['id'].'_'.$lng] .= '|uniquedbbyfield-'.$_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'-'.$_section['id'].'-'.$field['db_name'].'-'.$field['unique_by_field'].'-'.$_POST[$field['unique_by_field'].'_'.(count($_section['fields'][$field['unique_by_field']]['lng']) > 1 ? $lng : $_section['fields'][$field['unique_by_field']]['lng'][0])];
				}else{
					$_rules[$field['id'].'_'.$lng] .= '|uniquedb-'.$_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'-'.$_section['id'].'-'.$field['db_name'];
				}
			}
		}

		if($_action == "edit"){
			foreach($field['lng'] as $lng){
				if($field['unique_by_field'] != ""){
					$_rules[$field['id'].'_'.$lng] .= '|uniquedbbyfield-'.$_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'-'.$_section['id'].'-'.$field['db_name'].'-'.$field['unique_by_field'].'-'.$_POST[$field['unique_by_field'].'_'.(count($_section['fields'][$field['unique_by_field']]['lng']) > 1 ? $lng : $_section['fields'][$field['unique_by_field']]['lng'][0])].'-'.$_id;
				}else{
					$_rules[$field['id'].'_'.$lng] .= '|uniquedb-'.$_section['table'].(count($field['lng']) > 1 ? '_lng' : '').'-'.$_section['id'].'-'.$field['db_name'].'-'.$_id;
				}
			}
		}
	}
}

if(isset($field['show_if'])) {
	$si_rules = $field['show_if'];
	if(!empty($si_rules['id']) && !empty($si_rules)) {
	    $si_rules = array( $si_rules );
	}
	foreach($si_rules as $i => $rule){
		if(!empty($rule['id']) && !empty($rule)) {
		    $si_rules[$i] = array( $rule );
		}
	}

	foreach($field['lng'] as $lng){
		$show = false;
		$show_arr = array();
		$subshow_arr = array();
		
		foreach($si_rules as $i => $item) {
			$show_arr[$i] = true;
			foreach($item as $k => $subitem) {
				$subshow_arr[$i][$k] = true;
				switch($subitem['cmp']) {
				    case 'IN':
						if(!in_array($_POST[$subitem['id'].'_'.$lng], (array)$subitem['value'])) {
							$subshow_arr[$i][$k] = false;
						}
						break;
				    case 'NOT IN':
				    case 'NOTIN':
					    if(in_array($_POST[$subitem['id'].'_'.$lng], (array)$subitem['value'])) {
				            $subshow_arr[$i][$k] = false;
				        }
				        break;
				    default:
					    $subshow_arr[$i][$k] = version_compare($_POST[$subitem['id'].'_'.$lng], $subitem['value'], $subitem['cmp']);
				        break;
				}
			}
			foreach($subshow_arr[$i] as $arr){
				$show_arr[$i] = $show_arr[$i] && $arr;
			}
		}

		foreach($show_arr as $arr){
			$show = $show || $arr;
		}
		if(!$show) {
			$_rules[$field['id'].'_'.$lng] = 'trim';
			$_POST[$field['id'].'_'.$lng] = '';
		}
	}
}
