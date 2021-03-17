<?

function eurositeGetCharterCitiesRequest($type = "departure"){
	$xml = '
		<getCharterCitiesRequest>
			<DepartureType>'.$type.'</DepartureType>
		</getCharterCitiesRequest>
	';
	
	return eurositeRequest("getCharterCitiesRequest", $xml);
}