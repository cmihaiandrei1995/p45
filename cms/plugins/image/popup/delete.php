<div id="delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
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
					<p><?=_lng('confirm_delete_img')?></p>
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
		
		$('#<?=$field['id'].'_'.$j.'_'.$lng?>_wrapper').magnificPopup({
      		delegate: '.delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>',
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
			  		$('#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>').data('id', item.el.data('id'));
			  		$('#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>').data('table', item.el.data('table'));
			  		$('#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>').data('section', item.el.data('section'));
			  		$('#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>').data('field', item.el.data('field'));
			  	}
		  	}
		});
		
		$(document).on('click', '#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?> .modal-confirm', function (e) {
			e.preventDefault();
			
			$data = $(this).closest('#delete-image-<?=$field['id'].'-'.$j.'-'.$lng?>');
	
			if($_ajax.delete_img) { 
				$_ajax.delete_img.abort();
			}
			$_ajax.delete_img = $.ajax({
				type: 'GET',
				url: $_base_cms + 'plugins/image/ajax/delete.php',
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