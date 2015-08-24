<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<?php 
$db=new Database;
$id = $this->uri->segment(3);
$order = Order::getOrderByID($id);
$_order = ORM::factory('order',$id);
$user = ORM::factory('user')->where('id', $order->user_id)->find();
$shipping = ORM::factory('user_shipping_info')->where('id', $order->shippingID)->find();
$billing = ORM::factory('user_billing_info')->where('id', $order->billingID)->find();
//$user = User::getUserByID($order->user_id);
$order_products = Basket::getBasketContentForOrder($id);
//var_dump($order_products[0]);
$order_statuses = Order::getOrderStatusByID($id);
$order_id = $_order->getOrderId();




function order_status (){
	$status = array(	1=>"Pending", 
						2=>"Processed", 3=>"Denied", 4=>"Shipped", 5=>"Delivered", 6=>"Canceled", 7=>"Refund");
	return $status;
}

function status_filter ($id){
	switch ($id){
		case 1: return "Pending"; 
		case 2: return "Processed";
		case 3: return "Denied";		
		case 4: return "Shipped"; 
		case 5: return "Delivered"; 
		case 6: return "Canceled"; 
		case 7: return "Refund"; 
	}
}
?>		

<form action="<?php echo url::base() . $this->uri->segment(1). '/' . $this->uri->segment(2) . '/' .$id ?>" method="POST" >

<div id="mainContent" >
	<div class="box">
		  <div class="left"></div>
		  <div class="right"></div>
		  <div class="heading">
		    <h2 id="heading">Orders</h2>
		    <span id="buttons">
				<a class="button" href="<?php  echo url::base() ?>invoice?id=<?php echo $this->uri->segment(3) ?>" target="_blank"><span>Print Invoice</span></a>
				<a class="button" href="<?php  echo url::base() ?>packing_slip?id=<?php echo $this->uri->segment(3) ?>" target="_blank"><span>Print Packing Slip</span></a>
				<input type="button" onclick="location = '<?php  echo url::base() . $this->uri->segment(1) ?>'" value='Cancel' class="css-button"  />
			</span>
		</div>
	</div>
	
	<div id="contentLeft">
		<div id="tabs" class="htabs" >
			<a tab="#tab_order_details">Order Details</a>
			<a tab="#tab_products">Products</a>
			<a tab="#tab_shipping_address">Shipping Address</a>
			<a tab="#tab_billing_address">Billing Address</a>
			<a tab="#tab_order_status">Order Status</a>
		</div>
 	</div>
		
	<div id="contentRight">
	
		<div id="tab_order_details">
			<table class="form">
				<tr>
					<th> </th>
					<th> </th>
				</tr>
				<tr>
					<td>Order ID:</td>
					<?php if(FALSE !== $order_id) : ?>
					<td><?php echo $order_id; ?></td>
					<?php else: ?>
					<td>Order IDs are not available for orders that have not yet been processed.</td>
					<?php endif; ?>
				</tr>
				<tr>
					<td>Customer Name:</td>
					<td><?php echo $user->firstname .' '. $user->lastname ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><a href="mailto:<?php echo $user->email ?>" class="mail" title="Click here to email <?php echo $user->email ?>"><?php echo $user->email ?></a></td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td><?php echo format::phone($user->phone1) ?></td>
				</tr>
				<tr>
					<td>Secondary Phone:</td>
					<td><?php echo format::phone($user->phone2) ?></td>
				</tr>
				<tr>
					<td>Date Added:</td>
					<td><?php echo date("m/d/Y h:i a", $order->date_created)	?></td>
				</tr>
				<tr>
					<td>Date Requested:</td>
					<td><?php $timereq = mktime(0,0,0,substr($order->order_delivery_date,5,2),substr($order->order_delivery_date,8,2),substr($order->order_delivery_date,0,4)); echo date("m/d/Y", $timereq)	?></td>
				</tr>
				<?php if($order->statusID != 1): $result = $db->query('SELECT shipping_methods.name FROM shipping_methods INNER JOIN orders ON orders.shipping_method_id = shipping_methods.id WHERE orders.id = '.$order->id.'');
				if($result[0]) {$shippingMethod = $result[0]->name; } else { $shippingMethod='none';} ?>
				<tr>
					<td>Shipping method:</td>
					<td><?php echo $shippingMethod ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>Payment Method:</td>
					<td><?php echo $order->payment_method ?></td>
				</tr>
				<?php if($order->statusID != 1): ?>
				<tr>
					<td>Transaction ID:</td>
					<td><?php echo $order->trans_id; ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<td>Order Subtotal:</td>
					<td><?php echo format::dollar($_order->subtotal) ?></td>
				</tr>
				<tr>
					<td>Shipping Total:</td>
					<td><?php echo format::dollar($_order->shipping_total) ?></td>
				</tr>
				<tr>
					<td>Order Total:</td>
					<td><?php echo format::dollar(($_order->order_total)) ?></td>
				</tr>
				<tr>
					<td>Order Status:</td>
					<td><?php echo status_filter($order->statusID) ?></td>
				</tr>
				<tr>
					<td>Comment:</td>
					<td id='comment'><?php echo $order->comment ?><a onclick="changeOrderComment('comment')">Change</a></td>
				</tr>
				
			</table>
		 </div>  <!-- div id="tab_order_details" -->
			  
			 
		<div id="tab_products">
			<table class="list" >
				<colgroup>
					<col width="800" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
					<col width="150" />
				</colgroup>
				<tr>
					<th>Product</th>
					<th>Product Type</th>
					<th>Quantity</th>
					<th>Unit Price</th>
					<th>Total</th>
				</tr>
				<?php 
				$additionalFees = 0;
					foreach ($order_products as $product){
						$basket = ORM::factory('orders_basket')->find($product->id);
						$pr = Product::getProductById($product->product_id);
						$texts = $basket->getTextToShow(); 
						$additionalFees += $basket->second_side_fee;
?>
				<tr>
					<td><a rel="<?=$pr->id?>" onClick="showhideBox('productInfo<?=$product->id?>')"><?=$pr->name?></a> &nbsp;</td>
					<td><?=$pr->products_type->name?> &nbsp;</td>
					<td align="right"><?=$product->qty?>&nbsp;</td>
					<td align="right"><?=format::dollar($basket->packaging_rate ? $basket->packaging_rate : $product->rate)?>&nbsp;</td>
					<td align="right"><?=format::dollar($product->subtotal)?>&nbsp;</td>
				</tr>

				<tr>
					<td colspan="5">
						<div id="productInfo<?=$product->id?>" 
							 style="display:none;visibility:hidden;background-color:#eeeeee;">
							<h3>Product Info</h3>
							<strong>Product:</strong> <?=$pr->name?> <br>
							<strong>Quantity:</strong> <?=$product->qty?><br>
							<strong>Flavor: </strong> <?=$basket->flavor->name?> <br>
<?
							foreach ($basket->orders_baskets_datas as $data) {
								if ($data->type == 'Foil') {
									$_data = json_decode($data->data, TRUE);
?>
							<strong><?=$data->name?>:</strong> <?=$_data['name']?>	<br>
<?	
								}
							}
						if($product->product_id == 2) {
?>
							<strong>Style:</strong> <?=$product->style_id == 1 ? 'Heart Favor' : 'Lollipop'?><br>
<?
						}
						
						foreach ($texts as $text)
						{
?>
							<strong><?=$text->name?>: </strong> <?=$text->text?> (Font: <?=$text->font?>)<br />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Size: <?=$text->size?> | 
							Color: <?=$text->color_name?> (#<?=$text->color_hex?>)<br />
							<br>
<?						
						}

						foreach ($basket->orders_baskets_gngoptions as $option)
						{
?>
							<strong><?=$option->name?>: </strong> <?=$option->value?>
							<br>
<?
						}
						
						if ($basket->packaging_id != 0)
						{
?>
							<strong>Packaging: </strong><?=$basket->packaging->name?><br />
<?							
							if ($basket->orders_baskets_packagingoptions)
								foreach ($basket->orders_baskets_packagingoptions as $option)
								{
?>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<strong><?=$option->name?>:</strong> <?=$option->value?><br />
<?
								}
						}
								
								if(!empty($product->designpath) && $product->designpath != 'NULL') {
								echo '<div style="float:left;width:100%;display:block;"><h3>Design:</h3><a href="'.$product->designpath.'">'.$product->designpath.'</a><br>
								 <img src="'.$product->designpath.'" height="260"></div><br>';
								}
								if(!empty($product->clippath) && $product->clippath != 'NULL') {
								echo '<div style="float:left;width:100%;display:block;"><h3>Clip Image</h3><a href="'.$product->clippath.'">'.$product->clippath.'</a>
								 <br>
								 Color: '.$product->design_color.'<br>
								 <br><img src="'.$product->clippath.'" width="260" height="260"></div>';
								}
							
							echo '
							
							 </div>';
								 
								 
								
							


						echo '</td></tr>';
						}
						
						if ($additionalFees != 0) {
?>
				<tr>
					<td>Additional Fees</td>
					<td>&nbsp;</td>
					<td align="right">&nbsp;</td>
					<td align="right"><?=$additionalFees?></td>
					<td align="right"><?=format::dollar($additionalFees)?>&nbsp;</td>
				</tr>									
<?
						}
				?>

				

				<tr>
					<td colspan="4" align="right">Sub-total: </td>
					<td align="right"><?php echo format::dollar($_order->subtotal) ?></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Shipping Rate: </td>
					<td align="right"><?php echo format::dollar($_order->shipping_total) ?></td>
				</tr>
				<?php
					/*if (($discount = $order_subtotal + $order->shipping_total - $order->order_total) > 0){
				?>
					<tr>
						<td colspan="4" align="right">Discount: </td>
						<td align="right"><?php echo format::dollar($discount) ?></td>
					</tr>				
				<?php
					}*/
				?>
				<tr>
					<td colspan="4" align="right">Total: </td>
					<td align="right"><?php echo format::dollar($_order->order_total) ?></td>
				</tr>		   
			</table>
		 </div>   <!-- div id="tab_products" -->

		
			

		 <div id="tab_shipping_address">
			<table class="form">	
				<tr>
					<td>First Name:</td>
					<td id='shipping_firstname'><?php echo $shipping->firstname; ?><a onclick="change('shipping_firstname')">Change</a>
					</td>
				</tr>						
				<tr>
					<td>Last Name:</td>
					<td id='shipping_lastname'><?php echo $shipping->lastname; ?><a onclick="change('shipping_lastname')">Change</a></td>
				</tr>		
				<tr>
					<td>Company:</td>
					<td id='shipping_company'><?php echo $shipping->company; ?><a onclick="change('shipping_company')">Change</a></td>
				</tr>
				<tr>
					<td>Address 1:</td>
					<td id='shipping_address1'><?php echo $shipping->address1; ?><a onclick="change('shipping_address1')">Change</a></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td id='shipping_address2'><?php echo $shipping->address2; ?><a onclick="change('shipping_address2')">Change</a></td>
				</tr>
				<tr>
					<td>City:</td>
					<td id='shipping_city'><?php echo $shipping->city; ?><a onclick="change('shipping_city')">Change</a></td>
				</tr>
				<tr>
					<td>State:</td>
					<td id='shipping_state'><?php echo $shipping->state; ?><a onclick="change('shipping_state')">Change</a></td>
				</tr>
				<tr>
					<td>Postal Code:</td>
					<td id='shipping_zip'><?php echo $shipping->zip; ?><a onclick="change('shipping_zip')">Change</a></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td id='shipping_country'><?php echo $shipping->country; ?><a onclick="change('shipping_country')">Change</a></td>
				</tr>
			</table>
		 </div>   <!-- div id="tab_shipping_address" -->
		 
		 
		<div id="tab_billing_address" >
			<table class="form">
				<tr>
					<td>First Name:</td>
					<td id='billing_firstname'><?php echo $billing->firstname; ?><a onclick="change('billing_firstname')">Change</a></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td id='billing_lastname'><?php echo $billing->lastname; ?><a onclick="change('billing_lastname')">Change</a></td>
				</tr>		
				<tr>
					<td>Company:</td>
					<td id='billing_company'><?php echo $billing->company; ?><a onclick="change('billing_company')">Change</a></td>
				</tr>
				<tr>
					<td>Address 1:</td>
					<td id='billing_address1'><?php echo $billing->address1; ?><a onclick="change('billing_address1')">Change</a></td>
				</tr>
				<tr>
					<td>Address 2:</td>
					<td id='billing_address2'><?php echo $billing->address2; ?><a onclick="change('billing_address2')">Change</a></td>
				</tr>
				<tr>
					<td>City:</td>
					<td id='billing_city'><?php echo $billing->city; ?><a onclick="change('billing_city')">Change</a></td>
				</tr>
				<tr>
					<td>State:</td>
					<td id='billing_state'><?php echo $billing->state; ?><a onclick="change('billing_state')">Change</a></td>
				</tr>
				<tr>
					<td>Postal Code:</td>
					<td id='billing_zip'><?php echo $billing->zip; ?><a onclick="change('billing_zip')">Change</a></td>
				</tr>
				<tr>
					<td>Country:</td>
					<td id='billing_country'><?php echo $billing->country; ?><a onclick="change('billing_country')">Change</a></td>
				</tr>
			</table>
		</div>   <!-- div id="tab_billing_address" -->
		 
		 		 
		  
		<div id="tab_order_status">
			<table class="list">
				<tr>
					<th>Date Modified</td>
					<th>Status </td>
				</tr>	
				<tr>
					<td><?=date('m-d-Y H:i:s',$order->date_modified)?></td>
					<td><?=status_filter($order->statusID)?></td>
				 </tr>
				<tr>
					<td colspan="2" align="right">
						Order Status: 
						<select name="status">
						<?php 
							$order_statuses = order_status();
							foreach($order_statuses as $key => $value){
								if ($order->statusID == $key)
									$sel = 'selected=selected';
								else
									$sel ='';
								echo '<option value="'.$key.'"' . $sel .' >'.$value.'</option>';
							}
						?>			
						</select>

						<input type="submit" value="Update Order Status" name="update"  /> 
					</td>
				</tr>
			</table>
		</div>   <!-- div id="tab_order_status" -->

	</div>    	<!-- div id="contentRight" -->
</div>  <!-- div id='mainContent' -->
</form>

<script type="text/javascript">
	function change(el){
		//$('#'+el+'').empty();
		$('<input type="text" name="'+el+'" value="" />').appendTo($('#'+el+''));
		$('<input type="submit" name="save" value="Save" class="css-button" />').appendTo($('#'+el+''));
	}
	function changeOrderComment(el){
		$('#'+el+'').empty();
		$('<textarea cols="40" rows="8" name="'+el+'" /></textarea>').appendTo($('#'+el+''));
		$('<input type="submit" name="save" value="Save" class="css-button" />').appendTo($('#'+el+''));
	}
</script>

<script type="text/javascript"><!--
$.tabs('#tabs a', '<?php echo isset($_POST['selected_tab']) ? $_POST['selected_tab'] : ''?>'); 
//--></script>