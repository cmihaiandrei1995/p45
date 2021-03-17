
<main class="margin--bottom-100">
	<div class="inner-page-intro rights-page-intro">
        <div class="main-filters">
            <div class="home_forms-wrapper fhw-inner">
				<div class="row">
		            <div class="container">
		                <div class="col-xs-12 text-center">
		                    <p class="tag-line"><b><?=$_text['title']?></b></p>
		                </div>
		            </div>
		        </div>
            </div>
        </div>
    </div>

	<?/*
	<div class="container-fluid inner-banner-about">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<div class="black-layer"></div>
					<img class="img-banner__img object-fit" src="<?= $_base ?>static/img/banner-drepturi.jpg" alt="<?=$_text['title']?>">
				</div>
			</div>
		</div>
		<div class="row">
            <div class="container">
                <div class="col-xs-12 text-center">
                    <p class="tag-line"><b><?=$_text['title']?></b></p>
                </div>
            </div>
        </div>
	</div>
	*/?>

	<div class="container-fluid margin--top-50">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
						<?=$_text['description']?>
					</div>
					<div class="col-xs-12 hr-title st-hr-title margin--top-30">
						<h3 class="hr-title__text text--blue">Drepturile clientilor in privinta datelor personale</h3>
					</div>
				</div>
				<div class="row p-util-wrapper <?=isset($_POST['submit']) ? "hidden" : ""?>" id="items-wrap">
					<? foreach($_items as $item){?>
						<div class="col-sm-6 col-lg-3 text-center">
							<div class="rpo-link">
								<a href="#" class="data-item" data-what="<?=generate_name($item['title'])?>" data-id="<?=$item['id_data_protection']?>"><img src="<?=$item['images'][0]['small']?>"></a>
							</div>
						</div>
					<? }?>
				</div>
			</div>
		</div>
	</div>

	<? foreach($_items as $item){?>
		<div class="container-fluid <?=isset($_POST['submit']) && $item['id_data_protection'] == $_form['item'] ? "" : "hidden"?> data-item-expanded" id="data<?=$item['id_data_protection']?>">
			<div class="row">
				<div class="container">
					<div class="row p-util-wrapper">
						<div class="col-xs-12">
							<img src="<?=$item['images'][0]['small']?>" class="rpo-pict">
							<p class="rpo-title"><?=$item['title']?></p>
							<div class="rpo">
								<?=$item['description']?>
							</div>
							<a href="#" class="go-back-gdpr">x Inapoi</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<? }?>

	<div class="container-fluid margin--top-20 rpo-gray-bg <?=isset($_POST['submit']) ? "" : "hidden"?>" id="form-container">
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
					<input type="hidden" name="item" id="item_id" value="<?=$_form['item']?>">
					<div class="row">
						<div class="col-xs-12">
							<p>Pentru a trimite cererea va rugam completati informatiile de mai jos:</p>
							<!-- Date contact<br><br> -->
						</div>
						<span id="form-response"></span>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<div class="row">
									<!-- <label class="col-xs-12 col-sm-4">Prenume si nume:</label> -->
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
									<!-- <label class="col-xs-12 col-sm-4">Telefon mobil:</label> -->
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
									<!-- <label class="col-xs-12 col-sm-4">Email:</label> -->
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
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="checkbox item-rezervare__info__detalii__checkbox <? if($_form['item'] != 1 && $_form['item'] != 2){?>hidden<? }?>" id="gdpr-subscribe">
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
								<div class="col-md-12">
									<button class="btn btn--green item-rezervare__info__detalii__btn" id="submit" name="submit" type="submit">
										<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
										<span>TRIMITE CEREREA</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			<? }?>
		</div>
	</div>
</main>

<script>
$(document).ready(function(){

	$('.data-item').click(function(e){
		e.preventDefault();
		$('.data-item-expanded').addClass('hidden');
		$('#data'+$(this).data('id')).removeClass('hidden');
		$('#form-container').removeClass('hidden');
		$('#items-wrap').addClass('hidden');
		$('#item_id').val($(this).data('id'));

		if($(this).data('id') == 1 || $(this).data('id') == 2){
			$('#gdpr-subscribe').removeClass('hidden');
		}
	});

	$('.go-back-gdpr').click(function(e){
		e.preventDefault();
		$('.data-item-expanded').addClass('hidden');
		$('#form-container').addClass('hidden');
		$('#items-wrap').removeClass('hidden');

		$('#gdpr-subscribe').addClass('hidden');
	});
});
</script>
