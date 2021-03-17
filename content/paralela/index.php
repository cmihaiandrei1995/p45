<!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?=$_lang?>" class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="<?=$_lang?>" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="<?=$_lang?>" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="<?=$_lang?>" class="no-js"><!--<![endif]-->
<head>
<?php
    // Meta
    $include = $_theme_path . 'section/meta.php';
    include $include;
?>
</head>
<body class="<?=$_section?> <?=$_page?>">
<?php
    // Header
	$include = $_theme_path . 'section/header.php';
    if(!$_do_not_include_header) {
        include $include;
    }

	// Content
	$include = $_theme_path . $_page_file;
    include $include;

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
