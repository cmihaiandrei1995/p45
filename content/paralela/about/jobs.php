
		<main>
			<div class="container-fluid inner-banner inner-banner-about">
				<div class="row">
					<div class="col-xs-12">
						<div class="row img-banner__img__wrapper text-center">
								<div class="black-layer"></div>
							<img class="img-banner__img object-fit wwpro" src="<?= $_base ?>static/img/banner-cariere.jpg" alt="..." />
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid margin--top-50">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<h2 class="logo-title logo-title--full"><span class="logo-title__text">Cariere</span> <span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 about-wrapper">
								<div class="row">
									<div class="col-md-3">
										<? include $_theme_path.'common/sidebars/sidebar-about-new.php' ?>
									</div>
									<div class="col-md-9">
										<div class="about-section clearfix">
											<?= $_text['description'] ?>
										</div>
										<? if($_jobs){ $x = count($_jobs); $i=0; foreach($_jobs as $k => $job){ $i++; ?>
															
											<div class="about-section">
												<h4 class="media"><?= $job['title'] ?> </h4>
												<?= $job['description'] ?>
												<a class="more-details" href="#">aplica</a>
												
												<? if($_valid && isset($_POST['submit-'.$job['id_jobs']])){?>
													<div class="success-form" id="<?= strtolower(str_replace(" ", "-", $job['title'])) ?>">
												        <span class="title"><? _e('Va multumim!')?></span>
												       
												    </div>
												    <br><br><br>
												<? }else{?>
												
												<span id="<?= strtolower(str_replace(" ", "-", $job['title'])) ?>"></span>
												<form enctype="multipart/form-data" class="job-apply <?php if(count($_errors) && isset($_POST['submit-'.$job['id_jobs']])) { echo ""; }else{echo 'hidden'; } ?>" action="#<?= strtolower(str_replace(" ", "-", $job['title'])) ?>" method="post">
													<div class="row">
														<div class="col-sm-6">
															<input type="hidden" value="<?= $job['title'] ?>" name="title_job"/>
															<div class="form-control-div">
																<label>Nume complet</label>
																<input type="text" name="name" value="<?=$_form['name']?>" class="form-control" />
																<? if($_errors['name'] != ""){?>
												            		<span class="error"><?=$_errors['name']?></span>
												            	<? }?>
															</div>
															<div class="form-control-div">
																<label>Email</label>
																<input type="text" name="email" value="<?=$_form['email']?>" class="form-control" />
																<? if($_errors['email'] != ""){?>
												            		<span class="error"><?=$_errors['email']?></span>
												            	<? }?>
											            	</div>
															<div class="form-control-div">
																<label>Telefon</label>
																<input type="text" name="phone" value="<?=$_form['phone']?>" class="form-control" />
																<? if($_errors['phone'] != ""){?>
												            		<span class="error"><?=$_errors['phone']?></span>
												            	<? }?>
											            	</div>
														</div>
														<div class="col-sm-6">
															<label>Scrisoare de intentie</label>
															<textarea name="letter" class="form-control"><?=$_form['letter']?></textarea>
														</div>
														<div class="col-sm-6">
															<label>CV</label>
															<input type="file" name="file" value="" class="form-control" accept="image/x-png,image/gif,image/jpeg,application/pdf,application/msword"/>
															<? if($_errors['file'] != ""){?>
											            		<span class="error"><?=$_errors['file']?></span>
											            	<? }?>
														</div>
														<div class="col-sm-6">
															<button type="submit" name="submit-<?= $job['id_jobs'] ?>" class="btn--green">Aplica</button>
														</div>
													</div>
												</form>
												<? }?>
																	
											</div>
											<? if($i != $x){ ?>
											<hr class="delim inmedia" />
											<? } ?>
											
										<? } } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>
			<? //include $_theme_path.'common/boxes/box_partners.php' ?>
		</main>
		
