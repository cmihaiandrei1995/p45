<div class="col-md-12 contact-info">
	<div class="row">
		<div class="col-sm-4 col-lg-3 contact-info-col">
			<i class="sprite ipi-mail-iconlightblue"></i>
			<p>EMAIL</p>
			<? if(get_config('email_1') != ''){ ?>
				<a href="mailto:<?= get_config('email_1') ?>"><?= get_config('email_1') ?></a>
			<? } ?>
			<? if(get_config('email_2') != ''){ ?>
				<a href="mailto:<?= get_config('email_2') ?>"><?= get_config('email_2') ?></a>
			<? } ?>
		</div>
		<div class="col-sm-4 col-lg-3 contact-info-col">
			<i class="sprite ipi-phone-iconlightblue"></i>
			<p>Contact</p>
			<? if(get_config('telefon') != ''){ ?>
				<a href="tel:<?= get_config('telefon') ?>">Telefon: <?= get_config('telefon') ?></a>
			<? } ?>
			<? if(get_config('call_center') != ''){ ?>
				<a href="tel:<?= get_config('call_center') ?>">Call Center: <?= get_config('call_center') ?></a>
			<? } ?>
		</div>
		<div class="col-sm-4 col-lg-3 contact-info-col">
			<i class="sprite ipi-calendar-iconlightblue"></i>
			<p>PROGRAM AGENTII</p>
			<span>
				<? if(get_config('program_lv') != ''){ ?>
					L-V: <?= get_config('program_lv') ?><br />
				<? } ?>
				<? if(get_config('program_s') != ''){ ?>
					S: <?= get_config('program_s') ?>
				<? } ?>
			</span>
		</div>
	</div>
</div>
