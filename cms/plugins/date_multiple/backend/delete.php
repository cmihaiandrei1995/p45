<?php

if(isset($_id) && $_id > 0){
	$to_table = str_replace('#table#', $_section['table'], $field['use_other_table']);
	foreach($field['lng'] as $lng){
		if(count($field['lng']) > 1){
			db_query('DELETE FROM '.$to_table.' WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
		}else{
			db_query('DELETE FROM '.$to_table.' WHERE `'.$_section['id'].'` = ?', $_id);
		}
	}
}