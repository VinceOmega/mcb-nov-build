<?php defined('SYSPATH') OR die('No direct access allowed.');

class Product_cost_Model extends ORM {
	
	 /**
	 * Gets an array of all product costs
	 *
	 * @return array
	 */
	public function getCostsByProduct($id) {
		$db = new Database;
		return $db->query('SELECT * FROM product_costs WHERE productID = '.$id.' ORDER BY qty_start ASC');     
	}
  


}

