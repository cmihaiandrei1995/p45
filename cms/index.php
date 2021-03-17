<?php
$_use_routes = false;
$_is_cms = true;
require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/settings.php';

// Include backend
$backend = $_base_path_cms . 'backend/' . $_page . '.php';
if(is_file($backend)){
	require_once $backend;
}

// Start output
include $_base_path_cms . 'content/section/meta.php';

// Include content
$content = include $_base_path_cms . 'content/' . $_page . '.php';
if(is_file($content)){
	include $content;
}

// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();