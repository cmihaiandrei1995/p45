<?

function send_request_to_tm($data){

	ini_set('soap.wsdl_cache_enabled', 0);
	ini_set('soap.wsdl_cache_ttl', 0);

	$soapClient = new SoapClient("http://tmlive.paralela45.ro/ServerMain.asmx?wsdl", array('trace' => 1));

	$login_array = array(
	    'userName' => 'cereritm',
	    'userPassword' => 'Eed93$%fm38',
	    'userLocation' => 'web',
	    'activity_info' => 'LOGIN'
	);

	$login = $soapClient->__call("Login", array($login_array));

	$request = array("request" => $data);

	try {
		$soapClient->__call("AddClientRequest", array($request));
	} catch (SoapFault $exception) {

	}

	/*
	if(debug_mode()){
		echo "<pre>";
		print_R($request);
		var_dump($soapClient);
		exit;
	}
	*/

	return $soapClient;

}


function tm_get_source_list(){

	ini_set('soap.wsdl_cache_enabled', 0);
	ini_set('soap.wsdl_cache_ttl', 0);

	$soapClient = new SoapClient("http://tmlive.paralela45.ro/ServerMain.asmx?wsdl", array('trace' => 1));

	$login_array = array(
	    'userName' => 'cereritm',
	    'userPassword' => 'Eed93$%fm38',
	    'userLocation' => 'web',
	    'activity_info' => 'LOGIN'
	);

	$login = $soapClient->__call("Login", array($login_array));

	$request = array("request" => array());

	try {
		$soapClient->__call("GetClientOfflineRequestSourceList", array($request));
	} catch (SoapFault $exception) {

	}

	if(debug_mode()){
		echo "<pre>";
		print_R($request);
		var_dump($soapClient);
		exit;
	}

	return $soapClient;

}
