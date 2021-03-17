<?php
$_use_routes = false;
$_is_ajax = true;
$_is_cms = true;
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/../settings.php';

// Including the config file
if(isset($_module) && $_module!="") {
	if(file_exists($_base_path_cms . 'modules/' . $_module . '/config.php')) {
		include $_base_path_cms . 'modules/' . $_module . '/config.php';
		if(file_exists($_base_path_cms . 'modules/' . $_module . '/extra/config.php')) {
			include $_base_path_cms . 'modules/' . $_module . '/extra/config.php';
		}
	} else {
		exit;
	}
} else {
	exit;
}

// fix
$_section['actions'] = array('view');
if($_section['use_add']) $_section['actions'][] = "add";
if($_section['use_edit']) $_section['actions'][] = "edit";
if($_section['use_delete']) $_section['actions'][] = "delete";
if($_section['use_order']) $_section['actions'][] = "order";


$tmp = explode('.', $_GET['field']);
$fld = $tmp[count($tmp)-1];
$field = $_section['fields'][$fld];

$array = array();

if($_section['use_active'] && $fld == "active"){

	$array['values'] = array(
		array('id' => 1, 'text' => _lng('yes')),
		array('id' => 0, 'text' => _lng('no')),
	);

	echo json_encode($array);

}elseif(count($field)){

	if($_GET['action'] == "search"){

		$_filter_where[] = array(
			'field' => $field['from_field'],
			'operator' => 'like',
			'query' => $_GET['q']
		);

		if($_GET['where_field'] != "" && $_GET['where_value'] != ""){
			$where_field = json_decode($_GET['where_field'], true);
			$where_value = json_decode($_GET['where_value'], true);

			if(is_array($where_field) && is_array($where_value)){
				foreach($where_field as $k => $fld){
					$_filter_where[] = array(
						'field' => $where_field[$k],
						'operator' => 'in',
						'query' => $where_value[$k]
					);
				}
			}else{
				$_filter_where[] = array(
					'field' => $_GET['where_field'],
					'operator' => 'in',
					'query' => $_GET['where_value']
				);
			}
		}

		$config = array(
			'globals' => array(
				'_website_langs', '_module', '_filter_where'
			),
			'vars' => array('field' => $field, '_section' => $_section, '_is_ajax' => $_is_ajax)
		);

		// Constructing the plugin
		$plugin = new Plugin($field['type'], $config);

		if($plugin->hasWidget('data')){
			$plugin->widget('data', 'backend');

			$result = $plugin->values;

			$fields = array();
			if(count($field['add_info'])){
				foreach($field['add_info'] as $k => $info){
					$fields[] = 'field'.($k+1);
				}
			}

			foreach($result as $key => $val){
				$add_to = '';
				if(count($fields)){
					foreach($fields as $flds){
						$add_to .= ', '.$val[$flds];
					}
				}

				$array[] = array(
					'id' => $val[$field['from_id']],
					'text' => $val[$field['from_field']].$add_to
				);
			}
		}

	}elseif($_GET['action'] == "init"){

		if(count($field['values'])){

			$array['values'] = array();
			foreach($field['values'] as $key => $val){
				$array['values'][] = array(
					'id' => $key,
					'text' => $val
				);
			}

		}else{

			if($field['use_ajax']){
				$array['ajax'] = true;
			}else{
				$config = array(
					'globals' => array(
						'_website_langs', '_module',
					),
					'vars' => array('field' => $field, '_section' => $_section, '_is_ajax' => $_is_ajax)
				);

				// Constructing the plugin
				$plugin = new Plugin($field['type'], $config);

				if($plugin->hasWidget('data')){
					$plugin->widget('data', 'backend');
				}

				$array['values'] = array();
				foreach($plugin->values as $key => $val){
					$array['values'][] = array(
						'id' => $val[$field['from_id']],
						'text' => $val[$field['from_field']]
					);
				}
			}

		}
	}

	echo json_encode($array);
}

// Close the conn
$_db->close();
