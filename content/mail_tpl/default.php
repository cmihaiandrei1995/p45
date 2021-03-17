<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
		a:hover {text-decoration:none !important;}
		a img {border:0;}
		p {font-size:14px !important; line-height:1.4 !important; margin:10px 0 !important;}
	</style>
</head>
<body style="margin:0; padding:0; min-width: 100%!important;">
<table align="center" cellpadding="0" cellspacing="0" width="100%" style="margin:0; margin-top:40px; margin-bottom: 50px;">
    <tr><td>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border:3px solid #2f4ea1; width:100%; max-width:700px;">
            <tr><td>
                <table cellpadding="0" cellspacing="0" style="width:80%; margin:auto; font-family:'Calibri'; font-size:14px; color:#1b114d; margin-bottom:30px;">
                    <tr><td align="center"><br><a target="_blank" href="<?=$_base?>"><img src="<?=urle('img/logo.png', 'static')?>" border="0" /></a></td></tr>
                    <tr><td height="30"></td></tr>
                    <tr><td align="left">
                    	<? if($content['title'] != ""){?>
                        	<span style="font-size:20px; color:#2f4ea1;"><?=$content['title']?></span>
                        <? }?>
						<br>
                        <?=$content['content']?>
                    </td></tr>
                    <tr><td height="39" style="border-bottom:1px solid #2f4ea1;"></td></tr>
                    <tr><td height="20"></td></tr>
                    <tr><td>
                        <a href="<?=$_base?>" style="font-size:14px; color:#2f4ea1; text-decoration: none; font-weight:bold;"><span style="color:#2f4ea1;">Paralela 45</span></a>
                    </td></tr>
                </table>
            </td></tr>
        </table>
    </td></tr>
</table>
</body>
</html>
