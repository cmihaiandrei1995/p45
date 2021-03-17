<? if(!isset($_GET['popup'])){ ?>

	<!-- start: header -->
	<header class="header">
		<div class="logo-container">
			<a href="<?=$_cms_link != "" ? $_cms_link : "https://www.prologue.ro/" ?>" target="_blank" class="logo">
				<img src="<?=$_inner_logo != "" ? $_inner_logo : $_base_cms."assets/images/logo-light.png"?>" height="35" alt="<?=$_site_title?>" />
			</a>
			<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
				<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
			</div>
		</div>
	
		<!-- start: search & user box -->
		<div class="header-right">
	
			<ul class="notifications">
				<? if(debug_mode()){?>
					<li  data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('run_setup')?>">
						<a href="<?=$_base_cms?>setup.php" target="_blank" class="notification-icon">
							<i class="fa fa-cogs"></i>
						</a>
					</li>
					<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('run_update')?>">
						<a href="<?=$_base_cms?>update.php" target="_blank" class="notification-icon">
							<i class="fa fa-cloud-download"></i>
						</a>
					</li>
					<li class="hidden-xxs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<? }?>
				<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('dashboard')?>">
					<a href="<?=$_base_cms?>" class="notification-icon">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li>
					<a href="<?=$_base?>" target="_blank" class="notification-icon" data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('website')?>">
						<i class="fa fa-mail-forward"></i>
					</a>
				</li>
				<? if(count($_cms_langs) > 1){?>
					<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('cms_lang')?>">
						<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
							<i class="fa fa-flag"></i>
						</a>
						<ul class="dropdown-menu" role="menu">
							<? foreach($_cms_langs as $lng => $lng_name){?>
								<li>
									<a href="<?=$_base_cms?>bounce.php?action=lng&val=<?=$lng?><?=$_add_link?>" class="clearfix">
										<span class="title"><?=$lng_name?></span>
									</a>
								</li>
							<? }?>
						</ul>
					</li>
				<? }?>
				<? if(is_admin()){?>
					<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('users')?>">
						<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
							<i class="fa fa-user"></i>
						</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?=$_base_cms?>?module=admin_users" class="clearfix">
									<i class="fa fa-user"></i> &nbsp;<?=_lng('users')?>
								</a>
							</li>
							<li>
								<a href="<?=$_base_cms?>?module=admin_groups" class="clearfix">
									<i class="fa fa-users"></i> <?=_lng('groups')?>
								</a>
							</li>
							<li>
								<a href="<?=$_base_cms?>?module=admin_user_login" class="clearfix">
									&nbsp;<i class="fa fa-info"></i> &nbsp;&nbsp;<?=_lng('login_history')?>
								</a>
							</li>
							<li>
								<a href="<?=$_base_cms?>?module=admin_action" class="clearfix">
									<i class="fa fa-history"></i> &nbsp;<?=_lng('actions_log')?>
								</a>
							</li>
						</ul>
					</li>
					<? if($_config['server']['memcache'] || $_config['server']['file_cache']){?>
						<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('clear_cache')?>" class="cache-toggle">
							<a href="#" class="dropdown-toggle notification-icon">
								<i class="fa fa-server"></i>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="#" class="clearfix clear_cms_cache">
										<i class="fa fa-cog"></i> &nbsp;<?=_lng('clear_cms_cache')?>
									</a>
								</li>
								<li>
									<a href="#" class="clearfix clear_all_cache">
										<i class="fa fa-cogs"></i> <?=_lng('clear_all_cache')?>
									</a>
								</li>
							</ul>
						</li>
					<? }?>
		    	<? }?>
		    	<li data-toggle="tooltip" data-placement="bottom" data-original-title="<?=_lng('logout')?>">
					<a href="<?=$_base_cms?>?login&action=logout" class="notification-icon">
						<i class="fa fa-power-off"></i>
					</a>
				</li>
			</ul>
	
			<span class="separator"></span>
	
			<div id="userbox" class="userbox">
				<a href="#" data-toggle="dropdown">
					<div class="profile-info">
						<span class="hidden-xxs-up"><img src="<?=$_base_cms?>assets/images/admin.png"></span>
						<span class="name hidden-xxs"><?=$_SESSION[$_site_title]['cms']['title']?></span>
						<span class="role hidden-xxs"><?=$_SESSION[$_site_title]['cms']['user_group']?></span>
					</div>
					<i class="fa custom-caret"></i>
				</a>
	
				<div class="dropdown-menu">
					<ul class="list-unstyled">
						<li class="hidden-xxs-up">
							<div class="profile-info-responsive">
								<span class="name"><?=$_SESSION[$_site_title]['cms']['title']?></span>
								<span class="role"><?=$_SESSION[$_site_title]['cms']['user_group']?></span>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<a role="menuitem" tabindex="-1" href="<?=$_base_cms?>?module=admin_users&action=edit&id=<?=$_SESSION[$_site_title]['cms']['id_admin_user']?>"><i class="fa fa-user"></i> <?=_lng('account_data')?></a>
						</li>
						<li>
							<a role="menuitem" tabindex="-1" href="<?=$_base_cms?>?login&action=logout"><i class="fa fa-power-off"></i> <?=_lng('logout')?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- end: search & user box -->
	</header>
	<!-- end: header -->
	
<? }?>
