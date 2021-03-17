<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$row = db_row('SELECT * FROM eurosite_request WHERE id_eurosite_request = ?', intval($_GET['id']));

// Start output
include $_base_path_cms . 'content/section/meta.php';
?>
<!-- Main content wrapper -->
<section class="body">
	
	<!-- start: page -->
	<div class="row">

		<div class="col-md-12 col-lg-12 col-xl-12">
			<pre><? echo htmlentities($row['request']);?></pre>
		</div>
		
	</div>
			
</section>

<?
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();