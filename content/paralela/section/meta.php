<?
foreach($_offer_filter_links as $lnk){
	if($_GET[$lnk] != ""){
		$_no_index = true;
	}
}
if($_GET['d'] != "" || $_GET['t'] != "" || isset($_GET['error'])){
	$_no_index = true;
}
?>

<? /*
<!-- start Omniconvert.com code -->
<link rel="dns-prefetch" href="//app.omniconvert.com" />
<script type="text/javascript">window._mktz=window._mktz||[];</script>
<script src="//cdn.omniconvert.com/js/z70c4e7.js" async></script>
<!-- end Omniconvert.com code -->
*/ ?>

<meta charset="utf-8">
<meta name="language" http-equiv="content-language" content="<?=$_lang?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title><?=$_meta_title . (isset($_params['page']) ? " - Pagina ".$_params['page'] : "")?> | Paralela 45</title>
<meta name="description" itemprop="description" content="<?=$_meta_description?>">
<meta name="keywords" itemprop="keywords" content="<?=$_meta_keywords?>">

<link rel="shortcut icon" href="<?php urle('img/favicon.png', 'static') ?>" type="image/png">
<link rel="icon" href="<?php urle('img/favicon.ico', 'static') ?>" type="image/x-icon">

<? if($_do_not_include_header){?>
<base target="_parent">
<? }?>

<meta name="expires" content="never">
<meta name="revisit-after" content="1 Days">
<? if($_no_index){?>
<meta name="robots" content="noindex, follow">
<? }else{?>
<meta name="robots" content="index, follow">
<? }?>

<? if($_canonical){?>
<link rel="canonical" href="<?=$_canonical?>">
<? }?>

<? if($_nr_pages > 1 && !isset($_params['page'])){?>
	<link rel="next" href="http<?=($_config['site']['use_https'] ? "s" : "")?>://<?=$_config['site']['domain'].$_SERVER['REQUEST_URI'].$_config['paging']['page_link']."2/"?>" />
<? }elseif($_nr_pages > 1 && isset($_params['page'])){?>
	<? if($_params['page'] == 1){?>
		<link rel="next" href="http<?=($_config['site']['use_https'] ? "s" : "")?>://<?=$_config['site']['domain'].$_SERVER['REQUEST_URI'].$_config['paging']['page_link']."2/"?>" />
	<? }elseif($_params['page'] == $_nr_pages){?>
		<link rel="prev" href="http<?=($_config['site']['use_https'] ? "s" : "")?>://<?=$_config['site']['domain'].str_replace($_config['paging']['page_link'].$_params['page'], $_config['paging']['page_link'].($_params['page']-1), $_SERVER['REQUEST_URI'])?>" />
	<? }else{?>
		<link rel="next" href="http<?=($_config['site']['use_https'] ? "s" : "")?>://<?=$_config['site']['domain'].str_replace($_config['paging']['page_link'].$_params['page'], $_config['paging']['page_link'].($_params['page']+1), $_SERVER['REQUEST_URI'])?>" />
		<link rel="prev" href="http<?=($_config['site']['use_https'] ? "s" : "")?>://<?=$_config['site']['domain'].str_replace($_config['paging']['page_link'].$_params['page'], $_config['paging']['page_link'].($_params['page']-1), $_SERVER['REQUEST_URI'])?>" />
	<? }?>
<? }?>


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet" href="<?php urle('js/fancybox/jquery.fancybox.css?v=2.1.5', 'static') ?>" type="text/css" media="screen">

<link rel="stylesheet" href="<?php urle('css/vendor/jquery-ui.min.css', 'static') ?>">
<link rel="stylesheet" href="<?php urle('css/vendor/weather-icons.min.css', 'static') ?>">
<link rel="stylesheet" href="<?php urle('css/vendor/flipclock.css', 'static') ?>">
<!-- <link rel="stylesheet" href="<?php urle('css/vendor/weather-icons-wind.min.css', 'static') ?>"> -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php urle('css/style.css', 'static') ?>?v=<?=date('Ymd')?>">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>-->

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script type="text/javascript">
    var $_base = '<?=$_base?>';

    var $_room_types = $.parseJSON('<?=json_encode($_circuit_room_types)?>');

	var ecommTrackImp = [];
	var rmkFbTrackPrice = [];
	var rmkFbTrackIds = [];
	var rmkEventType = "";
    var rmkGTrackItems = [];

    $.datepicker.regional['ro'] = {
      closeText: 'Inchide',
      prevText: 'Anterior',
      nextText: 'Urmatorul',
      currentText: 'Curent',
      monthNames: [
      	'Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie',
      	'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'
      ],
      monthNamesShort: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec'],
      dayNames: ['Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata'],
      dayNamesShort: ['Dum', 'Lun', 'Mar', 'Mie', 'Joi', 'Vin', 'Sam'],
      dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sa'],
      weekHeader: 'Saptamana'
  	};

  	$.datepicker.setDefaults($.datepicker.regional['ro']);
</script>

<? include $_theme_path."section/tracking.php"; ?>
