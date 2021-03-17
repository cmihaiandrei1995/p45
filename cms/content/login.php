<!-- start: page -->
<section class="body-sign">
	<div class="center-sign">
		<a href="<?=$_cms_link != "" ? $_cms_link : "https://www.prologue.ro/" ?>" target="_blank" class="logo pull-left">
			<img src="<?=$_login_logo != "" ? $_login_logo : $_base_cms."assets/images/logo.png"?>" height="54" alt="<?=$_site_title?>" />
		</a>

		<div class="panel panel-sign">
			<div class="panel-title-sign mt-xl text-right">
				<h2 class="title text-uppercase text-bold m-none"><?=$_site_title?> CMS</h2>
			</div>
			<div class="panel-body">

				<? if($_GET['action'] == 'reset-pass'){?>

					<form action="" method="post">
						<input type="hidden" name="action" value="resetpass">

						<?=sys_message($error_msg, $err_type)?>

						<div class="form-group mb-lg">
							<div class="input-group input-group-icon">
								<input name="username" placeholder="<?=_lng('user_or_email')?>" value="<?=$_POST['username']?>" class="form-control input-lg" tabindex="1" />
							</div>
						</div>

						<? if($_SESSION[$_site_title]['cms']['log_tries'] >= $log_tries) {?>
							<div class="form-group mb-lg">
								<label><?=_lng('captcha_code')?></label>
								<div class="input-group input-group-icon">
									<input name="captcha" type="text" placeholder="" value="" class="form-control input-lg" tabindex="2" />
									<span class="input-group-btn" style="position:relative; z-index:10; right:100px;">
										<img class="captcha" src="<?=$_base?>lib/classes/validation/captcha.php?id=cms_login&rnd=<?=mt_rand(10,100)?>&width=100&height=46&characters=6&bg=f6f6f6&text=4a4a4a&noise=cccccc" alt="Captcha Code" />
									</span>
								</div>
							</div>
						<? }?>

						<div class="row">
							<div class="col-sm-12 text-right">
								<button type="submit" name="submit" class="btn btn-primary hidden-xs" tabindex="3"><?=_lng('reset_pass')?></button>
								<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" tabindex="5"><?=_lng('reset_pass')?></button>
							</div>
						</div>

						<p class="text-center mt-lg"><?=_lng('remembered')?> <a href="<?=$_base_cms?>?login"><?=_lng('login')?></a>
					</form>

				<? }else{?>

					<form action="" method="post">
						<input type="hidden" name="action" value="login">

						<?=sys_message($error_msg, $err_type)?>

						<? if($check_for_2fa){?>

							<? if($is_2fa_first_time){?>
								<div class="form-group mb-lg">
									<p class="text-center">Scaneaza codul QR cu o aplicatie 2FA de pe telefon <br> <a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Download Google Authenticator</a></p>
									<div class="input-group input-group-icon text-center">
										<br>
										<img src="<?=$qrCodeUrl?>">
										<br><br>
										Cod secret: <b><?=$tfa_secret?></b><br>
										Account: <b><?=$qr_account?></b>
									</div>
								</div>
							<? }?>

							<div class="form-group mb-lg">
								<label>Cod 2FA</label>
								<div class="input-group input-group-icon">
									<input name="2fa_code" type="text" placeholder="ex: 432316" value="" class="form-control input-lg" tabindex="1" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<input name="username" type="hidden" value="<?=$_POST['username']?>" />
							<input name="password" type="hidden" value="<?=$_POST['password']?>" />

							<div class="row">
								<div class="col-sm-12 text-center">
									<button type="submit" name="submit" class="btn btn-primary hidden-xs" tabindex="5"><?=_lng('login')?></button>
									<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" tabindex="5"><?=_lng('login')?></button>
								</div>
							</div>

						<? }else{?>

							<div class="form-group mb-lg">
								<label><?=_lng('user')?></label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" placeholder="<?=_lng('user_or_email')?>" value="<?=$_POST['username']?>" class="form-control input-lg" tabindex="1" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left"><?=_lng('pass')?></label>
									<a href="<?=$_base_cms?>?login&action=reset-pass" class="pull-right"><?=_lng('forgot_pass')?></a>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" placeholder="<?=_lng('pass')?>" class="form-control input-lg" tabindex="2" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<? if($_SESSION[$_site_title]['cms']['log_tries'] >= $log_tries) {?>
								<div class="form-group mb-lg">
									<label><?=_lng('captcha_code')?></label>
									<div class="input-group input-group-icon">
										<input name="captcha" type="text" placeholder="" value="" class="form-control input-lg" tabindex="3" />
										<span class="input-group-btn" style="position:relative; z-index:10; right:100px;">
											<img class="captcha" src="<?=$_base?>lib/classes/validation/captcha.php?id=cms_login&rnd=<?=mt_rand(10,100)?>&width=100&height=46&characters=6&bg=f6f6f6&text=4a4a4a&noise=cccccc" alt="Captcha Code" />
										</span>
									</div>
								</div>
							<? }?>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="remember" name="remember" value="1" type="checkbox" tabindex="4"/>
										<label for="remember"><?=_lng('remember_me')?></label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="submit" class="btn btn-primary hidden-xs" tabindex="5"><?=_lng('login')?></button>
									<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" tabindex="5"><?=_lng('login')?></button>
								</div>
							</div>

						<? }?>

						<p class="text-center">&nbsp;</p>

					</form>
				<? }?>
			</div>
		</div>

		<? if(!$_hide_footer_copy){?>
			<p class="text-center text-muted mt-md mb-md">&copy; <a href="<?=$_cms_link?>" target="_blank">Prologue CMS v<?=$_version?></a>. <?=_lng('copyright')?>.</p>
		<? }?>
	</div>
</section>
<!-- end: page -->
