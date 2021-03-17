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
	'is_bulk_editable'	=> false,
);

$this->sql = array(
	'ALTER TABLE #table# ADD #field# #type# NULL DEFAULT NULL'
);

/*
Usage:

		'password' => array(												//name - for reference
			'id'					=> 'password',							//id of the field
			'db_name'				=> 'password',							//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Parola',							//name to appear on the left column
			'type' 					=> 'text',								//look for field types in cms/plugins

			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules

 			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

			'tooltip'				=> 'Parola',							//tooltip value
			'placeholder'			=> 'ex: Lorem ipsum',					//placeholder value
			'icon'					=> 'key',								//name of the icon
			'size'					=> '',									//size, with % or px

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
