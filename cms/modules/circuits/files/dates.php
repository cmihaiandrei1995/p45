<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	foreach($_POST['id_circuit_date_price'] as $k => $val){
		db_query('UPDATE circuit_date_price SET
			price = ?, priceNoRedd = ?, reduction_type = ?, offer_type = ?
			-- , expired = ?, last_chance = ?
			WHERE id_circuit_date_price = ?',
			$_POST['price'][$k], $_POST['priceNoRedd'][$k] != "" ? $_POST['priceNoRedd'][$k] : NULL, $_POST['reduction_type'][$k], $_POST['offer_type'][$k],
			//$_POST['expired'][$k], $_POST['last_chance'][$k] != "" ? $_POST['last_chance'][$k] : NULL,
			$_POST['id_circuit_date_price'][$k]
		);
	}

	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM circuit_date_price WHERE id_circuit = ? ORDER BY `dep_date` ASC', intval($_GET['id']));

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
				    				<td width="15%"><b>Pret</b></td>
				    				<td width="15%"><b>Pret vechi</b></td>
				    				<td width="15%"><b>Tip reducere</b></td>
				    				<td width="15%"><b>Tip oferta</b></td>
									<!--
									<td width="15%"><b>Epuizat</b></td>
									<td width="10%"><b>Locuri ramase</b></td>
									-->
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
											    		name="date[]"
											    		class="form-control date"
											    		value="<?=date("d.m.Y", strtotime($row['dep_date']))?>"
											    		placeholder="Data"
											    		autocomplete="off"
											    		disabled
											    	/>
											    	<span class="input-group-addon">
														<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
													</span>
												</div>
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
						    				<td width="15%">
						    					<input
										    		type="text"
										    		name="priceNoRedd[]"
										    		value="<?=$row['priceNoRedd']?>"
										    		class="form-control"
										    		placeholder="Pret vechi"
										    		style="width:90%"
										    	/>
						    				</td>
						    				<td width="15%">
						    					<select name="reduction_type[]" class="form-control select2" style="width:90%">
						    						<option value=""></option>
													<option value="1" <?=($row['reduction_type'] == 1 ? "selected" : "")?>>Procentual</option>
													<option value="2" <?=($row['reduction_type'] == 2 ? "selected" : "")?>>Valoric</option>
											    </select>
						    				</td>
						    				<td width="15%">
						    					<select name="offer_type[]" class="form-control select2" style="width:90%">
													<option value="">Fara oferta</option>
													<option value="1" <?=($row['offer_type'] == 1 ? "selected" : "")?>>Oferta speciala</option>
													<option value="2" <?=($row['offer_type'] == 2 ? "selected" : "")?>>Last minute</option>
													<option value="3" <?=($row['offer_type'] == 3 ? "selected" : "")?>>Early booking</option>
											    </select>
						    				</td>
											<!--
												<td width="15%">
							    					<select name="expired[]" class="form-control select2" style="width:90%">
							    						<option value=""></option>
														<option value="0" <?=($row['expired'] == 0 || $row['expired'] == "" ? "selected" : "")?>>Nu</option>
														<option value="1" <?=($row['expired'] == 1 ? "selected" : "")?>>Da</option>
												    </select>
							    				</td>
												<td width="10%">
													<input
											    		type="text"
											    		name="last_chance[]"
											    		value="<?=$row['last_chance']?>"
											    		class="form-control"
											    		placeholder="Ultimele locuri"
											    		style="width:90%"
											    	/>
							    				</td>
											-->
						    			</tr>
						    			<input type="hidden" name="id_circuit_date_price[]" value="<?=$row['id_circuit_date_price']?>">
					    			<? }?>
					    		<? }?>
			    			</tbody>
			    			<tfoot>
			    				<tr>
						        	<td colspan="10">
					        			<br><br>
										<div class="col-md-12 text-right">
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
