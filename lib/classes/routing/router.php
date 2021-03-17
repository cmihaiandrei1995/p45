<?php

class router {

	protected $routes = array();
	protected $namedRoutes = array();
	protected $basePath = '';
	protected $matchTypes = array(
		'p'  => '(a^)|(?:page)(\d+)',
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '[^/\.]+',
		'**' => '.++',
		'#' => '.+?',
		''   => '[^/\.]++'
	);

	/**
	  * Create router in one call from config.
	  *
	  * @param array $routes
	  * @param string $basePath
	  * @param array $matchTypes
	  */
	public function __construct( $routes = array(), $basePath = '', $matchTypes = array() ) {
		global $_config;
		$this->matchTypes['p'] = str_replace('page', $_config['paging']['page_link'], $this->matchTypes['p']);

		$this->addRoutes($routes);
		$this->setBasePath($basePath);
		$this->addMatchTypes($matchTypes);
	}

	/**
	 * Add multiple routes at once from array in the following format:
	 *
	 *   $routes = array(
	 *      array($method, $route, $target, $name)
	 *   );
	 *
	 * @param array $routes
	 * @return void
	 * @author Koen Punt
	 */
	public function addRoutes($routes){
		if(!is_array($routes) && !$routes instanceof Traversable) {
			throw new \Exception('Routes should be an array or an instance of Traversable');
		}
		foreach($routes as $route) {
			call_user_func_array(array($this, 'map'), $route);
		}
	}

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public function setBasePath($basePath) {
		$this->basePath = $basePath;
	}

	/**
	 * Add named match types. It uses array_merge so keys can be overwritten.
	 *
	 * @param array $matchTypes The key is the name and the value is the regex.
	 */
	public function addMatchTypes($matchTypes) {
		$this->matchTypes = array_merge($this->matchTypes, $matchTypes);
	}

	/**
	 * Map a route to a target
	 *
	 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed $target The target where this route should point to. Can be anything.
	 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
	 */
	public function map($method, $route, $target, $query, $name = null) {

		$this->routes[] = array($method, $route, $target, $query, $name);

		if($name) {
			if(isset($this->namedRoutes[$name])) {
				throw new \Exception("Can not redeclare route '{$name}'");
			} else {
				$this->namedRoutes[$name] = $route;
			}

		}

		return;
	}

	/**
	 * Reversed routing
	 *
	 * Generate the URL for a named route. Replace regexes with supplied parameters
	 *
	 * @param string $routeName The name of the route.
	 * @param array @params Associative array of parameters to replace placeholders with.
	 * @return string The URL of the route with named parameters in place.
	 */
	public function generate($routeName, array $params = array()) {

		// Check if named route exists
		if(!isset($this->namedRoutes[$routeName])) {
			throw new \Exception("Route '{$routeName}' does not exist.");
		}

		// Replace named parameters
		$route = $this->namedRoutes[$routeName];

		// prepend base path to route url again
		$url = $this->basePath . ltrim($route, '/');

		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|\/\?|)`', $route, $matches, PREG_SET_ORDER)) {

			foreach($matches as $i => $match) {
				list($block, $pre, $type, $param, $optional) = $match;

				$post = '';

				if ($pre) {
					$block = substr($block, 1);
				}

				if(isset($params[$param]) || isset($params[$i])) {
					$replace = $params[$param] ? $params[$param] : $params[$i];

					if($replace != ""){
						if(substr($block, -2) == '/?') {
							$post = (is_null($replace) ? '' : '/');
						}
						//$url = str_replace($block, $replace, $url).$post;
						$url = str_replace($block, $replace.$post, $url);
					}else{
						$url = str_replace($block, "", $url);
					}
				} elseif ($optional) {
					$url = str_replace($pre.$block, $pre, $url).$post;
				}
			}

		}

		// add ?preview
		if(isset($_GET['preview']) && is_logged_in_cms()){
			$preview_found = false;

			$tmp = explode("?", $url);
			if($tmp[1]){
				$tmp_amp = explode("&", $tmp[1]);
				foreach($tmp_amp as $amp){
					if(strpos($amp, 'preview') !== false){
						$preview_found = true;
					}
				}
			}

			if(!$preview_found && !$tmp[1]){
				$url .= "?preview";
			}elseif(!$preview_found && $tmp[1]){
				$url .= "&preview";
			}
		}

		return $url;
	}

	/**
	 * Match a given Request Url against stored routes
	 * @param string $requestUrl
	 * @param string $requestMethod
	 * @return array|boolean Array with route information on success, false on failure (no match).
	 */
	public function match($requestUrl = null, $requestMethod = null) {

		global $_base, $_config;

		$params = array();
		$match = false;

		// set Request Url if it isn't passed as parameter
		if($requestUrl === null) {
			$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		}

		// strip base path from request url
		$requestUrl = substr($requestUrl, strlen($this->basePath));

		// Strip query string (?a=b) from Request Url
		if (($strpos = strpos($requestUrl, '?')) !== false) {
			$requestUrl = substr($requestUrl, 0, $strpos);
		}

		// set Request Method if it isn't passed as a parameter
		if($requestMethod === null) {
			$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
		}

		// Force request_order to be Get or Post
		$_REQUEST = array_merge($_GET, $_POST);

		$all_routes = $this->routes;
		foreach($this->routes as $handler) {
			list($method, $route, $target, $query, $name) = $handler;

			if(ends_with($route, '/[p:page]/?') || ends_with($route, '/[p:page]?')) {
			    $route_temp = str_replace(array('/[p:page]/?', '/[p:page]?'), '', $route);
			    $redirect = 1;
				$all_routes[] = array($method, $route_temp, $target, $query, $name.'-page-redirect', $redirect);

				if(ends_with($route, '/[p:page]/?')) {
					$route_temp = rtrim($route, '/?').'?';
					$redirect = 1;
					$all_routes[] = array($method, $route_temp, $target, $query, $name.'-page-redirect', $redirect);
				}
			}

			if(ends_with($route, '/')) {
				$route = rtrim($route, '/');
				$redirect = 1;
			} else {
				$route = $handler[1].'/';
				$redirect = -1;
			}
			$all_routes[] = array($method, $route, $target, $query, $name.'-redirect', $redirect);
		}

		foreach($all_routes as $handler) {
			list($method, $_route, $target, $query, $name, $redirect) = $handler;

			$methods = explode('|', $method);
			$method_match = false;

			// Check if request method matches. If not, abandon early. (CHEAP)
			if(strcasecmp($requestMethod, "HEAD") === 0) $method_match = true;
			foreach($methods as $method) {
				if (strcasecmp($requestMethod, $method) === 0) {
					$method_match = true;
					break;
				}
			}

			// Method did not match, continue to next route.
			if(!$method_match) continue;

			// Check for a wildcard (matches all)
			if ($_route === '*') {
				$match = true;
			} elseif (isset($_route[0]) && $_route[0] === '@') {
				$pattern = '`' . substr($_route, 1) . '`u';
				$match = preg_match($pattern, $requestUrl, $params);
			} else {
				$route = null;
				$regex = false;
				$j = 0;
				$n = isset($_route[0]) ? $_route[0] : null;
				$i = 0;

				// Find the longest non-regex substring and match it against the URI
				while (true) {
					if (!isset($_route[$i])) {
						break;
					} elseif (false === $regex) {
						$c = $n;
						$regex = $c === '[' || $c === '(' || $c === '.';
						if (false === $regex && false !== isset($_route[$i+1])) {
							$n = $_route[$i + 1];
							$regex = $n === '?' || $n === '+' || $n === '*' || $n === '{';
						}
						if (false === $regex && $c !== '/' && (!isset($requestUrl[$j]) || $c !== $requestUrl[$j])) {
							continue 2;
						}
						$j++;
					}
					$route .= $_route[$i++];
				}

				$regex = $this->compileRoute($route);
				$match = preg_match($regex, $requestUrl, $params);

				if($params) {
					foreach($params as $key => $value) {
						if(is_numeric($key)) unset($params[$key]);
					}

					foreach($params as $key => $value) {
						$match_pages = preg_match('/'.$_config['paging']['page_link'].'([0-9]+)\/?/', $value);
						if($match_pages && !$params['page']){
							unset($params[$key]);
							$params['page'] = $value;
							break;
						}
					}
				}
			}

			if(($match == true || $match > 0)) {

				if($redirect > 0) {
					$redirect_to = rtrim($_base, '/').$requestUrl.'/';
					go_away($redirect_to, '301');
				}

				if($redirect < 0) {
					$redirect_to = rtrim($_base, '/').substr($requestUrl, 0, -1);
					go_away($redirect_to, '301');
				}

				if($params) {
					foreach($params as $key => $value) {
						if($key == 'page') {
							$page_nb = abs(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
							if($page_nb == 0) {
								unset($params[$key]);
							} else {
								$params[$key] = $page_nb;
							}
						}
						if(is_numeric($key)) unset($params[$key]);
					}
				}

				if($params['page'] === '' || $params['page'] == 1) {
					unset($params['page']);
					$redirect_to = route_generate($name, $params);
					go_away($redirect_to, '301');
				}

				preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|\/\?|)`', $_route, $lnk_items, PREG_SET_ORDER);

				foreach($params as $i => $param) {
                    $target = str_replace('$'.($i+1), $param, $target);
                }

				$params = array_merge($query ?: array(), $params);

				// replace /
				foreach($params as &$param){
					$param = rtrim($param, '/');
					unset($param);
				}

				return array(
					'target' => $target,
					'params' => $params,
					'name' => $name
				);
			}
		}

		return false;
	}

	/**
	 * Compile the regex for a given route (EXPENSIVE)
	 */
	private function compileRoute($route) {
		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|\/\?|)`', $route, $matches, PREG_SET_ORDER)) {

			$matchTypes = $this->matchTypes;

			foreach($matches as $match) {
				list($block, $pre, $type, $param, $optional) = $match;

				if(isset($matchTypes[$type])){
					$type = $matchTypes[$type];
				}
				if($pre == '.'){
					$pre = '\.';
				}

				//Older versions of PCRE require the 'P' in (?P<named>)
				$pattern = '(?:'
						. ($pre !== '' ? $pre : null)
						. '('
						. ($param !== '' ? "?P<$param>" : null)
						. $type
						. ($optional === '/?' ? '/' : null)
						. ')'
						. ($optional !== '' ? '?' : null)
						. ')';

				$route = str_replace($block, $pattern, $route);
			}

		}

		return "`^$route$`u";
	}
}
