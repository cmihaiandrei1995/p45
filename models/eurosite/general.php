<?


function eurositeGetCountries(){
	return eurositeRequest("getCountryRequest");
}

function eurositeGetCities($country_code){
	$xml = '<getCityRequest CountryCode="'.$country_code.'" />';
	return eurositeRequest("getCityRequest", $xml);
}

function eurositeGetOwnCities(){
	return eurositeRequest("getOwnCityRequest");
}

function eurositeGetHotels($city_code){
	$xml = '<CityCode>'.$city_code.'</CityCode>';
	return eurositeRequest("getOwnHotelsRequest", $xml);
}

function eurositeGetHotelsWithDetails($city_code){
	$xml = '<CityCode>'.$city_code.'</CityCode>';
	return eurositeRequest("getOwnHotelsDetailsRequest", $xml);
}

function eurositeGetAgentii(){
	return eurositeRequest("getResellersRequest");
}




function eurositeRequest($request, $xml = ""){
	global $_config;

	$id_request = db_query('INSERT INTO eurosite_request SET created = NOW()');

	$xml_request = '<?xml version="1.0" encoding="UTF-8"?>
	<Request RequestType="'.$request.'">
		'.eurositeLoginXml($id_request).'
		<RequestDetails>
		';

		if($xml != ""){
			if(stripos($xml, $request) !== false) {
				$xml_request .= $xml;
			}else{
				$xml_request .= '<'.$request.'>'.$xml.'</'.$request.'>';
			}
		}else{
			$xml_request .= '<'.$request.'/>';
		}

	$xml_request .= '
		</RequestDetails>
	</Request>';

	$startTime = microtime(true);

	//ob_start();   #
	//$out = fopen('php://output', 'w'); #

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $_config['eurosite']['link']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_request);

	//curl_setopt($ch, CURLOPT_VERBOSE, true);  #
	//curl_setopt($ch, CURLOPT_STDERR, $out);  #

	$xml_response = curl_exec($ch);
	curl_close($ch);

	//fclose($out);   #
	//$debug = ob_get_clean(); #
	//echo $debug; #

	$endTime = microtime(true);

	$response = xml2array($xml_response);
	$id_response = $response['Response']['AuditInfo']['ResponseId']['value'];
	$output = $response['Response']['ResponseDetails'][str_replace('Request', 'Response', $request)];

	db_query('UPDATE eurosite_request SET title = ?, request = ?, id_response = ?, response = ?, response_time = ? WHERE id_eurosite_request = ?', $request, $xml_request, $id_response, gzdeflate($xml_response), ($endTime - $startTime), $id_request);

	return $output;
}

function eurositeLoginXml($id_request){
	global $_config;

	$loginXML = '
		<AuditInfo>
			<RequestId>'.$id_request.'</RequestId>
			<RequestUser>'.$_config['eurosite']['user'].'</RequestUser>
			<RequestPass>'.$_config['eurosite']['pass'].'</RequestPass>
			<RequestTime>'.date('Y-m-d\TH:i:s').'</RequestTime>
			<RequestLang>RO</RequestLang>
		</AuditInfo>
	';

	return $loginXML;
}
