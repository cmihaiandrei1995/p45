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
	'ALTER TABLE #table# ADD #field#_x #type# NULL DEFAULT NULL',
	'ALTER TABLE #table# ADD #field#_y #type# NULL DEFAULT NULL',
	'ALTER TABLE #table# ADD #field#_z int(11) NULL DEFAULT NULL'
);

/*
Usage:

		'map' => array(														//name - for reference
			'id'					=> 'map',								//id of the field
			'db_name'				=> 'map',								//db name of the field
			'db_fields'				=> array('map_x', 'map_y', 'map_z'),	//all names of the fields if it uses more than 1
			'db_type'				=> 'double',							//field type in the db
			'name' 					=> 'Harta',								//name to appear on the left column
			'type' 					=> 'map_xyz',							//look for field types in cms/plugins

			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules

 			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

			'tooltip'				=> 'Pozitionare harta',					//tooltip value
			'icon'					=> 'map',								//name of the icon

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
