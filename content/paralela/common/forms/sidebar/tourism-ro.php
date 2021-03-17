<form action="<?=route('tourism-ro-home')?>" method="post" id="aside-turism-intern">
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-t-intern-programul">
			<span class="aside-filters__label__text">Programul</span>
			<select id="aside-t-intern-programul" name="t-intern-programul" class="form-control aside-filters__select" style="width: 100%;">
				<option></option>
				<? foreach($_tourism_intern_options as $item){?>
					<option value="<?=$item['id']?>" data-type="<?=$item['type']?>"
						<? if(
							($_is_hotel_tag && $_hotel_tag['id_hotel_tag'] == $item['id']) ||
							($_is_tag && $_tag['id_city_tag'] == $item['id']) ||
							($item['type'] == "city" && generate_name($item['title']) == $_search['destination']) ||
							($item['type'] == "special" && generate_name($item['title']) == $_search['destination'])
						){?>selected<? }?>><?=$item['title']?></option>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>
	<div class="col-xs-12 col-sm-6 col-md-12">
		<label class="aside-filters__label" for="aside-t-intern-statiunea">
			<span class="aside-filters__label__text">Statiunea</span>
			<select id="aside-t-intern-statiunea" name="t-intern-statiunea" class="form-control aside-filters__select" style="width: 100%;">
				<? if($_cities_sidebar){?>
					<option></option>
					<? foreach($_cities_sidebar as $city){?>
						<option value="<?=$city['id']?>" <? if($city['id'] == $_GET['ct'] || $city['id'] = $_search['id_city']) echo "selected"?>><?=$city['text']?></option>
					<? }?>
				<? }?>
			</select>
			<span class="error"></span>
		</label>
	</div>

	<div class="clearfix"></div>
	<div class="text-center <? if(isset($_POST['advanced']) && $_POST['type'] == "tourism-ro"){?>hidden<? }?>">
		<a href="#" class="advanced-click">Cautare avansata</a>
	</div>
	<div class="advanced <? if(!isset($_POST['advanced']) && $_POST['type'] != "tourism-ro"){?>hidden<? }?>">
		<div class="col-xs-4 gutter-right">
			<span class="aside-filters__label__text">Check-in <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-t-intern-check-in" name="t-intern-check-in" placeholder="- Data -" autocomplete="off" value="<?=$_form['t-intern-check-in']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4 gutter-left">
			<span class="aside-filters__label__text">Check-out <i class="sprite sprite-calendar-grey-s"></i></span>
			<input type="text" class="form-control" id="aside-t-intern-check-out" name="t-intern-check-out" placeholder="- Data -" autocomplete="off" value="<?=$_form['t-intern-check-out']?>">
			<span class="error"></span>
		</div>
		<div class="col-xs-4">
			<label class="aside-filters__label" for="aside-t-intern-camere">
				<span class="aside-filters__label__text">Nr. camere</span>
				<select id="aside-t-intern-camere" name="t-intern-camere" class="form-control aside-filters__select select__s2" style="width: 100%;">
					<option value="1" <? if($_form['t-intern-camere'] == 1){?>selected<? }?>>1</option>
					<option value="2" <? if($_form['t-intern-camere'] == 2){?>selected<? }?>>2</option>
					<option value="3" <? if($_form['t-intern-camere'] == 3){?>selected<? }?>>3</option>
				</select>
			</label>
		</div>
		<? for($k=1; $k<=3; $k++){?>
			<div class="col-xs-12 aside-filters__cam<?=$k?>" <? if($_form['t-intern-camere'] >= $k){?>style="display:block"<? }?>>
				<label class="aside-filters__label aside-filters__label--small" for="aside-t-intern-adulti<?=$k?>">
					<span class="aside-filters__label__text">Adulti</span>
					<select id="aside-t-intern-adulti<?=$k?>" name="t-intern-adulti<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<?php for($j=1;$j<=5;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['t-intern-adulti'.$k] == $j){?>selected<? }elseif(!$_form && $j==2){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<label class="aside-filters__label aside-filters__label--small" for="aside-t-intern-copii<?=$k?>">
					<span class="aside-filters__label__text">Copii</span>
					<select id="aside-t-intern-copii<?=$k?>" name="t-intern-copii<?=$k?>" class="form-control aside-filters__select select__s2" style="width: 100%;">
						<option value="0">-</option>
						<?php for($j=1;$j<4;$j++) { ?>
							<option value="<?php echo $j; ?>" <? if($_form['t-intern-copii'.$k] == $j){?>selected<? }?>><?php echo $j; ?></option>
						<?php } ?>
					</select>
				</label>
				<? for($i=1; $i<=3; $i++){?>
					<label class="aside-filters__label aside-filters__label--small">
						<? if($i == 1){?>
							<span class="aside-filters__label__text" style="white-space: nowrap;">Varste copii</span>
						<? }?>
						<select class="form-control aside-filters__select aside-t-intern-varste-copii select__s2" name="t-intern-copii-varste<?=$k?>-<?=$i?>" style="width: 100%;">
							<option value="">-</option>
							<?php for($j=0;$j<14;$j++) { ?>
								<option value="<?php echo $j; ?>" <? if($_form['t-intern-copii-varste'.$k.'-'.$i] != "" && $_form['t-intern-copii-varste'.$k.'-'.$i] == $j){?>selected<? }?>><?php echo $j; ?></option>
							<?php } ?>
						</select>
					</label>
				<? }?>
			</div>
		<? }?>
	</div>

	<div class="col-xs-12">
		<input type="hidden" name="advanced" value="<?=isset($_POST['advanced']) ? $_POST['advanced'] : "0"?>">
		<input type="hidden" name="type" value="tourism-ro">
		<input type="hidden" name="location_type" value="<?=isset($_POST['location_type']) ? $_POST['location_type'] : "0"?>">
		<button class="btn btn--green aside-filters__btn center-block" type="submit">Cauta</button>
	</div>
</form>
