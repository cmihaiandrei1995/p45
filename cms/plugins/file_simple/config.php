<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'delete' => 'delete.php',
	'validate' => 'validate.php',
	'view' => 'view.php'
);

$this->view_settings = array(
	'is_viewable'		=> true,
	'is_searchable' 	=> false,
	'is_filtrable'		=> false,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> false,
);

$this->sql = array(
	'ALTER TABLE #table# ADD #field# #type# NULL DEFAULT NULL',
	'ALTER TABLE #table# ADD #field#_path #type# NULL DEFAULT NULL'
);

/*
Usage:

		'file' => array(													//name - for reference
			'id'					=> 'file',								//id of the field
			'db_name'				=> 'file',								//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Fisier',							//name to appear on the left column
			'type' 					=> 'file_simple',						//look for field types in cms/plugins

			'required' 				=> true,								//if required
			'accepted_ext' 			=> array('doc', 'pdf', 'xls'),			//accepted extensions
			'use_random'			=> false								//if use 4 random characters at the end of the filename
			'folder'				=> '/path/to/folder/'					//if empty will put in uploads/files/[date - based on created]
			'use_ymd_folder'		=> true									//if arrange files in subfolders based on year, month and day

  			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

 			'tooltip'				=> 'Upload fisier',						//tooltip value
			'icon'					=> 'file',								//name of the icon

			'lng' 					=> array('ro')							//languages - array (ro, en, de...)

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
