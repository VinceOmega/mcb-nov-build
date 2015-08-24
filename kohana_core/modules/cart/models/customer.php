<?php defined('SYSPATH') or die('No direct script access.');

class Customer_Model extends ORM{

 
    /**
	 * Gets an array of all products
	 *
	 * @return array
	 */
	public function getUsers() {
		$db = new Database;
		return $db->query('SELECT * FROM users ORDER BY id ASC');  
	}
  
	/**
	 * Gets a single product
	 *
	 * @return array
	 */
	public function getUserByID($id) {
		$db = new Database;
		$user = $db->query('SELECT * FROM users WHERE id = '.$id.'');
		return $user[0];
	}
	
	public function getNextID() {
		$db = new Database;
		$user = $db->query('SELECT id FROM users ORDER BY id DESC');
		$next = $user[0]->id + 1;
		return $next;
	}


}

