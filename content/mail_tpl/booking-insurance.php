<?
global $_week_days;
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title></title>
      <style type="text/css">
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */

         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}

         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */

         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}

         table[class=devicewidth] {min-width:1000px;max-width:1000px;}

         .visible-xs{display:none !important;}

         table td {border-collapse: collapse;}

         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }

         /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*/

         /*STYLES*/

         table[class=full] { width: 100%; clear: both; }

         /*################################################*/
         /*IPAD STYLES*/
         /*################################################*/

         @media only screen and (max-width: 640px) {

              a[href^="tel"], a[href^="sms"] {
                  text-decoration: none;
                  color: #ffffff; /* or whatever your want */
                  pointer-events: none;
                  cursor: default;
              }


              .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                  text-decoration: default;
                  color: #ffffff !important;
                  pointer-events: auto;
                  cursor: default;
              }

             table[class=devicewidth] {min-width:440px!important;width:440px!important;}
             table[class=devicewidth-col] {width: 440px!important;text-align:center!important;}
             table[class=devicewidthinner] {width: 420px!important;text-align:center!important;height:auto!important;}
             table[class=mobilespacing] {width: 420px!important;text-align:center!important;}
             table[class=tablet-button] {width: 100%!important;text-align:center!important;}
             table[class="sthide"]{display: none!important;}
             img[class="bigimage"]{width: 440px!important;height:auto!important;}
             img[class="col2img"]{width: 420px!important;height:auto!important;}
             td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}
             img[class="logo"]{padding:0!important;margin: 0 auto !important;}
         }


         /*##############################################*/
         /*IPHONE STYLES*/
         /*##############################################*/


         @media only screen and (max-width: 480px) {
             a[href^="tel"], a[href^="sms"] {
                 text-decoration: none;
                 color: #ffffff; /* or whatever your want */
                 pointer-events: none;
                 cursor: default;
             }

             .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
                 text-decoration: default;
                 color: #ffffff !important;
                 pointer-events: auto;
                 cursor: default;
             }

             table[class=devicewidth] {min-width:320px!important;width:320px!important;}
             table[class=devicewidth-col] {width: 320px!important;text-align:center!important;}
             table[class=devicewidthinner] {width: 300px!important;text-align:center!important;height:auto!important;}
             table[class=mobilespacing] {width: 300px!important;text-align:center!important;}
             table[class="sthide"]{display: none!important;}
             img[class="bigimage"]{width: 320px!important;height:auto!important;}
             img[class="col2img"]{width: 300px!important;height:auto!important;}
             img[class="image-banner"]{width: 320px!important;height:auto!important;}
         }
      </style>
   </head>


<body>

<div class="block">
   <!-- 2-columns -->
   <table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" st-sortable="2columns">
      <tbody>
         <tr>
            <td align="center">
               <table bgcolor="#4993de" width="1000" cellpadding="0" cellspacing="0" align="center" class="devicewidth">
                  <tbody>
                     <tr>
                        <td align="center">
                           <table width="650" cellpadding="0" cellspacing="0" align="center" class="devicewidth-col">
                              <tbody>
                                 <tr>
                                    <td align="center">
                                       <!-- col 1 -->
                                       <table width="526" cellpadding="0" cellspacing="0" class="devicewidth-col" align="left">
                                          <tbody>
                                              <tr><td align="center">
                                                  <table width="526" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                                         <tbody>
                                                             <tr><td height="20"></td></tr>
                                                             <tr>
                                                                 <td style="color:#fff; font-size:24px; font-weight:bold; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;" align="left">
                                      								<a href="<?=$_base?>" target="_blank"><img src="<?=$_base?>static/img/nl/ecr-logo.png" border="0" style="display:block; border:none; outline:none;" ></a>
                                      								Pregateste-te de plecarea in <?=$content['country']?>!
                                      							</td>
                                      						</tr>
                                                            <tr><td height="20"></td></tr>
                                                        </tbody>
                                                    </table>
                                              </td></tr>
                                          </tbody>
                                       </table>
                                       <!-- col 2 -->
                                       <table width="124" align="right" cellpadding="0" cellspacing="0" class="devicewidth-col">
                                          <tbody>
                                             <tr>
                                                <td align="center">
                                                   <table width="124" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                                      <tbody>
                                                          <tr><td height="20"></td></tr>
                                                          <tr>
                                                              <td><img src="<?=$_base?>static/img/nl/taxe-zero.png" border="0" width="124" height="102" style="display:block; border:none; outline:none;" ></td>
                                                          </tr>
                                                          <tr><td height="20"></td></tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <!-- end of col 2 -->
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
   <!-- end of 2-columns -->
</div>

<div class="block">
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
      <tbody>
         <tr>
            <td align="center">
               <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="min-width:650px;" class="devicewidth">
                  <tbody>
                      <tr><td height="35"></td></tr>
                      <tr><td style="color:#000; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
      					<b style="font-size:24px;">Asigurarea ta de calatorie</b><br><br>

      					Salut,<br><br>

      					Esti la un pas distanta de vacanta mult dorita.<br>
      					Te asteapta <b>#experientedeneuitat</b> in <b><?=$content['country']?></b>.<br>
      					O echipa de consultanti Paralela 45 deja se ocupa de toate documentele necesare calatoriei. In scurt timp, vei fi si contactat pentru confirmarea disponibilitatii pentru cazare si alte detalii.<br><br>

      					Iti multumim!<br><br>

      					<span style="color:#818080;"><?=$_week_days[date('N')]?>, <?=date('d.m.Y')?><br><br>
      				</td></tr>
                    <tr><td height="35"></td></tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="block">
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
      <tbody>
         <tr>
            <td align="center" style="color:#000; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
               <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="min-width:650px;" class="devicewidth">
                  <tbody>
                      <tr>
          					<td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Informatii turisti</td>
          					<td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right">
                                <? foreach($content['search_data']['insurants'] as $i => $insurant){ ?>
                                    <b><?=$insurant['lastname']." ".$insurant['firstname']." (".date("d.m.Y", strtotime($insurant['dob'])).")";?></b>:<br>
                                    <?=$content['insurance_data'][$i]['product']['title']?> - <?=$content['insurance_data'][$i]['quote']['prima']?> Ron
                                    <? if($i < count($content['search_data']['insurants']) - 1){?>
                                        <br><br>
                                    <? }?>
                                <? } ?>
          					</td>
          				</tr>
                        <tr>
                          <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Date contact</td>
                          <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right">
                              <b>Telefon:</b> <?=$content['form_data']['phone']?><br>
                              <b>Email:</b> <?=$content['form_data']['email']?>
                          </td>
                      </tr>
                      <tr>
                        <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Valabilitate</td>
                        <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['nr_days']?> zile / <?=$content['nr_nights']?> nopti</td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Perioada</td>
                      <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=date("d.m.Y", strtotime($content['check_in']))?> - <?=date("d.m.Y", strtotime($content['check_out']))?></td>
                    </tr>
                    <tr>
                      <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Numar turisti</td>
                      <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=($content['adults_all']+$content['children_all'])?> turisti (<?=$content['adults_all']?> adulti<?=$content['children_all'] > 0 ? " si ".$content['children_all']." copii" : ""?>)</td>
                    </tr>
                    <!--
                    <tr>
                        <td colspan="2">
                            <br><br>
                            <p style="color:#293245;">
                                <b>Pachetul ales este disponibil</b>, iar in cazul platii cu cardul va fi confirmat imediat. In cazul platii prin OP sau in agentie, acesta va fi confirmat dupa plata integrala sau a avansului, dupa caz.
                            </p>
                        </td>
                    </tr>
                    -->
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="block">
   <br><br>
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
      <tbody>
         <tr>
            <td align="center" style="color:#000; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
               <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="min-width:650px;" class="devicewidth">
                  <tbody>
                      <tr><td colspan="2" style="color:#000; font-size:24px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:34px; font-weight:bold;">Date facturare</td></tr>
                      <tr><td height="35"></td></tr>
                      <tr>
          					<td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Tip persoana</td>
          					<td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right">Persoana <?=$content['form_data']['invoice_type'] == "pf" ? "fizica" : "juridica"?></td>
          				</tr>
                        <tr>
                          <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Nume</td>
                          <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_name']?></td>
                      </tr>
                      <tr>
                        <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Prenume</td>
                        <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_surname']?></td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Adresa facturare</td>
                      <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_address']?></td>
                    </tr>
                    <tr>
                      <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Tara</td>
                      <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_country']?></td>
                    </tr>
                    <tr>
                      <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Oras</td>
                      <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_city']?></td>
                    </tr>
                    <tr>
                      <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Judet</td>
                      <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_county']?></td>
                    </tr>
                    <? if($content['form_data']['invoice_type'] == "pf"){?>
                        <!--
                            <tr>
                              <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">CNP</td>
                              <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_cnp']?></td>
                            </tr>
                        -->
                    <? }else{ ?>
                        <tr>
                          <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Companie</td>
                          <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_company']?></td>
                        </tr>
                        <tr>
                          <td align="left" bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">CUI</td>
                          <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_cui']?></td>
                        </tr>
                        <tr>
                          <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Nr. reg. com.</td>
                          <td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['form_data']['invoice_nr_reg']?></td>
                        </tr>
                    <? }?>
                    <tr><td height="35"></td></tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="block">
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
      <tbody>
         <tr>
            <td align="center" style="color:#000; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
               <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="min-width:650px;" class="devicewidth">
                  <tbody>
                      <tr>
                          <td colspan="2" style="color:#000; font-size:24px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:34px;">
                              <b>Detalii plata</b><br>
                              <span style="font-size:16px; color:#818080;">
                                  Metoda de plata:
                                  <?
                                  if($content['form_data']['payment'] == "euplatesc"){
                      				echo "Card online";
                      			  }
                      			  if($content['form_data']['payment'] == "rate"){
                      				echo "Card in rate";
                      			  }
                      			  if($content['form_data']['payment'] == "op"){
                      				echo "Transfer bancar";
                      			  }
                                  if($content['form_data']['payment'] == "cash"){
                      				echo "Cash";
                      			  }
                                  if($content['form_data']['payment'] == "voucher"){
                      				echo "Vouchere de vacanta";
                      			  }
                                  ?>
                                  <br>
                                  Agentie: <?=$content['agency']['title'].($content['form_data']['agent'] != "" ? " - Agent: ".$content['form_data']['agent'] : "")?>
                              </span>
                          </td>
                      </tr>
                      <tr><td height="35"></td></tr>
                      <tr>
          					<td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Pret integral</td>
          					<td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['final_price']?> € (<?=$content['final_price_ron']?> Ron)</td>
                      </tr>
                      <!--
                          <tr>
              					<td bgcolor="#f0f0f6" align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Asigurare medicala Turist 80 lei x 3</td>
              					<td bgcolor="#f0f0f6" style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right">240 lei</td>
                          </tr>
                          <tr>
              					<td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Reducere</td>
              					<td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right">- 100 €</td>
                          </tr>
                      -->
                      <tr>
                          <td bgcolor="#f0f0f6" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;"></td>
          				  <td bgcolor="#f0f0f6" align="right" style="color:#818080; padding:10px 20px; border:1px solid #cacae3; border-left:0; color:#000000;">Total&nbsp;&nbsp;&nbsp;<b><?=$content['final_price']?> €</b></td>
                      </tr>
                      <? if($content['form_data']['pay_amount'] != "full"){?>
                          <tr>
                                <td align="left" style="color:#818080; padding:10px 20px; padding-right: 0; border:1px solid #cacae3; border-right:0;">Avans de plata</td>
                                <td style="padding:10px 20px; padding-left: 0; border:1px solid #cacae3; border-left:0; line-height:24px;" align="right"><?=$content['advance_price']?> € (<?=$content['advance_price_ron']?> Ron)</td>
                          </tr>
                      <? }?>
                      <tr><td height="35"></td></tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="block">
   <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
      <tbody>
         <tr>
            <td align="center">
               <table width="650" cellpadding="0" cellspacing="0" border="0" align="center" style="min-width:650px;" class="devicewidth">
                  <tbody>
                      <!--
                          <tr><td align="left" style="color:#808080; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
          					<p style="color:#293245; font-weight:bold;">Pachetul include</p>
                            <ul style="list-style:none; padding-left:0;">
                                <li><img src="<?=$_base?>static/img/nl/list.jpg" border="0" style="display:inline-block; border:none; outline:none;" width="12" height="10"> Mic dejun</li>
                            </ul>
          				</td></tr>
                        <tr><td height="35"></td></tr>
                    -->
                    <tr><td align="left" style="color:#808080; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
                        <p>
                            Combinatia de servicii de calatorie pusa la dispozitia dumneavoastra este un pachet in intelesul Ordonantei Guvernului nr. 2/2018 privind pachetele de servicii de calatorie si serviciile de calatorie asociate, precum si pentru modificarea unor acte normative.
                            Prin urmare, veti beneficia de toate drepturile UE care se aplica pachetelor. Societatea Paralela 45 Turism SRL va fi pe deplin responsabila pentru executarea corespunzatoare a pachetului in ansamblu.
                            In plus, conform legislatiei, societatea Paralela 45 Turism SRL detine protectie pentru a va rambursa platile si, in cazul in care transportul este inclus in pachet, pentru a asigura repatrierea dumneavoastra in cazul in care devine insolventa.
                        </p>
                        <br>
                        <p>
                            Informatii suplimentare referitoare la principalele drepturi in temeiul Ordonantei Guvernului nr. 2/2018 puteti obtine <a href="<?=$_base?>drepturi-ordonanta-guvernului-nr-2-din-2018/" style="color:#293245;"><b>aici</b></a>.
                        </p>
                    </td></tr>
                    <tr><td height="35"></td></tr>

                    <? if($content['form_data']['obs'] != ""){?>
                        <tr><td style="font-weight:bold; color:#293245; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
                          <p>Observatii</p>
                        </td></tr>
                        <tr><td height="15"></td></tr>
                        <tr><td style="color:#808080; font-size:16px; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;">
                          <i>“<?=$content['form_data']['obs']?>”</i>
                        </td></tr>
                        <tr><td height="35"></td></tr>
                    <? }?>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
</div>

<div class="block">
   <!-- 2-columns -->
   <table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" st-sortable="2columns">
      <tbody>
         <tr>
            <td align="center">
               <table bgcolor="#4993de" width="1000" cellpadding="0" cellspacing="0" align="center" class="devicewidth">
                  <tbody>
                      <tr><td height="35"></td></tr>
                     <tr>
                        <td align="center">
                            <table width="650" cellpadding="0" cellspacing="0" align="center" class="devicewidthinner">
                                <tbody>
                                    <tr>
                                        <td style="color:#fff; font-size:16px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;" align="left">
                                           <b>Disclaimer</b><br>
                                       </td>
                                    </tr>
                                    <tr><td height="15"></td></tr>
                                    <tr>
                                        <td style="color:#fff; font-size:16px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;" align="left">
                                            Acest mail contine datele rezervarii plasate pe Paralela45.ro si nu reprezinta confirmarea rezervarii. Pentru confirmare, finalizare si documentele de calatorie, un consultant Paralela 45 te va contacta in cel mai scurt timp. Pentru alte informatii, apelati echipa noastra de vanzari online.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr><td height="70"></td></tr>
                    <tr>
                        <td>
                           <table width="650" cellpadding="0" cellspacing="0" align="center" class="devicewidth-col">
                              <tbody>
                                 <tr>
                                    <td align="center">
                                       <!-- col 1 -->
                                       <table width="350" cellpadding="0" cellspacing="0" class="devicewidthinner" align="left">
                                          <tbody>
                                              <tr><td align="center">
                                                  <table width="350" cellpadding="0" cellspacing="0" class="">
                                                         <tbody>
                                                             <tr>
                                                                 <td align="center">
                                      								<img src="<?=$_base?>static/img/nl/contact-pict.png" border="0" style="display:inline-block; border:none; outline:none;" width="327" height="327">
                                      							</td>
                                      						</tr>
                                                        </tbody>
                                                    </table>
                                              </td></tr>
                                          </tbody>
                                       </table>
                                       <!-- col 2 -->
                                       <table width="300" align="right" cellpadding="0" cellspacing="0" class="devicewidthinner">
                                          <tbody>
                                             <tr>
                                                <td align="center">
                                                   <table width="300" cellpadding="0" cellspacing="0" class="">
                                                      <tbody>
                                                          <tr>
                                                              <td style="color:#fff; font-size:14px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:20px;">
                                                                  <br><br>
                                                                  <b style="font-size:20px;">Agentia Online</b><br>
                                                                    <a href="<?=$_base?>" target="_blank" style="color:#fff; text-decoration:none;"><font style="color:#fff"><?=$_base?></font></a>
                                                                    <br><br>

                                                                    Tel: <a href="tel:+4(0) 374 454545" style="color:#fff; text-decoration:none;"><font style="color:#fff">+4(0) 374 45 45 45</font></a><br>
                                                                    E-mail: <a href="mailto:vanzari.online@paralela45.ro" style="color:#fff; text-decoration:none;"><font style="color:#fff">vanzari.online@paralela45.ro</font></a>
                                                                    <br><br>

                                                                    Licenta Numarul: 523 din 10.01.2019<br>
                                                                    Brevet Turism: nr.2 din 28.09.1998<br>
                                                                    Titular: Alin Nicolae Burcea<br>
                                        							Polita de asigurare OMNIASIG Seria I Nr. 55501 valabilitate 23.11.2020 - 24.11.2021
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                       <!-- end of col 2 -->
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                     <tr><td height="40"></td></tr>
                    <tr>
                       <td align="center">
                           <table width="650" cellpadding="0" cellspacing="0" align="center" class="devicewidth-col">
                               <tbody>
                                   <tr>
                                       <td style="color:#fff; font-weight: bold; font-size:16px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;" align="center">
                                          Urmariti-ne pe:
                                      </td>
                                   </tr>
                                   <tr><td height="15"></td></tr>
                                   <tr>
                                       <td align="center">
                                           <table cellpadding="0" cellspacing="0" align="center">
                                                <tr>
                                                    <td valign="top"><a href="https://www.facebook.com/Paralela45/" target="_blank"><img src="<?=$_base?>static/img/nl/fb.png" border="0" style="display:block !important; border:none; outline:none;" width="50" height="50"></a></td>
                                                    <td width="10"></td>
                                                    <td valign="top"><a href="https://www.instagram.com/paralela45ro/" target="_blank"><img src="<?=$_base?>static/img/nl/insta.png" border="0" style="display:block !important; border:none; outline:none;" width="50" height="50"></a></td>
                                                    <td width="10"></td>
                                                    <td valign="top"><a href="https://twitter.com/paralela45" target="_blank"><img src="<?=$_base?>static/img/nl/tw.png" border="0" style="display:block !important; border:none; outline:none;" width="50" height="50"></a></td>
                                                    <td width="10"></td>
                                                    <td valign="top"><a href="https://www.youtube.com/user/Paralela45Turism" target="_blank"><img src="<?=$_base?>static/img/nl/you.png" border="0" style="display:block !important; border:none; outline:none;" width="50" height="50"></a></td>
                                                </tr>
                                           </table>
                                       </td>
                                   </tr>
                                   <tr><td height="15"></td></tr>
                                   <tr>
                                       <td style="color:#fff; font-size:16px;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; line-height:24px;" align="center">
                                          Email trimis de Paralela45
                                      </td>
                                   </tr>
                                   <tr><td height="100"></td></tr>
                               </tbody>
                           </table>
                       </td>
                   </tr>
                  </tbody>
               </table>
            </td>
         </tr>
      </tbody>
   </table>
   <!-- end of 2-columns -->
</div>

</body>
</html>
