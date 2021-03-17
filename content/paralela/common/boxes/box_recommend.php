<?
list($_recommend, $count_recommend) = get_posts(array(
	'table' => 'box_recommend',
	'images' => 1,
	'limit' => 3
));

if($_recommend){
?>
    <div class="container-fluid hide-print <? if(!$_box_mobile[24] && $_page == "home"){?>hidden-xs<? }?>">
    	<div class="row">
    		<div class="container">
    			<div class="row">
    				<div class="col-xs-12 hr-title">
    					<hr class="hr-title__hr">
    					<h3 class="hr-title__text text-uppercase text--blue">Recomandari Paralela 45</h3>
    				</div>
    			</div>
    			<div class="row avantaje">
    				<? foreach($_recommend as $item){?>
    					<div class="col-ms-4 col-sm-4 avantaje__item">
    						<a class="avantaje__item__link hover-opacity" href="<?=$item['url']?>" target="_blank">
    							<img class="avantaje__item__img img-responsive" src="<?=$item['images'][0]['small']?>" alt="<?=$item['title']?>">
								<? /*
    							<div class="avantaje__item__wrapper avantaje__item__wrapper--blue text--white text-center">
    								<h4 class="avantaje__item__title text-uppercase"><?=$item['title']?></h4>
    							</div>
								*/ ?>
    						</a>
    					</div>
    				<? }?>
    			</div>
    		</div>
    	</div>
    </div>
<? }?>
