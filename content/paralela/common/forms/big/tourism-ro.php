<form action="<?=route('tourism-ro-home')?>" method="post">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-intern-tara">
							<!-- <span class="main-filters__label__text">Tara</span> -->
							<select id="t-intern-tara" name="t-intern-tara" class="form-control main-filters__select" style="width: 100%;">
								<option selected>Romania</option>
							</select>
						</label>
					</div>
					<div class="col-sm-6 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-intern-programul">
							<!-- <span class="main-filters__label__text">Programul</span> -->
							<select id="t-intern-programul" name="t-intern-programul" class="form-control main-filters__select" style="width: 100%;">
								<option></option>
								<? foreach($_tourism_intern_options as $item){?>
									<option value="<?=$item['id']?>" <? if($item['id'] == $_form['t-intern-programul']){?>selected<? }?> data-type="<?=$item['type']?>"><?=$item['title']?></option>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['t-intern-programul'] != ""){?>
					        		<?=$_errors['t-intern-programul']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-6 col-md-4">
						<label class="main-filters__label main-filters__label--padding" for="t-intern-statiunea">
							<!-- <span class="main-filters__label__text">Statiunea</span> -->
							<select id="t-intern-statiunea" name="t-intern-statiunea" class="form-control main-filters__select" style="width: 100%;" <? if(!$_form['t-intern-statiunea']){?>disabled<? }?>>
								<? if($_cities_sidebar){?>
									<option></option>
									<? foreach($_cities_sidebar as $city){?>
										<option value="<?=$city['id']?>" <? if($city['id'] == $_form['t-intern-statiunea']) echo "selected"?>><?=$city['text']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['t-intern-statiunea'] != ""){?>
					        		<?=$_errors['t-intern-statiunea']?>
					        	<? }?>
							</span>
						</label>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-3">
				<!-- aici cauta -->
				<button id="t-intern-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
				<!-- end aici cauta -->
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<!-- aici campurile pentru Cautare Avansata, iar textul "Stii..." dispare -->
				<div class="advanced-click-txt">
					[Stii exact ce cauti? Incearca aici]
				</div>
				<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "tourism-ro"){?>hidden<? }?>">
					<div class="row  half-gutters">
						<div class="col-sm-4 col-md-4">
							<div class="main-filters__label--padding">
								<div class="row half-gutters">
									<div class="col-md-6 col-sm-12 col-xs-6">
										<label class="main-filters__label " for="t-intern-check-in">
											<span class="main-filters__label__text">Check in <i class="sprite sprite-calendar-white"></i></span>
											<input type="text" class="form-control" id="t-intern-check-in" name="t-intern-check-in" placeholder="- Alege data -" autocomplete="off" value="<?=$_form['t-intern-check-in']?>">
											<span class="error">
												<? if($_errors['t-intern-check-in'] != ""){?>
									        		<?=$_errors['t-intern-check-in']?>
									        	<? }?>
											</span>
										</label>
									</div>
									<div class="col-md-6 col-sm-12 col-xs-6">
										<label class="main-filters__label" for="t-intern-check-out">
											<span class="main-filters__label__text">Check out <i class="sprite sprite-calendar-white"></i></span>
											<input type="text" class="form-control" id="t-intern-check-out" name="t-intern-check-out" placeholder="- Alege data -" autocomplete="off" value="<?=$_form['t-intern-check-out']?>">
											<span class="error">
												<? if($_errors['t-intern-check-out'] != ""){?>
									        		<?=$_errors['t-intern-check-out']?>
									        	<? }?>
											</span>
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-8 col-md-8">
							<div class="main-filters__label--padding">
								<div class="row half-gutters">
									<div class="col-md-2 advanced-selectors-xs-room">
										<label class="main-filters__label" for="t-intern-camere">
											<span class="main-filters__label__text">Camere</span>
											<select id="t-intern-camere" name="t-intern-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
												<option value="1" <? if($_form['t-intern-camere'] == 1){?>selected<? }?>>1</option>
												<option value="2" <? if($_form['t-intern-camere'] == 2){?>selected<? }?>>2</option>
												<option value="3" <? if($_form['t-intern-camere'] == 3){?>selected<? }?>>3</option>
											</select>
											<span class="error">
												<? if($_errors['t-intern-camere'] != ""){?>
									        		<?=$_errors['t-intern-camere']?>
									        	<? }?>
											</span>
										</label>
									</div>
									<? for($k=1; $k<=3; $k++){?>
										<div class="col-xs-12 col-md-10 advanced-selectors-xs <? if($k>1){?> col-md-offset-2 <? }?> item-filters__cam<?=$k?>" <? if($_form['t-intern-camere'] >= $k){?>style="display:block"<? }?>>
											<div class="row half-gutters">
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="t-intern-adulti<?=$k?>">
														<span class="main-filters__label__text">Adulti</span>
														<select id="t-intern-adulti<?=$k?>" name="t-intern-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
															<?php for($j=1;$j<=5;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['t-intern-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['t-intern-adulti'.$k] != ""){?>
												        		<?=$_errors['t-intern-adulti'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
													<label class="main-filters__label" for="t-intern-copii<?=$k?>">
														<span class="main-filters__label__text">Copii</span>
														<select id="t-intern-copii<?=$k?>" name="t-intern-copii<?=$k?>" class="form-control main-filters__select select__s2" style="width: 100%;">
															<option value="0">-</option>
															<?php for($j=1;$j<4;$j++) { ?>
																<option value="<?php echo $j; ?>" <? if($_form['t-intern-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
															<?php } ?>
														</select>
														<span class="error">
															<? if($_errors['t-intern-copii'.$k] != ""){?>
												        		<?=$_errors['t-intern-copii'.$k]?>
												        	<? }?>
														</span>
													</label>
												</div>
												<? for($i=1; $i<=3; $i++){?>
													<div class="col-xs-12 col-md-2 col-sm-4 col-lg-20">
														<label class="main-filters__label children_age" <? if($_form['t-intern-copii'.$k] >= $i){?>style="display:block"<? }?>>
															<? if($i==1){?>
																<span class="main-filters__label__text" style="white-space: nowrap;">Varste copii</span>
															<? }else{?>
																<span class="main-filters__label__text" style="white-space: nowrap;">&nbsp;</span>
															<? }?>
															<select class="form-control main-filters__select t-intern-varste-copii select__s2" id="t-intern-copii-varste<?=$k?>-<?=$i?>" name="t-intern-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
																<option value="">-</option>
																<?php for($j=0;$j<14;$j++) { ?>
																	<option value="<?php echo $j; ?>" <? if($_form['t-intern-copii-varste'.$k.'-'.$i] != "" && $_form['t-intern-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
																<?php } ?>
															</select>
															<span class="error">
																<? if($_errors['t-intern-copii-varste'.$k.'-'.$i] != ""){?>
													        		<?=$_errors['t-intern-copii-varste'.$k.'-'.$i]?>
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
				<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "tourism-ro"){?>hidden<? }?>">
					<a href="#" class="advanced-click">Cautare avansata</a>
				</div>
			</div>
			<!-- end replasare buton cautare avansata -->
		</div>
	</div>

	<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
	<input type="hidden" name="type" value="tourism-ro">
	<input type="hidden" name="location_type" value="<?=isset($_POST['location_type']) ? $_POST['location_type'] : "0"?>">
	<button id="t-intern-submit" class="hidden" type="submit">Cauta</button>
</form>
