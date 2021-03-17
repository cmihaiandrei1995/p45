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
	'CREATE TABLE IF NOT EXISTS #table#_file (
		`id_file` int(11) NOT NULL AUTO_INCREMENT,
		`#id#` int(11) NOT NULL DEFAULT "0",
		#lng#
		`file` varchar(255) NOT NULL,
		`folder` varchar(255) NOT NULL,
		`active` int(11) NOT NULL DEFAULT "1",
		`order` int(11) NOT NULL DEFAULT "1",
		PRIMARY KEY (`id_file`),
		KEY `#id#` (`#id#`)
	) ENGINE = MyISAM DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1'
);

/*
Usage:

		'file' => array(													//name - for reference
			'id'					=> 'file',								//id of the field
			'name' 					=> 'Fisier',							//name to appear on the left column
			'type' 					=> 'file',								//look for field types in cms/plugins
			'nr'					=> 10,									//number of fields
			'use_other_table'		=> '#table#_file',

			'required' 				=> 0,									//number of min required images or false
			'accepted_ext' 			=> array('doc', 'pdf', 'xls'),			//accepted extensions

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
