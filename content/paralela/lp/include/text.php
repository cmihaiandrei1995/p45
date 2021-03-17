<!--sectiune-->
<div class="row">

    <? if($group['title'] != "" || $group['description'] != ""){?>
        <div class="col-xs-12">
            <div class="intro">
                <? if($group['title'] != ""){?>
                    <h3 class="title"><?=$group['title']?></h3>
                <? }?>
                <? if($group['description'] != ""){?>
                    <?=$group['description']?>
                <? }?>
            </div>
        </div>
    <? }?>

</div>
