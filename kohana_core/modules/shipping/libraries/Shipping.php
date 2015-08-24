<?php defined('SYSPATH') OR die('No direct access allowed.');

class Shipping{
		
	public $basket;
	private $driver;
	private $method;
	private $destination;
	static public $shipping;
	
	public function __construct($company, $zip, $country_code, $basket){
		if(empty($company))
			throw new Kohana_Exception('core.shipping_company_not_provided', $d, get_class($this));

		$driver = 'Shipping_'.ucfirst($company).'_Driver';

		if ( ! Kohana::auto_load($driver))
			throw new Kohana_Exception('core.driver_not_found', $company, get_class($this));

		$this->driver = new $driver();
		$this->shipping = $this->get();
		
		$this->basket = $basket;	
		$this->destination->zip = $zip;
		$this->destination->country = $country_code;
			
	}	
	
	//Get the list of all the shipping methods along with rate, returns structure as follows:
	//array({method_name_1] => Array ([name] => readable method name, [amount] => ##),
	//		{method_name_2] => Array ([name] => readable method name, [amount] => ##))
	public function methods(){
					
		$s = $this->gatherShippingInfo();
		$this->driver->setData($s);
			
		if($this->hasShipping()){
			if(!isset($this->shipping['rate'][$s->hash])){
				$result = $this->driver->getRates();
				
				if($result){
					foreach ($result as $method=>$data){
						$this->shipping['rate'][$s->hash][$method] = $data; //cache the result
					}
				}else{
					$this->shipping['rate'][$s->hash] = array(); //no results found
				}
			}
		}else{ //no shippable products (or only downloadable products) are in the cart
			$this->shipping['rate'][$s->hash]['free_shipping'] = array('name' => 'No Shipping Cost', 'amount' => 0); 
		}
	
		$this->save();
		return $this->shipping['rate'][$s->hash]; 
	}
	
	
	//Gets the specific rate for the provided shipping method (returns a number, example: 6.77)
	public function amount($method = ''){
		$this->setMethod($method);
			
		$s = $this->gatherShippingInfo();
		$this->driver->setData($s); 
			
		if($this->hasShipping()){
			if(!isset($this->shipping['rate'][$s->hash][$this->method]['amount'])){ //if not already cached, then cache it
			// don't have rest until you get a rate 
				$amount = -1;
				while($amount <0){
					$amount = $this->driver->getRate($this->method);
				}
				
				if($amount){
					$this->shipping['rate'][$s->hash][$this->method]['amount'] =  $amount;
				}else{
					$this->shipping['rate'][$s->hash][$this->method]['amount'] = 0; //no results found
				}	
			}
			
			$this->save();
			return $this->shipping['rate'][$s->hash][$this->method]['amount'];
			
		}else{
			return 0; //No Shipping Cost
		}
	}
	
	public function setMethod($method){
		if(! isset($this->method)){
			if(! empty($method)){ //set the method for the first time
				$this->method = $method;
			}else{ //no method has been set
				throw new Kohana_Exception('core.Shipping_method_not_provided', '', get_class($this));
			}
		}else{ //method is already set but we want to overwrite it
			if(!empty($method)){
				$this->method = $method;
			}		
		}
	}
	
	
	private function hasShipping() {			
		return count($this->basket->weight() > 0);
	}
	
	private function gatherShippingInfo(){		
		$shipping_data->weight = $this->basket->weight();
		$shipping_data->to_zip = $this->destination->zip;
		$shipping_data->to_country = $this->destination->country;
		$shipping_data->cart_hash = $this->basket->hash();
		
		$shipping_data->hash = md5(serialize($shipping_data));
		
		return $shipping_data;
	}


	private function save(){
		$this->session = $this->shipping;
		Session::instance()->saveContent($this);
	}
	
	private function get(){
		return Session::instance()->getContent($this);
	}
	
}
