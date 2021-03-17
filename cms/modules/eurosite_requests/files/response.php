<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$row = db_row('SELECT * FROM eurosite_request WHERE id_eurosite_request = ?', intval($_GET['id']));

header('Content-Type: application/xml');
echo gzinflate($row['response']);



// Close the conn
$_db->close();