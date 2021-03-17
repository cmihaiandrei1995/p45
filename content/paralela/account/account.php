<main>
    <div class="my-account-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <? include $_theme_path.'account/include/side.php' ?>
                        </div>
                        <div class="col-md-9">
                            <?/*
                            <h1 class="logo-title logo-title--full">
                                <span class="logo-title__text"></span>
                            </h1>
                            */?>
                            <div class="my-content">
                                <div class="box passenger" id="form">
                                	 <form action="#form" method="post">
        	                             <div class="row">
        	                                 <div class="col-md-12">
        	                                     <div class="passenger-edit" style="border:none; margin:0px;">
        	                                     	 <? if(isset($_POST['account']) && $_valid){?>
        	                                     	 	<div class="alert alert-success">
        													Datele tale au fost salvate cu succes.
        												</div>
        	                                     	 <? }?>
        	                                         <p>Editeaza DATE PERSONALE</p>
        	                                         <div class="row">
        	                                             <div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_name">Nume</label>
        														<input type="text" class="form-control" id="invoice_name" name="invoice_name" value="<?=$_form['invoice_name']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_name'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_name']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_surname">Prenume</label>
        														<input type="text" class="form-control" id="invoice_surname" name="invoice_surname" value="<?=$_form['invoice_surname']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_surname'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_surname']?></span>
        											        	<? }?>
        													</div>
        												</div>
        	                                        </div>
        	                                        <div class="row">
        	                                             <div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="email">Email</label>
        														<input type="email" class="form-control" id="email" name="email" value="<?=$_form['email']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['email'] != ""){?>
        											        		<span class="error"><?=$_errors['email']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="phone">Telefon</label>
        														<input type="number" class="form-control" id="phone" name="phone" value="<?=$_form['phone']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['phone'] != ""){?>
        											        		<span class="error"><?=$_errors['phone']?></span>
        											        	<? }?>
        													</div>
        												</div>
        	                                         </div>
                                                     <br><br>
        	                                         <p>Editeaza DATE FACTURARE</p>
        	                                         <div class="row">
                                                         <?/*
        												<div class="col-ms-6 col-sm-5">
        													<div class="checkbox item-rezervare__info__detalii__checkbox">
        														<input id="invoice_type_pf" name="invoice_type" value="pf" type="radio" <? if($_form['invoice_type'] == "pf" || !isset($_form)) echo "checked"?>>
        														<label for="invoice_type_pf">FACTURA PE PERSOANA FIZICA</label>
        													</div>
        													<? if($_errors['invoice_type'] != ""){?>
        										        		<span class="error"><?=$_errors['invoice_type']?></span>
        										        	<? }?>
        												</div>
        												<div class="col-ms-6 col-sm-5 col-sm-offset-1">
        													<div class="checkbox item-rezervare__info__detalii__checkbox">
        														<input id="invoice_type_pj" name="invoice_type" value="pj" type="radio" <? if($_form['invoice_type'] == "pj") echo "checked"?>>
        														<label for="invoice_type_pj">FACTURA PE FIRMA</label>
        													</div>
        												</div>
                                                        */?>
        												<div class="clearfix"></div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_address">Adresa facturare</label>
        														<input type="text" class="form-control" id="invoice_address" name="invoice_address" value="<?=$_form['invoice_address']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_address'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_address']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_country">Tara</label>
        														<input type="text" class="form-control" id="invoice_country" name="invoice_country" value="<?=$_form['invoice_country']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_country'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_country']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_city">Oras</label>
        														<input type="text" class="form-control" id="invoice_city" name="invoice_city" value="<?=$_form['invoice_city']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_city'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_city']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_county">Judet/Sector</label>
        														<input type="text" class="form-control" id="invoice_county" name="invoice_county" value="<?=$_form['invoice_county']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_county'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_county']?></span>
        											        	<? }?>
        													</div>
        												</div>
        												<div class="col-ms-6 col-sm-6 f-persoana <? if($_form['invoice_type'] == "pj") echo "hidden"?>">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_cnp">CNP</label>
        														<input type="number" class="form-control" id="invoice_cnp" name="invoice_cnp" value="<?=$_form['invoice_cnp']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_cnp'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_cnp']?></span>
        											        	<? }?>
        													</div>
        												</div>
                                                        <div class="col-ms-6 col-sm-6 col-md-4 col-md-offset-2">
                                                            <button class="btn box-passenger-btn bp-btn-invert" type="submit" name="account">Salveaza</button>
                                                        </div>
                                                        <?/*
        												 <div class="col-ms-6 col-sm-5 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_form)) echo "hidden"?>">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_company">Companie</label>
        														<input type="text" class="form-control" id="invoice_company" name="invoice_company" value="<?=$_form['invoice_company']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_company'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_company']?></span>
        											        	<? }?>
        													</div>
        												</div>

        												<div class="col-ms-6 col-sm-5 col-sm-offset-1 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_form)) echo "hidden"?>">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_cui">CUI</label>
        														<input type="text" class="form-control" id="invoice_cui" name="invoice_cui" value="<?=$_form['invoice_cui']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_cui'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_cui']?></span>
        											        	<? }?>
        													</div>
        												</div>

        												 <div class="col-ms-6 col-sm-5 f-companie <? if($_form['invoice_type'] == "pf" || !isset($_form)) echo "hidden"?>">
        													<div class="form-group"> <!-- has-error -->
        														<label class="control-label item-rezervare__info__detalii__label__text" for="invoice_nr_reg">Numar Registrul Comertului</label>
        														<input type="text" class="form-control" id="invoice_nr_reg" name="invoice_nr_reg" value="<?=$_form['invoice_nr_reg']?>">
        														<span class="help-block hidden">Necesar</span>
        														<? if($_errors['invoice_nr_reg'] != ""){?>
        											        		<span class="error"><?=$_errors['invoice_nr_reg']?></span>
        											        	<? }?>
        													</div>
        												</div>
                                                        */?>
        											</div>
                                                    <?/*
        	                                        <div class="row">
        	                                            <div class="col-md-4"></div>
        	                                            <div class="col-md-4 text-center">
        	                                                <button class="btn box-passenger-btn bp-btn-invert" type="submit" name="account">Salveaza</button>
        	                                            </div>
        	                                        </div>
                                                    */?>
        	                                    </div>
        	                                </div>
        	                            </div>
        	                    	</form>
                                    <hr>
                                    <div id="pass">
                                    	<form action="#pass" method="post">
            	                             <div class="row">
            	                                 <div class="col-md-12">
            	                                     <div class="passenger-edit" style="border:none; margin:0px;">
            	                                     	 <? if(isset($_POST['pass']) && $_valid){?>
            	                                     	 	<div class="alert alert-success">
            													Noua parola a fost salvata cu succes.
            												</div>
            	                                     	 <? }?>
            	                                         <p>Schimbare PAROLA</p>
            	                                         <div class="row">
            	                                             <div class="col-ms-6 col-sm-4">
            	                                                <div class="form-group"> <!-- has-error -->
            														<label class="control-label item-rezervare__info__detalii__label__text" for="password">Parola noua</label>
            														<input type="password" class="form-control" id="password" name="password" value="">
            														<span class="help-block hidden">Necesar</span>
            														<? if($_errors['password'] != ""){?>
            											        		<span class="error"><?=$_errors['password']?></span>
            											        	<? }?>
            													</div>
            	                                            </div>
            	                                            <div class="col-ms-6 col-sm-4">
            	                                                <div class="form-group"> <!-- has-error -->
            														<label class="control-label item-rezervare__info__detalii__label__text" for="repassword">Rescrie parola</label>
            														<input type="password" class="form-control" id="repassword" name="repassword" value="">
            														<span class="help-block hidden">Necesar</span>
            														<? if($_errors['repassword'] != ""){?>
            											        		<span class="error"><?=$_errors['repassword']?></span>
            											        	<? }?>
            													</div>
            	                                            </div>
                                                            <div class="col-sm-4">
            	                                                <button class="btn box-passenger-btn bp-btn-invert" type="submit" name="pass">Salveaza</button>
            	                                            </div>
            	                                        </div>
            	                                    </div>
            	                                </div>
            	                            </div>
            	                    	</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
