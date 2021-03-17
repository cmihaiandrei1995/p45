<div class="container-fluid header--login header--blue header--border-bottom">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<a class="logo--login" href="<?=$_base?>" title="Paralela 45"><img src="<?=$_base?>static/img/logo.png" alt="Paralela 45"></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?/*
			<div class="hidden-xs hidden-sm col-md-5 col-md-offset-1 login--border login--pad-left">
				<h2 class="login__title">FOLOSESTE-TI CONTUL PENTRU:</h2>
				<ul class="list-unstyled login__list">
					<li><i class="sprite-login sprite-login-flag"></i> Verificare status rezervare</li>
					<li><i class="sprite-login sprite-login-doc"></i> Acces facil la documentele de calatorie</li>
					<li><i class="sprite-login sprite-login-star"></i> Verificare puncte de fidelitate</li>
					<li><i class="sprite-login sprite-login-24"></i> Alerte de calatorii &amp; Asistenta 24/24 h</li>
					<li><i class="sprite-login sprite-login-avatar"></i> Acces direct la consultantul tau de turism</li>
				</ul>
			</div>
			*/?>

			<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
				
				<? if(isset($_GET['whish'])){?>
					<h2 class="login__title">Salveaza-ti ofertele in Whishlist</h2>
					<p>Pentru a-ti putea salva oferte in whishlist trebuie sa iti creezi un cont sau sa te loghezi.</p>
					<br><br>
				<? }?>

				<? if($show_success_activation){?>
					<h2 class="login__title">Inregistrare cu succes!</h2>
					<p>Emailul dvs a fost confirmat cu succes. Acum va puteti autentifica folosind formularul de mai jos.</p>
					<br><br>
				<? }?>

				<? if($_show_resend){?>
					<h2 class="login__title">Emailul a fost retrimis!</h2>
					<p>Un email continand un link de activare a fost trimis pe adresa dvs. Dupa confirmarea contului va veti putea autentifica.</p>
				    <br><br>
				<? }?>

				<? if($_valid && $_POST['submit'] == "register"){?>
					<h2 class="login__title">Inregistrare cu succes!</h2>
					<p>Va multumim pentru inregistrarea pe site-ul Paralela45. Un email continand un link de activare a fost trimis pe adresa dvs. Dupa confirmarea contului va veti putea autentifica.</p>
				    <br><br>
				<? }elseif($_valid && $_POST['submit'] == "forgot"){?>
					<h2 class="login__title">Resetare parola</h2>
					<p>Parola contului dvs a fost resetata cu succes si a fost trimisa pe email.</p>
				    <br><br><br>
				<? }else{ ?>

					<?/*
					<div role="tabpanel" class="tab-pane <? if($_POST['submit'] == "forgot"){?>active<? }?>" id="forgot">
						<form class="login__form <?php if(count($_errors) && $_POST['submit'] == "forgot") { echo "form-error"; } ?>" action="<?=route('login')?>" method="post">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label login__form__label" for="login-email">Email</label>
								<input class="form-control <? if($_errors['email'] != "" && $_POST['submit'] == "forgot"){?>inp-error<? }?>" value="<?=($_POST['submit'] == "forgot" ? $_form['email'] : '')?>" id="login-email" name="email" type="email">
								<span class="help-block hidden">Necesar</span>
								<? if($_errors['email'] != "" && $_POST['submit'] == "forgot"){?>
				            		<span class="error"><?=$_errors['email']?></span>
				            	<? }?>
							</div>
							<input type="hidden" name="action" value="forgot">
							<button type="submit" name="submit" value="forgot" class="btn btn--green login__form__btn center-block">Reseteaza parola</button>
						</form>
					</div>
					*/?>

					<div id="register">
						<div class="login__intro">Creeaza cont nou</div>
						<form class="login__form <?php if(count($_errors) && $_POST['submit'] == "register") { echo "form-error"; } ?>" action="<?=route('login')?>" method="post">
							<div class="row">
								<div class="col-xs-12 col-md-2">
									<div class="radio rsmall">
									  <label><input type="radio" name="optradio" checked>Dl.</label>
									</div>
									<div class="radio rsmall">
									  <label><input type="radio" name="optradio" checked>Dna.</label>
									</div>
								</div>
								<div class="col-xs-12 col-md-10">
									<div class="row">
										<div class="col-ms-6 col-sm-6">
											<div class="form-group"> <!-- has-error -->
												<!-- <label class="control-label login__form__label" for="register-prenume">Prenume</label> -->
												<input class="form-control <? if($_errors['surname'] != "" && $_POST['submit'] == "register"){?>inp-error<? }?>" id="register-prenume" type="text" name="surname" value="<?=$_form['surname']?>" placeholder="[Prenume]">
												<span class="help-block hidden">Necesar</span>
												<? if($_errors['surname'] != "" && $_POST['submit'] == "register"){?>
								            		<span class="error"><?=$_errors['surname']?></span>
								            	<? }?>
											</div>
										</div>
										<div class="col-ms-6 col-sm-6">
											<div class="form-group"> <!-- has-error -->
												<!-- <label class="control-label login__form__label" for="register-nume">Nume</label> -->
												<input class="form-control <? if($_errors['name'] != "" && $_POST['submit'] == "register"){?>inp-error<? }?>" id="register-nume" type="text" name="name" value="<?=$_form['name']?>" placeholder="[Nume]">
												<span class="help-block hidden">Necesar</span>
												<? if($_errors['name'] != "" && $_POST['submit'] == "register"){?>
								            		<span class="error"><?=$_errors['name']?></span>
								            	<? }?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<div class="form-group"> <!-- has-error -->
										<!-- <label class="control-label login__form__label" for="register-email">Email</label> -->
										<input class="form-control <? if($_errors['email'] != "" && $_POST['submit'] == "register"){?>inp-error<? }?>" id="register-email" type="email" name="email" value="<?=($_POST['submit'] == "register" ? $_form['email'] : '')?>" placeholder="[Email]">
										<span class="help-block hidden">Necesar</span>
										<? if($_errors['email'] != "" && $_POST['submit'] == "register"){?>
						            		<span class="error"><?=$_errors['email']?></span>
						            	<? }?>
									</div>
								</div>
							</div>
							<div class="form-group"> <!-- has-error -->
								<!-- <label class="control-label login__form__label" for="register-password">Parola</label> -->
								<input class="form-control <? if($_errors['password'] != "" && $_POST['submit'] == "register"){?>inp-error<? }?>" id="register-password" type="password" name="password" placeholder="[Parola]">
								<span class="help-block hidden">Necesar</span>
								<? if($_errors['password'] != "" && $_POST['submit'] == "register"){?>
				            		<span class="error"><?=$_errors['password']?></span>
				            	<? }?>
							</div>
							<div class="form-group"> <!-- has-error -->
								<!-- <label class="control-label login__form__label" for="register-password2">Confirma parola</label> -->
								<input class="form-control <? if($_errors['repassword'] != "" && $_POST['submit'] == "register"){?>inp-error<? }?>" id="register-password2" type="password" name="repassword" placeholder="[Confirma parola]">
								<span class="help-block hidden">Necesar</span>
								<? if($_errors['repassword'] != "" && $_POST['submit'] == "register"){?>
				            		<span class="error"><?=$_errors['repassword']?></span>
				            	<? }?>
							</div>
							<?/*
							<div class="checkbox login__form__checkbox login__form__checkbox--color">
								<input id="register-acord" value="1" name="terms" type="checkbox">
								<label for="register-acord">Am citit si sunt de acord cu <a href="<?=route('terms')?>" target="_blank">Termeni si Conditii</a></label>
								<? if($_errors['terms'] != "" && $_POST['submit'] == "register"){?>
				            		<span class="error"><?=$_errors['terms']?></span>
				            	<? }?>
							</div>
							<div class="checkbox login__form__checkbox login__form__checkbox--color">
								<input id="gdpr" value="1" name="gdpr" type="checkbox">
								<label for="gdpr">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
								<? if($_errors['gdpr'] != "" && $_POST['submit'] == "register"){?>
				            		<span class="error"><?=$_errors['gdpr']?></span>
				            	<? }?>
							</div>
							<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
							<? if($_errors['g-recaptcha-response'] != ""){?>
			            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
			            	<? } ?>
							*/?>
							<input type="hidden" name="action" value="register">
							<button type="submit" name="submit" value="register" class="btn btn--green login__form__btn center-block">[Inregistreaza-te]</button>

							<div class="no-acc">
								Ai deja un cont? <br>
								<strong>Intra in contul tau <a href="">[aici »]</a></strong>
							</div>
						</form>
					</div>
				<? }?>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('#reset-pass').click(function(e){
		e.preventDefault();
		$('.tab-pane').removeClass('active');
		$('#forgot').addClass('active');

		$('ul.nav-tabs li').removeClass('active');
	});
});
</script>
