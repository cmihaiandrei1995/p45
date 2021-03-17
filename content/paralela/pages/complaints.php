
<main>

  <div class="container margin--top-30 p-pag">
        <div class="row">
              <div class="col-xs-12 hr-title">
                <h3 class="hr-title__text text--blue"><?= $_text['title'] ?></h3>
              </div>
          </div>
          <div class="row">
              <div class="col-md-4 col-md-push-8 text-center">
                  <img src="<?= $_text['images'][0]['url'] ?>" class="img-responsive" alt="<?= $_text['title'] ?>" />
              </div>
              <div class="col-md-8 col-md-pull-4 pargr">
                     <?= $_text['description'] ?>
                    </div>
              </div>
          </div>
    </div>
    <div class="contact-form-wrapper p-pag-contact-form">
       <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="logo-title logo-title--full"><span class="logo-title__text">Formular de contact</span></h2>
              </div>
            </div>
      </div>
      <div class="container-fluid contact-form">
          <div class="row">
              <div class="container">
              <? if($_valid && isset($_POST['submit'])){ ?>
					<div class="success-form" id="form-response">
				        <span class="title"><? _e('Va multumim!')?></span>
				    </div>
				    <br><br><br>
				<? }else{ ?>
				<div class="success-form" id="form-response"></div>
                  <form method="post" action="#form-response">
                      <div class="row">
                          <div class="col-xs-12"><p>Date contact</p></div>
                          <div class="col-md-4 col-sm-4">
                              <div class="form-group">
                                <input type="text" class="form-control" placeholder="Prenume si Nume" name="name" value="<?=$_form['name']?>">
                                <? if($_errors['name'] != ""){?>
				            		<span class="error"><?=$_errors['name']?></span>
				            	<? } ?>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Telefon" value="<?=$_form['phone']?>">
                                <? if($_errors['phone'] != ""){?>
				            		<span class="error"><?=$_errors['phone']?></span>
				            	<? } ?>
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?=$_form['email']?>">
                                <? if($_errors['email'] != ""){?>
				            		<span class="error"><?=$_errors['email']?></span>
				            	<? } ?>
                              </div>
                              <div class="g-recaptcha" data-sitekey="<?=$_config['captcha']['site_key']?>"></div>
							<? if($_errors['g-recaptcha-response'] != ""){?>
			            		<span class="error"><?=$_errors['g-recaptcha-response']?></span>
			            	<? } ?>
                          </div>
                          <div class="col-md-8 col-sm-8">
                              <textarea cols="5" name="observations" rows="5" placeholder="Observatii"><?= ($_errors != '') ? $_form['observations'] : '' ?></textarea>
                              <? if($_errors['observations'] != ""){?>
			            		<span class="error"><?=$_errors['observations']?></span>
			            	<? } ?>
                          </div>
                          <div class="col-xs-12">
                              <button class="btn btn--green item__info__btn pull-right" type="submit" name="submit">Trimite</button>
                          </div>
                      </div>
                  </form>
                  <? } ?>
              </div>
          </div>
      </div>
  </div>

  <?/*<? include $_theme_path.'common/boxes/box_learn_more_about.php' ?>*/?>

</main>
