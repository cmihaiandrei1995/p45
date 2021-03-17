<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> false,
	'is_searchable' 	=> true,
	'is_filtrable'		=> false,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> true,


);

$this->sql = array(
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

/*
Usage:

		'color' => array(													//name - for reference
			'id'					=> 'color',								//id of the field
			'db_name'				=> 'color',								//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Culoare',							//name to appear on the left column
			'type' 					=> 'colorpicker',						//look for field types in cms/plugins

			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules

 			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit
			'hidden_but_searchable' => true,								//if field is hidden but allow filter and search

			'tooltip'				=> 'Culoare',							//tooltip value
			'placeholder'			=> 'ex: #00FF12',						//placeholder value
			'icon'					=> 'eyedropper',						//name of the icon

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
