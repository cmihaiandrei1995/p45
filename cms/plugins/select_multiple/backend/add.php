<?php

if(isset($_POST['submit']) && $_valid){
	foreach($field['lng'] as $lng){
		if(count($field['lng']) > 1){
			$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
			
			if($_fld_rec[$_section['id'].'_lng'] != ""){
				$_update = 'UPDATE '.$_section['table'].'_lng SET 
					`'.$field['db_name'].'` = ?
					WHERE `'.$_section['id'].'_lng` = '.$_fld_rec[$_section['id'].'_lng'];
			}else{
				$_update = 'INSERT INTO '.$_section['table'].'_lng SET 
					`lng` = "'.$lng.'",
					`'.$field['db_name'].'` = ?,
					`'.$_section['id'].'` = ?';
			}
		}else{
			$_update = 'UPDATE '.$_section['table'].' SET 
				`'.$field['db_name'].'` = ?
				WHERE `'.$_section['id'].'` = ?';
		}
		
		$recs = $_form[$field['id'].'_'.$lng];
		
		db_query($_update, implode(",", $recs), $_id);
	}
}