<?php
namespace lib;

use lib\Db;
use lib\Users;
use lib\FileManager;

class Authorize {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	public $settings = ['source' => 'file'];
	public $users;
	public $user = false;


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($settings = false) {
		// Load settings //
		if ($settings)
			$this->settings = $settings;
		// Enable SQL //
		if ($this->settings['source'] != 'file')
			$this->db = new Db;
		// File //
		else
			$this->fileMan = new FileManager;
		$this->users = new Users($settings);

		// If POST authorize //
		if (!empty($_POST) && isset($_POST['name']) && isset($_POST['password'])) {
			$this->login($_POST['name'], $_POST['password']);
		}
		// If GET authorize //
		else if (isset($_GET['name']) && isset($_GET['password'])) {
			$this->login($_GET['name'], $_GET['password']);
		}
		// If SESSION or COOKIE authorize //
		else {
			$this->checkSession();
		}
	}


	//----------------------------------------------------------------------//
	//                                Вход                                  //
	//----------------------------------------------------------------------//
	function login($name, $password) {
		$this->user = $this->users->getUserByNameOrEmail($name);
		// If user is //
		if ($this->user) {
			// If passwords is equal //
			if ($this->user['password'] == $password) {
				$this->createSession();
				return true;
			}
		}
		return false;
	}


	//----------------------------------------------------------------------//
	//                               Выход                                  //
	//----------------------------------------------------------------------//
	public static function logout() {
		// Destroy Session //
		$_SESSION = array();
		session_destroy();
		// Destroy Cookie //
		self::unsetCookie('name');
		self::unsetCookie('SESSID');
	}



	//----------------------------------------------------------------------//
	//                         Создаём сессию                               //
	//----------------------------------------------------------------------//
	public function createSession() {
		// Create session //
		$_SESSION['name'] = $this->user['name'];
		// Add cookie //
		if (count($_COOKIE) > 0 || (isset($_POST['stay']) && $_POST['stay'] == 'on')) {
			// Data Base //
			if ($this->settings['source'] != 'file') {
				// Create COOCIE //
				$this->setCookie ('SESSID', session_id());
				// Write to SQL //
				$date = date("Y-m-d H:i:s");
				$useragent = $_SERVER['HTTP_USER_AGENT'];
				$query = 'SELECT * from users_sessions where session_id = \'' . session_id() . '\'';
				$result = $this->db->row($query);
				if (empty($result)) {
					$query = 'INSERT INTO users_sessions (user_id, session_id, date, useragent)
						VALUES (\'' . $this->user['id'] . '\', \'' . session_id() . '\', \'' . $date . '\', \'' . $useragent . '\')';
					$this->db->query($query);
				}
				else if ($result[0]['user_id'] != $this->user['id']) {
					$query = 'UPDATE users_sessions SET user_id = ' . $this->user['id'] . ' WHERE session_id = \'' . session_id() . '\'';
					$this->db->query($query);
				}
			}
			// File //
			else {
				// Create COOCIE //
				$this->setCookie ('name', $this->user['name']);
			}
		}
	}


	//----------------------------------------------------------------------//
	//                         Проверка сессии                              //
	//----------------------------------------------------------------------//
	function checkSession () {
		// By Session //
		if (isset($_SESSION['name'])) {
			$this->user = $this->users->getUserByNameOrEmail($_SESSION['name']);
			if ($this->user)
				return true;
		}
		// By Coocie //
		if (count($_COOKIE) > 0) {
			// Data Base //
			if ($this->settings['source'] != 'file') {
				if (isset($_COOKIE['SESSID'])) {
					$this->user = $this->users->getUserBySessId($_COOKIE['SESSID']);
					if ($this->user) {
						$this->createSession();
						return true;
					}
				}
			}
			// File //
			else {
				if (isset($_COOKIE['name'])) {
					$this->user = $this->users->getUserByNameOrEmail($_COOKIE['name']);
					if ($this->user) {
						$_SESSION['name'] = $this->user['name'];
						return true;
					}
				}
			}
		}
		return false;
	}


	//----------------------------------------------------------------------//
	//                              Cookie                                  //
	//----------------------------------------------------------------------//
	public function setCookie ($key, $val) {
		$y2k = time() + (86400 * 60);
		setcookie($key, $val, $y2k, "/");
	}
	public function updateCookie ($key, $val) {
		if (isset($_COOKIE[$key])) {
			$y2k = time() + (86400 * 60);
			setcookie($key, $val, $y2k, "/");
			return true;
		}
		return false;
	}
	public static function unsetCookie ($key) {
		unset($_COOKIE[$key]);
		setcookie($key, null, -1, '/');
	}
}
