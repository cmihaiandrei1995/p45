<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$_zone = get_zone_by_id(intval($_GET['id']));

if(isset($_GET['city_from'])){
	$city_from = get_city_by_id(intval($_GET['city_from']));

	$zone_texts = db_row('SELECT * FROM zone_text WHERE id_zone = ? AND id_city_from = ? AND senior = ?', $_zone['id_zone'], $city_from['id_city'], intval($_GET['senior']));

	if(isset($_POST['submit'])){

		if($zone_texts){
			db_query('UPDATE zone_text SET included_services = ?, transfers = ?, info_usefull = ?, financial_terms = ? WHERE id_zone_text = ?',
				$_POST['included_services'],
				$_POST['transfers'],
				$_POST['info_usefull'],
				$_POST['financial_terms'],
				$zone_texts['id_zone_text']
			);
		}else{
			db_query('INSERT INTO zone_text SET id_zone = ?, id_city_from = ?, included_services = ?, transfers = ?, info_usefull = ?, financial_terms = ?, senior = ?',
				$_zone['id_zone'],
				$city_from['id_city'],
				$_POST['included_services'],
				$_POST['transfers'],
				$_POST['info_usefull'],
				$_POST['financial_terms'],
				intval($_GET['senior'])
			);
		}

		go_away($_base_cms."modules/zones/files/texts.php?id=".$_zone['id_zone']."&edited=1");
	}
}

if($_GET['edited']){
	$_messages[] = array(
		'message' => 'Datele au fost salvate cu succes.',
		'type' => 'success'
	);
}

$_texts = array(
	'included_services' => 'Servicii incluse',
	'transfers' => 'Transferuri',
	'info_usefull' => 'Informatii utile',
	'financial_terms' => 'Conditii financiare'
);

list($_other_cities_from, $count_other) = get_posts(array(
	'table' => 'city',
	'limit' => -1,
	'extra_where' => ' AND id_city IN (SELECT id_city_from FROM charter_destination WHERE id_city IN (SELECT id_city FROM city WHERE id_zone = '.$_zone['id_zone'].') )',
	'order' => 'title ASC'
));

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
						<h2 class="panel-title">Texte Tab-uri <?=$_zone['title']?></h2>
					</header>
					<div class="panel-body">

						<? include $_base_path_cms . 'content/modules/alerts.php'?>

						<? if(isset($_GET['city_from'])){?>

							<div class="form-group">
								<label class="col-md-2 control-label" for="title">
									<i class="fa fa-pencil"></i>
									Oras plecare
							    </label>
								<div class="col-md-2">
									<input type="text" id="title" name="title" value="<?=$city_from['title'].($_GET['senior'] == 1 ? " - Seniori" : "")?>" class="form-control" disabled>
							    </div>
							</div>

							<? foreach($_texts as $field => $name){?>
								<div class="form-group">
									<label class="col-md-2 control-label" for="description">
										<i class="fa fa-info-circle"></i>
										<?=$name?>
									</label>

									<div class="col-md-10">
										<textarea name="<?=$field?>" rows="10" class="form-control" id="<?=$field?>"><?=$zone_texts[$field]?></textarea>
		    			    		</div>

									<script type="text/javascript">
										$(document).ready(function(){
											tinymce.init({
												// General options
												mode : "exact",
												elements : "<?=$field?>",
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
							<? }?>

							<div class="row">
								<div class="col-sm-12 text-right">
									<button type="submit" name="submit" class="btn btn-primary">Salveaza</button>
								</div>
							</div>

						<? }else{?>

							<table width="100%">
		            			<thead>
			            			<tr>
					    				<td width="90%"><b>Oras plecare</b></td>
					    				<td width="10%">&nbsp;</td>
					    			</tr>
		            			</thead>
		            			<tbody>
			            			<? if(count($_other_cities_from)) {?>
			            				<? foreach($_other_cities_from as $k => $row){?>
					            			<tr>
					            				<td width="90%">
							    					<?=$row['title']?>
							    				</td>
							    				<td class="text-right">
							    					<a
														class="mb-xs mt-xs mr-xs btn btn-info" href="<?=$_base_cms?>modules/zones/files/texts.php?id=<?=intval($_GET['id'])?>&city_from=<?=$row['id_city']?>"
														data-toggle="tooltip" data-placement="top" data-original-title="Editeaza">
															<i class="fa fa-pencil"></i>
													</a>
							    				</td>
							    			</tr>
						    			<? }?>
										<? foreach($_other_cities_from as $k => $row){?>
					            			<tr>
					            				<td width="90%">
							    					<?=$row['title']?> - Seniori
							    				</td>
							    				<td class="text-right">
							    					<a
														class="mb-xs mt-xs mr-xs btn btn-info" href="<?=$_base_cms?>modules/zones/files/texts.php?id=<?=intval($_GET['id'])?>&city_from=<?=$row['id_city']?>&senior=1"
														data-toggle="tooltip" data-placement="top" data-original-title="Editeaza">
															<i class="fa fa-pencil"></i>
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
