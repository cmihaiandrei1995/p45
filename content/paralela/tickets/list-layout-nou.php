<main>
	<div class="inner-page-intro">
		<div class="main-filters">
			<div class="home_forms-wrapper fhw-inner">
				<div class="container">
					<div class="row">
						<?php include $_theme_path.'common/forms/big/tickets.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- titlu pagina -->
				<h1 class="logo-title logo-title--full margin--bottom-40">
					<div class="ipi-icons">
						<i class="sprite ipi-plane-icon"></i>
					</div>
					<span class="logo-title__text">Bilete de avion</span><br>
					<span class="logo-subtitle__text upper">CELE MAI CAUTATE DESTINATII</span>
				</h1>
				<!-- end titlu pagina -->
			</div>
		</div>

		<!-- listare noua -->
		<? if($_items){ ?>
			<div class="row chartere">
				<?php foreach($_items as $item) { ?>
					<div class="col-xs-12 col-ms-6 col-sm-4 col-md-3 chartere__item chartere__item__planetickets">
						<a class="chartere__item__link" href="<?= route('ticket', $item['title'], $item['id_ticket']) ?>">
							<div class="chartere__item__planetickets__content">
								<div class="chartere__item__title">
									<div class="media">
										<h4 class="media-heading chartere__item__title__text chartere__item__title__text--v2">
											Bucuresti
											<i class="sprite where-to-white"></i>
											<span class="dest">LONDRA</span>
										</h4>
									</div>
								</div>
								<div class="chartere__item__number__wrapper">
									<span class="chartere__item__number__text">de la</span>
									<span class="chartere__item__number chartere__item__number--v2"><strong><?= $item['price'] ?><span class="chartere__item__number__currency">€</span></strong></span>
									<span class="nights">3 nopti</span>
								</div>
								<hr>
								<div class="chartere__item__details">
									<p><i class="sprite where-to-blue"></i> Zbor dus - intors</p>
									<p><i class="sprite sprite-calendar-light-blue"></i> 20 feb 2019 - 20 apr 2019</p>
									<p><i class="sprite sprite-plane-light-blue"></i> Wizz Air sau alte companii aeriene</p>
								</div>
								<div class="text-center"><button class="btn btn--green items__item__btn">Rezerva acum »</button></div>
							</div>
							<div class="blue-grad"></div>
							<img class="chartere__item__img object-fit" src="<?= $item['images'][0]['small'] ?>" alt="...">
							<?/*<div class="chartere__item__airline"><img class="position-center chartere__item__airline__img" src="<?= $item['company_image'] ?>" alt="<?= $item['company_title'] ?>"></div>*/?>
						</a>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<!-- end listare noua -->

	<div class="container">
        <div class="row wisub">
            <div class="col-xs-12">
                <!-- titlu pagina -->
                <h1 class="logo-title logo-title--full margin--bottom-40">
                    <div class="ipi-icons">
                        <i class="sprite ipi-plane-icon"></i>
                    </div>
                    <span class="logo-title__text">Bilete de avion</span><br>
                    <span class="logo-subtitle__text upper">CURSE CHARTER</span>
                </h1>
				<h2 class="hr-subtitle">
					Nu te-ai decis inca unde sa mergi in vacanta? Aici gasesti inspiratia.<br>
					Ai Oferte Speciale, vacante Last Minute si Bilete de Avion pentru destinatii diverse.
				</h2>
                <!-- end titlu pagina -->
            </div>
        </div>
		<!-- taburi -->
		<div class="row">
            <div class="col-xs-12 oferte-tab-list">
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Bucuresti</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Cluj Napoca</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Iasi</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Timisoara</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Targu Mures</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Oradea</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Arad</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Suceava</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Bacau</a>
                    </li>
					<li role="presentation" class="">
                        <a href="#" aria-controls="" role="tab" data-toggle="tab">Baia Mare</a>
                    </li>
                </ul>
                <div class="tab-content">
					<? if($_items){ ?>
						<div role="tabpanel" class="tab-pane active" id="">
					        <div class="row chartere">
					            <?php foreach($_items as $item) { ?>
					                <div class="col-xs-12 col-ms-6 col-sm-4 col-md-3 chartere__item chartere__item__planetickets">
					                    <a class="chartere__item__link" href="<?= route('ticket', $item['title'], $item['id_ticket']) ?>">
					                        <div class="chartere__item__planetickets__content">
					                            <div class="chartere__item__title">
					                                <div class="media">
					                                    <h4 class="media-heading chartere__item__title__text chartere__item__title__text--v2">
					                                        Bucuresti
					                                        <i class="sprite where-to-white"></i>
					                                        <span class="dest">LONDRA</span>
					                                    </h4>
					                                </div>
					                            </div>
					                            <div class="chartere__item__number__wrapper">
					                                <span class="chartere__item__number__text">de la</span>
					                                <span class="chartere__item__number chartere__item__number--v2"><strong><?= $item['price'] ?><span class="chartere__item__number__currency">€</span></strong></span>
					                                <span class="nights">3 nopti</span>
					                            </div>
					                            <hr>
					                            <div class="chartere__item__details">
					                                <p><i class="sprite where-to-blue"></i> Zbor dus - intors</p>
					                                <p><i class="sprite sprite-calendar-light-blue"></i> 20 feb 2019 - 20 apr 2019</p>
					                                <p><i class="sprite sprite-plane-light-blue"></i> Wizz Air sau alte companii aeriene</p>
					                            </div>
					                            <div class="text-center"><button class="btn btn--green items__item__btn">Rezerva acum »</button></div>
					                        </div>
					                        <div class="blue-grad"></div>
					                        <img class="chartere__item__img object-fit" src="<?= $item['images'][0]['small'] ?>" alt="...">
					                    </a>
					                </div>
					            <?php } ?>
					        </div>

							<!-- paginare -->
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="pagination mt20 mb20">
	        							<ul class="pages">
				            	            <li><span>1</span></li>
				            	            <li><a href="">2</a></li>
				            	            <li><a href="">3</a></li>
				            	            <li><a href="">4</a></li>
				            	            <li><a href="">5</a></li>
				            	            <li><a href="">6</a></li>
				            	            <li><a href="">7</a></li>
				            	            <li><a href="">8</a></li>
				            	            <li><a href="">9</a></li>
				            	            <li><a href="">10</a></li>
				            	            <li><a href=""><i class="icon pagination-rarr zmdi zmdi-chevron-right"></i></a></li>
				            	            <li><a href=""><i class="icon pagination-drarr"></i><i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-chevron-right"></i></a></li>
				            	        </ul>
								    </div>
								</div>
							</div>
							<!-- end paginare -->
						</div>
				    <?php } ?>
                </div>
            </div>
        </div>
		<!-- end taburi -->
	</div>

	<!-- nu ai gasit ce cautai -->
	<div class="find-more">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-7">
					<h2>Nu ai gasit ce cautai?</h2>
					Paralela 45 iti poate oferi bilete la tarife speciale pentru un numar mare zboruri. Daca totusi zborul pe care il cauti nu se afla in oferta noastra, putem obtine pentru tine o oferta personalizata.
					<button type="submit" name="submit-newsletter" value="2" class="footer__newsletter__submit text-uppercase">Cere o oferta personalizata »</button>
				</div>
				<div class="col-xs-12 col-md-5">
					<img src="<?= $_base?>static/img/find-more.png">
				</div>
			</div>
		</div>
	</div>
	<!-- campuri cautare -->
	<? if(!$_params['country_to']){?>
		<div class="find-more-form">
			<div class="container">
				<div class="row bilete-rezervare bilete-rezervare--pad">
					<? if($_valid && isset($_POST['submit'])){?>
						<div class="success-form" id="form-response">
							<span class="title"><? _e('Cererea ta a fost inregistrata. Aceasta nu este o rezervare, iar un consultant te va contacta in cel mai scurt timp.')?></span>
						</div>
						<br><br><br>
					<? }else{?>
					<form method="post" action="#form-response">
						<div class="col-ms-6 col-sm-6 col-md-3">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-oras-plecare">Oras plecare</label>
								<input class="form-control" id="bilete-rezervare-oras-plecare" type="text" name="oras_plecare" value="<?= $_form["oras_plecare"] ?>">
								<? if($_errors['oras_plecare'] != ""){?>
									<span class="error"><?=$_errors['oras_plecare']?></span>
								<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-3 ">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-oras-intoarcere">Oras intoarcere</label>
								<input class="form-control" id="bilete-rezervare-oras-intoarcere" type="text" name="oras_intoarcere" value="<?= $_form["oras_intoarcere"] ?>">
								<? if($_errors['oras_intoarcere'] != ""){?>
									<span class="error"><?=$_errors['oras_intoarcere']?></span>
								<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group has-feedback"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-data-plecare">Data plecare</label>
									<input class="form-control datepicker" id="bilete-rezervare-data-plecare" type="text" name="data_plecare" value="<?= $_form["data_plecare"] ?>">
									<? if($_errors['data_plecare'] != ""){?>
										<span class="error"><?=$_errors['data_plecare']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group has-feedback"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-data-intoarcere">Data intoarcere</label>
									<input class="form-control datepicker" id="bilete-rezervare-data-intoarcere" type="text"  name="data_intoarcere" value="<?= $_form["data_intoarcere"] ?>">
									<? if($_errors['data_intoarcere'] != ""){?>
										<span class="error"><?=$_errors['data_intoarcere']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-adulti">Numar adulti</label>
									<select class="select__s2" id="bilete-rezervare-adulti" data-placeholder="Adulti" style="width: 100%;" name="adulti" >
										<option value="">&nbsp;</option>
										<?php for($i=1;$i<10;$i++) { ?>
											<option value="<?=$i?>" <? if($_form["adulti"] == $i) echo "selected" ?>><?=$i?></option>
										<?php } ?>
									</select>
									<? if($_errors['adulti'] != ""){?>
										<span class="error"><?=$_errors['adulti']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-copii">Numar copii (2 - 11.99 ani)</label>
									<select class="select__s2" id="bilete-rezervare-copii" data-placeholder="Copii" style="width: 100%;" name="copii">
										<option  value="">&nbsp;</option>
										<?php for($i=0;$i<10;$i++) { ?>
											<option value="<?=$i?>" <? if($_form["copii"] == $i) echo "selected" ?>><?=$i?></option>
										<?php } ?>
									</select>
									<? if($_errors['copii'] != ""){?>
										<span class="error"><?=$_errors['copii']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-infanti">Numar infanti (0 - 1.99 ani)</label>
									<select class="select__s2" id="bilete-rezervare-infanti" data-placeholder="Infanti" style="width: 100%;" name="infants">
										<option value="">&nbsp;</option>
										<?php for($i=0;$i<10;$i++) { ?>
											<option value="<?=$i?>" <? if($_form["infants"] == $i) echo "selected" ?>><?=$i?></option>
										<?php } ?>
									</select>
									<? if($_errors['infants'] != ""){?>
										<span class="error"><?=$_errors['infants']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="checkbox item-rezervare__info__detalii__checkbox mt20">
									<input id="bilete-rezervare-direct" type="checkbox" value="1" name="zboruri_directe">
									<label for="bilete-rezervare-direct">Prefer doar zboruri directe </label>
								</div>
							</div>
							<div class="col-xs-12">
								<p class="bilete-rezervare__sub">Contact</p>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-prenume">Prenume</label>
									<input class="form-control" id="bilete-rezervare-prenume" type="text" name="firstname" value="<?= $_form["firstname"] ?>">
									<? if($_errors['firstname'] != ""){?>
										<span class="error"><?=$_errors['firstname']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-nume">Nume</label>
									<input class="form-control" id="bilete-rezervare-nume" type="text" name="lastname" value="<?= $_form["lastname"] ?>">
									<? if($_errors['lastname'] != ""){?>
										<span class="error"><?=$_errors['lastname']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-email">Email</label>
									<input class="form-control" id="bilete-rezervare-email" type="text" name="email" value="<?= $_form["email"] ?>">
									<? if($_errors['email'] != ""){?>
										<span class="error"><?=$_errors['email']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-ms-6 col-sm-6 col-md-3">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="bilete-rezervare-telefon">Telefon</label>
									<input class="form-control" id="bilete-rezervare-telefon" type="text" name="phone" value="<?= $_form["phone"] ?>">
									<? if($_errors['phone'] != ""){?>
										<span class="error"><?=$_errors['phone']?></span>
									<? }?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-5">
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="bilete-rezervare-acord" type="checkbox" value="1" name="newsletter">
									<label class="bilete-rezervare__label--small" for="bilete-rezervare-acord">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45.</label>
								</div>
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="bilete-rezervare-contract" type="checkbox" value="1" name="contract_turist" >
									<label class="bilete-rezervare__label--small" for="bilete-rezervare-contract">Am citit si sunt de acord cu <a href="<?= route('tourist-contract') ?>" target="_blank">Contractul cu turistul</a></label>
									<? if($_errors['contract_turist'] != ""){?>
										<span class="error"><?=$_errors['contract_turist']?></span>
									<? }?>
								</div>
								<!-- bifa Termeni si conditii -->
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="" type="checkbox" value="1" name="" >
									<label class="bilete-rezervare__label--small" for="">Am citit si sunt de acord cu <a href="" target="_blank">Termeni si conditii</a></label>
								</div>
								<!-- end bifa Termeni si conditii -->
								<?/*
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="bilete-rezervare-termeni" type="checkbox" value="1" name="terms">
									<label class="bilete-rezervare__label--small" for="bilete-rezervare-termeni">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
									<? if($_errors['terms'] != ""){?>
										<span class="error"><?=$_errors['terms']?></span>
									<? }?>
								</div>
								*/?>
							</div>
							<div class="col-sm-4 col-md-offset-3 text-right">
								<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
								<? if($_errors['g-recaptcha-response'] != ""){?>
									<span class="error"><?=$_errors['g-recaptcha-response']?></span>
								<? } ?>
							</div>
							<div class="clearfix"></div>
							<div class="col-xs-12 col-md-4 col-md-offset-4 col-lg-2 col-lg-offset-5">
								<button class="btn btn-block btn--green bilete-rezervare__btn" type="submit" name="submit">Cere oferta</button>
							</div>
						</form>
					<? } ?>
				</div>
			</div>
		</div>
	<? } ?>
	<!-- end campuri cautare -->
	<!-- end nu ai gasit ce cautai -->

	<!-- un paragraf -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="definal">
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait.
				</div>
			</div>
		</div>
	</div>
	<!-- un paragraf -->

	<div class="avantaje-online-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 hr-title">
					<h3 class="hr-title__text text-uppercase text--blue">DE CE SA REZERVI ONLINE BILETELE  DE AVION?</h3>
				</div>
			</div>
			<div class="row avantaje-online">
				<div class="col-xs-12 col-lg-10 col-lg-offset-2">
					<div class="row">
						<div class="col-ms-6 col-sm-6 col-md-3 avantaje-online__item">
							<p class="text-center"><i class="sprite sprite-avantaje1 center-block"></i></p>
							<p class="avantaje-online__title"><strong>Alegi, rezervi si platesti singur.<br> Tu controlezi alegerea!</strong><br> Fara intermediari si costuri suplimentare.</p>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-3 avantaje-online__item">
							<p class="text-center"><i class="sprite sprite-avantaje2 center-block"></i></p>
							<p class="avantaje-online__title"><strong>Online este mai ieftin.<br> Nu trebuie sa stai la coada!</strong><br> Poti sa alegi singur locul in avion si economisesti timp la aeroport</p>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-3 avantaje-online__item">
							<p class="text-center"><i class="sprite sprite-avantaje3 center-block"></i></p>
							<p class="avantaje-online__title"><strong>Informarile companiilor aeriene despre zboruri ajung direct la tine</strong></p>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-3 avantaje-online__item">
							<p class="text-center"><i class="sprite sprite-avantaje4 center-block"></i></p>
							<p class="avantaje-online__title"><strong>Articole si informatii</strong><br> despre companiile aeriene, stiri despre ofertele si serviciile lor.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_avantaje.php' ?>*/?>
</main>
