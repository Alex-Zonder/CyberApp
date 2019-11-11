<?php
namespace app\models;

use app\core\Model;

class Main extends Model {
	//----------------------------------------------------------------------//
	//                             Все новости                              //
	//----------------------------------------------------------------------//
	function getNews() {
		$query = 'SELECT * from news where';
		return $this->db->row($query);
	}
}
