<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
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
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

/*
Usage:

		'months' => array(													//name - for reference
			'id'					=> 'months',							//id of the field
			'db_name'				=> 'months',							//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Luni',								//name to appear on the left column
			'type' 					=> 'select_multiple',					//look for field types in cms/plugins

  			'values'				=> array(								//values must be an array holding keys with db values and strings as output values
										'1' => "Ianuarie",
										'2' => "Februarie"
										...
									),

			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

			'required' 				=> false,								//if required
			'validation_rules' 		=> '',									//validation rules

			'tooltip'				=> 'Luni',								//tooltip value
			'placeholder'			=> '',									//placeholder value
			'icon'					=> 'info',								//name of the icon
			'use_ajax'				=> false,								//allow search?

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '=', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
