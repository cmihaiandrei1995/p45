<?php

//get normal records count
$view_count = db_row('
	SELECT COUNT(1) AS nr_recs 
	FROM '.$_section['table'].' '.
	'WHERE 1 '.$_section['extra_where'].' '.
		($_section['use_drafts'] ? 'AND '.$_section['table'].'.draft = 0 ' : '').
		($_section['use_trash'] ? 'AND '.$_section['table'].'.trash = 0 ' : '')
);

//get trash count
if($_section['use_drafts']){
	$drafts_count = db_row('
		SELECT COUNT(1) AS nr_recs 
		FROM '.$_section['table'].' '.
		'WHERE 1 '.$_section['extra_where'].' '.
			'AND '.$_section['table'].'.draft = 1 '.
			($_section['use_trash'] ? 'AND '.$_section['table'].'.trash = 0 ' : '')
	);
}

//get trash count
if($_section['use_trash']){
	$trash_count = db_row('
		SELECT COUNT(1) AS nr_recs 
		FROM '.$_section['table'].' '.
		'WHERE 1 '.$_section['extra_where'].' '.
			($_section['use_drafts'] ? 'AND '.$_section['table'].'.draft = 0 ' : '').
			'AND '.$_section['table'].'.trash = 1 '
	);
}