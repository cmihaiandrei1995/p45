<?
function city_insurance_get_countries(){
    global $_config;

    $client = new SoapClient($_config['city_insurance']['link']);

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass']
    );

    $return = $client->getTari($params);

    if($return){
        if($return->tari){
            foreach($return->tari as $item){
                $countries[] = $item->tara;
            }
            return $countries;
        }
    }

    return false;
}


function city_insurance_get_clase(){
    global $_config;

    $client = new SoapClient($_config['city_insurance']['link']);

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass']
    );

    $return = $client->getClase($params);

    if($return){
        if($return->clase){
            foreach($return->clase as $item){
                $products[] = $item;
            }
            return $products;
        }
    }

    return false;
}


function city_insurance_get_quote($data, $is_storno){
    list($products, $count) = get_posts(array(
        'table' => 'city_insurance_product',
        'is_storno' => $is_storno ? 1 : 0
    ));
    foreach($products as $product){
        foreach($data['insurants'] as $k => $insurant){
            if(($product['is_extreme'] && $insurant['is_extreme']) || (!$product['is_extreme'] && !$insurant['is_extreme'])){
                $quote = city_insurance_get_quote_item($data, $insurant, $product['code'], $is_storno);
                if($quote){
                    $quotes[$k][] = array(
                        'quote' => $quote,
                        'product' => $product
                    );
                }
            }
        }
    }

    return $quotes;
}


function city_insurance_get_quote_item($data, $insurant, $product_id, $is_storno){
    global $_config, $_judete_city_insurance;

    $client = new SoapClient($_config['city_insurance']['link']);

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass'],

        'reducere' => '',                                           // (daca se intruneste una din conditiile de mai jos, se va aplica o reducere): 23 = se face asigurare pentru un grup de peste 10 persoane
        'clasa' => $product_id,                                     // valoarea acestui parametru o puteti obtine cu metoda getClase
        'nrZile' => $data['nights'],                                // numarul de zile de valabilitate
        'dataStart' => $data['start_date'],                         // data de intrare in valabilitate a politei, in format YYYY-MM-DD

        'dataNasterii' => $insurant['dob'],                         // data nasterii asiguratului, in format YYYY-MM-DD

        'tipStorno' => $is_storno ? 1 : 0,                          // folosit daca se asigura storno: 0 = se asigura intreg pachetul de calatorie , 1 = se asigura doar biletul de avion
        // 'pretContract' => 1000,                                     // Ron - costul de achizitie, exprimat in RON, al biletelor/pachetului turistic (este folosit cand se asigura si storno)
        // 'nrPersStorno' => 1,                                        // numarul de persoane, in caz ca se asigura intreg pachetul de calatorie

        'destinatia' => $data['country'],                           // tara unde calatoreste asiguratul; valoarea pentru acest camp o puteti prelua cu metoda getTari

        'zapada' => $insurant['zapada'] ? 1 : 0,                    // 1 = asiguratul practica: Snowkayaking, Ski, Snowboarding, Snowkiting, sanie, bob, Skiboarding, sărituri cu skiurile, patinaj, snowmobile
        'nautic' => $insurant['nautic'] ? 1 : 0,                    // 1 = asiguratul practica: Canioning, Surfing, Kayaking, Kitesurfing, Rafting, Scuba-diving (toate tipurile de  scufundări  inclusiv înot alături de rechini, delfini, diferite specii de pești și recifii de corali),  Windsurfing , sporturi extreme nautice (Wakeboard, Yachting, Cave diving, Powerboat, caiac, canoe, navigatie cu vase prevazute cu vele)
        'aero' => $insurant['aero'] ? 1 : 0,                        // 1 = asiguratul practica: Kiting, Bungee-jumping, Deltaplan, Parapantă, Parașutism, zbor cu aeronave cu motor de mici dimensiuni, planor sau cu aparate mai ușoare decât aerul (balon, aerostat)
        'terestru' => $insurant['terestru'] ? 1 : 0,                // 1 = asiguratul practica: Adventure race, Alpinism, Role, Skateboarding, Escalada, rapel, coborare cu blocatoare, Sporturi extreme terestre (călărie, speologie, vânătoare sportivă, paintball, trageri cu arme (arme de foc, arme cu aer comprimat, arcuri, arbalete, etc.), pescuit cu harpon cu resort sau aer comprimat), tiroliană (traversarea unei văi cu ajutorul unor sisteme de funii și scripeți), abseiling (coborâre în rapel pe coarda de alpinism)
        'roti' => $insurant['roti'] ? 1 : 0,                        // 1 = asiguratul practica: Ciclism, Raliuri, Motociclism MTB/BMX, conducerea de ATV, motociclete de teren, mountain biking, inclusiv downhill (coborâre cu mountain bike), off-road cu masini de teren
        'triatlon' => $insurant['triatlon'] ? 1 : 0,                // 1 = asiguratul participa la triatlon (daca se alege aceasta optiune, niciuna din celelalte categorii – zapada, nautic, aero, terestru, roti – nu va mai putea fi trimisa cu valoarea 1, intrucat webservice-ul va returna eroare)

        'scop' => $data['scope'],                                   // scopul calatoriei: 0 = turism , 1 = studii , 2 = prestare munca, sofer profesionist, om de afaceri
    );

    try{
        $return = $client->cotatie_medicale($params);
    }catch ( SoapFault $e ) {
        return array(
            'error' => true,
            'message' => $e->detail
        );
    }

    if($return){
        return json_decode(json_encode($return), true);
    }

    return false;
}


function city_insurance_create_offer($data, $insurant, $product_id, $payment, $id_booking, $is_storno){
    global $_config, $_judete_city_insurance;

    $client = new SoapClient($_config['city_insurance']['link']);

    $county_code = city_insurance_get_own_county_id_by_insurant_data($insurant);

    if($payment == "euplatesc" || $payment == "mobilpay") $payment_method = 2;
    elseif($payment == "cash") $payment_method = 1;
    elseif($payment == "op") $payment_method = 3;

    $foreign_country = "";
    if($insurant['foreign'] == 1){
        $foreign_country = city_insurance_get_country_by_id($insurant['country'])['title'];
    }

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass'],

        'reducere' => '',                                                           // (daca se intruneste una din conditiile de mai jos, se va aplica o reducere): 23 = se face asigurare pentru un grup de peste 10 persoane
        'clasa' => $product_id,                                                     // valoarea acestui parametru o puteti obtine cu metoda getClase
        'nrZile' => $data['nights'],                                                // numarul de zile de valabilitate
        'dataStart' => $data['start_date'],                                         // data de intrare in valabilitate a politei, in format YYYY-MM-DD

        'numeAsigurat' => $insurant['lastname'],                                    // numele asiguratului
        'prenumeAsigurat' => $insurant['firstname'],                                // prenumele asiguratului
        'dataNasterii' => $insurant['dob'],                                         // data nasterii asiguratului, in format YYYY-MM-DD
        'pasaport' => $insurant['cnp'],                                             // CNP-ul sau seria pasaportului asiguratului
        'adresa' => $insurant['address'],                                           // adresa asiguratului
        'contract' => $id_booking,                                                  // numarul biletului de avion / numarul contractului de prestari servicii - Campul contract este obligatoriu doar daca se asigura storno (are minOccurs = 0) si reprezinta fie numarul biletului de avion (daca tipStorno = 1), fie numarul contractului/pachetului de servicii de calatorie incheiat cu agentia de turism (daca tipStorno = 0)

        'tipStorno' => $is_storno ? 1 : 0,                                          // folosit daca se asigura storno: 0 = se asigura intreg pachetul de calatorie , 1 = se asigura doar biletul de avion
        // 'pretContract' => 1000,                                                     // Ron - costul de achizitie, exprimat in RON, al biletelor/pachetului turistic (este folosit cand se asigura si storno)
        // 'nrPersStorno' => 1,                                                        // numarul de persoane, in caz ca se asigura intreg pachetul de calatorie
        // 'stornoDataStart' => '2019-04-12',                                          // data de cand intra in valabilitate asigurarea storno - trebuie sa fie mereu ziua curenta
        // 'stornoDataEnd' => '2019-05-21',                                            // data cand expira valabilitatea storno

        'modalitatePlata' => $payment_method,                                       // documentul cu care se achita polita: 1 = cash , 2 = card , 3 = OP , 4 = CEC , 5 = ticketing , 6 = chitanta electronica (va fi generata automat o chitanta CITY ce poate fi obtinuta ulterior folosind metoda printeazaChitanta)
        'nrPlata' => $id_booking,                                                   // numarul documentului cu care se achita polita (daca modalitatePlata != 6)

        'destinatia' => $data['country'],                                           // tara unde calatoreste asiguratul; valoarea pentru acest camp o puteti prelua cu metoda getTari
        'asigJudet' => $county_code,                                                // judetul unde locuieste asiguratul:   $_judete_city_insurance
        'asigLocalitate' => $insurant['city'],                                      // localitatea unde locuieste asiguratul; valorile acceptate sunt conform bazei de date Siruta

        'zapada' => $insurant['zapada'] ? 1 : 0,                                    // 1 = asiguratul practica: Snowkayaking, Ski, Snowboarding, Snowkiting, sanie, bob, Skiboarding, sărituri cu skiurile, patinaj, snowmobile
        'nautic' => $insurant['nautic'] ? 1 : 0,                                    // 1 = asiguratul practica: Canioning, Surfing, Kayaking, Kitesurfing, Rafting, Scuba-diving (toate tipurile de  scufundări  inclusiv înot alături de rechini, delfini, diferite specii de pești și recifii de corali),  Windsurfing , sporturi extreme nautice (Wakeboard, Yachting, Cave diving, Powerboat, caiac, canoe, navigatie cu vase prevazute cu vele)
        'aero' => $insurant['aero'] ? 1 : 0,                                        // 1 = asiguratul practica: Kiting, Bungee-jumping, Deltaplan, Parapantă, Parașutism, zbor cu aeronave cu motor de mici dimensiuni, planor sau cu aparate mai ușoare decât aerul (balon, aerostat)
        'terestru' => $insurant['terestru'] ? 1 : 0,                                // 1 = asiguratul practica: Adventure race, Alpinism, Role, Skateboarding, Escalada, rapel, coborare cu blocatoare, Sporturi extreme terestre (călărie, speologie, vânătoare sportivă, paintball, trageri cu arme (arme de foc, arme cu aer comprimat, arcuri, arbalete, etc.), pescuit cu harpon cu resort sau aer comprimat), tiroliană (traversarea unei văi cu ajutorul unor sisteme de funii și scripeți), abseiling (coborâre în rapel pe coarda de alpinism)
        'roti' => $insurant['roti'] ? 1 : 0,                                        // 1 = asiguratul practica: Ciclism, Raliuri, Motociclism MTB/BMX, conducerea de ATV, motociclete de teren, mountain biking, inclusiv downhill (coborâre cu mountain bike), off-road cu masini de teren
        'triatlon' => $insurant['triatlon'] ? 1 : 0,                                // 1 = asiguratul participa la triatlon (daca se alege aceasta optiune, niciuna din celelalte categorii – zapada, nautic, aero, terestru, roti – nu va mai putea fi trimisa cu valoarea 1, intrucat webservice-ul va returna eroare)

        'mentiuni' => '',                                                           // alte informatii, daca e cazul
        'scop' => $data['scope'],                                                   // scopul calatoriei: 0 = turism , 1 = studii , 2 = prestare munca, sofer profesionist, om de afaceri

        'alteTari' => '',                                                           // alteTari – alte tari destinatare, in cazul in care asiguratul mai face popasuri

        'acord' => 1,                                                               // daca asiguratul este de acord cu prelucrarea datelor personale (in scopuri de marketing), 0 altfel
        'acord2' => 1,                                                              // daca asiguratul este de acord cu prelucrarea datelor personale privind starea de sanatate si datele minorilor, 0 altfel

        'strain' => $insurant['foreign'] == 1 ? 1 : 0,                              // 1 daca asiguratul este cetatean strain cu rezidenta in U.E., 0 altfel
        'strainTara' => $insurant['foreign'] == 1 ? $foreign_country : '',          // tara de rezidenta a asiguratului (daca strain = 1). Valori posibile: AUSTRIA, BELGIA, BULGARIA, CIPRU, CROATIA, DANEMARCA, ESTONIA, FINLANDA, FRANTA, GERMANIA, GRECIA, IRLANDA, ITALIA, LETONIA, LITUANIA, LUXEMBURG, MALTA, MAREA BRITANIE, OLANDA, POLONIA, PORTUGALIA, REPUBLICA CEHA, ROMANIA, SLOVACIA, SLOVENIA, SPANIA, SUEDIA, UNGARIA

        'altContractant' => 0,                                                      // 1 daca se mentioneaza alta persoana, diferita de asigurat, pentru contractant, 0 altfel (pentru cazurile cand asiguratul este minor). Campurile urmatoare au aceeasi definitie ca cele pentru asigurat
        'numeContractant' => '',
        'prenumeContractant' => '',
        'dataNasteriiContractant' => '',
        'pasaportContractant' => '',
        'adresaContractant' => '',
        'judetContractant' => '',
        'localitateContractant' => '',
    );

    // print_r($params);

    try{
        $return = $client->emitere_medicale($params);
    }catch ( SoapFault $e ) {
        return array(
            'error' => true,
            'message' => $e
        );
    }

    if($return){
        return json_decode(json_encode($return), true);
    }

    return false;
}



function city_insurance_print_offer($series, $number){
    global $_config;

    $client = new SoapClient($_config['city_insurance']['link']);

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass'],

        'serie' => $series,
        'numar' => $number,
        'printConditii' => 1                                            // 1 daca se doreste si atasarea conditiilor la pdf-ul politei, 0 daca se va printa doar polita impreuna cu oferta asociata
    );

    try{
        $return = $client->printeaza_oferta($params);
    }catch ( SoapFault $e ) {
        return array(
            'error' => true,
            'message' => $e->detail
        );
    }

    if($return){
        return json_decode(json_encode($return), true);
    }

    return false;
}


function city_insurance_create_insurance($series, $number, $payment, $id_booking){
    global $_config;

    $client = new SoapClient($_config['city_insurance']['link']);

    if($payment == "euplatesc" || $payment == "mobilpay") $payment_method = 2;
    elseif($payment == "cash") $payment_method = 1;
    elseif($payment == "op") $payment_method = 3;

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass'],

        'serie' => $series,
        'numar' => $number,

        'modalitatePlata' => $payment_method,                               // documentul cu care se achita polita: 1 = cash , 2 = card , 3 = OP , 4 = CEC , 5 = ticketing , 6 = chitanta electronica (va fi generata automat o chitanta CITY ce poate fi obtinuta ulterior folosind metoda printeazaChitanta)
        'nrPlata' => $id_booking,                                           // numarul documentului cu care se achita polita (daca modalitatePlata != 6)
    );

    try{
        $return = $client->salveazaOferta($params);
    }catch ( SoapFault $e ) {
        return array(
            'error' => true,
            'message' => $e->detail
        );
    }

    if($return){
        return json_decode(json_encode($return), true);
    }

    return false;
}


function city_insurance_print_insurance($series, $number){
    global $_config;

    $client = new SoapClient($_config['city_insurance']['link']);

    $params = array(
        'utilizator' => $_config['city_insurance']['user'],
        'parola' => $_config['city_insurance']['pass'],

        'serie' => $series,
        'numar' => $number,
        'printConditii' => 1                                                // 1 daca se doreste si atasarea conditiilor la pdf-ul politei, 0 daca se va printa doar polita impreuna cu oferta asociata
    );

    try{
        $return = $client->printeaza_medicale($params);
    }catch ( SoapFault $e ) {
        return array(
            'error' => true,
            'message' => $e->detail
        );
    }

    if($return){
        return json_decode(json_encode($return), true);
    }

    return false;
}


function city_insurance_get_country_by_id($id){
    return db_row('SELECT * FROM city_insurance_country WHERE id_city_insurance_country = ?', $id);
}

function city_insurance_get_county_by_id($id){
    return db_row('SELECT * FROM city_insurance_county WHERE id_city_insurance_county = ?', $id);
}

function city_insurance_get_county_by_code($id){
    return db_row('SELECT * FROM city_insurance_county WHERE code = ?', $id);
}

function city_insurance_get_own_county_id_by_insurant_data($insurant){
    global $_judete_city_insurance;

    if(is_numeric()){
        $county = city_insurance_get_county_by_id($insurant['county']);
    }else{
        $county = city_insurance_get_county_by_code($insurant['county']);
    }

    if(is_numeric(str_replace("B", "", $county['code']))){
        return str_replace("B", "", $county['code']);
    }else{
        foreach($_judete_city_insurance as $key => $item){
            if($item == $county['title']){
                return $key;
            }
        }
    }

    return 0;
}
