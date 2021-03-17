<? if($_banners){?>
    <div class="container-fluid wicover">
        <div class="container">
            <div class="row">
                <? foreach($_banners as $banner){?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                    	<div class="lp-vacations-box-interior">
                        <? if($banner['url'] != ""){?>
                        <a href="<?=$banner['url']?>">
                        <? }?>
                            <img src="<?=$banner['images'][0]['small']?>" />
                            <div class="text-hover-vacantions">
                                <? if($banner['title'] != ""){?>
                            		<h3><?=$banner['title']?></h3>
                                <? }?>
                                <? if($banner['subtitle'] != ""){?>
                            		<p><?=$banner['subtitle']?></p>
                                <? }?>
                        	</div>
                        <? if($banner['url'] != ""){?>
                        </a>
                        <? }?>
                        </div>
                    </div>
                <? }?>
            </div>
        </div>
    </div>
<? }?>
