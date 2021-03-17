
<div class="revolut-page">
    <div class="revolut-banner">
        <div class="container">
    		<div class="row">
    			<div class="col-xs-12">
                    <h2>
                        Paralela 45 <span class="heart-txt"><img src="<?=$_base?>static/img/revolut/heart.png" alt="">Revolut</span>
                        <span>Ia-ti cardul de calator si profita de oferta</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="revolut-adv">
        <div class="container">
    		<div class="row">
    			<div class="col-xs-12 col-ms-6 col-sm-6 col-md-3">
                    <div class="revolut-adv-box">
                        <img src="<?=$_base?>static/img/revolut/r01.png" alt="">
                        <span>Schimbi bani la cel mai bun curs</span>
                    </div>
                </div>
                <div class="col-xs-12 col-ms-6 col-sm-6 col-md-3">
                    <div class="revolut-adv-box">
                        <img src="<?=$_base?>static/img/revolut/r02.png" alt="">
                        <span>Retrageri de la orice bancomat din lume</span>
                    </div>
                </div>
                <div class="col-xs-12 col-ms-6 col-sm-6 col-md-3">
                    <div class="revolut-adv-box">
                        <img src="<?=$_base?>static/img/revolut/r03.png" alt="">
                        <span>Administrează-ti bugetul direct din aplicatie</span>
                    </div>
                </div>
                <div class="col-xs-12 col-ms-6 col-sm-6 col-md-3">
                    <div class="revolut-adv-box">
                        <img src="<?=$_base?>static/img/revolut/r04.png" alt="">
                        <span>Si multe altele...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="revolut-about">
        <div class="container">
    		<div class="row">
    			<div class="col-xs-12 col-md-4 text-center">
                    <img src="<?=$_base?>static/img/revolut/card.png" alt="">
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="know-that">
                        <h3>Stiati ca:</h3>
                        <p>Prin Revolut schimbi bani direct la cursul interbancar si fara comisioane ascunse?<br>
                        Totul direct din aplicatie.</p>
                    </div>
                </div>
            </div>
            <div class="steps" id="form">
                <div class="steps-content">
                    <div class="vert-divider"></div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="onleft">
                                <h3>
                                    Fa-ti cardul Revolut si poti<br>
                                    <p class="win-what">castiga o vacanta in Antalya</p>
                                </h3>
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="no">1.</span>
                                        <span class="step-det">Descarca aplicatia Revolut folosind link-ul primit prin sms.<br>
                                        (Cardul este gratuit doar daca folosesti acel link)</span>
                                    </li>
                                    <li>
                                        <span class="no">2.</span>
                                        <span class="step-det">Creeaza-ti contul in doar cateva minute.</span>
                                    </li>
                                    <li>
                                        <span class="no">3.</span>
                                        <span class="step-det">Comanda gratuit primul tau card.<br>
                                        (“Cards” – “Get new Revolut card” – “Physical”)</span>
                                    </li>
                                    <li>
                                        <span class="no">4.</span>
                                        <span class="step-det">Completeaza datele tale personale.</span>
                                    </li>
                                </ul>
                                 <? if(isset($_POST['submit']) && $_valid){?>
                                    <br><br><br>
                                    <h2 class="text-center">Felicitari! Te-ai inscris cu succes in concurs.</h2>
                                    <br><br><br>
                                <? }else{ ?>
                                    <form action="#form" method="POST">
                                        <div class="row">
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Nume" name="name" value="<?= $_form['name'] ?>">
                                                     <? if($_errors['name'] != ""){?>
                                                        <span class="error"><?=$_errors['name']?></span>
                                                    <? } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Prenume" name="surname" value="<?= $_form['surname'] ?>">
                                                     <? if($_errors['surname'] != ""){?>
                                                        <span class="error"><?=$_errors['surname']?></span>
                                                    <? } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" placeholder="Email" name="email" value="<?= $_form['email'] ?>">
                                                     <? if($_errors['email'] != ""){?>
                                                        <span class="error"><?=$_errors['email']?></span>
                                                    <? } ?> 
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-ms-6 col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Telefon" name="phone" value="<?= $_form['phone'] ?>">
                                                     <? if($_errors['phone'] != ""){?>
                                                        <span class="error"><?=$_errors['phone']?></span>
                                                    <? } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group check-group">
                                                    <label>
                                                        <input type="checkbox" value="1" name="newsletter" <?=$_form['newsletter'] == 1 ? "checked" : ""?>>
                                                        Vreau să primesc cele mai noi oferte, campanii și concursuri.
                                                    </label>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn btn--green" type="submit" name="submit"><span>COMANDA CARDUL</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <? } ?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="onright">
                                <h3>
                                    Ai card Revolut? Ai <span class="win-what">5% discount*</span> la rezervarile platite cu cardul tau Revolut
                                </h3>
                                <div class="tell">
                                    Foloseste cardul tau Revolut la orice comanda online specificand in detalii ca faci plata cu un card Revolut.<br><br>

                                    Vino cu cardul in orice agentie Paralela 45 si rezerva pe loc o vacanta.
                                </div>

                                <i>*Reducere valabila la Pachetele de Vacanta (zbor + cazare) si circuitele marca Paralela 45 (doar pentru destinatia Antalya se aplica discountul in limita a 100 euro/adult).</i>
                                <div class="text-center">
                                    <a href="<?= route('home') ?>" class="btn btn--green"><span>REZERVA ACUM</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="when text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            Perioada campaniei: 01.07.2019 – 01.09.2019.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="revolut-prize">
        <div class="container">
    		<div class="row">
    			<div class="col-xs-12 col-md-6 text-center">
                    <div class="img">
                        <img src="<?=$_base?>static/img/revolut/rimg.jpg" alt="">
                    </div>
                </div>
                <div class="col-xs-12 col-md-5">
                    <h3>castiga o vacanta PENTRU 2 PERSOANE in Antalya!</h3>
                    <strong>Plecare din:</strong> Bucuresti<br>
                    <strong>Perioada:</strong> 14.10 – 21.10.2019<br>
                    <strong>Hotel:</strong> Crystal Tat Beach 5* - Belek, regiunea Antalya - Turcia<br>
                    <strong>Masa:</strong> All Inclusive<br><br>

                    <strong>Servicii incluse in pachet:</strong><br>
                    · Transport avion Bucuresti – Antalya si retur, inclusiv taxe;<br>
                    · 7 nopti cazare si masa in regim All Inclusive (camera dubla);<br>
                    · Transferuri aeroport-hotel-aeroport;<br>
                    · Asistenta turistica locala.<br><br>

                     <strong>Valoare premiu:</strong> 1526 euro / 7422 RON<br>
                     <a href="<?= route('rules-revolut') ?>" target="_blank" class="advanced-click-revolut btn">Regulament concurs</a>
                </div>
            </div>
        </div>
    </div>

    <div class="revolut-use">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="<?=$_base?>static/img/revolut/ruse.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
