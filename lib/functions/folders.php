<?
/**
 * Creates folders based on current date - Year/Month/Day
 */
function create_folders($folder, $year = '', $month = '', $day = ''){
	global $_base_path;
	
	if($year == ''){
		$year = date('Y');
	}
	if($month == ''){
		$month = date('n');
	}
	if($day == ''){
		$day = date('j');
	}
	
	$folder = str_replace($_base_path.'uploads/', '', $folder);
	
	$dirname = $_base_path.'uploads/'.$folder.'/'.$year.'/'.$month.'/'.$day;
	if(!is_dir($dirname)){
		mkdir($dirname, 0755, true);
		chmod($_base_path.'uploads/'.$folder.'/'.$year, 0755);
		chmod($_base_path.'uploads/'.$folder.'/'.$year.'/'.$month, 0755);
		chmod($_base_path.'uploads/'.$folder.'/'.$year.'/'.$month.'/'.$day, 0755);
	}
}

/**
 * Copies a directory recursive
 */
function cpdir_recursive($src, $dst){
    $dir = opendir($src);
	
	if(!is_dir($dst)) { 
    	@mkdir($dst, 0755, true);
	}
	
    while(false !== ($file = readdir($dir))) { 
        if ($file != '.' && $file != '..') { 
            if(is_dir($src.'/'.$file) ) { 
                cpdir_recursive($src.'/'.$file, $dst.'/'.$file); 
            }else{ 
                copy($src.'/'.$file, $dst.'/'.$file); 
            } 
        } 
    } 
    closedir($dir);
} 

/**
 * Removes a directory recursive
 */
function rmdir_recursive($dir){ 
	$files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) { 
    	(is_dir("$dir/$file")) ? rmdir_recursive("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir);
}

/**
 * Chown a directory and files recursive
 */
function chown_recursive($dir, $owner){ 
	$files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) { 
    	(is_dir("$dir/$file")) ? chown_recursive("$dir/$file") : chown("$dir/$file", $owner); 
    } 
    return chown($dir, $owner); 
}

/**
 * Chgrp a directory and files recursive
 */
function chgrp_recursive($dir, $group){ 
	$files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) { 
    	(is_dir("$dir/$file")) ? chgrp_recursive("$dir/$file") : chgrp("$dir/$file", $group); 
    } 
    return chgrp($dir, $group); 
}


/**
 * Chmod a directory and files recursive
 */
function chmod_recursive($dir, $permissions){ 
	$files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) { 
    	(is_dir("$dir/$file")) ? chmod_recursive("$dir/$file") : chmod("$dir/$file", $permissions); 
    } 
    return chmod($dir, $permissions); 
}


/**
 * Transforms unix file size into human readable filesize
 */
function human_filesize($file, $decimals = 0) {
	$bytes = filesize($file);
	$sz = 'BKMGTP';
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . " " . @$sz[$factor] . "b";
}