<?php

class FileCache {
	
	// This is the function you store information with
	function store($key, $data, $ttl) {

	    // Opening the file
	    $h = fopen($this->setFileName($key), 'w');
	    if (!$h) throw new Exception('Could not write to cache');
		
	    // Serializing along with the TTL
	    $data = serialize(array(time() + $ttl, $data));
	    if (fwrite($h, $data) === false) {
	    	throw new Exception('Could not write to cache');
	    }
	    fclose($h);

	}
	
	// General function to create the filename for a certain key
  	private function setFileName($key) {
  		
		global $_base_path;
		
		if(!is_dir($_base_path.'cache/')){
			if(!mkdir($_base_path.'cache/', 0755, true)){
				die("Could not create cache folder.");
			}
		}
		
		$md5 = md5($key);
		
		$folder = substr($md5, 0, 2);
		if(!is_dir($_base_path.'cache/'.$folder)){
			if(!mkdir($_base_path.'cache/'.$folder, 0755, true)){
				die("Could not create a cache subfolder.");
			}
		}
		
		$subfolder = substr($md5, 2, 2);
		if(!is_dir($_base_path.'cache/'.$folder.'/'.$subfolder)){
			if(!mkdir($_base_path.'cache/'.$folder.'/'.$subfolder, 0755, true)){
				die("Could not create a cache subsubfolder.");
			}
		}
		
		return $_base_path.'cache/'.$folder.'/'.$subfolder.'/'.md5($key);
	}
	
  	// General function to find the filename for a certain key
  	private function getFileName($key) {
  		
		global $_base_path;
		
		$md5 = md5($key);
		
		$folder = substr($md5, 0, 2);
		$subfolder = substr($md5, 2, 2);
		return $_base_path.'cache/'.$folder.'/'.$subfolder.'/'.md5($key);
	}

  	// The function to fetch data returns false on failure
  	function fetch($key) {

    	$filename = $this->getFileName($key);
    	if (!file_exists($filename) || !is_readable($filename)) return false;

    	$data = file_get_contents($filename);

    	$data = @unserialize($data);
    	if (!$data) {
        	// Unlinking the file when unserializing failed
        	unlink($filename);
        	return false;
      	}

      	// checking if the data was expired
      	if (time() > $data[0]) {
        	// Unlinking
        	unlink($filename);
        	return false;
		}
		
    	return $data[1];
	}
}

$_file_cache = new FileCache();