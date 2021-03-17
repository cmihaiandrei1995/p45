
<main>
  <div class="container margin--top-30">
        <div class="row">
          <div class="col-xs-12">
              <div class="hr-title">
                  <h3 class="hr-title__text text--blue">Ghizi cu experienta pentru vacantele tale</h3>
              </div>
          </div>
          <div class="col-xs-12">
              <div class="row">
                  <div class="col-md-4">
                      <div class="guid">
                          <div class="guid-pict-name flex-container">
                          	<? if($_item['file']){ ?>
                            <img src="<?= $_base ?>uploads/images/<?= $_item['file_path']?>large-<?= $_item['file']?>" alt="<?= $_item['title'] ?>" class="img" />
                            <? } ?>
                            <p class="name"><?= $_item['title'] ?></p>
                        </div>
                        <? if($_item['description']){ ?>
                        	<?= $_item['description'] ?>
                        <? } ?>
                        <!--
                        <div class="text-center">
                            <a href="#"><i class="sprite-guid-social fb"></i></a>
                            <a href="#"><i class="sprite-guid-social video"></i></a>
                        </div>
                        -->
                    </div>
                  </div>
                  <div class="col-md-8">
                  	<? if($_item['images']){ ?>
                    <div class="swiper-container swiper-item__main">
                      <div class="swiper-wrapper">
                      	<? foreach($_item['images'] as $img){?>
                          <div class="swiper-slide"><img class="swiper-item__main__img object-fit" src="<?= $img['big'] ?>" alt="<?= $_item['title'] ?>"></div>
                          <? } ?>
                      </div>
                      <div class="swiper-button-next hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
                      <div class="swiper-button-prev hidden-sm hidden-md hidden-lg"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
                    </div>
                    <div class="swiper-item__thumbs hidden-xs">
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                        	<? foreach($_item['images'] as $img){ ?>
                            	<div class="swiper-slide"><img class="swiper-item__thumbs__img object-fit" src="<?= $img['thumb'] ?>" alt="<?= $_item['title'] ?>"></div>
                             <? } ?>
                        </div>
                      </div>
                      <div class="swiper-button-next"><i class="sprite sprite-swipe-right-blue-white-l"></i></div>
                      <div class="swiper-button-prev"><i class="sprite sprite-swipe-left-blue-white-l"></i></div>
                    </div>
                    <? } ?>
                  </div>
              </div>
          </div>
        </div>
    </div>

    <? if($_testimonials){ ?>
    <div class="container guide-testimonial margin--top-50">
        <div class="row">
          <div class="col-xs-12 hr-title">
            <h3 class="hr-title__text">Ce spun clientii  nostri</h3>
          </div>
      </div>
      <div class="row guid-clients-testimonials grid">
        <?  foreach($_testimonials as $item){  ?>
      		<div class="col-md-4 col-sm-6 col-xs-12 guid-client-col">
                <div class="guid-client">
                    <?= $item['description'] ?>
                    <? if($item['images']){?>
                    <ul class="list-unstyled">
                    	<? foreach($item['images'] as $img){ ?>
                        <li><a class="fancybox" rel="group" href="<?= $img['big'] ?>"><img src="<?= $img['small'] ?>" alt="<?= $item['title'] ?>"></a></li>
                       <? } ?>
                    </ul>
                    <? } ?>
                    <p class="author"><?= $item['name'] ?></p>
                    <p>
                        <span class="location"><?= $item['location'] ?>, </span>
                        <span class="date"><?= $item['date'] ?></span>
                    </p>
                </div>
           </div>
		<?  } ?>
  	</div>
  </div>
  <!-- </div> -->
  <? } ?>
</main>
