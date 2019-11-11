<?php
namespace app\controllers;

use app\core\Controller;

class AdminController extends Controller {
	//----------------------------------------------------------------------//
	//                          Главная страница                            //
	//----------------------------------------------------------------------//
	function indexAction () {
		//   Work with view params   //
		//$this->view->path = 'account/login';
		//$this->view::$layout = 'custom';
		//$this->view->redirect('http://ya.ru');

		//   Work with model   //
		//$news = $this->model->getNews();
		//$this->view->render('Главная страница', ['news'=>$news]);

		$this->view->render('Главная страница');
	}
}
