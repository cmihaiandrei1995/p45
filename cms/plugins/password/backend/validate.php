<?php
if(!$field['do_not_edit']){
	foreach($field['lng'] as $lng){
		$_rules[$field['id'].'_'.$lng] = 'trim|md5';

		if($field['required'] && $_action == "add"){
			$_rules[$field['id'].'_'.$lng] .= '|required';
		}
		if($field['validation_rules']){
			$_rules[$field['id'].'_'.$lng] .= '|'.$field['validation_rules'];
		}
	}
}

if(isset($field['show_if'])) {
    $si_rules = $field['show_if'];
    if(!empty($si_rules['id']) && !empty($si_rules)) {
        $si_rules = array( $si_rules );
    }
    foreach($si_rules as $i => $rule){
        if(!empty($rule['id']) && !empty($rule)) {
            $si_rules[$i] = array( $rule );
        }
    }

    foreach($field['lng'] as $lng){
        $show = false;
        $show_arr = array();
        $subshow_arr = array();
        
        foreach($si_rules as $i => $item) {
            $show_arr[$i] = true;
            foreach($item as $k => $subitem) {
                $subshow_arr[$i][$k] = true;
                switch($subitem['cmp']) {
                    case 'IN':
                        if(!in_array($_POST[$subitem['id'].'_'.$lng], (array)$subitem['value'])) {
                            $subshow_arr[$i][$k] = false;
                        }
                        break;
                    case 'NOT IN':
                    case 'NOTIN':
                        if(in_array($_POST[$subitem['id'].'_'.$lng], (array)$subitem['value'])) {
                            $subshow_arr[$i][$k] = false;
                        }
                        break;
                    default:
                        $subshow_arr[$i][$k] = version_compare($_POST[$subitem['id'].'_'.$lng], $subitem['value'], $subitem['cmp']);
                        break;
                }
            }
            foreach($subshow_arr[$i] as $arr){
                $show_arr[$i] = $show_arr[$i] && $arr;
            }
        }

        foreach($show_arr as $arr){
            $show = $show || $arr;
        }
        if(!$show) {
            $_rules[$field['id'].'_'.$lng] = 'trim';
            $_POST[$field['id'].'_'.$lng] = '';
        }
    }
}
