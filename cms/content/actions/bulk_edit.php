<form action="" class="form" method="post" enctype="multipart/form-data">
	
	<div class="widgets">
		
    	<div class="">
            <fieldset>
            	<div class="widget">
            		<div class="title">
            			<img src="<?=$_base_cms?>static/images/icons/dark/pencil.png" alt="" class="titleIcon" />
            			<h6><?=_lng('edit')?></h6>
            			<? if($_multiple_lang){?>
	            			<ul class="tabs-right langtabs">
	            				<? $lng_keys = array_keys($_website_langs);?>
	            				<? foreach($_website_langs as $lng => $lng_name){?>
		                        	<li <? if($lng == $lng_keys[0]){?>class="activeTab"<? }?>><a href="#" data-lang="<?=$lng?>"><?=$lng_name?></a></li>
		                        <? }?>
		                    </ul>
	                    <? }?>
            		</div>
            		<? print_r($_GET);?>
                    <?
                    foreach($_fields as $key => $plugin){
                    	$field_settings = $plugin->getViewSettings();
	                	$is_bulk_editable = $field_settings['is_bulk_editable'];
						
                    	if($plugin->hasWidget('add') && $is_bulk_editable){
							$plugin->widget('add', 'frontend');
						}
					}
					?>
		        	<div class="clear"></div>
                </div>
                
                <div class="formSubmit">
	        		<input type="submit" id="submit" name="submit" value="<?=_lng('save')?>" class="redB">
	        	</div>
                <div class="clear"></div>
        	</fieldset>
        </div>
        
        <div class="clear"></div>
    </div>
    
</form>