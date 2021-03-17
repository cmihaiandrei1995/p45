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
					<div class="login__intro">Intra in contul tau</div>
					<form class="login__form <?php if(count($_errors) && $_POST['submit'] == "login") { echo "form-error"; } ?>" action="<?=route('login')?>" method="post">
						<div class="form-group"> <!-- has-error -->
							<!-- <label class="control-label login__form__label" for="login-email">Email</label> -->
							<input class="form-control <? if($_errors['email'] != "" && $_POST['submit'] == "login"){?>inp-error<? }?>" value="<?=($_POST['submit'] == "login" ? $_form['email'] : '')?>" id="login-email" name="email" type="email" placeholder="Email">
							<span class="help-block hidden">Necesar</span>
							<? if($_errors['email'] != "" && $_POST['submit'] == "login"){?>
			            		<span class="error"><?=$_errors['email']?></span>
			            	<? }?>
						</div>
						<div class="form-group"> <!-- has-error -->
							<!-- <label class="control-label login__form__label" for="login-password">Parola</label> -->
							<input class="form-control <? if($_errors['password'] != "" && $_POST['submit'] == "login"){?>inp-error<? }?>" id="login-password" type="password" name="password" placeholder="Parola">
							<span class="help-block hidden">Necesar</span>
                            <? if($_errors['password'] != "" && $_POST['submit'] == "login"){?>
			            		<span class="error"><?=$_errors['password']?></span>
			            	<? }?>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="checkbox login__form__checkbox login__form__checkbox--color">
									<input id="login-remember" name="remember" value="1" type="checkbox">
									<label for="login-remember">Tine-ma minte</label>
								</div>
							</div>
							<div class="col-xs-6">
								<a href="#" id="reset-pass">Ai uitat parola?</a>
							</div>
						</div>
						<input type="hidden" name="action" value="login">
						<button type="submit" name="submit" value="login" class="btn btn--green login__form__btn center-block">Intra in cont</button>

						<div class="no-acc">
							Nu ai cont?<br>
							<strong>Creeaza-ti contul tau <a href="">[aici »]</a></strong>
						</div>
					</form>
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
