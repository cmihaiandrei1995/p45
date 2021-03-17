
<section class="voteaza-page">
    <div class="voteaza-page-intro">
        <div class="container">
        	<div class="row">
	            <div class="col-xs-12">
	            	<img src="<?=$_base?>static/img/voteaza/voteaza-intro-pict.png" class="hidden-xs">
                    <img src="<?=$_base?>static/img/voteaza/voteaza-intro-pict-xs.png" class="hidden-sm hidden-md hidden-lg">
	            </div>
            </div>
        </div>
    </div>

    <div class="voteaza-page-winners">
        <div class="container">
        	<div class="row">
                <div class="col-xs-12 text-center">
                    <img src="https://www.paralela45.ro/static/img/voteaza/you-winners.png"><br>
                    <div class="prizes-intro">
                        <strong>Lista câștigătorilor</strong><br>
                        campaniei "Mergi la vot, Mergi în vacaNŢă"
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <strong>Premiul 1: Creta</strong><br>
                    Câștigător: Petre Marilena Diana<br><br>

                    <strong>Premiul 2: Circuit in Grecia</strong><br>
                    Câștigător: Bucur Alin Ovidiu<br><br>

                    <strong>Premiul 3: Antalya</strong><br>
                    Câștigător: Truica Alina<br><br>

                    <strong>Premiul 4: Antalya</strong><br>
                    Câștigător: Stoica Alina<br><br>

                    <strong>Premiul 5: Phoenicia Holiday Resort - Studio</strong><br>
                    Câștigător: Muresan Alexandra<br><br>
                </div>
                <div class="col-xs-12 col-md-6">
                    <strong>Premiul 6: Phoenicia Holiday Resort - Apartament</strong><br>
                    Câștigător: Marin Marian<br><br>

                    <strong>Premiul 7: Hotel Central</strong><br>
                    Câștigător: Anghel Anca-Adriana<br><br>

                    <strong>Premiul 8: Hotel Central</strong><br>
                    Câștigător: Ristea Florea<br><br>

                    <strong>Premiul 9: Hotel Central</strong><br>
                    Câștigător: Dragu Bogdan<br>
                </div>
            </div>
        </div>
    </div>

    <? /*
    <div class="steps-wrapper">
	    <div class="container">
	    	<div class="row">

	            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
	            	<div class="row" id="form">
	            		<div class="col-ms-4 col-sm-4">
	            			<div class="step text-center">
	            				<img src="<?=$_base?>static/img/voteaza/pas1-icon.png">
	            				<div class="step-do">Înscrie-te!</div>
								în concurs
	            			</div>
	            		</div>
	            		<div class="col-ms-4 col-sm-4">
	            			<div class="step text-center">
	            				<img src="<?=$_base?>static/img/voteaza/pas2-icon.png">
	            				<div class="step-do">VOTEAZĂ!</div>
								Votul tău contează!
	            			</div>
	            		</div>
	            		<div class="col-ms-4 col-sm-4">
	            			<div class="step text-center">
	            				<img src="<?=$_base?>static/img/voteaza/pas3-icon.png">
	            				<div class="step-do">VerificĂ!</div>
								dacă ai câștigat
	            			</div>
	            		</div>
	            	</div>

                    <? if(isset($_POST['submit']) && $_valid){?>
                        <br><br><br>
    					<h2 class="text-center">Felicitari! Te-ai inscris cu succes in concurs.</h2>
                        <br><br><br>
    				<? }else{ ?>
    	            	<form action="#form" method="post">
    		            	<div class="row">
    		            		<div class="col-ms-6 col-sm-6">
    		            			<div class="form-group">
    							    	<input type="text" class="form-control" id="name" name="name" value="<?=$_form['name']?>" placeholder="Nume">
                                        <? if($_errors['name'] != ""){?>
    										<span class="error"><?=$_errors['name']?></span>
    									<? } ?>
    								</div>
    								<div class="form-group">
    							    	<input type="text" class="form-control" id="name" name="surname" value="<?=$_form['surname']?>" placeholder="Prenume">
                                        <? if($_errors['surname'] != ""){?>
    										<span class="error"><?=$_errors['surname']?></span>
    									<? } ?>
    								</div>
    		            		</div>
    		            		<div class="col-ms-6 col-sm-6">
    		            			<div class="form-group">
    							    	<input type="email" class="form-control" id="name" name="email" value="<?=$_form['email']?>" placeholder="Email">
                                        <? if($_errors['email'] != ""){?>
    										<span class="error"><?=$_errors['email']?></span>
    									<? } ?>
    								</div>
    								<div class="form-group">
    							    	<input type="text" class="form-control" id="name" name="phone" value="<?=$_form['phone']?>" placeholder="Telefon">
                                        <? if($_errors['phone'] != ""){?>
    										<span class="error"><?=$_errors['phone']?></span>
    									<? } ?>
    								</div>
    		            		</div>
    		            	</div>
    		            	<div class="row">
    		            		<div class="col-xs-12">
    		            			<div class="checkbox aside-filters__checkbox">
    									<input id="oferte-speciale" class="" type="checkbox" value="1" name="newsletter" <?=$_form['newsletter'] == 1 ? "checked" : ""?>>
    									<label for="oferte-speciale">Vreau să primesc cele mai noi oferte, campanii și concursuri.</label>
    								</div>
    		            			<div class="text-center">
    		            				<button type="submit" name="submit" value="submit" class="btn btn--green text-uppercase text--white hover-opacity">MERG LA VOT!</button>
    		            			</div>
    		            		</div>
    		            	</div>
    	            	</form>
                    <? }?>

	            </div>
	       </div>
	    </div>
    </div>
    */ ?>

    <div class="prizes-wrapper">
	    <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="<?=$_base?>static/img/voteaza/you-gift.jpg"><br>
                    <div class="prizes-intro">
                        <strong>LISTA PREMIILOR:</strong><br>
                    </div>
                </div>
            </div>
	    	<div class="row">
                <div class="col-xs-12">
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p1.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="#" class="prize-title">O vacanŢĂ de 7 nopŢi pentru 2 persoane În Insula Creta</a>
                            <div class="prize-from">
                                <img src="<?=$_base?>static/img/voteaza/i-plane.png"> Zbor din București sau Cluj în intervalul 16.09 - 22.09.2019.
                            </div>

                            <strong>Pachetul include:</strong> transport avion cursa charter, 7 nopți de cazare cu mic dejun la hotel de 3 stele, transferuri aeroport - hotel - aeroport și asistență turistică locală.
                            Perioada exactă de călătorie și hotelul vor fi anunțate până la 30 iunie 2019.
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p2.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/circuit/grecia-2019-circuitul-clasic/" class="prize-title">O vacanŢă tip circuit pentru 2 persoane în Grecia</a>
                            <div class="prize-from">
                                <img src="<?=$_base?>static/img/voteaza/i-bus.png"> Plecare din Bucuresti pe 04.08.2019.
                            </div>

                            <strong>Pachetul include:</strong> transport cu autocarul pe ruta București - Sofia - Salonic - Meteora - Atena - Delphi - Salonic - București, 6 nopți de cazare cu mic dejun în cameră dublă la hoteluri de 3 stele: 2 nopți în Salonic, 4 nopți în Atena, vizitarea orașelor de pe traseu, tur de oraș în Atena cu ghid grec vorbitor de limba română, însoțitor român de grup din partea agenției. Mai multe detalii despre vacanţă găsiți <a href="https://www.paralela45.ro/circuit/grecia-2019-circuitul-clasic/" class="link-more">aici »</a>
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p3.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="#" class="prize-title">O vacanŢĂ de 7 nopŢi pentru 2 persoane În Antalya </a>
                            <div class="prize-from">
                                <img src="<?=$_base?>static/img/voteaza/i-plane.png">Zbor din București în intervalul 07.06 - 14.06.2019.
                            </div>

                            <strong>Pachetul include:</strong> transport avion cursa charter, 7 nopți de cazare cu All Inclusive la hotel de 5 stele, transfer aeroport - hotel - aeroport și asistență turistică locală. Hotelul va fi nominalizat ulterior extragerii.
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p4.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="#" class="prize-title">O vacanŢĂ de 7 nopŢi pentru 2 persoane În Antalya</a>
                            <div class="prize-from">
                                <img src="<?=$_base?>static/img/voteaza/i-plane.png">Zbor din București în intervalul 07.06 - 14.06.2019.
                            </div>

                            <strong>Pachetul include:</strong> transport avion cursa charter, 7 nopți de cazare cu All Inclusive la hotel de 5 stele, transfer aeroport - hotel - aeroport și asistență turistică locală. Hotelul va fi nominalizat ulterior extragerii.
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p5.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/sejururi/phoenicia-holiday-resort-4114" class="prize-title">O vacanŢĂ de 5 nopŢi pentru 2 persoane la Mamaia</a>

                            <strong>Hotel Phoenicia Holiday Resort 4*</strong>, în perioada <strong>07.06 - 12.06.2019</strong>, cazare în Studio cu mic dejun. Mai multe detalii despre hotel găsiți <a href="https://www.paralela45.ro/sejururi/phoenicia-holiday-resort-4114" class="link-more">aici »</a>
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p6.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/sejururi/phoenicia-holiday-resort-4114" class="prize-title">O vacanŢĂ de 5 nopŢi pentru 2 persoane la Mamaia</a>

                            <strong>Hotel Phoenicia Holiday Resort 4*</strong>, în perioada <strong>07.06 - 12.06.2019</strong>, cazare în Apartament cu două camere cu mic dejun. Mai multe detalii despre hotel găsiți <a href="https://www.paralela45.ro/sejururi/phoenicia-holiday-resort-4114" class="link-more">aici »</a>
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p7.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="prize-title">O vacanŢĂ de 2 nopŢi pentru 2 persoane la Mamaia</a>

                            <strong>Hotel Central 3**</strong>, în perioada <strong>21.06 - 23.06.2019</strong>, cazare în Apartament cu doua camere cu mic dejun. Mai multe detalii despre hotel găsiți <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="link-more">aici »</a>
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p8.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="prize-title">O vacanŢĂ de 2 nopŢi pentru 2 persoane la Mamaia</a>

                            <strong>Hotel Central 3*</strong>, în perioada <strong>21.06 - 23.06.2019</strong>,  în cameră dublă cu mic dejun. Mai multe detalii despre hotel găsiți <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="link-more">aici »</a>
                        </div>
                    </div>
                    <div class="aprize-wrapper clearfix">
                        <img src="<?=$_base?>static/img/voteaza/p9.png" class="aprize-pict">
                        <div class="aprize">
                            <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="prize-title">O vacanŢĂ de 2 nopŢi pentru 2 persoane la Mamaia</a>

                            <strong>Hotel Central 3*</strong>, în perioada <strong>21.06 - 23.06.2019</strong>,  în cameră dublă cu mic dejun. Mai multe detalii despre hotel găsiți <a href="https://www.paralela45.ro/sejururi/hotel-central-4108" class="link-more">aici »</a>
                        </div>
                    </div>
                </div>
	            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <?/*
	            	<div class="row">
			            <div class="col-xs-12 text-center">
			            	<img src="<?=$_base?>static/img/voteaza/you-gift.jpg"><br>
			            	<div class="prizes-intro">
				            	<strong>Premiu:</strong><br>
								O <strong>vacanŢĂ</strong> pentru <strong>2 persoane În Insula Creta</strong>
							</div>

							<div class="go"><img src="<?=$_base?>static/img/voteaza/go.png">Zbor din <strong>București sau Cluj</strong> cu plecare între 16.09 - 22.09.2019*</div>
						</div>
					</div>
                    <div class="what">
    					<div class="row">
    			            <div class="col-xs-12 col-ms-6 col-sm-6">
                                <br><br>
    			            	Servicii incluse:<br><br>

    							• Transport avion cursă charter directă;<br>
    							• 7 nopți cazare cu mic dejun la hotel 3 stele**;<br>
    							• Transferuri aeroport – hotel – aeroport;<br>
    							• Asistență turistică locală.<br><br>

    							<small>
    								*Data exactă de plecare se va comunica până la 30.06.2019.<br>
    								**Hotelul va fi nominalizat odată cu plecarea.
    							</small>
    			            </div>
    			            <div class="col-xs-12 col-ms-6 col-sm-6 what-pict">
    			            	<img src="<?=$_base?>static/img/voteaza/prizes-pict.png">
    			            </div>
    		            </div>
                    </div>
                    */?>

                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <div class="when">
                                <strong>Perioada de desfășurare:</strong> 08.05.2019 - 26.05.2019<br>
                                <strong>Extragere câștigător:</strong> 27.05.2019
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <a href="<?=route('rules-vote')?>" target='_blank' class="regulament">Regulament concurs</a>
                        </div>
                    </div>
	            </div>
            </div>

        </div>
    </div>
</section>
