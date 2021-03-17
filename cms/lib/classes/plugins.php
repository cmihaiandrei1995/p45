<?
/**
 */

class Plugin 
{
	//the path to the plugin
	private $path;	
	
	//the widget array (it will be populated by including the plugin manifest)
	private $widgets;
	
	//the config array
	private $config;
	
	//array for keeping values between backend and frontend
	public $values;
	
	//the config array for view
	public $view_settings;
	
	//the sql to be ran to create the fields in the db
	public $sql;

	/**
	 * Class constructor.
	 * 
	 * @param $plugin The plugin folder you want to load.
	 */
	function __construct($plugin, $config = array()) {
		global $_db, $_base, $_base_path, $_base_cms, $_base_path_cms, $_base_uploads, $_base_uploads_path, $_lang_cms, $_lang_cms_rec, $_sections;
		
		if(!empty($plugin)) {
			$this->path = $_base_path_cms.'plugins/'.$plugin.'/';
			
			if(count($config['globals'])) {
				foreach($config['globals'] as $var) {
					global ${$var};
				}
			}
			if(count($config['vars'])) {
				foreach($config['vars'] as $var => $val) {
					${$var} = $val;
				}
			}
			
			if(is_dir($this->path)) {
				require $this->path.'config.php';
				
				$this->config = $config;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * Sets/modifies a variable.
	 * 
	 * @param $var The variable name / key
	 * @param $val The new value.
	 */
	public function setVar($var, $val) {
		$this->config['vars'][$var] = $val;
	}
	
	/**
	 * Returns the view config.
	 */
	public function getViewSettings() {
		return $this->view_settings;
	}
	
	/**
	 * Returns the sql variable.
	 */
	public function getSql() {
		return $this->sql;
	}
	
	/**
	 * Checks for a widget.
	 */
	public function hasWidget($widget) {
		return isset($this->widgets[$widget]);
	}	
	
	/**
	 * @return The *absolute* path to a certain widget.
	 */
	function widget($widget, $_type) {
		global $_db, $_base, $_base_path, $_base_cms, $_base_path_cms, $_base_uploads, $_base_uploads_path, $_lang_cms, $_lang_cms_rec, $_sections;
		
		if(isset($this->widgets[$widget])) {
			if(count($this->config['globals'])) {
				foreach($this->config['globals'] as $var) {
					global ${$var};
				}
			}
			if(count($this->config['vars'])) {
				foreach($this->config['vars'] as $var => $val) {
					${$var} = $val;
				}
			}
			include $this->path.$_type.'/'.$this->widgets[$widget];
		} else {
			return false;
		}
	}

	/**
	 * @return The *absolute* path to a certain CSS widget.
	 */
	function widgetCSS($widget)	{
		global $_db, $_base, $_base_path, $_base_cms, $_base_path_cms, $_base_uploads, $_base_uploads_path, $_lang_cms, $_lang_cms_rec, $_sections;
		
		if(isset($this->css[$widget])) {
			return $this->path.'css/'.$this->css[$widget];
		} else {
			return false;
		}
	}
	
	/**
	 * @return The *absolute* path to a certain JS widget.
	 */
	function widgetJS($widget) {
		global $_db, $_base, $_base_path, $_base_cms, $_base_path_cms, $_base_uploads, $_base_uploads_path, $_lang_cms, $_lang_cms_rec, $_sections;
		
		if(isset($this->js[$widget])) {
			return $this->path.'js/'.$this->js[$widget];
		} else {
			return false;
		}
	}
}
?>