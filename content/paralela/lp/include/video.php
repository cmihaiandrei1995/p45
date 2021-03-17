<? if($group['title'] != "" && $group['url_video'] != ""){?>
    <div class="row">
        <div class="col-xs-12">
            <div class="video vacation-video" style="<? if($group['bg_video'] != ""){?>background:url('<?=$_base_uploads.'images/'.$group['bg_video_path'].$group['bg_video'];?>');<? }?>">
                <div class="cct">
                    <h4><?=$group['title']?></h4>
                    <?=get_video_code($group['url_video'], 800, 400)?>
                    </div>
                <div class="shadow"></div>
            </div>
        </div>
    </div>
<? }?>
