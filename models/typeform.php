<?php

function typeform_get_forms(){

    $forms = typeform_execute('forms');

    $items = $forms['items'];

    if($forms['page_count'] > 1){
        for($i=2; $i<=$forms['page_count']; $i++){
            $forms = typeform_execute('forms?page='.$i);
            foreach($forms['items'] as $item){
                $items[] = $item;
            }
        }
    }

    return $items;
}




function typeform_get_form($id){

    $form = typeform_execute('forms/'.$id);

    return $form;
}





function typeform_get_responses($id, $since = ""){

    $since_req = "";
    if($since != ""){
        $since_req = 'since='.gmdate('Y-m-d\TH:i:s\Z', strtotime($since));
    }
    $responses = typeform_execute('forms/'.$id.'/responses?'.$since_req);

    // print_r($responses);

    $items = $responses['items'];

    if($responses['page_count'] > 1){
        for($i=2; $i<=$responses['page_count']; $i++){
            $responses = typeform_execute('forms/'.$id.'/responses?'.$since_req.'&page='.$i);
            foreach($responses['items'] as $item){
                $items[] = $item;
            }
        }
    }

    return $items;
}







function typeform_execute($path, $params = array()){
    global $_config;

    $api_uri = 'https://api.typeform.com/';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_uri.$path);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        'Authorization: Bearer '.$_config['typeform']['token'],
        'Accept: application/json',
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);

    return json_decode($server_output, true);
}
