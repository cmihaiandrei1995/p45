<?php
/**
 * Update the cms
 */

$_use_routes = false;
$_do_not_use_restrict = true;
$_page = "updates";

require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/settings.php';

// Start output
include $_base_path_cms . 'content/section/meta.php';

// get a list of all current tables
$_tables = array();
$tables = db_query('SHOW TABLES');
foreach($tables as $table){
	$_tables[] = $table['Tables_in_'.$_config['db']['database']];
}

show_table_log_header();

if(!isset($_SESSION[$_site_title]['cms']['id_admin_user'])){
	show_table_log_row('error', 'You have no permission to access this file. You must be logged in the cms in order to use this script.');
	exit;
}

$do_update = false;

// get version list
$curl_version = curl_init('http://cms.prologue.ro/updates.xml');
curl_setopt($curl_version, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($curl_version, CURLOPT_TIMEOUT, 5);
curl_setopt($curl_version, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_version, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl_version, CURLOPT_MAXREDIRS, 5);
$return = curl_exec($curl_version);

if($return != ""){
	$xml = xml2array($return);

	show_table_log_row('info', "Current cms version: ".$_version);

	if($xml['versions']['version'][0]['number']['value'] == $_version){
		show_table_log_row('error', "CMS is already to date.");
		exit;
	}elseif($xml['versions']['version'][0]['number']['value'] < $_version){
		show_table_log_row('fatal', "This version is ahead of current releases.");
		exit;
	}

	// browse available versions and get the closest new one
	foreach($xml['versions']['version'] as $version){
		if($version['number']['value'] == $_version){
			$do_update = true;
			break;
		}else{
			$new_version = $version['number']['value'];
			if($_config['site']['is_shop']){
				$new_version_file = $version['file_shop']['value'];
			}else{
				$new_version_file = $version['file']['value'];
			}
			$run_setup = $version['setup']['value'];
		}
	}

	// do update
	if($do_update){

		// create maintenance file
		$fh = fopen($_base_path.".maintenance", 'w') or die("Can't create file");
		show_table_log_row('info', "Enable maintenance mode");

		// let's update :)
		show_table_log_row('info', "New cms version: ".$new_version);

		// check for permissions for the uploads directory
		if(!is_dir($_base_uploads_path)){
			show_table_log_row('fatal', "Uploads directory does not exist.");

			// remove maintenance file
			if(file_exists($_base_path.".maintenance")){
				unlink($_base_path.".maintenance");
			}
			show_table_log_row('info', "Disable maintenance mode");

			exit;
		}else{
			if(!is_writable($_base_uploads_path)){
				show_table_log_row('fatal', "Uploads directory is not writable.");

				// remove maintenance file
				if(file_exists($_base_path.".maintenance")){
					unlink($_base_path.".maintenance");
				}
				show_table_log_row('info', "Disable maintenance mode");

				exit;
			}
		}

		show_table_log_row('info', "Connecting through ftp...");

		if($_config['ftp']['hostname'] == "" || $_config['ftp']['username'] == "" || $_config['ftp']['password'] == ""){
			show_table_log_row('fatal', "No FTP data set in config.");

			// remove maintenance file
			if(file_exists($_base_path.".maintenance")){
				unlink($_base_path.".maintenance");
			}
			show_table_log_row('info', "Disable maintenance mode");

			exit;
		}

		// set up a ftp connection or die
		$ftp_conn = _ftp_connect($_config['ftp']['hostname'], $_config['ftp']['port'], 5);

		if($ftp_conn){
			// try to login into ftp
			if (_ftp_login($ftp_conn, $_config['ftp']['username'], $_config['ftp']['password'])) {
				show_table_log_row('debug', "Connected.");
			}else{
				show_table_log_row('error', "FTP Login incorrect. Cannot connect through FTP.");

				// remove maintenance file
				if(file_exists($_base_path.".maintenance")){
					unlink($_base_path.".maintenance");
				}
				show_table_log_row('info', "Disable maintenance mode");

				exit;
			}
		}else{
			show_table_log_row('error', "FTP Connection error. Cannot connect through FTP.");

			// remove maintenance file
			if(file_exists($_base_path.".maintenance")){
				unlink($_base_path.".maintenance");
			}
			show_table_log_row('info', "Disable maintenance mode");

			exit;
		}

		show_table_log_row('info', "Starting download...");

		// start the archive download
		$curl_archive = curl_init($new_version_file);
	    curl_setopt($curl_archive, CURLOPT_HEADER, 0);
	    curl_setopt($curl_archive, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl_archive, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt($curl_archive, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl_archive, CURLOPT_TIMEOUT, 5);
	    $archive = curl_exec($curl_archive);
	    curl_close($curl_archive);

		// write to file
		$zipfile = $_base_uploads_path.'update.zip';
	    if(file_exists($zipfile)){
	        unlink($zipfile);
	    }
	    $fp = fopen($zipfile, 'x');
	    fwrite($fp, $archive);
	    fclose($fp);

		// check if saved
		if(!file_exists($zipfile)){
			show_table_log_row('error', "Can not download archive. Try again later.");

			// remove maintenance file
			if(file_exists($_base_path.".maintenance")){
				unlink($_base_path.".maintenance");
			}
			show_table_log_row('info', "Disable maintenance mode");

			exit;
		}

		show_table_log_row('debug', "Download complete.");

		// create a backup
		if(!is_dir($_base_uploads_path."backups/")){
			if(!mkdir($_base_uploads_path."backups", 0777)){
				show_table_log_row('fatal', "Can not create backup directory.");

				// remove maintenance file
				if(file_exists($_base_path.".maintenance")){
					unlink($_base_path.".maintenance");
				}
				show_table_log_row('info', "Disable maintenance mode");

				exit;
			}
		}
		if(!is_dir($_base_uploads_path."backups/backup/")){
			if(!mkdir($_base_uploads_path."backups/backup", 0777)){
				show_table_log_row('fatal', "Can not create backup directory.");

				// remove maintenance file
				if(file_exists($_base_path.".maintenance")){
					unlink($_base_path.".maintenance");
				}
				show_table_log_row('info', "Disable maintenance mode");

				exit;
			}
		}

		cpdir_recursive($_base_path."cms/", $_base_uploads_path."backups/backup/cms/");
		cpdir_recursive($_base_path."lib/", $_base_uploads_path."backups/backup/lib/");
		copy($_base_path."settings.php", $_base_uploads_path."backups/backup/settings.php");

		// Initialize archive object
		$zip = new ZipArchive();
		$zip->open($_base_uploads_path.'backups/backup-'.date('d.m.Y-H.i.s').'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

		$rootPath = $_base_uploads_path."backups/backup/";

		// Create recursive directory iterator
		$files = new RecursiveIteratorIterator(
		    new RecursiveDirectoryIterator($rootPath),
		    RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file){
		    if (!$file->isDir()) {
		        // Get real and relative path for current file
		        $filePath = $file->getRealPath();
		        $relativePath = substr($filePath, strlen($rootPath));

		        // Add current file to archive
		        $zip->addFile($filePath, $relativePath);
		    }
		}
		$zip->close();

		rmdir_recursive($_base_uploads_path."backups/backup/");

		show_table_log_row('info', "Backup done");

		show_table_log_row('info', "Unzipping the archive...");

		// create temp directory
		$tmp_dir = $_base_uploads_path."tmp/";
		if(is_dir($tmp_dir)){
			// clean it
			rmdir_recursive($tmp_dir);
		}

		// make the directory
		if(!is_dir($tmp_dir)){
			if(!mkdir($tmp_dir, 0777)){
				show_table_log_row('fatal', "Can not create temp directory.");

				// remove maintenance file
				if(file_exists($_base_path.".maintenance")){
					unlink($_base_path.".maintenance");
				}
				show_table_log_row('info', "Disable maintenance mode");

				exit;
			}
			chmod($tmp_dir, 0777);
		}

		// unzip the archive
		$zip = new ZipArchive;
		$res = $zip->open($zipfile);
		if($res === TRUE) {
			$zip->extractTo($tmp_dir);
			$zip->close();
		} else {
			show_table_log_row('error', "Can not unzip the archive.");

			// remove maintenance file
			if(file_exists($_base_path.".maintenance")){
				unlink($_base_path.".maintenance");
			}
			show_table_log_row('info', "Disable maintenance mode");

			exit;
		}

		show_table_log_row('debug', "Archive unzipped.");

		show_table_log_row('info', "Updating files...");

		// start moving files
		$tmp_dir_archive = $tmp_dir.'v'.$new_version.'/';
		$dir_handle = opendir($tmp_dir_archive);
        while($file = readdir($dir_handle)){
            if($file != "." && $file != ".."){
            	if(is_dir($tmp_dir_archive.$file)){
					_ftp_cpdir_recursive($ftp_conn, $file, $tmp_dir_archive.$file.'/', $tmp_dir_archive, true);
				}elseif(is_file($tmp_dir_archive.$file)){
					_ftp_cpdir_recursive($ftp_conn, $file, $tmp_dir_archive, $tmp_dir_archive, true);
				}
			}
		}
		closedir($dir_handle);

		// TODO: Clean up old folders and files ???

		show_table_log_row('info', "Finished. Updated to v".$new_version);

		// send data info to prologue
		$url_api = 'http://cms.prologue.ro/api/api.php';
		$fields_api = array(
			'name' => urlencode($_config['site']['name']),
			'domain' => urlencode($_config['site']['domain']),
			'path' => urlencode($_config['site']['path']),
			'version' => urlencode($_version),
			'to_version' => urlencode($new_version),
			'action' => 'update'
		);
		foreach($fields_api as $key => $value) { $fields_api_string .= $key.'='.$value.'&'; }
		rtrim($fields_api_string, '&');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_api);
		curl_setopt($ch, CURLOPT_POST, count($fields_api));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_api_string);
		$result = curl_exec($ch);
		curl_close($ch);

		// close the ftp connection
		_ftp_close($ftp_conn);

		// clean up the mess
		unlink($zipfile);
		rmdir_recursive($tmp_dir);

		// remove maintenance file
		if(file_exists($_base_path.".maintenance")){
			unlink($_base_path.".maintenance");
		}
		show_table_log_row('info', "Disable maintenance mode");

	}

	echo "</pre><br><br><br>";

	// run the setup file if needed
	if($do_update && $run_setup){
		include 'setup.php';
		exit;
	}

}else{
	show_table_log_row('error', "Can not update because version list is not available. Try again later.");
}

show_table_log_footer();

// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();
