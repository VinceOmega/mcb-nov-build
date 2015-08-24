<?php defined('SYSPATH') or die('No direct script access.');

class User_shipping_info_Model extends ORM{

 
    /**
	 * Gets an array of all products
	 *
	 * @return array
	 */
	public function getShippingInfo() {
		$db = new Database;
		return $db->query('SELECT * FROM user_shipping_infos ORDER BY id ASC');  
	}
  
	/**
	 * Gets a single product
	 *
	 * @return array
	 */
	public function getShippingInfoByUser($id) {
		$db = new Database;
		$si = $db->query('SELECT * FROM user_shipping_infos WHERE user_id = '.$id.' ORDER BY id DESC');
		return $si;
	}
	
	public function getNextID() {
		$db = new Database;
		$si = $db->query('SELECT id FROM user_shipping_infos ORDER BY id DESC');
		$next = $si[0]->id + 1;
		return $next;
	}


}

