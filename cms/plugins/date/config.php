<?php

$this->widgets = array(
	'add' => 'add.php',
	'edit' => 'edit.php',
	'validate' => 'validate.php'
);

$this->view_settings = array(
	'is_viewable'		=> true,
	'view_callback'		=> 'convert_sql_date_to_js',
	'is_searchable' 	=> false,
	'is_filtrable'		=> false,
	'is_sortable'		=> true,
	'is_bulk_editable'	=> true,


);

$this->sql = array(
	'ALTER TABLE #table# ADD `#field#` #type# NULL DEFAULT NULL'
);

if(!function_exists('convert_sql_date_to_js')){
	function convert_sql_date_to_js($date, $fld = false){
		global $_section, $field;

		if(!$fld){
			$fld = $field;
		}

		if(is_array($fld)){
			$to_format = $fld['js_format'];
		}else{
			$to_format = $_section['fields'][$fld]['js_format'];
		}

		return ($date != "" ? date(str_replace(array('mm', 'dd', 'yy'), array('m', 'd', 'Y'), $to_format), strtotime($date)) : "");
	}
}

/*
Usage:

		'date' => array(
			'id'					=> 'date',								//name - for reference
			'db_name'				=> 'date',								//id of the field
			'db_type'				=> 'date',								//db name of the field
			'name' 					=> 'Data',								//name to appear on the left column
			'type' 					=> 'date',								//look for field types in cms/plugins

			'js_format'				=> 'dd.mm.yy',							//js date format for showing
			'db_format'				=> 'Y-m-d',								//databse format to convert and save to

			'changeMonth'			=> 'false',								//allow change of month in the datepicker
			'changeYear'			=> 'false',								//allow change of year in the datepicker

			'required' 				=> true,								//if required
			'validation_rules' 		=> '',									//validation rules
			'do_not_edit'			=> false,								//if field is editable
			'hidden'				=> false,								//if field is shown on add and edit

			'tooltip'				=> 'Data - Format: zz.ll.aaaa',			//tooltip value
			'placeholder'			=> 'ex: 19.10.2012',					//placeholder value
			'icon'					=> 'dayCalendar',						//name of the icon

			'lng' 					=> array('ro'),							//languages - array (ro, en, de...)
			'value' 				=> date('d.m.Y')						//predefined value

			'show_if'				=> array(
										'id' => 'target_field_name',		//target id name
										'cmp' => '==', 						//takes ==, >, >=, <, <=, IN, NOT IN
										'value' => 'value of target field',	//target field value, can also be array (for IN, NOT IN)
									),
		),
*/
