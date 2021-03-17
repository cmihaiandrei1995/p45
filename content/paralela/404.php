<?
// redirecting old links
$_current_link = $_SERVER['SCRIPT_URI'] . ($_SERVER['QUERY_STRING'] != '' ? '?' . $_SERVER['QUERY_STRING'] : '');
$_link_to_redirect = "/".str_replace($_base, "", $_current_link);

$db_link = db_row('SELECT * FROM redirect WHERE old = ?', $_link_to_redirect);
if($db_link){
	go_away($_base.substr($db_link['new'], 1), '301');
}

// redirect links ending in "undefined"
$tmp_link = explode("/", $_SERVER['SCRIPT_URI']);
if($tmp_link[count($tmp_link) - 1] == "undefined"){
	$tmp_link[count($tmp_link) - 1] = "";
	$_current_link = implode("/", $tmp_link).($_SERVER['QUERY_STRING'] != '' ? '?' . $_SERVER['QUERY_STRING'] : '');
	
	go_away($_current_link, '301');
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?=$_lang?>" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="<?=$_lang?>" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="<?=$_lang?>" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?=$_lang?>" class="no-js"><!--<![endif]-->
<head>
<?php
    // Meta
    $_meta_title = __('Eroare 404');
	
    $include = $_theme_path . 'section/meta.php';
    include $include;
?>
</head>
<body>
<?php
    // Header
	$include = $_theme_path . 'section/header.php';
    if(!$_do_not_include_header) {
        include $include;
    }
?>
	<div class="text-center">
		<br><br><br><br><br><br>
	    <h1><?=e('Eroare 404')?></h1>
	    <p>
	    	<?=e('Pagina pe care o cautati nu exista sau a fost mutata. Ne cerem scuze!')?>
	    </p>
	    <br><br><br><br><br><br><br><br><br>
    </div>
<?php 	
	// Footer
	$include = $_theme_path . 'section/footer.php';
    if(!$_do_not_include_footer) {
        include $include;
    }

	// JS scripts
	$include = $_theme_path . 'section/js.php';
    include $include;
?>
</body>
</html>