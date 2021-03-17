<? if(!$_booking['tracking_code_shown']){?>

	<?
	db_query('UPDATE booking SET tracking_code_shown = 1 WHERE id_booking = ?', $_booking['id_booking']);
	?>

	<img src="https://feedback.trusted.ro/api/5ad8b37ea21fda19c83a5064/?email=<?=$_booking['email']?>&name=<?=$_booking['title']?>&order=<?=$_booking['id_booking']?>&county=<?=$_booking['county']?>&email_after=3" style="display:none;width:0px; height:0px" width="0" height="0" />

	<script>
		$(document).ready(function(){

			_mktz.push(['_Goal', 'sale', '<?=$_booking['total']?>', {transaction: '<?=$_booking['id_booking']?>'}]);

			dataLayer.push({
			  	'ecommerce': {
			    	'purchase': {
			      		'actionField': {
			        		'id': '<?=$_booking['id_booking']?>',
			        		'affiliation': 'Paralela 45 Online',
			        		'revenue': '<?=$_booking['total']?>'
			      		},
			      		'products': [{
							<? if($_booking['type'] == "circuit"){?>
				          		'id': '<?=$_selected_data['id_circuit']?>',
							<? }?>
							<? if($_booking['type'] == "charter"){?>
								'id': '<?=$_selected_data['id_hotel']?>',
								'brand': '<?=$_city['title']?>',
								'category': 'Chartere',
							<? }?>
							<? if($_booking['type'] == "tourism"){?>
								'id': '<?=$_selected_data['id_hotel']?>',
								'brand': '<?=$_city['title']?>',
				          		'category': '<?=$_city['id_country'] == 126 ? "Turism intern" : "Sejururi"?>',
							<? }?>
							<? if($_booking['type'] == "insurance"){?>
								'id': 'insurance',
								'brand': 'Asigurari',
				          		'category': 'Asigurari',
							<? }?>
			          		'name': '<?=$_item['title']?>',
			          		'price': '<?=$_booking['total']?>',
			          		'quantity': 1
			       		}]
			    	}
			  	}
			});

		  	gtag('event', 'conversion', {
		      	'send_to': 'AW-1009319514/MUAYCMjIlH4Q2vyj4QM',
		      	'value': <?=$_booking['total']?>,
		      	'currency': 'EUR',
		      	'transaction_id': '<?=$_booking['id_booking']?>'
		  	});

			gtag('event', 'page_view', {
				'send_to': 'AW-1009319514',
				<? if($_booking['type'] == "circuit"){?>
					'dynx_itemid': 'CI<?=$_selected_data['id_circuit']?>',
				<? }?>
				<? if($_booking['type'] == "charter"){?>
					'dynx_itemid': 'CH<?=$_selected_data['id_hotel']?>',
				<? }?>
				<? if($_booking['type'] == "tourism"){?>
					'dynx_itemid': 'SJ<?=$_selected_data['id_hotel']?>',
				<? }?>
				<? if($_booking['type'] == "insurance"){?>
					'dynx_itemid': 'insurance',
				<? }?>
				'dynx_itemid2': '',
				'dynx_pagetype': 'conversion',
				'dynx_totalvalue': '<?=$_booking['total']?>'
			});

			<? if($_params['type'] != "insurance"){?>
				gtag('event', 'purchase', {
					'send_to': 'AW-1009319514',
					'items': [{
						<? if($_params['type'] == "circuit"){?>
			  				'destination': 'CI<?=$_selected_data['id_circuit']?>',
						<? }?>
						<? if($_booking['type'] == "charter"){?>
							'origin': '<?=$_selected_data['id_city_from']?>',
							'destination': 'CH<?=$_selected_data['id_hotel']?>',
						<? }?>
						<? if($_booking['type'] == "tourism"){?>
							'destination': 'SJ<?=$_selected_data['id_hotel']?>',
						<? }?>
			  			'google_business_vertical': '<?=$_params['type'] == "tourism" ? "hotel_rental" : "travel"?>'
			    	}]
				});
			<? }?>

			fbq('track', 'Purchase', {
			    value: <?=$_booking['total']?>,
			    currency: 'EUR',
				order_id: '<?=$_booking['id_booking']?>',
			    content_type: 'product',
				<? if($_booking['type'] == "circuit"){?>
					content_ids: 'CI<?=$_selected_data['id_circuit']?>',
				<? }?>
				<? if($_booking['type'] == "charter"){?>
					content_ids: 'CH<?=$_selected_data['id_hotel']?>-<?=$_selected_data['id_city_from']?>',
				<? }?>
				<? if($_booking['type'] == "tourism"){?>
					content_ids: 'SJ<?=$_selected_data['id_hotel']?>',
				<? }?>
				<? if($_booking['type'] == "insurance"){?>
					content_ids: 'insurance',
				<? }?>
			});

		});
	</script>

<? }?>
