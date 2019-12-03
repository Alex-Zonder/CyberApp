<?php
namespace app\core;

class View {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	public $route;
	public $path;
	public static $template = 'cyber1';


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($route, $user, $config) {
		$this->config = $config;
		$this->user = $user;
		$this->route = $route;
		$this->path = $route['controller'] . '/' . $route['action'];
	}


	//----------------------------------------------------------------------//
	//                          Генерация страницы                          //
	//----------------------------------------------------------------------//
	public function render($title = 'Киберлайт', $vars = []) {
		// Load vars //
		$user = $this->user;
		extract($vars);
		// Render view //
		$path = 'app/views/' . $this->path . '.php';
		if (file_exists($path)) {
			ob_start();
			require $path;
			$content = ob_get_clean();
			require 'public/templates/' . self::$template . '/index.php';
		}
		else {
			View::errorCode('Не найден вид: ' . $path, 404, $this->user, $this->config['title']);
		}
	}


	//----------------------------------------------------------------------//
	//                           Страница ошибок                            //
	//----------------------------------------------------------------------//
	public static function errorCode($message = '', $code = 404, $user = false, $title = '') {
		http_response_code($code);
		$content = '<center><p><b><h3>Ошибка ' . $code . '<br>' . $message . '</h3></b></p></center>';
		require 'public/templates/' . self::$template . '/index.php';
		exit;
	}


	//----------------------------------------------------------------------//
	//                              Редирект                                //
	//----------------------------------------------------------------------//
	public static function redirect($url) {
		header('location: ' . $url);
	}
}
