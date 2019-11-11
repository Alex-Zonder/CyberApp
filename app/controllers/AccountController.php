<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Authorize;

class AccountController extends Controller {
	//----------------------------------------------------------------------//
	//                             Регистрация                              //
	//----------------------------------------------------------------------//
	function registerAction () {
		$this->view->render('Регистрация');
	}


	//----------------------------------------------------------------------//
	//                                Вход                                  //
	//----------------------------------------------------------------------//
	function loginAction () {
		// If POST authorize //
		if (!empty($_POST) && isset($_POST['name']) && isset($_POST['password'])) {
			// Authorized //
			if (isset($this->user['name'])) {
				$url = isset($_POST['url']) && $_POST['url'] != '/account/login' ? $_POST['url'] : '/';
				//header('Location: ' . $url);
				$this->view->redirect($url);
			}
			// Error Authorize //
			else {
				// View Login //
				$this->view->render('Вход', ['error' => 'Отсутствует связка пользователь/пароль']);
				exit();
			}
		}
		// View Login //
		$this->view->render('Вход');
	}


	//----------------------------------------------------------------------//
	//                               Выход                                  //
	//----------------------------------------------------------------------//
	function loguotAction () {
		Authorize::logout();
		//header('Location: ' . '/');
		$this->view->redirect('/');
	}


	//----------------------------------------------------------------------//
	//                        Настройки пользователя                        //
	//----------------------------------------------------------------------//
	function settingsAction () {
		//   Work with model   //
		//$user = $this->model->getUserData($this->user['name']);
		//$this->view->render('Настройки', ['user' => $user[0]]);
		// View Settings //
		$this->view->render('Настройки');
	}
}
