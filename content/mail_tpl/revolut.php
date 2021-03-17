<?
global $_base_static, $_base;
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!--[if mso]><style type="text/css">
        .disclaimer {font-size:10px !important;}
        .footer-links {font-size:11px !important;}
    </style><![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,660' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        .menu-text {
            padding: 10px;
        }

        .menu-text, .title-text {
            font-size: 16px !important;
        }

        .categ-text  {
            font-size: 14px !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>
    <!-- CSS Reset : END -->
    <!-- Reset list spacing because Outlook ignores much of our inline CSS. -->
    <!--[if mso]>
    <style type="text/css">
        ul,
        ol {
            margin: 0 !important;
        }
        li {
            margin-left: 30px !important;
        }
        li.list-item-first {
            margin-top: 0 !important;
        }
        li.list-item-last {
            margin-bottom: 10px !important;
        }
    </style>
    <![endif]-->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

    .left-responsive{
        text-align: left!important;
    }

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td-primary:hover,
        .button-a-primary:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        .m-text-center {
            text-align:right;
        }

        .m-textleft-center {
            text-align: left;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {
            .stack-column{
                min-width: 320px!important;
            }
            .test, #test123{
                min-width: 320px!important;
            }
            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center center-on-narrow {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center center-on-narrow {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }

            .email-container .menu-text, .email-container .title-text {
                font-size: 14px !important;
            }

            .email-container .categ-text {
                font-size: 12px !important;
            }

            .bigimage {
                min-width: 300px;
            }

            .m-text-center, .m-textleft-center {
                text-align:center !important;
            }
        }

        @media screen and (max-width: 696px) {
            .left-responsive{
                text-align: center!important;
            }

            .stack-column{
                min-width: 320px!important;
            }
            .test, #test123{
                min-width: 320px!important;
            }
            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center center-on-narrow {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center center-on-narrow {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }

            .email-container .menu-text {
                font-size: 13px !important;
                padding:5px 10px;
            }

            .email-container .title-text {
                font-size: 14px !important;
            }

            .email-container .categ-text {
                font-size: 12px !important;
            }

            .bigimage {
                min-width: 300px;
            }

            .m-text-center, .m-textleft-center {
                text-align:center !important;
            }

            /* And center justify these ones. */
            .stack-column-center center-on-narrow {
                text-align: center !important;
            }

            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
        }

    </style>
    <!-- Progressive Enhancements : END -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

</head>
<!--
    The email background color (#222222) is defined in three places:
    1. body tag: for most email clients
    2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
    3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color:#ffffff !important;">
    <center style="width: 100%;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
    <td>
    <![endif]-->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 660px.
            2. MSO tags for Desktop Windows Outlook enforce a 660px width.
            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 660px is a good width. Change with caution.
        -->
        <div style="max-width: 660px; margin: 0 auto;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="660">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0 auto;">
                <tr>
                    <td height="100%" valign="top" width="100%" style="background-color: #ffffff;">
                        <!--[if mso]>
                        <table align="center" role="presentation" border="0" cellspacing="0" cellpadding="0" width="660">
                        <tr>
                        <td valign="top" width="660">
                        <![endif]-->
                        <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                            <tr>
                                <td height="100%" valign="top" width="100%" style="background-color: #003399;">
                                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                                        <tr>
                                            <td align="center" valign="top" style="font-size:0;">
                                                <div style="display:inline-block; max-width:660px; min-width:660px; vertical-align:top;" class="stack-column">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td>
                                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="text-align: left;">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <div class="left-responsive">
                                                                                <img width="660" border="0" height="191" alt="" style="display:inline-block; border:none; outline:none; text-decoration:none;" src="<?= $_base_static ?>img/revolut/top.jpg">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <!-- Clear Spacer : BEGIN -->
                            <tr>
                                <td aria-hidden="true" height="10" style="font-size: 0px; line-height: 0px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <!-- Clear Spacer : END -->

                            <tr>
                                <td align="center" valign="middle" height="40" style="font-family: Tahoma, Geneva, sans-serif; color:#2f62a2;line-height:22px!important; font-weight: normal;text-align: center;mso-line-height-rule: exactly; padding:0 30px;">
                                    <p style="font-size:16px !important; line-height:22px!important; margin:0;">
                                        <br>
                                        <strong>
                                            <span style="text-transform:uppercase;">FelicitĂri !</span><br>
                                            Ai comandat cardul Revolut!
                                        </strong>
                                        <br><br><br>
                                        Descarca aplicatia folosind linkul:<br>
                                        <a href="https://revolut.ngih.net/paralela45y" target="_blank" style="color:#2f62a2; font-size: 16px!important; text-decoration:none;"><font style="color:#2f62a2;">https://revolut.ngih.net/paralela45y</font></a>
                                    </p>
                                    <br><br>
                                    <hr style="border-color:#2f62a2;">
                                    <p style="line-height:22px!important;font-size: 16px!important; font-weight:bold;">
                                        Ai 5% discount* la rezervarile platite cu cardul tau Revolut
                                    </p>
                                    <p style="line-height:22px!important;font-size: 14px!important; margin:0;">
                                        Foloseste cardul tau Revolut la orice comanda online specificand in detalii ca faci plata cu un card Revolut. Vino cu cardul in orice agentie Paralela 45 si rezerva pe loc o vacanta.
                                    </p>
                                    <p style="line-height:20px!important;font-size: 12px!important; margin:0;">
                                        <i>*Reducere valabila la Pachetele de Vacanta (zbor + cazare) si circuitele marca Paralela 45 (doar pentru destinatia Antalya se aplica discountul in limita a 100 euro/adult).</i>
                                    </p>
                                    <br><br>
                                    <a href="<?= $_base ?>" target="_blank"><img width="230" border="0" height="35" alt="" style="display:inline-block; border:none; outline:none; text-decoration:none;" src="<?= $_base_static ?>img/revolut/btn.jpg"></a>
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td height="100%" valign="top" width="100%" style="background-color: #003399;">
                                    <table align="center" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                                        <tr>
                                            <td align="center" valign="top" style="font-size:0;">
                                                <div style="display:inline-block; max-width:660px; min-width:660px; vertical-align:top;" class="stack-column">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td>
                                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="text-align: left;">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <div class="left-responsive">
                                                                                <img width="660" border="0" height="89" alt="" style="display:inline-block; border:none; outline:none; text-decoration:none;" src="<?= $_base_static ?>img/revolut/bottom.jpg">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <!--[if mso]>
                        </td>
                        </tr>
                        </table>
                        <![endif]-->
                    </td>
                </tr>

            </table>
            <!-- Email Body : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
    </center>
</body>
</html>
