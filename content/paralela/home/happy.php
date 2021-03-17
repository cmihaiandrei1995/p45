<div class="hd-page">
	<section class="header-hd">
		<div class="top-header-hd">
			<div class="container">
				<div class="row">
					<div class="col-xs-4">
						<a class="back-to-site" href="<?= route('home') ?>?home">« Inapoi la site</a>
					</div>
					<div class="col-xs-8 col-sm-4 col-sm-offset-4 call-txt">
						<a href="tel:0374 45 45 45"><img src="<?= $_base ?>static/img/call.png" alt=""></a>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-7 blue-header-hd">
					<div class="hd-intro">
						<a class="logo-hd" href="<?= route('happy') ?>" title="Paralela 45"><img src="<?= $_base ?>static/img/logo.png" alt="Paralela 45"></a>
						<img class="hd-img" src="<?= $_base ?>static/img/hd/happy.jpg" alt="Happy days" />

						<? /*
						<div class="fixedElement">
							<ul class="nav nav-tabs">
								<? foreach($_cities_from as $key => $title){?>
									<li class="city-top <? if($key == "bucuresti"){?>active<? }?>"><a data-toggle="tab" href="#<?=$key?>"><?=$title?></a></li>
								<? }?>
							  	<li><a data-toggle="modal" data-target="#myModal" href="#">Regulament</a></li>
							</ul>
						</div>
						*/ ?>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<img class="hd-rate" src="<?= $_base ?>static/img/bf/bf-rate.jpg" alt="Happy days Rate" />
				</div>
			</div>
		</div>
	</section>

	<section class="hd-countdown">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<span class="ztz">GRABESTE-TE, LOCURI LIMITATE!</span>
					<? /*<img class="countdown" src="<?= $_base ?>static/img/hd/hd-countdown.png" alt="Happy days Countdown" />*/?>
					<div class="your-clock"></div>
				</div>
			</div>
		</div>
	</section>

	<section class="hd-main-content">
		<div class="container">
			<span id="cities"></span>
			<div class="row">
				<div class="col-xs-12 col-md-3" id="fixedElement">
					<div class="fixedElement" id="">
						<p>Plecari din orasele:</p>
						<ul class="nav nav-tabs">
							<? foreach($_cities_from as $key => $title){?>
								<li class="city-top <? if($key == "bucuresti"){?>active<? }?>"><a data-toggle="tab" href="#<?=$key?>"><span>»</span> <?=$title?></a></li>
							<? }?>
							<li><a data-toggle="modal" data-target="#myModal" href="#">Regulament</a></li>
						</ul>
						<div class="sidebar">
							<div id="sticky_item_bf">
								<? foreach($_cities_from as $key => $title){?>
									<div id="<?=$key?>_side" class="<? if($key != "bucuresti"){?>hidden<? }?>">
										<? foreach($_sidebar[$key] as $offer => $sidebar){ ?>
											<? if($sidebar){?>
												<div class="sidebar-group">
													<h3 class="">
														<a href="#<?=$key .'-'. $offer?>">
															<span class="icon i<?=$_offers_icons[$offer]?>"></span>
															<?=$_offers_titles[$offer]?>
														</a>
													</h3>
													<ul>
														<? foreach($sidebar as $country => $zones){ ?>
															<li>
																<a href="#<?=$key?>-<?=$offer.'-'.generate_name($country)?>"><?=$country?></a>
																<? if($offer == "charter"){?>
																	<ul class="">
																		<? foreach($zones as $zone){?>
																			<li><a href="#<?=$key?>-<?=$offer.'-'.generate_name($country).'-'.generate_name($zone)?>"><?=$zone?></a></li>
																		<? }?>
																	</ul>
																<? }?>
															</li>
														<? }?>
													</ul>
												</div>
											<? }?>
										<? } ?>
									</div>
								<? } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-9 pull-right">
					<div class="tab-content">
						<? foreach($_cities_from as $key => $title){?>
							<div id="<?=$key?>" class="tab-pane fade in <? if($key == "bucuresti"){?>active<? }?> item--flex1 clearfix">

							  	<? foreach($_offers[$key] as $offer => $countries){  if($offer == 'charter'){?>
									<div class="liv-category-header">
										<img src="<?=$_base?>static/img/bf/i<?=$_offers_icons[$offer]?>-black.png"><?=$_offers_titles[$offer]?> • PLECARI DIN <?=$title?>
										<ul>
											<? $kz = 0; foreach($countries as $country => $zones){?>
												<li>
													<a href="#<?=$key?>-<?=$offer?>-<?=generate_name($country)?>"><?=$country?></a>
													<? if($kz < count($countries)-1){?>
														&nbsp;&nbsp;|&nbsp;&nbsp;
													<? }?>
												</li>
											<? $kz++;}?>
										</ul>
									</div>
								<? } ?>
									<div class="">

									  	<? foreach($countries as $country => $zones){?>
									  		<a class="anchor-bf" id="<?=$key?>-<?=$offer?>-<?=generate_name($country)?>"></a>
											<div id="<?=$key?>-<?=$offer?>-<?=generate_name($country)?>"></div>
											<? foreach($zones as $zone => $hotels){?>
												<div id="<?=$key?>-<?=$offer?>-<?=generate_name($country)?>-<?=generate_name($zone)?>"></div>
										  		<? if($hotels){?>
											  		<a class="anchor-bf" id="<?=$key?>-<?=$offer?>-<?=generate_name($zone)?>"></a>
												  	<h2><?=$_offers_titles[$offer]?> - <b><?=$zone?></b></h2>
												    <div class="row">
												    	<? foreach($hotels as $hotel){ ?>
												    		<? if($hotel['images'][0]['small'] && $hotel['price'] > 0){?>
														    	<div class="col-sm-6 col-md-4 box-wrapper">
														    		<div class="box">
														    			<p class="zone"><?=$zone?></p>
																		<? if($hotel['discount'] != ""){?>
															    			<p class="discount">
															    				<!--<small><b>pana la</b></small>-->
															    				-<?=$hotel['discount']?>%
																				<? if($hotel['offer_type'] == "charter"){?>
																    				<!--<small><i>*din cazare</i></small>-->
																				<? }?>
															    			</p>
																		<? }?>
															    		<div class="img-holder">
															    			<a href="<?=$hotel['url']?>" target="_blank" class="img-wrapper">
															    				<img class="lazy" data-original="<?=$hotel['images'][0]['big']?>" alt="<?=$hotel['title']?>"/>
															    			</a>
															    			<? /*
															    			<? if($hotel['discount_txt']){?>
																    			<span class="discount <?= $hotel['extra_txt'] != '' ? 'discount-small' : '' ?>">
															    					<?=$hotel['discount_txt']?>
																    				<? if($hotel['extra_txt']){?>
																    					<small><?=$hotel['extra_txt']?></small>
																    				<? }?>
																    			</span>
															    			<? }?>
																			 */ ?>
															    		</div>
															    		<div class="title text-center">
															    			<h3>
															    				<a href="<?=$hotel['url']?>" target="_blank">
															    					<?=$hotel['title']?> <br />
															    					<? if($hotel['stars']){?>
															    						(<?=$hotel['stars']?> stele)
															    					<? } ?>
															    				</a>
															    			</h3>
																			<? /*
															    			<? if($hotel['valabilitate']){?>
															    				<span><b>Valabilitate</b>: <?=$hotel['valabilitate']?></span>
															    			<? }?>
															    			<? if($hotel['plecare']){?>
															    				<span><b>Plecare</b>: <?=$hotel['plecare']?></span>
															    			<? }?>
																			*/ ?>
															    			<span>
																				<img src="<?= $_base ?>static/img/bf/i<?=$_offers_icons[$offer]?>-small.png" alt="" />
																				<? if($hotel['offer_type'] == "hotel"){?>
																					<b>Perioada:</b> <?=$hotel['period_txt']?>
																				<? }elseif($hotel['offer_type'] == "circuit"){?>
																					<b>Plecare:</b> <?=$hotel['plecare']?>
																				<? }else{?>
																					<b>Plecare:</b> <?=date("d.m.Y", strtotime($hotel['price_date_from']))?>
																				<? }?>
																			</span>
															    			<div class="price">
															    				de la
															    				<? if($hotel['price_old'] != ""){?>
															    					<span class="old"><?=$hotel['price_old']?> €</span>
															    				<? }else{?>
															    					<span class="old"></span>
															    				<? }?>
															    				<span class="new"><b><?=$hotel['price']?> €</b></span><br>
																				<? if($hotel['offer_type'] == "hotel"){?>
																					/ persoana / noapte
																				<? }else{?>
																    				/ persoana / <?=$hotel['nr_nights']?> nopti
																				<? }?>
															    			</div>
															    		</div>
															    		<a class="rezerva" href="<?=$hotel['url']?>" target="_blank">Rezerva</a>
														    		</div>
														    	</div>
													    	<? }?>
												    	<? } ?>
												    </div>

													<? if($offer == 'charter'){?>
														<div class="row">
															<div class="col-xs-12 col-md-6 col-md-offset-3">
																<br><br><br>
																<a class="rezerva" href="<?=$_base?>vacante/charter-<?=generate_name($zone)?>-plecare-din-<?=generate_name($key)?>/?&srt=dsc" target="_blank">Vezi toate ofertele din <?=$zone?></a>
															</div>
														</div>
													<? }?>
												<? }?>
											<? }?>
									    <? }?>
									</div>
							    <? } ?>

							</div>
						<? }?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title text-center">Termeni si conditii de acordare a reducerilor<br>Happy days by Paralela 45</h4>
		      	</div>
		           	<div class="modal-body">
					Reducerile sunt valabile intre 17 noiembrie 2018 si 20 noiembrie 2018 pana la ora 23:59 (sau in perioada mentionata la fiecare hotel, dar nu mai mult de 17-20 noiembrie 2018). Campania Happy days incepe sambata 17 noiembrie ora 00:01 si se incheie pe 20 noiembrie 2018 la ora 23:59.
					&nbsp;
					<br>
					<br>
					<strong>Regulament Happy days:</strong>
					<ol>
					 	<li>Toate preturile afisate de Paralela 45 contin taxele de aeroport</li>
					 	<li>Se accepta atat inscrierile online, cat si cele de la Targul de Turism al Romaniei si din toate agentiile Paralela 45 si partenere</li>
					 	<li>Sunt incluse in promotie toate hotelurile afisate in pagina campaniei si care au reduceri aplicate in siteul paralela45.ro</li>
					 	<li>Promotia se aplica pe anumite date de plecare, pentru pachetele de 7 nopti si este valabila in limita locurilor disponibile</li>
					 	<li>Pretul final al pachetului se considera rezultatul calcului efectuat in pagina hotelului, pret influentat de numarul de adulti, copii si varstele acestora.</li>
					 	<li>Camerele marcate cu "disponibil" in pagina hotelului se pot rezerva cu confirmare imediata la plata online cu cardul. Pentru alte modalitati de plata, rezervarea camerei se considera efectuata dupa finalizarea platii avansului (conform regulilor)</li>
					 	<li>Daca disponibilitatile apar epuizate online, efectuati rezervari pe lista de asteptare ("request") sau transmiteti formular de rezervare - exista posibilitatea suplimentarii locurilor</li>
					 	<li>Reducerile sunt aplicate atat sub forma procentuala cat si valoric - suma fixa (in functie de produs); nu se ofera reduceri din suplimente</li>
					 	<li>Procentele maxime afisate reprezinta reducerea Early Booking calculata din cazare cumulata cu reducerea TTR.</li>
					</ol>
					&nbsp;
					<br>
					<p><strong> Conditii de comercializare: </strong></p>
					&nbsp;
					<p><strong>	1. PACHETE CHARTER:  </strong></p>
					&nbsp;
					<p><strong>TERMENE DE PLATA:  </strong></p>
					<ul>
						<li>20% din pretul pachetului turistic - la inscriere; </li>
						<li>30% din pretul pachetului turistic - la termenul limita al pragului Early Booking aplicat la inscriere;  </li>
						<li>50% din pretul pachetului turistic - cu minim 30 zile inaintea plecarii.</li>

					</ul>
					<p>Procentul aferent primei plati sa va calcula in functie de momentul inscrierii. Daca inscrierea intervine cu mai putin de 30 zile inaintea plecarii, pachetul turistic se va achita integral. In cazul nerespectarii termenelor de plata, Tour Operatorul isi rezerva dreptul de a anula rezervarea.</p>
					&nbsp;
					<strong>CONDITII DE ANULARE / PENALIZARI:</strong>
					<ul>
						<li>20% din pretul pachetului turistic daca renuntarea se face din momentul confirmarii rezervarii si pana cu 60 zile inaintea plecarii; </li>
						<li>50% din pretul pachetului turistic daca renuntarea se face in intervalul 59 zile – 30 zile inaintea plecarii; </li>
						<li>80% din pretul pachetului turistic daca renuntarea se face in intervalul 29 zile – 7 zile inaintea plecarii;</li>
						<li>100% din pretul pachetului turistic daca renuntarea se face cu mai putin de 7 zile inaintea plecarii</li>
					</ul>
					<p>Aceste conditii sunt standard si se pot modifica in cazul in care furnizorul de servicii la sol impune conditii speciale de anulare. </p>
					&nbsp;
					<strong>NOTIFICARI SUPLIMENTARE:</strong>
					<ul>
						<li>Nerespectarea conditiilor de plata aplicate rezervarilor tip Early Booking/Promotii conduce la modificarea pretului pachetului conform ofertei standard.</li>
						<li>Orice modificare reprezinta anularea rezervarii cu penalizari si refacerea acesteia la pretul si conditiile din momentul reinscrierii;</li>
					</ul>
					&nbsp;
					<strong>	2. REVELIOANE: </strong>conform programului detaliat al circuitului
					&nbsp;
					<p>Plata poate fi facuta online pe site, online prin link de plata sau cash (numerar) in agentiile Paralela 45 inclusiv in zilele de 19.11 si 20.11.2018.</p>
					<p>Plata poate fi facuta si in rate fara dobanda daca ai unul dintre cardurile partenere: <a href="https://www.paralela45.ro/info/vacante-in-rate/" target="_blank">https://www.paralela45.ro/info/vacante-in-rate/</a></p>
					<p>Important! Conditiile de plata pot varia in functie de hotelul sau charterul ales. Ele vor fi afisate complet, alaturi de scadente in pagina de rezervare.</p>

		      	</div>
		    </div>
		</div>
	</div>

</div>

<script>
$(document).ready(function(){
	$(".lazy").lazyload({threshold : 50 });
	$('.city-top a').click(function(){
		$("img.laz").show().lazyload({ event : 'click' });


		var city_id = $(this).attr('href');
		//$('.lazy-punte').trigger('change');
		$('.sidebar ' + city_id +'_side' ).removeClass('hidden');
		$('.sidebar ' + city_id +'_side' ).siblings().addClass('hidden');
		$('html,body').animate({
            scrollTop: $("#cities").offset().top
        }, 500);
	});



	 if($(window).width()>=992) {
		$('#fixedElement').stick_in_parent({
			spacer: false,
			//recalc_every: 1,
			//offset_top:100
		});

		$('#fixedElement').parent()
			.on('sticky_kit:bottom', function(e) {
		    	$(this).parent().css('position', 'static');
		    	console.log('bottom');
		})
			.on('sticky_kit:unbottom', function(e) {
		    	$(this).parent().css('position', 'relative');
		    	console.log('unbottom');
		})

	}

		 $('.hd-page .sidebar .sidebar-group h3 a').click(function(e){
	 	 e.preventDefault();
	 	$('.hd-page .sidebar .sidebar-group h3 a').parent().removeClass('active');
	 	$(this).parent().addClass('active');

	 	var anchor =  $(this).attr('href');
	 	var id_anchor = anchor.substring(1, anchor.length);
	 	$('html,body').animate({
            scrollTop: $("#"+id_anchor).offset().top
        }, 500);

	 });

	 $('.hd-page .sidebar .sidebar-group ul li a').click(function(e){
	 	e.preventDefault();
	 	$('.hd-page .sidebar .sidebar-group h3').removeClass('active');
	 	$(this).closest('ul').siblings('h3').addClass('active');
	 	$('.hd-page .sidebar .sidebar-group ul li a').removeClass('active');
	 	$(this).addClass('active');

	 	var anchor =  $(this).attr('href');
	 	var id_anchor = anchor.substring(1, anchor.length);
	 	$('html,body').animate({
            scrollTop: $("#"+id_anchor).offset().top
        }, 500);

     });

     $(window).on('scroll', function() {
	    $('.anchor-bf').each(function() {
	        if($(window).scrollTop() >= $(this).offset().top -50) {
	            var id = $(this).attr('id');
              //$('.hd-page .sidebar .sidebar-group ul li a ul li a').removeClass('active');
	            //$('.hd-page .sidebar .sidebar-group ul li a').removeClass('active');
	            $('.hd-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').addClass('active');
	            $('.hd-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').parent('li').siblings().children('a').removeClass('active');
	            $('.hd-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('.sidebar-group').siblings().find('a').removeClass('active');

	            $('.hd-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('ul').siblings('h3').addClass('active');
	            $('.hd-page .sidebar .sidebar-group ul li a[href="#'+ id +'"]').closest('.sidebar-group').siblings().find('h3').removeClass('active');

	            //$('.hd-page .sidebar .sidebar-group h3 a[href="#'+ id +'"]').parent().addClass('active');
	            //$('.hd-page .sidebar .sidebar-group h3 a[href="#'+ id +'"]').parent('.sidebar-group').siblings().children('h3').removeClass('active');
	        }
	    });
	});
});
</script>

<style>
header, .partners-wrapper, footer .fixed{
	display:none !important;
}
</style>
