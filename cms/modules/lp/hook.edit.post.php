<?
$item = db_row('SELECT * FROM lp WHERE id_lp = ?', $_id);
if($item['slug'] == "") db_query('UPDATE lp SET slug = ? WHERE id_lp = ?', generate_name($item['title']), $_id);
