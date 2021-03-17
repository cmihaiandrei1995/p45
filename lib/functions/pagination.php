<?php
/**
 * Prints the pagination
 */
function print_pagination(array $params = array()) {
    $pagination = generate_pagination($params);

	if(count($pagination)){
	    extract($pagination);

	    $total_links = 11;

	    $total_links = ($total_links > $page_count ? $page_count : $total_links);

	    $ceil = ceil($total_links/2);
	    $floor = floor($total_links/2);

	    $a = 0;
	    $z = $total_links - 1;
	    if($page_count <= $total_links){
	        $z = $page_count;
	    }else{
	        if(isset($current_page) && ($current_page > $ceil)){
	            $a = $current_page - $floor;
	            $z = $current_page + $floor - 1;
	        }
	        if(isset($current_page) && ($current_page > ($page_count - $ceil))){
	            $a = $page_count - $total_links;
	            $z = $page_count - 1;
	        }
	    }

	    if($page_count) {
		?>
	    <div class="pagination mt20 mb20">
	        <ul class="pages">
	            <?php foreach($left_nav_pages as $page) { ?>
	            <li><?=$page['active'] ? '<span>'.$page['title'].'</span>' : '<a href="'.$page['url'].(count($_GET) ? "?".http_build_query($_GET) : "").'">'.$page['title'].'</a>';?></li>
	            <?php } ?>

	            <?php for($i=$a; $i<=$z-1; $i++) { $page = $pages[$i]; ?>
	            <li><?=$page['active'] ? '<span>'.$page['title'].'</span>' : '<a href="'.$page['url'].(count($_GET) ? "?".http_build_query($_GET) : "").'">'.$page['title'].'</a>';?></li>
	            <?php } ?>

	            <?php foreach($right_nav_pages as $page) { ?>
	            <li><?=$page['active'] ? '<span>'.$page['title'].'</span>' : '<a href="'.$page['url'].(count($_GET) ? "?".http_build_query($_GET) : "").'">'.$page['title'].'</a>';?></li>
	            <?php } ?>
	        </ul>
	        <span class="page-no">Pagina <?=$current_page?> din <?=$page_count?></span>
	    </div>
		<?
	    }
    }
}

function generate_pagination(array $params = array()) {
    global $_page, $_params, $_config;

    $items_count            = $params['items_count'] ? $params['items_count'] : 0;
    $per_page               = $params['per_page'] ? $params['per_page'] : 8;
    $route                  = $params['route'] ? $params['route'] : $_page;
    $route_params           = $params['route_params'] ? $params['route_params'] : $_params;
    $page                   = intval($route_params['page'] ? $route_params['page'] : 1);
    $pages                  = $left_nav_pages = $right_nav_pages = array();

    $left_nav_icon_class    = $params['left_nav_icon_class'] ? '<i class=" ' . $params['left_nav_icon_class'] . '"></i>' : '<i class="icon pagination-larr zmdi zmdi-chevron-left"></i>';
    $right_nav_icon_class   = $params['right_nav_icon_class'] ? '<i class=" ' . $params['right_nav_icon_class'] . '"></i>' : '<i class="icon pagination-rarr zmdi zmdi-chevron-right"></i>';
    $first_nav_icon_class   = $params['first_nav_icon_class'] ? '<i class="icon pagination-dlarr"></i><i class="'. $params['first_nav_icon_class']. '"></i><i class="'. $params['first_nav_icon_class']. '"></i>' : '<i class="icon pagination-dlarr"></i><i class="zmdi zmdi-chevron-left"></i><i class="zmdi zmdi-chevron-left"></i>';
    $last_nav_icon_class    = $params['last_nav_icon_class'] ? '<i class="icon pagination-drarr"></i><i class="' . $params['last_nav_icon_class']. '"></i><i class="' . $params['last_nav_icon_class']. '"></i>' : '<i class="icon pagination-drarr"></i><i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-chevron-right"></i>';


    if($items_count<=$per_page) {
        return null;
    }

    $page_count = ceil($items_count/$per_page);

    if($page > 6) {
        $left_nav_pages[] = array(
            'url' => route_generate($route, array_merge($route_params, array('page' => ''))),
            'title' => $first_nav_icon_class,
            'active' => 0
        );
    }
    if($page > 1) {
        $left_nav_pages[] = array(
            'url' => route_generate($route, array_merge($route_params, array('page' => (($page-1)>1 ? $_config['paging']['page_link'].($page-1) : '')))),
            'title' => $left_nav_icon_class,
            'active' => 0
        );
    }

    $pages[] = array(
        'url' => route_generate($route, array_merge($route_params, array('page' => ''))),
        'title' => 1,
        'active' => ($page==1 || !$page ? 1 : 0)
    );

    foreach(range(2, $page_count) as $p) {
        $pages[] = array(
            'url' => route_generate($route, array_merge($route_params, array('page' => $_config['paging']['page_link'].$p))),
            'title' => $p,
            'active' => ($page==$p ? 1 : 0)
        );
    }

    if($page < $page_count) {
        $right_nav_pages[] = array(
            'url' => route_generate($route, array_merge($route_params, array('page' => (($page+1)<=$page_count ? $_config['paging']['page_link'].($page+1) : '')))),
            'title' => $right_nav_icon_class,
            'active' => 0
        );
    }
    if($page < $page_count-6) {
        $right_nav_pages[] = array(
            'url' => route_generate($route, array_merge($route_params, array('page' => $_config['paging']['page_link'].$page_count))),
            'title' => $last_nav_icon_class,
            'active' => 0
        );
    }

    return array(
        'left_nav_pages' => $left_nav_pages,
        'pages' => $pages,
        'right_nav_pages' => $right_nav_pages,
        'current_page' => $page,
        'page_count' => $page_count,
    );
}
