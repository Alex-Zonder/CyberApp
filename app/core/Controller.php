<?php
namespace app\core;

use app\core\View;
use app\lib\Authorize;

abstract class Controller {
	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($route, $user, $config) {
		$this->user = $user;
		$this->view = new View($route, $user, $config);
		$this->model = $this->loadModel($route['controller']);
	}

	//----------------------------------------------------------------------//
	//                           Загрузка модели                            //
	//----------------------------------------------------------------------//
	public function loadModel($name) {
		$path = 'app\models\\' . ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}
}
