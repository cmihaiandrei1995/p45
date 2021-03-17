
<div class="aside-filters__search">
	<form id="search-hotel">
		<input type="text" class="form-control input-search-aside" placeholder="Cauta un hotel" value="<?=$_search_query?>">
		<button class="btn btn-search" type="submit"><i class="sprite sprite-search-blue"></i></button>
		<? if($_search_query != ""){?>
			<a href="<?=remove_offer_filter_link($_active_filters, 'query');?>" style="position:absolute; right:35px; top:5px; color:#f00; font-size:16px;"><i class="zmdi zmdi-close"></i></a>
		<? }?>
	</form>
</div>

<div class="aside-filters__item">
	<div class="checkbox aside-filters__checkbox">
		<input id="" class="click-to-link" type="checkbox" value="" data-remove="">
		<label for="oferte-speciale">Sterge toate filtrele</label>
	</div>
</div>

<? if($_filters['price']['max'] > $_filters['price']['min']){?>
	<div id="aside-filters__price" class="aside-filters__item aside-filters__price">
		<p class="aside-filters__sub" role="button" data-toggle="" data-target="" aria-expanded="true" aria-controls="">Pret</p>
		<div id="slider-range-filter"><div class="color-region"></div></div>
		<div id="slider-data-filter" data-min="<?=$_filters['price']['min']?>" data-max="<?=$_filters['price']['max']?>"
			data-min-set="<?=($_active_filters['price']['min'] > 0 ? $_active_filters['price']['min'] : $_filters['price']['min'])?>"
            data-max-set="<?=($_active_filters['price']['max'] > 0 ? $_active_filters['price']['max'] : $_filters['price']['max'])?>"></div>
		<span id="min2"></span>
		<span id="max2"></span>
		<input id="hidden-range-amount" type="hidden" name="range" value="">
		<script>
        	var $_price_filter_link = '<?=$_price_filter_link?>';
        </script>
	</div>
<? }?>

<? if($_filters['special_offer']['show'] || $_filters['last_minute']['show'] || $_filters['early_booking']['show']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__oferte" aria-expanded="true" aria-controls="aside-filters__oferte">Tip oferta <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__oferte" class="collapse in">
			<? if($_filters['special_offer']['show']){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="oferte-speciale" class="click-to-link" type="checkbox" <? if(in_array(1, $_active_filters['offer'])) echo "checked"?> value="<?=$_filters['special_offer']['add-url']?>" data-remove="<?=$_filters['special_offer']['remove-url']?>">
					<label for="oferte-speciale">Oferte speciale (<?=$_filters['special_offer']['count']?>)</label>
				</div>
			<? }?>
			<? if($_filters['last_minute']['show']){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="oferte-minute" class="click-to-link" type="checkbox" <? if(in_array(2, $_active_filters['offer'])) echo "checked"?> value="<?=$_filters['last_minute']['add-url']?>" data-remove="<?=$_filters['last_minute']['remove-url']?>">
					<label for="oferte-minute">Last minute (<?=$_filters['last_minute']['count']?>)</label>
				</div>
			<? }?>
			<? if($_filters['early_booking']['show']){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="oferte-early" class="click-to-link" type="checkbox" <? if(in_array(3, $_active_filters['offer'])) echo "checked"?> value="<?=$_filters['early_booking']['add-url']?>" data-remove="<?=$_filters['early_booking']['remove-url']?>">
					<label for="oferte-early">Early booking (<?=$_filters['early_booking']['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>

<? if($is_ro && $_filters['special_tags']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__tags" aria-expanded="true" aria-controls="aside-filters__tags">Oferte de vacanta <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__tags" class="collapse in">
			<? foreach($_filters['special_tags'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="tag-<?=$v['key']?>" class="click-to-link" type="checkbox" <? if(in_array($v['key'], $_active_filters['special_tags'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="tag-<?=$v['key']?>"><?=$v['name']?> (<?=$v['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>

<? if($_is_country && $_filters['zones']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__zones" aria-expanded="true" aria-controls="aside-filters__facilitati">Zone <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__zones" class="collapse in">
			<? foreach($_filters['zones'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="city-<?=$k?>" class="click-to-link" type="checkbox" <? if(in_array($k, $_active_filters['zones'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="city-<?=$k?>"><?=$v['name']?> (<?=$v['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>

<? if(!$_is_city && $_filters['cities']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__orase" aria-expanded="true" aria-controls="aside-filters__facilitati">Orase</p>
		<div id="aside-filters__orase" class="collapse in">
			<? foreach($_filters['cities'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="city-<?=$k?>" class="click-to-link" type="checkbox" <? if(in_array($k, $_active_filters['cities'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="city-<?=$k?>"><?=$v['name']?> (<?=$v['count']?>)</label>
				</div>
			<? }?>

			<?/*
			<a href="#" class="see-more-filters"><i class="zmdi zmdi-long-arrow-down"></i> Vezi mai multe</a>
			*/?>
		</div>
	</div>
<? }?>

<? if($_filters['stars']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__stele" aria-expanded="true" aria-controls="aside-filters__stele">Numar stele <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__stele" class="collapse in">
			<? foreach($_filters['stars'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="<?=$k?>-star" class="click-to-link" type="checkbox" <? if(in_array($k, $_active_filters['stars'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="<?=$k?>-star">
						<? for($i=1; $i<=$k; $i++){?>
							<i class="sprite sprite-star"></i>
						<? }?>
						(<?=$v['count']?>)
					</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>

<? if($_filters['meals']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__masa" aria-expanded="true" aria-controls="aside-filters__masa">Tip masa <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__masa" class="collapse in">
			<? foreach($_filters['meals'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="meal-<?=$v['key']?>" class="click-to-link" type="checkbox" <? if(in_array($v['key'], $_active_filters['meals'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="meal-<?=$v['key']?>"><?=$v['name']?> (<?=$v['count']?>)</label>
				</div>
			<? }?>

			<?/*
			<a href="#" class="see-more-filters"><i class="zmdi zmdi-long-arrow-down"></i> Vezi mai multe</a>
			*/?>
		</div>
	</div>
<? }?>

<? if($_filters['facilities']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__facilitati" aria-expanded="true" aria-controls="aside-filters__facilitati">Facilitati <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__facilitati" class="collapse in">
			<? foreach($_filters['facilities'] as $k => $v){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="facility-<?=$k?>" class="click-to-link" type="checkbox" <? if(in_array($k, $_active_filters['facilities'])) echo "checked"?> value="<?=$v['add-url']?>" data-remove="<?=$v['remove-url']?>">
					<label for="facility-<?=$k?>"><?=$_hotel_facilities_options[$_facilities_hotels[$k]]?> (<?=$v['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>
