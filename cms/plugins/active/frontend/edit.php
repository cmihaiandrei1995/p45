<div class="form-group">
	<label class="col-xs-12 col-md-4 col-lg-2 col-xl-4 control-label" for="active"><?=_lng('public')?> <span class="required">*</span></label>
	<div class="col-xs-5 col-sm-3 col-md-2 col-xl-5">
		<select name="active" id="active" class="select2 form-control">
			<option value="1" <?=(isset($_POST['active']) && $_POST['active'] == 1 ? "selected" : ($_record['row']['active'] == 1 ? "selected" : ''))?>><?=_lng('yes')?></option>
            <option value="0" <?=(isset($_POST['active']) && $_POST['active'] == 0 ? "selected" : ($_record['row']['active'] == 0 ? "selected" : ''))?>><?=_lng('no')?></option>
		</select>
	</div>
</div>
