<?
global $_record, $_todo_allow_update;
if($_form['allow_update_ro'] == 1 && $_record['row']['allow_update'] == 1){
	$_todo_allow_update = true;	
}
