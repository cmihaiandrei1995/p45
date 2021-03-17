<? if($record['active'] != 1) {?>
    <a class="mb-xs mt-xs mr-xs btn btn-default" href="<?=$_base_cms?>modules/users/files/resend.php?id=<?=$record['id_user']?>" data-toggle="tooltip" data-placement="top" data-original-title="Retrimite link activare"><i class="fa fa-envelope"></i></a>
<? }?>
