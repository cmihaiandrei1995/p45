<div id="delete-file-<?=$field['id'].'-'.$lng?>" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_delete')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_delete_file')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm">Ok</button>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</footer>
	</section>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		// delete dialog
		
		$('#<?=$field['id'].'_'.$lng?>_wrapper').magnificPopup({
      		delegate: '.delete-file-<?=$field['id'].'-'.$lng?>',
			type: 'inline',
			fixedContentPos: true,
			fixedBgPos: false,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in',
			modal: true,
			callbacks: {
			  	elementParse: function(item) {
			  		$('#delete-file-<?=$field['id'].'-'.$lng?>').data('id', item.el.data('id'));
			  		$('#delete-file-<?=$field['id'].'-'.$lng?>').data('table', item.el.data('table'));
			  		$('#delete-file-<?=$field['id'].'-'.$lng?>').data('section', item.el.data('section'));
			  		$('#delete-file-<?=$field['id'].'-'.$lng?>').data('field', item.el.data('field'));
			  	}
		  	}
		});
		
		$(document).on('click', '#delete-file-<?=$field['id'].'-'.$lng?> .modal-confirm', function (e) {
			e.preventDefault();
			
			$data = $(this).closest('#delete-file-<?=$field['id'].'-'.$lng?>');
	
			if($_ajax.delete_file) { 
				$_ajax.delete_file.abort();
			}
			$_ajax.delete_file = $.ajax({
				type: 'GET',
				url: $_base_cms + 'plugins/file_simple/ajax/delete.php',
				data: {
					id: $data.data('id'),
					table: $data.data('table'),
					section: $data.data('section'),
					field: $data.data('field')
				},
				success: function(data) {
					$('.gallery').find('[data-id="' + $data.data('id') + '"]').remove();
				}
			});
			
			$.magnificPopup.close();
		});
		
	});
</script>