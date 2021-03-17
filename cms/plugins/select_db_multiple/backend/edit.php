<?php

if(!$field['do_not_edit']){
	if(isset($_POST['submit']) && $_valid){
		$to_table = str_replace('#table#', $_section['table'], $field['use_other_table']);
		foreach($field['lng'] as $lng){
			if($field['use_ajax']){
				$recs = explode(',', $_form[$field['id'].'_'.$lng]);
			}else{
				$recs = $_form[$field['id'].'_'.$lng];
			}
			//unset($recs[0]);
			
			if(count($field['lng']) > 1){
				db_query('DELETE FROM '.$to_table.' WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
				
				foreach($recs as $val){
					if($val != 0){
						$_insert = 'INSERT INTO '.$to_table.' SET 
							`lng` = "'.$lng.'",
							`'.$field['db_name'].'` = ?,
							`'.$_section['id'].'` = ?';
						db_query($_insert, $val, $_id);
					}
				}
			}else{
				db_query('DELETE FROM '.$to_table.' WHERE `'.$_section['id'].'` = ?', $_id);
				
				foreach($recs as $val){
					if($val != 0){
						$_insert = 'INSERT INTO '.$to_table.' SET 
							`'.$field['db_name'].'` = ?,
							`'.$_section['id'].'` = ?';
						db_query($_insert, $val, $_id);
					}
				}
			}
		}
	}
}