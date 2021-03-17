<form >
	<div class="row">
		<div class="col-xs-12">
			<div class="befradio">
				<div class="radio main-filters__avion aside-filters__checkbox">
					<input id="" name="" type="radio" value="1">
					<label for="">[Dus-intors]</label>
				</div>
				<div class="radio main-filters__bus aside-filters__checkbox">
					<input id="" name="" type="radio" value="1">
					<label for="">[Doar dus]</label>
				</div>
				<div class="radio main-filters__bus aside-filters__checkbox">
					<input id="" name="" type="radio" value="1">
					<label for="">[Date flexibile +/- 3 zile]</label>
				</div>
				<div class="radio main-filters__bus aside-filters__checkbox">
					<input id="" name="" type="radio" value="1">
					<label for="">[Curse charter]</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="row half-gutters">
				<div class="col-sm-12 col-md-5">
					<div class="row">
						<div class="where-to"></div>
						<div class="col-sm-6">
							<!-- aici trebuie sa fie - Selecteaza plecarea - -->
							<label class="main-filters__label main-filters__label--padding" for="bilete-tara">
								<select id="" class="form-control main-filters__select" style="width: 100%;">
									<option value="">[- Selecteaza plecarea -]</option>
								</select>
								<span class="error"></span>
							</label>

							<?/*
							<label class="main-filters__label main-filters__label--padding" for="bilete-tara">
								<!-- <span class="main-filters__label__text">Tara</span> -->
								<select id="bilete-tara" class="form-control main-filters__select" style="width: 100%;">
									<option value=""></option>
									<? foreach($_ticket_countries as $country){?>
										<option value="<?=$country['id_country']?>"><?=$country['title']?></option>
									<? }?>
								</select>
								<span class="error"></span>
							</label>
							*/?>
						</div>
						<div class="col-sm-6">
							<!-- aici trebuie sa fie - Selecteaza destinatia - -->
							<label class="main-filters__label main-filters__label--padding" for="bilete-destinatia">
								<select id="" class="form-control main-filters__select" style="width: 100%;">
									<option value="">[- Selecteaza destinatia -]</option>
								</select>
								<span class="error"></span>
							</label>
						</div>
					</div>
				</div>
				<?/*
				<div class="col-sm-12 col-md-4">
					<label class="main-filters__label main-filters__label--padding" for="bilete-oras-plecare">
						<!-- <span class="main-filters__label__text">Oras plecare</span> -->
						<select id="bilete-oras-plecare" class="form-control main-filters__select" style="width: 100%;" disabled></select>
						<span class="error"></span>
					</label>
				</div>
				*/?>
				<div class="col-sm-12 col-md-7">
					<div class="row half-gutters">
						<!-- - Data  plecare - -->
						<div class="col-sm-6 col-md-4">
							<label class="main-filters__label main-filters__label-wiicon" for="chartere-check-in">
								<i class="sprite sprite-calendar-ininput"></i>
								<input type="text" class="form-control" id="chartere-check-in" name="chartere-check-in" placeholder="[- Data  plecare -]" autocomplete="off" value="<?=$_form['chartere-check-in']?>">
								<span class="error">
									<? if($_errors['chartere-check-in'] != ""){?>
										<?=$_errors['chartere-check-in']?>
									<? }?>
								</span>
							</label>
						</div>
						<!-- end - Data  plecare - -->
						<!-- - Data  retur - -->
						<div class="col-sm-6 col-md-4">
							<label class="main-filters__label main-filters__label-wiicon" for="chartere-check-in">
								<i class="sprite sprite-calendar-ininput"></i>
								<input type="text" class="form-control" id="chartere-check-in" name="chartere-check-in" placeholder="[- Data retur -]" autocomplete="off" value="<?=$_form['chartere-check-in']?>">
								<span class="error">
									<? if($_errors['chartere-check-in'] != ""){?>
										<?=$_errors['chartere-check-in']?>
									<? }?>
								</span>
							</label>
						</div>
						<!-- end - Data  retur - -->
						<!-- 1 adult, clasa economica - -->
						<div class="col-sm-6 col-md-4">
							<label class="main-filters__label main-filters__label--padding main-filters__label-wiicon" for="">
								<i class="sprite sprite-user-ininput"></i>
								<select id="" class="form-control main-filters__select" style="width: 100%;" disabled>
									<option value="">[- 1 adult, clasa economica -]</option>
								</select>
								<span class="error"></span>
							</label>
						</div>
						<!-- end 1 adult, clasa economica - -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row half-gutters">
		<div class="col-sm-12 col-md-7 col-md-offset-5">
			<div class="row half-gutters">
				<div class="col-sm-6 col-md-4 col-md-offset-8">
					<button id="bilete-submit" class="btn btn--green main-filters__btn-cauta mt7" type="submit">Cauta</button>
				</div>
			</div>
		</div>
	</div>
</form>
