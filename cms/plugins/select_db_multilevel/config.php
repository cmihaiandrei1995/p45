<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'data' => 'data.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> true,
	'is_searchable' 	=> false,
	'is_filtrable'		=> true,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> true,


);

foreach($field['from_db'] as $from_db){
	if($from_db['use_db']){
		$this->sql[] = 'ALTER TABLE #table# ADD '.$from_db['id'].' #type# NULL DEFAULT NULL';
	}
}

if(!function_exists('get_multilevel_values')){
	function get_multilevel_values($from_db, $i = 0, $val = ''){

		$add_where = '';
		if($i > 0){
			$add_where = ' AND '.$from_db[$i]['table'].'.'.$from_db[$i-1]['id'].' = '.$val;
		}

		$records = db_query('
			SELECT '.$from_db[$i]['table'].'.* '.
			'FROM '.$from_db[$i]['table'].
				($from_db[$i]['multilang'] ? ' JOIN '.$from_db[$i]['table'].'_lng USING ('.$from_db[$i]['id'].')' : '').' '.
			'WHERE 1 '.
				$add_where.
				($from_db['multilang'] ? ' AND '.$from_db[$i]['table'].'_lng.lng = "'.$_lang_cms_rec.'"' : '').' '.
			'ORDER BY '.
			$from_db[$i]['order_by'].' '.$from_db[$i]['order_how']
		);

		foreach($records as $k => $rec){
			$values[$k] = array(
				'id' => $rec[$from_db[$i]['id']],
				'title' => $rec[$from_db[$i]['field']]
			);
			if($i < count($from_db)-1){
				$values[$k]['values'] = get_multilevel_values($from_db, $i+1, $rec[$from_db[$i]['id']]);
			}
		}
		return $values;
	}
}

if(!function_exists('show_multilevel_values')){
	function show_multilevel_values($field, $lng, $values, $i = 0, $legacy = array(), $record = array()){
		$from_db = $field['from_db'];

		if(count($record)){
			foreach($from_db as $f => $from){
				if($from['use_db']){
					$db_val[] = $record[$from['id']];
				}
			}
		}

		foreach($values as $val){
			$legacy[] = $val['id'];
			$cur_val = $from_db[$i]['allow_select'] ? implode("_", $legacy) : "";
			?>
				<option value="<?=$cur_val?>"
					<? if(isset($_POST[$field['id'].'_'.$lng]) && $_POST[$field['id'].'_'.$lng] == $cur_val && $cur_val !="") echo "selected"; elseif(!isset($_POST['submit']) && implode("_", $db_val) == $cur_val && $cur_val != "") echo "selected"?>
					><?=str_repeat(" - ", $i)?><?=$val['title']?></option>
			<?
			array_pop($legacy);

			if(count($val['values'])){
				if($from_db[$i]['use_db']){
					$legacy[] = $val['id'];
				}
				show_multilevel_values($field, $lng, $val['values'], $i+1, $legacy, $record);
				array_pop($legacy);
			}
		}
	}
}

/*
Usage:

		'id_product_subcategory' => array(										//name - for reference
			'id'					=> 'id_product_subcategory',				//id of the field
			'db_name'				=> 'id_product_subcategory',				//db name of the field
			'db_type'				=> 'int',									//field type in the db
			'name' 					=> 'Subcategoria',							//name to appear on the left column
			'type' 					=> 'select_db_multilevel',					//look for field types in cms/plugins

			'from_db'				=> array(
										array(
											'table' => 'product_category',		//from table name
											'id' => 'id_product_category',		//from table base id
											'field' => 'title', 				//field to show
											'multilang' => false,				//is the from table with multilang?
											'order_by' => 'title',				//field to order records by
											'order_how' => 'asc',				//how to order
											'allow_select' => false,			//if allow the user to select at this level
											'use_db' => true					//if insert the record in the db
										),
										array(
											'table' => 'product_subcategory',	//from table name
											'id' => 'id_product_subcategory',	//from table base id
											'field' => 'title', 				//field to show
											'multilang' => false,				//is the from table with multilang?
											'order_by' => 'title',				//field to order records by
											'order_how' => 'asc',				//how to order
											'allow_select' => false,			//if allow the user to select at this level
											'use_db' => true					//if insert the record in the db
										),
									),

 			'do_not_edit'			=> false,									//if field is editable
			'hidden'				=> false,									//if field is shown on add and edit
			'hidden_but_searchable' => true,									//if field is hidden but allow filter and search

			'required' 				=> true,									//if required
			'validation_rules' 		=> '',										//validation rules

			'tooltip'				=> 'Subcategorie',							//tooltip value
			'placeholder'			=> 'Alege subcategorie',					//placeholder value
			'icon'					=> 'info',									//name of the icon

			'lng' 					=> array('ro'),								//languages - array (ro, en, de...)
			'value' 				=> ''										//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
