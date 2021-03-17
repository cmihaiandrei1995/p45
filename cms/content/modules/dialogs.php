<div id="delete-record" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
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
					<p><?=_lng('confirm_delete')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>


<div id="trash-record" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_trash')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_trash')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>


<div id="delete-restricted" class="zoom-anim-dialog modal-block modal-header-color modal-block-warning mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_delete')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-warning"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('no_delete_possible')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-default modal-dismiss"><?=_lng('ok')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>


<div id="delete-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_delete_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_delete_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="delete-record-all" href="#delete-record-all"></a>
</div>


<div id="trash-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_trash_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_trash_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="trash-record-all" href="#trash-record-all"></a>
</div>


<div id="undo-trash-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_undo_trash_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_undo_trash_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="undo-trash-record-all" href="#undo-trash-record-all"></a>
</div>


<div id="draft-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_undo_trash_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_undo_trash_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="draft-record-all" href="#draft-record-all"></a>
</div>


<div id="undo-draft-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_undo_draft_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_undo_draft_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="undo-draft-record-all" href="#undo-draft-record-all"></a>
</div>


<div id="active-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_active_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_active_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="active-record-all" href="#active-record-all"></a>
</div>


<div id="inactive-record-all" class="zoom-anim-dialog modal-block modal-header-color modal-block-primary mfp-hide">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?=_lng('do_inactive_all')?></h2>
		</header>
		<div class="panel-body">
			<div class="modal-wrapper">
				<div class="modal-icon">
					<i class="fa fa-question-circle"></i>
				</div>
				<div class="modal-text">
					<p><?=_lng('confirm_inactive_all')?></p>
				</div>
			</div>
		</div>
		<footer class="panel-footer">
			<div class="row">
				<div class="col-md-12 text-right">
					<button class="btn btn-primary modal-confirm"><?=_lng('ok')?></button>
					<button class="btn btn-default modal-dismiss"><?=_lng('cancel')?></button>
				</div>
			</div>
		</footer>
	</section>
</div>
<div class="hide">
	<a class="inactive-record-all" href="#inactive-record-all"></a>
</div>