<?php
if(isset($_POST['submit']) && $_valid){
	$_update = 'UPDATE '.$_section['table'].' SET `order` = "'.$_form['order'].'" WHERE '.$_section['id'].' = ?';
	db_query($_update, $_id);
}