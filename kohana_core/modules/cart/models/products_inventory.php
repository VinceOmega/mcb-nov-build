<?php defined('SYSPATH') OR die('No direct access allowed.');

class Products_inventory_Model extends ORM {
	protected $belongs_to = array('products');

	static public function forProduct($id){
		return $this->where('product_id', $id)->find();
	}

}