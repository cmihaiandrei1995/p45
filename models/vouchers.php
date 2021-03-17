<?

function generate_voucher($id_order, $save = false){
	global $_base, $_base_path, $_base_cms, $_base_cms_path, $_base_static, $_base_static_path, $_base_uploads, $_base_uploads_path, $_config;

    require_once $_base_path."models/dompdf/dompdf_config.inc.php";

	$order = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', intval($id_order));
	if($order){

		ob_start();
		include $_base_path.'content/voucher/'.$order['type'].'.php';
		$content = ob_get_clean();

        $_text_bottom = get_post(array(
            'table' => 'page',
            'id_page' => 277
        ));

        // replace in $content
        $content = str_replace('[name_from]', $order['name_from'], $content);
        $content = str_replace('[name_for]', $order['name_for'], $content);
        $content = str_replace('[value]', $order['value'], $content);
        $content = str_replace('[message]', $order['message'], $content);
        $content = str_replace('[code]', $order['code'], $content);
        $content = str_replace('[rules]', $_text_bottom['description'], $content);

        if(isset($_GET['html'])){
			echo $content;
			exit;
		}

        $dompdf = new DOMPDF();
		$dompdf->load_html($content);
		$dompdf->set_paper('A4', 'portrait');
		$dompdf->render();

		$pdf_name = "voucher-".$order['id_voucher_order'].".pdf";
		$file_name = $_base_uploads_path."vouchers/".$pdf_name;

		if($save){
			$output = $dompdf->output();

			if(file_exists($file_name)){
				@unlink($file_name);
			}
			file_put_contents($file_name, $output);
			return $file_name;
		}else{
			$dompdf->stream($pdf_name, array("Attachment" => false));
		}

	}
}
