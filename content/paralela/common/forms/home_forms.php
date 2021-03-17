<div class="col-xs-12 main-filters">
	<ul id="main-tabs" class="main-filters__list nav nav-tabs hidden-xs">
		<li class="main-filters__list__item <?=($_active_tab == "charters" || $_active_tab == "" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#chartere" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t1"></i><span class="main-filters__list__item__title">Pachete vacanta</span>
			</a>
		</li>
		<li class="main-filters__list__item <?=($_active_tab == "circuits" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#circuite" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t2"></i><span class="main-filters__list__item__title">Circuite</span>
			</a>
		</li>
		<li class="main-filters__list__item <?=($_active_tab == "tourism" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#turism-individual" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t3"></i><span class="main-filters__list__item__title">Turism individual</span>
			</a>
		</li>
		<li class="main-filters__list__item <?=($_active_tab == "tourism-ro" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#turism-intern" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t4"></i><span class="main-filters__list__item__title">Turism intern</span>
			</a>
		</li>
		<li class="main-filters__list__item <?=($_active_tab == "cruises" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#croaziere" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t5"></i><span class="main-filters__list__item__title">Croaziere</span>
			</a>
		</li>
		<!-- tab bilete de avion -->
		<li class="main-filters__list__item <?=($_active_tab == "tickets" ? "active" : "")?>">
			<a class="main-filters__list__item__link" href="#bilete-avion" data-toggle="tab">
				<i class="main-tabs-icon main-tabs-icon-t6"></i><span class="main-filters__list__item__title">[Bilete avion]</span>
			</a>
		</li>
		<!-- end tab bilete de avion -->
	</ul>

	<div class="dropdown hidden-sm hidden-md hidden-lg">
		<button class="btn btn-block main-filters__btn clearfix" type="button" id="main-filters__btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			<span class="main-filters__btn__text"><i class="sprite sprite-tab-chartere inactive"></i><i class="sprite sprite-tab-chartere-a active"></i> Chartere</span>
			<span class="main-filters__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>
		</button>
		<ul class="dropdown-menu" aria-labelledby="main-filters__btn" id="dropdown-main-filters-mobile">
			<li class="<?=($_active_tab == "charters" || $_active_tab == "" ? "active" : "")?>"><a href="#chartere" data-toggle="tab"><i class="sprite sprite-tab-chartere inactive"></i><i class="sprite sprite-tab-chartere-a active"></i> Pachete vacanta</a></li>
			<li class="<?=($_active_tab == "circuits" ? "active" : "")?>"><a href="#circuite" data-toggle="tab"><i class="sprite sprite-tab-circuite inactive"></i><i class="sprite sprite-tab-circuite-a active"></i> Circuite</a></li>
			<li class="<?=($_active_tab == "tourism" ? "active" : "")?>"><a href="#turism-individual" data-toggle="tab"><i class="sprite sprite-tab-t-individual inactive"></i><i class="sprite sprite-tab-t-individual-a active"></i> Turism individual</a></li>
			<li class="<?=($_active_tab == "tourism-ro" ? "active" : "")?>"><a href="#turism-intern" data-toggle="tab"><i class="sprite sprite-tab-t-intern inactive"></i><i class="sprite sprite-tab-t-intern-a active"></i> Turism intern</a></li>
			<li class="<?=($_active_tab == "cruises" ? "active" : "")?>"><a href="#croaziere" data-toggle="tab"><i class="sprite sprite-tab-croaziere inactive"></i><i class="sprite sprite-tab-croaziere-a active"></i> Croaziere</a></li>
			<li class="<?=($_active_tab == "tickets" ? "active" : "")?>"><a href="#bilete-avion"><i class="sprite sprite-tab-avion inactive"></i><i class="sprite sprite-tab-avion-a active"></i> Bilete avion</a></li>
		</ul>
	</div>

	<div class="tab-content">

		<div class="tab-pane <?=($_active_tab == "charters" || $_active_tab == "" ? "active" : "")?>" id="chartere">
			<div class="row">
				<?php include $_theme_path.'common/forms/big/charters.php'; ?>
			</div>
		</div>

		<div class="tab-pane <?=($_active_tab == "circuits" ? "active" : "")?>" id="circuite">
			<div class="row">
				<?php include $_theme_path.'common/forms/big/circuits.php'; ?>
			</div>
		</div>

		<div class="tab-pane <?=($_active_tab == "tourism" ? "active" : "")?>" id="turism-individual">
			<div class="row">
				<?php include $_theme_path.'common/forms/big/tourism.php'; ?>
			</div>
		</div>

		<div class="tab-pane <?=($_active_tab == "tourism-ro" ? "active" : "")?>" id="turism-intern">
			<div class="row">
				<?php include $_theme_path.'common/forms/big/tourism-ro.php'; ?>
			</div>
		</div>

		<div class="tab-pane <?=($_active_tab == "cruises" ? "active" : "")?>" id="croaziere">
			<div class="row main-filters__label--padding book-form">
				<?php include $_theme_path.'common/forms/big/cruises.php'; ?>
			</div>
		</div>

		<div class="tab-pane <?=($_active_tab == "tickets" ? "active" : "")?>" id="bilete-avion">
			<div class="row">
				<?php include $_theme_path.'common/forms/big/tickets.php'; ?>
			</div>
		</div>

		<? /*<button class="btn btn--green main-filters__btn-cauta"><span>Cauta</span></button> */ ?>
	</div>
</div>
