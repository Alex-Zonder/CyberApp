<?php
namespace models;

use core\Model;

class Account extends Model {
	//----------------------------------------------------------------------//
	//                    Достаем данные пользователя                       //
	//----------------------------------------------------------------------//
	function getUserData($name = false) {
		// Data Base //
		$query = 'SELECT * from users where name = :user';
		$params = ['user' => $name];
		$return = $this->db->row($query, $params);
		//debug($return);
		return $return;
	}
}
