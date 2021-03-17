<main class="margin--bottom-100 margin--top-50">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 hr-title wisub">
				<hr class="hr-title__hr">
				<h3 class="hr-title__text text--blue"><?= e('Asigurari de calatorie') ?></h3>
				<div class="hr-subtitlesmall__text">
					Paralela 45 – agentia ta de incredere recomanda turistilor sai incheierea unei asigurari de calatorie, pentru un sejur deplin relaxant, in deplina siguranta. Online, rapid și simplu.<br>
					Pleaca la drum asigurat!
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<br><img src="<?= $_base ?>static/img/city-insurance.jpg">
			</div>
		</div>

		<? if(!$_offers){?>
			<form method="post" action="" id="insurance-form">
				<!-- Informatii despre calatorie -->
				<div class="row">
					<div class="col-xs-12 margin--top-30">
						<h4 class="text--blue"><?= e('Informatii despre calatorie') ?></h4>
					</div>

					<div class="col-sm-6 col-md-3">
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

					<div class="col-sm-6 col-md-3">
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

					<div class="col-sm-12 col-md-6">
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="">Scopul calatoriei</label>
									<select class="form-control" name="scope" id="scope">
			                            <option value="">Alege scopul calatoriei</option>
			                            <?php foreach($_scopes as $key => $item) { ?>
			                                <option <?=$key == $_form['scope'] && $_form['scope'] != "" ? 'selected' : ''?> value="<?php echo $key ?>"><?php echo $item ?></option>
			                            <?php } ?>
			                        </select>
									<? if($_errors['scope']){?>
										<span class="error"><?=$_errors['scope']?></span>
									<? }?>
								</div>
							</div>

							<div class="col-sm-6 col-md-6">
								<div class="form-group"> <!-- has-error -->
									<label class="control-label bilete-rezervare__label" for="">Destinatie</label>
									<select class="form-control " name="destination" id="destination">
			                            <option value="">Alege destinatie</option>
										<optgroup label="Destinatii Paralela 45">
				                            <?php foreach($_destinations_paralela as $k => $item) { ?>
				                                <option <?=$item['id'] == $_form['destination'] ? 'selected' : ''?> value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
				                            <?php } ?>
										</optgroup>
										<optgroup label="Alte destinatii">
											<?php foreach($_destinations_all as $k => $item) { ?>
				                                <option <?=$item['id'] == $_form['destination'] ? 'selected' : ''?> value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
				                            <?php } ?>
										</optgroup>
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
										<div class="form-group has-feedback cnp <? if($_POST['insurants'][$i]['foreign'] == 1){?>hidden<? }?>"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">CNP</label>
											<input type="text" name="insurants[<?=$i?>][cnp]" value="<?=$_POST['insurants'][$i]['cnp']?>" class="form-control">
											<? if($_errors['insurants'.$i.'cnp']){?>
												<span class="error"><?=$_errors['insurants'.$i.'cnp']?></span>
											<? }?>
										</div>
										<div class="form-group has-feedback dob <? if($_POST['insurants'][$i]['foreign'] != 1 || !isset($_POST)){?>hidden<? }?>">
											<div class="calendar-input" style="position:relative;">
												<label class="control-label bilete-rezervare__label" for="">Data nasterii</label>
												<input type="text" name="insurants[<?=$i?>][dob]" value="<?=$_POST['insurants'][$i]['dob']?>" class="form-control" autocomplete="off">
												<img src="<?= $_base ?>static/img/calendar-input.jpg" class="calendar-trigger" />
											</div>
											<? if($_errors['insurants'.$i.'dob']){?>
												<span class="error"><?=$_errors['insurants'.$i.'dob']?></span>
											<? }?>
										</div>
									</div>
									<div class="col-sm-3">
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
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group" style="min-height: 54px;"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">&nbsp;</label>
											<div class="checkbox bilete-rezervare__checkbox" style="margin:0 15px 10px 0;">
												<input id="foreign_<?=$i?>" type="checkbox" class="foreign_check" value="1" name="insurants[<?=$i?>][foreign]" <? if($_POST['insurants'][$i]['foreign'] == 1) echo "checked"?> >
												<label for="foreign_<?=$i?>">
													Cetatean strain
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-3 foreign-country <? if($_POST['insurants'][$i]['foreign'] != 1){?>hidden<? }?>">
										<div class="form-group"> <!-- has-error -->
											<label class="control-label bilete-rezervare__label" for="">Tara origine</label>
											<select class="form-control country-foreign" name="insurants[<?=$i?>][country]">
					                            <option value="">Alege tara origine</option>
					                            <?php foreach($destinations_ue as $k => $item) { ?>
					                                <option <?=$item['id_city_insurance_country'] == $_POST['insurants'][$i]['country'] ? 'selected' : ''?> value="<?php echo $item['id_city_insurance_country'] ?>"><?php echo ucwords(strtolower($item['title'])) ?></option>
					                            <?php } ?>
					                        </select>
											<? if($_errors['insurants'.$i.'country']){?>
												<span class="error"><?=$_errors['insurants'.$i.'country']?></span>
											<? }?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;">
											<input id="zapada_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][zapada]" <? if($_POST['insurants'][$i]['zapada'] == 1) echo "checked"?> >
											<label for="zapada_<?=$i?>" data-toggle="tooltip" title="Snowkayaking, Ski, Snowboarding, Snowkiting, sanie, bob, Skiboarding, sărituri cu skiurile, patinaj, snowmobile">
												Sporturi de iarna
											</label>
										</div>
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;">
											<input id="nautic_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][nautic]" <? if($_POST['insurants'][$i]['nautic'] == 1) echo "checked"?> >
											<label for="nautic_<?=$i?>" data-toggle="tooltip" title="Canioning, Surfing, Kayaking, Kitesurfing, Rafting, Scuba-diving (toate tipurile de  scufundări  inclusiv înot alături de rechini, delfini, diferite specii de pești și recifii de corali),  Windsurfing , sporturi extreme nautice (Wakeboard, Yachting, Cave diving, Powerboat, caiac, canoe, navigatie cu vase prevazute cu vele)">
												Sporturi nautice
											</label>
										</div>
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;" <? if($_POST['insurants'][$i]['aero'] == 1) echo "checked"?> >
											<input id="aero_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][aero]">
											<label for="aero_<?=$i?>" data-toggle="tooltip" title="Kiting, Bungee-jumping, Deltaplan, Parapantă, Parașutism, zbor cu aeronave cu motor de mici dimensiuni, planor sau cu aparate mai ușoare decât aerul (balon, aerostat)">
												Sporturi aeronautice
											</label>
										</div>
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;" <? if($_POST['insurants'][$i]['terestru'] == 1) echo "checked"?> >
											<input id="terestru_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][terestru]">
											<label for="terestru_<?=$i?>" data-toggle="tooltip" title="Adventure race, Alpinism, Role, Skateboarding, Escalada, rapel, coborare cu blocatoare, Sporturi extreme terestre (călărie, speologie, vânătoare sportivă, paintball, trageri cu arme (arme de foc, arme cu aer comprimat, arcuri, arbalete, etc.), pescuit cu harpon cu resort sau aer comprimat), tiroliană (traversarea unei văi cu ajutorul unor sisteme de funii și scripeți), abseiling (coborâre în rapel pe coarda de alpinism)">
												Sporturi extreme
											</label>
										</div>
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;">
											<input id="roti_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][roti]" <? if($_POST['insurants'][$i]['roti'] == 1) echo "checked"?> >
											<label for="roti_<?=$i?>" data-toggle="tooltip" title="Ciclism, Raliuri, Motociclism MTB/BMX, conducerea de ATV, motociclete de teren, mountain biking, inclusiv downhill (coborâre cu mountain bike), off-road cu masini de teren">
												Sporturi cu motor
											</label>
										</div>
										<div class="checkbox bilete-rezervare__checkbox pull-left" style="margin:0 15px 10px 0;">
											<input id="triatlon_<?=$i?>" type="checkbox" value="1" name="insurants[<?=$i?>][triatlon]" <? if($_POST['insurants'][$i]['triatlon'] == 1) echo "checked"?> >
											<label for="triatlon_<?=$i?>" data-toggle="tooltip" title="Triatlon">
												Triatlon
											</label>
										</div>
									</div>
									<? if($error_quotes[$i]){?>
										<div class="col-sm-12">
											<span class="error"><?=$error_quotes[$i]?></span>
										</div>
									<? }?>
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
						<? /*
						<br><br>
						<div class="checkbox bilete-rezervare__checkbox">
							<input id="gdpr" type="checkbox" value="1" name="gdpr">
							<label for="gdpr">
								Sunt de acord ca datele mele personale sa fie prelucrate de catre City Insurance in scopul emiterii politelor de asigurare
							</label>
							<? if($_errors['gdpr']){?>
								<span class="error"><?=$_errors['gdpr']?></span>
							<? }?>
						</div>
						*/ ?>
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
							<h4 class="text--blue pull-left"><?= e('Asigurare de calatorie') ?></h4>
							<p class="pull-right"><a href="javascript:history.go(-1)"><< Inapoi</a></p>
						</div>
					</div>

					<? foreach($_offers as $i => $items){?>
						<div class="row">
							<div class="col-xs-12 margin--top-30 margin--bottom-10">
								<h4 class="text--blue">Nume Prenume asigurat:</h4>
								<h4 class="text--blue name-applicant" ><?= $data['insurants'][$i]['firstname'] ?> <?= $data['insurants'][$i]['lastname'] ?></h4>
							</div>
						</div>
						<div class="row row-container-checked">
							<? foreach($items as $j => $item){?>
								<div class="col-sm-6 margin--bottom-25" style="<?=$j%2 == 0 ? "clear:both" : ""?>">
									<div class="container-asigurare <?= (isset($_POST['book']) && $_form['offer_'.$i] == $j) || (!isset($_POST['book']) && $j == $selected_offer[$i]) ? 'container-checked' : 'container-unchecked' ?>">
										<div class="checkbox bilete-rezervare__checkbox">
											<!-- <input id="checkbox<?=$i?>_<?=$item['product']['id_city_insurance_product']?>" class="idd-trigger " type="radio" value="<?=$j?>" name="offer_<?=$i?>" <?=$_form['offer_'.$i] == $j ? "checked" : ""?>> -->
											<label for="checkbox<?=$i?>_<?=$item['product']['id_city_insurance_product']?>" style="min-height: 40px;">
												<?=$item['product']['title']?>
											</label>
							            </div>
							            <div class="description">
							            	<?=$item['product']['short_desc']?>
							            	<div class="row">
							            		<div class="col-xs-12 col-sm-5">
									            	<a href="#" class="show-popup" data-id="<?=$item['product']['id_city_insurance_product']?>">Vezi detalii »</a><br/>
									            </div>
									            <div class="col-xs-12 col-sm-7">
									            	<div class="row">
									            		 <div class="col-xs-12 col-sm-5">
										            	 	<span class=" price"><b><?=$item['quote']['prima']?></b> Lei</span>
										            	</div>
										            	<div class="col-xs-12 col-sm-7">
										            	 	<input id="checkbox<?=$i?>_<?=$item['product']['id_city_insurance_product']?>" class="idd-trigger hidden" type="radio" value="<?=$j?>" name="offer_<?=$i?>" <?= (isset($_POST['book']) && $_form['offer_'.$i] == $j) || (!isset($_POST['book']) && $j == $selected_offer[$i]) ? 'checked' : '' ?>>
															<label for="checkbox<?=$i?>_<?=$item['product']['id_city_insurance_product']?>">
																Alege asigurarea
															</label>
										            	</div>
										            </div>
									            </div>
									        </div>
							            	<!--<a href="#">Vezi termeni si conditii »</a>-->
							            </div>
									</div>
								</div>
							<? }?>
							<? if($_errors['offer_'.$i]){?>
								<div class="col-sm-12 margin--bottom-25 clear">
									<span class="error"><?=$_errors['offer_'.$i]?></span>
								</div>
							<? }?>

						</div>
					<? }?>

					<? /*
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
					*/ ?>
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
									<li>am 18 ani împliniți și sunt eligibil pentru achiziționarea asigurării</li>
									<li>datele si informatiile furnizate sunt reale la momentul completarii cererii</li>
								</ul>
							</label>
						</div>
						<div class="description-declare"></div>
						<? if($_errors['terms']){?>
							<span class="error"><?=$_errors['terms']?></span><br><br>
						<? }?>

						<div class="checkbox bilete-rezervare__checkbox">
							Pentru a fi corect și complet informat cu privire la prelucrarea datelor tale de către City Insurance precum și cu privire la informare asupra produsului (clauzele și termenii de încheiere a contractului de asigurare) te rugăm să descarci <a href="https://cityinsurance.ro/securitatea-si-confidentialitatea-datelor/conditii-de-asigurare/" target="_blank">aici</a> și să citești cu atenție următoarele documente:
							<ul>
								<li><a href="https://cityinsurance.ro/wp-content/uploads/2019/04/Nota_de_informare_din_23.04.2019_citysmart.pdf" target="_blank">Nota de Informare privind prelucrarea datelor cu caracter personal</a></li>
								<li><a href="https://cityinsurance.ro/wp-content/uploads/2018/07/18.01_PID_Asistenta_complexa_medicala.pdf" target="_blank">Documentul de informare (PID)</a></li>
								<li><a href="https://cityinsurance.ro/wp-content/uploads/2019/04/Conditii_de_asigurare.pdf" target="_blank">Condițiile de asigurare</a></li>
								<li><a href="https://cityinsurance.ro/wp-content/uploads/2018/07/Informare_precontractuala_Travel.pdf" target="_blank">Informarea cu privire la procedurile de soluționarea a litigiilor și deducerile prevăzute de legislația fiscală în vigoare</a></li>
							</ul>
						</div>

						<div class="checkbox bilete-rezervare__checkbox">
							<input id="terms2" type="checkbox" value="1" name="terms2">
							<label for="terms2">
								Am primit, am citit si sunt de acord cu termenii de încheiere a asigurării și informațiile furizate în următoarele documente, parte integrantă din Contractul de asigurare:
								<a href="https://cityinsurance.ro/wp-content/uploads/2018/07/18.01_PID_Asistenta_complexa_medicala.pdf" target="_blank">Documentul de informare privind produsul de asigurare de asistență medicală (PID)</a>,
								<a href="https://cityinsurance.ro/wp-content/uploads/2019/04/Conditii_de_asigurare.pdf" target="_blank">Condițiile de asigurare</a> și
								<a href="https://cityinsurance.ro/wp-content/uploads/2018/07/Informare_precontractuala_Travel.pdf" target="_blank">Informarea cu privire la procedurile de soluționarea a litigiilor și deducerile prevăzute de legislația fiscală în vigoare</a>
							</label>
						</div>
						<? if($_errors['terms2']){?>
							<span class="error"><?=$_errors['terms2']?></span><br><br>
						<? }?>

						<div class="checkbox bilete-rezervare__checkbox">
							<input id="terms3" type="checkbox" value="1" name="terms3">
							<label for="terms3">
								Am primit, am citit si sunt de acord cu prelucrarea datelor mele cu caracter personal in scopurile prezentate in <a href="https://cityinsurance.ro/wp-content/uploads/2019/04/Nota_de_informare_din_23.04.2019_citysmart.pdf" target="_blank">Nota de informare privind prelucrarea datelor cu caracter personal</a>
							</label>
						</div>
						<? if($_errors['terms3']){?>
							<span class="error"><?=$_errors['terms3']?></span><br><br>
						<? }?>

						<div class="checkbox bilete-rezervare__checkbox">
							<input id="terms4" type="checkbox" value="1" name="terms4">
							<label for="terms4">
								 Am acordul Asiguratilor pentru care solicit asigurarea de a trimite către City Insurance datele lor cu caracter personal pentru prelucrarea lor in scopurile prezentate in <a href="https://cityinsurance.ro/wp-content/uploads/2019/04/Nota_de_informare_din_23.04.2019_citysmart.pdf" target="_blank">Nota de informare privind prelucrarea datelor cu caracter personal</a>
							</label>
						</div>
						<? if($_errors['terms4']){?>
							<span class="error"><?=$_errors['terms4']?></span><br><br>
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
	<? foreach($_offers as $items){?>
		<? foreach($items as $j => $item){?>
			<? if(!in_array($item['product']['id_city_insurance_product'], $unique_prods)){?>
				<div class="black-cover hidden" id="popup-info-<?=$item['product']['id_city_insurance_product']?>">
					<div class="popup-white">
						<a href="#" class="close-popup"><i class="zmdi zmdi-close"></i></a>
						<h4><?=$item['product']['title']?></h4>
						<div class="table-wrapper">
							<?=$item['product']['description']?>
						</div>
					</div>
				</div>
				<? $unique_prods[] = $item['product']['id_city_insurance_product']?>
			<? }?>
		<? }?>
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

	$('#scope, #destination, .country-foreign').select2({
		language: "ro",
		minimumResultsForSearch: Infinity,
		placeholder: $(this).attr('data-placeholder'),
		width: '100%'
    });

	$('body').on('change', '.foreign_check', function(){
		if($(this).prop('checked')){
			$(this).parent().parent().parent().parent().find('.foreign-country').removeClass('hidden');

			$(this).parent().parent().parent().parent().parent().find('.dob').removeClass('hidden');
			$(this).parent().parent().parent().parent().parent().find('.cnp').addClass('hidden');
		}else{
			$(this).parent().parent().parent().parent().find('.foreign-country').addClass('hidden');

			$(this).parent().parent().parent().parent().parent().find('.dob').addClass('hidden');
			$(this).parent().parent().parent().parent().parent().find('.cnp').removeClass('hidden');
		}
	});

    // INSURANTS
    var $insurants = $('#insurants');
    $('#add-travelor').on('click', function(event) {
        event.preventDefault();
		$total = $insurants.find('.row-insurant').length;
        // clone first row
        var $clone = $insurants.find('.row-insurant:first').clone();
        // strip data
        $clone.find('input, select').val('');
		$clone.find('input[type="checkbox"]').val(1).attr('checked', false);
		$clone.find('.checkbox').each(function(){
			id = $(this).find('input').attr('id');
			tmp = id.split('_');
			rand = Math.floor(Math.random() * Math.floor(10000));
			$(this).find('input').attr('id', tmp[0]+'_'+rand);
			$(this).find('label').attr('for', tmp[0]+'_'+rand);
		});
        $clone.find('.cnp').removeClass('hidden');
		$clone.find('.dob').addClass('hidden');
		$clone.find('.info_insurant a.remove-insurant').removeClass('hidden');
		$clone.find('.foreign-country').addClass('hidden');
		$clone.find('.select2').remove();
		$clone.find('.select__s2, .country-foreign').select2({
		    language: "ro",
		    minimumResultsForSearch: Infinity,
		    placeholder: $(this).attr('data-placeholder'),
			width: '100%'
	    });
		$clone.find('.hasDatepicker').removeClass("hasDatepicker").attr('id', '');
		$clone.find('.dob input').datepicker({
	        firstDay: 1,
	        dateFormat: 'dd.mm.yy',
	        changeMonth: true,
	        changeYear: true,
			yearRange: "-100:+0",
			maxDate: 0
	    });
		$clone.find('.dob input').parent().find('.calendar-trigger').click(function(){
	        $(this).parent().find('input').trigger('focus');
	    });

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
	$('.dob input').datepicker({
        firstDay: 1,
        dateFormat: 'dd.mm.yy',
        changeMonth: true,
        changeYear: true,
		yearRange: "-100:+0",
		maxDate: 0
    });
	$('.dob').parent().find('.calendar-trigger').click(function(){
        $(this).parent().find('input').trigger('focus');
    });

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

    $('#insurance-results .container-asigurare').click(function(e){
		if( ! $(event.target).is('a.show-popup') ){
	    	//$('#insurance-results .container-asigurare').removeClass('container-checked').addClass('container-unchecked');
			$(this).parent().parent().find('.container-asigurare').removeClass('container-checked').addClass('container-unchecked');
	    	$(this).addClass('container-checked').removeClass('container-unchecked');
			$(this).find('input.idd-trigger').prop('checked', true);
		}
    });
});
</script>
