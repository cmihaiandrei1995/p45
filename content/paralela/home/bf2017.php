<div class="bf-page">
	<div class="container-fluid header-bf">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8 text-center">
				<p class="clearfix back-to-site">
					<a class="pull-left" href="<?= route('home') ?>?home"><i class="zmdi zmdi-chevron-left"></i> Inapoi la site</a>
					<a class="pull-right" href="tel:0219129">Call Center: 0219129</a>
				</p>
				<a class="logo-bf" href="<?= route('bf') ?>" title="Paralela 45"><img src="<?= $_base ?>static/img/logo.png" alt="Paralela 45"></a>
				<img src="<?= $_base ?>static/img/bf/city-bf.png" alt="Black Friday" />
				<img class="bf-img" src="<?= $_base ?>static/img/bf/bf-bf.png" alt="Black Friday" />
				<p id="cities"><i class="zmdi zmdi-circle"></i> Promotie valabila: 17 noiembrie 2017 <i class="zmdi zmdi-circle"></i></p>
				<div class="fixedElement">
					<ul class="nav nav-tabs">
						<? foreach($_cities_from as $key => $title){?>
							<li class="city-top <? if($key == "bucuresti"){?>active<? }?>"><a data-toggle="tab" href="#<?=$key?>"><?=$title?></a></li>
						<? }?>
					  	<li><a data-toggle="modal" data-target="#myModal" href="#">Regulament</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row ">
			<div class="tab-content">
				<? foreach($_cities_from as $key => $title){?>
					<div id="<?=$key?>" class="tab-pane fade in <? if($key == "bucuresti"){?>active<? }?> item--flex1 clearfix">
						<div class="sidebar col-sm-2">
							<div id="sticky_item_bf<?=$key?>">
								<? foreach($_sidebar[$key] as $offer => $sidebar){ ?>
									<? if($sidebar){?>
										<div class="sidebar-group">
											<h3 class="">
												<a href="#<?=$key .'-'. $offer?>">
													<span class="icon <?=$offer == "charter" ? 'charter' : ''?> <?=$offer == "tourism_ro" ? 't-intern' : ''?> <?=$offer == "tourism" ? 't-extern' : ''?> <?=$offer == "circuit" ? 'circuit' : ''?>"></span>
													<?=$_offers_titles[$offer]?>
												</a>
											</h3>
											<ul>
												<? foreach($sidebar as $dest){?>
													<li><a href="#<?=$key?>-<?=$offer.'-'.generate_name($dest)?>"><?=$dest?></a></li>
												<? }?>
											</ul>
										</div>
									<? }?>
								<? } ?>
							</div>
						</div>
						<div class="col-sm-8">
						  	<? foreach($_offers[$key] as $offer => $zones){ ?>
							  	<a class="anchor-bf" id="<?=$key?>-<?=$offer?>"></a>
							  	<? foreach($zones as $zone => $hotels){?>
							  		<? if($hotels){?>
								  		<a class="anchor-bf" id="<?=$key?>-<?=$offer?>-<?=generate_name($zone)?>"></a>
									  	<h2><?=$_offers_titles[$offer]?> - <b><?=$zone?></b></h2>
									    <div class="row">
									    	<? foreach($hotels as $hotel){ ?>
									    		<? if($hotel['images'][0]['small'] && $hotel['price'] > 0){?>
											    	<div class="col-sm-6 col-md-4">
											    		<div class="box">
												    		<div class="img-holder">
												    			<a href="<?=$hotel['url']?>" target="_blank">
												    				<img class="lazy" data-original="<?=$hotel['images'][0]['big']?>" alt="<?=$hotel['title']?>"/>
												    			</a>
												    			<? if($hotel['discount_txt']){?>
													    			<span class="discount <?= $hotel['extra_txt'] != '' ? 'discount-small' : '' ?>">
												    					<?=$hotel['discount_txt']?>
													    				<? if($hotel['extra_txt']){?>
													    					<small><?=$hotel['extra_txt']?></small>
													    				<? }?>
													    			</span>
												    			<? }?>
												    		</div>
												    		<div class="title text-center">
												    			<h3>
												    				<a href="<?=$hotel['url']?>" target="_blank">
												    					<?=$hotel['title']?> <br /> 
												    					<? if($hotel['city']['title']){?>
												    						(<?=$hotel['city']['title']?>)
												    					<? }?>
												    				</a>
												    			</h3>
												    			<? if($hotel['valabilitate']){?>
												    				<span><b>Valabilitate</b>: <?=$hotel['valabilitate']?></span>
												    			<? }?>
												    			<? if($hotel['plecare']){?>
												    				<span><b>Plecare</b>: <?=$hotel['plecare']?></span>
												    			<? }?>
												    			<div class="price">
												    				<span class="new">de la <b><?=$hotel['price']?> €</b></span>
												    				<? if($hotel['price_old'] != ""){?>
												    					<span class="old"><?=$hotel['price_old']?> €</span>
												    				<? }else{?>
												    					<span class="old"></span>
												    				<? }?>
												    			</div>
												    		</div>
												    		<a class="rezerva" href="<?=$hotel['url']?>" target="_blank">Rezerva</a>
											    		</div>
											    	</div>
										    	<? }?>
									    	<? } ?>
									    </div>
									<? }?>
							    <? }?>
						    <? } ?>
						</div>
					</div>
				<? }?>
			</div> 
		</div>
	</div>	
	
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title text-center">Termeni si conditii de acordare a reducerilor<br>Black Friday by Paralela 45</h4>
		      	</div>
		      	<div class="modal-body">
					Reducerile suplimentare (de Black Friday si Targ aplicate celor Early Booking existente) cuprinse intre 5% si 20% sunt valabile doar vineri 17 noiembrie 2017 pana la ora 23:59 (sau in perioada mentionata la fiecare hotel, dar nu mai mult de 16-20 noiembrie 2017). Campania Black Friday incepe vineri 17 noiembrie si se incheie la ora 23:59.
					&nbsp;
					<br>
					<br>
					<strong>Regulament Black Friday:</strong>
					<ol>
					 	<li>Toate preturile afisate de Paralela 45 contin toate taxele necesare efectuarii sejurului</li>
					 	<li>Se accepta atat inscrierile online, cat si cele de la Targul de Turism al Romaniei si din toate agentiile Paralela 45</li>
					 	<li>Sunt incluse in promotie toate hotelurile afisate in pagina campaniei</li>
					 	<li>Promotia se aplica pe anumite date de plecare, pentru pachetele de 7 nopti si este valabila in limita locurilor disponibile</li>
					 	<li>Pretul final al pachetului se considera rezultatul calcului efectuat in pagina hotelului, pret influentat de numarul de adulti, copii si varstele acestora.</li>
					 	<li>Camerele marcate cu "disponibil" in pagina hotelului se pot rezerva cu confirmare imediata la plata online cu cardul. Pentru alte modalitati de plata, rezervarea camerei se considera efectuata dupa finalizarea platii avansului (conform regulilor)</li>
					 	<li>Daca disponibilitatile apar epuizate online, efectuati rezervari pe lista de asteptare ("request") sau transmiteti formular de rezervare - exista posibilitatea suplimentarii locurilor</li>
					 	<li>Reducerile sunt aplicate atat sub forma procentuala cat si valoric - suma fixa (in functie de produs); nu se ofera reduceri din suplimente</li>
					 	<li>Procentele maxime afisate reprezinta reducerea Early Booking cumulata cu reducerea Black Friday calculata din cazare.</li>
					</ol>
					&nbsp;
					<br>
					<strong>Conditii de plata: </strong>
					
					<ul>
						<li>TURISM EXTERN: 50% la rezervare, 30% pana la sfarsitul pragului de Early Booking, 20% cu minim 2 saptamani inainte de plecare</li>
						<li>REVELIOANE: conform programului detaliat</li>
						<li>TURISM INTERN: 50% la rezervare, 50% pana la 29.12.2017</li>
						<li>Plata poate fi facuta online pe site, online prin link de plata sau cash (numerar) in agentiile Paralela 45 inclusiv in zilele de 18.11 si 20.11.2017.</li>
						<li>Plata poate fi facuta si in rate fara dobanda daca ai unul dintre cardurile partenere: <a href="https://www.paralela45.ro/info/vacante-in-rate/" target="_blank">https://www.paralela45.ro/info/vacante-in-rate/</a></li>
						<li>Important! Conditiile de plata pot varia in functie de hotelul sau charterul ales. Ele vor fi afisate complet, alaturi de scadente in pagina de rezervare.</li>
					</ul>
		      	</div>
		    </div>
		</div>
	</div>
	
</div>

<script>
$(document).ready(function(){
	$('.city-top a').click(function(){
		$('html,body').animate({ 
            scrollTop: $("#cities").offset().top 
        }, 500); 
	});
});
</script>

<style>
header, .partners-wrapper, footer .fixed{
	display:none !important;
}
</style>

