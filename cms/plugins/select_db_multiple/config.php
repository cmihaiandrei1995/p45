<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'data' => 'data.php',
	'delete' => 'delete.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> false,
	'is_searchable' 	=> false,
	'is_filtrable'		=> false,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> true,
);

$this->sql = array(
	'CREATE TABLE IF NOT EXISTS #use_other_table# (
		`#id#` int(11) NOT NULL DEFAULT "0",
		#lng#
		`#field#` #type# NOT NULL,
		KEY `#id#` (`#id#`)
	) ENGINE = MyISAM DEFAULT CHARSET = utf8'
);

if(!function_exists('select_db_multiple_format_records_with_parents')){
	function select_db_multiple_format_records_with_parents($fields, $field, $joins, $order_by, $parent_id, $level = 0){
		global $_lang_cms_rec;

		$records = db_query('
			SELECT '.$field['from_table'].'.* '.
				(count($fields) ? ', '.implode(', ', $fields).' ' : '').
			'FROM '.$field['from_table'].
				($field['from_multilang'] ? ' JOIN '.$field['from_table'].'_lng USING ('.$field['from_id'].')' : '').' '.
				(count($joins) ? implode(' ', $joins) : '').' '.
			'WHERE 1 '.
				$add_where.
				($field['from_where'] ? $field['from_where'] : '').
				($field['from_multilang'] ? ' AND '.$field['from_table'].'_lng.lng = "'.$_lang_cms_rec.'"' : '').' '.
				'AND parent_id = '.$parent_id.' '.
			'ORDER BY '.
			$order_by.
			$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$field['from_order_by'].' '.$field['from_order_how']
		);

		foreach($records as $key => $val){
			$val['has_children'] = false;
			$val['level'] = $level;
			if($parent_id > 0){
				$val[$field['from_field']] = " - ".$val[$field['from_field']];
				$val['level'] += 1;
			}
			if(isset($field['items_from_table']) && $field['items_from_table'] != '' && isset($field['items_from_field']) && $field['items_from_field'] != '') {
				$val['items_count'] = db_field('SELECT COUNT(1) FROM `'.$field['items_from_table'].'` WHERE `'.$field['items_from_field'].'` = ?', $val[$field['from_id']]);
			}

			$children = select_db_multiple_format_records_with_parents($fields, $field, $joins, $order_by, $val[$field['from_id']], $val['level']);
			if(count($children)){
				$val['has_children'] = true;
			}

			$all_values[] = $val;

			if(count($children)){
				foreach($children as $k => $v){
					if($parent_id > 0){
						$v[$field['from_field']] = " - ".$v[$field['from_field']];
					}
					$all_values[] = $v;
				}
			}
		}

		return $all_values;
	}
}

if(!function_exists('format_records_for_view_with_parents')){
	function format_records_for_view_with_parents($records, $parent_id, $level = 0){
		global $_section;

		foreach($records as $record){
			if($record['record_'.$_section['use_parent_for_view_field']] == $parent_id){
				$new_records[] = $record;
			}
		}

		foreach($new_records as $key => $val){
			$val['has_children'] = false;
			$val['level'] = $level;
			if($parent_id > 0){
				$val['level'] += 1;
			}

			$children = format_records_for_view_with_parents($records, $val[$_section['id']], $val['level']);
			if(count($children)){
				$val['has_children'] = true;
			}

			$all_values[] = $val;

			if(count($children)){
				foreach($children as $k => $v){
					$all_values[] = $v;
				}
			}
		}

		return $all_values;
	}
}

/*
Usage:
		'id_hotel' => array(												//name - for reference
			'id'					=> 'id_hotel',							//id of the field
			'db_name'				=> 'id_hotel',							//db name of the field
			'db_type'				=> 'int',								//field type in the db
			'name' 					=> 'Hotel',								//name to appear on the left column
			'type' 					=> 'select_db_multiple',				//look for field types in cms/plugins
			'use_other_table'		=> '#table#_to_hotel',

			'from_table'			=> 'hotel',								//from table name
			'from_id'				=> 'id_hotel',							//from table base id
			'from_multilang'		=> true,								//is the from table with multilang?
			'from_field'			=> 'title',								//field to show
			'from_order_by'			=> 'title',								//field to order records by
			'from_order_how'		=> 'asc',								//how to order
			'from_where'			=> 'AND field = 1'						//extra where

  			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit
			'use_parent'			=> false,								//uses parent_id in the database and show them with - in selector
			'max_levels'			=> 4,									//max levels of parents in hierarchy
			'disable_parents'		=> true,								//disables categories with children on product page
			'items_from_table'		=> 'shop_product',						//items table name
			'items_from_field'		=> 'id_shop_category',					//items table field to search

			'add_info'				=> array(
										array('id' => 'id_city', 'table' => 'city', 'field' => 'title', 'multilang' => false, 'not_affected' => false),
										array('id' => 'id_country', 'table' => 'country', 'field' => 'title', 'multilang' => false, 'not_affected' => false),
									),

			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules

			'tooltip'				=> 'Hotel',								//tooltip value
			'placeholder'			=> 'Alege hotel',						//placeholder value
			'icon'					=> 'globe',								//name of the icon
			'use_ajax'				=> true,								//use ajax for search

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
