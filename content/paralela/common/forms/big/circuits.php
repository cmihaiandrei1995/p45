<form action="<?=route('circuits-home')?>" method="post">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-12">
				<div class="befcheck">
					<span class="main-filters__label__text">Transport</span>
					<div class="checkbox main-filters__avion aside-filters__checkbox">
						<input id="circuite-airplane" name="circuite-airplane" type="checkbox" value="1">
						<label for="circuite-airplane"><i class="sprite sprite-circuit-avion-white"></i></label>
					</div>
					<div class="checkbox main-filters__bus aside-filters__checkbox">
						<input id="circuite-bus" name="circuite-bus" type="checkbox" value="1">
						<label for="circuite-bus"><i class="sprite sprite-circuit-bus-white"></i></label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<div class="row">
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label" for="circuite-continent">
							<!-- <span class="main-filters__label__text">Continent</span> -->
							<select id="circuite-continent" name="circuite-continent" class="form-control main-filters__select" style="width: 100%;">
								<option></option>
								<? foreach($_circuit_continents as $continent){?>
									<option value="<?=$continent['id_continent']?>" <? if($continent['id_continent'] == $_form['circuite-continent']) echo "selected"?>><?=$continent['title']?></option>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['circuite-continent'] != ""){?>
					        		<?=$_errors['circuite-continent']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label" for="circuite-tara">
							<!-- <span class="main-filters__label__text">Tara</span> -->
							<select id="circuite-tara" name="circuite-tara" class="form-control main-filters__select" style="width: 100%;"  <? if(!$_form['circuite-tara']){?>disabled<? }?>>
								<? if($_circuit_countries_header){?>
									<? foreach($_circuit_countries_header as $country){?>
										<option value="<?=$country['id_country']?>" <? if($_form['circuite-tara'] == $country['id_country']) echo "selected"?>><?=$country['title']?></option>
									<? }?>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['circuite-tara'] != ""){?>
					        		<?=$_errors['circuite-tara']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label" for="circuite-luna-plecare">
							<!-- <span class="main-filters__label__text">Luna plecare</span> -->
							<select id="circuite-luna-plecare" name="circuite-luna-plecare" class="form-control main-filters__select" style="width: 100%;">
								<option></option>
								<? foreach($_circuit_dates as $key => $val){?>
									<option value="<?=$key?>" <? if($key == $_form['circuite-luna-plecare']) echo "selected"?>><?=$val?></option>
								<? }?>
							</select>
							<span class="error">
								<? if($_errors['circuite-luna-plecare'] != ""){?>
					        		<?=$_errors['circuite-luna-plecare']?>
					        	<? }?>
							</span>
						</label>
					</div>
					<!-- orasul de plecare -->
					<div class="col-sm-6 col-md-3">
						<label class="main-filters__label" for="circuite-luna-plecare">
							<!-- <span class="main-filters__label__text">Orasul plecare</span> -->
							<select id="" name="" class="form-control main-filters__select" style="width: 100%;">
								<option value="- Alege orasul de plecare -">[- Alege orasul de plecare -]</option>
							</select>
							<span class="error"></span>
						</label>
					</div>
					<!-- end orasul de plecare -->
				</div>
			</div>

			<div class="col-xs-12 col-sm-4 col-md-3">
				<button id="circuite-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9">
				<!-- aici campurile pentru Cautare Avansata, iar textul "Stii..." dispare -->
				<div class="advanced-click-txt">
					[Stii exact ce cauti? Incearca aici]
				</div>
				<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "circuit"){?>hidden<? }?>">
					<div class="main-filters__label--padding">
						<div class="row half-gutters">
							<div class="col-md-2 col-sm-6 col-xs-8">
								<label class="main-filters__label" for="circuite-camere">
									<span class="main-filters__label__text">Camere</span>
									<select id="circuite-camere" name="circuite-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
										<option value="1" <? if($_form['circuite-camere'] == 1){?>selected<? }?>>1</option>
										<option value="2" <? if($_form['circuite-camere'] == 2){?>selected<? }?>>2</option>
										<option value="3" <? if($_form['circuite-camere'] == 3){?>selected<? }?>>3</option>
									</select>
									<span class="error">
										<? if($_errors['circuite-camere'] != ""){?>
							        		<?=$_errors['circuite-camere']?>
							        	<? }?>
									</span>
								</label>
							</div>
							<? for($k=1; $k<=3; $k++){?>
								<div class="col-xs-12 col-md-10 advanced-selectors-xs-circuite <? if($k>1){?> col-md-offset-2 <? }?> item-filters__cam<?=$k?>" <? if($_form['circuite-camere'] >= $k){?>style="display:block"<? }?>>
									<div class="wrapper">
										<div class="row half-gutters">
											<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
												<label class="main-filters__label adult_nr" for="circuite-adulti<?=$k?>">
													<span class="main-filters__label__text">Adulti</span>
													<select id="circuite-adulti<?=$k?>" name="circuite-adulti<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;">
														<?php for($j=1;$j<=3;$j++) { ?>
															<option value="<?php echo $j; ?>" <? if($_form['circuite-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
														<?php } ?>
													</select>
													<span class="error">
														<? if($_errors['circuite-adulti'.$k] != ""){?>
											        		<?=$_errors['circuite-adulti'.$k]?>
											        	<? }?>
													</span>
												</label>
											</div>
											<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
												<label class="main-filters__label child_nr" for="circuite-copii<?=$k?>">
													<span class="main-filters__label__text">Copii</span>
													<select id="circuite-copii<?=$k?>" name="circuite-copii<?=$k?>" class="form-control main-filters__select select__s2" style="width: 100%;">
														<option value="0">-</option>
														<option value="1" <? if($_form['circuite-copii'.$k] == 1){?>selected<? }?>>1</option>
													</select>
													<span class="error">
														<? if($_errors['circuite-copii'.$k] != ""){?>
											        		<?=$_errors['circuite-copii'.$k]?>
											        	<? }?>
													</span>
												</label>
											</div>
											<div class="col-xs-12 col-md-2 col-sm-6 col-lg-20">
												<label class="main-filters__label children_age child_age" <? if($_form['circuite-copii'.$k]){?>style="display:block"<? }?>>
													<span class="main-filters__label__text" style="white-space: nowrap;">Varsta copil</span>
													<select class="form-control main-filters__select circuite-varste-copii select__s2" id="circuite-copii-varste<?=$k?>" name="circuite-copii-varste<?=$k?>" style="width: 100%;">
														<option value="">-</option>
														<?php for($j=0;$j<14;$j++) { ?>
															<option value="<?php echo $j; ?>" <? if($_form['circuite-copii-varste'.$k] != "" && $_form['circuite-copii-varste'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
														<?php } ?>
													</select>
													<span class="error">
														<? if($_errors['circuite-copii-varste'.$k] != ""){?>
											        		<?=$_errors['circuite-copii-varste'.$k]?>
											        	<? }?>
													</span>
												</label>
											</div>
											<?/*
											<div class="col-xs-8 col-sm-3">
												<label class="main-filters__label room_type" for="circuite-room-type<?=$k?>">
													<span class="main-filters__label__text" style="white-space: nowrap;">Tip camera</span>
													<select id="circuite-room-type<?=$k?>" name="circuite-room-type<?=$k?>" class="form-control item-filters__select select__s2" style="width: 100%;" data-placeholder="- Tip camera -">
														<option value=""></option>
														<? foreach($_circuit_room_types as $key => $room){?>
															<option value="<?=$key?>" <? if($key==1){?>selected<? }?>><?=$room['title']?></option>
														<? }?>
													</select>
													<span class="error">
														<? if($_errors['circuite-room-type'.$k] != ""){?>
											        		<?=$_errors['circuite-room-type'.$k]?>
											        	<? }?>
													</span>
												</label>
											</div>
											*/?>
										</div>
									</div>
								</div>
							<? }?>
						</div>
					</div>
				</div>
				<!-- end aici campurile pentru Cautare Avansata -->
			</div>
			<!-- replasare buton cautare avansata -->
			<div class="col-xs-12 col-sm-4 col-md-3">
				<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "circuit"){?>hidden<? }?>">
					<a href="#" class="advanced-click">Cautare avansata</a>
				</div>
			</div>
			<!-- end replasare buton cautare avansata -->
		</div>
	</div>

	<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
	<input type="hidden" name="type" value="circuit">
	<button id="circuite-submit" class="hidden" type="submit">Cauta</button>
</form>
