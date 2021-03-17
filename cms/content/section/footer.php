	<!-- Vendor -->
	<script src="<?=$_base_cms?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Specific Vendor -->
	<script src="<?=$_base_cms?>assets/vendor/duallistbox/jquery.dualListBox.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/jquery-appear/jquery.appear.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/select2/select2.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/fileinput/fileinput.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/tinymce/tinymce.min.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/prettyPhoto/jquery.prettyPhoto.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/multidatespicker/jquery.multidatespicker.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/datetime/jquery-ui-timepicker-addon.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/pnotify/pnotify.custom.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/colorpicker/colorpicker.js"></script>
	<script src="<?=$_base_cms?>assets/vendor/isotope.pkgd.min.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="<?=$_base_cms?>assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="<?=$_base_cms?>assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="<?=$_base_cms?>assets/javascripts/theme.init.js"></script>

	<? if(file_exists($_base_path_cms . 'assets/custom/js/scripts.js')){?>
		<!-- Project Custom JS -->
		<script src="<?=$_base_cms?>assets/custom/js/scripts.js"></script>
	<? }?>

	<?php print_enqueued_scripts() ?>

</body>
</html>