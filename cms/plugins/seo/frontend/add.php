<section class="panel panel-featured panel-featured-primary">

	<header class="panel-heading">
		<h2 class="panel-title pull-left">SEO</h2>
		<? if($_multiple_lang){?>
			<? $lng_keys = array_keys($_website_langs);?>

			<div class="btn-group pull-right">
				<button type="button" class="m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><span><?=$_website_langs[$lng_keys[0]]?></span> <span class="caret"></span></button>
				<ul class="dropdown-menu langtabs" role="menu">
					<? foreach($_website_langs as $lng => $lng_name){?>
						<li class="<? if($lng == $lng_keys[0]){?>active<? }?>"><a href="#" data-lang="<?=$lng?>"><?=$lng_name?></a></li>
					<? }?>
				</ul>
			</div>
		<? }?>
		<div class="clearfix"></div>
	</header>

	<div class="panel-body">

		<? $i=1; foreach($_website_langs as $lng => $lng_name){?>
		<div>
            <div class="form-group lng_<?=$lng?>" <? if($i>1){?> style="display:none;"<? }?>>
                <label class="col-md-4 col-lg-2 control-label" for="seo_title_<?=$lng?>">
                    <?=_lng('meta_title')?>
                </label>
                <div class="col-md-6 col-lg-5">
                    <input
                        type="text"
                        id="seo_title_<?=$lng?>"
                        name="seo_title_<?=$lng?>"
                        value="<?=$_POST['seo_title_'.$lng]?>"
                        class="form-control"
                        placeholder="ex: Lorem ipsum dolor"
                        data-toggle="tooltip" data-placement="left" data-original-title="<?=_lng('page_title')?>"
                    />
                </div>
            </div>

            <div class="form-group lng_<?=$lng?>" <? if($i>1){?> style="display:none;"<? }?>>
                <label class="col-md-4 col-lg-2 control-label" for="seo_keywords_<?=$lng?>">
                    <?=_lng('meta_keywords')?>
                </label>
                <div class="col-md-6 col-lg-5">
                    <input
                        type="text"
                        id="seo_keywords_<?=$lng?>"
                        name="seo_keywords_<?=$lng?>"
                        value="<?=$_POST['seo_keywords_'.$lng]?>"
                        class="form-control"
                        placeholder="ex: lorem ipsum, dolor, sit amet"
                        data-toggle="tooltip" data-placement="left" data-original-title="<?=_lng('keywords')?>"
                    />
                </div>
            </div>

            <div class="form-group lng_<?=$lng?>" <? if($i>1){?> style="display:none;"<? }?>>
                <label class="col-md-4 col-lg-2 control-label" for="seo_description_<?=$lng?>">
                    <?=_lng('meta_description')?>
                </label>
                <div class="col-md-6 col-lg-5">
                    <input
                        type="text"
                        id="seo_description_<?=$lng?>"
                        name="seo_description_<?=$lng?>"
                        value="<?=$_POST['seo_description_'.$lng]?>"
                        class="form-control"
                        placeholder="ex: Lorem ipsum dolor sit amet"
                        data-toggle="tooltip" data-placement="left" data-original-title="<?=_lng('meta_desc')?>"
                    />
                </div>
            </div>
        </div>
        <? $i++;}?>

	</div>

</section>
