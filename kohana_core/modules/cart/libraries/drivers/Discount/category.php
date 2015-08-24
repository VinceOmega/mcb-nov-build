<?php defined('SYSPATH') OR die('No direct access allowed.');

class Discount_category_Driver extends Discount_Driver{
	public function amount(){
		$discountedCategories = $this->getObjects();

		foreach($this->cart->items() as $item){
			$productCategories = $this->getProductCategories($item->id);
			if (count( array_intersect($discountedCategories, $productCategories) ) && $this->evalCondition()){
				$this->appliedDiscounts[] = $this->discount->name;
				$this->calc($item->price);
			}
		}

		return $this->sum;
	}
	
	private function getProductCategories($productId){
		$db = new Database();
		$rows = $db->query('SELECT category_id FROM categories_products WHERE product_id='.(int)$productId);
		$out = array();
		foreach ($rows as $row){
			$out[] = $row->category_id;
		}
		return $out;
	}
}	