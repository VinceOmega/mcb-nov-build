<?php
class Cart_Controller extends Controller {
		
	function index()
	{
		echo 'example of the usage of the cart module <BR>';			
		$cart = new Basket();
		$cart->clear();
		

		echo 'there are '. $cart->size() .' items in the cart<BR>';
		assert(($cart->size() == 0));
		echo 'there are '. $cart->qty() .' qty items in the cart<BR><BR>';
		assert(($cart->qty() == 0));
	
	
	
	
		$item = new Item;
		$item->id = 2;
		$cart->add($item);
		
		
		$item = new Item;
		$item->id = 4;
		$cart->add($item); //adds just one product (with id of 4)	
		
		
		$item = new Item;
		$item->id = 4;
		$item->qty = 2;
		$item->options = array('color'=>'red');
		$cart->add($item); //add the 2 of the same product but with options
		
		echo 'there are '. $cart->size() .' items in the cart<BR>';
		assert(($cart->size() == 3));
		echo 'there are '. $cart->qty() .' qty items in the cart<BR><BR>';
		assert(($cart->qty() == 4));

		
		$item = new Item;
		$item->id = 4;
		$item->qty = 2;		
		$cart->update($item); //add two of product with id 2

		echo 'there are '. $cart->size() .' items in the cart<BR>';
		assert(($cart->size() == 3));
		echo 'there are '. $cart->qty() .' qty items in the cart<BR><BR>';
		assert(($cart->qty() == 5));
		

		$item = new Item;
		$item->id = 4;
		$cart->remove($item);//remove product 4 (only the one without any options) from the cart (along with it 2 qty)
		
		echo 'there are '. $cart->size() .' items in the cart<BR>';
		assert(($cart->size() == 2));
		echo 'there are '. $cart->qty() .' qty items in the cart<BR><BR>';
		assert(($cart->qty() == 3));
		

		
		$item = new Item;
		$item->id = 3;
		$item->qty = 2;
		$item->options = array('cool'=>'yes');				
		$cart->add($item);
		
		//adding a item through the array method
		$i = array(	'id' => 4,
					'qty'=> 5,
					'options' => array('color'=>'red'));

					
		$item = new Item($i);
		$cart->update($item); //update qty of the item given information 		
		
	
		/*
		//you can also use strings for the id (just remeber to have a corresponding key in your database)
		$item = new Item(array(	'id' => 'test3', 'qty'=> 2));
		$cart->update($item); //update qty of the item given information 
		*/		
		
		
		
		echo 'there are '. $cart->size() .' items in the cart<BR>';
		assert(($cart->size() == 3));
		echo 'there are '. $cart->qty() .' qty items in the cart<BR><BR>';
		assert(($cart->qty() == 8));
		
		
		echo '<BR>';
		if(! $cart->isEmpty()):
			
			foreach($cart->products() as $item):
				echo $item->name. " | " . $item->key . " | ". $item->qty . " | ".  $item->price. " | ".  $item->total."<br/>";
			endforeach;
			
		else:
			echo 'no products<BR>';
		endif;

		
		echo '<BR>';
		echo 'cart sub-total is '.$cart->subtotal()  ."<br/>";
		
		
		
		
		// There are two methods to get the order //
		// METHOD 1 (through the order class) //
		
		$form->shipping->first_name = 'Joe';
		$form->shipping->last_name = 'Smith';
		$form->shipping->address1 = '10 Elm st.';
		$form->shipping->city = 'Somerville';
		$form->shipping->state = 'NH';
		$form->shipping->zip = '02145';
		$form->shipping->country = 'US';
		$form->shipping->phone = '201020277 ';
		$form->shipping->email = 'test@test.com';
		
		$form->shipping->method = 'ups_03_ground';
		
		
		$form->payment->method = 'card'; //or paypal
		$form->payment->card->name = 'Joe Smith';
		$form->payment->card->type = 'V';
		$form->payment->card->card_num = '1234567890123456';
		$form->payment->card->exp_date = '0510';
		$form->payment->card->cvv = '882';
		
		//$form->customer->id = $user->getUserID();
		//$form->customer->ip = $input->getIPAddress();	
		
		
		$order = new Order;
		$order->cart = $cart;
		$order->shipping = $form->shipping;
		//$order->billing = $form->billing;
		//$order->payment = array();
		//$order->customer = array();			
		
		
		echo '<BR>Grand total is $'. $order->total() .'<BR>';
		
		echo $order->tax() .'<BR>';
		echo $order->shipping().'<BR>';
		//echo $order->discount();
		//print_r($order->shipping_methods());
	
		
		
		
		/*	
		// METHOD 2 (direct way) //
		
		//http://code.google.com/p/getpaid/wiki/TaxHandling
		$tax = new Tax('US', 'NH');
		echo 'tax is '. $tax->amount()  ."<br/>";
		
		$shipping = new Shipping('UPS', '02145', 'US', $cart->hash(), $cart->weight());
		//print_r($shipping->methods());
		$shipping->setMethod('ups_03_ground');
		//echo 'shipping is '. $shipping->amount()  ."<br/>";

	
		$grand_total = $cart->subtotal() + $tax->amount(); // + $shipping->amount(); // - $discount->amount()
		echo 'Grand total is $'. $grand_total .'';	
		*/
		
		
		$cart->clear();
		$profile = new Profiler;
		
	}
}
		
?>