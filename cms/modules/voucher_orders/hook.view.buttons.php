<? $record = db_row('SELECT * FROM voucher_order WHERE id_voucher_order = ?', $record['id_voucher_order'])?>
<? if(($record['status'] == "success" || $record['status'] == "paid") && $record['code'] != "") {?>
    <a class="mb-xs mt-xs mr-xs btn btn-default" href="<?=$_base_cms?>modules/voucher_orders/files/voucher_pdf.php?id=<?=$record['id_voucher_order']?>" data-toggle="tooltip" data-placement="top" data-original-title="Download voucher" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
<? }?>
