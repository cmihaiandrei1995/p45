<?php

// site stats
$site_stats = array();
foreach($_sections as $section){

	$site_stats[$section['name']] = array();

	foreach($section['modules'] as $module => $module_name){
		if(file_exists($_base_path_cms . 'modules/' . $module . '/config.php')) {
			include $_base_path_cms . 'modules/' . $module . '/config.php';
			if(file_exists($_base_path_cms . 'modules/' . $_module . '/extra/config.php')) {
				include $_base_path_cms . 'modules/' . $_module . '/extra/config.php';
			}

			$info = array();

			if($_section['table'] && check_admin_perm($module, 'view')){
				//get normal records count
				$nr_count = db_row('
					SELECT COUNT(1) AS nr_recs
					FROM '.$_section['table'].'
					WHERE 1 '.$_section['extra_where']
				);
				$info['nr_recs'] = $nr_count['nr_recs'];

				//get trash count
				if($_section['use_active']){
					$active_count = db_row('
						SELECT COUNT(1) AS nr_recs
						FROM '.$_section['table'].'
						WHERE active = 1 '.$_section['extra_where']
					);
					$info['nr_active'] = $active_count['nr_recs'];
					$info['nr_inactive'] = $info['nr_recs'] - $info['nr_active'];
				}else{
					$info['nr_active'] = "-";
					$info['nr_inactive'] = "-";
				}

				$info['module'] = $module;

				$site_stats[$section['name']][$module_name['name']] = $info;
			}
		}
	}
}
