<!-- formular pagina pachete de vacanta -->
<?/*
<div class="inner-page-intro">
	<div class="main-filters">
		<div class="home_forms-wrapper fhw-inner">
			<div class="container">
				<div class="row">
					<form action="<?=route('charters-home')?>" method="post">
						<div class="col-xs-12 col-sm-8 col-md-10">
							<div class="row half-gutters">
								<div class="col-sm-6 col-md-3">
									<label class="main-filters__label main-filters__label--padding" for="chartere-tara">
										<span class="main-filters__label__text">Tara, destinatie</span>
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
								<div class="col-sm-12 col-md-2">
									<label class="main-filters__label main-filters__label--padding" for="chartere-oras-plecare">
										<span class="main-filters__label__text">Plecare din:</span>
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
								<div class="col-sm-12 col-md-7">
									<div class="row half-gutters">
										<div class="col-sm-12 col-md-3">
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
											<div class="main-filters__label--padding">
												<!-- durata sejur -->
												<label class="main-filters__label" for="chartere-check-out">
													<span class="main-filters__label__text">Durata sejur</span>
													<select id="" name="" class="form-control main-filters__select" style="width: 100%;">
															<option>8 zile</option>
													</select>
												</label>
												<!-- end durata sejur -->
											</div>
										</div>
										<div class="col-sm-12 col-md-3">
											<label class="main-filters__label" for="chartere-camere">
												<span class="main-filters__label__text">Camere</span>
												<select id="chartere-camere" name="chartere-camere" class="form-control main-filters__select select__s2 camere-height-form" style="width: 100%;">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
												</select>
												<span class="error">
													<? if($_errors['chartere-camere'] != ""){?>
														<?=$_errors['chartere-camere']?>
													<? }?>
												</span>
											</label>
										</div>
										<div class="col-sm-12 col-md-3">
											<label class="main-filters__label" for="chartere-adulti<?=$k?>">
												<span class="main-filters__label__text">Adulti, copii</span>
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
									</div>
								</div>
							</div>
							<div class="text-right">
								<a href="#" class="search-more">Nu ai gasit ce cautai? Editeaza cautarea »</a>
							</div>
						</div>
						<div class="col-sm-12 col-md-2">
							<!-- aici cauta -->
							<button id="chartere-submit" class="btn btn--green main-filters__btn-cauta mt" type="submit">Cauta</button>
							<!-- end aici cauta -->
							<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
							<input type="hidden" name="type" value="charter">
							<button class="btn btn--green aside-filters__btn center-block" type="submit">Cauta</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
*/?>
<!-- end formular pagina pachete de vacanta -->

<form action="<?=route('charters-home')?>" method="post" id="aside-chartere">
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-chartere-tara">
			<span class="aside-filters__label__text">Tara</span>
			<select id="aside-chartere-tara" name="chartere-tara" class="form-control aside-filters__select" style="width: 100%;">
				<option></option>
				<? if($_charter_countries){?>
					<? foreach($_charter_countries as $country){?>
						<option value="<?=$country['id_country']?>" <? if($_country['id_country'] == $country['id_country']) echo "selected"?>><?=$country['title']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-chartere-destinatia">
			<span class="aside-filters__label__text">Destinatia</span>
			<select id="aside-chartere-destinatia" name="chartere-destinatia" class="form-control aside-filters__select" style="width: 100%;">
				<? if($_cities_sidebar){?>
					<option></option>
					<? foreach($_cities_sidebar as $city){?>
						<option value="<?=$city['id']?>" <? if($city['id'] == $_item['id_city'] || $city['id'] == $_item['id_zone']) echo "selected"?>><?=$city['text']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-chartere-plecare-din">
			<span class="aside-filters__label__text">Plecare din</span>
			<select id="aside-chartere-plecare-din" name="chartere-oras-plecare" class="form-control aside-filters__select" style="width: 100%;">
				<? if($_cities_from_sidebar){?>
					<option></option>
					<? foreach($_cities_from_sidebar as $city){?>
						<option value="<?=$city['id_city']?>" <? if($_city_from['id_city'] == $city['id_city']) echo "selected"?>><?=$city['title']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>

	<div class="clearfix"></div>
	<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "charter"){?>hidden<? }?>">
		<a href="#" class="advanced-click">Cautare avansata</a>
	</div>
	<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "charter"){?>hidden<? }?>">
		<div class="col-xs-4 gutter-right">
			<span class="aside-filters__label__text">Check-in <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-chartere-check-in" name="chartere-check-in" placeholder="- Data -" autocomplete="off" value="<?=$_form['chartere-check-in']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4 gutter-left">
			<span class="aside-filters__label__text">Check-out <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-chartere-check-out" name="chartere-check-out" placeholder="- Data -" autocomplete="off" <? if(!$_form['chartere-check-out']){?>disabled<? }?> value="<?=$_form['chartere-check-out']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4">
			<label class="aside-filters__label" for="aside-chartere-camere">
				<span class="aside-filters__label__text">Nr. camere</span>
				<select id="aside-chartere-camere" name="chartere-camere" class="form-control aside-filters__select select__s2" style="width: 100%;">
					<option value="1" <? if($_form['chartere-camere'] == 1){?>selected<? }?>>1</option>
					<option value="2" <? if($_form['chartere-camere'] == 2){?>selected<? }?>>2</option>
					<option value="3" <? if($_form['chartere-camere'] == 3){?>selected<? }?>>3</option>
				</select>
			</label>
		</div>
		<? for($k=1; $k<=3; $k++){?>
			<div class="col-xs-12 aside-filters__cam<?=$k?>" <? if($_form['chartere-camere'] >= $k){?>style="display:block"<? }?>>
				<label class="aside-filters__label aside-filters__label--small" for="aside-chartere-adulti<?=$k?>">
					<span class="aside-filters__label__text">Adulti</span>
					<select id="aside-chartere-adulti<?=$k?>" name="chartere-adulti<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<?php for($j=1;$j<=5;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['chartere-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<label class="aside-filters__label aside-filters__label--small" for="aside-chartere-copii<?=$k?>">
					<span class="aside-filters__label__text">Copii</span>
					<select id="aside-chartere-copii<?=$k?>" name="chartere-copii<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<option value="0">-</option>
						<?php for($j=1;$j<4;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['chartere-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<? for($i=1; $i<=3; $i++){?>
					<label class="aside-filters__label aside-filters__label--small">
						<? if($i == 1){?>
							<span class="aside-filters__label__text" style="white-space: nowrap;">Varste copii</span>
						<? }?>
						<select class="form-control aside-filters__select aside-chartere-varste-copii select__s2" name="chartere-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
							<option value="">-</option>
							<?php for($j=0;$j<14;$j++) { ?>
								<option value="<?php echo $j; ?>" <? if($_form['chartere-copii-varste'.$k.'-'.$i] != "" && $_form['chartere-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
							<?php } ?>
						</select>
					</label>
				<? }?>
			</div>
		<? }?>
	</div>

	<div class="col-xs-12">
		<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
		<input type="hidden" name="type" value="charter">
		<button class="btn btn--green aside-filters__btn center-block" type="submit">Cauta</button>
	</div>
</form>
