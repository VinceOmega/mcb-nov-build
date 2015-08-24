<?php defined('SYSPATH') OR die('No direct access allowed.');


class Order_status_Model extends ORM {


	public function getStatusByID($id) {
		$db = new Database;
		$status = $db->query('SELECT id, status_name FROM orders_statuses WHERE id = '.$id.'');
		return $status[0];
	}
  
  
  /**
	 * Gets a single status
	 *
	 * @return array
	 */
	

	public function getNextID() {
		$db = new Database;
		$status = $db->query('SELECT id FROM orders_statuses ORDER BY id DESC');
		$next = $status[0]->id + 1;
		return $next;
	}
  
}