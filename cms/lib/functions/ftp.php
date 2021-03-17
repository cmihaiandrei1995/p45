<?

// initiate ftp connection
function _ftp_connect($host, $port = 21, $timeout = 10){
	$conn = ftp_connect($host, $port, $timeout);// or die("ERROR: Couldn't connect to ".$host.".");
	return $conn;
}

// ftp login
function _ftp_login($conn, $user, $pass){
	global $_config;

	if (@ftp_login($conn, $user, $pass)) {
		if($_config['ftp']['passive_mode']){
			ftp_pasv($conn, true);
		}
		return true;
	} else {
		//throw new Exception("ERROR: Could not connect as ".$user.".");
		//die("ERROR: Could not connect as ".$user.".");
		return false;
	}
}

// ftp close
function _ftp_close($conn){
	ftp_close($conn);
}

/**
 * Copies a directory recursive via ftp
 */
function _ftp_cpdir_recursive($conn, $source, $folder, $main_folder, $overwrite = false){
	global $_config;

    if(is_dir($folder)) {
        $dir_handle = opendir($folder);
        while($file = readdir($dir_handle)){
            if($file != "." && $file != ".."){
				$ftp_folder = str_replace($main_folder, $_config['ftp']['main_dir'], $folder);
                if(is_dir($folder.$file)){
                    if(!is_dir($ftp_folder.$file)){
                        ftp_mkdir($conn, $ftp_folder.$file);
						//ftp_chmod($conn, 0755, $ftp_folder.$file);
                    }
                    _ftp_cpdir_recursive($conn, $source."/".$file, $folder.$file.'/', $main_folder, $overwrite);
                } else {
                	if($overwrite){
                		ftp_delete($conn, $ftp_folder.$file);
					}
					ftp_put($conn, $ftp_folder.$file, $folder.$file, FTP_BINARY);
                }
            }
        }
        closedir($dir_handle);
    } else {
    	if($overwrite){
    		ftp_delete($conn, $_config['ftp']['main_dir'].$source);
    	}
		ftp_put($conn, $_config['ftp']['main_dir'].$source, $folder.$source, FTP_BINARY);
    }
}
