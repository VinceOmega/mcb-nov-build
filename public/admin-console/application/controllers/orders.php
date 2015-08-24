<?php defined('SYSPATH') or die('No direct script access.');

class Orders_Controller extends Base_Controller {	

	public $tableCols = array('order_id','shortname','firstname', 'lastname', 'status_name', 'order_total', 'date_created');

	public $fields = array(
		'order_id' => array(
			'title' => 'Order ID',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'shortname' => array(
			'title' => 'Site',
			'type' => 'select',
			'options' => 'sites',
			'index' => 'orders.site_id',
			'stype' => 'select'
		),
		'firstname' => array(
			'title' => 'First Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'lastname' => array(
			'title' => 'Last Name',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'status_name' => array(
			'title' => 'Status',
			'type' => 'select',
			'options' => array('order_statuses', 'id', 'status_name'),
			'index' => 'orders.statusID',
			'stype' => 'select'
		),
		'order_total' => array(
			'title' => 'Order Total',
			'type' => 'text',
			'required' => true,
			'mask' => false
		),
		'date_created' => array(
			'title' => 'Date Created',
			'type' => 'date',
			'required' => true,
			'mask' => false,
			'date' => true
		),
	);
	public $objectName = 'orders';
	public $title = 'Orders List - ';
	
	public function getQuery(){
		$db = new Database();
		return $db->select('orders.*', 'order_statuses.status_name', 'sites.shortname', 'users.firstname', 'users.lastname', new Database_Expression('CONCAT(sites.shortname,"1",order_ids.id) as order_id'))->from('orders')
			->join('order_statuses', 'orders.statusID', 'order_statuses.id', 'left')
			->join('sites', 'orders.site_id', 'sites.id', 'left')
			->join('order_ids', 'orders.id', 'order_ids.order_id', 'left')
			->join('users', 'orders.user_id', 'users.id', 'left');
	}
	
	
	public function getWhere(){
		return (isset($_GET['designer'])) ? array('users_clients.user_id='.(int)$_GET['designer']) : array();
	}

	// old code	
	public function edit(){
		if (isset($_POST['update'])){
			$post = new Validation($_POST);            			 
	
			$id = $this->uri->segment(3);			
			$order = ORM::factory('order',$id);
			
			$order->statusID = $post->status;
			$order->save();
			
			// call autoresponder handler
			$billing_info = $order->user->user_billing_info;
			$shipping_info = $order->user->user_shipping_info;
			
			$shippingInfo  = $shipping_info->firstname.' '.$shipping_info->lastname.'<br/>';
			$shippingInfo .= trim($shipping_info->address1.' '.$shipping_info->address2).'<br />';
			$shippingInfo .= $shipping_info->city.', '.$shipping_info->state.' '.$shipping_info->zip.'<br />';
			$shippingInfo .= $shipping_info->country;
			
			$billingInfo  = $billing_info->firstname.' '.$billing_info->lastname.'<br/>';
			$billingInfo .= trim($billing_info->address1.' '.$billing_info->address2).'<br />';
			$billingInfo .= $billing_info->city.', '.$billing_info->state.' '.$billing_info->zip.'<br />';
			$billingInfo .= $billing_info->country;
					
			$dateTime = date('Y-m-d H:i:s');
			
			$additionalFees = 0;
			$description = '';
			foreach ($order->orders_baskets as $ob)
			{
				$additionalFees += $ob->second_side_fee;
				
				$product_name = $ob->product->name;
				if ($ob->packaging_id != 0)
					$product_name .= ' - '.$ob->packaging->name;
				
				$description .= $ob->qty.' x '.$product_name.' = '.money_format('%.2n', $ob->subtotal).'<br/>';
			}
			if ($additionalFees != 0)
				$description .= 'Additional Fees: '.money_format('%.2n', $additionalFees).'<br/>';

			if (!empty($order->comment))
				$description .= 'Comment:'.$order->comment.'<br/>';

			$total_text  = 'Subtotal: '.money_format('%.2n', $order->subtotal).'<br/>';
			$total_text .= 'Shipping:' .money_format('%.2n', $order->shipping_total).'<br/>';
			$total_text .= 'Total: '.   money_format('%.2n', $order->order_total);
		
			if (FALSE === ($order_id = $order->getOrderId())) {
				$db=new Database;
				$db->query('INSERT INTO order_ids (order_id) VALUES ('.$order->id.')');
				$order_id = $order->getOrderId();
			}
			
			$to = array(
				$order->user->email,
				'info@mychocolatecoins.com',
				'freddyfalck@hotmail.com',
				'info@deligance.com',
				'contact@polardesign.com'
			);
			foreach ($to as $address)
				Autoresponder::sendEmail('order.status.changed', $address, $order,
								array(
									'shipping_info' => $shippingInfo, 
									'billing_info'	=> $billingInfo, 
									'date_time'		=> $dateTime, 
									'description'	=> $description,
									'total'			=> $total_text,
									'order_id'		=> $order_id,
									'email'			=> $order->user->email
								)
							);
		}
		if (isset($_POST['save'])){
			$post = new Validation($_POST);            			 
			
			$id = $this->uri->segment(3);			
			$order = ORM::factory('order')->find($id);
			$order_address = ORM::factory('user_shipping_info')->find($order->shippingID);
			$order_billing = ORM::factory('user_billing_info')->find($order->billingID);
			
			foreach($post as $index=>$value){
				if ($index != 'save' AND $index != 'status' AND $index != 'selected_tab' AND $index != 'comment') {
					if(strpos($index, 'billing') >= 0) {
						$index = substr($index, 9);
						$order_address->{$index} = $value;
					} else if (strpos($index, 'shipping') >= 0) {
						$index = substr($index, 10);
						$order_address->{$index} = $value;
					}
					
				}
			}
			
			if (isset($_POST['comment'])){
				$order->comment = $_POST['comment'];
				$order->save();
			}
			$order_billing->save();
			$order_address->save();
		}
		$this->_renderView();
	}
	
	
	
	public function invoice(){			 
		$id = $this->uri->segment(3);			
		$order = ORM::factory('order')->find($id);
		$this->renderViewInvoice();
	}
	
	function _renderView(){
		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('order_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Order >> Add >> Edit ';     // string for variable $title in view header.php
		$view->content->heading  = 'Heading of your page'; // string for variable $heading in view content.php

		$view->render(TRUE);
	}
	
	function renderViewInvoice(){
		$view = new View('admin');
		 
		$view->header  = new View('header_invoice');
		$view->content = new View('order_invoice_content');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Order >> Add >> Edit ';     // string for variable $title in view header.php		 
		$view->render(TRUE);
	}	
	
	private function getProducts(){
		$cart = new Basket();
		$cart->clear();
		$products = explode('<-|->', $_POST['products']);
		unset($products[0]);
		foreach ($products as $product){
			$arr = explode('||', $product);
			$item = new Item;
			$item->id = $arr[0];
			$item->qty = $arr[1];
			$cart->add($item);
		}
		return $cart;
	}
	
	function add(){
		if (isset($_POST['products'])){
			unset($_SESSION['Basket']);
			unset($_SESSION['Shipping']);
		
			$shipping = new StdClass();
			$shipping->first_name = $_POST['shipping']['first_name'];
			$shipping->last_name = $_POST['shipping']['last_name'];
			$shipping->address1 = $_POST['shipping']['address1'];
			$shipping->address2 = $_POST['shipping']['address2'];
			$shipping->city = $_POST['shipping']['city'];
			$shipping->state = $_POST['shipping']['state'];
			$shipping->zip = $_POST['shipping']['zip'];
			$shipping->country = $_POST['shipping']['country'];
			$shipping->phone = $_POST['shipping']['phone'];
			$shipping->email = $_POST['shipping']['email'];
			$shipping->method = $_POST['shipping']['method'];
			$shipping->company = $_POST['shipping']['company'];

			$billing = new StdClass();
			$billing->first_name = $_POST['billing']['first_name'];
			$billing->last_name = $_POST['billing']['last_name'];
			$billing->address1 = $_POST['billing']['address1'];
			$billing->address2 = $_POST['billing']['address2'];
			$billing->city = $_POST['billing']['city'];
			$billing->state = $_POST['billing']['state'];
			$billing->zip = $_POST['billing']['zip'];
			$billing->country = $_POST['billing']['country'];
			$billing->phone = $_POST['billing']['phone'];
			$billing->email = $_POST['billing']['email'];
			$billing->company = $_POST['billing']['company'];	

			$payment = new StdClass();			
			if (isset($_POST['order']['cc']) && $_POST['order']['cc']=='on'){
				$payment->method = $_POST['card']['type'].' Card';
				$payment->card = new StdClass();
				$payment->card->name = $_POST['card']['name'];
				$payment->card->type = $_POST['card']['type'];
				$payment->card->card_num = $_POST['card']['number'];
				$payment->card->exp_date = $_POST['card']['expdate_month'] . $_POST['card']['expdate_year'];
				$payment->card->cvv = $_POST['card']['verification'];
			}else{
				$payment->method = 'Backend creation with no card data';
			}
			
			$cart = &$this->getProducts();

			$customer = new StdClass();
			$customer->ip = '0.0.0.0';
			$customer->id = (int)$_POST['order']['user'];
			
			$order = new Order;
			$order->shipping = $shipping;
			$order->billing = $billing;
			$order->payment = $payment;			
			$order->customer = $customer;
			$order->comment = $_POST['order']['comment'];
			$order->basket = $cart;
			
			if (isset($_POST['order']['discount']) && $_POST['order']['discount']!=''){
				$order->setDiscount((int)$_POST['order']['discount']);
			}

			try{
				if (isset($payment->card)){
					$order->pay('Authorize');
				}
				$id = $order->create();
				$order->confirm();
				//$order->sendConfirmation($id);
				$cart->clear();
				url::redirect('/orders');				
			}catch(Exception $e){
				$this->error = $e->getMessage();
			}
		}

		$view = new View('admin');
		 
		$view->header  = new View('header');
		$view->content = new View('order_add');
		$view->footer  = new View('footer');
		 
		$view->header->title     = 'Order >> Add';     // string for variable $title in view header.php
		$view->footer->copyright = 'Copyright';         // string for variable $copyright in view footer.php
		 
		$view->render(TRUE);
	}
	
	public function getShippingRate(){
		$cart = &$this->getProducts();
		$zip = $_POST['destZip'];
		$country = $_POST['destCountry'];		
		$method = $_POST['method'];

		$shipping = new Shipping('UPS', $zip, $country, $cart);
		$shipping->setMethod($method);
		$amount = $shipping->amount();
		//add 35% to the shipping cost that UPS returns
		$amount = sprintf ("%6.2f", $amount+ 0.35 * $amount);
		$cart->clear();
		die( trim($amount) );
	}
	
	public function test(){
		$id = $this->uri->segment(3);			
		$order = ORM::factory('order')->find($id);

		// call autoresponder handler
		$order_address = ORM::factory('orders_address')->find($order->orders_address_id);
		$shippingInfo = $order_address->shipping_first_name.' '.$order_address->shipping_last_name.'<br/>'.
				$order_address->shipping_address1.'<br/>'.$order_address->shipping_city.' '.$order_address->shipping_state.'<br/>'.$order_address->shipping_zip.'<br/>'.
				$order_address->shipping_country;

		$billingInfo = $order_address->billing_first_name.' '.$order_address->billing_last_name.'<br/>'.
				$order_address->billing_address1.'<br/>'.$order_address->billing_city.' '.$order_address->billing_state.'<br/>'.$order_address->billing_zip.'<br/>'.
				$order_address->billing_country;
				
		$dateTime = date('Y-m-d H:i:s');

		$db = new Database();
		$res = $db->query('SELECT p.name, ob.qty FROM products p JOIN orders_baskets ob ON (ob.product_id=p.id) WHERE ob.order_id="'.$order->id.'"');
		
		$order_basket = new Orders_basket_Model;
		$description = '';
		foreach($res as $item){
			$description .= $item->name . ' x ' . $item->qty . '<br/>';
		}
	
		Autoresponder::sendEmail('order.status.changed', 'erlan@polardesign.com', $order,
			array(
				'shipping_info' => $shippingInfo, 
				'billing_info' => $billingInfo, 
				'date_time' => $dateTime, 
				'description' => $description,
				'total' => format::dollar($order->payment_total)
			)
		);	
	}
}