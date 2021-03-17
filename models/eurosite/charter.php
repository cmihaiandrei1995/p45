<?



function eurositeGetPackageNVRoutesRequest($transport_type = "search"){
	$xml = '
		<getPackageNVRoutesRequest>
			<Transport>'.$transport_type.'</Transport>
		</getPackageNVRoutesRequest>
	';

	return eurositeRequest("getPackageNVRoutesRequest", $xml);
}

function eurositeGetCharterDeparturesRequest(){
	$xml = '
		<getCharterDeparturesRequest/>
	';

	return eurositeRequest("getCharterDeparturesRequest", $xml);
}




function eurositeGetPackageNVPriceRequest($data){
	global $_eurosite_meal_codes, $_eurosite_facility_codes;

	$xml = '
		<getPackageNVPriceRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			<DepCountryCode>RO</DepCountryCode>
			<DepCityCode>'.$data['from_city'].'</DepCityCode>
			<Transport>plane</Transport>
			<CurrencyCode>EUR</CurrencyCode>
			<Language>RO</Language>
			<OfferType>TOATE</OfferType> <!-- ‘TOATE’, ‘NORMAL’, ‘EB’, ‘OFSPEC’, ‘LASTMIN’ -->
			<PeriodOfStay>
				<CheckIn>'.$data['date_from'].'</CheckIn>
				<CheckOut>'.$data['date_to'].'</CheckOut>
			</PeriodOfStay>
			<Days>0</Days>
			<Rooms>
				<Room Code="DB" NoAdults="2"/>
			</Rooms>
		</getPackageNVPriceRequest>
	';

	return eurositeRequest("getPackageNVPriceRequest", $xml);
}


function eurositeGetPackageNVPriceRequestForPricing($data){

	$xml = '
		<getPackageNVPriceRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			'.($data['zone'] != "" ? '<Zone>'.$data['zone'].'</Zone>' : '').'
			<DepCountryCode>RO</DepCountryCode>
			<DepCityCode>'.$data['from_city'].'</DepCityCode>
			<Transport>plane</Transport>
			<CurrencyCode>EUR</CurrencyCode>
			<Language>RO</Language>
			<!--<ProductName><![CDATA['.$data['title'].']]></ProductName>-->
            <TourOpCode>'.$data['tourop_code'].'</TourOpCode>
            <ProductCode>'.$data['code'].'</ProductCode>
			<OfferType>TOATE</OfferType> <!-- ‘TOATE’, ‘NORMAL’, ‘EB’, ‘OFSPEC’, ‘LASTMIN’ -->
			<PeriodOfStay>
				<CheckIn>'.$data['date_from'].'</CheckIn>
				<CheckOut>'.$data['date_to'].'</CheckOut>
			</PeriodOfStay>
			<Days>0</Days>
			';
			for($i=0; $i<$data['rooms']; $i++){
				if($data['rooms_info'][$i]['child'] > 0){
					$xml .= '
						<Room Code="DB" NoAdults="'.$data['rooms_info'][$i]['adult'].'" NoChildren="'.$data['rooms_info'][$i]['child'].'">
							<Children>';
								for($j=0; $j<$data['rooms_info'][$i]['child']; $j++){
									$xml .= '<Age>'.$data['rooms_info'][$i]['child_age'][$j].'</Age>';
								}
							$xml .= '
							</Children>
						</Room>
					';
				}else{
					$xml .= '<Room Code="DB" NoAdults="'.$data['rooms_info'][$i]['adult'].'"/>';
				}
			}
	$xml .= '
		</getPackageNVPriceRequest>
	';

	return eurositeRequest("getPackageNVPriceRequest", $xml);
}

function eurositeCharterAddBooking($search_data, $data, $booking, $passengers){

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
				<BookingItem ProductType="hotel">
					<ItemClientId>1</ItemClientId>
					<TourOpCode>'.$data['tour_op'].'</TourOpCode>
					<HotelItem>
						<BookingAgent>Online,Online,Paralela45 Online SRL,vanzari.online@paralela45.ro</BookingAgent>
						<BookingClient>'.$booking['title'].'</BookingClient>
						<CountryCode>'.$data['country_code'].'</CountryCode>
						<CityCode>'.$data['city_code'].'</CityCode>
						<ProductCode>'.$data['hotel_code'].'</ProductCode>
						<Language>RO</Language>
						<PeriodOfStay>
							<CheckIn>'.$data['check_in'].'</CheckIn>
						    <CheckOut>'.$data['check_out'].'</CheckOut>
						</PeriodOfStay>
						<PackageId>'.$data['package_id'].'</PackageId>
						<VariantId>'.$data['variant_id'].'</VariantId>
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
          			</HotelItem>
        		</BookingItem>
			</BookingItems>
    	</AddBookingRequest>
	';

	return eurositeRequest("AddBookingRequest", $xml);
}
