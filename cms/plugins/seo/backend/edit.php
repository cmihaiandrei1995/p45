<?php
if(isset($_POST['submit']) && $_valid){
	if($_multiple_lang){
		foreach($_website_langs as $lng => $lng_name){
			$_fld_rec = db_row('SELECT * FROM '.$_section['table'].'_lng WHERE `lng` = "'.$lng.'" AND `'.$_section['id'].'` = ?', $_id);
		
			if($_fld_rec[$_section['id'].'_lng'] != ""){
				$_update = 'UPDATE '.$_section['table'].'_lng SET 
					`seo_title` = ?, 
					`seo_keywords` = ?, 
					`seo_description` = ?
					WHERE `'.$_section['id'].'_lng` = '.$_fld_rec[$_section['id'].'_lng'].' AND `'.$_section['id'].'` = ?';
			}else{
				$_update = 'INSERT INTO '.$_section['table'].'_lng SET 
					`lng` = "'.$lng.'",
					`seo_title` = ?, 
					`seo_keywords` = ?, 
					`seo_description` = ?,
					`'.$_section['id'].'` = ?';
			}
			db_query($_update, ucfirst($_form['seo_title'.'_'.$lng]), strtolower($_form['seo_keywords'.'_'.$lng]), ucfirst($_form['seo_description'.'_'.$lng]), $_id);
		}
	}else{
		$lng = array_keys($_website_langs);
		$_update = 'UPDATE '.$_section['table'].' SET 
			`seo_title` = ?, 
			`seo_keywords` = ?, 
			`seo_description` = ?
			WHERE `'.$_section['id'].'` = ?';
		db_query($_update, ucfirst($_form['seo_title'.'_'.$lng[0]]), strtolower($_form['seo_keywords'.'_'.$lng[0]]), ucfirst($_form['seo_description'.'_'.$lng[0]]), $_id);
	}
}