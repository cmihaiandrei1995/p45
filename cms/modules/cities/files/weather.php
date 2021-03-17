<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_POST['submit'])){
	
	foreach($_months as $m => $month){
		if($_POST['min_temp'][$m-1] != "" && $_POST['max_temp'][$m-1] != ""){
			$exists = db_row('SELECT * FROM city_weather WHERE id_city = ? AND month = ?', intval($_GET['id']), $m);
			if($exists){
				db_query('UPDATE city_weather SET icon = ?, min_temp = ?, max_temp = ? WHERE month = ? AND id_city = ?', 
					$_POST['icon'][$m-1], 
					$_POST['min_temp'][$m-1],
					$_POST['max_temp'][$m-1],
					$m, 
					intval($_GET['id'])
				);
			}else{
				db_query('INSERT INTO city_weather SET icon = ?, month = ?, min_temp = ?, max_temp = ?, id_city = ?', 
					$_POST['icon'][$m-1], 
					$m, 
					$_POST['min_temp'][$m-1],
					$_POST['max_temp'][$m-1],
					intval($_GET['id'])
				);
			}
		}
	}

	go_away($_base_cms."modules/cities/files/weather.php?id=".intval($_GET['id'])."&edited=1");
}

if($_GET['edited']){
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$item = db_row('SELECT * FROM city WHERE id_city = ?', intval($_GET['id']));

$rows = db_query('SELECT * FROM city_weather WHERE id_city = ? ORDER BY `month` ASC', intval($_GET['id']));
foreach($rows as $row){
	$_data[$row['month']] = $row;
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
						<h2 class="panel-title">Vremea <?=$item['title']?></h2>
					</header>
					<div class="panel-body">
						
						<? include $_base_path_cms . 'content/modules/alerts.php'?>
						
						<table width="100%">
	            			<thead>
		            			<tr>
				    				<td width="25%"><b>Luna</b></td>
				    				<td width="25%"><b>Icon</b></td>
				    				<td width="25%"><b>Temp Min</b></td>
				    				<td width="25%"><b>Temp Max</b></td>
				    			</tr>
	            			</thead>
	            			<tbody>
	            				<? foreach($_months as $m => $month){?>
	            					<tr><td colspan="10">&nbsp;</td></tr>
			            			<tr>
			            				<td width="25%">
					    					<?=$month?>
					    					<input type="hidden" name="month[]" value="<?=$m?>">
					    				</td>
					    				<td width="25%">
					    					<div class="form-group">
												<select class="form-control" style="width:90%" name="icon[]">
													<option value=""></option>
													<? foreach($_weather_icons as $k => $v){?>
														<option value="<?=$k?>" <? if($k==$_data[$m]['icon']){?>selected<? }?>><?=$v?></option>
													<? }?>
												</select>
											</div>
					    				</td>
					    				<td width="25%">
					    					<div class="form-group">
												<input type="text" name="min_temp[]" value="<?=$_data[$m]['min_temp']?>" class="form-control" placeholder="ex: 20" style="width:90%">
											</div>
					    				</td>
					    				<td width="25%">
											<div class="form-group">
												<input type="text" name="max_temp[]" value="<?=$_data[$m]['max_temp']?>" class="form-control" placeholder="ex: 20" style="width:90%">
											</div>
					    				</td>
					    			</tr>
				    			<? }?>
				    			<tr><td colspan="10">&nbsp;</td></tr>
			    			</tbody>
			        	</table>
			        	
			        	<div class="row">
							<div class="col-sm-12 text-center">
								<button type="submit" name="submit" class="btn btn-primary">Salveaza</button>
							</div>
						</div>
				        	
					</div>
				</section>
			</form>

		</div>
		
	</div>
			
</section>

<?
// Include footer
include $_base_path_cms . 'content/section/footer.php';

// Close the conn
$_db->close();