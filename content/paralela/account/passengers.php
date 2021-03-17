<main>
    <div class="container-fluid inner-banner">
        <div class="row">
            <div class="col-xs-12">
                <div class="row img-banner__img__wrapper">
                    <img class="img-banner__img object-fit" src="<?=$_base?>static/img/banner-myacc-rez.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="col-md-3">
                    <? include $_theme_path.'account/include/side.php' ?>
                </div>
                <div class="col-md-9">
                    <h1 class="logo-title logo-title--full">
                        <span class="logo-title__text"></span>
                        <span class="logo-title__sprite-wrapper"><i class="sprite sprite-logo"></i></span>
                    </h1>
                    <div class="my-content">
                        <div class="box passenger">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="passenger-pict"><img src="<?=$_base?>static/img/passenger.png" alt="" /></div>
                                    <div class="passenger-title">
                                        <h3>Ionut Popescu</h3>
                                        <a href="#"><i class="my-acc-sprite my-acc-edit"></i><span>editeaza date</span></a><br />
                                        <a href="#"><i class="my-acc-sprite my-acc-addpict"></i><span>adauga poza</span></a>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="passenger-details">
                                     <div class="col-md-4 col-ms-4 col-sm-4">
                                         <div class="col">
                                            <p>DATE PERSONALE</p>
                                            <b>Data nasterii: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Email:</b> <a href="mailto:ionut.popescu@ yahoo.com">ionut.popescu@ yahoo.com</a><br />
                                            <b>Telefon numar:</b> <a href="tel:0745 000 000">0745 000 000</a>
                                        </div>
                                     </div>
                                     <div class="col-md-4 col-ms-4 col-sm-4">
                                         <div class="col">
                                            <p>DATE PASAPORT</p>
                                            <b>Numar: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Data expirare: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Tara emitenta pasaport: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Nationalitate: </b><a href="#" class="edit">adauga</a><br />
                                        </div>
                                     </div>
                                     <div class="col-md-4 col-ms-4 col-sm-4">
                                         <div class="col">
                                            <p>DATE CARTE DE IDENTITATE</p>
                                            <b>Serie: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Numar: </b><a href="#" class="edit">adauga</a><br />
                                            <b>Data expirare: </b><a href="#" class="edit">adauga</a><br />
                                        </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="passenger-edit">
                                         <p>Editeaza DATE PERSONALE</p>
                                         <div class="row">
                                             <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Prenume</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Nume</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Tip pasager</span>
                                                    <select name="room" class="select__s2" style="width: 100%;">
                                                        <option value="">alege tipul de pasager</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Adresa E-mail</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Numar telefon</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Data nasterii</span>
                                                    <div class="row thw-row">
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Ziua</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Luna</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Anul</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                         </div>
                                         <p>Editeaza DATE PASAPORT</p>
                                         <div class="row">
                                             <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Tara emitere pasaport</span>
                                                    <select name="room" class="select__s2" style="width: 100%;">
                                                        <option value="">Romania</option>
                                                    </select>
                                                </label>
                                            </div>
                                             <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Nationalitate</span>
                                                    <select name="room" class="select__s2" style="width: 100%;">
                                                        <option value="">Romana</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Numar pasaport</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Data expirare pasaport</span>
                                                    <div class="row thw-row">
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Ziua</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Luna</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Anul</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Editeaza CARTE DE IDENTITATE</p>
                                         <div class="row">
                                             <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Tara emitere</span>
                                                    <select name="room" class="select__s2" style="width: 100%;">
                                                        <option value="">Romania</option>
                                                    </select>
                                                </label>
                                            </div>
                                             <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Nationalitate</span>
                                                    <select name="room" class="select__s2" style="width: 100%;">
                                                        <option value="">Romana</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Numar</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group"> <!-- has-error -->
                                                    <label class="control-label item-formular__label__text">Serie</label>
                                                    <input class="form-control" type="text" name="" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="item-formular__label">
                                                    <span class="item-formular__label__text">Data expirare</span>
                                                    <div class="row thw-row">
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Ziua</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Luna</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 thw-col">
                                                            <select name="room" class="select__s2" style="width: 100%;">
                                                                <option value="">Anul</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4 text-center">
                                                <button class="btn box-passenger-btn">inchide</button>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <button class="btn box-passenger-btn bp-btn-invert">salveaza</button>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                        <h3>Adauga pasageri</h3>
                        <div class="box passenger">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="passenger-pict"><img src="<?=$_base?>static/img/passenger.png" alt="" /></div>
                                    <div class="passenger-title">
                                        <button class="btn box-passenger-btn">adauga pasager ›</button>
                                        <a href="#"><i class="my-acc-sprite my-acc-edit"></i><span>editeaza date</span></a><br />
                                        <a href="#"><i class="my-acc-sprite my-acc-addpict"></i><span>adauga poza</span></a><br />
                                        <a href="#"><i class="my-acc-sprite my-acc-delete"></i><span>sterge date</span></a>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>