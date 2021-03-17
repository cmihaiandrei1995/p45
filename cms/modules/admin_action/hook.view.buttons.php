<?
global $_config;

$data = db_row('SELECT * FROM admin_action WHERE id_admin_action = ?', $record[$_section['id']]);

if($record['id_what'] > 0){
	$item = db_row('SELECT '.$_config['cms'][$record['section']]['id'].' FROM '.$_config['cms'][$record['section']]['table'].' WHERE '.$_config['cms'][$record['section']]['id'].' = ?', $record['id_what']);
}
?>

<? if($item){?>
	<a
		class="mb-xs mt-xs mr-xs btn btn-default" target="_blank"
		href="<?=$_base_cms?>?module=<?=$record['section']?>&action=edit&id=<?=$record['id_what']?>"
		data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('view_record')?>">
			<i class="fa fa-eye"></i>
	</a>
<? }else{ ?>
	<a
		class="mb-xs mt-xs mr-xs btn btn-default inactive"
		href="javascript:;"
		data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('view_record')?>">
			<i class="fa fa-eye"></i>
	</a>
<? }?>

<? if($data['data'] != ""){?>
	<a
		class="mb-xs mt-xs mr-xs btn btn-default"
		rel="prettyPhoto[info<?=$record[$_section['id']]?>]" href="<?=$_base_cms?>modules/admin_action/files/info.php?id=<?=$record[$_section['id']]?>&popup=true&iframe=true&width=75%&height=75%"
		data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('details')?>">
			<i class="fa fa-info"></i>
	</a>
<? }else{ ?>
	<a
		class="mb-xs mt-xs mr-xs btn btn-default inactive"
		href="javascript:;"
		data-toggle="tooltip" data-placement="top" data-original-title="<?=_lng('details')?>">
			<i class="fa fa-info"></i>
	</a>
<? }?>
