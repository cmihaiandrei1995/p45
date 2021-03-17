<main class="margin--bottom-100">
	<div class="container margin--top-50 p-pag">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2 hr-title">
				<h3 class="hr-title__text text--blue">Fii prietenul Paralela45!</h3>
				<div class="inner-page-subtitle">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				</div>
			</div>
        </div>
	</div>
    <div class="container subscription-wrapper">
        <div class="row">
			<div class="col-xs-12">
				<div class="form-wrapper">
					<div class="row">
			            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
							<? if(isset($_POST['submit']) && $_valid){?>
								<h2 class="text-center">Multumim pentru abonare.</h2>
							<? }else{ ?>
				                <form action="" method="post">
				                    <div class="row">
				                        <div class="col-xs-12 col-md-6">
				                            <div class="form-group">
				                                <label>Nume:</label>
				                                <input type="text" name="sub_name" value="<?=$_form['sub_name']?>">
												<? if($_errors['sub_name'] != ""){?>
													<span class="error"><?=$_errors['sub_name']?></span>
												<? } ?>
				                            </div>
				                        </div>
				                        <div class="col-xs-12 col-md-6">
				                            <div class="form-group">
				                                <label>Prenume:</label>
				                                <input type="text" name="sub_surname" value="<?=$_form['sub_surname']?>">
												<? if($_errors['sub_surname'] != ""){?>
													<span class="error"><?=$_errors['sub_surname']?></span>
												<? } ?>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="row">
				                        <div class="col-xs-12">
				                            <div class="form-group">
				                                <label>Email:</label>
				                                <input type="text" name="sub_email" value="<?=$_form['sub_email']?>">
												<? if($_errors['sub_email'] != ""){?>
													<span class="error"><?=$_errors['sub_email']?></span>
												<? } ?>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="row">
				                        <div class="col-xs-12 col-lg-7">
				                            <div class="checkbox item-rezervare__info__detalii__checkbox item-rezervare__info__detalii__checkbox--color">
												<input id="terms" name="terms" value="1" type="checkbox">
												<label for="terms">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45. Pentru mai multe detalii consultati Politica de confidentialitate.</label>
												<? if($_errors['terms'] != ""){?>
													<span class="error"><?=$_errors['terms']?></span>
												<? } ?>
											</div>
				                        </div>
				                        <div class="col-xs-12 col-lg-5">
											<div class="checkbox item-rezervare__info__detalii__checkbox <? if($_form['item'] != 1){?>hidden<? }?>" id="gdpr-subscribe">
												<input id="gdpr" value="1" type="checkbox" name="gdpr" >
												<label for="gdpr">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45. Pentru mai multe detalii consultati <a href="<?=route('privacy')?>" target="_blank">Politica de confidentialitate</a>.</label>
												<? if($_errors['gdpr'] != ""){?>
													<span class="error"><?=$_errors['gdpr']?></span>
												<? } ?>
											</div>
											<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
											<? if($_errors['g-recaptcha-response'] != ""){?>
												<span class="error"><?=$_errors['g-recaptcha-response']?></span>
											<? } ?>
				                        </div>
				                    </div>
				                    <div class="row">
				                        <div class="col-xs-12 col-md-4 col-md-offset-4">
											<br>
				                            <button type="submit" name="submit" class="btn btn-block btn--orange newsletter__submit text--white hover-opacity">Aboneaza-te »</button>
				                        </div>
				                    </div>
				                <form>
							<? }?>
			            </div>
					</div>
				</div>
			</div>
        </div>
    </div>
</main>
