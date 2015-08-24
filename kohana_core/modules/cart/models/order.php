<?php defined('SYSPATH') OR die('No direct access allowed.');

class Orders_status_Model extends ORM {
protected $sorting = array('date' => 'asc');
}

class Order_id_Model extends ORM {
protected $sorting = array('id' => 'desc');
}


class Orders_address_Model extends ORM {}


class Order_info extends ORM {

}


class Order_Model extends ORM {
	protected $has_many = array('order_status', 'orders_baskets');
	protected $has_one = array('orders_address', 'order_id');
	protected $belongs_to = array('site','user');
	
	const STATUS_PENDING	= 1;
	const STATUS_PROCESSED	= 2;
	const STATUS_DENIED		= 3;
	const STATUS_SHIPPED	= 4;
	const STATUS_DELIVERED	= 5;
	const STATUS_CANCELED	= 6;
	const STATUS_REFUND		= 7;
	const STATUS_ACTIVE		= 8;
	
	public function getCurrentOrder()
	{
		$order = $this->where('sessionID',Session::instance()->id())->find();

		if ($order->id == 0) {
			$time = time();
			
			$order->sessionID = Session::instance()->id();
			$order->trans_id = My_Template_Controller::getCurrentSite()->shortname.$time;
			$order->customer_ip = $_SERVER['REMOTE_ADDR'];
			$order->date_created = $time;
			$order->date_modified = $time;
			$order->statusID = self::STATUS_PENDING;
			$order->site_id = My_Template_Controller::getCurrentSite()->id;
			$order->save();
			
			$this->db->query('INSERT INTO order_ids (order_id) VALUES ('.$order->id.')');
		}
		
		return $order;
	}
	
	public function getSubTotal()
	{
		$total = 0;
		foreach ($this->orders_baskets as $orders_basket)
			$total += $orders_basket->subtotal + $orders_basket->second_side_fee;
		return $total;
	}
	
	public function refreshTotals()
	{
		$subtotal = $this->getSubTotal();
		$this->subtotal = $subtotal;
		$this->order_total = $subtotal + $this->shipping_total;
		
		$this->save();
	}
	
	public function getOrderId($justInteger = FALSE)
	{
		$result = $this->db->query('SELECT id FROM order_ids WHERE order_id = '.$this->id);
		if (count($result) == 0)
			return FALSE;
		
		$order_id = $result[0]->id;
		if (FALSE !== $justInteger)
			return $order_id;
		
        return My_Template_Controller::getCurrentSite()->shortname.'1'.sprintf("%04d\n", $order_id); 
	}
}

class Orders_status_name_Model extends ORM {
	protected $sorting = array('order_status_id' => 'asc');
}