<form action="<?= route('cruises')?>" method="get">
	<div class="col-xs-12 col-sm-8 col-md-9">
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<label class="main-filters__label" for="croaziere-destinatie">
					<!-- <span class="main-filters__label__text" > Destinatie</span> -->
					<select id="croaziere-destinatie" name="d" class="form-control main-filters__select" data-placeholder="- Alege destinatie -" style="width: 100%;">
						<option></option>
						<? foreach($_cruise_destinations_form as $item){?>
							<optgroup label="<?=$item['title']?>">
								<option value="<?=$item['id_cruise_destination']?>"><? _e('Toate destinatiile din')?> <?=$item['title']?></option>
								<? foreach($item['sub'] as $subitem){?>
										<option value="<?=$subitem['id_cruise_destination']?>"><?=$subitem['title']?></option>
								<? }?>
							</optgroup>
						<? }?>
					</select>
					<span class="error"></span>
				</label>
			</div>
			<div class="col-sm-6 col-md-3">
				<label class="main-filters__label"	for="croaziere-port">
					<!-- <span class="main-filters__label__text">Port imbarcare</span> -->
					<select id="croaziere-port" name="p" class="form-control main-filters__select" data-placeholder="- Alege portul de imbarcare -" style="width: 100%;">
						<option></option>
					</select>
					<span class="error"></span>
				</label>
			</div>
			<div class="col-sm-6 col-md-3">
				<label class="main-filters__label"	for="croaziere-luna">
					<!-- <span class="main-filters__label__text">Luna plecare</span> -->
					<select id="croaziere-luna" name="t" class="form-control main-filters__select" style="width: 100%;">
						<option></option>
					</select>
					<span class="error"></span>
				</label>
			</div>
			<div class="col-sm-6 col-md-3">
				<label class="main-filters__label" for="croaziere-nopti">
					<!-- <span class="main-filters__label__text">Numar nopti</span> -->
					<select id="croaziere-nopti" class="form-control main-filters__select" style="width: 100%;">
						<option></option>
						<? foreach($_cruise_nights_filter as $key => $val){?>
							<option value="<?=$key?>"><?=$val?></option>
						<? }?>
					</select>
					<span class="error"></span>
				</label>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 col-md-3">
		<button id="croaziere-submit" class="btn btn--green main-filters__btn-cauta" type="submit">Cauta</button>
	</div>
</form>
