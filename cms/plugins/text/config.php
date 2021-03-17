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
	'is_sortable'		=> true,
	'is_bulk_editable'	=> true,
);

$this->sql = array(
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

/* 
Usage:

		'title' => array(													//name - for reference
			'id'					=> 'title',								//id of the field
			'db_name'				=> 'title',								//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Titlu',								//name to appear on the left column
			'type' 					=> 'text',								//look for field types in cms/plugins

			'unique_in_db'			=> false,								//if field must be unique in db as value
			'unique_by_field'		=> ''									//field to check against
			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit
			'hidden_but_searchable' => true,								//if field is hidden but allow filter and search
			
			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules
			
			'tooltip'				=> 'Titlul inregistrarii',				//tooltip value
			'placeholder'			=> 'ex: Lorem ipsum',					//placeholder value
			'icon'					=> 'pencil',							//name of the icon
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
