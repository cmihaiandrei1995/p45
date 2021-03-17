<?
/**
 * Takes out seo info from the database, if not found, inserts it.
 */
function get_seo($section){
	global $_website_langs, $_lang, $_config;
	
	if(count($_website_langs) > 1){
		$seo = db_query('
			SELECT seo.*, seo_lng.*
	        FROM seo
	        LEFT JOIN seo_lng ON (seo.id_seo = seo_lng.id_seo)
	        WHERE '.
	        	(count($_config['cms']['seo']['fields']['title']['lng']) > 1 ? 'seo_lng.title LIKE "'.$section.'_%"' : 'seo.title LIKE "'.$section.'_%"').
	        	'AND seo_lng.lng = "'.$_lang.'"'
		);
	}else{
		$seo = db_query('
			SELECT * FROM seo 
			WHERE title LIKE "'.$section.'_%"'
		);
	}
	
	if(!$seo){
		if(count($_website_langs) > 1){
			$id_seo = db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_title');
			foreach($_website_langs as $key => $val){
				db_query("INSERT INTO seo_lng (`id_seo`, `lng`) VALUES (?, ?)", $id_seo, $key);
			}
			
			$id_seo = db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_description');
			foreach($_website_langs as $key => $val){
				db_query("INSERT INTO seo_lng (`id_seo`, `lng`) VALUES (?, ?)", $id_seo, $key);
			}
			
			$id_seo = db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_keywords');
			foreach($_website_langs as $key => $val){
				db_query("INSERT INTO seo_lng (`id_seo`, `lng`) VALUES (?, ?)", $id_seo, $key);
			}
		}else{
			db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_title');
			db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_description');
			db_query("INSERT INTO seo (`title`, `created`) VALUES (?, NOW())", $section.'_keywords');
		}
		return array();
	}else{
		foreach($seo as $item){
			if($item['title'] == $section.'_title'){
				$return['title'] = $item['value'];
			}
			if($item['title'] == $section.'_description'){
				$return['description'] = $item['value'];
			}
			if($item['title'] == $section.'_keywords'){
				$return['keywords'] = $item['value'];
			}
		}
		return $return;
	}
}