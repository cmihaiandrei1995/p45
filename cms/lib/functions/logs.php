<?

function admin_log_action($section, $action, $id = "", $data = array()){
	global $_site_title, $_config, $_website_langs;

	if($data){
		foreach($_config['cms'][$section]['fields'] as $key => $field){
			// check for multiple languages
			if(count($field['lng']) > 1){
				$_multiple_lang = true;
			}
		}

		foreach($_config['cms'][$section]['fields'] as $key => $field){
			if(!in_array($field['type'], array('image', 'image_simple', 'file', 'file_simple', 'multi_image', 'multi_image_copy_title', 'admin_permissions', 'password'))){
				foreach($field['lng'] as $lng){
					if($field['db_fields']){
						foreach($field['db_fields'] as $key_db){
							$_data[$key_db][$lng] = $data[$key_db.'_'.$lng];
						}
					}else{
						$_data[$key][$lng] = $data[$key.'_'.$lng];
					}
				}
			}
		}

		if($_config['cms'][$section]['use_active']){
			$_data['active'] = $data['active'];
		}

		if($_config['cms'][$section]['use_order']){
			$_data['order'] = $data['order'];
		}

		if($_config['cms'][$section]['use_seo']){
			if($_multiple_lang){
				foreach($_website_langs as $lng => $lng_name){
					$_data['seo_title'][$lng] = $data['seo_title_'.$lng];
					$_data['seo_keywords'][$lng] = $data['seo_keywords_'.$lng];
					$_data['seo_description'][$lng] = $data['seo_description_'.$lng];
				}
			}else{
				$lng = array_keys($_website_langs);
				$_data['seo_title'][$lng[0]] = $data['seo_title_'.$lng[0]];
				$_data['seo_keywords'][$lng[0]] = $data['seo_keywords_'.$lng[0]];
				$_data['seo_description'][$lng[0]] = $data['seo_description_'.$lng[0]];
			}
		}
	}

	db_query('INSERT INTO admin_action SET id_admin_user = ?, section = ?, action = ?, session_id = ?, id_what = ?, data = ?',
		$_SESSION[$_site_title]['cms']['id_admin_user'],
		$section,
		$action,
		session_id(),
		($id > 0 ? $id : NULL),
		($_data ? gzdeflate(serialize($_data)) : "")
	);
}

function show_table_log_header($with_time = false){
	?>
	<div class="panel-body tab-content">
		<table class="table table-striped table-no-more table-bordered mb-none">
			<thead>
				<tr>
					<th style="width: 10%"><span class="text-normal text-sm">Type</span></th>
					<? if($with_time){?>
						<th style="width: 15%"><span class="text-normal text-sm">Date</span></th>
					<? }?>
					<th><span class="text-normal text-sm">Message</span></th>
				</tr>
			</thead>
			<tbody class="log-viewer">

	<?
	flush();
}

function show_table_log_footer(){
	?>
			</tbody>
		</table>
	</div>
	<?
	flush();
}

function show_table_log_row($type, $message, $time = 0){
	$icons = array(
		'info' => 'info',
		'debug' => 'bug',
		'warning' => 'warning',
		'error' => 'times-circle',
		'fatal' => 'ban'
	);
	$texts = array(
		'info' => 'info',
		'debug' => 'muted',
		'warning' => 'warning',
		'error' => 'danger',
		'fatal' => 'danger'
	);
	?>
	<tr>
		<td data-title="Type" class="pt-md pb-md">
			<i class="fa fa-<?=$icons[$type]?> fa-fw text-<?=$texts[$type]?> text-md va-middle"></i>
			<span class="va-middle"><?=ucfirst($type)?></span>
		</td>
		<? if($time > 0){?>
			<td data-title="Date" class="pt-md pb-md">
				<?=date('d.m.Y H:i:s', $time)?>
			</td>
		<? }?>
		<td data-title="Message" class="pt-md pb-md">
			<?=$message?>
		</td>
	</tr>
	<?
	flush();
}
?>
