<?
if(!$field['do_not_edit']){
	if(isset($_POST['submit']) && $_valid){
		foreach($field['lng'] as $lng){
			$ids = explode(',', $_POST[$field['id'].'_'.$lng.'_order']);
			
			foreach($ids as $k => $id){
				$_update = 'UPDATE '.$_section['table'].'_img SET
								`'.$_section['id'].'` = ?,
								`order` = ?,
								`active` = 1
								WHERE `id_image` = ?';
				db_query($_update, $_id, ($k+1), $id);
			}
		}
	}
}