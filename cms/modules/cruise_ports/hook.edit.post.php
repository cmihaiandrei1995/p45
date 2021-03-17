<?
global $_todo_allow_update;
if($_todo_allow_update){
	db_query('UPDATE '.$_section['table'].' SET allow_update = 0 WHERE '.$_section['id'].' = ?', $_id);
}
