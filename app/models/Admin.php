<?php
namespace models;

use core\Model;

class Admin extends Model {
	//----------------------------------------------------------------------//
	//                             Миграции                                 //
	//----------------------------------------------------------------------//
	function migrate($name = false) {
		// Data Base //
		$query = require dirname(__DIR__) . '/lib/Migrations/0000_base.sql';
		$params = [];
		$return = $this->db->row($query, $params);
		//debug($return);
		return $return;

		// Формируем команду выполнения mysql-запроса из внешнего файла
	    //$command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', DB_USER, DB_PASSWORD, DB_HOST, DB_NAME, $file);
	    // Выполняем shell-скрипт
	    //shell_exec($command);
	}
}
