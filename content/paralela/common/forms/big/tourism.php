<form action="<?=route('tourism-home')?>" method="post">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="row">
					<div class="col-sm-4 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-individual-tara">
							<!-- <span class="main-filters__label__text">Tara</span> -->
							<select id="t-individual-tara" name="t-individual-tara" class="form-control main-filters__select" style="width: 100%;">
								<option></option>
								<? foreach($_tourism_countries as $country){?>
									<option value="<?=$country['id_country']?>" <? if($country['id_country'] == $_form['t-individual-tara']){?>selected<? }?>><?=$country['title']?></option>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['t-individual-tara'] != ""){?>
					        		<?=$_errors['t-individual-tara']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-4 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-individual-destinatia">
							<!-- <span class="main-filters__label__text">Destinatia</span> -->
							<select id="t-individual-destinatia" name="t-individual-destinatia" class="form-control main-filters__select" style="width: 100%;" <? if(!$_form['t-individual-destinatia']){?>disabled<? }?>>
								<? if($_destinations_sidebar){?>
									<option></option>
									<? foreach($_destinations_sidebar as $city){?>
										<option value="<?=$city['id']?>" <? if($city['id'] == $_form['t-individual-destinatia']) echo "selected"?>><?=$city['text']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['t-individual-destinatia'] != ""){?>
					        		<?=$_errors['t-individual-destinatia']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-4 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-individual-oras">
							<!-- <span class="main-filters__label__text">Statiunea</span> -->
							<select id="t-individual-oras" name="t-individual-oras" class="form-control main-filters__select" style="width: 100%;"  <? if(!$_form['t-individual-oras']){?>disabled<? }?>>
								<? if($_cities_sidebar){?>
									<option></option>
									<? foreach($_cities_sidebar as $city){?>
										<option value="<?=$city['id']?>" <? if($city['id'] == $_form['t-individual-oras']) echo "selected"?>><?=$city['text']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['t-individual-oras'] != ""){?>
					        		<?=$_errors['t-individual-oras']?>
					        	<? }?>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3 hidden-xs">
				<!-- aici cauta -->
				<button id="t-individual-submit" name="t-individual-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
				<!-- end aici cauta -->
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<!-- aici campurile pentru Cautare Avansata, iar textul "Stii..." dispare -->
				<div class="advanced-click-txt">
					[Stii exact ce cauti? Incearca aici]
				</div>
				<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "tourism"){?>hidden<? }?>">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="row half-gutters">
								<div class="col-sm-6 col-md-7">
									<label class="main-filters__label " for="t-individual-check-in">
										<span class="main-filters__label__text">Data plecare <i class="sprite sprite-calendar-white"></i></span>
										<input type="text" class="form-control" id="t-individual-check-in" name="t-individual-check-in" placeholder="- Alege data -" autocomplete="off" value="<?=$_form['t-individual-check-in']?>">
										<span class="error">
											<? if($_errors['t-individual-check-in'] != ""){?>
								        		<?=$_errors['t-individual-check-in']?>
								        	<? }?>
										</span>
									</label>
								</div>
								<div class="col-sm-6 col-md-5">
									<div class="main-filters__label--padding">
										<!-- durata sejur -->
										<label class="main-filters__label" for="chartere-check-out">
											<span class="main-filters__label__text">[Durata sejur]</span>
											<select id="" name="" class="form-control main-filters__select" style="width: 100%;">
													<option>8 zile</option>
											</select>
										</label>
										<!-- end durata sejur -->
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12 col-md-8">
							<div class="main-filters__label--padding">
								<div class="row half-gutters">
									<div class="col-md-2 advanced-selectors-xs-room">
										<label class="main-filters__label" for="t-individual-camere">
											<span class="main-filters__label__text">Camere</span>
											<select id="t-individual-camere" name="t-individual-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
												<option value="1" <? if($_form['t-individual-camere'] == 1){?>selected<? }?>>1</option>
												<option value="2" <? if($_form['t-individual-camere'] == 2){?>selected<? }?>>2</option>
												<option value="3" <? if($_form['t-individual-camere'] == 3){?>selected<? }?>>3</option>
											</select>
											<span class="error">
												<? if($_errors['t-individual-camere'] != ""){?>
									        		<?=$_errors['t-individual-camere']?>
									        	<? }?>
											</span>
										</label>
									</div>
									<? for($k=1; $k<=3; $k++){?>
										<div class="col-xs-12 col-md-10 advanced-selectors-xs <? if($k>1){?> col-md-offset-2 <? }?> item-filters__cam<?=$k?>" <? if($_form['t-individual-camere'] >= $k){?>style="display:block"<? }?>>
											<div class="row half-gutters">
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="t-individual-adulti<?=$k?>">
														<span class="main-filters__label__text">Adulti</span>
														<select id="t-individual-adulti<?=$k?>" name="t-individual-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
															<?php for($j=1;$j<=5;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['t-individual-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['t-individual-adulti'.$k] != ""){?>
												        		<?=$_errors['t-individual-adulti'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="t-individual-copii<?=$k?>">
														<span class="main-filters__label__text">Copii</span>
														<select id="t-individual-copii<?=$k?>" name="t-individual-copii<?=$k?>" class="form-control main-filters__select select__s2" style="width: 100%;">
															<option value="0">-</option>
															<?php for($j=1;$j<4;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['t-individual-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['t-individual-copii'.$k] != ""){?>
												        		<?=$_errors['t-individual-copii'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<? for($i=1; $i<=3; $i++){?>
													<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
														<label class="main-filters__label children_age" <? if($_form['t-individual-copii'.$k] >= $i){?>style="display:block"<? }?>>
															<? if($i==1){?>
																<span class="main-filters__label__text" style="white-space: nowrap;">Varste copii</span>
															<? }else{?>
																<span class="main-filters__label__text" style="white-space: nowrap;">&nbsp;</span>
															<? }?>
															<select class="form-control main-filters__select t-individual-varste-copii select__s2" id="t-individual-copii-varste<?=$k?>-<?=$i?>" name="t-individual-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
																<option value="">-</option>
																<?php for($j=0;$j<14;$j++) { ?>
																	<option value="<?php echo $j; ?>" <? if($_form['t-individual-copii-varste'.$k.'-'.$i] != "" && $_form['t-individual-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
																<?php } ?>
															</select>
															<span class="error">
																<? if($_errors['t-individual-copii-varste'.$k.'-'.$i] != ""){?>
													        		<?=$_errors['t-individual-copii-varste'.$k.'-'.$i]?>
													        	<? }?>
															</span>
														</label>
													</div>
												<? }?>
											</div>
										</div>
									<? }?>
								</div>
							</div>
						</div>
					</div>
					<!-- end aici campurile pentru Cautare Avansata -->
				</div>
			</div>
			<!-- replasare buton cautare avansata -->
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "tourism"){?>hidden<? }?>">
					<a href="#" class="advanced-click">Cautare avansata</a>
				</div>
			</div>
			<!-- end replasare buton cautare avansata -->
		</div>
		<div class="row hidden-sm hidden-md hidden-lg" style="margin-top:10px;">
			<div class="col-xs-12">
				<!-- aici cauta -->
				<button id="t-individual-submit" name="t-individual-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
				<!-- end aici cauta -->
			</div>
		</div>
	</div>

	<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
	<input type="hidden" name="type" value="tourism">
	<button id="t-individual-submit" name="t-individual-submit" class="hidden" type="submit">Cauta</button>
</form>
