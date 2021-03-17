<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	db_query('DELETE FROM cruise_date WHERE id_cruise = ?', intval($_GET['id']));
	
	foreach($_POST['date'] as $k => $val){
		if($_POST['date'][$k] != ""){
			db_query('INSERT INTO cruise_date SET id_cruise = ?, date = ?, url = ?', intval($_GET['id']), date("Y-m-d", strtotime($_POST['date'][$k])), $_POST['url'][$k]);
		}
	}
	
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM cruise_date WHERE id_cruise = ? ORDER BY `date` ASC', intval($_GET['id']));

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
				    				<td width="40%"><b>Data</b></td>
				    				<td width="40%"><b>Book ID</b></td>
				    				<td width="10%">&nbsp;</td>
				    			</tr>
	            			</thead>
	            			<tbody>
		            			<? if(count($rows)) {?>
		            				<? foreach($rows as $k => $row){?>
			            			<tr>
					    				<td width="40%">
					    					<div class="input-group input-group-icon" style="width:90%">
												<input 
										    		type="text" 
										    		name="date[]"
										    		class="form-control date" 
										    		value="<?=date("d.m.Y", strtotime($row['date']))?>" 
										    		placeholder="Data" 
										    		autocomplete="off"
										    	/>
										    	<span class="input-group-addon">
													<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
												</span>
											</div>
										</td>
					    				<td width="40%">
					    					<input 
									    		type="text" 
									    		name="url[]" 
									    		value="<?=$row['url']?>" 
									    		class="form-control" 
									    		placeholder="Url" 
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
					    					
					    					$(".date-new").datepicker({ 
												firstDay: 1,
												autoSize: true,
												dateFormat: 'dd.mm.yy',
											});	
					    				});
					    			</script>
					    		<? }?>
			    				<tr id="row" style="display:none;">
				    				<td width="40%">
										<div class="input-group input-group-icon" style="width:90%">
											<input 
									    		type="text" 
									    		name="date[]"
									    		class="form-control" 
									    		value="" 
									    		placeholder="Data" 
									    		autocomplete="off"
									    	/>
									    	<span class="input-group-addon">
												<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
											</span>
										</div>
									</td>
				    				<td width="40%">
				    					<input 
								    		type="text" 
								    		name="url[]" 
								    		value="" 
								    		class="form-control"
								    		placeholder="Url" 
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
						        	<td colspan="3">
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