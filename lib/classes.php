<?php
// compile less files
if(($_config['site']['less'] || isset($_GET['less'])) && !$_is_ajax && !$_is_cms && !$_is_cron){
	// less compiler
	require_once $_base_path . 'lib/classes/less/lessc.php';

	auto_compile_less(
	    $_base_static_path . 'css/less/style.less',
	    $_base_static_path . 'css/style.css',
	    false, // cache
	    true // compress
	);
}

// db class
require_once $_base_path . 'lib/classes/db/db.php';

// post validate class
require_once $_base_path . 'lib/classes/validation/validate.php';

// router class
require_once $_base_path . 'lib/classes/routing/router.php';

// thumbs class
require_once $_base_path . 'lib/classes/thumbs/class.upload.php';

// php mailer class
require_once $_base_path . 'lib/classes/mail/class.phpmailer.php';

if($_config['email']['smtp']){
	// mail class
	require_once $_base_path . 'lib/classes/mail/class.smtp.php';
}

// Carbon DateTime class
require_once $_base_path . 'lib/classes/date/carbon.php';

// basic FTP helper
require_once $_base_path . 'lib/classes/ftp/ftpHandler.php';

// file cache class
if($_config['server']['file_cache']){
	require_once $_base_path . 'lib/classes/cache/file_cache.php';
}

// Google authenticator class for 2FA
require_once $_base_path . 'lib/classes/google/GoogleAuthenticator.php';
