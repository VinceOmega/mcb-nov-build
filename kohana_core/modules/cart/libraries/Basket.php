<?php defined('SYSPATH') OR die('No direct access allowed.');

class Basket{
	
	static private $bin;
	static private $item_data;
	
	public $subtotal;
	
  	public function __construct($blob = '') {
		
		if(!empty($blob)){ 
			$this->bin = unserialize($blob); //reconstruct a bin from a serialized blob
		}else{ 
			$this->bin = $this->get(); //construct bin based on session
		}
		
		if(!isset($this->item_data))
			$this->item_data = array();
	}
	
	
	public function getBasketContentForOrder($id) {			
		if(isset($id)){
			return ORM::factory('orders_basket')->where('order_id', $id)->find_all();
		}
	}

	public function getSubtotalForOrder($id) {			
		  $db = new Database;
		  $result = $db->query('SELECT SUM(orders_baskets.subtotal) as total FROM orders_baskets WHERE orders_baskets.order_id = '.$id.'');
		  return $result[0]->total;
	}

	public function getItemByItemId($id) {			
		if(isset($id)){
			return ORM::factory('orders_basket')->where('order_id', $id)->find_all();
		}
	}

	public function getShoppingCartContents($id) {			
		if(isset($id)){
			return ORM::factory('orders_basket')->where('order_id', $id)->find_all();
		}
	}



	  
  	public function add($Item){
		$item = clone $Item;

		if(!empty($item->key)){
			if ((int)$item->qty && ((int)$item->qty > 0)) {
				if (!isset($this->bin[$item->key])) {
					$this->bin[$item->key] = (int)$item->qty;
				} else {
					$this->bin[$item->key] += (int)$item->qty;
				}
				
				$this->save();
			}
		}
  	}

  	public function update($Item){
		$item = clone $Item;
		
		if(!empty($item->key)){
			if(isset($this->bin[$item->key])) {
				if ((int)$item->qty && ((int)$item->qty > 0)) {	
					$this->bin[$item->key] = (int)$item->qty;
				} else {
					$this->remove($item);
				}
			}else{
				$this->add($item);
			}
			
			$this->save();
		}
  	}

  	public function remove($Item) {
		$item = clone $Item;
		
		if(!empty($item->key)){
			if (isset($this->bin[$item->key])) {
				unset($this->bin[$item->key]);
				$this->save();
			}
		}
	}

  	public function clear() {
		$this->bin = array();
		$this->save();
  	}
	
	public function subtotal() {
		$total = 0;
		
		foreach ($this->items() as $item) {
			$total += $item->total;
		}
        
		return $total;
  	}	
	
	public function items() {

		if(!empty($this->item_data)){
			return $this->item_data; //return the cached version
		}else{
			foreach ($this->bin as $key => $qty){
				$item = Item::withKey($key);
				
				if($detail = $item->loadDetail()){
					$this->item_data[$key] = $detail;
					$this->item_data[$key]->total = $item->getPrice() * $qty;	
					$this->item_data[$key]->qty = $qty;
					$this->item_data[$key]->key = $key;
					
				} else {
					$this->remove($item);
				}
			}
			return $this->item_data;
		}
  	}
	
	
	public function qty() {
		$total_qty = 0;
		
		foreach ($this->bin as $qty) {
			$total_qty += $qty;
		}
		
    	return $total_qty;
  	}
	
	public function size() {
		return (count($this->bin));
  	}
	  
  	public function isEmpty() {
    	return (count($this->bin) == 0);
  	}
	
	
	public function weight() {
		$weight = 0;

		foreach ($this->items() as $item) {
			if ($item->is_shippable) {
				if(isset($item->shipping_info['weight']))
					$weight += $item->shipping_info['weight'] * $item->qty;
			}
		}	
		
		return $weight;
	}
	
	public function hash(){
		return md5(serialize($this->bin));
	}
	
	public function save(){
		$this->session = $this->bin;
		Session::instance()->saveContent($this);
	}
	
	private function get(){
		return Session::instance()->getContent($this);
	}

	public function productQty($id){
		return $this->bin[$id];
	}
}
