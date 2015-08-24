<?php defined('SYSPATH') or die('No direct script access.');

class User_billing_info_Model extends ORM{

 
    /**
	 * Gets an array of all products
	 *
	 * @return array
	 */
	public function getBillingInfo() {
		$db = new Database;
		return $db->query('SELECT * FROM user_billing_infos ORDER BY id ASC');  
	}
  
	/**
	 * Gets a single product
	 *
	 * @return array
	 */
	public function getBillingInfoByUser($id) {
		$db = new Database;
		$bi = $db->query('SELECT * FROM user_billing_infos WHERE user_id = '.$id.' ORDER BY id DESC');
		return $bi;
	}
	
	public function getNextID() {
		$db = new Database;
		$bi = $db->query('SELECT id FROM user_billing_infos ORDER BY id DESC');
		$next = $bi[0]->id + 1;
		return $next;
	}


}

