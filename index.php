<?php
$_use_routes = true;
require_once dirname(__FILE__) . '/config.php';



if(date('d.m.Y') == "15.03.2019" && date('H') == 15 && intval(date('i')) >= 0 && intval(date('i')) < 15){
    if($_page != "autostrazi"){
        go_away(route('autostrazi'));
    }
}




// include backend
$include = $_backend_path . $_page_file;

if(is_file($include)) {
    include $include;
}

// include frontend
$include = $_theme_path . 'index.php';
if(is_file($include)) {
    include $include;
}

// Close the conn
$_db->close();
