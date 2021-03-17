<main class="new-about">
	<div class="container-fluid inner-banner inner-banner-about">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<? /* <div class="black-layer"></div> */ ?>
				</div>
				<? /*
				<div class="row">
					<div class="container">
						<div class="col-md-2"></div>
						<div class="col-xs-12 col-md-8">
							<p class="quote">“Oriunde ai vrea sa calatoresti, poti sa pleci linistit. Ai intotdeauna suportul nostru.”<br /><i>Alin Burcea</i></p>
						</div>
					</div>
				</div>
				*/ ?>
			</div>
		</div>
	</div>
	<div class="container-fluid margin--top-50">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="logo-title logo-title--full">
							<span class="logo-title__text">POVESTEA NOASTRA</span>
							<span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span>
						</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 about-wrapper">
								<div class="row">
									<div class="col-md-3">
										<? include $_theme_path.'common/sidebars/sidebar-about.php' ?>
									</div>
									<div class="col-md-9">

										<? if($_texts){
										  	foreach($_texts as $k => $text){ ?>
												<div class="about-section">
													<?= $text['description'] ?>

													<? if($k == count($_texts) - 2){ ?>
														<? if($_gallery[0]){?>
															<div class="holliday-pict about-swiper-wrapper-1">
																<div class="swiper-container swiper-container-about-new swiper-container-about-new-1">
																    <div class="swiper-wrapper">
																		<? foreach($_gallery[0]['images'] as $img){?>
																	      	<div class="swiper-slide">
																			  	<img src="<?=$img['small']?>">
																		  	</div>
																		<? }?>
																    </div>
															  	</div>
															  	<div class="swiper-button-next"></div>
															  	<div class="swiper-button-prev"></div>
														  	</div>
													  	<? }?>
													<? } ?>

													<? if($k == count($_texts) - 1){ ?>
														<? if($_gallery[0]){?>
															<div class="holliday-pict about-swiper-wrapper-2">
																<div class="swiper-container swiper-container-about-new swiper-container-about-new-2">
																    <div class="swiper-wrapper">
																		<? foreach($_gallery[1]['images'] as $img){?>
																			<div class="swiper-slide">
																				<img src="<?=$img['small']?>">
																			</div>
																		<? }?>
																    </div>
															  	</div>
															  	<div class="swiper-button-next"></div>
															  	<div class="swiper-button-prev"></div>
													  		</div>
														<? }?>
													</div>
													<? } ?>
												</div>
												<? if($k < count($_texts) - 1){ ?>
												<hr class="delim" />
												<? } ?>
											<? } ?>
										<? } ?>


										<!-- continut nou
										<div class="about-section">
											<div class="row">
												<div class="col-md-7">
													<h4 class="first">De peste 28 de ani facem diferenta in turism</h4>
													<p class="">
														Paralela 45 a fost infiintata in aprilie 1990, de doi prieteni, Alin Burcea si Adrian Grigorescu, care lucrasera impreuna ghizi la ITHR Bucuresti, in perioada 1985 -1989. Tot aici au lucrat si Ion Antonescu (“Marshal Turism” de azi) si Sorin Nicolescu (Olimpic International). “Ideea de a pune acest nume vine de la un artist plastic, prieten cu partenerul meu, care ne-a spus sa facem ceva foarte puternic vizual, care sa contina si cifre. Astfel, cu ajutorul lui, am decis sa numim agentia Paralela 45”, spune Alin Burcea.
													</p>
												</div>
												<div class="col-md-5 text-center">
													<img src="https://www.paralela45.ro/static/img/f-burcea-01.jpg">
													<p class="author">
														<strong>dr. Alin Burcea</strong><br>
														CEO Paralela 45
													</p>
												</div>
											</div>
										</div>
										<hr class="delim">
										<div class="about-section">
											<h4>De peste 28 de ani, Paralela 45 a rezistat pe piata turistica romaneasca pentru ca este un brand puternic, sustinut din spate de “brandul” Alin Burcea.</h4>
											<p class="colonajintow">
												O persoana plina de viata si idei, un om care a scris file in istoria turismului din Romania… Acesta este Alin Burcea. Nu multi stiu probabil ca a vrut sa se faca actor, ii place sa cante, dar viata i-a pregatit pariuri interesante, ajungand un iscusit om de afaceri. Daca s-ar fi facut actor, turismul romanesc cu siguranta ar fi avut de pierdut.
 												„Telul meu este sa imi fac foarte bine meseria, insa mult mai bine decat se face. Toate proiectele de succes dezvoltate au avut in spate echipe alese cu grija, si acest lucru a condus la situatia in care de peste 28 de ani romanii apreciaza in permanenta serviciile si produsele Paralela 45.”
											</p>
											<div class="row">
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff1.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff2.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff3.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff4.jpg" class="fimg">
												</div>
											</div>
											<br><br>
											<div class="row">
												<div class="col-sm-7">
													<ul class="about-him">
														<li>
															<span class="f-arr"><img src="https://www.paralela45.ro/static/img/f-arr.jpg"></span>
															<p><span class="has">1991-1993 Presedinte ANAT</span>. Alaturi de sase oameni a sustinut dezvoltarea turismului in Romania, fiind primul presedinte fondator.</p>
														</li>

														<li>
															<span class="f-arr"><img src="https://www.paralela45.ro/static/img/f-arr.jpg"></span>
															<p><span class="has">2001-2002  Secretar de Stat in Ministerul Turismului.</span> Proiectele coordonate: <br>
															<strong>Domeniul schiabil Predeal-Azuga</strong>, proiect ce a constat in largirea domeniului schiabil al localitatilor Predeal si Azuga, prin crearea unei noi partii (partia Cocosul), aductiunea de apa pentru generarea de zapada artificiala pe partii si amenajarea unei instalatii de iluminat nocturn pentru noua partie.
															<strong>Litoralul pentru toti</strong>, proiect care a urmarit facilitarea accesului persoanelor cu venituri reduse la vacante.
															<strong>Copiii Soarelui</strong>, proiect de promovare a gratuitatii oferita copiilor la cazarea pe litoralul romanesc.
															Legea nr. 631/2001, privind activitatea de comercializare a pachetelor de servicii turistice, la elaborarea careia a coordonat echipa de experti.</p>
														</li>

														<li>
															<span class="f-arr"><img src="https://www.paralela45.ro/static/img/f-arr.jpg"></span>
															<p><span class="has">2007 Doctor in turism</span>. Sustine prima lucrare cu tema “Turismul de afaceri in Romania” scrisa in Romania.</p>
														</li>

														<li>
															<span class="f-arr"><img src="https://www.paralela45.ro/static/img/f-arr.jpg"></span>
															<p><span class="has">2016-2018 Presedinte ANAT</span></p>
														</li>

														<li>
															<span class="f-arr"><img src="https://www.paralela45.ro/static/img/f-arr.jpg"></span>
															<p><span class="has">In prezent. Vicepresedinte ANAT</span></p>
														</li>
													</ul>
												</div>
												<div class="col-sm-5">
													<div class="cv-wrapper">
														<img src="https://www.paralela45.ro/static/img/f-burcea-02.jpg">
														<a href="http://burcea.ro/blog/cv-alin-burcea/" target="_blank" class="cv-bttn">CV Alin Burcea</a>
													</div>
												</div>
											</div>
										</div>
										<hr class="delim">
										<div class="about-section">
											<h4 class="upper">The Story</h4>
											<p class="colonajintow">
												Pe <strong>4 iunie 1990</strong> s-a deschis oficial, <strong>Paralela 45</strong>, in actualul sediu din Bdul Regina Elisabeta 29-31.
												In primul an, turismul intern a reprezentat principala activitate. Clientii erau multumiti pentru ca primeau chitanta pentru tot ceea ce plateau, adica “spaga” se transformase, legal in comision.<br><br>

												<strong>“Primul nostru grup, prima plecare  in strainatate cu turisti a fost in Turcia</strong>, la Istanbul, la sfarsit de iunie. Excursia costa la vremea aceea 25 de dolari si 500 de lei si s-a facut cu autocarul.  Am fost... ghid. Nu mai iesisem din tara decat in Bulgaria si Rusia si totul a fost o aventura. La granita bulgaro-turca am stat "numai" 4 ore si asta datorita unui bacsis "gras". Istanbulul mi s-a parut un oras extraordinar. Mi s-a parut atunci, mi se pare si astazi.<br><br>

												In <strong>1991 au inceput excursiile externe</strong>. A fost anul <strong>Chinei</strong>, de unde "turistii" romani au venit cu tone de marfa. A urmat <strong>Egiptul cu celebrele croaziere pe Nil</strong>, care si astazi se bucura de mare succes.  Apoi, <strong>Campionatele de fotbal – World Cup 1994, Anglia 1996, Coupe du Monde 1998, Belgia 2000</strong>. “La World Cup 1994 am dus 180 de romani in America. Eram la acea vreme prima agentie care ducea turisti la campionat.<br>
												<strong>Grecia s-a "lansat"</strong> si a devenit principala destinatie a romanilor.<br><br>

												<strong>Primul charter, evident, pe destinatia Antalya</strong>, l-am realizat, timid, in <strong>1996</strong>. Circuitele au inceput sa fie tot mai multe, in special cu autocarul, in perioada respectiva.<br><br>

												Am devenit <strong>agentie acreditata IATA in 1994</strong> si vanzarea de bilete de avion a fost de atunci una din activitatile noastre de baza. In <strong>1998 am infiintat Departamentul Corporate</strong>, cu o echipa si un sediu distinct. In anul <strong>2000 am fost selectati sa organizam partea logistica pentru ExpoHanovra 2000</strong>. Prima agentie in afara Bucurestiului a fost la Timisoara in 1996. <strong>Dupa 2003, Paralela45 a inceput extinderea retelei de agentii, astazi avem 43 de agentii proprii sau in franciza</strong>, coordonate de o puternica echipa de distributie.<br><br>

												<strong>"Specialitatea" noastra o reprezinta circuitele culturale, istorice pentru care suntem apreciati</strong>. Cele cateva zeci de chartere pe care le organizam anual sunt in continua crestere si diversificare.<br><br>

												Sase ani consecutiv, Paralela 45 s-a bucurat de cel mai ridicat nivel de incredere in achizitionarea vacantelor.  Am fost recunoscuti drept <strong>“The most trusted brand 2014“ la categoria Agentii de Turism</strong>, in cadrul studiului de piata realizat asupra consumatorului roman de revista Reader’s Digest. Anul <strong>2014</strong> a adus agentiei Paralela 45 o noua recunoastere, prin acordarea <strong>trofeului Superbrands, pentru al doilea an consecutiv</strong>, in categoria agentiilor de turism, conform analizei realizate de organizatia cu acelasi nume. O alta recunoastere facuta tot pe baza voturilor turistilor multumiti de serviciile noastre ne-a adus in <strong>2017 si 2018 locul I la categoria “cel mai bun tour-operator outgoing</strong>“, in cadrul galei <strong>TopHotel Awards</strong>, premiile excelentei in industria hoteliera, a turismului si ospitalitatii din Romania.
											</p>
											<div class="row">
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff5.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff6.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff7.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff8.jpg" class="fimg">
												</div>
											</div>
											<div class="row images-about-recon align-items-center">
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/uploads/media/2017/8/18/iata-logo-qi9b.jpg" alt="">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/uploads/media/2017/8/18/anat-hvi7.jpg" alt="" >
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/uploads/media/2017/8/18/asta-cji6.jpg" alt="" >
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/uploads/media/2017/11/7/tb1-qo49.png" alt="" >
												</div>
											</div>
											<p>
												Astazi, investim in on-line, in vanzarea on-line si in valorile pe care acesta ti le permite. Noul website Paralela 45, lansat in 2017, raspunde perfect tuturor tendintelor in domeniu, iar rezervarea unui sejur, precum si plata reprezinta acum un proces de numai cateva minute. Simplu si comod, fara a mai fi nevoie sa va deplasati in agentiile noastre, daca timpul nu va permite. 
												In <strong>2018, site-ul Paralela45</strong> a primit doua distinctii: <strong>Premiul pentru cel mai bun magazin online de Travel</strong> in cadrul <strong>Galei GPeC - The Most Important E-Commerce Event in CEE si Best travel agency website</strong> in cadrul <strong>ETravel Awards 2018</strong>.
											</p>
											<div class="row">
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff9.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff10.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff11.jpg" class="fimg">
												</div>
												<div class="col-sm-6 col-md-3">
													<img src="https://www.paralela45.ro/static/img/ff12.jpg" class="fimg">
												</div>
											</div>
											<p class="slogan text-center">
												Sa avem cu totii vacantele cat mai frumoase si #experientedeneuitat!
											</p>
										</div>
										<hr class="delim">
										<div class="about-section">
											<h4 class="upper">Management Paralela 45</h4>
											<div class="row management-team">
												<div class="col-sm-4 text-center">
													<img src="https://www.paralela45.ro/static/img/ll1.jpg">
													<p class="author">
														<strong>
															Alin Burcea<br>
															CEO (Presedinte)<br>
														</strong>
														<a href="mailto:secretariat@paralela45.ro">secretariat@paralela45.ro</a>
													</p>
												</div>
												<div class="col-sm-4 text-center">
													<img src="https://www.paralela45.ro/static/img/ll2.jpg">
													<p class="author">
														<strong>
															Ondina Dobriban<br>
															General Manager<br>
														</strong>
														<a href="mailto:ondina@paralela45.ro">ondina@paralela45.ro</a>
													</p>
												</div>
												<div class="col-sm-4 text-center">
													<img src="https://www.paralela45.ro/static/img/ll3.jpg">
													<p class="author">
														<strong>
															Valentina Ene<br>
															Executive Director<br>
														</strong>
														<a href="mailto:vali@paralela45.ro">vali@paralela45.ro</a>
													</p>
												</div>
											</div>
										</div>
										<hr class="delim">
										<div class="about-section">
											<h4>Paralela 45 in cifre</h4>
											<p>Paralela 45 are grija de vacantele dvs. Fiecare an reprezinta pentru noi o permanenta provocare pentru a inova si a descoperi impreuna noi destinatii!</p>
											<p class="colonaj">
												<span class="has">1,8 milioane de turisti</span><br> au calatorit cu noi, de la infiintarea agentiei Paralela 45 (1990)<br><br>
												<span class="has">peste 600 de zboruri charter anuale</span><br> catre diverse destinatii din Europa<br><br>
												<span class="has">peste 120 de itinerarii in circuite turistice</span><br> catre toate continentele<br><br>
											</p>
											<p class="colonaj">
												<span class="has">45 de ghizi</span><br> insotitori de grupuri<br><br>
												<span class="has">50 de reprezentanti locali permanenti, in destinatiile de vacanta</span><br>
												<span class="has">98% grad de ocupare</span> <br>(chartere avion si autocar)
											</p>
											<p style="text-align: center;">
												<br><br>
												<span class="has">peste 60 mil. €, cifra de afaceri anuala</span>
											</p>
											<p class="colonaj">&nbsp;</p>
											<div class="text-center margin--top-25 upper">
												<h5>Peste 28 de ani in care ne-am perfectionat pentru a fi cei mai buni</h5>
											</div>
											<div class="holliday-pict about-swiper-wrapper-1">
												<div class="swiper-container swiper-container-about-new swiper-container-about-new-1">
												    <div class="swiper-wrapper">
												      <div class="swiper-slide">
														  <img src="https://www.paralela45.ro/static/img/ff13.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="https://www.paralela45.ro/static/img/ff14.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="https://www.paralela45.ro/static/img/ff15.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="https://www.paralela45.ro/static/img/ff16.jpg">
													  </div>
												    </div>
											  </div>
											  <div class="swiper-button-next"></div>
											  <div class="swiper-button-prev"></div>
										  </div>
										</div>
										<hr class="delim">
										<div class="about-section">
											<h4>Sunt mandru de echipa mea, pe care o consider cea mai buna din Romania!</h4>
											<div class="row">
												<div class="col-md-8">
													<p>Cu un numar de <strong>160 de angajati</strong>, Paralela45 organizeaza periodic infotripuri si traininguri pentru instruirea consultantilor de turism si a personalului din back office. Incepand din 2017, a fost initiata o schema de fidelizare, <strong>Fidelity Star</strong>, prin care angajatii sunt recompensati in functie de vechime. Aproape jumatate dintre angajatii Paralela45 au o vechime intre 5 si 22 de ani. <strong>“Daca vrei sa cresti business-ul trebuie sa ai angajati multumiti si longevivi in companie. Sunt oameni care de 22 de ani nu au parasit corabia. Noi spunem ca Paralela45 este o mare familie, o adevarata scoala de turism, unde satisfactiile personale si profesionale ale angajatilor vin din gradul de satisfactie si aprecierile pe care le primim de la turisti si de la partenerii revanzatori”</strong>, marturiseste Alin Burcea.</p>
												</div>
												<div class="col-md-4">
													<img src="https://www.paralela45.ro/static/img/ff17.jpg">
												</div>
											</div>
											<div class="holliday-pict about-swiper-wrapper-2">
												<div class="swiper-container swiper-container-about-new swiper-container-about-new-2">
												    <div class="swiper-wrapper">
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff18.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff19.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff20.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff21.jpg">
													  </div>
													  <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff18.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff19.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff20.jpg">
													  </div>
												      <div class="swiper-slide">
														  <img src="<?= $_base ?>static/img/ff21.jpg">
													  </div>
												    </div>
											  </div>
											  <div class="swiper-button-next"></div>
											  <div class="swiper-button-prev"></div>
										  </div>
										</div> -->
									</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>
	<? //include $_theme_path.'common/boxes/box_partners.php' ?>

</main>
