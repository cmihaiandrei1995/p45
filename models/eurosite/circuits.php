<?

function eurositeCircuitSearchCityRequest(){
	return eurositeRequest("CircuitSearchCityRequest");
}

function eurositeGetCircuitLabelsRequest(){
	return eurositeRequest("getCircuitLabelsRequest", $xml);
}

function eurositeCircuitSearchRequest($data){

	$xml = '
		<CircuitSearchRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			<Year>'.$data['year'].'</Year>
			<Month>'.$data['month'].'</Month>
			<CurrencyCode>EUR</CurrencyCode>
			<Language>RO</Language>
			<Rooms>
				<Room Code="DB" NoAdults="2"/>
			</Rooms>
		</CircuitSearchRequest>
	';

	return eurositeRequest("CircuitSearchRequest", $xml);
}

function eurositeCircuitSearchRequestForPricing($data){
	global $_circuit_room_types;

	$xml = '
		<CircuitSearchRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			<Year>'.$data['year'].'</Year>
			<Month>'.$data['month'].'</Month>
			<ProductName><![CDATA['.$data['title'].']]></ProductName>
			<CurrencyCode>EUR</CurrencyCode>
			<Language>RO</Language>
			<Rooms>
			';
			for($i=0; $i<$data['rooms']; $i++){
				if($data['rooms_info'][$i]['child'] > 0){
					$xml .= '
						<Room Code="'.$_circuit_room_types[$data['rooms_info'][$i]['type']]['code'].'" NoAdults="'.$data['rooms_info'][$i]['adult'].'" NoChildren="'.$data['rooms_info'][$i]['child'].'">
							<Children>
								<Age>'.$data['rooms_info'][$i]['child_age'].'</Age>
							</Children>
						</Room>
					';
				}else{
					$xml .= '<Room Code="'.$_circuit_room_types[$data['rooms_info'][$i]['type']]['code'].'" NoAdults="'.$data['rooms_info'][$i]['adult'].'"/>';
				}
			}
	$xml .= '
			</Rooms>
		</CircuitSearchRequest>
	';

	return eurositeRequest("CircuitSearchRequest", $xml);
}

function eurositeCircuitGetProductInfoRequest($id){

	$tmp = explode('|', $id);
	$xml = '
		<getProductInfoRequest>
			<ProductType>circuit</ProductType>
			<TourOpCode>'.$tmp[1].'</TourOpCode>
			<ProductCode>'.$id.'</ProductCode>
		</getProductInfoRequest>
	';

	return eurositeRequest("getProductInfoRequest", $xml);
}

function eurositeCircuitSearchServiceRequest($id, $subid){

	$xml = '
		<CircuitSearchServiceRequest>
	    	<CircuitId>'.$id.'</CircuitId>
	    	<CircuitDep>'.$subid.'</CircuitDep>
	    </CircuitSearchServiceRequest>
	';

	return eurositeRequest("CircuitSearchServiceRequest", $xml);
}

function eurositeCircuitSearchServicePriceRequest($id, $subid, $type, $service, $passenger_type = "adult"){

	$xml = '
		<CircuitSearchServicePriceRequest>
	      	<CircuitId>'.$id.'</CircuitId>
	     	<CircuitDep>'.$subid.'</CircuitDep>
	      	<SuppType>'.$type.'</SuppType>
	      	<Service>'.$service.'</Service>
		  	<CurrencyCode>EUR</CurrencyCode>
			<PaxNames>
	        	<PaxName PaxType="'.$passenger_type.'">Nume 1</PaxName>
			</PaxNames>
	    </CircuitSearchServicePriceRequest>
	';

	return eurositeRequest("CircuitSearchServicePriceRequest", $xml);
}

function eurositeCircuitFeesRequest($id){

	$xml = '
		<CircuitFeesRequest>
	    	<UniqueId>'.$id.'</UniqueId>
	    </CircuitFeesRequest>
	';

	return eurositeRequest("CircuitFeesRequest", $xml);
}


function eurositeCircuitPaymentInstallments($circuit_id, $unique_id, $departure_charter, $tour_op, $data, $rooms_solution){

	$xml = '
		<getItemPaymentDLSRequest CurrencyCode="EUR">
	    	<BookingItems>
				<BookingItem ProductType="circuit">
					<TourOpCode>'.$tour_op.'</TourOpCode>
					<CircuitItem>
			            <CircuitId>'.$circuit_id.'</CircuitId>
			            <SearchId>'.$unique_id.'</SearchId>
			            <DepartureCharter>'.$departure_charter.'</DepartureCharter>
			            <Rooms>';

			            for($i=0; $i<$data['rooms']; $i++){
			            	if($data['rooms_info'][$i]['child'] > 0){
			            		$xml .= '<Room Code="'.$rooms_solution[$i].'" NoAdults="'.$data['rooms_info'][$i]['adult'].'"  NoChildren="'.$data['rooms_info'][$i]['child'].'">';
							}else{
								$xml .= '<Room Code="'.$rooms_solution[$i].'" NoAdults="'.$data['rooms_info'][$i]['adult'].'">';
							}

							$xml .= '<PaxNames>';

							for($j=1; $j<=$data['rooms_info'][$i]['adult']; $j++){
								$xml .= '<PaxName PaxType="adult">ADULT '.$j.'</PaxName>';
							}
							for($j=1; $j<=$data['rooms_info'][$i]['child']; $j++){
								$xml .= '<PaxName PaxType="child" ChildAge="3">CHILD '.$j.'</PaxName>';
							}

							$xml .= '</PaxNames>';
							$xml .= '</Room>';
						}

						$xml .= '
			            </Rooms>
			    	</CircuitItem>
				</BookingItem>
			</BookingItems>
	    </getItemPaymentDLSRequest>
	';

	return eurositeRequest("getItemPaymentDLSRequest", $xml);
}

function eurositeCircuitAddBooking($search_data, $data, $booking, $passengers){

	foreach($passengers as $passenger){
		$_passengers[$passenger['room'] - 1][$passenger['type']][$passenger['nr']] = array(
			'full_name' => $passenger['name']." ".$passenger['surname'],
			'name' => $passenger['name'],
			'surname' => $passenger['surname'],
			'dob' => $passenger['dob'],
			'gender' => $passenger['gender']
		);
	}

	$data['rooms_solution'] = json_decode(html_entity_decode($data['rooms_solution']), true);

	$xml = '
		<AddBookingRequest CurrencyCode="EUR">
			<BookingName>P45site-'.$booking['id_booking'].'</BookingName>
			<BookingClientId>P45site-'.$booking['id_booking'].'</BookingClientId>
			<BookingItems>
				<BookingItem ProductType="circuit">
					<ItemClientId>1</ItemClientId>
					<TourOpCode>'.$data['tour_op'].'</TourOpCode>
					<CircuitItem>
						<BookingAgent>Online,Online,Paralela45 Online SRL,vanzari.online@paralela45.ro</BookingAgent>
						<BookingClient>'.$booking['title'].'</BookingClient>
						<CircuitId>'.$data['circuit_id'].'</CircuitId>
						<SearchId>'.$data['unique_id'].'</SearchId>
						<DepartureCharter>'.$data['departure_charter'].'</DepartureCharter>
						<!--
						<SuppServices>
              				<Service>
                				<Code>1</Code>
                				<Type>charters</Type>
                				<CharterId>463</CharterId>
                				<PaxIds>
							    	<PaxId>1</PaxId>
							    	<PaxId>2</PaxId>
							    	<PaxId>3</PaxId>
    							</PaxIds>
  							</Service>
						</SuppServices>
						-->
						<Rooms>';

			            for($i=0; $i<$search_data['rooms']; $i++){
			            	if($search_data['rooms_info'][$i]['child'] > 0){
			            		$xml .= '<Room Code="'.$data['rooms_solution'][$i].'" NoAdults="'.$search_data['rooms_info'][$i]['adult'].'"  NoChildren="'.$search_data['rooms_info'][$i]['child'].'">';
							}else{
								$xml .= '<Room Code="'.$data['rooms_solution'][$i].'" NoAdults="'.$search_data['rooms_info'][$i]['adult'].'">';
							}

							$xml .= '<PaxNames>';

							for($j=1; $j<=$search_data['rooms_info'][$i]['adult']; $j++){
								$xml .= '<PaxName PaxType="adult" TGender="'.$_passengers[$i]['adult'][$j]['gender'].'" DOB="'.$_passengers[$i]['adult'][$j]['dob'].'">'.$_passengers[$i]['adult'][$j]['full_name'].'</PaxName>';
							}
							for($j=1; $j<=$search_data['rooms_info'][$i]['child']; $j++){
								$xml .= '<PaxName PaxType="child" TGender="C" DOB="'.$_passengers[$i]['child'][$j]['dob'].'">'.$_passengers[$i]['child'][$j]['full_name'].'</PaxName>';
							}

							$xml .= '</PaxNames>';
							$xml .= '</Room>';
						}

						$xml .= '
            			</Rooms>
          			</CircuitItem>
        		</BookingItem>
			</BookingItems>
    	</AddBookingRequest>
	';

	return eurositeRequest("AddBookingRequest", $xml);
}
