<form action="" id="aside-circuite-form">
	<div class="col-xs-12 circuite-checkbox clearfix">
		<span class="aside-filters__label__text pull-left">Transport</span>
		<div class="checkbox aside-filters__checkbox">
			<input id="aside-circuite-avion" value="" type="checkbox" name="circuit-plane" <? if($_is_plane) echo "checked"?>>
			<label for="aside-circuite-avion"><i class="sprite sprite-circuit-avion"></i></label>
		</div>
		<div class="checkbox aside-filters__checkbox">
			<input id="aside-circuite-bus" value="" type="checkbox" name="circuit-bus" <? if($_is_bus) echo "checked"?>>
			<label for="aside-circuite-bus"><i class="sprite sprite-circuit-bus"></i></label>
		</div>
	</div>
	<div class="col-ms-12 col-sm-12">
		<label class="aside-filters__label" for="aside-circuite-continent">
			<span class="aside-filters__label__text">Continent</span>
			<select id="aside-circuite-continent" class="form-control aside-filters__select" style="width: 100%;" name="circuit-continent">
				<option></option>
				<? foreach($_circuit_continents as $continent){?>
					<option value="<?=$continent['id_continent']?>" <? if($_continent['id_continent'] == $continent['id_continent']) echo "selected"?>><?=$continent['title']?></option>
				<? }?>
			</select>
		</label>
	</div>
	<div class="col-ms-12 col-sm-12">
		<label class="aside-filters__label" for="aside-circuite-tara">
			<span class="aside-filters__label__text">Tara</span>
			<select id="aside-circuite-tara" class="form-control aside-filters__select" style="width: 100%;" name="circuit-country">
				<? if(!$_country){?>
					<option></option>
				<? }?>
				<? if($_circuit_countries_sidebar){?>
					<? foreach($_circuit_countries_sidebar as $country){?>
						<option value="<?=$country['id_country']?>" <? if($_country['id_country'] == $country['id_country']) echo "selected"?>><?=$country['title']?></option>
					<? }?>
				<? }?>
			</select>
		</label>
	</div>
	<div class="col-ms-12 col-sm-12">
		<label class="aside-filters__label" for="aside-circuite-plecare-din">
			<span class="aside-filters__label__text">Plecare din</span>
			<select id="aside-circuite-plecare-din" class="form-control aside-filters__select" style="width: 100%;" <? if(!$_country){?>disabled<? }?> name="circuit-from">
				<? if($_cities_from_sidebar){?>
					<option></option>
					<? foreach($_cities_from_sidebar as $city){?>
						<option value="<?=$city['id_city']?>" <? if($_city_from['id_city'] == $city['id_city']) echo "selected"?>><?=$city['title']?></option>
					<? }?>
				<? }?>
			</select>
		</label>
	</div>
	<div class="col-ms-12 col-sm-12">
		<label class="aside-filters__label" for="aside-circuite-plecare-luna">
			<span class="aside-filters__label__text">Plecare in luna</span>
			<select id="aside-circuite-plecare-luna" class="form-control aside-filters__select" style="width: 100%;" <? if(!$_country){?>disabled<? }?> name="circuit-month">
				<? if($_circuit_dates_sidebar){?>
					<option></option>
					<? foreach($_circuit_dates_sidebar as $date){?>
						<option value="<?=$date['month']."-".$date['year']?>" <? if(intval($_GET['m'])."-".intval($_GET['y']) == $date['month']."-".$date['year']) echo "selected"?>><?=$_months[$date['month']]." ".$date['year']?></option>
					<? }?>
				<? }?>
			</select>
		</label>
	</div>
	<!--
	<div class="col-xs-12 aside-filters__cam1">
		<label class="aside-filters__label aside-filters__label--small" for="aside-circuite-adulti1">
			<span class="aside-filters__label__text">Adulti</span>
			<select id="aside-circuite-adulti" class="form-control aside-filters__select select__s2" style="width: 100%;" name="circuit-adult">
				<option value="0">-</option>
				<?php for($i=1;$i<5;$i++) { ?><option value="<?php echo $i; ?>" <? if($i==2) echo "selected"?>><?php echo $i; ?></option> <?php } ?>
			</select>
		</label>
		<label class="aside-filters__label aside-filters__label--small" for="aside-circuite-copii1">
			<span class="aside-filters__label__text">Copii</span>
			<select id="aside-circuite-copii" class="form-control aside-filters__select select__s2" style="width: 100%;" name="circuit-child">
				<option value="0">-</option>
				<?php for($i=1;$i<4;$i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
			</select>
		</label>
		<label class="aside-filters__label aside-filters__label--small">
			<span class="aside-filters__label__text" style="white-space: nowrap;">Varste copii</span>
			<select class="form-control aside-filters__select aside-circuite-varste-copii select__s2" style="width: 100%;" name="circuit-child-age-1">
				<?php for($i=0;$i<14;$i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
			</select>
		</label>
		<label class="aside-filters__label aside-filters__label--small">
			<span class="aside-filters__label__text">&nbsp;</span>
			<select class="form-control aside-filters__select aside-circuite-varste-copii select__s2" style="width: 100%;" name="circuit-child-age-2">
				<?php for($i=0;$i<14;$i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
			</select>
		</label>
		<label class="aside-filters__label aside-filters__label--small">
			<span class="aside-filters__label__text">&nbsp;</span>
			<select class="form-control aside-filters__select aside-circuite-varste-copii select__s2" style="width: 100%;" name="circuit-child-age-3">
				<?php for($i=0;$i<14;$i++) { ?><option value="<?php echo $i; ?>"><?php echo $i; ?></option> <?php } ?>
			</select>
		</label>
	</div>
	-->
	<div class="col-xs-12">
		<span class="error"></span>
		<button class="btn btn--green aside-filters__btn center-block" type="submit" name="submit">Cauta</button>
	</div>
</form>
