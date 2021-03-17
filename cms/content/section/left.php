<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-title">
			<?=$_site_title?>
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<li <?=($_page == "home" ? 'class="nav-active"' : '')?>>
						<a href="<?=$_base_cms?>">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span><?=_lng('dashboard')?></span>
						</a>
					</li>

					<? foreach($_sections as $key => $section){?>
						<?
				    	$found = 0;
						$found_subkey = $key;
				    	foreach($section['modules'] as $subkey => $submodule){
							if(check_admin_perm($subkey, 'view')) {
								$found++;
								if($found == 1){
									$found_subkey = $subkey;
								}
							}
						}
				    	?>

				    	<? if($found){?>

						    <li class="
						    	<? if(count($section['modules']) > 1 && $found > 1){?>
						    		nav-parent
						    		<? if($_module == $found_subkey || array_key_exists($_module, $section['modules'])){?>
						    			nav-expanded
						    		<? }?>
						    	<? }?>
						    	<? if($_module == $found_subkey || array_key_exists($_module, $section['modules'])){?>
						    		nav-active
						    	<? }?>
						    	">

								<a <? if(count($section['modules']) == 1 || $found == 1){?>href="<?=$_base_cms?>?module=<?=$found_subkey?>"<? }?> title="<?=$section['name']?>">
									<i class="fa fa-<?=($_menu_icons_to_fa[$section['menu_class']] != "" ? $_menu_icons_to_fa[$section['menu_class']] : $section['menu_class'])?>" aria-hidden="true"></i>
									<span><?=$section['name']?></span>
								</a>

								<? if(count($section['modules']) > 1 && $found > 1){?>
									<ul class="nav nav-children">
										<? foreach($section['modules'] as $subkey => $submodule){?>
							    			<? if(check_admin_perm($subkey, 'view')){?>
							    				<? if(!($submodule['do_not_show'])){?>
								    				<li <? if($_module == $subkey){?>class="nav-active"<? }?>>
														<a href="<?=$_base_cms?>?module=<?=$subkey?>" title="<?=$submodule['name']?>">
															 <?=$submodule['name']?>
														</a>
													</li>
												<? }?>
							    			<? }?>
							    		<? }?>
									</ul>
								<? }?>

							</li>

					    <? }?>
				    <? }?>

				    <? if($_extra_menu){?>
				    	<? foreach($_extra_menu as $item){?>
				    		<li>
								<a href="<?=$item['link']?>" target="<?=$item['target']?>">
									<i class="fa fa-<?=$item['icon']?>" aria-hidden="true"></i>
									<span><?=$item['name']?></span>
								</a>
							</li>
				    	<? }?>
				    <? }?>

				</ul>
			</nav>

		</div>

	</div>

</aside>
<!-- end: sidebar -->
