<?

$_generali_client = new SoapClient($_config['generali']['link'], array(
    'trace' => true,
    'exceptions' => true,
));


$_scopes = db_query('SELECT * FROM generali_service WHERE active = 1 ORDER BY `order` ASC');
$_counties = db_query('SELECT * FROM generali_county WHERE active = 1 ORDER BY title ASC');
//$_destinations = db_query('SELECT * FROM generali_country WHERE active = 1 ORDER BY title ASC');

$_genders = [
    'male' => 'Masculin',
    'female' => 'Feminin',
];

if(isset($_POST['search'])) {

    $_rules['start_date'] = 'trim|required';
    $_rules['end_date'] = 'trim|required';
    //$_rules['name'] = 'trim|required|alphanumeric|minlength-3';
    //$_rules['email'] = 'trim|required|email';
    //$_rules['phone'] = 'trim|required|numeric|minlength-10|maxlength-13';
    $_rules['destination'] = 'trim|required';
    $_rules['zone'] = 'trim|required';
    $_rules['scope'] = 'trim|required';
    $_rules['gdpr'] = 'trim|required';

    $custom_messages = array(
        'gdpr' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        )
    );

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
    $o_rules['cnp'] = 'trim|required|cnp';
    $o_rules['ci'] = 'trim|required';
    $o_rules['county'] = 'trim|required';
    $o_rules['city'] = 'trim|required';
    $o_rules['address'] = 'trim|required';

    foreach($_POST['insurants'] as $i => $o) {

        if(validCNP($o['cnp'])){
            $insurant_data = extractDataFromCNP($o['cnp']);

            if($insurant_data){
                $o['dob_day'] = $insurant_data['day'];
                $o['dob_month'] = $insurant_data['month'];
                $o['dob_year'] = $insurant_data['year'];
                $o['gender'] = $insurant_data['gender'] == 'm' ? 'male' : 'female';
            }
        }

        $o_form = new Validate($o_rules, $o);
        $o_valid = $o_form->check();

        foreach($o_rules as $key => $val){
            if($o_form->error($key) != ""){
                $_errors['insurants'.$i.$key] = $o_form->error($key);
            }
        }

        $_valid = $_valid && $o_valid;
    }

    if($_POST['scope'] == "FAMILIE" && count($_POST['insurants']) < 2){
        $_valid = false;
        $_errors['scope'] = "Pentru a putea alege pachetul de Familie, trebuie sa fie cel putin 2 persoane asigurate.";
    }

    foreach($_POST['insurants'] as $i => $o) {
        $o['dob'] = date('Y-m-d', strtotime($o['dob_year'].'-'.$o['dob_month'].'-'.$o['dob_day']));
        $o['age'] = DateTime::createFromFormat('Y-m-d', $o['dob'])->diff(new DateTime('now'))->y;

        if($o['age'] > 70){
            $_valid = false;
            $_errors['insurants'.$i.'age'] = "Varsta maxima pentru asigurat este de 70 ani.";
        }
    }

    if($_valid) {

        $data = $_POST;
        $_SESSION['insurance_booking'] = json_encode($data);

        $data['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
        $data['end_date'] = date('Y-m-d', strtotime($_POST['end_date']));

        foreach($data['insurants'] as &$o) {
            $o['dob'] = date('Y-m-d', strtotime($o['dob_year'].'-'.$o['dob_month'].'-'.$o['dob_day']));
            $o['age'] = DateTime::createFromFormat('Y-m-d', $o['dob'])->diff(new DateTime('now'))->y;
            unset($o);
        }

        $res = generali_get_quote($data);

        $_SESSION['insurance_offers'] = json_encode($res);
        $_offers = json_decode($_SESSION['insurance_offers'], true);

    }

}

if(isset($_POST['book'])) {

    $_offers = json_decode($_SESSION['insurance_offers'], true);
    if(!$_offers){
        go_away(route('insurance'));
    }

    $_rules['offer'] = 'trim|required';
    $_rules['terms'] = 'trim|required';
    $_rules['pid'] = 'trim|required';

    $custom_messages = array(
        'terms' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        ),
        'pid' => array(
            'required' => 'Trebuie sa fii de acord cu aceasta clauza'
        ),
        'offer' => array(
            'required' => 'Trebuie sa alegi o oferta'
        )
    );

    $_form = new Validate($_rules, 'post', $custom_messages);
    $_valid = $_form->check();
    foreach($_rules as $key => $val){
        if($_form->error($key) != ""){
            $_errors[$key] = $_form->error($key);
        }
    }

    if($_valid){
        $_SESSION['insurance_selected_item'] = $_form['offer'];
        go_away(route('booking-insurance'));
    }

}


$_meta_title = "Asigurari de calatorie";
$_no_index = false;
