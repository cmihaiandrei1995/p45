<?php
if(!$field['do_not_edit']){
	if(isset($_POST['submit']) && $_valid){
		foreach($field['lng'] as $lng){
			if(count($field['lng']) > 1){
				$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
				
				if($_fld_rec[$_section['id'].'_lng'] != ""){
					foreach(array('x', 'y', 'z') as $k){
						$_update = 'UPDATE '.$_section['table'].'_lng SET 
							`'.$field['db_name'].'_'.$k.'` = ?
							WHERE `'.$_section['id'].'_lng` = '.$_fld_rec[$_section['id'].'_lng'];
						db_query($_update, $_form[$field['id'].'_'.$k.'_'.$lng]);
					}
				}else{
					foreach(array('x', 'y', 'z') as $k){
						$_update = 'INSERT INTO '.$_section['table'].'_lng SET 
							`lng` = "'.$lng.'",
							`'.$field['db_name'].'_'.$k.'` = ?,
							`'.$_section['id'].'` = ?';
						db_query($_update, $_form[$field['id'].'_'.$k.'_'.$lng], $_id);
					}
				}
			}else{
				foreach(array('x', 'y', 'z') as $k){
					$_update = 'UPDATE '.$_section['table'].' SET 
						`'.$field['db_name'].'_'.$k.'` = ?
						WHERE `'.$_section['id'].'` = ?';
					db_query($_update, $_form[$field['id'].'_'.$k.'_'.$lng], $_id);
				}
			}
		}
	}
}