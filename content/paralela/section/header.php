<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N3PN9L" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			xfbml: true,
			version: 'v3.2'
		});
	};
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = 'https://connect.facebook.net/ro_RO/sdk/xfbml.customerchat.js';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="black-over hidden"></div>

<? /*
<div class="work-from-home">
    <strong>Echipa Paralela 45</strong> lucreaza, in aceasta perioada, exclusiv <strong>ONLINE | Luni - Vineri: 09:00 - 17:00</strong> |<br>Va rugam sa ne adresati solicitarile, prioritar prin e-mail, la <a href="mailto:secretariat@paralela45.ro">secretariat@paralela45.ro</a> si doar pentru urgente la <a href="tel:0219129">021.9129</a>
</div>
*/ ?>

<div class="de30ani-header hidden-md hidden-lg">
	<div class="de30ani-content">
		<a href="<?= route("about") ?>"><img src="<?= $_base ?>static/img/de30ani-txt.jpg" alt="" />
			<img src="<?= $_base ?>static/img/de30ani-btn.jpg" alt="" class="btn30ani" /></a>
	</div>
</div>

<header class="header header--border-top">
	<div class="container-fluid header__topbar header--dark-blue">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-10 col-ms-6 col-sm-6 col-md-3 col-lg-3 asistenta">
						<p class="margin--bottom-0 text--white">Asistenta in caz de urgenta: <a class="text--white hover-opacity" href="tel:+40374106406">0374 106 406</a></p>
					</div>
					<div class="col-md-6 col-lg-6 hidden-sm hidden-xs text-center header__topbar__tools">
						<ul class="header-list list-unstyled list-inline margin--bottom-0">
							<? /*<li><a class="text--white hover-opacity" href="<?= route('jobs') ?>"><i class="sprite sprite-topbar-testimoniale margin--right-5"></i><span>Cariere</span></a></li>
							<li><span class="text--white">|</span></li> */ ?>
							<li><a class="text--white hover-opacity" href="<?= route('testimonials') ?>"><i class="sprite sprite-topbar-quotes margin--right-5"></i><span>Testimoniale</span></a></li>
							<li><span class="text--white">|</span></li>
							<? /*<li><a class="text--white hover-opacity" href="<?= $_config['blog-link'] ?>" target="_blank"><i class="sprite sprite-topbar-photo margin--right-5"></i><span>Noi am fost acolo</span></a></li>
							<li><span class="text--white hidden-md">|</span></li> */ ?>
							<li><a class="text--white hover-opacity" href="<?= route('custom-vacations') ?>"><i class="sprite sprite-topbar-star margin--right-5"></i><span>Vacante la comanda</span></a></li>
							<li><span class="text--white">|</span></li>
							<li><a class="text--white hover-opacity" href="http://www.mae.ro/travel-alerts" target="_blank"><i class="sprite sprite-topbar-allert margin--right-5"></i><span>Alerte Calatorie</span></a></li>
						</ul>
					</div>
					<div class="col-xs-2 col-ms-6 col-sm-6 col-md-3 col-lg-3 text-right">
						<div class="my-acc-wrapper">
							<!-- buton contul meu -->
							<a class="text--white hover-opacity my-acc-btn no-hide-acc-menu" href="" id="my-acc-btn">
								<i class="sprite sprite-topbar-lock margin--right-5 no-hide-acc-menu"></i>
								<span class="hidden-xxs no-hide-acc-menu">Contul meu <i class="zmdi zmdi-caret-down no-hide-acc-menu"></i></span>
							</a>
							<!-- end buton contul meu -->

							<!-- dropdown contul meu -->
							<ul class="account-list list-unstyled margin--bottom-0 no-hide-acc-menu" id="my-acc-menu">
								<? if(is_logged_in()){?>
								<li class="btn-group user-loggedin">
									<a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="sprite sprite-user-avatar margin--right-5"></i>
										<span class="hidden-xxs"><?= $_loggedin_user['title'] ?></span><span class="caret"></span>
									</a>
									<ul class="dropdown-menu user-loggedin__list">
										<li class="visible-xxs-block"><a href="<?= route('my-account') ?>"><?= $_loggedin_user['title'] ?></a></li>
										<li><a href="<?= route('my-account-account') ?>"><i class="sprite sprite-user-group"></i>Date cont</a></li>
										<li><a href="<?= route('my-account-loyalty') ?>"><i class="sprite sprite-user-star"></i>Puncte de fidelitate</a></li>
										<li><a href="<?= route('my-account-whishlist') ?>"><i class="sprite sprite-user-sound"></i>Whislist</a></li>
										<li><a href="<?= route('logout') ?>"><i class="sprite sprite-user-lock"></i>Logout</a></li>
									</ul>
								</li>
								<? }else{ ?>
								<li><a class="text--white" href="<?= route('login') ?>"><span class="hidden-xxs">Intra in cont</span></a></li>
								<li><a class="text--white" href=""><span class="hidden-xxs">[Creeaza cont nou]</span></a></li>
								<li class="hidden-xxs"><a class="" href="http://rezervari.paralela45.ro" target="_blank"><span>Cont agentii</span></a></li>
								<? }?>
							</ul>
							<!-- end dropdown contul meu -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-ms-3 col-sm-4 main-logo-holder">
						<? /*<a class="logo" href="<?= $_base ?>" title="Paralela 45"><img src="<?= $_base ?>static/img/logo.png" alt="Paralela 45" /></a> */?>
						<a class="logo" href="<?= $_base ?>" title="Paralela 45"><img src="<?= $_base ?>static/img/logo-30.png" alt="Paralela 45" /></a>
						<? /*<a class="logo" href="<?= $_base ?>" title="Paralela 45"><img src="<?= $_base ?>static/img/logo-craciun.png" alt="Paralela 45" /></a> */?>

						<?/*<a href="<?= $_base ?>vacantasigurarea/" class="pastila-st"><img src="<?= $_base ?>static/img/pastila-st.png" alt="" /></a>*/?>

						<a href="<?= route("about") ?>" class="btn30ani-deincredere"><img src="<?= $_base ?>static/img/de30ani.png" alt="" /></a>

						<?/* <p class="motto"><span><b>RESPECTAM turistii!</b></span> <br> <b>ZERO taxe ascunse!</b></p>
						<img src="<?= $_base ?>static/img/100Romania.png" alt="Paralela 45" class="hundred-years" />*/?>
					</div>
					<div class="col-ms-5 col-sm-5 col-lg-4 form-search__wrapper">
						<form class="form-inline form-search clearfix" id="search_form_header" method="get" action="<?= route('search') ?>">
							<div class="form-group">
								<label class="sr-only" for="search">Cautare</label>
								<input type="text" class="form-control input-search" id="search_string" name="q" value="<?= $_GET['q'] ?>" placeholder="Cauta tara, orasul sau hotelul preferat..." autocomplete="off">
							</div>
							<button type="submit" class="btn btn-search"><i class="sprite sprite-search"></i></button>
							<div class="autosuggest-wrapper hidden" id="autosuggest-wrapper">
								<div class="row"></div>
							</div>
						</form>
					</div>
					<div class="col-sm-3 col-lg-4 clearfix header__contact">
						<p class="motto upper" style="font-weight: 500;"><span>RESPECTAM turistii</span> <br> <span style="font-weight:900; border-top:0;">ZERO</span> taxe ascunse!</p>

						<?/*<a href="<?= route("about") ?>" class="pastila-dr"><img src="<?= $_base ?>static/img/pastila-dr.png" alt="" /></a>*/?>

						<div class="call-center pull-right">
							<ul class="call-center--list list-unstyled margin--bottom-0 margin--top-5 pull-right">
								<li>
									<i class="sprite sprite-24-7"></i>
									<a class="text--green" href="tel:0374 45 45 45">0374 45 45 45</a>
								</li>
								<!-- vezi toate agentiile -->
								<li>
									<i class="sprite sprite-agentii"></i>
									<strong><a class="text--blue" href="<?= route('agencies') ?>">Vezi toate agentiile »</a></strong>
								</li>
								<!-- end vezi toate agentiile -->
							</ul>
							<? /* <div class="header__contact__mobile">
								<a class="text--red pull-left" href="tel:+4021 9129"><strong>021 9129</strong></a>
								<a href="tel:+402192129"><i class="sprite sprite-24-7"></i></a>
							</div> */ ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid header--blue header--border-bottom">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-2">
						<nav class="navbar navbar-paralela45 margin--bottom-0">
							<div class="container-fluid">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="modal" data-target="#menuModal">
										<span class="sr-only">Toggle navigation</span>
										<span class="navbar-header__ham__wrapper">
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</span>
										<span class="navbar-header__ham__text">MENU</span>
									</button>
								</div>
								<div class="modal fade menu-modal" id="menuModal" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<ul class="menu-modal__header__list list-unstyled margin--bottom-0 text-right">
													<li><a class="text--white" href="<?= route('testimonials') ?>"><span>Testimoniale</span></a></li>
													<li><a class="text--white" href="<?= $_config['blog-link'] ?>" target="_blank"><span>Noi am fost acolo</span></a></li>
													<li><a class="text--white" href="<?= route('custom-vacations') ?>"><span>Vacante la comanda</span></a></li>
												</ul>
											</div>
											<div class="modal-body">
												<ul class="nav navbar-nav navbar-nav-paralela45 text-right">
													<li class="<?= ($_section == "home" ? "active" : "") ?>">
														<a href="<?= $_base ?>" class="text--white">Home</a>
													</li>
													<li class="<?= ($_section == "charters" ? "active" : "") ?>">
														<!-- dropdown-->
														<a href="<?= route('charters-home') ?>" class="text--white">Pachete de vacanta</a>
														<? /*
														<a href="<?= route('charters-home') ?>" class="dropdown-toggle text--white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pachete de vacanta <i class="sprite sprite-down"></i></a>
														<ul class="dropdown-menu">
															<li><a href="#">Action</a></li>
															<li><a href="#">Another action</a></li>
															<li><a href="#">Something else here</a></li>
														</ul>
														*/ ?>
													</li>
													<? /*
													<li class="<?= ($_page == "lp" && $_item['id_lp'] == 24 ? "active" : "") ?>">
													<a href="<?= $_base ?>vacante-iarna/" class="text--white hover-opacity">Iarna 2020</a>
													</li>
													*/?>
													<li class="<?= ($_page == "lp" && $_item['id_lp'] == 23 ? "active" : "") ?>">
														<a href="<?= $_base ?>vacante-exotice/" class="text--white hover-opacity">Exotice</a>
													</li>
													<li class="<?= ($_section == "circuits" ? "active" : "") ?>">
														<a href="<?= route('circuits-home') ?>" class="text--white">Circuite</a>
													</li>
													<li class="<?= ($_section == "tourism" ? "active" : "") ?>">
														<a href="<?= route('tourism-home') ?>" class="text--white">Turism individual</a>
													</li>
													<li class="<?= ($_section == "tourism-ro" ? "active" : "") ?>">
														<a href="<?= route('tourism-ro-home') ?>" class="text--white">Turism intern</a>
													</li>
													<li class="<?= ($_page == "tourism" && $_params['city'] == "orase" ? "active" : "") ?>">
														<a href="<?= $_base ?>vacante-seniori-si-sociali/" class="text--white hover-opacity">Seniori</a>
													</li>
													<li class="<?= ($_section == "cruises" ? "active" : "") ?>">
														<a href="<?= route('cruises-home') ?>" class="text--white hover-opacity">Croaziere</a>
													</li>
													<? /*
                                                    <li class="<?= ($_page == "lp" && $_item['id_lp'] == 23 ? "active" : "") ?>">
													<a href="<?= $_base ?>vacante-exotice/" class="text--white hover-opacity">
														<!--<span style="color:#ea4200"><b>NOU!</b></span>-->
														Exotice
													</a>
													</li>
													*/ ?>
													<li class="<?= ($_section == "tickets" ? "active" : "") ?>">
														<a href="<?= route('tickets') ?>" class="text--white">Bilete de avion</a>
													</li>
													<li class="<?= ($_page == "buy-voucher" ? "active" : "") ?>">
														<a href="<?= route('buy-voucher') ?>" class="text--white">Vouchere cadou</a>
													</li>
													<li class="<?= ($_section == "agencies" ? "active" : "") ?>">
														<a href="<?= route('agencies') ?>" class="text--white hover-opacity">Contact</a>
													</li>
												</ul>
											</div>
											<div class="modal-footer">
												<ul class="call-center--list list-unstyled text-center">
													<li class="margin--bottom-0 text-uppercase text--white"><strong>Call center</strong></li>
													<li><a class="text--white" href="tel:+40374454545">0374 45 45 45</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- END Menu Modal -->
								<div class="hidden-xs hidden-sm">
									<ul class="nav navbar-nav navbar-nav-paralela45 navbar-desktop">
										<li class="<?= ($_section == "home" ? "active" : "") ?>">
											<a href="<?= $_base ?>"><i class="sprite sprite-home"></i></a>
										</li>
										<li class="<?= ($_section == "charters" ? "active" : "") ?> dropdown">
											<?/*<a href="<?= route('charters-home') ?>" class="">Pachete de vacanta</a>*/?>
											<a href="<?= route('charters-home') ?>" class="dropdown-toggle text--white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pachete de vacanta</a>
											<?php
											//@andrei: include dropdown menu Pachete de vacanta doar daca exista destintatii
											if($_destinations_from) { include('dd_pachete_vacante.php'); }
											?>
										</li>
										<? /*
                                        <li class="<?= ($_page == "lp" && $_item['id_lp'] == 24 ? "active" : "") ?>">
										<a href="<?= $_base ?>vacante-iarna/" class="" style="background-color:#ea4200;">Iarna 2020</a>
										</li>
										*/ ?>
										<li class="marked <?= ($_page == "lp" && $_item['id_lp'] == 23 ? "active" : "") ?>">
											<a href="<?= $_base ?>vacante-exotice/">Exotice</a>
										</li>
										<li class="<?= ($_section == "circuits" ? "active" : "") ?>">
											<a href="<?= route('circuits-home') ?>">Circuite</a>
										</li>
										<li class="<?= ($_section == "tourism" ? "active" : "") ?>">
											<!--dropdown-->
											<a href="<?= route('tourism-home') ?>">Turism individual</a>
											<? /*
											<a href="<?= route('tourism-home') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Turism individual <i class="sprite sprite-down"></i></a>
											<ul class="dropdown-menu">
												<li><a href="#">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
											</ul>
											*/ ?>
										</li>
										<li class="<?= ($_section == "tourism-ro" ? "active" : "") ?>">
											<a href="<?= route('tourism-ro-home') ?>">Turism intern</a>
										</li>
										<li class="<?= ($_page == "tourism" && $_params['city'] == "orase" ? "active" : "") ?>">
											<a href="<?= $_base ?>sejururi/orase/" class="">Orase</a>
										</li>
										<li class="<?= ($_section == "cruises" ? "active" : "") ?>">
											<a href="<?= route('cruises-home') ?>" class="">Croaziere</a>
										</li>
										<? /*
                                        <li class="<?= ($_page == "lp" && $_item['id_lp'] == 23 ? "active" : "") ?>">
										<a href="<?= $_base ?>vacante-exotice/" class="">
											<!--<span style="color:#ea4200"><b>NOU!</b></span>-->
											Exotice
										</a>
										</li>
										*/ ?>
										<li class="<?= ($_section == "planes" ? "active" : "") ?> marked">
											<a href="<?= route('tickets') ?>">Bilete avion</a>
										</li>
										<li class="<?= ($_page == "buy-voucher" ? "active" : "") ?>">
											<a href="<?= route('buy-voucher') ?>">Vouchere cadou</a>
										</li>
										<li class="<?= ($_section == "agencies" ? "active" : "") ?>">
											<a href="<?= route('agencies') ?>">Contact</a>
										</li>
									</ul>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<script>
	//@andrei: keep dropdown menu open on city link click
	jQuery('.dropdown').on('hide.bs.dropdown', function(e) {
		e.preventDefault();
	});
</script>