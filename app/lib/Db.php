<?php
namespace lib;

use PDO;

class Db {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	protected $db;


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($dbname = false) {
		$config = require dirname(__DIR__, 2).'/config/db.php';
		if ($dbname) $config['dbname'] = $dbname;
		if (isset($config['enabled']) && $config['enabled'] == true) {
			$config['dbname'] = $config['dbname'] == '' ? '' : 'dbname=' . $config['dbname'];
			try {
				$this->db = new PDO(
					$config['driver'] . ':host=' . $config['host'] . ';' . $config['dbname'],
					$config['username'],
					$config['password'],
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
				);
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
		}
	}


	//----------------------------------------------------------------------//
	//                         Отправка запроса                             //
	//----------------------------------------------------------------------//
	public function query($query, $params = []) {
		try {
			$prepare = $this->db->prepare($query);
			if (!empty($params))
				foreach ($params as $key => $value)
					$prepare->bindValue(':' . $key, $value);
			$prepare->execute();
		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		return $prepare;
	}


	//----------------------------------------------------------------------//
	//                           Возращает массив                           //
	//----------------------------------------------------------------------//
	public function row($query, $params = []) {
		return $this->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
	}


	//----------------------------------------------------------------------//
	//                           Возращает ячейку                           //
	//----------------------------------------------------------------------//
	public function column($query, $params = []) {
		return $this->query($query, $params)->fetchColumn();
	}
}
