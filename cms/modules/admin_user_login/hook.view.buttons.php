<?
$item = db_row('SELECT * FROM admin_user_login WHERE id_admin_user_login = ?', $record['id_admin_user_login']);
?>
<a 
	class="mb-xs mt-xs mr-xs btn btn-default"
	href="<?=$_base_cms?>bounce.php?action=search&module=admin_action&do=init&field=admin_action.session_id&search=<?=$item['session_id']?>&redirect_to_module=admin_action"
	data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('view_actions')?>">
		<i class="fa fa-eye"></i>
</a>