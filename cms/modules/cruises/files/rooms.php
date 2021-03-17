<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	db_query('DELETE FROM cruise_room WHERE id_cruise = ?', intval($_GET['id']));
	
	foreach($_POST['title'] as $k => $val){
		if($_POST['title'][$k] != ""){
			db_query('INSERT INTO cruise_room SET id_cruise = ?, title = ?, price = ?', intval($_GET['id']), $_POST['title'][$k], $_POST['price'][$k]);
		}
	}
	
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM cruise_room WHERE id_cruise = ? ORDER BY `id_cruise_room` ASC', intval($_GET['id']));

$record = db_row('SELECT * FROM cruise WHERE id_cruise = ?', intval($_GET['id']));
$currency = db_row('SELECT * FROM cruise_line WHERE id_cruise_line = ?', $record['id_cruise_line']);

// Start output
include $_base_path_cms . 'content/section/meta.php';
?>
<!-- Main content wrapper -->
<section class="body">
	
	<!-- start: page -->
	<div class="row">

		<div class="col-md-12 col-lg-12 col-xl-12">

			<form action="" method="post" enctype="multipart/form-data" >
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Cabine</h2>
					</header>
					<div class="panel-body">
						
						<? include $_base_path_cms . 'content/modules/alerts.php'?>
						
						<table width="100%">
	            			<thead>
		            			<tr>
				    				<td width="60%"><b>Cabina</b></td>
				    				<td width="20%"><b>Pret (<?=$currency['currency']?>)</b></td>
				    				<td width="10%">&nbsp;</td>
				    			</tr>
	            			</thead>
	            			<tbody>
		            			<? if(count($rows)) {?>
		            				<? foreach($rows as $k => $row){?>
			            			<tr>
					    				<td width="60%">
					    					<input 
									    		type="text" 
									    		name="title[]" 
									    		value="<?=$row['title']?>" 
									    		class="form-control" 
									    		placeholder="Cabina" 
									    		style="width:90%"
									    	/>
										</td>
					    				<td width="20%">
					    					<input 
									    		type="text" 
									    		name="price[]" 
									    		value="<?=$row['price']?>" 
									    		class="form-control" 
									    		placeholder="Pret" 
									    		style="width:90%"
									    	/>
					    				</td>
					    				<td class="text-right">
					    					<a 
												class="mb-xs mt-xs mr-xs btn btn-danger delete" href="javascript:;"
												data-toggle="tooltip" data-placement="top" data-original-title="Sterge">
													<i class="fa fa-close"></i>
											</a>
					    				</td>
					    			</tr>
					    			<? }?>
					    		<? }else{?>
					    			<script>
					    				$(document).ready(function(){
					    					$("#row").clone(true).appendTo($("#row").parent()).show().find('td div input').addClass('date-new');
					    				});
					    			</script>
					    		<? }?>
			    				<tr id="row" style="display:none;">
				    				<td width="60%">
				    					<input 
								    		type="text" 
								    		name="title[]" 
								    		value="" 
								    		class="form-control" 
								    		placeholder="Cabina" 
								    		style="width:90%"
								    	/>
									</td>
				    				<td width="20%">
				    					<input 
								    		type="text" 
								    		name="price[]" 
								    		value="" 
								    		class="form-control" 
								    		placeholder="Pret" 
								    		style="width:90%"
								    	/>
				    				</td>
				    				<td class="text-right">
				    					<a 
											class="mb-xs mt-xs mr-xs btn btn-danger delete" href="javascript:;"
											data-toggle="tooltip" data-placement="top" data-original-title="Sterge">
												<i class="fa fa-close"></i>
										</a>
				    				</td>
				    			</tr>
			    			</tbody>
			    			<tfoot>
			    				<tr>
						        	<td colspan="5">
					        			<br><br>
										<div class="col-md-12 text-right">
											<button id="add" name="add" class="btn btn-success">Adauga rand</button>
											<button type="submit" id="submit" name="submit" class="btn btn-primary">Salveaza</button>
										</div>
							        </td>
						        </tr>
			    			</tfoot>
			        	</table>
					</div>
				</section>
			</form>

		</div>
		
	</div>
			
</section>

<script type="text/javascript">
$(document).ready(function(){
	$('#add').click(function(e){
		e.preventDefault();
		$("#row").clone(true).appendTo($("#row").parent()).show().find('td div input').addClass('date-new');
	});
	$('.delete').bind('click', function(){
		$(this).parent().parent().remove();
	});
});
</script>
<?
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();