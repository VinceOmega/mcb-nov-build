<?php defined('SYSPATH') OR die('No direct access allowed.');

class Order{

	private $order;
	private $amount;
	public $error;
	private $appliedDiscounts;
	
	function __construct(){		
		$this->order->finance_state = 'NONE'; //Pending, CHARGING, CHARGED
		$this->order->fulfillment_state = 'NONE'; //NEW, PROCESSING, SHIPPED, DELIVERED?, Canceled, Refund
	}
	
	static public function getOrderByID($id){
		if(isset($id)){
			$order = new Order_Model($id);	
			return $order;
		}
	}

	static public function getOrdersByUser($id){
		if(isset($id)){
			$db=new Database;
			return $db->query('SELECT order_ids.id as order_id, orders.id as id, orders.statusID as statusID, orders.order_total, orders.order_date, payment_status.name as status_name FROM orders LEFT JOIN order_ids ON orders.id = order_ids.order_id LEFT JOIN payments ON orders.trans_id = payments.transaction_number LEFT JOIN payment_status ON payments.statusID = payment_status.id WHERE orders.user_id = '.$id.' GROUP BY order_id ');
		}
	}
	
	static public function getOrderStatusByID($id){
		if(isset($id)){
		$db=new Database;
			return $db->query('SELECT id, status_name FROM order_statuses WHERE id = '.$id.'');
		}
	}

	static public function getOrderID($id){
		if(isset($id)){
			$db=new Database;
			$result = $db->query('SELECT id FROM order_ids WHERE order_id = '.$id.'');
			if($result[0])
				return $result[0]->id;
			else 
				return false;
		}
	}
	
	public function load($id = null){
		if($id){
			$this->order = $this->getOrderFromDB($id);
		}else{
			$this->order = (object)$this->get();
		}
	}

	public function __get($b){
		return $this->order->$b;
	}
	
	public function __set($a, $b){
		$this->order->$a = $b;
		$this->save();
	}
	
	public function clear(){
		$this->order = '';
		$this->save();
	}
	
	public function shippingMethods(){
		if(isset($this->order->shipping)){
			$shipping = new Shipping('UPS', 
									$this->order->shipping->zip, 
									$this->order->shipping->country,
									$this->order->basket);
								
			return $shipping->methods();
		}else{
			return array();
		}
	}

	public function tax(){		
		if(isset($this->amount->tax)){
			return $this->amount->tax;
			
		}elseif(isset($this->order->shipping)){
			$tax = new Tax($this->order->shipping->country, 
							$this->order->shipping->state,
							$this->order->basket);	
							
			$this->amount->tax = $tax->amount();
			return $this->amount->tax;
			
		}else{
			
			return 0;
		}
	}
	
	
	public function shipping(){

		if(isset($this->amount->shipping)){
			return $this->amount->shipping;
			
		}elseif(isset($this->order->shipping)){			
			if(isset($this->order->shipping->method)){
				$shipping = new Shipping('UPS', 
										$this->order->shipping->zip, 
										$this->order->shipping->country,
										$this->order->basket);
										
				$shipping->setMethod($this->order->shipping->method);
				if (!is_numeric($amount = $shipping->amount())){
					$this->error = $amount;
					return 0;
				}
				if (isset($this->amount->discount['shippingDiscount'])){
					$amount = $amount - ($amount * 0.01 * $this->amount->discount['shippingDiscount']);
				}
				//add 35% to the shipping cost that UPS returns
				$shipping_cost = $amount+ 0.35 * $amount;
				$this->amount->shipping = $shipping_cost;
				return $shipping_cost;	
				
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}
	
	public function subtotal(){
		if(isset($this->amount->basket_discount)){
			return $this->amount->subtotal; // - $this->amount->subtotal_discount;
			
		}elseif(isset($this->order->basket)){
			if(! $this->order->basket->isEmpty()){
				$this->amount->subtotal = $this->order->basket->subtotal();
				return $this->amount->subtotal;
				
			}
		}else{	
			return 0;
		}
	}
	
	public function setDiscount($percent){
		$this->amount->discount['total'] = $percent * $this->subtotal() * 0.01;
	}
	
	public function discount($type = false){
		if(!isset($this->amount->discount)){
			$objDiscount = new Discount(false, $this->order->basket);
			$this->amount->discount = $objDiscount->amount();
			$this->appliedDiscounts = $objDiscount->getApplied();
		}
		return ($type && isset($this->amount->discount[$type])) ? $this->amount->discount[$type] : $this->amount->discount;		
	}
	
	public function total(){
		$total = round($this->subtotal() + $this->tax() + $this->shipping() - $this->discount('total'),2);
		// for some reason the ROUND function doesn't work on live site
		// couldn't come up with better than this:
		return sprintf ("%6.2f", $total);
	}
	
	
	public function pay($method){
		$payment = new Payment($method);

		if ($method=='Paypal'){

			Session::instance()->delete('paypal_token');
			$order = new Order_Model($this->order->id);			
			//$inv = uniqid('payPal_');
			$inv = $this->getTransID();
			$order->trans_id = $inv;
			$order->save();

			$attributes = array(
				'AMT'               => $this->total(),
				'INVNUM'            => $inv,
				'SHIPTONAME'        => $this->order->shipping->first_name . ' '. $this->order->shipping->last_name,
				'SHIPTOSTREET'      => $this->order->shipping->address1,
				'SHIPTOCITY'        => $this->order->shipping->city,
				'SHIPTOCOUNTRYCODE' => $this->order->shipping->country,
				'SHIPTOSTATE'       => $this->order->shipping->state,
				'SHIPTOZIP'         => $this->order->shipping->zip,
			);
			//$this->payment->GETDETAILS = FALSE;
		}else{
		
			if(!valid::credit_card($this->order->payment->card->card_num)) {
				throw new Exception('Invalid credit card data');
			}		
			
			$attributes = array('card_num'             => $this->order->payment->card->card_num,
								'exp_date'             => $this->order->payment->card->exp_date,
								'amount'               => $this->total(),
								'ship_to_first_name'   => $this->order->shipping->first_name,
								'ship_to_last_name'    => $this->order->shipping->last_name,
								'ship_to_address'      => $this->order->shipping->address1,
								'ship_to_city'         => $this->order->shipping->city,
								'ship_to_state'        => $this->order->shipping->state,
								'ship_to_zip'          => $this->order->shipping->zip,
								'ship_to_country'      => $this->order->shipping->country,
								'first_name'           => $this->order->billing->first_name,
								'last_name'            => $this->order->billing->last_name,
								'address'              => $this->order->billing->address1,
								'city'                 => $this->order->billing->city,
								'state'                => $this->order->billing->state,
								'zip'                  => $this->order->billing->zip,
								'country'              => $this->order->billing->country,
								//'x_invoice_num'        => $this->order->id
								
			);
		}
		$payment->set_fields($attributes);
		$this->order->finance_state = 'CHARGING';
		if($payment->process()){
			$this->order->finance_state = 'CHARGED';
			$this->order->status = 2;
			//$this->order->save();
			return true;
		}else{
			$this->order->finance_state = 'DENIED';
			$this->order->status = 3;
			//$this->order->save();
			throw new Exception('Payment operation failed ('.$payment->getLastError().')');
		}
	}
	
	
	private function getOrderFromDB(){
		//set all the amounts
		//set the order info
	}
	
	public function getData(){
		return $this->order;
	}
	
	
	public function log($e){
		if($this->order->id){
			$order = new Order_Model($this->order->id);
			$order->comment = $e;
			$order->save();
		}
	}
	
	
	public function create() {
		
		if($this->leftInInventory()){			
			$order = new Order_Model;
			
			$order->customer_id = isset($this->order->customer->id) ? $this->order->customer->id : 0 ;
			$order->first_name = $this->order->billing->first_name;
			$order->last_name = $this->order->billing->last_name;
			$order->telephone = $this->order->billing->phone;
			$order->email = $this->order->billing->email;
			$order->shipping_method = $this->order->shipping->method;
			$order->shipping_total = $this->shipping();
			$order->payment_method = $this->order->payment->method;
			$order->payment_total = $this->total();
			$order->tax = $this->tax();
			$order->status = 1;	
			$order->customer_ip = $this->order->customer->ip;		
			$order->comment = $this->order->comment;		
			$order->discounts = join(', ', $this->appliedDiscounts);
			
			if($order->save()){
				$this->order->id = $order->id;
				$this->order->finance_state = 'Pending';
				return $order->id;
			}else{
				throw new Exception('Order saving error');
			}
		}else{
			throw new Exception('Not Enough inventory');
		}
	}

	
	private function setAddress(){
		$order_address = new Orders_address_Model;
		
		$order_address->shipping_first_name = $this->order->shipping->first_name;
		$order_address->shipping_last_name = $this->order->shipping->last_name;
		$order_address->shipping_address1 = $this->order->shipping->address1;
		$order_address->shipping_address2 = $this->order->shipping->address2;
		$order_address->shipping_city = $this->order->shipping->city;
		$order_address->shipping_state = $this->order->shipping->state;
		$order_address->shipping_zip = $this->order->shipping->zip;
		$order_address->shipping_country = $this->order->shipping->country;
		$order_address->shipping_company = $this->order->shipping->company;
		
		$order_address->billing_first_name = $this->order->billing->first_name;
		$order_address->billing_last_name = $this->order->billing->last_name;
		$order_address->billing_address1 = $this->order->billing->address1;
		$order_address->billing_address2 = $this->order->billing->address2;
		$order_address->billing_city = $this->order->billing->city;
		$order_address->billing_state = $this->order->billing->state;
		$order_address->billing_zip = $this->order->billing->zip;
		$order_address->billing_country = $this->order->billing->country;
		$order_address->billing_company = $this->order->billing->company;
		
		$order_address->save();
		
		return $order_address->id;
	}
	
	
	
	private function updateStatusList($status){
		$order_status = new Orders_status_Model;
		
		$order_status->order_id = $this->order->id;
		$order_status->status = $status;
	//	$order_status->date = time();
		
		$order_status->save();
	}
	
	private function addOrderBasket(){
		foreach($this->order->basket->items() as $item){

			$order_basket = new Orders_basket_Model;
			$order_basket->order_id = $this->order->id;
			$order_basket->product_id = $item->id;
			$order_basket->qty = $item->qty;
			$order_basket->options = serialize($item->options);
			$order_basket->subtotal = $item->total;
			
			$order_basket->save();
		}
	}
	
	public function confirm(){
		if($this->order->id){
			$order = new Order_Model($this->order->id);
			
			if ($order){
				$order->status = 1;
				$order->orders_address_id = $this->setAddress();
				$order->trans_id = $this->getTransID();
				$order->date_modified = time();
				$order->date_created = time();
				$order->save();
			}
				
			$this->addOrderBasket();		
			$this->updateInventory();
			$this->updateStatusList(1);

			$this->order->fulfillment_state = 'NEW';
				
			return $order->trans_id;
		}
	}
	
	private function getTransID(){
		$id = 299792458 . $this->order->id . (int)$this->order->basket->size(); // the first number is just a random constant (speed of light in m/s)		
		$idd = strtoupper(base_convert($id, 10, 16)); // used to produce long transaction numbers
		return $idd;
	}	
	
	private function updateInventory(){
		foreach($this->order->basket->items() as $item){
			$i = ORM::factory('product', $item->id)->products_inventory;
			$i->amount_sold = $i->amount_sold + $item->qty;
			$i->save();
		}
	}
	
	private function leftInInventory(){
		
		$check = true;
		foreach($this->order->basket->items() as $item){
			$i = ORM::factory('product', $item->id)->products_inventory;
			if(($i->on_hand - $i->amount_sold) < $item->qty){
				$this->error = $item->id;
				$check = false;
				break;
			}
		}
		return $check;
	}
	
	private function save(){
		$this->session = (array)$this->order;
		Session::instance()->saveContent($this);
	}
	
	
	private function get(){
		return Session::instance()->getContent($this);
	}
	
	public function sendConfirmation($orderId){
		$order = ORM::factory('order', $orderId);
		$db = new Database();
		$res = $db->query('SELECT oa.* FROM orders_addresses oa JOIN orders o ON (oa.id = o.orders_address_id) WHERE o.id="'.$orderId.'"');

		// call autoresponder handlers
		$shippingInfo = $res[0]->shipping_first_name.' '.$res[0]->shipping_last_name.'<br/>'.
				$res[0]->shipping_address1.'<br/>'.$res[0]->shipping_address2.'<br/>'.$res[0]->shipping_city.' '.$res[0]->shipping_state.'<br/>'.$res[0]->shipping_zip.'<br/>'.
				$res[0]->shipping_country;

		$billingInfo = $res[0]->billing_first_name.' '.$res[0]->billing_last_name.'<br/>'.
				$res[0]->billing_address1.'<br/>'.$res[0]->billing_address2.'<br/>'.$res[0]->billing_city.' '.$res[0]->billing_state.'<br/>'.$res[0]->billing_zip.'<br/>'.
				$res[0]->billing_country;
				
		$dateTime = date('Y-m-d H:i:s');

		$res = $db->query('SELECT p.name, ob.qty, ob.subtotal FROM products p JOIN orders_baskets ob ON (ob.product_id=p.id) WHERE ob.order_id="'.$orderId.'"');
		
		$order_basket = new Orders_basket_Model;
		$description = '';
		$subtotal = 0;
		foreach($res as $item){
			$description .= $item->name . '  ' . $item->qty . ' x ' . format::dollar($item->subtotal) . '<br/>';
			$subtotal += $item->subtotal;
		}
		
		if (!empty($order->comment)){
			$description .= 'Comment:'.$order->comment.'<br/>';
		}
		
		$total = 'Subtotal: ' . format::dollar($subtotal) . '<br/>Shipping:' . format::dollar($order->shipping_total);
		
		$total .= '<br/>Total:' . format::dollar($order->payment_total);
			
		Autoresponder::sendEmail('order.confirmation', $order->email, $order, 
			array(
				'shipping_info' => $shippingInfo, 
				'billing_info' => $billingInfo, 
				'date_time' => $dateTime, 
				'description' => $description,
				'total' => $total
			)
		);
	}


	
	/*
	public function send_confirm_mail($links = '', $TNTinfo = ''){
		
		$subject = 'Store Order #'.$this->trans_id;
		$from = 'vanyad@polardesign.com';
		$sender = 'Paddock Furniture';
				
		//including the generated download links if available
		$text_links = '';
		if($links){
			$is_are = (count($links) > 1)? "are" : "is";
			$text_links = "The following ".$is_are." the download link to some of the content you purchased (note that these links will expire after 3 downloads or 3 days) \n\n";
			foreach($links as $link)
				$text_links .= $link['name'] ."\n". BASE_HTTP_DIRECTORY ."download/".$link['hash']."/ "."\n\n";
		}
		
		// grabbing the invoice for attachemnt
		$CurlURL = BASE_HTTP_DIRECTORY. 'admin/order/detail/invoice/'.$this->order_id;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $CurlURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  // RETURN THE CONTENTS OF THE CALL
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Needs to be included if no *.crt is available to verify SSL certificates
		curl_setopt($ch, CURLOPT_SSLVERSION,3);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close($ch);
		
				
		//show the shiiping info aprt of the email only if the customer has shippable products	
		$shipping_info = '';
		if($this->data->shipping->total > 0){
			$shipping_info = <<<FORMDATAGOESHERE
Your order will be sent to:
			
{$this->data->shipping->firstname} {$this->data->shipping->lastname}
{$this->data->shipping->address1}
{$this->data->shipping->city}, {$this->data->shipping->state}
{$this->data->shipping->zip}
{$this->data->shipping->country}

FORMDATAGOESHERE;
		}
		
		$text =<<<FORMDATAGOESHERE
Dear {$this->data->billing->firstname} {$this->data->billing->lastname},
Thank you for your order. This is to acknowledge that we've received your order (an invoice with details is attached). 
{$shipping_info}
{$text_links}
If you have any questions please write to us at cec_info@cio.com or simply reply to this email.
 
Thank you for shopping at Paddock Furniture.
FORMDATAGOESHERE;

		//$html = $template->fetch('default/template/mail/order_confirm.tpl');
		
		/*
		$mail = new CIOMail();	
		$mail->setTo($to);
		$mail->setFrom($from);
		$mail->setSender($sender);
		$mail->setSubject($subject);
		$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
		//$mail->setHtml($html);
	//	$mail->addAttachment($result, 'invoice.html');
		

		$mail->setTo($this->data->billing->email);
		$mail->send();
		
		
		//sending notification to other people
		$mail->setSubject($subject . $TNTinfo);
		$mail->setTo('cec_info@cio.com');
		$mail->send();
		
		$mail->setTo('jfinn@cio.com');
		$mail->send();
		
		$mail->setTo('dstark@cio.com');
		$mail->send();
		
		
		
	//	mail();
		
		//if($mail->send())
			
		return true;
	}
	*/
}
