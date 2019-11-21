<?php
namespace app\core;

use app\core\View;
use app\lib\Authorize;

class Router {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	protected $config;
	protected $auth;
	protected $url;
	protected $routes = [];
	protected $params = [];


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct() {
		//   Load Config   //
		$this->config = require 'config/app.php';
		//   Authorization   //
		if (isset($this->config['authorize']))
			$this->auth = new Authorize($this->config['authorize']);
		else
			$this->auth = new Authorize();
		//   Load Routes   //
		$this->url = trim($_SERVER['REQUEST_URI'], '/');
		$routes = require 'config/routes.php';
		foreach ($routes as $key => $value) {
			$key = '#^' . $key . '$#';
			$this->routes[$key] = $value;
		}
	}


	//----------------------------------------------------------------------//
	//                             Проверка пути                            //
	//----------------------------------------------------------------------//
	public function match() {
		foreach ($this->routes as $route => $params) {
			if (preg_match($route, $this->url)) {
				$this->params = $params;
				return true;
			}
		}
		return false;
	}


	//----------------------------------------------------------------------//
	//                                Старт                                 //
	//----------------------------------------------------------------------//
	public function run() {
		if ($this->match()) {
			// Check access //
			if (isset($this->params['access']) && $this->params['access'] != 'all') {
				if (!isset($this->auth->user['name'])) {
					$this->params['controller'] = 'account';
					$this->params['action'] = 'login';
				}
			}

			// Load controller //
			$path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
			if (class_exists($path)) {
				$action = $this->params['action'].'Action';
				if (method_exists($path, $action)) {
					$controller = new $path($this->params, $this->auth->user, $this->config);
					$controller->$action();
				}
				else View::errorCode('Не найден экшн: ' . $action, 404, $this->auth->user, $this->config['title']);
			}
			else View::errorCode('Не найден контроллер: ' . $path, 404, $this->auth->user, $this->config['title']);
		}
		else View::errorCode('Маршрут не найден: ' . $this->url, 404, $this->auth->user, $this->config['title']);
	}
}
