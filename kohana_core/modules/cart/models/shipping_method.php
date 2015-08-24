<?php defined('SYSPATH') OR die('No direct access allowed.');

class Shipping_method_Model extends ORM {
	
	private $_rates = NULL;
	
	public function getRates() {
		if (NULL == $this->_rates)
			$this->_rates = ORM::factory('shipping_rate')->getRatesByMethod($this->id);
		return $this->_rates;
	}
	
	public function getRateForPrice($price) {
		$maxRateRange = NULL;
		foreach ($this->getRates() as $rate) {
			if ($rate->prc_start <= $price && $price <= $rate->prc_end)
				return $rate;
			
			if ($rate->prc_end == 0)
				$maxRateRange = $rate;
		}
		return $maxRateRange;
	}
}