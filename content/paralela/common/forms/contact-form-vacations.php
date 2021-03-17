<? if($_valid && isset($_POST['submit'])){ ?>
	<div class="success-form" id="form-response">
        <span class="title"><? _e('Va multumim!')?></span>
    </div>
    <br><br><br>
<? }else{ ?>
	<span id="form-response"></span>
	<div class="contact-form">
		<form method="post" action="#form-response">
			<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<p>Date contact</p>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6">
											<input type="text" class="form-control" placeholder="Prenume" name="firstname" value="<?=$_form['firstname']?>">
										</div>
										<div class="col-sm-6">
											<input type="text" class="form-control" placeholder="Nume" name="lastname" value="<?=$_form['lastname']?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Telefon" name="phone" value="<?=$_form['phone']?>">
									<? if($_errors['phone'] != ""){?>
					            		<span class="error"><?=$_errors['phone']?></span>
					            	<? } ?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Email" name="email" value="<?=$_form['email']?>">
									<? if($_errors['email'] != ""){?>
					            		<span class="error"><?=$_errors['email']?></span>
					            	<? } ?>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<p>Locatie</p>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Plecare din" name="plecare" value="<?=$_form['plecare']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Tara de destinatie" name="destinatie-tara" value="<?=$_form['destinatie-tara']?>">
									<? if($_errors['destinatie-tara'] != ""){?>
					            		<span class="error"><?=$_errors['destinatie-tara']?></span>
					            	<? } ?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Oras de destinatie" name="destinatie-oras" value="<?=$_form['destinatie-oras']?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<textarea cols="5" rows="5" name="observations" placeholder="Observatii"><?= !$_valid && $_form['observations'] != '' ? $_form['observations']  : '' ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<p>Date sejur</p>
						<div class="row">
							<div class="col-md-6 col-xs-6">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Numar adulti" name="adulti" value="<?=$_form['adulti']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Varsta copii (ex: 1,2)" name="varsta" value="<?=$_form['varsta']?>">
								</div>
							</div>
							<div class="col-md-6 col-xs-6">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Numar copii" name="copii" value="<?=$_form['copii']?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Buget/persoana (€)" name="buget" value="<?=$_form['buget']?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control datepicker" placeholder="Date plecare" name="data-plecare" value="<?=$_form['data-plecare']?>">
									<i class="sprite sprite-calendar-grey form-control-feedback"></i>
								</div>
								<? if($_errors['data-plecare'] != ""){?>
				            		<span class="error"><?=$_errors['data-plecare']?></span>
				            	<? } ?>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group has-feedback">
									<input type="text" class="form-control datepicker" placeholder="Date intoarcere" name="data-intoarcere" value="<?=$_form['data-intoarcere']?>">
									<i class="sprite sprite-calendar-grey form-control-feedback"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<p>Transport</p>
								<div class="form-group">
									<label class="item-rezervare__info__detalii__label">
										<select class="select__s2" data-placeholder="Alege transportul" style="width: 100%;" name="transport">
											<option value=""></option>
											<? foreach($_tm_transport as $key => $val){?>
												<option <?= $_form['transport'] == $key ? "selected='selected'" : '' ?> value="<?=$key?>"><?=$val?></option>
											<? }?>
										</select>
									</label>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<p>Masa</p>
								<div class="form-group">
									<label class="item-rezervare__info__detalii__label">
										<select class="select__s2" data-placeholder="Alege tipul de masa" style="width: 100%;" name="masa">
											<option value=""></option>
											<? foreach($_tm_masa as $key => $val){?>
												<option <?= $_form['masa'] == $key ? "selected='selected'" : '' ?> value="<?=$key?>"><?=$val?></option>
											<? }?>
										</select>
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<p>Hotel</p>
								<div class="form-group">
									<label class="item-rezervare__info__detalii__label">
										<select class="select__s2" data-placeholder="Alege clasificarea hotelului" style="width: 100%;" name="hotel">
											<option value=""></option>
											<? for($i=1; $i<=5; $i++){?>
												<option <?= $_form['hotel'] == $i ? "selected='selected'" : '' ?> value="<?=$i?>"><?=$i?> <?=$i == 1 ? "stea" : "stele"?></option>
											<? }?>
										</select>
									</label>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<p>Tip camera</p>
								<div class="form-group">
								<label class="item-rezervare__info__detalii__label">
									<select class="select__s2" data-placeholder="Alege tipul de camre" style="width: 100%;" name="camera">
										<option value=""></option>
										<? foreach($_tm_camere as $key => $val){?>
											<option <?= $_form['camera'] == $key ? "selected='selected'" : '' ?> value="<?=$key?>"><?=$val?></option>
										<? }?>
									</select>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="checkbox item-rezervare__info__detalii__checkbox">
						<input id="informari-oferte" value="1" type="checkbox" name="newsletter">
						<label for="informari-oferte">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45.</label>
					</div>
					<div class="checkbox item-rezervare__info__detalii__checkbox">
						<input id="acord-termeni" value="1" type="checkbox" name="terms" >
						<label for="acord-termeni">Am citit si sunt de acord cu <a href="<?= route('terms') ?>" target="_blank">Termeni si conditii</a></label>
						<? if($_errors['terms'] != ""){?>
		            		<span class="error"><?=$_errors['terms']?></span>
		            	<? } ?>
					</div>
                    <div class="checkbox item-rezervare__info__detalii__checkbox">
						<input id="gdpr" value="1" type="checkbox" name="gdpr" >
						<label for="gdpr">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
						<? if($_errors['gdpr'] != ""){?>
		            		<span class="error"><?=$_errors['gdpr']?></span>
		            	<? } ?>
					</div>
					<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
					<? if($_errors['g-recaptcha-response'] != ""){?>
	            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
	            	<? } ?>
				</div>
				<input type="hidden" name="page-location" value="" id="page-location">
				<div class="col-md-4 text-center">
					<button class="btn btn-block btn--green item__info__btn" type="submit" name="submit">Trimite cererea</button>
				</div>
			</div>
		</form>
	</div>
<? } ?>
