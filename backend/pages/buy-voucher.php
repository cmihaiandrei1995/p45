<?


$voucher_values = array(50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000);

$_text_bottom = get_post(array(
    'table' => 'page',
    'id_page' => 277
));

$_text_top = get_post(array(
    'table' => 'page',
    'id_page' => 278
));

if($_params['id_order']){
    $_text_card_success = get_post(array(
    	'table' => 'page',
    	'id_page' => 279
    ));
    $_text_card_error = get_post(array(
    	'table' => 'page',
    	'id_page' => 280
    ));

    $_order = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', $_params['id_order']);

    if($_order['status'] == "error" || $_order['status'] == "error_payment"){
    	$_text_thank_you = $_text_card_error;
    }elseif($_order['status'] == "success"){
    	$_text_thank_you = $_text_card_success;
    }
}

if(isset($_POST['submit'])){

    $_valid = true;

    $_rules['voucher_type'] = 'trim|required';
	$_rules['name_from'] = 'trim|required';
    $_rules['name_for'] = 'trim|required';
    $_rules['message'] = 'trim|required';
    $_rules['voucher_value'] = 'trim|required|numeric';

    $_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
		'gdpr' => array(
			'required' => "Trebuie sa fii de acord cu aceasta clauza!"
		)
	);

	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

    if($_valid){
        $_show_form = true;
    }

}

if(isset($_POST['buy'])){

    $_show_form = true;

    $_valid = true;

    $_rules['voucher_type'] = 'trim|required';
	$_rules['name_from'] = 'trim|required';
    $_rules['name_for'] = 'trim|required';
    $_rules['message'] = 'trim|required';
    $_rules['voucher_value'] = 'trim|required|numeric';

    $_rules['name'] = 'trim|required';
    $_rules['surname'] = 'trim|required';
    $_rules['email'] = 'trim|required|email';
	$_rules['phone'] = 'trim|required|numeric';
    $_rules['address'] = 'trim|required';
    $_rules['city'] = 'trim|required';
    $_rules['payment'] = 'trim|required';

    $_custom_error_messages = array(
		'terms' => array(
			'required' => "Trebuie sa fii de acord cu termenii si conditiile site-ului!"
		),
		'gdpr' => array(
			'required' => "Trebuie sa fii de acord cu aceasta clauza!"
		)
	);

	$_form = new Validate($_rules, 'post', $_custom_error_messages);
	$_valid = $_form->check();

	foreach($_rules as $key => $val){
		if($_form->error($key) != ""){
			$_errors[$key] = $_form->error($key);
		}
	}

    if($_valid){

        $id_voucher_order = db_query(
            'INSERT INTO voucher_order SET title = ?, email = ?, phone = ?, address = ?, city = ?, name_from = ?, name_for = ?, type = ?, message = ?, value = ?, payment = ?, status = ?',
            $_form['name']." ".$_form['surname'],
            $_form['email'],
            $_form['phone'],
            $_form['address'],
            $_form['city'],
            $_form['name_from'],
            $_form['name_for'],
            $_form['voucher_type'],
            $_form['message'],
            $_form['voucher_value'],
            $_form['payment'],
            'new'
        );

        $currency = db_row('SELECT * FROM currency ORDER BY `date` DESC LIMIT 1');
        $_currency = $currency['value'];

        $_card_price = $_form['voucher_value'] * $_currency;

        require_once $_base_path.'models/euplatesc/euplatesc.php';

        $dataAll = array(
            'amount'      => $_card_price,
            'curr'        => 'RON',
            'invoice_id'  => "VOUCHER-".$id_voucher_order,
            'order_desc'  => 'Comanda voucher #'.$id_voucher_order,
            'merch_id'    => $_euplatesc_mid,
            'timestamp'   => gmdate("YmdHis"),
            'nonce'       => md5(microtime() . mt_rand()),
        );

        $dataAll['fp_hash'] = strtoupper(euplatesc_mac($dataAll, $_euplatesc_key));

        $dataBill = array(
            'fname'	   => $_form['name'],
            'lname'	   => $_form['surname'],
            'country'  => 'Romania',
            'company'  => '',
            'city'	   => $_form['city'],
            'add'	   => $_form['address'],
            'email'	   => $_form['email'],
            'phone'	   => $_form['phone'],
            'fax'	   => '',
        );
        ?>
            <html>
                <head>
                    <title>Euplatesc</title>
                    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                    <? include $_theme_path."section/tracking.php"; ?>
                </head>
                <body>
                    <?
                    $voucher_order = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', $id_voucher_order);
                    ?>
                    <div align="center">
                        <form action="https://secure.euplatesc.ro/tdsprocess/tranzactd.php" method="post" name="gateway" target="_self">
                            <p class="tx_red_mic">Pentru a finaliza plata veti fi redirectat catre pagina securizata a EuPlatesc</p>
                            <!--
                            <p><img src="https://www.euplatesc.ro/plati-online/tdsprocess/images/progress.gif" alt="" title="" onload="javascript:document.gateway.submit()"></p>
                            -->

                            <input name="fname" type="hidden" value="<?=$dataBill['fname'];?>" />
                            <input name="lname" type="hidden" value="<?=$dataBill['lname'];?>" />
                            <input name="country" type="hidden" value="<?=$dataBill['country'];?>" />
                            <input name="company" type="hidden" value="<?=$dataBill['company'];?>" />
                            <input name="city" type="hidden" value="<?=$dataBill['city'];?>" />
                            <input name="add" type="hidden" value="<?=$dataBill['add'];?>" />
                            <input name="email" type="hidden" value="<?=$dataBill['email'];?>" />
                            <input name="phone" type="hidden" value="<?=$dataBill['phone'];?>" />
                            <input name="fax" type="hidden" value="<?=$dataBill['fax'];?>" />

                            <input type="hidden" name="amount" value="<?=$dataAll['amount'] ?>" />
                            <input type="hidden" name="curr" value="<?=$dataAll['curr'] ?>" />
                            <input type="hidden" name="invoice_id" value="<?=$dataAll['invoice_id'] ?>" />
                            <input type="hidden" name="order_desc" value="<?=$dataAll['order_desc'] ?>" />
                            <input type="hidden" name="merch_id" value="<?=$dataAll['merch_id'] ?>" />
                            <input type="hidden" name="timestamp" value="<?=$dataAll['timestamp'] ?>" />
                            <input type="hidden" name="nonce" value="<?=$dataAll['nonce'] ?>" />
                            <input type="hidden" name="fp_hash" value="<?=$dataAll['fp_hash'] ?>" />

                            <input type="hidden" name="returnurl" value="<?=route('thank-you-voucher', $id_voucher_order) ?>" />

                            <p><a href="javascript:gateway.submit();" class="txtCheckout">Continua</a></p>
                        </form>

                        <script type="text/javascript" language="javascript">
                            window.setTimeout(document.gateway.submit(), 1000);
                        </script>
                    </div>
                </body>
            </html>

        <?
        exit;

    }

}





// seo
$_meta_title = "Daruim si calatorim";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = false;
