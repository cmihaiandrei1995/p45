<?
$_filter_action = "order";
include $_base_path_cms . 'content/modules/filters.php';
?>

<section class="panel panel-featured panel-featured-primary">

	<header class="panel-heading">
		<div class="panel-actions">
			<? if($_multiple_lang){?>
				<? $lng_keys = array_keys($_website_langs);?>

				<div class="btn-group pull-right">
					<button type="button" class="m-none btn btn-default dropdown-toggle" data-toggle="dropdown"><span><?=$_website_langs[$_SESSION[$_site_title]['cms']['lang_rec']]?></span> <span class="caret"></span></button>
					<ul class="dropdown-menu langtabs classic" role="menu">
						<? foreach($_website_langs as $lng => $lng_name){?>
							<li class="<? if($lng == $_SESSION[$_site_title]['cms']['lang_rec']){?>active<? }?>">
								<a href="<?=$_base_cms?>bounce.php?action=lng_rec&val=<?=$lng?>&where=order<?=$_add_link?>"><?=$lng_name?></a>
							</li>
						<? }?>
					</ul>
				</div>
			<? }?>
		</div>

		<h2 class="panel-title"><?=_lng('order_now')?></h2>
	</header>

	<div class="panel-body">

		<?
		$_filter_action = "order";
		include $_base_path_cms . 'content/modules/filters_set.php';
		?>

        <div class="body">

			<? if($_section['use_parent_for_view'] && !$_SESSION[$_site_title]['cms']['filter_order'][$_module][$_section['table'].".".$_section['use_parent_for_view_field']]){?>

				<div class="alert alert-warning">
					<i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;
					Pentru a putea ordona inregistrarile subordonate, filtreaza dupa campul "<?=$_section['fields'][$_section['use_parent_for_view_field']]['name']?>".
				</div>

			<? } ?>

        	<form id="order_form" action="" class="form" method="post" enctype="multipart/form-data">
	        	<div class="row show-grid">
					<div class="col-md-5">
						<div class="form-group">
							<label class="control-label"><?=_lng('fast_search')?>:</label>
							<div class="input-group">
								<input type="text" id="box1Filter" class="form-control" />
								<span class="input-group-btn">
									<button class="btn btn-default" id="box1Clear" type="button"><i class="fa fa-close"></i></button>
								</span>
							</div>
						</div>
						<div class="form-group">
			                <select id="box1View" name="box1View[]" multiple="multiple" class="form-control height300">
			                	<? foreach($records as $record){?>
			                    	<option value="<?=$record[$_section['id']]?>">
			                    		<? if($_order_fields){?>
			                    			<? foreach($_order_fields as $k => $fld){?>
			                    				<?=$record[$fld]?>
			                    				<? if($k < count($_order_fields)-1){?> - <? }?>
			                    			<? }?>
			                    		<? }else{?>
			                    			<?=$record[$_order_field]?>
			                    		<? }?>
			                    	</option>
			                    <? }?>
			                </select>
			                <input type="hidden" name="box1ViewValues">
			                <span id="box1Counter" class="help-block"></span>
		                </div>
		                <span id="box1Counter" class="countLabel"></span>

		                <div class="hide">
		                	<select id="box1Storage" name="box1Storage"></select>
		                </div>
					</div>

					<div class="col-md-2 text-center order-buttons">
						<button id="to2" type="button" class="mb-xs mt-xs mr-xs btn btn-default"><span class="fa fa-angle-right"></span></button>
						<button id="allTo2" type="button" class="mb-xs mt-xs mr-none btn btn-default"><span class="fa fa-angle-double-right"></span></button>

						<br>

						<button id="to1" type="button" class="mb-xs mt-xs mr-xs btn btn-default"><span class="fa fa-angle-left"></span></button>
						<button id="allTo1" type="button" class="mb-xs mt-xs mr-none btn btn-default"><span class="fa fa-angle-double-left"></span></button>

						<br><br>

						<button type="submit" name="submit" id="order_submit" class="btn btn-primary"><?=_lng('save')?></button>
					</div>

					<div class="col-md-5">
						<div class="form-group">
							<label class="control-label"><?=_lng('fast_search')?>:</label>
							<div class="input-group">
								<input type="text" id="box2Filter" class="form-control" />
								<span class="input-group-btn">
									<button class="btn btn-default" id="box2Clear" type="button"><i class="fa fa-close"></i></button>
								</span>
							</div>
						</div>
		                <div class="form-group">
		                	<select id="box2View" name="box2View[]" multiple="multiple" class="form-control height300"></select>
		                	<input type="hidden" name="box2ViewValues">
		                	<span id="box2Counter" class="help-block"></span>
		                </div>

		                <div class="hide">
		                	<select id="box2Storage" name="box2Storage" class="form-control"></select>
		                </div>
					</div>
				</div>
        	</form>

        </div>

	</div>
</section>
