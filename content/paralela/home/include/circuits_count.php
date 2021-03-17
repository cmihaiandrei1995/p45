<div class="container-fluid circuite circuite--light-blue circuite--border-bottom hidden-xxs <? if(!$_box_mobile[2]){?>hidden-xs<? }?>">
	<div class="row">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="circuite-list list-unstyled list-inline">
						<? foreach($_circuit_continents_homepage as $continent){?>
							<? if($_continent_id_to_css[$continent['id_continent']] != ""){?>
								<li class="circuit text-center">
									<a class="circuit-link hover-opacity" href="<?=$continent['url']?>" title="Circuite <?=$continent['title']?>">
										<div class="circuit-continent position-relative">
											<i class="sprite sprite-circuit-<?=$_continent_id_to_css[$continent['id_continent']]?> position-center"></i>
											<span class="circuit-continent-number-container position-center"><strong class="circuit-continent-number position-center"><?=$continent['count']?></strong></span>
										</div>
										<h3 class="circuit-continent-title text--white">Circuite <br> <?=$continent['title']?></h3>
									</a>
								</li>
							<? }?>
						<? }?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
