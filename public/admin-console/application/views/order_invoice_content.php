<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php 
$id = $this->uri->segment(3);
$order = Order::getOrderByID($id);

$order_products = Basket::getBasketContentForOrder($id);
$order_statuses = Order::getOrderStatusByID($id);

function order_status (){
	$status = array(	1=>"Pending", 2=>"Ordered",
						3=>"Processed", 4=>"Shipped", 5=>"Delivered", 6=>"Canceled", 7=>"Refund");
	return $status;
}

function formatPhone($phone){
	$phone = preg_replace('/[^0-9]/', '', $phone);

	$len = strlen($phone);
	if($len == 7)
		$phone = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $phone);
	elseif($len == 10)
		$phone = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $phone);

	return $phone; 
}
		
function dollar($dollar){
	return '$'. number_format($dollar, 2);
}		

function capitalize($name){
	return ucfirst(strtolower($name)).'<br/>';
}
		
function formatDate($date){
	//return  date("m/d/Y  H:m:s" , $date);
	return $date;
}

function status_filter ($id){
	switch ($id){
		case 1: return "Pending"; 
		case 2: return "Ordered"; 
		case 3: return "Processed"; 
		case 4: return "Shipped"; 
		case 5: return "Delivered"; 
		case 6: return "Canceled"; 
		case 7: return "Refund"; 
	}
}
?>		


<div id="mainContent" >
	
		
	<div id="contentRight">
		<div id="tab_order_details">
			
			<table class="form">
				<tr>
					<th> </th>
					<th> </th>
				</tr>
				<tr>
					<td>Order ID:</td>
					<td><?php echo $order->trans_id; ?></td>
				</tr>
			<!--	<tr>
					<td>Invoice ID:</td>
					<td><?php echo $order->trans_id; ?></td>
				</tr>		-->
				<tr>
					<td>Customer Name:</td>
					<td><?php echo $order->first_name .' '. $order->last_name ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?php echo $order->email ?></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><?php echo formatPhone($order->telephone) ?></td>
				</tr>
			<!--	<tr>
					<td>Quantity:</td>
					<td> </td>
				</tr> -->
				<tr>
					<td>Date Added:</td>
					<td><?php echo formatDate($order->date_created)	?></td>
				</tr>
				<tr>
					<td>Shipping method:</td>
					<td><?php echo $order->shipping_method ?></td>
				</tr>
				<tr>
					<td>Payment Method:</td>
					<td><?php echo $order->payment_method ?></td>
				</tr>
				<tr>
					<td>Order Total:</td>
					<td><?php echo dollar($order->payment_total) ?></td>
				</tr>
				<tr>
					<td>Order Status:</td>
					<td><?php echo status_filter($order->status) ?></td>
				</tr>
				<tr>
					<td>Comment:</td>
					<td><?php echo $order->comment ?></td>
				</tr>
				<tr>
					<td>Discounts:</td>
					<td><?php echo $order->discounts ?></td>
				</tr>				
			</table>
		 </div>  <!-- div id="tab_order_details" -->
			  
			 
		<div id="tab_products">
			<table class="list" >
				<colgroup>
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
				</colgroup>
				<tr>
					<th>Product</th>
					<th>Product Type</th>
					<!--<th>Product Options</th>-->
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
				<?php 
					$order_subtotal = 0;
					foreach ($order_products as $product){
						$pr = Product::getProductById($product->product_id);
		
						echo '<tr>
								<td>'. $pr->name.'</td>
								<td>'. $pr->products_type->name .'</td>';
						//		<td>';
						//		foreach( unserialize($product->options) as $key => $value) 
						//			echo $key . ' ' . $value .'<br>';
						//echo '</td>
						echo 	'<td align="right">'. $product->qty        .'</td>
								<td align="right">'. dollar($pr->price) .'</td>
								<td align="right">'. dollar($product->subtotal)  .'</td>
							</tr>';
						$order_subtotal += $product->subtotal;	
						}
				?>
				<tr>
					<td colspan="4" align="right">Sub-total: </td>
					<td align="right"><?php echo dollar($order_subtotal) ?></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Shipping Rate: </td>
					<td align="right"><?php echo dollar($order->shipping_total) ?></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Tax: </td>
					<td align="right"><?php echo dollar($order->tax) ?></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Total: </td>
					<td align="right"><?php echo dollar($order->payment_total) ?></td>
				</tr>		   
			</table>
		 </div>   <!-- div id="tab_products" -->
			 
		 <div id="tab_shipping_address">
			<table class="form">
				<tr>
					<th>Shipping Info</th>
					<th> </th>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><?php echo $order->orders_address->shipping_first_name; ?></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><?php echo $order->orders_address->shipping_last_name; ?></td>
				</tr>		
				<!--<tr>
					<td>Customer Name:</td>
					<td> </td>
				</tr>-->
				<tr>
					<td>Company:</td>
					<td><?php echo $order->orders_address->shipping_company; ?></td>
				</tr>
				<tr>
					<td>Address 1:</td>
					<td><?php echo $order->orders_address->shipping_address1; ?></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td><?php echo $order->orders_address->shipping_address2; ?></td>
				</tr>
				<tr>
					<td>City:</td>
					<td><?php echo $order->orders_address->shipping_city; ?></td>
				</tr>
				<tr>
					<td>State:</td>
					<td><?php echo $order->orders_address->shipping_state; ?></td>
				</tr>
				<tr>
					<td>Postal Code:</td>
					<td><?php echo $order->orders_address->shipping_zip; ?></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td><?php echo $order->orders_address->shipping_country; ?></td>
				</tr>
			</table>
		 </div>   <!-- div id="tab_shipping_address" -->
		 
		 
		<div id="tab_billing_address" >
			<table class="form">
				<tr>
					<th>Billing Info</th>
					<th> </th>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><?php echo $order->orders_address->billing_first_name; ?></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><?php echo $order->orders_address->billing_last_name; ?></td>
				</tr>		
				<tr>
					<td>Customer Name:</td>
					<td><?php echo $order->orders_address->billing_company; ?></td>
				</tr>
				<tr>
					<td>Company:</td>
					<td><?php echo $order->orders_address->billing_company; ?></td>
				</tr>
				<tr>
					<td>Address 1:</td>
					<td><?php echo $order->orders_address->billing_address1; ?></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td><?php echo $order->orders_address->billing_address2; ?></td>
				</tr>
				<tr>
					<td>City:</td>
					<td><?php echo $order->orders_address->billing_city; ?></td>
				</tr>
				<tr>
					<td>State:</td>
					<td><?php echo $order->orders_address->billing_state; ?></td>
				</tr>
				<tr>
					<td>Postal Code:</td>
					<td><?php echo $order->orders_address->billing_zip; ?></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td><?php echo $order->orders_address->billing_country; ?></td>
				</tr>
			</table>
		</div>   <!-- div id="tab_billing_address" -->
		 
		 		 
		  
		

	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->