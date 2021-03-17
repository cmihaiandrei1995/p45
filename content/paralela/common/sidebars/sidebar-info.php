<div class="aside-filters__item">
	<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege pagina<i class="sprite sprite-down-black"></i></p>
	<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
		<ul class="list-unstyled">
			<li><a class="<?= ($_section == 'terms') ? 'active' : '' ?>" href="<?= route('terms') ?>">Termeni si conditii ›</a></li>
			<li><a class="<?= ($_section == 'tourist-contract') ? 'active' : '' ?>" href="<?= route('tourist-contract') ?>">Contractul cu Turistul ›</a></li>
			<li><a class="<?= ($_section == 'tourist-contract-pj') ? 'active' : '' ?>" href="<?= route('tourist-contract-pj') ?>">Contractul cu Turistul PJ ›</a></li>
			<li><a class="<?= ($_section == 'fidelity-card') ? 'active' : '' ?>" href="<?= route('fidelity-card') ?>">Card de fidelitate ›</a></li>
			<li><a class="<?= ($_section == 'vacation_rate') ? 'active' : '' ?>" href="<?= route('vacations-lease') ?>">Vacante in rate ›</a></li>
			<li><a class="<?= ($_section == 'vouchers') ? 'active' : '' ?>" href="<?= route('vouchers') ?>">Tichete/vouchere de vacanta	›</a></li>
			<li><a class="<?= ($_section == 'franchise') ? 'active' : '' ?>" href="<?= route('franchise') ?>">Franciza Paralela 45 ›</a></li>
			<li><a class="<?= ($_section == 'privacy') ? 'active' : '' ?>" href="<?= route('privacy') ?>">Politica de confidentialitate ›</a></li>
			<li><a class="<?= ($_section == 'cookies') ? 'active' : '' ?>" href="<?= route('cookies') ?>">Politica cookie ›</a></li>
			<li><a href="<?=route('agencies')?>">Contact ›</a></li>
		</ul>
	</div>
</div>

<?/*nou
<div class="info-tab-list">
	<ul class="list-unstyled nav nav-pills">
		<li><a class="<?= ($_section == 'terms') ? 'active' : '' ?>" href="<?= route('terms') ?>"><span class="info-tab-list__text">Termeni si conditii ›</span></a></li>
		<li><a class="<?= ($_section == 'tourist-contract') ? 'active' : '' ?>" href="<?= route('tourist-contract') ?>"><span class="info-tab-list__text">Contractul cu Turistul ›</span></a></li>
		<li><a class="<?= ($_section == 'tourist-contract-pj') ? 'active' : '' ?>" href="<?= route('tourist-contract-pj') ?>"><span class="info-tab-list__text">Contractul cu Turistul PJ ›</span></a></li>
		<li><a class="<?= ($_section == 'fidelity-card') ? 'active' : '' ?>" href="<?= route('fidelity-card') ?>"><span class="info-tab-list__text">Card de fidelitate ›</span></a></li>
		<li><a class="<?= ($_section == 'vacation_rate') ? 'active' : '' ?>" href="<?= route('vacations-lease') ?>"><span class="info-tab-list__text">Vacante in rate ›</span></a></li>
		<li><a class="<?= ($_section == 'vouchers') ? 'active' : '' ?>" href="<?= route('vouchers') ?>"><span class="info-tab-list__text">Tichete/vouchere de vacanta	›</span></a></li>
		<li><a class="<?= ($_section == 'franchise') ? 'active' : '' ?>" href="<?= route('franchise') ?>"><span class="info-tab-list__text">Franciza Paralela 45 ›</span></a></li>
		<li><a class="<?= ($_section == 'privacy') ? 'active' : '' ?>" href="<?= route('privacy') ?>"><span class="info-tab-list__text">Politica de confidentialitate ›</span></a></li>
		<li><a class="<?= ($_section == 'cookies') ? 'active' : '' ?>" href="<?= route('cookies') ?>"><span class="info-tab-list__text">Politica cookie ›</span></a></li>
		<li><a href="<?=route('agencies')?>"><span class="info-tab-list__text">Contact ›</span></a></li>
	</ul>
</div>
*/?>
