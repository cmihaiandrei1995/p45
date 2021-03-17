<? if($_filters['price']['max'] > $_filters['price']['min']){?>
	<div id="aside-filters__price" class="aside-filters__price">
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
<? if($_filters['category']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__circuite__tip" aria-expanded="true" aria-controls="aside-filters__circuite__tip">Tip circuit <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__circuite__tip" class="collapse in">
			<? foreach($_filters['category'] as $key => $item){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="category-<?=$key?>" class="click-to-link" type="checkbox" <? if(in_array($item['id_circuit_label'], $_active_filters['cat'])) echo "checked"?> value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>">
					<label for="category-<?=$key?>"><?=$item['title']?> (<?=$item['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>
<? if($_filters['special']){?>
	<div class="aside-filters__item">
		<p class="aside-filters__sub" role="button" data-toggle="collapse" data-target="#aside-filters__circuite__sarbatori" aria-expanded="true" aria-controls="aside-filters__circuite__sarbatori">Circuite de sarbatori <i class="sprite sprite-down-black"></i></p>
		<div id="aside-filters__circuite__sarbatori" class="collapse in">
			<? foreach($_filters['special'] as $key => $item){?>
				<div class="checkbox aside-filters__checkbox">
					<input id="special-<?=$key?>" class="click-to-link" type="checkbox" <? if(in_array($item['id_circuit_label'], $_active_filters['special'])) echo "checked"?> value="<?=$item['add-url']?>" data-remove="<?=$item['remove-url']?>">
					<label for="special-<?=$key?>"><?=$item['title']?> (<?=$item['count']?>)</label>
				</div>
			<? }?>
		</div>
	</div>
<? }?>