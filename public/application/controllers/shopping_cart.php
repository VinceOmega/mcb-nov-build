<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Shopping_Cart_Controller extends My_Template_Controller {
	// Disable this controller when Kohana is set to production mode.
	// See http://docs.kohanaphp.com/installation/deployment for more details.
	const ALLOW_PRODUCTION = FALSE;
	// Set the name of the template to use
	public $template = 'kohana/template';

	public $description = '';
	public $title = '';
	public $keywords = '';
	
	protected $_removeSSL = FALSE;

	public function __construct() {
		parent::__construct();
		
		//set texts
		$method = $this->methodNameForSite('setTexts');
		$this->$method();
	}
	
	protected function setTexts_MCC()
	{
		$this->description = 'Shopping cart for MyChocolateCoins.com - purchase your custom chocolate coins.';
		$this->title = 'Cart - MyChocolateCoins.com: Create customized chocolate coins with your own design';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}
	
	protected function setTexts_MCH()
	{
		$this->description = 'Shopping cart for MyChocolateHearts.com - purchase your custom chocolate heart.';
		$this->title = 'Cart - MyChocolateHearts.com: Create customized chocolate hearts with your own design';
		$this->keywords = 'chocolate hearts, custom chocolate hearts, personalized chocolate hearts, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}

		protected function setTexts_MCB()
	{
		$this->description = 'Shopping cart for MyChocolateBars.com - purchase your custom chocolate bars.';
		$this->title = 'Cart - MyChocolateBars.com: Create customized chocolate bars with your own design';
		$this->keywords = 'chocolate bars, custom chocolate bars, personalized chocolate bars, chocolate favors, custom chocolate favors, party favors, personalized chocolate favors, chocolate casino chips, chocolate poker chips, custom chocolate casino chips, casino party favors, wedding favors, personalized wedding favors, baby shower favors, bridal shower favors, chocolate gelt, chocolate gold hearts, chocolate party favors, chocolate candy favors, custom chocolate, custom chocolate poker chips, corporate favors';
	}

	public function index() {

		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('shopping_cart');
		
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;
		
		//$db=new Database;
		// $order = ORM::factory('order')
		// 				->where('sessionID',$this->session->id())
		// 				->in('statusID',array(1,3))
		// 				->find();
		// $order->refreshTotals();

		              $db=new Database;
                $result = $db->query('SELECT id, subtotal FROM orders WHERE sessionID = \''.$this->session->id().'\' AND statusID IN (1,3)');
        $this->template->content->order = $result[0];
                $rows = count($result);
                
                if($rows  > 0)
                        $orderid = $result[0]->id;
                else 
                        $orderid = 0;
     if($orderid != 0){ 
		$packageid = $db->query('SELECT orders_baskets.id as id, orders_baskets.product_id as productid
				FROM orders_baskets 
				LEFT JOIN products ON orders_baskets.product_id = products.id 
				LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id
				LEFT JOIN user_designs ON user_designs.productid = products.id 
				WHERE orders_baskets.order_id = '.$orderid.' 
				AND orders_baskets.id = (SELECT DISTINCT MAX(ord.id) FROM orders_baskets as ord WHERE orders_baskets.id = ord.id )');
} else {
	$packageid = array();
}

	

		if ($orderid != 0)
		{
			$resultall = $db->query('SELECT orders_baskets.id as id, orders_baskets.order_id as order_id, orders_baskets.qty as qty, orders_baskets.rate as rate, 
				orders_baskets.subtotal as subtotal, orders_baskets.product_id as product_id, orders_baskets.designpath as designpath, orders_baskets.wrapperpath as wrapperpath,
				products.name as productname, products.kind as kind, products_descriptions.image as productimage, 
				products_descriptions.short_description as productdescription, orders_baskets.packaging_qty, orders_baskets.packaging_rate, 
				orders_baskets.second_side_fee FROM orders_baskets 
				LEFT JOIN products ON orders_baskets.product_id = products.id 
				LEFT JOIN products_descriptions ON products.products_description_id = products_descriptions.id
				LEFT JOIN user_designs ON user_designs.order_id = orders_baskets.order_id 
				WHERE orders_baskets.order_id = '.$orderid.'');
		}else  {
			$resultall = array();
		}
		$this->template->content->itemsresults = $resultall;
	  
		if (self::getCurrentSite()->packaging == 1) {
			$this->template->content->packagingsActive = TRUE;
			$orders = array();
			foreach ($resultall as $product) {
				$product->packaging = ORM::factory ('orders_basket')->find($product->id)->packaging;
				$orders[] = $product;
			}
			$this->template->content->itemsresults = $orders;
		}
	}
	
	public function checkout ()
	{
		//-----------------------------------------------\\
		// This is the FIRST checkout page where the     \\
		// user is asked for his shipping and billing    \\
		// info as well as the date requested            \\
		//-----------------------------------------------\\
		
		$db=new Database;
		
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('checkout');

		if (isset($_POST['requesteddate']))
			$this->template->content->requesteddate = $_POST["requesteddate"];
		else
			$this->template->content->requesteddate = date('Y-m-d');

		$this->template->content->user = FALSE;

		$formFields = User_Model::getFormFields();
		if (User_Model::logged_in()) {
			$user = User_Model::logged_user();
			$this->template->content->user = $user;

			foreach ($formFields as $section => &$fields) {
				if ($section == 'user') continue;

				foreach ($fields as &$field) {
					switch ($field->form) {
						case 'billing':	
							$field->value = $user->user_billing_info->{$field->db_name};
							break;
						case 'shipping':
							$field->value = $user->user_shipping_info->{$field->db_name};
							break;
					}
				}
			}
		}
		$this->template->content->formFields = $formFields;

		$this->template->content->countries = ORM::factory('country')->find_all();
		$this->template->content->states = ORM::factory('state')->find_all();

		// Meta Description and Meta Keywords for individual pages are, at this point, hard coded.
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;

		// Get the order
		$order = ORM::factory('order')
					->where('sessionID',$this->session->id())
					->in('statusID',array(1,3))
					->find();
		if ($order->id == 0) {
			url::redirect('/shopping_cart');
		}

		if ($order->shipping_method == 0)
		{
			$shippingMethod = ORM::factory('shipping_method',1);
			$shippingcost = $shippingMethod->getRateForPrice($order->subtotal)->price;
			$order->shipping_method_id = $shippingMethod->id;
			$order->shipping_total = $shippingcost;
			$order->save();
			$order->refreshTotals();
		}

		$this->template->content->order = $order;

		// Get a set of shipping options for the user -
		// The list is based upon the subtotal of the order;
		// There are 3 shipping options and all 3 should be returned each time:
		// Ground (3-6 days), 2 days, and Overnight
		$costs = $db->query('SELECT 
								shipping_rates.price, shipping_rates.shipping_method_id, shipping_rates.id, shipping_methods.name 
							FROM shipping_rates 
							LEFT JOIN shipping_methods 
								ON shipping_rates.shipping_method_id = shipping_methods.id 
							WHERE 
								prc_start <= '.$order->subtotal.' 
								AND prc_end >= '.$order->subtotal.' 
							ORDER BY shipping_rates.price ASC');
		//if the subtotal is higher than all shipping rates, get the highest one.
		if (count($costs) == 0)
			$costs = $db->query('
							SELECT 
								shipping_rates.price, shipping_rates.shipping_method_id, shipping_rates.id, shipping_methods.name 
							FROM shipping_rates 
							LEFT JOIN shipping_methods 
								ON shipping_rates.shipping_method_id = shipping_methods.id 
							WHERE 
								prc_start <= '.$order->subtotal.' 
								AND prc_end = 0 
							ORDER BY shipping_rates.price ASC');

		$this->template->content->shippingcosts = $costs;
		// In addition to the list, send the lowest priced shipping option (this will be automatically added to the order total, as this will
		// be the minimum shipping cost the user could possibly incur.
		if($costs[0])
		$this->template->content->shippinglow = $costs[0]->price;
		
		// After all the alterations and everything have been made, select the basket and pass on the this of items to the template
		$resultall = $db->query('
							SELECT 
								orders_baskets.*, 
								orders_baskets.id as orders_basket_id, 
								products.name as productname, 
								products_descriptions.image as productimage, 
								products_descriptions.image_alt 
							FROM orders_baskets 
							LEFT JOIN products 
								ON orders_baskets.product_id = products.id 
							LEFT JOIN products_descriptions 
								ON products.products_description_id = products_descriptions.id 
							WHERE orders_baskets.order_id = '.$order->id);
		$this->template->content->itemsresults = $resultall;
	}
	
	public function authorization ()
	{
		//-----------------------------------------------\\
		// This is the MIDDLE checkout page where the    \\
		// user info that was received is processed      \\
		// and inserted/updated in the DB before         \\ 
		// sending the user along to the payment segment \\ 
		//-----------------------------------------------\\
		
		// $db=new Database;
		
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('authorization');

		// Meta Description and Meta Keywords for individual pages are, at this point, hard coded.
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;

		$formFields = User_Model::getFormFields();

		//USER
		if (User_Model::logged_in())
			$user = User_Model::logged_user ();
		else {
			$user = ORM::factory('user');
			$user->email = $_POST['userEmail'];
			$user->password = $_POST['userPassword'];
			foreach ($formFields['billing'] as $field)
				$user->{$field->db_name} = $_POST[$field->formName];
			$user->site_id = self::getCurrentSite()->id;
			$user->save();
			$user->forceLogin();

			Autoresponder::sendEmail('user.registration', $user->email,
					$user, 
					array('new_pass'=>$_POST['userPassword']));
		}
		$user->newsletter = isset($_POST["email-updates"]) ? 1 : 0;
		$user->save();

		$user_billing_info = ORM::factory('user_billing_info');
		$user_billing_info->user_id = $user->id;
		foreach ($formFields['billing'] as $field)
			if (isset($_POST[$field->formName]))
				$user_billing_info->{$field->db_name} = $_POST[$field->formName];
		$user_billing_info->save();

		$user_shipping_info = ORM::factory('user_shipping_info');
		$user_shipping_info->user_id = $user->id;
		foreach ($formFields['shipping'] as $field)
			if (isset($_POST[$field->formName]))
				$user_shipping_info->{$field->db_name} = $_POST[$field->formName];
			if (isset($_POST[$field->formName]))
				$_SESSION["shipping"."$field->formName"] = $_POST[$field->formName];			
		$user_shipping_info->save();

		//like the ->reload() function doesn't have into account the relations, this refresh the object and will load the new shipping and billing in case they are needed.
		$user = ORM::factory('user',$user->id);

		//ORDER
		$order = ORM::factory('order')->getCurrentOrder();
		$order->can_share = isset($_POST["share"]) ? 1 : 0;
			//shipping
		$shippingMethod = ORM::factory('shipping_method')->find($_POST['shippingMethod']);
		$shippingcost = $shippingMethod->getRateForPrice($order->subtotal)->price;
		if($_POST['shippingCountry'] == "CA")
			$shippingcost += 30;
		$order->shipping_method_id = $shippingMethod->id;
		$order->shipping_total = $shippingcost;
			//user into order
		$order->user_id = $user->id;
		$order->shippingID = $user->user_shipping_info->id;
		$order->billingID = $user->user_billing_info->id;
			//last details and save
		$order->order_delivery_date = $_POST["requesteddate"];
		$order->date_modified = time();
		$order->save();
			//total and subtotal
		$order->refreshTotals();

		//like the ->reload() function doesn't have into account the relations, this refresh the object and will load the new shipping and billing in case they are needed.
		$order = ORM::factory('order',$order->id);

		//FOR NEXT FORM
		$this->template->content->user = $user;
		$this->template->content->order = $order;

		// Send final few pieces of data as variables to the template
		$this->template->content->requesteddate = $order->order_delivery_date;
		
		// After all the alterations and everything have been made, select the basket and pass on the this of items to the template
		$resultall = $db->query('
							SELECT 
								orders_baskets.*, 
								orders_baskets.id as orders_basket_id, 
								products.name as productname, 
								products_descriptions.image as productimage, 
								products_descriptions.image_alt 
							FROM orders_baskets 
							LEFT JOIN products 
								ON orders_baskets.product_id = products.id 
							LEFT JOIN products_descriptions 
								ON products.products_description_id = products_descriptions.id 
							WHERE orders_baskets.order_id = '.$order->id);
		$this->template->content->itemsresults = $resultall;
	}
	
	public function order_status ()
	{
		//-----------------------------------------------\\
		// This is the LAST checkout page where the      \\
		// payment is placed using Authorize.net and     \\
		// then lets the user know the payment status    \\
		//-----------------------------------------------\\
		
		$db=new Database;
		
		$this->template->content = new View('order_status');

		// Load Captcha library, you can supply the name of the config group you would like to use.
		//$captcha = new Captcha;

		// Ban bots (that accept session cookies) after 50 invalid responses.
		// Be careful not to ban real people though! Set the threshold high enough.
		//if ($captcha->invalid_count() > 49)
		//	exit('Bye! Stupid bot.');


		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;

		// Captcha::valid() is a static method that can be used as a Validation rule also.
		//if (Captcha::valid($this->input->post('captcha_response'))) {
		//	echo '<p style="color:green">Good answer!</p>';
		//} else {
		//	$this->template->content->status = 3;
		//	$this->template->content->trans_status = "Your Captcha response was incorrect";
		//	exit();
		//}

		$order = ORM::factory('order')
						->where('id',$_POST['orderid'])
						->where('user_id', User_Model::logged_user()->id)
						->find();
		$order->shipping_total = $_POST["shippingtotal"];    
		$order->save();
		$order->refreshTotals();

		$ccnum		= isset($_POST["cnumber"]) ?		$_POST["cnumber"]		: '';
		$nameoncard = isset($_POST["cname"]) ?			$_POST["cname"]			: '';
		$cardexp	= isset($_POST["expiration"]) ?		$_POST["expiration"]	: '';
		$cardcode	= isset($_POST["verification"]) ?	$_POST["verification"]	: '';

		$this->template->content->order = $order;

		$billing_info = $order->user->user_billing_info;
		$shipping_info = $order->user->user_shipping_info;

		$cardfname = $billing_info->firstname;
		$cardlname = $billing_info->lastname;

		$this->template->content->shippingName = $shipping_info->firstname.' '.$shipping_info->lastname;
		$this->template->content->shippingAddress = trim($shipping_info->address1.' '.$shipping_info->address2);
		$this->template->content->shippingCity = $shipping_info->city.', '.$shipping_info->state.', '.$shipping_info->country.' '.$shipping_info->zip;

		$this->template->content->billingName = $cardfname.' '.$cardlname;
		$this->template->content->billingAddress = trim($billing_info->address1.' '.$billing_info->address2);
		$this->template->content->billingCity = $billing_info->city.', '.$billing_info->state.', '.$billing_info->country.' '.$billing_info->zip;

		$shippingInfo  = $shipping_info->firstname.' '.$shipping_info->lastname.'<br/>';
		$shippingInfo .= trim($shipping_info->address1.' '.$shipping_info->address2).'<br />';
		$shippingInfo .= $shipping_info->city.', '.$shipping_info->state.' '.$shipping_info->zip.'<br />';
		$shippingInfo .= $shipping_info->country;

		$billingInfo  = $cardfname.' '.$cardlname.'<br/>';
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

		switch ($_POST['payment_method']){
			case 'credit_card':		
				$payment = new Payment('Authorize');

				$attributes = array(
							'card_num'			   => $ccnum,
							'exp_date'             => $cardexp,
							'card_code'            => $cardcode,
							'amount'               => number_format($order->order_total,2,'.',''),
							'ship_to_first_name'   => $shipping_info->firstname,
							'ship_to_last_name'    => $shipping_info->lastname,
							'ship_to_address'      => trim($shipping_info->address1.' '.$shipping_info->address2),
							'ship_to_city'         => $shipping_info->city,
							'ship_to_state'        => $shipping_info->state,
							'ship_to_zip'          => $shipping_info->zip,
							'first_name'           => $cardfname,
							'last_name'            => $cardlname,
							'address'              => trim($billing_info->address1.' '.$billing_info->address2),
							'city'                 => $billing_info->city,
							'state'                => $billing_info->state,
							'zip'                  => $billing_info->zip,
							'phone'                => $billing_info->phone1,
							'x_test_request'       => 'FALSE'
					);


				$payment->set_fields($attributes);   		  
				if($payment->process()) { 
					// !!!!!!!!!!!!!!!!!!!!!!!!!!!!
					// if the payment was SUCCESSFUL
					$this->template->content->trans_status = $payment->get_response();
					$this->template->content->status = 1;
					$transaction_id = $payment->get_transaction_id();
					$paymentstatus = 3;
					$orderstatus = 2;
				} else {
					// !!!!!!!!!!!!!!!!!!!!!!!!!!!!
					// if the payment FAILED			
					$this->template->content->status = 3;
					$this->template->content->trans_status = $payment->get_response();
					$orderstatus = 3;
					$paymentstatus = 1;
				}

				break;
//			case 'paypal':
//					@todo: review this code when uncomment
//					$payment = new Payment('Paypal');
//					$order->billcountry = "US";
//
//					$attributes = array(
//						'test_mode'			=> FALSE,
//						'AMT'               => $order->subtotal,
//						'INVNUM'            => $order->trans_id,
//						'SHIPTONAME'        => $order->shipfname . ' '. $order->shiplname,
//						'SHIPTOSTREET'      => $order->billaddress,
//						'SHIPTOCITY'        => $order->billcity,
//						'SHIPTOCOUNTRYCODE' => $order->billcountry ,
//						'SHIPTOSTATE'       => $order->billstate,
//						'SHIPTOZIP'         => $order->billzip,
//					);
//
//					$payment->set_fields($attributes);
//
//					if($payment->process()) { 
//						// !!!!!!!!!!!!!!!!!!!!!!!!!!!!
//						// if the payment was SUCCESSFUL
//						$this->template->content->trans_status = '';
//						$this->template->content->status = 1;
//						$transaction_id = $order->trans_id;
//						$paymentstatus = 3;
//						$orderstatus = 2;
//					} else {
//						// !!!!!!!!!!!!!!!!!!!!!!!!!!!!
//						// if the payment FAILED
//						$paymentstatus = 1;
//						$orderstatus = 3;
//						$this->template->content->status = 3;
//						$this->template->content->trans_status = '';
//					}
//
//
//					break;
			case 'testpayment':
				if (FALSE === strpos($_SERVER['SERVER_NAME'],'beta.polardesign.com')) {
					$errors = 'Wrong payment method';
				} else {
					// !!!!!!!!!!!!!!!!!!!!!!!!!!!!
					// if the payment was SUCCESSFUL
					$this->template->content->trans_status = 'Test payment used';
					$this->template->content->status = 1;
					$transaction_id = 'TESTPAYMENT';
					$paymentstatus = 3;
					$orderstatus = 2;
				}
				break;
			default:
				$errors = 'Wrong payment method';
		}

		$order->statusID = $orderstatus;
		$order->date_modified = time();
		$order->refreshTotals();//includes ->save();

		$order_id = '';
		if($orderstatus == 2)
		{
			//CREATE PAYMENT
			$db->query('INSERT INTO payments (transaction_number, statusID, transaction_date) VALUES (\''.$transaction_id.'\', '.$paymentstatus.', '.time().')');
			$paymentid = mysql_insert_id();

			//UPDATE THE ORDER TABLE
			$order->paymentID = $paymentid;
			$order->payment_method = 'Credit Card';
			$order->order_date = date("Y-m-d H:i:s");
			$order->save();

			$user_id = FALSE;
			if (User_Model::logged_in())
				$user_id = User_Model::logged_user()->id;
			Session::instance()->regenerate();
			if ($user_id)
				ORM::factory('user')->find($user_id)->forceLogin();

			//CREATE Order ID Entry
			if (FALSE === ($order_id = $order->getOrderId())) {
				$db->query('INSERT INTO order_ids (order_id) VALUES ('.$order->id.')');
				$order_id = $order->getOrderId();
			}
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
		
		// After all the alterations and everything have been made, select the basket and pass on the this of items to the template
		$resultall = $db->query('
							SELECT 
								orders_baskets.*, 
								orders_baskets.id as orders_basket_id, 
								products.name as productname, 
								products_descriptions.image as productimage, 
								products_descriptions.image_alt 
							FROM orders_baskets 
							LEFT JOIN products 
								ON orders_baskets.product_id = products.id 
							LEFT JOIN products_descriptions 
								ON products.products_description_id = products_descriptions.id 
							WHERE orders_baskets.order_id = '.$order->id);
		$this->template->content->itemsresults = $resultall;
	}
	
	public function update_quantity() {
		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('shopping_cart');
		
		foreach($_POST['orders_basket'] as $ordersBasketId => $coinsAmount) {
			$basket = ORM::factory('orders_basket')->find($ordersBasketId);
			
			if (self::getCurrentSite()->packaging == 1 && $basket->packaging_id != 0)
			{
				$packaging = ORM::factory('packaging')->find($basket->packaging_id);
				$packagingUnitPrice = $packaging->getUnitPriceForAmount($coinsAmount);
				if (FALSE !== $packagingUnitPrice)
				{
					$basket->qty = $coinsAmount;
					$basket->packaging_rate = $packagingUnitPrice->price;
					$basket->subtotal = $coinsAmount * $packagingUnitPrice->price;
				}
			}
			else
			{
				$productUnitPrice = $basket->product->getUnitPriceForAmount($coinsAmount)->price;
				
				$basket->qty = $coinsAmount;
				$basket->rate = $productUnitPrice;
				$basket->subtotal = $coinsAmount * $productUnitPrice;
			}
			
			$basket->save();
		}
		$order = $basket->order;
		$order->refreshTotals();
		
		url::redirect('/shopping_cart/');
		

		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;
		
	}


	public function paypal_ok() {
		$trans_id = $this->input->get('token');


		// In Kohana, all views are loaded and treated as objects.
		$this->template->content = new View('paypal_status');
		
		$postvars = $_POST;
		$db=new Database;

		
		$result = $db->query('SELECT * FROM orders WHERE trans_id = \''.$trans_id.'\'');
		$order = $result[0];
		
		$this->template->content->_order = ORM::factory('order',$order->id);

		//CREATE PAYMENT
		$result = $db->query('INSERT INTO payments (transaction_number, statusID, transaction_date) VALUES (\''.$trans_id.'\', 3, '.time().')');
		$paymentid = mysql_insert_id();

		//CREATE Order ID Entry
		$_res = $db->query('SELECT id FROM order_ids WHERE order_id="'.$order->id.'"');
		if(!$_res[0] || !$_res[0]->id) {
			//CREATE Order ID Entry
			$_res = $db->query('INSERT INTO order_ids (order_id) VALUES ('.$order->id.')');
			$new_order_id = mysql_insert_id();
		} else {
			$new_order_id = $_res[0]->id;
		}
			
		//UPDATE THE ORDER TABLE
		$result = $db->query('UPDATE orders SET paymentID = '.$paymentid.', payment_method = "PayPal", statusID = 2, order_total= '.$order->subtotal.', shipping_total = '.$order->shipping_total.', order_date = \''.date("Y-m-d H:i:s", time()).'\', date_modified = '.time().' WHERE id = '.$order->id.''); 

		
		$result = $db->query('SELECT orders.*, users.email, user_billing_infos.firstname as billfname, user_billing_infos.lastname as billlname, user_billing_infos.address1 as billaddress, user_billing_infos.city as billcity, user_billing_infos.state as billstate, user_billing_infos.zip as billzip, user_billing_infos.country as billcountry, user_billing_infos.phone1 as billphone, user_shipping_infos.firstname as shipfname, user_shipping_infos.lastname as shiplname, user_shipping_infos.address1 as shipaddress, user_shipping_infos.city as shipcity, user_shipping_infos.state as shipstate, user_shipping_infos.zip as shipzip, user_shipping_infos.country as shipcountry FROM orders LEFT JOIN user_billing_infos ON orders.billingID = user_billing_infos.id LEFT JOIN user_shipping_infos ON orders.shippingID = user_shipping_infos.id LEFT JOIN users ON orders.user_id = users.id WHERE orders.id = '.$order->id.'');
		$order = $result[0];


		$shippingInfo = $order->shipfname.' '.$order->shiplname.'<br/>'.
				$order->shipaddress.'<br/>'.$order->shipcity.' '.$order->shipstate.'<br/>'.$order->shipzip.'<br/>'.
				$order->shipcountry;
		
	
		$billingInfo = $order->billfname.' '.$order->billlname.'<br/>'.
					$order->billaddress.'<br/>'.$order->billcity.' '.$order->billstate.'<br/>'.$order->billzip.'<br/>'.
					$order->billcountry;
		$dateTime = date('Y-m-d H:i:s');



		
		$res = $db->query('SELECT p.name, ob.qty, ob.subtotal, ob.id as ob_id FROM products p JOIN orders_baskets ob ON (ob.product_id=p.id) WHERE ob.order_id="'.$order->id.'"');
		
		
		$description = '';
		$subtotal = 0;
		foreach($res as $item){
			$basket = ORM::factory('orders_basket',$item->ob_id);
			$product_name = $item->name;
			if ($basket->packaging_id != 0)
				$product_name .= ' - '.$basket->packaging->name;
			
			$description .= ''. $item->qty .' x '.$product_name .' = '.  money_format('%.2n', $item->subtotal) . '<br/>';
			$subtotal += $item->subtotal;
		}
		if (!empty($order->comment)){
			$description .= 'Comment:'.$order->comment.'<br/>';
		}
		
		$total = 'Subtotal: ' .  money_format('%.2n', $subtotal) . '<br/>Shipping:' .  money_format('%.2n', $order->shipping_total);
		$total .= '<br/>Total:' .  money_format('%.2n', $order->order_total);
	
		
		$emailAddr = $order->email;
		
		$res = $db->query('SELECT id FROM order_ids WHERE order_id = '.$order->id.'');
		$orderid = $res[0]->id;
		$order->id = $orderid;

		$new_order_id = 'MCH'.$orderid;
		
		$to = array(
			$emailAddr,
			'info@mychocolatecoins.com',
			'freddyfalck@hotmail.com',
			'info@deligance.com',
			'contact@polardesign.com'
		);
		foreach ($to as $address)
			Autoresponder::sendEmail('order.status.changed', $address, $order,
							array(
								'shipping_info' => $shippingInfo, 
								'billing_info' => $billingInfo, 
								'date_time' => $dateTime, 
								'description' => $description,
								'total' => $total,
								'order_id' => $new_order_id
							)
						);
		
		$this->template->content->status = 'Your paypal paymeny was successful!';
		$this->template->content->trans_id = $trans_id;
		$this->template->content->order_id = $order->id;

		$user_id = FALSE;
		if (User_Model::logged_in())
			$user_id = User_Model::logged_user()->id;
		Session::instance()->regenerate();
		if ($user_id)
			ORM::factory('user')->find($user_id)->forceLogin();



		// Meta Description and Meta Keywords for individual pages are, at this point, hard coded.
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;

		// You can assign anything variable to a view by using standard OOP
		// methods. In my welcome view, the $title variable will be assigned
		// the value I give it here.
		$this->template->title = $this->title;
		
	}

	
	public function paypal_cancel() {
		// In Kohana, all views are loaded and treated as objects.
		//$this->template->content = new View('paypal_status');
		url::redirect('/shopping_cart');
	}
	
	public function addGnG() {
		if (request::method() == 'post')
		{
			if (is_numeric($product_id = uri::segment(3)))
			{
				$product = ORM::factory('product')->find($product_id);
				if ($product->id == 0)
					url::redirect('/products');
			}
		
			$totalAmount = $_POST['bags'];
			$coinUnitPrice = $product->getUnitPriceForAmount($totalAmount);
			
			//create basket for Grab And Go
			$basket = ORM::factory('orders_basket');
			$basket->product_id =	$product->id;
			$basket->foil_id =		$product->foil_id;
			$basket->flavor_id =	$product->flavor_id;
			$basket->style_id =		1;
			$basket->order_id =		ORM::factory('order')->getCurrentOrder()->id;
			$basket->save();
			
			//set product qty and rate
			$basket->qty = $totalAmount;
			$basket->rate = $coinUnitPrice->price;
			$basket->subtotal = $totalAmount * $basket->rate;

			$basket->save();
			
			//options
			if (isset($_POST['options']))
				foreach ($_POST['options'] AS $option_id => $value) {
					$ob_gngo = ORM::factory('orders_baskets_gngoption');
					$ob_gngo->orders_basket_id = $basket->id;
					$ob_gngo->name = ORM::factory('gngoption',$option_id)->name;;
					$ob_gngo->value = $value;
					$ob_gngo->save();
				}

			url::redirect('/shopping_cart');
		}
		else
		{
			url::redirect('/products');
		}
	}

	public function selectPackaging() {
		$this->template->content = new View('select_packaging');
		$this->template->metaDescription = $this->description;
		$this->template->metaKeywords = $this->keywords;	
		$this->template->metaTitle = $this->title;
		$this->template->title = $this->title;
		
		if (isset($_GET['basketId']))
		{
			$basketId = $_GET['basketId'];
			$basket = ORM::factory('orders_basket')->find($basketId);
			if ($basket->id == 0)
				url::redirect('/');
			$product = $basket->product;
		}
		else
			url::redirect('/products');
		
		if (request::method() == 'post')
		{
			//iterate packagings
			$first = TRUE;
			if (isset($basket)) {
				foreach ($_POST['packagings'] as $packagingId => $coinsAmount) {
					if ($coinsAmount == 0) continue;
					
					if ($first) { 
						$curBasket = $basket; 
						$first = FALSE; 
					} else {
						$curBasket = $basket->cloneThis();
						if ($basket->second_side_fee != 0) {
							$curBasket->basket_with_fee = $basket->id;
							$curBasket->second_side_fee = 0;
						}
					}
					
					//set product qty and rate
					$curBasket->qty = $coinsAmount;
					$curBasket->rate = 0;
					
					//get packaging and get qty and rate
					$packaging = ORM::factory('packaging')->find($packagingId);
					$packagingUnitPrice = $packaging->getUnitPriceForAmount($coinsAmount);
					
					if (FALSE !== $packagingUnitPrice) {
						//set packaging id, qty and rate
						$curBasket->packaging_rate = floatval($packagingUnitPrice->price);
						$curBasket->packaging_id = $packagingId;

						//calculate and set subtotal
						$curBasket->subtotal = $coinsAmount * $packagingUnitPrice->price;

						$curBasket->save();
					}
					
					//options
					if (isset($_POST['packagingoptions']) && 
						isset($_POST['packagingoptions'][$packagingId]))
						foreach ($_POST['packagingoptions'][$packagingId] AS $option_id => $value) {
							$ob_po = ORM::factory('orders_baskets_packagingoption');
							$ob_po->orders_basket_id = $curBasket->id;
							$ob_po->name = ORM::factory('packagingoption',$option_id)->name;;
							$ob_po->value = $value;
							$ob_po->save();
						}
				}
			}

			url::redirect('/shopping_cart');
		}
		else
		{
			if (isset($_GET['basketId']))
			{
				$this->template->content->formAction = '/shopping_cart/selectPackaging/?basketId='.$basket->id;
				$this->template->content->basket = $basket;
				$this->template->content->product = $basket->product;
			}
			else if (is_numeric($product_id = Router::$arguments[0]))
			{
				$this->template->content->formAction = '/shopping_cart/selectPackaging/'.$product_id;
				$this->template->content->product = $product;
			}
			else
				url::redirect('/');
		}
	}


	public function __call($method, $arguments) {
		// Disable auto-rendering
		$this->auto_render = FALSE;
		// By defining a __call method, all pages routed to this controller
		// that result in 404 errors will be handled by this method, instead of
		// being displayed as "Page Not Found" errors.
		echo 'This text is generated by __call. If you expected the index page, you need to use: welcome/index/'.substr(Router::$current_uri, 8);
	}


} // End Welcome Controller
