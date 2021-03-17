<div class="
	form-group
	<? if(isset($_POST["order"])){?>
		<? if($_form->error("order") != ""){?>
			has-error
		<? }?>
	<? }?>">

	<label class="col-md-4 col-lg-2 col-xl-4 control-label" for="order">
		<?=_lng('order')?>
	</label>

	<div class="col-md-8 col-lg-5">
		<input
    		type="text"
    		id="order"
    		name="order"
    		value="<?=(isset($_POST["order"]) ? $_POST["order"] : 0)?>"
    		class="form-control"
    		data-toggle="tooltip" data-placement="left" data-original-title="<?=_lng('order')?>"
    	/>

    	<? if(isset($_POST["order"])){?>
	    	<? if($_form->error("order") != ""){?>
	    		<span class="help-block text-danger"><?=$_form->error("order")?></span>
	    	<? }?>
	    <? }?>
	</div>

</div>
