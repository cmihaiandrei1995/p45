<?php
$_use_routes = false;
$_is_cms = true;
$_is_ajax = true;
require_once dirname(__FILE__) . '/../../../../config.php';
require_once dirname(__FILE__) . '/../../../settings.php';

$action = db_row('SELECT * FROM admin_action WHERE id_admin_action = ?', intval($_GET['id']));

if($_config['cms'][$action['section']]){

	$data = unserialize(gzinflate($action['data']));

	if($data){
		$action_old = db_row('SELECT * FROM admin_action WHERE id_what = ? AND id_admin_action != ? AND data IS NOT NULL ORDER BY id_admin_action DESC LIMIT 1', $action['id_what'], $action['id_admin_action']);
		$data_old = unserialize(gzinflate($action_old['data']));
	}else{
		echo "Actiunea nu include salvare de date.";
		exit;
	}

	$_module = $action['section'];
	$_action = "view";

	if(file_exists($_base_path_cms . 'modules/' . $_module . '/config.php')) {
		include $_base_path_cms . 'modules/' . $_module . '/config.php';
		if(file_exists($_base_path_cms . 'modules/' . $_module . '/extra.config.php')) {
			include $_base_path_cms . 'modules/' . $_module . '/extra.config.php';
		}
	} else {
		echo "Sectiunea nu mai este disponibila in CMS.";
		exit;
	}

	// Loading field plugins
	foreach($_section['fields'] as $key => $field){
		// Setting globals and variables (dumping the whole field config array)
		$config = array(
			'globals' => array(
				'_multiple_lang', '_website_langs'
			),
			'vars' => array('field' => $field, '_section' => $_section, '_action' => $_action)
		);

		// Constructing the plugin
		$plugin = new Plugin($_section['fields'][$key]['type'], $config);
		if(!empty($plugin)) $_fields[$key] = $plugin;

		if($_fields[$key]->hasWidget('data')){
			$_fields[$key]->widget('data', 'backend');
		}

		// check for multiple languages
		if(count($_section['fields'][$key]['lng']) > 1){
			$_multiple_lang = true;
		}
	}

	if($_multiple_lang){

		// TODO ...

	}else{
		$lng = array_keys($_website_langs)[0];

		foreach($data as $key => $val){
			$record_data[$key] = $val[$lng];
		}

		if($data_old){
			foreach($data_old as $key => $val){
				$record_data_old[$key] = $val[$lng];
			}
		}
	}


}else{
	echo "Sectiunea nu mai este disponibila in CMS.";
	exit;
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
						<h2 class="panel-title">Informatii log</h2>
					</header>
					<div class="panel-body">

						<? include $_base_path_cms . 'content/modules/alerts.php'?>

						<table class="table mb-none table-hover table-striped">

							<tr>
								<th>Camp</th>
								<th>Valoare</th>
								<? if($data_old){?>
									<th>Valoare veche</th>
								<? }?>
							</tr>

							<? foreach($_section['fields'] as $fld => $field){ ?>

								<? if(!$field['hidden']){?>

									<tr>

					                	<?
					                	$field_settings = $_fields[$fld]->getViewSettings();
					                	if($field_settings['is_viewable']){?>

											<td style="min-width:100px">
												<?=$_section['fields'][$fld]['name']?>
											</td>

											<td>
												<?
												$record = $record_data;

							            		if($_fields[$fld]->hasWidget('view')){
							            			if($field_settings['is_viewable']){
														$_fields[$fld]->widget('view', 'frontend');
													}
												}else{
													$field_settings = $_fields[$fld]->getViewSettings();
								                	if($field_settings['is_viewable']){?>
								                		<?
								                		if(count($_section['fields'][$fld]['values'])){
								                			$key = $record[$_section['fields'][$fld]['db_name']];
														}

														if($_section['fields'][$fld]['values'][$key] != ""){
															$value = $_section['fields'][$fld]['values'][$key];
								                		}else{
								                			$value = limit_text(strip_tags($record[$_section['fields'][$fld]['db_name']]), 100);
								                		}

														if($field_settings['view_callback']){
															echo call_user_func_array($field_settings['view_callback'], array($value));
														}elseif($_section['fields'][$fld]['view_callback']){
															echo call_user_func_array($_section['fields'][$fld]['view_callback'], array($value));
														}else{
															echo $value;
														}
								                		?>
								                	<? }?>
								                <? }?>
											</td>

											<? if($data_old){?>
												<td>
													<?
													$record = $record_data_old;

								            		if($_fields[$fld]->hasWidget('view')){
								            			if($field_settings['is_viewable']){
															$_fields[$fld]->widget('view', 'frontend');
														}
													}else{
														$field_settings = $_fields[$fld]->getViewSettings();
									                	if($field_settings['is_viewable']){?>
									                		<?
									                		if(count($_section['fields'][$fld]['values'])){
									                			$key = $record[$_section['fields'][$fld]['db_name']];
															}

															if($_section['fields'][$fld]['values'][$key] != ""){
																$value = $_section['fields'][$fld]['values'][$key];
									                		}else{
									                			$value = limit_text(strip_tags($record[$_section['fields'][$fld]['db_name']]), 100);
									                		}

															if($field_settings['view_callback']){
																echo call_user_func_array($field_settings['view_callback'], array($value));
															}elseif($_section['fields'][$fld]['view_callback']){
																echo call_user_func_array($_section['fields'][$fld]['view_callback'], array($value));
															}else{
																echo $value;
															}
									                		?>
									                	<? }?>
									                <? }?>
												</td>
											<? }?>

										<? }?>

									</tr>

								<? }?>

			                <? }?>

						</table>

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
