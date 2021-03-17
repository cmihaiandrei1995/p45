<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> true,
	'is_searchable' 	=> false,
	'is_filtrable'		=> true,
	'is_sortable'		=> true,
	'is_bulk_editable'	=> true,


);

$this->sql = array(
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

if(!function_exists('max_strlen_array_values')){
	function max_strlen_array_values($array){
		$max = 0;

		foreach($array as $val){
			if(strlen($val) > $max){
				$max = strlen($val);
			}
		}

		return $max;
	}
}

/*
Usage:

		'allow_guide' => array(												//name - for reference
			'id'					=> 'allow_guide',						//id of the field
			'db_name'				=> 'allow_guide',						//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Apare in ghid',						//name to appear on the left column
			'type' 					=> 'select',							//look for field types in cms/plugins
			'values'				=> array(								//values must be an array holding keys with db values and strings as output values
										'1' => _lng('yes'),
										'0' => _lng('no')
									),

 			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit
			'hidden_but_searchable' => true,								//if field is hidden but allow filter and search

			'required' 				=> false,								//if required
			'validation_rules' 		=> '',									//validation rules

			'tooltip'				=> 'Apare in ghid',						//tooltip value
			'placeholder'			=> '',									//placeholder value
			'icon'					=> 'locked2',							//name of the icon
			'use_ajax'				=> false,								//allow search?

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
