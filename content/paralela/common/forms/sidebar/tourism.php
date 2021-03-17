<form action="<?=route('tourism-home')?>" method="post" id="aside-turism-individual">
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-t-individual-tara">
			<span class="aside-filters__label__text">Tara</span>
			<select id="aside-t-individual-tara" name="t-individual-tara" class="form-control aside-filters__select" style="width: 100%;">
				<option></option>
				<? if($_tourism_countries){?>
					<? foreach($_tourism_countries as $country){?>
						<option value="<?=$country['id_country']?>" <? if($_country['id_country'] == $country['id_country']) echo "selected"?>><?=$country['title']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-t-individual-destinatia">
			<span class="aside-filters__label__text">Destinatia</span>
			<select id="aside-t-individual-destinatia" name="t-individual-destinatia" class="form-control aside-filters__select" style="width: 100%;">
				<? if($_destinations_sidebar){?>
					<option></option>
					<? foreach($_destinations_sidebar as $city){?>
						<option value="<?=$city['id']?>" <? if($city['id'] == $_params['city'] || $city['id'] == $_search['destination']) echo "selected"?>><?=$city['text']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-t-individual-oras">
			<span class="aside-filters__label__text">Statiunea</span>
			<select id="aside-t-individual-oras" name="t-individual-oras" class="form-control aside-filters__select" style="width: 100%;">
				<? if($_cities_sidebar){?>
					<option></option>
					<? foreach($_cities_sidebar as $city){?>
						<option value="<?=$city['id']?>" <? if($city['id'] == $_GET['ct'] || $city['id'] == $_search['id_city']) echo "selected"?>><?=$city['text']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>

	<div class="clearfix"></div>
	<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "tourism"){?>hidden<? }?>">
		<a href="#" class="advanced-click">Cautare avansata</a>
	</div>
	<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "tourism"){?>hidden<? }?>">
		<div class="col-xs-4 gutter-right">
			<span class="aside-filters__label__text">Check-in <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-t-individual-check-in" name="t-individual-check-in" placeholder="- Data -" autocomplete="off" value="<?=$_form['t-individual-check-in']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4 gutter-left">
			<span class="aside-filters__label__text">Check-out <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-t-individual-check-out" name="t-individual-check-out" placeholder="- Data -" autocomplete="off" value="<?=$_form['t-individual-check-out']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4">
			<label class="aside-filters__label" for="aside-t-individual-camere">
				<span class="aside-filters__label__text">Nr. camere</span>
				<select id="aside-t-individual-camere" name="t-individual-camere" class="form-control aside-filters__select select__s2" style="width: 100%;">
					<option value="1" <? if($_form['t-individual-camere'] == 1){?>selected<? }?>>1</option>
					<option value="2" <? if($_form['t-individual-camere'] == 2){?>selected<? }?>>2</option>
					<option value="3" <? if($_form['t-individual-camere'] == 3){?>selected<? }?>>3</option>
				</select>
			</label>
		</div>
		<? for($k=1; $k<=3; $k++){?>
			<div class="col-xs-12 aside-filters__cam<?=$k?>" <? if($_form['t-individual-camere'] >= $k){?>style="display:block"<? }?>>
				<label class="aside-filters__label aside-filters__label--small" for="aside-t-individual-adulti<?=$k?>">
					<span class="aside-filters__label__text">Adulti</span>
					<select id="aside-t-individual-adulti<?=$k?>" name="t-individual-adulti<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<?php for($j=1;$j<=5;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['t-individual-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<label class="aside-filters__label aside-filters__label--small" for="aside-t-individual-copii<?=$k?>">
					<span class="aside-filters__label__text">Copii</span>
					<select id="aside-t-individual-copii<?=$k?>" name="t-individual-copii<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<option value="0">-</option>
						<?php for($j=1;$j<4;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['t-individual-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<? for($i=1; $i<=3; $i++){?>
					<label class="aside-filters__label aside-filters__label--small">
						<? if($i == 1){?>
							<span class="aside-filters__label__text" style="white-space: nowrap;">Varste copii</span>
						<? }?>
						<select class="form-control aside-filters__select aside-t-individual-varste-copii select__s2" name="t-individual-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
							<option value="">-</option>
							<?php for($j=0;$j<14;$j++) { ?>
								<option value="<?php echo $j; ?>" <? if($_form['t-individual-copii-varste'.$k.'-'.$i] != "" && $_form['t-individual-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
							<?php } ?>
						</select>
					</label>
				<? }?>
			</div>
		<? }?>
	</div>

	<div class="col-xs-12">
		<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
		<input type="hidden" name="type" value="tourism">
		<button class="btn btn--green aside-filters__btn center-block" type="submit">Cauta</button>
	</div>
</form>
