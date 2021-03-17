<div class="row">
	<div class="col-xs-12 col-lg-10 col-lg-offset-1 inline-nav steps-breadcrumbs-search">
		<ul class="nav nav-pills">
			<li role="presentation" class="<? if($_step >= 1){?>done<? }?> <? if($_step == 1){?>active<? }?>"><a href="#"><span class="badge">1</span> <span class="inline-nav__text">Cautare</span></a></li>
			<li role="presentation" class="<? if($_step >= 2){?>done<? }?> <? if($_step == 2){?>active<? }?>"><a href="#"><span class="badge">2</span> <span class="inline-nav__text"><?=$_step_type?></span></a></li>
			<li role="presentation" class="<? if($_step >= 3){?>done<? }?> <? if($_step == 3){?>active<? }?>"><a href="#"><span class="badge">3</span> <span class="inline-nav__text">Turisti</span></a></li>
			<li role="presentation" class="<? if($_step >= 4){?>done<? }?> <? if($_step == 4){?>active<? }?>"><a href="#"><span class="badge">4</span> <span class="inline-nav__text">Rezerva</span></a></li>
		</ul>
	</div>
</div>
