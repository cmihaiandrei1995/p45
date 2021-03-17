<?php
$_use_routes = false;
$_is_ajax = true;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/../settings.php';

// do nothing :) just keep session alive.

// Close the conn
$_db->close();
