<?
$_use_routes = false;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../config.php';

$_day = intval($_GET['day']);
$_duration = intval($_GET['duration']);

$_city_from = get_city_by_id(intval($_GET['id_city_from']));
$_item = get_hotel_by_id(intval($_GET['id_hotel']));

if($_GET['type'] == "zone"){
    $_is_zone = true;
    $_zone = get_zone_by_id(intval($_GET['location-id']));
}else{
    $_is_city = true;
    $_city = get_city_by_id(intval($_GET['location-id']));
}

$_item = hotel_prepare_charter_info($_item, ($_is_zone ? $_zone : $_city), $_city_from);

if($_GET['action'] == 'duration'){

    foreach($_item['periods'] as $period){
        $dayofweek = date('N', strtotime($period['date_from']));
        if($dayofweek == $_day){
            if($period['nr_nights'] == 7 || $period['nr_nights'] == 9 || $period['nr_nights'] == 14){
                if(!in_array($period['nr_nights'], $days_total)){
                    $days_total[] = $period['nr_nights'];
                }
            }
        }
    }

    sort($days_total);
    foreach($days_total as $day){
        $response[] = array(
            'id' => $day,
            'text' => $day." nopti",
        );
    }

}elseif($_GET['action'] == "chart"){

    foreach($_item['periods'] as $period){
        $dayofweek = date('N', strtotime($period['date_from']));
        if($dayofweek == $_day){
            if($period['nr_nights'] == $_duration){
                $periods[] = $period;
            }
        }
    }

    $min = 99999;
    $max = 0;
    foreach($periods as $period){
        if($period['price'] > $max) $max = $period['price'];
        if($period['price'] < $min) $min = $period['price'];
    }

    foreach($periods as $period){
        if($period['price'] == $min){
            $percent = 20;
            $color = "green";
        }elseif($period['price'] == $max){
            $percent = 100;
            $color = "blue";
        }else{
            $percent = 20 + intval( ($period['price']-$min) * 80 / ($max-$min) );
            $color = "blue";
        }

        $charter_price_list[] = array(
            'title' => 'Perioada '.date("d.m.Y", strtotime($period['date_from']))." - ".date("d.m.Y", strtotime($period['date_to'])),
            'month' => $_months_small[date("n", strtotime($period['date_from']))],
            'day' => date("d", strtotime($period['date_from'])),
            'price' => intval($period['price']).'&euro;',
            'price_old' => $period['priceNoRedd'] != "" ? intval($period['priceNoRedd']).'&euro;' : "",
            'price_class' => $color,
            'percentage' => $percent,
            'promo_text' => $period['description'],
            'black_friday' => $period['black_friday'],
            'date_from' => date("d.m.Y", strtotime($period['date_from'])),
            'date_to' => date("d.m.Y", strtotime($period['date_to'])),
        );
    }

    $json = array();
    $content = '';

    foreach($charter_price_list as $key => $price_item) {
        $content = '<div class="swiper-slide">
            <div class="price-bar-trigger price-item '. $price_item['price_class'].'" data-percentage="'. $price_item['percentage'].'" data-month="'. $price_item['month'].'" data-day="'. $price_item['day'].'" data-from="'. $price_item['date_from'].'" data-to="'. $price_item['date_to'].'">
                <div class="price-item-column-wrapper" data-black-friday="'.($price_item['black_friday'] ? '1' : '0').'">
                    <div class="price-item-column" '.($price_item['black_friday'] ? 'style="background-color:rgba(0,0,0,0.5);"' : '').'>
                    </div>
                </div>
                <div class="price-item-date">
                    <div class="price-item-day">'. $price_item['day'].'</div>
                    <div class="price-item-month">'. $price_item['month'].'</div>
                </div>
                <div class="price-item-separator"></div>
                <div class="price-item-tooltip">
                    <div class="title">' . $price_item['title'] .'</div>
                    <div class="sub">de la ' . ($price_item['price_old'] != "" ? "<del>".$price_item['price_old']."</del>" : "") .' <strong>' . $price_item['price'] .'</strong> <span class="no-resp">/persoana/pachet</span></div>
                    <div class="promo">' . $price_item['promo_text'] .'</div>
                </div>
            </div>
        </div>';

        $json[] = array(
            'slide' => $content
        );
    }

    $response = $json;

}


echo json_encode($response);

// Close the conn
$_db->close();
