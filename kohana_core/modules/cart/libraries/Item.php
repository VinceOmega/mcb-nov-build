<?php

class Item  {
	private $data;
	private $item;
	
	public function __construct($a = array()) {	
		
		$this->data->key = NULL;
		$this->data->id = NULL;
		$this->data->options = array();
		$this->data->qty = 1;
			
		if(!empty($a)){
			$this->data = (object) ($a + (array)$this->data);
		}
	}
	
	//this key calculation can be cutomized for each project (as long as it returns a string)
	public function computeKey(){
		
		if($this->data->id){
			if (!$this->data->options) {
				$this->data->key = $this->data->id;
			} else {
				$this->data->key = $this->data->id . ':' . implode('|', $this->data->options);
			}
		}
		
		//check to make sure the item exits, and that there are enough inventory
	}
	
	//this key de-calculation can be cutomized for each project (as long as it returns a string)
	public function decomputeKey(){
		
		if($this->data->key){
			$array = array();
			$array = explode(':', $this->data->key);
			$this->data->id = $array[0];
			
			if (isset($array[1])) {
				$this->data->options = explode('|', $array[1]);
			} else {
				$this->data->options = array();
			}
		}
		
		//check to make sure the item exits, and that there are enough inventory
	}

	
	//initiates an item object given an id
	public static function withID($id, $options = array()) {
		$instance = new self();
	
		$instance->data->id = $id;
		$instance->data->options = $options;
		$instance->computeKey(); //calculates key, for times when same product with different options are added to cart
			
        return $instance;
	}
	
	//initiates an item object given a key
	public static function withKey($key) {
		$instance = new self();
        
		$instance->data->key = $key;
		$instance->decomputeKey(); //gets id and options
		
        return $instance;
	}
	
	//use to automatically compute the item key
	public function __clone() {
		if(!empty($this->data->id)){
			$r = $this->withID($this->data->id, $this->data->options);
			$this->data->id = $r->id;
			$this->data->key = $r->key;
			$this->data->qty = $this->data->qty; //this will be either what the user has specified or if not specified, will default to 1 
			$this->data->options = $r->options;
		}
	}
	
	public function __get($b){
		return $this->data->$b;
	}
	
	public function __set($a, $b){
		$this->data->$a = $b;
	}
	
	//http://www.edmondscommerce.co.uk/php/php-__get-and-empty-not-working-as-you-expect-solution/
	public function __isset($key){
		return !($this->__get($key) === null);
	}
	
	
	public function __toString(){
		return $this->data->key;
	}
	
	//here you can calculate the "price" however that it needs to be
	//example: return $this->item->price * $num_of_indivual_components + $cost_of_incurred_options;
	public function getPrice() {
		if($this->loadDetail())
			return $this->item->price;
  	}	

	public function loadDetail() {

		if(!empty($this->item)){
			return $this->item; //return the cache
		}else{
			if(isset($this->data->id)){		
				$product = Product::getProductByID($this->data->id);
				
				if (!empty($product)) {	
					$this->item->id = $product->id;	
					$this->item->name = $product->name;	
					$this->item->price = $product->price;
					$this->item->size = $product->size;
					$this->item->shipping_info = $product->shipping_info; 
					$this->item->tax_ids = $product->tax_ids;
					$this->item->is_shippable = $product->is_shippable;
					$this->item->options = $this->data->options;
					
					$this->data->item = $this->item;
					return $this->item;
				}						
			}
			
			return FALSE;
		}
  	}
}

?>