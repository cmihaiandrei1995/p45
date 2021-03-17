<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

if(isset($_GET['grila'])){
	$item = db_row('SELECT * FROM hotel_grila WHERE id_hotel_grila = ?', intval($_GET['grila']));

	if(isset($_POST['submit'])){
		db_query('UPDATE hotel_grila SET title = ?, date_tab_from = ?, date_tab_to = ?, description = ?, description_eb = ?, value_eb = ?, date_expire_eb = ? WHERE id_hotel_grila = ?',
			$_POST['title'],
			($_POST['date_tab_from'] != "" ? date('Y-m-d', strtotime($_POST['date_tab_from'])) : NULL),
			($_POST['date_tab_to'] != "" ? date('Y-m-d', strtotime($_POST['date_tab_to'])) : NULL),
			$_POST['description'],
			$_POST['description_eb'],
			$_POST['value_eb'],
			($_POST['date_expire_eb'] != "" ? date('Y-m-d', strtotime($_POST['date_expire_eb'])) : NULL),
			intval($_GET['grila'])
		);

		go_away($_base_cms."modules/hotels/files/grile.php?id=".intval($_GET['id'])."&edited=1");
	}

	if($_GET['action'] == "delete"){
		db_query('DELETE FROM hotel_grila WHERE id_hotel_grila = ?', intval($_GET['grila']));
		go_away($_base_cms."modules/hotels/files/grile.php?id=".intval($_GET['id'])."&edited=1");
	}
}

if($_GET['edited']){
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$rows = db_query('SELECT * FROM hotel_grila WHERE id_hotel = ? ORDER BY `date_offer_from` ASC', intval($_GET['id']));

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
						<h2 class="panel-title">Grile preturi</h2>
					</header>
					<div class="panel-body">

						<? include $_base_path_cms . 'content/modules/alerts.php'?>

						<? if(isset($_GET['grila'])){?>

							<div class="form-group">
								<label class="col-md-2 control-label" for="title">
									<i class="fa fa-pencil"></i>
									Titlu
							    </label>
								<div class="col-md-2">
									<input type="text" id="title" name="title" value="<?=$item['title']?>" class="form-control">
							    </div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_offer_from">
									<i class="fa fa-calendar"></i>
									Data start oferta
							    </label>
								<div class="col-md-2">
									<div class="input-group input-group-icon">
										<input type="text" id="date_offer_from" name="date_offer_from" value="<?=date('d.m.Y', strtotime($item['date_offer_from']))?>" class="form-control" disabled size="10">
									</div>
							    </div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_offer_to">
									<i class="fa fa-calendar"></i>
									Data final oferta
							    </label>
								<div class="col-md-2">
									<div class="input-group input-group-icon">
										<input type="text" id="date_offer_to" name="date_offer_to" value="<?=date('d.m.Y', strtotime($item['date_offer_to']))?>" class="form-control" disabled size="10">
									</div>
							    </div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_tab_from">
									<i class="fa fa-calendar"></i>
									Data start afisare tab
				    			</label>

								<div class="col-md-2">
									<div class="input-group input-group-icon">
										<input type="text" id="date_tab_from" name="date_tab_from" value="<?=($item['date_tab_from'] != "" ? date('d.m.Y', strtotime($item['date_tab_from'])) : "")?>" class="form-control" placeholder="ex: 19.10.2012" autocomplete="off" size="10">
										<span class="input-group-addon">
											<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
										</span>
									</div>
							    </div>

							    <script type="text/javascript">
								    $(document).ready(function(){
								    	$("#date_tab_from").datepicker({
								    		firstDay: 1,
											autoSize: true,
											dateFormat: 'dd.mm.yy',
											changeMonth: false,
									      	changeYear: false
									    });
										$("#date_tab_from").parent().find('.calendar-trigger').click(function(){
											$("#date_tab_from").trigger('focus');
										});
									});
							    </script>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_tab_to">
									<i class="fa fa-calendar"></i>
									Data final afisare tab
				    			</label>

								<div class="col-md-2">
									<div class="input-group input-group-icon">
										<input type="text" id="date_tab_to" name="date_tab_to" value="<?=($item['date_tab_to'] != "" ? date('d.m.Y', strtotime($item['date_tab_to'])) : "")?>" class="form-control" placeholder="ex: 19.10.2012" autocomplete="off" size="10">
										<span class="input-group-addon">
											<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
										</span>
									</div>
							    </div>

							    <script type="text/javascript">
								    $(document).ready(function(){
								    	$("#date_tab_to").datepicker({
								    		firstDay: 1,
											autoSize: true,
											dateFormat: 'dd.mm.yy',
											changeMonth: false,
									      	changeYear: false
									    });
										$("#date_tab_to").parent().find('.calendar-trigger').click(function(){
											$("#date_tab_to").trigger('focus');
										});
									});
							    </script>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="description">
									<i class="fa fa-info-circle"></i>
									Descriere
								</label>

								<div class="col-md-10">
									<textarea name="description" rows="10" class="form-control" id="description"><?=$item['description']?></textarea>
	    			    		</div>

								<script type="text/javascript">
									$(document).ready(function(){
										tinymce.init({
											// General options
											mode : "exact",
											elements : "description",
											theme : "modern",
											skin : "lightgray",
											plugins: [ "advlist autosave charmap code colorpicker contextmenu hr image link lists media paste preview table textcolor textpattern visualchars wordcount" ],

										    toolbar1: "styleselect | fontsizeselect | bold italic underline strikethrough | subscript superscript | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor",
									        toolbar2: "undo redo | cut copy paste pastetext removeformat | outdent indent | hr | table | link unlink image media charmap | code",

											// Options
											extended_valid_elements : "iframe[src|width|height|name|style|align|border|scrollbars],i[class]",
											convert_urls : false,
											image_advtab: true,
											resize: true,
										    menubar: false,
											height : 300,
											width: "99.5%",

											textpattern_patterns: [
										         {start: '1. ', cmd: 'InsertOrderedList'},
										         {start: '* ', cmd: 'InsertUnorderedList'},
										         {start: '- ', cmd: 'InsertUnorderedList'}
										    ],

											// Basic setup
											setup : function(editor) {
												// Make use of tab and shift+tab to indent paragraphs
												editor.on('keydown', function(e) {
													// Firefox uses the e.which event for keypress, while IE and others use e.keyCode, so we look for both
											        if (e.keyCode) code = e.keyCode;
											        else if (e.which) code = e.which;
											        if(code == 9 && !e.altKey && !e.ctrlKey) {
											            // toggle between Indent and Outdent command, depending on if SHIFT is pressed
											            if (e.shiftKey) editor.execCommand('Outdent');
											            else editor.execCommand('Indent');
											            // prevent tab key from leaving editor in some browsers
											            if(e.preventDefault) {
											                e.preventDefault();
											            }
											            return false;
											        }
										      	});
											}
										});
									});
								</script>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_tab_from">
									<i class="fa fa-calendar"></i>
									Valoare EB (procentual)
				    			</label>

								<div class="col-md-2">
									<div class="input-group">
										<input type="text" id="value_eb" name="value_eb" value="<?=$item['value_eb']?>" class="form-control" placeholder="ex: 25" size="10">
									</div>
							    </div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="description_eb">
									<i class="fa fa-info-circle"></i>
									Descriere EB
								</label>

								<div class="col-md-10">
									<textarea name="description_eb" rows="10" class="form-control" id="description_eb"><?=$item['description_eb']?></textarea>
	    			    		</div>

								<script type="text/javascript">
									$(document).ready(function(){
										tinymce.init({
											// General options
											mode : "exact",
											elements : "description_eb",
											theme : "modern",
											skin : "lightgray",
											plugins: [ "advlist autosave charmap code colorpicker contextmenu hr image link lists media paste preview table textcolor textpattern visualchars wordcount" ],

										    toolbar1: "styleselect | fontsizeselect | bold italic underline strikethrough | subscript superscript | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor",
									        toolbar2: "undo redo | cut copy paste pastetext removeformat | outdent indent | hr | table | link unlink image media charmap | code",

											// Options
											extended_valid_elements : "iframe[src|width|height|name|style|align|border|scrollbars],i[class]",
											convert_urls : false,
											image_advtab: true,
											resize: true,
										    menubar: false,
											height : 300,
											width: "99.5%",

											textpattern_patterns: [
										         {start: '1. ', cmd: 'InsertOrderedList'},
										         {start: '* ', cmd: 'InsertUnorderedList'},
										         {start: '- ', cmd: 'InsertUnorderedList'}
										    ],

											// Basic setup
											setup : function(editor) {
												// Make use of tab and shift+tab to indent paragraphs
												editor.on('keydown', function(e) {
													// Firefox uses the e.which event for keypress, while IE and others use e.keyCode, so we look for both
											        if (e.keyCode) code = e.keyCode;
											        else if (e.which) code = e.which;
											        if(code == 9 && !e.altKey && !e.ctrlKey) {
											            // toggle between Indent and Outdent command, depending on if SHIFT is pressed
											            if (e.shiftKey) editor.execCommand('Outdent');
											            else editor.execCommand('Indent');
											            // prevent tab key from leaving editor in some browsers
											            if(e.preventDefault) {
											                e.preventDefault();
											            }
											            return false;
											        }
										      	});
											}
										});
									});
								</script>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label" for="date_expire_eb">
									<i class="fa fa-calendar"></i>
									Data expirare descriere EB
				    			</label>

								<div class="col-md-2">
									<div class="input-group input-group-icon">
										<input type="text" id="date_expire_eb" name="date_expire_eb" value="<?=($item['date_expire_eb'] != "" ? date('d.m.Y', strtotime($item['date_expire_eb'])) : "")?>" class="form-control" placeholder="ex: 19.10.2012" autocomplete="off" size="10">
										<span class="input-group-addon">
											<span class="icon"><i class="calendar-trigger fa fa-calendar"></i></span>
										</span>
									</div>
							    </div>

							    <script type="text/javascript">
								    $(document).ready(function(){
								    	$("#date_expire_eb").datepicker({
								    		firstDay: 1,
											autoSize: true,
											dateFormat: 'dd.mm.yy',
											changeMonth: false,
									      	changeYear: false
									    });
										$("#date_expire_eb").parent().find('.calendar-trigger').click(function(){
											$("#date_expire_eb").trigger('focus');
										});
									});
							    </script>
							</div>

							<div class="row">
								<div class="col-sm-12 text-right">
									<button type="submit" name="submit" class="btn btn-primary">Salveaza</button>
								</div>
							</div>

						<? }else{?>

							<table width="100%">
		            			<thead>
			            			<tr>
					    				<td width="20%"><b>Denumire</b></td>
					    				<td width="15%"><b>Data start afisare tab</b></td>
					    				<td width="15%"><b>Data final afisare tab</b></td>
					    				<td width="15%"><b>Data start oferta</b></td>
					    				<td width="15%"><b>Data final oferta</b></td>
					    				<td width="20%">&nbsp;</td>
					    			</tr>
		            			</thead>
		            			<tbody>
			            			<? if(count($rows)) {?>
			            				<? foreach($rows as $k => $row){?>
				            			<tr>
				            				<td width="20%">
						    					<?=$row['title']?>
						    				</td>
						    				<td width="15%">
						    					<? if($row['date_tab_from'] != ""){?>
													<?=date("d.m.Y", strtotime($row['date_tab_from']))?>
												<? }?>
						    				</td>
						    				<td width="15%">
						    					<? if($row['date_tab_to'] != ""){?>
													<?=date("d.m.Y", strtotime($row['date_tab_to']))?>
												<? }?>
						    				</td>
						    				<td width="15%">
												<?=date("d.m.Y", strtotime($row['date_offer_from']))?>
						    				</td>
						    				<td width="15%">
												<?=date("d.m.Y", strtotime($row['date_offer_to']))?>
						    				</td>
						    				<td class="text-right">
						    					<a
													class="mb-xs mt-xs mr-xs btn btn-info" href="<?=$_base_cms?>modules/hotels/files/grile.php?id=<?=intval($_GET['id'])?>&grila=<?=$row['id_hotel_grila']?>"
													data-toggle="tooltip" data-placement="top" data-original-title="Editeaza">
														<i class="fa fa-pencil"></i>
												</a>
												<a
													class="mb-xs mt-xs mr-xs btn btn-danger" href="<?=$_base_cms?>modules/hotels/files/grile.php?id=<?=intval($_GET['id'])?>&grila=<?=$row['id_hotel_grila']?>&action=delete"
													data-toggle="tooltip" data-placement="top" data-original-title="Sterge">
														<i class="fa fa-close"></i>
												</a>
						    				</td>
						    			</tr>
						    			<? }?>
						    		<? }?>
				    			</tbody>
				        	</table>

				        <? }?>

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
