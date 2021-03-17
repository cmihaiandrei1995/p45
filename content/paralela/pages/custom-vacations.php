
<main>
	<div class="container-fluid inner-banner inner-banner-vd inner-banner-vdws">
		<div class="row">
			<div class="col-xs-12">
				<div class="row img-banner__img__wrapper w-svdw">
						<div class="black-layer"></div>
					<img class="img-banner__img object-fit" src="<?= $_base ?>static/img/custom-vacations-banner.jpg" alt="...">
				</div>
				<!-- intro pagina -->
				<div class="row">
					<div class="container search-vd-wrapper svdw">
						<div class="col-md-12">
							<p class="l01">[Bucura-te de cele mai frumoase destinatii!]</p>
							<p class="l02">[Creaza-ti urmatoarea vacanta impreuna cu noi]</p>
						</div>
					</div>
				</div>
				<!-- end intro pagina -->
			</div>
		</div>
	</div>

	<!-- sugestii -->
	<div class="container-fluid vd-categories">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-8 col-lg-offset-2 hr-title wisub">
						<h3 class="hr-title__text text--blue">
							[Increde-te in experienta noastra[]<br>
							<span class="upper">[DESCOPERA LUMEA!]</span>
						</h3><br>
						<p class="inner-page-subtitle">[Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.]</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-ms-6 col-sm-6">
						<a class="master-destination" href="">
							<div class="destination">
								[exotice]
							</div>
							<div class="blue-cover light-blue-cover"></div>
							<img class="" src="<?= $_base ?>static/img/exp01.jpg">
						</a>
					</div>
					<div class="col-md-4 col-ms-6 col-sm-6">
						<a class="master-destination" href="">
							<div class="destination">
								[aventura]
							</div>
							<div class="blue-cover light-blue-cover"></div>
							<img class="" src="<?= $_base ?>static/img/exp01.jpg">
						</a>
					</div>
					<div class="col-md-4 col-ms-6 col-sm-6">
						<a class="master-destination" href="">
							<div class="destination">
								[cu familia]
							</div>
							<div class="blue-cover light-blue-cover"></div>
							<img class="" src="<?= $_base ?>static/img/exp01.jpg">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end sugestii -->

	<!-- top destinatii -->
	<div class="top-destinations">
		<div class="container-fluid">
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-lg-8 col-lg-offset-2 hr-title wisub">
							<h3 class="hr-title__text text--blue">
								<span class="upper">[TOP 10 DESTINATII]</span>
							</h3><br>
							<p class="inner-page-subtitle">[Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.]</p>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="swiper-container swiper-top-destinations">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<a class="" href="">
											<div class="destination">
												[]#1<br>
												MALDIVE]
											</div>
											<div class="blue-cover"></div>
											<img class="" src="<?= $_base ?>static/img/topdest-01.jpg">
										</a>
									</div>
									<div class="swiper-slide">
										<a class="" href="">
											<div class="destination">
												[]#2<br>
												BALI]
											</div>
											<div class="blue-cover"></div>
											<img class="" src="<?= $_base ?>static/img/topdest-01.jpg">
										</a>
									</div>
									<div class="swiper-slide">
										<a class="" href="">
											<div class="destination">
												[]#3<br>
												ZANZIBAR]
											</div>
											<div class="blue-cover"></div>
											<img class="" src="<?= $_base ?>static/img/topdest-01.jpg">
										</a>
									</div>
									<div class="swiper-slide">
										<a class="" href="">
											<div class="destination">
												[#4<br>
												KENYA]
											</div>
											<div class="blue-cover"></div>
											<img class="" src="<?= $_base ?>static/img/topdest-01.jpg">
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-button-prev"><i class="swiper-circuit-prev hidden-xs"></i></div>
							<div class="swiper-button-next"><i class="swiper-circuit-next hidden-xs"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end top destinatii -->

	<div class="container-fluid vd-categories puzzle-masonry">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-lg-8 col-lg-offset-2 hr-title wisub">
						<h3 class="hr-title__text text--blue">
							[Unde vrei sa mergi? Alege o vacanta pe gustul tau!]
						</h3><br>
						<p class="inner-page-subtitle">[Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.]</p>
					</div>
				</div>

				<!-- listare noua -->
				<? if($_vacations){ ?>
					<div class="row half-gutters">
						<?/*<? foreach($_vacations as $item){ $class= explode(" ", $item['title']) ?>*/?>
						<div class="col-ms-6 col-sm-6">
							<div class="row">
								<div class="col-xs-12 tall">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
											<p>[Iubesti destinatiile exotice sau visezi la un tip de vacanta exclusivist care sa sparga monotonia sejururilor traditionale? Consultantii de turism Paralela 45 iti pot oferi #experientedeneuitat in zeci de destinatii si tari, de pe toate continentele.<br>
											Te invitam sa calatoresti in siguranta alaturi de cei dragi, in cele mai atractive locuri din lume. Fie ca alegi decorurile exotice ale plajelor ireal de frumoase din Oceanul Indian, ineditul Asiei, impresionanta Africa sau India, poti fi sigur ca vacanta ta va fi cu adevarat memorabila.]</p>
											<a href="" class="btn btn--light-blue item-filters__btn">[solicita o oferta personalizata »]</a>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 regular">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="col-md-6 regular">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-ms-6 col-sm-6">
							<div class="row">
								<div class="col-xs-12 regular first-of-type">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-6 tall last-of-type">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="col-md-6 regular last-of-type">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="col-md-6 regular last-of-type">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="row">
								<div class="col-ms-6 col-sm-4 col-lg-3 regular">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="col-ms-6 col-sm-4 col-lg-6 regular">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
								<div class="col-ms-6 col-sm-4 col-lg-3 regular">
									<div class="category <?= strtolower($class[count($class)-1]) ?>" data-location="<?= $item['title'] ?>">
										<div class="category-txt">
											<p class="category-title">[Exotica]</p>
										</div>
										<div class="overlay text-center <?= $item['class'] ?>" id="<?= $item['class'] ?>"></div>
										<img src="<?= $_base ?>static/img/taste.jpg" alt="<?= $item['title'] ?>" />
									</div>
								</div>
							</div>
						</div>
						<?/*<? } ?>*/?>
					</div>
				<? } ?>
				<!-- end listare noua -->
			</div>

			<div class="contact-form-wrapper vacations-form-wrapper  <?= isset($_POST['submit']) ? 'show' : ''  ?>" data-location="">
				<h2 class="logo-title logo-title--full"><span class="logo-title__text">SOLICITARE VACANTA <b id="tip-vacanta"></b></span></h2>
				<a href="#" class="close-cat"><i class="zmdi zmdi-close"></i></a>
				<? include $_theme_path.'common/forms/contact-form-vacations.php' ?>
			</div>
		</div>
	</div>

	<!--
	<div class="container-fluid blue-bg vd-why">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 hr-title wisub">
					<hr class="hr-title__hr">
					<h3 class="hr-title__text text--blue">De ce sa alegi o Vacanta la comanda</h3>
					<p class="hr-subtitle__text text--blue">cu Paralela45</p>
				</div>
				<div class="col-xs-12">
					<div class="vd-why-txt text--blue clearfix">
						<?=$_text['description']?>
					</div>
				</div>
			 </div>
		 </div>
	</div>
	-->

	<?/*
	<div class="container vd-team">
		<div class="col-xs-12 hr-title wisub">
			<hr class="hr-title__hr">
			<h3 class="hr-title__text text--blue">Nu stii ce vacanta sa alegi?</h3>
			<p class="hr-subtitle__text text--blue">Echipa noastra va recomanda:</p>
		</div>
		<? foreach($_rec_vacation as $item){?>
			<div class="col-xs-12 col-sm-6 col-md-4">
				<div class="guid">
					<a href="<?=$item['url']?>" class="img"><img src="<?=$item['images'][0]['small']?>" alt="<?=$item['title']?>"></a>
					<p><a href="<?=$item['url']?>" class="name"><?=$item['title']?></a></p>
					<?=$item['description']?>
					<p><a href="<?=$item['url']?>" class="read-more">citeste mai mult ></a></p>
				</div>
			</div>
		<? }?>
	</div>
	*/?>

	<!-- in numere -->
	<div class="experiences-numbers-section">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-lg-8 col-lg-offset-2">
					<h3 class="hr-title__text text--blue">
						[29 ani de #experientedeneuitat]
					</h3>
					<p class="inner-page-subtitle">
						[Lorem ipsum Lorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsumLorem ipsum]
					</p>
				</div>
			</div>
		</div>

		<div class="experiences-numbers-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="experiences-numbers">
							<div class="en-box">
								<div class="enbox-01">
									[<i class="en-icon eni-01"></i>
									<span class="no">10000+</span><br>
									<span class="det">turisti fericiti</span><br>
									lorem ipsum lorem ipsu<br>
									lorem ipsum]
								</div>
							</div>
							<div class="en-box">
								<div class="enbox-02">
									[<i class="en-icon eni-02"></i>
									<span class="no">250</span><br>
									<span class="det">oameni in echipA paralela 45</span><br>
									lorem ipsum lorem ipsu<br>
									lorem ipsum]
								</div>
							</div>
							<div class="en-box">
								<div class="enbox-03">
									[<i class="en-icon eni-03"></i>
									<span class="no">600</span><br>
									<span class="det">VACANTE CREATE</span><br>
									lorem ipsum lorem ipsu<br>
									lorem ipsum]
								</div>
							</div>
							<div class="en-box">
								<div class="enbox-04">
									[<i class="en-icon eni-04"></i>
									<span class="no">6</span><br>
									<span class="det">PREMII</span><br>
									lorem ipsum lorem ipsu<br>
									lorem ipsum]
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="circle"></div>
		</div>
	</div>
	<!-- end in numere -->

	<? include $_theme_path.'common/boxes/box_sfaturi.php';?>

</main>
<script type="text/javascript">
$(document).ready(function(){
	$('.vd-categories .category .overlay').click(function(){
		$(this).siblings('img').addClass('img-float');
		$(this).parent().addClass('category-open');
		$(this).siblings().removeClass('hidden');
		$(this).closest('.col-md-4').siblings().addClass('hidden');
		$(this).closest('.col-md-4').addClass('open-div');
		$('.vacations-form-wrapper #page-location').val('Vacanta '+ $(this).find('p').text());
		$('.vacations-form-wrapper').show();

		var anchor = $(this).attr('id');

        $('html,body').animate({
            scrollTop: $('#'+anchor).offset().top - 265
        }, 500);

        $('#tip-vacanta').text($(this).parent().data('location'));
	});
});
</script>

<? if(isset($_POST['submit'])){ $vacanta = explode(" ",$_POST['page-location']);  ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.vd-categories .<?= strtolower($vacanta[count($vacanta)-1]) ?> .overlay').trigger("click");
		$('.vd-categories').css('margin-bottom', '0px');
	})
</script>
<? } ?>
