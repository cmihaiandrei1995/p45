<main class="margin--bottom-100 margin--top-50">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 hr-title wisub">
				<hr class="hr-title__hr">
				<h3 class="hr-title__text text--blue"><?= e('Asigurari de calatorie') ?></h3>
			</div>
		</div>

		<? if(!$_offers){?>
			<form method="post" action="" id="insurance-form">
				<!-- Informatii despre calatorie -->
				<div class="row">
					<div class="col-xs-12 margin--top-30">
						<h4 class="text--blue"><?= e('Informatii despre calatorie') ?></h4>
					</div>

					<div class="col-sm-6 col-md-2">
						<div class="form-group"> <!-- has-error -->
							<div class="has-feedback calendar-input">
								<label class="control-label bilete-rezervare__label" for=""><?= e('Data inceput')?></label>
								<input type="text" id="start_date" name="start_date" value="<?=$_form['start_date']?>" class="form-control" autocomplete="off">
								<img src="<?= $_base ?>static/img/calendar-input.jpg" class="calendar-trigger" />
							</div>
							<? if($_errors['start_date']){?>
								<span class="error"><?=$_errors['start_date']?></span>
							<? }?>
						</div>
					</div>

					<div class="col-sm-6 col-md-2">
						<div class="form-group"> <!-- has-error -->
							<div class="has-feedback calendar-input">
								<label class="control-label bilete-rezervare__label" for=""><?= e('Data sfarsit') ?></label>
								<input type="text" id="end_date" name="end_date" value="<?=$_form['end_date']?>" class="form-control" autocomplete="off">
								<img src="<?= $_base ?>static/img/calendar-input.jpg" class="calendar-trigger" />
							</div>
							<? if($_errors['end_date']){?>
								<span class="error"><?=$_errors['end_date']?></span>
							<? }?>
						</div>
					</div>

					<div class="col-sm-12 col-md-8">
						<div class="row">
							<div class="col-sm-4 col-md-4">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="">Scopul calatoriei</label>
									<select class="form-control " name="scope" id="scope">
			                            <option value="">Alege scopul calatoriei</option>
			                            <?php foreach($_scopes as $item) { ?>
			                                <option<?=$item['code'] == $_form['scope']?' selected':''?> value="<?php echo $item['code'] ?>"><?php echo $item['title'] ?></option>
			                            <?php } ?>
			                        </select>
									<? if($_errors['scope']){?>
										<span class="error"><?=$_errors['scope']?></span>
									<? }?>
								</div>
							</div>

							<div class="col-sm-4 col-md-4">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="">Zona</label>
									<select class="form-control " name="zone" id="zone" <? if($_form['zone'] != ""){?>data-selected="<?=$_POST['zone']?>"<? }else{?>disabled<? }?>>
			                            <option value="">Alege zona</option>
			                            <?php foreach($_destinations as $k => $item) { ?>
			                                <!--<option<?=$item['code'] == $_form['zone']?' selected':''?> value="<?php echo $item['code'] ?>"><?php echo $item['title'] ?></option>-->
			                            <?php } ?>
			                        </select>
									<? if($_errors['zone']){?>
										<span class="error"><?=$_errors['zone']?></span>
									<? }?>
								</div>
							</div>

							<div class="col-sm-4 col-md-4">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="">Destinatie</label>
									<select class="form-control " name="destination" id="destination" <? if($_POST['destination'] != ""){?>data-selected="<?=$_form['destination']?>"<? }else{?>disabled<? }?>>
			                            <option value="">Alege destinatie</option>
			                            <?php foreach($_destinations as $k => $item) { ?>
			                                <!--<option<?=$item['code'] == $_form['destination']?' selected':''?> value="<?php echo $item['code'] ?>"><?php echo $item['title'] ?></option>-->
			                            <?php } ?>
			                        </select>
									<? if($_errors['destination']){?>
										<span class="error"><?=$_errors['destination']?></span>
									<? }?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>

				<!-- Informatii despre calatori -->
				<div class="row">
					<div class="col-xs-12">
						<h4 class="text--blue"><?= e('Informatii despre calatori') ?></h4>
					</div>
				</div>
				<div id="insurants">
	                <?php $ins_lim = count($_POST['insurants']) > 0 ? count($_POST['insurants']) : 1; for($i=0; $i<$ins_lim; $i++) { ?>
						<div class="row row-insurant">
							<div class="col-xs-12">
								<h5 class="info_insurant">Informatii calator <span><?=($i+1)?></span> <a href="#" class="remove-insurant upper <? if($i == 0){?>hidden<? }?>"><i class="zmdi zmdi-close-circle"></i></a></h5>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for=""><?= e('Nume') ?></label>
											<input type="text" name="insurants[<?=$i?>][firstname]" value="<?=$_POST['insurants'][$i]['firstname']?>" class="form-control">
											<? if($_errors['insurants'.$i.'firstname']){?>
												<span class="error"><?=$_errors['insurants'.$i.'firstname']?></span>
											<? }?>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for=""><?= e('Prenume') ?></label>
											<input type="text" name="insurants[<?=$i?>][lastname]" value="<?=$_POST['insurants'][$i]['lastname']?>" class="form-control">
											<? if($_errors['insurants'.$i.'lastname']){?>
												<span class="error"><?=$_errors['insurants'.$i.'lastname']?></span>
											<? }?>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">CNP</label>
											<input type="text" name="insurants[<?=$i?>][cnp]" value="<?=$_POST['insurants'][$i]['cnp']?>" class="form-control">
											<? if($_errors['insurants'.$i.'cnp']){?>
												<span class="error"><?=$_errors['insurants'.$i.'cnp']?></span>
											<? }?>
										</div>
									</div>
									<div class="col-sm-2">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Serie si nr buletin</label>
											<input type="text" name="insurants[<?=$i?>][ci]" value="<?=$_POST['insurants'][$i]['ci']?>" class="form-control">
											<? if($_errors['insurants'.$i.'ci']){?>
												<span class="error"><?=$_errors['insurants'.$i.'ci']?></span>
											<? }?>
										</div>
									</div>

									<? /*
									<div class="col-sm-3">
										<div class="form-group"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Sex</label>
											<select class="form-control select__s2" name="insurants[<?=$i?>][gender]">
					                            <option value="">Alege</option>
					                            <?php foreach($_genders as $k => $label) { ?>
					                                <option<?=$k==$_POST['insurants'][$i]['gender']?' selected':''?> value="<?php echo $k ?>"><?php echo $label ?></option>
					                            <?php } ?>
					                        </select>
											<? if($_errors['insurants'.$i.'gender']){?>
												<span class="error"><?=$_errors['insurants'.$i.'gender']?></span>
											<? }?>
										</div>
									</div>

									<div class="col-sm-3">
										<div class="row">
											<div class="col-sm-12">
												<div class="form-group"> <!-- has-error -->
													<label class="control-label bilete-rezervare__label" for="">Data nasterii</label>
													<div class="row">
														<div class="col-md-3 col-sm-4 col-xs-3 db-padd-left">
															<div class="form-group" style="margin:0px;">
																<select class="form-control seldate" name="insurants[<?=$i?>][dob_day]">
																	<option value="">Zi</option>
																	<? for($zi=1; $zi<=31; $zi++){
																		 $dSel = "";
																		 if($_POST['insurants'][$i]['dob_day']==$zi) $dSel = "selected";
																		 echo '<option value="'.$zi.'" '.$dSel.'>'.$zi.'</option>';
																	 }?>
																</select>
															</div>
														</div>
														<div class="col-md-5 col-sm-4 col-xs-5 db-padd">
															<div class="form-group" style="margin:0px;">
																<select class="form-control seldate" name="insurants[<?=$i?>][dob_month]">
							                                        <option value="">Luna</option>
							                                        <? for($luna=1; $luna<=12; $luna++){
							                                            $mSel = "";
							                                            if($_POST['insurants'][$i]['dob_month']==$luna) $mSel = "selected";
							                                            echo '<option value="'.$luna.'" '.$mSel.'>'.$_months[$luna].'</option>';
							                                         }?>
							                                    </select>
															</div>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-4 db-padd-right">
															<div class="form-group" style="margin:0px;">
																<select class="form-control seldate" name="insurants[<?=$i?>][dob_year]">
							                                        <option value="">An</option>
							                                        <? for($an=date('Y'); $an>=(date('Y')-99); $an--){
							                                            $aSel = "";
							                                            if($_POST['insurants'][$i]['dob_year']==$an) $aSel = "selected";
							                                            echo '<option value="'.$an.'" '.$aSel.' >'.$an.'</option>';
							                                         }?>
							                                    </select>
															</div>
														</div>
													</div>
													<?php if($_errors['insurants'.$i.'age'] != "") { ?>
						                                <span class="error"><?=$_errors['insurants'.$i.'age']?></span>
						                            <?php } ?>
						                            <?php if($_errors['insurants'.$i.'dob_day'] != "" || $_errors['insurants'.$i.'dob_month'] != "" || $_errors['insurants'.$i.'dob_year'] != "") { ?>
						                                <span class="error">Completati data nasterii!</span>
						                            <?php } ?>
										        </div>
											</div>
										</div>
									</div>
									*/ ?>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Judet</label>
											<select class="form-control select__s2" name="insurants[<?=$i?>][county]">
					                            <option value="">Alege judet</option>
					                            <?php foreach($_counties as $item) { ?>
					                                <option<?=$item['code']==$_POST['insurants'][$i]['county']?' selected':''?> value="<?php echo $item['code'] ?>"><?php echo $item['title'] ?></option>
					                            <?php } ?>
					                        </select>
											<? if($_errors['insurants'.$i.'county']){?>
												<span class="error"><?=$_errors['insurants'.$i.'county']?></span>
											<? }?>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Localitate</label>
											<input type="text" name="insurants[<?=$i?>][city]" value="<?=$_POST['insurants'][$i]['city']?>" class="form-control">
											<? if($_errors['insurants'.$i.'city']){?>
												<span class="error"><?=$_errors['insurants'.$i.'city']?></span>
											<? }?>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group has-feedback"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Adresa</label>
											<input type="text" name="insurants[<?=$i?>][address]" value="<?=$_POST['insurants'][$i]['address']?>" class="form-control">
											<? if($_errors['insurants'.$i.'address']){?>
												<span class="error"><?=$_errors['insurants'.$i.'address']?></span>
											<? }?>
										</div>
									</div>
								</div>
								<hr>
							</div>
						</div>
					<? }?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<a href="#" id="add-travelor"><?= e('+ Adauga calator') ?></a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-sm-8">
						<br><br>
						<div class="checkbox bilete-rezervare__checkbox">
							<input id="gdpr" type="checkbox" value="1" name="gdpr">
							<label for="gdpr">
								Sunt de acord ca datele mele personale sa fie prelucrate de catre Generali in scopul emiterii politelor de asigurare
							</label>
							<? if($_errors['gdpr']){?>
								<span class="error"><?=$_errors['gdpr']?></span>
							<? }?>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<button class="btn btn-block btn--green bilete-rezervare__btn" name="search" type="submit">
							<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
							<span><?= e('Afiseaza ofertele') ?></span>
						</button>
					</div>
				</div>
			</form>
		<? }?>


		<? if($_offers){?>
			<!-- rezultate -->
			<form method="post" action="" id="book-form">
				<div id="insurance-results">

					<div class="row">
						<div class="col-xs-12 margin--top-30 margin--bottom-10">
							<h4 class="text--blue"><?= e('Asigurare de calatorie') ?></h4>
						</div>
					</div>

					<div class="row">
						<? foreach($_offers as $i => $offer){?>
							<div class="col-sm-6 margin--bottom-25" style="<?=$i%2 == 0 ? "clear:both" : ""?>">
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="checkbox<?=$offer['product']['id_generali_product']?>" class="idd-trigger" type="radio" value="<?=$offer['product']['id_generali_product']?>" name="offer" <?=$_form['offer'] == $offer['product']['id_generali_product'] ? "checked" : ""?>>
									<label for="checkbox<?=$offer['product']['id_generali_product']?>">
										<?=$offer['product']['title']?> <span class="text--blue pull-right"><b><?=$offer['results']['endUserPrice']?></b> Lei</span>
									</label>
					            </div>
					            <div class="description">
					            	<?=$offer['product']['short_desc']?>
					            	<a href="#" class="show-popup" data-id="<?=$offer['product']['id_generali_product']?>">Vezi detalii »</a><br/>
					            	<!--<a href="#">Vezi termeni si conditii »</a>-->
					            </div>
							</div>
						<? }?>
						<? if($_errors['offer']){?>
							<div class="col-sm-12 margin--bottom-25 clear">
								<span class="error"><?=$_errors['offer']?></span>
							</div>
						<? }?>
					</div>

					<!--
						<div class="row margin--top-25">
							<div class="col-sm-6">
								<div class="checkbox bilete-rezervare__checkbox">
									<input id="bilete-rezervare-termeni" type="checkbox" value="1" name="terms">
									<label class="bilete-rezervare__label--small" for="bilete-rezervare-termeni">Am citit si sunt de acord cu <a href="<?=route('terms')?>" target="_blank">Termeni si conditii</a></label>
									<? if($_errors['gdpr']){?>
										<span class="error"><?=$_errors['gdpr']?></span>
									<? }?>
								 </div>
							 </div>
						</div>
					-->
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<br><br>
						<div class="checkbox bilete-rezervare__checkbox">
							<input id="terms" type="checkbox" value="1" name="terms">
							<label for="terms">
								Declar ca la momentul incheierii acestei asigurari de calatorie
								<ul>
									<li>ma aflu pe teritoriul Romaniei</li>
									<li>nu sunt insarcinata</li>
								</ul>
							</label>
						</div>
						<div class="description-declare"></div>
						<? if($_errors['terms']){?>
							<span class="error"><?=$_errors['terms']?></span><br><br>
						<? }?>

						<div class="checkbox bilete-rezervare__checkbox <? if(!$_form['offer']){?>hidden<? }?>" id="idd-all">
							<input id="pid" type="checkbox" value="1" name="pid">
							<label for="pid">
								<? foreach($_offers as $k => $offer){?>
									<div id="idd<?=$offer['product']['id_generali_product']?>" class="idd-item <? if($_form['offer'] != $offer['product']['id_generali_product']){?>hidden<? }?>">
										Am luat la cunostinta despre <a href="<?=$offer['idd']['documentURL']?>" target="_blank">documentul de informare privind produsele de asigurare</a>
									</div>
								<? }?>
							</label>
						</div>
						<div class="description-declare"></div>
						<? if($_errors['pid']){?>
							<span class="error"><?=$_errors['pid']?></span><br><br>
						<? }?>
					</div>
					<div class="col-xs-12 col-sm-3 pull-right">
						<button class="btn btn-block btn--green bilete-rezervare__btn" name="book" type="submit">
							<i class="zmdi zmdi-spinner zmdi-hc-spin hidden"></i>
							<span><?= e('Plateste') ?></span>
						</button>
					</div>
				</div>
			</form>
		<? }?>


	</div>
</main>


<? if($_offers){?>
	<? foreach($_offers as $offer){?>
		<div class="black-cover hidden" id="popup-info-<?=$offer['product']['id_generali_product']?>">
			<div class="popup-white">
				<a href="#" class="close-popup"><i class="zmdi zmdi-close"></i></a>
				<h4><?=$offer['product']['title']?></h4>
				<div class="table-wrapper">
					<?=$offer['product']['description']?>
				</div>
			</div>
		</div>
	<? }?>
<? }?>




<script>
$(document).ready(function(){

	$('.show-popup').click(function(e){
		e.preventDefault();

		id = $(this).data('id');

		$('#popup-info-'+id).removeClass('hidden');
		$('#popup-info-'+id).find('.close-popup').click(function(ev){
			ev.preventDefault();
			$('#popup-info-'+id).addClass('hidden');
		});
	});

	$('input.idd-trigger').change(function(){
		$('#idd-all').removeClass('hidden');
		$('.idd-item').addClass('hidden');
		$('#idd'+$(this).val()).removeClass('hidden');
	});

	$('#insurance-form, #book-form').submit(function() {
		var $this = $(this).find('button[type="submit"]');
	    $this.find('span').addClass('hidden');
	    $this.find('i').removeClass('hidden');
	    //$this.prop('disabled', true);
	});

	$('#scope, #zone, #destination').select2({
    	minimumResultsForSearch: Infinity,
    	language: "ro",
    });

    $('#scope').change(function(){
        var scope = $(this).val();

        if(scope != ""){
            $.ajax({
    			type: 'POST',
    			url: $_base + 'ajax/insurance/zones.php',
    			data: {scope: scope},
    			success: function(data) {
    				var json = jQuery.parseJSON(data);
    				if(json) {
                        $('#zone').attr('disabled', false);
                        $('#zone option[value!=""]').detach();
                        var $element = $('#zone').select2();
                        for (var d = 0; d < json.length; d++) {
                            var item = json[d];
                            var option = new Option(item.text, item.id, false, false);
                            $element.append(option);
                        }
                        $element.select2({'minimumResultsForSearch': 25}).trigger('change');

                        $('#destination').attr('disabled', true);
                        $('#destination option[value!=""]').detach();
    				}
                    <? if($_POST['zone'] != ""){?>
                        if($('#zone').data('selected') != ""){
                            $('#zone').val($('#zone').data('selected')).trigger('change');
                        }
                    <? }?>
    			}
    		});
        }else{
            $('#zone').attr('disabled', true);
            $('#zone option[value!=""]').detach();

            $('#destination').attr('disabled', true);
            $('#destination option[value!=""]').detach();
        }
    });

    $('#zone').change(function(){
        var zone = $(this).val();
        var scope = $('#scope').val();

        if(scope != "" && zone != ""){
            $.ajax({
    			type: 'POST',
    			url: $_base + 'ajax/insurance/destinations.php',
    			data: {scope: scope, zone: zone},
    			success: function(data) {
    				var json = jQuery.parseJSON(data);
    				if(json) {
                        $('#destination').attr('disabled', false);
						$('#destination optgroup').detach();
						$('#destination option[value!=""]').detach();
                        var $element = $('#destination').select2();

						$element.select2({data: json});
						/*
                        for (var d = 0; d < json.length; d++) {
                            var item = json[d];
                            var option = new Option(item.text, item.id, false, false);
                            $element.append(option);
                        }
						*/
                        $element.select2({'minimumResultsForSearch': 25}).trigger('change');
    				}

                    <? if($_POST['destination'] != ""){?>
                        if($('#destination').data('selected') != ""){
                            $('#destination').val($('#destination').data('selected')).trigger('change');
                        }
                    <? }?>
    			}
    		});
        }else{
            $('#destination').attr('disabled', true);
            $('#destination option[value!=""]').detach();
        }
    });

    <? if($_POST['zone'] != ""){?>
        $('#scope').trigger('change');
    <? }?>

    // INSURANTS
    var $insurants = $('#insurants');
    $('#add-travelor').on('click', function(event) {
        event.preventDefault();
		$total = $insurants.find('.row-insurant').length;
        // clone first row
        var $clone = $insurants.find('.row-insurant:first').clone();
        // strip data
        $clone.find('input, select').val('');
        $clone.find('.error').remove();
		$clone.find('.info_insurant a.remove-insurant').removeClass('hidden');

		if($total < 9){
	        // create new row
	        $insurants.append($clone);
	        // correct array index
	        renumber_insurants();
		}else{
			alert('Maxim 9 asigurati!');
		}

		$i = 1;
		$insurants.find('.row-insurant').each(function(){
			$(this).find('.info_insurant span').html($i);
			$i++;
		});
    });
    $insurants.on('click', '.remove-insurant', function(event) {
        event.preventDefault();
        // there must be at least one insurant
        if($insurants.find('.row').length>1) {
            var $this = $(this);
            $this.closest('.row-insurant').remove();
        } else {
            alert('Minim un asigurat!');
        }
		$i = 1;
		$insurants.find('.row-insurant').each(function(){
			$(this).find('.info_insurant span').html($i);
			$i++;
		});
    });
    function renumber_insurants() {
        $insurants.find('.row-insurant').each(function(index) {
            var prefix = 'insurants['+ index + ']';
            $(this).find('input, select').each(function() {
               this.name = this.name.replace(/insurants\[\d+\]/, prefix);
            });
        });
    }

    // DATEPICKERS
    // dest start date
    $('#start_date').datepicker({
        minDate: '+0',
        firstDay: 1,
        autoSize: true,
        dateFormat: 'dd.mm.yy',
        changeMonth: false,
        changeYear: false,
        onSelect: triggerEndCalendarMinDate
    });
    $('#start_date').parent().find('.calendar-trigger').click(function(){
        $('#start_date').trigger('focus');
    });
    // dest end date
    $('#end_date').datepicker({
        minDate: '+0',
        firstDay: 1,
        autoSize: true,
        dateFormat: 'dd.mm.yy',
        changeMonth: false,
        changeYear: false,
        onSelect: triggerStartCalendarMaxDate
    });
    $('#end_date').parent().find('.calendar-trigger').click(function(){
        $('#end_date').trigger('focus');
    });
    function triggerEndCalendarMinDate(selectedDate) {
        var date2 = $('#start_date').datepicker('getDate');
        date2.setDate(date2.getDate()+1);
        $('#end_date').datepicker('option', 'minDate', date2);
    }
    function triggerStartCalendarMaxDate(selectedDate) {
        var date2 = $('#end_date').datepicker('getDate');
        date2.setDate(date2.getDate()-1);
        $('#start_date').datepicker('option', 'maxDate', date2);
    }
});
</script>
