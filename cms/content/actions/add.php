<form action="" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

	<div class="row">

		<div class="col-md-12 col-lg-12 col-xl-9">

			<section class="panel panel-featured panel-featured-primary">

				<header class="panel-heading">
					<h2 class="panel-title pull-left"><?=_lng('add')?></h2>
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

					<?
                    foreach($_fields as $plugin){
                    	if($plugin->hasWidget('add')){
							$plugin->widget('add', 'frontend');
						}
					}
					?>

				</div>

			</section>

			<?
		    if($_section['use_seo']){
		    	$seo_plugin->widget('add', 'frontend');
		    }
		    ?>

		</div>

		<div class="col-md-12 col-lg-12 col-xl-3">
			<section class="panel panel-featured panel-featured-primary panel-fixed">

				<header class="panel-heading">
					<h2 class="panel-title"><?=_lng('publish')?></h2>
				</header>

				<div class="panel-body">

					<?
				    if($_section['use_active']){
				    	$active_plugin->widget('add', 'frontend');
				    }
				    ?>

	                <?
				    if($_section['use_order']){
				    	$order_plugin->widget('add', 'frontend');
				    }
				    ?>

					<div class="form-group">
						<label class="col-xs-12 col-md-4 col-lg-2 col-xl-4 control-label" for="inputSuccess"><?=_lng('after_add')?></label>
						<div class="col-xs-7 col-md-5 col-xl-8">
							<select name="after" id="after" class="form-control select2">
					            <option value="list"><?=_lng('go_to_save')?></option>
					            <option value="edit" <?=($_GET['edited'] == "1" ? "selected" : "")?>><?=_lng('go_to_edit')?></option>
					        	<option value="add" <?=($_GET['added'] == "1" ? "selected" : "")?>><?=_lng('go_to_add')?></option>
					        </select>
						</div>
					</div>

				</div>

				<footer class="panel-footer">
					<div class="row">
						<div class="col-sm-12 text-right">
							<button type="submit" name="submit" class="btn btn-primary"><?=_lng('save')?></button>
						</div>
					</div>
				</footer>

			</section>
		</div>
	</div>

</form>
