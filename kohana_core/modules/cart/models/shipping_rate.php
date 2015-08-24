<?php defined('SYSPATH') OR die('No direct access allowed.');

class Shipping_rate_Model extends ORM {
	public function getRatesByMethod($id) {
		return $this->where('shipping_method_id',$id)->orderby('prc_start','ASC')->find_all();
	}
}

