<div class="aside-filters__item">
	<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege oras<i class="sprite sprite-down-black"></i></p>
	<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
		<ul class="list-unstyled">
            <? foreach($_despre_pages as $pg){?>
    			<li><a class="<?=($_params['id'] == $pg['id_about_new'] ? "active" : "")?>" href="<?= route('about-new'.$pg['id_about_new']) ?>"><?=$pg['title']?> ›</a></li>
            <? }?>
			<li><a class="<?=($_section == "about-media" ? "active" : "")?>" href="<?= route('about-media') ?>">Paralela 45 Mass-Media ›</a></li>
			<li><a class="<?=($_section == "csr" ? "active" : "")?>" href="<?= route('csr') ?>">Actiuni CSR	›</a></li>
			<li><a class="<?=($_section == "jobs" ? "active" : "")?>" href="<?= route('jobs') ?>">Cariere ›</a></li>
		</ul>
	</div>
</div>
