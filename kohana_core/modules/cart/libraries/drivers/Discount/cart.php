<?php defined('SYSPATH') OR die('No direct access allowed.');

class Discount_cart_Driver extends Discount_Driver{
	public function amount(){
		if ($this->evalCondition( $this->cart->qty() )){
			$this->appliedDiscounts[] = $this->discount->name;
			$this->calc( $this->cart->subtotal() );
		}
		return $this->sum;
	}
}	