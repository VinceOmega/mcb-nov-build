<?php defined('SYSPATH') OR die('No direct access allowed.');

class Tax{
	
	private $zone;
	public $basket;
	static public $tax;
	static private $cached_rates;
	
	public function __construct($country_code, $state_code = '', $basket) {
		$this->basket = $basket;
		$this->tax = $this->get();
		$this->setShippingZone($country_code, $state_code); 
	}
	
	public function amount($id = '') {		
		$hash = $this->getTaxHash();
		
		if(!isset($this->tax['rate'][$hash]['amount'])){
		
			$taxes = 0;
			foreach ($this->basket->items() as $item){				
				$taxes += $item->total * ($this->appliedTaxes($item->tax_ids) / 100);
			}
			
			$this->tax['rate'][$hash]['amount'] = $taxes; //caching the tax amount per cart content
			$this->save();
		}
		
		return $this->tax['rate'][$hash]['amount'];
	}
	
		
	private function appliedTaxes($tax_ids){
		$rate = 0;
	
		foreach($tax_ids as $id){
			if(!isset($this->cached_rates[$id])){
				$tax = $this->findInDB($id, $this->zone->country, $this->zone->state);
				
				if($tax){
					$this->cached_rates[$id] = $tax->rate; //caching the tax rate per tax-amount look up
				}
			}
			
			$rate += $this->cached_rates[$id];
		}
		
		return $rate;
	}
	
	
	public function findInDB($id, $country, $state){
			$tax = ORM::factory('tax_class_zone')
						->where('tax_class_id', $id)
						->where('country', $country);
						
			if(isset($state)){
				$tax = $tax->where('state', $state);
			}else{
				$tax = $tax->where('state', '');
			}
				
			return $tax->find();
	}
	
	
	private function setShippingZone($country, $state = ''){
		if(empty($country))
			throw new Kohana_Exception('country not provided for tax calculation', '', get_class($this));
			
		$this->zone->country = $country;
		$this->zone->state = $state;
	}
	
	private function getTaxHash(){
		$tax_info->state = $this->zone->state;
		$tax_info->to_country = $this->zone->country;
		$tax_info->cart = serialize($this->basket->hash());
		
		$hash = md5(serialize($tax_info));
		
		return $hash;
	}
	
	
	
	
	private function save(){
		$this->session = $this->tax;
		Session::instance()->saveContent($this);
	}
	
	private function get(){
		return Session::instance()->getContent($this);
	}
	
	public function getAll(){
		$tax_classes = ORM::factory('tax_class')->select_list('id', 'name');
	
		return $tax_classes;
	}
}
