<form action="<?=route('charters-home')?>" method="post">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12">
			<!-- <div class="col-xs-12 col-sm-8 col-md-9"> -->
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label main-filters__label--padding" for="chartere-tara">
							<!-- <span class="main-filters__label__text">Tara</span> -->
							<select id="chartere-tara" name="chartere-tara" class="form-control main-filters__select" style="width: 100%;">
								<option></option>
								<? foreach($_charter_countries as $country){?>
									<option value="<?=$country['id_country']?>" <? if($country['id_country'] == $_form['chartere-tara']){?>selected<? }?>><?=$country['title']?></option>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['chartere-tara'] != ""){?>
					        		<?=$_errors['chartere-tara']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label main-filters__label--padding" for="chartere-destinatia">
							<!-- <span class="main-filters__label__text">Destinatia</span> -->
							<select id="chartere-destinatia" name="chartere-destinatia" class="form-control main-filters__select" style="width: 100%;" <? if(!$_form['chartere-destinatia']){?>disabled<? }?>>
								<? if($_cities_sidebar){?>
									<option></option>
									<? foreach($_cities_sidebar as $city){?>
										<option value="<?=$city['id']?>" <? if($city['id'] == $_form['chartere-destinatia']) echo "selected"?>><?=$city['text']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['chartere-destinatia'] != ""){?>
					        		<?=$_errors['chartere-destinatia']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-12 col-md-3">
						<label class="main-filters__label main-filters__label--padding" for="chartere-oras-plecare">
							<!-- <span class="main-filters__label__text">Oras plecare</span> -->
							<select id="chartere-oras-plecare" name="chartere-oras-plecare" class="form-control main-filters__select" style="width: 100%;" <? if(!$_form['chartere-oras-plecare']){?>disabled<? }?>>
								<? if($_cities_from_sidebar){?>
									<option></option>
									<? foreach($_cities_from_sidebar as $city){?>
										<option value="<?=$city['id_city']?>" <? if($_form['chartere-oras-plecare'] == $city['id_city']) echo "selected"?>><?=$city['title']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['chartere-oras-plecare'] != ""){?>
					        		<?=$_errors['chartere-oras-plecare']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-12 col-md-3" style="display:none;">
						<label class="main-filters__label " for="chartere-check-in">
							<span class="main-filters__label__text">Data plecare <i class="sprite sprite-calendar-white"></i></span>
							<input type="text" class="form-control" id="chartere-check-in" name="chartere-check-in" placeholder="- Alege data -" autocomplete="off" value="<?=$_form['chartere-check-in']?>">
							<span class="error">
								<? if($_errors['chartere-check-in'] != ""){?>
									<?=$_errors['chartere-check-in']?>
								<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-12 col-md-3">
						<!-- aici cauta -->
						<button id="chartere-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
						<!-- end aici cauta -->
					</div>
				</div>
			</div>
			<?/*
			<div class="col-xs-12 col-sm-4 col-md-3" style="display:none;">
				<!-- aici cauta -->
				<button class="btn btn--green main-filters__btn-cauta"><span>Cauta</span></button>
				<!-- end aici cauta -->
			</div>
			*/?>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<!-- aici campurile pentru Cautare Avansata, iar textul "Stii..." dispare -->
				<!-- @andrei: nu stiu ce i cu asta nu gasesc nici o informatie despre el -->
				<!-- <div class="advanced-click-txt">
					[Stii exact ce cauti? Incearca aici]
				</div> -->

				<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "charter"){?>hidden<? }?>">
					<div class="row">
						<div class="col-sm-6 col-md-4">
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

						<div class="col-sm-6 col-md-8">
							<div class="main-filters__label--padding">
								<div class="row half-gutters">
									<div class="col-md-2 advanced-selectors-xs-room">
										<label class="main-filters__label" for="chartere-camere">
											<span class="main-filters__label__text">Camere</span>
											<select id="chartere-camere" name="chartere-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
												<option value="1" <? if($_form['chartere-camere'] == 1){?>selected<? }?>>1</option>
												<option value="2" <? if($_form['chartere-camere'] == 2){?>selected<? }?>>2</option>
												<option value="3" <? if($_form['chartere-camere'] == 3){?>selected<? }?>>3</option>
											</select>
											<span class="error">
												<? if($_errors['chartere-camere'] != ""){?>
									        		<?=$_errors['chartere-camere']?>
									        	<? }?>
											</span>
										</label>
									</div>
									<? for($k=1; $k<=3; $k++){?>
										<div class="col-xs-12 col-md-10 advanced-selectors-xs <? if($k>1){?> col-md-offset-2 <? }?> item-filters__cam<?=$k?>" <? if($_form['chartere-camere'] >= $k){?>style="display:block"<? }?>>
											<div class="row half-gutters">
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="chartere-adulti<?=$k?>">
														<span class="main-filters__label__text">Adulti</span>
														<select id="chartere-adulti<?=$k?>" name="chartere-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
															<?php for($j=1;$j<=5;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['chartere-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['chartere-adulti'.$k] != ""){?>
												        		<?=$_errors['chartere-adulti'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="chartere-copii<?=$k?>">
														<span class="main-filters__label__text">Copii</span>
														<select id="chartere-copii<?=$k?>" name="chartere-copii<?=$k?>" class="form-control main-filters__select select__s2" style="width: 100%;">
															<option value="0">-</option>
															<?php for($j=1;$j<4;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['chartere-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['chartere-copii'.$k] != ""){?>
												        		<?=$_errors['chartere-copii'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<? for($i=1; $i<=3; $i++){?>
													<div class="col-xs-12 col-md-2 col-sm-4 col-lg-20">
														<label class="main-filters__label children_age" <? if($_form['chartere-copii'.$k] >= $i){?>style="display:block"<? }?>>
															<? if($i==1){?>
																<span class="main-filters__label__text" style="white-space: nowrap;">Varste copii</span>
															<? }else{?>
																<span class="main-filters__label__text" style="white-space: nowrap;">&nbsp;</span>
															<? }?>
															<select class="form-control main-filters__select chartere-varste-copii select__s2" id="chartere-copii-varste<?=$k?>-<?=$i?>" name="chartere-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
																<option value="">-</option>
																<?php for($j=0;$j<14;$j++) { ?>
																	<option value="<?php echo $j; ?>" <? if($_form['chartere-copii-varste'.$k.'-'.$i] != "" && $_form['chartere-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
																<?php } ?>
															</select>
															<span class="error">
																<? if($_errors['chartere-copii-varste'.$k.'-'.$i] != ""){?>
													        		<?=$_errors['chartere-copii-varste'.$k.'-'.$i]?>
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
				</div>
				<!-- end aici campurile pentru Cautare Avansata -->
			</div>
			<!-- replasare buton cautare avansata -->
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "charter"){?>hidden<? }?>">
					<a href="#" class="advanced-click">Cautare avansata</a>
				</div>
			</div>
			<!-- end replasare buton cautare avansata -->

			<!-- buton cauta vacanta ta -->
			<div class="col-xs-12 col-sm-4 col-md-3" style="display:none;">
				<div class="text-center">
					<a href="#" class="advanced-search">[Cauta vacanta ta »]</a>
				</div>
			</div>
			<!-- end buton cauta vacanta ta -->
		</div>
	</div>

	<? /*
	<div class="clearfix"></div>
	<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "charter"){?>hidden<? }?>">
		<a href="#" class="advanced-click">Cautare avansata</a>
	</div>
	*/?>
	<?/*
	<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "charter"){?>hidden<? }?>">
		<div class="col-sm-4 col-md-4">
			<div class="main-filters__label--padding">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-6">
						<label class="main-filters__label " for="chartere-check-in">
							<span class="main-filters__label__text">Check in <i class="sprite sprite-calendar-grey"></i></span>
							<input type="text" class="form-control" id="chartere-check-in" name="chartere-check-in" placeholder="- Alege data -" autocomplete="off" value="<?=$_form['chartere-check-in']?>">
							<span class="error">
								<? if($_errors['chartere-check-in'] != ""){?>
					        		<?=$_errors['chartere-check-in']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-6">
						<label class="main-filters__label" for="chartere-check-out">
							<span class="main-filters__label__text">Check out <i class="sprite sprite-calendar-grey"></i></span>
							<input type="text" class="form-control" id="chartere-check-out" name="chartere-check-out" placeholder="- Alege data -" autocomplete="off" <? if(!$_form['chartere-check-in']){?>disabled<? }?> value="<?=$_form['chartere-check-out']?>">
							<span class="error">
								<? if($_errors['chartere-check-out'] != ""){?>
					        		<?=$_errors['chartere-check-out']?>
					        	<? }?>
							</span>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-8 col-md-8">
			<div class="main-filters__label--padding">
				<div class="row">
					<div class="col-md-2 advanced-selectors-xs-room">
						<label class="main-filters__label" for="chartere-camere">
							<span class="main-filters__label__text">Camere</span>
							<select id="chartere-camere" name="chartere-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
								<option value="1" <? if($_form['chartere-camere'] == 1){?>selected<? }?>>1</option>
								<option value="2" <? if($_form['chartere-camere'] == 2){?>selected<? }?>>2</option>
								<option value="3" <? if($_form['chartere-camere'] == 3){?>selected<? }?>>3</option>
							</select>
							<span class="error">
								<? if($_errors['chartere-camere'] != ""){?>
					        		<?=$_errors['chartere-camere']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<? for($k=1; $k<=3; $k++){?>
						<div class="col-xs-12 col-md-10 advanced-selectors-xs <? if($k>1){?> col-md-offset-2 <? }?> item-filters__cam<?=$k?>" <? if($_form['chartere-camere'] >= $k){?>style="display:block"<? }?>>
							<div class="row">
								<div class="col-xs-12 col-md-2 col-sm-6">
									<label class="main-filters__label" for="chartere-adulti<?=$k?>">
										<span class="main-filters__label__text">Adulti</span>
										<select id="chartere-adulti<?=$k?>" name="chartere-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
											<?php for($j=1;$j<=5;$j++) { ?>
												<option value="<?php echo $j; ?>" <? if($_form['chartere-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
											<?php } ?>
										</select>
										<span class="error">
											<? if($_errors['chartere-adulti'.$k] != ""){?>
								        		<?=$_errors['chartere-adulti'.$k]?>
								        	<? }?>
										</span>
									</label>
								</div>
								<div class="col-xs-12 col-md-2 col-sm-6">
									<label class="main-filters__label" for="chartere-copii<?=$k?>">
										<span class="main-filters__label__text">Copii</span>
										<select id="chartere-copii<?=$k?>" name="chartere-copii<?=$k?>" class="form-control main-filters__select select__s2" style="width: 100%;">
											<option value="0">-</option>
											<?php for($j=1;$j<4;$j++) { ?>
												<option value="<?php echo $j; ?>" <? if($_form['chartere-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
											<?php } ?>
										</select>
										<span class="error">
											<? if($_errors['chartere-copii'.$k] != ""){?>
								        		<?=$_errors['chartere-copii'.$k]?>
								        	<? }?>
										</span>
									</label>
								</div>
								<? for($i=1; $i<=3; $i++){?>
									<div class="col-xs-12 col-md-2 col-sm-4">
										<label class="main-filters__label children_age" <? if($_form['chartere-copii'.$k] >= $i){?>style="display:block"<? }?>>
											<? if($i==1){?>
												<span class="main-filters__label__text" style="white-space: nowrap;">Varste copii</span>
											<? }else{?>
												<span class="main-filters__label__text" style="white-space: nowrap;">&nbsp;</span>
											<? }?>
											<select class="form-control main-filters__select chartere-varste-copii select__s2" id="chartere-copii-varste<?=$k?>-<?=$i?>" name="chartere-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
												<option value="">-</option>
												<?php for($j=0;$j<14;$j++) { ?>
													<option value="<?php echo $j; ?>" <? if($_form['chartere-copii-varste'.$k.'-'.$i] != "" && $_form['chartere-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
												<?php } ?>
											</select>
											<span class="error">
												<? if($_errors['chartere-copii-varste'.$k.'-'.$i] != ""){?>
									        		<?=$_errors['chartere-copii-varste'.$k.'-'.$i]?>
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
	*/?>

	<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
	<input type="hidden" name="type" value="charter">
	<button id="chartere-submit" class="hidden" type="submit">Cauta</button>

	<script>
		var hasCheckIn;
	</script>

	<? if($_POST['advanced']==1){?>
	<script>
		$(document).ready(function(){

			var interval = setInterval(function(){

				if($("#chartere-check-in").val() != ""){
					hasCheckIn = true;
				}

				if($('#chartere-oras-plecare').data('select2')){
					clearInterval(interval);

					$('#chartere-oras-plecare').trigger('change');
				}
			}, 500);

		});
	</script>
	<? }?>

</form>
