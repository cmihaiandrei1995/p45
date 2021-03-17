<?
db_query('DELETE FROM cruise_itinerary WHERE '.$_section['id'].' = ?', intval($_REQUEST['id']));
db_query('DELETE FROM cruise_date WHERE '.$_section['id'].' = ?', intval($_REQUEST['id']));
db_query('DELETE FROM cruise_room WHERE '.$_section['id'].' = ?', intval($_REQUEST['id']));
?>