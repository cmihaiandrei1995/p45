<?

$_text_op = get_post(array(
	'table' => 'page',
	'id_page' => 256
));
$_text_cash = get_post(array(
	'table' => 'page',
	'id_page' => 257
));
$_text_voucher = get_post(array(
	'table' => 'page',
	'id_page' => 265
));
$_text_card_success = get_post(array(
	'table' => 'page',
	'id_page' => 258
));
$_text_card_error = get_post(array(
	'table' => 'page',
	'id_page' => 259
));



if($_params['id_booking']){
	$_booking = db_row('SELECT * FROM booking WHERE id_booking = ?', $_params['id_booking']);
}elseif(isset($_GET['orderId'])){
	go_away(route('thank-you', intval($_GET['orderId'])));
}

$_search_data = json_decode($_booking['search_data'], true);
$_selected_data = json_decode($_booking['selected_data'], true);

if($_selected_data['id_hotel']){
	$_item = get_hotel_by_id($_selected_data['id_hotel']);
	$_city = get_city_by_id($_item['id_city']);
}

if($_selected_data['id_circuit']){
	$_item = get_circuit_by_id($_selected_data['id_circuit']);
}




if($_booking['payment'] == "voucher"){
	$_banner = "03";
	$_text = $_text_voucher;
}elseif($_booking['payment'] == "cash"){
	$_banner = "03";
	$_text = $_text_cash;
}elseif($_booking['payment'] == "op"){
	$_banner = "03";
	$_text = $_text_op;
}elseif($_booking['payment'] == "card" && ($_booking['status'] == "error" || $_booking['status'] == "error_payment")){
	$_banner = "02";
	$_text = $_text_card_error;
}elseif($_booking['payment'] == "card" && $_booking['status'] == "paid"){
	$_banner = "01";
	$_text = $_text_card_success;
}else{
	$_banner = "01";
	$_text = $_text_card_success;
}

















$_section = 'booking';



//seo
$_meta_title = "Confirmare rezervare";
$_meta_description = "";
$_meta_keywords = "";
$_no_index = true;
