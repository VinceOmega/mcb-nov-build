<?php defined('SYSPATH') OR die('No direct access allowed.');

class Discount_Driver {
	
	protected $user;
	protected $cart;
	protected $discount = false;
	protected $sum = array('total' => 0, 'shippingDiscount' => 0);
	protected $appliedDiscounts = array();
	
	public function setValues($discount){
		$this->discount = $discount;
	}
	
	public function __construct($user, $cart){
		$this->user = $user;
		$this->cart = $cart;
	}
	
	public function amount(){
		$this->discount;
	}
	
	public function getApplied(){
		return $this->appliedDiscounts;
	}
	
	public function getObjects(){
		if (!$this->discount) return false;
		$db = new Database();
		$rows = $db->query('SELECT object_id FROM discounts_objects WHERE discount_id='.(int)$this->discount->id);
		$out = array();
		foreach ($rows as $row){
			$out[] = $row->object_id;
		}
		return $out;
	}
	
	public function calc($price){
		if (!empty($this->discount->percent)) $this->sum['total'] += $price*0.01*$this->discount->percent;
		if (!empty($this->discount->amount)) $this->sum['total'] += $this->discount->amount;
		if (!empty($this->discount->shipping_percent)) $this->sum['shippingDiscount'] += $this->discount->shipping_percent;
	}
	
	public function evalCondition($amount = false){
		if (empty($this->discount->condition)) return true;
		$total = $this->cart->subtotal();
		$condition = str_replace('%total%', $total, $this->discount->condition);
		$code = (Session::instance()->get('discount_code')) ? Session::instance()->get('discount_code') : '_no_code';
		$condition = str_replace('%code%', '"'.$code.'"', $condition);
		if ($amount) $condition = str_replace('%amount%', '"'.$amount.'"', $condition);
		$res =false;
		//die('$res = ('.$condition.');');
		@eval('$res = ('.$condition.');');
		return $res;
	}
}