<?php

$_title = "Dashboard";
$_subtitle = $_config['site']['name'];
$_is_dashboard = true;

// get widgets, if not, set the default ones
if($_SESSION[$_site_title]['cms']['id_admin_group'] == 1){
	if(!$_widgets){
		$_widgets = array('general_stats', 'analytics', 'prlg');
	}
}else{
	if(!$_widgets){
		$_widgets = array('general_stats', 'prlg');
	}
}

foreach($_widgets as $widget){
	if(is_dir($_base_cms_path.'widgets/'.$widget.'/') && file_exists($_base_cms_path.'widgets/'.$widget.'/backend.php')){
		include $_base_cms_path.'widgets/'.$widget.'/backend.php';
	}
}

if(!$_disable_updates){
	if($_SESSION[$_site_title]['cms']['id_admin_group'] == 1){
		// get version list
		$curl_version = curl_init('http://cms.prologue.ro/updates.xml');
		curl_setopt($curl_version, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl_version, CURLOPT_TIMEOUT, 5);
		curl_setopt($curl_version, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_version, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl_version, CURLOPT_MAXREDIRS, 5);
		$return = curl_exec($curl_version);
		
		if($return != ""){
			$xml_update = xml2array($return);
			
			if($xml_update['versions']['version'][0]['number']['value'] > $_version){
				// browse available versions and get the closest new one
				foreach($xml_update['versions']['version'] as $version){
					if($version['number']['value'] == $_version){
						$do_update = true;
						break;
					}else{
						if(!$version['beta']['value']){
							$new_version = $version['number']['value'];
							$current_version = $_version;
							$show_update_notification = true;
						}
					}
				}
			}
		}
	}
}