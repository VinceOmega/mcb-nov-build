<?php defined('SYSPATH') OR die('No direct access allowed.');

class Product_Type{

	private static $product;
	
	function __construct(){
	}
	
	static public function getAll(){
		$product_types = ORM::factory('products_type')->select_list('id', 'name');
		return $product_types;
	}
}