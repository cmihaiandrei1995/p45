<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> true,
	'is_searchable' 	=> true,
	'is_filtrable'		=> false,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> false,
);

$this->sql = array(
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

/*
Usage:

		'description' => array(												//name - for reference
			'id'					=> 'description',						//id of the field
			'db_name'				=> 'description',						//db name of the field
			'db_type'				=> 'text',								//field type in the db
			'name' 					=> 'Descriere',							//name to appear on the left column
			'type' 					=> 'textarea',							//look for field types in cms/plugins

  			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit
			'hidden_but_searchable' => true,								//if field is hidden but allow filter and search

  			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules

			'use_wysiwyg'			=> true,								//use the editor or just plain textarea
			'tooltip'				=> 'Continut articol',					//tooltip value
			'icon'					=> 'imagesList',						//name of the icon

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> ''									//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
