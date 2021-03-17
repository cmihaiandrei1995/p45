<?php
/*
Available params

- limit : int - used in limit sql query, if not present selects all records
- offset : int - default 0, used with 'limit'
- order : text - order by query (direct sql)
- status : db_is_active() - by default check config cms for active, trash, etc
- id : int - select default id value
- images : boolean - default false - calls get_images() for cuurent table
- details :
- query :
	1. string - run you own sql
	2. array {
		'key' => 'db_field',
		'compare' => 'sql_operator' // or, and, between, in, no in, etc...
		'value' => 'string, int, array'
	}
	3. multiple array like 2. but with "relation" key - AND / OR etc...
- select : array {
	'db_field or alias' => 'as field name / alias'
}
- groupby :
- join : array{
	'table_to_join_with',
	'id_to_join',
	true / false   // if you need group by
} // multiple join in multidimensional array
- extra_where : text - your special query
*/

function get_posts() {
    global $_config, $_lang, $_website_langs;

    $argv = func_get_args();
    $argc = func_num_args();
	
    if($argc == 1 && is_array($argv[0])) {
        $params = $argv[0];

        $offset = 0;
        $limit = $_config['paging']['ipp']['default'] ? : "";

        $table = $params['table'] ? : err('Missing table param');
        $debug = $params['debug'] ? : false;
		$id = 'id_'.$table;

        $select = $table.'.*';
		$select_count = 'COUNT(*) AS nr';
        $where = $join = $order = $group = '';
		$group_by = array();
        $status = db_is_active('', $table);
		if($status != '') $status = ' AND '.$status;

        unset($params['table'], $params['debug']);

        // set lang parameter to default if none provided
        if (!array_key_exists('lang', $params)) {
            $params['lang'] = $_lang;
        }
		
		// detect if section uses seo
		foreach($_config['cms'] as $key => $val){
	        if($val['table'] == $table){
	            $cms_section = $key;
	            break;
	        }
	    }
		$_section = $_config['cms'][$cms_section];
		
		// detect if section uses any multilanguage field
		$multilang_fields = false;
		foreach ($_config['cms'] as $key => $section) {
            if ($section['table'] == $table) {
                foreach ($section['fields'] as $key => $field) {
                    if (count($field['lng']) > 1) {
                        $multilang_fields = true;
						break;
                    }
                }
            }
        }
		
        foreach($params as $key => $value) {
            if($key == 'limit') {

                $limit = $value;

            } elseif($key == 'offset') {

                $offset = $value;

            } elseif($key == 'order') {

                // wrap `order` field so it doesn't cause an sql error
                $value = preg_replace('/(?<!`)order(?!`)/', '`order`', $value);

                $order = 'ORDER BY '. $value;

            } elseif($key == 'status') {

                $status = $value;

            } elseif($key == 'id') {

                $where .= ' AND '.$table.'.'.$id.' = "'.$value.'"';

            } elseif($key == 'images'){

                $get_images = true;

            } elseif($key == 'details'){

                $get_details = $value;

			} elseif($key == 'query'){

				if(is_string($value)) {
                    parse_str($value, $queries);
                    $queries = array($queries);
                } elseif(isset($value['key'])) {
                    $queries = array($value);
                } else {
                    $queries = $value;
                }

				if(count($queries) && $queries != ""){
	                foreach($queries as $query) {
	                	if(count($query) && $query != ""){
							if($query['relation'] != ""){
								$relation = $query['relation'];
								$where .= ' AND ( '.($query['relation'] == "OR" ? 0 : 1).' ';

								unset($query['relation']);
								foreach($query as $k => $q){
									$where .= get_where_query($q, $relation);
								}

								$where .= ' ) ';
							}else{
			                	$where .= get_where_query($query);
		                    }
						}
					}
				}

            } elseif ($key == 'select'){

            	$select_q = array();
				if(count($value)){
	            	foreach($value as $k => $v){
	            		if($k == "*" || $v == "*"){
	            			$select_q[] = $table.'.*';
	            		}else{
		            		if($v != ""){
		            			$select_q[] = $k.' AS '. $v;
								$select_count_q[] = $k.' AS '. $v;
							}else{
								$select_q[] = $v;
								$select_count_q[] = $v;
							}
						}
					}
					if(count($select_q)){
						$select = implode(", ", $select_q);
					}
					if(count($select_count_q)){
						$select_count .= ", ".implode(", ", $select_count_q);
					}
				}

			} elseif($key == 'groupby'){

				$group_by[] = $value;

			} elseif($key == 'join'){

				if(is_array($value)){
					if(!is_array($value[0])){
						$value = array($value);
					}
					foreach($value as $v){
						if($v[0] != ""){
							$join_table = $v[0];
							$join_id = $v[1];
							$tmp_join = explode("=", $join_id);
							if(count($tmp_join) > 1){
								$join .= ' JOIN '.$join_table.' ON ('.$table.'.'.$tmp_join[0].' = '.$join_table.'.'.$tmp_join[1].')';
								if($v[2]){
									$group_by[] = $join_table.'.'.$tmp_join[1];
								}
							}else{
								$join .= ' JOIN '.$join_table.' USING ('.$join_id.')';
								if($v[2]){
									$group_by[] = $join_table.'.'.$join_id;
								}
							}
						}
					}
				}else{
					$join .= ' '.$value.' ';
				}

			} elseif ($key == 'extra_where'){

				if(is_array($value)){
					$where .= implode(' ', $value);
				}else{
					$where .= ' '.$value;
				}

			} elseif ($key == 'having'){

				$having = ' HAVING '.$value.' ';

            } elseif ($key == 'lang'){

                if (in_array($value, array_keys($_website_langs))) {

                    foreach ($_config['cms'] as $key => $section) {
                        if ($section['table'] == $table) {
                            foreach ($section['fields'] as $key => $field) {
                                if (count($field['lng']) > 1) {
                                    $select .= ', '.$table.'_lng.'.$field['db_name'];
                                }
                            }
                        }
                    }

                    if ($multilang_fields) {
                        $join .= ' JOIN '.$table.'_lng USING (id_'.$table.')';
                        $where .= ' AND '.$table.'_lng.lng = "'.$value.'"';
                    }
                }

            } else {

            	if(stripos($key, '.') !== false){

	                list($join_table, $field) = explode('.', $key);
					if($join_table != $table){
		                $join_id = 'id_'.$join_table;
		                $join .= ' JOIN '.$join_table.' USING('.$join_id.')';
		                if(is_array($value)) {
		                    $where .= ' AND '.$join_table.'.'.$key.' IN ("'.implode('","', $value).'")';
		                } else {
		                    $where .= ' AND '.$join_table.'.'.$field.' = "'.$value.'"';
		                }
					}else{
		                if(is_array($value)) {
		                    $where .= ' AND '.$key.' IN ("'.implode('","', $value).'")';
		                } else {
		                    $where .= ' AND '.$key.' = "'.$value.'"';
		                }
					}

				}else{

					if(strpos($key, "`") === false) {
						$key = "`".$key."`";
					}
	                if(is_array($value)) {
	                    $where .= ' AND '.$table.'.'.$key.' IN ("'.implode('","', $value).'")';
	                } else {
	                    $where .= ' AND '.$table.'.'.$key.' = "'.$value.'"';
	                }

				}

            }
        }

		if(count($group_by)){
			$group = 'GROUP BY '.implode(',', $group_by);
		}

		if($order == ''){
			$order = 'ORDER BY ';

            $order_added = false;

			foreach($_config['cms'] as $key => $section) {
            	if($section['table'] == $table) {
            		if($section['use_order']){
            			$order .= ' '.$table.'.`order` ASC, ';
                        $order_added = true;
            		}
					break;
				}
			}

            if(!$order_added){
                if($_config['db_tables']){
                    if($_config['db_tables'][$table]){
                        if(in_array('order', $_config['db_tables'][$table])){
                            $order .= ' '.$table.'.`order` ASC, ';
                            $order_added = true;
                        }
                    }
                }
            }

			$order .= $table.'.'.$id.' DESC';
		}
		
		// add seo fields in case the section has multilanguage
		if($_section['use_seo'] && $multilang_fields){
			$select .= ', '.$table.'_lng.seo_title, '.$table.'_lng.seo_description, '.$table.'_lng.seo_keywords';
		}

        if($debug) {
            ld('
                SELECT '.$select.'
                FROM '.$table.'
                '.$join.'
                WHERE 1 '.$status.' '.$where.'
                '.$group.'
                '.$having.'
                '.$order.'
                '.($limit>0 ? 'LIMIT '.$offset.', '.$limit : '').'
            ');
        }

        $items = db_query('
            SELECT '.$select.'
            FROM '.$table.'
            '.$join.'
            WHERE 1 '.$status.' '.$where.'
            '.$group.'
            '.$having.'
            '.$order.'
            '.($limit>0 ? 'LIMIT '.$offset.', '.$limit : '').'
        ');

        if($items && ($get_details || $get_images)){
        	foreach($items as $i => &$item) {
	            if($get_images) {
	                $item['images'] = get_images($table, $item[$id]);
	            }
	            if($get_details) {
	                if(!is_array($get_details)) {
	                    $get_details = array($get_details);
	                }
	                foreach($get_details as $d) {
	                    if(is_array($d) && count($d) == 2) {
	                        $detail_id = $d[0];
	                        $detail_table = $d[1];
	                    } elseif(stripos($d, 'id_') !== false) {
	                        $detail_id = $d;
	                        $detail_table = str_replace('id_', '', $detail_id);
	                    } else {
	                        $detail_id = 'id_'.$d;
	                        $detail_table = $d;
	                    }
	                    $item[$detail_table] = db_row('SELECT * FROM '.$detail_table.' WHERE '.$detail_id.' = ?', $item[$detail_id]);
	                    unset($items[$i][$detail_id]);
	                }
	            }
	            unset($item);
	        }
	    }

        if($limit > 0){
        	$count_query = '
                SELECT '.$select_count.'
	            FROM '.$table.'
	            '.$join.'
	            WHERE 1 '.$status.' '.$where.'
	            '.$group.'
	            '.$having.'
            ';

			if($having != ""){
				$count_query = 'SELECT COUNT(*) AS nr FROM ('.$count_query.') AS tbl';
			}

        	if($debug) {
	            ld($count_query);
	        }

	        $count = db_query($count_query);
			if(count($count) > 1){
				$counter = count($count);
			}else{
				$counter = $count[0]['nr'];
			}
		}else{
			$counter = count($items);
		}

        return array($items, $counter);
    }
}

function get_post() {
    $argv = func_get_args();
    $argc = func_num_args();

    if($argc == 1 && is_array($argv[0])) {
        $params = $argv[0];
        $params['limit'] = 1;
        list($items, $count) = get_posts($params);
    } elseif($argc == 2) {
        $params = array(
            'limit' => 1,
            'table' => $argv[0],
            'id' => $argv[1],
        );
        list($items, $count) = get_posts($params);
    }
    return $items[0];
}


function get_where_query($query, $operator = 'AND'){
	$where = '';

	if(is_array($query['value']) && in_array(strtoupper($query['compare']), array('IN', 'NOT IN'))) {
        $where .= ' '.$operator.' '.$query['key'].' '.$query['compare'].' ("'.implode('","', $query['value']).'")';
    } elseif(is_array($query['value']) && in_array(strtoupper($query['compare']), array('BETWEEN'))) {
        $where .= ' '.$operator.' '.$query['key'].' '.$query['compare'].' "'.$query['value'][0].'" AND "'.$query['value'][1].'"';
	} elseif(in_array(strtoupper($query['compare']), array('IS NULL', 'IS NOT NULL'))) {
		$where .= ' '.$operator.' '.$query['key'].' '.$query['compare'];
    } elseif (stripos($query['value'], 'select') !== false) {
    	$where .= ' '.$operator.' '.$query['key'].' '.$query['compare'].' '.$query['value'];
	} else {
        $where .= ' '.$operator.' '.$query['key'].' '.$query['compare'].' "'.$query['value'].'"';
    }

	return $where;
}
