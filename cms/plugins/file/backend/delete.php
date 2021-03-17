<?php

$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);

if(isset($_id) && $_id > 0){
	foreach($field['lng'] as $lng){
		$_record[$lng][$field['use_other_table']] = db_query('SELECT * FROM '.$_section['table'].'_file WHERE '.$_section['id'].' = ?', $_id);
		foreach($_record[$lng][$field['use_other_table']] as $val){
			$files[$lng][$val['order']]['folder'] = $val['folder'];
			$files[$lng][$val['order']]['file'] = $val['file'];
			$files[$lng][$val['order']]['id'] = $val['id_file'];
		}
		
		for($j=1; $j<=$field['nr']; $j++){
			if($files[$lng][$j]['file']!="") {
				db_query('DELETE FROM '.$_section['table'].'_file WHERE id_file = ?', $files[$lng][$j]['id']);
			    
				$file_path = $_base_uploads_path.'files/'.$files[$lng][$j]['folder'].$files[$lng][$j]['file'];
				if(file_exists($file_path)) {
					unlink($file_path);
				}
			}
		}
	}
}