<?
if(!$field['use_ajax'] || $_is_ajax){
	
	$add_where = $order_by = "";
	
	if(count($field['add_info'])){
		$fields = $joins = array();
		foreach($field['add_info'] as $k => $info){
			if($info['table'] != ""){
				$joins[] = ' LEFT JOIN '.$info['table'].' AS tbl'.$k.' ON ('.$field['from_table'].'.'.$info['id'].' = tbl'.$k.'.'.$info['id'].')';
				$fields[] = 'tbl'.$k.($info['multilang'] ? '_lng' : '').'.'.$info['field'].' AS field'.($k+1);
			}else{
				$fields[] = ($info['multilang'] ? $field['from_table'].'_lng.' : '').$info['field'].' AS field'.($k+1);
			}
			
			if($info['multilang']){
				$joins[] = ' LEFT JOIN '.$info['table'].'_lng AS tbl'.$k.'_lng ON (tbl'.$k.'.'.$info['id'].' = tbl'.$k.'_lng.'.$info['id'].')';
				$add_where .= ' AND tbl'.$k.'_lng.lng = "'.$_lang_cms_rec.'"';
			}
		}
	}
	
	if($field['from_multilang']){
		$fields[] = $field['from_table'].'_lng.'.$field['from_field'];
	}
	
	if(count($_filter_where)){
		foreach($_filter_where as $_where){
			if($_where['operator'] == "like"){
				$add_where .= ' AND '.$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$_where['field'].' LIKE "%'.$_where['query'].'%"';
				$order_by .= ' (CASE WHEN '.$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$_where['field'].' = "'.$_where['query'].'" THEN 0
					               WHEN '.$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$_where['field'].' like "'.$_where['query'].'%" THEN 1
					               WHEN '.$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$_where['field'].' like "% %'.$_where['query'].'% %" THEN 2
					               WHEN '.$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$_where['field'].' like "%'.$_where['query'].'" THEN 3
					               ELSE 4
					          END), ';
			}
			if($_where['operator'] == "in" && $_where['query'] != ""){
				$add_where .= " AND ".$field['from_table'].'.'.$_where['field'].' IN ('.$_where['query'].')';
			}
		}
	}

	if($field['use_parent']){
		$this->values = select_db_format_records_with_parents($fields, $field, $joins, $order_by, 0);
	}else{
		$this->values = db_query('
			SELECT '.$field['from_table'].'.* '.
				(count($fields) ? ', '.implode(', ', $fields).' ' : '').	
			'FROM '.$field['from_table'].
				($field['from_multilang'] ? ' JOIN '.$field['from_table'].'_lng USING ('.$field['from_id'].')' : '').' '.
				(count($joins) ? implode(' ', $joins) : '').' '.
			'WHERE 1 '.
				$add_where.
				($field['from_where'] ? $field['from_where'] : '').
				($field['from_multilang'] ? ' AND '.$field['from_table'].'_lng.lng = "'.$_lang_cms_rec.'"' : '').' '.
			'ORDER BY '.
			$order_by.
			$field['from_table'].($field['from_multilang'] ? '_lng' : '').'.'.$field['from_order_by'].' '.$field['from_order_how']
		);
	}
}

