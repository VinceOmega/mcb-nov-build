<?php defined('SYSPATH') OR die('No direct access allowed.');

class Packaging_Model extends ORM {
	
	protected $has_and_belongs_to_many = array(
		'products_packaging' => 'products',
	);
	
	protected $has_many = array(
		'packagingoptions'
	);
	
	private $_prices = NULL;
	private $_minAmount = NULL;
	
	public function getPrices() {
		if (NULL == $this->_prices)
			$this->_prices = ORM::factory('packaging_cost')->getCostsByPackaging($this->id);
		return $this->_prices;
	}
	
	public function getAmountForCoins($coinsAmount)
	{
		return ceil($coinsAmount/$this->coins_amount);
	}
	
	public function getMinAmount()
	{
		if (NULL === $this->_minAmount)
		{
			foreach ($this->getPrices() as $price) {
				$this->_minAmount = $price->qty_start;
				break;
			}
		}
		return $this->_minAmount;
	}
	
	public function getUnitPriceForAmount($amount) {
		$maxPriceRange = NULL;
		foreach ($this->getPrices() as $price) {
			if ($price->qty_start <= $amount && $amount <= $price->qty_end)
				return $price;
			
			if ($price->qty_end == 0)
				$maxPriceRange = $price;
		}
		if ($amount < $this->getMinAmount())
			return FALSE;
		return $maxPriceRange;
	}
}