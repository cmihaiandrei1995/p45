<?php
if(isset($_POST['submit']) && $_valid){
	$_update = 'UPDATE '.$_section['table'].' SET `active` = ? WHERE '.$_section['id'].' = ? ';
	db_query($_update, $_form['active'], $_id);
}