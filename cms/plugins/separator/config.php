<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
);

$this->view_settings = array(
	'is_viewable'		=> false,
	'is_searchable' 	=> false,
	'is_filtrable'		=> false,
	'is_sortable'		=> false,
	'is_bulk_editable'	=> false,
);

/* 
Usage:

		'separator' => array(												//name - for reference
			'id'					=> 'separator',							//id of the field
			'name' 					=> 'Titlu',								//name to appear on the left column
			'type' 					=> 'separator',							//look for field types in cms/plugins
			'do_not_edit'			=> true,								//if field is editable
		),
*/