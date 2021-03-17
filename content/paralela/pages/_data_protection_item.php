
		<main class="margin--bottom-100">
			<div class="container-fluid inner-banner-about">
				<div class="row">
					<div class="col-xs-12">
						<div class="row img-banner__img__wrapper">
							<img class="img-banner__img object-fit" src="<?= $_base ?>static/img/banner-drepturi.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid margin--top-50">
				<div class="row">
					<div class="container">
						<div class="row p-util-wrapper">
							<div class="col-xs-12">
								<a href="<?=route('data-protection')?>" class="go-back-gdpr">x Inapoi</a>
							</div>
							<div class="col-xs-12">
								<img src="<?=$_item['images'][0]['small']?>" class="rpo-pict">
								<p class="rpo-title"><?=$_item['title']?></p>
								<div class="rpo">
									<?=$_item['description']?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid margin--top-50 rpo-gray-bg">
				<div class="container">
					<? if($_valid && isset($_POST['submit'])){ ?>
					  	<div class="row">
					  		<div class="container">
								<div class="success-form" id="form-response">
							        <span class="title"><? _e('Va multumim!')?></span>
							    </div>
							    <br><br><br>
							</div>
						</div>
					<? }else{ ?>
						<form method="post" action="#form-response" class="col-md-12">
							<div class="row">
								<div class="col-xs-12">
									<p>Pentru a trimite cererea va rugam completati informatiile de mai jos:</p>
									Date contact<br><br>
								</div>
								<span id="form-response"></span>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<div class="row">
											<label class="col-xs-12 col-sm-4">Prenume si nume:</label>
											<div class="col-xs-12 col-sm-8">
												<input type="text" class="form-control" placeholder="Nume" name="name" value="<?=$_form['name']?>">
												<? if($_errors['name'] != ""){?>
								            		<span class="error"><?=$_errors['name']?></span>
								            	<? } ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-xs-12 col-sm-4">Telefon mobil:</label>
											<div class="col-xs-12 col-sm-8">
												<input type="text" class="form-control" placeholder="Telefon" name="phone" value="<?=$_form['phone']?>">
												<? if($_errors['phone'] != ""){?>
								            		<span class="error"><?=$_errors['phone']?></span>
								            	<? } ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label class="col-xs-12 col-sm-4">Email:</label>
											<div class="col-xs-12 col-sm-8">
												<input type="text" class="form-control" placeholder="Email" name="email" value="<?=$_form['email']?>">
												<? if($_errors['email'] != ""){?>
								            		<span class="error"><?=$_errors['email']?></span>
								            	<? } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-6">
											<!-- <div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="informari-oferte" value="1" type="checkbox" name="newsletter">
												<label for="informari-oferte">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45.</label>
											</div> -->
											<div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="acord-termeni" value="1" type="checkbox" name="terms" >
												<label for="acord-termeni">Am citit si sunt de acord cu <a href="<?= route('terms') ?>" target="_blank">Termeni si conditii</a></label>
												<? if($_errors['terms'] != ""){?>
								            		<span class="error"><?=$_errors['terms']?></span>
								            	<? } ?>
											</div>
										</div>
										<div class="col-md-6">
											<button class="btn btn--green item-rezervare__info__detalii__btn" id="submit" name="submit" type="submit">
												<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
												<span>TRIMITE CEREREA</span>
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<!-- <div class="checkbox item-rezervare__info__detalii__checkbox">
												<input id="gdpr" value="1" type="checkbox" name="gdpr" >
												<label for="gdpr">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
												<? if($_errors['gdpr'] != ""){?>
								            		<span class="error"><?=$_errors['gdpr']?></span>
								            	<? } ?>
											</div> -->
											<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
											<? if($_errors['g-recaptcha-response'] != ""){?>
							            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
							            	<? } ?>
										</div>
									</div>
								</div>
							</div>
						</form>
					<? }?>
				</div>
			</div>
		</main>
