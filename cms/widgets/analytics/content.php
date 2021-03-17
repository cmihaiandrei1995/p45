<div class="grid-item col-md-6 col-lg-12 col-xl-6">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title pull-left">Google Analytics</h2>
			<? if($ga_analytics_token['value'] != "" && is_admin()){?>
				<a href="#" class="pull-right" id="ga_reset_account"><?=_lng('ga_reset_account')?></a>
			<? }?>
			<div class="clear"></div>
		</header>
		<div class="panel-body">
			<? if($ga_analytics_token['value'] != "" && $ga_analytics_profile['value'] != ""){?>

				<div class="row">
					<label class="control-label mr-top-5 col-md-3"><?=_lng('show_stats')?>:</label>
					<div class="col-md-3">
						<select class="form-control select2 ga-data-change" id="ga_date">
							<option value="today" selected="selected"><?=_lng('today')?></option>
							<option value="yesterday"><?=_lng('yesterday')?></option>
							<option value="7daysAgo"><?=_lng('last7')?></option>
							<option value="14daysAgo"><?=_lng('last14')?></option>
							<option value="30daysAgo"><?=_lng('last30')?></option>
							<option value="90daysAgo"><?=_lng('last90')?></option>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control select2 ga-data-change" id="ga_metrics">
							<option value="sessions" selected="selected"><?=_lng('visits')?></option>
							<option value="users"><?=_lng('unique')?></option>
							<option value="pageviews"><?=_lng('page_views')?></option>
							<option value="organicSearches">Organic search</option>
							<option value="visitBounceRate">Bounce rate</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>

				<div id="ga-body" style="min-height:280px">
					<div id="ga-loading" style="position: absolute; left: 47%; top: 50%;">
						<i class="fa fa-spinner fa-spin" style="font-size:40px;"></i>
					</div>

					<div id="ga-results" style="display:none;">
						<div class="chart chart-sm" id="ga-chart-data"></div>

						<hr class="solid short mt-lg">

						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-sessions"></div>
							<p class="text-xs text-muted mb-none"><?=_lng('visits')?></p>
						</div>
						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-users"></div>
							<p class="text-xs text-muted mb-none"><?=_lng('unique')?></p>
						</div>
						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-hits"></div>
							<p class="text-xs text-muted mb-none"><?=_lng('page_views')?></p>
						</div>
						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-bounce"></div>
							<p class="text-xs text-muted mb-none">Bounce rate</p>
						</div>
						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-organic"></div>
							<p class="text-xs text-muted mb-none">Organic search</p>
						</div>
						<div class="col-md-2">
							<div class="h4 text-bold mb-none mt-lg" id="ga-data-pages"></div>
							<p class="text-xs text-muted mb-none"><?=_lng('page_per_visit')?></p>
						</div>
					</div>
					<div class="clear"></div>
				</div>

			<? }elseif($ga_analytics_token['value'] != "" && $ga_analytics_profile['value'] == ""){?>

				<div class="form-group">
					<?=_lng('ga_choose_profile')?>
				</div>
				<div class="form-group row">
					<div class="col-md-3">
						<select name="ga_widget_account" id="ga_widget_account" class="form-control" placeholder="<?=_lng('ga_choose_account')?>">
							<? if(count($_ga_profiles)){?>
								<option value=""><?=_lng('ga_choose_account')?></option>
								<? foreach($_ga_profiles as $profile){?>
									<option value="<?=$profile['id']?>"><?=$profile['text']?></option>
								<? }?>
							<? }else{?>
								<option value=""><?=_lng('ga_no_account')?></option>
							<? }?>
						</select>
					</div>
					<div class="col-md-3">
						<select name="ga_widget_profile" id="ga_widget_profile" class="form-control" disabled placeholder="<?=_lng('ga_choose_a_profile')?>"></select>
					</div>
					<div class="col-md-3">
						<select name="ga_widget_view" id="ga_widget_view" class="form-control" disabled placeholder="<?=_lng('ga_choose_a_view')?>"></select>
					</div>
					<div class="col-md-1">
						<button class="btn btn-primary mr-left-20" id="save_ga_widget_profile" disabled><?=_lng('save')?></button>
					</div>
				</div>

			<? }else{ ?>

				<div class="form-group">
					<?=_lng('ga_needs_auth')?>
					<?=_lng('use')?> <a href="<?=$ga_authUrl?>" target="_blank"><?=_lng('this_link')?></a> <?=_lng('ga_to_generate')?>
				</div>
				<div class="form-group">
					<input type="text" class="form-control pull-left ga_widget_token" name="ga_widget_token" placeholder="<?=_lng('access_code')?>" style="width:50%">
					<button class="btn btn-primary mr-left-20 save_ga_widget_token"><?=_lng('save')?></button>
				</div>

			<? }?>
		</div>
	</section>
</div>

<?php enqueue_script('analytics-main', $_base_cms.'widgets/analytics/js/main.js', 'home') ?>

<?php enqueue_script('flot', $_base_cms.'widgets/analytics/js/flot/jquery.flot.min.js', 'home', -10) ?>
<?php enqueue_script('flot-tooltip', $_base_cms.'widgets/analytics/js/flot-tooltip/jquery.flot.tooltip.js', 'home') ?>
<?php enqueue_script('flot-categories', $_base_cms.'widgets/analytics/js/flot/jquery.flot.categories.min.js', 'home') ?>
<?php enqueue_script('flot-time', $_base_cms.'widgets/analytics/js/flot/jquery.flot.time.min.js', 'home') ?>
<?php enqueue_script('flot-resize', $_base_cms.'widgets/analytics/js/flot/jquery.flot.resize.min.js', 'home') ?>