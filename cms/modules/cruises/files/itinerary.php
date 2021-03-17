<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	db_query('DELETE FROM cruise_itinerary WHERE id_cruise = ?', intval($_GET['id']));
	
	foreach($_POST['id_cruise_port'] as $k => $val){
		if($_POST['id_cruise_port'][$k] != "" && $_POST['day'][$k] != ""){
			db_query('INSERT INTO cruise_itinerary SET id_cruise = ?, day = ?, id_cruise_port = ?, from_hour = ?, till_hour = ?', intval($_GET['id']), $_POST['day'][$k], $_POST['id_cruise_port'][$k], $_POST['from_hour'][$k], $_POST['till_hour'][$k]);
		}
	}
	
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM cruise_itinerary WHERE id_cruise = ? ORDER BY `day` ASC, CHAR_LENGTH(from_hour) ASC, CHAR_LENGTH(till_hour) DESC, from_hour ASC, till_hour ASC', intval($_GET['id']));

$record = db_row('SELECT * FROM cruise WHERE id_cruise = ?', intval($_GET['id']));
//$ports = db_query('SELECT port.* FROM cruise_to_port JOIN port USING (id_cruise_port) WHERE cruise_to_port.id_cruise = ?', intval($_GET['id']));
$ports = db_query('SELECT * FROM cruise_port ORDER BY title ASC');

if($record['nights'] < 1){
	$_error_add = 1;
	$_messages[] = array(
		'message' => 'Numarul de nopti nu a fost definit.',
		'type' => 'warning'
	);
}

if(!$ports){
	$_error_add = 1;
	$_messages[] = array(
		'message' => 'Nu au fost definite porturi.',
		'type' => 'warning'
	);
}

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
						<h2 class="panel-title">Itinerariu</h2>
					</header>
					<div class="panel-body">
						
						<? include $_base_path_cms . 'content/modules/alerts.php'?>
						
						<? if(!$_error_add){?>
							<table width="100%">
		            			<thead>
			            			<tr>
					    				<td width="10%"><b>Zi</b></td>
					    				<td width="40%"><b>Port</b></td>
					    				<td width="20%"><b>Ora sosire</b></td>
					    				<td width="20%"><b>Ora plecare</b></td>
					    				<td width="10%">&nbsp;</td>
					    			</tr>
		            			</thead>
		            			<tbody>
			            			<? if(count($rows)) {?>
			            				<? foreach($rows as $k => $row){?>
				            			<tr>
				            				<td width="10%">
				            					<select name="day[]" class="form-control select2" style="width:70%">
													<option value=""></option>
													<? for($i=1; $i<=$record['nights']+1; $i++){?>
											        	<option value="<?=$i?>" <? if($row['day'] == $i) echo "selected"?>><?=$i?></option>
											        <? }?>
											    </select>
				            				</td>
						    				<td width="40%">
						    					<select name="id_cruise_port[]" class="form-control select2" style="width:90%">
													<option value="0">Pe mare</option>
													<? foreach($ports as $port){?>
											        	<option value="<?=$port['id_cruise_port']?>" <? if($row['id_cruise_port'] == $port['id_cruise_port']) echo "selected"?>><?=$port['title']?></option>
											        <? }?>
											    </select>
											</td>
						    				<td width="20%">
						    					<input 
										    		type="text" 
										    		name="from_hour[]" 
										    		value="<?=$row['from_hour']?>" 
										    		class="form-control" 
										    		placeholder="Ora sosire" 
										    		style="width:90%"
										    	/>
						    				</td>
						    				<td width="20%">
						    					<input 
										    		type="text" 
										    		name="till_hour[]" 
										    		value="<?=$row['till_hour']?>" 
										    		class="form-control" 
										    		placeholder="Ora plecare" 
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
					    				<td width="10%">
			            					<select name="day[]" class="form-control select2_clone" style="width:70%">
												<option value=""></option>
												<? for($i=1; $i<=$record['nights']+1; $i++){?>
										        	<option value="<?=$i?>"><?=$i?></option>
										        <? }?>
										    </select>
			            				</td>
					    				<td width="40%">
					    					<select name="id_cruise_port[]" class="form-control select2_clone" style="width:90%">
												<option value="0">Pe mare</option>
												<? foreach($ports as $port){?>
										        	<option value="<?=$port['id_cruise_port']?>"><?=$port['title']?></option>
										        <? }?>
										    </select>
										</td>
					    				<td width="20%">
					    					<input 
									    		type="text" 
									    		name="from_hour[]" 
									    		value="" 
									    		class="form-control" 
									    		placeholder="Ora sosire" 
									    		style="width:90%"
									    	/>
					    				</td>
					    				<td width="20%">
					    					<input 
									    		type="text" 
									    		name="till_hour[]" 
									    		value="" 
									    		class="form-control" 
									    		placeholder="Ora plecare" 
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
				        <? }?>
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
		$("#row").clone(true).appendTo($("#row").parent()).show().find('td div input').addClass('date-new').end().find('.select2_clone').removeClass('select2_clone')
			.select2({
				minimumResultsForSearch: 25,
				dropdownAutoWidth: true
			});
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