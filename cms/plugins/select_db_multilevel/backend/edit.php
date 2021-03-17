<?php

if(!$field['do_not_edit']){
	if(isset($_POST['submit']) && $_valid){
		
		foreach($field['lng'] as $lng){
			$vals = explode("_", $_form[$field['id'].'_'.$lng]);
		
			$flds = array();
			foreach($field['from_db'] as $f => $from_db){
				if($from_db['use_db']){
					$flds[] = '`'.$from_db['id'].'` = '.$vals[$f];
				}
			}
			
			if(count($field['lng']) > 1){
				$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
				
				if($_fld_rec[$_section['id'].'_lng'] != ""){
					$_update = 'UPDATE '.$_section['table'].'_lng SET 
						'.implode(',', $flds).'
						WHERE `'.$_section['id'].'_lng` = '.$_fld_rec[$_section['id'].'_lng'];
				}else{
					$_update = 'INSERT INTO '.$_section['table'].'_lng SET 
						`lng` = "'.$lng.'",
						'.implode(',', $flds).',
						`'.$_section['id'].'` = ?';
				}
			}else{
				$_update = 'UPDATE '.$_section['table'].' SET 
					'.implode(',', $flds).'
					WHERE `'.$_section['id'].'` = ?';
			}
			db_query($_update, $_id);
		}
	}
}