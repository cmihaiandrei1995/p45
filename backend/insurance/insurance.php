<?

$_scopes = array(
    0 => 'Turism',
    1 => 'Studii',
    2 => 'Munca'
);

list($_counties, $count) = get_posts(array(
    'table' => 'city_insurance_county',
    'order' => 'title ASC'
));

$_genders = [
    'male' => 'Masculin',
    'female' => 'Feminin',
];

list($destinations, $count) = get_posts(array(
    'table' => 'city_insurance_country',
    'order' => 'title ASC'
));
foreach($destinations as $destination){
    if($destination['is_paralela'] == 1){
        $_destinations_paralela[] = array(
            'id' => $destination['id_city_insurance_country'],
            'title' => ucwords(strtolower($destination['title']))
        );
    }else{
        $_destinations_all[] = array(
            'id' => $destination['id_city_insurance_country'],
            'title' => ucwords(strtolower($destination['title']))
        );
    }
}


list($destinations_ue, $count) = get_posts(array(
    'table' => 'city_insurance_country',
    'order' => 'title ASC',
    'is_ue' => 1
));


if(isset($_POST['search'])) {

    $_rules['start_date'] = 'trim|required';
    $_rules['end_date'] = 'trim|required';
    //$_rules['name'] = 'trim|required|alphanumeric|minlength-3';
    //$_rules['email'] = 'trim|required|email';
    //$_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-13';
    $_rules['destination'] = 'trim|required';
    $_rules['scope'] = 'trim|required';
    //$_rules['gdpr'] = 'trim|required';

    // $custom_messages = array(
    //     'gdpr' => array(
    //         'required' => 'Trebuie sa fii de acord cu aceasta clauza'
    //     )
    // );

    $_form = new Validate($_rules, 'post', $custom_messages);
    $_valid = $_form->check();
    foreach($_rules as $key => $val){
        if($_form->error($key) != ""){
            $_errors[$key] = $_form->error($key);
        }
    }

    $o_rules['firstname'] = 'trim|required';
    $o_rules['lastname'] = 'trim|required';
    $o_rules['gender'] = 'trim|required|in-'.implode('-', array_keys($_genders));
    $o_rules['dob_day'] = 'trim|required';
    $o_rules['dob_month'] = 'trim|required';
    $o_rules['dob_year'] = 'trim|required';
    $o_rules['dob'] = 'trim|required';
    $o_rules['cnp'] = 'trim|required|cnp';
    $o_rules['ci'] = 'trim';
    $o_rules['county'] = 'trim|required';
    $o_rules['city'] = 'trim|required';
    $o_rules['address'] = 'trim|required';
    $o_rules['foreign'] = 'trim';
    $o_rules['country'] = 'trim';

    $o_rules['zapada'] = 'trim';
    $o_rules['nautic'] = 'trim';
    $o_rules['aero'] = 'trim';
    $o_rules['terestru'] = 'trim';
    $o_rules['roti'] = 'trim';
    $o_rules['triatlon'] = 'trim';

    foreach($_POST['insurants'] as $i => $o) {

        if($o['foreign'] == 1){

            $o_rules['country'] = 'trim|required';
            $o_rules['cnp'] = 'trim';
            $o_rules['gender'] = 'trim';

            $insurant_data = extractDataFromDate($o['dob']);

            if($insurant_data){
                $o['dob_day'] = $insurant_data['day'];
                $o['dob_month'] = $insurant_data['month'];
                $o['dob_year'] = $insurant_data['year'];
                $o['dob'] = $insurant_data['dob'];
                $o['age'] = $insurant_data['age'];
            }

        }else{

            $o_rules['country'] = 'trim';

            if(validCNP($o['cnp'])){
                $insurant_data = extractDataFromCNP($o['cnp']);

                if($insurant_data){
                    $o['dob_day'] = $insurant_data['day'];
                    $o['dob_month'] = $insurant_data['month'];
                    $o['dob_year'] = $insurant_data['year'];
                    $o['dob'] = $insurant_data['dob'];
                    $o['age'] = $insurant_data['age'];
                    $o['gender'] = $insurant_data['gender'] == 'm' ? 'male' : 'female';
                }
            }

        }

        $o_form = new Validate($o_rules, $o);
        $o_valid = $o_form->check();

        foreach($o_rules as $key => $val){
            if($o_form->error($key) != ""){
                $_errors['insurants'.$i.$key] = $o_form->error($key);
            }
        }

        if($o['age'] > 70){
            $o_valid = false;
            $_errors['insurants'.$i.'age'] = "Varsta maxima pentru asigurat este de 70 ani.";
        }

        if($o['age'] != ""){
            if($o['age'] >= 18) $adults++;
            else $children++;
        }

        $_valid = $_valid && $o_valid;

    }

    foreach($_POST['insurants'] as $i => $o) {

        if($o['foreign'] == 1){
            if(strtotime($_form['end_date']) - strtotime($_form['start_date']) > 119*24*60*60){ // 120 zile daca e strain
                $_valid = false;
                $_errors['end_date'] = "Pentru cetateni straini nu se pot emite polite pe o perioada mai mare de 120 de zile.";
            }

            if($_form['destination'] == $o['country']){
                $_valid = false;
                $_errors['insurants'.$i.'country'] = "Asigurarea nu valideaza pe teritoriul tarii de domiciliu sau a tarii de resedinta.";
            }
        }

    }


    if($children > 0 && !$adults){
        $_valid = false;
        $_errors['insurants0firstname'] = "Nu se pot emite asigurari numai pentru minori.";
    }

    if(strtotime($_form['start_date']) > strtotime($_form['end_date'])){
        $_valid = false;
        $_errors['start_date'] = "Data de inceput nu poate fi mai mare decat data de sfarsit.";
    }

    if(strtotime($_form['end_date']) - strtotime($_form['start_date']) > 365*24*60*60){ // 1 an
        $_valid = false;
        $_errors['end_date'] = "Intervalul asigurarii nu poate depasi 1 an.";
    }

    if(strtotime($_form['start_date']) - time() > 365*24*60*60){ // 1 an
        $_valid = false;
        $_errors['start_date'] = "Data calatoriei nu poate fi la un intervalmai mare de 1 an de data emiterii.";
    }

    if($_valid) {

        $data = $_POST;

        $data['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
        $data['end_date'] = date('Y-m-d', strtotime($_POST['end_date']));

        foreach($data['insurants'] as &$o) {

            if($o['foreign'] == 1){
                $insurant_data = extractDataFromDate($o['dob']);

                if($insurant_data){
                    $o['dob_day'] = $insurant_data['day'];
                    $o['dob_month'] = $insurant_data['month'];
                    $o['dob_year'] = $insurant_data['year'];
                    $o['dob'] = $insurant_data['dob'];
                    $o['age'] = $insurant_data['age'];
                }
            }else{
                $insurant_data = extractDataFromCNP($o['cnp']);

                if($insurant_data){
                    $o['dob_day'] = $insurant_data['day'];
                    $o['dob_month'] = $insurant_data['month'];
                    $o['dob_year'] = $insurant_data['year'];
                    $o['dob'] = $insurant_data['dob'];
                    $o['age'] = $insurant_data['age'];
                    $o['gender'] = $insurant_data['gender'] == 'm' ? 'male' : 'female';
                }
            }

            $o['is_extreme'] = false;
            if($o['zapada'] || $o['nautic'] || $o['aero'] || $o['terestru'] || $o['roti'] || $o['triatlon']){
                $o['is_extreme'] = true;
            }

            unset($o);
        }

        $destination = city_insurance_get_country_by_id($data['destination']);
        $data['country'] = $destination['title'];

        $data['nights'] = days_between_dates($data['end_date'], $data['start_date']);

        // print_r($_POST);
        // print_r($data);
        // exit;

        $_SESSION['insurance_booking'] = json_encode($data);

        $result = city_insurance_get_quote($data, false);

        $error = false;
        if($result){
            foreach($result as $i => $items){
                foreach($items as $item){
                    if($item['quote']['error']){
                        $error = true;
                        $error_quotes[$i] = $item['quote']['message'];
                    }
                }
            }

            if(!$error){
                foreach($result as $k => &$items){
                    usort($items, function($a, $b){
                        if($a['quote']['prima'] >= $b['quote']['prima']) return 1;
                        return -1;
                    });
                    foreach($items as $j => $item){
                        if(stripos($item['product']['title'], 'Optim') !== false && !$selected_offer[$k]){
                            $selected_offer[$k] = $j;
                        }
                    }
                    unset($items);
                }

                $_SESSION['insurance_offers'] = json_encode($result);
                $_offers = json_decode($_SESSION['insurance_offers'], true);
            }
        }
    }

}

if(isset($_POST['book'])) {

    $_offers = json_decode($_SESSION['insurance_offers'], true);
    $data = json_decode($_SESSION['insurance_booking'], true);

    if(!$_offers || !$data){
        go_away(route('insurance'));
    }

    foreach($data['insurants'] as $k => $insurant){
        $_rules['offer_'.$k] = 'trim|required';
    }
    $_rules['terms'] = 'trim|required';
    $_rules['terms2'] = 'trim|required';
    $_rules['terms3'] = 'trim|required';
    $_rules['terms4'] = 'trim|required';

    $custom_messages = array(
        'terms' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        ),
        'terms2' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        ),
        'terms3' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        ),
        'terms4' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        )
    );
    foreach($data['insurants'] as $k => $insurant){
        $custom_messages['offer_'.$k] = array(
            'required' => 'Trebuie sa alegi o oferta'
        );
    }

    $_form = new Validate($_rules, 'post', $custom_messages);
    $_valid = $_form->check();
    foreach($_rules as $key => $val){
        if($_form->error($key) != ""){
            $_errors[$key] = $_form->error($key);
        }
    }

    if($_valid){
        unset($_SESSION['insurance_selected_items']);
        foreach($data['insurants'] as $k => $insurant){
            $_SESSION['insurance_selected_items'][$k] = $_form['offer_'.$k];
        }
        go_away(route('booking-insurance'));
    }

}


$_meta_title = "Asigurari de calatorie";
$_no_index = false;
