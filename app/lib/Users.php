<?php
namespace app\lib;

use app\lib\Db;
use app\lib\FileManager;

class Users {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	public $settings = ['source' => 'file'];
	protected $db;


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($settings) {
		// Load settings //
		if ($settings)
			$this->settings = $settings;
		// Enable SQL //
		if ($this->settings['source'] != 'file')
			$this->db = new Db;
		// File //
		else
			$this->fileMan = new FileManager;
	}


	//----------------------------------------------------------------------//
	//                       Достаем пользователей                          //
	//----------------------------------------------------------------------//
	public function getUsers() {
		// Data Base //
		if ($this->settings['source'] != 'file') {
			$query = 'SELECT * from users';
			return $this->db->row($query);
		}
		// File //
		else return require 'config/users.php';
		//else return $this->fileMan->readFile($_SERVER['DOCUMENT_ROOT'] . '/app/config/users.php');
	}


	//----------------------------------------------------------------------//
	//                  Данные пользователя по key/value                    //
	//----------------------------------------------------------------------//
	public function getUser($key, $value) {
		// Data Base //
		if ($this->settings['source'] != 'file') {
			$query = 'SELECT * from users where :key = :value';
			$params = ['key' => $key, 'value' => $value];
			$return = $this->db->row($query, $params);
			if (isset($return[0]))
				return $return[0];
		}
		// File //
		else {
			$users = $this->getUsers();
			foreach ($users as $val)
				if ($val[$key] == $value)
					return $val;
		}
		return false;
	}


	//----------------------------------------------------------------------//
	//               Данные пользователя по имени или почте                 //
	//----------------------------------------------------------------------//
	public function getUserByNameOrEmail($name) {
		// Data Base //
		if ($this->settings['source'] != 'file') {
			$query = 'SELECT * from users where name = :name or email = :email';
			$params = ['name' => $name, 'email' => $name];
			$return = $this->db->row($query, $params);
			return isset($return[0]) ? $return[0] : false;
		}
		// File //
		else {
			$users = $this->getUsers();
			foreach ($users as $val)
				if ($val['name'] == $name || (isset($val['email']) && $val['email'] == $name))
					return $val;
		}
		return false;
	}


	//----------------------------------------------------------------------//
	//                     Данные пользователя по SESSID                    //
	//----------------------------------------------------------------------//
	public function getUserBySessId($id) {
		// Data Base //
		if ($this->settings['source'] != 'file') {
			/*$query = 'SELECT user_id AS id from users_sessions where session_id = :id';
			$params = ['id' => $id];
			$return = $this->db->row($query, $params);
			if (isset($return[0])) {
				$query = 'SELECT * from users where id = :id';
				$params = ['id' => $return[0]['id']];
				$return = $this->db->row($query, $params);
			}*/
			$query = 'SELECT * from users where id = (SELECT user_id from users_sessions where session_id = :id)';
			$params = ['id' => $id];
			$return = $this->db->row($query, $params);
			return isset($return[0]) ? $return[0] : false;
		}
		// File //
		else {
		}
		return false;
	}
}
