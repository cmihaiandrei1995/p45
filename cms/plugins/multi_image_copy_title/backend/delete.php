<?php

$field['use_other_table'] = str_replace("#table#", $_section['table'], $field['use_other_table']);

if(isset($_id) && $_id > 0){
	foreach($field['lng'] as $lng){
		$_record[$lng][$field['use_other_table']] = db_query('SELECT * FROM '.$_section['table'].'_img WHERE '.$_section['id'].' = ?', $_id);
		foreach($_record[$lng][$field['use_other_table']] as $val){
			$images[$lng][$val['order']]['folder'] = $val['folder'];
			$images[$lng][$val['order']]['image'] = $val['image'];
			$images[$lng][$val['order']]['id'] = $val['id_image'];
		}
		
		for($j=1; $j<=$field['nr']; $j++){
			if($images[$lng][$j]['image']!="") {
				db_query('DELETE FROM '.$_section['table'].'_img WHERE id_image = ?', $images[$lng][$j]['id']);
			    
				$img_path = $_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$images[$lng][$j]['image'];
				if(file_exists($img_path)) {
					unlink($img_path);
				}
				foreach($field['sizes'] as $key => $field_val) {
					$img_path = $_base_uploads_path.'images/'.$images[$lng][$j]['folder'].$key.'-'.$images[$lng][$j]['image'];
					if(file_exists($img_path)) {
						unlink($img_path);
					}
				}
			}
		}
	}
}