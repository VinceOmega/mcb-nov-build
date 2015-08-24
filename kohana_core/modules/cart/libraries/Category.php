<?php defined('SYSPATH') OR die('No direct access allowed.');

class Category{


	function __construct(){
	}
	/*
	static public function getCategoryByID($id){
		if(isset($id)){
			$category = new Category_Model($id);
			
			//http://stackoverflow.com/questions/866589/array-merge-replace (array union operator)
			$category->tax_ids = (object)($product->tax_ids + $product->products_type->tax_ids);	
	
			return $category;
		}
	}
	*/

	static public function getAll(){
		$categories = ORM::factory('category')->select_list('id', 'name');
		return $categories;
	}
	
	static public function getCategoryByID($id){
		if(isset($id)){
			$category = new Category_Model($id);	
			return $category;
		}
	}
	
	static public function getProductsByCategory($id){		
		if(isset($id)){
			$category = new Category_Model($id);	
			return $category->products;
		}
	}


}

