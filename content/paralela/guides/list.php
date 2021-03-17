
		<main>
			<!-- <div class="inner-page-intro guides-page-intro">
				<div class="main-filters">
					<div class="home_forms-wrapper fhw-inner">
						<div class="container">
							<div class="row">
							</div>
						</div>
					</div>
				</div>
			</div> -->

			<div class="container margin--top-50">
				<div class="row">
					<div class="col-xs-12">
						<h3 class="hr-title__text text--blue"><?= $_text['title'] ?></h3>
						<?= $_text['description'] ?>
					</div>
				</div>
				<? if($_items){ ?>
				<div class="row guides-list">
					<? foreach($_items as $item){ ?>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="guid">
								<div class="row">
									<div class="col-xs-5 col-ms-4 col-sm-5 col-md-4 col-lg-3 text-left">
										<? if($item['file'] != ''){ ?>
											<a href="<?= route('guide', $item['title']) ?>" class="img">
												<img src="<?= $_base ?>uploads/images/<?= $item['file_path']?>large-<?= $item['file']?>" alt="<?= $item['title'] ?>" />
											</a>
										<? } ?>
									</div>
									<div class="col-xs-7 col-ms-8 col-sm-7 col-md-8 col-lg-9">
										<div class="guid-info">
											<p><a href="<?= route('guide', $item['title']) ?>" class="name"><?= $item['title'] ?></a></p>
											<p><?= limit_text($item['description'], 130) ?> <a href="<?= route('guide', $item['title']) ?>" class="read-more">citeste mai mult</a></p>
											<!-- <div class="text-center">
													<a href="#"><i class="sprite-guid-social fb"></i></a>
													<a href="#"><i class="sprite-guid-social video"></i></a>
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>
					<? } ?>
				</div>
				<? } ?>
			</div>
		</main>

		<?/* aici trebuie inclusa sectinea de "Alege urmatoarea destinatie" similara cu home/include/circuite.php */?>
