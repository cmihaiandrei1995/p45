<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';


// delete action
if($_GET['action'] == "delete"){
	db_query('DELETE FROM circuit_itinerary WHERE id_circuit_itinerary = ?', intval($_GET['id']));
	exit;
}

// insert / update action
if(isset($_POST['submit'])){
	
	foreach($_POST['title'] as $k => $val){
		
		$valid = false;
		if($_POST['title'][$k] != ""){
			$valid = true;
		}
		
		if($valid){
			
			if($_POST['id_circuit_itinerary'][$k] != ""){
				db_query('UPDATE circuit_itinerary SET 
					`title` = ?,
					`map_x` = ?,
					`map_y` = ?, 
					`order` = ? 
					WHERE id_circuit_itinerary = ?
					', 
					$_POST['title'][$k], 
					$_POST['map_x'][$k] == "" ? NULL : $_POST['map_x'][$k],
					$_POST['map_y'][$k] == "" ? NULL : $_POST['map_y'][$k],
					$k,
					$_POST['id_circuit_itinerary'][$k]
				);
			}else{
				db_query('INSERT INTO circuit_itinerary SET 
					`title` = ?, 
					`map_x` = ?,
					`map_y` = ?,
					`id_circuit` = ?,
					`order` = ?
					', 
					$_POST['title'][$k],
					$_POST['map_x'][$k] == "" ? NULL : $_POST['map_x'][$k], 
					$_POST['map_y'][$k] == "" ? NULL : $_POST['map_y'][$k],
					intval($_GET['id']), 
					$k
				);
			}
		}
	}
	
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

// get current records
$rows = db_query('SELECT * FROM circuit_itinerary WHERE id_circuit = ? ORDER BY `order` ASC', intval($_GET['id']));

// Start output
include $_base_path_cms . 'content/section/meta.php';
?>
<style>
.ui-sortable-helper {
    display: table;
}
.ui-sortable-handle:before {
	content: none;
}
.ui-state-highlight{
	height: 44px;
}
.row td:first-child {
	cursor: move;
}
</style>
<!-- Main content wrapper -->
<section class="body">
	
	<!-- start: page -->
	<div class="row">

		<div class="col-md-12 col-lg-12 col-xl-12">

			<form action="" method="post" enctype="multipart/form-data" >
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Itinerariu circuit</h2>
					</header>
					<div class="panel-body">
						
						<? include $_base_path_cms . 'content/modules/alerts.php'?>
						
						<table width="100%" id="sortable">
	            			<tbody>
	            				<tr class="row">
		            				<td width="20">&nbsp;</td>
				    				<td width="40%"><b>Oras itinerariu</b></td>
				    				<td width="25%"><b>Latitudine</b></td>
				    				<td width="25%"><b>Longitudine</b></td>
				    				<td width="5%">&nbsp;</td>
				    			</tr>
		            			<? if(count($rows)) {?>
		            				<? foreach($rows as $k => $row){?>
			            			<tr class="row">
			            				<td width="20">
				    						<i class="fa fa-ellipsis-v"></i>
				    						<i class="fa fa-ellipsis-v"></i>
				    					</td>
					    				<td width="40%">
					    					<input 
									    		type="text" 
									    		name="title[]" 
									    		value="<?=$row['title']?>" 
									    		class="form-control" 
									    		placeholder="Nume valoare" 
									    		style="width:90%"
									    	/>
										</td>
										<td width="25%">
					    					<input 
									    		type="text" 
									    		name="map_x[]" 
									    		value="<?=$row['map_x']?>" 
									    		class="form-control" 
									    		placeholder="Latitudine" 
									    		style="width:90%"
									    	/>
										</td>
										<td width="25%">
					    					<input 
									    		type="text" 
									    		name="map_y[]" 
									    		value="<?=$row['map_y']?>" 
									    		class="form-control" 
									    		placeholder="Longitudine" 
									    		style="width:90%"
									    	/>
										</td>
					    				<td class="text-right" width="5%">
					    					<a 
												class="mb-xs mt-xs mr-xs btn btn-danger delete" href="javascript:;"
												data-toggle="tooltip" data-placement="top" data-original-title="Sterge">
													<i class="fa fa-close"></i>
											</a>
											<input type="hidden" name="id_circuit_itinerary[]" value="<?=$row['id_circuit_itinerary']?>" class="id">
					    				</td>
					    			</tr>
					    			<? }?>
					    		<? }else{?>
					    			<script>
					    				$(document).ready(function(){
					    					cloneRow();
					    				});
					    			</script>
					    		<? }?>
			    				<tr id="row" class="row" style="display:none;">
			    					<td width="20">
			    						<i class="fa fa-ellipsis-v"></i>
			    						<i class="fa fa-ellipsis-v"></i>
			    					</td>
				    				<td width="40%">
				    					<input 
								    		type="text" 
								    		name="title[]" 
								    		value="" 
								    		class="form-control" 
								    		placeholder="Nume valoare" 
								    		style="width:90%"
								    	/>
									</td>
									<td width="25%">
				    					<input 
								    		type="text" 
								    		name="map_x[]" 
								    		value="" 
								    		class="form-control" 
								    		placeholder="Latitudine" 
								    		style="width:90%"
								    	/>
									</td>
									<td width="25%">
				    					<input 
								    		type="text" 
								    		name="map_y[]" 
								    		value="" 
								    		class="form-control" 
								    		placeholder="Longitudine" 
								    		style="width:90%"
								    	/>
									</td>
				    				<td class="text-right" width="5%">
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
						        	<td colspan="100">
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
		cloneRow();
	});
	
	$('.delete').bind('click', function(){
		if($(this).parent().find('.id').val() != ""){
			$.ajax({
				type: 'GET',
				url: $_base_cms + 'modules/circuits/files/itinerary.php',
				data: {
					id: $(this).parent().find('.id').val(),
					action: 'delete'
				},
			});
		}
		$(this).parent().parent().remove();
	});
	
    $("#sortable tbody").sortable({
    	placeholder: "ui-state-highlight"
    });
    $("#sortable tbody").disableSelection();
});

function cloneRow(){
	$new_row = $("#row").clone(true);
	$new_row.appendTo($("#row").parent()).show();
}
</script>

<?
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();