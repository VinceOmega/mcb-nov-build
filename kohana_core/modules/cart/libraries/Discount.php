<?php defined('SYSPATH') OR die('No direct access allowed.');

class Discount{
	private $amount = array('total' => 0, 'shippingDiscount' => 0);
	private $appliedDiscounts = array();
	
	public function __construct($user, $cart){
	
		$db = new Database;
		$rows = $db->query('
			SELECT d.*, dt.name as discount_name 
			FROM discounts as d 
			LEFT JOIN discounts_types dt ON (d.type_id=dt.id) 
			WHERE (effective_from <= now() OR effective_from="0000:00:00") AND (effective_to >= now() OR effective_to = "0000:00:00")');

		foreach ($rows as $row){
			$driver = 'Discount_'.$row->discount_name.'_Driver';		
			if ( ! Kohana::auto_load($driver))
				throw new Kohana_Exception('core.driver_not_found', $row->discount_name, get_class($this));

			$driver = new $driver($user, $cart);

			$driver->setValues($row);
			if (is_array($amount = $driver->amount())){
				$this->amount['total'] += $amount['total'];
				if (isset($amount['shippingDiscount'])){
					$this->amount['shippingDiscount'] += $amount['shippingDiscount'];
				}
			}else{
				$this->amount['total'] += $amount;
			}
			$this->appliedDiscounts = array_merge( $this->appliedDiscounts, $driver->getApplied());
		}
	}
	
	public function getApplied(){
		return $this->appliedDiscounts;
	}
	
	public function amount(){	
		return $this->amount;
	}
	
	public function getDiscount($type, $id){
		$db = new Database;
		$query = $db->query('
			SELECT d.*
			FROM discounts as d 
			LEFT JOIN discounts_types dt ON (d.type_id=dt.id) 
			LEFT JOIN discounts_objects do ON (do.discount_id=d.id) 
			WHERE (effective_from <= now() OR effective_from="0000:00:00") AND (effective_to >= now() OR effective_to = "0000:00:00")
			AND dt.name="'.$type.'" AND do.object_id='.$id);
		if ($query->count()>0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	
}
