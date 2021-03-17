<div class="container-fluid newsletter newsletter--light-blue <? if(!$_box_mobile[7]){?>hidden-xs<? }?>">
	<div class="row">
		<div class="col-xs-12">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-lg-6">
						<div class="row">
							<div class="col-sm-3">
								<i class="sprite sprite-newsletter-shout"></i>
							</div>
							<div class="col-sm-9">
								<div class="nl-intro">
									<p class="newsletter__title text--white"><strong>Esti pasionat de calatorii?<br>
									<span class="text-uppercase">AFLA PRIMUL CELE MAI<br>
									NOI OFERTE</span> direct pe mail! </strong></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5 col-lg-3">
						<form class="form-horizontal newsletter__form newsletter-form ajax-form" action="<?=$_base.'ajax/newsletter.php'?>" method="post">
							<div class="form-group">
								<input class="form-control" id="newslleter_nume" name="name" type="text" placeholder="Nume:">
							</div>
							<div class="form-group">
								<input class="form-control" id="newsletter_prenume" name="surname" type="text" placeholder="Prenume:">
							</div>
							<div class="form-group">
								<input class="form-control" id="newsletter_email" name="email" type="email" placeholder="Email:">
							</div>
							<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>" style="transform:scale(0.8);-webkit-transform:scale(0.8);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							<div class="form-group">
								<button type="submit" class="btn btn-block btn--orange newsletter__submit text--white hover-opacity">Aboneaza-te la newsletter »</button>
							</div>

							<div class="success ajax-success" style="color:#72b94e;"></div>
							<div class="error ajax-error"></div>
						</form>
					</div>
					<div class="hidden-xs hidden-ms hidden-sm col-lg-3">
						<img src="<?= $_base?>static/img/nl-suitcase.png" class="nl-suitcase">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
