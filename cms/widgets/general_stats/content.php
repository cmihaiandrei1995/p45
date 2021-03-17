<div class="grid-item col-md-6 col-lg-12 col-xl-6">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('website_stats')?></h2>
		</header>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table mb-none table-hover table-striped">
					<thead>
						<tr>
							<th width="60%">&nbsp;</th>
							<th class="text-center"><?=_lng('records')?></th>
							<th class="text-center"><?=_lng('active')?></th>
							<th class="text-center"><?=_lng('inactive')?></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($site_stats as $section => $info){?>
                    		<? if(count($info) > 1){?>
                    			<tr>
									<td colspan="4"><b><?=$section?></b></td>
								</tr>
                    		<? }?>
                    		<? $mi = 0; foreach($info as $module => $inf){?>
                    			<tr <? if($mi%2 == 0){?>class="odd"<? }?>>
									<td>
										<? if(count($info) > 1){?>
											&nbsp;&nbsp;&nbsp;
											<a href="<?=$_base_cms?>?module=<?=$inf['module']?>"><?=$module?></a>
										<? }else{ ?>
											<b><a href="<?=$_base_cms?>?module=<?=$inf['module']?>" style="color:#777;"><?=$module?></a></b>
										<? }?>
									</td>
									<td class="text-center text-success"><b><?=$inf['nr_recs']?></b></td>
									<td class="text-center"><?=$inf['nr_active']?></td>
									<td class="text-center"><?=$inf['nr_inactive']?></td>
								</tr>
	                        <? $mi++; }?>
                        <? }?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
