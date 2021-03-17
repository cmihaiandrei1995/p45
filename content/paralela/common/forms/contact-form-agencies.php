<div class="contact-boxes">
	<div class="row">
		<div class="col-sm-4 contact-box" data-target="clienti">
			<div>
				<div class="layer">
					<h3>
						<i class="sprite ipi-mail-iconlightblue"></i>
						<p>
							[Contact<br>pentru <strong>clienti</strong>
							<i class="zmdi zmdi-caret-up"></i>]
						</p>
					</h3>
				</div>
			</div>
		</div>
		<div class="col-sm-4 contact-box" data-target="parteneri">
			<div>
				<div class="layer">
					<h3>
						<i class="sprite ipi-partners-iconlightblue"></i>
						<p>
							[Contact<br>pentru <strong>parteneri</strong>
							<i class="zmdi zmdi-caret-up"></i>]
						</p>
					</h3>
				</div>
			</div>
		</div>
		<div class="col-sm-4 contact-box"  data-target="corporate">
			<div>
				<div class="layer">
					<h3>
						<i class="sprite ipi-world-iconlightblue"></i>
						<p>
							[Contact<br>pentru <strong>corporate</strong>
							<i class="zmdi zmdi-caret-up"></i>]
						</p>
					</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 form-agencies-contact contact-form " style="<?= isset($_POST['contact-submit']) ? 'display:block;' : ''  ?>">

			<? if($_valid && isset($_POST['contact-submit'])){ ?>
			  	<div class="row">
			  		<div class="container">
						<div class="success-form" id="form-response">
					        <span class="title"><? _e('Va multumim!')?></span>
					    </div>
					    <br><br><br>
					</div>
				</div>
			<? }else{ ?>
				<span id="form-response"></span>
				<form method="post" action="#form-response" class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Prenume" name="firstname" value="<?=$_form['firstname']?>">
								<? if($_errors['firstname'] != ""){?>
				            		<span class="error"><?=$_errors['firstname']?></span>
				            	<? } ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Telefon" name="phone" value="<?=$_form['phone']?>">
								<? if($_errors['phone'] != ""){?>
				            		<span class="error"><?=$_errors['phone']?></span>
				            	<? } ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Nume" name="lastname" value="<?=$_form['lastname']?>">
								<? if($_errors['lastname'] != ""){?>
				            		<span class="error"><?=$_errors['lastname']?></span>
				            	<? } ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email" name="email" value="<?=$_form['email']?>">
								<? if($_errors['email'] != ""){?>
				            		<span class="error"><?=$_errors['email']?></span>
				            	<? } ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<textarea cols="5" rows="5" name="observations" placeholder="Observatii"><?= !$_valid && $_form['observations'] != '' ? $_form['observations'] : '' ?></textarea>
						</div>
					</div>
					<div class="clearfix"><br></div>
					<div class="row">
						<div class="col-sm-9">
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
						<input type="hidden" name="page-location" value="<?=$_form['page-location']?>" id="page-location-agency">
						<div class="col-sm-3">
							<button class="btn btn-block btn--green item__info__btn" type="submit" name="contact-submit" value="1">Trimite cererea</button>
						</div>
					</div>
				</form>
			<? } ?>
		</div>
	</div>
</div>


<script>
	$(document).ready(function(){
		$('body').on('click', '.contact-boxes .contact-box', function(){
	    	$(this).siblings(':not(.contact-form)').addClass('hidden');
	    	$('#page-location-agency').val($(this).data('target'));
	    	$('.contact-form').show();
	    	$('.close-cat-contact').show();
	    });

	    $('body').on('click', '.close-cat-contact', function(e){
	    	e.preventDefault();
	    	$('.contact-boxes .contact-box').removeClass('hidden');
	    	$('.close-cat-contact').hide();
	    	$('.contact-form').hide();
	    });
	});
</script>

<? if(isset($_POST['contact-submit'])){?>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.contact-boxes .contact-box[data-target="<?= $_form['page-location'] ?>"]').trigger("click");
		})
	</script>
<? } ?>
