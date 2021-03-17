<? if(count($_xml_news)){?>
	<div class="grid-item col-md-6 col-lg-12 col-xl-6">
		<section class="panel">
			<header class="panel-heading">
				<h2 class="panel-title">Prologue News</h2>
			</header>
			<div class="panel-body">
				<ul class="simple-user-list">
					<? foreach($_xml_news['rss']['channel']['item'] as $item => $val) {?>
						<li>
							<span class="uText">
								<span class="title"><a href="<?=$val['link']['value']?>?&utm_source=CMS&utm_medium=Click&utm_campaign=<?=urlencode($val['title']['value'])?>" target="_blank"><?=$val['title']['value']?></a></span>
								<span class="message truncate"><?=limit_text($val['description']['value'], 100)?></span>
							</span>
							<span class="uDate"><span class="uDay"><?=date("d", strtotime($val['pubDate']['value']))?></span><?=date("M", strtotime($val['pubDate']['value']))?></span>
						</li>
					<? }?>
				</ul>
			</div>
		</section>
	</div>
<? }?>