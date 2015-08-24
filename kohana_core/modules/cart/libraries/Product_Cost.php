<?php defined('SYSPATH') OR die('No direct access allowed.');

class Product_Cost{

	private static $product;
	
	function __construct(){
	}
	
	static public function getCostsByProduct($id){
		$product_types = ORM::factory('product_cost')->where('productID', $id)->orderby('qty_start', 'ASC')->find_all();
		return $product_types;
	}
}