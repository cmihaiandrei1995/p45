<?

$_generali_login_token = "";

function generali_get_country_by_code($code){
    return db_row('SELECT * FROM generali_country WHERE code = ?', $code);
}

function generali_deliver_insurance($orderNumber, $email) {
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $orderNumber;
    $params['email'] = $email;
    $result = generali_make_request($params, 'deliverKeys', $_generali_login_token);
    return $result;
}

function generali_get_order_status($orderNumber) {
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $orderNumber;
    $result = generali_make_request($params, 'orderStatus', $_generali_login_token);
    return $result;
}

function generali_place_order($id_product, $search_data, $booking_data){

    $scope = db_row('SELECT * FROM generali_service WHERE code = ?', $search_data['scope']);
    $country = db_row('SELECT * FROM generali_country WHERE code = ?', $search_data['destination']);
    $product = db_row('SELECT * FROM generali_product WHERE id_generali_product = ?', $id_product);

    // zones are related to products, this is a hack to work on "Extreme"
    $zone = db_row('SELECT * FROM generali_zone WHERE code = ?', $product['code']);
    if(!$zone){
        $zone = db_row('SELECT * FROM generali_zone WHERE code = ?', $search_data['zone']);
    }

    $IdCountry = $search_data['destination']; // generali_country
    $IdProduct = $product['id']; // generali_product
    $IdZona = $zone['id']; // generali_zone
    $travelType = $search_data['scope']; // generali_service

    $startDate = $search_data['start_date'];
    $endDate = $search_data['end_date'];

    $country = new TRaiSoapCountry();
    $country->countryId = $IdCountry;

    $scop = new TRaiSoapScop();
    $scop->scopId = $travelType;

    $zona = new TRaiSoapZona();
    $zona->zonaId = $IdZona;

    $judet = new TRaiSoapJudet();

    $productOptionsTurist = new TRaiSoapProductInformationTurist();
    $productOptionsTurist->DP = date("Y-m-d", strtotime($startDate));
    $productOptionsTurist->DI = date("Y-m-d", strtotime($endDate));
    $productOptionsTurist->CNTRY = array($country);
    $productOptionsTurist->SCP = array($scop);
    $productOptionsTurist->ZONA = array($zona);

    foreach($search_data['insurants'] as $pers) {
        $persoana = new TRaiSoapPersonTurism();

        $judet->judetName = $pers["county"];
        $persoana->NM = $pers["firstname"];
        $persoana->PN = $pers["lastname"];
        $persoana->CNP = $pers["cnp"];
        $persoana->CI = $pers["ci"];
        $persoana->SEX = $pers["gender"];
        $persoana->TEL = $booking_data["phone"];
        $persoana->JUD = $judet;
        $persoana->LOC = $pers["city"];
        $persoana->STR = $pers["address"];
        $persoana->BL = "";
        $persoana->SC = "";
        $persoana->ET = "";
        $persoana->APT = "";
        $persoana->CP = "";
        $persoana->EMAIL = $booking_data["email"];
        $persoana->AFECTIUNI = "";
        $productOptionsTurist->LP[] = $persoana;
    }

    $productOptions = new TRaiSoapProductInformation();

    if($IdProduct == 4){ // extreme
        $productOptions->productInformationExtreme = $productOptionsTurist;
    }else{
        $productOptions->productInformationTurist = $productOptionsTurist;
    }

    //var_dump($productOptions);
    //print_r($result);

    $result = generali_place_order_request($IdProduct, $productOptions);

    return $result;
}



function generali_get_quote($data){
    /**
    * Cotatie de pret *
    * $IdCountry, $travelType, $IdZona, $startDate, $endDate, $country, $scop,
    * $zona trebuie sa contina valori valide conform cu sablonul obtinut prin
    * apelarea metodei productInformation */

    $scope = db_row('SELECT * FROM generali_service WHERE code = ?', $data['scope']);
    $country = db_row('SELECT * FROM generali_country WHERE code = ?', $data['destination']);
    $products = db_query('SELECT * FROM generali_product WHERE active = 1 AND id_generali_product IN (SELECT id_generali_product FROM generali_product_to_service WHERE id_generali_service = ?) AND id_generali_product IN (SELECT id_generali_product FROM generali_product_to_country WHERE id_generali_country = ?)', $scope['id_generali_service'], $country['id_generali_country']);

    foreach($products as $product){

        // zones are related to products, this is a hack to work on "Extreme"
        $zone = db_row('SELECT * FROM generali_zone WHERE code = ?', $product['code']);
        if(!$zone){
            $zone = db_row('SELECT * FROM generali_zone WHERE code = ?', $data['zone']);
        }

        $IdCountry = $data['destination']; // generali_country
        $IdProduct = $product['id']; // generali_product
        $IdZona = $zone['id']; // generali_zone
        $travelType = $data['scope']; // generali_service

        $startDate = $data['start_date'];
        $endDate = $data['end_date'];

        $country = new TRaiSoapCountry();
        $country->countryId = $IdCountry;

        $scop = new TRaiSoapScop();
        $scop->scopId = $travelType;

        $zona = new TRaiSoapZona();
        $zona->zonaId = $IdZona;

        $productOptionsTurist = new TRaiSoapProductInformationTurist();
        $productOptionsTurist->DP = $startDate;
        $productOptionsTurist->DI = $endDate;
        $productOptionsTurist->CNTRY = array($country);
        $productOptionsTurist->SCP = array($scop);
        $productOptionsTurist->ZONA = array($zona);
        $productOptionsTurist->CHEAP = false;

        foreach($data['insurants'] as $person){
            $persoana = new TRaiSoapPersonTurism();
            $persoana->VARSTA = $person['age'];
            $productOptionsTurist->LP[] = $persoana;
        }

        $productOptions = new TRaiSoapProductInformation();
        if($IdProduct == 4){ // extreme
            $productOptions->productInformationExtreme = $productOptionsTurist;
        }else{
            $productOptions->productInformationTurist = $productOptionsTurist;
        }

        //var_dump($productOptions);
        //print_r($productPrices);

        $productPrices[$product['id_generali_product']] = array(
            'product' => $product,
            'results' => generali_get_quote_request($IdProduct, $productOptions),
            'idd' => generali_get_pid_request($IdProduct)
        );

    }

    return $productPrices;
}




function generali_place_order_request($id_product, $product_options){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $id_product;
    $params['options'] = $product_options;

    $agreements = new TRaiSoapAgreements();
    $agreements->gdpr = true;
    $agreements->marketing = false;
    $params['agreements'] = $agreements;
    $params['idd'] = true;

    $items = generali_make_request($params, 'placeOrder', $_generali_login_token);
    return $items;
}


function generali_get_pid_request($id_product){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $id_product;
    $items = generali_make_request($params, 'getIddDocument', $_generali_login_token);
    return $items;
}


function generali_get_quote_request($id_product, $product_options){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $id_product;
    $params['options'] = $product_options;
    $items = generali_make_request($params, 'productPrice', $_generali_login_token);
    return $items;
}


function generali_get_product_info($id){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $params['id'] = $id;
    $items = generali_make_request($params, 'productInformation', $_generali_login_token);
    return $items;
}

function generali_get_products(){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $items = generali_make_request($params, 'productsList', $_generali_login_token);
    return $items;
}

function generali_get_counties(){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $items = generali_make_request($params, 'getStatesList', $_generali_login_token);
    return $items;
}

function generali_get_countries(){
    global $_site_title, $_config;
    global $_generali_client, $_generali_login_token;

    if(!$_generali_login_token) {
        $_generali_login_token = generali_login($_generali_client);
    }

    $items = generali_make_request($params, 'getCountriesList', $_generali_login_token);
    return $items;
}





function generali_login($client){
    global $_site_title, $_config;

    if(!$_SESSION[$_site_title]["Generali_Token"]){
        try {
            $loginToken = $client->Login($_config['generali']['user'], $_config['generali']['pass']);
            if ($loginToken){
                //store the token in a local session
                $_SESSION[$_site_title]["Generali_Token"] = $loginToken;
            }
            return $loginToken;
        } catch ( SoapFault $e ) {
            //echo $faultCode = $e->faultcode;
            return false;
        }
    }else{
        $token = $_SESSION[$_site_title]["Generali_Token"];
        try {
            if ($client->authorizedUser($token)) {
                return $token;
            } else {
                unset($_SESSION[$_site_title]["Generali_Token"]);
                return generali_login($client);
            }
        }catch ( SoapFault $e ) {
            $faultCode = $e->faultcode;
            if($faultCode == 'SESSION_EXPIRED'){
                unset($_SESSION[$_site_title]["Generali_Token"]);
                return generali_login($client);
            }
        }
    }
}



function generali_make_request($params, $type, $login_token) {
    global $_config, $_generali_client;

    $startTime = microtime(true);

    $id_request = db_query('INSERT INTO generali_request SET created = NOW()');

    switch($type){
        case 'getCountriesList': {
            $response = $_generali_client->getCountriesList($login_token);
        }break;
        case 'getStatesList': {
            $response = $_generali_client->getStatesList($login_token);
        }break;
        case 'productsList': {
            $response = $_generali_client->productsList($login_token);
        }break;
        case 'productInformation': {
            $response = $_generali_client->productInformation($login_token, $params['id']);
        }break;
        case 'productPrice': {
            $response = $_generali_client->productPrice($login_token, $params['id'], $params['options']);
        }break;
        case 'getIddDocument': {
            $response = $_generali_client->getIddDocument($login_token, $params['id']);
        }break;
        case 'placeOrder': {
            $response = $_generali_client->placeOrder($login_token, $params['id'], $params['options'], null, false, null, $params['agreements']);
        }break;
        case 'orderStatus': {
            $response = $_generali_client->orderStatus($login_token, $params['id']);
        }break;
        case 'deliverKeys': {
            $response = $_generali_client->deliverKeys($login_token, $params['id'], $params['email']);
        }break;
    }

    $endTime = microtime(true);

    db_query('UPDATE generali_request SET title = ?, request = ?, response = ?, response_time = ? WHERE id_generali_request = ?', $type, json_encode($params), gzdeflate(json_encode($response)), ($endTime - $startTime), $id_request);

    return $response;
}







class TRaiSoapProduct
{
    /**
    * ID Produs
    *
    * @var integer
    */
    public $IdProduct;
    /**
    * Cod Produs
    *
    * @var string
    */
    public $ProductCode;
    /**
    *
    * Nume Produs
    *
    * @var string
    */
    public $ProductName;
    /**
    *
    * Descriere produs
    *
    * @var string
    */
    public $ProductDescription;
}


class TRaiSoapSimplePerson
{
    /**
    * Sex (male / female)
    *
    * vartype - optional
    * @var string
    */
    public $SEX;
    /**
    * Nume
    *
    * vartype - mandatory
    * @var string
    */
    public $NM;
    /**
    * Prenume
    *
    * vartype - mandatory
    * @var string
    */
    public $PN;
    /**
    * CNP
    *
    * vartype - mandatory
    * @var string
    */
    public $CNP;
    /**
    * Se seteaza in cazul clientilor ce prezinta afectiuni pre-existente sau cronice: * Cardiovasculare, Neurologice, Respiratorii, Infectioase, Digestive, Neoplasice, Hematologice, Diabet Zaharat
    *
    * vartype - optional
    * @var integer
    */
    public $AFECTIUNI;
    /**
    * Se seteaza pentru a obtine cotatii de pret. Pentru obtinerea cotatiilor de pret campul este obligatoriu.
    * La plasarea comenzilor acest camp este ignorat si varsta este calculata automat pe baza CNP-ului.
    *
    * vartype - mandatory / optional
    * @var integer
    */
    public $VARSTA;
}

class TRaiSoapPerson extends TRaiSoapSimplePerson
{
    /**
    * Serie si numar de buletin / pasaport
    *
    * vartype - mandatory
    * @var string
    */
    public $CI;
    /**
    * Judet
    *
    * vartype - mandatory
    * @var TRaiSoapJudet
    */
    public $JUD;
    /**
    * Localitatea
    *
    * vartype - mandatory
    * @var string
    */
     public $LOC;
     /**
    * Strada
     *
     * vartype - mandatory
     * @var string
     */
     public $STR;
     /**
     * Apartamentul
     *
     * vartype - optional
     * @var string
     */
     public $APT;
     /**
     * Bloc
     *
     * @var string
     */
     public $BL;
     /**
     * Scara
     *
     * vartype - optional
     * @var string
     */
     public $SC;
     /**
     * Etaj
     *
     * vartype - optional
     * @var string
     */
     public $ET;
     /**
     * Cod Postal
     *
     * vartype - optional
     * @var string
     */
     public $CP;
}


class TRaiSoapPersonTurism extends TRaiSoapPerson
{
     /**
    * Telefon
    *
    * vartype - mandatory
    * @var string
    */
    public $TEL;
    /**
    * E-mail
    *
    * vartype - optional
    * @var string
    */
    public $EMAIL;
}

class TRaiSoapPersonSofer extends TRaiSoapPerson
{
    /**
    * Telefon
    *
    * @var string
    */
    public $TEL;
    /**
    * E-mail
    *
    * @var string
    */
    public $EMAIL;
}

class TRaiSoapCountry
{
    public $TEL;
    /**
    * Numele tarii
    *
    * @var string
    */
    public $countryName = null;
    /**
    * ID Tara
    *
    * @var integer
    */
    public $countryId = null;
    /**
    * Zona geografica a tarii
    *
    * @var string
    */
    public $countryArea = null;
}

class TRaiSoapJudet
{
    /**
    * Numele judetului
    *
    * @var string
    */
    public $judetName = null;
    /**
    * Cod Judet
    *
    * @var string
    */
    public $judetCode = null;
}

class TRaiSoapZona
{
    /**
    * Numele zonei
    *
    * @var string
    */
    public $zonaName = null;
    /**
    * Codul zonei
    *
    * @var string
    */
    public $zonaCode = null;
    /**
    * ID Zona
    *
    * @var integer
    */
    public $zonaId = null;
}

class TRaiSoapScop
{
    /**
    * Scopul calatoriei
    *
    * @var string
    */
    public $scopName = null;
    /**
    * Id scop calatorie
    *
    * @var string
    */
    public $scopId = null;
}

class TRaiSoapProductInformationCore
{
    /**
    * Data Plecarii (YYYY-MM-DD)
    *
    * vartype - mandatory
    * @var string
    */
    public $DP;
    /**
    * Data Intoarcerii (YYYY-MM-DD)
    *
    * vartype - mandatory
    * @var string
    */
    public $DI;
    /**
    * Scopul calatoriei
    *
    * vartype - mandatory * @var TRaiSoapScop[]
    */
    public $SCP;
    /**
    * Tara de destinatie
    *
    * vartype - mandatory
    * @var TRaiSoapCountry[]
    */
    public $CNTRY;
}

class TRaiSoapProductInformationTurist extends TRaiSoapProductInformationCore
{
    /**
    * Zona teritoriala in care se face deplasarea
    *
    * vartype - mandatory * @var TRaiSoapZona[]
    */
    public $ZONA;
    /**
    * Lista persoane
    *
    * vartype - mandatory
    * @var TRaiSoapPersonTurism[]
    */
    public $LP;
    /**
    * Asigurare tip Cheap
    * *
    * @var boolean
    */
    public $CHEAP = false;
}

class TRaiSoapProductInformationStorno extends TRaiSoapProductInformationCore
{
    /**
    * Numarul contractului de servicii turistice
    *
    * vartype - optional/mandatory
    * @var string
    */
    public $SERVICES_CONTRACT_NUMBER;
    /**
    * Pretul contractului de servicii turistice
    *
    * vartype - mandatory
    * @var float
    */
    public $SERVICES_CONTRACT_PRICE;
    /**
    * Data contractului de servicii turistice (YYYY-MM-DD)
    *
    * vartype - optional/mandatory
    * @var string
    */
    public $SERVICES_CONTRACT_DATE;
    /**
    * Numele agentiei de turism pentru contractul de servicii turistice
    *
    * vartype - optional/mandatory
    * @var string
    */
    public $SERVICES_CONTRACT_TRAVEL_AGENCY;
    /**
    * Lista persoane
    *
    * vartype - mandatory
    * @var TRaiSoapPersonTurism[]
    */
    public $LP;
}

class TRaiSoapProductInformationProfesional extends TRaiSoapProductInformationCore
{
    /**
    * Zona teritoriala in care se face deplasarea
    *
    * vartype - mandatory * @var TRaiSoapZona[]
    */
    public $ZONA;
    /**
    * Lista persoane
    *
    * vartype - mandatory
    * @var TRaiSoapPersonTurism[]
    */
    public $LP;
    /**
    * Acoperire (ACCIDENTS sau ACCIDENTS_AND_HEALTH)
    *
    * vartype - mandatory
    * @var string
    */
    public $COVERAGE;
}

class TRaiSoapProductInformationCarAssist extends TRaiSoapProductInformationCore
{
    /**
    * Informatii despre sofer
    *
    * @var TRaiSoapPersonSofer
    */
    public $SOFER;
    /**
    * Lista persoane
    *
    * @var TRaiSoapSimplePerson[]
    */
    public $LP;
    /**
    * Numar de inmatriculare
    *
    * @var string
    */
    public $NI;
    /**
    * Serie sasiu
    *
    * @var string
    */
    public $SS;
}

class TRaiSoapProductInformation
{
    /**
    * productInformationTurist object
    *
    * @var TRaiSoapProductInformationTurist
    */
    public $productInformationTurist = null;
    /**
    * productInformationExtreme object
    *
    * @var TRaiSoapProductInformationTurist
    */
    public $productInformationExtreme = null;
    /**
    * productInformationCarAssist object
    *
    * @var TRaiSoapProductInformationCarAssist
    */
    public $productInformationCarAssist = null;
    /**
    * productInformationStorno object
    *
    * @var TRaiSoapProductInformationStorno
    */
    public $productInformationStorno = null;
    /**
    * productInformationProfesional object
    *
    * @var TRaiSoapProductInformationProfesional
    */
    public $productInformationProfesional = null;
}

class TRaiSoapProductPriceDetails
{
    /**
    * Pret detaliat pentru o persoana
    *
    * @var float
    */
    public $pricePersoana;
    /**
    * Numele persoanei pentru care este intors pretul
    *
    */
    public $numePersoana;
}

class TRaiSoapProductPrice
{
    /**
    * Pret partener (include discount-urile de partener si discount-urile de produs)
    *
    * @var float
    */
    public $partnerPrice = null;
    /**
    * Pret utilizator final
    *
    * @var float
    */
    public $endUserPrice = null;
    /**
    * Vector ce contine preturile detaliate pe fiecare persoana
    *
    * @var TRaiSoapProductPriceDetails[]
    */
    public $detailedPrice = null;
}

class TRaiSoapKey
{
    /**
    * Numele politei
    *
    * @var string
    */
    public $keyName = null;
    /**
    * URL pentru a downloada polita
    *
    * @var string
    */
    public $keyURL = null;
}

class TRaiSoapKeys
{
    /**
    * Lista politelor
    *
    * @var TRaiSoapKey[]
    */
    public $keys = null;
    /**
    * Termeni si conditii
    *
    * @var string
    */
    public $termsName = null;
    /**
    * URL pt termeni si conditii
    *
    * @var string
    */
    public $termsURL = null;
}

class TRaiSoapOfferDetails
{
    /**
    * Numele contractantului
    *
    * @var string
    */
    public $contractorName = null;
    /**
    * Informatii despre produs
    *
    * @var TRaiSoapProductInformation
    */
    public $productOptions;
    /**
    * Pretul ofertei
    *
    * @var TRaiSoapProductPrice
    */
    public $productPrice;
}

class TRaiSoapAgreements
{
    /**
    * @var boolean
    */
    public $gdpr = false;
    /**
    * @var boolean
    */
    public $marketing = false;
}

class TRaiSoapIddDocument
{
     /**
     * URL pentru prezentarea intermediarului si PID
     *
     * @var string
     */
     public $documentURL = null;
}
