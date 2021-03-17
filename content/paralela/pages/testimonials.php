<main>
    <div class="inner-page-intro testimonials-page-intro">
        <div class="main-filters">
            <div class="home_forms-wrapper fhw-inner">
                <div class="container">
                    <div class="row">
                         <div class="col-sm-6 col-lg-3 <?= isset($_GET['c']) && $_GET['c'] != "" ? '' : 'hidden' ?>">
                            <a href="#" id="all-testimonials">Vezi toate testimonialele</a>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3 col-ms-6 col-ms-offset-3 col-lg-4 col-lg-offset-4">
                        	<button type="button" class="btn btn-primary add-test" data-toggle="modal" data-target="#exampleModalLong">
                  			  Adauga testimonial
                  			</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container margin--top-50 testimonials-wrapper page-inner">
      <div class="row">
          <div class="col-xs-12">
              <!-- numar testimoniale -->
              <div class="page-inner-ordering">
                  <div class="row">
                      <div class="col-sm-9">
                          <!-- numar oferte -->
                          <p>[Am gasit <strong>20 testimoniale</strong>]</p>
                          <!-- end numar oferte -->
                      </div>
                      <div class="col-sm-3 text-sm-right">
                          <label>Ordonare:</label>
                          <div class="items__select__wrapper dropwdown-sortare">
                              <div class="dropdown">
                                  <button class="btn btn-primary dropdown-toggle sortare" type="button" data-toggle="dropdown"> Sortare
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu">
                                      <li <? if($_GET['srt'] == "pra" || !isset($_GET['srt'])){?> class="active" <? }?>><a href="<?= get_offer_sort_link('pra') ?>">Pret crescator</a></li>
                                      <li <? if($_GET['srt'] == "prd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('prd') ?>">Pret descrescator</a></li>
                                      <li <? if($_GET['srt'] == "dsc"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('dsc') ?>">Discount</a></li>
                                      <!--
                                      <li <? if($_GET['srt'] == "ta"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('ta') ?>">Titlu A-Z</a></li>
                                      <li <? if($_GET['srt'] == "td"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('td') ?>">Titlu Z-A</a></li>
                                      <li <? if($_GET['srt'] == "na"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('na') ?>">Nr zile crescator</a></li>
                                      <li <? if($_GET['srt'] == "nd"){?> class="active" <? }?>><a href="<?= get_offer_sort_link('nd') ?>">Nr zile descrescator</a></li>
                                      -->
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- end numar testimoniale -->
          </div>
      </div>

      <div class="row">
          <div class="col-xs-12 col-md-3">
              <!-- filtre testimoniale -->
              <div class="testimonials-oferte-tab-list">
                  <div class="testimonials-oferte-tab-list-title">[Toate testimonialele]</div>
                  <ul class="nav nav-pills">
                      <li><a href="#"><span class="testimonials-oferte-tab-list__text">[Austria 1]</span></a></li>
                      <li><a href="#"><span class="testimonials-oferte-tab-list__text">[Anglia 5]</span></a></li>
                      <li><a href="#"><span class="testimonials-oferte-tab-list__text">[Azerbaijan 3]</span></a></li>
                  </ul>
              </div>
              <!-- end filtre testimoniale -->
          </div>
          <div class="col-xs-12 col-md-9">
            <? if($_testimonials){  ?>
                <div class="row guid-clients-testimonials grid">
                  	<?  foreach($_testimonials as $item){  ?>
                  		<div class="col-xs-12 guid-client-col">
    	                    <div class="guid-client">
                                <p>
                                    <span class="author"><?= $item['name'] ?></span> a fost in
                                    <? if($item['title'] != ""){?>
        	                        	<span class="location"><?= $item['title'] ?></span> pe
        	                        <? }?>
                                    <span class="date"><?= date("d.m.Y", strtotime($item['date'])) ?></span>
                                    <br>
                                    [zona noua rating stelute]
                                    <? if($item['stars'] > 0){?>
                    					<span>
                    						<? for($i=1; $i<=$item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
                    					</span>
                    				<? }?>
                                </p>

    	                        <?= $item['description'] ?>
    	                        <? if($item['images']){?>
        	                        <ul class="list-unstyled">
        	                        	<? foreach($item['images'] as $img){ ?>
        	                            <li><a class="fancybox" rel="group" href="<?= $img['big'] ?>"><img src="<?= $img['small'] ?>" alt="<?= $item['title'] ?>" width="44"></a></li>
        	                           <? } ?>
        	                        </ul>
    	                        <? } ?>

                                <?php if(trim(strip_tags($item['reply'])) != ""){ ?>
                                    <!--raspuns Paralela45-->
                                    <div class="feeback-45">
                                        <p class="hh45"><img src="<?=$_base?>static/img/feedback-logo.png"> raspunde:</p>
                                        <?=$item['reply']?>
                                    </div>
                                <?php } ?>
    	                    </div>
                       </div>
    				<?  } ?>
                </div>

                <div class="col-md-12 pull-right text-center">
                     <?php print_pagination(array('items_count' => $_count, 'per_page' => $_ipp))?>
    	        </div>

                <? }else{?>
                 	<div class="row">
        	         	 <div class="col-md-12">
        					<h3>Nu s-a gasit niciun rezultat</h3>
        				</div>
        			</div>
             	<? } ?>
            </div>
        </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong"  role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
       <div class="form-training">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
				<div class="">
		              <div class="hr-title text-left">
		                <h3 class="hr-title__text">Adauga testimonial</h3>
		              </div>

							<? if($_valid && isset($_POST['submit'])){

								echo "<script>
						         $(window).load(function(){
						             $('#exampleModalLong').modal('show');
						         });
						    </script>";

								?>
							<div class="success-form text-center">
						        <span class="title"><? _e('Va multumim!')?></span>

						    </div>
						    <br><br><br>
						<? }else{?>

						<form class="job-apply " action="#exampleModalLong" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-5">

								<div class="form-control-div">

									<label>Titlu*</label>
									<input type="text" name="title" value="<?=$_form['title']?>" class="form-control" />

									<? if($_errors['title'] != ""){?>
					            		<span class="error"><?=$_errors['title']?></span>
					            	<? }?>
								</div>

								<div class="form-control-div">

									<label>Nume complet*</label>
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

									<label>Tara*</label>
									<select name="country" id="country-test" class="form-control aside-filters__select">
										<option value="">Alege tara</option>
										<? foreach($_countries_form as $country){ ?>
											<option value="<?= $country['id_country'] ?>" <?= $country['id_country'] ==  $_form['country'] ? "selected='selected'" : '' ?>><?= $country['title'] ?></option>
										<? } ?>
									</select>

									<? if($_errors['country'] != ""){?>
					            		<span class="error"><?=$_errors['country']?></span>
					            	<? }?>
								</div>

								<div class="form-control-div">

									<label>Oras*</label>
									<select name="city" id="city-test" class="form-control aside-filters__select" disabled>
										<option>Alege oras</option>
									</select>

									<? if($_errors['city'] != ""){?>
					            		<span class="error"><?=$_errors['city']?></span>
					            	<? }?>
								</div>
							</div>
							<div class="col-sm-7 textarea-div">
                                <div>
									<label>Povesteste-ne*</label>
									<textarea name="description" class="form-control" ><?=$_form['description']?></textarea>
									<? if($_errors['description'] != ""){?>
					            		<span class="error"><?=$_errors['description']?></span>
					            	<? }?>
                                </div>
                                <div>
                                    <p>[Ce nota ai da experientei tale?]</p>
                                    <? if($item['stars'] > 0){?>
                    					<span>
                    						<? for($i=1; $i<=$item['stars']; $i++){?><i class="sprite sprite-star"></i><? }?>
                    					</span>
                    				<? }?>
                                </div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-sm-12">
								<button type="submit" name="submit" class="btn--green">Trimite</button>
							</div>
                        </div>
					</form>

						<?  }
						if(!$_valid && isset($_POST['submit'])){
								echo "<script>
						         $(window).load(function(){
						             $('#exampleModalLong').modal('show');
						         });
						    </script>";
							 }
						 ?>

					</div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
