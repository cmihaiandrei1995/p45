<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	db_query('DELETE FROM ticket_date WHERE id_ticket = ?', intval($_GET['id']));

	foreach($_POST['date_from'] as $k => $val){
		if($_POST['date_from'][$k] != "" && $_POST['price'][$k] != ""){
			db_query('INSERT INTO ticket_date SET id_ticket = ?, date_from = ?, time_departure_from = ?, time_departure_to = ?, date_to = ?, time_return_from = ?, time_return_to = ?, price = ?',
					intval($_GET['id']), date("Y-m-d", strtotime($_POST['date_from'][$k])), $_POST['time_departure_from'][$k], $_POST['time_departure_to'][$k], $_POST['date_to'][$k] != "" ? date("Y-m-d", strtotime($_POST['date_to'][$k])) : NULL, $_POST['time_return_from'][$k], $_POST['time_return_to'][$k], $_POST['price'][$k]);
		}
	}

	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM ticket_date WHERE id_ticket = ? ORDER BY `id_ticket_date` ASC', intval($_GET['id']));

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
						<h2 class="panel-title">Date plecare</h2>
					</header>
					<div class="panel-body">

						<? include $_base_path_cms . 'content/modules/alerts.php'?>

						<table width="100%">
	            			<thead>
		            			<tr>
				    				<td width="15%"><b>Data plecare</b></td>
				    				<td width="10%"><b>Ora plecare</b></td>
				    				<td width="10%"><b>Ora sosire</b></td>
				    				<td width="15%"><b>Data intoarcere</b></td>
				    				<td width="10%"><b>Ora plecare</b></td>
				    				<td width="10%"><b>Ora sosire</b></td>
				    				<td width="15%"><b>Pret (EUR)</b></td>
				    				<td width="5%">&nbsp;</td>
				    			</tr>
	            			</thead>

	            			<tbody>
		            			<? if(count($rows)) {?>
		            				<? foreach($rows as $k => $row){?>
			            			<tr>
					    				<td width="15%">
					    					<div class="input-group input-group-icon" style="width:90%">
												<input
										    		type="text"
										    		name="date_from[]"
										    		class="form-control date"
										    		value="<?=date("d.m.Y", strtotime($row['date_from']))?>"
										    		placeholder="Data plecare"
										    		autocomplete="off"
										    	/>
										    	<span class="input-group-addon">
													<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
												</span>
											</div>
										</td>
										<td width="10%">
											<input
									    		type="text"
									    		name="time_departure_from[]"
									    		class="form-control"
									    		value="<?=$row['time_departure_from']?>"
									    		placeholder="Ora plecare"
									    		style="width:90%"
									    	/>
										</td>
										<td width="10%">
											<input
									    		type="text"
									    		name="time_departure_to[]"
									    		class="form-control"
									    		value="<?=$row['time_departure_to']?>"
									    		placeholder="Ora sosire"
									    		style="width:90%"
									    	/>
										</td>
										<td width="15%">
					    					<div class="input-group input-group-icon" style="width:90%">
												<input
										    		type="text"
										    		name="date_to[]"
										    		class="form-control date"
										    		value="<?=$row['date_to'] != "" && $row['date_to'] != "1970-01-01" ? date("d.m.Y", strtotime($row['date_to'])) : ""?>"
										    		placeholder="Data intoarcere"
										    		autocomplete="off"
										    	/>
										    	<span class="input-group-addon">
													<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
												</span>
											</div>
										</td>
										<td width="10%">
											<input
									    		type="text"
									    		name="time_return_from[]"
									    		class="form-control"
									    		value="<?=$row['time_return_from']?>"
									    		placeholder="Ora plecare"
									    		style="width:90%"
									    	/>
										</td>
										<td width="10%">
											<input
									    		type="text"
									    		name="time_return_to[]"
									    		class="form-control"
									    		value="<?=$row['time_return_to']?>"
									    		placeholder="Ora sosire"
									    		style="width:90%"
									    	/>
										</td>
					    				<td width="15%">
					    					<input
									    		type="text"
									    		name="price[]"
									    		value="<?=$row['price']?>"
									    		class="form-control"
									    		placeholder="Pret"
									    		style="width:90%"
									    	/>
					    				</td>
					    				<td width="5%" class="text-right">
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

					    					$(".date-new").datepicker({
												firstDay: 1,
												autoSize: true,
												dateFormat: 'dd.mm.yy',
											});
					    				});
					    			</script>
					    		<? }?>
			    				<tr id="row" style="display:none;">
				    				<td width="15%">
										<div class="input-group input-group-icon" style="width:90%">
											<input
									    		type="text"
									    		name="date_from[]"
									    		class="form-control"
									    		value=""
									    		placeholder="Data plecare"
									    		autocomplete="off"
									    	/>
									    	<span class="input-group-addon">
												<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
											</span>
										</div>
									</td>
									<td width="10%">
										<input
								    		type="text"
								    		name="time_departure_from[]"
								    		class="form-control"
								    		value=""
								    		placeholder="Ora plecare"
								    		style="width:90%"
								    	/>
									</td>
									<td width="10%">
										<input
								    		type="text"
								    		name="time_departure_to[]"
								    		class="form-control"
								    		value=""
								    		placeholder="Ora sosire"
								    		style="width:90%"
								    	/>
									</td>
									<td width="15%">
										<div class="input-group input-group-icon" style="width:90%">
											<input
									    		type="text"
									    		name="date_to[]"
									    		class="form-control"
									    		value=""
									    		placeholder="Data intoarcere"
									    		autocomplete="off"
									    	/>
									    	<span class="input-group-addon">
												<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
											</span>
										</div>
									</td>
									<td width="10%">
										<input
								    		type="text"
								    		name="time_return_from[]"
								    		class="form-control"
								    		value=""
								    		placeholder="Ora plecare"
								    		style="width:90%"
								    	/>
									</td>
									<td width="10%">
										<input
								    		type="text"
								    		name="time_return_to[]"
								    		class="form-control"
								    		value=""
								    		placeholder="Ora sosire"
								    		style="width:90%"
								    	/>
									</td>
				    				<td width="15%">
				    					<input
								    		type="text"
								    		name="price[]"
								    		value=""
								    		class="form-control"
								    		placeholder="Pret"
								    		style="width:90%"
								    	/>
				    				</td>
				    				<td width="5%" class="text-right">
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
						        	<td colspan="10">
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

		$(".date-new").datepicker({
			firstDay: 1,
			autoSize: true,
			dateFormat: 'dd.mm.yy',
		});
	});
	$('.delete').bind('click', function(){
		$(this).parent().parent().remove();
	});


	$(".date").datepicker({
		firstDay: 1,
		autoSize: true,
		dateFormat: 'dd.mm.yy',
	});
});
</script>
<?
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();
