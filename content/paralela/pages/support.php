
<main class="margin--bottom-100 support">
	<div class="container-fluid inner-banner inner-banner-about">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<div class="black-layer gray-layer"></div>
					<img class="img-banner__img object-fit" src="<?= $_base ?>static/img/banner-acte.jpg" alt="...">
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid margin--top-50">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<? if($_texts){ ?>
							<? foreach($_texts as $k => $text){ ?>
								<h2 class="logo-title logo-title--full <?= ($k > 0 ? 'hidden' : '') ?> " data-name="support_<?= $k ?>"><span class="logo-title__text"><?= $text['title'] ?></span> <span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span></h2>
							<? } ?>
						<? } ?>
					</div>
				</div>
				<div class="row p-util-wrapper">
					<div class="col-md-3">
						<div class="aside-filters__item">
							<p class="aside-filters__sub visible-xs-block visible-sm-block" role="button" data-toggle="collapse" data-target="#aside-filters__town" aria-expanded="true" aria-controls="aside-filters__town">Alege oras<i class="sprite sprite-down-black"></i></p>
							<div id="aside-filters__town" role="button" class="collapse in" aria-expanded="true">
								<? if($_texts){ ?>
								<ul class="list-unstyled">
									<? foreach($_texts as $k => $text){ ?>
										<li  ><a href="#" class="<?= ($k==0) ? 'active' : '' ?>" data-name="support_<?= $k ?>"><?= $text['title'] ?>	›</a></li>
									<? } ?>
								</ul>
								<? } ?>
							</div>
						</div>
					</div>
					<? if($_texts){ ?>
						<? foreach($_texts as $k => $text){ ?>
							<div class="col-md-9 <?= ($k > 0 ? 'hidden' : '') ?> " data-name="support_<?= $k ?>">
								<?= $text['description'] ?>
							</div>
						<? } ?>
					<? } ?>
				</div>
			</div>
		</div>
	</div>
</main>
