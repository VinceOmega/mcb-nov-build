<?php defined('SYSPATH') OR die('No direct access allowed.');

class Packaging_cost_Model extends ORM {
	
	 /**
	 * Gets an array of all product costs
	 *
	 * @return array
	 */
	public function getCostsByPackaging($id) {
		$db = new Database;
		return $db->query('SELECT * FROM packaging_costs WHERE packagingID = '.$id.' ORDER BY qty_start ASC');     
	}
  


}

