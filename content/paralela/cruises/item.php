<main>
	<!-- <div class="container-fluid inner-banner">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper">
					<img class="img-banner__img object-fit" src="<?=$_base?>static/img/header_croaziere.jpg" alt="<?=$_text['title']?>">
				</div>
				<div class="row">
					<div class="container">
						<div class="row">
							<?php //include $_theme_path.'common/forms/home_forms.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="container-fluid">
		<div class="row">
			<div class="container mt-25">
				<div class="row margin--top-25 item__title__wrapper item--flex1">
					<div class="col-sm-4 col-sm-push-8 item__back__wrapper">
						<a class="item__back" href="javascript:history.go(-1);">&lt; Inapoi la cautare</a>
					</div>
					<div class="col-sm-8 col-sm-pull-4">
						<div class="row item--flex2">
							<div class="col-xs-12">
								<? foreach($_item['dates'] as $x => $date){
									$year = $x;
									break;
								}
								?>
								<h1 class="item__title">
									Croaziere <?= $year ?>
									<span class="text--light-blue">•</span> <?=$_item['departure']['title']?>/<?= $_item['destination']['title'] ?>
								</h1>
								<p class="item__sub">
									<span class="">
										<?php  if($_item['plane_included'] == 1){ ?>
											<i class="sprite sprite-calendar-avion-blue"></i>
										<? } ?>
										<i class="sprite items__item__cruisesicon"></i>
									</span>
									<span><?=$_item['line']['title']?> • <?=$_item['ship']['title']?> • <?=$_item['nights'] ?> nopti</span>
								</p>
								<?/*
								<p class="hidden-md hidden-lg">
									<?php  if($_item['plane_included'] == 1){ ?>
									<i class="sprite sprite-calendar-avion-blue"></i>
									<? } ?>
									<i class="sprite items__item__cruisesicon"></i>
								</p>
								*/?>
							</div>
						</div>
					</div>
				</div>
				<div class="row item__info__wrapper">
					<div class="col-md-9">
						<div class="swiper-container swiper-item__main">
							<div class="swiper-wrapper">
								<?  foreach($_item['images'] as $img){  ?>
									<div class="swiper-slide"><img class="swiper-item__main__img object-fit" src="<?= $img['large'] ?>" alt="<?=$_item['line']['title']?>"></div>
								<? } ?>
							</div>
							<div class="swiper-button-next hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
							<div class="swiper-button-prev hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
						</div>
						<div class="swiper-item__thumbs hidden-xs">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?  foreach($_item['images'] as $img){  ?>
										<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?= $img['thumb'] ?>" alt="<?=$_item['line']['title']?>"></div>
									<? } ?>
								</div>
							</div>
							<div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
							<div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
						</div>
					</div>
					<div class="col-md-3 item__info">
						<div class="row">
							<div class="col-ms-6 col-sm-5 col-md-12 item__info--align">
								<? if($_item['promo'] && $_item['price_promo']){?>
									<p class="items__item__del">de la <del><?=$_item['price']?> <?=$_item['currency']?></del></p>
									<p class="items__item__price"><?=$_item['price_promo']?> <?=$_item['currency']?></p>
								<? }else{ ?>
									<p class="items__item__del">de la</p>
							 		<p class="items__item__price"><?=$_item['price']?> <?=$_item['currency']?></p>
							 	<? }?>
								<div class="clearfix">
									<span class="item__info__pers">/ persoana</span>
								</div>
								<p class="item__info__date">&nbsp;</p>
								<ul class="item__info__hotel list-unstyled list-inline">
									<!-- <li><i class="sprite sprite-hotel-last-minute-l"></i></li>
									<li><i class="sprite sprite-hotel-smart-l"></i></li>
									<li><i class="sprite sprite-hotel-early-booking-l"></i></li> -->
									<? if($_item['discount']) { ?>
										<li class="item__info__hotel__discount"><i class="sprite sprite-hotel-discount-l"></i> <span>-<?= round($_item['discount']) ?>%</span></li>
									<? } ?>
								</ul>
								<a id="item__480__btn" class="btn btn-block btn--green item__info__btn" href="#rezervation_form">SOLICITA OFERTA</a>
							</div>
							<div id="item__480__block" class="col-ms-6 col-sm-5 col-sm-offset-2 col-md-12 col-md-offset-0 item__info--space">
								<p class="item__info__croaziere__title pchicl"><strong>Detalii croaziera</strong></p>
								<ul class="list-unstyled item__info__croaziere">
									<li><i class="sprite sprite-croaziere-pin-s"></i> <span>Plecare din:</span> <?=$_item['departure']['title']?></li>
									<li><i class="sprite sprite-croaziere-boat-s"></i> <span>Vas:</span> <?=$_item['ship']['title']?></li>
									<li>
										<div class="media">
											<div class="media-left">
												<i class="sprite sprite-croaziere-port-s"></i>
											</div>
											<div class="media-body">
												<span>Porturi:</span> <?=implode(' - ', $_item['ports'])?>
											</div>
										</div>
									</li>
									<? if($_item['dates']){?>
                						<? foreach($_item['dates'] as $year => $dates){?>
											<li><i class="sprite sprite-croaziere-calendar-s"></i> <span>Plecari in <?=$year?>:</span> </span> <?=implode(', ', $dates)?></li>
										<?php } ?>
									<?php } ?>
									<?php if($_item['plane_included'] == 1){ ?>
										<li><i class="sprite sprite-croaziere-plane-s"></i> <span>Zbor inclus </li>
									<?php } ?>
								</ul>
								<img class="items__item__croaziere__company__img" src="<?= $_item['logo'] ?>" alt="...">
							</div>
							<div class="col-xs-12 hidden-xs hidden-sm">
								<hr class="item__info__hr">
							</div>
						</div>
						<div class="clearfix">
							<div class="addthis_inline_share_toolbox text-center"></div>
						</div>
						<div class="row">
							<?
							if(is_logged_in()){
								$whish_exist = check_if_offer_is_in_whishlist($_loggedin_user['id_user'], $_item['id_cruise'], 'cruise', 0);
							}
							?>
							<button class="btn btn-block item__info__whishlist <?=$whish_exist ? "saved" : ""?>" id="whishlist" onclick="<? if(is_logged_in()){?>saveToWishlist('cruise', <?=$_item['id_cruise']?>, 0);<? }else{?>location.href='<?=route('login')?>?whish';<? }?>">
								<i class="zmdi zmdi-favorite-outline"></i>
								<p class="ptwsh">
									Salv<?=$whish_exist ? "at" : "eaza"?> in whishlist
								</p>
							</button>
							<!-- butoane -->
							<button class="btn btn-block item__info__print hidden-xxs">
								[<i class="sprite sprite-print-small"></i>
								<p>Printeaza oferta</p>]
							</button>
							<button class="btn btn-block item__info__print">
								[<i class="sprite sprite-mail-small"></i>
								<p>Trimite hotelul pe email</p>]
							</button>
							<button class="btn btn-block item__info__print">
								[<i class="sprite sprite-fb-small"></i>
								<p>Distribuie pe facebook</p>]
							</button>
							<!-- end butoane -->
						</div>
						<!--
						<a href="<?= $_base ?>uploads/files/cruises/<?=$_item['trip_conditions']?>" target="_blank" class="btn btn-block item__info__download hidden"><i class="sprite sprite-download"></i> <span>Conditii calatorie</span></a>
						-->
					</div>
				</div>
				<div class="row item-tabs">
					<div class="col-xs-12">
						<div class="row no-pad">
							<div class="col-xs-12 col-md-3">
								<ul id="nav-tabs" class="nav nav-tabs hidden-xs hidden-sm">
									<li class="active"><a href="#formular-rezervare" data-toggle="tab">Formular cerere oferta</a></li>
									<li><a href="#descriere" data-toggle="tab">Descriere</a></li>
									<li><a href="#porturi" data-toggle="tab">Porturi</a></li>
									<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
									<li><a class="detalii-nava" href="#detalii-nava" data-toggle="tab">Detalii nava</a></li>
									<? if($_item['optional']){ ?>
										<li><a href="#excursii" data-toggle="tab">Excursii optionale</a></li>
									<? } ?>
									<li><a href="#anulare" data-toggle="tab">Conditii anulare</a></li>
									<!--
									<li class="--line-height"><a href="#orar" data-toggle="tab">Orar de zbor (informativ)</a></li>
									<li class=""><a href="#informatii" data-toggle="tab">Informatii importante</a></li>
									-->
								</ul>
								<div class="dropdown hidden-md hidden-lg">
									<button class="btn btn-block item-tabs__btn clearfix" type="button" id="item-tabs__btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="item-tabs__btn__text">Formular cerere oferta</span>
										<span class="item-tabs__btn__sprite"><i class="sprite sprite-panel-down position-center"></i></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="item-tabs__btn">
										<li class="active"><a href="#formular-rezervare" data-toggle="tab">Formular cerere oferta</a></li>
										<li><a href="#descriere" data-toggle="tab">Descriere</a></li>
										<li><a href="#porturi" data-toggle="tab">Porturi</a></li>
										<li><a href="#servicii" data-toggle="tab">Servicii incluse/neincluse</a></li>
										<li><a href="#detalii-nava" data-toggle="tab">Detalii nava</a></li>
										<? if($_item['optional']){ ?>
											<li><a href="#excursii" data-toggle="tab">Excursii optionale</a></li>
										<? }?>
										<li><a href="#anulare" data-toggle="tab">Conditii anulare</a></li>
										<!--
										<li><a href="#orar" data-toggle="tab">Orar de zbor (informativ)</a></li>
										<li><a href="#informatii">Informatii importante</a></li>
										-->
									</ul>
								</div>
							</div>
							<div class="col-xs-12 col-md-9">
								<div class="tab-content">
									<div class="tab-pane print-visible active" id="formular-rezervare">
										<div class="row item-formular print-hidden">
											<? if($_valid && isset($_POST['submit'])){?>
												<div class="section-header" id="reservation_form">
											        <small class="subtitle"><? _e('Va multumim pentru mesaj. Un operator paralela45.ro va va contacta in curand.')?></small>
											    </div>
											    <br><br><br>
										    <? }else{ ?>

												<form action="#rezervation_form" method="post" >
													<div class="col-md-4">
														<div class="form-group"> <!-- has-error -->
															<label class="control-label item-formular__label__text" for="rezervare-nume">Nume si prenume</label>
															<input class="form-control" id="rezervare-nume" type="text" name="name" value="<?=$_form['name']?>">
															<span class="help-block hidden">Necesar</span>
															<? if($_errors['name'] != ""){?>
											            		<span class="error"><?=$_errors['name']?></span>
											            	<? }?>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group"> <!-- has-error -->
															<label class="control-label item-formular__label__text" for="rezervare-telefon">Numar de telefon</label>
															<input class="form-control" id="rezervare-telefon" type="text" name="phone" value="<?=$_form['phone']?>">
															<span class="help-block hidden">Necesar</span>
															<? if($_errors['phone'] != ""){?>
											            		<span class="error"><?=$_errors['phone']?></span>
											            	<? }?>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group"> <!-- has-error -->
															<label class="control-label item-formular__label__text" for="rezervare-email">Adresa de email</label>
															<input class="form-control" id="rezervare-email" type="text" name="email" value="<?=$_form['email']?>">
															<span class="help-block hidden">Necesar</span>
															<? if($_errors['email'] != ""){?>
											            		<span class="error"><?=$_errors['email']?></span>
											            	<? }?>
														</div>
													</div>
													<div class="col-md-6">
														<div class="row">
															<div class="col-sm-6">
																<div class="form-group"> <!-- has-error -->
																	<label class="control-label item-formular__label__text" for="rezervare-adulti">Numar adulti</label>
																	<input class="form-control" id="rezervare-adulti" type="number" name="passengers" value="<?=$_form['passengers']?>">
																	<span class="help-block hidden">Necesar</span>
																	<? if($_errors['passengers'] != ""){?>
													            		<span class="error"><?=$_errors['passengers']?></span>
													            	<? }?>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group"> <!-- has-error -->
																	<label class="control-label item-formular__label__text" for="rezervare-copii">Numar copii</label>
																	<input class="form-control" id="rezervare-copii" type="number" name="children" value="<?=$_form['children']?>">
																	<span class="help-block hidden">Necesar</span>
																	<? if($_errors['children'] != ""){?>
													            		<span class="error"><?=$_errors['children']?></span>
													            	<? }?>
																</div>
															</div>
														</div>
														<div class="row">
															<? if($_item['rooms']){?>
															<div class="col-sm-6">
																<label class="item-formular__label">
																	<span class="item-formular__label__text">Tip cabina</span>
																	<select name="room" class="select__s2" style="width: 100%;">
																		<? foreach($_item['rooms'] as $room){?>
									                            		<option value="<?=$room['title']?>" <? if($_form['room'] == $room['title']) echo "selected"?>><?=$room['title']?></option>
									                            	<? }?>
																	</select>
																</label>
																<? if($_errors['room'] != ""){?>
												            		<span class="error"><?=$_errors['room']?></span>
												            	<? }?>
															</div>
															<? }?>

															<div class="col-sm-6">
																<label class="item-formular__label">
																	<span class="item-formular__label__text">Data imbarcare</span>
																	<select name="date" class="select__s2" style="width: 100%;">
																		<? foreach($_item['dates'] as $year => $dates){?>
									                            		<? foreach($dates as $date){?>
									                            			<option value="<?=$date?> <?=$year?>" <? if($_form['date'] == $date." ".$year) echo "selected"?>><?=$date?> <?=$year?></option>
									                            		<? }?>
									                            	<? }?>
																	</select>
																</label>
																<? if($_errors['date'] != ""){?>
												            		<span class="error"><?=$_errors['date']?></span>
												            	<? }?>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<span class="item-formular__label__text">Mesaj</span>
														<textarea class="form-control" rows="5" name="message"><?=$_form['message']?></textarea>
														<? if($_errors['message'] != ""){?>
										            		<span class="error"><?=$_errors['message']?></span>
										            	<? }?>
													</div>
													<div class="col-sm-7 col-md-8">
														<div class="checkbox item-rezervare__info__detalii__checkbox">
															<input id="informari-oferte" value="1" type="checkbox" name="newsletter">
															<label for="informari-oferte">Sunt de acord sa primesc prin email informari cu privire la oferte speciale, concursuri si gratuitati oferite de Paralela 45.</label>
														</div>
														<div class="checkbox item-rezervare__info__detalii__checkbox">
															<input id="acord-termeni" value="1" type="checkbox" name="terms" >
															<label for="acord-termeni">Am citit si sunt de acord cu <a href="<?= route('terms') ?>" target="_blank">Termeni si conditii</a></label>
															<? if($_errors['terms'] != ""){?>
											            		<span class="error"><?=$_errors['terms']?></span>
											            	<? } ?>
														</div>
							                            <div class="checkbox item-rezervare__info__detalii__checkbox">
															<input id="gdpr" value="1" type="checkbox" name="gdpr" >
															<label for="gdpr">Sunt de acord ca datele mele cu caracter personal sa fie folosite in scopul desfasurarii vacantei rezervate. Aceste date pot fi transmise si partenerilor nostri: hotelieri externi si interni, companii aeriene, transportatori si alti furnizori de servicii turistice comandate. Datele tale sunt in siguranta si stocate in mod criptat.</label>
															<? if($_errors['gdpr'] != ""){?>
											            		<span class="error"><?=$_errors['gdpr']?></span>
											            	<? } ?>
														</div>
														<div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
														<? if($_errors['g-recaptcha-response'] != ""){?>
										            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
										            	<? } ?>
														<!--
														<p class="item-formular__captcha__text">Completati casuta cu caracterele din imagine</p>
														<img class="item-formular__captcha__img" src="<?=$_base?>lib/classes/validation/captcha.php?id=reservation&rnd=<?=mt_rand(10,100)?>&width=100&height=37&characters=6&bg=f6f6f6&text=4a4a4a&noise=cccccc" width="100" height="37" />
														<div class="form-inline pull-left">
															<div class="form-group">
																<input type="text" name="captcha" class="form-control <? if($_errors['captcha'] != ""){?>cap-error<? }?>" id="captcha">
																<? if($_errors['captcha'] != ""){?>
												            		<span class="error"><?=$_errors['captcha']?></span>
												            	<? } ?>
															</div>
														</div>
														-->
													</div>
													<div class="col-sm-5 col-md-4">
														<button class="btn btn-block btn--green item-formular__btn" type="submit" name="submit">Trimite solicitarea</button>
													</div>
												</form>
											<? } ?>
										</div>
									</div>
									<div class="tab-pane print-visible" id="descriere">
									    <!-- <div class="col-md-12 print-visible"><p class="tab-title">Descriere</p></div> -->
										<p>Tarifele pornesc de la <?=($_item['promo'] && $_item['price_promo'] ? $_item['price_promo'] : $_item['price'])?> <?=$_item['currency']?> de persoana in cabina dubla interioara.<br> Oferta valabila in limita disponibilitatilor. Pentru detalii si rezervari va rugam contactati echipa paralela45.ro </p>
									</div>
									<div class="tab-pane" id="porturi">
										<div class="row">
										    <!-- <div class="col-md-12 print-visible"><p class="tab-title">Porturi</p></div> -->

											<div class="col-md-12">
												<ul class="list-unstyled item__info__porturi">
													<li class="hidden-xxs">
														<ul class="list-unstyled item__info__porturi__list item__info__porturi__list__title">
															<li>Ziua</li>
															<li>Portul</li>
															<li>Sosire</li>
															<li>Plecare</li>
														</ul>
													</li>
													<? foreach($_item['itinerary_list'] as $it){ ?>
														<li>
															<ul class="list-unstyled item__info__porturi__list">
																<li><span class="visible-xxs-inline-block">Ziua</span> <?=$it['day']?></li>
																<li><span class="visible-xxs-inline-block">Portul:</span> <?=$it['title']?></li>
																<li><span class="visible-xxs-inline-block">Sosire:</span> <?= ($it['from_hour'] != '' ? $it['from_hour'] : '-:-' ) ?></li>
																<li><span class="visible-xxs-inline-block">Plecare:</span> <?= ($it['till_hour'] != '' ? $it['till_hour'] : '-:-' ) ?></li>
															</ul>
														</li>
													<? }?>
												</ul>
											</div>
											<div class="col-md-4">
												<? if($_item['itinerary_image']){?>
							       					<img class="img-responsive item__info__porturi__img" src="<?=$_item['itinerary_image']?>" alt="Itinerariu" >
							       				<? }?>
											</div>
										</div>
									</div>

									<div class="tab-pane print-visible" id="servicii">
									    <!-- <div class="col-md-12 print-visible"><p class="tab-title">Servicii</p></div> -->
										<p class="text-uppercase"><strong>SERVICII INCLUSE:</strong></p>
										<?= $_item['included'] ?>
										<br>
										<p class="text-uppercase"><strong>NU SUNT INCLUSE:</strong></p>
										<?= $_item['not_included'] ?>
									</div>
									<div class="tab-pane item__info__det-nava" id="detalii-nava">

										<div class="row">
											<div class="col-sm-4 col-ms-5 col-md-4 col-lg-3">
												<img class="item__info__det-nava__logo" src="<?= $_item['logo'] ?>" alt="<?=$_item['line']['title']?>">
											</div>
											<div class="col-sm-6 col-sm-offset-2 col-ms-6 col-ms-offset-1 col-md-4 col-md-offset-4 col-lg-9 col-lg-offset-0">
												<a href="<?= $_base ?>uploads/files/cruises/<?= $_item['ship']['pdf']?>" target="_blank" class="btn btn-block item__info__download"><i class="sprite sprite-download"></i> <span>Planul puntilor detaliat (.PDF)</span></a>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-12">
												<p class="item__info__det-nava__title"><strong><?=$_item['ship']['title']?></strong></p>
												<?=$_item['ship']['description']?>
											</div>
										</div>
										<div class="row">
											<div class="col-ms-6 col-sm-6">
												<dl class="dl-horizontal item__info__det-nava__dl-p">
													<dt><i class="sprite sprite-nava-greutate"></i> Greutate</dt>
													<dd><?= $_item['ship']['weight']?> tone</dd>
													<dt><i class="sprite sprite-nava-capacitate"></i> Capacitate</dt>
													<dd><?= $_item['ship']['capacity']?> pasageri</dd>
													<dt><i class="sprite sprite-nava-lungime"></i> Lungime</dt>
													<dd><?= $_item['ship']['length']?> m</dd>
													<dt><i class="sprite sprite-nava-latime"></i> Latime</dt>
													<dd><?= $_item['ship']['width']?> m</dd>
												</dl>
											</div>
											<div class="col-ms-6 col-sm-6">
												<dl class="dl-horizontal item__info__det-nava__dl-p">
													<dt><i class="sprite sprite-nava-an"></i> An constructie</dt>
													<dd><?= $_item['ship']['year']?></dd>
													<dt><i class="sprite sprite-nava-echipaj"></i> Echipaj</dt>
													<dd><?= $_item['ship']['crew']?> persoane</dd>
													<dt><i class="sprite sprite-nava-constructor"></i> Constructor</dt>
													<dd><?= $_item['ship']['constructor'] ?>, <?= $_item['ship']['registered']?></dd>
													<dt><i class="sprite sprite-nava-viteza"></i> Viteza</dt>
													<dd><?= $_item['ship']['speed']?> noduri</dd>
												</dl>
											</div>
										</div>
										<div class="row margin--top-25 margin--bottom-50">
											<div class="col-ms-6 col-sm-6">
												<dl class="dl-horizontal item__info__det-nava__dl-s">
													<? $i=1; foreach($_specs as $key => $val){?>
											        <? if($_item['ship'][$key] != ""){?>
														<dt><?=$val?>:</dt>
														<dd><?=$_item['ship'][$key]?></dd>
													<? }?>
													<? if($i == 6){?>
												</dl>
											</div>
											<div class="col-ms-6 col-sm-6">
												<dl class="dl-horizontal item__info__det-nava__dl-s">
													<? }?>
														<? $i++;}?>
												</dl>
											</div>
											<!--
											<div class="col-xs-12 col-md-4">
												<div class="embed-responsive embed-responsive-4by3">
													<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/0XgpYXVN-Kk?rel=0&amp;showinfo=0"></iframe>
												</div>
											</div>
											-->
										</div>
										<div class="row">
											<div class="col-ms-4 col-sm-4 col-ms-push-8 col-sm-push-8">
												<select id="item__info__puntea__select" style="width: 100%;">
													<option></option>
													<? foreach($_item['ship']['decks'] as $dk){?>
														<option  value="<?= strtolower(str_replace(" ", "-", $dk['title'])) ?>"><?=$dk['title']?></option>
													<? }?>
												</select>
											</div>
										</div>
										<div class="row mt-20">
											<div class="col-md-2">
												<?php $x=0; foreach($decks as $deck){  ?>
													<? if($deck['image']){?>
														<img id="<?= strtolower(str_replace(" ", "-", $deck['title'])) ?>" class="<?= ($x!=0?'hidden':'') ?> deck-articles center-block item__info__puntea__img zoom-image" src="<?= $deck['image'] ?>" alt="<?=$deck['title']?>" data-zoom-image="<?= str_replace("medium-", "", $deck['image']) ?>">
													<?php }
													$x++;
												}?>
											</div>
											<div class="col-md-10">
												<div class="row">
													<div class="col-xs-12">
														<?php $i=0; foreach($decks as $deck){?>
															<div id="<?= strtolower(str_replace(" ", "-", $deck['title'])) ?>" class="<?= ($i!=0?'hidden':'') ?> deck-articles">
																<h3 class="item__info__puntea__title"><?=$deck['title']?></h3>

																<p class="item__info__puntea__sub"><?=$deck['description']?></p>

																<? if($deck['cabins']){?>
																	<ul class="media-list item__info__puntea__list">
																		<? foreach($deck['cabins'] as $cabin){ ?>
																		<li class="media">
																			<? if($cabin['images']){?>
																			<div class="media-body">
																				<h4 class="media-heading"><?=$cabin['title']?></h4>
																				<p>
																					<!--
																						<span class="item__info__puntea__color hidden" style="background-color: maroon"></span>
																					-->
																					<?=$cabin['description']?>
																				</p>
																			</div>
																			<div class="media-left">
																				<a href="<?=$cabin['big']?>" class="fancybox" rel="cabin">
																					<img class="media-object center-block lazy-punte lazy" data-original="<?=$cabin['images'][0]['thumb']?>"  alt="<?=$cabin['title']?>" />
																				</a>
																			</div>
																			<? }?>
																		</li>
																		<?php } ?>
																	</ul>
																<?php } ?>
															</div>

														<?php $i++; } ?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="tab-pane print-visible" id="excursii">
									    <div class="col-md-12 print-visible"><p class="tab-title">Excursii</p></div>
										<hr class="hr--blue print-hidden">
										<div class="row item__info__excursii">
											<? foreach($_item['optional'] as $exc){  ?>
												<div class="col-ms-6 col-sm-6 col-md-4 item__info__excursii__item">
													<a href="#"><img class="center-block img-responsive" src="<?= $_base ?>uploads/images/cruises/<?=$exc['image']?>" alt="<?=$exc['title']?>"></a>
													<p class="item__info__excursii__item__title"><a href="#"><?=$exc['title']?></a></p>
													<p class="item__info__excursii__item__desc"><?=$exc['description']?></p>
													<? if($exc['pdf']){?>
														<p class="text-center"><a class="btn item__info__download" href="<?= $_base ?>uploads/files/cruises/<?=$exc['pdf']?>" target="_blank" ><i class="sprite sprite-download"></i> <span>Vezi toate detaliile</span></a></p>
													<? } ?>
												</div>
											<? } ?>
										</div>
									</div>

									<div class="tab-pane print-visible" id="anulare">
									    <div class="col-md-12 print-visible"><p class="tab-title">Conditii de anulare</p></div>
										<?=$_item['cancelation']?>
									</div>

									<!--
									<div class="tab-pane" id="orar">
										<hr class="hr--blue">
										<p><strong>ORAR INFORMATIV DE ZBOR ( ore locale) </strong></p>
										<p>Plecari in perioada:	29.06 - 31.08.2016</p>
										<ul class="list-unstyled">
											<li class="item-itinerariu__list__flights">
												<ul class="list-unstyled list-inline">
													<li><i class="sprite sprite-arrow-blue-right"></i></li>
													<li>Bucuresti (Otopeni)</li>
													<li>10:15</li>
													<li>– Roma (Fiumicino)</li>
													<li>12:05</li>
												</ul>
											</li>
											<li class="item-itinerariu__list__flights">
												<ul class="list-unstyled list-inline">
													<li><i class="sprite sprite-arrow-blue-left"></i></li>
													<li>Roma (Fiumicino)</li>
													<li>10:15</li>
													<li>– Bucuresti (Otopeni)</li>
													<li>12:05</li>
												</ul>
											</li>
										</ul>
									</div>

									<div class="tab-pane" id="informatii">
										<hr class="hr--blue">
										<p><strong>GRUP MINIM</strong>: 25 persoane.</p>
										<p>Supliment 21-24 persoane: 30 euro/persoana.</p>
										<hr class="hr--blue">
										<p><strong>GTERMEN LIMITA DE INSCRIERE</strong>:</p>
										<p>4 saptamani inaintea datei de plecare.</p>
										<hr class="hr--blue">
										<p class="text-uppercase"><strong>Observatii:</strong></p>
										<div class="row">
											<div class="col-md-6">
												<ul class="list-unstyled">
													<li><span class="text--blue">›</span> Pentru infanti (0 – 1,99 ani) nu se achita taxele de aeroport</li>
													<li><span class="text--blue">›</span> Clasificarea pe stele a hotelurilor din oferta este cea atribuita oficial de autoritatile de resort din Grecia.	 Aceste standarde sunt specifice pentru Grecia si nu corespund sau nu pot fi echivalate cu standardele din alte tari. Facilitatile comune si cele ale camerelor sunt conforme cu standardele locale</li>
													<li><span class="text--blue">›</span> Descrierile hotelurilor cuprinse in acest material sunt valabile la data publicarii ofertei; in consecinta, agentia nu poate fi facuta raspunzatoare pentru eventualele neconcordante in privinta facilitatilor hotelului sau ale camerei. <br>Distributia camerelor la hoteluri se face de catre receptiile acestora; problemele legate de amplasarea sau aspectul camerei se rezolva de catre turist direct la receptia hotelului, asistat de reprezentantul local al agentiei	 </li>
													<li><span class="text--blue">›</span> Pentru anumite facilitati din hotel sau din camera, hotelierul poate solicita taxe suplimentare (minibar/frigider, seif, prosoape la plaja, aer conditionat etc.); in momentul sosirii la hotel solicitati receptionerului sa va informeze cu exactitate asupra lor </li>
													<li><span class="text--blue">›</span> Agentia nu este raspunzatoare pentru modificarile orarului de zbor sau pentru intarzieri, acestea fiind in responsabilitatea companiei aeriene si a autoritatilor aeroportuare. Datorita faptului ca zborul este de tip charter, acesta nu se supune regulilor impuse curselor de linie. <br>Agentia isi rezerva dreptul de a modifica suma aferenta taxelor de aeroport, in situatia in care aceasta masura este impusa de compania aeriana.</li>
												</ul>
											</div>
											<div class="col-md-6">
												<ul class="list-unstyled">
													<li><span class="text--blue">›</span> Agentia nu este raspunzatoare pentru eventualele modificari ale orarului de zbor.</li>
													<li><span class="text--blue">›</span> In situatia de suprarezervare (overbooking) a unui hotel, determinata de activitatea hotelierilor, inainte sau dupa inceperea calatoriei, agentia este obligata sa ofere o alta varianta de hotel in aceeasi zona sau intr-o zona cat mai apropiata, la aceeasi categorie sau de o categorie superioara fara sa modifice pretul.</li>
													<li><span class="text--blue">›</span> Excursiile optionale se efectueaza la fata locului cu agentia locale. Sumele aferente acestor excursii nu se incaseaza in numele si pentru Agentia Paralela 45. Preturile excursiilor optionale pot fi mai mari decat cele ale excursiilor ce pot fi achizitionate de la receptia hotelurilor, aceasta datorandu-se faptului ca persoanele participante vor avea la dispozitie un mijloc de transport care ii va duce si ii va aduce la hotelul respectiv, ghidul excursiei si dupa caz ghid local.</li>
													<li><span class="text--blue">›</span> Agentia nu raspunde in cazul refuzului autoritatilor de la punctele de frontiera de a primi turistul pe teritoriul propriu sau de a-i permite sa paraseasca teritoriul propriu.</li>
													<li><span class="text--blue">›</span> Prezentul document constituie anexa la contractul de prestari servicii.</li>
												</ul>
											</div>
										</div>
									</div>
									-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<a href="#" class="go-ontop">Inapoi sus <span><i class="zmdi zmdi-chevron-up"></i></span></a>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?/*<? include $_theme_path.'common/boxes/box_testimonials.php' ?>*/?>
	<?/*<? include $_theme_path.'common/boxes/box_new_offers.php' ?>*/?>
	<? include $_theme_path.'common/boxes/box_avantaje.php' ?>
</main>
