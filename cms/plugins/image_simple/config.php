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

		'image' => array(													//name - for reference
			'id'					=> 'file',								//id of the field
			'db_name'				=> 'file',								//db name of the field
			'db_type'				=> 'varchar',							//field type in the db
			'name' 					=> 'Imagine',							//name to appear on the left column
			'type' 					=> 'image_simple',						//look for field types in cms/plugins

 			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

			'required' 				=> 0,									//number of min required images or false
			'accepted_ext' 			=> array('jpg', 'jpeg', 'png'),			//accepted extensions
			'use_random'			=> false								//if use 4 random characters at the end of the filename
			'folder'				=> '/path/to/folder/'					//if empty will put in uploads/files/[date - based on created]
			'use_ymd_folder'		=> true									//if arrange files in subfolders based on year, month and day
			'resize'				=> true,								//if the image is to be resized
			'sizes'					=> array(								//all the sizes, leave 'auto' on height or width to not crop the image
										'big' => array(
											'width' => 800,
											'height' => 'auto'
										),
										'large' => array(
											'width' => 660,
											'height' => 290
										),
										'medium' => array(
											'width' => 200,
											'height' => 150
										),
										'small' => array(
											'width' => 230,
											'height' => 90
										),
										'thumb' => array(
											'width' => 100,
											'height' => 60
										),
									),

			// 'watermark'				=> array(
			// 							'image' => '',						// full server path to image - use $_base_path.'...'
			// 							'poz_x' => '',						// can be px or %
			// 							'poz_y' => '',						// can be px or %
			// ),

			'tooltip'				=> 'Upload magine',						//tooltip value
			'icon'					=> 'image2',							//name of the icon

			'lng' 					=> array('ro')							//languages - array (ro, en, de...)

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
