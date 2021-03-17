
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

	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">

						<a href="#" onclick="window.history.go(-1); return false;">< Inapoi </a>

						<div class="bilete-rezervare__detalii">
							<div class="row">

								<div class="col-sm-8">
									<p class="bilete-rezervare__detalii__title"><strong><?= $city_from ?></strong> (<?= $_item['iata_from'] ?>) - <strong><?= $city_to ?></strong> (<?= $_item['iata_to'] ?>)</p>
									<p class="bilete-rezervare__detalii__sub"><?= $date_from ?> <?= $date_to != "" ? " - ".$date_to : "" ?></p>
								</div>
								<div class="col-sm-4">
									<p class="bilete-rezervare__detalii__pret">de la <strong><?= $_item['price'] ?> €</strong></p>
									<p class="bilete-rezervare__detalii__pret__text">/ persoana / dus-intors <?//=days_between_dates($_item['date_from'], $_item['date_to'])?> <br>* taxa de aeroport inclusa</p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 bilete-rezervare__detalii--border-right">
									<div class="media">
										<div class="media-left media-middle">
											<i class="sprite sprite-arrow-blue-right-xl"></i>
										</div>
										<div class="media-body">
											<p class="bilete-rezervare__detalii__text"><span class="text-uppercase">PLECARE</span><br><strong><?= $date_departure ?></strong></p>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<p class="bilete-rezervare__detalii__text"><?= $_item['airport_from'] ?>, <?= $city_from ?><br><strong><?= $_item['time_departure_from'] ?></strong></p>
								</div>
								<div class="col-sm-2">
									<p class="bilete-rezervare__detalii__text"><?= $_item['info_stop'] ?><br><strong><?= $_item['time_stop'] ?></strong></p>
								</div>
								<div class="col-sm-2">
									<p class="bilete-rezervare__detalii__text"><?= $_item['airport_to'] ?>, <?= $city_to ?><br><strong><?= $_item['time_departure_to'] ?></strong></p>
								</div>
								<div class="col-sm-2 bilete-rezervare__detalii--border-left">
									<img class="bilete-rezervare__detalii__img" src="<?= $company_image ?>" alt="<?= $company_title ?>">
								</div>
							</div>
							<? if($date_return != ""){?>
								<div class="row">
									<div class="col-lg-3 bilete-rezervare__detalii--border-right">
										<div class="media">
											<div class="media-left media-middle">
												<i class="sprite sprite-arrow-blue-left-xl"></i>
											</div>
											<div class="media-body">
												<p class="bilete-rezervare__detalii__text"><span class="text-uppercase">Retur</span><br><strong><?= $date_return ?></strong></p>
											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<p class="bilete-rezervare__detalii__text"><?= $_item['airport_to'] ?>, <?= $city_to ?><br><strong><?= $_item['time_return_from'] ?></strong></p>
									</div>
									<div class="col-sm-2">
										<p class="bilete-rezervare__detalii__text"><?= $_item['info_stop'] ?><br><strong><?= $_item['time_stop'] ?></strong></p>
									</div>
									<div class="col-sm-2">
										<p class="bilete-rezervare__detalii__text"><?= $_item['airport_from'] ?>, <?= $city_from ?><br><strong><?= $_item['time_return_to'] ?></strong></p>
									</div>
									<div class="col-sm-2 bilete-rezervare__detalii--border-left">
										<img class="bilete-rezervare__detalii__img" src="<?= $company_image ?>" alt="<?= $company_title ?>">
									</div>
								</div>
							<? }?>
						</div>
						<? if($_item['observation']){  ?>
							<div class="col-sm-9">
								<?= $_item['observation'] ?>
							</div>
						<? } ?>
						<!--
						<div class="col-md-4 col-md-offset-4">
							<button class="btn btn-block btn--green bilete-rezervare__detalii__btn" id="open-res-form">Continua</button>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container <? //if(!isset($_POST['submit'])){ echo 'hidden'; } ?>" id="res-form">
		<div class="row bilete-rezervare">
			<div class="col-xs-12">
				<p class="bilete-rezervare__title"><strong>CERERE OFERTA BILET AVION</strong></p>
			</div>
			<? if($_valid && isset($_POST['submit'])){?>
				<div class="success-form" id="form-response">
			        <span class="title"><? _e('Cererea ta a fost inregistrata. Aceasta nu este o rezervare, iar un consultant te va contacta in cel mai scurt timp.')?></span>
			    </div>
			    <br><br><br>
			<? }else{?>
				<div class="col-lg-8 col-lg-offset-2" id="form-response">
					<p class="bilete-rezervare__sub">Detalii</p>
					<form class="row" method="post" action="#form-response">
						<div class="col-ms-6 col-sm-6">
							<div class="form-group has-feedback"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-data-plecare">Data plecare</label>
								<input class="form-control datepicker" id="bilete-rezervare-data-plecare" type="text" name="data_plecare" value="<?= $_form["data_plecare"] != "" ? $_form["data_plecare"] : $date_from2 ?>">
								<? if($_errors['data_plecare'] != ""){?>
				            		<span class="error"><?=$_errors['data_plecare']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="form-group has-feedback"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-data-intoarcere">Data intoarcere</label>
								<input class="form-control datepicker" id="bilete-rezervare-data-intoarcere" type="text"  name="data_intoarcere" value="<?= $_form["data_intoarcere"] != "" ? $_form["data_plecare"] : $date_to ?>">
								<? if($_errors['data_intoarcere'] != ""){?>
				            		<span class="error"><?=$_errors['data_intoarcere']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6 col-md-4">
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
						<div class="col-ms-6 col-sm-6 col-md-4">
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
						<div class="col-ms-6 col-sm-6 col-md-4">
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
						<div class="col-xs-12">
							<div class="checkbox item-rezervare__info__detalii__checkbox">
								<input id="bilete-rezervare-direct" type="checkbox" value="1" name="zboruri_directe">
								<label for="bilete-rezervare-direct">Prefer doar zboruri directe </label>
							</div>
						</div>
						<div class="col-xs-12">
							<p class="bilete-rezervare__sub">Contact</p>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-prenume">Prenume</label>
								<input class="form-control" id="bilete-rezervare-prenume" type="text" name="firstname" value="<?= $_form["firstname"] ?>">
								<? if($_errors['firstname'] != ""){?>
				            		<span class="error"><?=$_errors['firstname']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-nume">Nume</label>
								<input class="form-control" id="bilete-rezervare-nume" type="text" name="lastname" value="<?= $_form["lastname"] ?>">
								<? if($_errors['lastname'] != ""){?>
				            		<span class="error"><?=$_errors['lastname']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-email">Email</label>
								<input class="form-control" id="bilete-rezervare-email" type="text" name="email" value="<?= $_form["email"] ?>">
								<? if($_errors['email'] != ""){?>
				            		<span class="error"><?=$_errors['email']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="form-group"> <!-- has-error -->
								<label class="control-label bilete-rezervare__label" for="bilete-rezervare-telefon">Telefon</label>
								<input class="form-control" id="bilete-rezervare-telefon" type="text" name="phone" value="<?= $_form["phone"] ?>">
								<? if($_errors['phone'] != ""){?>
				            		<span class="error"><?=$_errors['phone']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-6">
							<div class="checkbox bilete-rezervare__checkbox">
								<input id="bilete-rezervare-acord" type="checkbox" value="1" name="newsletter">
								<label class="bilete-rezervare__label--small" for="bilete-rezervare-acord">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45.</label>
							</div>
							<? /*
							<div class="checkbox bilete-rezervare__checkbox">
								<input id="bilete-rezervare-contract" type="checkbox" value="1" name="contract_turist" >
								<label class="bilete-rezervare__label--small" for="bilete-rezervare-contract">Am citit si sunt de acord cu <a href="<?= route('tourist-contract') ?>" target="_blank">Contractul cu turistul</a></label>
								<? if($_errors['contract_turist'] != ""){?>
				            		<span class="error"><?=$_errors['contract_turist']?></span>
				            	<? }?>
							</div>
							*/ ?>
							<div class="checkbox bilete-rezervare__checkbox">
								<input id="bilete-rezervare-termeni" type="checkbox" value="1" name="terms">
								<label class="bilete-rezervare__label--small" for="bilete-rezervare-termeni">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
								<? if($_errors['terms'] != ""){?>
				            		<span class="error"><?=$_errors['terms']?></span>
				            	<? }?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
							<? if($_errors['g-recaptcha-response'] != ""){?>
			            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
			            	<? } ?>
						</div>
						<div class="clearfix"></div>
						<div class="col-xs-12 col-md-4 auto">
							<button class="btn btn--green btn-inline-block bilete-rezervare__btn" type="submit" name="submit">Cere oferta</button>
						</div>
					</form>
				</div>
			<? } ?>
		</div>
		<div class="row">
			<div class="col-xs-12 bilete-cond-financiare">
				<hr class="hr--blue">
				<p class="bilete-cond-financiare__title"><strong>Conditii financiare</strong></p>
				<?= $_item['financial'] != "" ? $_item['financial'] : '' ?>
				<hr class="hr--blue">
			</div>
		</div>
	</div>
	<?/*
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- titlu pagina -->
				<h1 class="logo-title logo-title--full margin--bottom-40">
					<div class="ipi-icons">
						<i class="sprite ipi-plane-icon"></i>
					</div>
					<span class="logo-title__text">Rezervare bilete</span><br>
				</h1>
				<!-- end titlu pagina -->
			</div>
		</div>
		<div class="row bilete">
			<div class="col-xs-12">
				<div class="swiper-container swiper-airplane">
					<div class="swiper-wrapper">
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-tarom.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-blueair.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-wizz.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-airfrance.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-klm.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-alitalia.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-lufthansa.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-czeck.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-lot.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-aeroflot.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-corendon.png" alt="..."></div>
						<div class="swiper-slide"><img src="<?= $_base ?>static/img/airlines/airline-freebird.png" alt="..."></div>
					</div>
				</div>
				<p class="bilete__title"><strong>Bilete personalizate</strong></p>
				<p class="bilete__sub">Paralela 45 iti poate oferi bilete la tarife speciale pentru un numar mare zboruri. Daca totusi zborul pe care il cauti nu se afla in oferta noastra, putem obtine pentru tine o <span class="text--light-blue">oferta personalizata.</span> Pentru oferte personalizate folositi <span class="text--light-blue">formularul de contact.</span></p>
			</div>
		</div>
	</div>
	*/?>

	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_avantaje.php' ?>*/?>
</main>


<? if($_item['periods']){?>
	<script>
	$(document).ready(function(){

		var $dates_from = [];
		var $dates_to = [];
		var selectedChekinDate = '';

		<? $dates_from = array();?>
		<? foreach($_item['periods'] as $date){?>
			<? if(!in_array($date['date_from'], $dates_from)){?>
				$dates_from.push('<?=$date['date_from']?>');
				$dates_to['<?=$date['date_from']?>'] = [];
			<? $dates_from[] = $date['date_from']; }?>
			$dates_to['<?=$date['date_from']?>'].push('<?=$date['date_to']?>');
		<? }?>

		$datePicker_from = $("#bilete-rezervare-data-plecare").datepicker({
	        minDate: "+1d",
	        changeMonth: true,
	        numberOfMonths: 1,
	        dateFormat: 'dd.mm.yy',
	        firstDay: 1,
	    	beforeShowDay: availableDays,
	    	minDate: '<?=date("d.m.Y", strtotime($_item['periods'][0]['date_from']))?>',
	        onSelect: trigerNextCalendarMinDateRestricted
	    });

	    $("#bilete-rezervare-data-intoarcere").datepicker({
	        changeMonth: true,
	        dateFormat: 'dd.mm.yy',
	        <? if(!$_date_to){?>
	        disabled: true,
	        <? }?>
	        firstDay: 1,
	        numberOfMonths: 1
	    });

		function availableDays(date) {
			dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

			//console.log(dmy+' : '+($.inArray(dmy, $dates_from)));
			if ($.inArray(dmy, $dates_from) != -1) {
		    	return [true, "","Available"];
		  	} else {
		    	return [false,"","unAvailable"];
		  	}
		}

		function availableDaysReturn(date) {
			dmy = date.getFullYear() + "-" + ('0' + (date.getMonth()+1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);

			tmp = selectedChekinDate.split('.');
			new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

			//console.log(dmy+' : '+($.inArray(dmy, $dates_to[new_dmy])));
			if ($.inArray(dmy, $dates_to[new_dmy]) != -1) {
		    	return [true, "","Available"];
		  	} else {
		    	return [false,"","unAvailable"];
		  	}
		}

		function trigerNextCalendarMinDateRestricted(selectedDate){
			$("#bilete-rezervare-data-intoarcere").datepicker("option", "disabled", false);
			$('#bilete-rezervare-data-intoarcere').val('');

	    	selectedChekinDate = selectedDate;

	    	tmp = selectedChekinDate.split('.');
			new_dmy = tmp[2] + "-" + tmp[1] + "-" + tmp[0];

			selectedChekoutDate = $dates_to[new_dmy];

			tmp = selectedChekoutDate[0].split('-');
			new_date = tmp[2] + "." + tmp[1] + "." + tmp[0];

	    	$('#bilete-rezervare-data-intoarcere').datepicker("option", "minDate", new_date);
	    	$('#bilete-rezervare-data-intoarcere').datepicker("option", "beforeShowDay", availableDaysReturn);
	    }
	});
	</script>
<? }?>
