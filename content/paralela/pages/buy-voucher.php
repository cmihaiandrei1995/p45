
<div class="vou-intro">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1 text-center">
                <? if($_text_thank_you){?>
                    <?=$_text_thank_you['description']?>
                <? }else{?>
                    <?=$_text_top['description']?>
                <? }?>
            </div>
        </div>

        <? if(!$_text_thank_you){?>
            <div class="row" <? if(isset($_POST['submit']) && !$_show_form){?>id="form"<? }?>>
                <div class="col-xs-12">
                    <form action="<?=route('buy-voucher')?>#form" method="post">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-4">
                                <div class="box">
                                    <p class="step">PASUL 1</p>
                                    Alege tipul de voucher dorit:

                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="general" <?=$_form['voucher_type'] == "general" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">GENERAL</span><br>
                                                alege Voucher General >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vgen.png">
                                        </label>
                                    </div>
                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="aniversare" <?=$_form['voucher_type'] == "aniversare" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">ANIVERSARE</span><br>
                                                alege Voucher Aniversare >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vaniv.jpg">
                                        </label>
                                    </div>
                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="valentines" <?=$_form['voucher_type'] == "valentines" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">VALENTINE'S DAY</span><br>
                                                alege Voucher<br>Valentine's Day >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vval.png">
                                        </label>
                                    </div>
                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="paste" <?=$_form['voucher_type'] == "paste" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">PASTE</span><br>
                                                alege Voucher Paste >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vpaste.png">
                                        </label>
                                    </div>
                                    <? /*
                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="nunta" <?=$_form['voucher_type'] == "nunta" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">NUNTĂ</span><br>
                                                alege Voucher Nuntă >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vnun.jpg">
                                        </label>
                                    </div>
                                    */ ?>
                                    <? /*
                                    <div class="form-radio">
                                        <label>
                                            <input type="radio" name="voucher_type" value="sarbatori" <?=$_form['voucher_type'] == "sarbatori" ? "checked" : ""?>>
                                            <p>
                                                <span class="den">SĂRBĂTORI</span><br>
                                                alege Voucher Sărbători >>
                                            </p>
                                            <br class="d-sm-none">
                                            <img src="<?= $_base?>static/img/voucher/vsarb.jpg">
                                        </label>
                                    </div>
                                    */ ?>
                                    <? if($_errors['voucher_type'] != ""){?>
                                        <span class="error"><?=$_errors['voucher_type']?></span>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box">
                                    <p class="step">PASUL 2</p>
                                    Completeaza campurile necesare:

                                    <div class="form-group mt-3">
                                        <label>“De la” (Nume și Prenume)</label>
                                        <input type="text" class="form-control" name="name_from" value="<?=$_form['name_from']?>">
                                        <? if($_errors['name_from'] != ""){?>
                                            <span class="error"><?=$_errors['name_from']?></span>
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>“Pentru” (Nume și Prenume)</label>
                                        <input type="text" class="form-control" name="name_for" value="<?=$_form['name_for']?>">
                                        <? if($_errors['name_for'] != ""){?>
                                            <span class="error"><?=$_errors['name_for']?></span>
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mesaj</label>
                                        <textarea cols="" rows="" name="message" style="color:#2f62a2"><?=$_form['message']?></textarea>
                                        <? if($_errors['message'] != ""){?>
                                            <span class="error"><?=$_errors['message']?></span>
                                        <? } ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Valoare Voucher</label>
                                        <select class="form-control" name="voucher_value">
                                            <option value="">Alege valoarea</option>
                                            <? foreach($voucher_values as $val){?>
                                                <option value="<?=$val?>" <? if($val == $_form['voucher_value']) echo "selected"?>><?=$val?> €</option>
                                            <? }?>
                                        </select>
                                        <? if($_errors['voucher_value'] != ""){?>
                                            <span class="error"><?=$_errors['voucher_value']?></span>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="box d-flex flex-column">
                                    <div>
                                        <p class="step">PASUL 3</p>
                                        Plătește voucherul, descarcă-l și dăruiește-l celor dragi<br>
                                        <button type="submit" name="submit" class="bttn-wtbord w-70 mt-4">Detalii plata voucher >></button>
                                    </div>

                                    <img src="<?= $_base?>static/img/voucher/gift.png" class="gift mt-auto img-responsive" <? if($_show_form){?>id="form"<? }?>>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <? }?>
    </div>
</div>

<? if(!$_text_thank_you){?>
    <div class="vou-det">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <? if($_show_form){?>
                        <div class="form-wrapper">
                            <div class="form-wrapper-intro">
                                <strong>DETALII PLATĂ VOUCHER <?=strtoupper($_form['voucher_type'])?></strong><br>
                                De la <strong><?=$_form['name_from']?></strong> pentru <strong><?=$_form['name_for']?></strong> in valoare de <strong><?=$_form['voucher_value']?>€</strong>
                            </div>

                            <form action="<?=route('buy-voucher')?>#form" method="post">

                                <input type="hidden" name="voucher_type" value="<?=$_form['voucher_type']?>">
                                <input type="hidden" name="name_from" value="<?=$_form['name_from']?>">
                                <input type="hidden" name="name_for" value="<?=$_form['name_for']?>">
                                <input type="hidden" name="message" value="<?=$_form['message']?>">
                                <input type="hidden" name="voucher_value" value="<?=$_form['voucher_value']?>">

                                Informații personale cumpărător:

                                <div class="row">
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Nume</label>
                                            <input type="text" class="form-control" name="name" value="<?=$_form['name']?>">
                                            <? if($_errors['name'] != ""){?>
                                                <span class="error"><?=$_errors['name']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Prenume</label>
                                            <input type="text" class="form-control" name="surname" value="<?=$_form['surname']?>">
                                            <? if($_errors['surname'] != ""){?>
                                                <span class="error"><?=$_errors['surname']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Telefon Mobil</label>
                                            <input type="text" class="form-control" name="phone" value="<?=$_form['phone']?>">
                                            <? if($_errors['phone'] != ""){?>
                                                <span class="error"><?=$_errors['phone']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="text" class="form-control" name="email" value="<?=$_form['email']?>">
                                            <? if($_errors['email'] != ""){?>
                                                <span class="error"><?=$_errors['email']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-9">
                                        <div class="form-group">
                                            <label>Adresă facturare</label>
                                            <input type="text" class="form-control" name="address" value="<?=$_form['address']?>">
                                            <? if($_errors['address'] != ""){?>
                                                <span class="error"><?=$_errors['address']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Localitate</label>
                                            <input type="text" class="form-control" name="city" value="<?=$_form['city']?>">
                                            <? if($_errors['city'] != ""){?>
                                                <span class="error"><?=$_errors['city']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Valoare voucher</label>
                                            <input type="text" class="form-control" value="<?=$_form['voucher_value']?> €" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>Modalitate plata</label>
                                            <select class="form-control" name="payment">
                                                <option value="">Alege modalitatea de plata</option>
                                                <option value="euplatesc" <? if($_form['payment'] == "euplatesc"){?>selected<? }?>>Cu cardul online prin Euplatesc.ro</option>
                                                <option value="rate" <? if($_form['payment'] == "rate"){?>selected<? }?>>Cu cardul online - In rate</option>
                                            </select>
                                            <? if($_errors['payment'] != ""){?>
                                                <span class="error"><?=$_errors['payment']?></span>
                                            <? } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <?/*<div class="form-group">
                                            <label>Modalitate de plată</label>
                                            <input type="text" class="form-control">
                                        </div>*/?>
                                    </div>
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="submit" name="buy" class="btn btn--green">Comandă voucherul cadou >></button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <i>*După achitarea voucherului veți primi linkul de descărcare pe adresa de e-mail menționată mai sus.</i>
                                    </div>
                                </div>
                                <hr>
                            </form>
                        </div>
                    <? }?>

                    <?=$_text_bottom['description']?>

                    <? /*
                    <p class="upper mb-0">VOUCHER CADOU PARALELA 45</p>
                    <p class="upper mb-0"><strong>REGULAMENT DE ACHIZIȚIONARE ȘI UTILIZARE</strong></p>
                    <div class="twocol mt-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer iaculis iaculis lacinia. Proin sagittis placerat viverra. Proin eu laoreet ligula. Praesent tristique porttitor enim at porttitor. Maecenas ac ultrices tellus. Aliquam purus eros, rutrum eget ornare ac, porttitor non elit. Proin dignissim elit laoreet, tristique augue eu, scelerisque arcu. Pellentesque eu pellentesque dui, nec lacinia lacus. Donec et dolor quis quam vulputate lacinia. Donec cursus ante a tellus dignissim egestas. Maecenas facilisis neque augue, vitae volutpat augue mattis et. Aliquam faucibus ultrices turpis, a tincidunt lorem tincidunt nec.
                        Ut tristique massa non mollis luctus. Vestibulum in convallis nulla. Nullam ac tincidunt neque, mollis feugiat orci. In justo dui, tincidunt sit amet felis vel, dignissim iaculis diam. Morbi elementum condimentum placerat. Aenean tristique efficitur ex eu pulvinar. Proin neque elit, consequat sit amet nisi id, molestie consequat nibh. Mauris iaculis neque quis lorem facilisis, eu scelerisque ante semper. Donec eu sapien sit amet elit fringilla sollicitudin.
                        Proin pretium porta nunc, at pellentesque leo maximus nec. Vestibulum ut est vel enim sodales pharetra. Mauris finibus laoreet dolor, quis finibus lacus dapibus nec. Donec vehicula orci lorem, sit amet sollicitudin erat lobortis ac. Aenean lobortis aliquam imperdiet. Morbi eleifend lorem vel erat ornare sollicitudin. Duis vitae eros arcu. Vivamus nec mi tincidunt, aliquam purus vitae, congue arcu. Sed quis turpis eu leo tincidunt viverra ac eget eros.
                        Vivamus hendrerit dictum elit sit amet euismod. Morbi laoreet elementum mattis. Ut eget facilisis elit, laoreet aliquet dui. Fusce vestibulum felis sed nibh egestas, pellentesque cursus odio lobortis. Praesent vulputate, felis at vehicula suscipit, metus dui gravida sapien, quis scelerisque lectus purus ut odio. Mauris sit amet venenatis libero, nec aliquet dui. Nunc laoreet tellus ut finibus mattis. Ut at viverra ex, rutrum ullamcorper felis. Aliquam sit amet libero sagittis, tincidunt felis ac, faucibus turpis. Sed vel placerat leo, sed hendrerit enim. Etiam dui dolor, laoreet eget massa sagittis, elementum blandit augue. In tempor imperdiet sem sed sagittis.
                    </div>
                    */ ?>
                </div>
            </div>
        </div>
    </div>
<? }?>
