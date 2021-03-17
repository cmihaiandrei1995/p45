<?

function eurositeGetHotelPriceRequest($data, $currency = "EUR"){
	global $_eurosite_meal_codes, $_eurosite_facility_codes;

	$xml = '
		<getHotelPriceRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			<CurrencyCode>'.$currency.'</CurrencyCode>
			<Language>RO</Language>
			<OfferType>TOATE</OfferType> <!-- ‘TOATE’, ‘NORMAL’, ‘EB’, ‘OFSPEC’, ‘LASTMIN’ -->
			<PeriodOfStay>
				<CheckIn>'.$data['date_from'].'</CheckIn>
				<CheckOut>'.$data['date_to'].'</CheckOut>
			</PeriodOfStay>
			<Rooms>
				<Room Code="DB" NoAdults="2"/>
			</Rooms>
		</getHotelPriceRequest>
	';

	return eurositeRequest("getHotelPriceRequest", $xml);
}


function eurositeGetHotelPriceRequestForPricing($data, $currency = "EUR"){
	$xml = '
		<getHotelPriceRequest>
			<CountryCode>'.$data['country'].'</CountryCode>
			<CityCode>'.$data['city'].'</CityCode>
			<CurrencyCode>'.$currency.'</CurrencyCode>
			<Language>RO</Language>
			<OfferType>TOATE</OfferType> <!-- ‘TOATE’, ‘NORMAL’, ‘EB’, ‘OFSPEC’, ‘LASTMIN’ -->
			<PeriodOfStay>
				<CheckIn>'.$data['date_from'].'</CheckIn>
				<CheckOut>'.$data['date_to'].'</CheckOut>
			</PeriodOfStay>
			<!--<ProductName><![CDATA['.$data['title'].']]></ProductName>-->
            <TourOpCode>'.$data['tourop_code'].'</TourOpCode>
            <ProductCode>'.$data['code'].'</ProductCode>
			<Rooms>
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
			</Rooms>
		</getHotelPriceRequest>
	';

	return eurositeRequest("getHotelPriceRequest", $xml);
}




function eurositeGetProductInfoRequest($hotelCode, $operator, $countryCode, $cityCode){

   $xml = '<ProductType>hotel</ProductType>
           <CountryCode>'.$countryCode.'</CountryCode>
           <CityCode>'.$cityCode.'</CityCode>
           <TourOpCode>'.($operator == "" ? "P45" : $operator).'</TourOpCode>
           <ProductCode>'.$hotelCode.'</ProductCode>';

	return eurositeRequest("getProductInfoRequest", $xml);
}

function eurositeHotelSearchServiceRequest($hotelCode, $checkinDate, $checkoutDate, $countryCode, $cityCode, $tourOpCode, $variantId){

    $xml = '
    	<getHotelServiceTypesRequest>
    		<CountryCode>'.$countryCode.'</CountryCode>
            <CityCode>'.$cityCode.'</CityCode>
            <TourOpCode>'.$tourOpCode.'</TourOpCode>
            <ProductCode>'.$hotelCode.'</ProductCode>
            <VariantId>'.$variantId.'</VariantId>
            <Language>RO</Language>
            <PeriodOfStay>
                <CheckIn>'.$checkinDate.'</CheckIn>
                <CheckOut>'.$checkoutDate.'</CheckOut>
            </PeriodOfStay>
   		</getHotelServiceTypesRequest>
    ';

    return eurositeRequest("getHotelServiceTypesRequest", $xml);
}


function eurositeHotelSearchServicePriceRequest($hotelCode, $checkinDate, $checkoutDate, $countryCode, $cityCode, $tourOpCode, $variantId, $type, $service, $passengerType, $currency = "EUR"){

    $xml = '
		<getHotelServicePriceRequest>
    		<CountryCode>'.$countryCode.'</CountryCode>
            <CityCode>'.$cityCode.'</CityCode>
            <TourOpCode>'.$tourOpCode.'</TourOpCode>
            <ProductCode>'.$hotelCode.'</ProductCode>
            <CurrencyCode>'.$currency.'</CurrencyCode>
            <VariantId>'.$variantId.'</VariantId>
            <Language>RO</Language>
            <Services>
                <Service>
                    <ServiceType>'.$type.'</ServiceType>
                    <ServiceCode>'.$service.'</ServiceCode>
                    <PeriodOfStay>
                        <CheckIn>'.$checkinDate.'</CheckIn>
                        <CheckOut>'.$checkoutDate.'</CheckOut>
                    </PeriodOfStay>
                    <PaxNames>
			        	<PaxName PaxType="'.$passengerType.'">Nume 1</PaxName>
					</PaxNames>
     			</Service>
            </Services>
     	</getHotelServicePriceRequest>
     ';

     return eurositeRequest("getHotelServicePriceRequest", $xml);
}


function eurositeGetHotelCancelationFeesRequest($hotelCode, $checkinDate, $checkoutDate, $countryCode, $cityCode, $tourOpCode, $variantId, $data, $rooms_solution, $currency = "EUR"){

	$xml = '
		<getItemFeesRequest CurrencyCode="'.$currency.'">
            <BookingItems>
                <BookingItem ProductType="hotel">
                    <TourOpCode>'.$tourOpCode.'</TourOpCode>
                    <HotelItem>
						<CountryCode>'.$countryCode.'</CountryCode>
						<CityCode>'.$cityCode.'</CityCode>
						<ProductCode>'.$hotelCode.'</ProductCode>
						<PeriodOfStay>
							<CheckIn>'.$checkinDate.'</CheckIn>
							<CheckOut>'.$checkoutDate.'</CheckOut>
                        </PeriodOfStay>
                        <VariantId>'.$variantId.'</VariantId>
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
                    </HotelItem>
                </BookingItem>
            </BookingItems>
        </getItemFeesRequest>
	';

	return eurositeRequest("getItemFeesRequest", $xml);
}


function eurositeHotelPaymentInstallments($hotelCode, $checkinDate, $checkoutDate, $countryCode, $cityCode, $tourOpCode, $variantId, $data, $rooms_solution, $currency = "EUR"){

	$xml = '
		<getItemPaymentDLSRequest CurrencyCode="'.$currency.'">
	    	<BookingItems>
				<BookingItem ProductType="hotel">
					<TourOpCode>'.$tourOpCode.'</TourOpCode>
					<HotelItem>
						<CountryCode>'.$countryCode.'</CountryCode>
			            <CityCode>'.$cityCode.'</CityCode>
			            <ProductCode>'.$hotelCode.'</ProductCode>
						<PeriodOfStay>
	                        <CheckIn>'.$checkinDate.'</CheckIn>
	                        <CheckOut>'.$checkoutDate.'</CheckOut>
	                    </PeriodOfStay>
						<VariantId>'.$variantId.'</VariantId>
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
					</HotelItem>
				</BookingItem>
			</BookingItems>
	    </getItemPaymentDLSRequest>
	';

	return eurositeRequest("getItemPaymentDLSRequest", $xml);
}



function eurositeHotelAddBooking($search_data, $data, $booking, $passengers, $currency = "EUR"){

	foreach($passengers as $passenger){
		$_passengers[$passenger['room'] - 1][$passenger['type']][$passenger['nr']] = array(
			'full_name' => $passenger['name']." / ".$passenger['surname'],
			'name' => $passenger['name'],
			'surname' => $passenger['surname'],
			'dob' => $passenger['dob'],
			'gender' => $passenger['gender']
		);
	}

	$data['rooms_solution'] = json_decode(html_entity_decode($data['rooms_solution']), true);

	$xml = '
		<AddBookingRequest CurrencyCode="'.$currency.'">
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
