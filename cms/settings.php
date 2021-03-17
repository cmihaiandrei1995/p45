<?
/**
 * General settings and includes
 */

 // Lang for cms
if(isset($_SESSION[$_site_title]['cms']['lang'])){
	$_lang_cms = $_SESSION[$_site_title]['cms']['lang'];
}else{
	$lng_keys = array_keys($_cms_langs);
	$_SESSION[$_site_title]['cms']['lang'] = $lng_keys[0];
	$_lang_cms = $lng_keys[0];
}

// Lang file include
require_once $_base_path_cms . 'lang/'.$_lang_cms.'.php';
if(is_file($_base_path_cms . 'lang/extra/'.$_lang_cms.'.php')){
	require_once $_base_path_cms . 'lang/extra/'.$_lang_cms.'.php';
}

// Lang for records
if(isset($_SESSION[$_site_title]['cms']['lang_rec'])){
	$_lang_cms_rec = $_SESSION[$_site_title]['cms']['lang_rec'];
}else{
	$lng_keys = array_keys($_website_langs);
	$_SESSION[$_site_title]['cms']['lang_rec'] = $lng_keys[0];
	$_lang_cms_rec = $lng_keys[0];
}

// Setup the ipp
if(isset($_SESSION[$_site_title]['cms']['ipp'])){
	$_ipp = $_SESSION[$_site_title]['cms']['ipp'];
}else{
	$_ipp = 10;
}

// ipp options
$_ipp_values = array(5, 10, 25, 50, 100, 250, 500, 1000);

// Setup $start for ipp
$_start = 0;
if(isset($_GET['pg'])){
	$_start = intval($_GET['pg']) * $_ipp - $_ipp;
	if($_start < 0) $_start = 0;
}

// Define the page
if(isset($_GET['login'])){
	$_page = "login";
	$_do_not_use_restrict = true;
}elseif(isset($_GET['module'])){
	$_module = $_GET['module'];
	$_page = "page";
}else{
	$_page = "home";
}

// Hold the current page in session
if(stripos($_SERVER['REQUEST_URI'], 'bounce.php') === false && !isset($_GET['action']) && !$_is_ajax){
	$_SESSION[$_site_title]['cms']['current_page'] = $_SERVER['REQUEST_URI'];
}

// Include general cms config
require_once $_base_path_cms . 'config.php';

// Add shop section
if($_config['site']['is_shop']){
	// get shop related functions & menu
	require_once $_base_path_cms . 'lib/shop.php';
}

// Add the media section
$_sections['admin_media'] = array(
	'name' => 'Media Center',
	'menu_class' => 'folder-open',

	'modules' => array(
		'admin_media' => array(
			'name' => 'Media Center'
		),
	)
);

// Add the translations area
$tables = db_query('SHOW TABLES');
foreach($tables as $table){
	$_tables[] = $table['Tables_in_'.$_config['db']['database']];
}

if(in_array('admin_translation', $_tables)){
	$count_translations = db_row('SELECT COUNT(*) AS nr FROM admin_translation');
	if($count_translations['nr'] > 0){
		$_sections['admin_translations'] = array(
			'name' => _lng('translations'),
			'menu_class' => 'flag',

			'modules' => array(
				'admin_translations' => array(
					'name' => _lng('translations')
				),
			)
		);
	}
}

// Add admin related tables to $_config['cms']
$_admin_modules = array('admin_media', 'admin_translations', 'admin_groups', 'admin_users');
foreach($_admin_modules as $key){
	$_section = array();

	if(file_exists($_base_path_cms . 'modules/' . $key . '/config.php')) {
		include $_base_path_cms . 'modules/' . $key . '/config.php';

		$_config['cms'][$key] = $_section;

		// get image sizes
		foreach($_section['fields'] as $k => $v){
			if($k == "image"){
				foreach($v['sizes'] as $s => $size){
					$_config['images'][$key][] = $s;
				}
			}
		}
	}
}

// Include cms functions
require_once $_base_path_cms . 'lib/functions.php';

// Include cms classes
require_once $_base_path_cms . 'lib/classes.php';

// Set up restrictions for cms
if(!$_do_not_use_restrict){
	restrict_cms();
}

// actions text
$_actions_txt = array(
	'active' => 'Activare',
	'add' => _lng('add'),
	'delete' => _lng('do_delete'),
	'draft' => 'Salvare draft',
	'edit' => _lng('edit'),
	'inactive' => 'Dezactivare',
	'order' => _lng('order_now'),
	'trash' => 'Mutare in Trash',
	'undo_draft' => 'Mutare din drafts',
	'undo_trash' => 'Scoatere din Trash',
	'view' => _lng('view'),
);

// sections names
foreach($_config['cms'] as $key => $sect){
	$_sections_txt[$key] = $sect['name'];
}

// old icons to new icons - added v1.4
$_menu_icons_to_fa = array(
	'dash' => 'home',
	'files' => 'files-o',
	'user' => 'user',
	'group' => 'users',
	'widgets' => 'gears',
	'monthCalendar' => 'calendar',
	'add' => 'plus',
	'archive' => 'archive',
	'book' => 'book',
	'folder' => 'folder',
	'info' => 'info',
	'help' => 'life-ring',
	'list' => 'list',
	'mail' => 'envelope',
	'money' => 'money',
	'settings' => 'cog',
	'plane' => 'plane',
	'travel' => 'suitcase',
	'walking' => 'globe',
	'world' => 'globe',
	'hotel' => 'hotel',
	'car' => 'car',
	'tables' => 'list'
);

$_form_icons_to_fa = array(
	'mail' => 'envelope',
	'email' => 'envelope',
	'info' => 'info-circle',
	'dayCalendar' => 'calendar',
	'flag2' => 'flag-o',
	'airplane' => 'plane',
	'imagesList' => 'list-ul',
	'locked2' => 'lock',
	'gmaps' => 'pencil-square-o',
	'map' => 'map-marker',
	'link2' => 'link',
	'image2' => 'image',
	'bell2' => 'info-circle'
);
