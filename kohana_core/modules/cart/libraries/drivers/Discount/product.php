<?php defined('SYSPATH') OR die('No direct access allowed.');

class Discount_product_Driver extends Discount_Driver{
	public function amount(){
		$discountedProducts = $this->getObjects();

		foreach($this->cart->items() as $item){
			if (in_array( $item->id, $discountedProducts)&& $this->evalCondition( $this->cart->productQty($item->id) )){
				$this->appliedDiscounts[] = $this->discount->name;
				$this->calc($item->price);
			}
		}

		return $this->sum;
	}
}	