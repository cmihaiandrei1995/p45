<!doctype html>
<html class="fixed <? if($_page!="login"){?>header-dark sidebar-left-sm<? }?> <?=$_COOKIE[generate_name($_site_title)]["cms"]["hide_sidebar"] ? "sidebar-left-collapsed" : "" ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<title><?=$_meta_title != "" ? $_meta_title." - ".$_site_title : $_site_title?> CMS</title>

	<!-- Web Fonts  -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=$_favicon != "" ? $_favicon : $_base_cms."assets/images/favicon.png"?>" type="image/png">
	
	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/font-awesome/css/font-awesome.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.11.4.custom.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/select2/select2.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/fileinput/fileinput.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/prettyPhoto/prettyPhoto.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/datetime/jquery-ui-timepicker-addon.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/pnotify/pnotify.custom.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="<?=$_base_cms?>assets/vendor/colorpicker/colorpicker.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=$_base_cms?>assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="<?=$_base_cms?>assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?=$_base_cms?>assets/stylesheets/theme-custom.css">

	<? if(file_exists($_base_path_cms . 'assets/custom/css/styles.css')){?>
		<!-- Project Custom CSS -->
		<link rel="stylesheet" href="<?=$_base_cms?>assets/custom/css/styles.css">
	<? }?>

	<!-- Head Libs -->
	<script src="<?=$_base_cms?>assets/vendor/modernizr/modernizr.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/jquery/jquery.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/jquery-ui/js/jquery-ui-1.11.4.custom.js"></script>

	<script type="text/javascript">
	var $_base_cms = '<?=$_base_cms?>';
	var $_module = '<?=$_module?>';
	var $_action = '<?=$_action?>';
	var $_add_link = '<?=$_add_link?>';

	var $_ajax = new Object();
	</script>
</head>
<body>
